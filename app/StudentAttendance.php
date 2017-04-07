<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendances';
    protected $fillable = [
        'id', 'attendance_id', 'student_id', 'status'
    ];
    public function attendance(){
        return $this->belongsTo('Attendance');
    }
    public function student(){
        return $this->belongsTo('Student');
    }
}
