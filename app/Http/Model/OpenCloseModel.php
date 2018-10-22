<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\RoundModel;
	use App\Http\Controllers\LogController;
	use App\Http\Model\CommonModel;
	// use App\Http\Model\CDModel;
	// use App\Http\Model\CDTranModel;
	// use App\Http\Model\SDModel;
	// use App\Http\Model\SDTranModel;
	use App\Http\Model\CDSDModel;
	use App\Http\Model\CDSDTranModel;
	class OpenCloseModel extends Model
	{
		//
		protected $table='cash';
		public $roundamt;
		public function __construct()
		{
			$this->roundamt=new RoundModel;
			$this->log_ctr= new LogController;
			// $this->common= new CommonModel;
			// $this->cd= new CDModel;
			// $this->cd_tran= new CDTranModel;
			// $this->sd= new SDModel;
			// $this->sd_tran= new SDTranModel;
			$this->cdsd= new CDSDModel;
			$this->cdsd_tran= new CDSDTranModel;
		}
		
		public function getbal()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$dte=date('Y-m-d');
			//print_r($dte);
			$xxx=DB::table('dailyopenclose')->where('Daily_Date',$dte)
			->where('Daily_Status','=',"OPEN")
			->where('Daily_Bid','=',$Branchid)
			->count('Dailyopenclose_Id');
			
			//print_r($xxx);						
			//$xyz=$xxx->Daily_Date;
			if($xxx!="0")
			{
				$id=DB::table('dailyopenclose')->select('Daily_Date','Daily_Status','Daily_TotBal','Daily_Description','addbank.Branch')
				->leftjoin('addbank','addbank.Bankid','=','dailyopenclose.Daily_Bankid')
				->where('Daily_Date',$dte)
				->where('Daily_Status','=','OPEN')
				->where('Daily_Bid','=',$Branchid)
				->get();
				
				return $id;
				
			}
			else if($xxx=="0")
			{
				
				$inhand= DB::table('cash')->select('InHandCash')->where('BID','=',$Branchid)->first();
				$inhandcash=$inhand->InHandCash;
				//	$temp=Floatval($inhand);
				
				DB::table('dailyopenclose')->insert(['Daily_Date'=>$dte,'Daily_Status'=>"OPEN",'Daily_TotBal'=>$inhandcash,'Daily_Bid'=>$Branchid,'Daily_Description'=>"INHANDCASH"]);
				$bank=DB::table('addbank')->select('BankName','TotalAmt','Bankid')->where('Bid','=',$Branchid)->get();
				for($i=0;$i<count($bank);$i++)
				{
					$bank_name=$bank[$i]->BankName;
					$bank_bal=$bank[$i]->TotalAmt;
					$bank_id=$bank[$i]->Bankid;
					DB::table('dailyopenclose')->insert(['Daily_Date'=>$dte,'Daily_Status'=>"OPEN",'Daily_TotBal'=>$bank_bal,'Daily_Bid'=>$Branchid,'Daily_Description'=>$bank_name,'Daily_Bankid'=>$bank_id]);
				}
				
				$id=DB::table('dailyopenclose')->select('Daily_Date','Daily_Status','Daily_TotBal','Daily_Description','addbank.Branch')
				->leftjoin('addbank','addbank.Bankid','=','dailyopenclose.Daily_Bankid')
				->where('Daily_Date',$dte)
				->where('Daily_Status','=','OPEN')
				->where('Daily_Bid','=',$Branchid)
				->get();
				/*$fdaccno=DB::table('fdallocation')->select('Fd_CertificateNum')->where('Closed','=',"NO")->where('intrest_needed','=',"YES")->where('Bid',$Branchid)->get();
					foreach($fdaccno as $accno)
					{
					
					$accno1=$accno->Fd_CertificateNum;
					$fddetails=DB::table('fdallocation')->select('Accid','lastinterestpaid','fdmonth','interstmonth')
					->where('Fd_CertificateNum',$accno1)
					->first();
					$fdmonth=$fddetails->fdmonth;
					$lastpaiddate=$fddetails->lastinterestpaid;
					$intertsamt=$fddetails->interstmonth;
					$accid=$fddetails->Accid;
					if($fdmonth=="1 Month(30 days)")
					{
					$days=30;
					}
					else if($fdmonth=="3 Month(90 days)")
					{
					$days=90;
					}
					else if($fdmonth=="6 Month(180 days)")
					{
					$days=180;
					}
					$date1=date_create($dte);
					$date2=date_create($lastpaiddate);
					$difdate=date_diff($date1,$date2);
					$difdays=$difdate->format('%a');
					if($difdays>=$days)
					{
					$sbtotamt1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
					$sbtotamt=$sbtotamt1->Total_Amount;
					$totamount=$sbtotamt+$intertsamt;
					DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$sbtotamt]);
					
					$sbid=DB::table('sb_transaction')->insertGetId(['Accid'=>$accid,'AccTid'=>"2",'TransactionType'=>"CREDIT",'particulars'=>"FD Interest",'Amount' =>$intertsamt,'CurrentBalance'=>$sbtotamt,'Total_Bal'=>$totamount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$month,'Year'=>$yer,'Payment_Mode'=>"FD Interest",'Bid'=>$Branchid,'CreatedBy'=>$UID]); 
					
					DB::table('fdallocation')->where('Fd_CertificateNum',$accno1)
					->update(['lastinterestpaid'=>$dte]);
					DB::table('fd_interest')->insert(['FD_Interest_date'=>$dte,'FD_Interest_AccountNo'=>$accno1,'FD_Interest_SB_Accid'=>$accid,'FD_Interest_Amount'=>$intertsamt,'FD_Interest_Bid'=>$Branchid,'FD_Interest_Sb_Tranid'=>$sbid]);
					
					}
					
				}*/
				return $id;
			}
		}
		public function getclosebal()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$dte=date('Y-m-d');
			//print_r($dte);
			$xxx=DB::table('dailyopenclose')->where('Daily_Date',$dte)
			->where('Daily_Status','=',"CLOSE")
			->where('Daily_Bid','=',$Branchid)
			->count('Dailyopenclose_Id');
			
			
			//print_r($xxx);						
			//$xyz=$xxx->Daily_Date;
			if($xxx!="0")
			{
				$id=DB::table('dailyopenclose')->select('Daily_Date','Daily_Status','Daily_TotBal','Daily_Description','addbank.Branch')
				->leftjoin('addbank','addbank.Bankid','=','dailyopenclose.Daily_Bankid')
				->where('Daily_Date',$dte)
				->where('Daily_Status','=','CLOSE')
				->get();
				
				return $id;
				
			}
			else if($xxx=="0")
			{
				
				$inhand= DB::table('cash')->select('InHandCash')->where('BID','=',$Branchid)->first();
				$inhandcash=$inhand->InHandCash;
				//	$temp=Floatval($inhand);
				//print_r($inhandcash);
				DB::table('dailyopenclose')->insert(['Daily_Date'=>$dte,'Daily_Status'=>"CLOSE",'Daily_TotBal'=>$inhandcash,'Daily_Bid'=>$Branchid,'Daily_Description'=>"INHANDCASH"]);
				$bank=DB::table('addbank')->select('BankName','TotalAmt','Bankid')->where('Bid','=',$Branchid)->get();
				for($i=0;$i<count($bank);$i++)
				{
					$bank_name=$bank[$i]->BankName;
					$bank_bal=$bank[$i]->TotalAmt;
					$bank_id=$bank[$i]->Bankid;
					DB::table('dailyopenclose')->insert(['Daily_Date'=>$dte,'Daily_Status'=>"CLOSE",'Daily_TotBal'=>$bank_bal,'Daily_Bid'=>$Branchid,'Daily_Description'=>$bank_name,'Daily_Bankid'=>$bank_id]);
				}
				
				$id=DB::table('dailyopenclose')->select('Daily_Date','Daily_Status','Daily_TotBal','Daily_Description','addbank.Branch')
				->leftjoin('addbank','addbank.Bankid','=','dailyopenclose.Daily_Bankid')
				->where('Daily_Date',$dte)
				->where('Daily_Status','=','CLOSE')
				->get();
				
				return $id;
			}
		}
		/*	public function getclosebal()
			{
			return DB::table('sb_transaction')->select('')
		}*/
		
		
		//-------------------SB datails start ----------------
		public function show_dailysbbalance($dte)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$sbtoday=$dte;
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance', DB::raw(" '' as 'SB_resp_No' "), DB::raw(" '' as 'SB_paymentvoucher_No' "),'Payment_Mode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->join("user","user.Uid","=","createaccount.Uid")
			->where("createaccount.Status","AUTHORISED")
			->where('SBReport_TranDate',$sbtoday)
			->where('sb_transaction.Bid','=',$BranchId)
			->where('Payment_Mode','=',"CASH")
			->where('tran_reversed','=',"NO")
			->where('Uncleared_Bal','=',"0")
			->where('sb_transaction.deleted','=',0)
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->get();

			$data_list = &$id;
			foreach($data_list as $key => $row) {
				$rv_adj = DB::table("receipt_voucher")
					->where("receipt_voucher.transaction_id",$row->Tranid)
					->where("receipt_voucher.transaction_category",1)
					->where("receipt_voucher.bid",$BranchId)
					->where("receipt_voucher.deleted",0)
					->value("receipt_voucher_no");
				$data_list[$key]->SB_resp_No = $rv_adj;
				$data_list[$key]->SB_paymentvoucher_No = $rv_adj;
			}

			return $id;
		}

		
		
		public function show_dailysbcreditbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('sb_transaction')->where('SBReport_TranDate','=',$dte)->where('TransactionType','=',"CREDIT")->where('Payment_Mode','=',"CASH")->where('tran_reversed','=',"NO")->where('Uncleared_Bal','=',"0")->where('Bid',$BranchId)->sum('Amount');
		}
		
		
		public function show_dailysbdebitbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('sb_transaction')->where('SBReport_TranDate',$dte)->where('TransactionType','=',"DEBIT")->where('Payment_Mode','=',"CASH")->where('tran_reversed','=',"NO")->where('Uncleared_Bal','=',"0")->where('Bid',$BranchId)->sum('Amount');
			}
		
		public function show_dailysbbalance_adjust($dte)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$sbtoday=$dte;
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance',DB::raw(" '' as 'SB_resp_No' "),DB::raw(" '' as 'SB_paymentvoucher_No' "),'Payment_Mode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),DB::raw(" '' as 'adj_no' ")	)
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->join("user","user.Uid","=","createaccount.Uid")
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","sb_transaction.Tranid")
			// ->where("receipt_voucher.transaction_category",1)
			->where("createaccount.Status","AUTHORISED")
			->where('SBReport_TranDate',$sbtoday)
			->where('sb_transaction.Bid','=',$BranchId)
			->where('Payment_Mode','<>',"CASH")
			->where('tran_reversed','=',"NO")
			->where('Uncleared_Bal','=','0')
			->where('sb_transaction.deleted','=','0')
			->where("sb_transaction.Amount",">",0)
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->get();

			$data_list = &$id;
			foreach($data_list as $key => $row) {
				$rv_adj = DB::table("receipt_voucher")
					->where("receipt_voucher.transaction_id",$row->Tranid)
					// ->where("receipt_voucher.transaction_category",1)
					// ->where("receipt_voucher.bid",$BranchId)
					// ->where("receipt_voucher.deleted",0)
					->value("receipt_voucher_no");
				$data_list[$key]->SB_resp_No = $rv_adj;
				$data_list[$key]->SB_paymentvoucher_No = $rv_adj;
				$data_list[$key]->adj_no = $rv_adj;
			}
			return $id;
		}
		
		public function show_dailysbcreditbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('sb_transaction')->where('SBReport_TranDate','=',$dte)->where('TransactionType','=',"CREDIT")->where('Uncleared_Bal','=','0')
			->where('Payment_Mode','<>',"CASH")->where('tran_reversed','=',"NO")->where('Bid',$BranchId)->sum('Amount');
		}
		
		
		public function show_dailysbdebitbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('sb_transaction')->where('SBReport_TranDate',$dte)->where('TransactionType','=',"DEBIT")->where('Payment_Mode','<>',"CASH")->where('tran_reversed','=',"NO")//->where('Uncleared_Bal','=',null)
			->where('Bid',$BranchId)->sum('Amount');
		}

		/*************** SB INTEREST PAID ***********/
		public function sb_int_paid($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;

			$sa = array(
				"Tranid",
				"SBReport_TranDate",
				"Amount",
				"particulars",
				"Payment_Mode",
				"TransactionType",
				"createaccount.AccNum",
				DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),
				"user.Uid"
			);
			$ret_data = DB::table("sb_transaction")
				->select($sa)
				->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
				->join("user","user.Uid","=","createaccount.Uid")
				->where("sb_transaction.Bid", $BID)
				->where("sb_transaction.deleted", 0)
				->where("sb_transaction.tran_reversed", "NO")
				->where("sb_transaction.Uncleared_Bal", 0)
				->where("sb_transaction.Amount",">",0)
				->where("sb_transaction.particulars", "SB INTEREST")
				->where("sb_transaction.SBReport_TranDate", $date)
				->orderBy('SBReport_TranDate','desc')
				->orderBy('Tranid','desc')
				->get();

			return $ret_data;
		}
		/*************** SB INTEREST PAID ***********/
		
		
		//-------------------SB details end-----------------------
		//-------------------RD details Start-------------------
		public function show_dailyrdbalance($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			//$dtoday=date('Y-m-d');
			$dtoday=$dte;

			
			$id = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum',DB::raw(" '' as 'RD_resp_No' "),'RDPayment_Mode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","rd_transaction.RD_TransID")
			->join("user","user.Uid","=","createaccount.Uid")
			->where("createaccount.Status","AUTHORISED")
			// ->where("receipt_voucher.transaction_category",2)
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->where('RDPayment_Mode','=',"CASH")
			->where('RD_Particulars','!=',"RD INTEREST CAL")
			->where('rd_transaction.deleted',0)
			//->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->get();


			$data_list = &$id;
			foreach($data_list as $key => $row) {
				$rv_adj = DB::table("receipt_voucher")
					->where("receipt_voucher.transaction_id",$row->RD_TransID)
					->where("receipt_voucher.transaction_category",2)
					->where("receipt_voucher.bid",$BranchId)
					->value("receipt_voucher_no");
				$data_list[$key]->RD_resp_No = $rv_adj;
			}





			/* $id1 = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum','receipt_voucher_no as RD_resp_No','RDPayment_Mode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","rd_transaction.RD_TransID")
			->join("user","user.Uid","=","createaccount.Uid")
			->where("createaccount.Status","AUTHORISED")
			->where("receipt_voucher.transaction_category",2)
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->where('RDPayment_Mode','=',"CASH")
			->where('RD_Particulars','!=',"RD INTEREST CAL")
			->where('rd_transaction.deleted',0)
			//->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->get();

			$i = -1;
			foreach($id1 as $row) {
				$id_arr[++$i] = $row->RD_TransID;
			}
			if(empty($id_arr)) {
				$id_arr = [];
			}//print_r($id1);

			$id2 = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum',DB::raw(" '' as RD_resp_No "),'RDPayment_Mode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->join("user","user.Uid","=","createaccount.Uid")
			->where("createaccount.Status","AUTHORISED")
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->where('RDPayment_Mode','=',"CASH")
			->where('rd_transaction.RD_Particulars','!=',"RD INTEREST CAL")
			->where("RD_Particulars","RD PREWITHDRAWA")
			->whereNotIn('RD_TransID',$id_arr)
			->where('rd_transaction.deleted',0)
			//->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->get();

			$id = array_merge($id1,$id2); */
			return $id;
			
		}
		
		public function show_dailyrdcreditbalance($dte)
		{
			//$dte=date('Y-m-d');
			//$dte=$dte;
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('rd_transaction')->where('RDReport_TranDate',$dte)->where('RD_Trans_Type','=',"CREDIT")->where('RDPayment_Mode','=',"CASH")->where('Bid',$BranchId)->sum('RD_Amount');
		}
		public function show_dailyrddebitbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('rd_transaction')->where('RDReport_TranDate',$dte)->where('RD_Trans_Type','=',"DEBIT")->where('RDPayment_Mode','=',"CASH")->where('Bid',$BranchId)->sum('RD_Amount');
		}
		
		public function show_dailyrdbalance_adjust($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			//$dtoday=date('Y-m-d');
			$dtoday=$dte;
			$id = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum','receipt_voucher_no as RD_resp_No','RDPayment_Mode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),'receipt_voucher_no as adj_no')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->join("user","user.Uid","=","createaccount.Uid")
			->join("receipt_voucher","receipt_voucher.transaction_id","=","rd_transaction.RD_TransID")
			->where("receipt_voucher.bid",$BranchId)
			->where("createaccount.Status","AUTHORISED")
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->where('RDPayment_Mode','<>',"CASH")
			->where('RD_Particulars','!=',"RD INTEREST CAL")
			->where('rd_transaction.deleted',0)
			//->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->get();
			return $id;
			
		}
		
		public function show_dailyrdcreditbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			//$dte=$dte;
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('rd_transaction')->where('RDReport_TranDate',$dte)->where('RD_Trans_Type','=',"CREDIT")->where('RDPayment_Mode','<>',"CASH")->where('Bid',$BranchId)->sum('RD_Amount');
		}
		public function show_dailyrddebitbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('rd_transaction')->where('RDReport_TranDate',$dte)->where('RD_Trans_Type','=',"DEBIT")->where('RDPayment_Mode','<>',"CASH")->where('Bid',$BranchId)->sum('RD_Amount');
		}
		
		//-------------------RD details Ends-------------------
		
		
		
		
		//-------------------Pigmy transtion details Start-------------------
		public function show_dailypigmycreditbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('pigmi_transaction')->where('PigReport_TranDate',$dte)->where('Transaction_Type','=',"CREDIT")->where('Bid',$BranchId)->where('pigmi_transaction.bill_no','=',"0")->where('pigmi_transaction.Agentid','=',"0")->where('pigmi_transaction.PgmPayment_Mode','<>',"CASH")->where('pigmi_transaction.Particulars','<>',"Opening Balance")->sum('Amount');
		}
		public function show_dailypigmydebitbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('pigmi_transaction')->where('PigReport_TranDate',$dte)->where('Transaction_Type','=',"DEBIT")->where('pigmi_transaction.Agentid','=',"0")->where('Bid',$BranchId)->where('pigmi_transaction.PgmPayment_Mode','<>',"CASH")->where('pigmi_transaction.bill_no','=',"0")->sum('Amount');
		}
		public function show_dailypigmybalance_cash_credit($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('pigmi_transaction')->where('PigReport_TranDate',$dte)->where('Transaction_Type','=',"CREDIT")->where('Bid',$BranchId)->where('pigmi_transaction.bill_no','=',"0")->where('pigmi_transaction.Agentid','=',"0")->where('pigmi_transaction.PgmPayment_Mode','=',"CASH")->where('pigmi_transaction.Particulars','<>',"Opening Balance")->sum('Amount');
		}
		public function show_dailypigmybalance_cash_debit($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			return DB::table('pigmi_transaction')->where('PigReport_TranDate',$dte)->where('Transaction_Type','=',"DEBIT")->where('pigmi_transaction.Agentid','=',"0")->where('Bid',$BranchId)->where('pigmi_transaction.PgmPayment_Mode','=',"CASH")->where('pigmi_transaction.bill_no','=',"0")->sum('Amount');
		}
		
/*		public function show_dailypigmybalance($dte)
		{
			//$pigtoday=date('Y-m-d');
			$pigtoday=$dte;
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->where('PigReport_TranDate','=',$pigtoday)
			->where('pigmi_transaction.Bid','=',$BranchId)
			->where('pigmi_transaction.bill_no','=',"0")
			->where('pigmi_transaction.Agentid','=',"0")
			->where('pigmi_transaction.PgmPayment_Mode','<>',"CASH")
			->where('pigmi_transaction.PgmPayment_Mode','<>',"INTEREST AMOUNT")
			->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL A")
			->where('pigmi_transaction.Particulars','<>',"Opening Balance")
//			->where('pigmi_transaction.Particulars','<>',"Amount Debited to DL Account")
//			->where('pigmiallocation.Closed','<>',"YES")
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->get();
			return $id;
		}*/
		
		
		
		public function show_dailypigmybalance($dte)
                {
                        //$pigtoday=date('Y-m-d');
                        $pigtoday=$dte;
                        $uname='';
                        if(Auth::user())
                        $uname= Auth::user();
                        $BranchId=$uname->Bid;
                        
                        
                        $data = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
                        ->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
                        ->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						->join("user","user.Uid","=","pigmiallocation.UID")
                        ->where('PigReport_TranDate','=',$pigtoday)
                        ->where('pigmi_transaction.Bid','=',$BranchId)
                        ->where('pigmi_transaction.bill_no','=',"0")
                        ->where('pigmi_transaction.Agentid','=',"0")
                        ->where('pigmi_transaction.PgmPayment_Mode','<>',"CASH")
                        ->where('pigmi_transaction.PgmPayment_Mode','<>',"INTEREST AMOUNT")
                        ->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL A")
                        ->where('pigmi_transaction.Particulars','<>',"Opening Balance")
                                ->orderBy('PigReport_TranDate','desc')
                        ->orderBy('PigmiTrans_ID','desc')
                        ->get();
                        $temp=array();
                        foreach($data AS $dataa)
                        {
                        
                                $PigmiAcc_No=$dataa->PigmiAcc_No;
                                $num_count=DB::table('pigmi_payamount')->where('PayAmountReport_PayDate','=',$pigtoday)->where('PayAmount_PigmiAccNum','=',$PigmiAcc_No)->count('PayId');
                                //print_r($num_count);
                                if($num_count==0)
                                {
                                        $temp[]=$dataa;
                        
                                }
                        }
                        return $temp;
                        //return $id;
                }
		
		
		
		public function show_dailypigmybalance_cash($dte)
		{
			//$pigtoday=date('Y-m-d');
			$pigtoday=$dte;
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where('PigReport_TranDate','=',$pigtoday)
			->where('pigmi_transaction.Bid','=',$BranchId)
			->where('pigmi_transaction.bill_no','=',"0")
//			->where('pigmi_transaction.Agentid','=',"0")
			->where('pigmi_transaction.PgmPayment_Mode','=',"CASH")
			//->where('pigmi_transaction.PgmPayment_Mode','<>',"CASH")
			->where('pigmi_transaction.Particulars','<>',"Opening Balance")
			->where("pigmi_transaction.tran_reversed", "NO")
			->where("pigmi_transaction.deleted", 0)
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->get();
			return $id;
		}
		
		public function show_pigmy_service_charge($dte)
		{
			//$pigtoday=date('Y-m-d');
			$pigtoday=$dte;
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where('PigReport_TranDate','=',$pigtoday)
			->where('service_charge','=',1)
			->where('pigmi_transaction.Bid','=',$BranchId)
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->get();
			return $id;
		}
		//-------------------Pigmy details End-------------------
		
		//-------------------Pigmy payamount details start-------------------
		public function show_dailypigmypayamtbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')->select('PayId','PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate',DB::raw(" '' as 'PayAmount_ReceiptNum' "),DB::raw(" '' as 'PayAmount_PaymentVoucher' "),'user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join("user","user.Uid","=","pigmiallocation.UID")
			// ->where("receipt_voucher.transaction_category",14)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','=',"CASH")
			->where('PayAmount_IntType','=',"INTEREST")
			->where('pigmi_payamount.deleted',0)
			->get();

			
			$data_list = &$id;
			foreach($data_list as $key => $row) {
				$rv_adj = DB::table("receipt_voucher")
					->where("receipt_voucher.transaction_id",$row->PayId)
					->where("receipt_voucher.transaction_category",14)
					->where("receipt_voucher.bid",$BranchId)
					->where("receipt_voucher.deleted",0)
					->value("receipt_voucher_no");
				$data_list[$key]->PayAmount_PaymentVoucher = $rv_adj;
				$data_list[$key]->PayAmount_ReceiptNum = $rv_adj;
			}
			
			return $id;
		}
		public function show_dailypigmypayamttotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_IntType','=',"INTEREST")
			->where('PayAmount_PaymentMode',"CASH")
			->sum('PayAmount_PayableAmount');
			
			return $id;
		}
		
		public function show_dailypigmypayamtbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')->select('pigmi_payamount.PayId','PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate',DB::raw(" '' as 'PayAmount_ReceiptNum' "),DB::raw(" '' as 'PayAmount_PaymentVoucher' "),'user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),DB::raw(" '' as 'adj_no' "))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("user","user.Uid","=","pigmiallocation.UID")
			// ->join("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			// ->where("receipt_voucher.bid",$BranchId)
			// ->where("receipt_voucher.transaction_category",14)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"INTEREST")
			->where('pigmi_payamount.deleted',0)
			->get();

			/**************************** pigmi paid amount single entry ***************************/
			$pre_row = NULL;
			$pre_no = '';
			foreach($id as $key => $row)
			{
				$cur_no = $row->PayAmount_PigmiAccNum;
				if($cur_no == $pre_no){
				//	echo "-found- ";
					$cur_amt = $row->PayAmount_PayableAmount;
					$pre_row->PayAmount_PayableAmount += $cur_amt;
					unset($id[$key]);
					continue;
				}
				$pre_row = $row;
				$pre_no = $cur_no;
			}
			/**************************** pigmi paid amount single entry ***************************/
			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "PayId";
			$fd["transaction_category"] = 14;
			$fd["receipt_voucher_type"] = 3;
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["PayAmount_ReceiptNum","PayAmount_PaymentVoucher","adj_no"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			return $id;
		}
		public function show_dailypigmypayamttotbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_IntType','=',"INTEREST")
			->where('PayAmount_PaymentMode','<>',"CASH")
			->sum('PayAmount_PayableAmount');
			
			return $id;
		}
		
		
		public function show_dailypigmypayamtbalance_per($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')->select('pigmi_payamount.PayId','PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate',DB::raw(" '' as 'PayAmount_ReceiptNum' "),DB::raw(" '' as 'PayAmount_PaymentVoucher' "),'PgmTotal_Amt','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join("user","user.Uid","=","pigmiallocation.UID")
			// ->where("receipt_voucher.transaction_category",14)
			// ->where("receipt_voucher.receipt_voucher_type",2)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->where('pigmi_payamount.deleted',0)
			->get();

			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "PayId";
			$fd["transaction_category"] = 14;
			$fd["receipt_voucher_type"] = 2;
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["PayAmount_ReceiptNum","PayAmount_PaymentVoucher"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/

			return $id;
		}

		public function show_dailypigmypayamttotbalance_per($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->sum('PgmTotal_Amt');
			
			return $id;
		}
		public function show_dailypigmypayamtbalance_per_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')->select('pigmi_payamount.PayId','PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate',DB::raw(" '' as 'PayAmount_ReceiptNum' "),DB::raw(" '' as 'PayAmount_PaymentVoucher' "),'PgmTotal_Amt','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),DB::raw(" '' as 'adj_no' ") )
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->where('pigmi_payamount.deleted',0)
			->get();
			
			/**************************** pigmi paid amount single entry ***************************/
			$pre_row = NULL;
			$pre_no = '';
			foreach($id as $key => $row)
			{
				$cur_no = $row->PayAmount_PigmiAccNum;
				if($cur_no == $pre_no){
				//	echo "-found- ";
					$cur_amt = $row->PayAmount_PayableAmount;
					$pre_row->PayAmount_PayableAmount += $cur_amt;
					unset($id[$key]);
					continue;
				}
				$pre_row = $row;
				$pre_no = $cur_no;
			}
			/**************************** pigmi paid amount single entry ***************************/


			/**************************** Adding extra charges ***************************/
			foreach($id as $key => $row)
			{
				$PigmiAcc_No = $row->PayAmount_PigmiAccNum;
				$pre_with_row = DB::table("pigmi_prewithdrawal")
					->where("PigmiAcc_No","=",$PigmiAcc_No)
					->first();
				$Deduct_Commission = $pre_with_row->Deduct_Commission;
				$Deduct_Amount = $pre_with_row->Deduct_Amount;
				
			//	$id[$key]->PayAmount_PayableAmount += ($Deduct_Commission + $Deduct_Amount);
				$id[$key]->PayAmount_PayableAmount = $pre_with_row->PgmTotal_Amt;
			}
			/**************************** Adding extra charges ***************************/
			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "PayId";
			$fd["transaction_category"] = 14;
			$fd["receipt_voucher_type"] = 3;
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["PayAmount_ReceiptNum","PayAmount_PaymentVoucher","adj_no"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			
			
			return $id;
		}
		public function show_dailypigmypayamttotbalance_per_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->sum('PayAmount_PayableAmount');
			
			return $id;
			
			
		}
		
		public function show_pigmicharg($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','PayAmount_ReceiptNum',/*'receipt_voucher_no as PayAmount_PaymentVoucher',*/DB::raw(" '' as PayAmount_PaymentVoucher "),'PgmTotal_Amt','Deduct_Commission','Deduct_Amount','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join("user","user.Uid","=","pigmiallocation.UID")
			// ->where("receipt_voucher.transaction_category",14)
			// ->where("receipt_voucher.receipt_voucher_type",1)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','=',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->where('pigmi_payamount.deleted',0)
			->get();
			return $id;
		}
		public function show_pigmichargtot_comm($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			//->where('PayAmount_PaymentMode','=',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->sum('Deduct_Commission');
			return $id;
		}public function show_pigmichargtot_amt($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','=',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->sum('Deduct_Amount');
			return $id;
		}
		public function show_pigmicharg_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','receipt_voucher_no as PayAmount_ReceiptNum','receipt_voucher_no as PayAmount_PaymentVoucher','PgmTotal_Amt','Deduct_Commission','Deduct_Amount','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),'receipt_voucher_no as adj_no')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->where('pigmi_payamount.deleted',0)
			->get();
			
			
			
/**************************** pigmi paid amount single entry ***************************/
			$pre_row = NULL;
			$pre_no = '';
			foreach($id as $key => $row)
			{
				$cur_no = $row->PayAmount_PigmiAccNum;
				if($cur_no == $pre_no){
				//	echo "-found- ";
					$cur_amt = $row->PayAmount_PayableAmount;
					$pre_row->PayAmount_PayableAmount += $cur_amt;
					unset($id[$key]);
					continue;
				}
				$pre_row = $row;
				$pre_no = $cur_no;
			}
/**************************** pigmi paid amount single entry ***************************/
			
			return $id;
		}
		
		public function show_pigmichargtot_comm_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->sum('Deduct_Commission');
			return $id;
		}public function show_pigmichargtot_amt_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pigmi_payamount')
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->sum('Deduct_Amount');
			return $id;
		}
		
		//-------------------Pigmy payamount details end-------------------
		public function show_dailyrdpayamtbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('rd_payamount')->select('rd_payamount.RDPayId','RDPayAmt_AccNum','RDPayAmt_PayableAmount','RDPayAmtReport_PayDate',DB::raw(" '' as 'RD_PayAmount_pamentvoucher' "), 'RDPayAmt_PaymentMode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),DB::raw(" '' as 'adj_no' ") )
			->join('createaccount','createaccount.AccNum','=','rd_payamount.RDPayAmt_AccNum')
			// ->join("receipt_voucher","receipt_voucher.transaction_id","=","rd_payamount.RDPayId")
			->join("user","user.Uid","=","createaccount.Uid")
			// ->where("receipt_voucher.transaction_category",15)
			->where('createaccount.Bid',$BranchId)
			->where('RDPayAmtReport_PayDate',$dte)
			->where('rd_payamount.deleted',0)
			->get();
			
			/* $id=DB::table('rd_payamount')->select('RDPayAmt_AccNum','RDPayAmt_PayableAmount','RDPayAmtReport_PayDate','receipt_voucher_no as RD_PayAmount_pamentvoucher', 'RDPayAmt_PaymentMode','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),'receipt_voucher_no as adj_no')
			->join('createaccount','createaccount.AccNum','=','rd_payamount.RDPayAmt_AccNum')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","rd_payamount.RDPayId")
			->join("user","user.Uid","=","createaccount.Uid")
			->where("receipt_voucher.transaction_category",15)
			->where('createaccount.Bid',$BranchId)
			->where('RDPayAmtReport_PayDate',$dte)
			->where('rd_payamount.deleted',0)
			->get(); */
			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "RDPayId";
			$fd["transaction_category"] = 15;
			$fd["receipt_voucher_type"] = ""; // ANY
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["RD_PayAmount_pamentvoucher","adj_no"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			return $id;
		}
		public function show_dailyrdpayamttotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('rd_payamount')->where('RDPayAmtReport_PayDate',$dte)->join('createaccount','createaccount.AccNum','=','rd_payamount.RDPayAmt_AccNum')
			->where('createaccount.Bid',$BranchId)->sum('RDPayAmt_PayableAmount');
			
			return $id;
		}
		//----------------------FDALLOATION STARTS------------------
		public function show_dailyfdallocamtbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fdallocation')->select('fdallocation.Fdid','Fd_CertificateNum','Fd_DepositAmt','Created_Date',DB::raw(" '' as 'FD_resp_No' "),'user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","fdallocation.Fdid")
			->join("user","user.Uid","=","fdallocation.Uid")
			// ->where("receipt_voucher.transaction_category",8)
			->where('Created_Date',$dte)
			->where('FDPayment_Mode','=',"CASH")
			->where('FdTid','!=',1)
			->where('fdallocation.Bid',$BranchId)
			->get();
			
			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "Fdid";
			$fd["transaction_category"] = 8;
			$fd["receipt_voucher_type"] = 1;
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["FD_resp_No"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			return $id;
		}


		public function show_dailykccallocamtbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fdallocation')->select('Fd_CertificateNum','Fd_DepositAmt','Created_Date','receipt_voucher_no as FD_resp_No','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","fdallocation.Fdid")
			->join("user","user.Uid","=","fdallocation.Uid")
			->where("receipt_voucher.transaction_category",8)
			->where('Created_Date',$dte)
			->where('FDPayment_Mode','=',"CASH")
			->where('FdTid','=',1)
			
			->where('fdallocation.Bid',$BranchId)
			->get();
			return $id;
		}

		public function show_dailyfdallocamttotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fdallocation')->where('Created_Date',$dte)->where('Bid',$BranchId)->where('FDPayment_Mode','=',"CASH")->sum('Fd_DepositAmt');
			
			return $id;
		}
		public function show_dailyfdallocamtbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fdallocation')
			->select('fdallocation.Fdid','Fd_CertificateNum','Fd_DepositAmt','Created_Date','FD_resp_No',DB::raw(" '' as 'adj_no' "),'user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name") )
			->leftjoin("user","user.Uid","=","fdallocation.Uid")
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","fdallocation.Fdid")
			->where('Created_Date',$dte)
			->where('FDPayment_Mode','<>',"CASH")
			->where('FdTid','!=',1)
			->where('fdallocation.Bid',$BranchId)
			->get();

			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "Fdid";
			$fd["transaction_category"] = 8;
			$fd["receipt_voucher_type"] = 3;
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["adj_no"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			
			return $id;
		}

		public function show_dailykccallocamtbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fdallocation')
			->select('Fd_CertificateNum','Fd_DepositAmt','Created_Date','FD_resp_No','receipt_voucher_no as adj_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","fdallocation.Fdid")
			->where('Created_Date',$dte)
			->where('FDPayment_Mode','<>',"CASH")
			->where('FdTid','=',1)
			
			->where('fdallocation.Bid',$BranchId)
			->get();
			return $id;
		}

		public function show_dailyfdallocamttotbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fdallocation')->where('Created_Date',$dte)->where('Bid',$BranchId)->where('FDPayment_Mode','<>',"CASH")->sum('Fd_DepositAmt');
			
			return $id;
		}
		//-----------------------FDALLOATION ENDS----------------
		//-----------------------FD PAYAMOUNT SATRT----------------
		public function show_dailyfdpayamtbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fd_payamount')->select('FDPayAmt_AccNum','FDPayAmt_PayableAmount','FDPayAmtReport_PayDate','receipt_voucher_no as FD_PayAmount_pamentvoucher','user.Uid',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),'fdallocation.FdTid')
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","fd_payamount.FDPayId")
			->join("user","user.Uid","=","fdallocation.Uid")
			->where("receipt_voucher.transaction_category",16)
			->where("receipt_voucher.bid",$BranchId)
			->where('fdallocation.Bid',$BranchId)
			->where('FDPayAmt_PaymentMode','=',"CASH")
			->where('FDPayAmtReport_PayDate',$dte)
			->where('fd_payamount.deleted',0)
			->get();
			return $id;
		}
		public function show_dailyfdpayamttotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			$id=DB::table('fd_payamount')->where('FDPayAmtReport_PayDate',$dte)->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->where('FDPayAmt_PaymentMode','=',"CASH")
			->where('fdallocation.Bid',$BranchId)->sum('FDPayAmt_PayableAmount');
			
			return $id;
		}
		public function show_dailyfdpayamtbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('fd_payamount')->select('FDPayAmt_AccNum','FDPayAmt_PayableAmount','FDPayAmtReport_PayDate','FD_PayAmount_pamentvoucher',"user.Uid",DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),'receipt_voucher_no as adj_no','fdallocation.FdTid')
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->join("user","user.Uid","=","fdallocation.Uid")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","fd_payamount.FDPayId")
			->where('receipt_voucher.transaction_category',16)//16-fd pay amt
			->where('receipt_voucher.bid', $BranchId)
			->where('fdallocation.Bid',$BranchId)
			->where('FDPayAmt_PaymentMode','<>',"CASH")
			->where('FDPayAmtReport_PayDate',$dte)
			->where('fd_payamount.deleted',0)
			->get();

			/************************** SINGLE ENTRY FOR FD PAY AMOUNT **********************************/
			$temp_list = array();
			foreach($id as $key => $row) {
				$acc_no = $row->FDPayAmt_AccNum;
				if(isset($temp_list[$acc_no])) {// ACCOUNT NUMEBR REPEATED (HAS MORE THAN ONE PAYMENT ENTRY)
					$old_key = $temp_list[$acc_no];
					$id[$old_key]->FDPayAmt_PayableAmount += $row->FDPayAmt_PayableAmount;// ADD CURRENT ENTRY AMOUNT TO OLD ENTRY'S AMOUNT
					$id[$old_key]->adj_no .= ", {$row->adj_no}";
					unset($id[$key]);// DELETE CURRENT ENTRY
				} else {
					$temp_list[$acc_no] = $key;// SAVE CURRENT ACCOUNT NO
				}
			}
			/************************** SINGLE ENTRY FOR FD PAY AMOUNT **********************************/

			return $id;
		}
		public function show_dailyfdpayamttotbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			$id=DB::table('fd_payamount')->where('FDPayAmtReport_PayDate',$dte)->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->where('FDPayAmt_PaymentMode','<>',"CASH")
			->where('fdallocation.Bid',$BranchId)->sum('FDPayAmt_PayableAmount');
			
			return $id;
		}
		//-----------------------FD PAYAMOUNT ENDS----------------
		public function show_dailysharebalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('purchaseshare')->select('PURSH_Memshareid','PURSH_Totalamt','PURSH_Date', 'receipt_voucher_no as PURSH_Share_resp_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","purchaseshare.PURSH_Pid")
			->join("members","members.Memid","=","purchaseshare.PURSH_Memid")
			->join("user","user.Uid","=","members.Uid")
			->where("receipt_voucher.transaction_category",12)
			->where('purchaseshare.Bid',$BranchId)
			->where('PURSH_Date',$dte)
			->get();
			return $id;
		}
		public function show_dailysharetotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('purchaseshare')->where('PURSH_Date',$dte)->where('Bid',$BranchId)->sum('PURSH_Totalamt');
			
			return $id;
		}
		
		public function show_dailymembsharebalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('members')->select('Memid','Member_Fee','CreatedDate', 'receipt_voucher_no as member_resp_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","members.Memid")
			->join("user","user.Uid","=","members.Uid")
			->where("receipt_voucher.transaction_category",11)
			->where('CreatedDate',$dte)
			->where('members.Bid',$BranchId)
			->get();
			return $id;
		}
		public function show_dailymembsharetotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('members')->where('CreatedDate',$dte)->where('Bid',$BranchId)->sum('Member_Fee');
			
			return $id;
		}
		
		public function show_dailymembclassdbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('customer')->select('customer.FirstName','Customer_Fee','customer.Created_on','receipt_voucher_no as Customer_ReceiptNum','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","customer.Custid")
			->join("user","user.Uid","=","customer.Uid")
			->where("receipt_voucher.transaction_category",28)
			->where('customer.Created_on',$dte)
			->where('customer.Bid',$BranchId)
			->where('custtyp', 'CLASS D')
			->where('customer.AuthStatus', 'AUTHORISED')
			->get();
			return $id;
		}
		public function show_dailymembclassdtotbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('customer')->where('Created_on',$dte)->where('Bid',$BranchId)->sum('Customer_Fee');
			
			return $id;
		}	
		
		//--------------------------DL REPAY Start----------------
		public function show_dlrepaytot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('depositeloan_repay')
			->where('DLRepay_Date',$dte)
			->where('DLRepay_Bid',$BranchId)
			->where('DLRepay_PayMode','=',"CASH")
			->where("depositeloan_repay.deleted",0)
			->sum('DLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_dlrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('depositeloan_repay')->select('DepLoan_LoanNum','DLRepay_Date','receipt_voucher_no as dL_ReceiptNum','DLRepay_PaidAmt','DLRepay_PrincipalPaid','DLRepay_InterestPaid','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->join('depositeloan_allocation','depositeloan_allocation.DepLoanAllocId','=','DLRepay_DepAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_repay.DLRepay_ID")
			->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
			->where("receipt_voucher.transaction_category",21)
			->where('DLRepay_Date',$dte)
			->where('DLRepay_PayMode','=',"CASH")
			->where('DLRepay_Bid',$BranchId)
			->where('depositeloan_repay.deleted',0)
			->get();
			
			return $id;
		}public function show_dlrepaytot_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('depositeloan_repay')->where('DLRepay_Date',$dte)->where('DLRepay_Bid',$BranchId)->where('DLRepay_PayMode','<>',"CASH")->where("depositeloan_repay.deleted",0)->sum('DLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_dlrepay_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('depositeloan_repay')->select('DepLoan_LoanNum','DLRepay_Date','dL_ReceiptNum','DLRepay_PaidAmt','DLRepay_PrincipalPaid','DLRepay_InterestPaid',DB::raw(" '' as adj_no "))
			->join('depositeloan_allocation','depositeloan_allocation.DepLoanAllocId','=','DLRepay_DepAllocID')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_repay.DLRepay_ID")
			// ->where("receipt_voucher.transaction_category",21)
			->where('DLRepay_Date',$dte)
			->where('DLRepay_PayMode','<>',"CASH")
			->where('DLRepay_Bid',$BranchId)
			->where('depositeloan_repay.deleted',0)
			->get();
			
			return $id;
		}
		//--------------------------DL REPAY END----------------
		//--------------------------PL REPAY SATRT--------------------------
		public function show_plrepaytot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('personalloan_repay')->where('PLRepay_PayMode','=',"CASH")->where('PLRepay_Date',$dte)->where('PLRepay_Bid',$BranchId)->where("personalloan_repay.deleted",0)->sum('PLRepay_PaidAmt');
			
			return $id;
		}
		public function show_plrepaytot_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('personalloan_repay')->where('PLRepay_PayMode','<>',"CASH")->where('PLRepay_Date',$dte)->where('PLRepay_Bid',$BranchId)->where("personalloan_repay.deleted",0)->sum('PLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_plrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('personalloan_repay')->select('PersLoan_Number','PLRepay_Date','receipt_voucher_no as PL_ReceiptNum','PLRepay_PaidAmt',"PLRepay_Amtpaidtoprincpalamt","PLRepay_PaidInterest",'user.Uid', 'pigmy_commission', DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->join('personalloan_allocation','personalloan_allocation.PersLoanAllocID','=','PLRepay_PLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_repay.PLRepay_Id")
			->join("members","members.Memid","=","personalloan_allocation.MemId")
			->join("user","user.Uid","=","members.Uid")
			->where("receipt_voucher.transaction_category",22)
			->where('PLRepay_PayMode','=',"CASH")
			->where('PLRepay_Date',$dte)
			->where('PLRepay_Bid',$BranchId)
			->where('personalloan_repay.deleted',0)
			->get();
			
			return $id;
		}
		public function show_plrepay_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('personalloan_repay')->select('PersLoan_Number','PLRepay_Date', DB::raw(" '-' as 'PL_ReceiptNum' "),'PLRepay_PaidAmt',"PLRepay_Amtpaidtoprincpalamt","PLRepay_PaidInterest",'user.Uid', 'pigmy_commission', DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),DB::raw("'' as 'adj_no'"))
			->join('personalloan_allocation','personalloan_allocation.PersLoanAllocID','=','PLRepay_PLAllocID')
			->join("members","members.Memid","=","personalloan_allocation.MemId")
			->join("user","user.Uid","=","members.Uid")
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_repay.PLRepay_Id")//NO ADJ NO. FOR ADJ CREDIT
			// ->where("receipt_voucher.receipt_voucher_type",3)
			->where('PLRepay_PayMode','<>',"CASH")
			->where('PLRepay_Date',$dte)
			->where('PLRepay_Bid',$BranchId)
			->where('personalloan_repay.deleted',0)
			->get();
			
			return $id;
		}
		
		public function show_jlrepaytot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('jewelloan_repay')->where('JLRepay_Date',$dte)->where('JLRepay_Bid',$BranchId)->where("jewelloan_repay.deleted",0)->sum('JLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_jlrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('jewelloan_repay')->select('JLRepay_Id','JewelLoan_LoanNumber','JLRepay_Date',DB::raw(" '' as 'jL_ReceiptNum' ") /*'receipt_voucher_no as jL_ReceiptNum'*/,'JLRepay_PaidAmt','JLRepay_PayMode',"JLRepay_paidtoprincipalamt","JLRepay_interestpaid",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),DB::raw(" '' as 'adj_no' ")/*'receipt_voucher_no as adj_no'*/)
			->join('jewelloan_allocation','jewelloan_allocation.JewelLoanId','=','JLRepay_JLAllocID')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_repay.JLRepay_Id")
			->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
			// ->where("receipt_voucher.transaction_category",23)
			->where('JLRepay_Date',$dte)
			->where('JLRepay_Bid',$BranchId)
			->where('jewelloan_repay.deleted',0)
			->get();
			
			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "JLRepay_Id";
			$fd["transaction_category"] = 23;
			$fd["receipt_voucher_type"] = "";
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["jL_ReceiptNum","adj_no"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			
			return $id;
		}
		
		public function show_slrepaytot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('staffloan_repay')->where('SLRepay_Date',$dte)->where('SLRepay_Bid',$BranchId)->where("staffloan_repay.deleted",0)->sum('SLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_slrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id1 = DB::table('staffloan_repay')->select('StfLoan_Number','SLRepay_Date','SLRepay_PaidAmt','paid_principle','SLRepay_PayMode','receipt_voucher_no as receipt_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),'receipt_voucher_no as adj_no')
			->join('staffloan_allocation','staffloan_allocation.StfLoanAllocID','=','SLRepay_SLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_repay.SLRepay_Id")
			->join("user","user.Uid","=","staffloan_allocation.Uid")
			->where("receipt_voucher.transaction_category",24)
			->where('SLRepay_Date',$dte)
			->where('SLRepay_Bid',$BranchId)
			->where('staffloan_repay.SLRepay_PayMode', "=", "CASH")
			->where('staffloan_repay.deleted', "=", 0)
			->get();
			
			$id2 = DB::table('staffloan_repay')->select('StfLoan_Number','SLRepay_Date','SLRepay_PaidAmt','paid_principle','SLRepay_PayMode','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), DB::raw(" '' as 'adj_no' "), DB::raw(" '' as 'receipt_no' ") )
			->join('staffloan_allocation','staffloan_allocation.StfLoanAllocID','=','SLRepay_SLAllocID')
			->join("user","user.Uid","=","staffloan_allocation.Uid")
			->where('SLRepay_Date',$dte)
			->where('SLRepay_Bid',$BranchId)
			->where('staffloan_repay.SLRepay_PayMode', "!=", "CASH")
			->where('staffloan_repay.deleted', "=", 0)
			->get();

			$id = array_merge($id1, $id2);
			
			return $id;
		}
		
		public function show_slrepay_interest($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id1 = DB::table('staffloan_repay')->select('StfLoan_Number','SLRepay_Date','SLRepay_Interest','SLRepay_PayMode','receipt_voucher_no as receipt_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), DB::raw(" '' as 'adj_no' ") )
			->join('staffloan_allocation','staffloan_allocation.StfLoanAllocID','=','SLRepay_SLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_repay.SLRepay_Id")
			->join("user","user.Uid","=","staffloan_allocation.Uid")
			->where("receipt_voucher.transaction_category",24)
			->where('SLRepay_Date',$dte)
			->where('SLRepay_Bid',$BranchId)
			->where('staffloan_repay.deleted', "=", 0)
			->get();
			
			$id2 = DB::table('staffloan_repay')->select('StfLoan_Number','SLRepay_Date', 'SLRepay_Interest', 'SLRepay_PaidAmt','paid_principle','SLRepay_PayMode','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), DB::raw(" '' as 'adj_no' "), DB::raw(" '' as 'receipt_no' ") )
			->join('staffloan_allocation','staffloan_allocation.StfLoanAllocID','=','SLRepay_SLAllocID')
			->join("user","user.Uid","=","staffloan_allocation.Uid")
			->where('SLRepay_Date',$dte)
			->where('SLRepay_Bid',$BranchId)
			->where('staffloan_repay.SLRepay_PayMode', "!=", "CASH")
			->where('staffloan_repay.deleted', "=", 0)
			->get();

			$id = array_merge($id1, $id2);
			
			return $id;
		}
		
		
		public function branch_branch_tot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('branch_to_branch')->where('Branch_Tran_Date',$dte)->where('Branch_Branch1_Id',$BranchId)->sum('Branch_Amount');
			
			return $id;
		}
		
		public function branch_branch_tran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('branch_to_branch')->select('branch_to_branch.Branch_Id','BName','Branch_Tran_Date','Branch_Amount','Branch_per','Branch_payment_Mode',DB::raw(" '' as 'voucher_no' "),DB::raw(" '' as 'adj_no' ") )
			->join('branch','branch.Bid','=','Branch_Branch2_Id')
			// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","branch_to_branch.Branch_Id")
			// ->where("receipt_voucher.transaction_category",4)
			// ->where("receipt_voucher.bid",$BranchId)
			// ->where("receipt_voucher.deleted",0)
			->where('Branch_Tran_Date',$dte)
			->where('Branch_Branch1_Id',$BranchId)
			->where('branch_to_branch.deleted',0)
			->get();
			
			/********************** APPEND RV ADJ NO **************************/
			unset($fd);
			$fd["transaction_id"] = "Branch_Id";
			$fd["transaction_category"] = 4;
			$fd["receipt_voucher_type"] = "";
			$fd["bid"] = $BranchId;
			$fd["rv_fields"] = ["voucher_no","adj_no"]; // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
			$this->daily_rep_rv_adj_no($id,$fd); // $id is passed through reference
			/********************** APPEND RV ADJ NO **************************/
			
			return $id;
		}
		public function branch_branch_tot_credit($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('branch_to_branch')->where('Branch_Tran_Date',$dte)->where('Branch_Branch2_Id',$BranchId)->sum('Branch_Amount');
			
			return $id;
		}
		
		public function branch_branch_tran_credit($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id1=DB::table('branch_to_branch')
				->select('Branch_Id','BName','Branch_Tran_Date','Branch_Amount','Branch_per','Branch_payment_Mode','receipt_voucher_no as receipt_no',DB::raw(" '' as 'adj_no' "), 'SubLedgerId')
				->join('branch','branch.Bid','=','Branch_Branch1_Id')
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","branch_to_branch.Branch_Id")
				->where("receipt_voucher.transaction_category",4)
				->where("receipt_voucher.bid",$BranchId)
				->where("receipt_voucher.deleted",0)
				->where('Branch_Tran_Date',$dte)
				->where('Branch_Branch2_Id',$BranchId)
				->where('branch_to_branch.deleted',0)
				->get();

			$i = -1;
			foreach($id1 as $row) {
				$id_arr[++$i] = $row->Branch_Id;
			}
			if(empty($id_arr)) {
				$id_arr = [];
			}

			/******* ADJUSTMENT CREDIT *****/
			$id2 = DB::table('branch_to_branch')
				->select('BName','Branch_Tran_Date','Branch_Amount','Branch_per','Branch_payment_Mode',DB::raw(" '' as 'adj_no' "), DB::raw(" '' as 'receipt_no' "), 'SubLedgerId')
				->join('branch','branch.Bid','=','Branch_Branch1_Id')
				->where('Branch_Tran_Date',$dte)
				->where('Branch_Branch2_Id',$BranchId)
				->where("branch_to_branch.Branch_payment_Mode", "!=", "INHAND")
				->whereNotIn('Branch_Id',$id_arr)
				->where('branch_to_branch.deleted',0)
				->get();
			// $id2 = [];
			/******* ADJUSTMENT CREDIT *****/
			$id = array_merge($id1,$id2);
			/******* END *****/
			
			return $id;
		}

		public function Bank_Branch($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id1=DB::table('deposit')->select('d_id','deposit.date','BankName','amount','reason','pay_mode','Deposit_type','receipt_voucher_no as receipt_no','receipt_voucher_no as voucher_no','receipt_voucher_no as adj_no')
			->leftJoin('addbank','addbank.Bankid','=','deposit.depo_bank_id')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","deposit.d_id")
			->where("receipt_voucher.transaction_category", ReceiptVoucherModel::DEPOSIT)
			->where("receipt_voucher.bid", $BranchId)
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where('deposit.Bid',$BranchId)
			->where('deposit.date',$dte)
			->where('deposit.deleted',0)
			->get();

			$i = -1;
			foreach($id1 as $row) {
				$id_arr[++$i] = $row->d_id;
			}
			if(empty($id_arr)) {
				$id_arr = [];
			}//print_r($id1);

			/******* ADJUSTMENT CREDIT *****/
			$id2=DB::table('deposit')->select('d_id','deposit.date','BankName','amount','reason','pay_mode','Deposit_type',DB::raw("'' as receipt_no"),DB::raw("'' as voucher_no"),DB::raw("'' as adj_no"))
			->leftJoin('addbank','addbank.Bankid','=','deposit.depo_bank_id')
			->where('deposit.Bid',$BranchId)
			->where('deposit.date',$dte)
			->where('deposit.Deposit_type',"WITHDRAWL")
			->where('deposit.pay_mode',"!=","INHAND")
			->whereNotIn('d_id',$id_arr)
			->where('deposit.deleted',0)
			->get();
			/******* ADJUSTMENT CREDIT *****/
			$id = array_merge($id1,$id2);
			/******* END *****/
			return $id;
			
		}
		public function Bank_Branch_tot($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('deposit')
			->where('deposit.Bid',$BranchId)
			->where('date',$dte)
			->sum('amount');
			return $id;
		}
		public function agentcoll_tot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pending_pigmy')->where('PendPigmy_ReceivedDate',$dte)->where('PendPigmy_Bid',$BranchId)->sum('PenPigmy_AmountReceived');
			
			return $id;
		}
		
		public function agentcoll_tran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('pending_pigmy')->select('FirstName','MiddleName','LastName','PendPigmy_ReceivedDate','PenPigmy_AmountReceived','receipt_voucher_no as receipt_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->join('user','user.Uid','=','pending_pigmy.PendPigmy_AgentUid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pending_pigmy.PpId")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",9)
			->where("receipt_voucher.bid",$BranchId)
			->where('PendPigmy_ReceivedDate',$dte)
			->where('PendPigmy_Bid',$BranchId)
			->where('pending_pigmy.deleted',0)
			->get();
			
			return $id;
		}
		
		public function Bank_Branch_extra($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('deposit')->select('date','BankName','amount','reason','pay_mode','Deposit_type')
			->leftJoin('addbank','addbank.Bankid','=','deposit.depo_bank_id')
			->where('addbank.Bid',$BranchId)
			->where('date',$dte)
			->get();
			return $id;
			
		}
		
		public function openstate()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$dte=date('Y-m-d');
			$id=DB::table('dailyopenclose')->where('Daily_Status','=',"OPEN")->where('Daily_Date','=',$dte)
			->where('Daily_Bid',$BranchId)->count('Dailyopenclose_Id');
			return $id;
		}
		public function openclosestate()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$dte=date('Y-m-d');
			$id=DB::table('dailyopenclose')->where('Daily_Status','=',"CLOSE")->where('Daily_Date','=',$dte)
			->where('Daily_Bid',$BranchId)->count('Dailyopenclose_Id');
			return $id;
		}
		
		public function show_dailyopeningbalance($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			//	$dte=date('Y-m-d');
			//print_r($dte);
			$id1=DB::table('dailyopenclose')->select('Daily_TotBal')->where('Daily_Status','=',"OPEN")->where('Daily_Date','=',$dte)
			->where('Daily_Bid',$BranchId)->first();
			//print_r($id);
			$id =$id1->Daily_TotBal;
			return $id;
		}
		public function show_dailyrunningbalance($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=0;
			
			$countofclose=DB::table('dailyopenclose')->select('Daily_TotBal')->where('Daily_Status','=',"CLOSE")->where('Daily_Date','=',$dte)
			->where('Daily_Bid',$BranchId)
			->count('Dailyopenclose_Id');
			
			if($countofclose>0)
			{
				$id1=DB::table('dailyopenclose')->select('Daily_TotBal')->where('Daily_Status','=',"CLOSE")->where('Daily_Date','=',$dte)
				->where('Daily_Bid',$BranchId)->first();
				//print_r($id);
				$id = $id1->Daily_TotBal;
			}
			else
			{
				
				$idd = DB::table('cash')->select('InHandCash')->where('BID','=',$BranchId)->first();
				$id=$idd->InHandCash;
			}
			return $id;
			
			
		}
		public function show_dailyexpencebalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('expense')->where('e_date',$dte)->where('Bid',$BranchId)->sum('amount');
			
			return $id;
		}
		
		public function show_dailyexpencetran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('expense')->selectRaw('lname,amount,e_date,receipt_voucher_no as  Expence_PamentVoucher, pay_mode,Particulars,receipt_voucher_no as adj_no')
			->join('legder','legder.lid','=','SubHead_lid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","expense.id")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",5)
			->where("receipt_voucher.bid",$BranchId)
			->where('e_date',$dte)
			->where('expense.Bid',$BranchId)
			->where('expense.deleted',0)
			->get();
			
			return $id;
		}
		public function show_dailyincometran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id1 = DB::table('income')
				->select('lname','Income_amount','Income_date','receipt_voucher_no as Income_Expence_PamentVoucher', 'Income_pay_mode','Income_Particulars','receipt_voucher_no as adj_no')
				->join('legder','legder.lid','=','Income_SubHead_lid')
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","income.Income_id")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",7)
				->where("receipt_voucher.bid",$BranchId)
				->where('Income_date',$dte)
				->where('income.Bid',$BranchId)
				->where('income.deleted',0)
				->get();

			/******* ADJUSTMENT CREDIT *****/
				$id2 = DB::table('income')
					->select('lname','Income_amount','Income_date',DB::raw("'' as Income_Expence_PamentVoucher"), 'Income_pay_mode','Income_Particulars',DB::raw("'' as adj_no"))
					->join('legder','legder.lid','=','Income_SubHead_lid')
					->where('Income_date',$dte)
					->where('income.Bid',$BranchId)
					->where('income.Income_pay_mode',"!=","INHAND")
					->where('income.deleted',0)
					->get();
			/******* ADJUSTMENT CREDIT *****/
			$id = array_merge($id1,$id2);
			return $id;
			
		}
		public function show_dailyincomebalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id=DB::table('income')->where('Income_date',$dte)->where('Bid',$BranchId)->sum('Income_amount');
			
			return $id;
		}
		//-----------------------DL LOAN ALLOCATION SATRT-------------------
		public function show_dlallocationtran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount','receipt_voucher_no as voucher_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_allocation.DepLoanAllocId")
			->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",17)
			->where("receipt_voucher.receipt_voucher_type",2)
			->where('DepLoan_PaymentMode','=',"CASH")
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_Branch',$BranchId)
			->get();
			
			
		}
		public function show_dlallocationbalance($dte)
		{
			//	$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_PaymentMode','=',"CASH")
			->where('DepLoan_Branch',$BranchId)
			->sum('DepLoan_LoanAmount');
			
			
		}
		public function show_dlallocationtran_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount','receipt_voucher_no as adj_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_allocation.DepLoanAllocId")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",17)
			->where("receipt_voucher.receipt_voucher_type",3)
			->where('DepLoan_PaymentMode','<>',"CASH")
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_Branch',$BranchId)
			->get();
			
			
		}
		public function show_dlallocationbalance_adjust($dte)
		{
			//	$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_PaymentMode','<>',"CASH")
			->where('DepLoan_Branch',$BranchId)
			->sum('DepLoan_LoanAmount');
			
			
		}
		public function show_dlallocationtran_charg($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanCharge','DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount','receipt_voucher_no as receipt_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_allocation.DepLoanAllocId")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",17)
			->where("receipt_voucher.receipt_voucher_type",1)
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_PaymentMode','=',"CASH")
			->where('DepLoan_Branch',$BranchId)
			->get();
			
			
		}
		public function show_dlallocationbalance_charg($dte)
		{
			//	$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_PaymentMode','=',"CASH")
			->where('DepLoan_Branch',$BranchId)
			->sum('DepLoan_LoanCharge');
			
			
		}
		public function show_dlallocationtran_charg_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanCharge','DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount','receipt_voucher_no as adj_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_allocation.DepLoanAllocId")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",17)
			->where("receipt_voucher.receipt_voucher_type",3)
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_PaymentMode','<>',"CASH")
			->where('DepLoan_Branch',$BranchId)
			->get();
			
			
		}
		public function show_dlallocationbalance_charg_adjust($dte)
		{
			//	$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('depositeloan_allocation')
			->where('DepLoan_LoanStartDate',$dte)
			->where('DepLoan_PaymentMode','<>',"CASH")
			->where('DepLoan_Branch',$BranchId)
			->sum('DepLoan_LoanCharge');
			
			
		}
		//-----------------------DL LOAN ALLOCATION END---------------------
		//-----------------------personal loan allocation  start-----------	
		public function show_plallocationtran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			/* 
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','personalloan_allocation.Bid','receipt_voucher_no as voucher_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_allocation.PersLoanAllocID")
			->join("members","members.Memid","=","personalloan_allocation.MemId")
			->join("user","user.Uid","=","members.Uid")
			->where("receipt_voucher.transaction_category",18)
			->where('StartDate',$dte)
			->where('PayMode','=',"CASH")
			->where('personalloan_allocation.Bid',$BranchId)
			->get();
			 */

			return DB::table("personalloan_payment")
				->select(
							'personalloan_allocation.PersLoan_Number',
							'personalloan_payment.paid_amount',
							'personalloan_payment.pl_payment_date',
							'personalloan_allocation.Bid',
							'receipt_voucher_no as voucher_no',
							'user.Uid',
							DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
						)
				->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_payment.pl_allocation_id")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_payment.pl_payment_id")
				->join("members","members.Memid","=","personalloan_allocation.MemId")
				->join("user","user.Uid","=","members.Uid")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",18)
				->where('personalloan_payment.pl_payment_date',$dte)
				->where('personalloan_payment.payment_mode','=',"CASH")
				->where('personalloan_allocation.Bid',$BranchId)
				->get();
			
		}
		public function show_plallocationbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('personalloan_allocation')
			->where('StartDate',$dte)
			->where('PayMode','=',"CASH")
			->where('Bid',$BranchId)
			->sum('LoanAmt');
			
			
		}
		
		public function show_plallocationtran_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;

			/* 
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','Bid')
			->where('StartDate',$dte)
			->where('PayMode','<>',"CASH")
			->where('Bid',$BranchId)
			->get();
			 */

			return DB::table("personalloan_payment")
				->select(
							'personalloan_allocation.PersLoan_Number',
							'personalloan_payment.paid_amount',
							'personalloan_payment.pl_payment_date',
							'personalloan_allocation.Bid',
							'receipt_voucher_no as voucher_no',
							'user.Uid',
							DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
							'receipt_voucher_no as adj_no'
						)
				->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_payment.pl_allocation_id")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_payment.pl_payment_id")
				->join("members","members.Memid","=","personalloan_allocation.MemId")
				->join("user","user.Uid","=","members.Uid")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.receipt_voucher_type",3)
				->where("receipt_voucher.transaction_category",18)
				->where('personalloan_payment.pl_payment_date',$dte)
				->where('personalloan_payment.payment_mode','<>',"CASH")
				->where('personalloan_allocation.Bid',$BranchId)
				->get();
			 
			
		}
		public function show_plallocationbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('personalloan_allocation')
			->where('StartDate',$dte)
			->where('PayMode','<>',"CASH")
			->where('Bid',$BranchId)
			->sum('LoanAmt');
			
			
		}	
		
		public function show_plallocationtran_charg($dte)
		{

			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;

			/* 
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','Bid','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','Insurance')
			->where('StartDate',$dte)
			->where('PayMode','<>',"CASH")
			->where('Bid',$BranchId)
			->get();
 */
			
			return DB::table('personalloan_payment')
			->select(
						'personalloan_allocation.PersLoan_Number',
						'personalloan_payment.pl_payment_date',
						'personalloan_allocation.Bid',
						'personalloan_payment.otherCharges',
						'personalloan_payment.Book_FormCharges',
						'personalloan_payment.AjustmentCharges',
						'personalloan_payment.ShareCharges',
						'personalloan_payment.Insurance',
						'receipt_voucher_no as receipt_no',
						'receipt_voucher_no as adj_no'
					)
			->leftjoin("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_payment.pl_allocation_id")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_payment.pl_payment_id")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.receipt_voucher_type",3)
			->where("receipt_voucher.transaction_category",18)
			->where('personalloan_payment.pl_payment_date',$dte)
			->where('personalloan_payment.payment_mode','<>',"CASH")
			->where('personalloan_allocation.Bid',$BranchId)
			->get();
		}
		
		public function show_plallocationtran_chargcash($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
/* 
			return DB::table('personalloan_allocation')
				->select('PersLoan_Number','LoanAmt','StartDate','personalloan_allocation.Bid','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','Insurance','receipt_voucher_no as receipt_no')
				->leftjoin("personalloan_payment","personalloan_payment.pl_allocation_id","=","personalloan_allocation.PersLoanAllocID")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_payment.pl_payment_id")
				->where("receipt_voucher.transaction_category",18)
				->where('StartDate',$dte)
				->where('PayMode','=',"CASH")
				->where('personalloan_allocation.Bid',$BranchId)
				->get();
 */
			return DB::table('personalloan_payment')
			->select(
						'personalloan_allocation.PersLoan_Number',
						'personalloan_payment.pl_payment_date',
						'personalloan_allocation.Bid',
						'personalloan_payment.otherCharges',
						'personalloan_payment.Book_FormCharges',
						'personalloan_payment.AjustmentCharges',
						'personalloan_payment.ShareCharges',
						'personalloan_payment.Insurance',
						'receipt_voucher_no as receipt_no'
					)
			->leftjoin("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_payment.pl_allocation_id")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_payment.pl_payment_id")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",18)
			->where('personalloan_payment.pl_payment_date',$dte)
			->where('personalloan_payment.payment_mode','=',"CASH")
			->where('personalloan_allocation.Bid',$BranchId)
			->get();
		}
		
		//-----------------------personal loan allocation  END-----------	
		//-----------------------JEWEL loan allocation  END-----------	
		public function show_jlallocationtran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','JewelLoan_LoanAmount','JewelLoan_StartDate','JewelLoan_Bid','receipt_voucher_no as voucher_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
			->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",20)
			->where("receipt_voucher.receipt_voucher_type",2)
			->where('JewelLoan_PaymentMode','=',"CASH")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_Bid',$BranchId)
			->where('jewelloan_allocation.deleted',0)
			->get();
			
			
		}
		public function show_jlallocationbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('jewelloan_allocation')
			->where('JewelLoan_PaymentMode','=',"CASH")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_Bid',$BranchId)
			->sum('JewelLoan_LoanAmount');
			
			
		}
		public function show_jlallocationtran_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','JewelLoan_LoanAmount','JewelLoan_StartDate','JewelLoan_Bid','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),'receipt_voucher_no as adj_no')
			->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",20)
			->where("receipt_voucher.receipt_voucher_type",3)
			->where('JewelLoan_PaymentMode','<>',"CASH")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_Bid',$BranchId)
			->where('jewelloan_allocation.deleted',0)
			->get();
			
			
		}
		public function show_jlallocationbalance_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('jewelloan_allocation')
			->where('JewelLoan_PaymentMode','<>',"CASH")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_Bid',$BranchId)
			->sum('JewelLoan_LoanAmount');
			
			
		}
		
		public function show_slallocationtran($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('staffloan_allocation')->select('StfLoan_Number','LoanAmt','StartDate','PayMode','receipt_voucher_no as voucher_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),'receipt_voucher_no as adj_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_allocation.StfLoanAllocID")
			->join("user","user.Uid","=","staffloan_allocation.Uid")
			->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
			->where("receipt_voucher.transaction_category",19)
			->where('StartDate',$dte)
			->where('staffloan_allocation.Bid',$BranchId)
			->where('staffloan_allocation.deleted',0)
			->get();
		}

		public function show_slallocationbalance($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('staffloan_allocation')
			->where('StartDate',$dte)
			->where('Bid',$BranchId)
			->sum('LoanAmt');
			
			
		}
		public function bank_tran_inhand($dte)
		{
			return DB::table('deposit')->select('date','depo_bank_id','reason','amount','Deposit_type','BankName')
			->leftJoin('addbank','addbank.Bankid','=','deposit.depo_bank_id')
			->where('deposit.date',$dte)
			->where('pay_mode',"INHAND")
			->orwhere('pay_mode',"CASH")
			->get();
		}
		public function bank_tran_adjust($dte)
		{
			return DB::table('deposit')->select('date','depo_bank_id','reason','amount','Deposit_type','BankName')
			->leftJoin('addbank','addbank.Bankid','=','deposit.depo_bank_id')
			->where('deposit.date',$dte)
			->where('pay_mode','<>',"INHAND")
			->orwhere('pay_mode','<>',"CASH")
			->get();
		}
		public function bank_amt_deposit($dte)
		{
			return DB::table('deposit')
			->where('date',$dte)
			->where('Deposit_type',"DEPOSIT")
			->where('pay_mode',"INHAND")
			->orwhere('pay_mode',"CASH")
			->sum('amount');
			
		}
		public function bank_amt_WITHDRAWL($dte)
		{
			return DB::table('deposit')
			->where('date',$dte)
			->where('Deposit_type',"WITHDRAWL")
			->where('pay_mode',"INHAND")
			->orwhere('pay_mode',"CASH")
			->sum('amount');
		}
		//public function 
		public function jlcharges($dte)
		{
			//$dte=date('Y-m-d');
			$temp=array();
			$temp1=array();
			$temp2=array();
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$jlaccno=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber')
			->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_PaymentMode','=',"CASH")
			//->where('JewelLoan_StartDate','=',"2017-02-07")
			->where('JewelLoan_Bid',$BranchId)
			->get();

			$temp_name = [];
			$temp_Uid = [];

			$temp_rec = array();
			$sum=0;
			foreach($jlaccno As $jl1)
			{
				$jl=$jl1->JewelLoan_LoanNumber;
				$jldetails1=DB::table('jewelloan_allocation')
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->select('JewelLoan_LoanNumber','JewelLoan_SaraparaCharge','JewelLoan_StartDate','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','receipt_voucher_no as receipt_no','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",20)
				->where("receipt_voucher.receipt_voucher_type",1)
				->where('JewelLoan_LoanNumber',$jl)
				->first();
				
				$JewelLoan_SaraparaCharge=$jldetails1->JewelLoan_SaraparaCharge;
				$JewelLoan_InsuranceCharge=$jldetails1->JewelLoan_InsuranceCharge;
				$JewelLoan_BookAndFormCharge=$jldetails1->JewelLoan_BookAndFormCharge;
				$JewelLoan_OtherCharge=$jldetails1->JewelLoan_OtherCharge;
				
				$tot=$JewelLoan_SaraparaCharge+$JewelLoan_InsuranceCharge+$JewelLoan_BookAndFormCharge+$JewelLoan_OtherCharge;
				$acc=$jldetails1->JewelLoan_LoanNumber;
				$temp[]=$acc;
				
				$temp1[$acc]=$tot;
				$temp_rec[$acc] = $jldetails1->receipt_no;
				$temp_name[$acc] = $jldetails1->name;
				$temp_Uid[$acc] = $jldetails1->Uid;
				$sum=$sum+$tot;
			}
			$temp2['num']=$temp;
			$temp2['val']=$temp1;
			$temp2['sum']=$sum;
			$temp2['receipt_no']=$temp_rec;
			$temp2['name']=$temp_name;
			$temp2['Uid']=$temp_Uid;
			return $temp2;
		}

		public function jewel_charges($date) 
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;

			$sa = array(
				"jewelloan_allocation.JewelLoanId",
				"JewelLoan_LoanNumber",
				"JewelLoan_PaymentMode",
				"JewelLoan_StartDate",
				DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
				"user.Uid",
				"JewelLoan_PaymentMode",
				"JewelLoan_SaraparaCharge",
				"JewelLoan_InsuranceCharge",
				"JewelLoan_BookAndFormCharge",
				"JewelLoan_OtherCharge",
				"receipt_voucher_no"
			);
			$ret_data1 = DB::table("jewelloan_allocation")
				->select($sa)
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",20)
				->where("receipt_voucher.receipt_voucher_type",1)
				->where("receipt_voucher.bid",$BID)
				->where('JewelLoan_Bid',$BID)
				->where('JewelLoan_StartDate',$date)
				->get();

			$i = -1;
			if(!empty($ret_data1)) {
				foreach($ret_data1 as $row) {
					$exclude_arr[++$i] = $row->JewelLoanId;
				}
			} else {
				$exclude_arr = array();
			}

			$sa = array(
				"jewelloan_allocation.JewelLoanId",
				"JewelLoan_LoanNumber",
				"JewelLoan_PaymentMode",
				"JewelLoan_StartDate",
				DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
				"user.Uid",
				"JewelLoan_PaymentMode",
				"JewelLoan_SaraparaCharge",
				"JewelLoan_InsuranceCharge",
				"JewelLoan_BookAndFormCharge",
				"JewelLoan_OtherCharge",
				DB::raw(" '' as 'receipt_voucher_no' ")
			);
			$ret_data2 = DB::table("jewelloan_allocation")
				->select($sa)
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
				// ->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				// ->where("receipt_voucher.transaction_category",20)
				// ->where("receipt_voucher.receipt_voucher_type",1)
				// ->where("receipt_voucher.bid",$BID)
				->where('JewelLoan_Bid',$BID)
				->where('JewelLoan_StartDate',$date)
				->whereNotIn("jewelloan_allocation.JewelLoanId",$exclude_arr)
				->get();

			$ret_data = array_merge($ret_data1,$ret_data2);

			return $ret_data;

		}
		
		public function jlcharges_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$temp=array();
			$temp1=array();
			$temp2=array();
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$jlaccno=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber')
			->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_PaymentMode','<>',"CASH")
			//->where('JewelLoan_StartDate','=',"2017-02-07")
			->where('JewelLoan_Bid',$BranchId)
			->get();

			$temp_name = [];
			$temp_Uid = [];
			$temp_adj = [];

			$sum=0;
			foreach($jlaccno As $jl1)
			{
				$jl=$jl1->JewelLoan_LoanNumber;
				$jldetails1=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','JewelLoan_SaraparaCharge','JewelLoan_StartDate','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),'receipt_voucher_no as adj_no')
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",20)
				->where("receipt_voucher.receipt_voucher_type",3)
				->where('JewelLoan_LoanNumber',$jl)
				->first();

				if(empty($jldetails1)) {
					continue;
				}
				
				$JewelLoan_SaraparaCharge=$jldetails1->JewelLoan_SaraparaCharge;
				$JewelLoan_InsuranceCharge=$jldetails1->JewelLoan_InsuranceCharge;
				$JewelLoan_BookAndFormCharge=$jldetails1->JewelLoan_BookAndFormCharge;
				$JewelLoan_OtherCharge=$jldetails1->JewelLoan_OtherCharge;
				
				$tot=$JewelLoan_SaraparaCharge+$JewelLoan_InsuranceCharge+$JewelLoan_BookAndFormCharge+$JewelLoan_OtherCharge;
				$acc=$jldetails1->JewelLoan_LoanNumber;
				$temp[]=$acc;
				
				$temp1[$acc]=$tot;
				$temp_adj[$acc] = $jldetails1->adj_no;
				$sum=$sum+$tot;
				$temp_name[$acc] = $jldetails1->name;
				$temp_Uid[$acc] = $jldetails1->Uid;
			}
			$temp2['num']=$temp;
			$temp2['val']=$temp1;
			$temp2['sum']=$sum;
			$temp2['adj_no']=$temp_adj;
			$temp2['name']=$temp_name;
			$temp2['Uid']=$temp_Uid;
			return $temp2;
		}
	
	
		public function fdinterstmonthly()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$UID=$uname->Uid;
			$dte=date('Y-m-d');
			$month=date('m');
			$yer=date('Y');
			
			$fdaccno=DB::table('fdallocation')
				->select('Fd_CertificateNum')
				->where('intrest_needed',"YES")
				->where('Fd_Withdraw',"NO")
				->where('Closed',"NO")
				->where('Bid',$Branchid)
				->where('fdallocation.FdReport_MatureDate',">=",date("Y-m-d"))
				->get();
			// print_r($fdaccno);
			foreach($fdaccno as $accno)
			{
				$saleem=0;
				$accno1=$accno->Fd_CertificateNum;
				
				$fdcou=DB::table('fd_monthly_interest')->where('fdnum',$accno1)->where('id','=',"1")->count('FD_ID');
				
				if($fdcou==0)
				{
					$fddetails=DB::table('fdallocation')->select('Accid','lastinterestpaid','fdmonth','interstmonth','Fd_DepositAmt','FdTid','Fd_CertificateNum','FdReport_StartDate')
					->where('Fd_CertificateNum',$accno1)
					->first();
					$fdmonth=$fddetails->fdmonth;
			/*******************/
					$temp = DB::table("fd_monthly_interest")
						->select("FD_Date")
						->where("deleted",0)
						->where("fdnum",$fddetails->Fd_CertificateNum)
						->orderBy("FD_Date","desc")
						->first();//print_r($temp);exit();
					
					if(!empty($temp) && $temp->FD_Date != "0000-00-00") {
						$last_interest_paid_date = $temp->FD_Date;
						$first_interest = false;
					} else {
						$last_interest_paid_date = $fddetails->FdReport_StartDate;
						$first_interest = true;
					}
			/*******************/
					$lastpaiddate=$last_interest_paid_date; //$fddetails->lastinterestpaid;
					$intertsamt=$fddetails->interstmonth;
					$accid=$fddetails->Accid;
					$fddeposit=$fddetails->Fd_DepositAmt;
					$FdTid=$fddetails->FdTid;
					
					$fdtype1=DB::table('fdtype')->select('FdInterest')->where('FdTid',$FdTid)->first();
					$FdInterest=$fdtype1->FdInterest;
					$amt1=$fddeposit*$FdInterest;
					//$amt1=$this->roundamt->Roundall($amt1);
					$at=$FdInterest+1200;
					$amt2=$amt1/$at;
					//$amt2=$this->roundamt->Roundall($amt2);
					//$amt3=$amt2/30;
					$amt3=$amt2*12;
					$amt4=$amt3/365;
					
					//$amt4=$this->roundamt->Roundall($amt4);
					$date1=date_create($dte);
					$date2=date_create($lastpaiddate);
					$difdate=date_diff($date1,$date2);
					$difdays=$difdate->format('%a');
					if($first_interest) {
						$difdays++;
					}
					if($fdmonth=="1 Month(30 days)")
					{
						$saleem=1;
					}
					if($fdmonth=="3 Month(90 days)"&&$difdays>85) //90 days
					{
						$saleem=1;
					}
					if($fdmonth=="6 Month(180 days)"&&$difdays>170) // 180 days
					{
						$saleem=1;
					}
					if($saleem==1)
					{
						$totamt=$difdays*$amt4;
						$totamt=$this->roundamt->Roundall($totamt);
						DB::table('fd_monthly_interest')->insert(['Accid'=>$accid,'amount'=>$totamt,'fdnum'=>$accno1,'id'=>"1",'Bid'=>$Branchid,'FD_Date'=>$dte,'days'=>$difdays]);
						
					}
					
				}
				/*	
					
					
					//print_r($difdays);
					
					
					
					if($saleem==1)
					{
					$totamt=$difdays*$amt3;
					
					
					return DB::table('fd_monthly_interest')->insert(['Accid'=>$accid,'amount'=>$totamt,'fdnum'=>$accno1,'id'=>"1",'Bid'=>$Branchid]);
					
					
					/*$sbtotamt1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
					$sbtotamt=$sbtotamt1->Total_Amount;
					$totamount=$sbtotamt+$totamt;
					DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$sbtotamt]);
					
					$sbid=DB::table('sb_transaction')->insertGetId(['Accid'=>$accid,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"FD Interest",'Amount' =>$totamt,'CurrentBalance'=>$sbtotamt,'Total_Bal'=>$totamount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$month,'Year'=>$yer,'Payment_Mode'=>"FD Interest",'Bid'=>$Branchid,'CreatedBy'=>$UID]); 
					
					DB::table('fdallocation')->where('Fd_CertificateNum',$accno1)
					->update(['lastinterestpaid'=>$dte]);
					DB::table('fd_interest')->insert(['FD_Interest_date'=>$dte,'FD_Interest_AccountNo'=>$accno1,'FD_Interest_SB_Accid'=>$accid,'FD_Interest_Amount'=>$totamt,'FD_Interest_Bid'=>$Branchid,'FD_Interest_Sb_Tranid'=>$sbid]);
				*/
				//	}
				
				/*if($fdmonth=="1 Month(30 days)")
					{
					$days=30;
					}
					else if($fdmonth=="3 Month(90 days)")
					{
					$days=90;
					}
					else if($fdmonth=="6 Month(180 days)")
					{
					$days=180;
					}
					$date1=date_create($dte);
					$date2=date_create($lastpaiddate);
					$difdate=date_diff($date1,$date2);
					$difdays=$difdate->format('%a');
					if($difdays>=$days)
					{
					$sbtotamt1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
					$sbtotamt=$sbtotamt1->Total_Amount;
					$totamount=$sbtotamt+$intertsamt;
					DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$sbtotamt]);
					
					$sbid=DB::table('sb_transaction')->insertGetId(['Accid'=>$accid,'AccTid'=>"2",'TransactionType'=>"CREDIT",'particulars'=>"FD Interest",'Amount' =>$intertsamt,'CurrentBalance'=>$sbtotamt,'Total_Bal'=>$totamount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$month,'Year'=>$yer,'Payment_Mode'=>"FD Interest",'Bid'=>$Branchid,'CreatedBy'=>$UID]); 
					
					DB::table('fdallocation')->where('Fd_CertificateNum',$accno1)
					->update(['lastinterestpaid'=>$dte]);
					DB::table('fd_interest')->insert(['FD_Interest_date'=>$dte,'FD_Interest_AccountNo'=>$accno1,'FD_Interest_SB_Accid'=>$accid,'FD_Interest_Amount'=>$intertsamt,'FD_Interest_Bid'=>$Branchid,'FD_Interest_Sb_Tranid'=>$sbid]);
					
				}*/
				//}
			}
			
			
		}
	
	
		public function create_fd_data()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$UID=$uname->Uid;
			$dte=date('Y-m-d');
			$month=date('m');
			$yer=date('Y');
			
			$Adata=DB::table('fd_monthly_interest')->select('FD_ID','Accid','amount','fdnum','id','Bid')->where('id','=',"1")->where('Bid',$Branchid)->get();

			$failed = array();
			$i = 0;
			
			foreach($Adata AS $ada)
			{
				
				$accid=$ada->Accid;
				$totamt=$ada->amount;
				$accno1=$ada->fdnum;

				$sb_particulars = "FD Interest ({$accno1})";
				
				$sbtotamt1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
				if(!empty($sbtotamt1)) {
					$sbtotamt=$sbtotamt1->Total_Amount;
					$totamount=$sbtotamt+$totamt;
					DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$totamount]);
					
					$sbid=DB::table('sb_transaction')->insertGetId(['Accid'=>$accid,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>$sb_particulars,'Amount' =>$totamt,'CurrentBalance'=>$sbtotamt,'Total_Bal'=>$totamount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$month,'Year'=>$yer,'Payment_Mode'=>"FD Interest",'Bid'=>$Branchid,'CreatedBy'=>$UID,'ignore_for_service_charge'=>1]); 
					
					DB::table('fdallocation')->where('Fd_CertificateNum',$accno1)
					->update(['lastinterestpaid'=>$dte]);
					/*DB::table('fd_interest')->insert(['FD_Interest_date'=>$dte,'FD_Interest_AccountNo'=>$accno1,'FD_Interest_SB_Accid'=>$accid,'FD_Interest_Amount'=>$totamt,'FD_Interest_Bid'=>$Branchid,'FD_Interest_Sb_Tranid'=>$sbid]);*/
				} else {
					$failed[$i++] = $ada->FD_ID;
				}
			}
			DB::table('fd_monthly_interest')->where('Bid',$Branchid)->whereNotIn("fd_monthly_interest.FD_ID",$failed)->update(['id'=>"0"]);
		}
		public function editFDdata($id)
		{
			$Fdedit=DB::table('fd_monthly_interest')->where('FD_ID',$id['Fd_id'])->update(['amount'=>$id['Fd_Amount']]);
			return $Fdedit;
		}
		public function editSBdata($id)
		{
			$Fdedit=DB::table('sb_int')->where('sb_int',$id['sdid'])->update(['int_'=>$id['amount']]);
			return $Fdedit;
		}
		public function create_SB_data()
		{
		
		$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$UID=$uname->Uid;
		$dte=date("Y-m-d");
		$m=date("m");
		$y=date("Y");
			$sb_data=DB::table('sb_int')->where('Bid','=',$Branchid)->get();
			foreach($sb_data AS $sb)
			{
				$acc=$sb->accno;
				$int_=$sb->int_;
				$sb_int=$sb->sb_int;
				$a=DB::table('createaccount')->select('Total_Amount','Accid')->where('AccNum','=',$acc)->first();
				
				$Total_Amount=$a->Total_Amount;
				$tot=$Total_Amount+$int_;
				$Accid=$a->Accid;
				DB::table('sb_transaction')->insert(['Accid'=>$Accid,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"SB INTEREST",'Amount'=>$int_,'CurrentBalance'=>$Total_Amount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$tot,'Bid'=>$Branchid,'Payment_Mode'=>"SB",'ignore_for_service_charge'=>1, 'SubLedgerId'=>106 ]);
				DB::table('createaccount')->where('AccNum','=',$acc)->update(['Total_Amount'=>$tot]);
				DB::table('sb_int')->where('sb_int','=',$sb_int)->delete();
				
			}
			
		}
		
		
		
		public function emp_sal($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$emp_sal=DB::table('salary')
				->select('salid','date','FirstName','MiddleName','LastName','netpay','gearning','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->join('user','user.Uid','=','salary.Uid')
				->where('date','=',$date)
				->where('salary.bid','=',$bid)
				->where('salary.deleted','=',0)
				->get();

			foreach($emp_sal as $key=>$row)
			{
				$staff_additions = DB::table("salary_extra_pay")
					->join("salary_extra","salary_extra.sal_extra_id","=","salary_extra_pay.sal_extra_id")
					->where("salary_extra.sal_extra_type",1)
					->where("sal_id",$row->salid)
					->sum("salpay_extra_amt");
				$emp_sal[$key]->gearning = $row->gearning - $staff_additions;
			}//print_r($emp_sal);exit();
				
			return $emp_sal;
		}
		
		public function agent_sal($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;

			$did_exclude_array = array(8); //DESIGNATION
			
			$emp_sal=DB::table('agent_commission_payment')
				->select('Agent_Commission_PaidDate','FirstName','MiddleName','LastName','Agent_Commission_PaidforAmt','Tds','securityDeposit','Agent_Commission_PaidAmount','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), "total_commission")
				->join('user','user.Uid','=','agent_commission_payment.Agent_Commission_Uid')
				->where('Agent_Commission_PaidDate','=',$date)
				->where('user.Bid','=',$bid)
				->where('agent_commission_payment.deleted','=',0)
				->whereNotIn("user.Did", $did_exclude_array)
				->get();
			return $emp_sal;
		}
		
		public function agent_sal_appraiser($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;

			$Did = 8;
			
			$emp_sal=DB::table('agent_commission_payment')
				->select('Agent_Commission_PaidDate','FirstName','MiddleName','LastName','Agent_Commission_PaidforAmt','Tds','securityDeposit','Agent_Commission_PaidAmount','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), "total_commission")
				->join('user','user.Uid','=','agent_commission_payment.Agent_Commission_Uid')
				->where('Agent_Commission_PaidDate','=',$date)
				->where('user.Bid','=',$bid)
				->where('user.Did','=',$Did)
				->where('agent_commission_payment.deleted','=',0)
				->get();
			return $emp_sal;
		}
		
		public function emp_sal_extra($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;

			$excluede_arr = array(3,5,6,7,8,14);
			
			$emp_sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin('salary','salary.salid','=','salary_extra_pay.sal_id')
				//->leftjoin('agent_commission_payment','agent_commission_payment.Agent_Commission_Id','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','salary.Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$bid)
				->whereNotIn('salary_extra_pay.sal_extra_id',$excluede_arr)
				->where('salary_extra_pay.deleted','=',0)
				->get();
			//print_r($emp_sal_extra);
			return $emp_sal_extra;
		}
		
		public function agent_sal_extra($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;

			$excluede_arr = array(11,9,10);
			
			$agent_sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname','paymentmode',DB::raw(" '' as 'receipt_no' "),'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin('agent_commission_payment','agent_commission_payment.Agent_Commission_Id','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','agent_commission_payment.Agent_Commission_Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				// ->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","agent_commission_payment.Agent_Commission_Id")
				// ->where("receipt_voucher.transaction_category",24)
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$bid)
				->whereNotIn('salary_extra_pay.sal_extra_id',$excluede_arr)
				->where('salary_extra_pay.deleted','=',0)
				->get();
			//print_r($agent_sal_extra);
			return $agent_sal_extra;
		}
		
		
		public function fd_monthly_int($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$fd_int=DB::table('fd_monthly_interest')
				->select('fdnum','amount','FD_Date','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->join("fdallocation","fdallocation.Fd_CertificateNum","=","fd_monthly_interest.fdnum")
				->join("user","user.Uid","=","fdallocation.Uid")
				->where('FD_Date','=',$date)
				->where('fd_monthly_interest.Bid','=',$bid)
				->where('fd_monthly_interest.id','=',0)
				->get();
				
		/* 	if(empty($fd_int)) {
			$fd_int = DB::table("sb_transaction")
				->select(DB::raw('`tran_Date` as `FD_Date`,`Amount` as `amount`, `fake_value` as `fdnum` '))
				->where("tran_Date","=",$date)
				->where("particulars","LIKE","%FD Interest%")
				->where('Bid','=',$bid)
				->get();
			} */
			return $fd_int;
		}
		
		
		
		
		public function loan_charge($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$loan_charge=DB::table('charges_tran')
				->select('loanid as ln_no','loanid as pay_mode','amount','charg_tran_date','loanid','lname','loantype','repay_id','loanid as receipt_no',DB::raw(" '' as 'name', '' as 'Uid'"))
				->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
				->join('legder','legder.lid','=','chareges.subhead')
				->where('charg_tran_date','=',$date)
				->where('bid','=',$bid)
				->where('charges_tran.deleted','=',0)
				->get();
				
			foreach($loan_charge as $key=>$row){
				//$loan_charge[$key]->pay_mode = "";
				$ln_type = strtoupper($row->loantype);
				switch($ln_type)
				{
					case "SL" : 
									$loan_charge[$key]->ln_no = DB::table('staffloan_allocation')
										->where('StfLoanAllocID','=',$row->loanid)
										->value('StfLoan_Number');
									
									if(!empty($row->repay_id)){
										$loan_charge[$key]->pay_mode = DB::table('staffloan_repay')
											->where('SLRepay_Id','=',$row->repay_id)
											->value('SLRepay_PayMode');
										if($loan_charge[$key]->pay_mode == "CASH") {
											$alloc_row = DB::table('staffloan_repay')
												 ->select("receipt_voucher_no","SLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
												->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_repay.SLRepay_Id")
												->join("staffloan_allocation","staffloan_allocation.StfLoanAllocID","=","staffloan_repay.SLRepay_SLAllocID")
												->join("user","user.Uid","=","staffloan_allocation.Uid")
												->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
												->where("receipt_voucher.transaction_category",24)
												->where('SLRepay_Id','=',$row->repay_id)
												->where('staffloan_repay.SLRepay_PayMode','=',"CASH")
												->first();
										} else {
											$alloc_row = DB::table('staffloan_repay')
												 ->select("SLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), DB::raw(" '' as 'receipt_voucher_no' ") )
												->join("staffloan_allocation","staffloan_allocation.StfLoanAllocID","=","staffloan_repay.SLRepay_SLAllocID")
												->join("user","user.Uid","=","staffloan_allocation.Uid")
												->where('SLRepay_Id','=',$row->repay_id)
												->where('staffloan_repay.SLRepay_PayMode','!=',"CASH")
												->first();
										}
											$loan_charge[$key]->pay_mode = $alloc_row->SLRepay_PayMode;
											$loan_charge[$key]->receipt_no = $alloc_row->receipt_voucher_no;
											$loan_charge[$key]->name = $alloc_row->name;
											$loan_charge[$key]->Uid = $alloc_row->Uid;
									} else {
//	IF REPAY ID DOES NOT EXISTS IN charges_tran TABLE...
										$alloc_row = DB::table('staffloan_repay')
											->select("SLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->join("staffloan_allocation","staffloan_allocation.StfLoanAllocID","=","staffloan_repay.SLRepay_SLAllocID")
											->join("user","user.Uid","=","staffloan_allocation.Uid")
											->where('SLRepay_Date','=',$date)
											->where('SLRepay_SLAllocID','=',$row->loanid)
											->first();
										
										if(!empty($alloc_row)) {
											$loan_charge[$key]->pay_mode = $alloc_row->SLRepay_PayMode;
											$loan_charge[$key]->receipt_no = "";
											$loan_charge[$key]->name = $alloc_row->name;
											$loan_charge[$key]->Uid = $alloc_row->Uid;
										}
									}
									
									
									break;
					case "JL" : 
									$ln_no = DB::table('jewelloan_allocation')
										->where('JewelLoanId','=',$row->loanid)
										->value('JewelLoan_LoanNumber');
									$loan_charge[$key]->ln_no = $ln_no;
									
									
									if(!empty($row->repay_id)){
										$alloc_row = DB::table('jewelloan_repay')
											->select("receipt_voucher_no","JLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_repay.JLRepay_Id")
											->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewelloan_repay.JLRepay_JLAllocID")
											->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
											->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
											->where("receipt_voucher.transaction_category",23)
											->where('JLRepay_Id','=',$row->repay_id)
											->where("jewelloan_repay.deleted",0)
											->first();
											
											$loan_charge[$key]->pay_mode = $alloc_row->JLRepay_PayMode;
											$loan_charge[$key]->receipt_no = $alloc_row->receipt_voucher_no;
											$loan_charge[$key]->name = $alloc_row->name;
											$loan_charge[$key]->Uid = $alloc_row->Uid;
									} else {
										$alloc_row = DB::table('jewelloan_repay')
											->select("JLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewelloan_repay.JLRepay_JLAllocID")
											->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
											->where('JLRepay_Date','=',$date)
											->where('JLRepay_JLAllocID','=',$row->loanid)
											->where("jewelloan_repay.deleted",0)
											->first();

											if(!empty($alloc_row)) {
												$loan_charge[$key]->pay_mode = $alloc_row->JLRepay_PayMode;
												$loan_charge[$key]->receipt_no = "";
												$loan_charge[$key]->name = $alloc_row->name;
												$loan_charge[$key]->Uid = $alloc_row->Uid;
											}
									}
									
									break;
					case "PL" : 
									$ln_no = DB::table('personalloan_allocation')
										->where('PersLoanAllocID','=',$row->loanid)
										->value('PersLoan_Number');
									$loan_charge[$key]->ln_no = $ln_no;
									
									
									if(!empty($row->repay_id)){
										$alloc_row = DB::table('personalloan_repay')
											->select("receipt_voucher_no","PLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_repay.PLRepay_Id")
											->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_repay.PLRepay_PLAllocID")
											->join("members","members.Memid","=","personalloan_allocation.MemId")
											->join("user","user.Uid","=","members.Uid")
											->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
											->where("receipt_voucher.transaction_category",22)
											->where('PLRepay_Id','=',$row->repay_id)
											->first();
											
											if(!empty($alloc_row)) {
												$loan_charge[$key]->pay_mode = $alloc_row->PLRepay_PayMode;
												$loan_charge[$key]->receipt_no = $alloc_row->receipt_voucher_no;
												$loan_charge[$key]->name = $alloc_row->name;
												$loan_charge[$key]->Uid = $alloc_row->Uid;
											}
									} else {
										$alloc_row = DB::table('personalloan_repay')
											->select("PLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_repay.PLRepay_PLAllocID")
											->join("members","members.Memid","=","personalloan_allocation.MemId")
											->join("user","user.Uid","=","members.Uid")
											->where('personalloan_repay.PLRepay_Date','=',$date)
											->where('personalloan_repay.PLRepay_PLAllocID','=',$row->loanid)
											->first();

											if(!empty($alloc_row)) {
												$loan_charge[$key]->pay_mode = $alloc_row->PLRepay_PayMode;
												$loan_charge[$key]->receipt_no = "";
												$loan_charge[$key]->name = $alloc_row->name;
												$loan_charge[$key]->Uid = $alloc_row->Uid;
											}
									}
									
									break;
					case "DL" : 
									$ln_no = DB::table('depositeloan_allocation')
										->where('DepLoanAllocId','=',$row->loanid)
										->value('DepLoan_LoanNum');
									$loan_charge[$key]->ln_no = $ln_no;
									
									
									if(!empty($row->repay_id)){
										$alloc_row = DB::table('depositeloan_repay')
											->select("receipt_voucher_no","DLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_repay.DLRepay_ID")
											->join("depositeloan_allocation","depositeloan_allocation.DepLoanAllocId","=","depositeloan_repay.DLRepay_ID")
											->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
											->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
											->where("receipt_voucher.transaction_category",21)
											->where('DLRepay_ID','=',$row->repay_id)
											->first();
											
											$loan_charge[$key]->pay_mode = $alloc_row->DLRepay_PayMode;
											$loan_charge[$key]->receipt_no = $alloc_row->receipt_voucher_no;
											$loan_charge[$key]->name = $alloc_row->name;
											$loan_charge[$key]->Uid = $alloc_row->Uid;
									} else {
										$alloc_row = DB::table('depositeloan_repay')
											->select("DLRepay_PayMode",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
											->join("depositeloan_allocation","depositeloan_allocation.DepLoanAllocId","=","depositeloan_repay.DLRepay_ID")
											->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
											->where('DLRepay_Date','=',$date)
											->where('DLRepay_DepAllocID','=',$row->loanid)
											->where("depositeloan_repay.deleted",0)
											->first();

											if(!empty($alloc_row)) {
												$loan_charge[$key]->pay_mode = $alloc_row->DLRepay_PayMode;
												$loan_charge[$key]->receipt_no = "";
												$loan_charge[$key]->name = $alloc_row->name;
												$loan_charge[$key]->Uid = $alloc_row->Uid;
											}
									}
									
									break;
				
				}
			
			
			}
				
			return $loan_charge;
		}
		
		
		public function b2b_adj_tran($date)
		{
			$date = date("Y-m-d");
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			$b2b_adj_tran = array();
			
			
				
			$b2ho = DB::table("branch_to_branch")
				->select("Branch_Amount as b2b_amt","Branch_Amount","SubLedgerId")//DB::raw("SUM())
				->where("Branch_payment_Mode","=","ADJUSTMENT")
                ->where('Branch_Tran_Date',"=",$date)
				->where("Branch_Branch1_Id","=",$bid)
				->get();
			$ho2b = DB::table("branch_to_branch")
				->select("Branch_Amount as b2b_amt","Branch_Amount","SubLedgerId")//DB::raw("SUM())
				->where("Branch_payment_Mode","=","ADJUSTMENT")
                ->where('Branch_Tran_Date',"=",$date)
				->where("Branch_Branch2_Id","=",$bid)
				->get();
				
			$sub_head = DB::table("legder")
				->select()
				->where("subhead","<>",0)
				->get();
				
			foreach($sub_head as $row) {
				$b2b["lname"][$row->lid] = $row->lname;
				$b2b["amt"][$row->lid] = 0;
			}
				
			foreach($b2ho as $row) {
				$b2b["amt"][$row->SubLedgerId] += $row->Branch_Amount;
			}
				
			foreach($ho2b as $row) {
				$b2b["amt"][$row->SubLedgerId] += $row->Branch_Amount;
			}
			
			foreach($b2b["amt"] as $key=>$value) {
				if(empty($value)) {
					unset($b2b["amt"][$key]);
					unset($b2b["lname"][$key]);
				}
			}
			return $b2b;
		}
		
		public function opposite_entry_for_expense_cheque($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$expense_cheque = DB::table("expense")
				->select()
				->join('legder','legder.lid','=','SubHead_lid')
				->where("e_date","=",$date)
				->where("Bid","=",$bid)
				->where("pay_mode","=","CHEQUE")
				->get();
			return $expense_cheque;
		}
		
		public function opposite_entry_for_income_cheque($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$income_cheque = DB::table("income")
				->select()
				->join('legder','legder.lid','=','Income_SubHead_lid')
				->where("Income_date","=",$date)
				->where("Bid","=",$bid)
				->where("Income_pay_mode","=","CHEQUE")
				->get();
			return $income_cheque;
		}
		
		public function is_day_open($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$dailyopenclose_rows = DB::table("dailyopenclose")
				->select()
				->where("Daily_Date","=",$date)
				->where("Daily_Bid","=",$bid)
				->count();
			
			if($dailyopenclose_rows > 0)
				return "yes";
			else
				return "no";
		}

		public function jewel_auction_account($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			if($bid == 6) {
				$sa = array(
					"jewel_auction.pay_mode",
					"jewel_auction.jewel_auction_amount",
					"jewel_auction.auction_date",
					"jewelloan_allocation.JewelLoan_LoanNumber",
					"buyer_name as name"
				);
				$jewel_auction_account = DB::table("jewel_auction")
					->select($sa)
					->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewel_auction.JewelLoanId")
					->where("jewelloan_allocation.auction_status",2) // auction done
					->where("jewel_auction.auction_date",$date)
					->where("jewel_auction.deleted",0)
					->get();
			} else {
				$jewel_auction_account = [];
			}
			return $jewel_auction_account;
		}
		
		public function jewel_auction_suspense_creation($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$jewel_auction_suspense_creation = DB::table("jewel_auction")
				->select(
							"pay_mode",
							"jewel_auction.extra_amount",
							"jewel_auction.jl_auction_suspense_create_date",
							"jewelloan_allocation.JewelLoan_LoanNumber",
							'user.Uid',
							DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name")
						)
				->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewel_auction.JewelLoanId")
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->where("jewelloan_allocation.JewelLoan_Bid","=",$bid)
				->where("jewel_auction.jl_auction_suspense_create_date","=",$date)
				->where("jewel_auction.deleted","=",0)
				->get();
			
			return $jewel_auction_suspense_creation;
		}
		
		public function jewel_auction_suspense($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$jewel_auction_suspense = DB::table("auction_amount_transaction")
				->select(
							"pay_mode",
							"amt_piad",
							"tran_date",
							"JewelLoan_LoanNumber",
							"receipt_voucher_no as voucher_no",'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
							'receipt_voucher_no as adj_no'
						)
				->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","auction_amount_transaction.jl_alloc_id")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","auction_amount_transaction.auc_tran_id")
				->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",26)
				->where("auction_amount_transaction.bid","=",$bid)
				->where("tran_date","=",$date)
				->where("auction_amount_transaction.deleted","=","0")
				->get();
			
			return $jewel_auction_suspense;
		}
		
		public function view_cash_details()
		{
			return DB::table("cash")
				->select(
							"cashId",
							"InHandCash",
							"Branch",
							"BID"
						)
				->get();
		}
		
		public function view_bank_details()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			return DB::table("addbank")
				->select(
							"Bankid",
							"BankName",
							"Branch",
							"Bid",
							"AddBank_IFSC",
							"SocietyBranch",
							"AccountNo",
							"TotalAmt"
						)
				->where("addbank.Bid", $BID)
				->get();
		}
		
		public function edit_cash_details($data)
		{
			$log_data = array(
									"table_name"	=>	"cash",
									"pk_name"		=>	"cashId",
									"pk_value"		=>	$data["cash_id"],
									"field_name"	=>	"InHandCash",
									"updated_to"	=>	$data["amount"]
								);
			$this->log_ctr->insert_log($log_data);
			
			return DB::table("cash")
				->where("cashId","=",$data["cash_id"])
				->update(["InHandCash"=>$data["amount"]]);
		}
		
		public function check_day_open($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$table = "dailyopenclose";
			$branch_id_field = "Daily_Bid";
			$date_field = "Daily_Date";
			$amount_type_field = "Daily_Description";
			$open_status = "Daily_Status";
			
			$day_open_entry = DB::table($table)
				->where($branch_id_field,$BID)
				->where($date_field,$data["date"])
				->where($amount_type_field,"INHANDCASH")
				->where($open_status,"OPEN")
				->count();
			$day_close_entry = DB::table($table)
				->where($branch_id_field,$BID)
				->where($date_field,$data["date"])
				->where($amount_type_field,"INHANDCASH")
				->where($open_status,"CLOSE")
				->count();
			
			if($day_open_entry == 0) {
				return DAY_IS_NOT_OPEN;
			} else if($day_close_entry == 0) {
				return DAY_IS_OPEN;
			} else {
				return DAY_IS_CLOSED;
			}
		}
		
		public function mdpayamt($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data = [];
			$ret_data = DB::table("md_transaction")
				->select(
							"maturity_deposit.md_acc_no",
							"md_transaction.md_tran_date",
							"md_transaction.md_amount",
							"md_transaction.payment_mode",
							"receipt_voucher_no as voucher_no",
							DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"),
							'receipt_voucher_no as adj_no',
							"user.Uid"
						)
				->join("maturity_deposit","maturity_deposit.md_id","=","md_transaction.md_id")
				->join("user","user.Uid","=","maturity_deposit.uid")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","md_transaction.md_tran_id")
				->where("receipt_voucher.deleted", ReceiptVoucherModel::NOT_DELETED)
				->where("receipt_voucher.transaction_category",10)
				->where("md_transaction.deleted",0)
				->where("md_transaction.bid",$BID)
				->where("md_tran_date",$date)
				->get();
			return $ret_data;
		}
		
		public function update_cash_details($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$close_count = DB::table("dailyopenclose")
				->where("Daily_Date",date("Y-m-d"))
				->where("Daily_Bid",$BID)
				// ->where("Daily_Bankid",0)
				->where("Daily_Status","CLOSE")
				->count();

			if($close_count > 0) {//if day is closed
				return;
			}
			
			return DB::table("cash")
				->where("BID","=",$BID)
				->update(["InHandCash"=>$data["amount"]]);
		}
		
		public function appraiser_commission_report_data($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data["appraiser_commission_details"] = [];
			
			$select_array = array(
									"JewelLoanId as allocation_id",
									"JewelLoan_LoanNumber as loan_no",
									"JewelLoan_SaraparaCharge as appraiser_charge",
									"JewelLoan_StartDate as start_date",
									"JewelLoan_LoanAmount as loan_amount"
								);
			
			$loan_allocation_list = DB::table("jewelloan_allocation")
				->select($select_array)
				->where("BID","=",$BID)
				->get();
			
			if(empty($loan_allocation_list)) {
				return $ret_data;
			}
				
			$i = -1;
			foreach($loan_allocation_list as $row) {
				$ret_data["appraiser_commission_details"][++$i]["allocation_id"] = $row->allocation_id;
				$ret_data["appraiser_commission_details"][$i]["loan_no"] = $row->loan_no;
				$ret_data["appraiser_commission_details"][$i]["appraiser_charge"] = $row->appraiser_charge;
				$ret_data["appraiser_commission_details"][$i]["start_date"] = $row->start_date;
				$ret_data["appraiser_commission_details"][$i]["loan_amount"] = $row->loan_amount;
			}
			
			print_r($ret_data);exit();
			return $ret_data;
		}

		public function get_did()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $Branchid=$uname->Bid; $UID=$uname->Uid;
			return DB::table("user")
				->where("Uid",$UID)
				->value("Did");
		}

		public function cd_tran($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			unset($select_array_cd_tran);
			$select_array_cd_tran = array(
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->pk}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_type_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_id_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->date_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->transaction_type_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->payment_mode_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->amount_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->particulars_field}",
				"{$this->cdsd->tbl}.{$this->cdsd->cdsd_acc_no_field}",
				"interest_tran",
				DB::raw(" CONCAT(FirstName, ' ',MiddleName, ' ', LastName )  as 'name' "),
				"user.Uid"
			);
			$ret_data = DB::table($this->cdsd_tran->tbl)
				->select($select_array_cd_tran)
				->join("{$this->cdsd->tbl}","{$this->cdsd->tbl}.{$this->cdsd->pk}","=","{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_id_field}")
				->join("user","user.Uid","=","{$this->cdsd->tbl}.{$this->cdsd->uid_field}")
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->date_field}", $date)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->deleted_field}", 0)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->bid_field}", $BID)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_type_field}", 1)
				->get();

			return $ret_data;
		}

		public function sd_tran($date)
		{
		 	$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			unset($select_array_sd_tran);
			$select_array_sd_tran = array(
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->pk}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_id_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->date_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->transaction_type_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->payment_mode_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->amount_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->particulars_field}",
				"{$this->cdsd->tbl}.{$this->cdsd->cdsd_acc_no_field}",
				"{$this->cdsd_tran->tbl}.{$this->cdsd_tran->interest_tran_field}",
				DB::raw(" CONCAT(FirstName, ' ',MiddleName, ' ', LastName )  as 'name' "),
				"user.Uid",
				"cdsd_account.user_type"
			);
			$ret_data = DB::table($this->cdsd_tran->tbl)
				->select($select_array_sd_tran)
				->join("{$this->cdsd->tbl}","{$this->cdsd->tbl}.{$this->cdsd->pk}","=","{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_id_field}")
				->join("user","user.Uid","=","{$this->cdsd->tbl}.{$this->cdsd->uid_field}")
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->date_field}", $date)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->deleted_field}", 0)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->bid_field}", $BID)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->cdsd_type_field}", 2)
				->where("{$this->cdsd_tran->tbl}.{$this->cdsd_tran->amount_field}",">",0)
				->get();

			return $ret_data;
			return [];
		}

		public function tds($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$agent_sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname','paymentmode',DB::raw(" '' as 'receipt_no' "),'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin('agent_commission_payment','agent_commission_payment.Agent_Commission_Id','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','agent_commission_payment.Agent_Commission_Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$BID)
				->where('salary_extra_pay.sal_extra_id',9)
				->where('salary_extra_pay.deleted','=',0)
				->get();
			// print_r($agent_sal_extra);exit;
			return $agent_sal_extra;
		}

		public function pf($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname',DB::raw(" 'ADJUSTMENT' as 'paymentmode' "),'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin('salary','salary.salid','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','salary.Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$BID)
				->whereIn('salary_extra_pay.sal_extra_id',[5,7])
				->where('salary_extra_pay.deleted','=',0)
				->get();
			//print_r($emp_sal_extra);
			return $sal_extra;
		}

		public function esi($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname',DB::raw(" 'ADJUSTMENT' as 'paymentmode' "),'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin('salary','salary.salid','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','salary.Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$BID)
				->whereIn('salary_extra_pay.sal_extra_id',[6,8])
				->where('salary_extra_pay.deleted','=',0)
				->get();
			//print_r($emp_sal_extra);
			return $sal_extra;
		}

		public function professional_tax($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname',DB::raw(" 'ADJUSTMENT' as 'paymentmode' "),'user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
				->leftjoin('salary','salary.salid','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','salary.Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$BID)
				->whereIn('salary_extra_pay.sal_extra_id',[14])
				->where('salary_extra_pay.deleted','=',0)
				->get();
			//print_r($emp_sal_extra);
			return $sal_extra;
		}


		public function select_branch()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$data["BID"] = $BID;
			$data["BNAME"] = DB::table("branch")->where("Bid",$BID)->value("BName");
			return $data;
		}

		public function sal_extra_from_ho($date)
		{
			$exclude_arr = array(3);
			/**************** FOR EMP SAL *****************/
			$sa= array(
				"salpay_extra_id",
				"salary_extra_pay.date",
				"salpay_extra_particulars",
				"salpay_extra_amt",
				DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
				DB::raw(" 'CREDIT' as 'transaction_type' "),
				"user.Uid",
				"salpay_extra_particulars"
			);
			$ret_data1 = DB::table("salary_extra_pay")
				->select($sa)
				->join("salary","salary.salid","=","salary_extra_pay.sal_id")
				->join("user","user.Uid","=","salary.Uid")
				->where("salary_extra_pay.bid",6)
				->where("employee_type",1)
				->where("salary_extra_pay.date",$date)
				->where("salary_extra_pay.salpay_extra_amt",">",0)
				->whereNotIn("salary_extra_pay.sal_extra_id",$exclude_arr)
				->where("salary_extra_pay.deleted",0)
				->get();

				
			/**************** FOR AGENT SAL *****************/
			$sa= array(
				"salpay_extra_id",
				"salary_extra_pay.date",
				"salpay_extra_particulars",
				"salpay_extra_amt",
				DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
				DB::raw(" 'CREDIT' as 'transaction_type' "),
				"user.Uid",
				"salpay_extra_particulars"
			);
			$ret_data2 = DB::table("salary_extra_pay")
				->select($sa)
				->join("agent_commission_payment","agent_commission_payment.Agent_Commission_Id","=","salary_extra_pay.sal_id")
				->join("user","user.Uid","=","agent_commission_payment.Agent_Commission_Uid")
				->where("salary_extra_pay.bid",6)
				->where("employee_type",2)
				->where("salary_extra_pay.date",$date)
				->where("salary_extra_pay.salpay_extra_amt",">",0)
				->whereNotIn("salary_extra_pay.sal_extra_id",$exclude_arr)
				->where("salary_extra_pay.deleted",0)
				->get();
				
			$ret_data = array_merge($ret_data1,$ret_data2);
			return $ret_data;
		}

		public function staff_addition_ta($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$sal_etra_id_arr = array(3);
			$ret_data = DB::table('salary_extra_pay')
			->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname','user.Uid',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"), DB::raw(" 'ADJUSTMENT' as 'pay_mode' ") )
			->leftjoin('salary','salary.salid','=','salary_extra_pay.sal_id')
			//->leftjoin('agent_commission_payment','agent_commission_payment.Agent_Commission_Id','=','salary_extra_pay.sal_id')
			->join('user','user.Uid','=','salary.Uid')
			->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
			->join('legder','legder.lid','=','salary_extra.sub_head')
			->where('salary_extra_pay.date','=',$date)
			->where('salary_extra_pay.bid','=',$BID)
			->whereIn('salary_extra_pay.sal_extra_id',$sal_etra_id_arr)
			->where('salary_extra_pay.deleted','=',0)
			->get();

			return $ret_data;
		}

		public function pg_prewithdrawal_charges($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$sa = array(
				"pigmi_prewithdrawal.PgmPrewithdraw_ID",
				"pigmi_prewithdrawal.Withdraw_Date",
				"pigmi_prewithdrawal.PigmiAcc_No",
				"pigmi_prewithdrawal.Deduct_Commission",
				"pigmi_prewithdrawal.Deduct_Amount",
				// "pigmi_payamount.PayAmount_PaymentMode",
				DB::raw(" '' as PayAmount_PaymentMode"),
				DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"),
				"user.Uid"
			);
			$ret_data = DB::table("pigmi_prewithdrawal")
				->select($sa)
				->join("pigmiallocation","pigmiallocation.PigmiAcc_No","=","pigmi_prewithdrawal.PigmiAcc_No")
				// ->join("pigmi_payamount","pigmi_payamount.PayAmount_PigmiAccNum","=","pigmi_prewithdrawal.PigmiAcc_No")
				->join("user","user.Uid","=","pigmiallocation.UID")
				->where("pigmi_prewithdrawal.Withdraw_Date",$date)
				->where("pigmi_prewithdrawal.CashPaid_State","PAID")
				->where("pigmiallocation.Bid",$BID)
				->get();

			foreach($ret_data as $key => $row) {
				$temp_pay_mode = DB::table("pigmi_payamount")
					->where("pigmi_payamount.PayAmount_PigmiAccNum",$row->PigmiAcc_No)
					->value("PayAmount_PaymentMode");

				$ret_data[$key]->PayAmount_PaymentMode = $temp_pay_mode;
			}

			return $ret_data;
		}

		public function daily_rep_rv_adj_no(&$data_list,$data) // $data_list IS PASSED THROUGH REFERENCE - SO IT POINTS TO AND MODIFIES ORIGINAL DATA
		{
			foreach($data_list as $key => $row) {
				$rv_adj = DB::table("receipt_voucher")
					->where("receipt_voucher.transaction_id",$row->{$data["transaction_id"]})
					->where("receipt_voucher.transaction_category",$data["transaction_category"])
					->where("receipt_voucher.bid",$data["bid"])
					->where("receipt_voucher.deleted",0);
				if(!empty($data["receipt_voucher_type"])) { // COMPARE IF SPECIFIED
					$rv_adj = $rv_adj->where("receipt_voucher.receipt_voucher_type",$data["receipt_voucher_type"]);
				}
				$rv_adj = $rv_adj->value("receipt_voucher_no");
				foreach($data["rv_fields"] as $rv_field) { // FIELD NAMES TO BE ASSIGNED WITH RV / ADJ  NO
					$data_list[$key]->{$rv_field} = $rv_adj;
				}
			}
		}

		public function daily_rep_all_charges($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$ret_data = array();
			$sa = array(
				"all_charges_id",
				"SubLedgerId"
			);
			$subhead_list = DB::table("all_charges")
				->select($sa)
				->where("deleted",0)
				->where("bid",$BID)
				->where("date",$date)
				->groupBy("SubLedgerId")
				->get();
			
			foreach($subhead_list as $key_sub => $row_sub) {
				$sa = array(
					"all_charges.all_charges_id",
					"all_charges.date",
					"all_charges.payment_mode",
					"all_charges.amount",
					"all_charges.particulars",
					"all_charges.tran_table",
					"all_charges.tran_id",
					"all_charges.SubLedgerId",
					DB::raw(" '' as 'name' "),
					DB::raw(" '' as 'acc_no' "),
					DB::raw(" '' as 'uid' ")
				);
				$subhead_tran_list = DB::table("all_charges")
					->select($sa)
					->where("SubLedgerId",$row_sub->SubLedgerId)
					->where("date",$date)
					->where("bid",$BID)
					->where("deleted",0)
					->get();
					$ret_data[$row_sub->SubLedgerId]["subhead_tran"] = $subhead_tran_list;
					$ret_data[$row_sub->SubLedgerId]["subhead_name"] = DB::table("legder")
						->where("lid",$row_sub->SubLedgerId)
						->value("lname");
			}

			/*************** FFETCH USER INFO ****************/
			foreach($ret_data as $key_ret => $row_ret) {
				foreach($row_ret["subhead_tran"]	 as $key_tran => $row_tran) {
					// print_r($ret_data[$key_ret]["subhead_tran"][$key_tran]);
					if(!empty($row_tran->tran_table) && !empty($row_tran->tran_id)) {
						// $base_table = DB::table("tablenames") ->where("Tid",$row_tran->tran_table) ->value("TName");
						$temp_name = "";
						$temp_acc_no = "";
						$temp_uid = "";
						switch($row_tran->tran_table) {
							case 6: // customer TABLE
									$user_info = DB::table("customer")
										->select("FirstName","MiddleName","LastName","Uid")
										->where("Custid",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = "{$user_info->FirstName} {$user_info->MiddleName} {$user_info->LastName}";
										$temp_acc_no = "";
										$temp_uid = $user_info->Uid;
									}
									break;
							case 24: // jewelloan_repay TABLE
									$user_info = DB::table("jewelloan_repay")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'JewelLoan_LoanNumber')
										->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","jewelloan_repay.JLRepay_JLAllocID")
										->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
										->where("jewelloan_repay.JLRepay_Id",$row_tran->tran_id)
										->where("jewelloan_repay.deleted",0)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->JewelLoan_LoanNumber;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 25: // personalloan_payment TABLE
									$user_info = DB::table("personalloan_repay")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'PersLoan_Number')
										->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_repay.PLRepay_PLAllocID")
										->join("members","members.Memid","=","personalloan_allocation.MemId")
										->join("user","user.Uid","=","members.Uid")
										->where("personalloan_repay.PLRepay_Id",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->PersLoan_Number;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 26: // staffloan_repay TABLE
									$user_info = DB::table("staffloan_repay")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'StfLoan_Number')
										->join("staffloan_allocation","staffloan_allocation.StfLoanAllocID","=","staffloan_repay.SLRepay_SLAllocID")
										->join("user","user.Uid","=","staffloan_allocation.Uid")
										->where("staffloan_repay.SLRepay_Id",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->StfLoan_Number;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 27: // depositeloan_repay TABLE
									$user_info = DB::table("depositeloan_repay")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'DepLoan_LoanNum')
										->join("depositeloan_allocation","depositeloan_allocation.DepLoanAllocId","=","depositeloan_repay.DLRepay_DepAllocID")
										->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
										->where("depositeloan_repay.DLRepay_ID",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->DepLoan_LoanNum;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 28: // pigmi_payamount TABLE
									$user_info = DB::table("pigmi_payamount")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'pigmiallocation.PigmiAcc_No')
										->join("pigmiallocation","pigmiallocation.PigmiAcc_No","=","pigmi_payamount.PayAmount_PigmiAccNum")
										->join("user","user.Uid","=","pigmiallocation.UID")
										->where("pigmi_payamount.PayId",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->PigmiAcc_No;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 29: // depositeloan_allocation TABLE
									$user_info = DB::table("depositeloan_allocation")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'depositeloan_allocation.DepLoan_LoanNum')
										->join("user","user.Uid","=","depositeloan_allocation.DepLoan_Uid")
										->where("depositeloan_allocation.DepLoanAllocId",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->DepLoan_LoanNum;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 30: // personalloan_payment TABLE
									$user_info = DB::table("personalloan_payment")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'personalloan_allocation.PersLoan_Number')
										->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_payment.pl_allocation_id")
										->join("members","members.Memid","=","personalloan_allocation.MemId")
										->join("user","user.Uid","=","members.Uid")
										->where("personalloan_payment.pl_payment_id",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->PersLoan_Number;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 31: // pigmi_prewithdrawal TABLE
									$user_info = DB::table("pigmi_prewithdrawal")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'pigmiallocation.PigmiAcc_No')
										->join("pigmiallocation","pigmiallocation.PigmiAcc_No","=","pigmi_prewithdrawal.PigmiAcc_No")
										->join("user","user.Uid","=","pigmiallocation.UID")
										->where("pigmi_prewithdrawal.PgmPrewithdraw_ID",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->PigmiAcc_No;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 32: // rd_prewithdrawal TABLE
									$user_info = DB::table("rd_prewithdrawal")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'createaccount.AccNum')
										->join("createaccount","createaccount.AccNum","=","rd_prewithdrawal.RdAcc_No")
										->join("user","user.Uid","=","createaccount.Uid")
										->where("rd_prewithdrawal.RdPrewithdraw_ID",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->AccNum;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 33: // rd_payamount TABLE
									$user_info = DB::table("rd_prewithdrawal")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'createaccount.AccNum')
										->join("createaccount","createaccount.AccNum","=","rd_payamount.RDPayAmt_AccNum")
										->join("user","user.Uid","=","createaccount.Uid")
										->where("rd_payamount.RDPayId",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->AccNum;
										$temp_uid = $user_info->Uid;
									}
									break;
							case 34: // salary TABLE
									$user_info = DB::table("salary")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' ") )
										->join("user","user.Uid","=","salary.Uid")
										->where("salary.salid",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = "";
										$temp_uid = $user_info->Uid;
									}
									break;
							case 35: // JL Allocation
									$user_info = DB::table("jewelloan_allocation")
										->select("user.Uid",DB::raw(" CONCAT(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'name' "), 'JewelLoan_LoanNumber' )
										->join("user","user.Uid","=","jewelloan_allocation.JewelLoan_Uid")
										->where("jewelloan_allocation.JewelLoanId",$row_tran->tran_id)
										->first();
									if(!empty($user_info)) {
										$temp_name = $user_info->name;
										$temp_acc_no = $user_info->JewelLoan_LoanNumber;
										$temp_uid = $user_info->Uid;
									}
									break;
							default:
									$temp_name = "";
									$temp_acc_no = "";
									$temp_uid = "";
									break;
						}
						//fetch user details
					}
					$ret_data[$key_ret]["subhead_tran"][$key_tran]->name = $temp_name;
					$ret_data[$key_ret]["subhead_tran"][$key_tran]->acc_no = $temp_acc_no;
					$ret_data[$key_ret]["subhead_tran"][$key_tran]->uid = $temp_uid;
				}
			}
			/*************** FFETCH USER INFO ****************/

			// print_r($ret_data);//exit();
			return $ret_data;
		}

		public function b2b_opp_adj_db($date)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$exclude_array = array(
				172,
				61,
				62,
				63,
				64,
				65,
				173,
				207,
				208,
				246,
				156,
				144,
				283
			);
			$subhead_list = DB::table("branch_to_branch")
				->select("SubLedgerId")
				->where("deleted",0)
				->where("Branch_Branch2_Id",$BID)
				->where("Branch_Tran_Date",$date)
				->whereNotIn("SubLedgerId",$exclude_array) // ALREADY DISPLAYED THESE ENTRIES UNDER SALARY
				->groupBy("SubLedgerId")
				->get();
			//print_r($subhead_list);exit();
			
			foreach($subhead_list as $key_sub => $row_sub) {
				$sa = array(
					"branch_to_branch.Branch_Id",
					"branch_to_branch.Branch_Tran_Date",
					"branch_to_branch.Branch_payment_Mode",
					"branch_to_branch.Branch_Amount",
					"branch_to_branch.Branch_per",
					"branch_to_branch.SubLedgerId",
					DB::raw(" '' as 'name' "),
					DB::raw(" '' as 'acc_no' "),
					DB::raw(" '' as 'uid' ")
				);
				$subhead_tran_list = DB::table("branch_to_branch")
					->select($sa)
					->where("SubLedgerId",$row_sub->SubLedgerId)
					->where("Branch_Tran_Date",$date)
					->where("Branch_Branch2_Id",$BID)
					->whereNotIn("Branch_payment_Mode",["CASH","INHAND"])
					->where("deleted",0)
					->get();
					$ret_data[$row_sub->SubLedgerId]["subhead_tran"] = $subhead_tran_list;
					$ret_data[$row_sub->SubLedgerId]["subhead_name"] = DB::table("legder")
						->where("lid",$row_sub->SubLedgerId)
						->value("lname");
			}

			if(empty($ret_data)) {
				$ret_data = [];
			}

			// print_r($ret_data);exit();
			return $ret_data;
		}
		
		
	}

	
	