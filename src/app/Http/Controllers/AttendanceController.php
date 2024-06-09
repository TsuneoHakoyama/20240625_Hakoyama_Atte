<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Optional;

class AttendanceController extends Controller
{
    //打刻ページの表示
    public function show()
    {
        $user_id = Auth::user()->id;
        $record = Attendance::with('breakTimes')->latest('work_start')->first();

        $work_start = optional($record)->work_start;
        $work_end = optional($record)->work_end;

        foreach ($record->breakTimes as $breakTime) {
            $break_start = $breakTime->break_start;
            $break_end = $breakTime->break_end;
        }

        $work_status = NULL;
        if ((isset($work_start)) && (empty($work_end))) {
            $work_status = 'on_duty';
        }

        $break_status = NULL;
        if ($work_status === 'on_duty') {
            if (isset($break_end)) {
                $break_status = 'ready_to_take_a_break';
            } elseif ((isset($break_start)) && (empty($break_end))) {
                $break_status = 'on_my_break';
            }
        }
        return view('stamp', compact('record', 'work_status', 'break_status'));
    }

    //勤務開始の記録
    public function workStartRecord()
    {
        $user_id = Auth::user()->id;
        $start_time = Carbon::now();
        $data = [
            'user_id' => $user_id,
            'work_start' => $start_time
        ];
        Attendance::create($data);
        return redirect('/')->with('message', '出勤時刻を記録しました');
    }

    //勤務終了の記録
    public function workEndRecord()
    {
        $user_id = Auth::user()->id;
        $record = Attendance::where('user_id', $user_id)->latest('work_start')->first();
        $end_time = Carbon::now();
        $start_time = new Carbon($record->work_start);
        $start_day = $start_time->format('Y-m-d');
        $end_day = $end_time->format('Y-m-d');

        if ($start_day !== $end_day) {
            $new_date = $end_time->copy()->startOfDay();
            $yesterday_diff = $new_date->diff($start_time);

            $yesterday_record = [
                'work_end' => $new_date,
                'working_hours' => $yesterday_diff->format('%H:%i:%s')
            ];
            $record->update($yesterday_record);

            $today_diff = $end_time->diff($new_date);
            $today_record = [
                'user_id' => $user_id,
                'work_start' => $new_date,
                'work_end' => $end_time,
                'working_hours' => $today_diff->format('%H:%i:%s')
            ];
            Attendance::create($today_record);
            return redirect('/')->with('message', '退勤時刻を記録しました');
        }

        $working_hours = $end_time->diff($start_time);
        $data = [
            'work_end' => $end_time,
            'working_hours' => $working_hours->format('%H:%i:%s')
        ];
        $record->update($data);


        return redirect('/')->with('message', '退勤時刻を記録しました');
    }



    //日付一覧ページの表示
    public function showTable()
    {
        $date = Carbon::today()->format('Y-m-d');
        $attendances = Attendance::with(['user', 'breakTimes'])
        ->whereDate('work_start', $date)
            ->paginate(5);

        $formattedTimes = [];
        foreach ($attendances as $attendance) {
            $attendance_id = $attendance->id;
            $breaks = BreakTime::where('attendance_id', $attendance_id)->whereDate('break_start', $date)->get();

            $totalSeconds = 0;

            foreach ($breaks as $break) {
                $break_total = Carbon::parse($break->break_total);
                $totalSeconds += $break_total->hour * 3600 + $break_total->minute * 60 + $break_total->second;
            }

            $formattedTime = $this->secondsToHms($totalSeconds);
            $formattedTimes[] = $formattedTime;
        }

        if (empty($formattedTimes)) {
            $formattedTimes = [];
        }

        return view('attendance', compact('date', 'attendances', 'formattedTimes'));
    }

    //前日データの表示
    public function showTablePreviousDay(Request $request)
    {
        $currentDay = $request->date;
        $previousDay = new DateTime($currentDay . '-1 day');
        $date = $previousDay->format('Y-m-d'); //日時取得
        $attendances = Attendance::with(['user', 'breakTimes'])
            ->whereDate('work_start', $date)
            ->paginate(5);

        $formattedTimes = [];
        foreach ($attendances as $attendance) {
            $attendance_id = $attendance->id;
            $breaks = BreakTime::where('attendance_id', $attendance_id)->get();

            $totalSeconds = 0;

            foreach ($breaks as $break) {
                $break_total = Carbon::parse($break->break_total);
                $totalSeconds += $break_total->hour * 3600 + $break_total->minute * 60 + $break_total->second;
            }

            $formattedTime = $this->secondsToHms($totalSeconds);
            $formattedTimes[] = $formattedTime;
            //dd($formattedTimes);
        }

        if (empty($formattedTimes)) {
            $formattedTimes = [];
        }

        return view('attendance', compact('date', 'attendances', 'formattedTimes'));
    }

    public function secondsToHms($totalSeconds)
    {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    //翌日データの表示
    public function showTableNextDay(Request $request)
    {
        $currentDay = $request->date;
        $nextDay = new DateTime($currentDay . '+1 day');
        $date = $nextDay->format('Y-m-d');
        $attendances = Attendance::with(['user', 'breakTimes'])
            ->whereDate('work_start', $date)
            ->paginate(5);

        $formattedTimes = [];
        foreach ($attendances as $attendance) {
            $attendance_id = $attendance->id;
            $breaks = BreakTime::where('attendance_id', $attendance_id)->get();

            $totalSeconds = 0;

            foreach ($breaks as $break) {
                $break_total = Carbon::parse($break->break_total);
                $totalSeconds += $break_total->hour * 3600 + $break_total->minute * 60 + $break_total->second;
            }

            $formattedTime = $this->secondsToHms($totalSeconds);
            $formattedTimes[] = $formattedTime;
            //dd($formattedTimes);
        }

        if (empty($formattedTimes)) {
            $formattedTimes = [];
        }

        return view('attendance', compact('date', 'attendances', 'formattedTimes'));
    }
}
