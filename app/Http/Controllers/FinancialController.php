<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\FinancialModel;
//use App\Http\Model\ledgermodel;

class FinancialController extends Controller
{
var $financial;
var $fin;


public function __construct()
    {
        $this->financial= new FinancialModel;
       // $this->LedgerModel= new ledgermodel;
	 
    }
public function showf()
{
$data['fin']=$this->financial->getdata();
$data['led']=$this->financial->getldata();
$data['leds']=$this->financial->getlda();
$data['ledato']=$this->financial->getaccto();
$data['bank']=$this->financial->getbank();
$data['pato']=$this->financial->pgetaccto();
$data['pa']=$this->financial->pgetaccby();
$data['pba']=$this->financial->getpb();
$data['jpar']=$this->financial->jgetparticular();
$data['j']=$this->financial->jgetparto();
$data['group']=$this->financial->getgroup();




	   
		
		return view('createfinancial',compact('data'));
//return view('createfinancial');
}

public function create_finan(Request $request)
	{
		$financial['rtype']=$request->input('rtype');
		$financial['credit']=$request->input('credit');
		$financial['debit']=$request->input('debit');
		$financial['date']=$request->input('date');
		$financial['ahto']=$request->input('ahto');
		$financial['ac']=$request->input('ac');
		$financial['ad']=$request->input('ad');
		$financial['narration']=$request->input('narration');
		$financial['aby']=$request->input('aby');
		$financial['curbal']=$request->input('curbal');
		
		
        $id=$this->financial->insert($financial);
		//$id1=$this->financial->insertv($financial);
        return redirect('/');
	
	}
	public function create_fi(Request $request)
	{
		$fi['ptype']=$request->input('ptype');
		$fi['dr']=$request->input('dr');
		$fi['cred']=$request->input('cred');
		$fi['pdate']=$request->input('pdate');
		$fi['pabhy']=$request->input('pabhy');
		$fi['pbal']=$request->input('pbal');
		$fi['pacre']=$request->input('pacre');
		$fi['padeb']=$request->input('padeb');
		$fi['pnarr']=$request->input('pnarr');
		$fi['pahy']=$request->input('pahy');
		$fi['ppbal']=$request->input('ppbal');
		
		
        $id=$this->financial->insertp($fi);
		//$id1=$this->financial->insertv($financial);
        return redirect('/');
	
	}
	
	
	public function create_financial(Request $request)
	{
	
		$finan['rtype']=$request->input('rtype');
		$finan['cr']=$request->input('cr');
		$finan['deb']=$request->input('deb');
		$finan['dat']=$request->input('dat');
		$finan['aht']=$request->input('aht');
		$finan['acre']=$request->input('acre');
		$finan['adeb']=$request->input('adeb');
		$finan['narr']=$request->input('narr');
		$finan['abhy']=$request->input('abhy');
		$finan['bal']=$request->input('bal');
		$finan['ttr']=$request->input('ttr');
		$finan['cno']=$request->input('cno');
		$finan['cdate']=$request->input('cdate');
		$finan['bname']=$request->input('bname');
		
        $id=$this->financial->insertion($finan);
        return redirect('/');
	
	} 
	
	public function create_pay(Request $request)
	{
	
		$pay['ptype']=$request->input('ptype');
		$pay['pdr']=$request->input('pdr');
		$pay['pcred']=$request->input('pcred');
		$pay['pdat']=$request->input('pdat');
		$pay['pabh']=$request->input('pabh');
		$pay['pba']=$request->input('pba');
		$pay['pacred']=$request->input('pacred');
		$pay['padebit']=$request->input('padebit');
		$pay['pnarrat']=$request->input('pnarrat');
		$pay['pahyt']=$request->input('pahyt');
		$pay['pban']=$request->input('pban');
		$pay['pttr']=$request->input('pttr');
		$pay['pcno']=$request->input('pcno');
		$pay['pcdate']=$request->input('pcdate');
		$pay['pbname']=$request->input('pbname');
		
        $id=$this->financial->insertpr($pay);
        return redirect('/');
	
	}
	
	public function create_journal(Request $request)
	{
	
		$journal['jpdr']=$request->input('jpdr');
		$journal['jpcred']=$request->input('jpcred');
		$journal['jpdat']=$request->input('jpdat');
		$journal['jpabh']=$request->input('jpabh');
		$journal['jpba']=$request->input('jpba');
		$journal['jpacred']=$request->input('jpacred');
		$journal['jpadebit']=$request->input('jpadebit');
		$journal['jpnarrat']=$request->input('jpnarrat');
		$journal['jpahyt']=$request->input('jpahyt');
		$journal['jpban']=$request->input('jpban');
		
		
        $id=$this->financial->insertJ($journal);
        return redirect('/');
	
	}

	public function InhandCashForFin()
	{
		$Dat=$this->financial->InhandCashForFin();
		
		$id['InHandCash']=$Dat->InHandCash;
		//$Dat['cashId']=$id->cashId;
		//$Dat['Branch']=$id->Branch;
		//$Dat['BID']=$id->BID;
		
		return $id;
		
		
	}
	
	public function createdayposting()
	{
	return view('daypost');
	}
	public function createvocher()
	{
	return view('ledgervocher');
	
	}
	public function sharereport()
	{
	return view('sharereport');
	}
	

	
	
}
