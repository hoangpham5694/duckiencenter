<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadComment extends Model
{
    protected $table = 'thread_comments';
    protected $fillable = [
        'id',
      
        'content',
        'teacher_id',
        'student_id',
        'user_id',
        'thread_id',
        'type',
        'status',
        'created_at',
        'updated_at'
        

    ];


    public function thread(){
        return $this->belongsTo('Thread');
    }


}
