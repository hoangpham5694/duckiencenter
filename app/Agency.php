<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
 	protected $table = 'agencies';
    protected $fillable = [
        'address', 'id', 'name', 'status'
    ];
    public function cource(){
        return $this->hasMany('Cource');
    }

}
