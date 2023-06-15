<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    private function newQuery(): Builder
    {
        return Department::query()
            ->with('cats')
            ->with('employees');
    }

    public function all(): array
    {
        return $this
            ->newQuery()
            ->get()
            ->all();
    }

    public function findById(string $id): ?Department
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

    public function save(Department $department): void
    {
        $original = $this->findById($department->getKey());

        if($original !== null) {
            $eloquent = Department::createFromArray($department->getAttributes());
            $eloquent->setAttribute($original->getKeyName(), $original->getKey());
            $original->update($eloquent->getAttributes());
        } else {
            $original = Department::createFromArray($department->getAttributes());
            $original->save();
        }
    }
}
