<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AttendancesTableSeeder;
use Database\Seeders\BreakTimesTableSeeder;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(BreakTimesTableSeeder::class);
    }
}
