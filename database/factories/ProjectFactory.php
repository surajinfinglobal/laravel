<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Web Development',
            'Mobile App',
            'UI/UX Design',
            'Laravel',
            'PHP'
        ];

        $technologies = [
            'Laravel, PHP, MySQL',
            'React, Node.js',
            'HTML, CSS, JavaScript',
            'Flutter, Firebase',
            'Bootstrap, jQuery'
        ];

        return [
            'user_id' => User::inRandomOrder()->first()->id,

            'title' => fake()->sentence(3),

            'category' => fake()->randomElement($categories),

            'image' => 'default.jpg',

            'github' => fake()->url(),

            'demo' => fake()->url(),

            'technology' => fake()->randomElement($technologies),

            'description' => fake()->paragraph(),

            'status' => fake()->randomElement([
                'Completed',
                'In Progress',
                'Pending'
            ]),
        ];
    }
}
