<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreakTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_time = Carbon::now();
        $start_time = $current_time->copy()->subMinutes(30);
        $diff = $current_time->diff($start_time);

        $param = [
            'attendance_id' => 2,
            'break_start' => $current_time->copy()->subHours(4),
            'break_end' => $current_time->copy()->subHours(3)->subMinutes(30),
            'break_total' => $diff->format('%h:%i:%s')
        ];
        DB::table('break_times')->insert($param);
        $param = [
            'attendance_id' => 6,
            'break_start' => $current_time->copy()->subHours(3)->subMinutes(30),
            'break_end' => $current_time->copy()->subHours(2),
            'break_total' => $diff->format('%h:%i:%s')
        ];
        DB::table('break_times')->insert($param);
        $param = [
            'attendance_id' => 4,
            'break_start' => $current_time->copy()->subHours(2),
            'break_end' => $current_time->copy()->subHours(1)->subMinutes(30),
            'break_total' => $diff->format('%h:%i:%s')
        ];
        DB::table('break_times')->insert($param);
        $param = [
            'attendance_id' => 2,
            'break_start' => $current_time->copy()->subHours(2),
            'break_end' => $current_time->copy()->subHours(1)->subMinutes(30),
            'break_total' => $diff->format('%h:%i:%s')
        ];
        DB::table('break_times')->insert($param);
    }
}
