<?php

namespace App\Http\Controllers;

use App\Models\BreakTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BreakTimeController extends Controller
{
    //休憩開始時刻の記録
    public function breakStartRecord(Request $request)
    {
        $attendance_id = $request->id;
        $start_time = Carbon::now();
        $data = [
            'attendance_id' => $attendance_id,
            'break_start' => $start_time
        ];
        BreakTime::create($data);
        return redirect('/')->with('message', '休憩開始時刻を記録しました');
    }

    //休憩終了時刻の記録
    public function breakEndRecord(Request $request)
    {
        $attendance_id = $request->id;
        $record = BreakTime::where('attendance_id', $attendance_id)->latest('break_start')->first();
        $start_time = new Carbon($record->break_start);
        $end_time = Carbon::now();
        $start_day = $start_time->format('Y-m-d');
        $end_day = $end_time->format('Y-m-d');

        if ($end_day !== $start_day) {
            $new_date = $end_time->copy()->startOfDay();
            $yesterday_diff = $new_date->diff($start_time);

            $yesterday_record = [
                'break_end' => $new_date,
                'break_total' => $yesterday_diff->format('%H:%I:%S')
            ];
            $record->update($yesterday_record);

            $today_diff = $end_time->diff($new_date);
            $today_record = [
                'break_start' => $new_date,
                'break_end' => $end_time,
                'break_total' => $today_diff->format('%H:%I:%S')
            ];
            BreakTime::create($today_record);
            return redirect('/')->with('message', '休憩終了時刻を記録しました');
        }

        $total_time = $end_time->diff($start_time)->format('%H:%I:%S');
        $data = [
            'break_end' => $end_time,
            'break_total' => $total_time
        ];
        $record->update($data);
        return redirect('/')->with('message', '休憩終了時刻を記録しました');
    }
}
