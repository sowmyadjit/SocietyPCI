<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\BankModel;
use App\Http\Model\ModulesModel;

class BankController extends Controller
{
    
    
	
	public function __construct()
    {
        $this->addbankmodel = new BankModel;
		$this->Modules= new ModulesModel;
	 
    }
	
	public function show_bank()
	{
		$Url="bank";
		$bank['module']=$this->Modules->GetAnyMid($Url);
		$bank['Banks']=$this->addbankmodel->GetBankData();
        return view('addbank',compact('bank'));
	}
	
	public function create_bank(Request $request)
	{
		$bank['bn']=$request->input('bn');
		$bank['branch']=$request->input('branch');
		$bank['ifsc']=$request->input('ifsc');
		$bank['acc']=$request->input('acc');
		$bank['ta']=$request->input('ta');
		$bank['branchlist']=$request->input('branchlist');
		$bank['branchid']=$request->input('branchid');
		
		$id=$this->addbankmodel->insert($bank);
		return redirect('/');
	
	}
	
	public function display_bank()
	{
		$Url="bank";
		$bank['module']=$this->Modules->GetAnyMid($Url);
		return view('createAddBank',compact('bank'));
	}

   
}
