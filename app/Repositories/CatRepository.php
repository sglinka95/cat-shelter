<?php

namespace App\Repositories;

use App\Models\Cat;
use Illuminate\Database\Eloquent\Builder;

class CatRepository implements CatRepositoryInterface
{
    private function newQuery(): Builder
    {
        return Cat::query()
            ->with('department')
            ->with('guardian');
    }

    public function findById(string $id): ?Cat
    {
        return $this
            ->newQuery()
            ->where('id', $id)
            ->first();
    }

    public function delete(string $id): void
    {
        $this
            ->newQuery()
            ->where('id', $id)
            ->delete();
    }

    public function save(Cat $cat): void
    {
        $original = $this->findById($cat->getKey());

        if($original !== null) {
            $eloquent = Cat::createFromArray($cat->getAttributes());
            $eloquent->setAttribute($original->getKeyName(), $original->getKey());
            $original->update($eloquent->getAttributes());
        } else {
            $original = Cat::createFromArray($cat->getAttributes());
            $original->save();
        }
    }

    public function findByCriteria(?array $filters): array
    {
       return $this->newQuery()->where($filters)->get()->all();
    }
}
