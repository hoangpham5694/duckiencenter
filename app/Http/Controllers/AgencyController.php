<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Teacher;
use App\Agency;
use App\Student;
class AgencyController extends Controller
{
    public function getAgencyListSimpleJson()
    {
    	$agencies = Agency::select('id','name')
    	->where('status','=','active')
    	->get();
        return $agencies;
    }
}
