<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $items = SocialMedia::orderBy('order')->get();
        return view('admin.social-media.index', compact('items'));
    }

    public function create()
    {
        return view('admin.social-media.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => $validated['name'],
            'icon' => $validated['icon'] ?? null,
            'url' => $validated['url'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'order' => $validated['order'],
        ];

        SocialMedia::create($data);

        return redirect()->route('admin.social-media.index')->with('success', 'Social media berhasil ditambahkan!');
    }

    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social-media.edit', ['item' => $socialMedia]);
    }

    public function update(Request $request, SocialMedia $socialMedia)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
        ]);

        $socialMedia->update([
            'name' => $validated['name'],
            'icon' => $validated['icon'] ?? $socialMedia->icon,
            'url' => $validated['url'] ?? $socialMedia->url,
            'is_active' => $validated['is_active'] ?? $socialMedia->is_active,
            'order' => $validated['order'],
        ]);

        return redirect()->route('admin.social-media.index')->with('success', 'Social media berhasil diperbarui!');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();
        return redirect()->route('admin.social-media.index')->with('success', 'Social media berhasil dihapus!');
    }
}
