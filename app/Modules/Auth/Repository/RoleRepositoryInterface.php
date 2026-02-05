<?php

namespace App\Modules\Auth\Repository;

use App\Modules\Base\Repositories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function getNames();

    public function isExisted(string $name);

    public function getByName(string $name);

    public function getInfo();
}
