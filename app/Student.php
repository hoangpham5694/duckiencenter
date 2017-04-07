<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'id', 'name', 'username', 'dob', 'status', 'phone', 'address', 'parents_phone'
    ];
    public function payment(){
        return $this->hasMany('Payment');
    }
    public function cource_student(){
        return $this->hasMany('CourceStudent');
    }
    public function student_course_monthly(){
        return $this->hasMany('StudentCourseMonthly');
    }
    public function student_attendance(){
        return $this->hasMany('StudentAttendance');
    }
    public function exam_mark(){
        return $this->hasMany('ExamMark');
    }

}
