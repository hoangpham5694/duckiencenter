<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseMonthly extends Model
{
    protected $table = 'course_monthly';
    protected $fillable = [
        'id', 'month','course_id', 'fee_monthly', 'status'
    ];
    public function course(){
        return $this->belongsTo('Course');
    }
    public function student_course_monthly(){
        return $this->hasMany('StudentCourseMonthly');
    }
    public function attendance(){
        return $this->hasMany('Attendance');
    }

}
