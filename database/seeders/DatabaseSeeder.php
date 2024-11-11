<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 50 países
        Country::factory(50)->create();
        
        // Crear 25 maestros
        Teacher::factory(25)->create();
        
        // Crear 15 cursos
        Course::factory(15)->create();
        
        // Asignar un maestro aleatorio a cada curso
        Course::all()->each(function ($course) {
            $course->teachers()->attach(random_int(1, 25)); // Asignar un maestro aleatorio
        });
    }
}
