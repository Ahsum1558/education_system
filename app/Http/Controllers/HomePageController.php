<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HeaderFooter;
use DB;

class HomePageController extends Controller
{
    public function addHeaderFooterForm(){
        $headerFooter = DB::table('header_footers')->first();
        if (isset($headerFooter)) {
            return view('admin.home.manage-header-footer-form', [
            'headerFooter' => $headerFooter
        ]);
        }else{
            return view('admin.home.add-header-footer-form');
        }
    }

    public function headerFooterSave(Request $request){
    	// return $request->all();
        $this->headerFooterValidation($request);
    	
    	$data = new HeaderFooter();
    	$data->owner_name 		= $request->owner_name;
    	$data->owner_department = $request->owner_department;
    	$data->mobile 			= $request->mobile;
    	$data->address 			= $request->address;
    	$data->copyright 		= $request->copyright;
    	$data->status 			= $request->status;
    	$data->save();

    	return redirect('/home')->with('message', 'Header and Footer added successfully');
    }

    public function manageHeaderFooter($id){
        $headerFooter = HeaderFooter::find($id);
        return view('admin.home.manage-header-footer-form', [
            'headerFooter' => $headerFooter
        ]);
    }

    public function headerFooterUpdate(Request $request){
        $this->headerFooterValidation($request);

        $headerFooter = HeaderFooter::find($request->id);
        $headerFooter->owner_name       = $request->owner_name;
        $headerFooter->owner_department = $request->owner_department;
        $headerFooter->mobile           = $request->mobile;
        $headerFooter->address          = $request->address;
        $headerFooter->copyright        = $request->copyright;
        $headerFooter->save();

        return redirect('/home')->with('message', 'Header and Footer updated successfully');
    }

    protected function headerFooterValidation($request){
        $this->validate($request, [
            'owner_name'        => 'required',
            'owner_department'  => 'required',
            'mobile'            => 'required',
            'address'           => 'required',
            'copyright'         => 'required',
        ]);
    }
}
