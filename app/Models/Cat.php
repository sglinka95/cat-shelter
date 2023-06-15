<?php

namespace App\Models;

use App\Enums\BreedEnum;
use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cat extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'sex',
        'birthdate',
        'department_id',
        'employee_id',
        'breed',
        'description',
        'sterilized'
    ];

    protected $casts = [
        'birthdate' => 'datetime',
        'breed' => BreedEnum::class,
        'sex' => SexEnum::class,
    ];

    public static function createFromArray(array $cat): self
    {
        return new self($cat);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
