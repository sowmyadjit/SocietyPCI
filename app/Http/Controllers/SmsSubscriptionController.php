<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\SmsSubscriptionModel;
use App\Http\Model\ModulesModel;
//use App\Http\Model\OpenCloseModel;


class SmsSubscriptionController extends Controller
{
	public function __construct()
    {
        $this->s_model= new SmsSubscriptionModel;
		$this->Modules= new ModulesModel;
	}
	public function Subscription()
	{
			$Url="sms";
			$smssub['module']=$this->Modules->GetAnyMid($Url);
			
		return view('SmsSub',compact('smssub'));
	}
	public function entry(Request $request)
	{
		$sms['smsval']=$request->input('smsval');
		$sms['userid']=$request->input('userid');
		$id=$this->s_model->SmsSubscriptionData($sms);
		return redirect('/');
	}
	
	
}
