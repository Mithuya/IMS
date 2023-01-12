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
            ['id' => 1, 'course_id' => '1', 'title' => 'HTML-Unit Test', 'description' => 'Exam to check the basic attributes of HTML tags', 'duration' => '1', 'examiner_id'=> '1', 'invigilator_id'=> '1', 'date_time' => '2023-01-04 23:14:24']
        ];

        DB::table('exams')->insert($exams);
    }
}
