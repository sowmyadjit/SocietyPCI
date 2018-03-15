<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\ledgermodel;

class ledgercontroller extends Controller
{
var $ledger;
public function __construct()
    {
        $this->ledger = new ledgermodel;
	 
    }
	
	
	public function show_led()
	{
	    $data['led']=$this->ledger->getled();
	    $data['ledk']=$this->ledger->getledka();
	    $data['ledger']=$this->ledger->getleddata();
	    $data['kledger']=$this->ledger->getkadata();
		
		return view('ledgerhead',compact('data'));
	}
	
	
	
	
	
	
	
	public function Show_ledgerDetails($id,$type=null){
		
		$ede['ledger']=$this->ledger->Getledger($id);
		 $ede['ledgers']=$this->ledger->getleddata();//added by manju
		if($type!=null)
			$ede['type']='edit';
		else
			$ede['type']='';
		return view('ledgerdetails',compact('ede'));
		
		}
	
	public function create_led(Request $request)
	{
		$ledger['lhname']=$request->input('lhname');
        $ledger['date']=$request->input('date');
        $ledger['kanlhname']=$request->input('kanlhname');
        $ledger['kdate']=$request->input('kdate');
		
       
        $id=$this->ledger->insert($ledger);
		//echo $id;
        //user::create($user);
        return redirect('/');
	
	}
	
	public function create_ledger(Request $request)
	{
		$led['ledgerhead']=$request->input('ledgerhead');
        $led['subhead']=$request->input('subhead');
        $led['sdate']=$request->input('sdate');
       $led['kledgerhead']=$request->input('kledgerhead');
        $led['kansubhead']=$request->input('kansubhead');
       // $led['ksdate']=$request->input('ksdate');
       
        $id=$this->ledger->insertion($led);
		//echo $id;
        //user::create($user);
        return redirect('/');
	
	}
	
	public function Updateledger(Request $request)
	{
		$ledger['Lid']=$request->input('Lid');
		$ledger['lhname']=$request->input('lhname');
        $ledger['date']=$request->input('date');
        $ledger['subhead']=$request->input('subhead');
        $ledger['kahead']=$request->input('kahead');
        $ledger['kasubhead']=$request->input('kasubhead');
        $ledger['kdate']=$request->input('kdate');
       
        $id=$this->ledger->updateledger($ledger);
		return redirect('/');
		}
		
	public function ledgerReport()
		{
			$ledger=$this->ledger->ledgerhead();
			return view('ledgerview',compact('ledger'));
			
		}
	public function LedSingleDetails($id)
	{
		//$ledger=$this->ledger->LedSingleDetails($id);
		
		//return view('ledgersingleview',compact('ledger'));
			
	}
    
}
