<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //ユーザー一覧の表示
    public function showUserList()
    {
        $users = User::orderBy('id', 'asc')->paginate(5);

        return view('user', compact('users'));
    }

    //ユーザーごとの勤怠情報の表示
    public function showUserAttendance(Request $request)
    {
        $user_id = $request->id;
        $user_name = User::find($user_id)->name;

        $attendances = Attendance::with(['breakTimes'])
            ->where('user_id', $user_id)
            ->paginate(5);

        $formatted_times = [];
        foreach ($attendances as $attendance) {
            $attendance_id = $attendance->id;
            $breaks = BreakTime::where('attendance_id', $attendance_id)->get();

            $total_seconds = 0;

            foreach ($breaks as $break) {
                $break_total = Carbon::parse($break->break_total);
                $total_seconds += $break_total->hour * 3600 + $break_total->minute * 60 + $break_total->second;
            }

            $formatted_time = $this->secondsToHms($total_seconds);
            $formatted_times[] = $formatted_time;
        }

        if (empty($formatted_times)) {
            $formatted_times = [];
        }

        return view('user-attendance', compact('user_name', 'attendances', 'formatted_times'));
    }

    //総休憩時間の表示形式変換
    public function secondsToHms($total_seconds)
    {
        $hours = floor($total_seconds / 3600);
        $minutes = floor(($total_seconds % 3600) / 60);
        $seconds = $total_seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
