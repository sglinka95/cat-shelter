<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private function newQuery(): Builder
    {
        return Employee::query()
            ->with('department')
            ->with('cats');
    }

    public function all(): array
    {
        return $this
            ->newQuery()
            ->get()
            ->all();
    }

    public function findById(string $id): ?Employee
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

    public function save(Employee $employee): void
    {
        $original = $this->findById($employee->getKey());

        if($original !== null) {
            $eloquent = Employee::createFromArray($employee->getAttributes());
            $eloquent->setAttribute($original->getKeyName(), $original->getKey());
            $original->update($eloquent->getAttributes());
        } else {
            $original = Employee::createFromArray($employee->getAttributes());
            $original->save();
        }
    }

    public function findByCriteria(?array $filters): array
    {
        return $this->newQuery()->where($filters)->get()->all();
    }
}
