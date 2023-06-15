<?php

namespace App\Repositories;

use App\Models\Cat;

interface CatRepositoryInterface
{
    public function findById(string $id): ?Cat;
    public function delete(string $id): void;
    public function save(Cat $cat): void;
    public function findByCriteria(array $filters): array;
}
