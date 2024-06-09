<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_time = Carbon::now();
        $start_time = Carbon::now()->subHours(8)->subMinutes(30);
        $diff = $current_time->diff($start_time);

        $param = [
            'user_id' => 2,
            'work_start' => $start_time->copy()->subDay(1)->toDateTimeString(),
            'work_end' => $current_time->copy()->subDay(1)->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'user_id' => 1,
            'work_start' => $start_time->toDateTimeString(),
            'work_end' => $current_time->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'user_id' => 2,
            'work_start' => $start_time->toDateTimeString(),
            'work_end' => $current_time->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'user_id' => 3,
            'work_start' => $start_time->toDateTimeString(),
            'work_end' => $current_time->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'user_id' => 4,
            'work_start' => $start_time->toDateTimeString(),
            'work_end' => $current_time->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'user_id' => 5,
            'work_start' => $start_time->toDateTimeString(),
            'work_end' => $current_time->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
        $param = [
            'user_id' => 4,
            'work_start' => $start_time->copy()->addDay(1)->toDateTimeString(),
            'work_end' => $current_time->copy()->addDay(1)->toDateTimeString(),
            'working_hours' => $diff->format('%h:%i:%s')
        ];
        DB::table('attendances')->insert($param);
    }
}
