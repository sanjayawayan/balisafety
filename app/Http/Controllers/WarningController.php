<?php

namespace App\Http\Controllers;

use App\Models\WarningAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarningController extends Controller
{
    public function index()
    {
        $warnings = WarningAlert::orderByDesc('created_at')->paginate(15);
        return view('admin.warnings', compact('warnings'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'severity' => 'required|in:INFO,WARNING,DANGER,CRITICAL',
            'category' => 'required|string|max:50',
            'regency' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'valid_until' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        WarningAlert::create([
            'title' => $validated['title'],
            'severity' => $validated['severity'],
            'category' => $validated['category'],
            'regency' => $validated['regency'],
            'content' => $validated['content'],
            'valid_until' => $validated['valid_until'] ?? null,
            'is_active' => true,
        ]);

        return back()->with('success', 'Peringatan Dini baru berhasil dipublikasikan!');
    }

    public function toggle($id)
    {
        $warning = WarningAlert::findOrFail($id);
        $warning->is_active = !$warning->is_active;
        $warning->save();

        return back()->with('success', 'Status peringatan dini berhasil diubah.');
    }

    public function destroy($id)
    {
        $warning = WarningAlert::findOrFail($id);
        $warning->delete();

        return back()->with('success', 'Peringatan dini berhasil dihapus.');
    }
}
