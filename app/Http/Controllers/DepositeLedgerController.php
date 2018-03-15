<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\DepositeLedgerModel;
	class DepositeLedgerController extends Controller
	{
		
		
		
		public function __construct()
		{
			$this->DepLedgerModel = new DepositeLedgerModel;
			
			
		}
		
		public function SbLedgerIndex()
		{
			$SbLM['module']=$this->DepLedgerModel->GetSBLedgerModule();
			
			return view('SbLedgerHome',compact('SbLM'));
		}
		
		public function PigmiLedgerIndex()
		{
			$PgLM['module']=$this->DepLedgerModel->GetPigmyLedgerModule();
			return view('PigmiLedgerHome',compact('PgLM'));
		}
		
		public function RdLedgerIndex()
		{
			$RdLM['module']=$this->DepLedgerModel->GetRDLedgerModule();
			return view('RdLedgerHome',compact('RdLM'));
		}
		
		public function FdLedgerIndex()
		{
			$FdLM['module']=$this->DepLedgerModel->GetFDLedgerModule();
			return view('FdLedgerHome',compact('FdLM'));
		}
		
		
		public function GetSbLedgerPerData(Request $request)
		{
			$SbLedgPar['SearchAccId']=$request->input('SearchAccId');
			$SbLedgPar['startdate']=$request->input('startdate');
			$SbLedgPar['enddate']=$request->input('enddate');
			
			$SbLedgerPerData['Kannada']=$request->input('Kannada');
			
			$SbLedgerPerData['CustomerDetails']=$this->DepLedgerModel->GetSbLedgerCustData($SbLedgPar);
			$SbLedgerPerData['TransactionDetails']=$this->DepLedgerModel->GetSbLedgerPerData($SbLedgPar);
			$SbLedgerPerData['module']=$this->DepLedgerModel->GetSBLedgerModule();
			return view('SbLedgerPerView',compact('SbLedgerPerData'));
		}
		
		public function GetRdLedgerPerData(Request $request)
		{
			$RdLedgPar['SearchAccId']=$request->input('SearchAccId');
			$RdLedgPar['startdate']=$request->input('startdate');
			$RdLedgPar['enddate']=$request->input('enddate');
			
			$RdLedgerPerData['Kannada']=$request->input('Kannada');
			
			$RdLedgerPerData['CustomerDetails']=$this->DepLedgerModel->GetRdLedgerCustData($RdLedgPar);
			$RdLedgerPerData['TransactionDetails']=$this->DepLedgerModel->GetRdLedgerPerData($RdLedgPar);
			$RdLedgerPerData['module']=$this->DepLedgerModel->GetRDLedgerModule();
			return view('RdLedgerPerView',compact('RdLedgerPerData'));
		}
		
		public function GetFdLedgerPerData(Request $request)
		{
			$FdLedgPar['SearchAccId']=$request->input('SearchAccId');
			$FdLedgPar['AllorNot']=$request->input('AllorNot');
			$FdLedgPar['FdStatus']=$request->input('FdStatus');
			$FdLedgPar['startdate']=$request->input('startdate');
			$FdLedgPar['enddate']=$request->input('enddate');
			$SearchCriteria=$FdLedgPar['AllorNot'];
			$FdStat=$FdLedgPar['FdStatus'];
			
			
			
			if($SearchCriteria=="ALL"||$SearchCriteria=="All"||$SearchCriteria=="all"||$FdStat!="")
			{
				
				$FdLedgerPerData['Kannada']=$request->input('Kannada');
				$FdLedgerPerData['CustomerDetails']=$this->DepLedgerModel->GetFdLedgerPerData($FdLedgPar);
				$FdLedgerPerData['module']=$this->DepLedgerModel->GetFDLedgerModule();
				return view('FdLedgerAllView',compact('FdLedgerPerData'));
				
			}
			else
			{
				$FdLedgerPerData['Kannada']=$request->input('Kannada');
				$FdLedgerPerData['CustomerDetails']=$this->DepLedgerModel->GetFdLedgerPerData($FdLedgPar);
				$FdLedgerPerData['module']=$this->DepLedgerModel->GetFDLedgerModule();
				return view('FdLedgerPerView',compact('FdLedgerPerData'));
			}
			
		}
		
		public function GetPigmiLedgerPerData(Request $request)
		{
			$PigmyLedgPar['SearchAccId']=$request->input('SearchAccId');
			$PigmyLedgPar['startdate']=$request->input('startdate');
			$PigmyLedgPar['enddate']=$request->input('enddate');
			
			$PigmiLedgerPerData['Kannada']=$request->input('Kannada');
			
			$PigmiLedgerPerData['CustomerDetails']=$this->DepLedgerModel->GetPigmiLedgerCustData($PigmyLedgPar);
			$PigmiLedgerPerData['TransactionDetails']=$this->DepLedgerModel->GetPigmiLedgerPerData($PigmyLedgPar);
			$PigmiLedgerPerData['module']=$this->DepLedgerModel->GetPigmyLedgerModule();
			return view('PigmiLedgerPerView',compact('PigmiLedgerPerData'));
		}
	}
