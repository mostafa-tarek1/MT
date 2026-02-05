<?php

namespace App\Modules\Auth\Repository;

use App\Modules\Base\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getActiveUsers();

    public function findByPhone($phone);
}
