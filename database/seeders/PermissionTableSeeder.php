<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',
           'course-list',
           'course-create',
           'course-edit',
           'course-delete',
           'subject-list',
           'subject-create',
           'subject-edit',
           'subject-delete',
           'student-list',
           'student-create',
           'student-edit',
           'student-delete',
           'staff-list',
           'staff-create',
           'staff-edit',
           'staff-delete'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
