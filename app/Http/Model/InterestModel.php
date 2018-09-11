<?php
	
	namespace App\Http\Model;
	
	define("MIN_BAL_TO_NOT_TO_CLOSE_ACC",26);
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\RoundModel;
	use App\Http\Model\AccountModel;
	use App\Http\Model\DepositModel;
	class InterestModel extends Model
	{
		
		protected $table='pigmi_interest';
		public $roundamt;
		public function __construct()
		{
			$this->roundamt=new RoundModel;
			$this->acc=new AccountModel;
			$this->dep_mdl = new DepositModel;
		}
		//Pigmi Interest Calculation
		var $detail;
		
		public function pigmiintcalc($id)
		{
			//var_dump($id);exit();
			$prev = $id["preview"];
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			$b=$udetail->Bid;
			$a=$id['acc11'];
			$calamt=0;
			$i=0;
			$intrst = 0;
			$count=DB::table('pigmiallocation')->count('PigmiAcc_No');
			$accno=DB::table('pigmiallocation')
			->select('PigmiAcc_No')
			->where('Status','=','AUTHORISED')
			->where('Closed','=','NO')
			->where('Loan_Adjustment','=','NO')
			->where('PigmiAllocID','=',$a)
			->first();
			
			$accno1=$accno->PigmiAcc_No;
			
			
			
			
			//foreach($accno as $ac)
			//{
			$dte=date('Y-m-d');
			
			$mnt=date('m');
			$year=date('Y');
			
			$acno=$accno1;//$accno->PigmiAcc_No;
			
			$pginterest=$this->getpigmiinterest($acno);
			//print_r($pginterest);
			$pgminterest=$pginterest->Interest;
			$agnt=$pginterest->Agentid;
			$pgtypeid=$pginterest->PigmiTypeid;
			$pgaloc=$pginterest->PigmiAllocID;
			$sdate=$pginterest->StartDate;
			$sd=date_create($sdate);
			$sdtemonth=$sd->format('m');
			$edate=$pginterest->EndDate;
			$dtdecr=$sdtemonth-1;
			$dtincr=$dtdecr+1;
			$startmonth=$dtdecr+1;
			
			//print_r($dtincr);
			
			//	if($edate<=$dte)
			//	{
			
			$monthamt=$this->getmonth_amt($acno,$sdate,$edate);
			
				// print_r($monthamt);
			$arramt=array();
			for($i=1;$i<=12;$i++)
			{
				//echo "Hello";
				//print_r ($monthamt[$dtincr]);
				//break;
				
				if(empty($monthamt[$dtincr])&&$dtincr==$startmonth)
				{
					break;
				}
				else if(empty($monthamt[$dtincr]))
				{
					
					$monthamt[$dtincr]=$arramt[$i-1];
				}
				
				$arramt[$i]=$monthamt[$dtincr];
				
				if($arramt[$i]==0)
				{
					$arramt[i]=$arramt[$i-1];
				}
				$dtincr++;
				
				if($dtincr>12)
				{
					$dtincr=1;
				}
				
			}
			//print_r($arramt);
			
			$a=0;
			
			foreach($arramt as $amt)
			{
				$a=$amt+$a;
			}
			
			$calcamt=$pginterest->Interest;
			$pgtotint=$this->getdetail($acno);
			$totalamount=$pgtotint->Total_Amount;
			$total=$a;
			
			//$totamt1=($calcamt*$total)/100;
			//$totamt=$totamt1/12;
			
			$totamt=($calcamt*$total)/1200;
			
			
			$totamt=$this->roundamt->Roundall($totamt);
			
/*******************/
				if($prev == 1){//do not insert or update
					return $totamt;
				}
/*******************/

			$detailcount=$this->getdtlcount($acno,$sdate);
			
/************/
			$total_service_charge_amount = $this->dep_mdl->total_service_charge_amount(["allocation_id"=>$id['acc11']]);
			//var_dump($total_service_charge_amount);exit();
/************/
			
			$amtpay=$totalamount+$totamt-$total_service_charge_amount;
			$amtpay=$this->roundamt->Roundall($amtpay);
			
			$reportdte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$time=date('h:i:s');
			//if($detailcount==0)
			//{
			
			$id = DB::table('pigmi_interest')->insertGetId(['PigmiAcc_No'=>$acno,'Monthtotal_Amount'=>$total,'Interest_Amt'=>$totamt,'Interest'=>$pgminterest,'Month'=>$mnt,'Year'=>$year,'PgmInt_Date'=>$dte,'Amount_Payable'=>$amtpay,'Principle_Amount'=>$totalamount]);
			
			
			
			
			$tran = DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$dte,'PigReport_TranDate'=>$reportdte,'Trans_Time'=>$time,'PigmiAllocID'=>$pgaloc,'Current_Balance'=>$totalamount,'Transaction_Type'=>"CREDIT",'Amount'=>$totamt,'Particulars'=>"Pygmy Interest Calculated",'PigmiTypeid'=>$pgtypeid,'Total_Amount'=>$amtpay,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"INTEREST AMOUNT",'CreatedBy'=>$UID,'Bid'=>$b]);
			
			DB::table('pigmiallocation')->where('PigmiAcc_No','=',$acno)
			->update(['Closed'=>"YES",'Total_Amount'=>$amtpay]);
			//}
			/*else
				{
				$getinterestdtl=$this->getinterestdetail($acno,$sdate);
				$gettranid=$this->gettrandetail($acno,$sdate);
				$pgintid=$getinterestdtl->PgmInterest_ID;
				$tranid=$gettranid;//->PigmiTrans_ID;
				
				$id = DB::table('pigmi_interest')->where('PgmInterest_ID','=',$pgintid)
				->update(['PigmiAcc_No'=> $acno,'Monthtotal_Amount'=>$total,'Interest_Amt' => $totamt,'Interest' => $pgminterest,'Month' => $mnt,'Year' => $year,'PgmInt_Date'=>$dte,'Amount_Payable'=>$amtpay,'Principle_Amount'=>$totalamount]);
				
				$tran = DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tranid)
				->update(['Trans_Date'=>$dte,'PigReport_TranDate'=>$reportdte,'Trans_Time'=>$time,'PigmiAllocID'=>$pgaloc,'Current_Balance'=>$totalamount,'Transaction_Type'=>"CREDIT",'Amount'=>$totamt,'Particulars'=>"Pygmy Interest Calculated",'PigmiTypeid'=>$pgtypeid,'Total_Amount'=>$amtpay,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"INTEREST AMOUNT",'CreatedBy'=>$UID,'Bid'=>$b]);
				
				DB::table('pigmiallocation')->where('PigmiAcc_No','=',$acno)
				->update(['Closed'=>"YES",'Total_Amount'=>$amtpay]);
			}*/
			//	}
			return $totamt;
		}
		
		
		function getpigmiinterest($acno)
		{
			$ptype=DB::table('pigmiallocation')
			->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('pigmitype.Pigmi_Type','pigmitype.Interest','StartDate','EndDate','Agentid','pigmitype.PigmiTypeid','pigmiallocation.PigmiAllocID')
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
		
		function getdtlcount($acno,$sdate)
		{
			$dte=date('Y-m-d');
			$detail=DB::table('pigmi_interest')
			->where('PigmiAcc_No','=',$acno)
			->whereRaw("DATE(pigmi_interest.PgmInt_Date) BETWEEN '".$sdate."' AND '".$dte."'")
			->count('PigmiAcc_No');
			return $detail;
		}
		
		function getinterestdetail($acno,$sdate)
		{
			$dte=date('Y-m-d');
			$getvalue=DB::table('pigmi_interest')
			->select('PgmInterest_ID')
			->where('PigmiAcc_No','=',$acno)
			->whereRaw("DATE(pigmi_interest.PgmInt_Date) BETWEEN '".$sdate."' AND '".$dte."'")
			->first();
			return $getvalue;
		}
		
		function gettrandetail($acno,$sdate)
		{
			
			$dte=date('Y-m-d');
			$actid=DB::table('pigmiallocation')
			->select('PigmiAllocID')
			->where('PigmiAcc_No','=',$acno)
			->first();
			
			$pgalid=$actid->PigmiAllocID;
			
			$getvalue=DB::table('pigmi_transaction')
			->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
			->where('pigmi_transaction.PigmiAllocID','=',$pgalid)
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$sdate."' AND '".$dte."'")
			->max('PigmiTrans_ID');
			return $getvalue;
		}
		
		
		function getmonth_amt($acno,$sdate,$edate)
		{
			/*$dte=date('Y-m-d');
				
				$actid=DB::table('pigmiallocation')
				->select('PigmiAllocID')
				->where('PigmiAcc_No','=',$acno)
				->first();
				
				$pgalid=$actid->PigmiAllocID;
				
				//$date = strtotime('2012-05-01 -4 months');
				
				$date1 = strtotime($edate .' -1 months');
				$final1=date('Y-m-d', $date1);
				$final=date_create($final1);
				$lastmonth=$final->format('m');
				$lastday=$final->format('d');
				$lastyrar=$final->format('Y');
				if(($lastmonth%2)==0)
				{	if($lastmonth==2)
				{
				$lastday=28;
				}
				else
				{
				$lastday=30;
				}
				
				
				}
				else
				{
				$lastday=31;
				
				}
				$final=$lastyrar."-".$lastmonth."-".$lastday;
				print_r($final);
				
				return DB::table('pigmi_transaction')
				->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
				->where('pigmi_transaction.PigmiAllocID','=',$pgalid)
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$sdate."' AND '".$final."'")
				->groupBy('pigmi_transaction.Month')
				->selectRaw('sum(pigmi_transaction.Amount) as sum,pigmi_transaction.Month')
			->lists('sum','pigmi_transaction.Month');*/
			
			$dte=date('Y-m-d');
			
			$actid=DB::table('pigmiallocation')
			->select('PigmiAllocID')
			->where('PigmiAcc_No','=',$acno)
			->first();
			
			$pgalid=$actid->PigmiAllocID;
			
			//$date = strtotime('2012-05-01 -4 months');
			$loopmonth1=date_create($sdate);
			$loopmonth=$loopmonth1->format('m');
			
			$date1 = strtotime($edate .' -1 months');
			$final1=date('Y-m-d', $date1);
			$final=date_create($final1);
			$lastmonth=$final->format('m');
			$lastday=$final->format('d');
			$lastyrar=$final->format('Y');
			if(($lastmonth%2)==0)
			{	if($lastmonth==2)
				{
					$lastday=28;
				}
				else
				{
					$lastday=30;
				}
				
				
			}
			else
			{
				$lastday=31;
				
			}
			$final=$lastyrar."-".$lastmonth."-".$lastday;
			//print_r($final);
			
			$test= DB::table('pigmi_transaction')
			->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
			->where('pigmi_transaction.PigmiAllocID','=',$pgalid)
			->where('pigmi_transaction.service_charge','=',0)//NO SERVICE CHARGE ENTRIES
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$sdate."' AND '".$final."'")
			->groupBy('pigmi_transaction.Month')
			->selectRaw('max(pigmi_transaction.PigmiTrans_ID) as sum,pigmi_transaction.Month,pigmi_transaction.Total_Amount')
			//->selectRaw('sum(pigmi_transaction.Amount) as sum,pigmi_transaction.Month')
			->lists('sum');
			
			//print_r($test);
			$monthandamt=array();
			//$arramt=array();
			foreach($test as $tranid)
			{
				$amtandmonth=DB::table('pigmi_transaction')->select('Month','Total_Amount')
				->where('PigmiTrans_ID',$tranid)
				->first();
				$mnth=$amtandmonth->Month;
				$amt=$amtandmonth->Total_Amount;
				$monthandamt[$mnth]=$amt;
				
			}
			//	print_r($monthandamt);
			
			return $monthandamt;
			
		}
		
		
		
		
		/*
		//SB INTEREST CALCULATIONS GOES BELOW//
		function sbinterest_cal($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$dte=date('d-m-Y');
			$reportdte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			$MonthWord=date('M');
			$calamt=0;
			$i=0;
			$intrst = 0;
			$count=DB::table('createaccount')->count('AccNum');
			$accno=DB::table('createaccount')->select('AccNum','Accid','AccTid','Created_on','Total_Amount')->where('createaccount.AccTid','=',$id)->where('Bid','=',$BID)->get();
			//print_r($accno);
			foreach($accno as $ac)
			{
			$Total_Amount=$ac->Total_Amount;
				
			if($Total_Amount>250)
			{
				$acno=$ac->AccNum;$Accid=$ac->Accid;
				$Created_on=$ac->Created_on;
				//$tempmDate = explode('-',$Created_on);
				//$mon=$tempmDate[1];
				//$year1=$tempmDate[0];
				$dte=date('d-m-Y');
				$year=date('Y');
				$mnt=date('m');
				
				
				
				$s_date="2017-03-01";
				$d_date="2017-08-31";
				$month=2;
				$year_sb=2017;
				$date1=date_create($s_date);
				$date2=date_create($d_date);
				$difmnth=date_diff($date2,$date1);
				$difmnth1=$difmnth->format('%m');
				$difyr=$difmnth->format('%y');
				$mn=array();
				for($j=1;$j<=6;$j++)
				{
					if(($month+$j)>12)
					{
						$mn[$j]=($month+$j)%12;
						$yr=$year_sb+1;
					}
					else
					{
						$mn[$j]=($month+$j);
						$yr=$year_sb;
					}
				}
				$temp_data=0;
			print_r($mn);
				
				for($k=1;$k<=count($mn);$k++)
				{
					
					
					$m=$mn[$k];
					
					$bal= DB::table('sb_transaction')->where('Accid','=',$Accid)
					->where('sb_transaction.Month','=',$m)
					->where('sb_transaction.Year','=',$yr)
					->where('sb_transaction.Bid','=',$BID)
					//->where('sb_transaction.Cleared_State','=',"CLEARED")
					->min('Total_Bal');
					
					
					
				
					if($bal==0)
					{
						
						if($m==1)
						{
							$m=12;
							$yr=$yr-1;
						}
						else
						{
							$m=$m-1;
						}
						//if($year1>=$yr)
						//{
							$maxtot=1;
							for($i=1;$i<=6;$i++)
							{
								if($yr=="2017"&&$m>=3)
								{
								$maxtot=DB::table('sb_transaction')
								->where('Accid','=',$Accid)
								->where('sb_transaction.Month','=',$m)
								->where('sb_transaction.Year','=',$yr)
								->where('sb_transaction.Bid','=',$BID)
					
								//->where('sb_transaction.Cleared_State','=',"CLEARED")
								->max('Tranid');
								
								if($maxtot>0)
								{
									$month_bal1=DB::table('sb_transaction')->select('Total_Bal')
									->where('Tranid','=',$maxtot)
									->first();
									$month_bal=$month_bal1->Total_Bal;
								}
								}
								else
								{
									$month_bal=0;
									}
								
							}
							
						//}
						
					}
					else
					{
						$month_bal=$bal;
					}
					
					print_r($month_bal);
					$temp_data=(floatval($temp_data)+floatval($month_bal));
					
					
					
					
				}
				
				$inter=$this->getinterest($acno);
				$singleinterst=$inter->Intrest;
				$interestby=$singleinterst/12;
				$tta=($temp_data*$interestby)/100;
				$tta=$this->roundamt->Roundall($tta);
				$a=DB::table('sb_int')->insert(['accno'=>$acno,'int_'=>$tta,'total'=>$temp_data,'Bid'=>$BID]);
			}	
			}
			
			
			//return $a;
		}*/
		
		function cal_month_bal($acno,$m,$yr,$year1)
		{
			if($year1>=$yr)
			{
				if($m>1)
				{
					$m=12;
					$yr=$yr-1;
				}
				else
				{
					$m=$m-1;
				}
				$maxtot=DB::table('sb_transaction')->leftJoin('createaccount','sb_transaction.Accid','=','createaccount.Accid')
				->where('createaccount.AccNum','=',$acno)
				->where('sb_transaction.Month','=',$m)
				->where('sb_transaction.Year','=',$yr)
				//->where('sb_transaction.Cleared_State','=',"CLEARED")
				->max('Tranid');
				if($maxtot>0)
				{
					$month_bal1=DB::table('sb_transaction')->select('Total_Bal')
					->where('Tranid','=',$maxtot)
					->first();
					$month_bal=$month_bal1->Total_Bal;
					return $month_bal;
				}
				else
				{ 
					
					
					$this->cal_month_bal($acno,$m,$yr);
				}
			}
			else
			{
				$month_bal=0;
				return $month_bal;
			}
			
		}
		
		
		
		function getinterest($acno)
		{
			$interest=DB::table('createaccount')->select('Intrest')
			->leftJoin('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->where('AccNum','=',$acno)
			->first();
			return $interest;
		}
		
		
		function getcountdtl($acno)
		{
			
			
			
			
			
		}
		
		
		
		
		
		
		
		
		public function rdinterest_cal($id)
		{
			//var_dump($id);exit();
			$prev = $id["preview"];
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			//	$acctyp=$id['acctyp_11'];
			$acctyp="2";
			$bid=$udetail->Bid;
			$mnt=date('m');
			$year=date('Y');
			$dte=date('Y-m-d');
			
			$accno=DB::table('createaccount')->select('AccNum')
			->where('createaccount.Accid','=',$id["rdaccid"])
			//->where('Status','=',"AUTHORISED")
			->first();
			//	->where('Closed','<>','YES')
			//->where('createaccount.AccTid','=',$id)
			//print_r($accno);
			//foreach($accno as $ac)
			//{
			$acno=null;
			$duecount=null;
			$monthcount=null;
			$trandate=null;
			$acno = $accno->AccNum;
			$rdintrst=$this->getrdinterest($acno);
			
			$acid=$rdintrst->Accid;
			$startdate=$rdintrst->Created_on;
			$sdate=date("Y-m-d",strtotime($startdate));
			$date2=date_create($sdate);
			$day=$date2->format('d');
			$edate=$rdintrst->Maturity_Date;
			
			//if($dte>=$edate)
			//	{
			$monthlytot=$this->getRDmonth_amt($acno,$sdate);
			$tot=0;
			foreach($monthlytot as $amt)
			{
				$tot=$amt+$tot;
			}
			$getintr=$rdintrst->Intrest;//get interest  of  RD
			$getdur=$rdintrst->Duration;// get RD DUration
			$gettotmonth=$getdur*12;//get total month
			$principleamt=$rdintrst->Total_Amount;
			$rdtotal=$tot;
			// echo "rd total: {$rdtotal}<br />\n";
			if($getdur>1)
			{
				$calcdur=$getdur-1;
				$yearinterest=$calcdur*0.5;
				$calinterestrate=$getintr+$yearinterest;	
			}
			else
			{
				$calinterestrate=$getintr;
			}
			$interest=($calinterestrate/12);
			$interestamt=($rdtotal*$interest)/100;
			$interestamt=$this->roundamt->Roundall($interestamt);
			
			$trandate=$this->gettrandate($acno,$sdate,$edate);//to get all the transation date
			$trandatecount=$this->gettrandatecount($acno,$sdate,$edate);//to get all the transation date count
			$payableamt=$principleamt;
			//$totalBal=
			if($trandatecount==$gettotmonth)
			{
				$monthcount=0;
			}
			else
			{
				
				$monthcount=$gettotmonth-$trandatecount;
			}

			/* foreach($trandate as $trandatedue)
			{
				$tranday=$trandatedue->RDReport_TranDate;
				$trandate2=date_create($tranday);
				$day2=$trandate2->format('d');
				if($day2>$day)
				{
					$duecount=$duecount+1;
				}
			} */
			
			$prev_month = -1;
			foreach($trandate as $trandatedue)
			{
				$tranday=$trandatedue->RDReport_TranDate;
				$trandate2=date_create($tranday);
				$day2=$trandate2->format('d');
				$this_month = $trandate2->format('m');
				if($day2>$day && ($prev_month != $this_month))
				{
					$duecount=$duecount+1;
				}
				$prev_month = $this_month;
			}

			$duecount1=$duecount+$monthcount;
			$interestcount=$this->getrdinterestcount($acno);
			if($duecount1>0)
			{
				$getopbal=$this->getopngbal($acno,$sdate,$edate);
				$opbal=$getopbal->opening_blance;
				$due=($opbal*5)/1000;
				// echo "due count: {$duecount1}<br />\n	";
				$dueamt=$due*$duecount1;
				$dueamt=$this->roundamt->Roundall($dueamt);
				$rdamt1=($interestamt-$dueamt);
				$rdamt=abs($rdamt1);//interest amt
/*******************/
				if($prev == 1){//do not insert or update
					return $rdamt;
				}
/*******************/
				$amtpay=($payableamt+$rdamt);
				
				if($interestcount==0)
				{
					DB::table('rd_interest')->insertGetId(['RdAcc_No'=>$acno,'Total_Amount'=>$rdtotal,'Interest'=>$getintr,'Amount_Payable'=>$amtpay,'RDInt_Date'=>$dte,'Interest_Amt'=>$rdamt,'Month'=>$mnt,'Year'=>$year,'Principle_Amount'=>$principleamt]);
					
					$id = DB::table('rd_transaction')->insertGetId(['Accid'=> $acid,'AccTid' =>"2",'RD_Trans_Type' => "CREDIT",'RD_Particulars' => "RD INTEREST CALCULATED",'RD_Amount' =>$rdamt ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$amtpay,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
					
					DB::table('createaccount')->where('Accid',$acid)
					->update(['Total_Amount'=>$amtpay,'Closed'=>"YES"]);
				}
				else
				{
					$interestid=$this->getrdinterestdetail($acno);
					$tran=$this->getrdtrandetail($acno,$sdate);
					$interest_ID=$interestid->RDInterest_ID;
					//$rdtranid=$tran->RD_TransID;
					$rdtranid=$tran;
					
					DB::table('rd_interest')->where('RDInterest_ID',$interest_ID)
					->update(['Total_Amount'=>$rdtotal,'Interest'=>$getintr,'Amount_Payable'=>$amtpay,'RDInt_Date'=>$dte,'Interest_Amt'=>$rdamt,'Month'=>$mnt,'Year'=>$year,'Principle_Amount'=>$principleamt]);
					
					$id = DB::table('rd_transaction')->where('RD_TransID',$rdtranid)
					->update(['Accid'=> $acid,'AccTid' =>"2",'RD_Trans_Type' => "CREDIT",'RD_Particulars' => "RD INTEREST CALCULATED",'RD_Amount' =>$rdamt ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$amtpay,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
					
					DB::table('createaccount')->where('Accid',$acid)
					->update(['Total_Amount'=>$amtpay,'Closed'=>"YES"]);
				}
				return $rdamt;
			}
			else
			{
/*******************/
				if($prev == 1){//do not insert or update
					return $interestamt;
				}
/*******************/
				$payamt=$payableamt+$interestamt;
				if($interestcount==0)
				{
					DB::table('rd_interest')->insertGetId(['RdAcc_No'=>$acno,'Total_Amount'=>$rdtotal,'Interest'=>$getintr,'Amount_Payable'=>$payamt,'RDInt_Date'=>$dte,'Interest_Amt'=>$interestamt,'Month'=>$mnt,'Year'=>$year,'Principle_Amount'=>$principleamt]);
					
					$id = DB::table('rd_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $acctyp,'RD_Trans_Type' => "CREDIT",'RD_Particulars' => "RD INTEREST CALCULATED",'RD_Amount' =>$interestamt ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$payamt,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
					
					DB::table('createaccount')->where('Accid',$acid)
					->update(['Total_Amount'=>$payamt,'Closed'=>"YES"]);
				}
				else
				{
					$interestid=$this->getrdinterestdetail($acno);
					$tran=$this->getrdtrandetail($acno,$sdate);
					$interest_ID=$interestid->RDInterest_ID;
					$rdtranid=$tran;//->RD_TransID;
					
					DB::table('rd_interest')->where('RDInterest_ID',$interest_ID)
					->update(['Total_Amount'=>$rdtotal,'Interest'=>$getintr,'Amount_Payable'=>$payamt,'RDInt_Date'=>$dte,'Interest_Amt'=>$interestamt,'Month'=>$mnt,'Year'=>$year,'Principle_Amount'=>$principleamt]);
					
					$id = DB::table('rd_transaction')->where('RD_TransID',$rdtranid)
					->update(['Accid'=> $acid,'AccTid' => $acctyp,'RD_Trans_Type' => "CREDIT",'RD_Particulars' => "RD INTEREST CALCULATED",'RD_Amount' =>$interestamt ,'RD_CurrentBalance' =>$rdtotal,'RD_Total_Bal' =>$payamt,'RD_Date' => $dte,'RDReport_TranDate'=>$dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid]);
					
					DB::table('createaccount')->where('Accid',$acid)
					->update(['Total_Amount'=>$payamt,'Closed'=>"YES"]);
				}
				return $interestamt;
			}
			//}
			//}
		}
		
		function getrdinterest($acno)
		{
			$interest=DB::table('createaccount')->select('Intrest','Duration','Total_Amount','Maturity_Date','Created_on','Accid')
			->leftJoin('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->where('AccNum','=',$acno)
			->first();
			
			return $interest;
		}
		function gettrandate($acno,$sdate,$edate)
		{
			$rddate=DB::table('rd_transaction')->select('RDReport_TranDate')
			->leftJoin('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$edate."'")
			->where('createaccount.AccNum','=',$acno)
			->get();
			return $rddate;
		}
		function gettrandatecount($acno,$sdate,$edate)
		{
			$rddate1=DB::table('rd_transaction')
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$edate."'")
			->join('createaccount','rd_transaction.Accid','=','createaccount.Accid')
			->where('createaccount.AccNum','=',$acno)
			->count('RDReport_TranDate');
			return $rddate1;
		}
		
		function getopngbal($acno,$sdate,$edate)
		{
			$rdopenbal=DB::table('createaccount')->select('opening_blance')
			->where('createaccount.AccNum','=',$acno)
			
			->first();
			return $rdopenbal;
		}
		
		function getrdinterestdetail($acno)
		{
			return DB::table('rd_interest')
			->select('RDInterest_ID')
			->where('RDAcc_No','=',$acno)
			->first();
		}
		
		function getrdinterestcount($acno)
		{
			return DB::table('rd_interest')
			->where('RDAcc_No','=',$acno)
			->count('RDAcc_No');
			
		}
		function getrdtrandetail($acno,$sdate)
		{
			
			$dte=date('Y-m-d');
			$actid=DB::table('createaccount')
			->select('Accid')
			->where('AccNum','=',$acno)
			->first();
			
			$accid=$actid->Accid;
			
			$rdgetvalue=DB::table('rd_transaction')
			->join('createaccount','createaccount.Accid','=','createaccount.Accid')
			->where('rd_transaction.Accid','=',$accid)
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$dte."'")
			->max('RD_TransID');
			return $rdgetvalue;
		}
		
		function getRDmonth_amt($acno,$sdate)//end date todays date 
		{
			$dte=date('Y-m-d');
			
			$accnid=DB::table('createaccount')
			->select('Accid')
			->where('AccNum','=',$acno)
			->first();
			
			$accid=$accnid->Accid;
			
			$rd_transaction = DB::table('rd_transaction')
			->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->where('rd_transaction.Accid','=',$accid)
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$dte."'")
			->groupBy('rd_transaction.RD_Month')
			->selectRaw('min(rd_transaction.RD_Total_Bal) as sum,rd_transaction.RD_Month')	//	CHANGE sum TO min
			->lists('sum','rd_transaction.RD_Month');
			
			$rd_transaction_sum = DB::table('rd_transaction')
			->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->where('rd_transaction.Accid','=',$accid)
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$sdate."' AND '".$dte."'")
			->groupBy('rd_transaction.RD_Month')
			->selectRaw('max(rd_transaction.RD_Total_Bal) as sum,rd_transaction.RD_Month')	//	CHANGE sum TO min
			->lists('sum','rd_transaction.RD_Month');

			
			// print_r($rd_transaction);//exit();
			// print_r($rd_transaction_sum);//exit();


/****edit***/
			$temp = date("m",strtotime($sdate));
			$start_month = (int)$temp;
			$i = (int)$temp;
			if(++$i == 13){
				$i = 1;
			}
			while($i != $start_month ) {//echo "$i";
				if(isset($rd_transaction[$i])) {
					//echo "true<br>\n";
				} else {
					//echo "false";
					$j = $i-1;
					if($j == 0) {
						$j = 12;
					}//echo "$rd_transaction[$j]<br>\n";
					$rd_transaction[$i] = $rd_transaction_sum[$j];
					$rd_transaction_sum[$i] = $rd_transaction_sum[$j];
				}
				if(++$i == 13){
					$i = 1;
				}
			}
			// print_r($rd_transaction);//exit();
			// print_r($rd_transaction_sum);//exit();
/****edit***/
			return $rd_transaction;
		}
		
		function FDwithdraw($id)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$dte=date('Y-m-d');
			$accno=DB::table('fdallocation')->select('Fd_CertificateNum')
			//->where('FdReport_MatureDate','<=',$dte)
			->where('Fdid','=',$id["fdalocid"])
			->first();
			//foreach($accno as $acc)
			//{
			$fdaccnnum=$accno->Fd_CertificateNum;
			DB::table('fdallocation')->where('Fd_CertificateNum',$fdaccnnum)
			->update(['Fd_Withdraw'=>"YES",'Closed'=>"YES"]);
			//	}

			/************** fd remaining interest ***************/
			$fdallocation_row = DB::table('fdallocation')
				->select(
					'intrest_needed',
					'Fd_TotalAmt',
					'Fd_CertificateNum',
					'FdReport_StartDate',
					'interstmonth',
					'Accid',
					'Fd_DepositAmt',
					'FdTid',
					"FdReport_MatureDate"
					)
				->where('Fdid','=',$id["fdalocid"])
				->first();
			
			if($dte > $fdallocation_row->FdReport_MatureDate) {
				$end_date = $fdallocation_row->FdReport_MatureDate;
			} else {
				$end_date = $dte;
			} echo "end_date = {$end_date} ";

			echo "-0-";
			if(strcasecmp($fdallocation_row->intrest_needed, "YES") == 0) {echo "-1-";
				//calc int // $fd_rem_interest

						$fddetails = $fdallocation_row;
						$accno1 = $fdallocation_row->Fd_CertificateNum;
						/***************************/
							$fdcou=DB::table('fd_monthly_interest')->where('fdnum',$accno1)->where('id','=',"1")->count('FD_ID');
							if($fdcou==0) {echo "-2-";
										/*******************/
										$temp = DB::table("fd_monthly_interest")
										->select("FD_Date")
										->where("deleted",0)
										->where("fdnum",$fddetails->Fd_CertificateNum)
										->orderBy("FD_Date","desc")
										->first();//print_r($temp);exit();
										
										if(!empty($temp) && $temp->FD_Date != "0000-00-00") {echo "-3-";
											$last_interest_paid_date = $temp->FD_Date;
											$first_interest = false;
										} else {echo "-4-";
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
								$date1=date_create($end_date);
								$date2=date_create($lastpaiddate);
								$difdate=date_diff($date1,$date2);
								$difdays=$difdate->format('%a');
								if($first_interest) {echo "-5-";
									$difdays++;
								}
								$totamt=$difdays*$amt4;
								$totamt=$this->roundamt->Roundall($totamt);
								DB::table('fd_monthly_interest')->insert(['Accid'=>$accid,'amount'=>$totamt,'fdnum'=>$accno1,'id'=>"1",'Bid'=>$BID,'FD_Date'=>$dte,'days'=>$difdays]);
								echo "-6-";
							}
						/***************************/
						// $fd_rem_interest = $totamt;



				// $fd_total_amt = $fdallocation_row->Fd_TotalAmt + $fd_rem_interest;
				// DB::table("fdallocation")
				// 	->where('Fdid','=',$id["fdalocid"])
				// 	->update(['Fd_TotalAmt'=>$fd_total_amt, 'interest_amount'=>$fd_rem_interest]);
			}
			/************** fd remaining interest ***************/
		}

		public function editpigmiInterestCalc($id)
		{
			$pigmiid=$id['acc11'];
			$intestamt=$id['intrestamt'];
			$acualintestamt=$id['acualamt'];
			
			
			$PIGMIMACID1=DB::table('pigmi_transaction')->where('PigmiAllocID',$pigmiid)
			->max('PigmiTrans_ID');
			
			$pigtotamt1=DB::table('pigmiallocation')->select('Total_Amount','PigmiAcc_No')
			->where('PigmiAllocID',$pigmiid)
			->first();
			
			$pigtotamt=$pigtotamt1->Total_Amount;
			$pigaccno=$pigtotamt1->PigmiAcc_No;
			$totamt=$pigtotamt-$acualintestamt;
			$totamt1=$totamt+$intestamt;
			//print_r($totamt);
			//print_r($intestamt);
			//print_r($totamt1);
			DB::table('pigmiallocation')->where('PigmiAllocID',$pigmiid)
			->update(['Total_Amount'=>$totamt1]);
			DB::table('pigmi_interest')->where('PigmiAcc_No',$pigaccno)
			->update(['Interest_Amt'=>$intestamt,'Amount_Payable'=>$totamt1]);
			return DB::table('pigmi_transaction')->where('PigmiTrans_ID',$PIGMIMACID1)
			->update(['Amount'=>$intestamt,'Total_Amount'=>$totamt1]);
		}
		
		public function editrdInterestCalc($id)
		{
			$rdid=$id['acc11'];
			$intestamt=$id['intrestamt'];
			$acualintestamt=$id['acualamt'];
			
			
			$rdmaxid=DB::table('rd_transaction')->where('Accid',$rdid)
			->max('RD_TransID');
			
			$rdtotamt1=DB::table('createaccount')->select('Total_Amount','AccNum')
			->where('Accid',$rdid)
			->first();
			
			$rdtotamt=$rdtotamt1->Total_Amount;
			$rdaccno=$rdtotamt1->AccNum;
			$totamt=$rdtotamt-$acualintestamt;
			$totamt1=$totamt+$intestamt;
			//print_r($totamt);
			//print_r($intestamt);
			//print_r($totamt1);
			DB::table('createaccount')->where('Accid',$rdid)
			->update(['Total_Amount'=>$totamt1]);
			DB::table('rd_interest')->where('RdAcc_No',$rdaccno)
			->update(['Interest_Amt'=>$intestamt,'Amount_Payable'=>$totamt1]);
			return DB::table('rd_transaction')->where('RD_TransID',$rdmaxid)
			->update(['RD_Amount'=>$intestamt,'RD_Total_Bal'=>$totamt1]);
		}
		
		
		//SB INTEREST CALCULATIONS GOES BELOW//
		function sbinterest_cal2($data)
		{
			$int_year = $data["int_year"];
			$int_month = date("m",strtotime("{$data["int_year"]}-{$data["int_month"]}"));
//			echo "int_month=$int_month";//exit();
			
			$interest_calculation_date = "{$int_year}-{$int_month}-01";
//			var_dump($interest_calculation_date);exit();

			$interest_calculated_till = date("Y-m-t",strtotime("+5 months",strtotime("{$int_year}-{$int_month}")));
//			var_dump($interest_calculated_till);exit();
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$calamt=0;
			$i=0;
			$intrst = 0;
			$count=DB::table('createaccount')->count('AccNum');
			$accno=DB::table('createaccount')
				->select('AccNum','Accid','AccTid','Created_on','Total_Amount')
				->where('createaccount.AccTid','=',$data["acctype"])
				->where('Closed','=',"NO")
				->where('Bid','=',$BID)
				// ->where('Accid','=',"39")
				->where('last_interest_calculated_till','<',$interest_calculation_date)
//				->limit(5)
				->get();
//			print_r($accno);//exit();
			$fn_data["acc_id"] = $data["acctype"];
			$normal_interest_rate = $this->get_interest_rate($fn_data);
			unset($fn_data);
			$interest_rate_with_fdacc = $normal_interest_rate;// - 1;
			$acc_with_fd = array();
			$acc_with_fd = DB::table("fdallocation")
				->where("Bid","=",$BID)
				->lists("Accid");
//			print_r($acc_with_fd);
			
			foreach($accno as $ac)
			{
				$fn_data["acc_id"] = $ac->Accid;
				$balance = $this->acc->get_account_balance($fn_data);
//				echo "balance=$balance";
					
				if($balance >= 250)
				{
					echo "accid={$ac->Accid} ({$ac->AccNum})<br>";
					$acno=$ac->AccNum;
					$Accid=$ac->Accid;
					
					$fn_data["int_year"] = $int_year;
					$fn_data["int_month"] = $int_month;
					$monthly_min = $this->get_month_min_bal($fn_data);
//					print_r($monthly_min);continue;
					
					$monthly_min_sum = 0;
					$temp_date = "{$int_year}-{$int_month}";
					for($i=1; $i<=6; $i++) {
//						echo "temp_date=$temp_date<br>";//exit();
						if(isset($monthly_min["{$temp_date}"])) {
							$monthly_min_sum += $monthly_min["{$temp_date}"];
	//						var_dump($monthly_min["{$temp_date}"]);
						}
						$temp_date = date("Y-m",strtotime("+1 month",strtotime($temp_date)));
					}
					echo "monthly_min_sum=$monthly_min_sum<br>";//exit();
					
					if(in_array($Accid,$acc_with_fd)) {
						$interest_rate = $interest_rate_with_fdacc;
					} else {
						$interest_rate = $normal_interest_rate;
					}
					$interest_amount = round($monthly_min_sum * $interest_rate / 100 / 12);
//					echo "interest_amount=$interest_amount<br>";exit();
					
					$a=DB::table('sb_int')->insert(['accno'=>$acno,'int_'=>$interest_amount,'total'=>$monthly_min_sum,'Bid'=>$BID,"sb_int_date"=>$interest_calculated_till]);
					DB::table("createaccount")
						->where("Accid","=",$Accid)
						->update(["last_interest_calculated_till"=>$interest_calculated_till]);
				}//return;
			}
		}
		
		public function get_interest_rate($data)
		{
			return DB::table("accounttype")
				->where("AccTid","=",$data["acc_id"])
				->value("Intrest");
		}
		
		public function get_month_min_bal($data)
		{
			$int_year = $data["int_year"];
			$int_month = $data["int_month"];
			$today = date("Y-m");
			$monthly_min = array();
			
			$mar_31_entry = DB::table("sb_transaction") 
				->where("Accid","=",$data["acc_id"])
				->where("particulars","=","Balance on 31-03-2017")
				->first();
				
			if(!empty($mar_31_entry)) {
				$temp_date = date("Y-m",strtotime("2017-03-31"));
				// $temp_date = date("Y-m",strtotime("{$int_year}-03-31"));
				$first_bal = $mar_31_entry->Amount;
			} else {
				$created_date = DB::table("createaccount")
					->where("Accid","=",$data["acc_id"])
					->value("Created_on");
				$start_month = date("m",strtotime($created_date));
				$start_year = date("Y",strtotime($created_date));
				$temp_date = "{$start_year}-{$start_month}";
				$first_bal = DB::table("sb_transaction")
					->where("Accid","=",$data["acc_id"])
					->where("particulars","=","Opening Balance")
					->value("Amount");
			}
			
			$first_flag = true;
			$cur_bal = 0;
			while($temp_date <= $today) {
				if($first_flag) {
					$monthly_min["{$temp_date}"] = $first_bal;
					$first_flag = false;
				} else {
					$monthly_min["{$temp_date}"] = $cur_bal;
				}
				
//				echo "temp_date = $temp_date";//continue;
				$trans = DB::table('sb_transaction')
					->select('sb_transaction.Accid','SBReport_TranDate','TransactionType','Amount','Total_Bal','Tranid','particulars','CurrentBalance','Cleared_State','CurrentBalance','Uncleared_Bal')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
					->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
					->where('sb_transaction.Accid',$data["acc_id"])
					->where("tran_reversed","=","NO")
					->where("SBReport_TranDate","like","%{$temp_date}%")
					->where("sb_transaction.deleted","=",0)
					->orderBy('SBReport_TranDate','asc')
					->orderBy('Tranid','asc')
					->get();
//				print_r($trans);//exit();
				
				foreach($trans as $row) {
					if(strcasecmp($row->TransactionType, "CREDIT") == 0) {
						if($row->Cleared_State != "UNCLEARED" && !($row->Uncleared_Bal > 0)) {
							$cur_bal += $row->Amount;
						}
					} else {
						if($row->Cleared_State != "UNCLEARED" && !($row->Uncleared_Bal > 0)) {
							$cur_bal -= $row->Amount;
						}
					}
					if($cur_bal < $monthly_min["{$temp_date}"]) {
						$monthly_min["{$temp_date}"] = $cur_bal;
					}
				}
//				echo "cur_bal = $cur_bal<br>";//continue;
				$temp_date = date("Y-m",strtotime('+1 month',strtotime("{$temp_date}-01")));
				
			}
			foreach($monthly_min as $key => $val){
				if($key < "{$int_year}-{$int_month}") {
					unset($monthly_min[$key]);
				}
			}
			print_r($monthly_min);//exit();
			return $monthly_min;
		}
		
		public function calc_service_charge_sb($data)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$calculation_year = $data["year"];
			//$type = $data["type"];
			
			$caculation_date = "{$calculation_year}-03-31";
			
			$createaccount = DB::table('createaccount')
				->select(
							'AccNum',
							'Accid',
							'AccTid',
							'Created_on',
							'Total_Amount'
						)
				->where('createaccount.AccTid','=',1)
				->where('Bid','=',$BID)
				->where('Closed','=',"NO")
				->where('last_service_charge_calculated_till','<',$caculation_date)
//				->limit(5)
				->get();
				
			foreach($createaccount as $row) {
				$last_tran = DB::table('sb_transaction')
					->select('SBReport_TranDate')
					->where('sb_transaction.Accid',$row->Accid)
					->where("tran_reversed","=","NO")
					->where("particulars","!=","SB INTEREST")
					->where('ignore_for_service_charge','=','0')
					->orderBy('SBReport_TranDate','desc')
					->orderBy('Tranid','desc')
					->first();
					
//				print_r($last_tran);//exit();
//				echo "Accid:".$row->Accid;
				
				if(empty($last_tran)) {
					continue;
				}
				
				$last_tran_date = $last_tran->SBReport_TranDate;
				$diff = date_diff(date_create($last_tran_date),date_create($caculation_date));
				$diff_y = $diff->y;
				
				if($diff_y > 0) {
					$fn_data["acc_id"] = $row->Accid;
					$balance = $this->acc->get_account_balance($fn_data);
					
					$insert_arr = array(
											"service_charge_date"=>$caculation_date,
											"bid"=>$BID,
											"acc_type"=>1,
											"acc_id"=>$row->Accid,
											"acc_balance"=>$balance,
											"last_transaction_date"=>$last_tran_date
										);
					if($balance < MIN_BAL_TO_NOT_TO_CLOSE_ACC) {
						$insert_arr["service_charge_amount"] = $balance;
						if($balance <= 0) {
							$insert_arr["deleted"] = 1;
						}
					} else {
						$insert_arr["service_charge_amount"] = 10;
					}
					DB::table("service_charge")
						->insertGetId($insert_arr);
				}
				DB::table("createaccount")
					->where("Accid","=",$row->Accid)
					->update(["last_service_charge_calculated_till"=>$caculation_date]);
			}
		}
		
		public function calc_service_charge_pg($data)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$calculation_year = $data["year"];
			//$type = $data["type"];
			
			$caculation_date = "{$calculation_year}-03-31";
			
			$pigmiallocation = DB::table('pigmiallocation')
				->select(
							'PigmiAllocID'
						)
				->where('Bid','=',$BID)
				->where('Closed','=',"NO")
				->where('last_service_charge_calculated_till','<',$caculation_date)
				->get();
				
			foreach($pigmiallocation as $row) {
				$last_tran = DB::table('pigmi_transaction')
					->select('PigReport_TranDate')
					->where('pigmi_transaction.PigmiAllocID',$row->PigmiAllocID)
					->where("tran_reversed","=","NO")
//					->where("particulars","!=","SB INTEREST")
					->orderBy('PigReport_TranDate','desc')
					->orderBy('PigmiTrans_ID','desc')
					->first();
					
//				print_r($last_tran);//exit();
//				echo "Accid:".$row->PigmiAllocID;
				
				if(empty($last_tran)) {
					continue;
				}
				
				$last_tran_date = $last_tran->PigReport_TranDate;
				$diff = date_diff(date_create($last_tran_date),date_create($caculation_date));
				$diff_y = $diff->y;
				
				if($diff_y > 0) {
					$balance = DB::table("pigmiallocation")
						->where("PigmiAllocID","=",$row->PigmiAllocID)
						->value("Total_Amount");
					
					$insert_arr = array(
											"service_charge_date"=>$caculation_date,
											"bid"=>$BID,
											"acc_type"=>2,
											"acc_id"=>$row->PigmiAllocID,
											"acc_balance"=>$balance,
											"last_transaction_date"=>$last_tran_date
										);
					if($balance < MIN_BAL_TO_NOT_TO_CLOSE_ACC) {
						$insert_arr["service_charge_amount"] = $balance;
						if($balance <= 0) {
							$insert_arr["deleted"] = 1;
						}
					} else {
						$insert_arr["service_charge_amount"] = 10;
					}
					
					DB::table("service_charge")
						->insertGetId($insert_arr);
				}
				DB::table("pigmiallocation")
					->where("PigmiAllocID","=",$row->PigmiAllocID)
					->update(["last_service_charge_calculated_till"=>$caculation_date]);
			}
		}
		
		public function create_service_charge($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$type = $data["type"];
			$type_no = 0;
			
			//$tran_date = date("Y-m-d",strtotime("2018-03-31"));
			$tran_date = date("Y-m-d");
			$tran_time = date("H:i:s");
			
			switch($type) {
				case "SB":	$type_no = 1;break;
				case "PIGMY":	$type_no = 2;break;
			}
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$service_charge = DB::table("service_charge")
				->where("charge_collected","=","0")
				->where("bid","=",$BID)
				->where("acc_type","=",$type_no)
				->where("deleted","=",0)
				->get();
				
			$sv_amt_sum = 0;
			
			switch($type) {
				case "SB":	
							foreach($service_charge as $row) {
								$insert_data1["Accid"] = $row->acc_id;
								$insert_data1["AccTid"] = "1";
								$insert_data1["TransactionType"] = "DEBIT";
								$insert_data1["particulars"] = "SERVICE CHARGE";
								$insert_data1["Amount"] = $row->service_charge_amount;
								//$insert_data1["CurrentBalance"] = $credit_acc["CurrentBalance"];
								$insert_data1["tran_Date"] = $this->dmy($tran_date);
								$insert_data1["SBReport_TranDate"] = $tran_date;
								$insert_data1["Time"] = date("Y-m-d H:i:s",strtotime($tran_date));
								$insert_data1["Month"] = date("d",strtotime($tran_date));
								$insert_data1["Year"] = date("Y",strtotime($tran_date));
								//$insert_data1["Total_Bal"] = $credit_acc["Total_Bal"];
								$insert_data1["Bid"] = $BID;
								$insert_data1["Payment_Mode"] = "ADJUSTMENT";
								$insert_data1["CreatedBy"] = $UID;
								$insert_data1["tran_reversed"] = "no";
								$insert_data1["LedgerHeadId"] = 38;
								$insert_data1["SubLedgerId"] = 42;
								$insert_data1["ignore_for_service_charge"] = 1;
								$insert_data1["service_charge"] = 1;
								DB::table("sb_transaction")
									->insertGetId($insert_data1);
								DB::table("service_charge")
									->where("service_charge_id","=",$row->service_charge_id)
									->update(["charge_collected"=>1]);
									
								if($row->acc_balance < MIN_BAL_TO_NOT_TO_CLOSE_ACC) {
									echo "acc_id:{$row->acc_id} - closed <br />\n";
									DB::table("createaccount")->where("Accid","=",$row->acc_id)->update(["Closed"=>"YES"]);
								}
								$sv_amt_sum += $row->service_charge_amount;
							}
							
							break;
				case "PIGMY":	
							foreach($service_charge as $row) {
								$pigmiallocation = DB::table("pigmiallocation")
									->select()
									->where("PigmiAllocID","=",$row->acc_id)
									->first();
								$new_total_amt = $pigmiallocation->Total_Amount - $row->service_charge_amount;
								$insert_data = array(
														"PigmiTypeid"=>$pigmiallocation->PigmiTypeid,
														"Trans_Date"=>$tran_date,
														"PigReport_TranDate"=>$tran_date,
														"Trans_Time"=>$tran_time,
														"Agentid"=>$pigmiallocation->Agentid,
														"PigmiAllocID"=>$pigmiallocation->PigmiAllocID,
														"Transaction_Type"=>"DEBIT",
														//"Current_Balance"=>$pigmiallocation->Total_Amount,
														"Amount"=>$row->service_charge_amount,
														//"Total_Amount"=>$new_total_amt,
														"Particulars"=>"SERVICE CHARGE",
														"PgmPayment_Mode"=>"ADJUSTMENT",
														"Month"=>date("m",strtotime($tran_date)),
														"Year"=>date("Y",strtotime($tran_date)),
														"Bid"=>$row->bid,
														"CreatedBy"=>$UID,
														"LedgerHeadId"=>"",
														"SubLedgerId"=>"",
														"ignore_for_service_charge"=>"1",
														"service_charge"=>"1",
													);
								DB::table("pigmi_transaction")
									->insertGetId($insert_data);
								DB::table("service_charge")
									->where("service_charge_id","=",$row->service_charge_id)
									->update(["charge_collected"=>1]);
									
								if($row->acc_balance < MIN_BAL_TO_NOT_TO_CLOSE_ACC) {
									DB::table("pigmiallocation")->where("PigmiAllocID","=",$row->acc_id)->update(["Closed"=>"YES"]);
								}
								
								//DB::table("pigmiallocation")->where("PigmiAllocID","=",$row->acc_id)->update(['Total_Amount'=>$new_total_amt]);
								
								$sv_amt_sum += $row->service_charge_amount;
							}
							
							break;
			}
			$table = "income";
			$insert_array = array(
									"Income_Head_lid"		=>	85,
									"Income_SubHead_lid"	=>	88,
									"Income_date"			=>	$tran_date,
									"Bid"					=>	$BID,
									"Income_pay_mode"		=>	"ADJUSTMENT",
									"Income_amount"			=>	$sv_amt_sum,
									"Income_Particulars"	=>	"{$type} SERVICE CHARGE ON ".date("31-03-Y"),
									"Income_ExpenseBy"		=>	$UID,
									//"Income_Expence_PamentVoucher"	=>	,
									"LedgerHeadId"			=>	85,
									"SubLedgerId"			=>	88
								);
			DB::table($table)
				->insertGetId($insert_array);
		}
		
		public function dmy($date)
		{
			return date("d-m-Y",strtotime($date));
		}
		
		public function calc_service_charge_alrdy_cal($data)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$type = $data["type"];
			$paid_status = $data["paid_status"];
			
			$return_data["service_charge"] = array();
			$return_data["total_amount"] = 0;
			switch($type) {
				case "SB":	
							$return_data["service_charge"] = DB::table('service_charge')
								->select(
												"service_charge_date as date",
												"AccNum as acc_no",
												"Old_AccNo as old_acc_no",
												"service_charge_amount",
												"last_transaction_date",
												"charge_collected"
										)
								->join("createaccount","createaccount.Accid","=","service_charge.acc_id")
								->where("acc_type","=",1)
								->where("service_charge.bid","=",$BID)
								->where("charge_collected","=",$paid_status)
								->where("service_charge.deleted","=",0)
								->orderBy("Accid","asc")
								->get();
								
							foreach($return_data["service_charge"] as $row) {
								$return_data["total_amount"] += $row->service_charge_amount;
							}
							break;
				case "PIGMY":	
							$return_data["service_charge"] = DB::table('service_charge')
								->select(
												"service_charge_date as date",
												"PigmiAcc_No as acc_no",
												"old_pigmiaccno as old_acc_no",
												"service_charge_amount",
												"last_transaction_date",
												"charge_collected",
												"FirstName",
												"MiddleName",
												"LastName"
										)
								->join("pigmiallocation","pigmiallocation.PigmiAllocID","=","service_charge.acc_id")
								->join("user","user.Uid","=","pigmiallocation.Agentid")
								->where("acc_type","=",2)
								->where("service_charge.bid","=",$BID)
								->where("charge_collected","=",$paid_status)
								->where("service_charge.deleted","=",0)
								->get();
								
							foreach($return_data["service_charge"] as $row) {
								$return_data["total_amount"] += $row->service_charge_amount;
							}
							break;
			}
			
			return($return_data);
		}
		
	}
?>
