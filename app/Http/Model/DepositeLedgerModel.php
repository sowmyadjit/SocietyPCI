<?php
	
	namespace App\Http\Model;
	use DB;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	
	class DepositeLedgerModel extends Model
	{
		protected $table='sb_transaction';
		
		
		public function GetSbLedgerPerData($id)
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$sbaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('sb_transaction')->select('sb_transaction.Accid','SBReport_TranDate','TransactionType','Amount','Total_Bal','Tranid','particulars','CurrentBalance')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
			->where('sb_transaction.Accid',$sbaid)
			->where('sb_transaction.Bid','=',$BranchId)
			->where("createaccount.deleted",0)
			->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->orderBy('SBReport_TranDate','asc')
			->orderBy('Tranid','asc')
			//->get();
			->paginate(15);
			
			return $id;
		}
		
		public function GetSbLedgerCustData($id)
		{
			$sbaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('createaccount')->select('AccNum','Old_AccNo','createaccount.Created_on','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->leftJoin('address','address.Aid','=','user.Aid')
			->leftJoin('nominee','nominee.Nid','=','createaccount.nid')
			->where('createaccount.Accid',$sbaid)
			->where('createaccount.Bid','=',$BranchId)
			->first();
			
			return $id;
		}
		
		public function GetRdLedgerPerData($id)//04-04-16
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$sbaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('rd_transaction')->select('rd_transaction.Accid','RDReport_TranDate','RD_Trans_Type','RD_Amount','RD_Total_Bal','RD_TransID','RD_Particulars','RD_CurrentBalance')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->leftJoin('accounttype','accounttype.AccTid','=','rd_transaction.AccTid')
			->where('rd_transaction.Accid',$sbaid)
			->where('rd_transaction.Bid','=',$BranchId)
			->where("createaccount.deleted",0)
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->orderBy('RDReport_TranDate','asc')
			->orderBy('RD_TransID','asc')
			//->get();
			->paginate(15);
			
			return $id;
		}
		
		public function GetRdLedgerCustData($id)//04-04-16
		{
			$sbaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('createaccount')->select('AccNum','Old_AccNo','createaccount.Created_on','createaccount.Maturity_Date','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->leftJoin('address','address.Aid','=','user.Aid')
			->leftJoin('nominee','nominee.Nid','=','createaccount.nid')
			->where('createaccount.Accid',$sbaid)
			->where('createaccount.Bid','=',$BranchId)
			->first();
			
			return $id;
		}
		
		public function GetFdLedgerPerData($id)//04-04-16
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$fdaid=$id['SearchAccId'];
			$allornot=$id['AllorNot'];
			$FdStat=$id['FdStatus'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			if($allornot=="ALL"||$allornot=="All"||$allornot=="all"||$FdStat=="ALL")
			{
				$id = DB::table('fdallocation')->select('Fdid','Fd_CertificateNum','Fd_OldCertificateNum','FdReport_StartDate','FdReport_MatureDate','fdallocation.FdTid','Fd_DepositAmt','Fd_TotalAmt','fdallocation.interest_amount','Fd_Remarks','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship','FatherName','SpouseName','Kan_FatherName','Kan_SpouseName','fdtype.FdType','NumberOfYears','NumberOfDays','fdtype.FdInterest')
				->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
				->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
				->leftJoin('address','address.Aid','=','user.Aid')
				->leftJoin('nominee','nominee.Nid','=','fdallocation.Nid')
				->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
				//->where('fdallocation.Fdid',$fdaid)
				->where('fdallocation.Bid','=',$BranchId)
				->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
				->orderBy('FdReport_StartDate','asc')
				->orderBy('fdallocation.Fd_CertificateNum','asc')
				//->orderBy('RD_TransID','asc')
				//->first();
				->paginate(6);
				
				return $id;
			}
			else if($FdStat=="CLOSED"||$FdStat=="ACTIVE")
			{
				if($FdStat=="CLOSED")
				{
					$id = DB::table('fdallocation')->select('Fdid','Fd_CertificateNum','Fd_OldCertificateNum','FdReport_StartDate','FdReport_MatureDate','fdallocation.FdTid','Fd_DepositAmt','Fd_TotalAmt','fdallocation.interest_amount','Fd_Remarks','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship','FatherName','SpouseName','Kan_FatherName','Kan_SpouseName','fdtype.FdType','NumberOfYears','NumberOfDays','fdtype.FdInterest')
					->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
					->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
					->leftJoin('address','address.Aid','=','user.Aid')
					->leftJoin('nominee','nominee.Nid','=','fdallocation.Nid')
					->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
					->where('fdallocation.Closed','=','YES')
					->where('fdallocation.Bid','=',$BranchId)
					->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('FdReport_StartDate','asc')
					->orderBy('fdallocation.Fd_CertificateNum','asc')
					//->orderBy('RD_TransID','asc')
					//->first();
					->paginate(6);
					
					return $id;
				}
				
				else if($FdStat=="ACTIVE")
				{
					$id = DB::table('fdallocation')->select('Fdid','Fd_CertificateNum','Fd_OldCertificateNum','FdReport_StartDate','FdReport_MatureDate','fdallocation.FdTid','Fd_DepositAmt','Fd_TotalAmt','fdallocation.interest_amount','Fd_Remarks','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship','FatherName','SpouseName','Kan_FatherName','Kan_SpouseName','fdtype.FdType','NumberOfYears','NumberOfDays','fdtype.FdInterest')
					->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
					->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
					->leftJoin('address','address.Aid','=','user.Aid')
					->leftJoin('nominee','nominee.Nid','=','fdallocation.Nid')
					->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
					->where('fdallocation.Closed','=','NO')
					->where('fdallocation.Bid','=',$BranchId)
					->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('FdReport_StartDate','asc')
					->orderBy('fdallocation.Fd_CertificateNum','asc')
					//->orderBy('RD_TransID','asc')
					//->first();
					->paginate(6);
					
					return $id;
				}
			}
			else
			{
				$id = DB::table('fdallocation')->select('Fdid','Fd_CertificateNum','Fd_OldCertificateNum','FdReport_StartDate','FdReport_MatureDate','fdallocation.FdTid','Fd_DepositAmt','Fd_TotalAmt','fdallocation.interest_amount','Fd_Remarks','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship','FatherName','SpouseName','Kan_FatherName','Kan_SpouseName','fdtype.FdType','NumberOfYears','NumberOfDays','fdtype.FdInterest')
				->leftJoin('user', 'user.Uid', '=' , 'fdallocation.Uid')
				->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
				->leftJoin('address','address.Aid','=','user.Aid')
				->leftJoin('nominee','nominee.Nid','=','fdallocation.Nid')
				->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
				->where('fdallocation.Fdid',$fdaid)
				->where('fdallocation.Bid','=',$BranchId)
				//->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
				->orderBy('FdReport_StartDate','asc')
				//->orderBy('RD_TransID','asc')
				->first();
				//->paginate(15);
				
				return $id;
				
				
				
				
				
			}
		}
		
		public function GetPigmiLedgerPerData($id)
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$pigmyaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('pigmi_transaction')->select('pigmi_transaction.PigmiAllocID','PigReport_TranDate','Transaction_Type','Amount','pigmi_transaction.Total_Amount','PigmiTrans_ID','Particulars')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->where('pigmi_transaction.PigmiAllocID',$pigmyaid)
			->where('pigmi_transaction.Bid','=',$BranchId)
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->orderBy('PigReport_TranDate','asc')
			->orderBy('PigmiTrans_ID','asc')
			//->get();
			->paginate(15);
			
			return $id;
		}
		
		public function GetPigmiLedgerCustData($id)
		{
			$pigaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('pigmiallocation')->select('PigmiAcc_No','old_pigmiaccno','pigmitype.Interest','pigmiallocation.StartDate','pigmiallocation.EndDate','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship')
			->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			->leftJoin('user','user.Uid','=','pigmiallocation.UID')
			->leftJoin('customer','customer.Uid','=','pigmiallocation.UID')
			->leftJoin('address','address.Aid','=','user.Aid')
			->leftJoin('nominee','nominee.Nid','=','customer.Nid')
			->where('pigmiallocation.PigmiAllocID',$pigaid)
			->where('pigmiallocation.Bid','=',$BranchId)
			->first();
			
			return $id;
		}
		
		public function GetSBLedgerModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','SbLedgerIndex')
			->first();
			return $id;
		}
		
		public function GetRDLedgerModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','RdLedgerIndex')
			->first();
			return $id;
		}
		
		public function GetFDLedgerModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','FdLedgerIndex')
			->first();
			return $id;
		}
		
		public function GetPigmyLedgerModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','PigmiLedgerIndex')
			->first();
			return $id;
		}
	}
