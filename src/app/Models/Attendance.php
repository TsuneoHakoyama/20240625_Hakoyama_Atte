<?php

namespace App\Models;

use App\Models\BreakTime;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'work_start',
        'work_end',
        'working_hours',
    ];

    protected $casts = [
        'work_start' => 'datetime',
        'work_end' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }
}
