<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->delete();

        $subjects = [
            ['id' => 1, 'title' => 'HTML', 'description' => 'html with css', 'duration' => '6', 'course_id'=> '1'],
            ['id' => 2, 'title' => 'CSS', 'description' => 'html continuation', 'duration' => '3', 'course_id'=>'1'],
            ['id' => 3, 'title' => 'Laravel', 'description' => 'Laravel', 'duration' => '3', 'course_id'=> '2'],
        ];

        DB::table('subjects')->insert($subjects);
    }
}
