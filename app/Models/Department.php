<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
    ];

    public static function createFromArray(array $department): self
    {
        return new self($department);
    }

    public function cats(): HasMany
    {
        return $this->hasMany(Cat::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
