<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CreateAdminUserSeeder::class);
        // $this->call(RolesSeeder::class);                 will create on wasch role table created
        $this->call(PermissionTableSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ExamSeeder::class);

    }
}
