<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Structure\Models\QuoteRequest;

class QuoteRequestController extends Controller
{
    public function index()
    {
        $query = QuoteRequest::query();

        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%');
            });
        }

        if (request()->has('is_read') && request('is_read') !== '') {
            $query->where('is_read', request('is_read'));
        }

        $requests = $query->orderBy('created_at', 'desc')->paginate(15)->appends(request()->query());

        return view('structure::dashboard.quote_requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = QuoteRequest::findOrFail($id);

        if (! $request->is_read) {
            $request->update(['is_read' => true]);
        }

        return view('structure::dashboard.quote_requests.show', compact('request'));
    }

    public function markAsRead($id)
    {
        $request = QuoteRequest::findOrFail($id);
        $request->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديد الطلب كمقروء',
        ]);
    }

    public function markAsUnread($id)
    {
        $request = QuoteRequest::findOrFail($id);
        $request->update(['is_read' => false]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديد الطلب كغير مقروء',
        ]);
    }

    public function destroy($id)
    {
        $request = QuoteRequest::findOrFail($id);
        $request->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف الطلب بنجاح',
        ]);
    }
}
