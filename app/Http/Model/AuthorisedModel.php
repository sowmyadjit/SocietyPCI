<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	class AuthorisedModel extends Model
	{
		
		
		//
		protected $table='customer';
		public function GetcustAuthories()
		{	
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$id = DB::table('customer')->select('Custid','customer.FirstName','customer.MiddleName','customer.LastName','BName','AccNum','Gender','OpeningBalance','address.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo','Member_No')
			->leftJoin('branch', 'branch.Bid', '=' , 'customer.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'customer.Aid')
			->leftJoin('user', 'user.Uid', '=' , 'customer.Uid')
			->where('customer.AuthStatus','=',"UNAUTHORISED")
			->where('user.Bid',$BID)
			->get();
			return $id;
		}
		public function GetcustrejAuthories()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$id = DB::table('customer')->select('Custid','customer.FirstName','customer.MiddleName','customer.LastName','BName','AccNum','Gender','OpeningBalance','Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'customer.Bid')
			->leftJoin('address', 'address.Aid', '=' , 'customer.Aid')
			->where('AuthStatus','=',"rejected")
			->where('customer.Bid',$BID)
			->get();
			return $id;
		}
		public function AcceptcustAuthories($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			
			$u=DB::table('customer')->where('Custid',$id)
			->select('Uid')
			->first();
			$a=$u->Uid;
			
			
			$id=DB::table('customer')->where('Custid',$id)
			->update(['AuthStatus'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			
			
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"AUTHORISED"]);
			
			return $id;								   
			
			
		}
		
		public function rejectcustAuthories($id)
		{	/*
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$u=DB::table('customer')->where('Custid',$id)
			->select('Uid')
			->first();
			$a=$u->Uid;
			
			
			$id=DB::table('customer')->where('Custid',$id)
			->update(['AuthStatus'=>"rejected",'AuthorisedBy'=>$UID]);
			
			
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"rejected"]);
			
		return $id;		*/
		$uname='';
		if(Auth::user())
		$uname= Auth::user();
		$UID=$uname->Uid;
		
		$udetail= DB::table('user')->select('Uid','FirstName','MiddleName','LastName','Bid')
		->where('Uid','=',$UID)
		->first();
		
		$b=$udetail->Bid;
		
		$u=DB::table('customer')->where('Custid',$id)
		->select('Uid','Customer_Fee')
		->first();
		$a=$u->Uid;
		$custf=$u->Customer_Fee;
		
		
		$id=DB::table('customer')->where('Custid',$id)
		->update(['AuthStatus'=>"rejected",'AuthorisedBy'=>$UID]);
		
		
		
		DB::table('user')->where('Uid',$a)
		->update(['AuthStatus'=>"rejected"]);
		
		$incash=DB::table('cash')
		->select('InHandCash')
		->where('BID','=',$b)
		->first();
		
		$cash=$incash->InHandCash;
		$tot=$cash-$custf;
		
		$id=DB::table('cash')->where('BID',$b)
		->update(['InHandCash'=>$tot]);
		
		return $id;	
		
		
		}
		
		public function Getunauthaccount()
		{
			$id = DB::table('createaccount')->select('Accid','AccNum','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('status','=',"UNAUTHORISED")
			->where('createaccount.JointUid','=',"")
			->get();
			
			return $id;
		}
		
		public function Getunauthaccount_joint()
		{
			$id = DB::table('createaccount')->select('Accid','AccNum','user.FirstName as user1','user.FirstName as user2','BName','Acc_Type','MobileNo','PhoneNo','createaccount.JointUid')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('status','=',"UNAUTHORISED")
			->where('createaccount.JointUid','!=',"")
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
		
		public function rejectAccountview()
		{
			$id = DB::table('createaccount')->select('Accid','AccNum','user.FirstName','user.MiddleName','user.LastName','BName','Acc_Type','MobileNo','PhoneNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'createaccount.Bid')
			->leftJoin('accounttype', 'accounttype.AccTid', '=' , 'createaccount.AccTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'createaccount.nid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('status','=',"rejected")
			->get();
			
			return $id;
		}
		public function AcceptAccount($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('createaccount')->where('Accid',$id)
			->update(['Status'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			return $id;								   
			
			
		}
		public function rejectAccount($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$udetail= DB::table('user')
			->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$bid=$udetail->Bid;
			$u=$udetail->Uid;
			
			$acct=DB::table('createaccount')
			->select('opening_blance')
			->where('Accid','=',$id)
			->first();
			$opb=$acct->opening_blance;
			
			$incash=DB::table('cash')
			->select('InHandCash')
			->where('BID','=',$bid)
			->first();
			
		    $curcash=$incash->InHandCash;
			$totincash=$curcash-$opb;
			
			DB::table('cash')
			->where('BID',$bid)
			->update(['InHandCash'=>$totincash]);
			
			$trandate=date('Y-m-d');
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"SB/RD Account Rejected",'InhandTrans_Cash'=>$opb,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$curcash,'Total_InhandCash'=>$totincash]);
			
			
			$id=DB::table('createaccount')
			->where('Accid',$id)
			->update(['Status'=>"rejected",'AuthorisedBy'=>$UID]);
			
			return $id;								   
			
			
		}
		
		public function Getunauthpigmy()
		{
		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			return DB::table('pigmiallocation')
			->join('user','pigmiallocation.Uid','=','user.Uid')
			->join('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->select('user.FirstName','pigmitype.Pigmi_Type','pigmiallocation.AllocationDate','pigmiallocation.StartDate','pigmiallocation.EndDate','pigmiallocation.PigmiAllocID','pigmiallocation.PigmiTypeid','pigmiallocation.PigmiAcc_No','Interest','max_Interest','Max_Commission','LastName','MiddleName')
			->where('status','=','UNAUTHORISED')
			->where('pigmiallocation.Bid',$BID)
			->get();
		}
		public function AcceptAccountpigmy($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('pigmiallocation')->where('PigmiAllocID',$id)
			->update(['Status'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			return $id;								   
			
			
		}
		public function rejectAccountpigmy($id)
		{		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			//$b=$udetail->BName;
			$bid=$udetail->Bid;
			$u=$udetail->Uid;
			
			
			
			$alloc=DB::table('pigmiallocation')
			->select('Opening_Balance')
			->where('PigmiAllocID','=',$id)
			->first();
			$ob=$alloc->Opening_Balance;
			
			$cash=DB::table('cash')
			->select('InHandCash')
			->where('BID','=',$bid)
			->first();
			
		    $totcash=$cash->InHandCash;
			$totinhand=$totcash-$ob;
			
			DB::table('cash')
			->where('BID',$bid)
			->update(['InHandCash'=>$totinhand]);
			
			$trandate=date('Y-m-d');
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Pigmy Account Rejected",'InhandTrans_Cash'=>$ob,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$totcash,'Total_InhandCash'=>$totinhand]);
			
			DB::table('pigmiallocation')->where('PigmiAllocID',$id)
			->update(['Status'=>"rejected",'AuthorisedBy'=>$UID]);
			
			/******** REJECT *******/
				$pigmiallocation = DB::table("pigmiallocation")
					->select(
						"pending_pigmy.PpId",
						"pigmiallocation.Agentid",
						"pigmiallocation.StartDate",
						"pigmiallocation.Opening_Balance",
						"pending_pigmy.PendPigmy_Bid"
					)
					->join("pending_pigmy","pending_pigmy.PendPigmy_AgentUid","=","pigmiallocation.Agentid")
					->where("pigmiallocation.PigmiAllocID",$id)
					->where("pending_pigmy.PendPigmy_Status","PENDING")
					// ->where("pigmiallocation.StartDate","=","pending_pigmy.PendPigmy_CollectionDate")
					// ->where("pigmiallocation.Opening_Balance","=","pending_pigmy.PendPigmy_PendingAmount")
					->get();
					
					foreach($pigmiallocation as $row_pg) {
						$temp = DB::table("pending_pigmy")
							->where("pending_pigmy.PpId",$row_pg->PpId)
							->where("pending_pigmy.PendPigmy_AgentUid",$row_pg->Agentid)
							->where("pending_pigmy.PendPigmy_CollectionDate",$row_pg->StartDate)
							->where("pending_pigmy.PendPigmy_PendingAmount",$row_pg->Opening_Balance)
							->where("pending_pigmy.PendPigmy_Bid",$row_pg->PendPigmy_Bid)
							->first();
						if(!empty($temp)) {
							DB::table("pending_pigmy")
								->where("PpId",$temp->PpId)
								->update(["PendPigmy_Status"=>"REJECTED"]);
							break;
						}
					}
			/******** REJECT *******/
			return;
		}
		
		public function GetAuthEmployee()
		{
			$id = DB::table('employee')->select('Eid','ECode','basicpay','incometax','pf','hra','Gender','MaritalStatus','Occupation','Age','Birthdate','user.Email','Address','District','City','State','PhoneNo','MobileNo','Pincode','BName','DName','user.FirstName','user.MiddleName','user.LastName')
			->leftJoin('designation','designation.Did','=','employee.Did')
			->leftJoin('branch','branch.Bid', '=' , 'employee.Bid')
			->leftJoin('address','address.Aid','=','employee.Aid')
			->leftJoin('user','user.Uid','=','employee.Uid')
			->where('status','=',"UNAUTHORISED")
			//->paginate(10);
			->get();
			return $id;
		}
		public function AcceptempAuthories($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$u=DB::table('employee')->where('ECode',$id)
			->select('Uid')
			->first();
			$a=$u->Uid;
			
			
			$id=DB::table('employee')->where('ECode',$id)
			->update(['status'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			
			
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"AUTHORISED"]);
			
			return $id;								   
			
			
		}
		public function rejectempAuthories($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$u=DB::table('employee')->where('ECode',$id)
			->select('Uid')
			->first();
			$a=$u->Uid;
			
			
			$id=DB::table('employee')->where('ECode',$id)
			->update(['status'=>"rejected",'AuthorisedBy'=>$UID]);
			
			
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"rejected"]);
			
			return $id;	
			
			
			
			
			
		}
		public function GetAuthLoan()
		{
			return DB::table('loan_allocation')
			->select('user.FirstName','loan_type.LoanType_Name','branch.BName','loan_allocation.LoanAlloc_ID','loan_allocation.LoanAlloc_LoanAmt','loan_allocation.LoanAlloc_Duration','loan_allocation.LoanAlloc_SDate','loan_allocation.LoanAlloc_EDate')
			->join('loan_type','loan_type.LoanType_ID','=','loan_allocation.LoanType_ID')
			->join('branch','branch.Bid','=','loan_allocation.Bid')
			->join('createaccount','createaccount.Accid','=','loan_allocation.Accid')
			->join('user','user.Uid','=','createaccount.Uid')
			->where('loan_allocation.status','=',"UNAUTHORISED")
			->get();
		}
		
		public function GetUnauthPigmyDL()
		{
			/*return DB::table('depositeloan_allocation')
				->select('user.FirstName','loan_type.LoanType_Name','branch.BName','depositeloan_allocation.DepLoanAllocId','depositeloan_allocation.DepLoan_LoanAmount','depositeloan_allocation.DepLoan_LoanCharge','depositeloan_allocation.DepLoan_LoanStartDate','depositeloan_allocation.DepLoan_LoanEndDate')
				->join('loan_type','loan_type.LoanType_ID','=','depositeloan_allocation.DepLoan_LoanType')
				->join('pigmiallocation','pigmiallocation.PigmiAcc_No','=','depositeloan_allocation.DepLoan_AccNum')
				->join('user','user.Uid','=','pigmiallocation.UID')
				->join('branch','branch.Bid','=','depositeloan_allocation.DepLoan_Branch')
				->where('depositeloan_allocation.DepLoan_Authorise','=',"UNAUTHORISED")
			->get();*/
			
			return DB::table('depositeloan_allocation')
			->select('user.FirstName','loan_type.LoanType_Name','branch.BName','depositeloan_allocation.DepLoanAllocId','depositeloan_allocation.DepLoan_LoanAmount','depositeloan_allocation.DepLoan_LoanCharge','depositeloan_allocation.DepLoan_LoanStartDate','depositeloan_allocation.DepLoan_LoanEndDate')
			->join('loan_type','loan_type.LoanType_ID','=','depositeloan_allocation.DepLoan_LoanType')
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->join('branch','branch.Bid','=','depositeloan_allocation.DepLoan_Branch')
			->where('depositeloan_allocation.DepLoan_Authorise','=',"UNAUTHORISED")
			->get();
			
			
		}
		public function acceptunauthloan($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			
			
			
			$id=DB::table('loan_allocation')->where('LoanAlloc_ID',$id)
			->update(['status'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			
			return $id;			
			
			
		}
		
		public function AcceptUnAuthPigmyDL($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			
			$udetail= DB::table('user')->select('user.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->Bid;
			
			$lid=DB::table('depositeloan_allocation')->where('DepLoanAllocId',$id)
			->update(['DepLoan_Authorise'=>"AUTHORISED",'DepLoan_AuthBy'=>$UID]);
			
			$tid=DB::table('depositeloan_allocation')->select('DepLoan_PaymentMode','DepLoan_LoanCharge','DepLoan_LoanAmount')
			->where('DepLoanAllocId','=',$id)
			->first();
			
			$pym=$tid->DepLoan_PaymentMode;
			$lnc=$tid->DepLoan_LoanCharge;
			$lnamt=$tid->DepLoan_LoanAmount;
			
			if($pym=="SB ACCOUNT")
			{
				$tid1=DB::table('depositeloan_allocation')->select('DepLoan_SbTranId')
				->where('DepLoanAllocId','=',$id)
				->first();
				//print_r($tid);
				
				
				$sbtid=$tid1->DepLoan_SbTranId;
				//$lnc=$tid1->DepLoan_LoanCharge;
				
				
				$sb=DB::table('sb_transaction')
				->select('Amount','CurrentBalance','Total_Bal','Tranid','Accid')
				->where('Tranid','=',$sbtid)
				->first();
				
				
				$accid=$sb->Accid;
				
				$amt=$sb->Amount;
				$cb=$sb->CurrentBalance;
				$tot=($amt+$cb)-$lnc;
				$crbal=$tot;
				$dte=date('d-m-Y');
				
				$id=DB::table('sb_transaction')->where('Tranid',$sbtid)
				->update(['Cleared_State'=>"CLEARED",'Total_Bal'=>$tot,'Uncleared_Bal'=>0,'ChequeClear_Date'=>$dte]);
				
				$aid=DB::table('createaccount')->where('Accid',$accid)
				->update(['Total_Amount'=>$tot]);
				
			}
			
			
			
			
			//$xx=$id['LoanCharge'];
			//$xxx=$id['DepLoanAmt'];
			
			$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$b)->first();
			
			$inhandcash1=$inhandcashh->InHandCash;
			$x=$inhandcash1+$lnc;
			
			DB::table('cash')->where('BID','=',$b)
			->update(['InHandCash'=>$x]);
			
			if($pym=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$b)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$a=$inhandcash1-$lnamt;
				
				DB::table('cash')->where('BID','=',$b)
				->update(['InHandCash'=>$a]);
			}
			
			return $id;			
			
			
		}
		
		public function rejectunauthloan($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('loan_allocation')->where('LoanAlloc_ID',$id)
			->update(['status'=>"rejected",'AuthorisedBy'=>$UID]);
			
			return $id;			
			
			
			
			
		}
		
		public function RejectUnAuthPigmyDL($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('depositeloan_allocation')->where('DepLoanAllocId',$id)
			->update(['DepLoan_Authorise'=>"REJECTED",'DepLoan_AuthBy'=>$UID]);
			
			return $id;			
			
			
			
			
		}
		
		public function accept_rejcustAuthories($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','FirstName','MiddleName','LastName','Bid')
			->where('Uid','=',$UID)
		    ->first();
			
			$b=$udetail->Bid;
			
			
			
			$u=DB::table('customer')->where('Custid',$id)
			->select('Uid','Customer_Fee')
			->first();
			$a=$u->Uid;
			$custf=$u->Customer_Fee;
			
			
			$cid=DB::table('customer')->where('Custid',$id)
			->update(['AuthStatus'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			
			
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"AUTHORISED"]);
			
			
			
			$incash=DB::table('cash')
			->select('InHandCash')
			->where('BID','=',$b)
			->first();
			
			$cash=$incash->InHandCash;
			$tot=$cash+$custf;
			
			$id=DB::table('cash')->where('BID',$b)
			->update(['InHandCash'=>$tot]);
			
			$trandate=date('Y-m-d');
			//$bid=$udetail->Bid;
			//$totcash=$inhandcash1+$amount1;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Rejected Customer Accepted",'InhandTrans_Cash'=>$custf,'InhandTrans_Bid'=>$b,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$cash,'Total_InhandCash'=>$tot]);
			
			return $id;								   
			
			
		}
		
		//Newly Added to accept rejected Accounts
		public function AcceptRejectAccount($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','FirstName','MiddleName','LastName','Bid')
			->where('Uid','=',$UID)
		    ->first();
			
			$bid=$udetail->Bid;
			
			
			
			$u=DB::table('createaccount')->where('Accid',$id)
			->select('opening_blance','Uid')
			->first();
			$a=$u->Uid;
			
			$opbalance=$u->opening_blance;
			
			
			$actid=DB::table('createaccount')->where('Accid',$id)
			->update(['Status'=>"AUTHORISED",'AuthorisedBy'=>$UID]);
			
			
			
			$incash=DB::table('cash')
			->select('InHandCash')
			->where('BID','=',$bid)
			->first();
			
			$cash=$incash->InHandCash;
			$tot=$cash+$opbalance;
			
			$id=DB::table('cash')->where('BID',$bid)
			->update(['InHandCash'=>$tot]);
			
			$trandate=date('Y-m-d');
			//$bid=$udetail->Bid;
			//$totcash=$inhandcash1+$amount1;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Rejected SB/RD Account Accepted",'InhandTrans_Cash'=>$opbalance,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$cash,'Total_InhandCash'=>$tot]);
			
			return $id;								   
			
			
		}
		
		//Show Details of UnAuthorised Personal Loans
		public function show_unauthPLoan($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID = $uname->Bid;

			$lid1=DB::table('loancategory')->select('LoanCategoryId')->where('LoanCategoryName','=',$id)->first();
				$lid=$lid1->LoanCategoryId;
			
			$id = DB::table('request_loan')->select('PersLoanAllocID','branch.BName','members.FirstName','members.MiddleName','members.LastName','Requested_LoanAmt','Request_Date')
			->Join('branch', 'branch.Bid', '=' , 'request_loan.Bid')
			->Join('members', 'members.Memid', '=' , 'request_loan.RL_MemId')
			->where('Auth_Status','=',"UNAUTHORISED")
			->where('Loan_Category','=',$lid)
			->where("request_loan.Bid", $BID)
			->get();
			return $id;
		}
		
		//Accept UnAuthorised Personal Loans
		public function Accept_unauthPLoan($id)
		{
			$dte=date('d-m-Y');
			$repdte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$tme=date('h:i:s');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$ploanallocId=$id['ploanalc'];
			
			$id=DB::table('request_loan')->where('PersLoanAllocID',$ploanallocId)
			->update(['Auth_Status'=>"AUTHORISED",'AutorisedBy'=>$UID,'AmountDecideBy_Board'=>$id['acceptamt'],'Board_ResolutionNo'=>$id['reslnno']]);
			
			return $id;								   
		}
		
		//Reject UnAuthorised Personal Loans
		public function Reject_unauthPLoan($id)
		{		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('request_loan')->where('PersLoanAllocID',$id)
			->update(['Auth_Status'=>"REJECTED",'CreadtedBY'=>$UID]);
			
			return $id;								   
			
		}
		
		//Show Details of UnAuthorised Deposit Loans
		public function show_unauthDLoan($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID = $uname->Bid;

				$lid1=DB::table('loancategory')->select('LoanCategoryId')->where('LoanCategoryName','=',$id)->first();
				$lid=$lid1->LoanCategoryId;
		
			$id = DB::table('request_loan')->select('PersLoanAllocID','branch.BName','user.FirstName','user.MiddleName','user.LastName','Requested_LoanAmt','Request_Date','DepLoan_AccNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'request_loan.Bid')
			->leftJoin('user', 'user.Uid', '=', 'request_loan.Uid')
			->where('Auth_Status','=',"UNAUTHORISED")
			->where('Loan_Category','=',$lid)
			->where("request_loan.Bid", $BID)
			->get();
			return $id;
		}
		
		//Accept UnAuthorised Deposit Loans
		public function Accept_unauthDLoan($id)
		{
			$dte=date('d-m-Y');
			$repdte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$tme=date('h:i:s');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$dloanallocId=$id['dloanal'];
			$boardamt=$id['dacceptamt'];
			$resoution=$id['dreslnno'];
			
			DB::table('request_loan')->where('PersLoanAllocID',$dloanallocId)
			->update(['Auth_Status'=>"AUTHORISED",'AutorisedBy'=>$UID,'AmountDecideBy_Board'=>$boardamt,'Board_ResolutionNo'=>$resoution]);							   
		}
		
		//Reject UnAuthorised Deposit Loans
		public function Reject_unauthDLoan($id)
		{		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('request_loan')->where('PersLoanAllocID',$id)
			->update(['Auth_Status'=>"REJECTED",'AutorisedBy'=>$UID]);
			
			return $id;								   
			
		}
		
		//Show Details of UnAuthorised Staff Loans
		public function show_unauthSLoan($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID = $uname->Bid;
		
			$lid1=DB::table('loancategory')->select('LoanCategoryId')->where('LoanCategoryName','=',$id)->first();
				$lid=$lid1->LoanCategoryId;
			$id = DB::table('request_loan')->select('PersLoanAllocID','branch.BName','user.FirstName','user.MiddleName','user.LastName','Requested_LoanAmt','Request_Date')
			->leftJoin('branch', 'branch.Bid', '=' , 'request_loan.Bid')
			->leftJoin('user', 'user.Uid', '=', 'request_loan.Uid')
			->where('Auth_Status','=',"UNAUTHORISED")
			->where('Loan_Category','=',$lid)
			->get();
			return $id;
		}
		
		//Accept UnAuthorised Staff Loans
		public function Accept_unauthSLoan($id)
		{
			$dte=date('d-m-Y');
			$repdte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$tme=date('h:i:s');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$sloanallocId=$id['sloanal'];
			
			DB::table('request_loan')->where('PersLoanAllocID',$sloanallocId)
			->update(['Auth_Status'=>"AUTHORISED",'AutorisedBy'=>$UID,'AmountDecideBy_Board'=>$id['sacceptamt'],'Board_ResolutionNo'=>$id['sreslnno']]);							   
		}
		
		//Reject UnAuthorised Staff Loans
		public function Reject_unauthSLoan($id)
		{		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('request_loan')->where('PersLoanAllocID',$id)
			->update(['Auth_Status'=>"REJECTED",'AutorisedBy'=>$UID]);
			
			return $id;								  
		}
		
		//Show Details of UnAuthorised Jewel Loans
		public function show_unauthJLoan($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID = $uname->Bid;
		
			$lid1=DB::table('loancategory')->select('LoanCategoryId')->where('LoanCategoryName','=',$id)->first();
		$lid=$lid1->LoanCategoryId;
			$id = DB::table('request_loan')->select('PersLoanAllocID','branch.BName','user.FirstName','user.MiddleName','user.LastName','Requested_LoanAmt','Request_Date','Jewel_Description','Gold_Rate','JewelLoan_Duration')
			->leftJoin('branch', 'branch.Bid', '=' , 'request_loan.Bid')
			->leftJoin('user', 'user.Uid', '=', 'request_loan.Uid')
			->where('Auth_Status','=',"UNAUTHORISED")
			->where('Loan_Category','=',$lid)
			->where("request_loan.Bid", $BID)
			->get();
			return $id;
		}
		
		//Accept UnAuthorised Jewel Loans
		public function Accept_unauthJLoan($id)
		{
			$dte=date('d-m-Y');
			$repdte=date('Y-m-d');
			$mnt=date('m');
			$year=date('Y');
			$tme=date('h:i:s');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$jloanallocId=$id['jloanal'];
			
			DB::table('request_loan')->where('PersLoanAllocID',$jloanallocId)
			->update(['Auth_Status'=>"AUTHORISED",'AutorisedBy'=>$UID,'AmountDecideBy_Board'=>$id['jacceptamt'],'Board_ResolutionNo'=>$id['jreslnno']]);							   
		}
		
		//Reject UnAuthorised Jewel Loans
		public function Reject_unauthJLoan($id)
		{		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$id=DB::table('request_loan')->where('PersLoanAllocID',$id)
			->update(['Auth_Status'=>"REJECTED",'AutorisedBy'=>$UID]);
			
			return $id;								  
		}
		
	}

	