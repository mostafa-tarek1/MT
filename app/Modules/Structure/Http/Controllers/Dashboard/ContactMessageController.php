<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Structure\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactMessageController extends Controller
{
    public function index()
    {
        $query = ContactMessage::query();

        // Apply search filter if present
        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('message', 'like', '%'.$search.'%');
            });
        }

        // Filter by read status
        if (request()->has('is_read') && request('is_read') !== '') {
            $query->where('is_read', request('is_read'));
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(15)->appends(request()->query());

        return view('structure::dashboard.contact_messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('structure::dashboard.contact_messages.show', compact('message'));
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديد الرسالة كمقروءة'
        ]);
    }

    public function markAsUnread($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => false]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديد الرسالة كغير مقروءة'
        ]);
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف الرسالة بنجاح'
        ]);
    }
}

