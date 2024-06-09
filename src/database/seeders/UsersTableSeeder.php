<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '佐藤一郎',
            'email' => 'ichiro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤二郎',
            'email' => 'jiro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤三郎',
            'email' => 'saburo.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤四郎',
            'email' => 'shiro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤五郎',
            'email' => 'goro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤六郎',
            'email' => 'rokuro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤七郎',
            'email' => 'shichiro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤八郎',
            'email' => 'hachiro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤九郎',
            'email' => 'kuro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐藤十郎',
            'email' => 'juro.sato@example.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
    }
}
