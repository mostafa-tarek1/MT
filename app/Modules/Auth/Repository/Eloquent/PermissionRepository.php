<?php

namespace App\Modules\Auth\Repository\Eloquent;

use App\Modules\Auth\Models\Permission;
use App\Modules\Auth\Repository\PermissionRepositoryInterface;
use App\Modules\Base\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends Repository implements PermissionRepositoryInterface
{
    protected Model $model;

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function permissionForm()
    {
        return $this->model::query()->oldest()->pluck('name');
    }
}
