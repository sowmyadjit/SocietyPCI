<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\LoanTypeModel;
use App\Http\Model\ModulesModel;
//use App\Http\Controllers\LoanController;

class LoanTypeController extends Controller
{
    var $loantyp;
	
	public function __construct()
    {
        $this->loantyp = new LoanTypeModel;
		$this->Modules= new ModulesModel;
	 
    }
    public function show_loantypedetail()
	{
		$Url="Loantype";
		$lt['module']=$this->Modules->GetAnyMid($Url);
		$lt['LoanType']=$this->loantyp->GetLoanTypes();
		return view('loantype',compact('lt'));
	}
     public function show_createloantype()
	{
		$Url="Loantype";
		$LoanCategory['module']=$this->Modules->GetAnyMid($Url);
		//$LoanCategory=$this->loantyp->GetLoanCategoryDropD();
		//return view('createloantype',['LoanCategory'=>$LoanCategory]);
		$LoanCategory['LoanCat']=$this->loantyp->GetLoanCategoryDropD();
		return view('createloantype',compact('LoanCategory'));
	}

    public function createloantype(Request $request)
	{
		$loantype['loantyp']=$request->input('loantyp');
		$loantype['intrest']=$request->input('intrest');
		$loantype['member']=$request->input('member');
		$loantype['customer']=$request->input('customer');
		$loantype['agent']=$request->input('agent');
		$loantype['staff']=$request->input('staff');
		$loantype['LoanCategory']=$request->input('LoanCategory');
		$loantype['due_intrest']=$request->input('due_intrest');
		$id=$this->loantyp->insert($loantype);
		return redirect('/');
	}

    
}
