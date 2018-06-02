<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use File;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	
	class PigmiAllocationModel extends Model
	{
		protected $table='pigmiallocation';
		
		public function __construct() {
			$this->rv_no = new ReceiptVoucherController;
		}
		
		public function insert($id)
		{
			$dte=date('d-m-Y');
			$reportdte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			//$startdate=$id['pgsdte'];
			$tempsDate = explode('/',$id['pgsdte']);
			$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			$sdate=date('Y-m-d',strtotime($consDate));
			//$enddate=$id['pgedte'];
			
			$tempeDate = explode('/',$id['pgedte']);
			$coneDate = $tempeDate[2]."-".$tempeDate[1]."-".$tempeDate[0];
			
			$edate=date('Y-m-d',strtotime($coneDate));
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
				$BID=$uname->Bid;
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid','BCode')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			$bcode=$udetail->BCode;
			//$b=$udetail->BName;
			$bid=$udetail->Bid;
			$u=$udetail->Uid;
			//$bcode=$id['branch'];
		//	$bcode=$uname->BCode;
			$opbal=$id['opngbal'];
			//$bid=$id['branchid'];
			$countinc=1;
			/*$countpal=DB::table('pigmiallocation')
			->where('PigmiAcc_No','like','%'.$bcode.'%')
			->count();
			
			if($countpal=="")
			{
				$paccno="PCISPG".$bcode.$countinc;
			}
			else
			{
				$paccno="PCISPG".$bcode.($countpal+1);
			}*/
			
			
/*			$maxid=DB::table('pigmiallocation')->where('Bid','=',$bid)->max('PigmiAllocID');
			$accnum1=DB::table('pigmiallocation')->select('PigmiAcc_No')->where('PigmiAllocID','=',$maxid)->first();
			$accnum=$accnum1->PigmiAcc_No;
			print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
				$paccno2=$matches[2];
				
				$paccno3=intval($paccno2)+1;
				$paccno="PCISPG".$bcode.$paccno3;*/
				
	/************ NEXT PIGMY ACCOUNT NUMBER ************/
			$allocation_list = DB::table("pigmiallocation")
			->select("PigmiAcc_No")
				->where("Bid",$BID)
				->get();
			
			$max_number = 0;
			foreach($allocation_list as $row_all_list) {
				$temp_number = preg_replace('/[^0-9]/', '', $row_all_list->PigmiAcc_No);
				$max_number = ($temp_number > $max_number) ? $temp_number: $max_number;
			}
			//echo "max: {$max_number}\n<br />";
			$new_max_number = $max_number + 1;
			$new_allocation_number = "PCISPG{$bcode}{$new_max_number}";
			//echo "new all no: {$new_allocation_number}\n<br />"; exit();
			$paccno = $new_allocation_number;
	/************************/
				
				
				$agentid=$id['agid'];
				$amt=$id['opngbal'];
			$paid = DB::table('pigmiallocation')->insertGetId(['PigmiAcc_No'=> $paccno,'PigmiTypeid'=>$id['pigmid'],'UID'=>$id['uid'],'Agentid'=>$id['agid'],'AllocationDate'=>$reportdte,'StartDate'=>$sdate,'EndDate'=>$edate,'Commission'=>$id['pgcmsn'],'Opening_Balance'=>$id['opngbal'],'Total_Amount'=>$id['opngbal'],'Bid'=>$BID]);
			
			$id=DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$dte,'PigReport_TranDate'=>$reportdte,'Agentid'=>$id['agid'],'PigmiAllocID'=>$paid,'Current_Balance'=>$id['opngbal'],'Amount'=>$id['opngbal'],'PigmiTypeid'=>$id['pigmid'],'Transaction_Type'=>"Credit",'Particulars'=>"Opening Balance",'Total_Amount'=>$id['opngbal'],'PgmCleared_State'=>"CLEARED",'Bid'=>$BID,'CreatedBy'=>$u,'Month'=>$mnt,'Year'=>$year,'Pigmy_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"102",'PgmPayment_Mode'=>"CASH"]);
			
			//echo $b;
			
			/*$inhand=DB::table('cash')->select('InHandCash')
			->where('BID','=',$bid)
			->first();
		    $inhandcash=$inhand->InHandCash;
			
		    $amt=$inhandcash+$opbal;
			
			
			DB::table('cash')->where('BID',$bid)
			->update(['InHandCash'=>$amt]);
			
			
			$trandate=date('Y-m-d');
			$totcash=$inhandcash+$opbal;
			
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to Pigmi Account",'InhandTrans_Cash'=>$opbal,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash,'Total_InhandCash'=>$totcash]);*/
			
			
			$data1=DB::table('pending_pigmy')->where('PendPigmy_AgentUid','=',$agentid)
					->where('PendPigmy_CollectionDate','=',$reportdte)
					->count('PpId');
					
					if($data1==0)
					{
						DB::table('pending_pigmy')->insertGetId(['PendPigmy_AgentUid'=>$agentid,'PendPigmy_CollectionDate'=>$reportdte,'PendPigmy_PendingAmount'=>$amt,'PendPigmy_Bid'=>$bid]);
						
					}
					else
					{
						$totamt1=DB::table('pending_pigmy')->select('PendPigmy_PendingAmount')
						->where('PendPigmy_AgentUid','=',$agentid)
						->where('PendPigmy_CollectionDate','=',$reportdte)
						->first();
						$totamt=$totamt1->PendPigmy_PendingAmount;
						$totalamount=$totamt+$amt;
						
						DB::table('pending_pigmy')->where('PendPigmy_AgentUid','=',$agentid)
						->where('PendPigmy_CollectionDate','=',$reportdte)
						->update(['PendPigmy_PendingAmount'=>$totalamount,'PendPigmy_Status'=>"PENDING"]);
						
					}
			
			return $id;
		}
		
		public function GetAlocatedAgent($alcg)
		{ 
			return DB::table('user')
			//->join('pigmi_transaction','pigmi_transaction.Agentid','=','user.Uid')
			->select(DB::raw('user.Uid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))->distinct()
			->where('user.FirstName','like','%'.$alcg.'%')
			->where('user.Did','=','4')
			->get();
		}
		public function GetAlocatedAgent1($alcg)
		{
			return DB::table('user')
			
			->select(DB::raw('user.Uid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->where('user.Did','=',"4")
			->get();
		}
		public function getAccountnum($pigmiallocation)
		{
			$pigmiallocation=DB::table('pigmiallocation')
			->select('PigmiAcc_No','PigmiAllocID','old_pigmiaccno')
			->where('Agentid','=',$pigmiallocation)
			->where('Status','=',"AUTHORISED")
			->where('Closed','=',"NO")
			->get();
			return $pigmiallocation;
		}
		
		public function getAcctholder($id)
		{
			/*$query1=DB::table('pigmi_transaction')
				->where('pigmi_transaction.PigmiAllocID','=',$id)
				->max('pigmi_transaction.PigmiTrans_ID');
				
				return DB::table('pigmi_transaction')
				->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
				->join('user','pigmiallocation.Uid','=','user.Uid')
				->join('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
				//->select('user.FirstName','pigmitype.Pigmi_Type','pigmi_transaction.Total_Amount')
				->select('user.FirstName','pigmitype.Pigmi_Type','pigmi_transaction.Total_Amount','pigmitype.PigmiTypeid')
				->where('pigmi_transaction.PigmiAllocID','=',$id)
				->where('pigmi_transaction.PigmiTrans_ID','=',$query1)
			->first();*/
			
			return DB::table('pigmiallocation')
			->join('user','pigmiallocation.Uid','=','user.Uid')
			->join('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('user.FirstName','pigmitype.Pigmi_Type','pigmiallocation.Total_Amount','pigmitype.PigmiTypeid','pigmiallocation.PigmiAllocID')
			->where('PigmiAllocID','=',$id)
			->first();
		}
		public function getallocdetail()
		{
			/*$query2=DB::table('user')
				->join('pigmiallocation','pigmiallocation.Agentid','=','user.Uid')
				->select('user.FirstName')
			->get();*/
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			return DB::table('pigmiallocation')
			->join('user','pigmiallocation.Uid','=','user.Uid')
			->join('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('user.FirstName','user.MiddleName','user.LastName','pigmitype.Pigmi_Type','pigmiallocation.AllocationDate','pigmiallocation.StartDate','pigmiallocation.EndDate','pigmiallocation.PigmiAllocID','pigmiallocation.PigmiTypeid','pigmiallocation.PigmiAcc_No','pigmiallocation.old_pigmiaccno','pigmiallocation.Total_Amount','user.Uid')
			->where('pigmiallocation.Bid','=',$bid)
			->where('Status','=',"AUTHORISED")
			->get();
		}
		
		
		public function GetSeachedpigmyAcc($q)
		{
			return DB::select("SELECT `PigmiAllocID` as id, CONCAT(`PigmiAllocID`,'-',`PigmiAcc_No`) as name FROM `pigmiallocation` where `PigmiAcc_No` LIKE '%".$q."%' ");
			
			
		/*	$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('pigmiallocation')
			->select(DB::raw('PigmiAllocID as id,CONCAT(`PigmiAcc_No`,"-",`old_pigmiaccno`,"  ",`FirstName` ," ",`MiddleName`," ",`LastName`) as name'))
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			
			->where('user.Bid','=',$BranchId)
			->where('Closed','=',"NO")
			->get();*/
			
		}
		public function GetpigmyAcc($q)
		{
			return DB::select("SELECT `PigmiAllocID` as id, CONCAT(`old_pigmiaccno`,'-',`PigmiAcc_No`) as name FROM `pigmiallocation` where `PigmiAcc_No` LIKE '%".$q."%' ");
			
			/*$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('pigmiallocation')
			->select(DB::raw('PigmiAllocID as id,CONCAT(`PigmiAcc_No`,"-",`old_pigmiaccno`,"  ",`FirstName` ," ",`MiddleName`," ",`LastName`) as name'))
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->where('user.Bid','=',$BranchId)
			->where('Closed','=',"NO")
			->get();*/
			
		}
		
		public function Getbranchid($branch)
		{
			$id=DB::table('branch')
			->select('BCode')
			->where('Bid','=',$branch)
			->first();
			return $id;
		}
		
		public function GetPigmyNumForLoanAlloc($q)
		{
			
			
			return DB::table('pigmiallocation')
			//	->select(DB::raw('PigmiAllocID as id, CONCAT(`PigmiAllocID`,"-",`PigmiAcc_No`) as name'))
			->select(DB::raw('PigmiAllocID as id, PigmiAcc_No as name'))
			->where('Status','=',"AUTHORISED")
			->where('Loan_Allocated','=',"NO")
			->where('Closed','=',"NO")
			->get();		
		}
		
		public function PigmiPendingAmtView()
		{
		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('pending_pigmy')
			->join('user','user.Uid','=','pending_pigmy.PendPigmy_AgentUid')
			->join('address','address.Aid','=','user.Aid')
			->join('branch','branch.Bid','=','pending_pigmy.PendPigmy_Bid')
			->select('user.FirstName','user.MiddleName','user.LastName','PendPigmy_AgentUid','PpId','PendPigmy_PendingAmount','PendPigmy_Bid','PendPigmy_CollectionDate','PendPigmy_Status','BName','MobileNo')
			->where('PendPigmy_Status','=',"PENDING")
			->where('PendPigmy_Bid','=',$BranchId)
			->paginate(10);
		}
		
		public function ReceivePigmiPendingAgentData($id)
		{
			
			$val = DB::table('pending_pigmy')
			->join('user','user.Uid','=','pending_pigmy.PendPigmy_AgentUid')
			->join('address','address.Aid','=','user.Aid')
			->join('branch','branch.Bid','=','pending_pigmy.PendPigmy_Bid')
			->select('user.FirstName','user.MiddleName','user.LastName','PendPigmy_AgentUid','PpId','PendPigmy_PendingAmount','PendPigmy_Bid','PendPigmy_CollectionDate','PendPigmy_Status','BName','MobileNo')
			->where('PpId',$id)
			->get();
			
			return $val;
		}
		
		public function ReceivePigmyPendingAmt($id)
		{
			$PPrPpId=$id['PPrPpId'];
			$PPrPaidAmt=$id['PPrPaidAmt'];
			$PPrPendingBal=$id['PPrPendingBal'];
			$PPrPendingAmt=$id['PPrPendingAmt'];
			
			$ReceivedDte=date('Y-m-d');
			
			if($PPrPendingAmt==$PPrPaidAmt)
			{
				$Stat="CLEARED";
				
			}
			else{
				$Stat="PENDING";
			}
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
			$inhandcash1=$inhandcashh->InHandCash;
			$x=$inhandcash1+$PPrPaidAmt;
			DB::table('cash')->where('BID','=',$BID)
			->update(['InHandCash'=>$x]);
			
			$PrevReceived = DB::table('pending_pigmy')->select('PenPigmy_AmountReceived')
			->where('PpId',$PPrPpId)
			->first();
			
			$PrevReceivedAmt=$PrevReceived->PenPigmy_AmountReceived;
			
			$ReceivedAmt = (floatval($PrevReceivedAmt)+floatval($PPrPaidAmt));
			
			DB::table('pending_pigmy')->where('PpId',$PPrPpId)
			->update(['PendPigmy_PendingAmount'=>$PPrPendingBal,'PenPigmy_AmountReceived'=>$ReceivedAmt,'PendPigmy_ReceivedDate'=>$ReceivedDte,'PendPigmy_Status'=>$Stat,'PenPigmy_ReceivedBy'=>$UID]);
			
				/***********/
				$fn_data["rv_payment_mode"] = "CASH";
				$fn_data["rv_transaction_id"] = $PPrPpId;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::AGENT_COLLECTION;//constant AGENT_COLLECTION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $ReceivedDte;
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			
		}
		
		public function GetSearchPigmyAccWithOldAcc($q) 
		{
			
			return DB::select("SELECT `PigmiAllocID` as id, CONCAT(`old_pigmiaccno`,'/',`PigmiAcc_No`,':',CASE Closed
			WHEN 'YES' THEN 'Closed'
			WHEN 'NO' THEN 'Active'
			ELSE Closed
            END) as name FROM `pigmiallocation` where `PigmiAcc_No` LIKE '%PG%' ");
			
		}
		
		public function SearchPigmy($q)//M 19-4-16 For pigmiallocation.blade to pigmy accounts
		{
			if(Auth::user())
			$uname= Auth::user();
			$bid=$uname->Bid;
			
			return DB::table('pigmiallocation')
			->select(DB::raw('PigmiAllocID as id, CONCAT(user.`FirstName`,"  ",user.`MiddleName`,"  ",user.`LastName`,"  , ",pigmiallocation.`PigmiAcc_No`,"  /  ",pigmiallocation.`old_pigmiaccno`) as name'))
			->Join('user','user.Uid','=','pigmiallocation.Uid')
			->where('pigmiallocation.Bid','=',$bid)
			->get();
		}
		
		public function GetSearchData($id)//M 19-4-16 For pigmiallocation.blade to pigmy accounts
		{
			return DB::table('pigmiallocation')
			->join('user','pigmiallocation.Uid','=','user.Uid')
			->join('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('user.FirstName','pigmitype.Pigmi_Type','pigmiallocation.AllocationDate','pigmiallocation.StartDate','pigmiallocation.EndDate','pigmiallocation.PigmiAllocID','pigmiallocation.PigmiTypeid','pigmiallocation.PigmiAcc_No','pigmiallocation.old_pigmiaccno','pigmiallocation.Total_Amount')
			->where('PigmiAllocID','=',$id)
			->get();
		}
		public function ViewPigallocEdit($id)
		{
			return DB::table('pigmiallocation')->select('AllocationDate','StartDate','EndDate','Total_Amount','PigmiAcc_No','old_pigmiaccno','FirstName','MiddleName','LastName','PigmiAllocID')
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->where('PigmiAllocID','=',$id)
			->first();
			
		}
		
		public function editpigmialloc($id)
		{
			
			$allid=$id['alocid'];
			$allocdate=$id['cd'];
			$startdate=$id['sd'];
			$enddate=$id['ed'];
			$totamount=$id['ta'];
			echo $allid;
			$Res =	DB::table('pigmiallocation')->where('PigmiAllocID',$allid)
			->update(['AllocationDate'=> $allocdate,'StartDate'=> $startdate,'EndDate'=> $enddate,'Total_Amount'=> $totamount]); 
			return $Res;
			
		}
		
		public function PigmiAccountForAgent($q)//M 20-5-16 For AgentPigmyReport.blade TypeAhead
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			return DB::table('pigmiallocation')
			->select(DB::raw('PigmiAllocID as id, CONCAT(`PigmiAcc_No`," - ",`old_pigmiaccno`," | ",`FirstName`," ",`MiddleName`," ",`LastName`," : ",CASE Closed
			WHEN "YES" THEN "Closed"
			WHEN "NO" THEN "Active"
			ELSE Closed
            END) as name'))
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->where('pigmiallocation.Agentid',$UID)
			->get();
		}
		
		public function PigmyCustomerList()//M18-5-16 FOR AgenPigmyEntryHome.blade
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			//print_r($UID);
			
			$id = DB::table('pigmiallocation')
			->where('pigmiallocation.Agentid',$UID) //uncomment this line at starting
			->leftJoin('user','pigmiallocation.Uid','=','user.Uid')
			->leftJoin('address','address.Aid','=','user.Uid')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('user.FirstName','user.MiddleName','user.LastName','address.MobileNo','BName','pigmitype.Pigmi_Type','pigmiallocation.AllocationDate','pigmiallocation.StartDate','pigmiallocation.EndDate','pigmiallocation.PigmiAllocID','pigmiallocation.PigmiTypeid','pigmiallocation.PigmiAcc_No','pigmiallocation.old_pigmiaccno','pigmiallocation.Total_Amount')
			//->get();
			->paginate(20);
			//print_r($id);
			return $id;
			
			
		}
		public function GetSeachedpigmyAccinterest($q)
		{
			//return DB::select("SELECT `PigmiAllocID` as id, CONCAT(`PigmiAllocID`,'-',`PigmiAcc_No`) as name FROM `pigmiallocation` where `PigmiAcc_No` LIKE '%".$q."%' ");
			
			$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			return DB::table('pigmiallocation')
			->select(DB::raw('PigmiAllocID as id,CONCAT(`PigmiAcc_No`,"-",`old_pigmiaccno`,"  ",`FirstName` ," ",`MiddleName`," ",`LastName`) as name'))
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			
			->where('user.Bid','=',$BranchId)
			->where('pigmiallocation.Closed','=',"NO")
			//->where('EndDate','<',$dte)
			->get();
			
		}
		public function extraamt()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			return DB::table('extraagentamount')->select('FirstName','MiddleName','LastName','BName','ExtraAmt_AccountNum','ExtraAmt_Amount','ExtraAmt_Date','ExtraAmt_Id')
			->join('user','user.Uid','=','extraagentamount.ExtraAmt_AgentId')
			->join('branch','branch.Bid','=','extraagentamount.ExtraAmt_Bid')
			->where('ExtraAmt_Status',"PENDING")
			//->where('ExtraAmt_Bid',$BID)
			->get();
		}
		public function paybackamt($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$dte=date('Y-m-d');
			DB::table('extraagentamount')->where('ExtraAmt_Id',$id)
			->update(['ExtraAmt_Status'=>"PAID",'ExtraAmt_Paybackdate'=>$dte,'ExtraAmt_PayBackBy'=>$UID]);
			
		}
		
		
		public function changeallcust($id)
		{
			$agent1=$id['agent1'];
			$agent2=$id['agent2'];
			
			DB::table('pigmiallocation')->where('Agentid',$agent1)
			->update(['Agentid'=>$agent2]);
			
		}
		public function changesinglecust($id)
		{
			$agent1=$id['agent1'];
			return DB::table('pigmiallocation')->select('PigmiAllocID','PigmiAcc_No','old_pigmiaccno','Total_Amount','FirstName','MiddleName','LastName')
			->leftJoin('user','user.Uid','=','pigmiallocation.UID')
			->where('Agentid',$agent1)
			->where('Closed',"NO")
			->get();
			
		}
		public function changesinglecustcheck($id)
		{
			$agent1=$id['agent1'];
			$agent2=$id['agent2'];
			$allocid=$id['alocid'];
			$x=$id['loopid'];
			$z=0;
			for($i=1;$i<=$x;$i++)
			{
				$acid=explode(",",$allocid);
				
				
				$y=$acid[$z];
				DB::table('pigmiallocation')->where('PigmiAllocID',$y)
				->update(['Agentid'=>$agent2]);
				$z++;
				
			}
		}
		public function getAllocatesaraparalist($alcg)
		{
		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			
			$BID=$uname->Bid;
			
			return DB::table('user')
			//->join('pigmiallocation','pigmiallocation.Agentid','=','user.Uid')
			->select(DB::raw('user.Uid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))->distinct()
			->where('user.FirstName','like','%'.$alcg.'%')
			->where('user.Did','=',"8")
			->where('user.Bid','=',$BID)
			->get();
		}
		public function get_agents()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$ret_data = [];
			$ret_data = DB::table("user")
				->where("Bid",$BID)
				->where("Did",4)
				->get();
			return $ret_data;
		}
	}
?>