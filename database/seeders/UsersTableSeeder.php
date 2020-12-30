<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@g.g',
                'password' => bcrypt(Str::random(16)),//Случайная строка заданой велечины
            ],
            [
              'name' => 'Автор',
              'email' => 'author1@g.g',
              'password' => bcrypt('123123'),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
