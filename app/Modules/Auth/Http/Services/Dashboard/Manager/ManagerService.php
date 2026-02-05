<?php

namespace App\Modules\Auth\Http\Services\Dashboard\Manager;

use App\Modules\Auth\Http\Requests\Dashboard\Mangers\MangerRequest;
use App\Modules\Auth\Repository\ManagerRepositoryInterface;
use App\Modules\Auth\Repository\RoleRepositoryInterface;

use function App\Modules\Base\Http\Helpers\delete_model;

use App\Modules\Base\Http\Helpers\Http;

use function App\Modules\Base\Http\Helpers\responseFail;
use function App\Modules\Base\Http\Helpers\responseSuccess;
use function App\Modules\Base\Http\Helpers\store_model;
use function App\Modules\Base\Http\Helpers\update_model;

use App\Modules\Base\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class ManagerService
{
    use FileTrait;

    public function __construct(
        private ManagerRepositoryInterface $repository,
        private RoleRepositoryInterface $roleRepository,
    ) {}

    public function index()
    {
        $managers = $this->repository->paginate(10);

        return view('base::dashboard.managers.list', compact('managers'));
    }

    public function create($id)
    {

        $role = $this->roleRepository->getById($id);

        return view('base::dashboard.admins.create', compact('role'));
    }

    public function store(MangerRequest $request)
    {

        DB::beginTransaction();
        try {
            $data = $request->except('id', 'image', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'managers');
            }

            $roleId = $data['role_id'];
            unset($data['role_id']);

            $manger = store_model($this->repository, $data, true);

            if ($manger) {
                $manger->addRole($roleId);
            }
            DB::commit();

            return redirect()->route('managers.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $manager = $this->repository->getById($id);
        $role = $manager->roles->first();

        return view('base::dashboard.admins.edit', compact('role', 'manager'));
    }

    public function update(MangerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $manager = $this->repository->getById($id);
            $data = $request->except('id', 'image', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'managers', $manager->image);

            }

            if (! isset($data['password'])) {
                unset($data['password']);
            }

            $roleId = $data['role_id'];
            unset($data['role_id']);

            update_model($this->repository, $id, $data);
            
            // Update role if changed
            if ($roleId && $manager->roles->first()->id != $roleId) {
                $manager->syncRoles([$roleId]);
            }

            DB::commit();

            return redirect()->route('managers.index')
                ->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function toggle($id)
    {
        $manager = $this->repository->getById($id);
        $manager->is_active = ! $manager->is_active;
        $manager->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $manager->is_active]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $manger = $this->repository->getById($id);
            if ($manger->image) {
                $this->deleteFile($manger->image);
            }
            $deleted = delete_model($this->repository, $id);
            DB::commit();
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            } else {
                return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
            }
        } catch (\Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
}
