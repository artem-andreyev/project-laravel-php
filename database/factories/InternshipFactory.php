<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipFactory extends Factory
{
    protected $model = Internship::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'duration' => $this->faker->numberBetween(1, 12),
            'employer_id' => Employer::factory(),
        ];
    }
}
