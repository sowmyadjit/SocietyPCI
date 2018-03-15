<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\SmsModel;
	
	class API_Model extends Model
	{
		
		protected $table = 'customer';
		public $smsmodel;
		public function __construct()
		{
			$this->smsmodel=new SmsModel;
		}
		public static function getcustomer($id)
		{
			return DB::table('customer')->select('FirstName','MiddleName','LastName','Custid','customer.Uid')
			->selectRaw('CONCAT(PigmiAcc_No,"-",old_pigmiaccno) as PigmiAcc_No')
			->leftJoin('pigmiallocation','pigmiallocation.UID','=','customer.Uid')
			->where('pigmiallocation.Agentid','=',$id)
			->get();
		}
		
		public function getpigmydetails($id)
		{
			$r=explode('-',$id);
			//print_r($r);
			return DB::table('pigmiallocation')->select('Opening_Balance','Total_Amount','PigmiTypeid')
			->where('PigmiAcc_No','=',$r[0])
			->get();
		}
		public function pigmytransaction($id)
		{	
		
			date_default_timezone_set('Asia/Kolkata');
			
			
			$s=null;
			$dte=date('d-m-Y');
			$reportdte=date('Y-m-d');
			$pttme=date('H:i:s');
			$mnt=date('m');
			$year=date('Y');
			$x=$id['accNum'];
			$r=explode('-',$x);
			$allid =DB::table('pigmiallocation')->select('PigmiAllocID')
			->where('PigmiAcc_No','=',$r[0])
			->first();
			$pigmiallcoid=$allid->PigmiAllocID;
			$pgmmode=$id['pgmpaymode'];
			
			if($pgmmode=="Cash")
			{
				$state="CLEARED";
				$bal=0;
				$totbal=$id['pgbalamt'];
				
				DB::table('pigmiallocation')->where('PigmiAcc_No',$r[0])
				->update(['Total_Amount'=>$totbal]);
				
			}
			else if($pgmmode=="Cheque")
			{
				$state="UNCLEARED";
				$bal=$id['pgbalamt'];
				$totbal=$id['curbal'];
				
			}									
			
			
			$Agen=$id['agtid'];
			$TranDate=$reportdte;
			$TempEntryCheck = DB::table('pending_pigmy')->select('PendPigmy_AgentUid','PpId','PendPigmy_PendingAmount')
			->where('pending_pigmy.PendPigmy_AgentUid','=',$Agen)
			->where('pending_pigmy.PendPigmy_CollectionDate','=',$TranDate)
			->first();
			
			if(empty($TempEntryCheck))
			{
				DB::table('pending_pigmy')->insertGetId(['PendPigmy_AgentUid'=>$id['agtid'],'PendPigmy_CollectionDate'=>$TranDate,'PendPigmy_PendingAmount'=>$id['pgamount'],'PendPigmy_Bid'=>$id['pgmbranch']]);
				
			}
			else
			{
				
				$statval="PENDING";
				$EntryCheck	= $TempEntryCheck->PendPigmy_AgentUid;				
				$PpId	= $TempEntryCheck->PpId;				
				$Pend	= $TempEntryCheck->PendPigmy_PendingAmount;	
				$Amtx = $id['pgamount'];
				
				$StatCh=DB::table('pending_pigmy')->select('PendPigmy_Status')
				->where('PpId','=',$PpId)
				->first();
				
				if($StatCh=="CLEARED")
				{
					$statval="PENDING";
				}
				
				
				$PendingAmt = $Pend + $Amtx;
				
				DB::table('pending_pigmy')->where('PpId',$PpId)
				->update(['PendPigmy_PendingAmount'=>$PendingAmt,'PendPigmy_Status'=>$statval]);
				
			}
			
			$pid= DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$dte,'Trans_Time'=>$pttme,'PigReport_TranDate'=>$reportdte,'Agentid'=>$id['agtid'],'PigmiAllocID'=>$pigmiallcoid,'Current_Balance'=>$id['curbal'],'Transaction_Type'=>"CREDIT",'Amount'=>$id['pgamount'],'Particulars'=>$id['ptpar'],'PigmiTypeid'=>$id['acctno'],'Total_Amount'=>$totbal,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>$id['pgmpaymode'],'PgmCheque_Number'=>$id['pgmchequeno'],'PgmCheque_Date'=>$id['pgmchdate'],'PgmCleared_State'=>$state,'PgmUncleared_Bal'=>$bal,'PgmBank_Name'=>$id['pgmbankname'],'PgmBank_Branch'=>$id['pgmbankbranch'],'PgmIFSC_Code'=>$id['pgmifsccode'],'Bid'=>$id['pgmbranch'],'CreatedBy'=>$id['agtid']]);
			
			$msg_dep_amount=$id['pgamount'];
			$msg_totbal=$totbal;
			$ac_det=DB::table('pigmiallocation')
			->where('PigmiAllocID','=',$pigmiallcoid)
			->join('user', 'user.Uid', '=', 'pigmiallocation.Uid')
			->join('address', 'address.Aid', '=', 'user.Aid')
			->select('pigmiallocation.PigmiAcc_No','address.MobileNo','user.FirstName','user.MiddleName','user.LastName')
			->first();
			//print_r($id['acctno']);
			//print_r($ac_det);
			$name=$ac_det->FirstName.' '.$ac_det->MiddleName.' '.$ac_det->LastName;
			$mobile=$ac_det->MobileNo;
			$acn=$ac_det->PigmiAcc_No;
			$acn=str_replace("PCIS","****",$acn);
			$acn=str_replace("PG","02**00",$acn);
			$message='Dear '.$name.', Amount of ';
			$message.=$msg_dep_amount;
			$message.=' has been received towards pigmy A/C ';
			$message.=$acn;
			$message.='. Available balance is ';
			$message.=$msg_totbal;
			$message.='. Regards PCI Society.';
			//echo $mobile;
			//echo '</br>'.$message;
			$this->smsmodel->SendMSG(60451,$mobile,$message);// comment this to disable SMS FOR PIGMY
			
			return $pid;
			/*if(empty($s))
				{
				return false;
				}
				else
				{
				return true;
			}*/
			
			
			
			
		}
		public function agentprofile($id)
		{
			return DB::table('user')->select('user.FirstName','user.MiddleName','user.LastName','BName','Gender','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo','LoginName')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('user.Uid','=',$id)
			->first();
		}
		public function changepass($id)
		{
			$newpass=$id['newpass'];
			$agentid=$id['uid'];
			return DB::table('user')->where('Uid',$agentid)
			->update(['Password'=>$newpass]);
		}
		public function pigmycustreport($id)
		{
			$acc=$id['accnum'];
			$r=explode('-',$acc);
			$start=$id['fromdate'];
			$end=$id['todate'];
			$piaid1=DB::table('pigmiallocation')->select('PigmiAllocID')
			->where('PigmiAcc_No','=',$r[0])
			->first();
			
			
			
			
			$piaid=$piaid1->PigmiAllocID;								
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmiallocation.Total_Amount')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->where('pigmi_transaction.PigmiAllocID',$piaid)
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->where('pigmi_transaction.Particulars','!=',"Opening Balance")
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->get();
			
			return $id;
		}
		public function pigmyagentreport($id)
		{
			$uid=$id['uid'];
			$start=$id['fromdate'];
			$end=$id['todate'];
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmiallocation.Total_Amount','FirstName','MiddleName','LastName')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->where('pigmi_transaction.Agentid',$uid)
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->where('pigmi_transaction.Particulars','!=',"Opening Balance")
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->get();
			return $id;
		}
	}
