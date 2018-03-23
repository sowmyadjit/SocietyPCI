<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\RoundModel;
	class InterestModel extends Model
	{
		
		protected $table='pigmi_interest';
		public $roundamt;
		public function __construct()
		{
			$this->roundamt=new RoundModel;
		}
		//Pigmi Interest Calculation
		var $detail;
		
		public function pigmiintcalc($id)
		{
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
			
			//	print_r($monthamt);
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
			
			$detailcount=$this->getdtlcount($acno,$sdate);
			
			$amtpay=$totalamount+$totamt;
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
		}
		
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
			->where('createaccount.Accid','=',$id)
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
			$interestcount=$this->getrdinterestcount($acno);
			if($duecount1>0)
			{
				$getopbal=$this->getopngbal($acno,$sdate,$edate);
				$opbal=$getopbal->opening_blance;
				$due=($opbal*5)/1000;
				$dueamt=$due*$duecount1;
				$dueamt=$this->roundamt->Roundall($dueamt);
				$rdamt1=($interestamt-$dueamt);
				$rdamt=abs($rdamt1);//interest amt
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
			->selectRaw('sum(rd_transaction.RD_Total_Bal) as sum,rd_transaction.RD_Month')
			->lists('sum','rd_transaction.RD_Month');
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
					$rd_transaction[$i] = $rd_transaction[$j];
				}
				if(++$i == 13){
					$i = 1;
				}
			}
//			print_r($rd_transaction);//exit();
/****edit***/
			return $rd_transaction;
		}
		
		function FDwithdraw($id)
		{
			$dte=date('Y-m-d');
			$accno=DB::table('fdallocation')->select('Fd_CertificateNum')
			//->where('FdReport_MatureDate','<=',$dte)
			->where('Fdid','=',$id)
			->first();
			//foreach($accno as $acc)
			//{
			$fdaccnnum=$accno->Fd_CertificateNum;
			DB::table('fdallocation')->where('Fd_CertificateNum',$fdaccnnum)
			->update(['Fd_Withdraw'=>"YES",'Closed'=>"YES"]);
			//	}
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
		
		
	}
?>
