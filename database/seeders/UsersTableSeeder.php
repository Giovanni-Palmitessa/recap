<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
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
                'name'      => 'asd',
                'email'     => 'asd@asd.asd',
                'password'  => 'asd'
            ],
            [
                'name'      => 'qwe',
                'email'     => 'qwe@qwe.qwe',
                'password'  => 'qwe'
            ],
        ];

        foreach ($users as $user_data) {
            User::create($user_data);
        }
    }
}
