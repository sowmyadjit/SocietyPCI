<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\AccountModel;
	use App\Http\Model\PigmiAllocationModel;
	use App\Http\Model\PigmiTransactionModel;
	use App\Http\Model\LoanModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\OpenCloseModel;
use App\Http\Model\TransactionModel;
	use App\Http\Model\ledgermodel;
	use App\Http\Model\DepositModel;
	
	
	class TransactionController extends Controller
	{
		
		public function __construct()
		{
			$this->acc = new AccountModel;
			$this->pigmiallocation_model=new PigmiAllocationModel;
			$this->pigmi_transactionmodel=new PigmiTransactionModel;
			$this->loan_model=new LoanModel;
			$this->OP_model=new OpenCloseModel;
			$this->TranModel=new TransactionModel;
			$this->ledger = new ledgerModel;
			$this->Modules= new ModulesModel;
			$this->dep_mdl= new DepositModel;
		}
		public function index()
		{
			//$data['pigmiallocation']='';
			// return view('transation',$data);
			


			$id['open']=$this->OP_model->openstate();
			$id['close']=$this->OP_model->openclosestate();
			if(empty($id['open']))
			{
				$state['open']=0;
			}
			else
			{
				$state['open']=1;
			} 
			if(empty($id['close']))
			{
				$state['close']=0;
			}
			else
			{
				$state['close']=1;
			}
			$state['ledger']=$this->ledger->GetSubHeads();
			return view('transation',compact('state'));
		}
		public function ShowTeller()
		{
			/*$data['pigmiallocation']='';
			return view('transation',$data);*/
			
			$Url="Transaction";
			$Teller['module']=$this->Modules->GetAnyMid($Url);
			
			$id['open']=$this->OP_model->openstate();
			$id['close']=$this->OP_model->openclosestate();
			if(empty($id['open']))
			{
				$Teller['open']=0;
			}
			else
			{
				$Teller['open']=1;
			} 
			if(empty($id['close']))
			{
				$Teller['close']=0;
			}
			else
			{
				$Teller['close']=1;
			}
			$Teller['ledger']=$this->ledger->GetSubHeads();
			
			return view('transation',compact('Teller'));
		}
		
		public function ShowDepTeller()
		{
			
			$Url="DepTransaction";
			$Teller['module']=$this->Modules->GetAnyMid($Url);
			$id['open']=$this->OP_model->openstate();
			$id['close']=$this->OP_model->openclosestate();
			if(empty($id['open']))
			{
				$Teller['open']=0;
			}
			else
			{
				$Teller['open']=1;
			} 
			if(empty($id['close']))
			{
				$Teller['close']=0;
			}
			else
			{
				$Teller['close']=1;
			}
			$Teller['ledger']=$this->ledger->GetSubHeads();
			return view('transation',compact('Teller'));
		}
		
		public function ShowAccTeller()
		{
			
			$Url="AccTransaction";
			$Teller['module']=$this->Modules->GetAnyMid($Url);
			$id['open']=$this->OP_model->openstate();
			$id['close']=$this->OP_model->openclosestate();
			if(empty($id['open']))
			{
				$Teller['open']=0;
			}
			else
			{
				$Teller['open']=1;
			} 
			if(empty($id['close']))
			{
				$Teller['close']=0;
			}
			else
			{
				$Teller['close']=1;
			}
			$Teller['ledger']=$this->ledger->GetSubHeads();
			//print_r($Teller);
			return view('transation',compact('Teller'));
		}
		
		public function retrive_val(Request $request)
		{
			$acc['acttype']=$request->input('acttype');
			$get=$this->acc->getvalue($acc);
			/*********/
			$fn_data["acc_id"] =  $request->input('acttype');
			$sb_balance = $this->acc->get_account_balance($fn_data);
			/*********/
			
			//print_r($get);
			$id['crbal'] = $sb_balance;//$get->Total_Amount;
			$id['actype']=$get->Acc_Type;
			$id['fname']=$get->FirstName;
			$id['mname']=$get->MiddleName;
			$id['lname']=$get->LastName;
			$id['acid']=$get->AccTid;
			$id['uid']=$get->Uid;
			return $id;
		}
		
		/**
			* Show the form for creating a new resource.
			*
			* @return \Illuminate\Http\Response
		*/
		public function create_transaction(Request $request)
		{
			$trans['actid']=$request->input('actid');
			$trans['actid_adj']=$request->input('actid_adj');
			$trans['sb_adj_current_bal']=$request->input('sb_adj_current_bal');
			$trans['name']=$request->input('name');
			$trans['acctype']=$request->input('acctype');
			$trans['par']=$request->input('par');
			$trans['trantyp']=$request->input('trantyp');
			$trans['sb_amount']=$request->input('sb_amount');
			$trans['cb']=$request->input('cb');
			$trans['tb']=$request->input('tb');
			$trans['dte']=$request->input('dte');
			$trans['tme']=$request->input('tme');
			
			$trans['paymode']=$request->input('paymode');
			$trans['chequeno']=$request->input('chequeno');
			$trans['chdate']=$request->input('chdate');
			$trans['bankname']=$request->input('bankname');
			$trans['bankbranch']=$request->input('bankbranch');
			$trans['ifsccode']=$request->input('ifsccode');
			$trans['uncleared']=$request->input('uncleared');
			$trans['unclearedval']=$request->input('unclearedval');
			$trans['branchid']=$request->input('branchid');
			$trans['lid']=$request->input('lid');
			$trans['bankid']=$request->input('bankid');
			$trans['creditbank']=$request->input('creditbank');
			
			$trans['LedgerId']=$request->input('LedgerId');
			$id=$this->acc->insert_tran($trans);
			return $id;
			// return redirect('/');
			
		}
		public function getaccnum(Request $request)
		{
			$data ='';
			$acct['agentID']=$request->input('agentID');
			$pigmiallocation=$this->pigmiallocation_model->getAccountnum($acct);
			//$accno['actno']=$get->PigmiAllocID;
			//return view('transation',['pigmiallocation'=>$pigmiallocation]);
			$data.='<select class="form-control"  id="acctno" name="acctno" onChange="getacnum();">';
			$data.='<option>--Select Account Number--</option>';
			foreach( $pigmiallocation as $key){
				$data.='<option value='.$key->PigmiAllocID.' >'.$key->PigmiAcc_No.'  -  '.$key->old_pigmiaccno.'</option>';
				
				
			}
			$data.='</select> ';
			echo $data;
			
		}
		
	
		public function getAcctholder(Request $request)
		{
			$acchname['accname']=$request->input('accname');
			$get=$this->pigmiallocation_model->getAcctholder($acchname);
			$id['fstname']=$get->FirstName;
			$id['pgmtype']=$get->Pigmi_Type;
			$id['opbal']=$this->dep_mdl->get_pigmy_account_balance(["allocation_id"=>$get->PigmiAllocID]);//$get->Total_Amount;
			$id['ptid']=$get->PigmiTypeid;
			return $id;
		}
		
		
		public function createpigmitrans(Request $request)
		{
			$pgtrans['ptdte']=$request->input('ptdte');
			$pgtrans['pttme']=$request->input('pttme');
			$pgtrans['agtid']=$request->input('agtid');
			$pgtrans['acctno']=$request->input('acctno');
			//$pgtrans['pgtype']=$request->input('pgtype');
			$pgtrans['pgbalamt']=$request->input('pgbalamt');
			$pgtrans['trtype']=$request->input('trtype');
			$pgtrans['pgamount']=$request->input('pgamount');
			$pgtrans['ptpar']=$request->input('ptpar');
			$pgtrans['curbal']=$request->input('curbal');
			$pgtrans['pgtid']=$request->input('pgtid');
			$pgtrans['pgmbranch']=$request->input('pgmbranch');
			$pgtrans['pgmpaymode']=$request->input('pgmpaymode');
			$pgtrans['pgmchequeno']=$request->input('pgmchequeno');
			$pgtrans['pgmchdate']=$request->input('pgmchdate');
			$pgtrans['pgmbankname']=$request->input('pgmbankname');
			$pgtrans['pgmbankbranch']=$request->input('pgmbankbranch');
			$pgtrans['pgmifsccode']=$request->input('pgmifsccode');
			$pgtrans['pgmuncleared']=$request->input('pgmuncleared');
			$pgtrans['pgmunclearedval']=$request->input('pgmunclearedval');
			
			$id=$this->pigmi_transactionmodel->insert_pgtran($pgtrans);
			if(isset($id["error"])) {
				return $id["error"];
			}
			return "success";
		}

			public function AgentPigmiTransaction(Request $request)
		{
			$pgtrans['allocid']=$request->input('allocid');
			$pgtrans['PigmyCollectDate']=$request->input('PigmyCollectDate');
			$pgtrans['PigAmt']=$request->input('PigAmt');
			//send the ledger id dd from view and insert it in transaction HERE
	//$data = $request->json->all();
			$name1 = $request->allocid;
			$name2 = $request->PigmyCollectDate;
			$name3 = $request->PigAmt;
			foreach($pgtrans['allocid'] as $key=>$aloc)
			{
				$allocid=$aloc;
				$date=$pgtrans['PigmyCollectDate'][$key];
				$amt=$pgtrans['PigAmt'][$key];
				//echo '<br/>'.$aid.'->'.$dt.'->'.$amt;
				//insert(aid,dt,amt);
				if($amt!="0")
				{
					if($amt!="")
						$this->pigmi_transactionmodel->AgentPigmiTransaction($allocid,$date,$amt);	
				}
				
				
			}
			return redirect('/home');
		}

		
		public function retrive_rdval(Request $request)
		{
		$acc['acttype']=$request->input('acttype');
		$get=$this->acc->getrdvalue($acc);
		//print_r($get);
		$id['rdcrbal']=$get->Total_Amount;
		$id['rdactype']=$get->Acc_Type;
		$id['rdfname']=$get->FirstName;
		$id['rdacid']=$get->AccTid;
		$id['rdduration']=$get->Duration;
		return $id;
	}
	
	public function createrdtrans(Request $request)
	{
		$rdtrans['rddte']=$request->input('rddte');
		$rdtrans['rdtme']=$request->input('rdtme');
		$rdtrans['rdaccount']=$request->input('rdaccount');
		$rdtrans['rdname']=$request->input('rdname');
		$rdtrans['rdacctype']=$request->input('rdacctype');
		$rdtrans['rdduration']=$request->input('rdduration');
		$rdtrans['rdtrantyp']=$request->input('rdtrantyp');
		$rdtrans['rdpar']=$request->input('rdpar');
		$rdtrans['rdamount']=$request->input('rdamount');
		$rdtrans['rdcb']=$request->input('rdcb');
		$rdtrans['rdtb']=$request->input('rdtb');
		$rdtrans['rdactid']=$request->input('rdactid');
	
		$rdtrans['rdbranch']=$request->input('rdbranch');
		$rdtrans['rdpaymode']=$request->input('rdpaymode');
		$rdtrans['rdchequeno']=$request->input('rdchequeno');
		$rdtrans['rdchdate']=$request->input('rdchdate');
		$rdtrans['rdbankname']=$request->input('rdbankname');
		$rdtrans['rdbankbranch']=$request->input('rdbankbranch');
		$rdtrans['rdifsccode']=$request->input('rdifsccode');
		$rdtrans['rduncleared']=$request->input('rduncleared');
		$rdtrans['rdunclearedval']=$request->input('rdunclearedval');
		$rdtrans['accounts']=$request->input('accounts');
		$rdtrans['AccId']=$request->input('AccId');
		
			$rdtrans['LedgerId']=$request->input('LedgerId');
			$id=$this->acc->insert_rdtran($rdtrans);
			return $id;
			// return redirect('/');
	}
	
	
	//Create Loan Transaction
	public function Create_LoanTrans(Request $request)
	{
		$lntrans['lndte']=$request->input('lndte');
		$lntrans['lntme']=$request->input('lntme');
		//$lntrans['lntme']=$request->input('lntme');
		//$lntrans['lnbranchnme']=$request->input('lnbranchnme');
		//$lntrans['lnaccount']=$request->input('lnaccount');
		//$lntrans['lnname']=$request->input('lnname');
		//$lntrans['lnat']=$request->input('lnat');
		//$lntrans['lnduration']=$request->input('lnduration');
		$lntrans['lnamt']=$request->input('lnamt');
		$lntrans['lnremamt']=$request->input('lnremamt');
		$lntrans['lnpaymode']=$request->input('lnpaymode');
		$lntrans['lnchequeno']=$request->input('lnchequeno');
		$lntrans['lnchdate']=$request->input('lnchdate');
		$lntrans['lnbankname']=$request->input('lnbankname');
		//$lntrans['lnbankname']=$request->input('lnbankname');
		$lntrans['lnbankbranch']=$request->input('lnbankbranch');
		$lntrans['lnifsccode']=$request->input('lnifsccode');
		$lntrans['amtavail']=$request->input('amtavail');
		$lntrans['payamt']=$request->input('payamt');
		$lntrans['lnuncleared']=$request->input('lnuncleared');
		$lntrans['lnunclearedval']=$request->input('lnunclearedval');
		$lntrans['lnpar']=$request->input('lnpar');
		$lntrans['lnremtot']=$request->input('lnremtot');
		$lntrans['lnsbrem']=$request->input('lnsbrem');
		$lntrans['branch']=$request->input('branch');
		$lntrans['account']=$request->input('account');
		
		$id=$this->acc->insert_loantran($lntrans);
		return redirect('/');
	}
	
	//To retrieve Loan information //Newly Added
	
	public function Retrieve_Loaninfo(Request $request)
	{
		$loaninfo=$request->input('actno');
		//echo $loaninfo;
		$get=$this->loan_model->getLoanInfo($loaninfo);
		//print_r($get);
		$id['fname']=$get->FirstName;
		$id['loantype']=$get->LoanType_Name;
		$id['loandur']=$get->LoanAlloc_Duration;
		$id['loanamt']=$get->LoanAlloc_LoanAmt;
		//$id['reminitial']=$get->LoanAlloc_LoanAmt;
		//if(!empty($get->Loan_TotalRem))
		$id['remtotal']=$get->Loan_TotalRem;
		//else
		//$id['remtotal']=$get->LoanAlloc_LoanAmt;
		return $id;
	} 
	
	public function RetriveSB_Amt(Request $request)
	{
		$sbamt=$request->input('actid');
		//echo $loaninfo;
		$get=$this->loan_model->RetriveSB_Amt($sbamt);
		//print_r($get);
		$id['total']=$get->Total_Bal;
		/*$id['loantype']=$get->LoanType_Name;
			$id['loandur']=$get->LoanAlloc_Duration;
			$id['loanamt']=$get->LoanAlloc_LoanAmt;
			//$id['reminitial']=$get->LoanAlloc_LoanAmt;
			if(!empty($get->LoanTrans_RemTotal))
			$id['remtotal']=$get->LoanTrans_RemTotal;
			else
		$id['remtotal']=$get->LoanAlloc_LoanAmt;*/
		return $id;
	}
	public function TranReceiptHome()
		{
			return view('TransactionReceiptHome');
		}
		
		
		public function TransactionReceiptView(Request $request)
		{
			$ReceiptParam['ReceiptTypeDD']=$request->input('ReceiptTypeDD');
			
			
			if($ReceiptParam['ReceiptTypeDD']=="SB")
			{
				$ReceiptData=$this->TranModel->TransactionReceiptData($ReceiptParam);
				return view('TransactionReceiptListSB',compact('ReceiptData'));
			}
			else if($ReceiptParam['ReceiptTypeDD']=="RD")
			{
				$ReceiptData=$this->TranModel->TransactionReceiptData($ReceiptParam);
				return view('TransactionReceiptListRD',compact('ReceiptData'));
			}
			else if($ReceiptParam['ReceiptTypeDD']=="PIGMY")
			{
				$ReceiptData=$this->TranModel->TransactionReceiptData($ReceiptParam);
				return view('TransactionReceiptListPG',compact('ReceiptData'));
			}
		}
		
		public function TranReceipt($type,$id)
		{
			
			if($type=="SB")
			{
				$ReceiptData=$this->TranModel->TranReceipt($type,$id);
				return view('TranReceiptSB',compact('ReceiptData'));
			}
			else if($type=="RD")
			{
				$ReceiptData=$this->TranModel->TranReceipt($type,$id);
				return view('TranReceiptRD',compact('ReceiptData'));
			}
			else if($type=="PIGMY")
			{
				$ReceiptData=$this->TranModel->TranReceipt($type,$id);
				return view('TranReceiptPG',compact('ReceiptData'));
			}
		}
		
		public function rv_print(Request $request)
		{
			$in_data['tran_category'] = $request->input("tran_category");//JL,SB,..
			$in_data['tran_type'] = $request->input("tran_type");//CREDIT,DEBIT
			$in_data['tran_id'] = $request->input("tran_id");
			if(empty($in_data["tran_id"])) {
				$in_data["tran_list"] = "YES";
			} else {
				$in_data["tran_list"] = "NO";
			}
			switch($in_data['tran_type']) {
				case "SB" : $data = $this->TranModel->rv_print_sb($in_data);
							break;
				case "RD" : $data = $this->TranModel->rv_print_rd($in_data);
							break;
				case "JL" : $data = $this->TranModel->rv_print_jl($in_data);
							break;
				case "DL" : $data = $this->TranModel->rv_print_dl($in_data);
							break;
				case "SL" : $data = $this->TranModel->rv_print_sl($in_data);
							break;
				case "PL" : $data = $this->TranModel->rv_print_pl($in_data);
							break;
			}
			return view("blade_name",compact('data'));
		}
}
