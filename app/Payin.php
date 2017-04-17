<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payin extends Model
{
    protected $table = 'payin';
    protected $fillable = [
		'student_id',
		'user_id',
		'real_money',
		'virtual_money',
		'amount',
		'is_paid'
    ];
    public function teacher(){
        return $this->belongsTo('Teacher');
    }
     public function user(){
        return $this->belongsTo('User');
    }
}
