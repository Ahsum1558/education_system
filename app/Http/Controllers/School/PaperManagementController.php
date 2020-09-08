<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ClassName;
use App\Model\Paper;

class PaperManagementController extends Controller
{
    public function addPaperForm(){
    	$classes = ClassName::where('status','=',1)->get();
    	return view('admin.settings.paper.paper-add-form', [
    		'classes'=>$classes
    	]);
    }

    public function addPaper(Request $request){
    	if ($request->post()) {
    		$data = new Paper();
    		$data->exam_id = $request->exam_id;
    		$data->paper_name = $request->paper_name;
    		$data->short_name = $request->short_name;
    		$data->mark = $request->mark;
    		$data->weight = $request->weight;
    		$data->status = 1;
    		$data->save();

    		return back()->with('message', 'Paper Added Successfully.');
    	}
    }

    public function paperList(){
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.settings.paper.paper-list', [
            'classes'=>$classes
        ]);
    }

    public function examWisePaperList(Request $request){
        if ($request->ajax()) {
            $papers = Paper::where([
                'exam_id'=>$request->exam_id,
            ])->get();

            return view('admin.settings.paper.exam-wise-paper-list', [
            'papers'=>$papers
        ]);
        }
    }
}
