<?php

namespace Database\Factories;

use App\Enums\BreedEnum;
use App\Enums\SexEnum;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sex = Arr::random(SexEnum::cases());
        $breed = Arr::random(BreedEnum::cases());
        return [
            'name' => $this->faker->name,
            'sex' => $sex->value,
            'birthdate' => $this->faker->date('Y-m-d'),
            'department_id' => Department::factory(),
            'employee_id' => Employee::factory(),
            'breed' => $breed->value,
            'description' => $this->faker->paragraph,
            'sterilized' => $this->faker->boolean
        ];
    }
}
