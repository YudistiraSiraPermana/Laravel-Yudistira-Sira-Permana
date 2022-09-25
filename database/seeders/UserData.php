<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Yudistira Sira Permana',
                'username' => 'yudis',
                'password' => bcrypt('12345'),
                'level' => 1,
                'email' => 'yudistirasirapermana@gmail.com'
            ],
            [
                'name' => 'User Mahasiswa',
                'username' => 'mhs',
                'password' => bcrypt('12345'),
                'level' => 2,
                'email' => 'usermahaiswa@gmail.com'
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
