<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\AccountModel;
use App\Http\Model\ReveresEntryModel;
use App\Http\Model\ModulesModel;


class ReveresEntryController extends Controller
{
	
	 var $acc;
	
	public function __construct()
    {
        $this->acc = new ReveresEntryModel;
		$this->Modules= new ModulesModel;
		
		
	 
    }
	
	public function reveresentry()
	{
		$Url="reveresentry";
			$b['module']=$this->Modules->GetAnyMid($Url);
			//$b['branch']=$this->branch->GetData();
		//return view('ReveresEntry');
		return view('ReveresEntry',compact('b'));
	}
	public function reversentryindex(Request $request)
	{
		$Url="reveresentry";
		
		$revers['trantyo']=$request->input('trantyo');
		$revers['startdate']=$request->input('startdate');
		$revers['accid']=$request->input('accid');
		
		$reversentry['data']=$this->acc->reversentryindex($revers);
		
		$reversentry['module']=$this->Modules->GetAnyMid($Url);
		return view('Revereshome',compact('reversentry'));
		
	}
	public function reversentrysb(Request $request)
	{
		$revers['tranid']=$request->input('tranid');
		$revers['perticulsb']=$request->input('perticulsb');
		
		$reversentry=$this->acc->reversentrysb($revers);
		return redirect('/');
		
	}
	
	public function reversentryindexpigmy(Request $request)
	{
		$Url="reveresentry";
		$revers['trantyo']=$request->input('trantyo');
		$revers['startdate']=$request->input('startdate');
		$revers['accid']=$request->input('accid');
		$reversentry['data']=$this->acc->reversentryindexpigmy($revers);
		$reversentry['module']=$this->Modules->GetAnyMid($Url);
		return view('ReversHomePigmy',compact('reversentry'));
		
	}
		public function reversentrypigmy(Request $request)
	{
		$revers['tranid']=$request->input('tranid');
		$revers['perticulpigmy']=$request->input('perticulpigmy');
		
		$reversentry=$this->acc->reversentrypigmy($revers);
		return redirect('/');
		
	}
	
	public function reversentryindexrd(Request $request)
	{
	
		$Url="reveresentry";
		$revers['trantyo']=$request->input('trantyo');
		$revers['startdate']=$request->input('startdate');
		$revers['accid']=$request->input('accid');
		$reversentry['data']=$this->acc->reversentryindexrd($revers);
		$reversentry['module']=$this->Modules->GetAnyMid($Url);
		return view('ReversHomeRd',compact('reversentry'));
		
	}
		public function reversentryrd(Request $request)
	{
		$Url="reveresentry";
		$revers['trantyo']=$request->input('trantyo');
		$revers['tranid']=$request->input('tranid');
		$revers['perrd']=$request->input('perrd');
		
		$reversentry=$this->acc->reversentryrd($revers);
		return redirect('/');
		
	}
	

	
}
