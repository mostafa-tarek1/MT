<?php

namespace App\Modules\Auth\Http\Services\Dashboard\User;

use App\Modules\Auth\Http\Requests\Dashboard\User\UserRequest;
use App\Modules\Auth\Repository\UserRepositoryInterface;
use App\Modules\Base\Http\Helpers\Http;

use function App\Modules\Base\Http\Helpers\responseFail;
use function App\Modules\Base\Http\Helpers\responseSuccess;

use App\Modules\Base\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class UserService
{
    use FileTrait;

    public function __construct(private readonly UserRepositoryInterface $userRepository) {}

    public function index()
    {
        $query = $this->userRepository->query();

        // Apply search filter if present
        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%');
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(10)->appends(request()->query());

        return view('base::dashboard.users.list', compact('users'));
    }

    public function create()
    {
        // Create empty arrays for required variables
        $Governorates = [];
        $Roles = \App\Modules\Auth\Models\Role::all();

        return view('base::dashboard.users.create', compact('Governorates', 'Roles'));
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            // رفع الصورة إن وجدت
            if ($request->hasFile('profile_image')) {
                $data['profile_image'] = $this->image($request->file('profile_image'), 'users');
            }

            // Hash password
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            // Remove role_id from data as it's not a column in users table
            $roleId = $data['role_id'] ?? null;
            unset($data['role_id']);

            $user = $this->userRepository->create($data);

            // Attach role if provided
            if ($roleId) {
                $user->addRole($roleId);
            }

            DB::commit();

            return redirect()->route('users.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong').': '.$e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $user = $this->userRepository->getById($id);

        return view('base::dashboard.users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = $this->userRepository->getById($id);
        $Governorates = [];
        $Roles = \App\Modules\Auth\Models\Role::all();

        return view('base::dashboard.users.edit', compact('user', 'Governorates', 'Roles'));
    }

    public function update(UserRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepository->getById($id);
            $data = $request->validated();

            // رفع الصورة الجديدة وحذف القديمة إن وجدت
            if ($request->hasFile('profile_image')) {
                $data['profile_image'] = $this->image($request->file('profile_image'), 'users', $user->profile_image);
            }

            // Handle password
            if (isset($data['password']) && $data['password'] != null) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            // Handle role
            $roleId = $data['role_id'] ?? null;
            unset($data['role_id']);

            $this->userRepository->update($id, $data);

            // Sync role if provided
            if ($roleId) {
                $user->roles()->sync([$roleId]);
            }

            DB::commit();

            return redirect()->route('users.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong').': '.$e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->userRepository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            } else {
                return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
            }
        } catch (\Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }

    public function showActiveUsers()
    {
        $users = $this->userRepository->getActiveUsers();

        // do something with $users
        // ...
        // ...
        // return ...
    }
}
