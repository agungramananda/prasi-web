@extends('layouts.admin')

@section('title', __('Detail Pesan'))
@section('page-title', __('Detail Pesan'))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-brand-navy hover:underline">&larr; {{ __('Kembali ke Pesan') }}</a>
    <div class="mt-2 flex items-center space-x-2">
        @if(!$message->is_read)
        <form action="{{ route('admin.contact-messages.read', $message) }}" method="POST">
            @csrf
            @method('PATCH')
            <button class="px-3 py-1 text-xs rounded-md bg-blue-100 hover:bg-blue-200 text-blue-700">{{ __('Tandai Dibaca') }}</button>
        </form>
        @endif
        <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" onsubmit="return confirm('{{ __('Hapus pesan ini?') }}');">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 text-xs rounded-md bg-red-100 hover:bg-red-200 text-red-700">{{ __('Hapus') }}</button>
        </form>
    </div>
    
</div>

<div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
    <div class="flex flex-wrap gap-6">
        <div>
            <div class="text-xs text-gray-500">{{ __('Tanggal') }}</div>
            <div class="text-sm text-gray-800">{{ $message->created_at->format('d M Y H:i') }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500">{{ __('Status') }}</div>
            <div>
                @if(!$message->is_read)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">{{ __('Belum Dibaca') }}</span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">{{ __('Sudah Dibaca') }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="text-xs text-gray-500">{{ __('Nama') }}</div>
            <div class="text-sm text-gray-800">{{ $message->name }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500">{{ __('Email') }}</div>
            <div class="text-sm text-gray-800">{{ $message->email }}</div>
        </div>
        @if($message->phone)
        <div>
            <div class="text-xs text-gray-500">{{ __('Telepon') }}</div>
            <div class="text-sm text-gray-800">{{ $message->phone }}</div>
        </div>
        @endif
    </div>

    <div>
        <div class="text-xs text-gray-500">{{ __('Subjek') }}</div>
        <div class="text-base text-gray-900 font-medium">{{ $message->subject }}</div>
    </div>

    <div>
        <div class="text-xs text-gray-500">{{ __('Pesan') }}</div>
        <div class="whitespace-pre-wrap text-gray-800">{{ $message->message }}</div>
    </div>
</div>
@endsection
