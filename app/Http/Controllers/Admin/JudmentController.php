<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluatedFragance;

class JudmentController extends Controller
{
    public function index(){
        return view('admin.judments.index');
    }

    public function judment($control=1,$carrier="a",$judges=8){

        return view('admin.judments.judment',[
            'control'=>$control,
            'carrier'=>$carrier,
            'judges'=>$judges
        ]);
    }
}
