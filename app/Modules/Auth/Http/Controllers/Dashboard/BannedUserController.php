<?php

namespace App\Modules\Auth\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\BanUserRequest;
use App\Modules\Auth\Services\BannedUserService;
use Illuminate\Http\Request;

class BannedUserController extends Controller
{
    public function __construct(
        private readonly BannedUserService $bannedUserService
    ) {}

    public function index(Request $request)
    {
        $banned = $this->bannedUserService->getPaginatedBannedUsers(
            $request->input('search')
        );

        return view('dashboard.banned_users.index', compact('banned'));
    }

    public function store(BanUserRequest $request)
    {
        // Check if request has phone or user_id
        if ($request->has('phone')) {
            $result = $this->bannedUserService->banUserByPhone(
                $request->input('phone'),
                $request->input('reason'),
                auth('manager')->id()
            );
        } else {
            $result = $this->bannedUserService->banUser(
                $request->input('user_id'),
                $request->input('reason'),
                auth('manager')->id()
            );
        }

        // Handle AJAX requests
        if ($request->ajax()) {
            return response()->json($result);
        }

        return $result['success']
            ? redirect()->route('dashboard.banned-users.index')->with('success', $result['message'])
            : back()->withErrors(['error' => $result['message']]);
    }

    public function unban(int $id)
    {
        $result = $this->bannedUserService->unbanUser($id);

        return $result['success']
            ? redirect()->route('dashboard.banned-users.index')->with('success', $result['message'])
            : back()->withErrors(['error' => $result['message']]);
    }
}
