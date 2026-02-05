<?php

namespace App\Modules\Base\Repositories\Eloquent;

use App\Modules\Base\Http\Traits\FileTrait;
use App\Modules\Base\Repositories\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class Repository implements RepositoryInterface
{
    use FileTrait;

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get the model instance
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Get all records
     *
     * @param  array  $columns  Columns to select
     * @param  array  $relations  Relations to eager load
     */
    public function getAll(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Get all active records
     *
     * @param  array  $columns  Columns to select
     * @param  array  $relations  Relations to eager load
     */
    public function getActive(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->where('is_active', true)->get($columns);
    }

    /**
     * Get a single record by ID
     *
     * @param  int|string  $modelId  The model ID
     * @param  array  $columns  Columns to select
     * @param  array  $relations  Relations to eager load
     * @param  array  $appends  Attributes to append
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getById(
        $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    /**
     * Get records by column value
     *
     * @param  string  $byColumn  Column name to filter by
     * @param  mixed  $value  Value to match
     * @param  array  $columns  Columns to select
     * @param  array  $relations  Relations to eager load
     */
    public function get(
        string $byColumn,
        mixed $value,
        array $columns = ['*'],
        array $relations = [],
    ): array|Collection {
        return $this->model->newQuery()->select($columns)->with($relations)->where($byColumn, $value)->get();
    }

    /**
     * Get records with custom query
     *
     * @param  array|callable  $query  Query conditions
     * @param  array  $relations  Relations to eager load
     * @param  string  $orderBy  Sort order (ASC/DESC)
     * @param  array  $columns  Columns to select
     */
    public function getWithQuery(
        array|callable $query,
        array $relations = [],
        string $orderBy = 'ASC',
        array $columns = ['*'],
    ): array|Collection {
        return $this->model->newQuery()->select($columns)->where($query)->with($relations)->orderBy('id', $orderBy)->get();
    }

    /**
     * Get first record matching criteria
     *
     * @param  string  $byColumn  Column name to filter by
     * @param  mixed  $value  Value to match
     * @param  array  $columns  Columns to select
     * @param  array  $relations  Relations to eager load
     */
    public function first(
        string $byColumn,
        mixed $value,
        array $columns = ['*'],
        array $relations = [],
    ): Builder|Model|null {
        return $this->model->newQuery()->select($columns)->with($relations)->where($byColumn, $value)->first();
    }

    /**
     * Get the first record
     */
    public function getFirst(): ?Model
    {
        return $this->model->first();
    }

    /**
     * Create a new record
     *
     * @param  array  $payload  Data to create
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * Insert records (without events)
     *
     * @param  array  $payload  Data to insert
     */
    public function insert(array $payload): bool
    {
        $model = $this->model->newQuery()->insert($payload);

        return $model;
    }

    /**
     * Create multiple records
     *
     * @param  array  $payload  Array of records to create
     */
    public function createMany(array $payload): bool
    {
        try {
            foreach ($payload as $record) {
                $this->model->newQuery()->create($record);
            }

            return true;
        } catch (Exception $e) {
            Log::error('CATCH: '.$e);

            return false;
        }
    }

    /**
     * Update a record
     *
     * @param  int|string  $modelId  The model ID
     * @param  array  $payload  Data to update
     */
    public function update(int|string $modelId, array $payload): bool
    {
        $model = $this->getById($modelId);

        return $model->update($payload);
    }

    /**
     * Delete a record (soft delete if enabled)
     *
     * @param  int|string  $modelId  The model ID
     * @param  array  $filesFields  File fields to delete
     */
    public function delete(int|string $modelId, array $filesFields = []): bool
    {
        $model = $this->getById($modelId);
        foreach ($filesFields as $field) {
            if ($model->$field !== null) {
                $this->deleteFile($model->$field);
            }
        }

        return $model->delete();
    }

    /**
     * Permanently delete a record
     *
     * @param  int|string  $modelId  The model ID
     * @param  array  $filesFields  File fields to delete
     */
    public function forceDelete(int|string $modelId, array $filesFields = []): bool
    {
        $model = $this->getById($modelId);
        foreach ($filesFields as $field) {
            if ($model->$field !== null) {
                $this->deleteFile($model->$field);
            }
        }

        return $model->forceDelete();
    }

    /**
     * Paginate records
     *
     * @param  int  $perPage  Records per page
     * @param  array  $relations  Relations to eager load
     * @param  string  $orderBy  Sort order (ASC/DESC)
     * @param  array  $columns  Columns to select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10, array $relations = [], string $orderBy = 'ASC', array $columns = ['*'])
    {
        return $this->model->newQuery()->select($columns)->with($relations)->orderBy('id', $orderBy)->paginate($perPage);
    }

    /**
     * Paginate records with custom query
     *
     * @param  array|callable  $query  Query conditions
     * @param  int  $perPage  Records per page
     * @param  array  $relations  Relations to eager load
     * @param  string  $orderBy  Sort order (ASC/DESC)
     * @param  array  $columns  Columns to select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateWithQuery(
        array|callable $query,
        int $perPage = 10,
        array $relations = [],
        string $orderBy = 'ASC',
        array $columns = ['*'],
    ) {
        return $this->model->newQuery()->select($columns)->where($query)->with($relations)->orderBy('id', $orderBy)->paginate($perPage);
    }

    /**
     * Get a new query builder instance
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * Get records with polymorphic relation
     *
     * @param  string  $relation  Relation name
     * @param  string|array  $class  Model class(es)
     * @return Collection
     */
    public function whereHasMorph(string $relation, string|array $class)
    {
        return $this->model->newQuery()->whereHasMorph($relation, $class)->get();
    }

    /**
     * Get trashed (soft deleted) records
     *
     * @param  array  $columns  Columns to select
     * @param  array  $relations  Relations to eager load
     */
    public function getTrashed(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->onlyTrashed()->with($relations)->get($columns);
    }

    /**
     * Restore soft deleted record
     *
     * @param  int|string  $modelId  The model ID
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function restoreById(int|string $modelId): bool
    {
        $model = $this->model->withTrashed()->findOrFail($modelId);

        return $model->restore();
    }
}
