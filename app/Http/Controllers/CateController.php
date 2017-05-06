<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\NewsCategories;
class CateController extends Controller
{
    public function getListCatesSimpleJson()
    {
    	$cate = NewsCategories::where('status','=','active')->orWhere('status','=','system')
    	->get();
    	return $cate;
    }
}
