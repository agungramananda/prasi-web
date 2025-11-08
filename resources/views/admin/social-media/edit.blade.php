@extends('layouts.admin')

@section('title', 'Edit Social Media')
@section('page-title', 'Edit Social Media')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.social-media.update', $item) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg @error('name') border-red-500 @enderror">
                    @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Link)</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $item->icon) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg @error('icon') border-red-500 @enderror">
                    @error('icon')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" name="url" id="url" value="{{ old('url', $item->url) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg @error('url') border-red-500 @enderror">
                    @error('url')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $item->order) }}" min="0" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg @error('order') border-red-500 @enderror">
                        @error('order')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} class="w-4 h-4 text-[#D4AF37] border-gray-300 rounded">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">Aktif</label>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.social-media.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#D4AF37] to-[#F4E4B7] text-[#0B1E3D] font-semibold rounded-lg">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
