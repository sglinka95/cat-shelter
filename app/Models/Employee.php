<?php

namespace App\Models;

use App\Enums\PositionEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'department_id',
        'position',
    ];

    protected $casts = [
        'position' => PositionEnum::class,
    ];

    public static function createFromArray(array $employee): self
    {
        return new self($employee);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function cats(): HasMany
    {
        return $this->hasMany(Cat::class, 'employee_id', 'id');
    }
}
