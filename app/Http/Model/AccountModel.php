<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\SmsModel;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\SettingsModel;
	
	class AccountModel extends Model
	{
		//
		protected $table='createaccount';
		public $smsmodel;
		public function __construct()
		{
			$this->smsmodel=new SmsModel;
			$this->rv_no = new ReceiptVoucherController;
			$this->settings = new SettingsModel;
		}
		
		public function insert($id)
		{
			$dte=date('Y-m-d');
			$reportdte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			//$branchcode=$id['branchcd'];
			$type=$id['atype'];
			$mode=$id['AgentPayMode'];
			$Accid_sb_=$id['AccNum'];
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
				$BID=$uname->Bid;
				$actid=1;
				
				$branchcode1=DB::table('branch')->select('BCode')->where('Bid',$BID)->first();
				$branchcode=$branchcode1->BCode;
			if($type=="RD"||$type=="Reccuring Deposit")
			{
				$tempmDate = explode('/',$id['m']);
				$conmDate = $tempmDate[2]."-".$tempmDate[1]."-".$tempmDate[0];
				$mdate=date('Y-m-d',strtotime($conmDate));
				$actid=2;
			}
			else
			{
				$mdate=0;
			}
			$count_inc;
			
			$maxid=DB::table('createaccount')->where('Bid','=',$BID)->where('AccTid','=',$actid)->max('Accid');
			$accnum1=DB::table('createaccount')->select('AccNum')->where('Accid','=',$maxid)->first();
			$accnum=$accnum1->AccNum;
			//print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
				$paccno2=$matches[2];
				$paccno3=intval($paccno2)+1;
				//$paccno="PCISPG".$branchcode.$paccno3;
			
			if($type=="SB")
			{
				$count_inc="PCIS".$branchcode."SB".$paccno3;
			
			}
			else if($type=="RD"||$type=="Recurring Deposit")
			{
				$count_inc="PCIS".$branchcode."RD".$paccno3;
			}
			
			//Inserting into Nominee Table
			$nid = DB::table('nominee')->insertGetId(['Nom_FirstName'=> $id['nfname'],'Nom_MiddleName' => $id['nmname'],'Nom_LastName' => $id['nlname'],'Nom_Gender' => $id['ngender'],'Nom_Marital_Status' => $id['nmstate'],'Nom_Occupation' => $id['noccup'],'Nom_Age' => $id['nage'],'Nom_Birthdate' => $id['nbdate'],'Nom_Email' => $id['nemail'],'Nom_Address' => $id['nadd'],'Nom_City' => $id['ncity'],'Nom_District' => $id['ndist'],'Nom_state' => $id['nstate'],'Nom_MobNo' => $id['nmno'],'Nom_Pincode' => $id['npin'],'Nom_PhoneNo'=>$id['npno'],'Uid'=>$id['user_ss'],'Relationship'=>$id['relation'],'Nom_District'=>$id['ndist']]); 
			//Inserting into createaccount Table
			$acid = DB::table('createaccount')->insertGetId(['AccNum'=>$count_inc,'Old_AccNo'=>$id['oldaccno'],'Duration'=>$id['rddurtn'],'AccTid'=>$id['acctyp_11'],'Bid'=>$BID,'Uid'=>$id['user_ss'],'opening_blance'=>$id['ob'],'nid'=>$nid,'Created_on'=>$dte,'Total_Amount'=>$id['ob'],'Maturity_Date'=>$mdate,'Agent_ID'=>$id['agid'],"Closed"=>"NO"]);
			$amount1=$id['ob'];
			if($type=="SB")
			{
			
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
				$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
				
				->leftJoin('branch','branch.Bid','=','user.Bid')
				->where('user.Uid','=',$UID)
				->first();
				
				$b=$udetail->BName;
				$u=$udetail->Uid;
				//echo $b;
				//Inserting into sb_transaction Table
				$sb_id = DB::table('sb_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $id['acctyp_11'],'TransactionType' => "CREDIT",'particulars' =>"Opening Balance",'Amount' =>$amount1,'CurrentBalance' => $amount1,'Total_Bal' => $id['ob'],'tran_Date' =>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$u,'Bid'=>$BID,'SB_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'Payment_Mode'=>"CASH"]);
				
				/***********/
				$fn_data["rv_payment_mode"] = $mode;
				$fn_data["rv_transaction_id"] = $sb_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SB_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

				if($mode=="SB ACCOUNT")
				{
						
						$SBAccountNum=$id['SBAccountNum'];
						$SBAvailhidn=$id['SBAvailhidn'];
					$updateamt=$SBAvailhidn-$amount1;
					DB::table('createaccount')->where('AccNum','=',$SBAccountNum)
					->update(['Total_Amount'=>$updateamt]);
					$sb_id2 = DB::table('sb_transaction')->insertGetId(['Accid'=> $Accid_sb_,'AccTid' => "1",'TransactionType' => "DEBIT",'particulars' =>"SB ACCOUNT",'Amount' =>$amount1,'CurrentBalance' => $SBAvailhidn,'Total_Bal' => $updateamt,'tran_Date' =>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$u,'Bid'=>$BID,'SB_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'Payment_Mode'=>"SB"]);
				}
				else if($mode=="CASH")
				{
					
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$amount1;
				DB::table('cash')->where('BID','=',$BID)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to SB Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
				}
				return $sb_id;
				
			}
			else if($type=="RD"||$type=="Recurring Deposit")
			{
				
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
				$u=$udetail->Uid;
				
				
				$rd_pay_mode = "";
				
				//echo $b;
				//$mode=$id['AgentPayMode'];
				if($mode=="SB ACCOUNT")
				{
					$rd_pay_mode = "ADJUSTMENT";
					//$Accid_sb_=$id['AccNum'];
					$SBAccountNum=$id['SBAccountNum'];
					$SBAvailhidn=$id['SBAvailhidn'];
					$updateamt=$SBAvailhidn-$amount1;
					DB::table('createaccount')->where('AccNum','=',$SBAccountNum)
					->update(['Total_Amount'=>$updateamt]);
					$sb_id3 = DB::table('sb_transaction')->insertGetId(['Accid'=> $Accid_sb_,'AccTid' => "1",'TransactionType' => "DEBIT",'particulars' =>"SB ACCOUNT",'Amount' =>$amount1,'CurrentBalance' => $SBAvailhidn,'Total_Bal' => $updateamt,'tran_Date' =>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$u,'Bid'=>$BID,'SB_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'Payment_Mode'=>"SB"]);
				}
				else
				{
					$rd_pay_mode = "CASH";
					$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
					$inhandcash1=$inhandcashh->InHandCash;
					$x=$inhandcash1+$amount1;
					DB::table('cash')->where('BID','=',$BID)
					->update(['InHandCash'=>$x]);
					//$inhandcash=DB::table('cash')->select('InHandCash')->where('Branch','=',$b)->first();
					$trandate=date('Y-m-d');
					
					$totcash=$inhandcash1+$amount1;
					DB::table('inhandcash_trans')
					->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to RD Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$BID,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
					}
					
					
					$amount1=$id['ob'];
					$rd_id = DB::table('rd_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $id['acctyp_11'],'RD_Trans_Type' => "Credit",'RD_Particulars' => "Opening Balance",'RD_Amount' => $amount1,'RD_CurrentBalance' => $amount1,'RD_Total_Bal' => $id['ob'],'RD_Date' => $dte,'RDReport_TranDate'=> $dte,'RD_Month'=>$mnt,'RD_Year'=>$year,'CreatedBy'=>$u,'Bid'=>$BID,'RD_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"43",'RDPayment_Mode'=>$rd_pay_mode]);
					
					/***********/
					$fn_data["rv_payment_mode"] = $mode;
					$fn_data["rv_transaction_id"] = $rd_id;
					$fn_data["rv_transaction_type"] = "CREDIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::RD_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = $dte;
					$this->rv_no->save_rv_no($fn_data);
					unset($fn_data);
					/***********/

					return $rd_id;
				
			}
			
			
			
		}
		
		
		
		public function Getaccountnum($q)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
				
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
			$ret_data =  DB::table('createaccount')
			->select(DB::raw('Accid as id, CONCAT(`Old_AccNo`,"-",`AccNum`) as name'))
			->where('AccNum','like','%SB%')
			->where('Status','=',"AUTHORISED");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where('createaccount.Bid','=',$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		/*public function getvalue($id)
			{
			$id=DB::table('createaccount')->select('Acc_Type')
			->leftJoin('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->where('Accid',$id)
			->get();
			
			return $id;
		}*/
		/*public function getvalue($id)
			{
			$acid=DB::table('createaccount')->select('AccTid')->where('Accid','=',$id['acttype'])->first();
			$id=DB::table('accounttype')->select('Acc_Type')->where('AccTid','$acid')->first();
			return $id;
		}*/
		
		public function getData()
		{
			
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			
			$id = DB::table('createaccount')->where('createaccount.Bid',$BID)
			->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','AccountCategory','user.Uid','Total_Amount','createaccount.Created_on','createaccount.Maturity_Date','Agent_ID')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			
//			->paginate(10);
			->get();
			
			foreach($id as $key => $row) {
				$id[$key]->Total_Amount = $this->get_account_balance(["acc_id"=>$row->Accid]);
			}
			
			return $id;
		}
		
		public function getData_all()
		{
			
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			
			$id = DB::table('createaccount')->where('createaccount.Bid',$BID)
			->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','AccountCategory','user.Uid','Total_Amount','createaccount.Created_on','createaccount.Maturity_Date','Agent_ID')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->get();
			
			foreach($id as $key => $row) {
				$id[$key]->Total_Amount = $this->get_account_balance(["acc_id"=>$row->Accid]);
			}
			
			return $id;
		}
		
		public function getSBData()
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
				
			$id = DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','Total_Amount')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('AccNum','like','%SB%')
//			->where('createaccount.JointUid','=',"")
			->where('createaccount.Bid','=',$BID)
			->get();
			
			foreach($id as $key => $row) {
				$id[$key]->sb_bal = $this->get_account_balance(["acc_id"=>$row->Accid]);
			}
			
			return $id;
		}
		
		public function getSBData_joint()
		{
			$uname='';
			if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			
			$id = DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','createaccount.JointUid')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('AccNum','like','%SB%')
			->where('createaccount.JointUid','!=',"")
			->where('createaccount.Bid','=',$BID)
		//	->paginate(10);
			->get();
			
			foreach($id as $key=>$row)
			{
				$uids = explode(",",$row->JointUid);
				$uid2 = $uids[1];
				
				$user2 = DB::table("user")
					->select("FirstName","MiddleName","LastName")
					->where("Uid","=",$uid2)
					->first();
				
				$id[$key]->user2 = $user2->FirstName . " " . $user2->MiddleName . " " . $user2->LastName;
				
			}
			
			return $id;
		}
		
		public function getRDData()
		{
			
			$id = DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','Agent_ID','Total_Amount')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('AccNum','like','%RD%')
			->paginate(10);
			
			return $id;
		}
		
		public function getRDData2()
		{
			
			$id = DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','Agent_ID','Total_Amount')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('AccNum','like','%RD%')
			->get();
			return $id;
		}
		
		public function GetAccount($id1) //single account details for edit and view
		{
			
			$id['alldetails']= DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','Nom_FirstName','Nom_MiddleName','Nom_LastName','Nom_Gender','Nom_Marital_Status','Nom_Occupation','Nom_Age','Nom_Birthdate','Relationship','Nom_Email','Nom_Address','Nom_City','Nom_District','Nom_state','Nom_MobNo','Nom_PhoneNo','Nom_Pincode','createaccount.AccTid','address.Aid','address.Age','address.Gender','address.BirthDate','address.Address','address.City','address.District','address.State','address.Pincode','address.Occupation','address.MaritalStatus','address.Email','address.Occupation','branch.Bid','nominee.Nid','createaccount.Created_on','user.Uid','Total_Amount')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('Accid',$id1)
			->get();
			$asd=DB::table('createaccount')->select('Uid')->where('Accid',$id1)->first();
			$uid=$asd->Uid;
			$cust_num=DB::table('customer')->where('Uid',$uid)->count('Custid');
			if($cust_num>0)
			{
				$fa_name=DB::table('customer')->select('FatherName')->where('Uid',$uid)->first();
			}
			$mem_num=DB::table('members')->where('Uid',$uid)->count('Memid');
			if($mem_num>0)
			{
				$fa_name=DB::table('members')->select('FatherName')->where('Uid',$uid)->first();
			}
			$id['fa_name']=$fa_name->FatherName;
			
			return $id;
		}
		
		public function GetAccount_joint($id1) //single account details for edit and view
		{
			$users = DB::table("createaccount")
				->where("Accid","=",$id1)
				->value("JointUid");
			$uids = explode(",",$users);
			$uid2 = $uids[1];
			
			$id['alldetails']= DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','Nom_FirstName','Nom_MiddleName','Nom_LastName','Nom_Gender','Nom_Marital_Status','Nom_Occupation','Nom_Age','Nom_Birthdate','Relationship','Nom_Email','Nom_Address','Nom_City','Nom_District','Nom_state','Nom_MobNo','Nom_PhoneNo','Nom_Pincode','createaccount.AccTid','address.Aid','address.Age','address.Gender','address.BirthDate','address.Address','address.City','address.District','address.State','address.Pincode','address.Occupation','address.MaritalStatus','address.Email','address.Occupation','branch.Bid','nominee.Nid','createaccount.Created_on','user.Uid','Total_Amount')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			//->leftJoin('user', 'user.Uid', '=' , $uid2)
			->leftJoin('user', 'user.Uid', '=' , DB::Raw("$uid2"))
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('Accid',$id1)
			->get();
			
			$cust_num=DB::table('customer')->where('Uid',$uid2)->count('Custid');
			if($cust_num>0)
			{
				$fa_name=DB::table('customer')->select('FatherName')->where('Uid',$uid2)->first();
			}
			$mem_num=DB::table('members')->where('Uid',$uid2)->count('Memid');
			if($mem_num>0)
			{
				$fa_name=DB::table('members')->select('FatherName')->where('Uid',$uid2)->first();
			}
			$id['fa_name']=$fa_name->FatherName;
			
			return $id;
		}
		
		/*public function getvalue($id)
			{
			$query1=DB::table('sb_transaction')
			->where('sb_transaction.Accid','=',$id)
			->max('sb_transaction.Tranid');
			
			return DB::table('sb_transaction')
			->join('createaccount','createaccount.Accid','=','sb_transaction.Accid')
			->join('user','createaccount.Uid','=','user.Uid')
			->join('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->select('sb_transaction.Total_Bal','accounttype.Acc_Type','user.FirstName','user.MiddleName','user.LastName','accounttype.AccTid','user.Uid')
			->where('sb_transaction.Accid','=',$id)
			->where('sb_transaction.Tranid','=',$query1)
			->first();
			return $id;
		}*/
		
		public function getvalue($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			/*$query1=DB::table('sb_transaction')
				->where('sb_transaction.Accid','=',$id)
			->max('sb_transaction.Tranid');*/
			
			return DB::table('sb_transaction')
			->join('createaccount','createaccount.Accid','=','sb_transaction.Accid')
			->join('user','createaccount.Uid','=','user.Uid')
			->join('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->select('createaccount.Total_Amount','accounttype.Acc_Type','user.FirstName','user.MiddleName','user.LastName','accounttype.AccTid','user.Uid')
			->where('sb_transaction.Accid','=',$id)
			->where('createaccount.Bid','=',$BID)
			//->where('sb_transaction.Tranid','=',$query1)
			->first();
		//	return $id;
		}
		
		public function insert_tran($id)
		{
			$res = 0;
			$dte=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
/*********************/
			$tr_date = $id['dte'];
			$td_date = date("Y-m-d");
			if($tr_date != $td_date)
				$old_tran = true;
			else
				$old_tran = false;
/*********************/

			/*************** DEBIT CHEQUE *****************/
				if(strcasecmp($id['paymode'],"CHEQUE")==0 && strcasecmp($id['trantyp'],"DEBIT")==0) {
					$id['uncleared'] = 0;
					$id['unclearedval'] = "CLEARED";
				}
			/*************** DEBIT CHEQUE *****************/
			
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			//echo $b;
			
			
			$tt=$id['trantyp'];
			//print_r($tm);
			$amount1=$id['sb_amount'];
			$msg_dep_amount=$id['sb_amount'];
			$pay=$id['paymode'];
			
			
			//$dte=date('d-m-Y');
			//$reportdte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			$tm=date('Y-m-d h:i:s');
			$acid=$id['actid'];
			$totbal=$id['tb'];
			$msg_totbal=$id['tb'];
			$trantyp=$id['trantyp'];
			//print_r($tm);
			if($trantyp=="CREDIT")
			{
				
			$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				$r1=0;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			}
			else if($trantyp=="DEBIT")
			{
				$respit2=DB::table('branch')->select('payment_voucher_No')->where('Bid',$BID)->first();
				$respit3=$respit2->payment_voucher_No;
				$r1=$respit3+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r1]);
				$r=0;
			}
			if($pay != "SB") {
				//echo "pay = ";				print_r($pay); echo "<br />";
				if($pay == "ADJUSTMENT (OLD ENTRY)") {
					$id["paymode"] = "ADJUSTMENT";
					$id['tb'] = $id['cb'];
				}
				$r=0;
				$res = DB::table('sb_transaction')->insertGetId(['Accid'=> $id['actid'],'AccTid' => $id['acctype'],'TransactionType' => $id['trantyp'],'particulars' => $id['par'],'Amount' => $id['sb_amount'],'CurrentBalance' => $id['cb'],'Total_Bal' => $id['tb'],'tran_Date' => $id['dte'],'SBReport_TranDate'=>  $id['dte'],'Time' =>$tm,'Month'=>$mnt,'Year'=>$year,'Time'=>$tm,'Payment_Mode'=>$id['paymode'],'Cheque_Number'=>$id['chequeno'],'Cheque_Date'=>$id['chdate'],'Cleared_State'=>$id['unclearedval'],'Uncleared_Bal'=>$id['uncleared'],'Bank_Name'=>$id['bankname'],'Bank_Branch'=>$id['bankbranch'],'IFSC_Code'=>$id['ifsccode'],'Bid'=>$BID,'CreatedBy'=>$UID,'SB_resp_No'=>$r,'SB_paymentvoucher_No'=>$r1,'LedgerHeadId'=>"38",'SubLedgerId'=>"42",'CreditBankId'=>$id['creditbank']]);
				
				/***********/
				$fn_data["rv_payment_mode"] = $pay;
				$fn_data["rv_transaction_id"] = $res;
				$fn_data["rv_transaction_type"] = $trantyp;
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SB_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['dte'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				
				if(!$old_tran)
					$sb=DB::table('createaccount')->where('Accid',$acid)
					->update(['Total_Amount'=>$totbal]);
			}
/*EDIT 26SEP2017*/
//			if($pay!="CHEQUE")
			if($pay =="CASH")
/*EDIT END 26SEP2017*/
			{
				
/*				$diff = abs(strtotime($td_date) - strtotime($tr_date));
				$diff_in_hrs = $diff/60/60;
				echo "diff_in_hrs="; print_r("$diff_in_hrs");//*/
			
				if($tt=="CREDIT")
				{
					
					$inhandcashh=DB::table('cash')->select('InHandCash')->where('Bid','=',$bid)->first();
					$inhandcash1=$inhandcashh->InHandCash;
					$x=$inhandcash1+$amount1;
					
					if(!$old_tran)
						DB::table('cash')->where('Bid','=',$bid)
							->update(['InHandCash'=>$x]);
					
					$trandate=date('Y-m-d');
					$totcash=$inhandcash1+$amount1;
					DB::table('inhandcash_trans')
					->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to SB Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
					
				}
				else  //debit
				{
					$inhandcashh=DB::table('cash')->select('InHandCash')->where('Bid','=',$bid)->first();
					$inhandcash1=$inhandcashh->InHandCash;
					$x=$inhandcash1-$amount1;
					
					if(!$old_tran)
						DB::table('cash')->where('Bid','=',$bid)
							->update(['InHandCash'=>$x]);
					
					$trandate=date('Y-m-d');
					$totcash=$inhandcash1-$amount1;
					
					DB::table('inhandcash_trans')
					->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Debited from SB Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
					
				}
			}
			else
			if ($pay =="CHEQUE")
			{
				if($tt=="CREDIT")
				{}
				else
				{
				    $bankid=$id['bankid'];
					$Banktot1=DB::table('addbank')->select('TotalAmt')->where('Bankid',$bankid)->first();
					$Banktot=$Banktot1->TotalAmt;
					$amt=$id['sb_amount'];
					$bankamttot=$Banktot-$amt;

					DB::table("sb_transaction")
						->where("Tranid",$res)
						->update(["Cleared_State"=>"CLEARED"]);
					
					if(!$old_tran)
						DB::table('addbank')->where('Bankid',$bankid)
						->update(['TotalAmt'=>$bankamttot]);
					
					DB::table('deposit')->insert(['Bid'=>$BID,'d_date'=>$dte,'date'=>$dte,'depo_bank_id'=>$bankid,'pay_mode'=>"CHEQUE",'cheque_no'=>$id['chequeno'],'cheque_date'=>$id['chdate'],'amount'=>$amt,'Deposit_type'=>"WITHDRAWL",'reason'=>$id['par']]);
						/******EXTRA*************/
					$updateAccount=$totbal-$amt;
					
					if(!$old_tran)
						DB::table('createaccount')->where('Accid',$acid)
						->update(['Total_Amount'=>$updateAccount]);
				}
			}
			else
			if ($pay =="SB")
			{
				date_default_timezone_set("Asia/Kolkata");
				if($tt=="CREDIT")
				{
					$credit_acc["Accid"] = $id["actid"];
					$credit_acc["Total_Bal"] = $id["cb"] + $id["sb_amount"];
					$credit_acc["CurrentBalance"] = $id["cb"];
					
					$debit_acc["Accid"] = $id["actid_adj"];
					$debit_acc["Total_Bal"] = $id["sb_adj_current_bal"] - $id["sb_amount"];
					$debit_acc["CurrentBalance"] = $id["sb_adj_current_bal"];
				}
				else
				{
					$credit_acc["Accid"] = $id["actid_adj"];
					$credit_acc["Total_Bal"] = $id["sb_adj_current_bal"] + $id["sb_amount"];
					$credit_acc["CurrentBalance"] = $id["sb_adj_current_bal"];
					
					$debit_acc["Accid"] = $id["actid"];
					$debit_acc["Total_Bal"] = $id["cb"] - $id["sb_amount"];
					$debit_acc["CurrentBalance"] = $id["cb"];
				}
				
				$insert_data1["Accid"] = $credit_acc["Accid"];
				$insert_data1["AccTid"] = $id['acctype'];
				$insert_data1["TransactionType"] = "CREDIT";
				$insert_data1["particulars"] = "SB TO SB";
				$insert_data1["Amount"] = $id["sb_amount"];
				$insert_data1["CurrentBalance"] = $credit_acc["CurrentBalance"];
				$insert_data1["tran_Date"] = date("d-m-Y");
				$insert_data1["SBReport_TranDate"] = date("Y-m-d");
				$insert_data1["Time"] = date("Y-m-d H:i:s");
				$insert_data1["Month"] = date("d");
				$insert_data1["Year"] = date("Y");
				$insert_data1["Total_Bal"] = $credit_acc["Total_Bal"];
				$insert_data1["Bid"] = $BID;
				$insert_data1["Payment_Mode"] = "ADJUSTMENT";
				$insert_data1["CreatedBy"] = $UID;
				$insert_data1["tran_reversed"] = "no";
				$insert_data1["LedgerHeadId"] = 38;
				$insert_data1["SubLedgerId"] = 42;
				DB::table("sb_transaction")
					->insertGetId($insert_data1);
					
				$insert_data2["Accid"] = $debit_acc["Accid"];
				$insert_data2["AccTid"] = $id['acctype'];
				$insert_data2["TransactionType"] = "DEBIT";
				$insert_data2["particulars"] = "SB TO SB";
				$insert_data2["Amount"] = $id["sb_amount"];
				$insert_data2["CurrentBalance"] = $debit_acc["CurrentBalance"];
				$insert_data2["tran_Date"] = date("d-m-Y");
				$insert_data2["SBReport_TranDate"] = date("Y-m-d");
				$insert_data2["Time"] = date("Y-m-d H:i:s");
				$insert_data2["Month"] = date("d");
				$insert_data2["Year"] = date("Y");
				$insert_data2["Total_Bal"] = $debit_acc["Total_Bal"];
				$insert_data2["Bid"] = $BID;
				$insert_data2["Payment_Mode"] = "ADJUSTMENT";
				$insert_data2["CreatedBy"] = $UID;
				$insert_data2["tran_reversed"] = "no";
				$insert_data2["LedgerHeadId"] = 38;
				$insert_data2["SubLedgerId"] = 42;
				DB::table("sb_transaction")
					->insertGetId($insert_data2);
					
				if(!$old_tran)
					DB::table("createaccount")
						->where("Accid","=",$credit_acc["Accid"])
						->update(["Total_Amount"=>$credit_acc["Total_Bal"]]);
						
				if(!$old_tran)
					DB::table("createaccount")
						->where("Accid","=",$debit_acc["Accid"])
						->update(["Total_Amount"=>$debit_acc["Total_Bal"]]);
			}
			
/*EDIT 26SEP2017*/
			//if($id['acctype']==1)
			if($id['acctype']==1 && $pay != 'ADJUSTMENT')
/*EDIT 26SEP2017*/
			{
				$ac_det=DB::table('createaccount')->select('AccNum','MobileNo')
				->leftJoin('user', 'user.Uid', '=', 'createaccount.Uid')
				->leftJoin('address', 'address.Aid', '=', 'user.Aid')
				->where('Accid',$id['actid'])->first();
				$mobile=$ac_det->MobileNo;
				$acn=$ac_det->AccNum;
				$acn=str_replace("PCIS","****",$acn);
				$acn=str_replace("SB","01**00",$acn);
				$message='Dear customer, your account ';
				$message.=$acn;
				$message.=' has been credited with Rs.';
				$message.=$msg_dep_amount;
				$message.='. Available balance ';
				$message.=$msg_totbal;
				$message.='. Regards PCI society.';
				
			//	$this->smsmodel->SendMSG(60266,$mobile,$message);
				
				
				
			}
			return $res;
		}
		
		
		public function insert_rdtran($id)
		{
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
			$rdamt=$id['rdamount'];
			$rdpay=$id['rdpaymode'];
			$accnts=$id['accounts'];
		   
			//print_r($rdamt);
			
			//$dte=date('d-m-Y');
			//$reportdte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			$tm=date('h:i:s');
			$totbal=$id['rdtb'];
			$acid=$id['rdactid'];
			$sb_id=$id['AccId'];
			$rd_tran_id = DB::table('rd_transaction')->insertGetId(['Accid'=> $id['rdactid'],'AccTid' => $id['rdacctype'],'RD_Trans_Type' => $id['rdtrantyp'],'RD_Particulars' => $id['rdpar'],'RD_Amount' => $id['rdamount'],'RD_CurrentBalance' => $id['rdcb'],'RD_Total_Bal' => $id['rdtb'],'RD_Date' => $id['rddte'],'RDReport_TranDate'=>$id['rddte'],'RD_Month'=>$mnt,'RD_Year'=>$year,'RD_Time'=>$tm,'Bid'=>$id['rdbranch'],'RDPayment_Mode'=>$id['rdpaymode'],'RDCheque_Number'=>$id['rdchequeno'],'RDCheque_Date'=>$id['rdchdate'],'RDCleared_State'=>$id['rdunclearedval'],'RDUncleared_Bal'=>$id['rduncleared'],'RDBank_Name'=>$id['rdbankname'],'RDBank_Branch'=>$id['rdbankbranch'],'RDIFSC_Code'=>$id['rdifsccode'],'CreatedBy'=>$UID,'LedgerHeadId'=>"38",'SubLedgerId'=>"43"]); 
			
				/***********/
				$fn_data["rv_payment_mode"] = $rdpay;
				$fn_data["rv_transaction_id"] = $rd_tran_id;
				$fn_data["rv_transaction_type"] = $id['rdtrantyp'];
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::RD_TRAN;//constant RD_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['rddte'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			if($rdpay!="SB ACCOUNT")
			{
			    $sb=DB::table('createaccount')->where('Accid',$acid)
			    ->update(['Total_Amount'=>$totbal]);
			}
			
			if($rdpay!="CHEQUE" && $rdpay!="SB ACCOUNT")
			{
				
				
				$tr_date = $id['rddte'];
				$td_date = date("Y-m-d");
				
				// $diff = abs(strtotime($td_date) - strtotime($tr_date));
				// $diff_in_hrs = $diff/60/60;
				// echo "diff_in_hrs="; print_r("$diff_in_hrs");
				
				
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$totcash=$inhandcash1+$rdamt;
				
				//if($diff_in_hrs < 12)
					DB::table('cash')->where('BID','=',$BID)
					->update(['InHandCash'=>$totcash]);
				
				$trandate=date('Y-m-d');
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to RD Account",'InhandTrans_Cash'=>$rdamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
				
			}
			if($rdpay=="SB ACCOUNT")
			{
		      // $SBaccount_no=explode('-',$accnts);
		  	  //$SBAccNum= $SBaccount_no[1];
		      
			  $AccTTid = DB::table('createaccount')->select('AccTid','Total_Amount')->where('Accid',$sb_id)->first();
			  $AccTid=$AccTTid->AccTid;
			//  $Accid=$AccTTid->Accid;
			  $Amount_total=$AccTTid->Total_Amount;
			  
			  $totalAmount=$Amount_total-$rdamt; //calculate Amount
			  
			  DB::table('createaccount')->where('Accid',$sb_id)
			   ->update(['Total_Amount'=>$totalAmount]);  //update account
			  
			  $sb=DB::table('createaccount')->where('Accid',$acid)
			    ->update(['Total_Amount'=>$totbal]);
			    $sbamt=$id['rdamount'];
				
			    $totalblnc=$Amount_total;
				$id = DB::table('sb_transaction')->insertGetId(['AccTid' => $AccTid,'Bid' =>$bid,'Accid' => $sb_id,'TransactionType' => "DEBIT",'particulars' => "Amount debited for RD account",'Amount' =>$rdamt,'CurrentBalance' => $Amount_total,'tran_Date'=>date('Y-m-d'),'Time'=>$tm,'Month'=>$mnt,'Year'=>$year,'Total_Bal'=>$totalAmount,'Payment_Mode'=>"SB ACCOUNT",'Cleared_State'=>"CLEARED",'Uncleared_Bal'=>'', 'SubLedgerId'=>42]);
				
			}
			return $rd_tran_id;
		}
		
		public function getrdvalue($id)
		{
			/*$query2=DB::table('rd_transaction')
			->where('rd_transaction.Accid','=',$id)
			->max('rd_transaction.RD_TransID');
			
			return DB::table('rd_transaction')
			->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->join('user','createaccount.Uid','=','user.Uid')
			->join('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->select('rd_transaction.RD_Total_Bal','accounttype.Acc_Type','user.FirstName','accounttype.AccTid','createaccount.Duration')
			->where('rd_transaction.Accid','=',$id)
			->where('rd_transaction.RD_TransID','=',$query2)
			->first();*/
			//return $id;
			
			
		 $id= DB::table('createaccount')->select('Total_Amount','createaccount.AccTid','FirstName','Acc_Type','Duration')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->leftJoin('accounttype','accounttype.AccTid','=','createaccount.AccTid')
			->where('Accid','=',$id)
			->first();
		
			return $id;
		}
		public function getrdaccount($q)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
			$ret_data = DB::table('createaccount')
			->select(DB::raw('Accid as id, CONCAT(`Accid`,"-",`AccNum`) as name'))
			->where('AccNum','like','%RD%')
			->where('Status','=',"AUTHORISED");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where('createaccount.Bid','=',$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		public function get_running_rd_num($q)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;

			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
			$ret_data =  DB::table('createaccount')
				->select(DB::raw('Accid as id, CONCAT(`Accid`,"-",`AccNum`) as name'))
				->where('AccNum','like','%RD%')
				->where('Status','=',"AUTHORISED")
				->where('createaccount.Closed','=',"NO");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("createaccount.Bid",$BID);
			}
			$ret_data = $ret_data->get();

			return $ret_data;
		}
		
		public function GetSeachedAcc($q)
		{
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			return DB::table('createaccount')
			->where('createaccount.Bid','=',$BID)
			->select(DB::raw('Accid as id, CONCAT(`Old_AccNo`,"-",`AccNum`,"-",`FirstName`,"  ",`MiddleName`,"  ",`LastName`) as name'))
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->where('Status','=',"AUTHORISED")
			
			->get();
		}
		
		public function GetSeachedOldAcc($q)
		{
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
			return DB::table('createaccount')
			->select(DB::raw('Accid as id, CONCAT(`Accid`,"-",`Old_AccNo`) as name'))
			->where('Status','=',"AUTHORISED")
			->get();
		}
		
		public function checkaccount($id)
		{
			//print_r($id);
			$id= DB::table('createaccount')
			->select('createaccount.Uid')
			->join('user','user.Uid','=','createaccount.Uid')
			->where('createaccount.Uid','=',$id['userid'])
			->where('AccTid','=',"1")
			->first();
			return $id;
		}
		
		public function GetSearchAccs($id)
		{
			$id = DB::table('createaccount')->select('Accid','AccNum','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo','Agent_ID','Total_Amount')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('Accid',$id)
			->get();
			
			return $id;
		}
		
		public function GetSearchOldAccs($id)
		{
			$id = DB::table('createaccount')->select('Accid','Old_AccNo','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('Accid',$id)
			->get();
			
			return $id;
			}
		
		public function Getloanaccount($q)
		{
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
			return DB::table('createaccount')
			->select(DB::raw('Accid as id, CONCAT(`Accid`,"-",`AccNum`) as name'))
			//->where('AccNum','like','%SB%')
			//->where('Bid','=',$id)
			->get();
		}
		
		public function GetBranchid($branch)
		{
			$id=DB::table('branch')
			->select('BCode')
			->where('Bid','=',$branch)
			->first();
			return $id;
		}
		
		
		//This retrieves the account number for SbReport To serach Per SB account report Called from SearchController //GetSeachedSbAccount function.
		public function GetSeachedSbAcc($q) 
		{
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `Accid` LIKE '%".$q."%' ");
			return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%SB%' ");
			
		}
		
		public function GetSearchSbAccWithOldAcc($q) 
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			
			$check_branch = "";
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$check_branch = "AND `createaccount`.`Bid`={$BID}";
			}

			return DB::select("SELECT `Accid` as id, CONCAT(`Old_AccNo`,'/',`AccNum`,':',CASE Closed
               WHEN 'YES' THEN 'Closed'
               WHEN 'NO' THEN 'Active'
              ELSE Closed
		END) as name FROM `createaccount` where `AccNum` LIKE '%SB%' {$check_branch}");
			
		}
		
		public function GetSearchRdAccWithOldAcc($q) 
		{
			
			return DB::select("SELECT `Accid` as id, CONCAT(`Old_AccNo`,'/',`AccNum`,':',CASE Closed
               WHEN 'YES' THEN 'Closed'
               WHEN 'NO' THEN 'Active'
              ELSE Closed
            END) as name FROM `createaccount` where `AccNum` LIKE '%RD%' ");
			
		}
		
		
		//This retrieves the account number for RdReport To serach Per RD account report Called from SearchController //GetSeachedRdAccount function.
		public function GetSeachedRdAcc($q) 
		{
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `Accid` LIKE '%".$q."%' ");
			return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%RD%' ");
			
		}
		
		public function insert_loantran($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$dte=date('d-m-Y');
			$reportdte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			$tm=date('h:i:s');
			
			$paymode=$id['lnpaymode'];
			$aid=$id['account'];
			
			$acid = DB::table('loan_transaction')->insertGetId(['LoanTrans_Time'=> $tm,'LoanTrans_Date' => $dte,'LoanReport_TranDate' => $reportdte,'Bid' => $id['branch'],'Accid' => $id['account'],'LoanTrans_LoanAmt' => $id['lnamt'],'LoanTrans_RemAmt' => $id['lnremamt'],'LoanTrans_PayMode' => $id['lnpaymode'],'LoanTrans_Chqdte' => $id['lnchdate'],'LoanTrans_Chqno'=>$id['lnchequeno'],'LoanTrans_bnkname'=>$id['lnbankname'],'LoanTrans_bnkbranch'=>$id['lnbankbranch'],'LoanTrans_ifsc'=>$id['lnifsccode'],'LoanTrans_AmtPaid'=>$id['payamt'],'LoanTrans_particular'=>$id['lnpar'],'LoanTrans_RemTotal'=>$id['lnremtot'],'LoanChqCleared_State'=>$id['lnunclearedval'],'LoanUncleared_Bal'=>$id['lnuncleared'],'CreatedBy'=>$UID]); 
			if($paymode!="CHEQUE")
			{
				$reid=DB::table('loanremaining_balance')->where('Accid',$aid)
				->update(['Loan_TotalRem'=>$id['lnremtot']]);
			}
			
			if($paymode=="SB ACCOUNT")
			{
				$actid=DB::table('accounttype')
				->select('AccTid')
				->where('Acc_Type','like','%SB%')
				->first();
				$accountid=$actid->AccTid;
				
				/*$bal=DB::table('sb_transaction')
					->select('Total_Bal')
					->where('Accid','=',$aid)
					->where('Tranid','=',$max)
				->first();*/
				
				$sbamt=$id['amtavail'];
				$sbrem=$id['lnsbrem'];
				//$a=$id['branch'];
				
				$id = DB::table('sb_transaction')->insertGetId(['AccTid' => $accountid,'Bid' => $id['branch'],'Accid' => $id['account'],'TransactionType' => "DEBIT",'particulars' => "Amount debited for loan account",'Amount' => $id['payamt'],'CurrentBalance' => $id['amtavail'],'tran_Date'=>$id['lndte'],'Time'=>$id['lntme'],'Month'=>$mnt,'Year'=>$year,'Total_Bal'=>$id['lnsbrem'],'Payment_Mode'=>"LOAN",'Cleared_State'=>"CLEARED",'Uncleared_Bal'=>$id['lnuncleared']]);
			}
			
			return $id;
		}
		
		public function CreateJointAcc($id)
		{
			
			$dte=date('d-m-Y');
			$repdte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			$branchcode=$id['branchcd'];
			$type=$id['atype'];
			$accountnm=$branchcode.$type;
			echo $accountnm;
			$count=1;
			$count_inc;
			$accno = DB::table('createaccount')
			->where('AccNum','like','%'.$accountnm.'%')
			->count();
			
			if($type=="SB")
			{
				if($accno==0)
				{
					$count_inc="PCIS".$branchcode."SB".$count;
					
				}
				else
				{
					$count_inc="PCIS".$branchcode."SB".($accno+1);
				}
			}
			
			//Inserting into Nominee Table
			$nid = DB::table('nominee')->insertGetId(['Nom_FirstName'=> $id['nfname'],'Nom_MiddleName' => $id['nmname'],'Nom_LastName' => $id['nlname'],'Nom_Gender' => $id['ngender'],'Nom_Marital_Status' => $id['nmstate'],'Nom_Occupation' => $id['noccup'],'Nom_Age' => $id['nage'],'Nom_Birthdate' => $id['nbdate'],'Nom_Email' => $id['nemail'],'Nom_Address' => $id['nadd'],'Nom_City' => $id['ncity'],'Nom_District' => $id['ndist'],'Nom_state' => $id['nstate'],'Nom_MobNo' => $id['nmno'],'Nom_Pincode' => $id['npin'],'Nom_PhoneNo'=>$id['npno'],'Uid'=>$id['jointuid'],'JointUid'=>$id['jointuid'],'Nom_District'=>$id['ndist']]); 
			//Inserting into createaccount Table
			$acid = DB::table('createaccount')->insertGetId(['AccNum'=>$count_inc,'Old_AccNo'=>$id['oldaccno'],'Duration'=>$id['rddurtn'],'AccTid'=>$id['acctyp_11'],'Bid'=>$id['branchid'],'Uid'=>$id['jointuid'],'JointUid'=>$id['jointuid'],'opening_blance'=>$id['ob'],'nid'=>$nid,'Created_on'=>$id['crtdte'],'AccountCategory'=>"JOINTACCOUNT", 'Closed'=>"NO" ]);
			if($type=="SB")
			{
				
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
				$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
				
				->leftJoin('branch','branch.Bid','=','user.Bid')
				->where('user.Uid','=',$UID)
				->first();
				
				$b=$udetail->BName;
				//echo $b;
				$bid=$udetail->Bid;
				$u=$udetail->Uid;
				$amount1=$id['ob'];
				
				
				//Inserting into sb_transaction Table
				$id = DB::table('sb_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $id['acctyp_11'],'TransactionType' => "Credit",'particulars' => "Opening Balance",'Amount' => $id['ob'],'CurrentBalance' => "0",'Total_Bal' => $id['ob'],'tran_Date' => $dte,'SBReport_TranDate'=>$repdte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$UID,'Bid'=>$bid,'Payment_Mode'=>"SB"]);
				
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('Branch','=',$b)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$amount1;
				DB::table('cash')->where('Branch','=',$b)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to Joint Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
				
				
			}
			
			return $id;
			
			
			
		}
		
		
		
		
		
		public function CreateMinorAccount($id)
		{
			
			$dte=date('d-m-Y');
			$repodte=date('Y-m-d');
			$year=date('Y');
			$mnt=date('m');
			$branchcode=$id['branchcd'];
			$type=$id['atype'];
			$accountnm=$branchcode.$type;
			echo $accountnm;
			$count=1;
			$count_inc;
			$accno = DB::table('createaccount')
			->where('AccNum','like','%'.$accountnm.'%')
			->count();
			
			if($type=="SB")
			{
				if($accno==0)
				{
					$count_inc="PCIS".$branchcode."SB".$count;
					
				}
				else
				{
					$count_inc="PCIS".$branchcode."SB".($accno+1);
				}
			}
			
			//Inserting into Nominee Table
			$nid = DB::table('nominee')->insertGetId(['Nom_FirstName'=> $id['nfname'],'Nom_MiddleName' => $id['nmname'],'Nom_LastName' => $id['nlname'],'Nom_Gender' => $id['ngender'],'Nom_Marital_Status' => $id['nmstate'],'Nom_Occupation' => $id['noccup'],'Nom_Age' => $id['nage'],'Nom_Birthdate' => $id['nbdate'],'Nom_Email' => $id['nemail'],'Nom_Address' => $id['nadd'],'Nom_City' => $id['ncity'],'Nom_District' => $id['ndist'],'Nom_state' => $id['nstate'],'Nom_MobNo' => $id['nmno'],'Nom_Pincode' => $id['npin'],'Nom_PhoneNo'=>$id['npno'],'Uid'=>$id['user_ss'],'JointUid'=>$id['user_ss'],'Nom_District'=>$id['ndist']]); 
			
			//Inserting into createaccount Table
			$acid = DB::table('createaccount')->insertGetId(['AccNum'=>$count_inc,'Old_AccNo'=>$id['oldaccno'],'AccTid'=>$id['acctyp_11'],'Bid'=>$id['branchid'],'Uid'=>$id['user_ss'],'JointUid'=>$id['user_ss'],'opening_blance'=>$id['ob'],'nid'=>$nid,'Created_on'=>$id['crtdte'],'AccountCategory'=>"MINORACCOUNT"]);
			if($type=="SB")
			{
				
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
				$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
				
				->leftJoin('branch','branch.Bid','=','user.Bid')
				->where('user.Uid','=',$UID)
				->first();
				
				$b=$udetail->BName;
				$bid=$udetail->Bid;
				$amount1=$id['ob'];
				
				
				//Inserting into sb_transaction Table
				$id = DB::table('sb_transaction')->insertGetId(['Accid'=> $acid,'AccTid' => $id['acctyp_11'],'TransactionType' => "Credit",'particulars' => "Opening Balance",'Amount' => "0",'CurrentBalance' => $id['ob'],'Total_Bal' => $id['ob'],'tran_Date' => $dte,'SBReport_TranDate'=>$repodte,'Month'=>$mnt,'Year'=>$year,'CreatedBy'=>$UID,'CreatedBy'=>$UID]);
				
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('Branch','=',$b)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$amount1;
				DB::table('cash')->where('Branch','=',$b)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				$totcash=$inhandcash1+$amount1;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to Minor Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			
			return $id;
			
			
			
		}
		
		
		public function updateaccount($id)
		{
			
			DB::table('nominee')->where('Nid',$id['nid'])
			->update(['Nom_FirstName'=> $id['nfname'],'Nom_MiddleName' => $id['nmname'],'Nom_LastName' => $id['nlname'],'Nom_Gender' => $id['ngender'],'Nom_Marital_Status' => $id['nmstate'],'Nom_Occupation' => $id['noccup'],'Nom_Age' => $id['nage'],'Nom_Birthdate' => $id['nbdate'],'Nom_Email' => $id['nemail'],'Nom_Address' => $id['nadd'],'Nom_City' => $id['ncity'],'Nom_District' => $id['ndist'],'Nom_state' => $id['nstate'],'Nom_MobNo' => $id['nmno'],'Nom_Pincode' => $id['npin'],'Nom_PhoneNo'=>$id['npno'],'Nom_District'=>$id['ndist'],'Relationship'=>$id['relation'],'Uid'=>$id['uid']]);
			
			DB::table('createaccount')->where('Accid',$id['acid'])
			->update(['Total_Amount'=>$id['totamt']]);
			return $id;
			
			
		}
		
		public function GetRDNumForLoanAlloc($q)
		{
			//return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%RD%' ");
			
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data =  DB::table('createaccount')
			->select(DB::raw('Accid as id,AccNum as name'))
			->where('Closed','<>',"YES")
			->where('Loan_Allocated','=',"NO")
			->where('AccNum','like','%RD%');
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("createaccount.Bid", $BID);
			}
			//->where('Status','=',"AUTHORISED")
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		public function calc_sb_bal($data = 0)
		{
			$acc_id = $data['acc_id'];
			if(empty($acc_id)) {
				return "acc_id required";
			}
			$init_amt = 0;
			$init_date = '0000-00-00';
			
			$bal = $init_amt;
			$transactions = DB::table('sb_transaction')
				->select('Tranid','Amount','TransactionType')
				->where('Accid','=',$acc_id)
				->where('tran_reversed','=','NO')
				->orderBy('tran_Date','asc')
				->get();
				
			foreach($transactions as $key=>$row) {
				$type = strtoupper($row->TransactionType);
				$temp_amt = strtoupper($row->Amount);
				
				switch($type) {
					case "CREDIT":	$bal += $temp_amt;
									break;
					case "DEBIT":	$bal -= $temp_amt;
									break;
					default		:	print_r("Inavlid TransactionType (TransactionType= {$row->TransactionType}, Tranid={$row->Tranid})");	echo "<br />";
				}
				
			}
				
			return $bal;
		}
		
		public function get_account_balance($data)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
				$trans = DB::table('sb_transaction')->select('sb_transaction.Accid','SBReport_TranDate','TransactionType','Amount','Total_Bal','Tranid','particulars','CurrentBalance','Cleared_State','CurrentBalance','Uncleared_Bal')
				->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
				->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
				->where('sb_transaction.Accid',$data["acc_id"])
//				->where('sb_transaction.Tranid','>',$tranid)
				->where("tran_reversed","=","NO")
//				->where("SBReport_TranDate","!=",$start)
//				->where("Cleared_State","!=","UNCLEARED")
//				->where("Uncleared_Bal","=",0)
//				->where("sb_transaction.SBReport_TranDate","<",$start)
//				->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '0000-00-00' AND '".$start."'")
				->where("sb_transaction.deleted","=",0)
				->orderBy('SBReport_TranDate','asc')
				->orderBy('Tranid','asc')
				->get();
				
				$total_amt = 0;
				foreach($trans as $row) {
					if(strcasecmp($row->TransactionType, "CREDIT") == 0) {
						if($row->Cleared_State != "UNCLEARED" && !($row->Uncleared_Bal > 0)) {
							$total_amt += $row->Amount;
						}
					} else {
						if($row->Cleared_State != "UNCLEARED" && !($row->Uncleared_Bal > 0)) {
							$total_amt -= $row->Amount;
						}
					}
				}
			return $total_amt;
		}
		
		public function swap_sb_tranid($data)
		{
			$sb_tran_id_1 = $data["sb_tran_id_1"];//38188;//
			$sb_tran_id_2 = $data["sb_tran_id_2"];//38187;//
			
			print_r($sb_tran_id_1); echo "<br />"; print_r($sb_tran_id_2);
			
			$max_sb_tranid = DB::table("sb_transaction")
				->select(DB::Raw('max(Tranid) as max_sb_tranid'))
				->value('max_sb_tranid');
				
			$temp_sb_tranid = $max_sb_tranid + 3;
			
			DB::table("sb_transaction")
				->where("Tranid","=",$sb_tran_id_1)
				->update(["Tranid"=>$temp_sb_tranid]);
			
			DB::table("sb_transaction")
				->where("Tranid","=",$sb_tran_id_2)
				->update(["Tranid"=>$sb_tran_id_1]);
			
			DB::table("sb_transaction")
				->where("Tranid","=",$temp_sb_tranid)
				->update(["Tranid"=>$sb_tran_id_2]);
		}
		
		public function delete_sb_tranid($data)
		{
			$sb_tran_id = $data["sb_tran_id"];
			
			DB::table("sb_transaction")
				->where("Tranid","=",$sb_tran_id)
				->delete();
			
			return $sb_tran_id;
		}
		
		public function account_list_sb($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BranchId=$uname->Bid;
			
			$ret_data["account_list"] = array();
			$ret_data["account_type"] = $data["account_type"];
			$table = "createaccount";
			$branch_id_field = "{$table}.Bid";
			$account_type_field = "{$table}.AccTid";
			$closed_field = "{$table}.Closed";
			$account_id_field = "{$table}.Accid";
			$select_array = array(
									"{$table}.Accid as account_id",
									"{$table}.AccNum as account_no",
									"{$table}.Old_AccNo as old_account_no",
									"{$table}.Created_on as start_date",
									"{$table}.Maturity_Date as end_date",
									"{$table}.AccountCategory as account_category",
									"{$table}.JointUid as joint_user_ids",
									"{$table}.Closed as closed",
									"{$table}.Total_Amount as balance",
									"{$table}.Agent_ID as agent_id",
									"{$table}.Duration as duration",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"accounttype.Acc_Type as account_type"
								);
			$account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$table}.Uid")
				->join("accounttype","accounttype.AccTid","=","{$table}.AccTid")
				->where("status","AUTHORISED");
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$account_list = $account_list->where($branch_id_field,"=",$BranchId);
				}
				// 
			if(!empty($data["account_id"])) {
				$account_list = $account_list
									->where($account_id_field,"=",$data["account_id"]);
			} else {
				$account_list = $account_list
									->where($account_type_field,"=",$data["account_type"])
									->where($closed_field,"=",$data["closed"]);
			}
			$account_list = $account_list
								->get();
							
			$i = -1;
			foreach($account_list as $row_acc_list) {
				$ret_data["account_list"][++$i]["account_id"] = $row_acc_list->account_id;
				$ret_data["account_list"][$i]["account_no"] = $row_acc_list->account_no;
				$ret_data["account_list"][$i]["old_account_no"] = $row_acc_list->old_account_no;
				$ret_data["account_list"][$i]["user_id"] = $row_acc_list->user_id;
				//IF JOINT ACCOUNT
				if($row_acc_list->account_category == "JOINTACCOUNT") {
					$joint_user_ids = explode(",",$row_acc_list->joint_user_ids);
					$ret_data["account_list"][$i]["name"] = "";
					$first_flag = true;
					foreach($joint_user_ids as $joint_uid) {
						$joint_user = DB::table("user")
							->select(
										"user.Uid as user_id",
										"user.FirstName as first_name",
										"user.MiddleName as middle_name",
										"user.LastName as last_name"
									)
							->where("Uid","=",$joint_uid)
							->first();
						if($first_flag) {
							$first_flag = false;
							$ret_data["account_list"][$i]["name"] .= "{$joint_user->first_name} {$joint_user->middle_name} {$joint_user->last_name}";
						} else {
							$ret_data["account_list"][$i]["name"] .= ", {$joint_user->first_name} {$joint_user->middle_name} {$joint_user->last_name}";
						}
					}
				} else {
					$ret_data["account_list"][$i]["name"] = "{$row_acc_list->first_name} {$row_acc_list->middle_name} {$row_acc_list->last_name}";
				}
				//JOINT ACCOUNT END
				$ret_data["account_list"][$i]["account_type"] = $row_acc_list->account_type;
				$ret_data["account_list"][$i]["start_date"] = $row_acc_list->start_date;
				$ret_data["account_list"][$i]["end_date"] = $row_acc_list->end_date;
				$ret_data["account_list"][$i]["duration"] = $row_acc_list->duration;
				if($row_acc_list->account_type == "SB") {
					$ret_data["account_list"][$i]["balance"] = $this->get_account_balance(["acc_id"=>$row_acc_list->account_id]);
				} else {
					$ret_data["account_list"][$i]["balance"] = $row_acc_list->balance;
				}
				$ret_data["account_list"][$i]["closed"] = $row_acc_list->closed;

				//RD AGENT NAME
				if($row_acc_list->agent_id != 0) {
					$agent = DB::table("user")
						->select(
							DB::raw(" concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`) as 'agent_name' ")
						)
						->where("user.Uid",$row_acc_list->agent_id)
						->first();
					$temp_agent_id = "({$row_acc_list->agent_id})";
					$temp_agent_name = $agent->agent_name;
				} else {
					$temp_agent_id = "";
					$temp_agent_name = "";
				}
				// $ret_data["account_list"][$i]["agent_id"] = $temp_agent_id;
				$ret_data["account_list"][$i]["agent_name"] = $temp_agent_name . $temp_agent_id;
			}
			
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function account_edit_sb_rd($data)
		{
			$table = "createaccount";
			return DB::table($table)
				->where("Accid","=",$data["account_id"])
				->update(["Closed"=>$data["closed"]]);
		}
		
	}

	