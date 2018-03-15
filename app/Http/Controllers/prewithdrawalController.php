<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\prewithdrawalModel;
	use App\Http\Model\OpenCloseModel;
	use App\Http\Model\ModulesModel;

class prewithdrawalController extends Controller
{
    
    
	 var $pigmtaccno;
	
	public function __construct()
    {
        $this->pigmtaccno = new prewithdrawalModel;
        $this->PreWithModel = new prewithdrawalModel;
			$this->OP_model=new OpenCloseModel;
			$this->Modules= new ModulesModel;
	 
    }
	public function prepigmiinterest()
		{
			$Url="branch";
			$interest['module']=$this->Modules->GetAnyMid($Url);
			$interest['open']=$this->OP_model->openstate();
			$interest['close']=$this->OP_model->openclosestate();
			if(empty($interest['open']))
			{
				$interest['open']=0;
			}
			else
			{
				$interest['open']=1;
			} 
			if(empty($interest['close']))
			{
				$interest['close']=0;
			}
			else
			{
				$interest['close']=1;
			}
			
			return view('PreWithdrawal',compact('interest'));
			
		}
		
	
	public function prepigmiwithdrawal(Request $request)
	{
		$pigmyacc['pigmyaccount']=$request->input('pigmyaccount');
		
		$id=$this->pigmtaccno->prepigmiwithdrawal($pigmyacc);
		return redirect('/');
	
	}
	public function prerdwithdrawal(Request $request)
	{
		$rdacc['rdaccount']=$request->input('rdaccount');
		$id=$this->pigmtaccno->prerdwithdrawal($rdacc);
		return redirect('/');
	
	}
	
	/*public function display_company()
	{
		return view('createcompany');
	}*/

   
}
