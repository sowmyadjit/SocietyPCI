<?php
	
	namespace App\Http\Model;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	
	class TransactionModel extends Model
	{
		protected $table='sb_transaction';
		
		public function TransactionReceiptData($id)
		{
			$ReceTypeDD=$id['ReceiptTypeDD'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			if($ReceTypeDD=="SB")
			{
				$SBTRAN = DB::table('sb_transaction')
				->select('Tranid','sb_transaction.Accid','Old_AccNo','AccNum','TransactionType','sb_transaction.particulars','Amount','CurrentBalance','Total_Amount','SBReport_TranDate','sb_transaction.Bid','Payment_Mode','FirstName','MiddleName','LastName','createaccount.Uid','SB_resp_No','SB_paymentvoucher_No')
				->join('createaccount','createaccount.Accid','=','sb_transaction.Accid')
				->join('user','user.Uid','=','createaccount.Uid')
				->where('sb_transaction.Bid',$BID)
				->orderBy('Tranid','dsc')
				->paginate(15);
				//print_r($SBTRAN);
				return $SBTRAN;
			}
			else if($ReceTypeDD=="RD")
			{
				
				$RDTRAN = DB::table('rd_transaction')
				->select('RD_TransID','rd_transaction.Accid','Old_AccNo','AccNum','RD_Trans_Type','rd_transaction.RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Total_Bal','RDReport_TranDate','rd_transaction.Bid','RDPayment_Mode','FirstName','MiddleName','LastName','createaccount.Uid','RD_resp_No')
				->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
				->join('user','user.Uid','=','createaccount.Uid')
				->where('rd_transaction.Bid',$BID)
				->orderBy('RD_TransID','dsc')
				->paginate(15);
				//print_r($SBTRAN);
				return $RDTRAN;
				
			}
			else if($ReceTypeDD=="PIGMY")
			{
				
			}
		}
		
		public function TranReceipt($type,$id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			if($type=="SB")
			{
				$SbReceData = DB::table('sb_transaction')
				->select('Tranid','sb_transaction.Accid','Old_AccNo','AccNum','TransactionType','sb_transaction.particulars','Amount','CurrentBalance','Total_Amount','SBReport_TranDate','sb_transaction.Bid','Payment_Mode','FirstName','MiddleName','LastName','createaccount.Uid','receipt_voucher_no as SB_resp_No','BName','receipt_voucher_no as SB_paymentvoucher_No')
				->join('createaccount','createaccount.Accid','=','sb_transaction.Accid')
				->join('user','user.Uid','=','createaccount.Uid')
				->join('branch','branch.Bid','=','sb_transaction.Bid')
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","sb_transaction.Tranid")
				->where('Tranid',$id)
				->get();
				//print_r($SbReceData);
				return $SbReceData;
			}
			else if($type=="RD")
			{
				$RDTRAN = DB::table('rd_transaction')
				->select('RD_TransID','rd_transaction.Accid','Old_AccNo','AccNum','RD_Trans_Type','rd_transaction.RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Total_Bal','RDReport_TranDate','rd_transaction.Bid','RDPayment_Mode','FirstName','MiddleName','LastName','createaccount.Uid','RD_resp_No','BName')
				->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
				->join('user','user.Uid','=','createaccount.Uid')
				->join('branch','branch.Bid','=','rd_transaction.Bid')
				->where('RD_TransID',$id)
				->get();
				//print_r($SBTRAN);
				return $RDTRAN;
			}
			else if($type=="PIGMY")
			{
				
			}
		}

		/* -------------------------------------------------- */
		public function rv_print_sb($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;

			$table = "sb_transaction";
		/* 	if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			} */
			$transaction_category = 1;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.Tranid as tran_id",
					"createaccount.AccNum as acc_no",
					"createaccount.Old_AccNo as old_acc_no",
					"{$table}.SBReport_TranDate as date",
					"{$table}.Amount as amount",
					"{$table}.particulars as particulars",
					"{$table}.TransactionType as transaction_type",
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("createaccount","createaccount.Accid","=","{$table}.Accid")
				->join("user","user.Uid","=","createaccount.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.Tranid")
				// ->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.Tranid",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "SB";
				$ret_data->tran_category = $data["tran_category"];
			}

			return $ret_data;
		}

		public function rv_print_rd($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;

			$table = "rd_transaction";
			$transaction_category = 2;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.RD_TransID as tran_id",
					"createaccount.AccNum as acc_no",
					"createaccount.Old_AccNo as old_acc_no",
					"{$table}.RDReport_TranDate as date",
					"{$table}.RD_Amount as amount",
					"{$table}.RD_Particulars as particulars",
					"{$table}.RD_Trans_Type as transaction_type",
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("createaccount","createaccount.Accid","=","{$table}.Accid")
				->join("user","user.Uid","=","createaccount.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.RD_TransID")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				if($data["tran_list"] == "YES") {
					$ret_data = $ret_data->get();
				} else {
					$ret_data = $ret_data->where("{$table}.RD_TransID",$data["tran_id"])
						->first();
					$ret_data->tran_category_name = "RD";
					$ret_data->tran_category = $data["tran_category"];
				}

			return $ret_data;
		}

		public function rv_print_jl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;

			$table = "jewelloan_allocation";
			$transaction_category = 20;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.JewelLoanId as tran_id",
					"{$table}.JewelLoan_LoanNumber as acc_no",
					"{$table}.jewelloan_Oldloan_No as old_acc_no",
					"{$table}.JewelLoan_StartDate as date",
					"{$table}.JewelLoan_LoanAmount as amount",
					"{$table}.JewelLoan_SaraparaCharge",
					"{$table}.JewelLoan_InsuranceCharge",
					"{$table}.JewelLoan_BookAndFormCharge",
					"{$table}.JewelLoan_OtherCharge",
					DB::raw("(`JewelLoan_SaraparaCharge`+`JewelLoan_InsuranceCharge`+`JewelLoan_BookAndFormCharge`+`JewelLoan_OtherCharge`) as 'charges_sum'"),
					DB::raw("'' as particulars"),
					DB::raw("'DEBIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.JewelLoanId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				if($data["tran_list"] == "YES") {
					$ret_data = $ret_data->get();
					foreach($ret_data as $key_jl=>$row_jl) {
						if($row_jl->receipt_voucher_type == 1) {
							$ret_data[$key_jl]->amount = $row_jl->charges_sum;
							$ret_data[$key_jl]->transaction_type = "CREDIT";
						}
					}
				} else {
					$ret_data = $ret_data->where("{$table}.JewelLoanId",$data["tran_id"])
						->first();
					if($ret_data->receipt_voucher_type == 1) {
						$ret_data->amount = $ret_data->charges_sum;
						$ret_data->transaction_type = "CREDIT";
					}
					$ret_data->tran_category_name = "JL";
					$ret_data->tran_category = $data["tran_category"];
					$ret_data->particulars .= "
							Sarapara charge - {$ret_data->JewelLoan_SaraparaCharge}, 
							Insurance charge - {$ret_data->JewelLoan_InsuranceCharge}, 
							Books and forms charge - {$ret_data->JewelLoan_BookAndFormCharge}, 
							Other charge - {$ret_data->JewelLoan_OtherCharge}
						";
				}

			return $ret_data;
		}

		public function rv_print_jl_cr($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;

			$table = "jewelloan_allocation";
			$transaction_category = 20;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.JewelLoanId as tran_id",
					"{$table}.JewelLoan_LoanNumber as acc_no",
					"{$table}.jewelloan_Oldloan_No as old_acc_no",
					"{$table}.JewelLoan_StartDate as date",
					DB::raw("(`JewelLoan_SaraparaCharge`+`JewelLoan_InsuranceCharge`+`JewelLoan_BookAndFormCharge`+`JewelLoan_OtherCharge`) as 'amount'"),
					"{$table}.JewelLoan_SaraparaCharge",
					"{$table}.JewelLoan_InsuranceCharge",
					"{$table}.JewelLoan_BookAndFormCharge",
					"{$table}.JewelLoan_OtherCharge",
					DB::raw("'' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.JewelLoanId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.receipt_voucher_type",1)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				
				$ret_data = $ret_data->where("{$table}.JewelLoanId",$data["tran_id"])
					->first();
					
				$ret_data->tran_category_name = "JL";
				$ret_data->tran_category = $data["tran_category"];
				$ret_data->particulars .= "Appraiser commission - {$ret_data->JewelLoan_SaraparaCharge},\nInsurance charge - {$ret_data->JewelLoan_InsuranceCharge},\nBooks and forms charge - {$ret_data->JewelLoan_BookAndFormCharge},\nOther charge - {$ret_data->JewelLoan_OtherCharge}";

			return $ret_data;
		}

		public function rv_print_jl_db($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;

			$table = "jewelloan_allocation";
			$transaction_category = 20;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.JewelLoanId as tran_id",
					"{$table}.JewelLoan_LoanNumber as acc_no",
					"{$table}.jewelloan_Oldloan_No as old_acc_no",
					"{$table}.JewelLoan_StartDate as date",
					"{$table}.JewelLoan_LoanAmount as amount",
					DB::raw("(`JewelLoan_SaraparaCharge`+`JewelLoan_InsuranceCharge`+`JewelLoan_BookAndFormCharge`+`JewelLoan_OtherCharge`) as 'charges_sum'"),
					DB::raw("'Jewel Loan Allocation' as particulars"),
					DB::raw("'DEBIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.JewelLoanId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.receipt_voucher_type",2)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				
				//TRAN LIST = NO
				$ret_data = $ret_data->where("{$table}.JewelLoanId",$data["tran_id"])
					->first();
					
				$ret_data->tran_category_name = "JL";
				$ret_data->tran_category = $data["tran_category"];

			return $ret_data;
		}

		public function rv_print_dl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "depositeloan_allocation";
			$transaction_category = 17;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.DepLoanAllocId as tran_id",
					"{$table}.DepLoan_LoanNum as acc_no",
					"{$table}.Old_loan_number as old_acc_no",
					"{$table}.DepLoan_LoanStartDate as date",
					"{$table}.DepLoan_LoanAmount as amount",
					DB::raw("(`DepLoan_LoanCharge`) as 'charges_sum'"),
					DB::raw("'Deposit Loan Allocation' as particulars"),
					DB::raw("'DEBIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.DepLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.DepLoanAllocId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				if($data["tran_list"] == "YES") {
					$ret_data = $ret_data->get();
					foreach($ret_data as $key_dl=>$row_dl) {
						if($row_dl->receipt_voucher_type == 1) {
							$ret_data[$key_dl]->amount = $row_dl->charges_sum;
							$ret_data[$key_dl]->transaction_type = "CREDIT";
						}
					}
				} else {
					$ret_data = $ret_data->where("{$table}.DepLoanAllocId",$data["tran_id"])
						->first();

					if($ret_data->receipt_voucher_type == 1) {
						$ret_data->amount = $ret_data->charges_sum;
						$ret_data->transaction_type = "CREDIT";
						$ret_data->tran_category = $data['tran_category'];
					}
					$ret_data->tran_category_name = "DL";
				}

			return $ret_data;
		}

		public function rv_print_dl_cr($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "depositeloan_allocation";
			$transaction_category = 17;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.DepLoanAllocId as tran_id",
					"{$table}.DepLoan_LoanNum as acc_no",
					"{$table}.Old_loan_number as old_acc_no",
					"{$table}.DepLoan_LoanStartDate as date",
					"{$table}.DepLoan_LoanCharge as amount",
					DB::raw("'Books and forms charges' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.DepLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.DepLoanAllocId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.receipt_voucher_type",1)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				
				$ret_data = $ret_data->where("{$table}.DepLoanAllocId",$data["tran_id"])
					->first();

				$ret_data->tran_category = $data['tran_category'];
				$ret_data->tran_category_name = "DL";
				
			return $ret_data;
		}

		public function rv_print_dl_db($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "depositeloan_allocation";
			$transaction_category = 17;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.DepLoanAllocId as tran_id",
					"{$table}.DepLoan_LoanNum as acc_no",
					"{$table}.Old_loan_number as old_acc_no",
					"{$table}.DepLoan_LoanStartDate as date",
					"{$table}.DepLoan_LoanAmount as amount",
					DB::raw("(`DepLoan_LoanCharge`) as 'charges_sum'"),
					DB::raw("'Deposit Loan Allocation' as particulars"),
					DB::raw("'DEBIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.DepLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.DepLoanAllocId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.receipt_voucher_type",2)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				
				$ret_data = $ret_data->where("{$table}.DepLoanAllocId",$data["tran_id"])
					->first();

				$ret_data->tran_category_name = "DL";
				$ret_data->tran_category = $data["tran_category"];

			return $ret_data;
		}

		public function rv_print_sl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "staffloan_allocation";
			$transaction_category = 19;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.StfLoanAllocID as tran_id",
					"{$table}.StfLoan_Number as acc_no",
					"{$table}.old_saffloan_no as old_acc_no",
					"{$table}.StartDate as date",
					"{$table}.LoanAmt as amount",
					DB::raw("'Staff Loan Allocation' as particulars"),
					DB::raw("'DEBIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.StfLoanAllocID")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
				if($data["tran_list"] == "YES") {
					$ret_data = $ret_data->get();
				} else {
					$ret_data = $ret_data->where("{$table}.StfLoanAllocID",$data["tran_id"])
						->first();
					
					$ret_data->tran_category_name = "SL";
					$ret_data->tran_category = $data["tran_category"];
				}

			return $ret_data;
		}

		public function rv_print_pl($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "personalloan_allocation";
			$transaction_category = 18;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.PersLoanAllocID as tran_id",
					"{$table}.PersLoan_Number as acc_no",
					"{$table}.PersLoanAllocID as old_acc_no",
					"{$table}.StartDate as date",
					"{$table}.LoanAmt as amount",
					DB::raw("'Personal Loan Allocation' as particulars"),
					DB::raw("'DEBIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("members","members.Memid","=","{$table}.MemId")
				->join("user","user.Uid","=","members.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.PersLoanAllocID")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.PersLoanAllocID",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "PL";
				$ret_data->tran_category = $data["tran_category"];
			}

			return $ret_data;
		}
		
		public function rv_print_jl_pay($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "jewelloan_repay";
			$transaction_category = 23;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.JLRepay_Id as tran_id",
					"jewelloan_allocation.JewelLoanId as allocation_id",
					"jewelloan_allocation.JewelLoan_LoanNumber as acc_no",
					"jewelloan_allocation.jewelloan_Oldloan_No as old_acc_no",
					"{$table}.JLRepay_Date as date",
					"{$table}.JLRepay_PaidAmt as amount",
					"{$table}.JLRepay_paidtoprincipalamt as principle",
					"{$table}.JLRepay_interestpaid as interest",
					DB::raw("'' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewelloan_repay.JLRepay_JLAllocID")
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.JLRepay_Id")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.JLRepay_Id",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "JL";
				$ret_data->tran_category = $data["tran_category"];

				$ret_data->particulars .= "Principle:{$ret_data->principle}\nInterest:{$ret_data->interest}";
				$charges_transacton = DB::table("charges_tran")
					->select(
							"chareges.charges_name",
							"charges_tran.amount"
							)
					->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
					->where("loantype","JL")
					->where("loanid",$ret_data->allocation_id)
					->where("charg_tran_date",$ret_data->date)
					->get();
				foreach($charges_transacton as $part) {
					$ret_data->particulars .= "\n{$part->charges_name}:{$part->amount}";
				}
			}
			return $ret_data;
		}
		
		public function rv_print_dl_pay($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "depositeloan_repay";
			$transaction_category = 21;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.DLRepay_ID as tran_id",
					"depositeloan_allocation.DepLoanAllocId as allocation_id",
					"depositeloan_allocation.DepLoan_LoanNum as acc_no",
					"depositeloan_allocation.Old_loan_number as old_acc_no",
					"{$table}.DLRepay_Date as date",
					"{$table}.DLRepay_PaidAmt as amount",
					"{$table}.DLRepay_PrincipalPaid as principle",
					"{$table}.DLRepay_InterestPaid as interest",
					DB::raw("'' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("depositeloan_allocation","depositeloan_allocation.DepLoanAllocId","=","{$table}.DLRepay_DepAllocID")
				->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.DLRepay_ID")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.DLRepay_ID",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "DL";
				$ret_data->tran_category = $data["tran_category"];

				$ret_data->particulars .= "Principle:{$ret_data->principle}\nInterest:{$ret_data->interest}";
				$charges_transacton = DB::table("charges_tran")
					->select(
							"chareges.charges_name",
							"charges_tran.amount"
							)
					->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
					->where("loantype","DL")
					->where("loanid",$ret_data->allocation_id)
					->where("charg_tran_date",$ret_data->date)
					->get();
				foreach($charges_transacton as $part) {
					$ret_data->particulars .= "\n{$part->charges_name}:{$part->amount}";
				}
			}
			return $ret_data;
		}
		
		public function rv_print_sl_pay($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "staffloan_repay";
			$transaction_category = 24;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.SLRepay_Id as tran_id",
					"staffloan_allocation.StfLoanAllocID as allocation_id",
					"staffloan_allocation.StfLoan_Number as acc_no",
					"staffloan_allocation.old_saffloan_no as old_acc_no",
					"{$table}.SLRepay_Date as date",
					"{$table}.SLRepay_PaidAmt as amount",
					"{$table}.paid_principle as principle",
					"{$table}.SLRepay_Interest as interest",
					DB::raw("'' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("staffloan_allocation","staffloan_allocation.StfLoanAllocID","=","{$table}.SLRepay_SLAllocID")
				->join("user","user.Uid","=","staffloan_allocation.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.SLRepay_Id")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.SLRepay_Id",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "SL";
				$ret_data->tran_category = $data["tran_category"];

				$ret_data->particulars .= "Principle:{$ret_data->principle}\nInterest:{$ret_data->interest}";
				$charges_transacton = DB::table("charges_tran")
					->select(
							"chareges.charges_name",
							"charges_tran.amount"
							)
					->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
					->where("loantype","SL")
					->where("loanid",$ret_data->allocation_id)
					->where("charg_tran_date",$ret_data->date)
					->get();
				foreach($charges_transacton as $part) {
					$ret_data->particulars .= "\n{$part->charges_name}:{$part->amount}";
				}
			}
			return $ret_data;
		}
		
		public function rv_print_pl_pay($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "personalloan_repay";
			$transaction_category = 22;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.PLRepay_Id as tran_id",
					"personalloan_allocation.PersLoanAllocID as allocation_id",
					"personalloan_allocation.PersLoan_Number as acc_no",
					"personalloan_allocation.Old_PersLoan_Number as old_acc_no",
					"{$table}.PLRepay_Date as date",
					"{$table}.PLRepay_PaidAmt as amount",
					"{$table}.PLRepay_Amtpaidtoprincpalamt as principle",
					"{$table}.PLRepay_PaidInterest as interest",
					DB::raw("'' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","{$table}.PLRepay_PLAllocID")
				->join("members","members.Memid","=","personalloan_allocation.MemId")
				->join("user","user.Uid","=","members.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.PLRepay_Id")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.PLRepay_Id",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "PL";
				$ret_data->tran_category = $data["tran_category"];

				$ret_data->particulars .= "Principle:{$ret_data->principle}\nInterest:{$ret_data->interest}";
				$charges_transacton = DB::table("charges_tran")
					->select(
							"chareges.charges_name",
							"charges_tran.amount"
							)
					->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
					->where("loantype","PL")
					->where("loanid",$ret_data->allocation_id)
					->where("charg_tran_date",$ret_data->date)
					->get();
				foreach($charges_transacton as $part) {
					$ret_data->particulars .= "\n{$part->charges_name}:{$part->amount}";
				}
			}
			return $ret_data;
		}
		
		public function rv_print_mem_fee($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "members";
			$transaction_category = 22;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.Memid as tran_id",
					"{$table}.Memid as acc_no",
					"{$table}.Member_no as old_acc_no",
					"{$table}.CreatedDate as date",
					"{$table}.Member_Fee as amount",
					DB::raw("'Entrance Fee' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","members.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.Memid")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.Memid",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "MEMBER";
				$ret_data->tran_category = $data["tran_category"];
			}
			return $ret_data;
		}
		
		public function rv_print_cust_fee($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "customer";
			$transaction_category = 28;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.Custid as tran_id",
					"{$table}.Custid as acc_no",
					DB::raw("'' as old_acc_no"),
					"{$table}.Created_on as date",
					"{$table}.Customer_Fee as amount",
					DB::raw("'D CLASS MEMBERSHIP' as particulars"),
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.Custid")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0)
				->where("{$table}.Customer_Fee","!=",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.Custid",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "CUSTOMER";
				$ret_data->tran_category = $data["tran_category"];
			}
			return $ret_data;
		}
		
		public function rv_print_pg_pend($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			$table = "pending_pigmy";
			$transaction_category = 9;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.PpId as tran_id",
					// DB::raw("'-' as acc_no"),
					"user.Uid as acc_no",
					DB::raw("'' as old_acc_no"),
					"{$table}.PendPigmy_ReceivedDate as date",
					"{$table}.PenPigmy_AmountReceived as amount",
					DB::raw("'NN Suspense' as particulars"),
					"{$table}.PendPigmy_CollectionDate as collection_date",
					DB::raw("'CREDIT' as transaction_type"),
					"receipt_voucher.receipt_voucher_no as receipt_voucher_no",
					"receipt_voucher.receipt_voucher_type as receipt_voucher_type",
					"user.Uid as uid",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.PendPigmy_AgentUid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.PpId")
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("receipt_voucher.bid",$BID)
				->where("receipt_voucher.deleted",0);
			if($data["tran_list"] == "YES") {
				$ret_data = $ret_data->get();
			} else {
				$ret_data = $ret_data->where("{$table}.PpId",$data["tran_id"])
					->first();
				$ret_data->tran_category_name = "AGENT";
				$ret_data->tran_category = $data["tran_category"];
				$ret_data->particulars .= " - " . $ret_data->collection_date;
			}
			return $ret_data;
		}
		
		
	}
