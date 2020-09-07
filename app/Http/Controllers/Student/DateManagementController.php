<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Year;


class DateManagementController extends Controller
{
    public function addYear(){
    	$currentYear = date('Y');
    	$check = Year::where('year','=',$currentYear)->get();
    	if (count($check)>0) {
    		return back()->with('error_message', "$currentYear already exist in database !!! Please try agin next year.");
    	}else{
    		$year = new Year();
    		$year->year = $currentYear;
    		$year->status = 1;
    		$year->save();

    		return back()->with('message', "Year $currentYear added in database successfully.");
    	}
    }
}
