<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   	protected $table = 'attendances';
    protected $fillable = [
        'id', 'month_id', 'study_date', 'status'
    ];
    public function course_monthly(){
        return $this->belongsTo('CourseMonthly');
    }
    public function student_attendance(){
        return $this->hasMany('StudentAttendace');
    }

}
