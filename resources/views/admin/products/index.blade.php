@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <p class="text-gray-600">Total {{ $products->total() }} produk</p>
    </div>
    <a href="{{ route('admin.products.create') }}" 
       class="px-6 py-3 bg-gradient-to-r from-[#D4AF37] to-[#F4E4B7] text-[#0B1E3D] font-semibold rounded-lg hover:from-[#F4E4B7] hover:to-[#D4AF37] transition-all shadow-md">
        + Tambah Produk Baru
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EN Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded object-cover">
                            @else
                            <div class="w-12 h-12 bg-gradient-to-br from-[#0B1E3D] to-[#1a3a5c] rounded flex items-center justify-center">
                                <span class="text-[#D4AF37] text-xs font-bold">BK</span>
                            </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500 max-w-xs truncate">{{ Str::limit($product->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->category)
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#F4E4B7] text-[#0B1E3D]">
                            {{ $product->category }}
                        </span>
                        @else
                        <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                        @php($en = $product->getTranslation('name','en'))
                        <div class="mt-1">
                            @if(!$en)
                                <span class="px-2 py-0.5 text-[10px] rounded bg-red-100 text-red-700">EN Missing</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] rounded bg-green-100 text-green-700">EN OK</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-1">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            @if($product->is_featured)
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#D4AF37] text-[#0B1E3D]">
                                Unggulan
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php($en = $product->getTranslation('name','en'))
                        @if(!$en)
                            <span class="px-2 py-0.5 text-[10px] rounded bg-red-100 text-red-700">Missing</span>
                        @else
                            <span class="px-2 py-0.5 text-[10px] rounded bg-green-100 text-green-700">OK</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-[#D4AF37] font-semibold hover:underline">Tambah produk baru</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
    @endif
</div>

@endsection
