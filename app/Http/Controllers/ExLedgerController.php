<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ExLedgerModel;
	use App\Http\Model\ModulesModel;
	
	class ExLedgerController extends Controller
	{
		var $ledger;
		public function __construct()
		{
			$this->ledger = new ExLedgerModel;
			$this->Modules= new ModulesModel;
			
		}
		
		public function show_led()
		{
			
			$Url="ExpenseHead";
			$data['module']=$this->Modules->GetAnyMid($Url);
			// $data['led']=$this->ledger->getled();
			//$data['ledk']=$this->ledger->getledka();
			$data['ledger']=$this->ledger->getleddata();
			// $data['kledger']=$this->ledger->getkadata();
			
			return view('Exledgerhead',compact('data'));
		}
		
		public function create_led(Request $request)
		{
			$ledger['lhname']=$request->input('lhname');
			$ledger['date']=$request->input('date');
			
			
			
			$id=$this->ledger->insert($ledger);
			
			return redirect('/');
			
		}
		
		public function create_ledger(Request $request)
		{
			$led['ledgerhead']=$request->input('ledgerhead');
			$led['subhead']=$request->input('subhead');
			
			
			$id=$this->ledger->insertion($led);
			
			return redirect('/');
			
		}
		
	}
