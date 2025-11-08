<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name.id' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'description.id' => 'required|string',
            'description.en' => 'nullable|string',
            // Allow very large prices now that column is DECIMAL(12,2)
            // Max value before decimal: 10 digits (up to 9,999,999,999.99)
            'price' => 'required|numeric|min:0|max:9999999999.99',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data = [
            'price' => $validated['price'],
            'category' => $validated['category'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
        ];

        if ($request->hasFile('image')) {
            // choose disk: use digitalocean when configured, otherwise public so assets are web-accessible
            $disk = config('filesystems.default') === 'digitalocean' ? 'digitalocean' : 'public';
            $data['image'] = $request->file('image')->store('products', $disk);
        }

        $product = new Product($data);
        $product->setTranslations('name', array_filter($request->input('name', [])));
        $product->setTranslations('description', array_filter($request->input('description', [])));
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name.id' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'description.id' => 'required|string',
            'description.en' => 'nullable|string',
            // Keep validation aligned with DECIMAL(12,2) storage capacity
            'price' => 'required|numeric|min:0|max:9999999999.99',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $update = [
            'price' => $validated['price'],
            'category' => $validated['category'] ?? $product->category,
            'is_featured' => $validated['is_featured'] ?? $product->is_featured,
            'is_active' => $validated['is_active'] ?? $product->is_active,
        ];

        if ($request->hasFile('image')) {
            // keep same disk selection logic as when storing
            $disk = config('filesystems.default') === 'digitalocean' ? 'digitalocean' : 'public';
            if ($product->image) {
                Storage::disk($disk)->delete($product->image);
            }
            $update['image'] = $request->file('image')->store('products', $disk);
        }

        $product->fill($update);
        $product->setTranslations('name', array_filter($request->input('name', [])));
        $product->setTranslations('description', array_filter($request->input('description', [])));
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            $disk = config('filesystems.default') === 'digitalocean' ? 'digitalocean' : 'public';
            Storage::disk($disk)->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
