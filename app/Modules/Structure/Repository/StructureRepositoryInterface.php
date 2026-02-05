<?php

namespace App\Modules\Structure\Repository;

use App\Modules\Base\Repositories\RepositoryInterface;

interface StructureRepositoryInterface extends RepositoryInterface
{
    public function structure($key);

    public function publish($key, $content);
}
