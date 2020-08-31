<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Model\Slide;

class SliderController extends Controller
{
    public function addSlide(){
    	return view('admin.slider.add-slide-form');
    }

    public function uploadSlide(Request $request){
    	$this->validate($request, [
    		'slide_image' 		=> 'required',
    		'slide_title' 		=> 'required',
    		'slide_description'	=> 'required',
    		'status' 			=> 'required',
    	]);

    	$data = new Slide();
    	$data->slide_image 			= $this->createSlide($request);
    	$data->slide_title 			= $request->slide_title;
    	$data->slide_description 	= $request->slide_description;
    	$data->status 				= $request->status;
    	$data->save();

    	return back()->with('message', 'New slide added successfully');
    }

    protected function createSlide($request){
    	 $file = $request->file('slide_image');
         $imageName = $file->getClientOriginalName();
         $directory = 'public/admin/assets/slider/';
         $imageUrl = $directory.$imageName;
    
         Image::make($file)->resize(1400, 570)->save($imageUrl);

         return $imageUrl;
    }
}
