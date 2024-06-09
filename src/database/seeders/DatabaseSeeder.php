<?php

namespace Database\Seeders;

use Database\Seeders\AttendancesTableSeeder;
use Database\Seeders\BreakTimesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $this->call(UsersTableSeeder::class);
            $this->call(AttendancesTableSeeder::class);
            $this->call(BreakTimesTableSeeder::class);
        }
    }
}
