<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Controllers\ReceiptVoucherController;

	class UnclearedChequeModel extends Model
	{
		protected $table = 'sb_transaction';

		public function __construct()
		{
			$this->rv_no = new ReceiptVoucherController;
		}
		
		//Uncleared SB Cheque Detail
		public function get_transdetail()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			
			return DB::table('sb_transaction')
			->join('createaccount','createaccount.Accid','=','sb_transaction.Accid')
			->join('user','createaccount.Uid','=','user.Uid')
			->select('tran_Date','AccNum','FirstName','MiddleName','LastName','Cheque_Number','Cheque_Date','Bank_Name','Bank_Branch','IFSC_Code','Uncleared_Bal','sb_transaction.Tranid','createaccount.Accid','user.Uid','TransactionType','Cleared_State')
			->where('Cleared_State','=','UNCLEARED')
			->where('TransactionType','=','CREDIT')
			->where('sb_transaction.Bid','=',$BID)
			->get();
		} 
		
		//Uncleared RD Cheque Detail
		public function get_rdtransdetail()
		{
			
			return DB::table('rd_transaction')
			->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->join('user','createaccount.Uid','=','user.Uid')
			->select('RD_Date','AccNum','FirstName','MiddleName','LastName','RDCheque_Number','RDCheque_Date','RDBank_Name','RDBank_Branch','RDIFSC_Code','RDUncleared_Bal','RD_TransID','createaccount.Accid','user.Uid','RD_Trans_Type','RDCleared_State')
			->where('RDCleared_State','=','UNCLEARED')
			->get();
		}
		
		//Uncleared Pigmi Cheque Detail
		public function get_pgmtransdetail()
		{
			
			return DB::table('pigmi_transaction')
			->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
			->join('user','user.Uid','=','pigmiallocation.Uid')
			->select('Trans_Date','PigmiAcc_No','FirstName','MiddleName','LastName','PgmCheque_Number','PgmCheque_Date','PgmBank_Name','PgmBank_Branch','PgmIFSC_Code','PgmUncleared_Bal','PigmiTrans_ID','pigmiallocation.PigmiAllocID','user.Uid','Transaction_Type','PgmCleared_State')
			->where('PgmCleared_State','=','UNCLEARED')
			->get();
		}
		
		//Uncleared Loan Cheque Detail
		public function get_dlcheque()
		{
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('depositeloan_repay')
			->select('FirstName','MiddleName','LastName','DLRepay_PaidAmt','Dl_Cheque_No','Dl_Cheque_Date','Dl_BankName','Dl_BankBranch','Dl_IFSC','DepLoan_LoanNum','DepLoan_AccNum','Old_loan_number','Old_Accnum','DLRepay_ID')
			->join('depositeloan_allocation','depositeloan_allocation.DepLoanAllocId','=','depositeloan_repay.DLRepay_DepAllocID')
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('Dl_Cheque_Status','=',"1")
			->where('DLRepay_Bid','=',$BID)
			->where('DLRepay_PayMode','=',"CHEQUE")
			->get();
		}
		public function get_plcheque()
		{
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('personalloan_repay')
			->select('FirstName','MiddleName','LastName','PLRepay_PaidAmt','PL_ChequeNO','PL_ChequeDate','PL_BankName','PL_BankBranch','PL_IFSC','PersLoan_Number','Old_PersLoan_Number','PLRepay_Id')
			->join('personalloan_allocation','personalloan_allocation.PersLoanAllocID','=','personalloan_repay.PLRepay_PLAllocID')
			->join('members','members.Memid','=','personalloan_allocation.MemId')
			->where('PL_ChequeStatus','=',"1")
			->where('PLRepay_Bid','=',$BID)
			->where('PLRepay_PayMode','=',"CHEQUE")
			->get();
		}
		
		public function get_jlcheque()
		{
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('jewelloan_repay')
			->select('FirstName','MiddleName','LastName','JLRepay_PaidAmt','JL_ChequeNo','JL_ChequeDate','JL_BankName','JL_BankBranch','JL_IFSC','JewelLoan_LoanNumber','jewelloan_Oldloan_No','JLRepay_Id')
			->join('jewelloan_allocation','jewelloan_allocation.JewelLoanId','=','jewelloan_repay.JLRepay_JLAllocID')
			->join('user','user.Uid','=','jewelloan_allocation.JewelLoan_Uid')
			->where('JL_Status','=',"1")
			->where('JLRepay_Bid','=',$BID)
			->where('JLRepay_PayMode','=',"CHEQUE")
			->get();
		}
		
		//Uncleared FD Cheque Detail
		
		public function get_fdtransdetail()
		{
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('fdallocation')
			// ->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
			->join('user','user.Uid','=','fdallocation.Uid')
			->join('addbank','addbank.Bankid','=','fdallocation.FDBnk_ID')
			->select('FD_StartDate',/*'AccNum',*/'FirstName','MiddleName','LastName','FDChq_No','FDChq_Date','BankName','FDBnk_Branch','FDIFSC_Code','FDUnclear_Bal','Fdid','fdallocation.Accid','user.Uid','FDCleared_State', 'FDBnk_Name')
			->where('FDCleared_State','=','UNCLEARED')
			->where('FdTid','!=',1)
			->where('fdallocation.Bid', $BID)
			->get();
		}
		public function get_kcctransdetail()
		{
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('fdallocation')
			// ->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
			->join('user','user.Uid','=','fdallocation.Uid')
			->join('addbank','addbank.Bankid','=','fdallocation.FDBnk_ID')
			->select('FD_StartDate',/*'AccNum',*/'FirstName','MiddleName','LastName','FDChq_No','FDChq_Date','BankName','FDBnk_Branch','FDIFSC_Code','FDUnclear_Bal','Fdid','fdallocation.Accid','user.Uid','FDCleared_State', 'FDBnk_Name')
			->where('FDCleared_State','=','UNCLEARED')
			->where('FdTid','=',1)
			->where('fdallocation.Bid', $BID)
			->get();
		}
		
		public function get_Expensedetail()
		{
			return DB::table('expense')
			->join('addbank','addbank.Bankid','=','expense.bank_id')
			->select('SocietyBranch','BankName','AccountNo','Branch','AddBank_IFSC','cheque_no','cheque_date','amount','expense.id','e_date','addbank.Bankid')
			->where('ChequeClear_State','=','UNCLEARED')
			->get();
		}
		
		public function ClearCheque($id)
		{
		
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
			$dte=date('Y-m-d');
			$m=date('m');
			$y=date('Y');
			$sb=DB::table('sb_transaction')
			->select('AccTid','particulars','tran_Date','SBReport_TranDate','Time','Month','Year','Amount','CurrentBalance','Total_Bal','TransactionType','Accid','CreditBankId','Cheque_Number','Cheque_Date','Bank_Name','Bank_Branch','Bid','Payment_Mode','IFSC_Code','CreatedBy')
			->where('Tranid',$id['tid'])
			->first();
			
			$tt=$sb->TransactionType;
			$particulars=$sb->particulars;
			$Cheque_Number=$sb->Cheque_Number;
			$Cheque_Date=$sb->Cheque_Date;
			$Bank_Name=$sb->Bank_Name;
			$Bank_Branch=$sb->Bank_Branch;
			$Bid=$sb->Bid;
			$CreditBankId=$sb->CreditBankId;
			$CreatedBy=$sb->CreatedBy;
			$accid=$sb->Accid;
			$actualtotamt1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
			$val=$id['cheqchrge'];
			$actualtotamt=$actualtotamt1->Total_Amount;
			
			$amt=$sb->Amount;
			$amt1=floatval($amt)-floatval($val);
			$cb=$actualtotamt;
			//$tot=(floatval($amt)+floatval($cb))-floatval($val);
			$tot=(floatval($amt)+floatval($cb));
			$crbal=$actualtotamt;
			$tot1=$tot-floatval($val);
			DB::table('sb_transaction')->insert(['Accid'=>$accid,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>$particulars,'Amount'=>$amt,'CurrentBalance'=>$crbal,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$tot,'Bid'=>$Bid,'Payment_Mode'=>"CHEQUE",'Cheque_Number'=>$Cheque_Number,'Cheque_Date'=>$Cheque_Date,'Cleared_State'=>"CLEARED",'Uncleared_Bal'=>"0",'Bank_Name'=>$Bank_Name,'Bank_Branch'=>$Bank_Branch,'ChequeClear_Date'=>$dte,'ChequeAuthorisedBY'=>$UID,'CreatedBy'=>$CreatedBy,'CreditBankId'=>$CreditBankId]);
			
			DB::table('sb_transaction')->insert(['Accid'=>$accid,'AccTid'=>"1",'TransactionType'=>"DEBIT",'particulars'=>"CHEQUE CHAREGE",'Amount'=>$val,'CurrentBalance'=>$tot,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$tot1,'Bid'=>$Bid,'Payment_Mode'=>"CHEQUE",'Cheque_Number'=>$Cheque_Number,'Cheque_Date'=>$Cheque_Date,'Cleared_State'=>"CLEARED",'Uncleared_Bal'=>"0",'Bank_Name'=>$Bank_Name,'Bank_Branch'=>$Bank_Branch,'ChequeClear_Date'=>$dte,'ChequeAuthorisedBY'=>$UID,'CreatedBy'=>$CreatedBy,'CreditBankId'=>$CreditBankId]);
			
			$aid=DB::table('createaccount')->where('Accid',$accid)
			->update(['Total_Amount'=>$tot1]);
			
			
			$id=DB::table('sb_transaction')->where('Tranid',$id['tid'])
			->update(['Cleared_State'=>"CLEARED",'ChequeClear_Date'=>$dte]);
			/*$id=DB::table('sb_transaction')->where('Tranid',$id['tid'])
			->update(['Cleared_State'=>"CLEARED",'CurrentBalance'=>$crbal,'Total_Bal'=>$tot,'Uncleared_Bal'=>0,'ChequeClear_Date'=>$dte,'Amount'=>$amt1]);
			
			*/
			
			
			$bankamt1=DB::table('addbank')->select('TotalAmt')->where('Bankid',$CreditBankId)->first();
			$bankamt=$bankamt1->TotalAmt;
			$bankupdateamt=$bankamt+$amt;
			
			DB::table('addbank')->where('Bankid',$CreditBankId)->update(['TotalAmt'=>$bankupdateamt]);
			/***************FETCH SUB HEAD ID OF BANK ************/
				$bank_id = $CreditBankId;
				$dep_subhead_id = DB::table("addbank")->where("Bankid",$bank_id)->value("SubLedgerId");
			/***************FETCH HEAD ID OF BANK ************/
			$deposit_id = DB::table('deposit')->insertGetId(['Bid'=>$Bid,'d_date'=>$dte,'date'=>$dte,'depo_bank_id'=>$CreditBankId,'pay_mode'=>"CHEQUE",'cheque_no'=>$Cheque_Number,'cheque_date'=>$Cheque_Date,'bank_name'=>$Bank_Name,'amount'=>$amt,'reason'=>$particulars,'cd'=>$dte,'Deposit_type'=>"Deposit", 'paid'=>'yes',"SubLedgerId"=>$dep_subhead_id ]);
				// ADJ NO FOR BANK DEPOSIT
				/***********/
				$fn_data["rv_payment_mode"] = "ADJUSTMENT";
				$fn_data["rv_transaction_id"] = $deposit_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			//INCOME ENTRY FOR CHEQUE CHARGE
				$insert_data["Income_Head_lid"] = 88;
				$insert_data["Income_SubHead_lid"] = 85;	//	BANK CHARGES SUBHEAD UNDER OTHER INCOME HEAD IS NOT PRESENT. SO OHTER INCOME SUBHEAD UNDER OTHER INCOME HEAD(85)
				$insert_data["Income_date"] = $dte;
				$insert_data["Income_cheque_no"] = $Cheque_Number;
				$insert_data["Income_cheque_date"] = $Cheque_Date;
				$insert_data["Bid"] = $Bid;
				$insert_data["Income_pay_mode"] = "ADJUSTMENT";
				$insert_data["Income_amount"] = $val;
				$insert_data["Income_Particulars"] = "CHEQUE CHARGE - {$Cheque_Number}";
				$insert_data["Income_ExpenseBy"] = $UID;
				$income_id = DB::table("income")
					->insertGetId($insert_data);
				
				// NO ADJ NO FOR ADJ CREDIT
			
			return $id;							   
		}
		
		
		
		public function ClearRDCheque($id)
		{
			$dte=date('d-m-Y');
			$rd=DB::table('rd_transaction')
			->select('RD_Amount','RD_CurrentBalance','RD_Total_Bal','Accid')
			->where('RD_TransID',$id)
			->first();
			
			$amt=$rd->RD_Amount;
			$cb=$rd->RD_CurrentBalance;
			$accid=$rd->Accid;
			$tot=($amt+$cb);
			$crbal=$tot;
			
			
			$id=DB::table('rd_transaction')->where('RD_TransID',$id)
			
			->update(['RDCleared_State'=>"CLEARED",'RD_CurrentBalance'=>$crbal,'RD_Total_Bal'=>$tot,'RDUncleared_Bal'=>0,'RDChequeClear_Date'=>$dte]);
			
			$aid=DB::table('createaccount')->where('Accid',$accid)
			
			->update(['Total_Amount'=>$tot]);		
			
			return $id;							   
			
			
		}
		
		public function ClearPgmCheque($id)
		{
			$dte=date('d-m-Y');
			$pgm=DB::table('pigmi_transaction')
			->select('Amount','Current_Balance','Total_Amount','PigmiAllocID')
			->where('PigmiTrans_ID',$id)
			->first();
			
			$amt=$pgm->Amount;
			$cb=$pgm->Current_Balance;
			$paid=$pgm->PigmiAllocID;
			$tot=($amt+$cb);
			$crbal=$tot;
			
			
			$pid=DB::table('pigmi_transaction')->where('PigmiTrans_ID',$id)
			
			->update(['PgmCleared_State'=>"CLEARED",'Current_Balance'=>$crbal,'Total_Amount'=>$tot,'PgmUncleared_Bal'=>0,'PgmChequeClear_Date'=>$dte]);
			
			$id=DB::table('pigmiallocation')->where('PigmiAllocID',$paid)
			
			->update(['Total_Amount'=>$tot]);
			return $id;							   
			
			
		}	
		
		public function ClearloanCheque($id)
		{
			$dte=date('d-m-Y');
			
			$loan=DB::table('loan_transaction')
			->select('LoanTrans_AmtPaid','LoanTrans_RemTotal','LoanTrans_RemAmt','Accid')
			->where('LoanTrans_ID',$id)
			->first();
			
			$amt=$loan->LoanTrans_AmtPaid;
			//$lnremtot=$loan->LoanTrans_RemTotal;
			$lnrem=$loan->LoanTrans_RemAmt;
			$acid=$loan->Accid;
			$tot=($lnrem-$amt);
			$lnremtot=$tot;
			
			
			$lid=DB::table('loan_transaction')->where('LoanTrans_ID',$id)
			
			->update(['LoanChqCleared_State'=>"CLEARED",'LoanTrans_RemTotal'=>$lnremtot,'LoanUncleared_Bal'=>0,'LoanTrans_Chqdte'=>$dte]);
			
		    $id=DB::table('loanremaining_balance')->where('Accid',$acid)
			->update(['Loan_TotalRem'=>$lnremtot]);
			return $id;							   
			
			
		}
		
		//Clear FD Cheque
		public function ClearfdCheque($id)
		{
			$dte=date('d-m-Y');
			
			/* $loan=DB::table('fdallocation')
				->select('FD_DepositAmt','Accid')
				->where('Fdid',$id)
				->first();
				
				$amt=$loan->LoanTrans_AmtPaid;
				//$lnremtot=$loan->LoanTrans_RemTotal;
				$lnrem=$loan->LoanTrans_RemAmt;
				$acid=$loan->Accid;
				$tot=($lnrem-$amt);
			$lnremtot=$tot;*/
			
			
			$lid=DB::table('fdallocation')->where('Fdid',$id)
			
			->update(['FDCleared_State'=>"CLEARED",'FDUnclear_Bal'=>0,'FDChq_date'=>$dte]);
			
			/* $id=DB::table('loanremaining_balance')->where('Accid',$acid)
			->update(['Loan_TotalRem'=>$lnremtot]);*/
			return $id;							   
			
			
		}
		
		public function Expense_clear($id)
		{
			$dte=date('d-m-Y');
			
			$eid=DB::table('expense')->where('id',$id)
			->update(['ChequeClear_State'=>"CLEARED",'ChequeClear_Date'=>$dte]);
			
			return $id;							   
			
			
		}
		
		public function RejectCheque($id)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$dte=date('d-m-Y');
			$trid=$id['tid'];
			$chqchrge=$id['cheqchrge'];
			$sb=DB::table('sb_transaction')
			->select('Amount','CurrentBalance','Total_Bal','Accid','CreditBankId')
			->where('Tranid',$trid)
			->first();
			//$pm=$sb->Payment_Mode;
			//if($pm=="CEDIT")
			//{
			$amt=$sb->Amount;
			$cb=$sb->CurrentBalance;
			$ac=$sb->Accid;
			$CreditBankId=$sb->CreditBankId;
			$actualbankamt=$id['bankamt'];
			$tot=($cb-$chqchrge);
			$crbal=$tot;
			//}
			
			$id=DB::table('sb_transaction')->where('Tranid',$trid)
			
			->update(['Cleared_State'=>"REJECTED",'ChequeClear_Date'=>$dte,'Chq_bounce_charge'=>$chqchrge,'CurrentBalance'=>$crbal,'Total_Bal'=>$tot]);
			
			$aid=DB::table('createaccount')->where('Accid',$ac)
			
			->update(['Total_Amount'=>$tot]);	
			
			
			$bankamt1=DB::table('addbank')->select('TotalAmt')->where('Bankid',$CreditBankId)->first();
			$bankamt=$bankamt1->TotalAmt;
			$bankupdateamt=$bankamt-$chqchrge;//$actualbankamt;
			
			DB::table('addbank')->where('Bankid',$CreditBankId)->update(['TotalAmt'=>$bankupdateamt]);

			/**************** bank entrty *****************/
				$sb_tran_info = DB::table("sb_transaction")
					->where("Tranid", $trid)
					->first();

				$date= date("Y-m-d");
				$bank_id = $CreditBankId;
				$cheque_no = "";
				$cheque_date = "";
				$amount = $chqchrge;
				$reason = "CHEQUE RETURN";
				$Deposit_type = "WITHDRAWL";
				
				$addbank = DB::table('addbank')
					->where('Bankid','=',$bank_id)
					->first();
				/***************FETCH SUB HEAD ID OF BANK ************/
					$bank_id = $bank_id;
					$dep_subhead_id = DB::table("addbank")->where("Bankid",$bank_id)->value("SubLedgerId");
				/***************FETCH HEAD ID OF BANK ************/

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = date("d-m-Y",strtotime($date));
				$insert_array["date"] = date("Y-m-d",strtotime($date));
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "ADJUSTMENT";
				$insert_array["cheque_no"] = $cheque_no;
				$insert_array["cheque_date"] = $cheque_date;
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $amount;
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = $reason;
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = $Deposit_type;
				$insert_array["SubLedgerId"] = $dep_subhead_id;

				$insert_id = DB::table("deposit")
					->insertGetId($insert_array);
				/**************** bank entrty *****************/
					//GENERATE ADJ NO.
						/***********/
						unset($fn_data);
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $insert_id;
						$fn_data["rv_transaction_type"] = "CREDIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $date;
						$fn_data["rv_bid"] = $BID;
						$adj_no = $this->rv_no->save_rv_no($fn_data);
						/***********/

					
				/**************** expense entrty *****************/
				unset($ia);
				$ia["Head_lid"] = 111;
				$ia["SubHead_lid"] = 194;
				$ia["e_date"] = date("Y-m-d");
				$ia["Bid"] = $BID;
				$ia["pay_mode"] = "ADJUSTMENT";
				$ia["amount"] = $chqchrge;
				$ia["Particulars"] = "CHEQUE RETURN CHARGE";
				$ia["ExpenseBy"] = $UID;
				$insert_id = DB::table("expense")
					->insertGetId($ia);
					//GENERATE ADJ NO.
					/***********/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $insert_id;
					$fn_data["rv_transaction_type"] = "DEBIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::EXPENSE;//constant EXPENSE is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = date("Y-m-d");
					$fn_data["rv_bid"] = $BID;
					$adj_no = $this->rv_no->save_rv_no($fn_data);
					/***********/
				/**************** expense entrty *****************/

				/**************** sb tran entrty *****************/
					/* $ia_sb = array(
						"Accid"=>$sb_tran_info->Accid,
						"AccTid"=>1,
						"TransactionType"=>"DEBIT",
						"particulars"=>"CHEQUE RETURN CHARGE - {$sb_tran_info->Cheque_Number}",
						"Amount"=>$chqchrge,
						"tran_Date"=>$date,
						"SBReport_TranDate"=>$date,
						"Time"=>date("Y-m-d H:i:s"),
						"Month"=>date("m",strtotime($date)),
						"Year"=>date("Y",strtotime($date)),
						"Bid"=>$BID,
						"Payment_Mode"=>"ADJUSTMENT",
						"CreatedBy"=>$UID,
						"tran_reversed"=>"NO"
					);
					$sb_tran_id = DB::table("sb_transaction")
						->insertGetId($ia_sb); */
					
					/****** SB CREDIT *****/
					/* unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $sb_tran_id;
					$fn_data["rv_transaction_type"] = "DEBIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SB_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = $date;
					$fn_data["rv_bid"] = $BID;
					$this->rv_no->save_rv_no($fn_data); */
					/***********/
				/**************** sb tran entrty *****************/


			return $id;	
		}
		
		public function RDRejectCheque($id)
		{
			$dte=date('d-m-Y');
			$trid=$id['tid'];
			$chqchrge=$id['cheqchrge'];
			$rd=DB::table('rd_transaction')
			->select('RD_Amount','RD_CurrentBalance','RD_Total_Bal','Accid')
			->where('RD_TransID',$trid)
			->first();
			//$pm=$sb->Payment_Mode;
			//if($pm=="CEDIT")
			//{
			$amt=$rd->RD_Amount;
			$cb=$rd->RD_CurrentBalance;
			$ac=$rd->Accid;
			$tot=($cb-$chqchrge);
			$crbal=$tot;
			//}
			
			$id=DB::table('rd_transaction')->where('RD_TransID',$trid)
			
			->update(['RDCleared_State'=>"REJECTED",'RDChequeClear_Date'=>$dte,'RDChq_bounce_charge'=>$chqchrge,'RD_CurrentBalance'=>$crbal,'RD_Total_Bal'=>$tot]);
			
			$aid=DB::table('createaccount')->where('Accid',$ac)
			
			->update(['Total_Amount'=>$tot]);		
			return $id;	
		}
		
		public function PgmRejectCheque($id)
		{
			$dte=date('d-m-Y');
			$trid=$id['tid'];
			$chqchrge=$id['cheqchrge'];
			$pgm=DB::table('pigmi_transaction')
			->select('Amount','Current_Balance','Total_Amount','PigmiAllocID')
			->where('PigmiTrans_ID',$trid)
			->first();
			
			$amt=$pgm->Amount;
			$cb=$pgm->Current_Balance;
			$paid=$pgm->PigmiAllocID;
			$tot=($cb-$chqchrge);
			$crbal=$tot;
			
			$pid=DB::table('pigmi_transaction')->where('PigmiTrans_ID',$trid)
			
			->update(['PgmCleared_State'=>"REJECTED",'PgmChequeClear_Date'=>$dte,'PgmChq_bounce_charge'=>$chqchrge,'Current_Balance'=>$crbal,'Total_Amount'=>$tot]);
			
			$id=DB::table('pigmiallocation')->where('PigmiAllocID',$paid)
			
			->update(['Total_Amount'=>$tot]);
			return $id;	
		}
		
		public function LoanRejectCheque($id)
		{
			$dte=date('d-m-Y');
			$trid=$id['tid'];
			$chqchrge=$id['cheqchrge'];
			$loan=DB::table('loan_transaction')
			->select('LoanTrans_AmtPaid','LoanTrans_RemTotal','LoanTrans_RemAmt','Accid')
			->where('LoanTrans_ID',$trid)
			->first();
			
			//$amt=$loan->Amount;
			//$cb=$pgm->Current_Balance;
			//$tot=($cb-$chqchrge);
			//$crbal=$tot;
			
			$id=DB::table('loan_transaction')->where('LoanTrans_ID',$trid)
			
			->update(['LoanChqCleared_State'=>"REJECTED",'LoanTrans_Chqdte'=>$dte]);
			return $id;	
		}
		
		public function FDRejectCheque($id)
		{
			$dte=date('d-m-Y');
			$trid=$id['tid'];
			$chqchrge=$id['cheqchrge'];
			/* $loan=DB::table('fdallocation')
				->select('FD_DepositAmt','LoanTrans_RemTotal','LoanTrans_RemAmt','Accid')
				->where('LoanTrans_ID',$trid)
			->first();*/
			
			$id=DB::table('fdallocation')->where('Fdid',$trid)
			
			->update(['FDCleared_State'=>"REJECTED",'FDChq_Date'=>$dte,'FDCheque_bounce'=>$chqchrge]);
			return $id;	
		}
		
		public function Expense_Reject($id)
		{
			$dte=date('d-m-Y');
			$trid=$id['tid'];
			$chqchrge=$id['cheqchrge'];
			
			$ex=DB::table('expense')
			->select('amount','bank_id')
			->where('id','=',$trid)
			->first();
			
			$amt=$ex->amount;
			$bid=$ex->bank_id;
			
			$bnk=DB::table('addbank')
			->select('TotalAmt')
			->where('Bankid','=',$bid)
			->first();
			
			$tot=$bnk->TotalAmt;
			$bal=$amt+$chqchrge;
			$totamt=$tot-$bal;
			
			DB::table('addbank')->where('Bankid',$bid)
			->update(['TotalAmt'=>$totamt]);
			
			$id=DB::table('expense')->where('id',$trid) 
			->update(['ChequeClear_State'=>"REJECTED",'ChequeClear_Date'=>$dte,'Chqbounce_charge'=>$chqchrge]);
			return $id;	
		}
		
		public function GetModuleData()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','unclearedcheque')
			->first();
			
			
			return $id;
		}
		
		
	}
