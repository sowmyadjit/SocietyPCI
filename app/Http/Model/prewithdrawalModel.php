<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use DateTime;
	use Auth;
	use App\Http\Model\RoundModel;
	use App\Http\Model\DepositModel;
	use App\Http\Model\SettingsModel;
	use App\Http\Model\AllChargesModel;

	class prewithdrawalModel extends Model
	{
		protected $table = 'pigmiallocation';
		
		public $roundamt;
		public function __construct()
		{
			$this->settings = new SettingsModel;
			$this->roundamt=new RoundModel;
			$this->dep_mdl = new DepositModel;
			$this->all_ch = new AllChargesModel;
		}
		
		public function Getpigmyacct()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$dte=date('Y-m-d');
			$ret_data = DB::table('pigmiallocation')
			->select(DB::raw('PigmiAllocID as id, CONCAT(`PigmiAllocID`,"-",`PigmiAcc_No`,"-",`old_pigmiaccno`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->join('user','user.Uid','=','pigmiallocation.Uid')
			->where('Status','=',"AUTHORISED")
			//->where('EndDate','>',$dte)
			->where('Closed','<>',"YES");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("pigmiallocation.Bid",$BID);
			}
			$ret_data = $ret_data->get();

			return $ret_data;
		}
		
		
		public function prepigmiwithdrawal($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			$b=$udetail->Bid;
			
			
			$calamt=0;
			$i=0;
			$intrst = 0;
			$accno=DB::table('pigmiallocation')->select('PigmiAcc_No')
			->where('PigmiAllocID','=',$id)
			->first();
			
			$dte=date('Y-m-d');
			
			$mnt=date('m');
			$year=date('Y');
			$acno=null;
			$acno = $accno->PigmiAcc_No;
			
			$pgdate=$this->getpigmiinterest($acno);
			$agnt=$pgdate->Agentid;
			$pgtypeid=$pgdate->PigmiTypeid;
			$pgaloc=$pgdate->PigmiAllocID;
			$sdate=$pgdate->StartDate;
			//$sdate=date("Y-m-d",strtotime($startdate));
			$edate=$pgdate->EndDate;
			//$edate=date("Y-m-d",strtotime($enddate));
			
			$start=date_create($sdate);
			$today=date_create($dte);
			//	print_r($start);
			//	print_r($today);
			$pgmdifmonth=date_diff($today,$start);
			//print_r($pgmdifmonth);
			$pgmdifmnthfirst=$pgmdifmonth->format('%m');
			print_r($pgmdifmnthfirst);
			//echo $pgmdifmnthfirst;
			
			
			$pgtotint=$this->getdetail($acno);
			
			$total=$pgtotint->Total_Amount;
			//$detailcount=$this->getdtlcount($acno,$sdate,$edate);
			//$getinterestdtl=$this->getinterestdetail($acno,$sdate,$edate);
			//$withdrawid=$getinterestdtl->PgmPrewithdraw_ID;
			
/************/
			$total_service_charge_amount = $this->dep_mdl->total_service_charge_amount(["allocation_id"=>$id['pigmyaccount']]);
			//var_dump($total_service_charge_amount);exit();
/************/

			if($pgmdifmnthfirst<6)
			{
				
				if($total>1000)
				{
					$commission=(4/100);
					//$commission=$this->Roundall($commission);
					$deduct=25;
					$totcommission=($total*$commission);
					$totcommission=$this->roundamt->Roundall($totcommission);
					$pretot=$totcommission+$deduct;
					$totalamtpay=($total-$pretot) - $total_service_charge_amount;
				}
				else
				{
					$commission=(4/100);
					//echo $commission;
					//$commission=$this->Roundall($commission);
					$deduct=10;
					$totcommission=($total*$commission);
					$totcommission=$this->roundamt->Roundall($totcommission);
					$pretot=$totcommission+$deduct;
					$totalamtpay=($total-$pretot) - $total_service_charge_amount;
				}
				
				$id = DB::table('pigmi_prewithdrawal')->insertGetId(['PigmiAcc_No'=>$acno,'PgmTotal_Amt'=>$total,'TotalAmt_Payable'=>$totalamtpay,'Withdraw_Date'=>$dte,'Particulars'=>"Withdrawal Between 1 to 6 Months",'Deduct_Commission'=>$totcommission,'Deduct_Amount'=>$deduct]);
				
				
				
				$reportdte=date('Y-m-d');
				$mnt=date('m');
				$year=date('Y');
				$time=date('h:i:s');
				
				$tran = DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$dte,'PigReport_TranDate'=>$reportdte,'Trans_Time'=>$time,'PigmiAllocID'=>$pgaloc,'Current_Balance'=>$total,'Transaction_Type'=>"CREDIT",'Amount'=>$pretot,'Particulars'=>"Withdrawal Between 1 to 6 Months",'PigmiTypeid'=>$pgtypeid,'Total_Amount'=>$totalamtpay,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"PREWITHDRAWAL AMOUNT",'CreatedBy'=>$UID,'Bid'=>$b]);
				
				DB::table('pigmiallocation')->where('PigmiAcc_No','=',$acno)
				->update(['Closed'=>"YES",'Total_Amount'=>$totalamtpay]);
				
			}
			else if($pgmdifmnthfirst<9)
			{
				if($total>1000)
				{
					$deduct=25;
					$totalamtpay=($total-$deduct) - $total_service_charge_amount;
				}
				else
				{
					$deduct=10;
					$totalamtpay=($total-$deduct) - $total_service_charge_amount;
				}
				//if($detailcount==0)
				//{
				
				$id = DB::table('pigmi_prewithdrawal')->insertGetId(['PigmiAcc_No'=>$acno,'PgmTotal_Amt'=>$total,'TotalAmt_Payable'=>$totalamtpay,'Withdraw_Date'=>$dte,'Particulars'=>"Withdrawal Between 7 to 12 Months",'Deduct_Amount'=>$deduct]);
				
				$reportdte=date('Y-m-d');
				$mnt=date('m');
				$year=date('Y');
				$time=date('h:i:s');
				
				$tran = DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$dte,'PigReport_TranDate'=>$reportdte,'Trans_Time'=>$time,'PigmiAllocID'=>$pgaloc,'Current_Balance'=>$total,'Transaction_Type'=>"CREDIT",'Amount'=>$deduct,'Particulars'=>"Pygmy Withdrawal Between 7 to 9 Months",'PigmiTypeid'=>$pgtypeid,'Total_Amount'=>$totalamtpay,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"PREWITHDRAWAL AMOUNT",'CreatedBy'=>$UID,'Bid'=>$b]);
				
				DB::table('pigmiallocation')->where('PigmiAcc_No','=',$acno)
				->update(['Closed'=>"YES",'Total_Amount'=>$totalamtpay]);
				
				
			}
			else
			
			{
				
					
					$totalamtpay=$total - $total_service_charge_amount;
				$deduct=0;
				
				$id = DB::table('pigmi_prewithdrawal')->insertGetId(['PigmiAcc_No'=>$acno,'PgmTotal_Amt'=>$total,'TotalAmt_Payable'=>$totalamtpay,'Withdraw_Date'=>$dte,'Particulars'=>"Withdrawal Between 9 to 12 Months",'Deduct_Amount'=>$deduct]);
				
				$reportdte=date('Y-m-d');
				$mnt=date('m');
				$year=date('Y');
				$time=date('h:i:s');
				
				$tran = DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$dte,'PigReport_TranDate'=>$reportdte,'Trans_Time'=>$time,'PigmiAllocID'=>$pgaloc,'Current_Balance'=>$total,'Transaction_Type'=>"CREDIT",'Amount'=>$deduct,'Particulars'=>"Pygmy Withdrawal Between 7 to 12 Months",'PigmiTypeid'=>$pgtypeid,'Total_Amount'=>$totalamtpay,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"PREWITHDRAWAL AMOUNT",'CreatedBy'=>$UID,'Bid'=>$b]);
				
				DB::table('pigmiallocation')->where('PigmiAcc_No','=',$acno)
				->update(['Closed'=>"YES",'Total_Amount'=>$totalamtpay]);
				
			}
			

			if(isset($totcommission)) {
				/******************** ALL CHARGES ******************/
				unset($fd);
				$fd["date"] = $reportdte;
				$fd["bid"] = $b;
				$fd["transaction_type"] = 2; // DEBIT
				$fd["payment_mode"] = "";
				$fd["amount"] = $totcommission;
				$fd["particulars"] = "PIGMY COMMISSION";
				$fd["paid"] = 0; //										--later will bbe replaced with 1
				$fd["tran_table"] = 31; // pigmi_prewithdrawal 			--later will be updated with   28-pigmi_payamount
				$fd["tran_id"] = $id; // 								--later will be updated with pigmy pay amt tran id
				$fd["created_by"] = $UID;
				$fd["SubLedgerId"] = 82; // PIGMY COMMISSION
				$fd["deleted"] = 0;
				$this->all_ch->clear_row_data();
				$this->all_ch->set_row_data($fd);
				$this->all_ch->insert_row();
				/******************** ALL CHARGES ******************/
			}
			if(isset($deduct)) {
				/******************** ALL CHARGES ******************/
				unset($fd);
				$fd["date"] = $reportdte;
				$fd["bid"] = $b;
				$fd["transaction_type"] = 2; // DEBIT
				$fd["payment_mode"] = "";
				$fd["amount"] = $deduct;
				$fd["particulars"] = "OTHER INCOME";
				$fd["paid"] = 0; //										--later will bbe replaced with 1
				$fd["tran_table"] = 31; // pigmi_prewithdrawal 			--later will be updated with   28-pigmi_payamount
				$fd["tran_id"] = $id; // 								--later will be updated with pigmy pay amt tran id
				$fd["created_by"] = $UID;
				$fd["SubLedgerId"] = 88; // OTHER INCOME
				$fd["deleted"] = 0;
				$this->all_ch->clear_row_data();
				$this->all_ch->set_row_data($fd);
				$this->all_ch->insert_row();
				/******************** ALL CHARGES ******************/
			}

		}
		
		function getpigmiinterest($acno)
		{
			$ptype=DB::table('pigmiallocation')
			->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('StartDate','EndDate','Agentid','pigmitype.PigmiTypeid','pigmiallocation.PigmiAllocID')
			->where('pigmiallocation.PigmiAcc_No','=',$acno)
			->first();
			return $ptype;
		}
		function getdetail($acno)
		{
			return DB::table('pigmiallocation')
			->where('pigmiallocation.PigmiAcc_No','=',$acno)
			->select('Total_Amount')
			->first();
		}
		
		/*function getdtlcount($acno,$sdate,$edate)
			{
			$detail=DB::table('pigmi_prewithdrawal')
			->where('PigmiAcc_No','=',$acno)
			->whereRaw("DATE(pigmi_prewithdrawal.Withdraw_Date) BETWEEN '".$sdate."' AND '".$edate."'")
			->count('PigmiAcc_No');
			return $detail;
			}
			
			function getinterestdetail($acno,$sdate,$edate)
			{
			
			$getvalue=DB::table('pigmi_prewithdrawal')
			->select('PgmPrewithdraw_ID')
			->where('PigmiAcc_No','=',$acno)
			->whereRaw("DATE(pigmi_prewithdrawal.Withdraw_Date) BETWEEN '".$sdate."' AND '".$edate."'")
			->first();
			return $getvalue;
			
		}*/
		
		/*public function prerdwithdrawal($id)
			{
			$duecount=null;
			$dte=date('Y-m-d');
			$monthcount=null;
			$trandate=null;
			$x=$id['rdaccount'];
			$acccno=DB::table('createaccount')->select('AccNum')->where('Accid','=',$x)->first();
			$acno=$acccno->AccNum;
			$rdintrst=$this->getrdinterest($acno);
			$startdate=$rdintrst->Created_on;
			$sdate=date("Y-d-m",strtotime($startdate));
			
			
			$date2=date_create($sdate);
			$day=$date2->format('d');
			
			
			$enddate1=date("Y-d-m",strtotime($dte));
			$enddate=date_create($dte);
			
			//$edate=date("Y-d-m");
			//print_r($enddate);
			$difmnth=date_diff($date2,$enddate);
			$monthdiff=$difmnth->format('%m');
			
			
			
			$getintr=$rdintrst->Intrest;//get interest  of  RD
			//echo $getintr;
			$getdur=$rdintrst->Duration;// get RD DUration
			//$gettotmonth=$getdur*12;//get total month
			$rdtotal=$rdintrst->Total_Amount;
			/*	if($day2>12)
			{
			$calcdur=$day2/12;
			$yearinterest=$calcdur*0.5;
			$calinterestrate=$getintr+$yearinterest;
			
			
			
			}
			else 
			{
			$calinterestrate=$getintr;
			}
			
			
			
			
			$interest=(2.5/12);
			
			
			$interestamt=($rdtotal*$interest)/100;
			
			
			$trandate=$this->gettrandate($acno,$sdate,$enddate1);//to get all the transaction date
			$trandatecount=$this->gettrandatecount($acno,$sdate,$enddate1);//to get all the transaction date count
			
			//	echo $trandatecount;
			
			$payableamt=$rdtotal-$interestamt;
			
			if($trandatecount==$monthdiff)
			{
			$monthcount=0;
			}
			else{
			
			$monthcount=$monthdiff-$trandatecount;
			}
			//echo $monthcount;
			
			//print_r($trandate);
			
			foreach($trandate as $trandatedue)
			{
			$tranday=$trandatedue->RDReport_TranDate;
			$trandate2=date_create($tranday);
			$day2=$trandate2->format('d');
			if($day2>$day)
			{
			$duecount=$duecount+1;
			}
			
			}
			$duecount1=$duecount+$monthcount;
			echo $duecount1;
			if($duecount1>0)
			{
			$getopbal=$this->getopngbal($acno);
			$opbal=$getopbal->opening_blance;
			$agent=$getopbal->Agent_ID;
			
			$x=($opbal*5);
			$y=$x/1000;
			$y1=$y*$duecount1;
			
			$xxx=($payableamt-$y1);
			DB::table('rd_prewithdrawal')->insertGetId(['RdAcc_No'=>$acno,'RdTotal_Amt'=>$rdtotal,'TotalAmt_Payable'=>$xxx]);
			}
			else
			{
			echo("else");
			DB::table('rd_prewithdrawal')->insertGetId(['RdAcc_No'=>$acno,'RdTotal_Amt'=>$rdtotal,'TotalAmt_Payable'=>$payableamt]);
			}
			
			
		}*/
		
		
		public function prerdwithdrawal($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$bid=$udetail->Bid;
			
			$duecount=null;
			$dte=date('Y-m-d');
			$monthcount=null;
			$trandate=null;
			$x=$id['rdaccount'];
			$acccno=DB::table('createaccount')->select('AccNum')->where('Accid','=',$x)->first();
			$acno=$acccno->AccNum;
			$rdintrst=$this->getrdinterest($acno);
			$acid=$rdintrst->Accid;
			$actid=$rdintrst->AccTid;
			$startdate=$rdintrst->Created_on;
			// $sdate=date("Y-d-m",strtotime($startdate));
			$sdate=date("Y-m-d",strtotime($startdate));
			
			
			$date2=date_create($sdate);
			$day=$date2->format('d');
			
			
			// $enddate1=date("Y-d-m",strtotime($dte));
			$enddate1=date("Y-m-d",strtotime($dte));
			$enddate=date_create($dte);
			
			
			$difmnth=date_diff($date2,$enddate);
			
			$monthdiff=$difmnth->format('m');
			
			
			$getintr=$rdintrst->Intrest;//get interest  of  RD
			
			$getdur=$rdintrst->Duration;// get RD DUration
			
			$rdtotal=$rdintrst->Total_Amount;
			
			
			
			$trandate=$this->gettrandate($acno,$sdate,$enddate1);//to get all the transaction date
			$trandatecount=$this->gettrandatecount($acno,$sdate,$enddate1);//to get all the transaction date count
			
			//	echo $trandatecount;
			
			
			if($trandatecount==$monthdiff)
			{
				$monthcount=0;
			}
			else{
				
				$monthcount=$monthdiff-$trandatecount;
			}
			
			
			foreach($trandate as $trandatedue)
			{
				$tranday=$trandatedue->RDReport_TranDate;
				$trandate2=date_create($tranday);
				$day2=$trandate2->format('d');
				if($day2>$day)
				{
					$duecount=$duecount+1;
				}
				
			}
			$duecount1=$duecount+$monthcount;
			//echo $duecount1;
			$interest=(2.5/12);
			
			
			$interestamt=($rdtotal*$interest)/100;
			$interestamt=$this->roundamt->Roundall($interestamt);
			
			
			$getopbal=$this->getopngbal($acno);
			$agent=$getopbal->Agent_ID;
			$opbal=$getopbal->opening_blance;
			
			if($duecount1>0)
			{
				$due=($opbal*5)/1000;
				
				$duecountamt=$due*$duecount1;
				$amt=$rdtotal-$duecountamt;
				$intamt=$interestamt-$duecountamt;
			}
			else
			{
				$amt=$rdtotal;
				$intamt=$interestamt;
			}
			if($monthdiff>12)
			{
				$payableamt=$amt+$interestamt;
				$rd_prewithdrawal_id = DB::table('rd_prewithdrawal')->insertGetId(['RdAcc_No'=>$acno,'RdTotal_Amt'=>$rdtotal,'TotalAmt_Payable'=>$payableamt,'Particulars'=>"prewithdrawal after 1 year",'Withdraw_Date'=>$dte,'Deduct_Amt'=>$intamt]);
				$rd_deduct_amt = $intamt;
				
				$mnt=date('m');
				$year=date('Y');
				$id = DB::table('rd_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $actid,'RD_Trans_Type' => "DEBIT",'RD_Particulars' => "RD PREWITHDRAWAL AFTER 1 YEAR CALCULATED",'RD_Amount' =>$intamt ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$payableamt,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
				
				DB::table('createaccount')->where('AccNum','=',$acno)
				->update(['Closed'=>"YES",'Total_Amount'=>$payableamt]);
			}
			else
			{
				if($rdtotal>1000)
				{
					if($agent!=0)
					{
						$payableamt=($amt-$interestamt)-25;
						$intamt1=$interestamt+25;
					}
					else
					{
						$payableamt=$amt-25;
						$intamt1=25;
					}
					$rd_prewithdrawal_id = DB::table('rd_prewithdrawal')->insertGetId(['RdAcc_No'=>$acno,'RdTotal_Amt'=>$rdtotal,'TotalAmt_Payable'=>$payableamt,'Particulars'=>"prewithdrawal before 1 year",'Withdraw_Date'=>$dte,'Deduct_Amt'=>$intamt1]);
					$rd_deduct_amt = $intamt1;
					
					$mnt=date('m');
					$year=date('Y');
					$id = DB::table('rd_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $actid,'RD_Trans_Type' => "DEBIT",'RD_Particulars' => "RD PREWITHDRAWAL BEFORE 1 YEAR CALCULATED",'RD_Amount' =>$intamt1 ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$payableamt,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
					
					DB::table('createaccount')->where('AccNum','=',$acno)
					->update(['Closed'=>"YES",'Total_Amount'=>$payableamt]);
					
				}
				
				
				else
				{
					if($agent!=0)
					{
						$payableamt=($amt-$interestamt)-10;
						$intamt2=$interestamt-10;
						
					}
					else
					{
						$payableamt=$amt-10;
						$intamt2=10;
						
					}
					$rd_prewithdrawal_id = DB::table('rd_prewithdrawal')->insertGetId(['RdAcc_No'=>$acno,'RdTotal_Amt'=>$rdtotal,'TotalAmt_Payable'=>$payableamt,'Particulars'=>"prewithdrawal before 1 year",'Deduct_Amt'=>$intamt2]);
					$rd_deduct_amt = $intamt2;
					
					$mnt=date('m');
					$year=date('Y');
					$id = DB::table('rd_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $actid,'RD_Trans_Type' => "DEBIT",'RD_Particulars' => "RD PREWITHDRAWAL BEFORE 1 YEAR CALCULATED",'RD_Amount' =>$intamt2 ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$payableamt,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
					
					DB::table('createaccount')->where('AccNum','=',$acno)
					->update(['Closed'=>"YES",'Total_Amount'=>$payableamt]);
					
				}
				
			}
			
			if(isset($rd_deduct_amt)) {
				/******************** ALL CHARGES ******************/
				unset($fd);
				$fd["date"] = date("Y-m-d");
				$fd["bid"] = $bid;
				$fd["transaction_type"] = 2; // DEBIT
				$fd["payment_mode"] = "";
				$fd["amount"] = $rd_deduct_amt;
				$fd["particulars"] = "OTHER INCOME";
				$fd["paid"] = 0; //										--later will be replaced with 1
				$fd["tran_table"] = 32; // rd_prewithdrawal 			--later will be updated with   33-rd_payamount
				$fd["tran_id"] = $rd_prewithdrawal_id; // 				--later will be updated with rd pay amt tran id
				$fd["created_by"] = $UID;
				$fd["SubLedgerId"] = 88; // OTHER INCOME
				$fd["deleted"] = 0;
				$this->all_ch->clear_row_data();
				$this->all_ch->set_row_data($fd);
				$this->all_ch->insert_row();
				/******************** ALL CHARGES ******************/
			}
			
			
			
			
			
			
		}
		
		
		
		function getrdinterest($acno)
		{
			$interest=DB::table('createaccount')->select('Intrest','Duration','Total_Amount','Maturity_Date','Created_on','Accid','createaccount.AccTid')
			->leftJoin('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->where('AccNum','=',$acno)
			->first();
			
			return $interest;
		}
		function gettrandate($acno,$sdate,$enddate1)
		{
			$rddate=DB::table('rd_transaction')->select('RDReport_TranDate')
			->leftJoin('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$enddate1."'")
			->where('createaccount.AccNum','=',$acno)
			->get();
			return $rddate;
		}
		function gettrandatecount($acno,$sdate,$enddate1)
		{
			$rddate1=DB::table('rd_transaction')
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$enddate1."'")
			->join('createaccount','rd_transaction.Accid','=','createaccount.Accid')
			->where('createaccount.AccNum','=',$acno)
			->count('RDReport_TranDate');
			return $rddate1;
		}
		function getopngbal($acno)
		{
			$rdopenbal=DB::table('createaccount')->select('opening_blance','Agent_ID')
			->where('createaccount.AccNum','=',$acno)
			
			->first();
			return $rdopenbal;
		}
		
		public function GetBankNameForPayAmt($q) //For AmtPay
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			return DB::select("SELECT `Bankid` as id, `BankName` as name FROM `addbank` where `addbank`.`Bid`={$BID} AND `BankName` LIKE '%".$q."%' ");
		}
		
		
		
		public function getrdprewithdraw()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;

			$ret_data = DB::table('createaccount')
			->select(DB::raw('Accid as id, CONCAT(`Accid`,"-",`AccNum`) as name'))
			->where('Status','=',"AUTHORISED")
			->where('AccNum','like','%RD%')
			->where('Closed','<>',"YES");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("createaccount.Bid",$BID);
			}
			$ret_data = $ret_data->get();

			return $ret_data;
		}
		
		public function prefdwithdrawal($id)
		{
			$dte=date('Y-m-d');
			$accno=DB::table('fdallocation')->select('Fd_CertificateNum','FdReport_StartDate','FdReport_MatureDate','Fd_DepositAmt')
			->where('Fdid','=',$id["fdaccount"])
			->first();
			
			
			$enddate=$accno->FdReport_MatureDate;
			$startdate=$accno->FdReport_StartDate;
			$acno=$accno->Fd_CertificateNum;
			$amt=$accno->Fd_DepositAmt;
			/*$d2=date_create($dte);
				$d1=date_create($startdate);
				$difday=date_diff($d1,$d2);
			$days=$difday->format('%d');*/
			//print_r($d1);
			//print_r($d2);
			//print_r($difday);
			
			$from_date = new DateTime($startdate);
			$to_date = new DateTime($dte);
			$days=$from_date->diff($to_date)->days;
			$days++;
			$days=$days-8;
			print_r($days);
			
			
			//echo $dayttt;
			
			
			$countofrow=DB::table('fdprewithdrawl')->count('fdprewithdraw_Id');
			for($i=1;$i<=$countofrow;$i++)
			{
				$xx1=DB::table('fdprewithdrawl')->select('prewitdraw_Days')->where('fdprewithdraw_Id','=',$i)->first();
				$x1=$xx1->prewitdraw_Days;
				 if($days<30)
				{
					echo ("value is less than 30");
					DB::table('fd_prewithdrawal')->insertGetId(['FdAcc_No'=>$acno,'FdTotal_Amt'=>$amt,'TotalAmt_Payable'=>$amt,'Withdraw_Date'=>$dte,'Interest_Amount'=>0,'Particulars'=>'FD PREWITHDRAWAL']);
					//exit(0);
				}
				else if($x1>$days)
				{
					$interest=$this->getinterest($i);
					$intrst1=$interest->prewidraw_interest;
					$intrst=$intrst1/100;
					$interestamt=($days*$amt*$intrst)/365;
					$interestamt=$this->roundamt->Roundall($interestamt);
					$payableamt=$amt+$interestamt;
					DB::table('fd_prewithdrawal')->insertGetId(['FdAcc_No'=>$acno,'FdTotal_Amt'=>$amt,'TotalAmt_Payable'=>$payableamt,'Withdraw_Date'=>$dte,'Interest_Amount'=>$interestamt,'Particulars'=>'FD PREWITHDRAWAL']);
					
					DB::table('fdallocation')->where('Fd_CertificateNum',$acno)
					->update(['Closed'=>"YES"]);
					exit(0);
				}
				
			}
			return $days;
			
		}
		function getinterest($i1)
		{
		$i=$i1-1;
			$inter=DB::table('fdprewithdrawl')->select('prewidraw_interest')->where('fdprewithdraw_Id','=',$i)
			->first();
			return $inter;
		}
		
		
		
	}
