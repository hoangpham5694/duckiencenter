<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryMoney extends Model
{
    protected $table = 'history_moneys';
    protected $fillable = [
        'id', 'name','attendance_id','student_id','money',
        'amount','status'
    ];
}
