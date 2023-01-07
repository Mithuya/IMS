<?php

namespace Database\Seeders;

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
        $user = User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'phno' => '0777773777',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'Student']);
        $user->assignRole([$role->id]);

        $student = new Student;
        $student->dob = now();
        $student->nic = "123123123V";
        $student->gender = "male";
        $student->address = "Jafna";
        $user->students()->save($student);
    }
}
