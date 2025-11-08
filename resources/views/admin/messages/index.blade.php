@extends('layouts.admin')

@section('title', __('Pesan Masuk'))
@section('page-title', __('Pesan Masuk'))

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Pesan Masuk') }}</h2>
        @if(isset($unreadCount) && $unreadCount > 0)
            <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">{{ $unreadCount }} {{ __('Belum Dibaca') }}</span>
        @endif
    </div>
    <form method="GET" action="" class="flex items-center gap-2">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Cari pesan...') }}"
               class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-brand-gold focus:border-brand-gold w-56" />
        <button class="px-4 py-2 bg-brand-gold text-brand-navy text-sm font-medium rounded-md hover:shadow-subtle">{{ __('Cari') }}</button>
        @if(request('q'))
            <a href="?filter={{ request('filter') }}" class="text-xs text-gray-500 hover:text-gray-700">{{ __('Reset') }}</a>
        @endif
    </form>
    <div class="flex space-x-2">
        <a href="?" class="px-3 py-2 text-sm rounded-md {{ !request('filter') ? 'bg-brand-gold text-brand-navy' : 'bg-gray-100 text-gray-700' }}">{{ __('Semua') }}</a>
        <a href="?filter=unread" class="px-3 py-2 text-sm rounded-md {{ request('filter')==='unread' ? 'bg-brand-gold text-brand-navy' : 'bg-gray-100 text-gray-700' }}">{{ __('Belum Dibaca') }}</a>
        <a href="?filter=read" class="px-3 py-2 text-sm rounded-md {{ request('filter')==='read' ? 'bg-brand-gold text-brand-navy' : 'bg-gray-100 text-gray-700' }}">{{ __('Sudah Dibaca') }}</a>
    </div>
</div>

@if($messages->count() === 0)
    <div class="p-6 bg-white border border-gray-200 rounded-lg text-center text-gray-600">
        @if(request('q'))
            {{ __('Tidak ada hasil untuk pencarian.') }}
        @else
            {{ __('Tidak ada pesan.') }}
        @endif
    </div>
@else
<form method="POST" action="{{ route('admin.contact-messages.bulk') }}" id="bulkForm">
    @csrf
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3"><input type="checkbox" id="selectAll" class="form-checkbox"></th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">{{ __('Pengirim') }}</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">{{ __('Subjek') }}</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">{{ __('Status') }}</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">{{ __('Tanggal') }}</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($messages as $msg)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3"><input type="checkbox" name="ids[]" value="{{ $msg->id }}" class="row-checkbox"></td>
                <td class="px-4 py-3 text-sm text-gray-800">
                    <div class="font-medium">{{ $msg->name }}</div>
                    <div class="text-gray-500 text-xs">{{ $msg->email }}</div>
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">
                    <a href="{{ route('admin.contact-messages.show', $msg) }}" class="text-brand-navy hover:underline">{{ Str::limit($msg->subject, 50) }}</a>
                </td>
                <td class="px-4 py-3">
                    @if(!$msg->is_read)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">{{ __('Belum Dibaca') }}</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">{{ __('Sudah Dibaca') }}</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-sm text-gray-600">{{ $msg->created_at->format('d M Y H:i') }}</td>
                <td class="px-4 py-3 text-sm text-right space-x-2">
                    @if(!$msg->is_read)
                    <form action="{{ route('admin.contact-messages.read', $msg) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="text-xs px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-md">{{ __('Tandai Dibaca') }}</button>
                    </form>
                    @endif
                    <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Hapus pesan ini?') }}');">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700 rounded-md">{{ __('Hapus') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex items-center justify-between p-4 border-t border-gray-200">
        <div class="flex items-center gap-2">
            <select name="action" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">{{ __('Aksi Massal') }}</option>
                <option value="read">{{ __('Tandai Dibaca') }}</option>
                <option value="delete">{{ __('Hapus Terpilih') }}</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-brand-gold text-brand-navy text-sm font-medium rounded-md">{{ __('Terapkan') }}</button>
        </div>
        {{ $messages->links() }}
    </div>
    </div>
</form>

<script>
document.getElementById('selectAll')?.addEventListener('change', function(e){
    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = e.target.checked);
});
</script>
@endif
@endsection
