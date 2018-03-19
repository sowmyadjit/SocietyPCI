<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	
	class MemberModel extends Model
	{
		//
		protected $table='members';
		
		public function GetMember($m)
		{
			return DB::table('members')
			->select(DB::raw('Memid as id, CONCAT(`Memid`,"-",`Member_no`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->where('status','=',"AUTHORISED")
			->get();
		}
		
		public function insert($id)
		{
			//  $id = DB::table('users')->insertGetId(['Uname' => $id['uname'],'Password'=>$id['password'],'Email'=>$id['email'],'Bid'=>$id['bid']]);
			//return $id;
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			//echo $b;
			$amount1=$id['totamt'];
			$shamt=$id['mfee'];
			
			//Inserting into Document table		
			$docid = DB::table('docprovided')->insertGetId(['Photo'=>$id['photo'],'Signature'=>$id['sign'],'ID_Proof'=>$id['idp'],'Address_Proof'=>$id['adprf']]);
			
			$Aid = DB::table('address')->insertGetId(['FirstName'=> $id['mfname'],'MiddleName' => $id['mmname'],'LastName' => $id['mlname'],'Gender' => $id['mgender'],'MaritalStatus' => $id['mmrstate'],'Occupation' => $id['moccup'],'Age' => $id['mage'],'Birthdate' => $id['mbdate'],'Email' => $id['memail'],'Address' => $id['madd'],'City' => $id['mcity'],'State' => $id['mstate'],'MobileNo' => $id['mmno'],'Pincode' => $id['mpin'],'PhoneNo'=>$id['mpno'],'District'=>$id['mdist']]); 
			$Uid = DB::table('user')->insertGetId(['Aid' => $Aid,'Bid'=>$BID,'Created_on'=>$id['mdte'],'Email'=>$id['memail'],'FirstName'=> $id['mfname'],'MiddleName' => $id['mmname'],'LastName' => $id['mlname'],'LoginName' => $id['lgname'],'Password'=>$id['pwd'],'Passcode'=>$id['pscd']]);
			
			/*$id=DB::table('user')
			->Max('Uid');*/
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$Uid,'Relationship'=>$id['reltn']]);
			
			$Memid=DB::table('members')->insertGetId(['Bid'=>$BID,'Nid'=>$Nid,'CreatedDate'=>$id['mdte'],'PancardNum'=>$id['pncrdno'],'AdharCardNum'=>$id['adcrdno'],'VoteridNum'=>$id['voterid'],'PassportNum'=>$id['passportnum'],'Remarks'=>$id['remark'],'FirstName'=>$id['mfname'],'MiddleName'=>$id['mmname'],'LastName'=>$id['mlname'],'Uid'=>$Uid,'Member_Fee'=>$id['mfee'],'DocProvid'=>$docid,'Aid'=>$Aid,'FatherName'=>$id['fthrname'],'SpouseName'=>$id['spousename'],'member_resp_no'=>$r]);
			
			$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$countpr=DB::table('purchaseshare')->count();
			if($countpr==0)
			{
				$certid=1;
			}
			else
			{
				$certid=$countpr+1;
			}
			$noofshare=$id['totshare'];
			$shareprice=$id['shprice'];
			$shareval=$id['shamt'];
			$s1=$noofshare*$shareprice;
			$s2=$noofshare*$shareval;
			$s3=$s1+$s2;
			
			$LedgerHeadId = '32';
			switch($id['shclass']) {
				case "CLASS_A":	
				case "OLD_ACLASS":	
				case "A CLS":	
						$SubLedgerId = "33";
						break;
				case "CLASS_C":	
				case "Old_C_Class":	
				case "C CLASS OLD":	
						$SubLedgerId = "34";
						break;
			}
			
			$pid = DB::table('purchaseshare')->insertGetId(['PURSH_Memid'=> $Memid,'PURSH_Shrclass'=>$id['shclass'],'PURSH_Shareamt'=>$id['shamt'],'PURSH_Memshareid'=>$id['memshr'],'PURSH_Certfid'=>$certid,'PURSH_Shareprice'=>$id['shprice'],'PURSH_Shmaxcount'=>$id['count'],'PURSH_Noofshares'=>$id['totshare'],'PURSH_Totalamt'=>$s3,'PURSH_TotalShareValue'=>$id['totshrval'],'PURSH_Date'=>$id['mdte'],'Bid'=>$BID,'PURSH_Share_resp_no'=>$r,'LedgerHeadId'=>$LedgerHeadId,'SubLedgerId'=>$SubLedgerId]);
			
			$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
			$inhandcash1=$inhandcashh->InHandCash;
			$x=$inhandcash1+$amount1+$shamt;
			DB::table('cash')->where('BID','=',$bid)
			->update(['InHandCash'=>$x]);
			
			$trandate=date('Y-m-d');
			$memfee=$amount1;
			$totcash=$inhandcash1+$memfee;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Member Fee and Share Price",'InhandTrans_Cash'=>$memfee,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			
			$nofshares=$id['totshare'];
			for($i=0;$i<$nofshares;$i++)
			{
				DB::table('individual_shares')->insertGetId(['individual_share_Bid'=>$BID,'individual_share_Mid'=>$Memid,'individual_share_Class'=>$id['shclass'],'individual_share_Date'=>$id['mdte'],'individual_share_certificateid'=>$certid]);
				
			}
			
			
			return $id;
		}
		
		public function UpdateMember($id)
		{
			
			DB::table('address')->where('Aid',$id['aid'])
			->update(['FirstName'=> $id['mfname'],'MiddleName' => $id['mmname'],'LastName' => $id['mlname'],'Gender' => $id['mgender'],'MaritalStatus' => $id['mmrstate'],'Occupation' => $id['moccup'],'Age' => $id['mage'],'Birthdate' => $id['mbdate'],'Email' => $id['memail'],'Address' => $id['madd'],'City' => $id['mcity'],'State' => $id['mstate'],'Kan_Address' => $id['KaMAdd'],'Kan_City' => $id['KaMCity'],'Kan_State' => $id['KaMState'],'MobileNo' => $id['mmno'],'Pincode' => $id['mpin'],'PhoneNo'=>$id['mpno'],'District'=>$id['mdist'],'Kan_District'=>$id['KaMDistrict']]); 
			
			DB::table('user')->where('Uid',$id['uid'])
			->update(['Aid'=>$id['aid'],'Bid'=>$id['branchid'],'Created_on'=>$id['mdte'],'Email'=>$id['memail'],'FirstName'=> $id['mfname'],'MiddleName' => $id['mmname'],'LastName' => $id['mlname'],'Kan_FirstName'=> $id['KaMFname'],'Kan_MiddleName' => $id['KaMMname'],'Kan_LastName' => $id['KaMLname'],'LoginName' => $id['lgname']]);
			
			DB::table('nominee')->where('Nid',$id['nid'])
			->update(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Kan_Nom_FirstName'=>$id['KaNFname'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Kan_Nom_LastName'=>$id['KaNLname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Kan_Nom_MiddleName'=>$id['KaNMname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$id['uid'],'Relationship'=>$id['rltn'],'Kan_Relationship'=>$id['KaRelation']]);
			
			DB::table('docprovided')->where('DocProvid',$id['dcid'])
			->update(['ID_Proof'=>$id['memidp'],'Address_Proof'=>$id['memadrp'],'Photo'=>$id['memphoto'],'Signature'=>$id['memsign']]);
			
			$id = DB::table('members') -> where('Memid',$id['memid'])
			->update(['Bid'=>$id['branchid'],'Nid'=>$id['nid'],'Aid'=>$id['aid'],'CreatedDate'=>$id['mdte'],'PancardNum'=>$id['pncrdno'],'AdharCardNum'=>$id['adcrdno'],'VoteridNum'=>$id['voterid'],'PassportNum'=>$id['passportnum'],'Remarks'=>$id['remark'],'FirstName'=>$id['mfname'],'MiddleName'=>$id['mmname'],'LastName'=>$id['mlname'],'Uid'=>$id['uid'],'Member_Fee'=>$id['mfee'],'FatherName'=>$id['fthrname'],'SpouseName'=>$id['spousename'],'Kan_FatherName'=>$id['KaMFather'],'Kan_SpouseName'=>$id['KaMSpouse']]);
			
			return $id;
		}
		
		public function getData()
		{
			
			
			//$id = DB::table('members')->select('Memid','PURSH_Memid','FirstName','MiddleName','LastName','CreatedDate','Remarks','PURSH_Shrclass','PURSH_Noofshares','PURSH_TotalShareValue')
			//->leftJoin('purchaseshare', 'purchaseshare.PURSH_Memid', '=' , 'members.Memid')
			
			$id = DB::table('members')
				->select('Memid','FirstName','MiddleName','LastName','CreatedDate','Remarks','members.status','FatherName','Member_no','classtype',DB::raw("sum(`PURSH_Noofshares`) AS no_of_shares, sum(`PURSH_Totalamt`) as total_share_amt"))
				->join("purchaseshare","purchaseshare.PURSH_Memid","=","members.Memid")
				->groupBy("purchaseshare.PURSH_Memid")
				->orderBy('Memid', 'desc')
				->paginate(10);
			
			return $id;
		}
		
		public function GetSearchData($id)//M 19-4-16
		{
			
			$id = DB::table('members')
				->select('Memid','FirstName','MiddleName','LastName','CreatedDate','Remarks','members.status','FatherName','Member_no',DB::raw("sum(`PURSH_Noofshares`) AS no_of_shares, sum(`PURSH_Totalamt`) as total_share_amt"))
				->join("purchaseshare","purchaseshare.PURSH_Memid","=","members.Memid")
				->groupBy("purchaseshare.PURSH_Memid")
				->where('Memid','=',$id)
				->get();
			
			return $id;
		}
		
		public function GetMemberDetail($id)
		{
			return DB::table('members')->select('Memid','members.Bid','members.Aid','members.Nid','members.Uid','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','FatherName','members.SpouseName','Kan_FatherName','members.Kan_SpouseName','CreatedDate','address.Gender','user.LoginName','BName','user.Email','address.MaritalStatus','address.Occupation','address.Age','address.Birthdate','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.MobileNo','address.Pincode','address.PhoneNo','PancardNum','AdharCardNum','VoteridNum','PassportNum','Remarks','Member_Fee','Nom_Address','Nom_Age','Nom_Birthdate','Nom_City','Nom_District','Nom_Email','Nom_FirstName','Nom_MiddleName','Nom_LastName','Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','Kan_Relationship','Nom_Gender','Nom_Marital_Status','Nom_MobNo','Nom_Occupation','Nom_PhoneNo','Nom_Pincode','Nom_State','ID_Proof','Address_Proof','Photo','Signature','members.DocProvid')
			->leftJoin('branch', 'branch.Bid', '=' , 'members.Bid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'members.Nid')
			->leftJoin('address', 'address.Aid', '=' , 'members.Aid')
			//->leftJoin('purchaseshare', 'purchaseshare.PURSH_Memid', '=' , 'members.Memid')
			->leftJoin('user', 'user.Uid', '=' , 'members.Uid')
			//->leftJoin('shares','shares.Share_Class','=','purchaseshare.PURSH_Shrclass')
			->leftJoin('docprovided','docprovided.DocProvid','=','members.DocProvid')
			->where('Memid',$id)
			->get();
		}
		public function GetMemberDetail1($id)
		{
			return DB::table('members')->select('ID_Proof','Address_Proof','Photo','Signature','members.DocProvid')
			
			->leftJoin('docprovided','docprovided.DocProvid','=','members.DocProvid')
			->where('Memid',$id)
			->first();
		}
		public function GetMembersForPersLoan($id)
		{
			return DB::table('members')
			->select(DB::raw('Memid as id, CONCAT(`Memid`,"/",`Member_no`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->where('status','=',"AUTHORISED")
			//->where('Loan_Allocated','=','NO')
			->get();
		}
		public function tranmember($id)
		{
			$dte=date('Y-m-d');
			$uid=$id['userid'];
			//print_r($uid);
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			
			$custinfo=DB::table('customer')->select('Bid','Nid','FirstName','MiddleName','LastName','DocProvid','Aid','FatherName','SpouseName')
			->where('Uid','=',$uid)
			->first();
			
			$bid=$custinfo->Bid;
			//$bid=$BID;
			$nid=$custinfo->Nid;
			$fname=$custinfo->FirstName;
			$mname=$custinfo->MiddleName;
			$lname=$custinfo->LastName;
			$docpvd=$custinfo->DocProvid;
			$aid=$custinfo->Aid;
			$fthrname=$custinfo->FatherName;
			$spname=$custinfo->SpouseName;
			
			$Memid=DB::table('members')->insertGetId(['Bid'=>$bid,'Nid'=>$nid,'CreatedDate'=>$dte,'FirstName'=>$fname,'MiddleName'=>$mname,'LastName'=>$lname,'Uid'=>$uid,'Member_Fee'=>$id['memfee'],'DocProvid'=>$docpvd,'Aid'=>$aid,'FatherName'=>$fthrname,'SpouseName'=>$spname,'member_resp_no'=>$r]);
			
			$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$countpr=DB::table('purchaseshare')->count();
			if($countpr==0)
			{
				$certid=1;
			}
			else
			{
				$certid=$countpr+1;
			}
			$mfeeeee=$id['memfee'];
			$amount1=intval($id['totamt'])+intval($mfeeeee);
			
			$noofshare=$id['totshare'];
			$shareprice=$id['shprice'];
			$shareval=$id['shamt'];
			$s1=$noofshare*$shareprice;
			$s2=$noofshare*$shareval;
			$s3=$s1+$s2;//	+$mfeeeee;
			$pid = DB::table('purchaseshare')->insertGetId(['PURSH_Memid'=> $Memid,'PURSH_Shrclass'=>$id['shclass'],'PURSH_Shareamt'=>$id['shamt'],'PURSH_Memshareid'=>$id['memshr'],'PURSH_Certfid'=>$certid,'PURSH_Shareprice'=>$id['shprice'],'PURSH_Shmaxcount'=>$id['count'],'PURSH_Noofshares'=>$id['totshare'],'PURSH_Totalamt'=>$s3,'PURSH_TotalShareValue'=>$id['totshrval'],'PURSH_Date'=>$dte,'PURSH_Share_resp_no'=>$r,'Bid'=>$BID]);
			
			
			$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
			$inhandcash1=$inhandcashh->InHandCash;
			$x=$inhandcash1+$amount1;
			DB::table('cash')->where('BID','=',$bid)
			->update(['InHandCash'=>$x]);
			
			$trandate=date('Y-m-d');
			$memfee=$amount1;
			$totcash=$inhandcash1+$memfee;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Member Fee and Share Price",'InhandTrans_Cash'=>$memfee,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			
		}
		
		public function SearchMember($q)//M 19-4-16 For member.blade to search customer
		{
			return DB::table('members')
			->select(DB::raw('Memid as id, CONCAT(`Member_no`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`," , ",`FatherName`,"(Father)") as name'))
			->get();
		}
		
		public function get_branches()
		{
			return DB::table('branch')
				->select()
				->get();
		}
		
		public function get_share_classes()
		{
			return DB::table('shares')
				->select()
				->get();
		}
		
		public function share_details_data($data)
		{
			if($data["bid"] == 0) {
				$branch = DB::table("branch")
					->select()
					->get();
				foreach($branch as $row)
					$bids[] = $row->Bid;
				$bids[] = 0;
			} else {
				$bids[] = $data["bid"];
			}
			
			if($data["share_class_id"] == 0) {
				$shares = DB::table("shares")
					->select()
					->get();
				foreach($shares as $row)
					$share_class_ids[] = $row->Share_ID;
			} else {
				$share_class_ids[] = $data["share_class_id"];
			}


			return DB::table("purchaseshare")
				->select("purchaseshare.Bid","PURSH_Memid","Member_no","PURSH_Shrclass","PURSH_Noofshares","PURSH_Shareamt","PURSH_Totalamt","PURSH_TotalShareValue","BName","FirstName","MiddleName","LastName")
				->leftJoin("branch","branch.Bid","=","purchaseshare.Bid")
				->join("shares","shares.Share_Class","=","purchaseshare.PURSH_Shrclass")
				->join("members","members.Memid","=","purchaseshare.PURSH_Memid")
				->whereIn("purchaseshare.Bid",$bids)
				->whereIn("shares.Share_ID",$share_class_ids)
				->orderBy("purchaseshare.Bid","asc")
				->orderBy("Member_no","asc")
				->get();
		}
		
		public function get_member_details($data)
		{
			$ret_data = array();
			$i = 0;
			
			$member_nos = DB::table("members")
				->select("Member_no")
				->distinct("Member_no")
				->get();
				
			foreach($member_nos as $key_mn => $row_mn) {
				$members = DB::table("members")
					->select()
					->where("Member_no","=",$row_mn->Member_no)
					->get();
					
				foreach($members as $key_me => $row_mi) {
					$purchaseshare = DB::table("purchaseshare")
						->select()
						->where("purchaseshare.PURSH_Memid","=",$row_mi->Memid)
						->orderBy("PURSH_Shrclass")
						->get();
					foreach($purchaseshare as $row_pu) {
							
						$ret_data[$i]["member_id"] = $row_mi->Memid;
						$ret_data[$i]["uid"] = $row_mi->Uid;
						$ret_data[$i]["old_member_no"] = $row_mi->Member_no;
						$ret_data[$i]["new_member_no"] = $row_mi->New_Member_No;
						$ret_data[$i]["member_name"] = $row_mi->FirstName . " " . $row_mi->MiddleName . "" . $row_mi->LastName;
						$ret_data[$i]["FatherName"] = $row_mi->FatherName;
						$ret_data[$i]["SpouseName"] = $row_mi->SpouseName;
						$ret_data[$i]["bid"] = $row_pu->Bid;
						$ret_data[$i]["share_class"] = $row_pu->PURSH_Shrclass;
						$ret_data[$i]["certificate_id"] = $row_pu->PURSH_Certfid;
						$ret_data[$i]["no_of_shares"] = $row_pu->PURSH_Noofshares;
						$ret_data[$i]["share_amt"] = $row_pu->PURSH_Shareamt;
						$ret_data[$i]["share_total_amt"] = $row_pu->PURSH_Totalamt;
						$ret_data[$i]["share_purchase_date"] = $row_pu->PURSH_Date;
						$ret_data[$i]["share_status"] = $row_pu->Status;
						$i++;
//						if($i == 5)break;
					}
//					if($i == 5)break;
				}
//				if($i == 5)break;
			}
			return $ret_data;
		}
		
		
		
	}
	
