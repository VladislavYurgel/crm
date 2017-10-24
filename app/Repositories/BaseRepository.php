<?php

namespace App\Repositories;

use App\Http\Requests\Contracts\BaseApiRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Builder
     */
    protected $query;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $this->newQuery();

        return $this->query->get();
    }

    /**
     * @param BaseApiRequest $request
     * @return $this|Model
     */
    public function store(BaseApiRequest $request)
    {
        $this->newQuery();

        $item = $this->query->create($request->all());

        return $item;
    }

    /**
     * @param Model $model
     * @param BaseApiRequest $request
     * @return Model
     */
    public function update(Model $model, BaseApiRequest $request)
    {
        $model->update($request->all());

        return $model;
    }

    /**
     * @return $this
     */
    private function newQuery()
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

}