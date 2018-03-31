<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	
	class DLRepaymentModel extends Model
	{
		protected $table='depositeloan_allocation';
		public function pigmydlacc()
		{
			
			return DB::table('depositeloan_allocation')
			//->select(DB::raw('DepLoanAllocId as id, CONCAT(`DepLoanAllocId`,"-",`DepLoan_AccNum`) as name'))
			->select(DB::raw('DepLoanAllocId as id, DepLoan_AccNum as name'))
			->where('DepLoan_AccNum','like','%PG%')
			->where('LoanClosed_State','<>',"YES")
			->get();		
		}
		public function GetDLDetail($id)
		{
			
			$deposite_type = DB::table("depositeloan_allocation")
				->where("depositeloan_allocation.DepLoanAllocId","=",$id)
				->value("DepLoan_DepositeType");
				
			switch($deposite_type) {
				case "FD":	$interest_rate = $this->fddl_interest($id);
							break;
				case "RD":	//$interest_rate = $this->rddl_interest($id);
							break;
				case "PIGMY":	$interest_rate = 12;
								break;
			}
			
			$depositeloan_allocation = DB::table('depositeloan_allocation')->select('DepLoan_LoanNum','DepLoanAllocId','DepLoan_RemailningAmt','FirstName','MiddleName','LastName','DepLoan_lastpaiddate','partpayment_amount','DepLoan_LoanAmount','LoanType_Interest','loan_due_interest','EMI_Amount')
			//->leftJoin('pigmiallocation','pigmiallocation.PigmiAcc_No','=','depositeloan_allocation.DepLoan_AccNum')
			->leftJoin('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->leftJoin('loan_type','loan_type.LoanType_ID','=','depositeloan_allocation.DepLoan_LoanTypeID')
			->where('DepLoanAllocId','=',$id)
			->first();
			
			if(isset($interest_rate)) {
				$depositeloan_allocation->LoanType_Interest = $interest_rate;
			}
			
//			var_dump($depositeloan_allocation);			exit();
			return $depositeloan_allocation;
		}
		
		public function fddl_interest($id)
		{
			$DepLoan_AccNum = DB::table("depositeloan_allocation")
				->where("depositeloan_allocation.DepLoanAllocId","=",$id)
				->value("DepLoan_AccNum");
				
			$fd_allocation = DB::table("fdallocation")
				->select()
				->join("fdtype","fdtype.FdTid","=","fdallocation.FdTid")
				->where("fdallocation.Fd_CertificateNum","=",$DepLoan_AccNum)
				->first();
				
			$interest = $fd_allocation->FdInterest;
//			var_dump($interest);exit();
			return $interest + 3;
		}
		
		public function GetFDDetail($fdid)
		{
			return DB::table('fdallocation')->select('Fdid','Fd_CertificateNum','Fd_TotalAmt','Fd_Withdraw')
			->where('Fdid','=',$fdid)
			->first();
		}
		
		public function CalcDayDiff($id)
		{
			$sdate=$id['dlsdate'];
			$pid=$id['pid'];
			$did=$id['did'];
			//$sdte=$('#PgStdate').val();
			$dte=date('Y-m-d');
			$date1=date_create($dte);
			$date2=date_create($sdate);
			$difdate=date_diff($date1,$date2);
			$difdtefirst=$difdate->format('%a');
//			return $difdtefirst;

			$days = (int)$difdtefirst;
			
			if(!empty($pid)) {
				$personalloan_repay = DB::table('personalloan_repay')
					->select()
					->where('PLRepay_PLAllocID','=',$pid)
					->get();
				$n = count($personalloan_repay);
				if($n == 0) {
					$days++;
				}
			} else if(!empty($did)) {
				$depositeloan_repay = DB::table('depositeloan_repay')
					->select()
					->where('DLRepay_DepAllocID','=',$did)
					->get();
				$n = count($depositeloan_repay);
				if($n == 0) {
					$days++;
				}
			}
			
			return $days;
		}
		public function jlCalcDayDiff($id)
		{
			
			$jlsdate=$id['strdate'];
			$today =$jlsdate;
			$time = strtotime($jlsdate);
			$final = date("Y-m-d", strtotime("+1 month", $time));
			
			//$final = date(strtotime("+1 month", $time));
			//$datemonth = strtotime(date("Y-m-d", strtotime($today)) . "+1 month");
			
			return $final;
		}
		
		public function GetPygmyAccDetail($id)
		{
			return DB::table('pigmiallocation')
			->select('Total_Amount','PigmiAllocID','PigmiTypeid','Agentid')
			->where('PigmiAcc_No','=',$id)
			->first();
		}
		public function GetSBAccDetail($id)
		{
			return DB::table('depositeloan_allocation')
			->select('createaccount.Accid','createaccount.AccNum','createaccount.AccTid','createaccount.Total_Amount')
			->join('createaccount','createaccount.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('depositeloan_allocation.DepLoan_AccNum','=',$id)
			->first();
		}
		
		public function createPigmyDL($id)
		{
			$RepayDte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$tme=date('h:i:s');
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			$bid=$udetail->Bid;
			
			$loantype=$id['dltype'];
			
			if($loantype=="pygmy DL")
			{
				
				$LoanRem=$id['Pgremtotamt'];
				$payAmt=$id['pgpayamt'];
				$DepAlID=$id['DLAlloc'];
				
				$loanintrest=$id['pgintamt'];
				$loanpendingamt=$id['pgremamt'];
				
				
				
				
				$payAmt_full=$id['pgpayamt'];
				$paymode=$id['PgPayMode'];
				$PgAccNo=$id['DLAccNum'];
				$PgAmt=$id['PgAvailhidn'];
				$branch=$id['BranchIDP'];
				$sbavailbal=$id['PgSBAvailhidn'];
				$pgavailbal=$id['PgAvailhidn'];
				if($paymode=="SB ACCOUNT")
				{
					$sbremamt=($sbavailbal-$payAmt);
				}
				if($paymode=="PIGMI ACCOUNT")
				{
					$pgremamt=($pgavailbal-$payAmt);
					$PgTotRem=($PgAmt-$payAmt);
				}
				$totrem=$LoanRem-$payAmt;
				$acid=$id['Pgacid'];
				$actid=$id['Pgactid'];
				
				
				$bankid=$id['bank_pigmy'];
				$chequeno=$id['chequeno_pigmy'];
				$chequedate=$id['chequedate_pigmy'];
				$bankname=$id['bankname_pigmy'];
				$bankbranch=$id['bankbranch_pigmy'];
				$ifsc=$id['ifsccode_pigmy'];
				
				
			}
			else if($loantype=="RD DL")
			{
				$loanintrest=$id['rdintamt'];
				$loanpendingamt=$id['rdremamt'];
				
				$payAmt_full=$id['rdpayamt'];
				
				$LoanRem=$id['rdremtotamt'];
				$payAmt=$id['rdpayamt'];
				$DepAlID=$id['RDDLAlloc'];
				$paymode=$id['RdPayMode'];
				$PgAccNo=$id['RDDLAccNum'];
				$PgAmt=$id['RdAvailhidn'];
				$branch=$id['BranchIDR'];
				$sbavailbal=$id['RdSBAvailhidn'];
				$pgavailbal=$id['PgAvailhidn'];//added 16/8/2017
				if($paymode=="SB ACCOUNT")
				{
					$sbremamt=($sbavailbal-$payAmt);
				}
				if($paymode=="PIGMI ACCOUNT")
				{
					$PgTotRem=($PgAmt-$payAmt);
					$totrem=$LoanRem-$payAmt;
					$pgremamt=($pgavailbal-$payAmt);//added 16/8/2017
				}
				$acid=$id['rdacid'];
				$actid=$id['rdactid'];
				$bankid=$id['bank_rd'];
				$chequeno=$id['chequeno_rd'];
				$chequedate=$id['chequedate_rd'];
				$bankname=$id['bankname_rd'];
				$bankbranch=$id['bankbranch_rd'];
				$ifsc=$id['ifsccode_rd'];
				
			}	
			else if($loantype=="FD DL")
			{
				$loanintrest=$id['fdintamt'];
				$loanpendingamt=$id['fdremamt'];
				$LoanRem=$id['fdremtotamt'];
				$payAmt=$id['fdpayamt'];
				$payAmt_full=$id['fdpayamt'];
				$DepAlID=$id['FDDLAlloc'];
				$paymode=$id['FdPayMode'];
				$PgAccNo=$id['FDDLAccNum'];
				$PgAmt=$id['FdAvailhidn'];
				$branch=$id['BranchIDF'];
				if($paymode=="SB ACCOUNT")
				{
					$sbavailbal=$id['fdSBAvailhidn'];
					$sbremamt=($sbavailbal-$payAmt);
				}
				if($paymode=="PIGMI ACCOUNT")
				{
					//$sbremamt=($sbavailbal-$payAmt);
					$PgTotRem=($PgAmt-$payAmt);
				}
				$totrem=$LoanRem-$payAmt;
				$acid=$id['fdacid'];
				$actid=$id['fdactid'];
				
				$bankid=$id['bank_fd'];
				$chequeno=$id['chequeno_fd'];
				$chequedate=$id['chequedate_fd'];
				$bankname=$id['bankname_fd'];
				$bankbranch=$id['bankbranch_fd'];
				$ifsc=$id['ifsccode_fd'];
				
			}
			$n=$id['loopid'];
			$charges=$id['charges'];
			$chaamount=$id['amount'];
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				
				$head_sub=DB::table('chareges')->select('head','subhead')
				->where('charges_id',$x)
				->first();
				$head=$head_sub->head;
				$subhead=$head_sub->subhead;
				
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$DepAlID,'bid'=>$bid,'charg_tran_date'=>$RepayDte,'loantype'=>"DL",'LedgerHeadId'=>$head,'SubLedgerId'=>$subhead]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
				//	print_r($chargsum);
			}
			$payAmt=Floatval($payAmt)-Floatval($chargsum);
			
			
			
			$x=DB::table('depositeloan_allocation')->select('DepLoan_RemailninginterestAmt')->where('DepLoanAllocId',$DepAlID)->first();
			
			$x1=$x->DepLoan_RemailninginterestAmt;
			if(!(empty($x1)))
			{
				$loanintrest=$x1+$loanintrest;
			}
			
			
			if($payAmt>$loanintrest)
			{
				$payAmt=$payAmt-$loanintrest;
				$intrestpaid=$loanintrest;
				$intrestremaining=0;
				$loanpendingamt=$loanpendingamt-$payAmt;
				
			}
			else
			{
				$intrestpaid=$payAmt-$loanintrest;
				$intrestremaining=$intrestpaid-$loanintrest;
				//$loanpendingamt=$loanpendingamt;
				$payAmt=0;
				
			}
			
			
			if($loantype=="pygmy DL")
			{
				
				$DLTran=DB::table('depositeloan_repay')->InsertGetId(['DLRepay_DepAllocID'=>$id['DLAlloc'],'DLRepay_PaidAmt'=>$id['pgpayamt'],'DLRepay_PayMode'=>$id['PgPayMode'],'DLRepay_Bid'=>$branch,'Created_By'=>$UID,'DLRepay_Date'=>$RepayDte,'DLRepay_Interestcalculated'=>$loanintrest,'DLRepay_InterestPaid'=>$intrestpaid,'DLRepay_InterestPending'=>$intrestremaining,'DLRepay_PrincipalPaid'=>$payAmt,'Dl_Cheque_No'=>$chequeno,'Dl_Cheque_Date'=>$chequedate,'Dl_BankName'=>$bankname,'Dl_BankBranch'=>$bankbranch,'Dl_IFSC'=>$ifsc,'Dl_CreditBank'=>$bankid,'Dl_Cheque_Status'=>"1"]);
			}
			else if($loantype=="RD DL")
			{
				
				
				$DLTran=DB::table('depositeloan_repay')->InsertGetId(['DLRepay_DepAllocID'=>$id['RDDLAlloc'],'DLRepay_PaidAmt'=>$id['rdpayamt'],'DLRepay_PayMode'=>$id['RdPayMode'],'DLRepay_Bid'=>$branch,'Created_By'=>$UID,'DLRepay_Date'=>$RepayDte,'DLRepay_Interestcalculated'=>$loanintrest,'DLRepay_InterestPaid'=>$intrestpaid,'DLRepay_InterestPending'=>$intrestremaining,'DLRepay_PrincipalPaid'=>$payAmt,'Dl_Cheque_No'=>$chequeno,'Dl_Cheque_Date'=>$chequedate,'Dl_BankName'=>$bankname,'Dl_BankBranch'=>$bankbranch,'Dl_IFSC'=>$ifsc,'Dl_CreditBank'=>$bankid,'Dl_Cheque_Status'=>"1"]);
			}
			else if($loantype=="FD DL")
			{
				$DLTran=DB::table('depositeloan_repay')->InsertGetId(['DLRepay_DepAllocID'=>$id['FDDLAlloc'],'DLRepay_PaidAmt'=>$id['fdpayamt'],'DLRepay_PayMode'=>$id['FdPayMode'],'DLRepay_Bid'=>$branch,'Created_By'=>$UID,'DLRepay_Date'=>$RepayDte,'DLRepay_Interestcalculated'=>$loanintrest,'DLRepay_InterestPaid'=>$intrestpaid,'DLRepay_InterestPending'=>$intrestremaining,'DLRepay_PrincipalPaid'=>$payAmt,'Dl_Cheque_No'=>$chequeno,'Dl_Cheque_Date'=>$chequedate,'Dl_BankName'=>$bankname,'Dl_BankBranch'=>$bankbranch,'Dl_IFSC'=>$ifsc,'Dl_CreditBank'=>$bankid,'Dl_Cheque_Status'=>"1"]);
			}
			if($paymode=="CASH"||$paymode=="SB ACCOUNT"||$paymode=="PIGMI ACCOUNT"||$paymode=="FD_ACCOUNT")
			{
				DB::table('depositeloan_allocation')
				->where('DepLoanAllocId',$DepAlID)
				->update(['DepLoan_RemailningAmt'=>$loanpendingamt,'DepLoan_RemailninginterestAmt'=>$intrestremaining,'DepLoan_lastpaiddate'=>$RepayDte]);
				
				if($loanpendingamt<=0)
				{
					DB::table('depositeloan_allocation')
					->where('DepLoanAllocId',$DepAlID)
					->update(['LoanClosed_State'=>"YES"]);
					
					if($loantype=="pygmy DL")
					{
						DB::table('pigmiallocation')
						->where('PigmiAcc_No',$PgAccNo)
						->update(['LoanClosed_State'=>"YES",'Loan_Allocated'=>"NO"]);
					}
					else if($loantype=="RD DL")
					{
						DB::table('createaccount')
						->where('AccNum',$PgAccNo)
						->update(['Loan_Allocated'=>"NO"]);
					}
					else if($loantype=="FD DL")
					{
						DB::table('fdallocation')
						->where('Fd_CertificateNum',$PgAccNo)
						->update(['Loan_Allocated'=>"NO"]);
					}
					
				}
			}
			if($paymode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				
				$totcash=$inhandcash1+$payAmt_full;
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$totcash]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$RepayDte,'InhandTrans_Particular'=>"Amount Credited to Pygmy DL",'InhandTrans_Cash'=>$payAmt_full,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			/*else if($paymode=="PYGMY ACCOUNT")
				{
				DB::table('pigmiallocation')
				->where('PigmiAcc_No',$PgAccNo)
				->update(['Total_Amount'=>$PgTotRem,'Loan_Adjustment'=>"YES"]);
				
				
				DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$RepayDte,'PigReport_TranDate'=>$RepayDte,'Trans_Time'=>$tme,'Agentid'=>$id['Pgagentid'],'PigmiAllocID'=>$id['Pgallocid'],'Current_Balance'=>$id['PgAvailhidn'],'Transaction_Type'=>"DEBIT",'Amount'=>$payAmt,'Particulars'=>"Amount Debited to DL Account",'PigmiTypeid'=>$id['Pgtypeid'],'Total_Amount'=>$PgTotRem,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"PYGMY ACCOUNT",'Bid'=>$branch,'CreatedBy'=>$UID]);
			}*/
			else if($paymode=="SB ACCOUNT")//SB ACCOUNT
			{
				DB::table('sb_transaction')->insertGetId(['Accid'=>$acid,'AccTid' => $actid,'TransactionType' => "DEBIT",'particulars' => "Amount Debited to DL Account",'Amount' => $payAmt_full,'CurrentBalance' => $sbavailbal,'Total_Bal' => $sbremamt,'tran_Date' => $RepayDte,'SBReport_TranDate'=> $RepayDte,'Time' =>$tme,'Month'=>$mnt,'Year'=>$year,'Payment_Mode'=>"SB ACCOUNT",'Bid'=>$branch,'CreatedBy'=>$UID]); 
				
				$sb=DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$sbremamt]);				
			}
			else if($paymode=="PIGMI ACCOUNT")//PIGMI ACCOUNT
			{
				DB::table('pigmi_transaction')->insertGetId(['PigmiAllocID'=>$acid,'PigmiTypeid' => $actid,'Transaction_Type' => "DEBIT",'Particulars' => "Amount Debited to DL Account",'Amount' => $payAmt_full,'Current_Balance' => $pgavailbal,'Total_Amount' => $pgremamt,'Trans_Date' => $RepayDte,'PigReport_TranDate'=> $RepayDte,'Trans_Time' =>$tme,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"PIGMI ACCOUNT",'Bid'=>$branch,'CreatedBy'=>$UID,'Agentid'=>'0']); 
				
				
				
/***************** pigmi paid amount entry *************************/
				
				$PigmiAccNum = DB::table('pigmiallocation')
					->select('PigmiAcc_No','Closed')
					->where('PigmiAllocID','=',$acid)
					->first();
				$pg_ac_no = $PigmiAccNum->PigmiAcc_No;
				$closed = $PigmiAccNum->Closed;
				if($closed == 'YES') {
					$PayAmount_PayDate = date('d-m-Y');
					
					$PayAmount_IntType = DB::table('pigmi_interest')	
						->where('PigmiAcc_No','=',$pg_ac_no)
						->first();
						
					if(! empty($PayAmount_IntType)) {
						$int_type = 'INTEREST';
					} else {
						$int_type = 'PREWITHDRAWAL';
					}

					DB::table('pigmi_payamount')->insertGetId(['Bid'=>$bid,'PayAmount_PigmiAccNum'=>$pg_ac_no,'PayAmount_PaymentMode'=>'DL REPAY','PayAmount_PayableAmount'=>$payAmt,'PayAmountReport_PayDate'=>$RepayDte,'PayAmount_PayDate'=>$PayAmount_PayDate,'PayAmount_IntType'=>$int_type]);
				}
/***************** pigmi paid amount entry *************************/
				
				
				$sb=DB::table('pigmiallocation')->where('PigmiAllocID',$acid)
				->update(['Total_Amount'=>$pgremamt]);				
			}
			else if($paymode=="FD_ACCOUNT")//PIGMI ACCOUNT
			{
			$dte=date('Y-m-d');
			$fdnum1=DB::table('fdallocation')->select('Fd_CertificateNum','Fd_Withdraw','Fd_TotalAmt')->where('Fdid',$id['FD_pay_num'])->first();
			$fdnum=$fdnum1->Fd_CertificateNum;
			$Fd_Withdraw=$fdnum1->Fd_Withdraw;
			$Fd_TotalAmt=$fdnum1->Fd_TotalAmt;
			if($Fd_Withdraw=="YES")
			{
				$m="MATURED";
				$totfd=$Fd_TotalAmt-$payAmt_full;
				DB::table('fdallocation')->where('Fdid',$id['FD_pay_num'])
				->update(['Fd_TotalAmt'=>$totfd,"fd_renewed"=>"YES","renewed_amount"=>$Fd_TotalAmt]);
			}
			else
			{
				$m="PREWITHDRAWAL";
																							
				DB::table('fdallocation')->where('Fdid',$id['FD_pay_num'])
				->update(["fd_renewed"=>"YES","renewed_amount"=>$Fd_TotalAmt]);
				$fdamt1=DB::table('fd_prewithdrawal')->select('TotalAmt_Payable')->where('FdAcc_No','=',$fdnum)->first();
				$fdamt=$fdamt1->TotalAmt_Payable;
				$totfd=$fdamt-$payAmt_full;
				DB::table('fd_prewithdrawal')->where('FdAcc_No','=',$fdnum)->update(['TotalAmt_Payable'=>$totfd]);
			}
				DB::table('fd_payamount')->insert(['FDPayAmt_AccNum'=>$fdnum,'FDPayAmt_PaymentMode'=>"Adjustment",'FDPayAmt_PayableAmount'=>$payAmt_full,'FDPayAmt_PayDate'=>$dte,'FDPayAmtReport_PayDate'=>$dte,'Bid'=>$bid,'FDPayAmt_IntType'=>$m]);
			}
		}
		
		
		
		public function RDdlacc()
		{
			
			return DB::table('depositeloan_allocation')
			
			->select(DB::raw('DepLoanAllocId as id, DepLoan_AccNum as name'))
			->where('DepLoan_AccNum','like','%RD%')
			->get();		
		}
		
		public function FDdlacc()
		{
			
			return DB::table('depositeloan_allocation')
			
			->select(DB::raw('DepLoanAllocId as id, DepLoan_AccNum as name'))
			->where('LoanClosed_State','<>',"YES")
			//->where('DepLoan_AccNum','like','%FD%')
			->get();		
		}
		public function FDdlacc_fd()
		{
			
			return DB::table('fdallocation')
			
			->select(DB::raw('Fdid as id, Fd_CertificateNum as name'))
			
			//->where('DepLoan_AccNum','like','%FD%')
			->get();		
		}
		public function loan_sl()
		{
			
			return DB::table('staffloan_allocation')
			
			->select(DB::raw('StfLoanAllocID as id,StfLoan_Number as name'))
			->get();		
		}
		public function loan_jl()
		{
			
			return DB::table('jewelloan_allocation')
			
			->select(DB::raw('JewelLoanId as id,JewelLoan_LoanNumber as name'))
			->get();		
		}
		public function loan_dl()
		{
			
			return DB::table('depositeloan_allocation')
			
			->select(DB::raw('DepLoanAllocId as id,DepLoan_LoanNum as name'))
			->get();		
		}
		public function loan_pl()
		{
			
			return DB::table('personalloan_allocation')
			
			->select(DB::raw('PersLoanAllocID as id,PersLoan_Number as name'))
			->get();		
		}
		public function getdlacc()
		{
			
			return DB::table('depositeloan_allocation')
			
			->select(DB::raw('DepLoanAllocId as id, CONCAT(`DepLoan_LoanNum`,"-",`Old_loan_number`)  as name'))
			
			->get();		
		}
		public function SBdlacc()
		{
			
			return DB::table('createaccount')
			
			->select(DB::raw('Accid as id, AccNum as name'))
			->where('AccNum','like','%SB%')
			->get();		
		}
		public function getplacc()
		{
			
			return DB::table('personalloan_allocation')
			
			->select(DB::raw('PersLoanAllocID as id, PersLoan_Number as name'))
			->get();		
		}
		public function getjlacc()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			if($BID == 6) {
				$bids = array(1,2,3,4,5,6);
			} else {
				$bids = array($BID);
			}
			
			return DB::table('jewelloan_allocation')
			
			->select(DB::raw('JewelLoanId as id, JewelLoan_LoanNumber as name'))
			->where('JewelLoan_Closed','!=','YES')
			->whereIn('JewelLoan_Bid',$bids)
			->orWhere("auction_status","=","1")
			->orWhere("auction_status","=","2")
			->get();		
		}
		public function getplacc_partpayment()
		{
			
			return DB::table('personalloan_allocation')
			
			->select(DB::raw('PersLoanAllocID as id, PersLoan_Number as name'))
			->where('PayMode','=',"PARTPAYMENT")
			->get();		
		}
		public function getjlacc_partpayment()
		{
			
			return DB::table('jewelloan_allocation')
			
			->select(DB::raw('JewelLoanId as id, JewelLoan_LoanNumber as name'))
			->where('JewelLoan_PaymentMode','=',"PARTPAYMENT")
			->get();		
		}	
		
		
		
		public function getjlaccsearch()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			if($bid == 6) {
				$condition_for_HO = '1 = 1';
			} else {
				$condition_for_HO = " user.Bid = $bid ";
			}
			
			return DB::table('jewelloan_allocation')
			->select(DB::raw('JewelLoanId as id, CONCAT(`JewelLoan_Uid`,"-",`FirstName`,`MiddleName`,`LastName`,"-",`JewelLoan_LoanNumber`,"-",`jewelloan_Oldloan_No`) as name'))
			->join('user','user.Uid','=','JewelLoan_Uid')
			->whereRaw($condition_for_HO)
			->orderBy("JewelLoan_LoanNumber","desc")
			->get();		
		}
		
		public function getplaccsearch()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			if($bid == 6) {
				$condition_for_HO = '1 = 1';
			} else {
				$condition_for_HO = " user.Bid = $bid ";
			}
			
			return DB::table('personalloan_allocation')
			->select(DB::raw('PersLoanAllocID as id, CONCAT(`user`.`FirstName`,`user`.`MiddleName`,`user`.`LastName`,"-",`PersLoan_Number`,"-",`Old_PersLoan_Number`) as name'))
			->join('members','members.Memid','=','personalloan_allocation.MemId')
			->join('user','user.Uid','=','members.Uid')
			->whereRaw($condition_for_HO)
			->get();
		}
		
		public function getslaccsearch()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			if($bid == 6) {
				$condition_for_HO = '1 = 1';
			} else {
				$condition_for_HO = " user.Bid = $bid ";
			}
			
			return DB::table('staffloan_allocation')
			->select(DB::raw('StfLoanAllocID as id, CONCAT(`FirstName`,`MiddleName`,`LastName`,"-",`StfLoan_Number`,"-",`old_saffloan_no`) as name'))
			->join('user','user.Uid','=','staffloan_allocation.Uid')
			->whereRaw($condition_for_HO)
			->get();	
		}
		
		public function getdlaccsearch()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			if($bid == 6) {
				$condition_for_HO = '1 = 1';
			} else {
				$condition_for_HO = " user.Bid = $bid ";
			}
			
			return DB::table('depositeloan_allocation')
			->select(DB::raw('DepLoanAllocId as id, CONCAT(`FirstName`,`MiddleName`,`LastName`,"-",`DepLoan_LoanNum`,"-",`Old_loan_number`) as name'))
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->whereRaw($condition_for_HO)
			->get();	
		}
		
		public function getslacc()
		{
			
			return DB::table('staffloan_allocation')
			
			->select(DB::raw('StfLoanAllocID as id,StfLoan_Number as name'))
			->get();		
		}
		public function getslacc_partpayment()
		{
			
			return DB::table('staffloan_allocation')
			
			->select(DB::raw('StfLoanAllocID as id,StfLoan_Number as name'))
			->where('PayMode','=',"PARTPAYMENT")
			->get();		
		}
		public function getdlacc_partpayment()
		{
			
			return DB::table('depositeloan_allocation')
			
			->select(DB::raw('DepLoanAllocId as id,DepLoan_LoanNum as name'))
			//->where('DepLoan_PaymentMode','=',"PARTPAYMENT")
			->get();		
		}
		public function DLRepayGetSBDetails($id)
		{
			return DB::table('createaccount')->select('Accid','AccNum','AccTid','Total_Amount')
			->where('Accid','=',$id)
			->first();
		}
		
		public function DLRepayGetPgmDetails($id)//M 15-6-16 FOR DLRepayment Paymode pigmy pigmy acc TA change
		{
			return DB::table('pigmiallocation')->select('PigmiAllocID','PigmiAcc_No','PigmiTypeid','Total_Amount','Agentid')
			->where('PigmiAllocID','=',$id)
			->first();
		}
		
		public function GetplDetail($id)
		{
			return DB::table('personalloan_allocation')->select('PersLoanAllocID','RemainingLoan_Amt','caldate','FirstName','MiddleName','LastName','EMI_Amount','LoanAmt','partpayment_amount','LoanType_Interest','loan_due_interest','EMI_Amount','RemainingInterest_Amt','EMIremaining')
			->leftJoin('members','members.Memid','=','personalloan_allocation.MemId')
			->leftJoin('loan_type','loan_type.LoanType_ID','=','personalloan_allocation.LoanType_ID')
			->where('PersLoanAllocID','=',$id)
			->first();
			
		}	
		public function GetjlDetail($id)
		{
																		 
			$jid=$id['jlAlcID'];
			$jewelloan_allocation = DB::table('jewelloan_allocation')->select('JewelLoan_LoanRemainingAmount','JewelLoan_StartDate','JewelLoan_EndDate','FirstName','MiddleName','LastName','JewelLoan_lastpaiddate','partpayment_amount','JewelLoan_LoanAmount','LoanType_Interest','auction_status','loan_due_interest','JewelLoan_remaininginterest')
			->leftJoin('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->leftJoin('loan_type','loan_type.LoanType_ID','=','jewelloan_allocation.JewelLoan_LoanTypeId')
			->where('JewelLoanId','=',$jid)
			->first();
			
			
			
			
				/********** CHECK FOR 1ST REPAY **********/
				$fn_data["jlaccid"] = $jid;
				$is_jl_first_repay_done = $this->is_jl_first_repay_done($fn_data);//true/false
				unset($fn_data);
//				var_dump($is_jl_first_repay_done);exit();
				/********** CHECK FOR 1ST REPAY END **********/
				
				
				/********** get interest paid upto **********/
				if($is_jl_first_repay_done == 1) {
					$jewelloan_repay = DB::table("jewelloan_repay")
						->where("JLRepay_JLAllocID","=",$jid)
						->orderBy("JLRepay_Date","desc")
						->first();
					$last_date = $jewelloan_repay->interest_paid_upto;
				} else {
					$last_date = $jewelloan_allocation->JewelLoan_StartDate;
				}
//				echo "last_date: $last_date <br />"; exit();
				/********** get interest paid upto END **********/
			$jewelloan_allocation->JewelLoan_lastpaiddate = $last_date;
			
			return $jewelloan_allocation;
			
		}
		
		public function GetslDetail($id)
		{
			return DB::table('staffloan_allocation')->select('StaffLoan_LoanRemainingAmount','LastPaidDate','FirstName','MiddleName','LastName','EMI_Amount','partpayment_amount','LoanAmt','loan_due_interest','EMI_Amount')
			->leftJoin('user','user.Uid','=','staffloan_allocation.Uid')
			->leftJoin('loan_type','loan_type.LoanType_ID','=','staffloan_allocation.Loan_Type')
			->where('StfLoanAllocID','=',$id)
			->first();
			
		}
		public function PersonalLoanRepay($id)
		{
			
			$RepayDte=date('Y-m-d',strtotime($id["rec_date_pl"]));
			$mnt=date('m',strtotime($id["rec_date_pl"]));
			$year=date('Y',strtotime($id["rec_date_pl"]));
			$tme=date('h:i:s');
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$bid=$uname->Bid;
			$BID=$uname->Bid;
			$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
			$respit=$respit1->Recp_No;
			$r=$respit+1;
			DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$payAmt=$id['plpayamt'];
			$payAmt1=$id['plpayamt'];
			$PgAmt=$id['plAvailhidn'];
			$pigmyavilableamt=$id['PgAvailhidnforPL'];
			$interest_upto_pl = $id['interest_upto_pl'];
			$rec_date_pl = $id['rec_date_pl'];
			
			$paymode=$id['plPayMode'];
			if($paymode=="PYGMY ACCOUNT")
			{
				$PgTotRem=($pigmyavilableamt-$payAmt);
				abs($PgTotRem);
				$pigmycommision=(($payAmt*4)/100);
				$payAmt=(Floatval($payAmt)-Floatval($pigmycommision));
				abs($payAmt);
			}
			
			
			$loanremainingamt=$id['plremamt'];
			$loaninterest=$id['plintamt'];
			$n=$id['loopid'];
			$emi1=$id['plemi'];
			
			$chargid=$id['charges'];
			$chargamt=$id['amount'];
			$DepAlID=$id['plAlloc'];
			
			$bankid=$id['bank_pl'];
			$chequeno=$id['chequeno_pl'];
			$chequedate=$id['chequedate_pl'];
			$bankname=$id['bankname_pl'];
			$bankbranch=$id['bankbranch_pl'];
			$ifsc=$id['ifsccode_pl'];
			
			$z=0;
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$DepAlID,'bid'=>$bid,'charg_tran_date'=>$RepayDte,'loantype'=>"PL"]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
				//	print_r($chargsum);
			}
			//print_r($chargsum);
			$emi1=Floatval($emi1)-Floatval($chargsum);
			
			$payAmt=Floatval($payAmt)-Floatval($chargsum);
			//print_r($emi1);
			//print_r($payAmt);
			$emi=$emi1-$loaninterest;
			
			abs($emi);
			
			
			$PgAccNo=$id['plloanno'];
			
			$branch=$BID;
			if($paymode=="SB ACCOUNT")
			{
				$sbavailbal=$id['plSBAvailhidn'];
				$sbremamt=($sbavailbal-$payAmt1);
			}
			
			
			$acid=$id['placid'];
			$actid=$id['plactid'];
			$pigmyallocid=$id['plpigmiid'];
			
			$pigmyagentid=$id['pgyagentid'];
			$pigmytypid=$id['pgytypid'];
			
			$x=DB::table('personalloan_allocation')->select('RemainingInterest_Amt','EMIremaining')->where('PersLoanAllocID',$DepAlID)->first();
			
			$x1=$x->RemainingInterest_Amt;
			$x2=$x->EMIremaining;
			$x1=floatval($x1);
			$x2=floatval($x2);
			$loaninterest=$x1+$loaninterest;
			$emi=$x2+$emi;
			abs($emi);
			if($payAmt>=$loaninterest)
			{
				$payAmt=$payAmt-$loaninterest;
				abs($payAmt);
				$paidinterest=$loaninterest;
				if($payAmt>$emi)
				{
					$loanremainingamt=$loanremainingamt-$payAmt;
					abs($loanremainingamt);
					$remainigemi=0;
				}
				else if($payAmt<=$emi)
				{
					$loanremainingamt=$loanremainingamt-$payAmt;
					abs($loanremainingamt);
					$remainigemi=$emi-$payAmt;
					abs($remainigemi);
				}
				$remaininginterst=0;
			}
			else if($payAmt<$loaninterest)
			{
				$remaininginterst=$loaninterest-$payAmt;
				//abs($remaininginterst);
				$paidinterest=$payAmt;
				$payAmt=0;
				//$loanremainingamt=0;
				$remainigemi=$emi;
			}	     
			$plTran=DB::table('personalloan_repay')->InsertGetId(['PLRepay_PLAllocID'=>$DepAlID,'PLRepay_PaidAmt'=>$id['plpayamt'],'PLRepay_PayMode'=>$id['plPayMode'],'PLRepay_Bid'=>$branch,'PLRepay_Created_By'=>$UID,'PLRepay_Date'=>$RepayDte,'PLRepay_CalculatedInterest'=>$loaninterest,'RemainingInterest_Amt'=>$remaininginterst,'PLRepay_PaidInterest'=>$paidinterest,'PLRepay_Amtpaidtoprincpalamt'=>$payAmt,'PLRepay_EMIremaining'=>$remainigemi,'PL_ReceiptNum'=>$r,'PL_ChequeNO'=>$chequeno,'PL_ChequeDate'=>$chequedate,'PL_BankName'=>$bankname,'PL_BankBranch'=>$bankbranch,'PL_IFSC'=>$ifsc,'PL_CreditBank'=>$bankid,'interest_paid_upto'=>$interest_upto_pl]);
			if($paymode=="CASH"||$paymode=="SB ACCOUNT"||$paymode=="PYGMY ACCOUNT"||$paymode=="ADJUSTMENT")
			{
				DB::table('personalloan_allocation')
				->where('PersLoanAllocID',$DepAlID)
				->update(['RemainingLoan_Amt'=>$loanremainingamt,'caldate'=>$RepayDte,'RemainingInterest_Amt'=>$remaininginterst,'EMIremaining'=>$remainigemi]);
				if($loanremainingamt<=0)
				{
					
					DB::table('personalloan_allocation')
					->where('PersLoanAllocID',$DepAlID)
					->update(['Closed'=>"YES"]);
				}
			}
			if($paymode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				
				$totcash=$inhandcash1+$payAmt1;
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$totcash]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$RepayDte,'InhandTrans_Particular'=>"Amount Credited to Pygmy DL",'InhandTrans_Cash'=>$payAmt1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			else if($paymode=="SB ACCOUNT")//SB ACCOUNT
			{
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$acid,'AccTid' => $actid,'TransactionType' => "DEBIT",'particulars' => "Amount Debited to PL Account",'Amount' => $payAmt1,'CurrentBalance' => $sbavailbal,'Total_Bal' => $sbremamt,'tran_Date' => $RepayDte,'SBReport_TranDate'=> $RepayDte,'Time' =>$tme,'Month'=>$mnt,'Year'=>$year,'Time'=>$tme,'Payment_Mode'=>"SB ACCOUNT",'Bid'=>$branch,'CreatedBy'=>$UID]); 
				
				$sb=DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$sbremamt]);	
				
				$sb=DB::table('personalloan_repay')->where('PLRepay_Id',$plTran)
				->update(['PLRepay_SbTranId'=>$sbtran]);				
			}
			else if ($paymode=="PYGMY ACCOUNT")
			{   	 
				$tot=$pigmyavilableamt-$payAmt1;
				$pigmytran=DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$RepayDte,'PigReport_TranDate'=>$RepayDte,'Agentid'=>"0",'PigmiAllocID'=>$pigmyallocid,'Current_Balance'=>$pigmyavilableamt,'Transaction_Type'=>"DEBIT",'Amount'=>$payAmt1,'Particulars'=>"AJUSTED TO THE PERSONAL LOAN",'Total_Amount'=>$tot,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"PYGMY ACCOUNT",'Bid'=>$branch,'PigmiTypeid'=>$pigmytypid]);
				
				$PIGMY=DB::table('pigmiallocation')->where('PigmiAllocID',$pigmyallocid)
				->update(['Total_Amount'=>$tot]);	
				
				$sb=DB::table('personalloan_repay')->where('PLRepay_Id',$plTran)
				->update(['PLRepay_PIGMYTranId'=>$pigmytran]);
			}
			else if($paymode=="CHEQUE")
			{
				
				DB::table('personalloan_repay')->where('PLRepay_Id',$plTran)
				->update(['PL_ChequeStatus'=>"1"]);
			}
			else if($paymode=="ADJUSTMENT")
			{
				DB::table('personalloan_repay')->where('PLRepay_Id',$plTran)
				->update(['PL_adjustid'=>$id['adid']]);
			}
		}
		
		public function JewelLoanRepay($id)
		{
			
			$RepayDte=date('Y-m-d',strtotime($id["rec_date_jl"]));
			$mnt=date('m',strtotime($id["rec_date_jl"]));
			$year=date('Y',strtotime($id["rec_date_jl"]));
			$tme=date('h:i:s');
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$bid=$uname->Bid;
			
			$interest_upto = $id["interest_upto"];
			$Loaninterest=$id['jlintamt'];//interset amount
			$LoanprincipalRem=$id['jlremamt'];
			$payAmt=$id['jlpayamt'];
			$totamt=$id['jlpayamt'];
			$DepAlID=$id['jlAlloc'];
			$n=$id['loopid'];
			$chargid=$id['charges'];
			$chargamt=$id['amount'];
			
			$bankid=$id['bank_jl'];
			$chequeno=$id['chequeno_jl'];
			$chequedate=$id['chequedate_jl'];
			$bankname=$id['bankname_jl'];
			$bankbranch=$id['bankbranch_jl'];
			$ifsc=$id['ifsccode_jl'];
			///$payAmt=$Loaninterest-$payAmt;
			
			//$LoanRem=$id['jlremtotamt'];
			
			$x=DB::table('jewelloan_allocation')->select('JewelLoan_remaininginterest')	->where('JewelLoanId',$DepAlID)->first();
			
			$x1=$x->JewelLoan_remaininginterest;
			if(!(empty($x1)))
			{
				$Loaninterest=$x1+$Loaninterest;
			}
			
			$z=0;
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$DepAlID,'bid'=>$bid,'charg_tran_date'=>$RepayDte,'loantype'=>"JL"]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
				
			}
			$payAmt=Floatval($payAmt)-Floatval($chargsum);
			if($payAmt>=$Loaninterest)
			{
				$payAmt=$payAmt-$Loaninterest;
				abs($payAmt);
				$paidinterest=$Loaninterest;
				$remaininginterst=0;
				$pendingloanamt=$LoanprincipalRem-$payAmt;
			}
			else if($payAmt<$Loaninterest)
			{
				$remaininginterst=$Loaninterest-$payAmt;
				abs($remaininginterst);
				$paidinterest=$payAmt;
				$payAmt=0;
				$pendingloanamt=$LoanprincipalRem;
			}
			
			
			
			
			
			$paymode=$id['jlPayMode'];
			$PgAccNo=$id['jlloanno'];
			$PgAmt=$id['jlAvailhidn'];
			$branch=$id['branch'];
			$sbavailbal=$id['jlSBAvailhidn'];
			if($paymode=="SB ACCOUNT")
			{
				$sbremamt=($sbavailbal-$totamt);
			}
			//$PgTotRem=($PgAmt-$payAmt);
			//$totrem=$LoanRem-$payAmt;
			$acid=$id['jlacid'];
			$actid=$id['jlactid'];
			
			$repay_through_auction = 0;
			$auction_status = DB::table("jewelloan_allocation")
				->where("JewelLoanId","=",$DepAlID)
				->value("auction_status");
				
			if($auction_status == 1 || $auction_status == 2) {
				$repay_through_auction = 1;
			}
			
			$jlTran=DB::table('jewelloan_repay')->InsertGetId(['JLRepay_JLAllocID'=>$DepAlID,'JLRepay_PaidAmt'=>$id['jlpayamt'],'JLRepay_PayMode'=>$paymode,'JLRepay_Bid'=>$branch,'JLRepay_Created_By'=>$UID,'JLRepay_Date'=>$RepayDte,'JLRepay_interestcalculated'=>$Loaninterest,'JLRepay_interestpaid'=>$paidinterest,'JLRepay_interestpending'=>$remaininginterst,'JLRepay_paidtoprincipalamt'=>$payAmt,'JL_ChequeNo'=>$chequeno,'JL_ChequeDate'=>$chequedate,'JL_BankName'=>$bankname,'JL_BankBranch'=>$bankbranch,'JL_CreditBank'=>$bankid,'JL_IFSC'=>$ifsc,'repay_through_auction'=>$repay_through_auction,'interest_paid_upto'=>$interest_upto]);
			
			DB::table('jewelloan_allocation')
			->where('JewelLoanId',$DepAlID)
			->update(['JewelLoan_LoanRemainingAmount'=>$pendingloanamt,'JewelLoan_remaininginterest'=>$remaininginterst,'JewelLoan_lastpaiddate'=>$RepayDte]);
			if($paymode=="CASH"||$paymode=="SB ACCOUNT"||$paymode=="ADJUSTMENT")
			{
				if($pendingloanamt<=0)
				{
					DB::table('jewelloan_allocation')
					->where('JewelLoanId',$DepAlID)
					->update(['JewelLoan_Closed'=>"YES"]);
				}
			}
			if($paymode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				
				$totcash=$inhandcash1+$totamt;
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$totcash]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$RepayDte,'InhandTrans_Particular'=>"Amount Credited to Pygmy DL",'InhandTrans_Cash'=>$totamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			else if($paymode=="SB ACCOUNT")//SB ACCOUNT
			{
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$acid,'AccTid' => $actid,'TransactionType' => "DEBIT",'particulars' => "Amount Debited to JL Account",'Amount' => $totamt,'CurrentBalance' => $sbavailbal,'Total_Bal' => $sbremamt,'tran_Date' => $RepayDte,'SBReport_TranDate'=> $RepayDte,'Time' =>$tme,'Month'=>$mnt,'Year'=>$year,'Time'=>$tme,'Payment_Mode'=>"SB ACCOUNT",'Bid'=>$branch,'CreatedBy'=>$UID]); 
				
				$sb=DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$sbremamt]);	
				
				$sb=DB::table('jewelloan_repay')->where('JLRepay_Id',$jlTran)
				->update(['JLRepay_SbTranId'=>$sbtran]);				
			}
			else
			{
				$sb=DB::table('jewelloan_repay')->where('JLRepay_Id',$jlTran)
				->update(['JL_Status'=>"1"]);		
				
			}
		
		}
		
		public function JewelAuctionRepay($auc_amt,$pay_amt,$jlAlloc)
		{
			$rem_amt = $auc_amt - $pay_amt;
			DB::table('jewel_auction')
				->where('JewelLoanId','=',$jlAlloc)
				->update(['extra_amount'=>$rem_amt]);
		}
		
		public function StaffLoanRepay($id)
		{
			
			$RepayDte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$tme=date('h:i:s');
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$bid=$uname->Bid;
			
			$LoanRem=$id['slremtotamt'];
			$payAmt=$id['slpayamt'];
			$payAmt_tot=$id['slpayamt'];
			$DepAlID=$id['slAlloc'];
			$paymode=$id['slPayMode'];
			$PgAccNo=$id['slloanno'];
			$PgAmt=$id['slAvailhidn'];
			$branch=$id['branch'];
			$sbavailbal=$id['slSBAvailhidn'];
			
			
			
			
/*********************** sl charegs  ************************/

			$z=0;
			$n = $id['xsl'];
			$chargid = $id['charges'];
			$chargamt = $id['amount'];

			$charges=$id['charges'];
			$chaamount=$id['amount'];
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				
				$head_sub=DB::table('chareges')->select('head','subhead')
				->where('charges_id',$x)
				->first();
				$head=$head_sub->head;
				$subhead=$head_sub->subhead;
				
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$DepAlID,'bid'=>$bid,'charg_tran_date'=>$RepayDte,'loantype'=>"SL",'LedgerHeadId'=>$head,'SubLedgerId'=>$subhead]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
					echo "- charge sum = "; print_r($chargsum); echo "- ";
			}





/*********************** sl charegs  ************************/
			
			
			
			if($paymode=="SB ACCOUNT")
			{
			$sbremamt=($sbavailbal-$payAmt);
			$PgTotRem=($PgAmt-$payAmt);
			}
			$totrem=$LoanRem-$payAmt;
			$acid=$id['slacid'];
			$actid=$id['slactid'];
			
			$slTran=DB::table('staffloan_repay')->InsertGetId(['SLRepay_SLAllocID'=>$DepAlID,'SLRepay_PaidAmt'=>$id['slpayamt'],'SLRepay_PayMode'=>$id['slPayMode'],'SLRepay_Bid'=>$branch,'SLRepay_Created_By'=>$UID,'SLRepay_Date'=>$RepayDte]);
			
			DB::table('staffloan_allocation')
			->where('StfLoanAllocID',$DepAlID)
			->update(['StaffLoan_LoanRemainingAmount'=>$totrem]);
			
			if($paymode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				
				$totcash=$inhandcash1+$payAmt_tot;
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$totcash]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$RepayDte,'InhandTrans_Particular'=>"Amount Credited to Pygmy DL",'InhandTrans_Cash'=>$payAmt_tot,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			else if($paymode=="SB ACCOUNT")//SB ACCOUNT
			{
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$acid,'AccTid' => $actid,'TransactionType' => "DEBIT",'particulars' => "Amount Debited to SL Account",'Amount' => $payAmt_tot,'CurrentBalance' => $sbavailbal,'Total_Bal' => $sbremamt,'tran_Date' => $RepayDte,'SBReport_TranDate'=> $RepayDte,'Time' =>$tme,'Month'=>$mnt,'Year'=>$year,'Time'=>$tme,'Payment_Mode'=>"SB ACCOUNT",'Bid'=>$branch,'CreatedBy'=>$UID]); 
				
				$sb=DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$sbremamt]);	
				
				$sb=DB::table('staffloan_repay')->where('SLRepay_Id',$slTran)
				->update(['SLRepay_SbTranId'=>$sbtran]);				
			}
			else if($paymode=="CD")
			{
				$staff_no1=DB::table('staffloan_allocation')->select('StfLoan_Number')
				->where('StfLoanAllocID',$DepAlID)
				->first();
				$staff_no=$staff_no1->StfLoan_Number;  
				DB::table('compulsory_deposi')->insert(['CD_Bid'=>$bid,'CD_Amount'=>$payAmt_tot,'CD_Date'=>$RepayDte,'CD_Account'=>$staff_no,'CD_Type'=>"DEBIT"]);
				
			}
		}
		public function chargeslist() //For Branch wise Repor
		{
			
			$chargesList = DB::table('chareges')->select('charges_id','charges_name')->get();
			return $chargesList;
		}
		public function GetplCertificate($id)
		{
			$id=DB::table('personalloan_repay')->select('PLRepay_Date','PLRepay_PLAllocID','PLRepay_PaidAmt','PLRepay_PayMode','PLRepay_Bid','PLRepay_CalculatedInterest','PLRepay_BuildingFund','PLRepay_Commission','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','PersLoan_Number','Old_PersLoan_Number','FirstName','MiddleName','LastName','PL_ReceiptNum')
			->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' , 'personalloan_repay.PLRepay_PLAllocID')
			->leftJoin('members','members.Memid', '=' ,'personalloan_allocation.MemId')
			->where('personalloan_repay.PLRepay_Id','=',$id)
			->get();
			
			return $id;
			
			
		}	
		
		public function GetjlCertificate($id)
		{
			$id=DB::table('jewelloan_repay')
			->select('JLRepay_Id','JLRepay_Date','JLRepay_JLAllocID','JLRepay_PaidAmt','JLRepay_PayMode','JLRepay_interestcalculated','JLRepay_interestpaid','JLRepay_interestpending','JLRepay_paidtoprincipalamt','JewelLoan_LoanNumber','jewelloan_Oldloan_No','FirstName','MiddleName','LastName','JewelLoan_LoanRemainingAmount','jL_ReceiptNum')
			->leftJoin('jewelloan_allocation', 'jewelloan_allocation.JewelLoanId', '=' , 'jewelloan_repay.JLRepay_JLAllocID')
			->leftJoin('user', 'user.Uid', '=' , 'jewelloan_allocation.JewelLoan_Uid')
			->where('jewelloan_repay.JLRepay_Id','=',$id)
			->first();
			
			return $id;
			
			
		}
		
		public function Getjlcharges($id)
		{
			$datadetails=DB::table('jewelloan_repay')->select('JLRepay_JLAllocID','JLRepay_Date')
			->where('jewelloan_repay.JLRepay_Id','=',$id)
			->first();
			$jlallocid=$datadetails->JLRepay_JLAllocID;
			$jldata=$datadetails->JLRepay_Date;
			return DB::table('charges_tran')->select('charg_id','amount','charges_name')
			->join('chareges','chareges.charges_id','=','charges_tran.charges_id')
			->where('loanid','=',$jlallocid)
			->where('charg_tran_date','=',$jldata)
			->where('loantype','=',"JL")
			->get();
		}
		public function GetLoanrepay($id)
		{
			$LoanId=$id['LoanDD'];
			$PLoanTId=$id['PLoanDD'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$loanrepayid=$id['loanid'];
			if($LoanId=="PERSONAL_LOAN")
			{
				
				if($PLoanTId=="ASL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"ASL")->first();
					$pltid = $pltid1->LoanType_ID;
					
					$id=DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
					->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_repay.PLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->paginate(20);
					return $id;
				}
				else if($PLoanTId=="CSL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"CSL")->first();
					$pltid = $pltid1->LoanType_ID;
					$id=DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
					->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_repay.PLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->paginate(20);
					return $id;
				}
				else if($PLoanTId=="AMTL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"AMTL")->first();
					$pltid = $pltid1->LoanType_ID;
					$id=DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
					->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_repay.PLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->paginate(20);
					return $id;
				}
				else if($PLoanTId=="CMTL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"CMTL")->first();
					$pltid = $pltid1->LoanType_ID;
					$id=DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
					->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_repay.PLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->paginate(20);
					return $id;
				}
				else if($PLoanTId=="ALL")
				{
					
					$id=DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
					->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
					->whereRaw("DATE(personalloan_repay.PLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->paginate(20);
					return $id;
				}
				
				else if($PLoanTId=="single")
				{
					
					$id=DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
					->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
					->whereRaw("DATE(personalloan_repay.PLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->where('PLRepay_PLAllocID','=',$loanrepayid)
					->paginate(20);
					return $id;
				}
				
				
			}
			else if($LoanId=="DEPOSITE_LOAN")
			{
				if($loanrepayid=="undefined")
				{
					$id=DB::table('depositeloan_repay')
					->select('DLRepay_ID','DLRepay_Date','DLRepay_DepAllocID','DLRepay_PaidAmt','DLRepay_Interestcalculated','DLRepay_InterestPaid','DLRepay_InterestPending','DLRepay_PrincipalPaid','DepLoan_LoanNum','Old_loan_number','DepLoan_AccNum','Old_Accnum','DepLoan_DepositeType','FirstName','MiddleName','LastName')
					->leftJoin('depositeloan_allocation', 'depositeloan_allocation.DepLoanAllocId', '=' , 'depositeloan_repay.DLRepay_DepAllocID')
					->leftJoin('user', 'user.Uid', '=' , 'depositeloan_allocation.DepLoan_Uid')
					->whereRaw("DATE(depositeloan_repay.DLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->paginate(20);
					return $id;
				}
				else
				{
					$id=DB::table('depositeloan_repay')
					->select('DLRepay_ID','DLRepay_Date','DLRepay_DepAllocID','DLRepay_PaidAmt','DLRepay_Interestcalculated','DLRepay_InterestPaid','DLRepay_InterestPending','DLRepay_PrincipalPaid','DepLoan_LoanNum','Old_loan_number','DepLoan_AccNum','Old_Accnum','DepLoan_DepositeType','FirstName','MiddleName','LastName')
					->leftJoin('depositeloan_allocation', 'depositeloan_allocation.DepLoanAllocId', '=' , 'depositeloan_repay.DLRepay_DepAllocID')
					->leftJoin('user', 'user.Uid', '=' , 'depositeloan_allocation.DepLoan_Uid')
					->whereRaw("DATE(depositeloan_repay.DLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
					->where('DLRepay_DepAllocID','=',$loanrepayid)
					->paginate(20);
					return $id;
				}
				
			}
			else if($LoanId=="STAFF_LOAN")
			{
				$id=DB::table('staffloan_allocation')
				->select('staffloan_allocation.Uid','StfLoan_Number','staffloan_allocation.Bid','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','LoanduratiobDays','Staff_Surety','Loan_Type','StartDate','EndDate','StaffLoan_LoanRemainingAmount','EMI_Amount','StfLoanAllocID')
				->leftJoin('user', 'user.Uid', '=' , 'staffloan_allocation.Uid')
				->whereRaw("DATE(staffloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(20);
				return $id;
			}
			
			else if($LoanId=="JEWEL_LOAN")
			{
				$id=DB::table('jewelloan_repay')
				->select('JLRepay_Id','JLRepay_Date','JLRepay_JLAllocID','JLRepay_PaidAmt','JLRepay_PayMode','JLRepay_interestcalculated','JLRepay_interestpaid','JLRepay_interestpending','JLRepay_paidtoprincipalamt','JewelLoan_LoanNumber','jewelloan_Oldloan_No','FirstName','MiddleName','LastName','JewelLoan_LoanRemainingAmount')
				->leftJoin('jewelloan_allocation', 'jewelloan_allocation.JewelLoanId', '=' , 'jewelloan_repay.JLRepay_JLAllocID')
				->leftJoin('user', 'user.Uid', '=' , 'jewelloan_allocation.JewelLoan_Uid')
				->whereRaw("DATE(jewelloan_repay.JLRepay_Date) BETWEEN '".$start."' AND '".$end."'")
				->paginate(20);
				return $id;
			}
			
			
		}
		public function GetdlCertificate($id)
		{
			$id= DB::table('depositeloan_repay')->select('DLRepay_Date','DLRepay_PaidAmt','FirstName','MiddleName','LastName','DepLoan_LoanNum','Old_loan_number','dL_ReceiptNum','DLRepay_InterestPaid','DLRepay_PrincipalPaid','DepLoan_RemailningAmt')
			->leftJoin('depositeloan_allocation','depositeloan_allocation.DepLoanAllocId','=','depositeloan_repay.DLRepay_DepAllocID')
			->leftJoin('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			//->leftJoin('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('DLRepay_ID','=',$id)
			->first();
			
			return $id;
		}
		
		public function Getdlcharges($id)
		{
			$datadetails= DB::table('depositeloan_repay')->select('DLRepay_Date','DLRepay_DepAllocID')
			->where('DLRepay_ID','=',$id)
			->first();
			$dlallocid=$datadetails->DLRepay_DepAllocID;
			$repaydate=$datadetails->DLRepay_Date;
			return DB::table('charges_tran')->select('charg_id','amount','charges_name')
			->join('chareges','chareges.charges_id','=','charges_tran.charges_id')
			->where('loanid','=',$dlallocid)
			->where('charg_tran_date','=',$repaydate)
			->where('loantype','=',"DL")
			->get();
		}
		
		public function DL_Renew_Allocation($id)
		{
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$dte=date('Y-m-d');
			
			$BranchID= DB::table('branch')->select('BCode')
			->where('branch.Bid','=',$BID)
			->first();
			$BranchCode=$BranchID->BCode;
			
			$maxid=DB::table('depositeloan_allocation')->where('DepLoan_Branch','=',$BID)->max('DepLoanAllocId');
			$accnum1=DB::table('depositeloan_allocation')->select('DepLoan_LoanNum')->where('DepLoanAllocId','=',$maxid)->first();
			$accnum=$accnum1->DepLoan_LoanNum;
			print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
			$paccno2=$matches[2];
			
			$paccno3=intval($paccno2)+1;
			$paccno="PCISDL".$BranchCode.$paccno3;
			
			
			$existingloannumber=$id['loannum'];
			$loandata=DB::table('depositeloan_allocation')->where('DepLoan_LoanNum',$existingloannumber)->first();
			$DepLoan_DepositeType=$loandata->DepLoan_DepositeType;
			$DepLoan_LoanTypeID=$loandata->DepLoan_LoanTypeID;
			$DepLoan_Branch=$loandata->DepLoan_Branch;
			$DepLoan_AccNum=$loandata->DepLoan_AccNum;
			$DepLoan_LoanEndDate=$loandata->DepLoan_LoanEndDate;
			$DepLoan_Uid=$loandata->DepLoan_Uid;
			$DepLoanAllocId=$loandata->DepLoanAllocId;
			
			
			$lid = DB::table('depositeloan_allocation')->insertGetId(['DepLoan_DepositeType'=> $DepLoan_DepositeType,'DepLoan_LoanTypeID'=>$DepLoan_LoanTypeID,'DepLoan_Branch'=>$DepLoan_Branch,'DepLoan_AccNum'=>$DepLoan_AccNum,'DepLoan_LoanAmount'=>$id['DepLoanAmt'],'DepLoan_RemailningAmt'=>$id['DepLoanAmt'],'DepLoan_LoanCharge'=>$id['LoanCharge'],'DepLoan_LoanStartDate'=>$dte,'DepLoan_LoanEndDate'=>$DepLoan_LoanEndDate,'DepLoan_LoanDurationDays'=>"",'DepLoan_PaymentMode'=>$id['DepLoanPayMode'],'DepLoan_LoanNum'=>$paccno,'DepLoan_Uid'=>$DepLoan_Uid,'DepLoan_AuthBy'=>$UID,'DepLoan_lastpaiddate'=>$dte]);
			if($id['DepLoanPayMode']=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				
				$inhandcash1=$inhandcashh->InHandCash;
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$amt=$inhandcash1-$id['PayableAmount'];
				
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$amt]);
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$dte,'InhandTrans_Particular'=>"Amount Credited from Deposit Loan",'InhandTrans_Cash'=>$id['PayableAmount'],'InhandTrans_Bid'=>$BID,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$amt]);
				
			}
			else if($id['DepLoanPayMode']=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bnkid)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				$ResultAmt=($BankAmt-$id['PayableAmount']);
				
				DB::table('addbank')->where('Bankid','=',$bnkid)
				->update(['TotalAmt'=>$ResultAmt]);
			}
			else if($id['DepLoanPayMode']=="SB ACCOUNT")
			{
				
				
				
				$reportdatee=date('Y-m-d');
				$dm=date('m');
				$dy=date('Y');
				$tm=date('h:i:s');
				$a=$id['DepSBAvail'];
				$amt1=$id['PayableAmount'];
				$amount=$a+$amt1;
				
				$sbtran=DB::table('sb_transaction')->insertGetId(['Accid'=>$id['accid'],'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"Deposite Loan Amount",'Amount'=>$id['PayableAmount'],'CurrentBalance'=>$id['DepSBAvail'],'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Time'=>$tm,'Month'=>$dm,'Year'=>$dy,'Total_Bal'=>$amount,'Bid'=>$DepLoan_Branch,'Payment_Mode'=>"DL LOAN",'CreatedBy'=>$UID]);
				
				$ACID=$id['accid'];
				$sb=DB::table('createaccount')->where('Accid',$ACID)
				->update(['Total_Amount'=>$amount]);	
			}
			$n=$id['loopid'];
			$charges=$id['charges'];
			$chaamount=$id['amount'];
			$loanintrest=$id['old_interst_amt'];
			$loanpendingamt=$id['old_principalamt'];
			$chargsum=0;
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
				
				$head_sub=DB::table('chareges')->select('head','subhead')
				->where('charges_id',$x)
				->first();
				$head=$head_sub->head;
				$subhead=$head_sub->subhead;
				
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$DepAlID,'bid'=>$bid,'charg_tran_date'=>$dte,'loantype'=>"DL",'LedgerHeadId'=>$head,'SubLedgerId'=>$subhead]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
				
			}
			$payAmt=$chargsum+$loanintrest+$loanpendingamt;
			$DLTran=DB::table('depositeloan_repay')->InsertGetId(['DLRepay_DepAllocID'=>$DepLoanAllocId,'DLRepay_PaidAmt'=>$payAmt,'DLRepay_PayMode'=>"LOAN RENEWAL",'DLRepay_Bid'=>$DepLoan_Branch,'Created_By'=>$UID,'DLRepay_Date'=>$dte,'DLRepay_Interestcalculated'=>$loanintrest,'DLRepay_InterestPaid'=>$loanintrest,'DLRepay_InterestPending'=>'0','DLRepay_PrincipalPaid'=>$loanpendingamt,'Dl_Cheque_Status'=>"1"]);
			
			DB::table('depositeloan_allocation')
			->where('DepLoanAllocId',$existingloannumber)
			->update(['DepLoan_RemailningAmt'=>'0','DepLoan_RemailninginterestAmt'=>'0','DepLoan_lastpaiddate'=>$dte,'LoanClosed_State'=>"YES"]);
			
		}
		public function adjustment_num() 
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$data=DB::table('branch_to_branch')
			//->select(DB::raw('Branch_Id as id, Branch_Id as name'))
			->select(DB::raw('Branch_Id as id, CONCAT(`Branch_Id`,"-",`Branch_per`) as name'))
			->where('Branch_Branch2_Id','=',$BID)
			->get();
			return $data;
		}
		public function FdClosedAcc_Unpaid()
		{
		$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			return DB::table('fdallocation')->select(DB::raw('Fdid as id, CONCAT(`Fd_CertificateNum`,"-",`Fd_OldCertificateNum`) as name'))
			->where('Closed','=',"YES")->where('Paid_State','=','UNPAID')->where('Bid','=',$BID)->get();
		}
		
		public function fdCertTypeAhead()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			return DB::table('fdallocation')
//				->select("Fdid","Fd_CertificateNum","Fd_TotalAmt")
				->select(DB::raw('Fdid as id, `Fd_CertificateNum` as name'))
				->where('Closed','=',"YES")
				->where('Paid_State','=','UNPAID')
				->where('Bid','=',$BID)->get();
		}
		
		public function dateComp($data)
		{
			$first = $data['first'];
			$second = $data['second'];
			
			if(strtotime($first) > strtotime($second)) {
				return 1;
			} else {
				return 0;
			}
			
			return $days;
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
		
		public function getFdAdjAmt($data)
		{
			$Fd_CertificateNum = $data['Fd_CertificateNum'];
			if($data['Fd_Withdraw']) {
				$amt = DB::table("fd_payamount")
					->where('FDPayAmt_AccNum','=',$Fd_CertificateNum)
					->value('FDPayAmt_PayableAmount');
			} else {
				$amt = DB::table("fd_prewithdrawal")
					->where('FdAcc_No','=',$Fd_CertificateNum)
					->value('TotalAmt_Payable');
			}
			
			if(empty($amt)) {
				$amt = DB::table("fd_prewithdrawal")
					->where('FdAcc_No','=',$Fd_CertificateNum)
					->value('TotalAmt_Payable');
			} else if(empty($amt)) {
				$amt = 0;
			}
			return $amt;
		}
		
		public function is_jl_first_repay_done($data)
		{
			$n = 0;
			$jlaccid = $data['jlaccid'];
			$jl_repay = DB::table('jewelloan_repay')
				->select()
				->where('JLRepay_JLAllocID','=',$jlaccid)
				->get();
			$n = count($jl_repay);
			//var_dump($n);
			if($n > 0) {
				return 1;
			} else {
				return 0;
			}
		}
		

	}

	
	