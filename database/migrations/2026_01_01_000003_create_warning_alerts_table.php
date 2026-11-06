<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warning_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('severity')->default('WARNING'); // INFO, WARNING, DANGER, CRITICAL
            $table->string('category')->default('weather'); // weather, ocean_wave, volcanic, traffic, security
            $table->string('regency')->default('Semua Wilayah');
            $table->text('content');
            $table->dateTime('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warning_alerts');
    }
};
