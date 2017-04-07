<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourseMonthly extends Model
{
	protected $table = 'student_course_monthly';
    protected $fillable = [
        'id', 'month_id', 'student_id', 'status','is_fee', 'comment'
    ];
    public function course_monthly(){
        return $this->belongsTo('CourseMonthly');
    }
    public function student(){
        return $this->belongsTo('Student');
    }


}
