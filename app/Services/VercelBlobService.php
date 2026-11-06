<?php

namespace App\Services;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

class VercelBlobService
{
    public function __construct(private HttpFactory $http)
    {
    }

    public function isConfigured(): bool
    {
        return is_string(config('services.vercel_blob.token'))
            && config('services.vercel_blob.token') !== ''
            && is_string(config('services.vercel_blob.store_id'))
            && config('services.vercel_blob.store_id') !== '';
    }

    public function upload(UploadedFile $file, string $pathname): string
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Vercel Blob is not configured.');
        }

        $storeId = Str::after((string) config('services.vercel_blob.store_id'), 'store_');
        $contentType = $file->getMimeType() ?: 'application/octet-stream';
        $requestId = $storeId . ':' . (int) (microtime(true) * 1000) . ':' . bin2hex(random_bytes(6));

        $response = $this->http->timeout(30)
            ->withToken((string) config('services.vercel_blob.token'))
            ->withHeaders([
                'x-api-blob-request-id' => $requestId,
                'x-api-blob-request-attempt' => '0',
                'x-api-version' => '13',
                'x-vercel-blob-store-id' => $storeId,
                'x-vercel-blob-access' => 'private',
                'x-add-random-suffix' => '1',
                'x-allow-overwrite' => '0',
                'x-content-type' => $contentType,
            ])
            ->withBody($file->get(), $contentType)
            ->put('https://vercel.com/api/blob/?pathname=' . rawurlencode($pathname));

        $response->throw();

        $uploadedPath = $response->json('pathname');
        if (!is_string($uploadedPath) || $uploadedPath === '') {
            throw new RuntimeException('Vercel Blob returned an invalid upload response.');
        }

        return $uploadedPath;
    }
}