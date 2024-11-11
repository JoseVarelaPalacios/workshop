<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        $workshopNames = [
            'Introducción a la Programación',
            'Taller de Fotografía',
            'Curso de Cocina Italiana',
            'Taller de Escritura Creativa',
            'Curso de Marketing Digital',
            'Taller de Pintura para Principiantes',
            'Desarrollo Web Avanzado',
            'Taller de Mindfulness y Meditación',
            'Curso de Diseño Gráfico',
            'Taller de Robótica y Programación',
            'Curso de Jardinería Urbana'
        ];
        return [
           'name' => $this->faker->randomElement($workshopNames),
            'duration' => $this->faker->numberBetween(1, 12) . ' semanas',
            'description' => $this->faker->text(250),
            'mode' => $this->faker->randomElement(['Presencial', 'En línea']),
            'start_date' => $this->faker->date(),
            'finish_date' => $this->faker->date(),
            'cost' => $this->faker->randomFloat(2, 100, 1000),
            'image' => '/img/example.png'
        ];
    }
}
