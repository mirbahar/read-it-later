<?php

namespace App\Repositories\Eloquent;

use App\Models\Pocket;
use App\Repositories\Contracts\PocketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class PocketRepository extends BaseRepository implements PocketRepositoryInterface
{
    public function __construct(Pocket $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $pocketId
     * @return Collection|null
     */
    public function detailsPocketById(int $pocketId): ?Collection
    {
        $pockets =  $this->model->findOrFail($pocketId)->with('contents')->get();
        return $pockets;
    }

    public function getPocketsWithContents(Request $request) : LengthAwarePaginator
    {

        $perPage     = $request->get('perPage') ?: null ;
        $columns     = $request->get('columns') ? : ['*'];
        $pageName    = $request->get('pageName') ?: 'page';
        $page        = $request->get('page') ?: null;

        return $this->model->with('contents')->select($columns)->paginate($perPage, $columns, $pageName, $page);
    }
}
