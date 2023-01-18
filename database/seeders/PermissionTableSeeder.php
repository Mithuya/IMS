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
            'role-show',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-show',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'course-show',
            'subject-list',
            'subject-create',
            'subject-edit',
            'subject-delete',
            'subject-show',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'student-show',
            'staff-list',
            'staff-create',
            'staff-edit',
            'staff-delete',
            'staff-show',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-show',
            'exam-list',
            'exam-create',
            'exam-edit',
            'exam-delete',
            'exam-show'
         ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
