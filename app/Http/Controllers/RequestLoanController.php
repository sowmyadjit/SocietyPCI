<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\LoanTypeModel;
	use App\Http\Model\LoanModel;
	use App\Http\Model\PayAmtModel;
	use App\Http\Model\RequestLoanModel;
	use App\Http\Model\OpenCloseModel;
	
	class RequestLoanController extends Controller
	{
		var $loantype;
		public function __construct()
		{
			$this->loantype=new LoanTypeModel;
			$this->loan=new LoanModel;
			$this->PayAmtMod=new PayAmtModel;
			$this->Req_Loan=new RequestLoanModel;
			$this->op=new OpenCloseModel;
		}

		public function RequestLoan()
		{
			$rl=$this->Req_Loan->GetRequestLoanData();
			$data["is_day_open"] = $this->op->is_day_open(date("Y-m-d"));
      		return view('RequestLoan',compact('rl','data'));
		}

		public function RequestPersLoan()
		{
			//$PersLoanCatCharge=$this->loantype->GetPerLoanCategory();
			$LoanCat=$this->loantype->GetLoanCategoryDropD();
			$data = $this->op->select_branch();
			return view('RequestPersonalLoan',compact('LoanCat','data'));
		}
		
		/*public function GetMemSBDetailView(Request $request)
		{
			$SBMemID['sbmembrid']=$request->input('sbmembrid');
			$get=$this->loan->GetMemSBDetailView($SBMemID);
			$id['sbacno']=$get->AccNum;
			$id['sbtot']=$get->Total_Amount;
			$id['sbaccid']=$get->Accid;
			$id['sbactid']=$get->AccTid;
			$id['uid']=$get->Uid;
			$id['fn']=$get->FirstName;
			$id['mn']=$get->MiddleName;
			$id['ln']=$get->LastName;
			return $id;
		}*/
		
		/*public function GetCharges()
		{
			$get=$this->loan->GetCharges();
			$id['book_form']=$get->book_formcharges;
			$id['other_charge']=$get->other_Charges;
			$id['adj_charge']=$get->Adjustment_Charge;
			return $id;
		}*/
		
		/*public function GetBankDetailsForPersLoan(Request $request) //for PayAmt
		{
			$Bank['BankId']=$request->input('BankId');
			$get=$this->PayAmtMod->GetBankDetailsForPayAmt($Bank);
			
			$id['BankName']=$get->BankName;
			$id['IFSC']=$get->AddBank_IFSC;
			$id['Branch']=$get->Branch;
			$id['AccountNo']=$get->AccountNo;
			return $id;
		}*/
		
		public function GetBranchIDForDL(Request $request)
		{
			$BranchID['BranchId']=$request->input('BranchId');
			$get=$this->loan->GetBranchIDForDL($BranchID);
			$id['inhand']=$get->InHandCash;
			return $id;
		}
		
		public function ReqPersLoanAllocation(Request $request)
		{
			$ReqPersLoan['ReqPersLoanAmt']=$request->input('ReqPersLoanAmt');
			$ReqPersLoan['LoanDurationDays']=$request->input('LoanDurationDays');
			$ReqPersLoan['LoanDurationYears']=$request->input('LoanDurationYears');
			$ReqPersLoan['ReqPLBranchID']=$request->input('ReqPLBranchID');
			$ReqPersLoan['ReqPLMembID']=$request->input('ReqPLMembID');
			$ReqPersLoan['ReqPersLoanDate']=$request->input('ReqPersLoanDate');
			$ReqPersLoan['LoanCategory']=$request->input('LoanCategory');
			$ReqPersLoan['loantypeid']=$request->input('loantypeid');
			$ReqPersLoan['loantypetext']=$request->input('loantypetext'); //m16-06-16
			$ReqPersLoan['DepositAccountNum']=$request->input('DepositAccountNum');
			$ReqPersLoan['ReqDepLoanAmt']=$request->input('ReqDepLoanAmt');
			$ReqPersLoan['ReqDepReqLoanAmt']=$request->input('ReqDepReqLoanAmt');
			$ReqPersLoan['ReqEmpID']=$request->input('ReqEmpID');
			$ReqPersLoan['ReqStfLoanAmt']=$request->input('ReqStfLoanAmt');
			$ReqPersLoan['ReqStfReqLoanAmt']=$request->input('ReqStfReqLoanAmt');
			$ReqPersLoan['ReqCustID']=$request->input('ReqCustID');
			$ReqPersLoan['ReqJwlDesc']=$request->input('ReqJwlDesc');
			$ReqPersLoan['ReqJwlRate']=$request->input('ReqJwlRate');
			$ReqPersLoan['ReqJwlLoanAmt']=$request->input('ReqJwlLoanAmt');
			$ReqPersLoan['ReqJewelDuration']=$request->input('ReqJewelDuration');
			$ReqPersLoan['grossweight']=$request->input('grossweight');
			$ReqPersLoan['netweight']=$request->input('netweight');
			$ReqPersLoan['UID']=$request->input('UID');
			$ReqPersLoan['custtype']=$request->input('custtype');
			$ReqPersLoan['userid']=$request->input('userid');
			$ReqPersLoan['jlid']=$request->input('jlid');
			
			$id=$this->Req_Loan->ReqPersLoanAllocation($ReqPersLoan);
			return redirect('/');
		}
		
		public function GetMemSBDetailReq(Request $request)
		{
			$MemID['membrid']=$request->input('membrid');
			$get=$this->loan->GetMemSBDetail($MemID);
			if(!empty($get->AccNum))  
			{
				$id['acn']=0;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		
		/*public function GetPygmyDetailsForReqLoan(Request $request)
		{
			$Pygmy['PgAllocID']=$request->input('PgAllocID');
			$get=$this->Req_Loan->GetPygmyDetailsForReqLoan($Pygmy);
			$id['pg_total']=$get->Total_Amount;
			return $id;
		}*/
		
		/*public function GetRDDetailsForReqLoan(Request $request)
		{
			$RD['RDAccID']=$request->input('RDAccID');
			$get=$this->Req_Loan->GetRDDetailsForReqLoan($RD);
			$id['rd_total']=$get->Total_Amount;
			return $id;
		}*/
		
		public function GetJltype(Request $request)
		{
			return ($this->Req_Loan->GetJltype($request->search));
		}
	}
