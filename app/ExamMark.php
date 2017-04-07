<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    protected $table = 'exam_marks';
    protected $fillable = [
        'id', 'mark' ,'exam_id', 'student_id','comment', 'status'
    ];
    public function exam(){
        return $this->belongsTo('Exam');
    }
    public function student(){
        return $this->belongsTo('Student');
    }
}
