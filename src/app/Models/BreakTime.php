<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'attendance_id',
        'break_start',
        'break_end',
        'break_total'
    ];

    public function attendance()
    {
        $this->belongsTo(Attendance::class);
    }
}
