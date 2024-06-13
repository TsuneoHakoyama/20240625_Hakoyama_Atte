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
        $attendances = Attendance::with(['breakTimes'])
            ->where('user_id', $user_id)
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
        }

        if (empty($formattedTimes)) {
            $formattedTimes = [];
        }

        return view('user-attendance', compact('attendances', 'formattedTimes'));
    }

    //総休憩時間の表示形式変換
    public function secondsToHms($totalSeconds)
    {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
