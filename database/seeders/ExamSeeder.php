<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->delete();

        $exams = [
            ['id' => 1, 'course_id' => '1', 'title' => 'HTML-Unit Test', 'description' => 'Exam to check the basic attributes of HTML tags', 'duration' => '1', 'examiner_id'=> '1', 'invigilator_id'=> '1', 'date_time' => '2023-01-04 20:14:24'],
            ['id' => 2, 'course_id' => '2', 'title' => 'Laravel-Unit Test', 'description' => 'Check create crud application', 'duration' => '3', 'examiner_id'=> '1', 'invigilator_id'=> '1', 'date_time' => '2023-02-04 23:14:24'],
            ['id' => 3, 'course_id' => '1', 'title' => 'CSS-Unit Test', 'description' => 'Exam to check the basic attributes of CSS', 'duration' => '3', 'examiner_id'=> '1', 'invigilator_id'=> '1', 'date_time' => '2023-01-06 21:14:24'],
            ['id' => 4, 'course_id' => '3', 'title' => 'CCNA-Unit Test', 'description' => 'Exam to check network address', 'duration' => '3', 'examiner_id'=> '1', 'invigilator_id'=> '1', 'date_time' => '2023-01-08 21:14:24']
        ];

        DB::table('exams')->insert($exams);
    }
}
