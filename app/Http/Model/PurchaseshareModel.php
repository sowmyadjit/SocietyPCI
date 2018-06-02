<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	
	class PurchaseshareModel extends Model
	{
		//
		protected $table='purchaseshare'; 
		
		public function __construct() {
			$this->rv_no = new ReceiptVoucherController;
		}
		
		public function getmaxcount()
		{
			$countmx=DB::table('purchaseshare')->count();
			if($countmx==0)
			{
				$id=0;
			}
			else
			{
				$id=DB::table('purchaseshare')->max('PURSH_Shmaxcount');
			}
			return $id;
		}
		
		public function insert($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			//$b=$udetail->BName;
			$bid=$udetail->Bid;
			
			$countpr=DB::table('purchaseshare')->count();
			if($countpr==0)
			{
				$certid=1;
			}
			else
			{
				$certid=$countpr+1;
			}
			$puramt=$id['totamt'];
			$noofshare=$id['totshare'];
			$shareprice=$id['shprice'];
			$shareval=$id['shamt'];
			$s1=$noofshare*$shareprice;
			$s2=$noofshare*$shareval;
			$s3=$s1+$s2;
			$purchaseshare_id = DB::table('purchaseshare')->insertGetId(['Bid'=>$BID,'PURSH_Memid'=> $id['mid'],'PURSH_Shrclass'=>$id['shclass'],'PURSH_Shareamt'=>$id['shamt'],'PURSH_Memshareid'=>$id['memshr'],'PURSH_Certfid'=>$certid,'PURSH_Shareprice'=>$id['shprice'],'PURSH_Shmaxcount'=>$id['count'],'PURSH_Noofshares'=>$id['totshare'],'PURSH_Totalamt'=>$s3,'PURSH_TotalShareValue'=>$id['totshrval'],'PURSH_Date'=>$id['spdate'],'LedgerHeadId'=>"32",'SubLedgerId'=>"34"]);
			
				/***********/
				$fn_data["rv_payment_mode"] = "CASH";
				$fn_data["rv_transaction_id"] = $purchaseshare_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SHARE_ALLOCATION;//constant SHARE_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['spdate'];
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
			$inhandcash1=$inhandcashh->InHandCash;
			$totinhand=$inhandcash1+$puramt;
			DB::table('cash')->where('BID','=',$bid)
			->update(['InHandCash'=>$totinhand]);
			
			$trandate=date('Y-m-d');
			//$totcash=$inhandcash1+$memfee;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Additional Share Purchased",'InhandTrans_Cash'=>$puramt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totinhand]);
			
			
			$nofshares=$id['totshare'];
			for($i=0;$i<$nofshares;$i++)
			{
				DB::table('individual_shares')->insertGetId(['individual_share_Mid'=>$id['mid'],'individual_share_Class'=>$id['shclass'],'individual_share_Date'=>$id['spdate'],'individual_share_certificateid'=>$certid]);
				
			}
			
			
			return $purchaseshare_id;
		}
		
		public function GetData()
		{
			
			$id = DB::table('purchaseshare')->select('PURSH_Pid','PURSH_Memid','Memid','FirstName','MiddleName','LastName','PURSH_Shrclass','PURSH_Shareamt','PURSH_Noofshares','PURSH_Totalamt','PURSH_Memshareid','PURSH_Certfid','purchaseshare.Status')
			->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
			
			->get();
			
			return $id;
		}
		
		public function GetSearchData($id)
		{
			
			$id = DB::table('purchaseshare')->select('PURSH_Pid','PURSH_Memid','Memid','FirstName','MiddleName','LastName','PURSH_Shrclass','PURSH_Shareamt','PURSH_Noofshares','PURSH_Totalamt','PURSH_Memshareid','PURSH_Certfid','purchaseshare.Status')
			->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
			->where('PURSH_Pid','=',$id)
			->get();
			
			return $id;
		}
		
		public function GetPurshareDetail($id)
		{
			$id = DB::table('purchaseshare')->select('PURSH_Pid','PURSH_Memid','Memid','members.FirstName','members.MiddleName','members.LastName','PURSH_Shrclass','PURSH_Shareamt','PURSH_Noofshares','PURSH_Totalamt','PURSH_Memshareid','PURSH_Certfid','PURSH_Date','Member_Fee','FatherName','BName','Address','City','District','State','Nom_FirstName','Nom_MiddleName','Nom_LastName','Nom_Address','Nom_City','Relationship','Memid','SpouseName')
			->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
			->leftJoin('address', 'address.Aid', '=' , 'members.Aid')
			->leftJoin('branch', 'branch.Bid', '=' , 'members.Bid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'members.Nid')
			->where('PURSH_Pid',$id)
			->get();
			
			return $id;
			
		}
		
		public function GetPurshareReceDetail($id)
		{
			$id = DB::table('purchaseshare')->select('PURSH_Pid','PURSH_Memid','Memid','FirstName','MiddleName','LastName','PURSH_Shrclass','PURSH_Shareamt','PURSH_Noofshares','PURSH_Totalamt','PURSH_Memshareid','PURSH_Certfid','PURSH_Date','Member_Fee','FatherName','BName','PURSH_ReceiptNo')
			->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
			->leftJoin('branch', 'branch.Bid', '=' , 'members.Bid')
			//->min
			->where('PURSH_Pid',$id)
			->get();
			
			return $id;
			
		}
		
		public function GetMinPurId($mid)
		{
			
			$id = DB::table('purchaseshare')->select('PURSH_Pid')
			->where('PURSH_Memid',$mid)
			->min('PURSH_Pid');
			
			
			return $id;
		}
		
		public function GetMaxRecNum()
		{
			
			$id = DB::table('purchaseshare')->select('PURSH_ReceiptNo')
			//->where('PURSH_Memid',$mid)
			->max('PURSH_ReceiptNo');
			
			
			return $id;
		}
		
		public function UpdateReceiptNo($id)
		
		{
			$rid=$id['recenum'];
			$purid=$id['purchid'];
			DB::table('purchaseshare')->where('PURSH_Pid','=',$purid)
			->update(['PURSH_ReceiptNo'=>$rid]);
			
			
			
		}
		
		public function SearchPurchaseShare($q)
		{
			return DB::table('purchaseshare')
			->select(DB::raw('PURSH_Pid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`,"-",`PURSH_Certfid`," , ",`FatherName`,"(Father)") as name'))
			->leftJoin('members','members.Memid','=','purchaseshare.PURSH_Memid')
			->get();
			
		}
		public function getshares($id)
		{
			return DB::table('purchaseshare')->select('PURSH_Certfid','PURSH_Noofshares','PURSH_TotalShareValue','PURSH_Pid')
			->where('PURSH_Memid','=',$id)
			->where('Status','!=',"CLOSED")
			->get();
		}
		
		public function getsharesindiv($id)
		{
			return DB::table('individual_shares')->select('individual_share_certificateid','PURSH_Shareamt','individual_share_ID')
			->leftJoin('purchaseshare','purchaseshare.PURSH_Certfid','=','individual_share_certificateid')
			->where('individual_share_Mid','=',$id)
			->distinct()
			->where('individual_share_status','<>',"CLOSED")
			->get();
		}
		
		public function shareclose($pid)
		{
			$id = DB::table('purchaseshare')->select('PURSH_Pid','PURSH_Memid','Memid','members.FirstName','members.MiddleName','members.LastName','PURSH_Shrclass','PURSH_Shareamt','PURSH_Noofshares','PURSH_Totalamt','PURSH_Memshareid','PURSH_Certfid','PURSH_Date','Member_Fee','FatherName','BName','Address','City','District','State','Nom_FirstName','Nom_MiddleName','Nom_LastName','Nom_Address','Nom_City','Relationship','Memid','PURSH_TotalShareValue')
			->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
			->leftJoin('address', 'address.Aid', '=' , 'members.Aid')
			->leftJoin('branch', 'branch.Bid', '=' , 'members.Bid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'members.Nid')
			->where('PURSH_Pid',$pid)
			->get();
			
			return $id;
			
		}
		
		public function indshareclose($pid)
		{
			
			$shareid=$pid['shareid'];
			$loopid=$pid['loopid'];
			//print_r($shareid);
			$s_id=$pid['s_id'];
			$id['data'] = DB::table('purchaseshare')->select('PURSH_Pid','PURSH_Memid','Memid','members.FirstName','members.MiddleName','members.LastName','PURSH_Shrclass','PURSH_Shareamt','PURSH_Noofshares','PURSH_Totalamt','PURSH_Memshareid','PURSH_Certfid','PURSH_Date','Member_Fee','FatherName','BName','Address','City','District','State','Nom_FirstName','Nom_MiddleName','Nom_LastName','Nom_Address','Nom_City','Relationship','Memid','PURSH_TotalShareValue','individual_share_ID')
			->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
			->leftJoin('address', 'address.Aid', '=' , 'members.Aid')
			->leftJoin('branch', 'branch.Bid', '=' , 'members.Bid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'members.Nid')
			->leftJoin('individual_shares', 'individual_shares.individual_share_certificateid', '=' , 'PURSH_Certfid')
			->where('individual_share_ID',$s_id)
			->get();
			$sum=0;
			$count=0;
			$z=0;
			
			for($i=0;$i<$loopid;$i++)
			{
				
				
				$share=explode(",",$shareid);
				$x=$share[$z];
				$data=DB::table('individual_shares')->select('PURSH_Shareamt')
				->leftJoin('purchaseshare','purchaseshare.PURSH_Certfid','=','individual_share_certificateid')
				->where('individual_share_ID','=',$x)
				->first();
				$amt=$data->PURSH_Shareamt;
				$sum=$sum+$amt;
				$count=$count+1;
				
				$z++;
				
				
				//	print_r($chargsum);
			}
			$id['no_of_share']=$count;
			$id['no_of_amt']=$sum;
			$id['All_share_id']=$shareid;
			$id['loopid']=$loopid;
			
			
			
			return $id;
			
		}
		public function ShareCloseTran($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$dte=date('Y-m-d');
			
			$purchase_share = array();
			$purchase_share = DB::table("purchaseshare")
				->where("PURSH_Certfid","=",$id["cerificateid"])
				->first();
			
			DB::table('shareclosed')->insert(['ShareClose_Date'=>$dte,'ShareClose_Pid'=>$id['pid'],'ShareClose_CertificateNum'=>$id['cerificateid'],'ShareClose_AmountPaid'=>$id['payamt'],'bid'=>$purchase_share->Bid,'LedgerHeadId'=>$purchase_share->LedgerHeadId,'SubLedgerId'=>$purchase_share->SubLedgerId]);
			
			$pid=$id['pid'];
			$cid=$id['cerificateid'];
			DB::table('purchaseshare')->where('PURSH_Pid',$pid)
			->update(['Status'=>"CLOSED"]);
			DB::table('individual_shares')->where('individual_share_certificateid',$cid)
			->update(['individual_share_status'=>"CLOSED"]);
			if($id['tt']=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1-$id['payamt'];
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount DEITED to SHARE",'InhandTrans_Cash'=>$id['payamt'],'InhandTrans_Bid'=>$BID,'InhandTrans_Type'=>"DEBIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$x]);
				
			}	
			else if($id['tt']=="Adjust TO Branch")
			{
				
				DB::table('branch_to_branch')->insert(['Branch_Branch1_Id'=>$BID,'Branch_Branch2_Id'=>$id['BranchList2'],'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$id['payamt'],'Branch_per'=>$id['per'],'LedgerHeadId'=>$id['HeadiD'],'SubLedgerId'=>$id['expsubhead'],'Branch_payment_Mode'=>"ADJUSTMENT"]);
				
				DB::table('branch_to_branch')->insert(['Branch_Branch1_Id'=>$id['BranchList2'],'Branch_Branch2_Id'=>$BID,'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$id['payamt'],'Branch_per'=>"ADJUSTED TO HEAD OFFICE",'LedgerHeadId'=>$id['HeadiD'],'SubLedgerId'=>$id['expsubhead'],'Branch_payment_Mode'=>"ADJUSTMENT"]);
			}
			
			
			
		}
		
		public function SingleShareCloseTran($id)
		{
			$pid_share="";
			$cid_share="";
			$sid_share="";
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$dte=date('Y-m-d');
			$amt=$id['payamt'];
			$loopid=$id['loopid'];
			$shareid=$id['shareid'];
			$z=0;
			for($i=0;$i<$loopid;$i++)
			{
				$share=explode(",",$shareid);
				$x=$share[$z];
				
				DB::table('individual_shares')->where('individual_share_ID',$x)
				->update(['individual_share_status'=>"CLOSED"]);
				$certificateid1=DB::table('individual_shares')->select('individual_share_certificateid')->where('individual_share_ID',$x)
				->first();
				
				$certificateid=$certificateid1->individual_share_certificateid;
				$sharedata=DB::table('purchaseshare')->select('PURSH_Noofshares','PURSH_TotalShareValue','PURSH_Pid')
				->where('PURSH_Certfid',$certificateid)
				->first();
				$PURSH_Noofshares=$sharedata->PURSH_Noofshares;
				$PURSH_TotalShareValue=$sharedata->PURSH_TotalShareValue;
				$PURSH_Pid=$sharedata->PURSH_Pid;
				$totshares=$PURSH_Noofshares-1;
				$totamt=$PURSH_TotalShareValue-200;
				//$temp[$z]=$PURSH_Pid;
				if($i<$loopid-1)
				{
				$pid_share.=$PURSH_Pid.",";
				$cid_share.=$certificateid.",";
				$sid_share.=$x.",";
				}
				else
				{
					$pid_share.=$PURSH_Pid;
					$cid_share.=$certificateid;
					$sid_share.=$x;
				}
				$z++;
			}
			DB::table('shareclosed')->insert(['ShareClose_Date'=>$dte,'ShareClose_Pid'=>$pid_share,'ShareClose_CertificateNum'=>$cid_share,'ShareClose_AmountPaid'=>$id['payamt'],'ShareClose_ShareID'=>$sid_share]);
			
			if($id['tt']=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1-$id['payamt'];
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				
				
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount DEITED to SHARE",'InhandTrans_Cash'=>$id['payamt'],'InhandTrans_Bid'=>$BID,'InhandTrans_Type'=>"DEBIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$x]);
				
			}	
			else if($id['tt']=="Adjust TO Branch")
			{
				
				DB::table('branch_to_branch')->insert(['Branch_Branch1_Id'=>$BID,'Branch_Branch2_Id'=>$id['BranchList2'],'Branch_Tran_Date'=>$dte,'Branch_Amount'=>$id['payamt'],'Branch_per'=>$id['per'],'LedgerHeadId'=>$id['HeadiD'],'SubLedgerId'=>$id['expsubhead']]);
			}
			return $id;
		}
		
		public function GetMemberdetails($q)
		{
			
			return DB::table('members')
			->select(DB::raw('Memid as id, CONCAT(`Member_no`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			
			->get();
			
			
		}
	}

	