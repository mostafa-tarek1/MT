<?php

namespace App\Modules\Auth\Repository\Eloquent;

use App\Modules\Auth\Models\Manager;
use App\Modules\Auth\Repository\SettingsRepositoryInterface;
use App\Modules\Base\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;

class SettingsRepository extends Repository implements SettingsRepositoryInterface
{
    protected Model $model;

    public function __construct(Manager $model)
    {
        parent::__construct($model);
    }
}
