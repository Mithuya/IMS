<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            // ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web'], // created on AdminUserSeeder
            // ['id' => 2, 'name' => 'Student', 'guard_name' => 'web'], // will create on student Seeder
            // ['id' => 3, 'name' => 'Staff', 'guard_name' => 'web'] // will create on staff Seeder
        ];

        DB::table('roles')->insert($roles);
    }
}
