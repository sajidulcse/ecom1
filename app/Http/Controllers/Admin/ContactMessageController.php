<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Toastr;

// Contact messages inbox controller -- added 2026-04-15
class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('backEnd.contact_messages.index', compact('messages'));
    }

    public function show($id)
    {
        $msg = ContactMessage::findOrFail($id);

        // Mark as read on open
        if (!$msg->is_read) {
            $msg->update(['is_read' => true]);
        }

        return view('backEnd.contact_messages.show', compact('msg'));
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();
        Toastr::success('Message deleted.', 'Success');
        return redirect()->route('admin.contact_messages.index');
    }
}
