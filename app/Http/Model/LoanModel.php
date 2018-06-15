<?php
	
	namespace App\Http\Model;
	
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\SettingsModel;
	
	class LoanModel extends Model
	{
		protected $table='loan_allocation';

		public function __construct() {
				$this->rv_no = new ReceiptVoucherController;
				$this->settings = new SettingsModel;
		}
		
		public function getaccname($id)
		{
			return DB::table('createaccount')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->select('user.FirstName','user.Uid')
			->where('createaccount.Accid','=',$id['act'])
			->first();
		}
		
		/*public function insert($id)
			{
			
			
			$lid = DB::table('loan_allocation')->insertGetId(['LoanType_ID'=> $id['lntp'],'Accid'=>$id['lnac'],'Bid'=>$id['lnbc'],'LoanAlloc_LoanAmt'=>$id['loanamt'],'LoanAlloc_Duration'=>$id['loanduratn'],'LoanAlloc_SDate'=>$id['loansdte'],'LoanAlloc_EDate'=>$id['loanedte'],'LoanDoc_ID'=>$docid]);
			
			$id=DB::table('loanremaining_balance')->insertGetId(['Accid'=>$id['lnac'],'Loan_TotalRem'=>$id['loanamt']]);
			
			return $id;
		}*/
		
		public function CreateDepositeLoan($id)
		{
			//print_r($id);
			$AccBID=$id['DepLoanBranchid'];
			$sbtran='';
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BCode','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$BranchID= DB::table('branch')->select('BCode')
			//->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('branch.Bid','=',$AccBID)
			->first();
			
			
			$BranchCode=$BranchID->BCode;
			$b=$udetail->BCode;
			$bid=$udetail->Bid;
			
			$paymode=$id['DepLoanPayMode'];
			$bnkid=$id['LoanBankId'];
			$payamt=$id['PayableAmount'];
			$datee=date('d-m-Y');
			
			if($paymode=="SB ACCOUNT")
			{
				
				
				
				$reportdatee=date('Y-m-d');
				$dm=date('m');
				$dy=date('Y');
				$tm=date('h:i:s');
				$a=$id['DepSBAvail'];
				$amt1=$id['PayableAmount'];
				$amount=$a+$amt1;
				
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$id['sb'],'AccTid'=>$id['DepSBtype'],'TransactionType'=>"CREDIT",'particulars'=>"Deposite Loan Amount",'Amount'=>$id['PayableAmount'],'CurrentBalance'=>$id['DepSBAvail'],'tran_Date'=>$datee,'SBReport_TranDate'=>$reportdatee,'Time'=>$tm,'Month'=>$dm,'Year'=>$dy,'Total_Bal'=>$amount,'Bid'=>$id['DepLoanBranchid'],'Payment_Mode'=>$id['DepLoanPayMode'],'CreatedBy'=>$UID]);
				
				$ACID=$id['sb'];
				$sb=DB::table('createaccount')->where('Accid',$ACID)
				->update(['Total_Amount'=>$amount]);	
			}
			
			//$count=1;
			//$cntrow=DB::table('depositeloan_allocation')->count('DepLoanAllocId');
			
			
			
			$maxid=DB::table('depositeloan_allocation')->where('DepLoan_Branch','=',$bid)->max('DepLoanAllocId');
			
			
			$accnum1=DB::table('depositeloan_allocation')->select('DepLoan_LoanNum')->where('DepLoanAllocId','=',$maxid)->first();
			$accnum=$accnum1->DepLoan_LoanNum;
			print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
			$paccno2=$matches[2];
			
			$paccno3=intval($paccno2)+1;
			$paccno="PCISDL".$b.$paccno3;
			
			
			
			/*	if($cntrow==0)
				{
				$count_inc="PCIS"."DL".$BranchCode.$count;
				
				}
				else
				{
				$count_inc="PCIS"."DL".$BranchCode.($cntrow+1);
			}*/
			
			
			$deptyp=$id['DepositeType'];
			$deploannum=$id['DepositAccountNum'];
			$Uidfi='';
			if($deptyp=="PIGMY")
			{
				$Uidfi1=DB::table('pigmiallocation')
				->select('UID')
				->where('PigmiAcc_No','=',$deploannum)
				->first();
				
				$Uidfi=$Uidfi1->UID;
				
			}
			else if($deptyp=="FD")
			{
				$Uidfi1=DB::table('fdallocation')
				->select('Uid')
				->where('Fd_CertificateNum','=',$deploannum)
				->first();
				
				$Uidfi=$Uidfi1->Uid;
				
			}
			else if($deptyp=="RD")
			{
				$Uidfi1=DB::table('createaccount')
				->select('Uid')
				->where('AccNum','=',$deploannum)
				->first();
				
				$Uidfi=$Uidfi1->Uid;
				
			}
			$lid = DB::table('depositeloan_allocation')->insertGetId(['DepLoan_DepositeType'=> $deptyp,'DepLoan_LoanTypeID'=>$id['DepLoanType'],'DepLoan_Branch'=>$AccBID,'DepLoan_AccNum'=>$id['DepositAccountNum'],'DepLoan_LoanAmount'=>$id['DepLoanAmt'],'DepLoan_RemailningAmt'=>$id['DepLoanAmt'],'DepLoan_LoanCharge'=>$id['LoanCharge'],'DepLoan_LoanStartDate'=>$id['DepLoanStartDate'],'DepLoan_LoanEndDate'=>$id['DepLoanEndDate'],'DepLoan_LoanDurationDays'=>$id['emimonth'],'DepLoan_PaymentMode'=>$id['DepLoanPayMode'],'DepLoan_ChequeNumber'=>$id['DepLoanChequeNum'],'DepLoan_ChequeDate'=>$id['DepLoanChequeDte'],'DepLoan_BankId'=>$id['LoanBankId'],'DepLoan_LoanNum'=>$paccno,'DepLoan_SbTranId'=>$sbtran,'DepLoan_Uid'=>$Uidfi,'DepLoan_AuthBy'=>$UID,'EMI_Amount'=>$id['EMIAmount'],'DepLoan_lastpaiddate'=>$id['DepLoanStartDate'],'Old_loan_number'=>$id['old']]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $paymode;
				$fn_data["rv_transaction_id"] = $lid;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DL_ALLOCATION;//constant DL_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['DepLoanStartDate'];
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				/***********/
				$fn_data["rv_payment_mode"] = $paymode;
				$fn_data["rv_transaction_id"] = $lid;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DL_ALLOCATION;//constant DL_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['DepLoanStartDate'];
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			if($deptyp=="PIGMY")
			{
				$alid = DB::table('pigmiallocation')
				->where('PigmiAcc_No',$deploannum)
				->update(['Loan_Allocated'=> "YES"]);
			}
			else if($deptyp=="FD")
			{
				$alid = DB::table('fdallocation')
				->where('Fd_CertificateNum',$deploannum)
				->update(['Loan_Allocated'=> "YES"]);
			}
			else if($deptyp=="RD")
			{
				$alid = DB::table('createaccount')
				->where('AccNum',$deploannum)
				->update(['Loan_Allocated'=> "YES"]);
			}
			
			if($paymode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				
				$inhandcash1=$inhandcashh->InHandCash;
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$amt=$inhandcash1-$payamt;
				
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$amt]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$datee,'InhandTrans_Particular'=>"Amount Credited from Deposit Loan",'InhandTrans_Cash'=>$payamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$amt]);
			}
			
			else if($paymode=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bnkid)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				$ResultAmt=($BankAmt-$payamt);
				
				DB::table('addbank')->where('Bankid','=',$bnkid)
				->update(['TotalAmt'=>$ResultAmt]);
			}
			return $id;
		}
		
		public function GetLoanAcct($q)
		{
			return DB::table('loan_allocation')
			->join('createaccount','createaccount.Accid','=','loan_allocation.Accid')
			->select(DB::raw('loan_allocation.Accid as id, AccNum as name'))
			->where('AccNum','like','%'.$q.'%')
			->where('loan_allocation.status','=',"AUTHORISED")
			->get();
		}
		
		public function getLoanInfo($id)
		{
			/*$acc=DB::table('loan_transaction')
				->where('loan_transaction.Accid','=',$id)
				->count('Accid');
				//echo $acc;
				if($acc==0)
				{
				$res=DB::table('loan_allocation')
				->join('createaccount','createaccount.Accid','=','loan_allocation.Accid')
				->join('user','user.Uid','=','createaccount.Uid')
				->join('loan_type','loan_type.LoanType_ID','=','loan_allocation.LoanType_ID')
				->select('FirstName','LoanType_Name','LoanAlloc_Duration','LoanAlloc_LoanAmt')
				->where('loan_allocation.Accid','=',$id)
				->first();
				}
				else
			{*/
			$res=DB::table('loan_allocation')
			->join('createaccount','createaccount.Accid','=','loan_allocation.Accid')
			->join('user','user.Uid','=','createaccount.Uid')
			->join('loan_type','loan_type.LoanType_ID','=','loan_allocation.LoanType_ID')
			->join('loanremaining_balance','loanremaining_balance.Accid','=','loan_allocation.Accid')
			->select('FirstName','LoanType_Name','LoanAlloc_Duration','LoanAlloc_LoanAmt','Loan_TotalRem')
			->where('loan_allocation.Accid','=',$id)
			->first();
			//}
			return $res;
		}
		
		public function RetriveSB_Amt($id)
		{
			$maxid=DB::table('sb_transaction')
			->where('Accid','=',$id)
			->max('Tranid');
			return DB::table('sb_transaction')
			->select('Total_Bal')
			->where('Accid','=',$id)
			->where('Tranid','=',$maxid)
			->first();
		}
		
		public function loan_criteria($id)
		{
			$res=DB::table('createaccount')
			->select('Accid')
			->where('AccNum','like','%SB%')
			->where('Accid','=',$id)
			->first();
			return $res;
		}
		
		
		public function RetrievePigmyAccDetail($id) //for Pigmy Loan Allocation
		{
			$id= DB::table('pigmiallocation')
			->select('user.FirstName','user.MiddleName','user.LastName','Total_Amount','user.Uid')
			->leftJoin('user','user.Uid','=','pigmiallocation.UID')
			->where('pigmiallocation.PigmiAllocID','=',$id)
			->first();
			return $id;
		}
		
		public function RetrieveFdAccDetail($id) //for FD Loan Allocation
		{
			$id= DB::table('fdallocation')
			->select('user.FirstName','user.MiddleName','user.LastName','Fd_DepositAmt','user.Uid')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->where('fdallocation.Fdid','=',$id)
			->first();
			return $id;
		}
		
		public function RetrieveRdAccDetail($id) //for RD Loan Allocation
		{
			$id= DB::table('createaccount')
			->select('user.FirstName','user.MiddleName','user.LastName','Total_Amount','user.Uid')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->where('createaccount.Accid','=',$id)
			->first();
			return $id;
		}
		
		public function GetLoanChargesDropD() //fOR dEP lOAN aLLOC
		{
			$LoanCharge = DB::table('loan_charges')->select('LoanCharges_Amount')->get();
			return $LoanCharge;
		}
		
		public function GetBranchIDForDL($id) 
		{
			$id= DB::table('cash')
			->select('InHandCash')
			->where('BID','=',$id)
			->first();
			return $id;	
		}
		
		public function GetSBForDL($id)
		{
			//prin $id;
			/*$id=DB::table('depositeloan_allocation')
				->select('createaccount.AccNum','createaccount.Total_Amount')
				->leftJoin('pigmiallocation','pigmiallocation.PigmiAcc_No','=','depositeloan_allocation.DepLoan_AccNum')
				->leftJoin('createaccount','createaccount.Uid','=','pigmiallocation.UID')
				
				->where('AccNum','like','%SB%')
				->where('DepLoan_AccNum','=',$id)
				
			->first();*/
			$deptype=$id['DepositType'];
			$accnum=$id['PAccNum'];
			$q='';
			$q1='';
			if($deptype=='PIGMY')
			{
				$q1=DB::table('pigmiallocation')
				->where('PigmiAcc_No','=',$accnum)
				->select('UID')
				->first();
				$q=$q1->UID;
			}
			else if($deptype=='FD')
			{
				$q1=DB::table('fdallocation')
				->select('Uid')
				->where('Fd_CertificateNum','=',$accnum)
				->first();
				$q=$q1->Uid;
			}
			else if($deptype=='RD')
			{
				$q1=DB::table('createaccount')
				->select('Uid')
				->where('AccNum','=',$accnum)
				->first();
				$q=$q1->Uid;
			}
			$id=DB::table('createaccount')
			->select('createaccount.AccNum','createaccount.Total_Amount','createaccount.Accid','createaccount.AccTid')
			->where('AccNum','like','%SB%')
			->where('Uid','=',$q)
			->first();
			return $id;
		}
		
		public function Get_EmpDetails($id) //for RD Loan Allocation
		{
			$idd = DB::table('employee')
			->select('Emp_Type','Joining_Date','basicpay')
			//->join('salary','salary.Uid','=','employee.Uid')
			->where('employee.Uid','=',$id)
			->first();
			//print_r($idd);
			
			return $idd;
		}
		
		public function GetMemSBDetail($id) //To get Sb Detail for Member
		{
			$id=DB::table('createaccount')
			->select('createaccount.AccNum')
			->join('members','members.Uid','=','createaccount.Uid')
			->where('AccNum','like','%SB%')
			->where('members.Memid','=',$id)
			->first();
			//print_r($id);
			return $id;
		}
		
		public function GetMemSBDetailView($id) //To View Sb Detail for Member
		{
			/*$id=DB::table('createaccount')
			->select('createaccount.AccNum','createaccount.Total_Amount','createaccount.Accid',
			'createaccount.AccTid','members.Uid','members.FirstName','members.MiddleName','members.LastName')
			->join('members','members.Uid','=','createaccount.Uid')
			->where('AccNum','like','%SB%')
			->where('members.Memid','=',$id)
			->first();
			//print_r($id);*/
			$id=DB::table('createaccount')->select('createaccount.AccNum','createaccount.Total_Amount','createaccount.Accid',
			'createaccount.AccTid','user.Uid','user.FirstName','user.MiddleName','user.LastName')
			->join('user','user.Uid','=','createaccount.Uid')
			->where('Accid',$id)
			->first();
			return $id;
		}
		
		public function GetCharges() //To get Loan Charges
		{
			return DB::table('nondeploancharge_master')
			->select('book_formcharges','other_Charges','Adjustment_Charge','Compulsory_Deposit','staffcharge')
			->first();
			//return $id;
		}
		public function StaffGetDiffYear($id) //To get Staff Work Experience
		{
			$jdte=$id['jDate'];
			$dte=date('Y-m-d');
			
			$date1=date_create($dte);
			$date2=date_create($jdte);
			//print_r ($date1);
			//print_r ($date2);
			//break;
			$difdate=date_diff($date1,$date2);
			
			$difyearfirst=$difdate->format('%y');
			$difmonthfirst=$difdate->format('%m');
			$difdayfirst=$difdate->format('%d');
			$dif=$difyearfirst."Years"." ".$difmonthfirst."Months"." ".$difdayfirst."Days";
			return $dif;
		}
		
		public function insert($id)
		{
			$docid=DB::table('loan_document')->InsertGetId(['LoanDoc_VoterID'=>$id['loanvid'],'LoanDoc_AdharCard'=>$id['loanadrcrd'],'LoanDoc_PanCard'=>$id['loanpncrd'],'LoanDoc_Signature'=>$id['loansign']]);
			
			$lid = DB::table('loan_allocation')->insertGetId(['LoanType_ID'=> $id['lntp'],'Accid'=>$id['lnac'],'Bid'=>$id['lnbc'],'LoanAlloc_LoanAmt'=>$id['loanamt'],'LoanAlloc_Duration'=>$id['loanduratn'],'LoanAlloc_SDate'=>$id['loansdte'],'LoanAlloc_EDate'=>$id['loanedte'],'LoanDoc_ID'=>$docid]);
			
			$id=DB::table('loanremaining_balance')->insertGetId(['Accid'=>$id['lnac'],'Loan_TotalRem'=>$id['loanamt']]);
			
			return $id;
		}
		
		public function CreatePersonalLoan($id)
		{
			$AccBID=$id['PLBranchID'];
			$dte=date('Y-m-d');
			$reportdatee=date('Y-m-d');
			$dm=date('m');
			$dy=date('Y');
			$tm=date('h:i:s');
			$acid=$id['PersLoanSBAccid'];
			if(empty($id['partpayment']))
			{
				$pay=$id['PersLoanAmt'];
				
			}
			else
			{
				
				$pay=$id['partpayment'];
			}
			
			$sbtran='';
			$docid='';
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BCode','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			
			$BranchID= DB::table('branch')->select('BCode')
			->where('branch.Bid','=',$AccBID)
			->first();
			
			$BranchCode=$BranchID->BCode;
			$b=$udetail->BCode;
			$bid=$udetail->Bid;
			
			$paymode=$id['PersLoanPayMode'];
			$payamt=$id['PersPayAmt'];
			$memid=$id['PLMembID'];
			$bnkid=$id['PersLoanBankID'];
			$sbamt=$id['PersLoanSBtotalhidn'];
			$Persloantypeid=$id['Persloantypeid'];
			
			$tempeDate = explode('/',$id['PersLoanEndDate']);
			$coneDate = $tempeDate[2]."-".$tempeDate[1]."-".$tempeDate[0];
			
			$docid=DB::table('loan_document')->InsertGetId(['Loan_Security1'=>$id['sec1'],'Loan_Security2'=>$id['sec2'],'Loan_Security3'=>$id['sec3'],'Loan_Security4'=>$id['sec4']]);
			
			$count=1;
			$cntrow=DB::table('personalloan_allocation')
			->where('Bid',$bid)
			->count('PersLoanAllocID');
			if($cntrow==0)
			{
				$count_inc="PCIS"."PL".$BranchCode.$count;
				
			}
			else
			{
				$count_inc="PCIS"."PL".$BranchCode.($cntrow+1);
			}
			
	/****************/
			$update_allocation = false;
			if($id["partpay"] == "Partpayment") {
				$part_pay_count = DB::table("personalloan_allocation")
					->where("MemId",$id['PLMembID'])
					->where("Closed","NO")
					->where("Bid",$BID)
					->count();
					
				if($part_pay_count > 0) {
					$update_allocation = true;
				}
			}
			
			if($update_allocation) {
				$allocation_entry = DB::table("personalloan_allocation")
					->where("MemId",$id['PLMembID'])
					->where("Closed","NO")
					->orderBy("PersLoanAllocID","desc")
					->first();
					
				$total_loan_amount = $allocation_entry->LoanAmt + $id["PersLoanAmt"];
				$total_remaining_amount = $allocation_entry->RemainingLoan_Amt + $id["PersLoanAmt"];
				$total_otherCharges = $allocation_entry->otherCharges + $id['PersOthrChrges'];
				$total_Book_FormCharges = $allocation_entry->Book_FormCharges + $id['PersBkfrmChrg'];
				$total_AjustmentCharges = $allocation_entry->AjustmentCharges + $id['PersAdjChrg'];
				$total_ShareCharges = $allocation_entry->ShareCharges + $id['PersShrChrg'];
				$total_Insurance = $allocation_entry->Insurance + $id['Insurance'];
				
				DB::table("personalloan_allocation")
					->where("PersLoanAllocID",$allocation_entry->PersLoanAllocID)
					->update([
								"LoanAmt"=>$total_loan_amount,
								"RemainingLoan_Amt"=>$total_remaining_amount,
								"EMI_Amount"=>$id['PersEMIAmt'],
								// "otherCharges"=>$total_otherCharges,
								// "Book_FormCharges"=>$total_Book_FormCharges,
								// "AjustmentCharges"=>$total_AjustmentCharges,
								// "ShareCharges"=>$total_ShareCharges,
								// "Insurance"=>$total_Insurance
							]);
				$perslid = $allocation_entry->PersLoanAllocID;
					
			} else {
				$perslid = DB::table('personalloan_allocation')->insertGetId(['PersLoan_Number'=> $count_inc,'Bid'=> $id['PLBranchID'],'DocId'=>$docid,'MemId'=>$id['PLMembID'],'LoanAmt'=>$id['PersLoanAmt'],'otherCharges'=>$id['PersOthrChrges'],'Book_FormCharges'=>$id['PersBkfrmChrg'],'AjustmentCharges'=>$id['PersAdjChrg'],'ShareCharges'=>$id['PersShrChrg'],'PayableAmt'=>$id['PersPayAmt'],'LoandurationYears'=>$id['LoanDurationYears'],'FirstSurety'=>$id['PLSurety1ID'],'SecondSurety'=>$id['PLSurety2ID'],'StartDate'=>$id['PersLoanStartDate'],'EndDate'=>$coneDate,'PayMode'=>$id['PersLoanPayMode'],'accid'=>$id['PersLoanSBAccid'],'CreadtedBY'=>$UID,'BankID'=>$id['PersLoanBankID'],'ChequeDate'=>$id['PersLoanChequeDte'],'ChequeNumber'=>$id['PersLoanChequeNum'],'EMI_Amount'=>$id['PersEMIAmt'],'RemainingLoan_Amt'=>$id['PersLoanAmt'],'caldate'=>$id['PersLoanStartDate'],'Insurance'=>$id['Insurance'],'partpayment_amount'=>$pay,'LoanType_ID'=>$Persloantypeid,"allocation_date"=>date("Y-m-d")]);
			}
	/****************/
				
			$ln_amt = $id['PersLoanAmt'];
			$ln_type = $Persloantypeid;
			$subhead = DB::table("loan_type")->where("LoanType_ID","=",$ln_type)->value("SubLedgerId");
			$personalloan_payment_id = DB::table('personalloan_payment')->insertGetId([
																	"pl_payment_date"=>date("Y-m-d"),
																	"pl_allocation_id"=>$perslid,
																	"paid_amount"=>$ln_amt,
																	"paid_status"=>"1",
																	"payment_mode"=>$paymode,
																	"particulars"=>"PL PAYMENT",
																	"otherCharges"=>$id['PersOthrChrges'],
																	"Book_FormCharges"=>$id['PersBkfrmChrg'],
																	"AjustmentCharges"=>$id['PersAdjChrg'],
																	"ShareCharges"=>$id['PersShrChrg'],
																	"Insurance"=>$id['PersPayAmt'],
																	"SubLedgerId"=>$subhead,
																	"deleted"=>"0",
																]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $paymode;
				$fn_data["rv_transaction_id"] = $personalloan_payment_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::PL_ALLOCATION;//constant PL_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = date("Y-m-d");
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/																
			
			$membertyp1=DB::table('members')->select('agent_member')->where('Memid','=',$id['PLMembID'])->first();
			$membertyp=$membertyp1->agent_member;
			if($membertyp=="1")
			{
				$cd1=DB::table('employee')->select('CD')->where('Uid',$id['uid'])->first();
				$cd=$cd1->CD;
				$totcd=$cd+$id['PersAdjChrg'];
				DB::table('employee')->where('Uid',$id['uid'])->update(['CD'=>$totcd]);
				$branchcd1=DB::table('branch')->select('CD')->where('Bid',$BID)->first();
				$branchcd=$branchcd1->CD;
				$totbranchCD=$branchcd+$id['PersAdjChrg'];
				
				DB::table('branch')->where('Bid',$BID)->update(['CD'=>$totbranchCD]);
			}
			DB::table('createaccount')
			->where('Accid',$acid)
			->update(['Loan_Allocated'=>"YES"]);
			
			DB::table('members')
			->where('Memid',$memid)
			->update(['Loan_Allocated'=>"YES"]);
			
			if($paymode=="SB ACCOUNT")
			{
				
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$id['PersLoanSBAccid'],'AccTid'=>$id['PersLoanSBAccTid'],'TransactionType'=>"CREDIT",'particulars'=>"Personal Loan Amount",'Amount'=>$id['PersPayAmt'],'CurrentBalance'=>$id['PersSBAvailhidn'],'tran_Date'=>$dte,'SBReport_TranDate'=>$reportdatee,'Time'=>$tm,'Month'=>$dm,'Year'=>$dy,'Total_Bal'=>$id['PersLoanSBtotalhidn'],'Bid'=>$id['PLBranchID'],'Payment_Mode'=>$id['PersLoanPayMode'],'CreatedBy'=>$UID/*,'Uncleared_Bal'=>$id['PersPayAmt'],'Cleared_State'=>"PENDING"*/]);
				
				DB::table('createaccount')
				->where('Accid',$acid)
				->update(['Total_Amount'=>$sbamt]);
			}
			else if($paymode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				
				$inhandcash1=$inhandcashh->InHandCash;
				$tot=$inhandcash1-$payamt;
				
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$tot]);
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$dte,'InhandTrans_Particular'=>"Amount Credited from Personal Loan",'InhandTrans_Cash'=>$payamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$tot]);
				
			}
			else if($paymode=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bnkid)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				$ResultAmt=($BankAmt-$payamt);
				
				DB::table('addbank')->where('Bankid','=',$bnkid)
				->update(['TotalAmt'=>$ResultAmt]);
			}
			
			return $id;
		}
		
		
		
		public function JewelLoanAllocation($id)//06-04-2016
		{
			print_r($id);
			$dte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$BranchId=$uname->Bid;
			//$tempsDate = explode('/',$id['JewelStartDate']);
			//$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			//$sdate=date('Y-m-d',strtotime($consDate));
			//$enddate=$id['pgedte'];
			
			$tempeDate = explode('/',$id['JewelEndDate']);
			$coneDate = $tempeDate[2]."-".$tempeDate[1]."-".$tempeDate[0];
			
			//$edate=date('Y-m-d',strtotime($coneDate));
			//$BranchId=$id['bid'];
			
			$branchcodeval = DB::table('branch')->select('BCode')
			->where('branch.Bid','=',$BranchId)
			->first();
			$branchcode=$branchcodeval->BCode;
			$accountnm=$branchcode."JL";
			
			/*	$count=1;
				$count_inc;
				$accno = DB::table('jewelloan_allocation')
				->where('JewelLoan_LoanNumber','like','%'.$accountnm.'%')
			->count();*/
			
			
			
			$maxid=DB::table('jewelloan_allocation')->where('JewelLoan_Bid','=',$BranchId)->max('JewelLoanId');
			
			
			$accnum1=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber')->where('JewelLoanId','=',$maxid)->first();
			$accnum=$accnum1->JewelLoan_LoanNumber;
			print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
			$paccno2=$matches[2];
			
			$paccno3=intval($paccno2)+1;
			$count_inc="PCISJL".$branchcode.$paccno3;
			
			/*	if($accno==0)
				{
				$count_inc="PCIS".$branchcode."JL".$count;
				
				}
				else
				{
				$count_inc="PCIS".$branchcode."JL".($accno+1);
			}*/
			
			
			$jid=DB::table('jewelloan_allocation')->InsertGetId(['JewelLoan_LoanNumber'=>$count_inc,'JewelLoan_LoanTypeId'=>$id['loantyp'],'JewelLoan_Bid'=>$BranchId,'JewelLoan_Uid'=>$id['jeweluid'],'JewelLoan_AppraisalValue'=>$id['Jewelappval'],'JewelLoan_LoanDuration'=>$id['Jewelduration'],'JewelLoan_LoanAmount'=>$id['JewelAmt'],'JewelLoan_SaraparaCharge'=>$id['JewelspacomVal'],'JewelLoan_InsuranceCharge'=>$id['JewelinsuVal'],'JewelLoan_BookAndFormCharge'=>$id['JewelBkfrmChrgVal'],'JewelLoan_OtherCharge'=>$id['JewelOthrChrges'],'JewelLoan_LoanAmountAfterDeduct'=>$id['JewelPayAmountAfter'],'JewelLoan_StartDate'=>$id['JewelStartDate'],'JewelLoan_EndDate'=>$coneDate,'JewelLoan_PaymentMode'=>$id['JewelPayMode'],'JewelLoan_ChqNum'=>$id['JewelChequeNum'],'JewelLoan_ChqDate'=>$id['JewelChequeDte'],'JewelLoan_Bankid'=>$id['BankId'],'JewelLoan_CreatedBy'=>$UID,'JewelLoan_LoanRemainingAmount'=>$id['JewelAmt'],'JewelLoan_lastpaiddate'=>$id['JewelStartDate'],'jewelloan_Description'=>$id['Jewel_Description'],'jewelloan_Oldloan_No'=>$id['old'],'jewelloan_RequestID'=>$id['PersLoanAllocID']]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $id['JewelPayMode'];
				$fn_data["rv_transaction_id"] = $jid;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::JL_ALLOCATION;//constant JL_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				/***********/
				$fn_data["rv_payment_mode"] = $id['JewelPayMode'];
				$fn_data["rv_transaction_id"] = $jid;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::JL_ALLOCATION;//constant JL_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			$pid=$id['PersLoanAllocID'];
			
			DB::table('request_loan')->where('PersLoanAllocID','=',$pid)
			->update(['Request_LoanAllocated'=>"YES",'Request_LoanAllocted_Id'=>$jid]);
			
			
			$paymode=$id['JewelPayMode'];
			$payable=$id['JewelPayAmountAfter'];
			$payableamt=Floatval($payable);
			if($paymode=="CASH")
			{
				$payable=$id['JewelPayAmountAfter'];
				$payableamt=Floatval($payable);
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$a=$inhandcash1-$payableamt;
				
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$a]);
			}
			
			else if($paymode=="SB ACCOUNT")
			{
				$payable=$id['JewelPayAmountAfter'];
				$payableamt=Floatval($payable);
				$idii = DB::table('sb_transaction')->insertGetId(['Accid'=> $id['accid'],'AccTid' =>"1",'TransactionType' => "CREDIT",'particulars' =>"JL AMOUNT CREDITED",'Amount' =>$payableamt,'CurrentBalance' => $id['JewelSBAvail'],'Total_Bal' => $id['JewelSBtotal'],'tran_Date' =>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$BID,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'Payment_Mode'=>"SB ACCOUNT"]);
				
				DB::table('createaccount')->where('Accid','=',$id['accid'])->update(['Total_Amount'=>$id['JewelSBtotal']]);
				
				
			}
			
		}
		
		
		public function JewelLoanAllocation_Renewal($id)//06-04-2016
		{
			
			$dte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$BranchId=$uname->Bid;
			
			$payableamt=$id['JewelPayAmountAfter'];
			$tempeDate = explode('/',$id['JewelEndDate']);
			$coneDate = $tempeDate[2]."-".$tempeDate[1]."-".$tempeDate[0];
			
			
			
			$branchcodeval = DB::table('branch')->select('BCode')
			->where('branch.Bid','=',$BranchId)
			->first();
			$branchcode=$branchcodeval->BCode;
			$accountnm=$branchcode."JL";
			
			/*	$count=1;
				$count_inc;
				$accno = DB::table('jewelloan_allocation')
				->where('JewelLoan_LoanNumber','like','%'.$accountnm.'%')
			->count();*/
			
			
			
			$maxid=DB::table('jewelloan_allocation')->where('JewelLoan_Bid','=',$BranchId)->max('JewelLoanId');
			
			
			$accnum1=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber')->where('JewelLoanId','=',$maxid)->first();
			$accnum=$accnum1->JewelLoan_LoanNumber;
			print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
			$paccno2=$matches[2];
			
			$paccno3=intval($paccno2)+1;
			$count_inc="PCISJL".$branchcode.$paccno3;
			
			/*	if($accno==0)
				{
				$count_inc="PCIS".$branchcode."JL".$count;
				
				}
				else
				{
				$count_inc="PCIS".$branchcode."JL".($accno+1);
			}*/
			
			$jeweldata=DB::table('jewelloan_allocation')->where('JewelLoan_LoanNumber',$id['account_num'])->first();
			
			$JewelLoan_LoanTypeId=$jeweldata->JewelLoan_LoanTypeId;
			$JewelLoan_Bid=$jeweldata->JewelLoan_Bid;
			$JewelLoan_Uid=$jeweldata->JewelLoan_Uid;
			$JewelLoan_AppraisalValue=$jeweldata->JewelLoan_AppraisalValue;
			$JewelLoanId=$jeweldata->JewelLoanId;
			
			
			$jid=DB::table('jewelloan_allocation')->InsertGetId(['JewelLoan_LoanNumber'=>$count_inc,'JewelLoan_LoanTypeId'=>$JewelLoan_LoanTypeId,'JewelLoan_Bid'=>$JewelLoan_Bid,'JewelLoan_Uid'=>$JewelLoan_Uid,'JewelLoan_AppraisalValue'=>$JewelLoan_AppraisalValue,'JewelLoan_LoanDuration'=>$id['Jewelduration'],'JewelLoan_LoanAmount'=>$id['JewelAmt'],'JewelLoan_SaraparaCharge'=>$id['JewelspacomVal'],'JewelLoan_InsuranceCharge'=>$id['JewelinsuVal'],'JewelLoan_BookAndFormCharge'=>$id['JewelBkfrmChrgVal'],'JewelLoan_OtherCharge'=>$id['JewelOthrChrges'],'JewelLoan_LoanAmountAfterDeduct'=>$id['JewelPayAmountAfter'],'JewelLoan_StartDate'=>$id['JewelStartDate'],'JewelLoan_EndDate'=>$coneDate,'JewelLoan_PaymentMode'=>$id['JewelPayMode'],'JewelLoan_ChqNum'=>$id['JewelChequeNum'],'JewelLoan_ChqDate'=>$id['JewelChequeDte'],'JewelLoan_Bankid'=>$id['BankId'],'JewelLoan_CreatedBy'=>$UID,'JewelLoan_LoanRemainingAmount'=>$id['JewelAmt'],'JewelLoan_lastpaiddate'=>$id['JewelStartDate'],'jewelloan_Description'=>$id['Jewel_Description']]);
			
			
			
			
			$paymode=$id['JewelPayMode'];
			
			if($paymode=="CASH")
			{
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$a=$inhandcash1-$payableamt;
				
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$a]);
			}
			
			else if($paymode=="SB ACCOUNT")
			{
				$idii = DB::table('sb_transaction')->insertGetId(['Accid'=> $id['accid'],'AccTid' =>"1",'TransactionType' => "CREDIT",'particulars' =>"JL AMOUNT CREDITED",'Amount' =>$payableamt,'CurrentBalance' => $id['JewelSBAvail'],'Total_Bal' => $id['JewelSBtotal'],'tran_Date' =>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$BID,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'Payment_Mode'=>"SB ACCOUNT"]);
				
				DB::table('createaccount')->where('Accid','=',$id['accid'])->update(['Total_Amount'=>$id['JewelSBtotal']]);
				
				
			}
			
			
			//$charges=$id['charges'];
			//$amount=$id['amount'];
			//$loopid=$id['loopid'];
			
			
			
			
			$Loaninterest=$id['old_interest_num'];//interset amount
			$LoanprincipalRem=$id['old_principal_num'];
			
			$n=$id['loopid'];
			$chargid=$id['charges'];
			$chargamt=$id['amount'];
			
			$totamt=$id['tot'];
			
			
			$z=0;
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$DepAlID,'bid'=>$JewelLoan_Bid,'charg_tran_date'=>$dte,'loantype'=>"JL"]);
				$z++;
				
				
				
			}
			$jlTran=DB::table('jewelloan_repay')->InsertGetId(['JLRepay_JLAllocID'=>$JewelLoanId,'JLRepay_PaidAmt'=>$id['tot'],'JLRepay_PayMode'=>"RENEWAL",'JLRepay_Bid'=>$JewelLoan_Bid,'JLRepay_Created_By'=>$UID,'JLRepay_Date'=>$dte,'JLRepay_interestcalculated'=>$Loaninterest,'JLRepay_interestpaid'=>$Loaninterest,'JLRepay_interestpending'=>'0','JLRepay_paidtoprincipalamt'=>$LoanprincipalRem]);
			
			DB::table('jewelloan_allocation')
			->where('JewelLoanId',$JewelLoanId)
			->update(['JewelLoan_LoanRemainingAmount'=>'0','JewelLoan_remaininginterest'=>'0','JewelLoan_lastpaiddate'=>$dte]);
			
			if(!(empty($id['Amt_recive'])))
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$a=$inhandcash1-$id['Amt_recive'];
				
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$a]);
				
			}
		}
		
		
		
		
		public function CheckSBForStaff($id)
		{
			$id=DB::table('createaccount')
			->select('AccNum')
			->where('AccNum','like','%SB%')
			->where('Uid','=',$id)
			->first();
			//print_r($id);
			return $id;
		}
		
		public function getSBForStaff($id)
		{
			$id=DB::table('createaccount')
			->select('AccNum','Total_Amount','Accid','AccTid','FirstName','MiddleName','LastName')
			->join('user','user.Uid','=','createaccount.Uid')
			->where('AccNum','like','%SB%')
			->where('createaccount.Uid','=',$id)
			->first();
			return $id;
		}
		
		public function StaffLoanAllocation($id)
		{
			$AccBID=$id['staffbid'];
			$dte=date('Y-m-d');
			$reportdatee=date('Y-m-d');
			$dm=date('m');
			$dy=date('Y');
			$tm=date('h:i:s');
			$acid=$id['StfLoanSBAccid'];
			
			$sbtran='';
			$docid='';
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BCode','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			
			$BranchID= DB::table('branch')->select('BCode','CD')
			//->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('branch.Bid','=',$AccBID)
			->first();
			
			$BranchCode=$BranchID->BCode;
			$Branch_CD=$BranchID->CD;
			$b=$udetail->BCode;
			$bid=$udetail->Bid;
			
			$paymode=$id['StfLoanPayMode'];
			$payamt=$id['StfPayAmt'];
			$bnkid=$id['StfBankId'];
			$s1=$id['stfsec1'];
			$s2=$id['stfsec2'];
			$s3=$id['stfsec3'];
			$s4=$id['stfsec4'];
			
			$tempsDate = explode('-',$id['StfLoanStartDate']);
			$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			
			
			$tempeDate = explode('-',$id['StfLoanEndDate']);
			$coneDate = $tempeDate[2]."-".$tempeDate[1]."-".$tempeDate[0];
			
			//$edate=date('Y-m-d',strtotime($coneDate));
			
			if(!($s1==""||$s2==""||$s3==""||$s4==""))
			{
				$docid=DB::table('loan_document')->InsertGetId(['Loan_Security1'=>$id['stfsec1'],'Loan_Security2'=>$id['stfsec2'],'Loan_Security3'=>$id['stfsec3'],'Loan_Security4'=>$id['stfsec4']]);
			}
			$count=1;
			$cntrow=DB::table('staffloan_allocation')->count('StfLoanAllocID');
			if($cntrow==0)
			{
				$count_inc="PCIS"."SL".$BranchCode.$count;
				
			}
			else
			{
				$count_inc="PCIS"."SL".$BranchCode.($cntrow+1);
			}
			$EmpUid=$id['StaffID'];
			$cd=$id['Compulsory_Deposit'];
			$sc=$id['staffcharge'];
			$amt_cd=$cd+$sc;
			$cd_id=DB::table('compulsory_deposit')->insertGetId(['CD_Bid'=>$bid,'CD_Amount'=>$amt_cd,'CD_Date'=>$dte,'CD_Account'=>$count_inc,'CD_Type'=>"CREDIT"]);
			
			$tot_branch_cd=$Branch_CD+$amt_cd;
			DB::table('branch')->where('Bid',$bid)->update(['CD'=>$tot_branch_cd]);
			
			$perslid = DB::table('staffloan_allocation')->insertGetId(['StfLoan_Number'=> $count_inc,'Bid'=> $AccBID,'DocId'=>$docid,'Uid'=>$id['StaffID'],'LoanAmt'=>$id['Stfamttopay'],'otherCharges'=>$id['StfOthrChrge'],'Book_FormCharges'=>$id['StfBkfrmChrg'],'AjustmentCharges'=>$id['Compulsory_Deposit'],'ShareCharges'=>$id['staffcharge'],'PayableAmt'=>$id['StfPayAmt'],'LoandurationYears'=>$id['LoanDurationYears'],'LoanduratiobDays'=>$id['LoanDurationDays'],'Staff_Surety'=>$id['suretyid'],'Loan_Type'=>$id['StfLoanType'],'StartDate'=>$consDate,'EndDate'=>$coneDate,'PayMode'=>$paymode,'accid'=>$id['StfLoanSBAccid'],'CreadtedBY'=>$UID,'BankID'=>$id['StfBankId'],'ChequeDate'=>$id['StfLoanChequeDte'],'ChequeNumber'=>$id['StfLoanChequeNum'],'StaffLoan_LoanRemainingAmount'=>$id['Stfamttopay'],'cd_id'=>$cd_id,'LedgerHeadId'=>'49','SubLedgerId'=>'56']);
			
				/***********/
				$fn_data["rv_payment_mode"] = $paymode;
				$fn_data["rv_transaction_id"] = $perslid;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SL_ALLOCATION;//constant SL_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			
			
			
			DB::table('createaccount')
			->where('Accid',$acid)
			->update(['Loan_Allocated'=>"YES"]);
			
			DB::table('employee')
			->where('Uid',$EmpUid)
			->update(['Loan_Allocated'=>"YES"]);
			
			if($paymode=="SB ACCOUNT")
			{
				
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$acid,'AccTid'=>$id['StfLoanSBAccTid'],'TransactionType'=>"CREDIT",'particulars'=>"Staff Loan Amount",'Amount'=>$payamt,'CurrentBalance'=>$id['StfSBAvail'],'tran_Date'=>$dte,'SBReport_TranDate'=>$reportdatee,'Time'=>$tm,'Month'=>$dm,'Year'=>$dy,'Total_Bal'=>$id['StfLoanSBtotal'],'Bid'=>$AccBID,'Payment_Mode'=>$paymode,'CreatedBy'=>$UID,'Uncleared_Bal'=>$payamt,'Cleared_State'=>"PENDING"]);
				
				DB::table('createaccount')
				->where('Accid',$acid)
				->update(['Total_Amount'=>$id['StfLoanSBtotal']]);
			}
			else if($paymode=="CASH")
			{
				
				//$xx=$id['LoanCharge'];
				//$xxx=$id['DepLoanAmt'];
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				
				$inhandcash1=$inhandcashh->InHandCash;
				$tot=$inhandcash1-$payamt;
				
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$tot]);
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$dte,'InhandTrans_Particular'=>"Amount Credited from Staff Loan",'InhandTrans_Cash'=>$payamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$tot]);
				
			}
			else if($paymode=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bnkid)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				$ResultAmt=($BankAmt-$payamt);
				
				DB::table('addbank')->where('Bankid','=',$bnkid)
				->update(['TotalAmt'=>$ResultAmt]);
			}
			
			return $id;
		}
		
		//Get Members For Personal Loan Allocation
		public function GetMembersForPersLoanAlloc($q)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('request_loan')
			->join('members','members.Memid','=','request_loan.RL_MemId')
			->select(DB::raw('Memid as id, CONCAT(`Memid`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->where('Auth_Status','=',"AUTHORISED")
			->where('Request_LoanAllocated','=',"NO")
			->where('Loan_CategoryId','=',"1");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("request_loan.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		//Get Members For Personal Loan Allocation
		public function GetMemDetailForPLAlloc($id)
		{
			return DB::table('request_loan')
			->join('branch','branch.Bid','=','request_loan.Bid')
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->select('LoandurationYears','LoandurationDays','AmountDecideBy_Board','BName','LoanType_Name','branch.Bid','loan_type.LoanType_ID','Uid')
			->where('RL_MemId','=',$id)
			->where('Request_LoanAllocated','=','NO')
			->orderBy('PersLoanAllocID','desc')
			->first();
		}
		
		//Get Pygmy Account Number for Deposit Loan
		public function GetPigmyNumForDLAlloc($q) 
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, DepLoan_AccNo as name'))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','request_loan.DepLoan_AccNo')
			->where('Loan_Allocated','=',"NO")
			->where('Closed','=',"NO")
			->where('DepLoan_AccNo','like','%PG%');
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("request_loan.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		//Get RD Account Number for Deposit Loan
		public function GetRDNumForDLAlloc($q) 
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, DepLoan_AccNo as name'))
			->join('createaccount','createaccount.AccNum','=','request_loan.DepLoan_AccNo')
			->where('Loan_Allocated','=',"NO")
			->where('Closed','=',"NO")
			->where('DepLoan_AccNo','like','%RD%');
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("request_loan.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		//Get RD Account Number for Deposit Loan
		public function GetFDNumForDLAlloc($q) 
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, DepLoan_AccNo as name'))
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','request_loan.DepLoan_AccNo')
			->where('Loan_Allocated','=',"NO")
			->where('Closed','=',"NO");
			//->where('DepLoan_AccNo','like','%FD%')
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("request_loan.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		//Get Pygmy detail for DL Allocation
		public function GetPigmyDetailForDL($id) //for Dep Loan Allocation
		{
			$id= DB::table('request_loan')
			->select('user.FirstName','user.MiddleName','user.LastName','loan_type.LoanType_ID','loan_type.LoanType_Name','user.Uid','branch.BName','pigmiallocation.Total_Amount','AmountDecideBy_Board','branch.Bid','EndDate')
			->join('user','user.Uid','=','request_loan.Uid')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','request_loan.DepLoan_AccNo')
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->join('branch','branch.Bid','=','request_loan.Bid')
			->where('request_loan.DepLoan_AccNo','like','%PG%')
			->where('PersLoanAllocID','=',$id)
			->first();
			return $id;
		}
		
		public function RetrieveRdAccDetailfromrequesttable($id) //for RD Loan Allocation
		{
			$id= DB::table('request_loan')
			->select('user.FirstName','user.MiddleName','user.LastName','loan_type.LoanType_ID','loan_type.LoanType_Name','user.Uid','branch.BName','createaccount.Total_Amount','AmountDecideBy_Board','branch.Bid','Maturity_Date')
			->join('user','user.Uid','=','request_loan.Uid')
			->join('createaccount','createaccount.AccNum','=','request_loan.DepLoan_AccNo')
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->join('branch','branch.Bid','=','request_loan.Bid')
			->where('request_loan.DepLoan_AccNo','like','%RD%')
			->where('PersLoanAllocID','=',$id)
			->first();
			return $id;
		}
		
		public function RetrieveFdAccDetailfromrequesttable($id) //for RD Loan Allocation
		{
			$id= DB::table('request_loan')
			->select('user.FirstName','user.MiddleName','user.LastName','loan_type.LoanType_ID','loan_type.LoanType_Name','user.Uid','branch.BName','fdallocation.Fd_DepositAmt','AmountDecideBy_Board','branch.Bid','FdReport_MatureDate')
			->join('user','user.Uid','=','request_loan.Uid')
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','request_loan.DepLoan_AccNo')
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->join('branch','branch.Bid','=','request_loan.Bid')
		//	->where('request_loan.DepLoan_AccNo','like','%FD%')
			->where('PersLoanAllocID','=',$id)
			->first();
			return $id;
		}
		public function getcustfromrequesttable($id)
		{
			$id= DB::table('request_loan')
			->select('loan_type.LoanType_ID','loan_type.LoanType_Name','branch.BName','AmountDecideBy_Board','LoandurationYears','LoandurationDays','branch.Bid','Gold_Rate','JewelLoan_Duration','Uid','Jewel_Description','PersLoanAllocID')
			//->join('user','user.Uid','=','request_loan.Uid')
			//->join('fdallocation','fdallocation.Fd_CertificateNum','=','request_loan.DepLoan_AccNo')
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->join('branch','branch.Bid','=','request_loan.Bid')
			->where('PersLoanAllocID','=',$id)
			->first();
			return $id;
		}
		public function GetJewelDetail() //To get Loan Charges
		{
			return DB::table('jewelloan_chareges_master')
			->select('six_Month','one_year','sarapara_commission','Book_Form_charges','Insurance_charges','other_charges')
			->first();
			//return $id;
		}
		public function Getjewelcustfromrequesttable($id)
		{
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$ret_data = DB::table('request_loan')
			
			->select(DB::Raw('PersLoanAllocID as id, CONCAT(user.`Uid`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->join('user','user.Uid','=','request_loan.Uid')
			->where('Request_LoanAllocated','=',"NO");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("request_loan.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}	
		
		//Get Month Difference for Dep loan EMI calculation
		public function GetMonthDiffForDL($id)
		{
			$st_dte=$id['Start_Date'];
			$ed_dte=$id['End_Date'];
			
			$date1=date_create($st_dte);
			$date2=date_create($ed_dte);
			$difdate=date_diff($date1,$date2);
			
			$difmonth=$difdate->format('%m');
			return $difmonth;
			
		}
		
		//Get Employee Name for Staff Loan Allocation
		public function GetEmpNameForSLAlloc($id)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, user.FirstName as name'))
			->join('user','user.Uid','=','request_loan.Uid')
			->where('Loan_Category','=',"3")
			->where('Auth_Status','=',"AUTHORISED");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("request_loan.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		public function getdetailsfromrequesttable($id)
		{
			$id= DB::table('request_loan')
			->select('loan_type.LoanType_ID','loan_type.LoanType_Name','branch.BName','AmountDecideBy_Board','LoandurationYears','LoandurationDays','branch.Bid','Uid')
			->leftJoin('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->leftJoin('branch','branch.Bid','=','request_loan.Bid')
			->where('PersLoanAllocID','=',$id)
			->first();
			//print_r($id);
			return $id;
		}
		public function dlloanrecepit($id)
		{
			return DB::table('depositeloan_allocation')
			->select('DepLoan_LoanNum','Old_loan_number','DepLoan_DepositeType','DepLoan_AccNum','Old_Accnum','DepLoan_LoanAmount','DepLoan_LoanCharge','DepLoan_LoanStartDate','DepLoan_LoanEndDate','DepLoan_RemailningAmt','FirstName','MiddleName','LastName','DepLoanAllocId')
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('DepLoanAllocId',$id)
			->get();
			
		}
		public function plloanrecepit($id)
		{
			return DB::table('personalloan_allocation')->select('PersLoanAllocID','PersLoan_Number','Old_PersLoan_Number','LoanAmt','PayableAmt','StartDate','EndDate','RemainingLoan_Amt','EMI_Amount','FirstName','MiddleName','LastName')
			->join('members','members.Memid','=','personalloan_allocation.MemId')
			->where('PersLoanAllocID',$id)
			->get();
		}
		public function jewelLoan1()
		{
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$jewelloan_allocation = DB::table('jewelloan_allocation')->select('JewelLoanId','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description','user.FirstName','user.MiddleName','user.LastName','JewelLoan_StartDate','JewelLoan_Uid','JewelLoan_Closed','JewelLoan_lastpaiddate','auction_status','fake_value')
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			//->leftJoin('customer','customer.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->where('JewelLoan_Bid',$BID)
//			->paginate(10);
			->get();
			
			foreach($jewelloan_allocation as $key => $row) {
				if($row->auction_status == 1 || $row->auction_status == 2) {
					$jewelloan_allocation[$key]->JewelLoan_Closed = "AUCTION";
//					$jewelloan_allocation[$key]->
				}
			}
			
			return $jewelloan_allocation;
		}
		
		public function jewelLoan1_all()
		{
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			return DB::table('jewelloan_allocation')->select('JewelLoanId','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description','user.FirstName','user.MiddleName','user.LastName','JewelLoan_StartDate','JewelLoan_Uid','JewelLoan_Closed','JewelLoan_lastpaiddate','auction_status','fake_value')
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			//->leftJoin('customer','customer.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->where('JewelLoan_Bid',$BID)
			//->paginate(10);
			->get();
		}
		public function jlloanrecepit($id)
		{
			return DB::table('jewelloan_allocation')->select('JewelLoanId','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description','FirstName','MiddleName','LastName','JewelLoan_StartDate')
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->where('JewelLoanId',$id)
			->get();
			
		}
		
		public function jlsearchacc($id)
		{
			
			$id= DB::table('jewelloan_allocation')->select('JewelLoanId','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description','user.FirstName','user.MiddleName','user.LastName','JewelLoan_StartDate','Custid')
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->leftJoin('customer','customer.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->where('JewelLoanId',$id)
			->get();
			return $id;
		}
		
		public function plsearchacc($pl)
		{
			
			$id= DB::table('personalloan_allocation')
				->select()
				->leftJoin('members','members.Memid','=','personalloan_allocation.MemId')
				->leftJoin('user','user.Uid','=','members.Uid')
				->where('PersLoanAllocID',$pl)
				->get();
			
			return $id;
		}
		
		public function slsearchacc($sl)
		{
			
			$id= DB::table('staffloan_allocation')
				->select()
				->leftJoin('user','user.Uid','=','staffloan_allocation.Uid')
				->where('StfLoanAllocID',$sl)
				->get();
				return $id;
		}
		
		public function dlsearchacc($dl)
		{
			
			$id= DB::table('depositeloan_allocation')
				->select()
				->leftJoin('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
				->where('DepLoanAllocId',$dl)
				->get();
				return $id;
		}
		
	/*	public function dlsearchacc($id)
		{
			return DB::table('depositeloan_allocation')
			->select('DepLoan_LoanNum','Old_loan_number','DepLoan_DepositeType','DepLoan_AccNum','Old_Accnum','DepLoan_LoanAmount','DepLoan_LoanCharge','DepLoan_LoanStartDate','DepLoan_LoanEndDate','DepLoan_RemailningAmt','user.FirstName','user.MiddleName','user.LastName','DepLoanAllocId','DepLoan_Uid')
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('DepLoanAllocId',$id)
			->get();
			
			
		}*/
		public function getcd_of_employee($id)
		{
			$c_id1=DB::table('staffloan_allocation')->select('cd_id')->where('StfLoanAllocID','=',$id)
			->first();
			$c_id=$c_id1->cd_id;
			$id=DB::table('compulsory_deposit')->select('CD_Amount')->where('CD_ID',$c_id)->first();
			
			return $id;
			
		}
		public function getSBForJewel($id)
		{
			
			$uiddd=DB::table('request_loan')->select('Uid')->where('PersLoanAllocID',$id)->first();
			$uidd=$uiddd->Uid;
			$x=DB::table('createaccount')->select('AccNum','Total_Amount')->where('Uid',$uidd)->first();
			return $x;
		}
		public function CreatePersLoanAllocation_renewal($id)
		{
			$dte=('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$BranchID= DB::table('branch')->select('BCode')
			->where('branch.Bid','=',$BID)
			->first();
			$BranchCode=$BranchID->BCode;
			
			$tempeDate = explode('/',$id['PersLoanEndDate']);
			$coneDate = $tempeDate[2]."-".$tempeDate[1]."-".$tempeDate[0];
			
			
			
			
			$maxid=DB::table('personalloan_allocation')->where('Bid','=',$BID)->max('PersLoanAllocID');
			
			
			$accnum1=DB::table('personalloan_allocation')->select('PersLoan_Number')->where('PersLoanAllocID','=',$maxid)->first();
			$accnum=$accnum1->PersLoan_Number;
			print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
			$paccno2=$matches[2];
			
			$paccno3=intval($paccno2)+1;
			$paccno="PCISPL".$BranchCode.$paccno3;
			
			
			$accno=$id['accno'];
			$plData=DB::table('personalloan_allocation')->where('PersLoan_Number',$accno)->first();
			
			$DocId=$plData->DocId;
			$MemId=$plData->MemId;
			$Bid=$plData->Bid;
			$FirstSurety=$plData->FirstSurety;
			$SecondSurety=$plData->SecondSurety;
			$EMI_Amount=$plData->EMI_Amount;
			$PersLoanAllocID=$plData->PersLoanAllocID;
			
			
			$perslid = DB::table('personalloan_allocation')->insertGetId(['PersLoan_Number'=> $paccno,'Bid'=> $Bid,'DocId'=>$DocId,'MemId'=>$MemId,'LoanAmt'=>$id['loanamt'],'otherCharges'=>$id['PersOthrChrges'],'Book_FormCharges'=>$id['PersBkfrmChrg'],'AjustmentCharges'=>$id['PersAdjChrg'],'ShareCharges'=>$id['PersShrChrg'],'PayableAmt'=>$id['loanamt'],'LoandurationYears'=>$id['LoanDurationYears'],'FirstSurety'=>$FirstSurety,'SecondSurety'=>$SecondSurety,'StartDate'=>$id['PersLoanStartDate'],'EndDate'=>$coneDate,'PayMode'=>$id['PersLoanPayMode'],'accid'=>$id['PersLoanSBAccid'],'CreadtedBY'=>$UID,'BankID'=>$id['PersLoanBankID'],'ChequeDate'=>$id['PersLoanChequeDte'],'ChequeNumber'=>$id['PersLoanChequeNum'],'EMI_Amount'=>$EMI_Amount,'RemainingLoan_Amt'=>$id['loanamt'],'caldate'=>$id['PersLoanStartDate'],'Insurance'=>$id['Insurance']]);
			
			$chargid=$id['charges'];
			$chargamt=$id['amount'];
			$n=$id['loopid'];
			
			
			$z=0;
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$PersLoanAllocID,'bid'=>$Bid,'charg_tran_date'=>$dte,'loantype'=>"PL"]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
				
			}
			
			
			$plTran=DB::table('personalloan_repay')->InsertGetId(['PLRepay_PLAllocID'=>$PersLoanAllocID,'PLRepay_PaidAmt'=>$id['tot'],'PLRepay_PayMode'=>"RENEWAL",'PLRepay_Bid'=>$Bid,'PLRepay_Created_By'=>$UID,'PLRepay_Date'=>$dte,'PLRepay_CalculatedInterest'=>$id['oldinterestamt'],'RemainingInterest_Amt'=>"0",'PLRepay_PaidInterest'=>$id['oldinterestamt'],'PLRepay_Amtpaidtoprincpalamt'=>$id['oldprincpalamt'],'PLRepay_EMIremaining'=>"0"]);
			
			
			return DB::table('personalloan_allocation')->where('PersLoan_Number',$accno)->update(['Closed'=>"YES"]);
		}
		public function partpaypartamt($id)
		{
			$dte=date('Y-m-d');
			DB::table('partpayment')->insert(['Part_Type'=>$id['type'],'Part_AllocID'=>$id['alloc'],'Part_Amount'=>$id['ea'],'Part_Date'=>$dte]);
			
		}
		
  
		public function getPendingJewelList()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$today = date("Y-m-d");
			$result = DB::table('jewelloan_allocation')
			->select()
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->leftJoin('request_loan','request_loan.PersLoanAllocID','=','jewelloan_allocation.jewelloan_RequestID')
			->where('JewelLoan_EndDate','<=',$today)
			->where('JewelLoan_Closed','=','NO')
			->where('JewelLoan_Bid','=',$BID)
			->where('auction_status','=','0')
			->get();
		//	->get();
			return $result;
			
		}
		
		public function jewelAuctionList()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$today = date("Y-m-d");
			$result = DB::table('jewelloan_allocation')
						->select()
						->join('jewel_auction','jewel_auction.JewelLoanId','=','jewelloan_allocation.JewelLoanId')
						->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
						->leftJoin('request_loan','request_loan.PersLoanAllocID','=','jewelloan_allocation.jewelloan_RequestID')
						->where('JewelLoan_EndDate','<=',$today)
//						->where('JewelLoan_Closed','=','NO')
//						->where('JewelLoan_Bid','=',$BID)
						->where('auction_status','=','1')
						->paginate(10);
					//	->get();
			return $result;
		}
		
		public function jewelAuctionExtraAmountList()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$today = date("Y-m-d");
			
			$result = DB::table('jewelloan_allocation')
						->select()
						->join('jewel_auction','jewel_auction.JewelLoanId','=','jewelloan_allocation.JewelLoanId')
						->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
						->leftJoin('request_loan','request_loan.PersLoanAllocID','=','jewelloan_allocation.jewelloan_RequestID')
//						->where('JewelLoan_EndDate','<=',$today)
						->where('JewelLoan_Bid','=',$BID)
						->where('auction_status','=','2')
//						->where('extra_amount','>','0')
						->where('exta_amount_paid','=','0')
						->paginate(10);
					//	->get();
					
			foreach($result as $key_res => $row_res) {
				$data["jewel_allocation_id"] = $row_res->JewelLoanId;
				$result[$key_res]->extra_amount = $this->jewel_auction_account_balance($data);
			}
			
			return $result;
		}
		
		public function sendToJewelAuction($acc_id)
		{
			foreach($acc_id as $aid) {
				DB::table('jewelloan_allocation')
					->where('JewelLoanId','=',$aid)
					->update(['auction_status'=>1,'JewelLoan_Closed'=>'YES','auction_sent_date'=>date("Y-m-d")]);
				$data = array(
							'JewelLoanId'=>$aid
						);
				DB::table('jewel_auction')
					->insert($data);
			}
		}
		
		public function jewelAuction($b)
		{
			foreach($b as $acc=>$amt) {
				DB::table('jewel_auction')
					->where('JewelLoanId','=',$acc)
					->update(['jewel_auction_amount'=>$amt]);
					
				DB::table('jewelloan_allocation')
					->where('JewelLoanId','=',$acc)
					->update(['auction_status'=>2]);
			}
		}
		
		
		function jlAuction($details)
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$buyerName = $details['bname'];
			$rem_amt = $details['rem_amt'];
			$rem_int = $details['rem_int'];
			$charges = $details['charges'];
			$auctionAmt = $details['auc_amt'];
			$buyerpaymentmode = $details['pay_mode'];
			$SBAccid = $details['buyer_acc_no'];
			$jewelalocid = $details['jl_alloc_id'];
			$bid2 = $details['bid2'];
			$expsubhead = $details['subhead_id'];
			$HeadiD = $details['head_id'];
			$per = $details['per'];
			$auc_date = $details['auc_date'];
			$dte = $auc_date;//date('Y-m-d');
			$reportdte = $auc_date;//date('Y-m-d');
			$year = date('Y',strtotime($auc_date));
			$mnt = date('m',strtotime($auc_date));
			$pay_type = $details["pay_type"];
			
			$loan_deduction_amount = $rem_amt + $rem_int + $charges;
		/*	$extra_amount =  */
			
			$extra_amount = $auctionAmt - $loan_deduction_amount;
			if($extra_amount < 0)
				$extra_amount = 0;
			
			/*
				$extra_amount < 0
				LOSS ACCOUNT
			*/
			
			print_r($details);
		
			if($buyerpaymentmode == "CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$auctionAmt;
				DB::table('cash')
						->where('BID','=',$BID)
						->update(['InHandCash'=>$x]);
			}
			else if($buyerpaymentmode=="SB")
			{
				$sbdetails=DB::table('createaccount')
							->select('AccNum','Total_Amount')
							->where('Accid','=',$SBAccid)
							->first();
				$AccNum=$sbdetails->AccNum;
				$Total_Amount=$sbdetails->Total_Amount;
				$updateamt=$Total_Amount-$auctionAmt;
				DB::table('createaccount')
					->where('Accid','=',$SBAccid)
					->update(['Total_Amount'=>$updateamt]);
				$id = DB::table('sb_transaction')
						->insertGetId(['Accid'=> $SBAccid,'AccTid' => "1",'TransactionType' => "DEBIT",'particulars' =>"SB ACCOUNT",'Amount' =>$auctionAmt,'CurrentBalance' => $Total_Amount,'Total_Bal' => $updateamt,'tran_Date' =>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$BID,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'Payment_Mode'=>"SB"]);
			}
			
			if($pay_type == "CASH") {
				$b2b_tran_id = DB::table('branch_to_branch')
					->insertGetId(['Branch_Branch1_Id'=>$BID,'Branch_Branch2_Id'=>$bid2,'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$auctionAmt,'Branch_per'=>$per,'LedgerHeadId'=>$HeadiD,'SubLedgerId'=>$expsubhead,'jewelalocId'=>$jewelalocid]);
				
					/***********/
					$fn_data["rv_payment_mode"] = $pay_type;
					$fn_data["rv_transaction_id"] = $b2b_tran_id;
					$fn_data["rv_transaction_type"] = "DEBIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = $dte;
					$fn_data["rv_bid"] = null;
					$this->rv_no->save_rv_no($fn_data);
					unset($fn_data);
					/***********/
					/***********/
					$fn_data["rv_payment_mode"] = $pay_type;
					$fn_data["rv_transaction_id"] = $b2b_tran_id;
					$fn_data["rv_transaction_type"] = "CREDIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = $dte;
					$fn_data["rv_bid"] = $bid2;//TO BRANCH
					$this->rv_no->save_rv_no($fn_data);
					unset($fn_data);
					/***********/
			
			} else {
				DB::table('branch_to_branch')
					->insert(['Branch_Branch1_Id'=>$bid2,'Branch_Branch2_Id'=>$BID,'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$auctionAmt,'Branch_per'=>$per,'LedgerHeadId'=>$HeadiD,'SubLedgerId'=>$expsubhead,'jewelalocId'=>$jewelalocid]);
			}
				
			DB::table('jewelloan_allocation')
				->where('JewelLoanId',$jewelalocid)
				->update(['auction_status'=>2]);
				
				
				
			DB::table('jewel_auction')
				->where('JewelLoanId',$jewelalocid)
				->update(['auction_date'=>$auc_date,'jewel_auction_amount'=>$auctionAmt,'loan_deduction_amount'=>$loan_deduction_amount,'extra_amount'=>$extra_amount,'buyer_name'=>$buyerName,'pay_mode'=>$buyerpaymentmode,'sb_acc_no'=>$SBAccid,'bank_name'=>"",'cheque_no'=>"",'cheque_date'=>""]);
			
			$jewel_auction_id = DB::table("jewel_auction")
				->where("JewelLoanId",$jewelalocid)
				->value("jewel_auction_id");
				/***********/
				$fn_data["rv_payment_mode"] = $buyerpaymentmode;
				$fn_data["rv_transaction_id"] = $jewel_auction_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::JL_AUCTION;//constant JL_AUCTION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
		}
		
		function jewelAuctionExtraAmountPay($id)
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$today=date("Y-m-d");
			$pay_date = $id["pay_date"];
			$pay_date_time =  strtotime($pay_date);
			$per = $id["per"];
			
			if($today == $pay_date) {
				$old_entry = false;
			} else {
				$old_entry = true;
			}
			
			$extra_amount = $id['extra_amt'];
			$date_ymd = date("Y-m-d",$pay_date_time);
			$date_dmy = date("d-m-Y",$pay_date_time);
			$time = date("Y-m-d H:i:s");
			$month = date("m",$pay_date_time);
			$year = date("Y",$pay_date_time);
			$voucher_no = 0;
			$voucher_no = DB::table("branch")->where("Bid","=",$BID)->value("payment_voucher_No");
			$voucher_no++;
				$cheque_no = $id["cheque_no"];
				$cheque_date = $id["cheque_date"];
				$bank_acc_no = $id["bank_acc_no"];
			
			$auction_amount_transaction_id = DB::table('auction_amount_transaction')
				->insertGetId(['bid'=>$BID,'jl_alloc_id'=>$id['jl_alloc_id'],'tran_date'=>$pay_date,'amt_piad'=>$id['extra_amt'],'created_by'=>$UID,'pay_mode'=>$id["pay_mode"],"voucher_no"=>$voucher_no,"cheque_no"=>$cheque_no,"cheque_date"=>$cheque_date,'SubLedgerId'=>"67"]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $id["pay_mode"];
				$fn_data["rv_transaction_id"] = $auction_amount_transaction_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::JL_AUCTION_EXTRA_AMOUNT_PAY;//constant JL_AUCTION_EXTRA_AMOUNT_PAY is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $pay_date;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			if($id["pay_mode"] == "CASH") {
				if(!$old_entry) {
					$cash_amount = DB::table("cash")->where("BID","=",$BID)->value("InHandCash");
					$rem_cash = $cash_amount - $id['extra_amt'];
					DB::table("cash")->where("BID","=",$BID)->update(["InHandCash"=>$rem_cash]);
				}
			} elseif($id["pay_mode"] == "SB") {
			
				$acc_id = $id["acc_no"];
				$acc_amt = DB::table("createaccount")->where("Accid","=",$acc_id)->value("Total_Amount");
				
				$sb_array = array(
									"Accid"=>$acc_id,
									"AccTid"=>"1",
									"TransactionType"=>"CREDIT",
									"particulars"=>$per,
									"Amount"=>$extra_amount,
									"tran_Date"=>$date_dmy,
									"SBReport_TranDate"=>$date_ymd,
									"Time"=>$time,
									"Month"=>$month,
									"Year"=>$year,
									"Bid"=>$BID,
									"Payment_Mode"=>"ADJUSTMENT",
									"CreatedBy"=>$UID,
									"tran_reversed"=>"no",
									"LedgerHeadId"=> "38",
									"SubLedgerId"=> "42"
								);
				
				$ret_id = DB::table("sb_transaction")->insertGetId($sb_array);
				$acc_new_amt = $acc_amt + $extra_amount;
				if(!$old_entry) {
					DB::table("createaccount")->where("Accid","=",$acc_id)->update(["Total_Amount"=>$acc_new_amt]);
				}
			} else {//if($id["pay_mode"] == "CHEQUE") {
				$initial_amt = DB::table("addbank")->where("Bankid","=",$bank_acc_no)->value("TotalAmt");
				$total_bal = $initial_amt - $extra_amount;
				if(!$old_entry) {
					DB::table("addbank")->where("Bankid","=",$bank_acc_no)->update(["TotalAmt"=>$total_bal]);
				}
			}
				
			$fn_data['jewel_allocation_id'] = $id['jl_alloc_id'];
			$remaining_amount = $this->jewel_auction_account_balance($fn_data);
			
			if(!($remaining_amount > 0)) {
				DB::table("jewel_auction")->where("JewelLoanId","=",$id['jl_alloc_id'])->update(["exta_amount_paid"=>"1"]);
			}
			
		}
		
		function get_cdreport($data)
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			
			$sl_field_codition = "=";
			$sl_no = $data["sl_no"];
			if(empty($sl_no)) {
				$sl_field_codition = "!=";
				$sl_no = "1";
			}
			$from_date = $data["from_date"];
			$to_date = $data["to_date"];
			if(empty($from_date) || empty($to_date)) {
				$from_date = date("Y-m-d",strtotime("-1 month"));
				$to_date = date("Y-m-d");
				
				//print_r("from_date = ".$from_date); echo "<br>";
				//print_r("to_date = ".$to_date); echo "<br>";
			}
			$dates = [$from_date,$to_date];
			
			$ret_data["from_date"] = $from_date;
			$ret_data["to_date"] = $to_date;
			
			$ret_data['det'] = DB::table("compulsory_deposit")
				->select("CD_Amount","CD_Date","CD_Account","CD_Type","FirstName","MiddleName","LastName")
				->join("staffloan_allocation","staffloan_allocation.StfLoan_Number","=","compulsory_deposit.CD_Account")
				->join("user","user.Uid","=","staffloan_allocation.Uid")
				//->where("compulsory_deposit.CD_Bid","=",$BID)
				->where("CD_Account",$sl_field_codition,$sl_no)
				->whereBetween("CD_Date",$dates)
				->get();
			return $ret_data;
		}
		
		function get_sdreport()
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			
			return DB::table("employee")
				->select("Emp_Secutity_Deposit","FirstName","MiddleName","LastName")
				->join("user","user.Uid","=","employee.Uid")
				->where("employee.Bid","=",$BID)
				->get();
		}
		
		function loan_pending_report_pl()
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			
			$today = date("Y-m-d");
			
			return DB::table("personalloan_allocation")
				->select("user.FirstName","user.MiddleName","user.LastName",DB::raw("PersLoan_Number as ln_no, RemainingLoan_Amt as rem_amt,EndDate as end_date"))
				->join("members","members.Memid","=","personalloan_allocation.MemId")
				->join("user","user.Uid","=","members.Uid")
				->where("Closed","=","NO")
				->where("EndDate","<",$today)
				->where("RemainingLoan_Amt",">",0)
				->where("personalloan_allocation.Bid","=",$BID)
				->get();
		}
		
		function loan_pending_report_jl()
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			
			$today = date("Y-m-d");
			
			
			return DB::table("jewelloan_allocation")
				->select("user.FirstName","user.MiddleName","user.LastName",DB::raw("JewelLoan_LoanNumber as ln_no, JewelLoan_LoanRemainingAmount as rem_amt,JewelLoan_EndDate as end_date"))
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->where('JewelLoan_EndDate','<=',$today)
				->where('JewelLoan_Closed','=','NO')
				->where('auction_status','=','0')
				->where('JewelLoan_Bid','=',$BID)
				->get();
		}
		
		function loan_pending_report_sl()
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			
			$today = date("Y-m-d");
			
			
			return DB::table("staffloan_allocation")
				->select("user.FirstName","user.MiddleName","user.LastName",DB::raw("StfLoan_Number as ln_no, StaffLoan_LoanRemainingAmount as rem_amt,EndDate as end_date"))
				->join("user","user.Uid","=","staffloan_allocation.Uid")
				->where('EndDate','<=',$today)
				//->where('JewelLoan_Closed','=','NO')
				->where('StaffLoan_LoanRemainingAmount','>','0')
				->where('staffloan_allocation.Bid','=',$BID)
				->get();
		}
		
		function loan_pending_report_dl($dl_type)
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			
			switch($BID) {
				case 1:	$branch_code = "%KUL%";	break;
				case 2:	$branch_code = "%TOK%";	break;
				case 3:	$branch_code = "%KRI%";	break;
				case 4:	$branch_code = "%JOK%";	break;
				case 5:	$branch_code = "%TAL%";	break;
			}
			
			$today = date("Y-m-d");
			
			return DB::table("depositeloan_allocation")
				->select("user.FirstName","user.MiddleName","user.LastName",DB::raw("DepLoan_LoanNum as ln_no, DepLoan_RemailningAmt as rem_amt,DepLoan_LoanEndDate as end_date"))
				->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
				->where("LoanClosed_State","=","NO")
				->where("DepLoan_LoanEndDate","<",$today)
				->where("DepLoan_RemailningAmt",">",0)
				->where("DepLoan_DepositeType","=",$dl_type)
				//->where("DepLoan_Bid","=",$BID)
				->where("DepLoan_LoanNum","like",$branch_code)
				->get();
		}
		
		public function edit_jl_net_wt($data)
		{
			$jewel_alloc_id = $data["jewel_alloc_id"];
			$net_wt = $data["net_wt"];
			$closed_status = $data["closed_status"];
			DB::table("jewelloan_allocation")
				->where("JewelLoanId","=",$jewel_alloc_id)
				->update(["jewelloan_Net_weight"=>$net_wt,"JewelLoan_Closed"=>$closed_status]);
				
			return;
		}
		
		public function jewel_loan_report()
		{
			$i = 0;
			$jewelloan_allocation = array();
				
				$select_array = array(
											"JewelLoanId",
											"JewelLoan_LoanNumber",
											"JewelLoan_Uid",
											"FirstName",
											"MiddleName",
											"LastName",
											"BName",
											"JewelLoan_LoanAmount",
//											"principle_paid",
//											"interest_paid",
											"JewelLoan_LoanRemainingAmount",
											"JewelLoan_StartDate",
											"JewelLoan_EndDate",
											"JewelLoan_lastpaiddate",
											"JewelLoan_Closed",
											"LoanType_Interest",
											"jewelloan_Description",
											"jewelloan_Gross_weight",
											"jewelloan_Net_weight",
											"fake_value as principle_paid",
											"fake_value as interest_paid",
											"fake_value as pending_princple",
											"fake_value as no_days_from_last_pay"
									);
			
			$jewelloan_allocation = DB::table("jewelloan_allocation")
				->select($select_array)
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->join("loan_type","loan_type.LoanType_ID","=","jewelloan_allocation.JewelLoan_LoanTypeId")
				->join("branch","branch.Bid","=","jewelloan_allocation.JewelLoan_Bid")
//				->take(5)
				->get();
				
			foreach($jewelloan_allocation as $key_jew => $row_jew) {
				$principle_paid = 0;
				$interest_paid = 0;
				
				$jewelloan_repay = DB::table("jewelloan_repay")
					->select()
					->where("jewelloan_repay.JLRepay_JLAllocID","=",$row_jew->JewelLoanId)
					->get();
				
				foreach($jewelloan_repay as $key_pay => $row_pay) {
					$principle_paid += $row_pay->JLRepay_paidtoprincipalamt;
					$interest_paid += $row_pay->JLRepay_interestpaid;
				}
				
				$date_diff1 = date_diff(date_create($row_jew->JewelLoan_lastpaiddate),date_create(date("Y-m-d")));
				$date_diff2 = date_diff(date_create($row_jew->JewelLoan_StartDate),date_create(date("Y-m-d")));
				if(! $principle_paid)
					$no_days_from_last_pay = (int) $date_diff2->format("%a");
				else
					$no_days_from_last_pay = (int) $date_diff1->format("%a");
				
				$jewelloan_allocation[$key_jew]->principle_paid = $principle_paid;
				$jewelloan_allocation[$key_jew]->interest_paid = $interest_paid;
				$jewelloan_allocation[$key_jew]->pending_princple = $row_jew->JewelLoan_LoanAmount - $principle_paid;
				$jewelloan_allocation[$key_jew]->no_days_from_last_pay = $no_days_from_last_pay;
			}
			return $jewelloan_allocation;
		}
		
		public function jewel_loan_repay_report_data($data)//pending
		{
		
			
			/*
				customer det
				+today's date 
				+customer name,
				+id,
				+address,
				-nomine/garntr,
				-----------------------------------
				allocatin detls
				(for pl consider part payment)
				+id
				+req date,
				+st date,
				+end date, 
				+sanctioned amt,
				+interest rate, 
				+post due date interest					voucher print
				----------------------------------
				
				repayment details
				+date,
				-part,
				+principle , 
				+interest, 
				+charges, 
				paid upto
				
				---------------------------------
				summary
				total paid 
				pending principle
				balance interest(interest till today)
			
			*/
		
		
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			$UID=$uname->Uid;
			
			$table = "";
			$loan_category = "JL";
			
			$loan_allocation_id = $data["loan_allocation_id"];
			
			$ret_data = array();
			$ret_data["repayments"] = array();
			
			/*
				$ret_data["today_date_dmy"]
				
				$ret_data["allocation_details"]["loan_category"]
				$ret_data["allocation_details"]["loan_allocation_id"]
				$ret_data["allocation_details"]["request_date"]
				$ret_data["allocation_details"]["start_date"]
				$ret_data["allocation_details"]["end_date"]
				$ret_data["allocation_details"]["sanctioned_amount"]
				$ret_data["allocation_details"]["interest_rate"]
				$ret_data["allocation_details"]["post_due_date_interest_rate"]
				
				
				
				$ret_data["customer_details"]["user_id"]
				$ret_data["customer_details"]["name"]
				$ret_data["customer_details"]["address"]
				$ret_data["customer_details"]["mobile"]
				$ret_data["customer_details"]["guarantor"]
				$ret_data["customer_details"]["guarantor_mobile"]
				
					//ARRAY
					$ret_data["repayments"][$i]["repayment_id"]
					$ret_data["repayments"][$i]["repayment_date"]
					$ret_data["repayments"][$i]["repayment_total_paid_amount"]
					$ret_data["repayments"][$i]["repayment_paid_principle_amount"]
					$ret_data["repayments"][$i]["repayment_paid_interest_amount"]
					$ret_data["repayments"][$i]["charges_sum"]
					$ret_data["repayments"][$i]["paid_up_to"]
					
						//ARRAY
						$ret_data["repayments"][$i]["charges"][$j]["charge_id"]
						$ret_data["repayments"][$i]["charges"][$j]["charge_amount"]
						$ret_data["repayments"][$i]["charges"][$j]["charge_name"]
				
			*/
			
			$ret_data["today_date_dmy"] = date("d-m-Y");
			
			

//		ALLOCATION DETAILS
			$table = "jewelloan_allocation";
			$allocation = DB::table($table)
				->select(
							"{$table}.JewelLoanId",
							"{$table}.JewelLoan_Uid",
							"{$table}.JewelLoan_StartDate",
							"{$table}.JewelLoan_EndDate",
							"{$table}.JewelLoan_LoanAmount",
							"{$table}.JewelLoan_lastpaiddate",
//							"request_loan.Request_Date",
							"loan_type.LoanType_Interest",
							"loan_type.loan_due_interest"
						)
//				->join("request_loan","request_loan.Request_LoanAllocted_Id","=","jewelloan_allocation.JewelLoanId")
				->join("loan_type","loan_type.LoanType_ID","=","jewelloan_allocation.JewelLoan_LoanTypeId")
				->where("JewelLoanId","=",$loan_allocation_id)
				->first();
			$ret_data["allocation_details"]["loan_category"] = $loan_category;//-
			$ret_data["allocation_details"]["loan_allocation_id"] = $allocation->JewelLoanId;//-
			$ret_data["allocation_details"]["user_id"] = $allocation->JewelLoan_Uid;//-
//			$ret_data["allocation_details"]["request_date"] = $allocation->Request_Date;
			$ret_data["allocation_details"]["start_date"] = $allocation->JewelLoan_StartDate;
			$ret_data["allocation_details"]["end_date"] = $allocation->JewelLoan_EndDate;
			$ret_data["allocation_details"]["sanctioned_amount"] = $allocation->JewelLoan_LoanAmount;
			$ret_data["allocation_details"]["interest_rate"] = $allocation->LoanType_Interest . "%";
			$ret_data["allocation_details"]["post_due_date_interest_rate"] = $allocation->loan_due_interest . "%";
//		ALLOCATION DETAILS END



			
//		CUSTOMER DETAILS
			$table = "user";
			$user = DB::table($table)
				->select(
							"{$table}.Uid",
							"{$table}.FirstName",
							"{$table}.MiddleName",
							"{$table}.LastName",
							"address.Address",
							"address.MobileNo"
						)
				->join("address","address.Aid","=","user.Aid")
				->where("Uid","=",$allocation->JewelLoan_Uid)
				->first();
				
			$ret_data["customer_details"]["user_id"] = $user->Uid;
			$ret_data["customer_details"]["name"] = "{$user->FirstName} {$user->MiddleName} {$user->LastName}";
			$ret_data["customer_details"]["address"] = $user->Address;
			$ret_data["customer_details"]["mobile"] = $user->MobileNo;
			$ret_data["customer_details"]["guarantor"] = "N/A";//JL
			$ret_data["customer_details"]["guarantor_mobile"] = "N/A";//JL
//		CUSTOMER DETAILS END




//		REPAYMENT DETAILS///////////////////////////////
			$table = "jewelloan_repay";
			$repayment = array();
			$repayment = DB::table($table)
				->select(
							"{$table}.JLRepay_Id",
							"{$table}.JLRepay_Date",
							"{$table}.JLRepay_PaidAmt",
							"{$table}.JLRepay_paidtoprincipalamt",
							"{$table}.JLRepay_interestpaid",
							"{$table}.interest_paid_upto"
						)
				->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewelloan_repay.JLRepay_JLAllocID")
				->where("jewelloan_allocation.JewelLoanId","=",$allocation->JewelLoanId)
				->orderBy("JLRepay_Id","asc")
				->get();
				
			$i = -1;
			
			
			$repay_principle_sum = 0;
			$repay_interest_sum = 0;
			foreach($repayment as $key => $row_repay) {
				$ret_data["repayments"][++$i]["repayment_id"] = $row_repay->JLRepay_Id;//-
				$ret_data["repayments"][$i]["repayment_date"] = $row_repay->JLRepay_Date;
				$ret_data["repayments"][$i]["repayment_total_paid_amount"] = $row_repay->JLRepay_PaidAmt;
				$ret_data["repayments"][$i]["repayment_paid_principle_amount"] = $row_repay->JLRepay_paidtoprincipalamt;
				$ret_data["repayments"][$i]["repayment_paid_interest_amount"] = $row_repay->JLRepay_interestpaid;
				
				$table = "charges_tran";
				$charges = array();
				$charges = DB::table($table)
					->select(
								"{$table}.charg_id",
								"{$table}.amount",
								"chareges.charges_name"
							)
					->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
					->where("{$table}.loanid","=",$allocation->JewelLoanId)
					->where("{$table}.loantype","=",$loan_category)
					->where("{$table}.loantype","=",$loan_category)
					->where("{$table}.charg_tran_date","=",$row_repay->JLRepay_Date)
					->get();
				
				$j = -1;
				$charges_sum = 0;
				foreach($charges as $key_charges => $row_charges) {
					$ret_data["repayments"][$i]["charges"][++$j]["charge_id"] = $row_charges->charg_id;
					$ret_data["repayments"][$i]["charges"][$j]["charge_amount"] = $row_charges->amount;
					$ret_data["repayments"][$i]["charges"][$j]["charge_name"] = $row_charges->charges_name;
					$charges_sum += $row_charges->amount;
				}
				$ret_data["repayments"][$i]["charges_sum"] = $charges_sum;
				$ret_data["repayments"][$i]["paid_up_to"] = $row_repay->interest_paid_upto;//"-";//$paid_up_to();
				$fn_data = array();
				$fn_data["repay_principle_sum"] = $repay_principle_sum;
				$fn_data["repay_interest_sum"] = $repay_interest_sum;
//				$this->get_paid_upto($fn_data);
				
				$repay_principle_sum += $row_repay->JLRepay_paidtoprincipalamt;
				$repay_interest_sum += $row_repay->JLRepay_interestpaid;
			}
//		REPAYMENT DETAILS END
			$ret_data["allocation_details"]["balance"] = $allocation->JewelLoan_LoanAmount - $repay_principle_sum;
			
			
			//print_r($ret_data);exit;
			return $ret_data;
			
		}
		
		public function get_paid_upto($data)
		{
			$repay_principle_sum = $data["repay_principle_sum"];
			$repay_interest_sum = $data["repay_interest_sum"];
			
		}
		
		public function GetBranchDropD() //For Branch wise Report
		{
			
			$BranchList = DB::table('branch')
				->select('Bid','BName')
//				->orderBy("Bid","desc")
				->get();
			return $BranchList;
		}
		
		public function jewel_auction_account_balance($data)
		{
			$jewel_allocation_id = $data["jewel_allocation_id"];
			
			$extra_amount = 0;
			$jewel_auction = DB::table("jewel_auction")
				->select()
				->where("JewelLoanId","=", $jewel_allocation_id)
				->first();
			$extra_amount = $jewel_auction->jewel_auction_amount - $jewel_auction->loan_deduction_amount;
//			$extra_amount = $jewel_auction->extra_amount;
			
			$total_paid_amount = 0;
			$auction_amount_transaction = DB::table("auction_amount_transaction")
				->select(DB::Raw('sum(`amt_piad`) as total_paid'))
				->where("jl_alloc_id","=",$jewel_allocation_id)
				->first();
			$total_paid_amount = $auction_amount_transaction->total_paid;
			
			$total_loan_repayment = 0;
			$jewelloan_repay = DB::table("jewelloan_repay")
				->select(DB::Raw('sum(`JLRepay_PaidAmt`) as total_loan_repay'))
				->where("JLRepay_JLAllocID","=",$jewel_allocation_id)
				->where("repay_through_auction","=","1")
				->first();
			$total_loan_repayment = $jewelloan_repay->total_loan_repay;
			
			$total_loan_charges = 0;
			$charges_tran = DB::table("charges_tran")
				->select(DB::Raw('sum(`amount`) as total_loan_charges'))
				->where("loanid","=",$jewel_allocation_id)
				->where("loantype","=","JL")
				->where("repay_through_auction","=","1")
				->first();
			$total_loan_charges = $charges_tran->total_loan_charges;
			
			$remaining_amount =  $extra_amount - $total_paid_amount - $total_loan_repayment - $total_loan_charges;
			
			return $remaining_amount;
		}
/********************************************************************************************/
		public function repay_report_data_pl($data)//pending
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;
			$UID=$uname->Uid;
			
			$table = "";
			$loan_category = $data["loan_category"];// echo $loan_category; exit();
			
			$loan_allocation_id = $data["loan_allocation_id"]; //echo $loan_allocation_id; exit();
			
			$ret_data = array();
			$ret_data["repayments"] = array();
			
			/*
				$ret_data["today_date_dmy"]
				
				$ret_data["allocation_details"]["loan_category"]
				$ret_data["allocation_details"]["loan_allocation_id"]
				$ret_data["allocation_details"]["request_date"]
				$ret_data["allocation_details"]["start_date"]
				$ret_data["allocation_details"]["end_date"]
				$ret_data["allocation_details"]["sanctioned_amount"]
				$ret_data["allocation_details"]["interest_rate"]
				$ret_data["allocation_details"]["post_due_date_interest_rate"]
				
				
				
				$ret_data["customer_details"]["user_id"]
				$ret_data["customer_details"]["name"]
				$ret_data["customer_details"]["address"]
				$ret_data["customer_details"]["mobile"]
				$ret_data["customer_details"]["guarantor"]
				$ret_data["customer_details"]["guarantor_mobile"]
				
					//ARRAY
					$ret_data["repayments"][$i]["repayment_id"]
					$ret_data["repayments"][$i]["repayment_date"]
					$ret_data["repayments"][$i]["repayment_total_paid_amount"]
					$ret_data["repayments"][$i]["repayment_paid_principle_amount"]
					$ret_data["repayments"][$i]["repayment_paid_interest_amount"]
					$ret_data["repayments"][$i]["charges_sum"]
					$ret_data["repayments"][$i]["paid_up_to"]
					
						//ARRAY
						$ret_data["repayments"][$i]["charges"][$j]["charge_id"]
						$ret_data["repayments"][$i]["charges"][$j]["charge_amount"]
						$ret_data["repayments"][$i]["charges"][$j]["charge_name"]
				
			*/
			
			$ret_data["today_date_dmy"] = date("d-m-Y");
			$ret_data["today_date_ymd"] = date("Y-m-d");
			
			

//		ALLOCATION DETAILS
			$table = "personalloan_allocation";
			$allocation = DB::table($table)
				->select(
							"{$table}.PersLoanAllocID",
							"{$table}.StartDate",
							"{$table}.EndDate",
							"{$table}.LoanAmt",
							"{$table}.caldate",
							"{$table}.EMI_Amount",
//							"request_loan.Request_Date",
							"members.Uid",
							"loan_type.LoanType_Interest",
							"loan_type.loan_due_interest"
						)
//				->join("request_loan","","=","")
				->join("members","members.Memid","=","personalloan_allocation.MemId")
				->join("loan_type","loan_type.LoanType_ID","=","personalloan_allocation.LoanType_ID")
				->where("PersLoanAllocID","=",$loan_allocation_id)
				->first();
				
			//print_r($allocation);exit();
			
			$ret_data["allocation_details"]["loan_category"] = $loan_category;//-
			$ret_data["allocation_details"]["loan_allocation_id"] = $allocation->PersLoanAllocID;//-
			$ret_data["allocation_details"]["user_id"] = $allocation->Uid;//-
//			$ret_data["allocation_details"]["request_date"] = $allocation->Request_Date;
			$ret_data["allocation_details"]["start_date"] = $allocation->StartDate;
			$ret_data["allocation_details"]["end_date"] = $allocation->EndDate;
			$ret_data["allocation_details"]["sanctioned_amount"] = $allocation->LoanAmt;
			$ret_data["allocation_details"]["interest_rate"] = $allocation->LoanType_Interest . "%";
			$ret_data["allocation_details"]["post_due_date_interest_rate"] = $allocation->loan_due_interest . "%";
			$ret_data["allocation_details"]["emi"] = $allocation->EMI_Amount;
			//print_r($ret_data);exit();
//		ALLOCATION DETAILS END



			
//		CUSTOMER DETAILS
			$table = "user";
			$user = DB::table($table)
				->select(
							"{$table}.Uid",
							"{$table}.FirstName",
							"{$table}.MiddleName",
							"{$table}.LastName",
							"address.Address",
							"address.MobileNo",
							"members.Member_no",
							"members.Memid",
							"personalloan_allocation.MEMBER_NO_FirstSurety"
						)
				->join("address","address.Aid","=","user.Aid")
				->join("members","members.Uid","=","user.Uid")
				->join("personalloan_allocation","personalloan_allocation.MemId","=","members.Memid")
				->where("user.Uid","=",$allocation->Uid)
				->first();
			$guarantor_mem_no=$user->MEMBER_NO_FirstSurety;
			$table1 = "members";
			$guarantor=DB::table($table1)
						->select(
									"{$table1}.FirstName",
									"address.Address",
									"address.MobileNo"
								)
						->join("address","address.Aid","=","members.Aid")
						->where("members.Memid","=",$guarantor_mem_no)
						->first();
			$ret_data["customer_details"]["user_id"] = $user->Uid;
			$ret_data["customer_details"]["name"] = "{$user->FirstName} {$user->MiddleName} {$user->LastName}";
			$ret_data["customer_details"]["address"] = $user->Address;
			$ret_data["customer_details"]["mobile"] = $user->MobileNo;
			$ret_data["customer_details"]["member_no"] = $user->Member_no;
							//->join("members","members.Uid","=","user.Uid")
				//->join("personalloan_allocation","personalloan_allocation.MemId","=","members.Memid")
			//query
			if(!empty($guarantor)) {
				$ret_data["customer_details"]["guarantor_name"] = $guarantor->FirstName;//PL
				$ret_data["customer_details"]["guarantor_mobile"] = $guarantor->MobileNo;//PL
				$ret_data["customer_details"]["guarantor_address"] = $guarantor->Address;//PL
			} else {
				$ret_data["customer_details"]["guarantor_name"] = "";
				$ret_data["customer_details"]["guarantor_mobile"] = "";
				$ret_data["customer_details"]["guarantor_address"] = "";
			}
			//print_r($ret_data); exit();
//		CUSTOMER DETAILS END


//		PAYMENT DETAILS
			$table = "personalloan_payment";
			$payment = array();
			$payment = DB::table($table)
				->select(
							"{$table}.pl_payment_id as payment_id",
							"{$table}.pl_payment_date as date",
							"{$table}.paid_amount as amount"
						)
				->where("{$table}.pl_allocation_id","=",$allocation->PersLoanAllocID)
				->where("{$table}.paid_status","=",1)
				->where("{$table}.deleted","=",0)
				->orderBy("pl_payment_date","asc")
				->get();
			
			$i = -1;
			foreach($payment as $key => $row_payment) {
				$ret_data["payments"][++$i]["payment_id"] = $row_payment->payment_id;
				$ret_data["payments"][$i]["date"] = $row_payment->date;
				$ret_data["payments"][$i]["amount"] = $row_payment->amount;
			}




//		REPAYMENT DETAILS///////////////////////////////
			$table = "personalloan_repay";
			$repayment = array();
			$repayment = DB::table($table)
				->select(
							"{$table}.PLRepay_Id",
							"{$table}.PLRepay_Date",
							"{$table}.PLRepay_PaidAmt",
							"{$table}.PLRepay_Amtpaidtoprincpalamt",
							"{$table}.PLRepay_PaidInterest",
							"{$table}.interest_paid_upto"
						)
				->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_repay.PLRepay_PLAllocID")
				->where("personalloan_allocation.PersLoanAllocID","=",$allocation->PersLoanAllocID)
				->where("PL_ChequeStatus",'=',0)//*cheque cleared
//				->orderBy("PLRepay_Id","desc")
				->get();
			//print_r($repayment); exit();
			$i = -1;
			
			
			$repay_principle_sum = 0;
			$repay_interest_sum = 0;
			foreach($repayment as $key => $row_repay) {
				$ret_data["repayments"][++$i]["repayment_id"] = $row_repay->PLRepay_Id;//-
				$ret_data["repayments"][$i]["repayment_date"] = $row_repay->PLRepay_Date;
				$ret_data["repayments"][$i]["repayment_total_paid_amount"] = $row_repay->PLRepay_PaidAmt;
				$ret_data["repayments"][$i]["repayment_paid_principle_amount"] = $row_repay->PLRepay_Amtpaidtoprincpalamt;
				$ret_data["repayments"][$i]["repayment_paid_interest_amount"] = $row_repay->PLRepay_PaidInterest;
				$ret_data["repayments"][$i]["interest_paid_upto"] = $row_repay->interest_paid_upto;
				
				$table = "charges_tran";
				$charges = array();
				$charges = DB::table($table)
					->select(
								"{$table}.charg_id",
								"{$table}.amount",
								"chareges.charges_name"
							)
					->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
					->where("{$table}.loanid","=",$allocation->PersLoanAllocID)
					->where("{$table}.loantype","=",$loan_category)
					->where("{$table}.charg_tran_date","=",$row_repay->PLRepay_Date)
					->get();
				//print_r($charges); exit();
				$j = -1;
				$charges_sum = 0;
				foreach($charges as $key_charges => $row_charges) {
					$ret_data["repayments"][$i]["charges"][++$j]["charge_id"] = $row_charges->charg_id;
					$ret_data["repayments"][$i]["charges"][$j]["charge_amount"] = $row_charges->amount;
					$ret_data["repayments"][$i]["charges"][$j]["charge_name"] = $row_charges->charges_name;
					$charges_sum += $row_charges->amount;
				}
				//print_r($charges_sum); exit();
				$ret_data["repayments"][$i]["charges_sum"] = $charges_sum;
//				$ret_data["repayments"][$i]["paid_up_to"] = $row_repay->interest_paid_upto;//"-";//$paid_up_to();
				
				$repay_principle_sum += $row_repay->PLRepay_Amtpaidtoprincpalamt;
				$repay_interest_sum += $row_repay->PLRepay_PaidInterest;
			}
//		REPAYMENT DETAILS END
			$ret_data["allocation_details"]["balance"] = $allocation->LoanAmt - $repay_principle_sum;
			$ret_data["allocation_details"]["repay_principle_sum"] = $repay_principle_sum;
			
			
			//print_r($ret_data);exit();
			return $ret_data;
			
		}
		
		public function save_repay_data_jl($data)
		{
			DB::table("jewelloan_repay")
				->where("JLRepay_Id","=",$data["repay_id"])
				->update(["interest_paid_upto"=>$data["int_date"]]);
				
			$JewelLoanId = DB::table("jewelloan_repay")
				->where("JLRepay_Id","=",$data["repay_id"])
				->value("JLRepay_JLAllocID");
				
			$max_jewelloan_repay = DB::table("jewelloan_repay")
				->where("JLRepay_JLAllocID","=",$JewelLoanId)
				->orderBy("JLRepay_Id","desc")
				->first();
				
			$date = $max_jewelloan_repay->interest_paid_upto;
				
			DB::table("jewelloan_allocation")
				->where("JewelLoanId","=",$JewelLoanId)
				->update(["JewelLoan_lastpaiddate"=>$date]);
		}
		
		public function save_repay_data_pl($data)
		{
			$table = "personalloan_repay";
			$p_key = "PLRepay_Id";
			DB::table($table)
				->where($p_key,"=",$data["repay_id"])
				->update(["PLRepay_Amtpaidtoprincpalamt"=>$data["principle_amount"],"PLRepay_PaidInterest"=>$data["interest_amount"],"interest_paid_upto"=>$data["int_date"]]);
		}
		
		public function calculate_jewel_interest($data)
		{
			$loan_allocation_id = $data["loan_allocation_id"];
			$today = $data["interest_upto"];
			
			echo "loan_allocation_id: $loan_allocation_id <br />";
			echo "today: $today<br />";exit();
			
			/**************** GET JL DETAILS ********************/
			$table = "jewelloan_allocation";
			$allocation = DB::table($table)
				->select(
							"{$table}.JewelLoanId",
							"{$table}.JewelLoan_Uid",
							"{$table}.JewelLoan_StartDate",
							"{$table}.JewelLoan_EndDate",
							"{$table}.JewelLoan_LoanAmount",
							"{$table}.JewelLoan_lastpaiddate",
							"loan_type.LoanType_Interest",
							"loan_type.loan_due_interest"
						)
				->join("loan_type","loan_type.LoanType_ID","=","jewelloan_allocation.JewelLoan_LoanTypeId")
				->where("JewelLoanId","=",$loan_allocation_id)
				->first();
			print_r($allocation); exit();
			
			$user_id = $allocation->JewelLoan_Uid;
			$start_date = $allocation->JewelLoan_StartDate;
			$end_date = $allocation->JewelLoan_EndDate;
			$loan_amount = $allocation->JewelLoan_LoanAmount;
			$balance_amount = $allocation->JewelLoan_LoanRemainingAmount;
			$interest_in_number = $allocation->LoanType_Interest;
			$due_interest_in_number = $allocation->loan_due_interest;
			/**************** GET JL DETAILS END ********************/
			
			
			
			/********** CHECK FOR 1ST REPAY **********/
			$fn_data["jlaccid"] = $loan_allocation_id;
			$is_jl_first_repay_done = $this->is_jl_first_repay_done($fn_data);//true/false
			unset($fn_data);
			var_dump($is_jl_first_repay_done);exit();
			/********** CHECK FOR 1ST REPAY END **********/
			
			
			/********** get interest paid upto **********/
			if($is_jl_first_repay_done) {
				$jewelloan_repay = DB::table("jewelloan_repay")
					->where("JLRepay_JLAllocID","=",$loan_allocation_id)
					->orderBy("","desc")
					->first();
				$last_date = $jewelloan_repay->interest_paid_upto;
			} else {
				$last_date = $start_date;
			}
			echo "last_date: $last_date <br />"; exit();
			/********** get interest paid upto END **********/
			
			
			
			$days = 0;
			$due_days = 0;
			$fn_data["first"] = $today;
			$fn_data["second"] = $end_date;
			$is_today_gt_end = $this->dateComp($fn_data);//true/false
			unset($fn_data);
			if($is_today_gt_end) {//CONSIDER DUE DAYS
			
				echo "is_today_gt_end: $is_today_gt_end <br />";
				$fn_data["first"] = $last_date;
				$fn_data["second"] = $end_date;
					$is_lastdate_gt_enddate = $this->dateComp($fn_data);//true/false
				unset($fn_data);
				if($is_lastdate_gt_enddate) {//CONSIDER DUE DAYS - LAST PAID   AFTER   END DATE  -  ALL DAYS ARE DUE DAYS
					echo "***** CONSIDER DUE DAYS - LAST PAID   AFTER   END DATE  -  ALL DAYS ARE DUE DAYS *******<br />";
					$fn_data["first"] = $last_date;
					$fn_data["second"] = $today;
						$due_days = $this->dateDiff($fn_data);
					unset($fn_data);
				} else {//CONSIDER DUE DAYS - LAST PAID   BEFORE   END DATE  -  DAYS+DUE_DAYS
					echo "***** CONSIDER DUE DAYS - LAST PAID   BEFORE   END DATE  -  DAYS+DUE_DAYS *******<br />";
					$fn_data["first"] = $last_date;
					$fn_data["second"] = $end;
						$days = $this->dateDiff($fn_data);
					unset($fn_data);
					$fn_data["first"] = $last_date;
					$fn_data["second"] = $today;
						$due_days = $this->dateDiff($fn_data);
					unset($fn_data);
					if($is_jl_first_repay_done == false) {//FIRST REPAY +1
						$days++;
					}
				}
			} else {//DO NOT CONSIDER DUE DAYS
				echo "***** DO NOT CONSIDER DUE DAYS *******<br />";
				$fn_data["first"] = $last_date;
				$fn_data["second"] = $today;
					$days = $this->dateDiff($fn_data);
				unset($fn_data);
				if($is_jl_first_repay_done == false) {//FIRST REPAY +1
					$days++;
				}
			}
				
			echo "***** days: $days<br />";
			echo "***** due days: $due_days<br />"; exit();
			
			
			$fn_data["days"] = $days;
			$fn_data["interest_rate"] = $interest_in_number;
			$fn_data["balance_amount"] = $balance_amount;
			$normal_interest = $this->interest_calc($fn_data);
			
			$fn_data["days"] = $due_days;
			$fn_data["interest_rate"] = $due_interest_in_number;
			$due_interest = $this->interest_calc($fn_data);
			echo "***** end ******<br />";
			
		}
		
		public function is_jl_first_repay_done($data)
		{
			echo "************is_jl_first_repay_done***************<br />";exit();
			$n = 0;
			$jlaccid = $data['jlaccid'];
			$jl_repay = DB::table('jewelloan_repay')
				->select()
				->where('JLRepay_JLAllocID','=',$jlaccid)
				->get();
			$n = count($jl_repay);
//			var_dump($n);
			if($n > 0) {
				echo "true <br />";
				return true;
			} else {
				echo "false <br />";
				return false;
			}
		}
		
		public function dateComp($data)
		{
			echo "************dateComp***************<br />";exit();
			$first = $data['first'];
			$second = $data['second'];
			if(strtotime($first) > strtotime($second)) {
				echo "dateComp=true <br />";
				return true;
			} else {
				echo "dateComp=false <br />";
				return false;
			}
		}
		
		public function dateDiff($data)
		{
			$first = $data['first'];
			$second = $data['second'];
			$first_date = date_create($first);
			$second_date = date_create($second);
			$diff = date_diff($first_date,$second_date);
			$diff_days = $diff->format('%a');
			$days = (int)$diff_days;
			
			return $days;
		}
		
		//used for jl and pl
		public function interest_calc($data)//	_/
		{
//			echo "<br />\n************interest_calc***************<br />\n";//exit();
			$this->cl("<br />\n************interest_calc***************<br />\n");
			if(isset($data['msg']))
//				echo "msg: {$data['msg']} <br />\n";//exit();
			$this->cl("msg: {$data['msg']} <br />\n");
			$days = $data["days"];
//			echo "days=$days <br />\n";
			$this->cl("days=$days <br />\n");
			$years = $days / 365;
			$interest_rate_in_number = $data["interest_rate"];
			$interest_rate = $interest_rate_in_number / 100;
//			echo "interest_rate=$interest_rate <br />\n";
			$this->cl("interest_rate=$interest_rate <br />\n");
			$balance_amount = $data["balance_amount"];
//			echo "balance_amount=$balance_amount <br />\n";
			$this->cl("balance_amount=$balance_amount <br />\n");
			$interest_amount = round($balance_amount * $years * $interest_rate);
//			echo "interest_amount=$interest_amount <br />\n";
			$this->cl("interest_amount=$interest_amount <br />\n");
//			echo "<br />\n************interest_calc end***************<br />\n";//exit();
			$this->cl("<br />\n************interest_calc end***************<br />\n");
			return $interest_amount;
		}
		
		public function interest_calc_pl($data)
		{
			$this->cl_clear();
			$loan_allocation_id = $data["loan_allocation_id"];
			$loan_allocation_id_field = "PersLoanAllocID";
			$interest_upto = $data["interest_upto"];//not related to due interest
			$this->cl("interest_upto: $interest_upto\n");
			$today = date("Y-m-d");
			$normal_interest = 0;
			$due_interest = 0;
			
			
			
			//print_r($data);exit();//check for today's date and old date
			
			/**************** GET PL DETAILS ********************/
			$table = "personalloan_allocation";
			$allocation = DB::table($table)
				->select(
							"{$table}.{$loan_allocation_id_field}",
							"{$table}.StartDate",
							"{$table}.EndDate",
							"{$table}.LoanAmt",
							"{$table}.caldate",
							"{$table}.EMI_Amount",
							"{$table}.RemainingLoan_Amt",
							"members.Uid",
							"loan_type.LoanType_Interest",
							"loan_type.loan_due_interest"
						)
				->join("members","members.Memid","=","personalloan_allocation.MemId")
				->join("loan_type","loan_type.LoanType_ID","=","personalloan_allocation.LoanType_ID")
				->where($loan_allocation_id_field,"=",$loan_allocation_id)
				->first();
			//print_r($allocation); exit();
			
			$user_id = $allocation->Uid;
			$start_date = $allocation->StartDate;
			$end_date = $allocation->EndDate;
			$loan_amount = $allocation->LoanAmt;
			$balance_amount = $loan_amount - $this->paid_principle_amt(["loan_allocation_id"=>$loan_allocation_id,'loan_category'=>"PL"]);
//			$balance_amount = $allocation->RemainingLoan_Amt;
			$interest_in_number = $allocation->LoanType_Interest;
			$due_interest_in_number = $allocation->loan_due_interest;
			$emi = $allocation->EMI_Amount;
			//echo "balance amount: {$balance_amount}<br />\n";exit();
			/**************** GET PL DETAILS END ********************/
			
			
			
			
			
			
			/********** CHECK FOR 1ST REPAY **********/
			$fn_data["loan_allocation_id"] = $loan_allocation_id;
			$fn_data["loan_category"] = "PL";
			$is_first_repay_done = $this->is_first_repay_done($fn_data);//true/false
			unset($fn_data);
			//var_dump($is_first_repay_done);exit();
			/********** CHECK FOR 1ST REPAY END **********/
			
			/********** get interest paid upto **********/
			if($is_first_repay_done) {
				$personalloan_repay = DB::table("personalloan_repay")
					->where("PLRepay_PLAllocID","=",$loan_allocation_id)
					->where("PL_ChequeStatus","=",0)
					->orderBy("PLRepay_Date","desc")
					->first();
				$last_date = $personalloan_repay->interest_paid_upto;
			} else {
				$last_date = $start_date;
			}
			if($last_date == "0000-00-00") {
//				echo "last paid date is not valid (0000-00-00)\n";
				$this->cl("last paid date is not valid (0000-00-00)\n");
				return ["int"=>"last paid date is not valid (0000-00-00)","remaining_amount"=>$balance_amount];
			}
//			echo "last_date: $last_date <br />\n"; exit();
			/********** get interest paid upto END **********/
			
			/********** get interest paid upto **********/
			$personalloan_repay = DB::table("personalloan_repay")
				->where("PLRepay_PLAllocID","=",$loan_allocation_id)
				->where("PL_ChequeStatus","=",0)
				->where("PLRepay_Amtpaidtoprincpalamt",">",0)
				->orderBy("PLRepay_Date","desc")
				->first();
					
			if($personalloan_repay) {
				$last_pricliple_paid_date = $personalloan_repay->PLRepay_Date;
			} else {
				$last_pricliple_paid_date = $start_date;
			}
			$this->cl("last_pricliple_paid_date = {$last_pricliple_paid_date}\n");
//			echo "last_pricliple_paid_date: $last_pricliple_paid_date <br />\n"; //exit();
			/********** get interest paid upto END **********/
			
			
/***************PART PAYMENT****************/
			$total_interest = 0;
			$part_pay_interest = 0;
			$personalloan_payment = DB::table("personalloan_payment")
				->select()
				->where("pl_allocation_id","=",$loan_allocation_id)
				->get();
				
			$count = count($personalloan_payment);
			
			if($count > 1) {//consider part payment
				if(!empty($personalloan_repay)) {//atleast 1 repay done
					$personalloan_repay = DB::table("personalloan_repay")
						->select()
						->where("PLRepay_PLAllocID","=",$loan_allocation_id)
						->where("PL_ChequeStatus","=",0)
						->orderBy("PLRepay_Date","desc")
						->first();
					$last_repay_date = $personalloan_repay->PLRepay_Date;
					$total_repay_amount = DB::table("personalloan_repay")
						->where("PLRepay_PLAllocID","=",$loan_allocation_id)
						->where("PL_ChequeStatus","=",0)
						->sum("PLRepay_Amtpaidtoprincpalamt");
						
					$total_paid_before_last_repayment = DB::table("personalloan_payment")
						->where("pl_allocation_id","=",$loan_allocation_id)
						->where("pl_payment_date","<",$last_repay_date)
						->where("paid_status","=",1)
						->where("deleted","=",0)
						->sum("paid_amount");
						
					$fn_data["first"] = $last_repay_date;
					$fn_data["second"] = $interest_upto;
					$days = $this->dateDiff($fn_data);
					unset($fn_data);
					
					$fn_data["msg"] = "part payment 1";
					$fn_data["days"] = $days;
					$fn_data["interest_rate"] = $interest_in_number;
					$fn_data["balance_amount"] = $total_paid_before_last_repayment - $total_repay_amount;
					
					$old_amount_interest = $this->interest_calc($fn_data);
					$total_interest += $old_amount_interest;
					unset($fn_data);
					//------------------------------------------------------------------------
					$personalloan_payment_after_last_repay = DB::table("personalloan_payment")
						->select(DB::raw('sum(paid_amount) as paid_amount_on_date'),'pl_payment_date')
						->where("pl_allocation_id","=",$loan_allocation_id)
						->where("pl_payment_date",">",$last_repay_date)
						->where("paid_status","=",1)
						->where("deleted","=",0)
						->groupBy("pl_payment_date")
						->orderBy("pl_payment_date","asc")
						->first();
					
					while(!empty($personalloan_payment_after_last_repay)) {
						$prev_payment_date = $personalloan_payment_after_last_repay->pl_payment_date;
						
						$fn_data["first"] = $personalloan_payment_after_last_repay->pl_payment_date;
						$fn_data["second"] = $interest_upto;
						$days = $this->dateDiff($fn_data);
						unset($fn_data);
						$fn_data["msg"] = "part payment 2";
						$fn_data["days"] = $days + 1;//1st repayment for this amount
						$fn_data["interest_rate"] = $interest_in_number;
						$fn_data["balance_amount"] = $personalloan_payment_after_last_repay->paid_amount_on_date;
						$total_interest += $this->interest_calc($fn_data);
						unset($fn_data);
						
						$personalloan_payment_after_last_repay = DB::table("personalloan_payment")
							->select()
							->where("pl_allocation_id","=",$loan_allocation_id)
							->where("pl_payment_date",">",$prev_payment_date)
							->where("paid_status","=",1)
							->where("deleted","=",0)
							->groupBy("pl_payment_date")
							->orderBy("pl_payment_date","asc")
							->first();
						//return $total_interest;
					}//end of while
				} else {//no repayments
					$personalloan_payment = DB::table("personalloan_payment")
						->select(DB::raw('sum(paid_amount) as paid_amount_on_date'),'pl_payment_date')
						->where("pl_allocation_id","=",$loan_allocation_id)
						->where("paid_status","=",1)
						->where("deleted","=",0)
						->groupBy("pl_payment_date")
						->orderBy("pl_payment_date","asc")
						->first();
					
				//	print_r($personalloan_payment);
					
					while(!empty($personalloan_payment)) {
//						print_r($personalloan_payment);
						$prev_payment_date = $personalloan_payment->pl_payment_date;
						
						$fn_data["first"] = $personalloan_payment->pl_payment_date;
						$fn_data["second"] = $interest_upto;
						$days = $this->dateDiff($fn_data);
						unset($fn_data);
						$fn_data["msg"] = "part payment 3";
						$fn_data["days"] = $days + 1;//first repayment
						$fn_data["interest_rate"] = $interest_in_number;
						$fn_data["balance_amount"] = $personalloan_payment->paid_amount_on_date;
						$total_interest += $this->interest_calc($fn_data);
						unset($fn_data);
						
						$personalloan_payment = DB::table("personalloan_payment")
							->select(DB::raw('sum(paid_amount) as paid_amount_on_date'),'pl_payment_date')
							->where("pl_allocation_id","=",$loan_allocation_id)
							->where("pl_payment_date",">",$prev_payment_date)
							->where("paid_status","=",1)
							->where("deleted","=",0)
							->groupBy("pl_payment_date")
							->orderBy("pl_payment_date","asc")
							->first();
//						return $total_interest;
					}
				}//no repayments
				$part_pay_interest = $total_interest;
			}//CONSIDER PART PAYMENT END
/***************PART PAYMENT END***************/
			else
/********** Normal interest calculation (due int not included) **********/
			{
				$fn_data["first"] = $last_date;
				$fn_data["second"] = $interest_upto;
//				print_r($fn_data);
//				$this->cl($fn_data);
					$days = $this->dateDiff($fn_data);
				unset($fn_data);
//				echo "days: $days <br />\n"; exit();
				
				if(!$is_first_repay_done) {
					$days++;
				}
//				echo "days: $days <br />\n"; //exit();
				
				$fn_data["msg"] = "normal interest calculation";
				$fn_data["days"] = $days;
				$fn_data["interest_rate"] = $interest_in_number;
				$fn_data["balance_amount"] = $balance_amount;
//				print_r($fn_data); //exit();
					$normal_interest = $this->interest_calc($fn_data);
				unset($fn_data);
//				echo "normal_interest: $normal_interest <br />\n"; exit();
			}
/********** Normal interest calculation (due int not included) **********/
			
/********** Due interest calculation **********/
				
			$fn_data["start_date"] = $start_date;
			$fn_data["end_date"] = $end_date;
				$total_no_of_installments = $this->total_no_of_installments($fn_data);
				$total_emi_amount = $total_no_of_installments * $emi;
				$extra_emi_amount = $total_emi_amount - $loan_amount;//EXTRA EMI AMOUNT
				$this->cl("extra_emi_amount: $extra_emi_amount <br />\n");
			unset($fn_data);
			
			if($is_first_repay_done) {
				$fn_data["loan_allocation_id"] = $loan_allocation_id;
				$fn_data["loan_category"] = "PL";
					$paid_installment_amt = $this->paid_principle_amt($fn_data);
				unset($fn_data);
			} else {
				$paid_installment_amt = 0;
			}
//			echo "paid_installment_amt: $paid_installment_amt <br />\n"; //exit();
			$this->cl("paid_installment_amt: $paid_installment_amt <br />\n");
			$fn_data["start_date"] = $start_date;
			$fn_data["end_date"] = $end_date;
			$fn_data["today"] = $today;
//			print_r($fn_data);//exit();
				$current_installment_no = $this->current_installment_no($fn_data);
			unset($fn_data);
//			echo "current_installment_no: $current_installment_no <br />\n"; //exit();
			$this->cl("current_installment_no: $current_installment_no <br />\n");
			
			$installment_amt_till_today = $current_installment_no * $emi;
			$this->cl("emi: $emi \n");
			if($current_installment_no == $total_no_of_installments-1) {
				$this->cl("current_installment_no == total_no_of_installments-1<br />\n");
				$installment_amt_till_today -= $extra_emi_amount / 2;
			} elseif($current_installment_no == $total_no_of_installments) {
				$installment_amt_till_today -= $extra_emi_amount;
				$this->cl("current_installment_no == total_no_of_installments<br />\n");
			}
//			echo "installment_amt_till_today: $installment_amt_till_today <br />\n";// exit();
			$this->cl("installment_amt_till_today: $installment_amt_till_today <br />\n");
			
			$min_emi_diff = $emi * 2;
			$emi_diff = $installment_amt_till_today - $paid_installment_amt;
//			echo "min_emi_diff(Not more than 2 installments): $min_emi_diff <br />\n"; //exit();
//			echo "emi_diff: $emi_diff <br />\n"; //exit();
			
			if($emi_diff > $min_emi_diff) {//CONSIDER DUE INTEREST
//				echo "<br />\n****CONSIDER DUE INTEREST****<br />\n\n";//exit();
				$fn_data["first"] = $last_pricliple_paid_date;
				$fn_data["second"] = $today;
					$due_days = $this->dateDiff($fn_data);
				unset($fn_data);
				if(!$is_first_repay_done) {
					$due_days++;
				}
//				echo "due_days: {$due_days} <br />\n";//exit();
				
				$fn_data["msg"] = "due interest calculation";
				$fn_data["days"] = $days;//$due_days;
				$fn_data["interest_rate"] = $due_interest_in_number;
				$fn_data["balance_amount"] = $emi_diff;
//				print_r($fn_data);//exit();
				$due_interest = $this->interest_calc($fn_data);
//				echo "*****due_interest_amount: {$due_interest} <br />\n<br />\n<br />\n";exit();
			} else {
//				echo "<br />\n**** 0  DUE INTEREST ****<br />\n";
			}
/********** Due interest calculation End **********/
			$this->cl($normal_interest + $due_interest + $part_pay_interest);
			$ret_data["int"] = $normal_interest + $due_interest + $part_pay_interest;
			$ret_data["pending_emi"] = $emi_diff;
			$ret_data["remaining_amount"] = $balance_amount;
			return $ret_data;
		}
		
		public function is_first_repay_done($data)//		_/
		{
			//echo "****is_first_repay_done****<br />\n";
			$n = 0;
			$loan_allocation_id = $data['loan_allocation_id'];
			switch($data['loan_category']) {
				case "PL":
							$table = "personalloan_repay";
							$loan_id_field = "PLRepay_PLAllocID";
							$cheque_cleared_status_field = "PL_ChequeStatus";
							break;
				case "JL":
							$table = "jewelloan_repay";
							$loan_id_field = "JLRepay_JLAllocID";
							$cheque_cleared_status_field = "JL_Status";
							break;
				case "DL":
							$table = "depositeloan_repay";
							$loan_id_field = "DLRepay_DepAllocID";
							$cheque_cleared_status_field = "Dl_Cheque_Status";
							break;
			}
			$repay = DB::table($table)
				->select()
				->where($loan_id_field,'=',$loan_allocation_id)
				->where($cheque_cleared_status_field,'=',0)
				->get();
			$n = count($repay);
			if($n > 0) {
				//echo "*{$loan_allocation_id}-true* <br />\n";//exit();
				//echo "****is_first_repay_done end****<br />\n";
				return true;
			} else {
				//echo "*{$loan_allocation_id}-false* <br />\n";//exit();
				//echo "****is_first_repay_done end****<br />\n";
				return false;
			}
		}
		
		public function paid_principle_amt($data)//	_/
		{
			//echo "****paid_installment_amt****<br />\n";
			$loan_allocation_id = $data['loan_allocation_id'];
			
			switch($data['loan_category']) {
				case "PL":
							$table = "personalloan_repay";
							$loan_id_field = "PLRepay_PLAllocID";
							$cheque_cleared_status_field = "PL_ChequeStatus";
							$principle_amount_field = "PLRepay_Amtpaidtoprincpalamt";
							break;
				case "JL":
							$table = "jewelloan_repay";
							$loan_id_field = "JLRepay_JLAllocID";
							$cheque_cleared_status_field = "JL_Status";
							$principle_amount_field = "JLRepay_paidtoprincipalamt";
							break;
				case "DL":
							$table = "depositeloan_repay";
							$loan_id_field = "DLRepay_DepAllocID";
							$cheque_cleared_status_field = "Dl_Cheque_Status";
							$principle_amount_field = "DLRepay_PrincipalPaid";
							break;
			}
			
			$sum = 0;//paid to principle amt
			if($this->is_first_repay_done(["loan_allocation_id"=>$loan_allocation_id,'loan_category'=>$data['loan_category']])) {
				
				$repay = DB::table($table)
					->select("{$principle_amount_field} as principle_amount_paid")
					->where($loan_id_field,'=',$loan_allocation_id)
					->where($cheque_cleared_status_field,'=',0)//*cheque cleared
					->get();
				foreach($repay as $key_repay => $row_repay) {
					$sum += $row_repay->principle_amount_paid;
				}
			}
			//echo "sum: {$sum}<br />\n";
			//echo "****paid_installment_amt end****<br />\n";
			return $sum;
		}
		
		public function current_installment_no($data)//verify this function for all cases
		{
			$start_date = $data["start_date"];
			$end_date = $data["end_date"];
			$today = $data["today"];
			
			$st_arr = explode("-",$start_date);
			$st_d = $st_arr[2];
			$st_m = $st_arr[1];
			$st_y = $st_arr[0];
			
			$temp_date = $start_date;
			$temp_arr = explode("-",$temp_date);
			$temp_d = $temp_arr[2];
			$temp_m = $temp_arr[1];
			$temp_y = $temp_arr[0];
			
			$installment_no = 0; // |----|----|----|					time
								//	ST 1    2    3 ED				installment_nos for repayment
			
			while($temp_date < $today && $temp_date < $end_date) {//test this section
				$installment_no++;
				$temp_m++;
				if($temp_m == 13) {
					$temp_m = 1;
					$temp_y++;
				}
				$temp_time_string = "{$temp_y}-{$temp_m}-{$temp_d}";
				$temp_date = date("Y-m-d",strtotime($temp_time_string));
//				echo "<br />\ntemp_date: {$temp_date} ";
			}
			
//			echo "<br />\n";
			if($temp_date < $end_date) {
				return $installment_no - 1;
			} else {
				return $installment_no;
			}
		}
		
		public function total_no_of_installments($data)
		{
			$start_date = $data["start_date"];
			$end_date = $data["end_date"];
			
			$st_arr = explode("-",$start_date);
			$st_d = $st_arr[2];
			$st_m = $st_arr[1];
			$st_y = $st_arr[0];
			$en_arr = explode("-",$end_date);
			$en_d = $en_arr[2];
			$en_m = $en_arr[1];
			$en_y = $en_arr[0];
			
			$months = $en_m - $st_m + ($en_y - $st_y) * 12;
//			$this->cl(var_dump($months));exit();
			return $months;
		}
		
		public function cl($var)
		{	
			$file = fopen("a.txt","a");
			$content = "\n" . json_encode($var);
			fwrite($file,$content);
		}
		
		public function cl_clear()
		{	
			$file = fopen("a.txt","w");
			fwrite($file,"");
		}
		
		public function charges_transaction_report($data)
		{
			$ret_data = array();
			$table = "charges_tran";
			$charges_tran = DB::table($table)
				->select(
							"{$table}.amount",
							"{$table}.charg_tran_date",
							"chareges.charges_name"
						)
				->join("chareges","chareges.charges_id","=","{$table}.charges_id")
				->where("loanid","=",$data["loan_allocation_id"])
				->where("loantype","=",$data["loan_category"])
				->where("charg_tran_date","=",$data["charges_date"])
				->where("repay_through_auction","=",0)
				->get();
			$i = -1;
			
			foreach($charges_tran as $key_ch => $row_ch) {
				$ret_data[++$i]["charg_tran_date"] = $row_ch->charg_tran_date;
				$ret_data[$i]["charges_name"] = $row_ch->charges_name;
				$ret_data[$i]["amount"] = $row_ch->amount;
			}
			return $ret_data;
		}
		
		public function get_interest_paid_upto($data) {
			$is_first_repay_done = $this->is_first_repay_done(['loan_allocation_id'=>$data['loan_id'],'loan_category'=>$data['loan_category']]);
			switch($data['loan_category']) {
				case "JL":
							$table = "jewelloan_repay";
							$loan_id_field = "JLRepay_JLAllocID";
							$cheque_cleared_status_field = "JL_Status";
							$date_field = "JLRepay_Date";
							break;
				case "PL":
							$table = "personalloan_repay";
							$loan_id_field = "PLRepay_PLAllocID";
							$cheque_cleared_status_field = "PL_ChequeStatus";
							$date_field = "PLRepay_Date";
							break;
		/*		case "DL":
							$table = "depositeloan_repay";
							$loan_id_field = "DLRepay_DepAllocID";
							$cheque_cleared_status_field = "Dl_Cheque_Status";
							$date_field = "DLRepay_Date";
							break;*/
			}
			if($is_first_repay_done) {
				$repay = DB::table($table)
					->where($loan_id_field,"=",$data['loan_id'])
					->where($cheque_cleared_status_field,"=",0)
					->orderBy($date_field,"desc")
					->first();
				$interest_paid_upto = $repay->interest_paid_upto;
			} else {//$data['start_date'] is optional
				if(!isset($data['start_date'])) {
					switch($data['loan_category']) {
						case "JL":
									$table = "jewelloan_allocation";
									$loan_id_field = "JewelLoanId";
									$start_date_field = "JewelLoan_StartDate";
									break;
						case "PL":
									$table = "personalloan_allocation";
									$loan_id_field = "PersLoanAllocID";
									$start_date_field = "StartDate";
									break;
				/*		case "DL":
									$table = "personalloan_allocation";
									$loan_id_field = "PersLoanAllocID";
									$start_date_field = "StartDate";
									break;*/
					}
					$interest_paid_upto = DB::table($table)
						->where($loan_id_field,"=",$data['loan_id'])
						->value($start_date_field);
				} else {
					$interest_paid_upto = $data['start_date'];
				}
			}
			return $interest_paid_upto;
		}
		
		public function account_list_jl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data['loan_details'] = array();
			$ret_data['loan_category'] = $data["category"];
			$table = "jewelloan_allocation";
			$closed_field = "JewelLoan_Closed";
			$branch_id_field = "JewelLoan_Bid";
			$user_id_field = "JewelLoan_Uid";
			$loan_id_field = "JewelLoanId";
			$select_array = array(
									"{$table}.JewelLoanId as loan_id",
									"{$table}.JewelLoan_LoanNumber as loan_no",
									"{$table}.jewelloan_Oldloan_No as loan_old_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.JewelLoan_LoanAmount as loan_amount",
									"{$table}.JewelLoan_StartDate as start_date",
									"{$table}.JewelLoan_EndDate as end_date",
									"{$table}.JewelLoan_Closed as closed",
									"{$table}.auction_status as auction_status",
									"{$table}.jewelloan_Description as jewel_description",
									"{$table}.jewelloan_Net_weight as net_weight"
								);
			$account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$table}.{$user_id_field}");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$account_list = $account_list->where($branch_id_field,"=",$BID);
			}
			if(!empty($data['loan_id'])) {
				$account_list = $account_list->where($loan_id_field,'=',$data['loan_id']);
			} else {
				$account_list = $account_list->where($closed_field,"=",$data['closed']);
			}
			$account_list = $account_list//->limit(1)
										->get();
				
			if(empty($account_list)) {
				return $ret_data;
			}
			
			$i = -1;
			foreach($account_list as $row) {
				$ret_data['loan_details'][++$i]['loan_id'] = $row->loan_id;
				$ret_data['loan_details'][$i]['loan_no'] = $row->loan_no;
				$ret_data['loan_details'][$i]['loan_old_no'] = $row->loan_old_no;
				$ret_data['loan_details'][$i]['user_id'] = $row->user_id;
				$ret_data['loan_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['loan_details'][$i]['loan_amount'] = $row->loan_amount;
				$ret_data['loan_details'][$i]['start_date'] = $row->start_date;
				$ret_data['loan_details'][$i]['end_date'] = $row->end_date;
				$ret_data['loan_details'][$i]['jewel_description'] = $row->jewel_description;
				$ret_data['loan_details'][$i]['net_weight'] = $row->net_weight;
				if($row->auction_status == 1 || $row->auction_status == 2) {
					$ret_data['loan_details'][$i]['closed'] = "Auctioned";
				} else {
					$ret_data['loan_details'][$i]['closed'] = $row->closed;
				}
				$ret_data['loan_details'][$i]['paid_principle_amt'] = $this->paid_principle_amt([
																								"loan_allocation_id"=>$row->loan_id,
																								"loan_category"=>$data['category']
																							]);
				$ret_data['loan_details'][$i]['ramaining_amount'] = $row->loan_amount - $ret_data['loan_details'][$i]['paid_principle_amt'];
				$fn_data = array(
										'loan_id'=>$row->loan_id,
										'loan_category'=>$data["category"],
										'start_date'=>$row->start_date//optional
									);
				$ret_data['loan_details'][$i]['interest_paid_upto'] = $this->get_interest_paid_upto($fn_data);
				unset($fn_data);
			}
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function account_list_pl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data['loan_details'] = array();
			$ret_data['loan_category'] = $data["category"];
			$table = "personalloan_allocation";
			$closed_field = "Closed";
			$branch_id_field = "{$table}.Bid";
			$loan_id_field = "PersLoanAllocID";
			$select_array = array(
									"{$table}.PersLoanAllocID as loan_id",
									"{$table}.PersLoan_Number as loan_no",
									"{$table}.Old_PersLoan_Number as loan_old_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.LoanAmt as loan_amount",
									"{$table}.StartDate as start_date",
									"{$table}.EndDate as end_date",
									"{$table}.Closed as closed",
									"{$table}.EMI_Amount as emi",
									"{$table}.LoanType_ID as loan_type_id"
								);
			$account_list = DB::table($table)
				->select($select_array)
				->join("members","members.Memid","=","{$table}.MemId")
				->join("user","user.Uid","=","members.Uid");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$account_list = $account_list->where($branch_id_field,"=",$BID);
			}
			if(!empty($data['loan_id'])) {
				$account_list = $account_list->where($loan_id_field,'=',$data['loan_id']);
			} else {
				$account_list = $account_list->where($closed_field,"=",$data['closed']);
			}
			$account_list = $account_list//->limit(1)
										->get();
			
			if(empty($account_list)) {
				return $ret_data;
			}
			
			
			$i = -1;
			foreach($account_list as $row) {
				$ret_data['loan_details'][++$i]['loan_id'] = $row->loan_id;
				$ret_data['loan_details'][$i]['loan_no'] = $row->loan_no;
				$ret_data['loan_details'][$i]['loan_old_no'] = $row->loan_old_no;
				$ret_data['loan_details'][$i]['user_id'] = $row->user_id;
				$ret_data['loan_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['loan_details'][$i]['loan_amount'] = $row->loan_amount;
				$ret_data['loan_details'][$i]['start_date'] = $row->start_date;
				$ret_data['loan_details'][$i]['end_date'] = $row->end_date;
				$ret_data['loan_details'][$i]['closed'] = $row->closed;
				$ret_data['loan_details'][$i]['emi'] = $row->emi;
				$ret_data['loan_details'][$i]['loan_type_id'] = $row->loan_type_id;
				$ret_data['loan_details'][$i]['paid_principle_amt'] = $this->paid_principle_amt([
																								"loan_allocation_id"=>$row->loan_id,
																								"loan_category"=>$data['category']
																							]);
				$ret_data['loan_details'][$i]['ramaining_amount'] = $row->loan_amount - $ret_data['loan_details'][$i]['paid_principle_amt'];
				$fn_data = array(
										'loan_id'=>$row->loan_id,
										'loan_category'=>$data["category"],
										'start_date'=>$row->start_date//optional
									);
				$ret_data['loan_details'][$i]['interest_paid_upto'] = $this->get_interest_paid_upto($fn_data);
				unset($fn_data);
			}
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function account_list_pl_edit($data)
		{
			$table = "personalloan_allocation";
			$allocation_id_field = "{$table}.PersLoanAllocID";
			$closed_field = "closed";
			
			$update_array = array(
										"{$closed_field}"=>$data["closed"]
								);
			
			DB::table($table)
				->where($allocation_id_field,'=',$data['loan_id'])
				->update($update_array);
		}
		
		public function account_list_dl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data['loan_details'] = array();
			$ret_data['loan_category'] = $data["category"];
			$table = "depositeloan_allocation";
			$closed_field = "LoanClosed_State";
			$branch_id_field = "{$table}.DepLoan_Branch";
			$loan_id_field = "DepLoanAllocId";
			$user_id_field = "DepLoan_Uid";
			
			$select_array = array(
									"{$table}.DepLoanAllocId as loan_id",
									"{$table}.DepLoan_LoanNum as loan_no",
									"{$table}.Old_loan_number as loan_old_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.DepLoan_LoanAmount as loan_amount",
									"{$table}.DepLoan_LoanStartDate as start_date",
									"{$table}.DepLoan_LoanEndDate as end_date",
									"{$table}.LoanClosed_State as closed"
								);
			$account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$table}.{$user_id_field}");
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$account_list = $account_list->where($branch_id_field,"=",$BID);
				}
			if(!empty($data['loan_id'])) {
				$account_list = $account_list->where($loan_id_field,'=',$data['loan_id']);
			} else {
				if($data['closed'] == "NO") {
					$account_list = $account_list->whereIn($closed_field,[$data['closed'],""]);
				} else {
					$account_list = $account_list->where($closed_field,"=",$data['closed']);
				}
			}
			$account_list = $account_list//->limit(1)
										->get();
//			print_r($account_list);exit();
			
			if(empty($account_list)) {
				return $ret_data;
			}
			
			$i = -1;
			foreach($account_list as $row) {
				$ret_data['loan_details'][++$i]['loan_id'] = $row->loan_id;
				$ret_data['loan_details'][$i]['loan_no'] = $row->loan_no;
				$ret_data['loan_details'][$i]['loan_old_no'] = $row->loan_old_no;
				$ret_data['loan_details'][$i]['user_id'] = $row->user_id;
				$ret_data['loan_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['loan_details'][$i]['loan_amount'] = $row->loan_amount;
				$ret_data['loan_details'][$i]['start_date'] = $row->start_date;
				$ret_data['loan_details'][$i]['end_date'] = $row->end_date;
				$ret_data['loan_details'][$i]['closed'] = $row->closed;
				$ret_data['loan_details'][$i]['paid_principle_amt'] = $this->paid_principle_amt([
																								"loan_allocation_id"=>$row->loan_id,
																								"loan_category"=>$data['category']
																							]);
				$ret_data['loan_details'][$i]['ramaining_amount'] = $row->loan_amount - $ret_data['loan_details'][$i]['paid_principle_amt'];
			/*	$fn_data = array(
										'loan_id'=>$row->loan_id,
										'loan_category'=>$data["category"],
										'start_date'=>$row->start_date//optional
									);
				$ret_data['loan_details'][$i]['interest_paid_upto'] = $this->get_interest_paid_upto($fn_data);
				unset($fn_data);*/
			}
//			print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function account_list_dl_edit($data)
		{
			$table = "depositeloan_allocation";
			$allocation_id_field = "{$table}.DepLoanAllocId";
			$closed_field = "LoanClosed_State";
			
			$update_array = array(
										"{$closed_field}"=>$data["closed"]
								);
			
			DB::table($table)
				->where($allocation_id_field,'=',$data['loan_id'])
				->update($update_array);
		}

		public function pl_is_first_payment($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$first_payment = "YES";
			if($data['member_id'] > 0) {
				$part_pay_count = DB::table("personalloan_allocation")
					->where("MemId",$data['member_id'])
					->where("Closed","NO")
					->where("Bid",$BID)
					->count();
					
				if($part_pay_count > 0) {
					$first_payment = "NO";
				}
			}
			return $first_payment;
		}
		
	}
	
