<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\RoundModel;
	use App\Http\Controllers\LogController;
	class OpenCloseModel extends Model
	{
		//
		protected $table='cash';
		public $roundamt;
		public function __construct()
		{
			$this->roundamt=new RoundModel;
			$this->log_ctr= new LogController;
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
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','receipt_voucher_no as SB_resp_No','receipt_voucher_no as SB_paymentvoucher_No','Payment_Mode',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","sb_transaction.Tranid")
			->join("user","user.Uid","=","createaccount.Uid")
			->where("receipt_voucher.transaction_category",1)
			->where('SBReport_TranDate',$sbtoday)
			->where('sb_transaction.Bid','=',$BranchId)
			->where('Payment_Mode','=',"CASH")
			->where('tran_reversed','=',"NO")
			->where('Uncleared_Bal','=',"0")
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->get();
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
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','SB_resp_No','SB_paymentvoucher_No','Payment_Mode',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->join("user","user.Uid","=","createaccount.Uid")
			->where('SBReport_TranDate',$sbtoday)
			->where('sb_transaction.Bid','=',$BranchId)
			->where('Payment_Mode','<>',"CASH")
			->where('tran_reversed','=',"NO")
			->where('Uncleared_Bal','=','0')
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->get();
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
			$id = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum','receipt_voucher_no as RD_resp_No','RDPayment_Mode',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","rd_transaction.RD_TransID")
			->join("user","user.Uid","=","createaccount.Uid")
			->where("receipt_voucher.transaction_category",2)
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->where('RDPayment_Mode','=',"CASH")
			//->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->get();
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
			$id = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum','RD_resp_No','RDPayment_Mode',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->join("user","user.Uid","=","createaccount.Uid")
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->where('RDPayment_Mode','<>',"CASH")
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
                        
                        
                        $data = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
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
			
			
			
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
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
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','Transaction_Type','Particulars','Pigmy_resp_No',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
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
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','receipt_voucher_no as PayAmount_ReceiptNum','receipt_voucher_no as PayAmount_PaymentVoucher',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where("receipt_voucher.transaction_category",14)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','=',"CASH")
			
			
			->where('PayAmount_IntType','=',"INTEREST")
			->get();
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
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','PayAmount_ReceiptNum','PayAmount_PaymentVoucher',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"INTEREST")
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
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','receipt_voucher_no as PayAmount_ReceiptNum','receipt_voucher_no as PayAmount_PaymentVoucher','PgmTotal_Amt',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where("receipt_voucher.transaction_category",14)
			->where("receipt_voucher.receipt_voucher_type",2)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
			->get();
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
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','PayAmount_ReceiptNum','PayAmount_PaymentVoucher','PgmTotal_Amt',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
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
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','PayAmount_ReceiptNum','receipt_voucher_no as PayAmount_PaymentVoucher','PgmTotal_Amt','Deduct_Commission','Deduct_Amount',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","pigmi_payamount.PayId")
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where("receipt_voucher.transaction_category",14)
			->where("receipt_voucher.receipt_voucher_type",1)
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','=',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
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
			
			$id=DB::table('pigmi_payamount')->select('PayAmount_PigmiAccNum','PayAmount_PayableAmount','PayAmountReport_PayDate','PayAmount_ReceiptNum','PayAmount_PaymentVoucher','PgmTotal_Amt','Deduct_Commission','Deduct_Amount',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			
			->join('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','PayAmount_PigmiAccNum')
			->join("user","user.Uid","=","pigmiallocation.UID")
			->where('PayAmountReport_PayDate',$dte)
			->where('pigmiallocation.Bid',$BranchId)
			->where('PayAmount_PaymentMode','<>',"CASH")
			->where('PayAmount_IntType','=',"PREWITHDRAWAL")
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
			
			$id=DB::table('rd_payamount')->select('RDPayAmt_AccNum','RDPayAmt_PayableAmount','RDPayAmtReport_PayDate','receipt_voucher_no as RD_PayAmount_pamentvoucher', 'RDPayAmt_PaymentMode',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('createaccount','createaccount.AccNum','=','rd_payamount.RDPayAmt_AccNum')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","rd_payamount.RDPayId")
			->join("user","user.Uid","=","createaccount.Uid")
			->where("receipt_voucher.transaction_category",15)
			->where('createaccount.Bid',$BranchId)
			->where('RDPayAmtReport_PayDate',$dte)
			->get();
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
			
			$id=DB::table('fdallocation')->select('Fd_CertificateNum','Fd_DepositAmt','Created_Date','receipt_voucher_no as FD_resp_No',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join("receipt_voucher","receipt_voucher.transaction_id","=","fdallocation.Fdid")
			->join("user","user.Uid","=","fdallocation.Uid")
			->where("receipt_voucher.transaction_category",8)
			->where('Created_Date',$dte)
			->where('FDPayment_Mode','=',"CASH")
			
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
			
			$id=DB::table('fdallocation')->select('Fd_CertificateNum','Fd_DepositAmt','Created_Date','FD_resp_No')
			->where('Created_Date',$dte)
			->where('FDPayment_Mode','<>',"CASH")
			
			->where('Bid',$BranchId)
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
			
			$id=DB::table('fd_payamount')->select('FDPayAmt_AccNum','FDPayAmt_PayableAmount','FDPayAmtReport_PayDate','receipt_voucher_no as FD_PayAmount_pamentvoucher',DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name"))
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->join("receipt_voucher","receipt_voucher.transaction_id","=","fd_payamount.FDPayId")
			->join("user","user.Uid","=","fdallocation.Uid")
			->where("receipt_voucher.transaction_category",16)
			->where('fdallocation.Bid',$BranchId)
			->where('FDPayAmt_PaymentMode','=',"CASH")
			->where('FDPayAmtReport_PayDate',$dte)
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
			
			$id=DB::table('fd_payamount')->select('FDPayAmt_AccNum','FDPayAmt_PayableAmount','FDPayAmtReport_PayDate','FD_PayAmount_pamentvoucher')
			->join('fdallocation','fdallocation.Fd_CertificateNum','=','fd_payamount.FDPayAmt_AccNum')
			->where('fdallocation.Bid',$BranchId)
			->where('FDPayAmt_PaymentMode','<>',"CASH")
			->where('FDPayAmtReport_PayDate',$dte)
			->get();
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
			$id=DB::table('purchaseshare')->select('PURSH_Memshareid','PURSH_Totalamt','PURSH_Date', 'receipt_voucher_no as PURSH_Share_resp_no',DB::raw("concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as name"))
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
			$id=DB::table('members')->select('Memid','Member_Fee','CreatedDate', 'receipt_voucher_no as member_resp_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","members.Memid")
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
			$id=DB::table('customer')->select('FirstName','Customer_Fee','Created_on','receipt_voucher_no as Customer_ReceiptNum')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","customer.Custid")
			->where("receipt_voucher.transaction_category",28)
			->where('Created_on',$dte)
			->where('customer.Bid',$BranchId)
			->where('custtyp', 'CLASS D')
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
			
			$id=DB::table('depositeloan_repay')->select('DepLoan_LoanNum','DLRepay_Date','receipt_voucher_no as dL_ReceiptNum','DLRepay_PaidAmt')
			->join('depositeloan_allocation','depositeloan_allocation.DepLoanAllocId','=','DLRepay_DepAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_repay.DLRepay_ID")
			->where("receipt_voucher.transaction_category",21)
			->where('DLRepay_Date',$dte)
			->where('DLRepay_PayMode','=',"CASH")
			->where('DLRepay_Bid',$BranchId)
			->get();
			
			return $id;
		}public function show_dlrepaytot_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('depositeloan_repay')->where('DLRepay_Date',$dte)->where('DLRepay_Bid',$BranchId)->where('DLRepay_PayMode','<>',"CASH")->sum('DLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_dlrepay_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('depositeloan_repay')->select('DepLoan_LoanNum','DLRepay_Date','dL_ReceiptNum','DLRepay_PaidAmt')
			->join('depositeloan_allocation','depositeloan_allocation.DepLoanAllocId','=','DLRepay_DepAllocID')
			->where('DLRepay_Date',$dte)
			->where('DLRepay_PayMode','<>',"CASH")
			->where('DLRepay_Bid',$BranchId)
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
			
			$id=DB::table('personalloan_repay')->where('PLRepay_PayMode','=',"CASH")->where('PLRepay_Date',$dte)->where('PLRepay_Bid',$BranchId)->sum('PLRepay_PaidAmt');
			
			return $id;
		}
		public function show_plrepaytot_adjust($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('personalloan_repay')->where('PLRepay_PayMode','<>',"CASH")->where('PLRepay_Date',$dte)->where('PLRepay_Bid',$BranchId)->sum('PLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_plrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('personalloan_repay')->select('PersLoan_Number','PLRepay_Date','receipt_voucher_no as PL_ReceiptNum','PLRepay_PaidAmt',"PLRepay_Amtpaidtoprincpalamt","PLRepay_PaidInterest")
			->join('personalloan_allocation','personalloan_allocation.PersLoanAllocID','=','PLRepay_PLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_repay.PLRepay_Id")
			->where("receipt_voucher.transaction_category",22)
			->where('PLRepay_PayMode','=',"CASH")
			->where('PLRepay_Date',$dte)
			->where('PLRepay_Bid',$BranchId)
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
			
			$id=DB::table('personalloan_repay')->select('PersLoan_Number','PLRepay_Date','PL_ReceiptNum','PLRepay_PaidAmt',"PLRepay_Amtpaidtoprincpalamt","PLRepay_PaidInterest")
			->join('personalloan_allocation','personalloan_allocation.PersLoanAllocID','=','PLRepay_PLAllocID')
			->where('PLRepay_PayMode','<>',"CASH")
			->where('PLRepay_Date',$dte)
			->where('PLRepay_Bid',$BranchId)
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
			
			$id=DB::table('jewelloan_repay')->where('JLRepay_Date',$dte)->where('JLRepay_Bid',$BranchId)->sum('JLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_jlrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('jewelloan_repay')->select('JewelLoan_LoanNumber','JLRepay_Date','receipt_voucher_no as jL_ReceiptNum','JLRepay_PaidAmt','JLRepay_PayMode',"JLRepay_paidtoprincipalamt","JLRepay_interestpaid")
			->join('jewelloan_allocation','jewelloan_allocation.JewelLoanId','=','JLRepay_JLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_repay.JLRepay_Id")
			->where("receipt_voucher.transaction_category",23)
			->where('JLRepay_Date',$dte)
			->where('JLRepay_Bid',$BranchId)
			->get();
			
			return $id;
		}
		
		public function show_slrepaytot($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('staffloan_repay')->where('SLRepay_Date',$dte)->where('SLRepay_Bid',$BranchId)->sum('SLRepay_PaidAmt');
			
			return $id;
		}
		
		public function show_slrepay($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('staffloan_repay')->select('StfLoan_Number','SLRepay_Date','SLRepay_PaidAmt','SLRepay_PayMode','receipt_voucher_no as receipt_no')
			->join('staffloan_allocation','staffloan_allocation.StfLoanAllocID','=','SLRepay_SLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_repay.SLRepay_Id")
			->where("receipt_voucher.transaction_category",24)
			->where('SLRepay_Date',$dte)
			->where('SLRepay_Bid',$BranchId)
			->get();
			
			return $id;
		}
		
		public function show_slrepay_interest($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('staffloan_repay')->select('StfLoan_Number','SLRepay_Date','SLRepay_Interest','SLRepay_PayMode','receipt_voucher_no as receipt_no')
			->join('staffloan_allocation','staffloan_allocation.StfLoanAllocID','=','SLRepay_SLAllocID')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_repay.SLRepay_Id")
			->where("receipt_voucher.transaction_category",24)
			->where('SLRepay_Date',$dte)
			->where('SLRepay_Bid',$BranchId)
			->get();
			
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
			
			$id=DB::table('branch_to_branch')->select('BName','Branch_Tran_Date','Branch_Amount','Branch_per','Branch_payment_Mode','receipt_voucher_no as voucher_no')
			->join('branch','branch.Bid','=','Branch_Branch2_Id')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","branch_to_branch.Branch_Id")
			->where("receipt_voucher.transaction_category",4)
			->where('Branch_Tran_Date',$dte)
			->where('Branch_Branch1_Id',$BranchId)
			->get();
			
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
			
			$id=DB::table('branch_to_branch')->select('BName','Branch_Tran_Date','Branch_Amount','Branch_per','Branch_payment_Mode','receipt_voucher_no as receipt_no')
			->join('branch','branch.Bid','=','Branch_Branch1_Id')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","branch_to_branch.Branch_Id")
			->where("receipt_voucher.transaction_category",4)
			->where("receipt_voucher.bid",$BranchId)
			->where('Branch_Tran_Date',$dte)
			->where('Branch_Branch2_Id',$BranchId)
			->get();
			
			return $id;
		}
		public function Bank_Branch($dte)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id=DB::table('deposit')->select('deposit.date','BankName','amount','reason','pay_mode','Deposit_type','receipt_voucher_no as receipt_no','receipt_voucher_no as voucher_no')
			->leftJoin('addbank','addbank.Bankid','=','deposit.depo_bank_id')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","deposit.d_id")
			->where("receipt_voucher.transaction_category",6)
			->where('deposit.Bid',$BranchId)
			->where('deposit.date',$dte)
			->get();
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
			
			$id=DB::table('pending_pigmy')->select('FirstName','MiddleName','LastName','PendPigmy_ReceivedDate','PenPigmy_AmountReceived','receipt_voucher_no as receipt_no')
			->join('user','user.Uid','=','PendPigmy_AgentUid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","pending_pigmy.PpId")
			->where("receipt_voucher.transaction_category",9)
			->where('PendPigmy_ReceivedDate',$dte)
			->where('PendPigmy_Bid',$BranchId)
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
			$id=DB::table('expense')->selectRaw('lname,amount,e_date,receipt_voucher_no as  Expence_PamentVoucher, pay_mode,Particulars')
			->join('legder','legder.lid','=','SubHead_lid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","expense.id")
			->where("receipt_voucher.transaction_category",5)
			->where('e_date',$dte)
			->where('expense.Bid',$BranchId)
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
			$id=DB::table('income')->select('lname','Income_amount','Income_date','receipt_voucher_no as Income_Expence_PamentVoucher', 'Income_pay_mode','Income_Particulars')
			->join('legder','legder.lid','=','Income_SubHead_lid')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","income.Income_id")
			->where("receipt_voucher.transaction_category",7)
			->where('Income_date',$dte)
			->where('income.Bid',$BranchId)->get();
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
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount','receipt_voucher_no as voucher_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_allocation.DepLoanAllocId")
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
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount')
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
			return DB::table('depositeloan_allocation')->select('DepLoan_LoanCharge','DepLoan_LoanNum','DepLoan_AccNum','DepLoan_LoanStartDate','DepLoan_LoanAmount')
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
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','personalloan_allocation.Bid','receipt_voucher_no as voucher_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_allocation.PersLoanAllocID")
			->where("receipt_voucher.transaction_category",18)
			->where('StartDate',$dte)
			->where('PayMode','=',"CASH")
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
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','Bid')
			->where('StartDate',$dte)
			->where('PayMode','<>',"CASH")
			->where('Bid',$BranchId)
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
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','Bid','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','Insurance')
			->where('StartDate',$dte)
			->where('PayMode','<>',"CASH")
			->where('Bid',$BranchId)
			->get();
		}
		
		public function show_plallocationtran_chargcash($dte)
		{
			//$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('personalloan_allocation')->select('PersLoan_Number','LoanAmt','StartDate','personalloan_allocation.Bid','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','Insurance','receipt_voucher_no as receipt_no')
			->leftjoin("personalloan_payment","personalloan_payment.pl_allocation_id","=","personalloan_allocation.PersLoanAllocID")
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_payment.pl_payment_id")
			->where("receipt_voucher.transaction_category",18)
			->where('StartDate',$dte)
			->where('PayMode','=',"CASH")
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
			return DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','JewelLoan_LoanAmount','JewelLoan_StartDate','JewelLoan_Bid','receipt_voucher_no as voucher_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
			->where("receipt_voucher.transaction_category",20)
			->where("receipt_voucher.receipt_voucher_type",2)
			->where('JewelLoan_PaymentMode','=',"CASH")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_Bid',$BranchId)
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
			return DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','JewelLoan_LoanAmount','JewelLoan_StartDate','JewelLoan_Bid')
			->where('JewelLoan_PaymentMode','<>',"CASH")
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_Bid',$BranchId)
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
			return DB::table('staffloan_allocation')->select('StfLoan_Number','LoanAmt','StartDate','PayMode','receipt_voucher_no as voucher_no')
			->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_allocation.StfLoanAllocID")
			->where("receipt_voucher.transaction_category",19)
			->where('StartDate',$dte)
			->where('staffloan_allocation.Bid',$BranchId)
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
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_PaymentMode','=',"CASH")
			//->where('JewelLoan_StartDate','=',"2017-02-07")
			->where('JewelLoan_Bid',$BranchId)
			->get();

			$temp_rec = array();
			$sum=0;
			foreach($jlaccno As $jl1)
			{
				$jl=$jl1->JewelLoan_LoanNumber;
				$jldetails1=DB::table('jewelloan_allocation')
				->select('JewelLoan_LoanNumber','JewelLoan_SaraparaCharge','JewelLoan_StartDate','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','receipt_voucher_no as receipt_no')
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_allocation.JewelLoanId")
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
				$sum=$sum+$tot;
			}
			$temp2['num']=$temp;
			$temp2['val']=$temp1;
			$temp2['sum']=$sum;
			$temp2['receipt_no']=$temp_rec;
			return $temp2;
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
			->where('JewelLoan_StartDate',$dte)
			->where('JewelLoan_PaymentMode','<>',"CASH")
			//->where('JewelLoan_StartDate','=',"2017-02-07")
			->where('JewelLoan_Bid',$BranchId)
			->get();
			$sum=0;
			foreach($jlaccno As $jl1)
			{
				$jl=$jl1->JewelLoan_LoanNumber;
				$jldetails1=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','JewelLoan_SaraparaCharge','JewelLoan_StartDate','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge')
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
				$sum=$sum+$tot;
			}
			$temp2['num']=$temp;
			$temp2['val']=$temp1;
			$temp2['sum']=$sum;
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
			
			$fdaccno=DB::table('fdallocation')->select('Fd_CertificateNum')
			->where('intrest_needed',"YES")->where('Fd_Withdraw',"NO")->where('Closed',"NO")->where('Bid',$Branchid)->get();
			
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
			
			$Adata=DB::table('fd_monthly_interest')->select('Accid','amount','fdnum','id','Bid')->where('id','=',"1")->where('Bid',$Branchid)->get();
			
			foreach($Adata AS $ada)
			{
				
				$accid=$ada->Accid;
				$totamt=$ada->amount;
				$accno1=$ada->fdnum;
				
				$sbtotamt1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
				$sbtotamt=$sbtotamt1->Total_Amount;
				$totamount=$sbtotamt+$totamt;
				DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$totamount]);
				
				$sbid=DB::table('sb_transaction')->insertGetId(['Accid'=>$accid,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"FD Interest",'Amount' =>$totamt,'CurrentBalance'=>$sbtotamt,'Total_Bal'=>$totamount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$month,'Year'=>$yer,'Payment_Mode'=>"FD Interest",'Bid'=>$Branchid,'CreatedBy'=>$UID,'ignore_for_service_charge'=>1]); 
				
				DB::table('fdallocation')->where('Fd_CertificateNum',$accno1)
				->update(['lastinterestpaid'=>$dte]);
				/*DB::table('fd_interest')->insert(['FD_Interest_date'=>$dte,'FD_Interest_AccountNo'=>$accno1,'FD_Interest_SB_Accid'=>$accid,'FD_Interest_Amount'=>$totamt,'FD_Interest_Bid'=>$Branchid,'FD_Interest_Sb_Tranid'=>$sbid]);*/
			}
			DB::table('fd_monthly_interest')->where('Bid',$Branchid)->update(['id'=>"0"]);
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
				DB::table('sb_transaction')->insert(['Accid'=>$Accid,'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"SB INTEREST",'Amount'=>$int_,'CurrentBalance'=>$Total_Amount,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$tot,'Bid'=>$Branchid,'Payment_Mode'=>"SB",'ignore_for_service_charge'=>1]);
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
				->select('date','FirstName','MiddleName','LastName','netpay','gearning')
				->join('user','user.Uid','=','salary.Uid')
				->where('date','=',$date)
				->where('user.Bid','=',$bid)
				->get();
				
			return $emp_sal;
		}
		
		public function agent_sal($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$emp_sal=DB::table('agent_commission_payment')
				->select('Agent_Commission_PaidDate','FirstName','MiddleName','LastName','Agent_Commission_PaidforAmt','Tds','securityDeposit','Agent_Commission_PaidAmount')
				->join('user','user.Uid','=','agent_commission_payment.Agent_Commission_Uid')
				->where('Agent_Commission_PaidDate','=',$date)
				->where('user.Bid','=',$bid)
				->get();
			return $emp_sal;
		}
		
		public function emp_sal_extra($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$emp_sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname')
				->leftjoin('salary','salary.salid','=','salary_extra_pay.sal_id')
				//->leftjoin('agent_commission_payment','agent_commission_payment.Agent_Commission_Id','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','salary.Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$bid)
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
			
			$agent_sal_extra=DB::table('salary_extra_pay')
				->select('salpay_extra_amt', 'salary_extra.sal_extra_type', 'salpay_extra_particulars', 'salary_extra_pay.date', 'FirstName', 'MiddleName', 'LastName','sal_extra_name', 'lname','paymentmode','receipt_voucher_no as receipt_no')
				->leftjoin('agent_commission_payment','agent_commission_payment.Agent_Commission_Id','=','salary_extra_pay.sal_id')
				->join('user','user.Uid','=','agent_commission_payment.Agent_Commission_Uid')
				->join('salary_extra','salary_extra.sal_extra_id','=','salary_extra_pay.sal_extra_id')
				->join('legder','legder.lid','=','salary_extra.sub_head')
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","agent_commission_payment.Agent_Commission_Id")
				->where("receipt_voucher.transaction_category",24)
				->where('salary_extra_pay.date','=',$date)
				->where('salary_extra_pay.bid','=',$bid)
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
				->select('fdnum','amount','FD_Date')
				->where('FD_Date','=',$date)
				->where('Bid','=',$bid)
				->get();
				
			if(empty($fd_int)) {
			$fd_int = DB::table("sb_transaction")
				->select(DB::raw('`tran_Date` as `FD_Date`,`Amount` as `amount`, `fake_value` as `fdnum` '))
				->where("tran_Date","=",$date)
				->where("particulars","=","FD Interest")
				->where('Bid','=',$bid)
				->get();
			}
			return $fd_int;
		}
		
		
		
		
		public function loan_charge($date)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			$loan_charge=DB::table('charges_tran')
				->select('loanid as ln_no','loanid as pay_mode','amount','charg_tran_date','loanid','lname','loantype','repay_id','loanid as receipt_no')
				->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
				->join('legder','legder.lid','=','chareges.subhead')
				->where('charg_tran_date','=',$date)
				->where('bid','=',$bid)
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
										$loan_charge[$key]->receipt_no = DB::table('staffloan_repay')
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","staffloan_repay.SLRepay_Id")
											->where("receipt_voucher.transaction_category",24)
											->where('SLRepay_Id','=',$row->repay_id)
											->value('receipt_voucher_no');
									} else {
//	IF REPAY ID DOES NOT EXISTS IN charges_tran TABLE...
										$loan_charge[$key]->pay_mode = DB::table('staffloan_repay')
											->where('SLRepay_Date','=',$date)
											->where('SLRepay_SLAllocID','=',$row->loanid)
											->value('SLRepay_PayMode');
										$loan_charge[$key]->receipt_no = "";
									}
									
									
									break;
					case "JL" : 
									$ln_no = DB::table('jewelloan_allocation')
										->where('JewelLoanId','=',$row->loanid)
										->value('JewelLoan_LoanNumber');
									$loan_charge[$key]->ln_no = $ln_no;
									
									
									if(!empty($row->repay_id)){
										$loan_charge[$key]->pay_mode = DB::table('jewelloan_repay')
											->where('JLRepay_Id','=',$row->repay_id)
											->value('JLRepay_PayMode');
										$loan_charge[$key]->receipt_no = DB::table('jewelloan_repay')
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","jewelloan_repay.JLRepay_Id")
											->where("receipt_voucher.transaction_category",23)
											->where('JLRepay_Id','=',$row->repay_id)
											->value('receipt_voucher_no');
									} else {
										$loan_charge[$key]->pay_mode = DB::table('jewelloan_repay')
											->where('JLRepay_Date','=',$date)
											->where('JLRepay_JLAllocID','=',$row->loanid)
											->value('JLRepay_PayMode');
										$loan_charge[$key]->receipt_no = "";
									}
									
									break;
					case "PL" : 
									$ln_no = DB::table('personalloan_allocation')
										->where('PersLoanAllocID','=',$row->loanid)
										->value('PersLoan_Number');
									$loan_charge[$key]->ln_no = $ln_no;
									
									
									if(!empty($row->repay_id)){
										$loan_charge[$key]->pay_mode = DB::table('personalloan_repay')
											->where('PLRepay_Id','=',$row->repay_id)
											->value('PLRepay_PayMode');
										$loan_charge[$key]->receipt_no = DB::table('personalloan_repay')
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","personalloan_repay.PLRepay_Id")
											->where("receipt_voucher.transaction_category",22)
											->where('PLRepay_Id','=',$row->repay_id)
											->value('receipt_voucher_no');
									} else {
										$loan_charge[$key]->pay_mode = DB::table('personalloan_repay')
											->where('PLRepay_Date','=',$date)
											->where('PLRepay_PLAllocID','=',$row->loanid)
											->value('PLRepay_PayMode');
										$loan_charge[$key]->receipt_no = "";
									}
									
									break;
					case "DL" : 
									$ln_no = DB::table('depositeloan_allocation')
										->where('DepLoanAllocId','=',$row->loanid)
										->value('DepLoan_LoanNum');
									$loan_charge[$key]->ln_no = $ln_no;
									
									
									if(!empty($row->repay_id)){
										$loan_charge[$key]->pay_mode = DB::table('depositeloan_repay')
											->where('DLRepay_ID','=',$row->repay_id)
											->value('DLRepay_PayMode');
										$loan_charge[$key]->receipt_no = DB::table('depositeloan_repay')
											->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","depositeloan_repay.DLRepay_ID")
											->where("receipt_voucher.transaction_category",21)
											->where('DLRepay_ID','=',$row->repay_id)
											->value('receipt_voucher_no');
									} else {
										$loan_charge[$key]->pay_mode = DB::table('depositeloan_repay')
											->where('DLRepay_Date','=',$date)
											->where('DLRepay_DepAllocID','=',$row->loanid)
											->value('DLRepay_PayMode');
										$loan_charge[$key]->receipt_no = "";
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
			
			$jewel_auction_account = DB::table("auction_amount_transaction")
				->select(
							"pay_mode",
							"amt_piad",
							"tran_date",
							"JewelLoan_LoanNumber",
							"receipt_voucher_no as voucher_no"
						)
				->join("jewelloan_allocation","jewelloan_allocation.JewelLoanId","=","auction_amount_transaction.jl_alloc_id")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","auction_amount_transaction.auc_tran_id")
				->where("receipt_voucher.transaction_category",20)
				->where("auction_amount_transaction.bid","=",$bid)
				->where("tran_date","=",$date)
				->where("auction_amount_transaction.deleted","=","0")
				->get();
			
			return $jewel_auction_account;
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
							DB::raw("concat(`FirstName`,' ',`MiddleName`,' ',`LastName`) as name")
						)
				->join("maturity_deposit","maturity_deposit.md_id","=","md_transaction.md_id")
				->join("user","user.Uid","=","maturity_deposit.uid")
				->leftjoin("receipt_voucher","receipt_voucher.transaction_id","=","md_transaction.md_tran_id")
				->where("receipt_voucher.transaction_category",2)
				->where("md_transaction.deleted",0)
				->where("md_transaction.bid",$BID)
				->where("md_tran_date",$date)
				->get();
			return $ret_data;
		}
		
		public function update_cash_details($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
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
		
		
	}

	
	