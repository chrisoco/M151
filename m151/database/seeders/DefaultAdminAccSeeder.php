<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultAdminAccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'     => 'admin',
                'prename'  => 'admin',
                'email'    => 'admin@admin.ch',
                'password' => Hash::make('123'),
            ]
        ];

        DB::table('users')->insert($users);
    }
}

