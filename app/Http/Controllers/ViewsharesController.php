<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\ViewsharesModel;
use App\Http\Model\ModulesModel;

class ViewsharesController extends Controller
{
     public function __construct()
    {
       
		$this->viewshares= new ViewsharesModel;
		$this->Modules= new ModulesModel;
	}
	
	public function show_shares()
	{
		$Url="custauth";
		$m['module']=$this->Modules->GetAnyMid($Url);
		$m['data']=$this->viewshares->Getshares();
		return view('viewshares',compact('m'));
	}
	
	public function viewshares_data()
	{
		$Url="custauth";
		$m['module']=$this->Modules->GetAnyMid($Url);
		$m['data']=$this->viewshares->Getshares();
		return view('viewshares_data',compact('m'));
	}

	public function show_rejshares()
	{
		$Url="custauth";
		$m['module']=$this->Modules->GetAnyMid($Url);
		$m['data']=$this->viewshares->Getrejectshares();
		return view('viewrejectedshare',compact('m'));
	}
	public function accept_shares($mid,$purid)
	{
		$acceptsh=$this->viewshares->AcceptShares($mid,$purid);
		return redirect('/authmemb');
	}
	
	public function AcceptRejectedShare($mid,$purid)
	{
		$acceptsh=$this->viewshares->AcceptRejectedShare($mid,$purid);
		return redirect('/authmemb');
	}
	
	
	public function reject_Shares($mid,$purid)
	{
		$acceptrejsh=$this->viewshares->rejectShares($mid,$purid);
		return redirect('/authmemb');
	}
	
	public function RejectSuspendShare($purid)
	{
		$acceptrejsh=$this->viewshares->RejectSuspendShare($purid);
		return redirect('/authmemb');
	}
	
	public function show_suspendedshares()
	{
		$Url="custauth";
		$m['module']=$this->Modules->GetAnyMid($Url);
		$m['data']=$this->viewshares->Getsuapendedshares();
		return view('acceptsuspendedshares',compact('m'));
	}
/*	public function accept_suspendshares($purid)
	{



		$acceptsuspendsh=$this->viewshares->AcceptsuspendShares($purid);
	}*/
		public function accept_suspendshares($purid,$amt = 0)
	{
		//$param['purid']=$request->input('purid');
		//$param['amt']=$request->input('amt');
		$param['purid']=$purid;
		$param['amt']=$amt;
		
		$acceptsuspendsh=$this->viewshares->AcceptsuspendShares($param);
	}
	public function autoriseindividualshares()
	{
		$shares=$this->viewshares->autoriseindividualshares();
		return view('individualshare',compact('shares'));
	}
	public function acceptsuspendindividualshares($id,$amt,$cid)
	{
		$param['pid']=$id;
		$param['amt']=$amt;
		$param['cid']=$cid;
		$acceptsuspendindividualshares=$this->viewshares->acceptsuspendindividualshares($param);
	}
}

