<?php

namespace App\Modules\Base\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getAll(array $columns = ['*'], array $relations = []): Collection;

    public function getActive(array $columns = ['*'], array $relations = []): Collection;

    public function getById(
        $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    public function get(
        string $byColumn,
        mixed $value,
        array $columns = ['*'],
        array $relations = [],
    ): array|Collection;

    public function getWithQuery(
        array|callable $query,
        array $relations = [],
        string $orderBy = 'ASC',
        array $columns = ['*'],
    ): array|Collection;

    public function first(
        string $byColumn,
        mixed $value,
        array $columns = ['*'],
        array $relations = [],
    ): Builder|Model|null;

    public function create(array $payload): ?Model;

    public function insert(array $payload): bool;

    public function getFirst(): ?Model;

    public function update(int|string $modelId, array $payload): bool;

    public function delete(int|string $modelId, array $filesFields = []): bool;

    public function forceDelete(int|string $modelId, array $filesFields = []): bool;

    public function paginate(int $perPage = 10, array $relations = [], string $orderBy = 'ASC', array $columns = ['*']);

    public function paginateWithQuery(
        array|callable $query,
        int $perPage = 10,
        array $relations = [],
        string $orderBy = 'ASC',
        array $columns = ['*'],
    );

    public function whereHasMorph(string $relation, string|array $class);

    public function query(): Builder;

    public function getTrashed(array $columns = ['*'], array $relations = []): Collection;

    public function restoreById(int|string $modelId): bool;
}
