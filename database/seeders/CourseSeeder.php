<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->delete();

        $courses = [
            ['id' => 1, 'title' => 'Web Dev', 'description' => 'html, cs', 'duration' => '6', 'start_date'=> now(), 'end_date' => now()],
            ['id' => 2, 'title' => 'Full Stack', 'description' => 'laravel, react', 'duration' => '3', 'start_date'=> now(), 'end_date' => now()],
            ['id' => 3, 'title' => 'NetWork', 'description' => 'ccna', 'duration' => '3', 'start_date'=> now(), 'end_date' => now()],
            ['id' => 4, 'title' => 'Programming', 'description' => 'java', 'duration' => '6', 'start_date'=> now(), 'end_date' => now()],
        ];

        DB::table('courses')->insert($courses);
    }
}
