<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Model\PigmiModel;
use App\Http\Controllers\Controller;
use App\Http\Model\ModulesModel;

class PigmiController extends Controller
{
   

//   var pigmi;
	public function  __construct()
	{
        $this->pigmi = new PigmiModel;
		$this->Modules= new ModulesModel;
    }
	public function show_pigmi()
	{
		$Url="pigmetype";
		$p['module']=$this->Modules->GetAnyMid($Url);
		$p['pigmitype']=$this->pigmi->GetPigmyType();
        return view('pigme',compact('p'));
	}
	public function show_pigmitype()
	{
		$Url="pigmetype";
		$p['module']=$this->Modules->GetAnyMid($Url);
		return view('createpigmi',compact('p'));
	}
	public function create_pigmitype(Request $request)
	{
		$pigmityp['pt']=$request->input('pt');
		$pigmityp['mi']=$request->input('mi');
		$pigmityp['inter']=$request->input('inter');
		$pigmityp['mcomm']=$request->input('mcomm');
		$pigmityp['comm']=$request->input('comm');
	
		$id=$this->pigmi->insert($pigmityp);
		return redirect('/');
	
	}
	
	
}
