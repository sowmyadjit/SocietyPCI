<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\PayAmtModel;
use App\Http\Model\OpenCloseModel;
	
	class PayAmtController extends Controller
	{
		
		//var $comp;
		
		public function __construct()
		{
			$this->Modules= new ModulesModel;
			$this->PayAmtMod = new PayAmtModel;
			$this->OP_model=new OpenCloseModel;
			
		}
		
		public function PayAmountIndex()
		{
			$Url="PayAmountIndex";
			$PayAmount['module']=$this->Modules->GetAnyMid($Url);
				$PayAmount['data']=$this->PayAmtMod->GetPigPayData();
			$PayAmount['open']=$this->OP_model->openstate();
			$PayAmount['close']=$this->OP_model->openclosestate();
	   if(empty($PayAmount['open']))
	   {
			$PayAmount['open']=0;
		}
		else
		{
			$PayAmount['open']=1;
		} 
		if(empty($PayAmount['close']))
		{
			$PayAmount['close']=0;
		}
		else
		{
			$PayAmount['close']=1;
		}
       // return view('transation',compact('state'));
			return view('PigmyPayAmountHome',compact('PayAmount'));
		}
		
		public function RDPayAmountIndex()
		{
			$Url="RDPayAmountIndex";
			$PayAmount['module']=$this->Modules->GetAnyMid($Url);
			
				$PayAmount['data']=$this->PayAmtMod->GetRDPayData();
			$PayAmount['open']=$this->OP_model->openstate();
			$PayAmount['close']=$this->OP_model->openclosestate();
			 if(empty($PayAmount['open']))
	   {
			$PayAmount['open']=0;
		}
		else
		{
			$PayAmount['open']=1;
		} 
		if(empty($PayAmount['close']))
		{
			$PayAmount['close']=0;
		}
		else
		{
			$PayAmount['close']=1;
		}
			return view('RdPayAmountHome',compact('PayAmount'));
		}
		
		public function FDPayAmountIndex() //M 13-4-16 Pending to edit
		{
			$Url="RDPayAmountIndex";
			$PayAmount['module']=$this->Modules->GetAnyMid($Url);
			
			$PayAmount['data']=$this->PayAmtMod->GetFDPayData();
			$PayAmount['open']=$this->OP_model->openstate();
			$PayAmount['close']=$this->OP_model->openclosestate();
		 if(empty($PayAmount['open']))
	   {
			$PayAmount['open']=0;
		}
		else
		{
			$PayAmount['open']=1;
		} 
		if(empty($PayAmount['close']))
		{
			$PayAmount['close']=0;
		}
		else
		{
			$PayAmount['close']=1;
		}
			return view('FdPayAmountHome',compact('PayAmount'));
		}
		
		public function PigmyPayAmountView()
		{
			return view('PygmyPayAmt');
		}
		
		public function RDPayAmountView()
		{
			return view('RDPayAmt');
		}
		public function FDPayAmountView()
		{
			return view('FDPayAmt');
		}
		
		public function PigmyPayAmount(Request $request)
		{
			$PayAmt['account']=$request->input('account');
			$PayAmt['PigPayMode']=$request->input('PigPayMode');
			$PayAmt['PigPayableAmt']=$request->input('PigPayableAmt');
			$PayAmt['PigPayChequeNum']=$request->input('PigPayChequeNum');
			$PayAmt['PigPayChequeDate']=$request->input('PigPayChequeDate');
			$PayAmt['BankId']=$request->input('BankId');
			$PayAmt['sbremamt']=$request->input('sbremamt');
			$PayAmt['sbavailamt']=$request->input('sbavailamt');
			$PayAmt['accid']=$request->input('accid');
			$PayAmt['actid']=$request->input('actid');
			$PayAmt['PigIntMode']=$request->input('PigIntMode');
			$PayAmt['Bid']=$request->input('Bid');
			
			
			
			$id=$this->PayAmtMod->InsertPayAmount($PayAmt);
			return redirect('/');
			
		}
		
		public function PigmyPayAmountReceipt($id)
		{
			$PigPayRece['PigPayAmt']=$this->PayAmtMod->GetPigPayReceDetail($id);
			
			//$PigPayRece['maxReceiptId']=$this->PayAmtMod->PigPayMaxRecNum();
			//var_dump($psreceipt);
			
			return view('PigmyPayAmountReceipt',compact('PigPayRece'));
			
		}
		
		public function RdPayAmountReceipt($id) //M 13-4-16
		{
			$RdPayRece['RdPayAmt']=$this->PayAmtMod->GetRdPayReceDetail($id);
			
			//$RdPayRece['maxReceiptId']=$this->PayAmtMod->RdPayMaxRecNum();
			//$RdPayRece['StaffBranch']=$this->PayAmtMod->ReceiptStaffBranch();
			//var_dump($psreceipt);
			
			return view('RdPayAmountReceipt',compact('RdPayRece'));
			
		}
		
		public function FdPayAmountReceipt($id) //M 15-4-16
		{
			$FdPayRece['FdPayAmt']=$this->PayAmtMod->GetFdPayReceDetail($id);
			
			//$FdPayRece['maxReceiptId']=$this->PayAmtMod->FdPayMaxRecNum();
			//$FdPayRece['StaffBranch']=$this->PayAmtMod->ReceiptStaffBranch();
			//var_dump($psreceipt);
			
			return view('FdPayAmountReceipt',compact('FdPayRece'));
			
		}
		
		/*public function UpdatePigmyReceiptNo(Request $request)
		{
			$UpdPigPayRece['recenum']=$request->input('recenum');
			
			$UpdPigPayRece['PigPayId']=$request->input('PigPayId');
			//var_dump($psreceipt);
			
			$id=$this->PayAmtMod->UpdatePigmyReceiptNo($UpdPigPayRece);
			return redirect('/');
			
		}
		
		public function PigPayMaxRecNum()
		{
			$MaxPigRec['ReceiptNum']=$this->PayAmtMod->PigPayMaxRecNum();
			//$id['ReceiptNum']=$MaxPigRec->PayAmount_ReceiptNum;
			//return $id;
			return $MaxPigRec;
			
			//$id=$this->PayAmtMod->InsertPayAmount($PayAmt);
			//return redirect('/');
			
		}
		
		public function UpdateRdReceiptNo(Request $request)
		{
			$UpdRdPayRece['recenum']=$request->input('recenum');
			
			$UpdRdPayRece['RdPayId']=$request->input('RdPayId');
			//var_dump($psreceipt);
			
			$id=$this->PayAmtMod->UpdateRdReceiptNo($UpdRdPayRece);
			return redirect('/');
			
		}
		
		public function RdPayMaxRecNum()
		{
			$MaxRdRec['ReceiptNum']=$this->PayAmtMod->RdPayMaxRecNum();
			//$id['ReceiptNum']=$MaxPigRec->PayAmount_ReceiptNum;
			//return $id;
			return $MaxRdRec;
			
			//$id=$this->PayAmtMod->InsertPayAmount($PayAmt);
			//return redirect('/');
			
		}
		
		public function UpdateFdReceiptNo(Request $request)//M 15-4-16
		{
			$UpdFdPayRece['recenum']=$request->input('recenum');
			
			$UpdFdPayRece['FdPayId']=$request->input('FdPayId');
			//var_dump($psreceipt);
			
			$id=$this->PayAmtMod->UpdateFdReceiptNo($UpdFdPayRece);
			return redirect('/');
			
		}*/
		
		
		
		public function GetPigmyDetailsForPayAmt(Request $request) //for PayAmt
		{
			$Pigmy['PigmyAccNum']=$request->input('PigmyAccNum');
			$get=$this->PayAmtMod->GetPigmyDetailsForPayAmt($Pigmy);
			$id['TotPayAmt']=$get->Total_Amount;
			$id['PigmyFn']=$get->FirstName;
			$id['PigmyMn']=$get->MiddleName;
			$id['PigmyLn']=$get->LastName;
			$id['PgTot']=$get->PgmTotal_Amt;
			$id['PgCom']=$get->Deduct_Commission;
			$id['PgDed']=$get->Deduct_Amount;
			$id['uid']=$get->Uid;
			return $id;
		}
		
		public function GetBankDetailsForPayAmt(Request $request) //for PayAmt
		{
			$Bank['BankId']=$request->input('BankId');
			$get=$this->PayAmtMod->GetBankDetailsForPayAmt($Bank);
			
			$id['BankName']=$get->BankName;
			$id['IFSC']=$get->AddBank_IFSC;
			$id['Branch']=$get->Branch;
			$id['AccountNo']=$get->AccountNo;
			return $id;
		}
		
		//Retrive Account Details from interest table (Newly Added)
		public function GetPigmyIntDetailsForPayAmt(Request $request) 
		{
			$PigmyInt['PigmyIntAccNum']=$request->input('PigmyIntAccNum');
			$get=$this->PayAmtMod->GetPigmyIntDetailsForPayAmt($PigmyInt);
			$id['TotIntPayAmt']=$get->Total_Amount;
			$id['PigmyIntFn']=$get->FirstName;
			$id['PigmyIntMn']=$get->MiddleName;
			$id['PigmyIntLn']=$get->LastName;
			$id['uid']=$get->Uid;
			$id['mtot']=$get->Principle_Amount;
			$id['intrst']=$get->Interest_Amt;
			return $id;
		}
		
		public function GetSBForPayAmt(Request $request)
		{
			$UserID['usrid']=$request->input('usrid');
			$get=$this->PayAmtMod->GetSBForPigmiPayAmt($UserID);
			
			if(!empty($get->AccNum))  //if have SB Account
			{
				$id['acn']=0;
				$id['tot']=$get->Total_Amount;
				$id['acccn']=$get->AccNum;
				$id['acid']=$get->Accid;
				$id['actid']=$get->AccTid;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		public function GetRDIntDetailsForPayAmt(Request $request) 
		{
			$RDInt['RDIntAccNum']=$request->input('RDIntAccNum');
			$get=$this->PayAmtMod->GetRDIntDetailsForPayAmt($RDInt);
			$id['TotIntPayAmt']=$get->Amount_Payable;
			$id['RDIntFn']=$get->FirstName;
			$id['RDIntMn']=$get->MiddleName;
			$id['RDIntLn']=$get->LastName;
			$id['uid']=$get->Uid;
			$id['mtot']=$get->Total_Amount;
			$id['intrst']=$get->Interest_Amt;
			return $id;
		}
		
		public function GetRDDetailsForPayAmt(Request $request) //for PayAmt
		{
			$RD['RDAccNum']=$request->input('RDAccNum');
			$get=$this->PayAmtMod->GetRDDetailsForPayAmt($RD);
			$id['RDFn']=$get->FirstName;
			$id['RDMn']=$get->MiddleName;
			$id['RDLn']=$get->LastName;
			$id['RDTot']=$get->RdTotal_Amt;
			$id['RDPayAmt']=$get->TotalAmt_Payable;
			$id['RDDedAmt']=$get->Deduct_Amt;
			$id['uid']=$get->Uid;
			return $id;
		}
		
		public function GetFDMatuDetailsForPayAmt(Request $request) //for PayAmt
		{
			$FDInt['FDMatuAccNum']=$request->input('FDMatuAccNum');
			$get=$this->PayAmtMod->GetFDMatuDetailsForPayAmt($FDInt);
			$id['FDIntFn']=$get->FirstName;
			$id['FDIntMn']=$get->MiddleName;
			$id['FDIntLn']=$get->LastName;
			$id['FDIntTot']=$get->Fd_DepositAmt;
			$id['FDIntPayAmt']=$get->Fd_TotalAmt;
			$id['FDIntAmt']=$get->interest_amount;
			$id['uid']=$get->Uid;
			return $id;
		}
		
		public function GetFDDetailsForPayAmt(Request $request) //for PayAmt
		{
			$FD['FDAccNum']=$request->input('FDAccNum');
			$get=$this->PayAmtMod->GetFDDetailsForPayAmt($FD);
			$id['FDFn']=$get->FirstName;
			$id['FDMn']=$get->MiddleName;
			$id['FDLn']=$get->LastName;
			$id['FDTot']=$get->FdTotal_Amt;
			$id['FDPayAmt']=$get->TotalAmt_Payable;
			$id['FDIntAmt']=$get->Interest_Amount;
			$id['uid']=$get->Uid;
			$id['acc']=$get->Fd_CertificateNum;
			return $id;
		}
		
		
		public function GetSBForRDPayAmt(Request $request)
		{
			$UserID['usrid']=$request->input('usrid');
			$get=$this->PayAmtMod->GetSBForRDPayAmt($UserID);
			
			if(!empty($get->AccNum))  //if have SB Account
			{
				$id['acn']=0;
				$id['tot']=$get->Total_Amount;
				$id['acccn']=$get->AccNum;
				$id['acid']=$get->Accid;
				$id['actid']=$get->AccTid;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		public function GetSBForFDPayAmt(Request $request)
		{
			$UserID['usrid']=$request->input('usrid');
			$get=$this->PayAmtMod->GetSBForFDPayAmt($UserID);
			
			if(!empty($get->AccNum))  //if have SB Account
			{
				$id['acn']=0;
				$id['tot']=$get->Total_Amount;
				$id['acccn']=$get->AccNum;
				$id['acid']=$get->Accid;
				$id['actid']=$get->AccTid;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		
		public function RDPayAmount(Request $request)//pending to edit for cheque
		{
			$rdPayAmt['rdaccount']=$request->input('rdaccount');
			$rdPayAmt['RDPayMode']=$request->input('RDPayMode');
			$rdPayAmt['RDPayableAmt']=$request->input('RDPayableAmt');
			$rdPayAmt['RDPayChequeNum']=$request->input('RDPayChequeNum');
			$rdPayAmt['RDPayChequeDate']=$request->input('RDPayChequeDate');
			$rdPayAmt['BankId']=$request->input('BankId');
			$rdPayAmt['sbremamt']=$request->input('sbremamt');
			$rdPayAmt['sbavailamt']=$request->input('sbavailamt');
			$rdPayAmt['accid']=$request->input('accid');
			$rdPayAmt['actid']=$request->input('actid');
			$rdPayAmt['RDIntMode']=$request->input('RDIntMode');
			$rdPayAmt['Bid']=$request->input('Bid');
			
			
			
			$id=$this->PayAmtMod->InsertRDPayAmount($rdPayAmt);
			return redirect('/');
			
		}
		
		public function FDPayAmount(Request $request)//pending to edit for cheque
		{
			$fdPayAmt['fdaccount']=$request->input('fdaccount');
			$fdPayAmt['FDAccnum']=$request->input('FDAccnum');
			$fdPayAmt['FDPayMode']=$request->input('FDPayMode');
			$fdPayAmt['FDPayableAmt']=$request->input('FDPayableAmt');
			$fdPayAmt['FDPayChequeNum']=$request->input('FDPayChequeNum');
			$fdPayAmt['FDPayChequeDate']=$request->input('FDPayChequeDate');
			$fdPayAmt['BankId']=$request->input('BankId');
			$fdPayAmt['sbremamt']=$request->input('sbremamt');
			$fdPayAmt['sbavailamt']=$request->input('sbavailamt');
			$fdPayAmt['accid']=$request->input('accid');
			$fdPayAmt['actid']=$request->input('actid');
			$fdPayAmt['FDPaymntMode']=$request->input('FDPaymntMode');
			$fdPayAmt['Bid']=$request->input('Bid');
			
			
			
			$id=$this->PayAmtMod->InsertFDPayAmount($fdPayAmt);
			return redirect('/');
			
		}
		
		public function PigmyPaySearchView(Request $request)// M 20-4-16
		{
			$Url="PayAmountIndex";
			$id=$request->input('SearchAccId');
			$PayAmount['module']=$this->Modules->GetAnyMid($Url);
			
			$PayAmount['data']=$this->PayAmtMod->GetPigPaySearchData($id);
			return view('PigmyPayAmountSearch',compact('PayAmount'));
		}
		
		public function RdPaySearchView(Request $request)// M 20-4-16
		{
			$id=$request->input('SearchAccId');
			$PayAmount=$this->PayAmtMod->GetRdPaySearchData($id);
			return view('RdPayAmountSearch',compact('PayAmount'));
		}
		
		public function FdPaySearchView(Request $request)// M 20-4-16
		{
			$id=$request->input('SearchAccId');
			$PayAmount=$this->PayAmtMod->GetFdPaySearchData($id);
			return view('FdPayAmountSearch',compact('PayAmount'));
		}
	}
	
	
