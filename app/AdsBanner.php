<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsBanner extends Model
{
    protected $table = 'ads_banners';
    protected $fillable = [
         'id', 'name', 'url','created_at'
    ];
}
