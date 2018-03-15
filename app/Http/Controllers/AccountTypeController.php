<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\AccountTypeModel;
use App\Http\Model\ModulesModel;

class AccountTypeController extends Controller
{
	var $acctyp;
	
	public function __construct()
    {
        $this->acctyp = new AccountTypeModel;
		$this->Modules= new ModulesModel;
	 
    }
    public function show_accounttype()
	{
		$a['AccType']=$this->acctyp->GetAccTypes();
		$Url="acctype";
		$a['module']=$this->Modules->GetAnyMid($Url);
		return view('acctype',compact('a'));
	}
   
   
    public function show_createacctype()
	{
		$Url="acctype";
		$a['module']=$this->Modules->GetAnyMid($Url);
		return view('createacctype',compact('a'));
	}
	
	
	public function createacctype(Request $request)
	{
		$acctype['acctyp']=$request->input('acctyp');
		$acctype['intrest']=$request->input('intrest');
		$id=$this->acctyp->insert($acctype);
		return redirect('/');
	
	}
   
}
