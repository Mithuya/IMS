<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
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

        // Create known Staff for Testing purpose with known email and password

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



        // Create 10 random Staffs
        User::factory()->times(10)->create()->each(function ($user) {
            $user->staffs()->save(Staff::factory()->make());
            $role = Role::select('id')->where('name', '=', 'Staff')->first();
            $user->assignRole([$role->id]);
        });
    }
}
