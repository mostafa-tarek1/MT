<?php

namespace App\Modules\Auth\Repository;

use App\Modules\Base\Repositories\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{
    public function permissionForm();
}
