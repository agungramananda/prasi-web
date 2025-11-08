@extends('layouts.admin')

@section('title', 'Kelola Social Media')
@section('page-title', 'Kelola Social Media')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <p class="text-gray-600">Total {{ $items->count() }} social media</p>
    </div>
    <a href="{{ route('admin.social-media.create') }}" 
       class="px-6 py-3 bg-gradient-to-r from-[#D4AF37] to-[#F4E4B7] text-[#0B1E3D] font-semibold rounded-lg hover:from-[#F4E4B7] hover:to-[#D4AF37] transition-all shadow-md">
        + Tambah Social Media
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    @if($items->count() > 0)
    <div class="divide-y divide-gray-200">
        @foreach($items as $item)
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $item->name }}</h3>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            Order: {{ $item->order }}
                        </span>
                    </div>

                    @if($item->url)
                    <p class="text-gray-600 mb-2"><a href="{{ $item->url }}" class="text-blue-600 hover:underline" target="_blank">{{ $item->url }}</a></p>
                    @endif

                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        @if($item->icon)
                        <span class="flex items-center">
                            <i class="{{ $item->icon }} mr-2"></i>
                            <span class="text-sm">{{ $item->icon }}</span>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-2 ml-4">
                    <a href="{{ route('admin.social-media.edit', $item) }}" 
                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <form action="{{ route('admin.social-media.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus social media ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="p-12 text-center text-gray-500">
        Belum ada social media. <a href="{{ route('admin.social-media.create') }}" class="text-[#D4AF37] font-semibold hover:underline">Tambah social media baru</a>
    </div>
    @endif
</div>

@endsection
