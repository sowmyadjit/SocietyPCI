<?php
	
	namespace App\Http\Model;
	
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	
	class LoanModel extends Model
	{
		protected $table='loan_allocation';
		
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
			
			$perslid = DB::table('personalloan_allocation')->insertGetId(['PersLoan_Number'=> $count_inc,'Bid'=> $id['PLBranchID'],'DocId'=>$docid,'MemId'=>$id['PLMembID'],'LoanAmt'=>$id['PersLoanAmt'],'otherCharges'=>$id['PersOthrChrges'],'Book_FormCharges'=>$id['PersBkfrmChrg'],'AjustmentCharges'=>$id['PersAdjChrg'],'ShareCharges'=>$id['PersShrChrg'],'PayableAmt'=>$id['PersPayAmt'],'LoandurationYears'=>$id['LoanDurationYears'],'FirstSurety'=>$id['PLSurety1ID'],'SecondSurety'=>$id['PLSurety2ID'],'StartDate'=>$id['PersLoanStartDate'],'EndDate'=>$coneDate,'PayMode'=>$id['PersLoanPayMode'],'accid'=>$id['PersLoanSBAccid'],'CreadtedBY'=>$UID,'BankID'=>$id['PersLoanBankID'],'ChequeDate'=>$id['PersLoanChequeDte'],'ChequeNumber'=>$id['PersLoanChequeNum'],'EMI_Amount'=>$id['PersEMIAmt'],'RemainingLoan_Amt'=>$id['PersLoanAmt'],'caldate'=>$id['PersLoanStartDate'],'Insurance'=>$id['Insurance'],'partpayment_amount'=>$pay,'LoanType_ID'=>$Persloantypeid]);
			
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
			return DB::table('request_loan')
			->join('members','members.Memid','=','request_loan.RL_MemId')
			->select(DB::raw('Memid as id, CONCAT(`Memid`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->join('loan_type','loan_type.LoanType_ID','=','request_loan.LoanType_ID')
			->where('Auth_Status','=',"AUTHORISED")
			->where('Request_LoanAllocated','=',"NO")
			->where('Loan_CategoryId','=',"1")
			->get();
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
			->first();
		}
		
		//Get Pygmy Account Number for Deposit Loan
		public function GetPigmyNumForDLAlloc($q) 
		{
			return DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, DepLoan_AccNo as name'))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','request_loan.DepLoan_AccNo')
			->where('Loan_Allocated','=',"NO")
			->where('Closed','=',"NO")
			->where('DepLoan_AccNo','like','%PG%')
			->get();
		}
		
		//Get RD Account Number for Deposit Loan
		public function GetRDNumForDLAlloc($q) 
		{
			return DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, DepLoan_AccNo as name'))
			->join('createaccount','createaccount.AccNum','=','request_loan.DepLoan_AccNo')
			->where('Loan_Allocated','=',"NO")
			->where('Closed','<>',"NO")
			->where('DepLoan_AccNo','like','%RD%')
			->get();
		}
		
		//Get RD Account Number for Deposit Loan
		public function GetFDNumForDLAlloc($q) 
		{
			return DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, DepLoan_AccNo as name'))
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','request_loan.DepLoan_AccNo')
			->where('Loan_Allocated','=',"NO")
			->where('Closed','=',"NO")
			//->where('DepLoan_AccNo','like','%FD%')
			->get();
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
			
			return DB::table('request_loan')
			
			->select(DB::Raw('PersLoanAllocID as id, CONCAT(user.`Uid`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->join('user','user.Uid','=','request_loan.Uid')
			->where('Request_LoanAllocated','=',"NO")
			->where('request_loan.Bid','=',$BID)
			->get();
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
			return DB::table('request_loan')
			->select(DB::Raw('PersLoanAllocID as id, user.FirstName as name'))
			->join('user','user.Uid','=','request_loan.Uid')
			->where('Loan_Category','=',"3")
			->where('Auth_Status','=',"AUTHORISED")
			->get();
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
			return DB::table('jewelloan_allocation')->select('JewelLoanId','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description','user.FirstName','user.MiddleName','user.LastName','JewelLoan_StartDate','JewelLoan_Uid')
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			//->leftJoin('customer','customer.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->where('JewelLoan_Bid',$BID)
			->paginate(10);
			//->get();
		}
		
		public function jewelLoan1_all()
		{
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			return DB::table('jewelloan_allocation')->select('JewelLoanId','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description','user.FirstName','user.MiddleName','user.LastName','JewelLoan_StartDate','JewelLoan_Uid')
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
			->paginate(10);
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
						->where('JewelLoan_Closed','=','NO')
						->where('JewelLoan_Bid','=',$BID)
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
						->where('JewelLoan_EndDate','<=',$today)
						->where('JewelLoan_Bid','=',$BID)
						->where('auction_status','=','2')
						->where('extra_amount','>','0')
						->paginate(10);
					//	->get();
			return $result;
		}
		
		public function sendToJewelAuction($acc_id)
		{
			foreach($acc_id as $aid) {
				DB::table('jewelloan_allocation')
					->where('JewelLoanId','=',$aid)
					->update(['auction_status'=>1]);
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
			$auctionAmt = $details['auc_amt'];
			$buyerpaymentmode = $details['pay_mode'];
			$SBAccid = $details['buyer_acc_no'];
			$jewelalocid = $details['jl_alloc_id'];
			$bid2 = $details['bid2'];
			$expsubhead = $details['subhead_id'];
			$HeadiD = $details['head_id'];
			$per = $details['per'];
			$dte = date('Y-m-d');
			$reportdte = date('Y-m-d');
			$year = date('Y');
			$mnt = date('m');
		/*	$extra_amount =  */
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
			DB::table('branch_to_branch')
				->insert(['Branch_Branch1_Id'=>$BID,'Branch_Branch2_Id'=>$bid2,'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$auctionAmt,'Branch_per'=>$per,'LedgerHeadId'=>$HeadiD,'SubLedgerId'=>$expsubhead,'jewelalocId'=>$jewelalocid]);
			DB::table('jewelloan_allocation')
				->where('JewelLoanId',$jewelalocid)
				->update(['auction_status'=>2]);
				
				
				
			DB::table('jewel_auction')
				->where('JewelLoanId',$jewelalocid)
				->update(['jewel_auction_amount'=>$auctionAmt,'extra_amount'=>"",'buyer_name'=>$buyerName,'pay_mode'=>$buyerpaymentmode,'sb_acc_no'=>$SBAccid,'bank_name'=>"",'cheque_no'=>"",'cheque_date'=>""]);
		}
		
		function jewelAuctionExtraAmountPay($id)
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$today=date("Y-m-d");
			
			DB::table('auction_amount_transaction')
				->insert(['jl_alloc_id'=>$id['jl_alloc_id'],'tran_date'=>$today,'amt_piad'=>$id['extra_amt'],'created_by'=>$UID]);
/*			DB::table('jewel_auction')    //update amt
				->where()
				->*/
			
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
			
			DB::table("jewelloan_allocation")
				->where("JewelLoanId","=",$jewel_alloc_id)
				->update(["jewelloan_Net_weight"=>$net_wt]);
			return;
		}
	}
	
