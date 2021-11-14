<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\EloquentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model |Builder|\Illuminate\Database\Eloquent\Builder
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function delete(int $id): int
    {
        return $this->model->where('id', $id)->delete();
    }

    public function paginate(Request $request): LengthAwarePaginator
    {

        $perPage     = $request->get('perPage') ?: null ;
        $columns     = $request->get('columns') ? : ['*'];
        $pageName    = $request->get('pageName') ?: 'page';
        $page        = $request->get('page') ?: null;

        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }
}
