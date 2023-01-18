<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create known student for Testing purpose with known email and password

        $user = User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'phno' => '0777773777',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'Student']);
        $user->assignRole([$role->id]);

        $student = new Student([
            'dob' => now(),
            'nic' => "123123123V",
            'gender' => "male",
            'address' => "Jafna",
        ]);
        $user->students()->save($student);


        // Create 10 random students
        User::factory()->times(10)->create()->each(function ($user) {
            $student = Student::factory()->make();
            $user->students()->save($student);
            $role = Role::select('id')->where('name', '=', 'Student')->first();
            $user->assignRole([$role->id]);

            $course_ids =  json_decode(Course::select('id')->pluck('id'),true);   // convert all plucked courses ids to array
            $course_ids = [$course_ids[array_rand($course_ids)],$course_ids[array_rand($course_ids)]];
            $student->courses()->attach($course_ids);
        });
    }
}
