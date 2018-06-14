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
		
		
	}
