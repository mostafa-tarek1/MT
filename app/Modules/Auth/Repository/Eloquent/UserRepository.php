<?php

namespace App\Modules\Auth\Repository\Eloquent;

use App\Modules\Auth\Models\User;
use App\Modules\Auth\Repository\UserRepositoryInterface;
use App\Modules\Base\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected Model $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getActiveUsers()
    {
        return $this->model::query()->where('is_active', true);
    }

    public function findByPhone($phone)
    {
        return $this->model::where('phone', $phone)->first();
    }
}
