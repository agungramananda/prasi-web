<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter');
        $search = trim((string)$request->query('q', ''));
        $query = ContactMessage::query();

        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%")
                  ->orWhere('message', 'like', "%$search%");
            });
        }

        $messages = $query->recent()->paginate(20)->withQueryString();
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.messages.index', compact('messages', 'unreadCount', 'filter', 'search'));
    }

    public function show(ContactMessage $contact_message): View
    {
        if (! $contact_message->is_read) {
            $contact_message->forceFill(['is_read' => true])->save();
        }
        return view('admin.messages.show', ['message' => $contact_message]);
    }

    public function destroy(ContactMessage $contact_message): RedirectResponse
    {
        $contact_message->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', __('Pesan dihapus.'));
    }

    public function markAsRead(ContactMessage $contact_message): RedirectResponse
    {
        if (! $contact_message->is_read) {
            $contact_message->is_read = true;
            $contact_message->save();
        }
        return back()->with('success', __('Ditandai sebagai telah dibaca.'));
    }

    public function bulk(Request $request): RedirectResponse
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);
        if (!is_array($ids) || count($ids) === 0 || $action === null || $action === '') {
            return back()->with('error', __('Pilih pesan dan aksi.'));
        }

        $query = ContactMessage::whereIn('id', $ids);
        if ($action === 'read') {
            $affected = (clone $query)->where('is_read', false)->update(['is_read' => true]);
            return back()->with('success', trans_choice(':count pesan ditandai dibaca.', $affected, ['count' => $affected]));
        }
        if ($action === 'delete') {
            $affected = $query->delete();
            return back()->with('success', trans_choice(':count pesan dihapus.', $affected, ['count' => $affected]));
        }
        return back()->with('error', __('Aksi tidak dikenal.'));
    }
}
