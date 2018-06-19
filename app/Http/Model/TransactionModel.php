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

		public function rv_print_sb($data)
		{
			$table = "sb_transaction";
			if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			}
			$transaction_category = 1;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.Tranid as tran_id",
					"createaccount.AccNum as acc_no",
					"createaccount.Old_AccNo as old_acc_no",
					"{$table}.SBReport_TranDate as date",
					"{$table}.Amount as amount",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("createaccount","createaccount.Accid","=","{$table}.Accid")
				->join("user","user.Uid","=","createaccount.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.Tranid")
				->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("{$table}.Tranid",$data["tran_id"])
				->first();

			return $ret_data;
		}

		public function rv_print_rd($data)
		{
			$table = "rd_transaction";
			if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			}
			$transaction_category = 2;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.RD_TransID as tran_id",
					"createaccount.AccNum as acc_no",
					"createaccount.Old_AccNo as old_acc_no",
					"{$table}.RDReport_TranDate as date",
					"{$table}.RD_Amount as amount",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("createaccount","createaccount.Accid","=","{$table}.Accid")
				->join("user","user.Uid","=","createaccount.Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.RD_TransID")
				->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("{$table}.RD_TransID",$data["tran_id"])
				->first();

			return $ret_data;
		}

		public function rv_print_jl($data)
		{
			$table = "jewelloan_allocation";
			if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			}
			$transaction_category = 20;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.JewelLoanId as tran_id",
					"{$table}.JewelLoan_LoanNumber as acc_no",
					"{$table}.jewelloan_Oldloan_No as old_acc_no",
					"{$table}.JewelLoan_StartDate as date",
					"{$table}.JewelLoan_LoanAmount as amount",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.JewelLoanId")
				->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("{$table}.JewelLoanId",$data["tran_id"])
				->first();

			return $ret_data;
		}

		public function rv_print_dl($data)
		{
			$table = "depositeloan_allocation";
			if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			}
			$transaction_category = 17;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.DepLoanAllocId as tran_id",
					"{$table}.DepLoan_LoanNum as acc_no",
					"{$table}.Old_loan_number as old_acc_no",
					"{$table}.DepLoan_LoanStartDate as date",
					"{$table}.DepLoan_LoanAmount as amount",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.DepLoanAllocId")
				->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("{$table}.DepLoanAllocId",$data["tran_id"])
				->first();

			return $ret_data;
		}

		public function rv_print_sl($data)
		{
			$table = "staffloan_allocation";
			if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			}
			$transaction_category = 19;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.StfLoanAllocID as tran_id",
					"{$table}.StfLoan_Number as acc_no",
					"{$table}.old_saffloan_no as old_acc_no",
					"{$table}.StartDate as date",
					"{$table}.LoanAmt as amount",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.StfLoanAllocID")
				->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("{$table}.StfLoanAllocID",$data["tran_id"])
				->first();

			return $ret_data;
		}

		public function rv_print_pl($data)
		{
			$table = "personalloan_allocation";
			if($data["tran_type"] == "CREDIT") {
				$receipt_voucher_type = 1;
			} else {
				$receipt_voucher_type = 2;
			}
			$transaction_category = 18;

			$ret_data = '';
			$ret_data = DB::table($table)
				->select(
					"{$table}.PersLoanAllocID as tran_id",
					"{$table}.PersLoan_Number as acc_no",
					"{$table}.PersLoanAllocID as old_acc_no",
					"{$table}.StartDate as date",
					"{$table}.LoanAmt as amount",
					DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
				)
				->join("members","members.Memid","=","{$table}.MemId")
				->join("user","user.Uid","=","{$table}.JewelLoan_Uid")
				->join("receipt_voucher","receipt_voucher.transaction_id","=","{$table}.PersLoanAllocID")
				->where("receipt_voucher.receipt_voucher_type",$receipt_voucher_type)
				->where("receipt_voucher.transaction_category",$transaction_category)
				->where("{$table}.PersLoanAllocID",$data["tran_id"])
				->first();

			return $ret_data;
		}
		
		
	}
