<?php

namespace Database\Factories;

use App\Enums\PositionEnum;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $position = Arr::random(PositionEnum::cases());
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'department_id' => Department::factory(),
            'position' => $position->value,
        ];
    }
}
