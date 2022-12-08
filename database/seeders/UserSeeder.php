<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            0 => array(
                'emp_id'=>'US4D001',
                'role_id'=>'1',
                'department_id'=>null,
                'name' => '4DGlobals',
                'phone_no' => null,
                'email' => 'admin@4dglobals.com',
                'password' => bcrypt('12345678'),
            )
        ));
    }
}
