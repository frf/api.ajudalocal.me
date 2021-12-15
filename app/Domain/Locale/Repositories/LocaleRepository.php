<?php

namespace Domain\Locale\Repositories;

use Domain\Locale\Models\Locale;
use App\Repositories\Repository;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LocaleRepository extends Repository
{
    public function model()
    {
        return Locale::class;
    }

    public function oneAapproved()
    {
        $this->applyCriteria();
        return QueryBuilder::for($this->model)
            ->where('status', Locale::STATUS_APPROVED)
            ->first();
    }

    public function allAapproved()
    {
        $this->applyCriteria();
        return QueryBuilder::for($this->model)
            ->where('status', Locale::STATUS_APPROVED)
            ->paginate();
    }

    public function allPublished()
    {
        $this->applyCriteria();
        return QueryBuilder::for($this->model)
            ->where('status', Locale::STATUS_PUBLISHED)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->paginate();
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        return QueryBuilder::for($this->model)
            ->find($id, $columns);
    }

    public function create(array $data): Locale
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = "id")
    {
        return parent::update($data, $id, $attribute);
    }
}
