<?php

namespace App\Modules\Auth\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Dashboard\User\UserRequest;
use App\Modules\Auth\Http\Services\Dashboard\User\UserService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:users-read', ['index', 'show']),
            new Middleware('permission:users-create', ['store', 'create']),
            new Middleware('permission:users-update', ['update', 'edit']),
            new Middleware('permission:users-delete', ['destroy']),
        ];
    }

    public function __construct(private readonly UserService $user) {}

    public function index()
    {
        return $this->user->index();
    }

    public function show(string $id)
    {
        return $this->user->show($id);
    }

    public function create()
    {
        return $this->user->create();
    }

    public function store(UserRequest $request)
    {
        return $this->user->store($request);
    }

    public function edit(string $id)
    {
        return $this->user->edit($id);
    }

    public function update(UserRequest $request, string $id)
    {
        return $this->user->update($request, $id);
    }

    public function destroy(string $id)
    {

        return $this->user->destroy($id);
    }
}
