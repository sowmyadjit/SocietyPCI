<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\FdTypeModel;
use App\Http\Model\ModulesModel;

class FdTypeController extends Controller
{

	
	
	
	var $fdtyp;
	
	public function __construct()
    {
        $this->fdtyp = new FdTypeModel;
		$this->Modules= new ModulesModel;
    }
    public function show_fdtype()
	{
		$Url="fdtype";
		$fd['module']=$this->Modules->GetAnyMid($Url);
		$fd['FdTypes']=$this->fdtyp->GetFdTypes();
		return view('fdtype',compact('fd'));
	}
   
   
    public function show_createfdtype()
	{
		$Url="fdtype";
		$fd['module']=$this->Modules->GetAnyMid($Url);
		return view('createfdtype',compact('fd'));
	}
	
	
	public function createfdtype(Request $request)
	{
		$fdtyp['fdtype']=$request->input('fdtype');
		$fdtyp['fdyear']=$request->input('fdyear');
		$fdtyp['fddays']=$request->input('fddays');
		$fdtyp['interest']=$request->input('interest');
		$id=$this->fdtyp->insert($fdtyp);
		return redirect('/');
	
	}
	
	public function GetFdvalues(Request $request)
	{
		$fd['fdtypeid']=$request->input('fdtypeid');
		$get=$this->fdtyp->GetFdvalues($fd);
		//print_r($get);
		$id['fddayval']=$get->NumberOfDays;
		$id['fdintval']=$get->FdInterest;
		$id['NumberOfMonth']=$get->NumberOfMonth;
		$id['NumberOfYears']=$get->NumberOfYears;
		$id['BasedON']=$get->BasedON;
		return $id;
	}
   
}
