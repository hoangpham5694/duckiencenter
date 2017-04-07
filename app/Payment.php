<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'id', 'month_id' ,'teacher_id', 'student_id','total_money','teacher_money','remain_money','paid_time', 'status'
    ];
    public function teacher(){
        return $this->belongsTo('Teacher');
    }
    public function student(){
        return $this->belongsTo('Student');
    }
    public function course_monthly(){
        return $this->belongsTo('CourseMonthly');
    }
}
