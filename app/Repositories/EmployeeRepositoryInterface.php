<?php

namespace App\Repositories;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function findById(string $id): ?Employee;
    public function delete(string $id): void;
    public function save(Employee $employee): void;
    public function findByCriteria(array $filters): array;
}
