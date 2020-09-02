<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ClassName;

class BatchManagementController extends Controller
{
    public function addBatchForm(){
    	$classes = ClassName::all();
    	return view('admin.settings.batch.add-batch-form');
    }
}
