<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'phno' => '0773773777',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'Staff']);
        $user->assignRole([$role->id]);

        $staff = new Staff([
            'dob' => now(),
            'nic' => '123123124V',
            'gender' => 'male',
            'address' => 'Jafna'

        ]);

        $user->staffs()->save($staff);
    }
}
