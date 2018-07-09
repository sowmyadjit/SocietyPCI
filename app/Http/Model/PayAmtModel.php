<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	
	class PayAmtModel extends Model
	{
		protected $table = 'pigmi_prewithdrawal';
		
		public function __construct() {
			$this->rv_no = new ReceiptVoucherController;
		}
		
		public function InsertPayAmount($id)
		{
			$paydate=date('d-m-Y');
			$paydatereport=date('Y-m-d');
			$PigAccNum=$id['account'];
			$PayMode=$id['PigPayMode'];
			$BankId=$id['BankId'];
			$PayableAmt=$id['PigPayableAmt'];
			$inttype=$id['PigIntMode'];
			$acid=$id['accid'];
			$amt=$id['sbremamt'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','BCode','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$Bcode=$udetail->BCode;
			$u=$udetail->Uid;
			
			$MaxReceipt=DB::table('pigmi_payamount')
			->where('PayAmount_ReceiptNum','LIKE','%'.$Bcode.'%')
			//->where('FD_PayAmount_ReceiptNum','<>',"0")
			->count('PayId');
			$RecYear=date('my');
			$ReceiptNum=$Bcode.$RecYear."PGW-".($MaxReceipt+1);
			
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
				$respit3=$respit2->payment_voucher_No;
				$r1=$respit3+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r1]);
			
			$pigmi_payamount_id = DB::table('pigmi_payamount')->insertGetId(['PayAmount_PigmiAccNum'=>$id['account'],'PayAmount_PaymentMode'=>$id['PigPayMode'],'PayAmount_ChequeNum'=>$id['PigPayChequeNum'],'PayAmount_ChequeDate'=>$id['PigPayChequeDate'],'PayAmount_PayableAmount'=>$id['PigPayableAmt'],'PayAmount_PayDate'=>$paydate,'PayAmountReport_PayDate'=>$paydatereport,'PayAmount_BankId'=>$id['BankId'],'PayAmount_IntType'=>$id['PigIntMode'],'PayAmount_ReceiptNum'=>$ReceiptNum,'PayAmount_PaymentVoucher'=>$r1,'Bid'=>$BID]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $PayMode;
				$fn_data["rv_transaction_id"] = $pigmi_payamount_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::PG_PAYAMOUNT;//constant PG_PAYAMOUNT is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $paydatereport;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			if($inttype=="PREWITHDRAWAL")
			{
				/***********/
				$fn_data["rv_payment_mode"] ="CASH";
				$fn_data["rv_transaction_id"] = $pigmi_payamount_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::PG_PAYAMOUNT;//PIGMI PREWITHDRAWAL DEDUCT AMOUNT
				$fn_data["rv_date"] = $paydatereport;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				DB::table('pigmi_prewithdrawal')->where('PigmiAcc_No','=',$PigAccNum)
				->update(['CashPaid_State'=>"PAID"]);
			}
			else//For Interest
			{
				DB::table('pigmi_interest')->where('PigmiAcc_No','=',$PigAccNum)
				->update(['Paid_State'=>"PAID"]);
			}
			
			if($PayMode=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$BankId)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				
				$ResultAmt=($BankAmt-$PayableAmt);
				
				DB::table('addbank')->where('Bankid','=',$BankId)
				->update(['TotalAmt'=>$ResultAmt]);
				
				//
				$addbank = DB::table('addbank')
				->where('Bankid','=',$BankId)
				->first();

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = $paydate;
				$insert_array["date"] = $paydatereport;
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "CHEQUE";
				$insert_array["cheque_no"] = $id['PigPayChequeNum'];
				$insert_array["cheque_date"] = $id['PigPayChequeDate'];
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $id['PigPayableAmt'];
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = "PIGMY PAY AMOUNT THROUGH CHEQUE";
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = "WITHDRAWL";

				DB::table("deposit")
					->insertGetId($insert_array);
				//NO NEED TO GENERATE RECEIPT/VOUCHER NO FOR ADJ CREDIT TRANSACTION
			}
			
			else if($PayMode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$tot=$inhandcash1-$PayableAmt;
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$tot]);
				
				$trandate=date('Y-m-d');
				$bid=$udetail->Bid;
				//$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Paid to Pygmy Customer",'InhandTrans_Cash'=>$PayableAmt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$tot]);
			}
			else
			{
				$reportdte=date('Y-m-d');
				$mnt=date('m');
				$year=date('Y');

				$sb_particulars = "Credited from Pygmy Account ({$PigAccNum})";

				DB::table('sb_transaction')->insertGetId(['Accid'=>$id['accid'],'AccTid' => $id['actid'],'TransactionType' => "CREDIT",'particulars' =>$sb_particulars,'Amount' =>$id['PigPayableAmt'],'CurrentBalance' => $id['sbavailamt'],'Total_Bal' => $id['sbremamt'],'tran_Date' => $reportdte,'SBReport_TranDate'=>$reportdte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$u,'bid'=>$BID,'Payment_Mode'=>"PIGMY"]);
				
				DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$amt]);
				
				
			}
		}
		
		
		public function InsertRDPayAmount($id)
		{
			$paydate=date('d-m-Y');
			$paydatereport=date('Y-m-d');
			$RDAccNum=$id['rdaccount'];
			$RDPayMode=$id['RDPayMode'];
			$BankId=$id['BankId'];
			$PayableAmt=$id['RDPayableAmt'];
			$inttype=$id['RDIntMode'];
			$acid=$id['accid'];
			$amt=$id['sbremamt'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','BCode','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$Bcode=$udetail->BCode;
			$u=$udetail->Uid;
			
			
			$MaxReceipt=DB::table('rd_payamount')
			->where('RD_PayAmount_ReceiptNum','LIKE','%'.$Bcode.'%')
			//->where('FD_PayAmount_ReceiptNum','<>',"0")
			->count('RDPayId');
			$RecYear=date('my');
			$ReceiptNum=$Bcode.$RecYear."RDW-".($MaxReceipt+1);
			
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
				$respit3=$respit2->payment_voucher_No;
				$r1=$respit3+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r1]);
				
			$rd_payamount_id = DB::table('rd_payamount')->insertGetId(['RDPayAmt_AccNum'=>$id['rdaccount'],'RDPayAmt_PaymentMode'=>$id['RDPayMode'],'RDPayAmt_ChequeNum'=>$id['RDPayChequeNum'],'RDPayAmt_ChequeDate'=>$id['RDPayChequeDate'],'RDPayAmt_PayableAmount'=>$id['RDPayableAmt'],'RDPayAmt_PayDate'=>$paydate,'RDPayAmtReport_PayDate'=>$paydatereport,'RDPayAmt_BankId'=>$id['BankId'],'RDPayAmt_IntType'=>$id['RDIntMode'],'RD_PayAmount_ReceiptNum'=>$ReceiptNum,'RD_PayAmount_pamentvoucher'=>$r1,'Bid'=>$BID]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $RDPayMode;
				$fn_data["rv_transaction_id"] = $rd_payamount_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::RD_PAYAMOUNT;//constant RD_PAYAMOUNT is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $paydatereport;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			if($inttype=="PREWITHDRAWAL")
			{
				DB::table('rd_prewithdrawal')->where('RdAcc_No','=',$RDAccNum)
				->update(['CashPaid_State'=>"PAID"]);
			}
			else//For Interest
			{
				DB::table('rd_interest')->where('RdAcc_No','=',$RDAccNum)
				->update(['Paid_State'=>"PAID"]);
			}
			
			if($RDPayMode=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$BankId)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				
				$ResultAmt=($BankAmt-$PayableAmt);
				
				DB::table('addbank')->where('Bankid','=',$BankId)
				->update(['TotalAmt'=>$ResultAmt]);

				//
				$addbank = DB::table('addbank')
				->where('Bankid','=',$BankId)
				->first();

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = $paydate;
				$insert_array["date"] = $paydatereport;
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "CHEQUE";
				$insert_array["cheque_no"] = $id['RDPayChequeNum'];
				$insert_array["cheque_date"] = $id['RDPayChequeDate'];
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $id['RDPayableAmt'];
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = "RD PAY AMOUNT THROUGH CHEQUE";
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = "WITHDRAWL";

				DB::table("deposit")
					->insertGetId($insert_array);
			}
			
			else if($RDPayMode=="CASH")
			{
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('Branch','=',$b)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$tot=$inhandcash1-$PayableAmt;
				DB::table('cash')->where('Branch','=',$b)
				->update(['InHandCash'=>$tot]);
				
				$trandate=date('Y-m-d');
				$bid=$udetail->Bid;
				//$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Paid to RD Customer",'InhandTrans_Cash'=>$PayableAmt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$tot]);
			}
			else
			{
				$reportdte=date('Y-m-d');
				$mnt=date('m');
				$year=date('Y');

				$temp_particulars = "Credited from RD Account ({$RDAccNum})";

				DB::table('sb_transaction')->insertGetId(['Accid'=>$id['accid'],'AccTid' => $id['actid'],'TransactionType' => "CREDIT",'particulars' =>$temp_particulars,'Amount' =>$id['RDPayableAmt'],'CurrentBalance' => $id['sbavailamt'],'Total_Bal' => $id['sbremamt'],'tran_Date' => $reportdte,'SBReport_TranDate'=>$reportdte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$u]);
				
				DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$amt]);
				
				
			}
		}
		
		public function InsertFDPayAmount($id)
		{
			$paydate=date('d-m-Y');
			$paydatereport=date('Y-m-d');
			$FDAccNum=$id['FDAccnum'];
			$FDPayMode=$id['FDPayMode'];
			$BankId=$id['BankId'];
			$PayableAmt=$id['FDPayableAmt'];
			$inttype=$id['FDPaymntMode'];
			$acid=$id['accid'];
			$amt=$id['sbremamt'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
				$respit3=$respit2->payment_voucher_No;
				$r1=$respit3+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r1]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','BCode','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$Bcode=$udetail->BCode;
			$u=$udetail->Uid;
			
			
			$MaxReceipt=DB::table('fd_payamount')
			->where('FD_PayAmount_ReceiptNum','LIKE','%'.$Bcode.'%')
			//->where('FD_PayAmount_ReceiptNum','<>',"0")
			->count('FDPayId');
			$RecYear=date('my');
			$ReceiptNum=$Bcode.$RecYear."FDW-".($MaxReceipt+1);
			
/***********************/
			$fd_type = DB::table("fdallocation")
				->where("Fd_CertificateNum","=",$id['fdaccount'])
				->value("FdTid");
			
			if($fd_type == 1) {
				$sub_head_id = '40';
				$fd_type_name = "KCC";
			} else {
				$sub_head_id = '41';
				$fd_type_name = "FD";
			}
/***********************/
			$fd_payamount_id = DB::table('fd_payamount')->insertGetId(['FDPayAmt_AccNum'=>$id['fdaccount'],'FDPayAmt_PaymentMode'=>$id['FDPayMode'],'Bid'=>$BID,'FDPayAmt_ChequeNum'=>$id['FDPayChequeNum'],'FDPayAmt_ChequeDate'=>$id['FDPayChequeDate'],'FDPayAmt_PayableAmount'=>$id['FDPayableAmt'],'FDPayAmt_PayDate'=>$paydate,'FDPayAmtReport_PayDate'=>$paydatereport,'FDPayAmt_BankId'=>$id['BankId'],'FDPayAmt_IntType'=>$id['FDPaymntMode'],'FD_PayAmount_ReceiptNum'=>$ReceiptNum,'FD_PayAmount_pamentvoucher'=>$r1,'LedgerHeadId'=>'38','SubLedgerId'=>$sub_head_id]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $FDPayMode;
				$fn_data["rv_transaction_id"] = $fd_payamount_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::FD_PAYAMOUNT;//constant FD_PAYAMOUNT is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $paydatereport;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			$fd_alloc = DB::table("fdallocation")
				->select('fd_renewed','renewed_amount')
				->where("Fd_CertificateNum","=",$id['fdaccount'])
				->first();
				
			$fd_renewed = $fd_alloc->fd_renewed;
			$renewed_amount = $fd_alloc->renewed_amount;
			
/*			if($fd_renewed == "YES") {
				DB::table('fd_payamount')->insertGetId(['FDPayAmt_AccNum'=>$id['fdaccount'],'FDPayAmt_PaymentMode'=>"ADJUSTMENT",'Bid'=>$BID,'FDPayAmt_PayableAmount'=>$renewed_amount,'FDPayAmt_PayDate'=>$paydate,'FDPayAmtReport_PayDate'=>$paydatereport,'FDPayAmt_IntType'=>$id['FDPaymntMode']]);
			}//*/
			
			
			if($inttype=="PREWITHDRAWAL")
			{
				DB::table('fd_prewithdrawal')->where('FdAcc_No','=',$id['fdaccount'])
				->update(['CashPaid_State'=>"PAID"]);
			}
			else//For Interest
			{
				DB::table('fdallocation')->where('Fd_CertificateNum','=',$id['fdaccount'])
				->update(['Paid_State'=>"PAID"]);
			}
			
			if($FDPayMode=="CHEQUE")
			{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$BankId)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				
				$ResultAmt=($BankAmt-$PayableAmt);
				
				DB::table('addbank')->where('Bankid','=',$BankId)
				->update(['TotalAmt'=>$ResultAmt]);

				//
				$addbank = DB::table('addbank')
				->where('Bankid','=',$BankId)
				->first();

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = $paydate;
				$insert_array["date"] = $paydatereport;
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "CHEQUE";
				$insert_array["cheque_no"] = $id['FDPayChequeNum'];
				$insert_array["cheque_date"] = $id['FDPayChequeDate'];
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $id['FDPayableAmt'];
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = "{$fd_type_name} PAY AMOUNT THROUGH CHEQUE";
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = "WITHDRAWL";

				DB::table("deposit")
					->insertGetId($insert_array);

			}
			
			else if($FDPayMode=="CASH")
			{
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('Branch','=',$b)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$tot=$inhandcash1-$PayableAmt;
				DB::table('cash')->where('Branch','=',$b)
				->update(['InHandCash'=>$tot]);
				
				$trandate=date('Y-m-d');
				$bid=$udetail->Bid;
				//$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Paid to {$fd_type_name} Customer",'InhandTrans_Cash'=>$PayableAmt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$tot]);
			}
			else
			{
				$reportdte=date('Y-m-d');
				$mnt=date('m');
				$year=date('Y');

				$temp_particulars =  "Credited from {$fd_type_name} Account ({$id["fdaccount"]})";

				DB::table('sb_transaction')->insertGetId(['Accid'=>$id['accid'],'Payment_Mode'=>$FDPayMode,'AccTid' => $id['actid'],'TransactionType' => "CREDIT",'particulars' =>$temp_particulars,'Amount' =>$id['FDPayableAmt'],'CurrentBalance' => $id['sbavailamt'],'Total_Bal' => $id['sbremamt'],'tran_Date' => $reportdte,'SBReport_TranDate'=>$reportdte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$u,"Bid"=>$udetail->Bid]);
				
				DB::table('createaccount')->where('Accid',$acid)
				->update(['Total_Amount'=>$amt]);
				
				
			}
		}
		
		public function GetPigmyDetailsForPayAmt($id) //for PayAmt
		{
			/*if(Auth::user())
				$uname= Auth::user();
			$BID=$uname->Bid;*/
			$id= DB::table('pigmi_prewithdrawal')
			->select('pigmiallocation.Total_Amount','pigmi_prewithdrawal.PgmTotal_Amt','pigmi_prewithdrawal.Deduct_Commission','pigmi_prewithdrawal.Deduct_Amount','user.FirstName','user.MiddleName','user.LastName','user.Uid')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','pigmi_prewithdrawal.PigmiAcc_No')
			->join('user','user.Uid','=','pigmiallocation.UID')
			->where('pigmi_prewithdrawal.PigmiAcc_No','=',$id)
			//->where('pigmiallocation.Bid',$BID)
			//->where('pigmi_prewithdrawal.PigmiAcc_No','like',$id)
			->first();
			return $id;
			
		}
		
		public function GetBankDetailsForPayAmt($id) //for PayAmt
		{
			$id= DB::table('addbank')
			->select('addbank.BankName','addbank.AddBank_IFSC','addbank.Branch','addbank.AccountNo','TotalAmt')
			->where('addbank.Bankid','=',$id)
			->first();
			return $id;
			
		}
		
		public function GetPigmyIntDetailsForPayAmt($id) //for PayAmt
		{
			$id= DB::table('pigmi_interest')
			->select('pigmiallocation.Total_Amount','pigmi_interest.Monthtotal_Amount','pigmi_interest.Interest_Amt','user.FirstName','user.MiddleName','user.LastName','user.Uid','Principle_Amount','pigmiallocation.Bid')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','pigmi_interest.PigmiAcc_No')
			->join('user','user.Uid','=','pigmiallocation.UID')
			->where('pigmi_interest.PigmiAcc_No','=',$id)
			//->where('Bid',$BID)
			->first();
			return $id;
		}
		
		public function GetSBForPigmiPayAmt($id)
		{
			$id=DB::table('createaccount')
			->select('createaccount.AccNum','createaccount.Total_Amount','createaccount.Accid','createaccount.AccTid')
			->where('AccNum','like','%SB%')
			->where('Uid','=',$id)
			->first();
			return $id;
		}
		
		//Newly Added to get Pigmy Account number from interest table
		public function GetIntPigmyAccForPayAmt() //For AmtPay
		{
			//	return DB::select("SELECT `PgmPrewithdraw_ID` as id, `PigmiAcc_No` as name FROM `pigmi_prewithdrawal` where `PigmiAcc_No` LIKE '%".$q."%' ");
			
			return DB::table('pigmi_interest')
			->select(DB::raw('PgmInterest_ID as id, PigmiAcc_No as name'))
			->where('Paid_State','=',"UNPAID")
			->get();
		}
		
		public function GetPigmyAccForPayAmt() //For AmtPay
		{
			return DB::table('pigmi_prewithdrawal')
			->select(DB::raw('PgmPrewithdraw_ID as id, PigmiAcc_No as name'))
			->where('CashPaid_State','=',"UNPAID")
			->get();
		}
		
		public function GetRDAccForPayAmt() //For AmtPay
		{
			return DB::table('rd_prewithdrawal')
			->select(DB::raw('RdPrewithdraw_ID as id, RdAcc_No as name'))
			->where('CashPaid_State','=',"UNPAID")
			->get();
		}
		
		public function GetFDAccForPayAmt() //For AmtPay
		{
			return DB::table('fd_prewithdrawal')
			->select(DB::raw('FdPrewithdraw_ID as id, FdAcc_No as name'))
			->where('CashPaid_State','=',"UNPAID")
			->get();
		}
		
		public function GetKCCAccForPayAmt() //For AmtPay
		{
			return DB::table('fd_prewithdrawal')
			->select(DB::raw('FdPrewithdraw_ID as id, FdAcc_No as name'))
			->join("fdallocation","fdallocation.Fd_CertificateNum","=","fd_prewithdrawal.FdAcc_No")
			->where('CashPaid_State','=',"UNPAID")
			->where('fdallocation.FdTid',1)
			->get();
		}
		
		public function GetRDIntAccForPayAmt() //For AmtPay
		{
			return DB::table('rd_interest')
			->select(DB::raw('RdInterest_ID as id, RdAcc_No as name'))
			->where('Paid_State','=',"UNPAID")
			->get();
		}
		
		public function GetFDMatuAccForPayAmt() //For AmtPay
		{
			return DB::table('fdallocation')
			->select(DB::raw('Fdid as id, Fd_CertificateNum as name'))
			->where('fdallocation.FdTid','!=',1)
			->where('Paid_State','=',"UNPAID")
			->where('Fd_Withdraw','=',"YES")
			->get();
		}
		
		public function GetKCCMatuAccForPayAmt() //For AmtPay
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			return DB::table('fdallocation')
				->select(DB::raw('Fdid as id, Fd_CertificateNum as name'))
				->where('fdallocation.Bid','=',$BID)
				->where('Paid_State','=',"UNPAID")
				->where('Fd_Withdraw','=',"YES")
				->where('fdallocation.FdTid','=',1)
				->get();
		}

		public function GetRDIntDetailsForPayAmt($id) //for PayAmt
		{
			$id= DB::table('rd_interest')
			->select('rd_interest.Amount_Payable','rd_interest.Total_Amount','rd_interest.Interest_Amt','user.FirstName','user.MiddleName','user.LastName','user.Uid','rd_interest.Principle_Amount')
			->leftJoin('createaccount','createaccount.AccNum','=','rd_interest.RdAcc_No')
			->leftJoin('user','user.Uid','=','createaccount.UID')
			->where('rd_interest.RdAcc_No','=',$id)
			->first();
			
			return $id;
		}
		
		public function GetFDMatuDetailsForPayAmt($id) //for PayAmt
		{
			$id= DB::table('fdallocation')
			->select('fdallocation.Fd_TotalAmt','fdallocation.interest_amount','fdallocation.Fd_DepositAmt','user.FirstName','user.MiddleName','user.LastName','user.Uid')
			->leftJoin('user','user.Uid','=','fdallocation.UID')
			->where('fdallocation.Fd_CertificateNum','=',$id)
			->first();
			
			return $id;
		}
		public function GetRDDetailsForPayAmt($id) //for PayAmt
		{
			$id= DB::table('rd_prewithdrawal')
			->select('rd_prewithdrawal.TotalAmt_Payable','rd_prewithdrawal.RdTotal_Amt','rd_prewithdrawal.Deduct_Amt','user.FirstName','user.MiddleName','user.LastName','user.Uid')
			
			->leftJoin('createaccount','createaccount.AccNum','=','rd_prewithdrawal.RdAcc_No')
			->leftJoin('user','user.Uid','=','createaccount.UID')
			->where('rd_prewithdrawal.RdAcc_No','=',$id)
			
			->first();
			return $id;
			
		}
		public function GetFDDetailsForPayAmt($id) //for PayAmt
		{
			
			/*$usr=DB::table('fdallocation')->select('Uid')
				->where('Fd_CertificateNum','=',$id)
				->first();
			$usrid=$usr->Uid;*/
			
			$id= DB::table('fd_prewithdrawal')
			->select('fd_prewithdrawal.FdTotal_Amt','fd_prewithdrawal.TotalAmt_Payable','fd_prewithdrawal.Interest_Amount','user.FirstName','user.MiddleName','user.LastName','user.Uid','fdallocation.Fd_CertificateNum')
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_prewithdrawal.FdAcc_No')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->where('fd_prewithdrawal.FdAcc_No','=',$id)
			
			->first();
			return $id;
			
		}
		public function GetSBForRDPayAmt($id)
		{
			$id=DB::table('createaccount')
			->select('createaccount.AccNum','createaccount.Total_Amount','createaccount.Accid','createaccount.AccTid')
		//	->where('AccNum','like','%SB%')
		//	->where('Uid','=',$id)
			->where('Accid','=',$id)
			->first();
			return $id;
		}
		
		public function GetSBForFDPayAmt($id)
		{
			$id=DB::table('createaccount')
			->select('createaccount.AccNum','createaccount.Total_Amount','createaccount.Accid','createaccount.AccTid')
			//->where('AccNum','like','%SB%')
			//->where('Uid','=',$id)
			->where('Accid','=',$id)
			->first();
			return $id;
		}
		
		/*public function PigPayMaxRecNum()
			{
			$id=DB::table('pigmi_payamount')
			->max('PayAmount_ReceiptNum');
			//print_r($id);
			return $id;
			}
			
			public function UpdatePigmyReceiptNo($id)
			{
			
			$PayId=$id['PigPayId'];
			$RecNum=$id['recenum'];
			
			$id=DB::table('pigmi_payamount')
			->where('PayId',$PayId)
			->update(['PayAmount_ReceiptNum'=>$RecNum]);
			//print_r($id);
			return $id;
			}
			
			public function RdPayMaxRecNum() //M 13-4-16
			{
			$id=DB::table('rd_payamount')
			->where('RD_PayAmount_ReceiptNum','<>',"0")
			->count('RDPayId');
			return $id;
			}
			
			public function UpdateRdReceiptNo($id)//M 13-4-16
			{
			
			$PayId=$id['RdPayId'];
			$RecNum=$id['recenum'];
			
			$id=DB::table('rd_payamount')
			->where('RDPayId',$PayId)
			->update(['RD_PayAmount_ReceiptNum'=>$RecNum]);
			//print_r($id);
			return $id;
			
			
			}
			
			public function FdPayMaxRecNum() //M 15-4-16
			{
			$id=DB::table('fd_payamount')
			->where('FD_PayAmount_ReceiptNum','<>',"0")
			->count('FDPayId');
			//print_r($id);
			return $id;
			}
			
			public function UpdateFdReceiptNo($id)//M 15-4-16
			{
			
			$PayId=$id['FdPayId'];
			$RecNum=$id['recenum'];
			
			$id=DB::table('fd_payamount')
			->where('FDPayId',$PayId)
			->update(['FD_PayAmount_ReceiptNum'=>$RecNum]);
			//print_r($id);
			return $id;
		}*/
		
		public function GetPigPayData()
		{
			$id = DB::table('pigmi_payamount')->select('PayId','PayAmountReport_PayDate','PayAmount_PigmiAccNum','FirstName','MiddleName','LastName','Pigmi_Type')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAcc_No', '=' , 'pigmi_payamount.PayAmount_PigmiAccNum')
			->leftJoin('pigmitype', 'pigmitype.PigmiTypeid', '=' , 'pigmiallocation.PigmiTypeid')
			->leftJoin('user', 'user.Uid', '=' , 'pigmiallocation.Uid')
			//->where('PayAmount_IntType','=','PREWITHDRAWAL')
			->orderBy('PayId','desc')
			//->where('PayAmount_ReceiptNum','=',"0")
			->paginate(15);
			//->get();
			//print_r($id);
			return $id;
			
		}
		
		public function GetPigPayReceDetail($id)
		{
			$id = DB::table('pigmi_payamount')->select('PayId','PayAmountReport_PayDate','PayAmount_PigmiAccNum','FirstName','MiddleName','LastName','Pigmi_Type','BName','PgmTotal_Amt','Deduct_Commission','Deduct_Amount','PayAmount_PayableAmount','PayAmount_ReceiptNum')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAcc_No', '=' , 'pigmi_payamount.PayAmount_PigmiAccNum')
			->leftJoin('pigmi_prewithdrawal', 'pigmi_prewithdrawal.PigmiAcc_No', '=' , 'pigmi_payamount.PayAmount_PigmiAccNum')
			->leftJoin('pigmitype', 'pigmitype.PigmiTypeid', '=' , 'pigmiallocation.PigmiTypeid')
			->leftJoin('user', 'user.Uid', '=' , 'pigmiallocation.Uid')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			//->where('PayAmount_IntType','=','PREWITHDRAWAL')
			->where('PayId',$id)
			->get();
			//print_r($id);
			return $id;
			
		}
		
		public function GetRDPayData()
		{
			$id = DB::table('rd_payamount')->select('RDPayId','RDPayAmtReport_PayDate','RDPayAmt_AccNum','FirstName','MiddleName','LastName')
			->leftJoin('createaccount', 'createaccount.AccNum', '=' , 'rd_payamount.RDPayAmt_AccNum')
			//->leftJoin('pigmitype', 'pigmitype.PigmiTypeid', '=' , 'pigmiallocation.PigmiTypeid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			//->where('RDPayAmt_IntType','=','PREWITHDRAWAL')
			->orderBy('RDPayId','desc')
			//->where('RD_PayAmount_ReceiptNum','=',"0")
			->paginate(15);
			//->get();
			//print_r($id);
			return $id;
			
		}
		
		public function GetRdPayReceDetail($id)
		{
			$id = DB::table('rd_payamount')->select('RDPayId','RDPayAmtReport_PayDate','RDPayAmt_AccNum','FirstName','MiddleName','LastName','BName','RdTotal_Amt','Deduct_Amt','RDPayAmt_PayableAmount','RD_PayAmount_ReceiptNum')
			->leftJoin('createaccount', 'createaccount.AccNum', '=' , 'rd_payamount.RDPayAmt_AccNum')
		//	->leftJoin('rd_prewithdrawal', 'rd_prewithdrawal.RdAcc_No', '=' , 'rd_payamount.RDPayAmt_AccNum')
			//->leftJoin('pigmitype', 'pigmitype.PigmiTypeid', '=' , 'pigmiallocation.PigmiTypeid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			//->where('RDPayAmt_IntType','=','PREWITHDRAWAL')
			->where('RDPayId',$id)
			->get();
			//print_r($id);
			return $id;
			
		}
		
		public function GetFDPayData() //M 15-4-16
		{
			$id = DB::table('fd_payamount')->select('FDPayId','FDPayAmtReport_PayDate','FDPayAmt_AccNum','FirstName','MiddleName','LastName','FdType')
			->leftJoin('fdallocation', 'fdallocation.Fd_CertificateNum', '=' , 'fd_payamount.FDPayAmt_AccNum')
			->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
			->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
			//->where('FDPayAmt_IntType','=','PREWITHDRAWAL')
			->orderBy('FDPayId','desc')
			->where('FDPayId','>',"102")
			->paginate(15);
			//->get();
			//print_r($id);
			return $id;
			
		}
		
		public function GetKCCPayData() //M 15-4-16
		{
			$id = DB::table('fd_payamount')
				->select(
					'FDPayId',
					'FDPayAmtReport_PayDate',
					'FDPayAmt_AccNum','FirstName',
					'MiddleName','LastName','FdType'
				)
				->leftJoin('fdallocation', 'fdallocation.Fd_CertificateNum', '=' , 'fd_payamount.FDPayAmt_AccNum')
				->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
				->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
				->orderBy('FDPayId','desc')
				->where('FDPayId','>',"102")
				->where('fdallocation.FdTid',1)
				->get();
			return $id;
			
		}
		
		public function GetFdPayReceDetail($id) //M 15-4-16
		{
			
			$id = DB::table('fd_payamount')->select('FDPayId','FDPayAmtReport_PayDate','FDPayAmt_AccNum','FirstName','MiddleName','LastName','BName','FdTotal_Amt','FDPayAmt_PayableAmount','fd_prewithdrawal.Interest_Amount','FdType','Withdraw_Date','FD_PayAmount_ReceiptNum')
			->leftJoin('fdallocation', 'fdallocation.Fd_CertificateNum', '=' , 'fd_payamount.FDPayAmt_AccNum')
			->leftJoin('fd_prewithdrawal', 'fd_prewithdrawal.FdAcc_No', '=' , 'fd_payamount.FDPayAmt_AccNum')
			->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
			->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			->where('FDPayAmt_IntType','=','PREWITHDRAWAL')
			->where('FDPayId',$id)
			->get();
			//print_r($id);
			return $id;
			
		}
		
		public function SearchPigmyPay($q)//M 20-4-16 For PigmyPayAmountHome.blade to search PigmyPay
		{
			return DB::table('pigmi_payamount')
			->select(DB::raw('PayId as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`," , ",`PigmiAcc_No`,"  /  ",`old_pigmiaccno`," , ",`PayAmount_ReceiptNum`) as name'))
			->leftJoin('pigmiallocation','pigmiallocation.PigmiAcc_No','=','pigmi_payamount.PayAmount_PigmiAccNum')
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->get();
		}
		
		public function GetPigPaySearchData($id)//M 20-4-16 For PigmyPayAmountHome.blade to search PigmyPay
		{
			$id = DB::table('pigmi_payamount')->select('PayId','PayAmountReport_PayDate','PayAmount_PigmiAccNum','FirstName','MiddleName','LastName','Pigmi_Type')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAcc_No', '=' , 'pigmi_payamount.PayAmount_PigmiAccNum')
			->leftJoin('pigmitype', 'pigmitype.PigmiTypeid', '=' , 'pigmiallocation.PigmiTypeid')
			->leftJoin('user', 'user.Uid', '=' , 'pigmiallocation.Uid')
			//->where('PayAmount_IntType','=','PREWITHDRAWAL')
			->where('PayId','=',$id)
			->get();
			
			return $id;
		}
		
		
		
		
		
		
		public function SearchRdPay($q)//M 20-4-16 For RdPayAmountHome.blade to search PigmyPay
		{
			return DB::table('rd_payamount')
			->select(DB::raw('RDPayId as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`," , ",`AccNum`,"  /  ",`Old_AccNo`," , ",`RD_PayAmount_ReceiptNum`) as name'))
			->leftJoin('createaccount','createaccount.AccNum','=','rd_payamount.RDPayAmt_AccNum')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->get();
		}
		
		public function GetRdPaySearchData($id)//M 20-4-16 For RdPayAmountHome.blade to search PigmyPay
		{
			$id = DB::table('rd_payamount')->select('RDPayId','RDPayAmtReport_PayDate','RDPayAmt_AccNum','FirstName','MiddleName','LastName')
			->leftJoin('createaccount', 'createaccount.AccNum', '=' , 'rd_payamount.RDPayAmt_AccNum')
			//->leftJoin('pigmitype', 'pigmitype.PigmiTypeid', '=' , 'pigmiallocation.PigmiTypeid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->where('RDPayAmt_IntType','=','PREWITHDRAWAL')
			->where('RDPayId','=',$id)
			->get();
			
			return $id;
		}
		
		public function SearchFdPay($q)//M 20-4-16 For FdPayAmountHome.blade to search PigmyPay
		{
			return DB::table('fd_payamount')
			->select(DB::raw('FDPayId as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`," , ",`Fd_CertificateNum`,"  /  ",`Fd_OldCertificateNum`," , ",`FD_PayAmount_ReceiptNum`) as name'))
			->leftJoin('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->get();
		}
		
		public function GetFdPaySearchData($id)//M 20-4-16 For FdPayAmountHome.blade to search PigmyPay
		{
			$id = DB::table('fd_payamount')->select('FDPayId','FDPayAmtReport_PayDate','fd_payamount.FDPayAmt_AccNum','FirstName','MiddleName','LastName','FdType')
			->leftJoin('fdallocation', 'fdallocation.Fd_CertificateNum', '=' , 'fd_payamount.FDPayAmt_AccNum')
			->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
			->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
			->where('FDPayAmt_IntType','=','PREWITHDRAWAL')
			->where('FDPayId','=',$id)
			->get();
			
			return $id;
		}
		
		/*public function ReceiptStaffBranch()// For FD,RD,PIGMY pay receipt M 18-4-16
			{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','BCode','BName')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			return $udetail;
		}*/
		
	}
