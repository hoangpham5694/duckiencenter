<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Teacher;
use App\Agency;
use App\Course;
use Illuminate\Support\Facades\DB;
class AgencyController extends Controller
{
    public function getAgencyListSimpleJson()
    {
    	$agencies = Agency::select('id','name')
    	->where('status','=','active')
    	->get();
        return $agencies;
    }
    public function getAgencyList()
    {
    	return view('admin.agencies.list');
    }
    public function getAgencyListJson($max, $page)
    {
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
    	$agencies = Agency::leftJoin('courses','courses.agency_id','=','agencies.id')
    	->select('agencies.id','agencies.name',DB::raw('count(courses.id) as count_courses'))
    	->where('agencies.status','=','active')
    //	->where('courses.status','!=','delete')
    	->groupBy('agencies.id')
    	->limit($numberRecord)->offset($vitri)    	
    	->get();
    	return $agencies;
    }
    public function getAgencyTotalJson()
    {
    	return Agency::select('id')->where('status','=','active')->count();
    }
    public function getAgencyAdd($agencyname)
    {
    	$agency = new Agency();
    	$agency->name = $agencyname;
    	$agency->status = 'active';
    	$agency->save();
    	return "Thêm nhóm thành công";
    }
    public function getAgencyEdit($agencyid, $agencyname)
    {
    	$agency = Agency::findOrFail($agencyid);
    	$agency->name = $agencyname;
    	//$agency->status = 'active';
    	$agency->save();
    	return "Sửa nhóm thành công";
    }
    public function getAgencyDelete($id)
    {
    	$agency = Agency::findOrFail($id);
    	$agency->status = 'delete';
    	$agency->save();
    	return "Xóa nhóm thành công";
    }


}
