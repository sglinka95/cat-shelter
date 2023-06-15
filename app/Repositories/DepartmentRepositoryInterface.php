<?php

namespace App\Repositories;

use App\Models\Department;

interface DepartmentRepositoryInterface
{
    public function all(): array;
    public function findById(string $id): ?Department;
    public function delete(string $id): void;
    public function save(Department $department): void;
}
