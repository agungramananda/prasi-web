<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcommerceLink;
use Illuminate\Http\Request;

class EcommerceLinkController extends Controller
{
    public function index()
    {
        $items = EcommerceLink::orderBy('order')->get();
        return view('admin.ecommerce-links.index', compact('items'));
    }

    public function create()
    {
        return view('admin.ecommerce-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'platform' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => $validated['name'],
            'platform' => $validated['platform'] ?? null,
            'url' => $validated['url'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'order' => $validated['order'],
        ];

        EcommerceLink::create($data);

        return redirect()->route('admin.ecommerce-links.index')->with('success', 'E-commerce link berhasil ditambahkan!');
    }

    public function edit(EcommerceLink $ecommerceLink)
    {
        return view('admin.ecommerce-links.edit', ['item' => $ecommerceLink]);
    }

    public function update(Request $request, EcommerceLink $ecommerceLink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'platform' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
        ]);

        $ecommerceLink->update([
            'name' => $validated['name'],
            'platform' => $validated['platform'] ?? $ecommerceLink->platform,
            'url' => $validated['url'] ?? $ecommerceLink->url,
            'icon' => $validated['icon'] ?? $ecommerceLink->icon,
            'is_active' => $validated['is_active'] ?? $ecommerceLink->is_active,
            'order' => $validated['order'],
        ]);

        return redirect()->route('admin.ecommerce-links.index')->with('success', 'E-commerce link berhasil diperbarui!');
    }

    public function destroy(EcommerceLink $ecommerceLink)
    {
        $ecommerceLink->delete();
        return redirect()->route('admin.ecommerce-links.index')->with('success', 'E-commerce link berhasil dihapus!');
    }
}
