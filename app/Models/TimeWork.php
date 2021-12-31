<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeWork extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function check_schedule()
    {
        // $date = request('date');
        $current_date = date('Y-m-d', time());
        if($time_work = TimeWork::whereDate('date', $current_date)->first() == null)
        {
            $time_work = new TimeWork;
            $time_work->start_at = '07:00:00';
            $time_work->end_at = '15:30:00';
            $time_work->date = date('Y-m-d', time());

            $time_work->save();
        }
    }
}
