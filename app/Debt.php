<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $table = 'debts';
    protected $fillable = [
        'id', 'student_id', 'attendance_id','money','status','created_at'
    ];

}
