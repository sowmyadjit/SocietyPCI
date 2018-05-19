<?php
	
	namespace App\Http\Model;
	use DB;
	use Auth;
	
	use Illuminate\Database\Eloquent\Model;
	
	class ReportModel extends Model
	{
		protected $table='sb_transaction';
		public function getData()
		{
			$pigtoday=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$sbtoday=date('Y-m-d');
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','FirstName','MiddleName','LastName','createaccount.Old_AccNo')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->where('SBReport_TranDate',$sbtoday)
			->where('sb_transaction.Bid','=',$BranchId)
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->paginate(10);
			
			return $id;
		}
		
		public function GetRdData()
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$dtoday=date('Y-m-d');
			$id = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum','Old_AccNo','FirstName','MiddleName','LastName')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->leftJoin('user', 'user.Uid', '=' , 'createaccount.Uid')
			->where('RDReport_TranDate',$dtoday)
			->where('rd_transaction.Bid','=',$BranchId)
			->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->paginate(10);
			
			return $id;
		}
		
		public function GetLoanData()	
		{
			$id = DB::table('loan_transaction')->select('LoanTrans_ID','LoanTrans_LoanAlloc_ID','LoanReport_TranDate','LoanTrans_Date','LoanTrans_Time','loan_transaction.Bid','loan_transaction.Accid','LoanTrans_LoanAmt','LoanTrans_RemAmt','LoanTrans_PayMode','LoanTrans_Chqdte','LoanTrans_Chqno','LoanTrans_bnkname','LoanTrans_bnkbranch','LoanTrans_ifsc','LoanTrans_Chqbncchrge','LoanTrans_AmtPaid','LoanTrans_particular','LoanTrans_RemTotal','LoanChqCleared_State','LoanUncleared_Bal','createaccount.AccNum','loan_allocation.LoanType_ID','BName','user.FirstName','user.MiddleName','user.LastName','LoanType_Name','LoanAlloc_LoanAmt','LoanAlloc_Duration','LoanAlloc_SDate','LoanAlloc_EDate')
			->leftJoin('loan_allocation', 'loan_allocation.LoanAlloc_ID', '=' , 'loan_transaction.LoanTrans_LoanAlloc_ID')
			->join('loan_type','loan_type.LoanType_ID','=','loan_allocation.LoanType_ID')
			->leftJoin('branch','branch.Bid','=','loan_transaction.Bid')
			->leftJoin('createaccount','createaccount.Accid','=','loan_transaction.Accid')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->orderBy('LoanReport_TranDate','desc')
			->orderBy('LoanTrans_ID','desc')
			->paginate(10);
			
			return $id;
		}
		
		public function getpigmireport()
		{
			$pigtoday=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','FirstName','MiddleName','LastName','pigmi_transaction.Agentid')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			// ->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
			->where('PigReport_TranDate','=',$pigtoday)
			->where('pigmi_transaction.Bid','=',$BranchId)
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->paginate(15);
			return $id;
		}
		
		public function ClosedPigmyData() //M 25-03
		{
			$pigtoday=date('Y-m-d');
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			
			
			$id = DB::table('pigmi_interest')->select('pigmi_interest.PgmInterest_ID','pigmi_interest.PigmiAcc_No','pigmi_interest.Monthtotal_Amount','pigmi_interest.Interest_Amt','pigmi_interest.Interest','pigmi_interest.Month','pigmi_interest.Year','pigmi_interest.PgmInt_Date','pigmi_interest.Amount_Payable','pigmi_interest.Paid_State','PgmPrewithdraw_ID','pigmi_prewithdrawal.PigmiAcc_No','pigmi_prewithdrawal.PgmTotal_Amt','TotalAmt_Payable','','')
			
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->where('PigReport_TranDate','=',$pigtoday)
			->where('Bid','=',$BranchId)
			->orderBy('PigReport_TranDate','desc')
			->orderBy('PigmiTrans_ID','desc')
			->paginate(10);
			return $id;
		}
		/*public function GetDatasb($id)
			{
			$id = DB::table('sb_transaction')->select('tran_Date','TransactionType','Amount','Total_Bal','AccNum','Tranid')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->where('sb_transaction.Accid',$id)
			//->get();
			->paginate(5);
			
			return $id;
		}*/
		
		
		public function GetSbPerReport($id)
		{	
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$sbaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','user.FirstName','user.MiddleName','user.LastName','Old_AccNo')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->where('sb_transaction.Accid',$sbaid)
			->where('sb_transaction.Bid','=',$BranchId)
			->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->paginate(10);
			
			return $id;
		}
		
		public function GetRdPerReport($id) 
		{	
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$rdaid=$id['SearchAccId'];
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('rd_transaction')->select('RD_TransID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum','FirstName','MiddleName','LastName','Old_AccNo')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			
			->leftJoin('accounttype','accounttype.AccTid','=','rd_transaction.AccTid')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->where('createaccount.Bid','=',$BranchId)
			->where('rd_transaction.Accid',$rdaid)
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->paginate(20);
			
			return $id;
		}
		
		public function GetRdDetails($id) 
		{
			$rdaid=$id['SearchAccId'];
			
			$ret_data = DB::table('createaccount')
				->select()
				->leftJoin('accounttype','accounttype.AccTid','=','createaccount.AccTid')
				->where('createaccount.Accid','=',$rdaid)
				->first();
			
			return $ret_data;
		}
		
		public function GetLoanPerReport($id) //PENDING TO EDIT
		{	
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$rdaid=$id['SearchAccId'];
			
			$id = DB::table('loan_transaction')->select('LoanTrans_ID','RDReport_TranDate','RD_Time','rd_transaction.Accid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_CurrentBalance','RD_Month','RD_Year','RD_Total_Bal','AccNum')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			
			->leftJoin('accounttype','accounttype.AccTid','=','rd_transaction.AccTid')
			->where('rd_transaction.Accid',$rdaid)
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->orderBy('RDReport_TranDate','desc')
			->orderBy('LoanTrans_ID','desc')
			->paginate(10);
			
			return $id;
		}
		
		
		public function GetDatapigmy($id)
		{	
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$piaid=$id['SearchAccId'];
			$AllOrNot=$id['AllorNot'];
			
			if($AllOrNot=="all"||$AllOrNot=="ALL"||$AllOrNot=="All")
			{
				$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','FirstName','MiddleName','LastName','old_pigmiaccno','pigmi_transaction.Agentid')
				->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
				->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
                ->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
				//->orderBy('PigReport_TranDate','desc')
				//->orderBy('PigmiTrans_ID','desc')
				->paginate(15);
				
				return $id;
			}
			else
			{
				
				$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','FirstName','MiddleName','LastName','old_pigmiaccno','pigmi_transaction.Agentid')
				->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
				->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
				->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
				->where('pigmi_transaction.PigmiAllocID',$piaid)
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
				->orderBy('PigReport_TranDate','desc')
				->orderBy('PigmiTrans_ID','desc')
				->paginate(10);
				
				return $id;
			}
		}
		public function GetDatapigmytotal($id)
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$piaid=$id['SearchAccId'];
			return DB::table('pigmi_transaction')->where('pigmi_transaction.PigmiAllocID',$piaid)
			->where('Transaction_Type','=',"CREDIT")
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->sum('Amount');
		}
		public function GetBranchDropD() //For Branch wise Report
		{
			
			$BranchList = DB::table('branch')->select('Bid','BName')->get();
			return $BranchList;
		}
		
		public function GetLoanDropD() //For Branch wise Report Thashmitha
		{
			
			$id= DB::table('loancategory')->select('LoanCategoryId','LoanCategoryName')->get();
			//print_r($id);
			return $id;
		}
		
		public function GetPLoanDropD() //For Branch wise Report 
		{
			
			$lcid= DB::table('loancategory')->select('LoanCategoryId')->where('LoanCategoryName',"PERSONAL LOAN")->first();
			
			$id = DB::table('loan_type')->select('LoanType_ID','LoanType_Name','Loan_CategoryId')->where('Loan_CategoryId',$lcid->LoanCategoryId)->get();
			//print_r($id);
			return $id;
		}
		public function GetPLoanDropDL() //For Branch wise Report 
		{
			$id = DB::table('loan_type')->select('LoanType_ID','LoanType_Name','Loan_CategoryId')->where('Loan_CategoryId','=','2')->get();
			
			return $id;
		}
		
		public function GetAgentDropD($id) //For Branch wise Report
		{
			$BranchID=$id['BranchID'];
			if($BranchID!="ALL")
			{
				$BranchID=$id['BranchID'];
				
				$Dsgn = DB::table('designation')->select('Did')
				->where('DName','like','%AGENT%')
				->first();
				$Desig=$Dsgn->Did;
				
				
				$AgentListBW = DB::table('user')->select('BName','BCode','FirstName','MiddleName','LastName','Uid')
				->leftJoin('branch','branch.Bid','=','user.Bid')
				->where('Did','=',$Desig)
				->where('user.Bid','=',$BranchID)
				->orderBy('FirstName','asc')
				->get();
				// print_r($AgentListBW);
				// print_r($BranchID);
				return $AgentListBW;
				
			}
			else
			{
				$Dsgn = DB::table('designation')->select('Did')
				->where('DName','like','%AGENT%')
				->first();
				$Desig=$Dsgn->Did;
				
				
				$AgentListBW = DB::table('user')->select('BName','BCode','FirstName','MiddleName','LastName','Uid')
				->leftJoin('branch','branch.Bid','=','user.Bid')
				->where('Did','=',$Desig)
				->orderBy('user.Bid','asc')
				->orderBy('FirstName','asc')
				->get();
				//print_r($AgentListBW);
				
				return $AgentListBW;
				
			}
		}
		
		public function PigmiBranchWiseReport()//Todays Transaction FOR PigmiBranchWiseReport 
		{	
			
			$pigtoday=date('Y-m-d');
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','user.FirstName','user.MiddleName','user.LastName','branch.BName')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
			->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
			->where('PigReport_TranDate','=',$pigtoday)
			->orderBy('PigReport_TranDate','desc')
			->orderBy('pigmi_transaction.Bid','asc')
			->orderBy('user.FirstName','asc')
			->orderBy('PigmiTrans_ID','desc')
			
			->paginate(10);
			
			return $id;
		}
		
		public function SbBranchWiseReport()//Todays Transaction FOR SbBranchWiseReport 
		{	
			$sbtoday=date('Y-m-d');
			$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','BName')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
			->leftJoin('branch','branch.Bid','=','sb_transaction.Bid')
			->where('SBReport_TranDate',$sbtoday)
			->orderBy('sb_transaction.Bid','asc')
			->orderBy('SBReport_TranDate','desc')
			->orderBy('Tranid','desc')
			->paginate(10);
			
			return $id;
		}
		
		
		
		public function GetPigmyTranBranchWiseData($id)
		{	
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$BranchID=$id['BranchDD'];
			$AgentUid=$id['AgentDD'];
			
			if($start==$end)
			{
				if($BranchID=="ALL") //all Branch all Agent S.DATE=E.DATE
				{
					$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
					->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
					->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
					->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
					->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
					->where('PigReport_TranDate','=',$start)
					->orderBy('PigReport_TranDate','desc')
					->orderBy('pigmi_transaction.Bid','asc')
					->orderBy('user.FirstName','asc')
					->orderBy('PigmiTrans_ID','desc')
					->paginate(10);
					//print_r($id);
					return $id;
				}
				else//Specific Branch
				{
					if($AgentUid=="ALL")//Specific Branch all AGENT  S.DATE=E.DATE
					{
						$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
						->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
						->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
						->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
						->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						->where('PigReport_TranDate','=',$start)
						->where('pigmi_transaction.Bid','=',$BranchID)
						->orderBy('PigReport_TranDate','desc')
						->orderBy('user.FirstName','asc')
						->orderBy('PigmiTrans_ID','desc')
						->paginate(10);
						
						return $id;
						
					}
					else//specific BRANCH specific AGENT S.DATE=E.DATE
					{
						$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
						->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
						->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
						->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
						->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						->where('PigReport_TranDate','=',$start)
						->where('pigmi_transaction.Bid','=',$BranchID)
						->where('pigmi_transaction.Agentid','=',$AgentUid)
						->orderBy('PigReport_TranDate','desc')
						->orderBy('user.FirstName','asc')
						->orderBy('PigmiTrans_ID','desc')
						->paginate(10);
						
						return $id;
					}
					
				}
				
				
			}//if($start==$end) ends
			else// if S.DATE not= E.DATE
			{
				if($BranchID=="ALL") // all BRANCH S.DATE not= E.DATE
				{
					if($AgentUid=="ALL") // all BRANCH all AGENT S.DATE not= E.DATE
					{
						$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
						->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
						->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
						->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
						->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						//->where('PigReport_TranDate','=',$start)
						
						
						
						->orderBy('pigmi_transaction.Bid','asc')
						->orderBy('user.FirstName','asc')
						->orderBy('PigReport_TranDate','desc')
						//->orderBy('PigmiTrans_ID','desc')
						->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
						->groupby('pigmi_transaction.PigReport_TranDate')
						
						->groupby('pigmi_transaction.Agentid')
						->paginate(10);
						//print_r($id);
						return $id;
					}
					else// all BRANCH specific AGENT S.DATE not= E.DATE
					{
						
						$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
						->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
						->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
						->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
						->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						//->where('PigReport_TranDate','=',$start)
						->where('pigmi_transaction.Agentid','=',$AgentUid)
						
						->orderBy('pigmi_transaction.Bid','asc')
						->orderBy('user.FirstName','asc')
						->orderBy('PigReport_TranDate','desc')
						//->orderBy('PigmiTrans_ID','desc')
						->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
						->groupby('pigmi_transaction.PigReport_TranDate')
						
						->groupby('pigmi_transaction.Agentid')
						->paginate(10);
						//print_r($id);
						return $id;
					}
				}
				else//specific branch
				{
					if($AgentUid=="ALL")// specific BRANCH all AGENT S.DATE not= E.DATE
					{
						$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
						->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
						->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
						->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
						->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						//->where('PigReport_TranDate','=',$start)
						->where('pigmi_transaction.Bid','=',$BranchID)
						
						
						->orderBy('pigmi_transaction.Bid','asc')
						->orderBy('user.FirstName','asc')
						->orderBy('PigReport_TranDate','desc')
						//->orderBy('PigmiTrans_ID','desc')
						->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
						->groupby('pigmi_transaction.PigReport_TranDate')
						
						->groupby('pigmi_transaction.Agentid')
						->paginate(10);
						//print_r($id);
						return $id;
					}
					else// specific BRANCH specific AGENT S.DATE not= E.DATE
					{
						$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
						->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
						->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
						->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
						->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
						//->where('PigReport_TranDate','=',$start)
						->where('pigmi_transaction.Bid','=',$BranchID)
						->where('pigmi_transaction.Agentid','=',$AgentUid)
						
						->orderBy('pigmi_transaction.Bid','asc')
						->orderBy('user.FirstName','asc')
						->orderBy('PigReport_TranDate','desc')
						//->orderBy('PigmiTrans_ID','desc')
						->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
						->groupby('pigmi_transaction.PigReport_TranDate')
						
						->groupby('pigmi_transaction.Agentid')
						->paginate(10);
						//print_r($id);
						return $id;
						
					}
				}
				
			}
		}
		
		public function GetPigmyAgentTotalCollectPD($id)
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$BranchID=$id['BranchDD'];
			$AgentUid=$id['AgentDD'];
			
			if($BranchID!="ALL")// specific BRANCH S.DATE not= E.DATE total collection perday
			{
				
				if($AgentUid!="ALL")//specific BRANCH specific AGENT S.DATE not= E.DATE total collection perday
				{
					$data['parent'][] = DB::table('pigmi_transaction')->select('pigmi_transaction.Agentid')
					->where('pigmi_transaction.Bid','=',$BranchID)
					->where('pigmi_transaction.Agentid','=',$AgentUid)
					->distinct()
					->get();
					
					foreach($data['parent']  as $parent)
					{
						foreach($parent as $p)
						{									 
							$data[$p->Agentid]['child1'][]= DB::table('pigmi_transaction')->select('pigmi_transaction.PigReport_TranDate')
							->where('pigmi_transaction.Bid','=',$BranchID)
							->where('pigmi_transaction.Agentid','=',$AgentUid)
							->distinct()
							->get();								 
							
							
							foreach($data[$p->Agentid]['child1']  as $child1)
							{
								foreach($child1 as $c1){
									
									$data[$p->Agentid][$c1->PigReport_TranDate][] = DB::table('pigmi_transaction')
									->where('pigmi_transaction.Bid','=',$BranchID)
									->where('pigmi_transaction.Agentid','=',$p->Agentid)
									->where('pigmi_transaction.PigReport_TranDate','=',$c1->PigReport_TranDate)
									->where('Transaction_Type',"credit")
									->orWhere('Transaction_Type',"CREDIT")
									//->sum('pigmi_transaction.Amount');
									->select(DB::raw('sum(pigmi_transaction.Amount) as sum'))
									->first();
								}
								
							}
						}
					}
					
					
				}
				else//specific BRANCH all AGENT S.DATE not= E.DATE total collection perday
				{
					
					
					
					$data['parent'][] = DB::table('pigmi_transaction')->select('pigmi_transaction.Agentid')
					->where('pigmi_transaction.Bid','=',$BranchID)
					->distinct()
					->get();
					
					foreach($data['parent']  as $parent)
					{
						foreach($parent as $p)
						{									 
							$data[$p->Agentid]['child1'][]= DB::table('pigmi_transaction')->select('pigmi_transaction.PigReport_TranDate')
							->where('pigmi_transaction.Bid','=',$BranchID)
							->distinct()
							->get();								 
							
							
							foreach($data[$p->Agentid]['child1']  as $child1)
							{
								foreach($child1 as $c1){
									
									$data[$p->Agentid][$c1->PigReport_TranDate][] = DB::table('pigmi_transaction')
									->where('pigmi_transaction.Bid','=',$BranchID)
									->where('pigmi_transaction.Agentid','=',$p->Agentid)
									->where('pigmi_transaction.PigReport_TranDate','=',$c1->PigReport_TranDate)
									->where('Transaction_Type',"credit")
									->orWhere('Transaction_Type',"CREDIT")
									//->sum('pigmi_transaction.Amount');
									->select(DB::raw('sum(pigmi_transaction.Amount) as sum'))
									->first();
								}
								
							}
						}
					}
				}
				
				return $data;
			}
			else//all BRANCH S.DATE not= E.DATE total collection perday
			{
				if($AgentUid!="ALL")//all BRANCH specific AGENT S.DATE not= E.DATE total collection perday
				{
					$data['parent'][] = DB::table('pigmi_transaction')->select('pigmi_transaction.Agentid')
					
					->where('pigmi_transaction.Agentid','=',$AgentUid)
					->distinct()
					->get();
					
					foreach($data['parent']  as $parent)
					{
						foreach($parent as $p)
						{									 
							$data[$p->Agentid]['child1'][]= DB::table('pigmi_transaction')->select('pigmi_transaction.PigReport_TranDate')
							
							->where('pigmi_transaction.Agentid','=',$AgentUid)
							->distinct()
							->get();								 
							
							
							foreach($data[$p->Agentid]['child1']  as $child1)
							{
								foreach($child1 as $c1){
									
									$data[$p->Agentid][$c1->PigReport_TranDate][] = DB::table('pigmi_transaction')
									
									->where('pigmi_transaction.Agentid','=',$p->Agentid)
									->where('pigmi_transaction.PigReport_TranDate','=',$c1->PigReport_TranDate)
									->where('Transaction_Type',"credit")
									->orWhere('Transaction_Type',"CREDIT")
									//->sum('pigmi_transaction.Amount');
									->select(DB::raw('sum(pigmi_transaction.Amount) as sum'))
									->first();
								}
								
							}
						}
					}
				}
				else//all BRANCH all AGENT S.DATE not= E.DATE total collection perday
				{
					
					$data['parent'][] = DB::table('pigmi_transaction')->select('pigmi_transaction.Agentid')
					->distinct()
					->get();
					
					foreach($data['parent']  as $parent)
					{
						foreach($parent as $p)
						{									 
							$data[$p->Agentid]['child1'][]= DB::table('pigmi_transaction')->select('pigmi_transaction.PigReport_TranDate')
							->distinct()
							->get();								 
							
							
							foreach($data[$p->Agentid]['child1']  as $child1)
							{
								foreach($child1 as $c1){
									
									$data[$p->Agentid][$c1->PigReport_TranDate][] = DB::table('pigmi_transaction')
									
									->where('pigmi_transaction.Agentid','=',$p->Agentid)
									->where('pigmi_transaction.PigReport_TranDate','=',$c1->PigReport_TranDate)
									->where('Transaction_Type',"credit")
									->orWhere('Transaction_Type',"CREDIT")
									//->sum('pigmi_transaction.Amount');
									->select(DB::raw('sum(pigmi_transaction.Amount) as sum'))
									->first();
								}
								
							}
						}
					}
				}
				
				return $data;
				
			}
			
		}
		
		public function GetSbTranBranchWiseData($id)
		{
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$BranchID=$id['BranchDD'];
			$SBAccNum=$id['SBAccNum'];
			//$AgentUid=$id['AgentDD'];
			//$pigtoday=date('Y-m-d');
			
			
			if($BranchID=="ALL") //all Branch all account
			{
				
				if($SBAccNum=="undefined"||$SBAccNum=="") //all Branch all account 
				{
					$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','BName',' 	Old_AccNo')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','sb_transaction.Bid')
					//->where('sb_transaction.Bid',$BranchID)
					->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('sb_transaction.Bid','asc')
					->orderBy('sb_transaction.Accid','asc')
					->orderBy('SBReport_TranDate','desc')
					->orderBy('Tranid','desc')
					->paginate(10);
					return $id;
				}
				else
				{
					$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','BName',' 	Old_AccNo')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','sb_transaction.Bid')
					->where('sb_transaction.Accid',$SBAccNum)
					->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('sb_transaction.Bid','asc')
					->orderBy('sb_transaction.Accid','asc')
					->orderBy('SBReport_TranDate','desc')
					->orderBy('Tranid','desc')
					->paginate(10);
					return $id;
				}
			}
			else
			{
				if($SBAccNum=="undefined"||$SBAccNum=="") //all Branch all account 
				{
					$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','BName',' 	Old_AccNo')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','sb_transaction.Bid')
					->where('sb_transaction.Bid',$BranchID)
					->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('sb_transaction.Bid','asc')
					->orderBy('sb_transaction.Accid','asc')
					->orderBy('SBReport_TranDate','desc')
					->orderBy('Tranid','desc')
					->paginate(10);
					
					return $id;
				}
				else
				{
					$id = DB::table('sb_transaction')->select('SBReport_TranDate','TransactionType','Amount','Total_Bal','AccNum','Tranid','particulars','CurrentBalance','BName',' 	Old_AccNo')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','sb_transaction.Bid')
					->where('sb_transaction.Bid',$BranchID)
					->where('sb_transaction.Accid',$SBAccNum)
					->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('sb_transaction.Bid','asc')
					->orderBy('sb_transaction.Accid','asc')
					->orderBy('SBReport_TranDate','desc')
					->orderBy('Tranid','desc')
					->paginate(10);
					
					return $id;
				}
			}
		}
		
		//To retrieve the Expense Detail
		
		public function ExpBranchWiseReport()//Todays Transaction FOR ExpBranchWiseReport 
		{	
			
			$exptoday=date('Y-m-d');
			
			$id = DB::table('expense')->select('e_date','cheque_no','cheque_date','bank','bank_id','Bank2','bank2id','pay_mode','amount','Particulars','ChequeClear_Date','ChequeClear_State','Chqbounce_charge','ExpenseBy','branch.BName','user.FirstName','user.MiddleName','user.LastName','id')
			->leftJoin('branch','branch.Bid','=','expense.Bid')
			->leftJoin('user','user.Uid','=','expense.Bid')
			->where('e_date','=',$exptoday)
			->where('bank2id','=',"0")
			->orderBy('e_date','desc')
			->orderBy('expense.Bid','asc')
			->orderBy('user.FirstName','asc')
			->orderBy('id','desc')
			
			->paginate(10);
			
			return $id;
		}
		
		public function RDBranchWiseReport()//Todays Transaction FOR RDBranchWiseReport 
		{	
			$sbtoday=date('Y-m-d');
			$id = DB::table('rd_transaction')->select('RDReport_TranDate','RD_Trans_Type','RD_Amount','RD_Total_Bal','AccNum','RD_TransID','RD_Particulars','RD_CurrentBalance','BName')
			->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
			->leftJoin('branch','branch.Bid','=','rd_transaction.Bid')
			->where('RDReport_TranDate',$sbtoday)
			->orderBy('rd_transaction.Bid','asc')
			->orderBy('RDReport_TranDate','desc')
			->orderBy('RD_TransID','desc')
			->paginate(10);
			
			return $id;
		}
		
		public function FDBranchWiseReport()//Todays Transaction FOR FDBranchWiseReport 
		{	
			
			return DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum')
			->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
			//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
			->join('user','user.Uid','=','fdallocation.Uid')
			->paginate(10);
		}
		
		public function GetRDTranBranchWiseData($id)
		{
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$BranchID=$id['BranchDD'];
			$RDAccNum=$id['SBAccNum'];
			//$AgentUid=$id['AgentDD'];
			//$pigtoday=date('Y-m-d');
			
			
			if($BranchID=="ALL") //all Branch all account
			{
				
				if($RDAccNum=="undefined"||$RDAccNum=="") //all Branch all account 
				{
					$id = DB::table('rd_transaction')->select('RDReport_TranDate','RD_Trans_Type','RD_Amount','RD_Total_Bal','AccNum','RD_TransID','RD_Particulars','RD_CurrentBalance','BName')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','rd_transaction.Bid')
					//->where('sb_transaction.Bid',$BranchID)
					->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('rd_transaction.Bid','asc')
					->orderBy('rd_transaction.Accid','asc')
					->orderBy('RDReport_TranDate','desc')
					->orderBy('RD_TransID','desc')
					->paginate(10);
					return $id;
				}
				else
				{
					$id = DB::table('rd_transaction')->select('RDReport_TranDate','RD_Trans_Type','RD_Amount','RD_Total_Bal','AccNum','RD_TransID','RD_Particulars','RD_CurrentBalance','BName')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','rd_transaction.Bid')
					->where('rd_transaction.Accid',$RDAccNum)
					->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('rd_transaction.Bid','asc')
					->orderBy('rd_transaction.Accid','asc')
					->orderBy('RDReport_TranDate','desc')
					->orderBy('RD_TransID','desc')
					->paginate(10);
					return $id;
				}
			}
			else
			{
				if($RDAccNum=="undefined"||$RDAccNum=="") //all Branch all account 
				{
					$id = DB::table('rd_transaction')->select('RDReport_TranDate','RD_Trans_Type','RD_Amount','RD_Total_Bal','AccNum','RD_TransID','RD_Particulars','RD_CurrentBalance','BName')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','rd_transaction.Bid')
					->where('rd_transaction.Bid',$BranchID)
					->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('rd_transaction.Bid','asc')
					->orderBy('rd_transaction.Accid','asc')
					->orderBy('RDReport_TranDate','desc')
					->orderBy('RD_TransID','desc')
					->paginate(10);
					
					return $id;
				}
				else
				{
					$id = DB::table('rd_transaction')->select('RDReport_TranDate','RD_Trans_Type','RD_Amount','RD_Total_Bal','AccNum','RD_TransID','RD_Particulars','RD_CurrentBalance','BName')
					->leftJoin('createaccount', 'createaccount.Accid', '=' , 'rd_transaction.Accid')
					->leftJoin('branch','branch.Bid','=','rd_transaction.Bid')
					->where('rd_transaction.Bid',$BranchID)
					->where('rd_transaction.Accid',$RDAccNum)
					->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('rd_transaction.Bid','asc')
					->orderBy('rd_transaction.Accid','asc')
					->orderBy('RDReport_TranDate','desc')
					->orderBy('RD_TransID','desc')
					->paginate(10);
					
					return $id;
				}
			}
		}
		
		
		
		public function GetFDTranBranchWiseData($id)
		{
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$BranchID=$id['BranchDD'];
			$FDAccNum=$id['SBAccNum'];
			//$AgentUid=$id['AgentDD'];
			//$pigtoday=date('Y-m-d');
			
			
			if($BranchID=="ALL") //all Branch all account
			{
				
				if($FDAccNum=="undefined"||$FDAccNum=="") //all Branch all account 
				{
					$id =DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum')
					->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
					//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
					->join('user','user.Uid','=','fdallocation.Uid')
					->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
					->orderBy('fdallocation.Bid','asc')
					->orderBy('FdReport_StartDate','desc')
					->paginate(10);
					return $id;
				}
				else
				{
					
					$id = DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum')
					->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
					//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
					->join('user','user.Uid','=','fdallocation.Uid')
					->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
					->where('Fdid','=',$FDAccNum)
					->orderBy('fdallocation.Bid','asc')
					->orderBy('FdReport_StartDate','desc')
					->paginate(10);
					return $id;
				}
			}
			else
			{
				if($FDAccNum=="undefined"||$FDAccNum=="") //all Branch all account 
				{
					$id = DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum')
					->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
					//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
					->join('user','user.Uid','=','fdallocation.Uid')
					->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
					->where('fdallocation.Bid','=',$BranchID)
					->orderBy('fdallocation.Bid','asc')
					->orderBy('FdReport_StartDate','desc')
					->paginate(10);
					return $id;
				}
				else
				{
					$id =DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum')
					->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
					//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
					->join('user','user.Uid','=','fdallocation.Uid')
					->whereRaw("DATE(fdallocation.FdReport_StartDate) BETWEEN '".$start."' AND '".$end."'")
					->where('fdallocation.Bid','=',$BranchID)
					->where('Fdid','=',$FDAccNum)
					->orderBy('fdallocation.Bid','asc')
					->orderBy('FdReport_StartDate','desc')
					->paginate(10);
					
					return $id;
				}
			}
		}
		
		public function MaturedPigmiReport($id)
		{
			$AccId=$id['SearchAccId'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			if($AccId=="undefined"||$AccId=="")
			{
				$id =DB::table('user')->select('PgmInterest_ID','PgmInt_Date','pigmi_interest.PigmiAcc_No','Pigmi_Type','Monthtotal_Amount','Interest_Amt','Month','Year','Amount_Payable','Paid_State','user.FirstName','user.MiddleName','user.LastName','pigmitype.Pigmi_Type','user.Bid')
				->leftJoin('pigmiallocation','pigmiallocation.UID','=','user.Uid')
				->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
				->leftJoin('pigmi_interest','pigmi_interest.PigmiAcc_No','=','pigmiallocation.PigmiAcc_No')
				
				//->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
				->whereRaw("DATE(pigmi_interest.PgmInt_Date) BETWEEN '".$start."' AND '".$end."'")
				->where('user.Bid','=',$BranchId)
				//->orderBy('user.Bid','asc')
				->orderBy('PgmInt_Date','desc')
				->paginate(10);
				return $id;
			}
			else
			{
				$id =DB::table('user')->select('PgmInterest_ID','PgmInt_Date','pigmi_interest.PigmiAcc_No','Pigmi_Type','Monthtotal_Amount','Interest_Amt','Month','Year','Amount_Payable','Paid_State','user.FirstName','user.MiddleName','user.LastName','pigmitype.Pigmi_Type','user.Bid')
				->leftJoin('pigmiallocation','pigmiallocation.UID','=','user.Uid')
				->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
				->leftJoin('pigmi_interest','pigmi_interest.PigmiAcc_No','=','pigmiallocation.PigmiAcc_No')
				
				//->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
				->whereRaw("DATE(pigmi_interest.PgmInt_Date) BETWEEN '".$start."' AND '".$end."'")
				->where('pigmi_interest.PigmiAcc_No','=',$AccId)
				->where('user.Bid','=',$BranchId)
				//->orderBy('user.Bid','asc')
				->orderBy('PgmInt_Date','desc')
				->paginate(10);
				return $id;
			}
			
			
		}
		
		public function PrewithPigmiReport($id)
		{
			$AccId=$id['SearchAccId'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			if($AccId=="undefined"||$AccId=="")
			{
				$id =DB::table('user')->select('PgmPrewithdraw_ID','Withdraw_Date','pigmi_prewithdrawal.PigmiAcc_No','Pigmi_Type','PgmTotal_Amt','TotalAmt_Payable','Particulars','CashPaid_State','Deduct_Commission','Deduct_Amount','user.FirstName','user.MiddleName','user.LastName','pigmitype.Pigmi_Type','user.Bid')
				->leftJoin('pigmiallocation','pigmiallocation.UID','=','user.Uid')
				->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
				->leftJoin('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','pigmiallocation.PigmiAcc_No')
				
				//->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
				->whereRaw("DATE(pigmi_prewithdrawal.Withdraw_Date) BETWEEN '".$start."' AND '".$end."'")
				->where('user.Bid','=',$BranchId)
				//->orderBy('user.Bid','asc')
				->orderBy('Withdraw_Date','desc')
				->paginate(10);
				return $id;
			}
			else
			{
				$id =DB::table('user')->select('PgmPrewithdraw_ID','Withdraw_Date','pigmi_prewithdrawal.PigmiAcc_No','Pigmi_Type','PgmTotal_Amt','TotalAmt_Payable','Particulars','CashPaid_State','Deduct_Commission','Deduct_Amount','user.FirstName','user.MiddleName','user.LastName','pigmitype.Pigmi_Type','user.Bid')
				->leftJoin('pigmiallocation','pigmiallocation.UID','=','user.Uid')
				->leftJoin('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
				->leftJoin('pigmi_prewithdrawal','pigmi_prewithdrawal.PigmiAcc_No','=','pigmiallocation.PigmiAcc_No')
				
				//->leftJoin('user','user.Uid','=','pigmiallocation.Uid')
				->whereRaw("DATE(pigmi_prewithdrawal.Withdraw_Date) BETWEEN '".$start."' AND '".$end."'")
				->where('pigmi_prewithdrawal.PigmiAcc_No','=',$AccId)
				->where('user.Bid','=',$BranchId)
				//->orderBy('user.Bid','asc')
				->orderBy('Withdraw_Date','desc')
				->paginate(10);
				return $id;
			}
		}
		public function GetSbprintPerData($id)
		{
			$sbaid=$id['SearchAccId'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id['data'] = DB::table('createaccount')->select('AccNum','Old_AccNo','createaccount.Created_on','user.FirstName','user.MiddleName','user.LastName','user.Kan_FirstName','user.Kan_MiddleName','user.Kan_LastName','address.Address','address.City','address.District','address.State','address.Kan_Address','address.Kan_City','address.Kan_District','address.Kan_State','address.Pincode','Nom_FirstName','Nom_MiddleName','Nom_LastName','nominee.Relationship','Kan_Nom_FirstName','Kan_Nom_MiddleName','Kan_Nom_LastName','nominee.Kan_Relationship','BCode','BName','BAddress','BCity','BState','BPhoneNo','BMobileNo','BPincode')
			->leftJoin('user','user.Uid','=','createaccount.Uid')
			->leftJoin('address','address.Aid','=','user.Aid')
			->leftJoin('nominee','nominee.Nid','=','createaccount.nid')
			->leftJoin('branch','branch.Bid','=','createaccount.Bid')
			->where('createaccount.Accid',$sbaid)
			//->where('createaccount.Bid','=',$BranchId)
			->first();
			$asd=DB::table('createaccount')->select('Uid')->where('Accid',$sbaid)->first();
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
			
			if(empty($id['fa_name'])) {
					$spouse_name = DB::table('customer')->where('Uid',$uid)->value('SpouseName');
					if(empty($spouse_name)) {
						$spouse_name = DB::table('members')->where('Uid',$uid)->value('SpouseName');
					}
					$id['spouse_name']=$spouse_name;
			}
			
			return $id;
		}
		
		public function GetSbprinttranPerData($id)//04-04-16
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$sbaid=$id['SearchAccId'];
			$tranid=$id['tranid'];
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			if($tranid==0)
			{
				$data['id'] = DB::table('sb_transaction')->select('sb_transaction.Accid','SBReport_TranDate','TransactionType','Amount','Total_Bal','Tranid','particulars','CurrentBalance','Cleared_State','CurrentBalance','Uncleared_Bal')
				->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
				->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
				->where('sb_transaction.Accid',$sbaid)
				//	->where('sb_transaction.Bid','=',$BranchId)
				->where("tran_reversed","=","NO")
				->where("Amount","!=","0")
				->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
				->orderBy('SBReport_TranDate','asc')
				->orderBy('Tranid','asc')
				->get();
				
				$minid = DB::table('sb_transaction')->select('Tranid')
				->where('sb_transaction.Accid',$sbaid)
				->where("tran_reversed","=","NO")
				->where("Uncleared_Bal","=",0)
				//->where('sb_transaction.Bid','=',$BranchId)
				->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
				->min('Tranid');
				
				
				if(!empty($minid))
				{
					$pb1=DB::table('sb_transaction')->select('CurrentBalance')->where('Tranid',$minid)->first();
					$data['pb']=$pb1->CurrentBalance;
				}
				else
				{
					$data['pb']=0;
				}
			}
			else if($tranid>0)
			{
				
				$data['id'] = DB::table('sb_transaction')->select('sb_transaction.Accid','SBReport_TranDate','TransactionType','Amount','Total_Bal','Tranid','particulars','CurrentBalance','Cleared_State','CurrentBalance','Uncleared_Bal')
				->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
				->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
				->where('sb_transaction.Accid',$sbaid)
				//	->where('sb_transaction.Bid','=',$BranchId)
				->where('sb_transaction.Tranid','>',$tranid)
				->where("tran_reversed","=","NO")
				->where("Uncleared_Bal","=",0)
				->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
				->orderBy('SBReport_TranDate','asc')
				->orderBy('Tranid','asc')
				->get();
				$pb1=DB::table('sb_transaction')->select('CurrentBalance')->where('Tranid',$tranid)->first();
				$data['pb']=$pb1->CurrentBalance;
			}
			//->paginate(15);
			
			return $data;
		}
		
		public function get_prev_balance($id)
		{
			$end=$id['enddate'];
			$start=$id['startdate'];
			$sbaid=$id['SearchAccId'];
			$tranid=$id['tranid'];
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
				$trans = DB::table('sb_transaction')->select('sb_transaction.Accid','SBReport_TranDate','TransactionType','Amount','Total_Bal','Tranid','particulars','CurrentBalance','Cleared_State','CurrentBalance','Uncleared_Bal')
				->leftJoin('createaccount', 'createaccount.Accid', '=' , 'sb_transaction.Accid')
				->leftJoin('accounttype','accounttype.AccTid','=','sb_transaction.AccTid')
				->where('sb_transaction.Accid',$sbaid)
				->where('sb_transaction.Tranid','>',$tranid)
				->where("tran_reversed","=","NO")
//				->where("SBReport_TranDate","!=",$start)
//				->where("Cleared_State","!=","UNCLEARED")
//				->where("Uncleared_Bal","=",0)
//				->whereRaw("DATE(sb_transaction.SBReport_TranDate) BETWEEN '0000-00-00' AND '".$start."'")
				->where("sb_transaction.SBReport_TranDate","<",$start)
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
		
		
		
		public function AgentPigmiTodayReport()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$pigtoday=date('Y-m-d');
			
			$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','user.FirstName','user.MiddleName','user.LastName','branch.BName')
			->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
			->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
			->leftJoin('user','user.Uid','=','pigmiallocation.UID')
			->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
			->where('PigReport_TranDate','=',$pigtoday)
			->where('pigmi_transaction.Agentid','=',$UID) //Uncomment This Line At Starting
			->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
			->orderBy('PigReport_TranDate','desc')
			->orderBy('user.FirstName','asc')
			->orderBy('PigmiTrans_ID','desc')
			
			->paginate(10);
			
			return $id;
		}
		
		public function GetAgentPigmiReportData($id)
		{
			$StartDate = $id['startdate'];
			$EndDate = $id['enddate'];
			
			if($StartDate==$EndDate)//single day report
			{
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
				$BID=$uname->Bid;
				
				
				$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','Current_Balance','PigmiAcc_No','PigmiTrans_ID','Pigmi_Type','pigmi_transaction.Total_Amount','old_pigmiaccno','Trans_Date','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
				->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
				->leftJoin('user','user.Uid','=','pigmiallocation.UID')
				->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
				->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
				->where('PigReport_TranDate','=',$StartDate)
				->where('pigmi_transaction.Agentid','=',$UID) //Uncomment This Line
				->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
				->orderBy('PigReport_TranDate','desc')
				->orderBy('user.FirstName','asc')
				->orderBy('PigmiTrans_ID','desc')
				->paginate(10);
				
				return $id;
				
			}
			else if($StartDate!=$EndDate)//date range report,SUM of collection
			{
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
				$BID=$uname->Bid;
				
				
				
				$id = DB::table('pigmi_transaction')->select('PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
				->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
				->leftJoin('user','user.Uid','=','pigmi_transaction.Agentid')
				->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
				->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
				->where('pigmi_transaction.Agentid','=',$UID) //Uncomment This Line
				->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
				->orderBy('user.FirstName','asc')
				->orderBy('PigReport_TranDate','desc')
				//->orderBy('PigmiTrans_ID','desc')
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$StartDate."' AND '".$EndDate."'")
				->groupby('pigmi_transaction.PigReport_TranDate')
				->paginate(10);
				//print_r($id);
				return $id;
				
			}
			
			
			
		}
		
		public function PigmiAgentReportSum($id)
		{
			$StartDate = $id['startdate'];
			$EndDate = $id['enddate'];
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			
			$data['child1']= DB::table('pigmi_transaction')->select('pigmi_transaction.PigReport_TranDate')
			->where('pigmi_transaction.Agentid','=',$UID)
			->distinct()
			->get();								 
			
			
			foreach($data['child1']  as $child1)
			{
				foreach($child1 as $c1){
					
					//print_r($c1);
					$data[$c1][] = DB::table('pigmi_transaction')
					->where('pigmi_transaction.Agentid','=',$UID)
					->where('pigmi_transaction.PigReport_TranDate','=',$c1)
					->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
					//->sum('pigmi_transaction.Amount');
					->select(DB::raw('sum(pigmi_transaction.Amount) as sum'))
					->first();
				}
				
			}
			//print_r($data);
			return $data;
		}
		
		public function GetAgentPigmiReportCustData($id)
		{
			
			
			$StartDate = $id['startdate'];
			$EndDate = $id['enddate'];
			$Accid=$id['SearchAccId'];
			$AllN=$id['AllorNot'];
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			if($AllN=="ALL"||$AllN=="All"||$AllN=="all")
			{
				$id = DB::table('pigmi_transaction')->select('PigmiTrans_ID','PigmiAcc_No','old_pigmiaccno','Current_Balance','pigmi_transaction.Total_Amount','PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
				->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
				->leftJoin('user','user.Uid','=','pigmiallocation.UID')
				->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
				->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
				->where('pigmi_transaction.Agentid','=',$UID) //Uncomment This Line
				->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
				//->orderBy('user.FirstName','asc')
				->orderBy('PigReport_TranDate','desc')
				//->orderBy('PigmiTrans_ID','desc')
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$StartDate."' AND '".$EndDate."'")
				//->groupby('pigmi_transaction.PigReport_TranDate')
				->paginate(10);
				//print_r($id);
				return $id;
				
			}
			
			else if($AllN!='ALL'||$AllN!='All'||$AllN!='all')
			{
				
				$id = DB::table('pigmi_transaction')->select('PigmiTrans_ID','PigmiAcc_No','old_pigmiaccno','Current_Balance','pigmi_transaction.Total_Amount','PigReport_TranDate','Amount','pigmi_transaction.Agentid','pigmi_transaction.Bid','user.FirstName','user.MiddleName','user.LastName','branch.BName')
				->leftJoin('pigmiallocation', 'pigmiallocation.PigmiAllocID', '=' , 'pigmi_transaction.PigmiAllocID')
				->leftJoin('user','user.Uid','=','pigmiallocation.UID')
				->leftJoin('branch','branch.Bid','=','pigmi_transaction.Bid')
				->leftJoin('pigmitype','pigmiallocation.PigmiTypeid','=','pigmitype.PigmiTypeid')
				->where('pigmi_transaction.Agentid','=',$UID) //Uncomment This Line
				->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
				->where('pigmi_transaction.PigmiAllocID','=',$Accid)
				//->orderBy('user.FirstName','asc')
				->orderBy('PigReport_TranDate','desc')
				//->orderBy('PigmiTrans_ID','desc')
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$StartDate."' AND '".$EndDate."'")
				//->groupby('pigmi_transaction.PigReport_TranDate')
				->paginate(10);
				//print_r($id);
				return $id;	
				
			}
			
			
			
		}
		
		public function GetLoanReport($id)
		{
			$LoanId=$id['LoanDD'];
			$PLoanTId=$id['PLoanDD'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			if($LoanId=="PERSONAL_LOAN")
			{
				
				if($PLoanTId=="ASL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"ASL")->first();
					$pltid = $pltid1->LoanType_ID;
					
					$id=DB::table('personalloan_allocation')
					->select('personalloan_allocation.MemId','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','StartDate','EndDate','PayMode','EMI_Amount','RemainingLoan_Amt','PersLoanAllocID','PersLoan_Number','FirstName','MiddleName','LastName')
					->leftJoin('members', 'members.Memid', '=' , 'personalloan_allocation.MemId')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
					->paginate(10);
					return $id;
				}
				else if($PLoanTId=="CSL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"CSL")->first();
					$pltid = $pltid1->LoanType_ID;
					$id=DB::table('personalloan_allocation')
					->select('personalloan_allocation.MemId','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','StartDate','EndDate','PayMode','EMI_Amount','RemainingLoan_Amt','PersLoanAllocID','PersLoan_Number','FirstName','MiddleName','LastName')
					->leftJoin('members', 'members.Memid', '=' , 'personalloan_allocation.MemId')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
					->paginate(10);
					return $id;
				}
				else if($PLoanTId=="AMTL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"AMTL")->first();
					$pltid = $pltid1->LoanType_ID;
					$id=DB::table('personalloan_allocation')
					->select('personalloan_allocation.MemId','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','StartDate','EndDate','PayMode','EMI_Amount','RemainingLoan_Amt','PersLoanAllocID','PersLoan_Number','FirstName','MiddleName','LastName')
					->leftJoin('members', 'members.Memid', '=' , 'personalloan_allocation.MemId')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
					->paginate(10);
					return $id;
				}
				else if($PLoanTId=="CMTL")
				{
					$pltid1 = DB::table('loan_type')->select('LoanType_ID')->where('LoanType_Name',"CMTL")->first();
					$pltid = $pltid1->LoanType_ID;
					$id=DB::table('personalloan_allocation')
					->select('personalloan_allocation.MemId','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','StartDate','EndDate','PayMode','EMI_Amount','RemainingLoan_Amt','PersLoanAllocID','PersLoan_Number','FirstName','MiddleName','LastName')
					->leftJoin('members', 'members.Memid', '=' , 'personalloan_allocation.MemId')
					->where('personalloan_allocation.LoanType_ID',$pltid)
					->whereRaw("DATE(personalloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
					->paginate(10);
					return $id;
				}
				else if($PLoanTId=="ALL")
				{
					
					$id=DB::table('personalloan_allocation')
					->select('personalloan_allocation.MemId','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','StartDate','EndDate','PayMode','EMI_Amount','RemainingLoan_Amt','PersLoanAllocID','PersLoan_Number','FirstName','MiddleName','LastName')
					->leftJoin('members', 'members.Memid', '=' , 'personalloan_allocation.MemId')
					->whereRaw("DATE(personalloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
					->paginate(10);
					return $id;
				}
				
				
			}
			else if($LoanId=="DEPOSITE_LOAN")
			{
				$id=DB::table('depositeloan_allocation')
				->select('DepLoan_Uid','DepLoan_LoanNum','DepLoan_DepositeType','DepLoan_Branch','DepLoan_AccNum','DepLoan_LoanAmount','DepLoan_LoanCharge','DepLoan_LoanStartDate','DepLoan_LoanEndDate','DepLoan_LoanDurationDays','DepLoan_RemailningAmt','EMI_Amount','DepLoanAllocId')
				->leftJoin('user', 'user.Uid', '=' , 'depositeloan_allocation.DepLoan_Uid')
				->whereRaw("DATE(depositeloan_allocation.DepLoan_LoanStartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			else if($LoanId=="STAFF_LOAN")
			{
				$id=DB::table('staffloan_allocation')
				->select('staffloan_allocation.Uid','StfLoan_Number','staffloan_allocation.Bid','LoanAmt','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','PayableAmt','LoandurationYears','LoanduratiobDays','Staff_Surety','Loan_Type','StartDate','EndDate','StaffLoan_LoanRemainingAmount','EMI_Amount','StfLoanAllocID')
				->leftJoin('user', 'user.Uid', '=' , 'staffloan_allocation.Uid')
				->whereRaw("DATE(staffloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			
			else if($LoanId=="JEWEL_LOAN")
			{
				$id=DB::table('jewelloan_allocation')
				->select('JewelLoan_Uid','JewelLoan_LoanNumber','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','JewelLoan_LoanAmountAfterDeduct','JewelLoan_StartDate','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','JewelLoanId')
				->leftJoin('user', 'user.Uid', '=' , 'jewelloan_allocation.JewelLoan_Uid')
				->whereRaw("DATE(jewelloan_allocation.JewelLoan_StartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			
			
		}
		
		
		public function getExData()
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$edtoday=date('Y-m-d');
 			$id = DB::table('expense')->select('id','e_date','cheque_date','pay_mode','amount','Particulars')
			
			->leftJoin('branch', 'branch.Bid', '=' , 'expense.Bid')
			
			->where('e_date',$edtoday)
			->where('expense.Bid','=',$BranchId)
			->orderBy('e_date','desc')
			//	->orderBy('RD_TransID','desc')
			->paginate(10);
			//->get();
			return $id;
			
		}
		
		public function GetExPerReport($id)
		{
			
			$end=$id['enddate'];
			$start=$id['startdate'];
			$exaid=$id['SearchAccId'];
			$exsid=$id['searchid'];
			
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('expense')->select('id','e_date','cheque_date','pay_mode','amount','Particulars')
			->leftJoin('branch', 'branch.Bid', '=' , 'expense.Bid')
			
			//->leftJoin('accounttype','accounttype.AccTid','=','rd_transaction.AccTid')
			//->where('Bid','=',$BranchId)
			->where('expense.Bid',$exaid)
			->where('expense.Bid',$exsid)
			->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
			//->orderBy('e_date','desc')
			//->orderBy('id','desc')
			->paginate(10);
			
			return $id;
			
		}
		
		
		public function GetExpenceReport($id)
		{
			
			$BranchId=$id['BranchDD'];
			$SubHeadID=$id['SubHeadID'];
			$HeadID=$id['HeadID'];
			$PayMode=$id['paymode'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			
			if($BranchId=="ALL")
			{
				if($PayMode=="INHAND")
				{
					if($SubHeadID=="ALL")
					{
						$id = DB::table('expense')
						->where('expense.pay_mode',"INHAND")
						//->orWhere('expense.pay_mode',"CASH")
						->where('expense.Head_lid',$HeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','pay_mode','amount','Particulars')
						->paginate(10);
						//print_r($id);
						return $id;
						
					}
					else
					{
						$id = DB::table('expense')
						->where('expense.pay_mode',"INHAND")
						//->orWhere('expense.pay_mode',"CASH")
						->where('expense.SubHead_lid',$SubHeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','pay_mode','amount','Particulars')
						->paginate(10);
						//print_r($id);
						return $id;
					}
					
				}
				else if($PayMode=="CHEQUE")
				{
					if($SubHeadID=="ALL")
					{
						$id = DB::table('expense')
						->where('expense.pay_mode',"CHEQUE")
						->where('expense.Head_lid',$HeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','cheque_date','pay_mode','amount','Particulars','bank','cheque_no')
						->paginate(10);
						
						return $id;
						
					}
					else
					{
						$id = DB::table('expense')
						->where('expense.pay_mode',"CHEQUE")
						->where('expense.SubHead_lid',$SubHeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','cheque_date','pay_mode','amount','Particulars','bank','cheque_no')
						->paginate(10);
						
						return $id;
					}
				}
			}
			else
			{
				
				if($PayMode=="INHAND")
				{
					if($SubHeadID=="ALL")
					{
						$id = DB::table('expense')
						//->leftJoin('branch', 'branch.Bid', '=' , 'expense.Bid')
						->where('expense.Bid',$BranchId)
						->where('expense.pay_mode',"INHAND")
						//->orWhere('expense.pay_mode',"CASH")
						->where('expense.Head_lid',$HeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','cheque_date','pay_mode','amount','Particulars')
						->paginate(10);
						
						return $id;
					}
					else
					{
						$id = DB::table('expense')
						//->leftJoin('branch', 'branch.Bid', '=' , 'expense.Bid')
						->where('expense.Bid',$BranchId)
						->where('expense.pay_mode',"INHAND")
						//->orWhere('expense.pay_mode',"CASH")
						->where('expense.SubHead_lid',$SubHeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','cheque_date','pay_mode','amount','Particulars')
						->paginate(10);
						
						return $id;
					}
					
				}
				else if($PayMode=="CHEQUE")
				{
					if($SubHeadID=="ALL")
					{
						$id = DB::table('expense')
						//->leftJoin('branch', 'branch.Bid', '=' , 'expense.Bid')
						->where('expense.Bid',$BranchId)
						->where('expense.pay_mode',"CHEQUE")
						->where('expense.Head_lid',$HeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','cheque_date','pay_mode','amount','Particulars','bank','cheque_no')
						->paginate(10);
						
						return $id;
						
					}
					else
					{
						$id = DB::table('expense')
						//->leftJoin('branch', 'branch.Bid', '=' , 'expense.Bid')
						->where('expense.Bid',$BranchId)
						->where('expense.pay_mode',"CHEQUE")
						->where('expense.SubHead_lid',$SubHeadID)
						->whereRaw("DATE(expense.e_date) BETWEEN '".$start."' AND '".$end."'")
						->select('id','e_date','cheque_date','pay_mode','amount','Particulars','bank','cheque_no')
						->paginate(10);
						
						return $id;
					}
				}
				
			}
			
			
		}
		
		
		public function getbranch()
		{
			$id = DB::table('branch')->select('BName','Bid')->get();
			return $id;
			
		}
		
		public function GetIncomeReport($id)
		{
			$income=$id['income'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			if($income=="customerfees")
			{
				$id=DB::table('customer')
				->select('Custid','customer.FirstName','customer.MiddleName','customer.LastName','Customer_Fee','Customer_ReceiptNum')
				->where('custtyp','=',"CLASS D")
				->whereRaw("DATE(customer.Created_on) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
				
			}
			else if($income=="jewelloancharges")
			{
				$id=DB::table('jewelloan_allocation')
				->select('JewelLoanId','JewelLoan_LoanNumber','JewelLoan_AppraisalValue','JewelLoan_SaraparaCharge','JewelLoan_InsuranceCharge','JewelLoan_BookAndFormCharge','JewelLoan_OtherCharge','jewelloan_Oldloan_No','FirstName','MiddleName','LastName')
			    ->leftJoin('user', 'user.Uid', '=' , 'jewelloan_allocation.JewelLoan_Uid')
				
				->whereRaw("DATE(jewelloan_allocation.JewelLoan_StartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			else if($income=="personalloancharges")
			{
				$id=DB::table('personalloan_allocation')
				->select('PersLoanAllocID','PersLoan_Number','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','FirstName','MiddleName','LastName','Old_PersLoan_Number')
				->leftJoin('members','members.Memid', '=' ,'personalloan_allocation.MemId')
				
				->whereRaw("DATE(personalloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			else if($income=="depositloancharges")
			{
				$id=DB::table('depositeloan_allocation')
				->select('DepLoanAllocId','DepLoan_LoanNum','DepLoan_LoanCharge','FirstName','MiddleName','LastName','Old_loan_number')
				->leftJoin('user', 'user.Uid', '=' , 'depositeloan_allocation.DepLoan_Uid')
				->whereRaw("DATE(depositeloan_allocation.DepLoan_LoanStartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			else if($income=="staffloancharges")
			{
				$id=DB::table('staffloan_allocation')
				->select('StfLoanAllocID','StfLoan_Number','otherCharges','Book_FormCharges','AjustmentCharges','ShareCharges','FirstName','MiddleName','LastName')
				->leftJoin('user', 'user.Uid', '=' , 'staffloan_allocation.Uid')
				->whereRaw("DATE(staffloan_allocation.StartDate) BETWEEN '".$start."' AND '".$end."'")
				->paginate(10);
				return $id;
			}
			
		}
		
		
		public function getsharereport($id)
		{
			$sha=$id['sha'];
			// $end=$id['enddate'];
			// $start=$id['startdate'];
			if($sha=="ALL")
			{
				$id['details']=DB::table('purchaseshare')
				//->select('PURSH_Pid','PURSH_Memid','PURSH_Shrclass','PURSH_Shareamt','PURSH_Shareprice','PURSH_Shmaxcount','PURSH_Noofshares','PURSH_Totalamt','PURSH_TotalShareValue','purchaseshare.Status','PURSH_ReceiptNo','PURSH_PendingAmount','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				//->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->groupby('PURSH_Memid')
				//->leftJoin('shares', 'shares.Share_ID', '=' , 'purchaseshare.PURSH_Memid')
				//->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				//->whereRaw("DATE(purchaseshare.PURSH_Date) BETWEEN '".$start."' AND '".$end."'")
				//->paginate(10);
				->get();
				
				$id['memid'] = DB::table('purchaseshare')->select('PURSH_Memid')
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->distinct()
				->get();
				
				foreach($id['memid'] as $parent)
				{
					foreach($parent as $p)
					{
						$id[$p]['noshr']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->select(DB::raw('sum(purchaseshare.PURSH_Noofshares)as sum1'))
						->get();
						
						$id[$p]['totamt']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->select(DB::raw('sum(purchaseshare.PURSH_Totalamt)as sum2'))
						->get();
						
						
					}
					
				}
				//print_r($id);
				return $id;
			}
			else if($sha=="CLASS_A")
			{
				$id['details']=DB::table('purchaseshare')
				//->select('PURSH_Pid','PURSH_Memid','PURSH_Shrclass','PURSH_Shareamt','PURSH_Shareprice','PURSH_Shmaxcount','PURSH_Noofshares','PURSH_Totalamt','PURSH_TotalShareValue','purchaseshare.Status','PURSH_ReceiptNo','PURSH_PendingAmount','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->groupby('PURSH_Memid')
				//->leftJoin('shares', 'shares.Share_ID', '=' , 'purchaseshare.PURSH_Memid')
				//->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				//->whereRaw("DATE(purchaseshare.PURSH_Date) BETWEEN '".$start."' AND '".$end."'")
				//->paginate(10);
				->get();
				
				$id['memid'] = DB::table('purchaseshare')->select('PURSH_Memid')
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->distinct()
				->get();
				
				foreach($id['memid'] as $parent)
				{
					foreach($parent as $p)
					{
						$id[$p]['noshr']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
						->select(DB::raw('sum(purchaseshare.PURSH_Noofshares)as sum1'))
						->get();
						
						$id[$p]['totamt']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
						->select(DB::raw('sum(purchaseshare.PURSH_Totalamt)as sum2'))
						->get();
						
						
					}
					
				}
				//print_r($id);
				return $id;
			}
			else if($sha=="CLASS_B")
			{$id['details']=DB::table('purchaseshare')
				//->select('PURSH_Pid','PURSH_Memid','PURSH_Shrclass','PURSH_Shareamt','PURSH_Shareprice','PURSH_Shmaxcount','PURSH_Noofshares','PURSH_Totalamt','PURSH_TotalShareValue','purchaseshare.Status','PURSH_ReceiptNo','PURSH_PendingAmount','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				->where('purchaseshare.PURSH_Shrclass',"CLASS_B")
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->groupby('PURSH_Memid')
				//->leftJoin('shares', 'shares.Share_ID', '=' , 'purchaseshare.PURSH_Memid')
				//->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				//->whereRaw("DATE(purchaseshare.PURSH_Date) BETWEEN '".$start."' AND '".$end."'")
				//->paginate(10);
				->get();
				
				$id['memid'] = DB::table('purchaseshare')->select('PURSH_Memid')
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->distinct()
				->get();
				
				foreach($id['memid'] as $parent)
				{
					foreach($parent as $p)
					{
						$id[$p]['noshr']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->where('purchaseshare.PURSH_Shrclass',"CLASS_B")
						->select(DB::raw('sum(purchaseshare.PURSH_Noofshares)as sum1'))
						->get();
						
						$id[$p]['totamt']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->where('purchaseshare.PURSH_Shrclass',"CLASS_B")
						->select(DB::raw('sum(purchaseshare.PURSH_Totalamt)as sum2'))
						->get();
						
						
					}
					
				}
				//print_r($id);
				return $id;
				
			}
			else if($sha=="CLASS_C")
			{
				$id['details']=DB::table('purchaseshare')
				//->select('PURSH_Pid','PURSH_Memid','PURSH_Shrclass','PURSH_Shareamt','PURSH_Shareprice','PURSH_Shmaxcount','PURSH_Noofshares','PURSH_Totalamt','PURSH_TotalShareValue','purchaseshare.Status','PURSH_ReceiptNo','PURSH_PendingAmount','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				->where('purchaseshare.PURSH_Shrclass',"CLASS_C")
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->groupby('PURSH_Memid')
				//->leftJoin('shares', 'shares.Share_ID', '=' , 'purchaseshare.PURSH_Memid')
				//->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				//->whereRaw("DATE(purchaseshare.PURSH_Date) BETWEEN '".$start."' AND '".$end."'")
				//->paginate(10);
				->get();
				
				$id['memid'] = DB::table('purchaseshare')->select('PURSH_Memid')
				->orderBy('purchaseshare.Bid','asc')
				->orderBy('PURSH_Memid','asc')
				->distinct()
				->get();
				
				foreach($id['memid'] as $parent)
				{
					foreach($parent as $p)
					{
						$id[$p]['noshr']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->where('purchaseshare.PURSH_Shrclass',"CLASS_C")
						->select(DB::raw('sum(purchaseshare.PURSH_Noofshares)as sum1'))
						->get();
						
						$id[$p]['totamt']=DB::table('purchaseshare')
						->where('PURSH_Memid',$p)
						->where('purchaseshare.PURSH_Shrclass',"CLASS_C")
						->select(DB::raw('sum(purchaseshare.PURSH_Totalamt)as sum2'))
						->get();
						
						
					}
					
				}
				//print_r($id);
				return $id;
			}
			
			
		}
		
		public function GetShare() // Thashmitha
		{
			
			$id = DB::table('shares')->select('Share_ID','Share_Class')->get();
			return $id;
		}
		
		public function sharedetail($id,$stype) // Thashmitha
		{
			
			if($stype=="ALL")
			{
				$id = DB::table('purchaseshare')
				->where('PURSH_Memid',$id)
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No','PURSH_Shrclass','PURSH_Pid','PURSH_Memshareid','PURSH_Certfid','PURSH_Noofshares','PURSH_Totalamt','PURSH_Date','purchaseshare.Status','PURSH_ReceiptNo')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				//->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				->orderBy('purchaseshare.PURSH_Pid','asc')
				->orderBy('PURSH_Shrclass','asc')
				->get();
				//print_r($id);
				return $id;
				
			}
			else if($stype=="CLASS_A")
			{
				$id = DB::table('purchaseshare')
				->where('PURSH_Memid',$id)
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No','PURSH_Shrclass','PURSH_Pid','PURSH_Memshareid','PURSH_Certfid','PURSH_Noofshares','PURSH_Totalamt','PURSH_Date','purchaseshare.Status','PURSH_ReceiptNo')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				->where('purchaseshare.PURSH_Shrclass',"CLASS_A")
				->orderBy('purchaseshare.PURSH_Pid','asc')
				->orderBy('PURSH_Shrclass','asc')
				->get();
				//print_r($id);
				return $id;
				
			}
			else if($stype=="CLASS_B")
			{
				$id = DB::table('purchaseshare')
				->where('PURSH_Memid',$id)
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No','PURSH_Shrclass','PURSH_Pid','PURSH_Memshareid','PURSH_Certfid','PURSH_Noofshares','PURSH_Totalamt','PURSH_Date','purchaseshare.Status','PURSH_ReceiptNo')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				->where('purchaseshare.PURSH_Shrclass',"CLASS_B")
				->orderBy('purchaseshare.PURSH_Pid','asc')
				->orderBy('PURSH_Shrclass','asc')
				->get();
				//print_r($id);
				return $id;
				
			}
			else if($stype=="CLASS_C")
			{
				$id = DB::table('purchaseshare')
				->where('PURSH_Memid',$id)
				->select('PURSH_Memid','members.FirstName','members.MiddleName','members.LastName','Member_no','New_Member_No','PURSH_Shrclass','PURSH_Pid','PURSH_Memshareid','PURSH_Certfid','PURSH_Noofshares','PURSH_Totalamt','PURSH_Date','purchaseshare.Status','PURSH_ReceiptNo')
				->leftJoin('members', 'members.Memid', '=' , 'purchaseshare.PURSH_Memid')
				->where('purchaseshare.PURSH_Shrclass',"CLASS_C")
				->orderBy('purchaseshare.PURSH_Pid','asc')
				->orderBy('PURSH_Shrclass','asc')
				->get();
				//print_r($id);
				return $id;
				
			}
		}
		
		public function GetPigCust()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			$id = DB::table('user')->select('user.Uid','user.Did','user.FirstName','user.MiddleName','user.LastName')
			//->leftJoin('user','user.Uid','=','employee.Uid')
			->leftJoin('designation','designation.Did','=','user.Did')
			//->where('user.Bid',$BranchId)
			->where('DName','=',"AGENT")
			->get();
			return $id;
		}
		
		public function PigmyCustPerData($id)
		{
			$age=$id['age'];
			$id = DB::table('pigmiallocation')
			//->where('PURSH_Memid',$id)
			->select('PigmiAllocID','user.FirstName','user.MiddleName','user.LastName','PigmiAcc_No','old_pigmiaccno')
			->leftJoin('user','user.Uid', '=' ,'pigmiallocation.UID')
			->where('pigmiallocation.Agentid',$age)
			->where('pigmiallocation.Closed','=',"NO")
			//->where('purchaseshare.PURSH_Shrclass',"CLASS_C")
			->orderBy('pigmiallocation.PigmiAllocID','asc')
			//->orderBy('PURSH_Shrclass','asc')
			->get();
			//print_r($id);
			return $id;
		}
		public function loanrepayreport()
		{
			return DB::table('personalloan_repay')->select('PLRepay_Id','PLRepay_Date','PLRepay_PaidAmt','PLRepay_CalculatedInterest','personalloan_repay.RemainingInterest_Amt','PLRepay_PaidInterest','PLRepay_Amtpaidtoprincpalamt','PLRepay_EMIremaining','personalloan_allocation.RemainingLoan_Amt','PersLoan_Number')
			->leftJoin('personalloan_allocation','personalloan_allocation.PersLoanAllocID', '=' ,'personalloan_repay.PLRepay_PLAllocID')
			->get();
		}
		public function GetSBPassModule()
		{
			$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','passbookprint')
			->first();
			
			
			return $id;
			
		}
		
		public function GetSBReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','sbreport')
			->first();
			return $id;
		}
		
		public function GetRDReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','RDreport')
			->first();
			return $id;
		}
		
		public function GetPigmyReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','pigmireport')
			->first();
			return $id;
		}
		
		public function GetLoanReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','LoanReport')
			->first();
			return $id;
		}
		
		public function GetClosedPigmyReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','ClosedPigmyReport')
			->first();
			return $id;
		}
		
		public function GetDepositReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','depositReport')
			->first();
			return $id;
		}
		
		
		
		
		
		
		
		
		
		public function GetSbBranchWiseReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','SbBranchWiseReport')
			->first();
			return $id;
		}
		
		public function GetRdBranchWiseReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','RDBranchWiseReport')
			->first();
			return $id;
		}
		
		public function GetFdBranchWiseReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','FDBranchWiseReport')
			->first();
			return $id;
		}
		
		public function GetPigmiBranchWiseReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','PigmiBranchWiseReport')
			->first();
			return $id;
		}
		
		public function GetExpenseBranchWiseReportModule()
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=','expenseReport')
			->first();
			return $id;
		}
		
		
		public function getdepData()
		{
			
 			$id = DB::table('deposit')->select('d_id','d_date','depo_bank','pay_mode','amount')
			
			//	->leftJoin('branch', 'branch.Bid', '=' , 'deposit.Bid')
			
			//->where('d_date',$dedtoday)
			//->where('deposit.Bid','=',$BranchId)
			//->orderBy('d_date','desc')
			//	->orderBy('RD_TransID','desc')
			//	->paginate(10);
			->get();
			return $id;
		}
		public function getbank()//T 5/5/16 for depositreport dd
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			$id = DB::table('addbank')->select('BankName','Bankid','AccountNo')
			->where('Bid',$BranchId)
			->get();
			return $id;
			
		} 
		
		
		public function GetDepositReport($id)
		{
			
			$Bankid=$id['BankDD'];
			
			$PayMode=$id['paymode'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			if($Bankid=="ALL")
			{
				if($PayMode=="inhand")
				{
					
					$id = DB::table('deposit')
					->where('deposit.pay_mode',"inhand")
					->where('deposit.Bid',$BranchId)
					->whereRaw("DATE(deposit.date) BETWEEN '".$start."' AND '".$end."'")
					->select('d_id','d_date','Branch','pay_mode','amount')
					->paginate(10);
					//print_r($id);
					return $id;
					
					
				}
				else if($PayMode=="cheque")
				{
					
					$id = DB::table('deposit')
					->where('deposit.pay_mode',"cheque")
					->where('deposit.Bid',$BranchId)
					->whereRaw("DATE(deposit.date) BETWEEN '".$start."' AND '".$end."'")
					->select('d_id','d_date','Branch','depo_bank','pay_mode','cheque_no','cheque_date','amount')
					->paginate(10);
					
					return $id;
					
				}
				
				
			}
			else
			{
				if($PayMode=="inhand")
				{
					
					$id = DB::table('deposit')
					->where('deposit.pay_mode',"inhand")
					->where('deposit.depo_bank_id',$Bankid)
					->where('deposit.Bid',$BranchId)
					->whereRaw("DATE(deposit.date) BETWEEN '".$start."' AND '".$end."'")
					->select('d_id','d_date','Branch','pay_mode','amount')
					->paginate(10);
					//print_r($id);
					return $id;
					
					
				}
				else if($PayMode=="cheque") 
				{
					
					$id = DB::table('deposit')
					->where('deposit.pay_mode',"cheque")
					->where('deposit.depo_bank_id',$Bankid)
					->where('deposit.Bid',$BranchId)
					->whereRaw("DATE(deposit.date) BETWEEN '".$start."' AND '".$end."'")
					->select('d_id','d_date','Branch','depo_bank','pay_mode','cheque_no','cheque_date','amount')
					->paginate(10);
					
					return $id;
					
				}
			}
			
			
			
		}
		
		public function pigmiagentdetails($id)
		{
			$agentid=$id['AgentDD'];
			return DB::table('user')->select('FirstName','MiddleName','LastName')
			->where('Uid','=',$agentid)
			->first();
			
			
		}
		public function pigmiagenttotalamt($id)
		{
			$agentid=$id['AgentDD'];
			$branchid=$id['BranchDD'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			
			return DB::table('pigmi_transaction')
			->leftJoin('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
			->where('pigmi_transaction.Bid','=',$branchid)
			->where('pigmi_transaction.Agentid','=',$agentid)->where('pigmi_transaction.tran_reversed','=',"NO")
			->where('pigmi_transaction.PgmPayment_Mode','<>',"INTEREST AMOUNT")
			->whereRaw("DATE(PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->where('Transaction_Type','=',"CREDIT")
			->where('Status','!=',"rejected")
			->sum('pigmi_transaction.Amount');
		}
		public function pigmiagentalltrandetails($id)
		{
			$agentid=$id['AgentDD'];
			$branchid=$id['BranchDD'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			return DB::table('pigmi_transaction')->select('FirstName','MiddleName','LastName','Amount','PigReport_TranDate','pigmi_transaction.Total_Amount','PigmiAcc_No','old_pigmiaccno','PigmiTrans_ID')
			->leftJoin('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
			->leftJoin('user','user.Uid','=','pigmiallocation.UID')
			->where('pigmi_transaction.Bid','=',$branchid)
			->where('pigmi_transaction.Agentid','=',$agentid)
			->where('pigmi_transaction.tran_reversed','=',"NO")
			->where('pigmi_transaction.PgmPayment_Mode','<>',"INTEREST AMOUNT")
			->where('pigmiallocation.Status','<>',"rejected")
			//->where('Transaction_Type',"credit")
			//->orWhere('Transaction_Type',"CREDIT")
			//->where('pigmi_transaction.PgmPayment_Mode','<>',"PREWITHDRAWAL AMOUNT")
			->whereRaw("DATE(PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->paginate(10);
			
		}
		public function alltotalamt()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$amt['sb']=DB::table('createaccount')->where('AccTid','=',"1")->where('Bid','=',$BID)->where('Status','=',"AUTHORISED")->where('Closed','<>',"YES")->sum('Total_Amount');
			
			$amt['rd']=DB::table('createaccount')->where('AccTid','=',"2")->where('Status','=',"AUTHORISED")->where('Bid','=',$BID)->where('Closed','<>',"YES")->sum('Total_Amount');
			
			$amt['pigmy']=DB::table('pigmiallocation')->where('Closed','<>',"YES")->where('Bid','=',$BID)->sum('Total_Amount');
			
			$amt['fd']=DB::table('fdallocation')->where('FDkcc','<>',"YES")->where('Bid','=',$BID)->where('Closed','=',"NO")->sum('Fd_DepositAmt');
			
			$amt['kcc']=DB::table('fdallocation')->where('Closed','=',"NO")->where('FDkcc','=',"KCC")->where('Bid','=',$BID)->sum('Fd_DepositAmt');
			
			$amt['dl_remaing']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_pigmi']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"PIGMY")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_rd']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"RD")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_fd']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"FD")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_kcc']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"KCC")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['pl_remaing']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_asl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"5")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_csl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"6")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_amtl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"7")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_cmtl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"8")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['jl_remaing']=DB::table('jewelloan_allocation')->where('JewelLoan_Closed','=',"NO")->where('JewelLoan_Bid','=',$BID)->sum('JewelLoan_LoanRemainingAmount');
			
			$amt['sl_remaing']=DB::table('staffloan_allocation')->where('Bid','=',$BID)->sum('StaffLoan_LoanRemainingAmount');
			
			
			
			
			
			return $amt;
			
		}	
		
		public function getallamount($id)
		{
			
			$BID=$id;
			
			$amt['sb']=DB::table('createaccount')->where('AccTid','=',"1")->where('Bid','=',$BID)->where('Status','=',"AUTHORISED")->where('Closed','<>',"YES")->sum('Total_Amount');
			
			$amt['rd']=DB::table('createaccount')->where('AccTid','=',"2")->where('Status','=',"AUTHORISED")->where('Bid','=',$BID)->where('Closed','<>',"YES")->sum('Total_Amount');
			
			$amt['pigmy']=DB::table('pigmiallocation')->where('Closed','<>',"YES")->where('Bid','=',$BID)->sum('Total_Amount');
			
			$amt['fd']=DB::table('fdallocation')->where('FDkcc','<>',"YES")->where('Bid','=',$BID)->where('Closed','=',"NO")->sum('Fd_DepositAmt');
			
			$amt['kcc']=DB::table('fdallocation')->where('Closed','=',"NO")->where('FDkcc','=',"KCC")->where('Bid','=',$BID)->sum('Fd_DepositAmt');
			$amt['dl_remaing']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_pigmi']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"PIGMY")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_rd']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"RD")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_fd']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"FD")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['dl_remaing_kcc']=DB::table('depositeloan_allocation')->where('LoanClosed_State','<>',"YES")->where('DepLoan_DepositeType','=',"KCC")->where('DepLoan_Branch','=',$BID)->sum('DepLoan_RemailningAmt');
			
			$amt['pl_remaing']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_asl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"5")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_csl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"6")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_amtl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"7")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			$amt['pl_remaing_cmtl']=DB::table('personalloan_allocation')->where('Closed','<>',"YES")->where('LoanType_ID','=',"8")->where('Bid','=',$BID)->sum('RemainingLoan_Amt');
			
			
			$amt['jl_remaing']=DB::table('jewelloan_allocation')->where('JewelLoan_Closed','=',"NO")->where('JewelLoan_Bid','=',$BID)->sum('JewelLoan_LoanRemainingAmount');
			
			$amt['sl_remaing']=DB::table('staffloan_allocation')->where('Bid','=',$BID)->sum('StaffLoan_LoanRemainingAmount');	
			
			return $amt;
		}
		public function getallaccountpigmi($id)
		{
			$accdetails['pigmi']=DB::table('pigmiallocation')->select('PigmiAllocID','PigmiAcc_No','old_pigmiaccno','pigmiallocation.PigmiTypeid','pigmiallocation.UID','Agentid','StartDate','EndDate','Opening_Balance','Status','Total_Amount','Closed','Pigmi_Type','Interest')
			->join('user','user.Uid','=','pigmiallocation.UID')
			->join('pigmitype','pigmitype.PigmiTypeid','=','pigmiallocation.PigmiTypeid')
			
			->where('pigmiallocation.UID',$id)
			->get();
			
			$accdetails['user']=DB::table('user')->select('user.FirstName','user.MiddleName','user.LastName','address.Gender','address.MaritalStatus','address.Occupation','address.Age','address.Birthdate','address.Email','address.Address','address.City','address.District','address.State','address.PhoneNo','address.MobileNo','address.Pincode')
			->join('address','address.Aid','=','user.Uid')
			->where('user.Uid',$id)
			->first();
			//$usrid=$accdetails['pigmi']->UID;
			$accdetails['agent']=DB::table('user')->select('FirstName','MiddleName','LastName')->where('Uid',$id)->first();
			
			$accdetails['sb']=DB::table('createaccount')->select('AccNum','Old_AccNo','opening_blance','Created_on','Total_Amount','Closed')
			->where('Uid',$id)
			->get();
			
			$accdetails['fd']=DB::table('fdallocation')->select('Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_CertificateNum','Fd_OldCertificateNum','Fd_TotalAmt','Closed','Paid_State','FdType','NumberOfYears','FdInterest')
			->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
			->where('Uid',$id)
			->get();
			
			$accdetails['dl']=DB::table('depositeloan_allocation')->select('DepLoan_LoanNum','Old_loan_number','DepLoan_DepositeType','DepLoan_AccNum','Old_Accnum','DepLoan_LoanAmount','DepLoan_LoanStartDate','DepLoan_LoanEndDate','DepLoan_RemailningAmt','LoanClosed_State')
			->where('DepLoan_Uid',$id)
			->get();
			
			$accdetails['pl']=DB::table('personalloan_allocation')->select('PersLoan_Number','Old_PersLoan_Number','LoanAmt','LoandurationYears','StartDate','EndDate','EMI_Amount','RemainingLoan_Amt','board_resolution_no','Closed','LoanType_Name','LoanType_Interest','Uid')
			->join('loan_type','loan_type.LoanType_ID','=','personalloan_allocation.LoanType_ID')
			->join('members','members.Memid','=','personalloan_allocation.MemId')
			->where('members.Uid',$id)
			->get();
			
			$accdetails['jl']=DB::table('jewelloan_allocation')->select('JewelLoan_LoanNumber','jewelloan_Oldloan_No','JewelLoan_AppraisalValue','JewelLoan_LoanDuration','JewelLoan_LoanAmount','JewelLoan_StartDate','JewelLoan_EndDate','JewelLoan_LoanRemainingAmount','JewelLoan_Closed','jewelloan_Gross_weight','jewelloan_Net_weight','jewelloan_pergram_value','jewelloan_Description')
			->where('JewelLoan_Uid',$id)
			->get();
			
			
			return $accdetails;
			
		}
		public function pigmidirectDelete($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			//$tran=$id['tranid'];
			$perticulars="DELETED";
			
			$pigmyid1=DB::table('pigmiallocation')->select('PigmiAllocID')->where('PigmiAcc_No',$id)
			->first();
			$pigmyid=$pigmyid1->PigmiAllocID;
			
			$no_of_tran=DB::table('pigmi_transaction')->where('PigmiAllocID',$pigmyid)
			->count('PigmiTrans_ID');
			if($no_of_tran=="1")
			{
				
				
				$sbdetails= DB::table('pigmi_transaction')->select('Trans_Date','PigmiTrans_ID','Transaction_Type','Amount','Particulars','pigmi_transaction.PigmiAllocID','pigmi_transaction.Bid','pigmi_transaction.PigmiTypeid','pigmiallocation.Total_Amount','PigReport_TranDate')
				->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
				->where('pigmi_transaction.PigmiAllocID','=',$pigmyid)
				->first();
				
				$trntype=$sbdetails->Transaction_Type;
				$tran=$sbdetails->PigmiTrans_ID;
				$amt=$sbdetails->Amount;
				$tot=$sbdetails->Total_Amount;
				$acid=$sbdetails->PigmiAllocID;
				$actid=$sbdetails->PigmiTypeid;
				$branch=$sbdetails->Bid;
				$dte=Date('Y-m-d');
				
				if($trntype=="credit"||$trntype=="CREDIT"||$trntype=="Credit")
				{
					
					$totamt=(Floatval($tot)-Floatval($amt));
					DB::table('pigmi_transaction')->insert(['PigmiAllocID'=>$acid,'PigmiTypeid'=>$actid,'Transaction_Type'=>"DEBIT",'Amount'=>$amt,'Total_Amount'=>$totamt,'Trans_Date'=>$dte,'PigReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
					/*'Month'=>$totamt,'Year'=>$totamt,*/
					DB::table('pigmiallocation')->where('PigmiAllocID','=',$acid)
					->update(['Total_Amount'=>$totamt]);
					
					
					DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tran)
					->update(['tran_reversed'=>"YES"]);
				}
				else if($trntype=="debit"||$trntype=="DEBIT"||$trntype=="Debit")
				{
					
					$totamt=(Floatval($tot)+Floatval($amt));
					DB::table('pigmi_transaction')->insert(['PigmiAllocID'=>$acid,'PigmiTypeid'=>$actid,'Transaction_Type'=>"DEBIT",'Amount'=>$amt,'Total_Amount'=>$totamt,'Trans_Date'=>$dte,'PigReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
					/*'Month'=>$totamt,'Year'=>$totamt,*/
					DB::table('pigmiallocation')->where('PigmiAllocID','=',$acid)
					->update(['Total_Amount'=>$totamt]);
					
					
					DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tran)
					->update(['tran_reversed'=>"YES"]);
				}
				DB::table('pigmiallocation')->where('PigmiAcc_No',$id)
				->update(['Deleted'=>"YES"]);
			}
			else
			{
				$tranids=DB::table('pigmi_transaction')->select('PigmiTrans_ID')->where('PigmiAllocID',$pigmyid)
				->get();
				
				
				foreach($tranids AS $tranid1)
				{
					$tranid=$tranid1->PigmiTrans_ID;
					
					$sbdetails= DB::table('pigmi_transaction')->select('Trans_Date','PigmiTrans_ID','Transaction_Type','Amount','Particulars','pigmi_transaction.PigmiAllocID','pigmi_transaction.Bid','pigmi_transaction.PigmiTypeid','pigmiallocation.Total_Amount','PigReport_TranDate')
					->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
					->where('pigmi_transaction.PigmiTrans_ID','=',$tranid)
					->first();
					
					$trntype=$sbdetails->Transaction_Type;
					$tran=$tranid;
					$amt=$sbdetails->Amount;
					$tot=$sbdetails->Total_Amount;
					$acid=$sbdetails->PigmiAllocID;
					$actid=$sbdetails->PigmiTypeid;
					$branch=$sbdetails->Bid;
					$dte=Date('Y-m-d');
					
					if($trntype=="credit"||$trntype=="CREDIT"||$trntype=="Credit")
					{
						
						$totamt=(Floatval($tot)-Floatval($amt));
						DB::table('pigmi_transaction')->insert(['PigmiAllocID'=>$acid,'PigmiTypeid'=>$actid,'Transaction_Type'=>"DEBIT",'Amount'=>$amt,'Total_Amount'=>$totamt,'Trans_Date'=>$dte,'PigReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
						/*'Month'=>$totamt,'Year'=>$totamt,*/
						DB::table('pigmiallocation')->where('PigmiAllocID','=',$acid)
						->update(['Total_Amount'=>$totamt]);
						
						
						DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tran)
						->update(['tran_reversed'=>"YES"]);
					}
					else if($trntype=="debit"||$trntype=="DEBIT"||$trntype=="Debit")
					{
						
						$totamt=(Floatval($tot)+Floatval($amt));
						DB::table('pigmi_transaction')->insert(['PigmiAllocID'=>$acid,'PigmiTypeid'=>$actid,'Transaction_Type'=>"DEBIT",'Amount'=>$amt,'Total_Amount'=>$totamt,'Trans_Date'=>$dte,'PigReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
						/*'Month'=>$totamt,'Year'=>$totamt,*/
						DB::table('pigmiallocation')->where('PigmiAllocID','=',$acid)
						->update(['Total_Amount'=>$totamt]);
						
						
						DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tran)
						->update(['tran_reversed'=>"YES"]);
					}
				}
				DB::table('pigmiallocation')->where('PigmiAcc_No',$id)
				->update(['Deleted'=>"YES"]);
			}
			
			
		}
/*********************************CLOSED REPORTS*************************/
		public function ClosedreportS($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$Bid=$uname->Bid;
			
			$startdates=$id['startdate'];
			$enddates=$id['enddate'];
			$loanId=$id['loanId'];
			
			if($loanId=='ALL')
			{
		       //print_r("Hi");
		      $closedReports=DB::table('personalloan_allocation')->select('personalloan_allocation.LoanType_ID','StartDate','EndDate','PersLoan_Number','LoanAmt','RemainingInterest_Amt','RemainingLoan_Amt','caldate','loan_type.LoanType_Name')
			  ->leftJoin('loan_type','loan_type.LoanType_ID','=','personalloan_allocation.LoanType_ID')
			   ->where('Closed','YES') 
			   ->where('Bid',$Bid) 
			//->whereRaw("DepLoan_LoanStartDate BETWEEN '".$startdates."' AND '".$enddates."'")
			  ->paginate(10); 
			  //print_r($closedReports);
			}
			else
			{
		       //print_r("Hi hello");
		       $closedReports=DB::table('personalloan_allocation')->select('personalloan_allocation.LoanType_ID','StartDate','EndDate','PersLoan_Number','LoanAmt','RemainingInterest_Amt','RemainingLoan_Amt','caldate','loan_type.LoanType_Name')
			  ->leftJoin('loan_type','loan_type.LoanType_ID','=','personalloan_allocation.LoanType_ID')
			   ->where('personalloan_allocation.LoanType_ID','=',$loanId) 
			   ->where('Closed','YES') 
			    ->where('Bid',$Bid) 
			//->whereRaw("DepLoan_LoanStartDate BETWEEN '".$startdates."' AND '".$enddates."'")
			  ->paginate(10); 
			}
			return  $closedReports;
			 
		}
		public function ClosedreportS1($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$Bid=$uname->Bid;
			
			$startdates=$id['startdate'];
			$enddates=$id['enddate'];
			$loanId=$id['loanId'];
			if($loanId=='ALL')
			{
		       $closedReports1=DB::table('depositeloan_allocation')
			   ->where('LoanClosed_State','YES') 
			   ->where('DepLoan_Branch',$Bid) 
			//->whereRaw("DepLoan_LoanStartDate BETWEEN '".$startdates."' AND '".$enddates."'")
			  ->paginate(10); 
			}
			else
			{
		       $closedReports1=DB::table('depositeloan_allocation')
			   ->where('DepLoan_LoanTypeID','=',$loanId) 
			   ->where('LoanClosed_State','YES') 
			   ->where('DepLoan_Branch',$Bid) 
			//->whereRaw("DepLoan_LoanStartDate BETWEEN '".$startdates."' AND '".$enddates."'")
			  ->paginate(10); 
			}
			return  $closedReports1;
			 
		}
		public function closedStaffJLD($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$Bid=$uname->Bid;
			
			$startdates=$id['startdate'];
			$enddates=$id['enddate'];
			$loanId=$id['loanId'];
			if($loanId=='3')
			{
		       $closedReportsJL1=DB::table('staffloan_allocation')
			    ->where('Bid',$Bid) 
			  // ->where('DepLoan_LoanTypeID','=',$loanId)
			 //  ->where('LoanClosed_State','YES') 
			//->whereRaw("DepLoan_LoanStartDate BETWEEN '".$startdates."' AND '".$enddates."'")
			  ->paginate(10); 
			}
			else if($loanId=='4')
			{
		       $closedReportsJL1=DB::table('jewelloan_allocation')
			   ->where('JewelLoan_LoanTypeId','=',$loanId) 
			   ->where('JewelLoan_Closed','YES') 
			   ->where('JewelLoan_Bid',$Bid) 
			//->whereRaw("DepLoan_LoanStartDate BETWEEN '".$startdates."' AND '".$enddates."'")
			  ->paginate(10); 
			}
			return  $closedReportsJL1;
			 
		}
		
		public function sb_print_joint_acc_2nd_name($data)
		{
			$ret_data["is_joint_acc"] = false;
			
			$JointUid = DB::table("createaccount")
				->where("Accid","=",$data["SearchAccId"])
				->value("JointUid");
				
			if(!empty($JointUid)) {
				$uids = explode(",",$JointUid);
				$uid2 = $uids[1];
				
				$uid2_name = DB::table("user")
				//	->select(DB::raw("concat(`FirstName`," " MiddleName LastName name"))
					->select(DB::raw('CONCAT(FirstName, " ", MiddleName, " ",LastName) AS name'))
					->where("Uid","=",$uid2)
					->first();
				$ret_data["uid2_name"] = $uid2_name->name;
				$ret_data["is_joint_acc"] = true;
			}
			
			
			return $ret_data;
		}
		
		
		public function pigmy_report($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $Bid=$uname->Bid;
			
			$ret_data = array();
			$ret_data["pg_tr"] = array();//pigmy transactions
			$ret_data["dates"] = array();// From Date   to   To Date
			$ret_data["dates_row_sum"] = array();// From Date   to   To Date
			
			if(empty($data["to_date"])) {
				$data["to_date"] = $data["from_date"];
			}
			$j = -1;
			$tran_date = $data["from_date"];
			while($tran_date <= $data["to_date"]) {
				$ret_data["dates"][++$j] = $tran_date;
				$tran_date = $this->next_date(["date"=>$tran_date]);
			}
//			print_r($ret_data);exit();
			
/****** all pigmy allocation ******/

			$table="pigmiallocation";
			if(!empty($data["allocation_id"])) {
				$pigmiallocation = DB::table($table)
					->select(
								DB::raw("fake_value as prev_amt"),
								"{$table}.PigmiAllocID",
								"{$table}.old_pigmiaccno",
								"{$table}.PigmiAcc_No",
								"user.FirstName",
								"user.MiddleName",
								"user.LastName"
							)
					->join("user","user.Uid","=","{$table}.UID")
					//->where("Closed","=","NO")
					->where("{$table}.Bid","=",$Bid)
					->where("PigmiAllocID","=",$data["allocation_id"])
					->get();
			} else {
				$pigmiallocation = DB::table($table)
					->select(
								DB::raw("fake_value as prev_amt"),
								"{$table}.PigmiAllocID",
								"{$table}.old_pigmiaccno",
								"{$table}.PigmiAcc_No",
								"user.FirstName",
								"user.MiddleName",
								"user.LastName"
							)
					->join("user","user.Uid","=","{$table}.UID")
					//->where("Closed","=","NO")
					->where("Agentid","=",$data["agent_uid"])
					->where("{$table}.Bid","=",$Bid)
					//->limit(500)
					->get();
			}
//			print_r($pigmiallocation);exit();
			
/****** all pigmy transactions ******/
			$table = "pigmi_transaction";
			$all_pigmi_transaction = DB::table($table)
				->select(
							"pigmiallocation.PigmiAllocID",
							"PigReport_TranDate",
							"Amount",
							"Transaction_Type"
						)
				->join("pigmiallocation","pigmiallocation.PigmiAllocID","=","{$table}.PigmiAllocID")
				->where("{$table}.tran_reversed","=","NO")
				->where("{$table}.Bid","=",$Bid)
				->where("{$table}.service_charge","=",0)
				->where("{$table}.Agentid","=",$data["agent_uid"]);
			if(!empty($data["allocation_id"])) {
				$all_pigmi_transaction = $all_pigmi_transaction->where("pigmiallocation.PigmiAllocID","=",$data["allocation_id"]);
			}
			$all_pigmi_transaction = $all_pigmi_transaction->get();
//			print_r($all_pigmi_transaction);exit();
				
				$tran_date_arr = [];
			$k = -1;
			foreach($all_pigmi_transaction as $row_all_tran) {
				$tran_date_arr[$row_all_tran->PigmiAllocID][] = $row_all_tran->PigReport_TranDate;
				$all_pigmi_transaction_arr["{$row_all_tran->PigmiAllocID}"][] = $row_all_tran;
				if(isset($pigmi_transaction_arr["{$row_all_tran->PigmiAllocID}"]["{$row_all_tran->PigReport_TranDate}"])) {
					$pigmi_transaction_arr["{$row_all_tran->PigmiAllocID}"]["{$row_all_tran->PigReport_TranDate}"] += $row_all_tran->Amount;
				} else {
					$pigmi_transaction_arr["{$row_all_tran->PigmiAllocID}"]["{$row_all_tran->PigReport_TranDate}"] = $row_all_tran->Amount;
				}
			}//return 'show';
//			print_r($tran_date_arr);exit();
			foreach($tran_date_arr as $key_tran_date => $row_tran_date) {
//				print_r($row_tran_date);exit();
				$last_tran_date["{$key_tran_date}"] = max($row_tran_date);
			}
//			print_r($last_tran_date);//exit();
			
			
/********* process each entry ***********/
			$i = -1;
			$ret_data["dates_col_total_sum"] = 0;
			foreach($pigmiallocation as $key_alloc => $row_alloc) {
				if(!isset($last_tran_date["{$row_alloc->PigmiAllocID}"])) {
					//echo " 1 ";
					continue;
				}
				
				$last_tran_date_pid = $last_tran_date["{$row_alloc->PigmiAllocID}"];
				//$day_before_one_month = date('Y-m-d', strtotime(' -30 day'));
//				echo "$last_tran_date_pid < $day_before_one_month";exit();
				
				if($last_tran_date_pid < $data["from_date"]) {
					//echo " 1 ";
					continue;
				}
				//var_dump($day_before_one_month);exit();
			
				$ret_data["pg_tr"][++$i]["allocation_id"] = $row_alloc->PigmiAllocID;
				$ret_data["pg_tr"][$i]["pigmy_no"] = "{$row_alloc->old_pigmiaccno}/{$row_alloc->PigmiAcc_No}";
				$ret_data["pg_tr"][$i]["customer_name"] = "{$row_alloc->FirstName} {$row_alloc->MiddleName} {$row_alloc->LastName}";
				
				$credit_amount = 0;
				$debit_amount = 0;
				$total_credit_amount = 0;
				$total_debit_amount = 0;
				if(!empty($all_pigmi_transaction_arr["{$row_alloc->PigmiAllocID}"])) {
					foreach($all_pigmi_transaction_arr["{$row_alloc->PigmiAllocID}"] as $row) {//var_dump($row);exit();
						if($row->PigReport_TranDate < $data["from_date"]) {
							if($row->Transaction_Type) {
								$credit_amount += $row->Amount;
								
							} else {
								$debit_amount += $row->Amount;
							}
						}
						if($row->Transaction_Type) {
							$total_credit_amount += $row->Amount;
							
						} else {
							$total_debit_amount += $row->Amount;
						}
					}
				} else {
					echo "empty";
				}
				
				$ret_data["pg_tr"][$i]["day_sum_row"] = 0;
				$ret_data["pg_tr"][$i]["col_sum"] = 0;
				$ret_data["pg_tr"][$i]["prev_amt"] = $credit_amount - $debit_amount;
				$ret_data["pg_tr"][$i]["col_sum"] = $credit_amount - $debit_amount;
				$ret_data["pg_tr"][$i]["total_amt"] = $total_credit_amount - $total_debit_amount;
				foreach($ret_data["dates"] as $tran_date) {
					$day_amt = 0;
					if(!empty($pigmi_transaction_arr["{$row_alloc->PigmiAllocID}"]["{$tran_date}"])) {
						$day_amt = $pigmi_transaction_arr["{$row_alloc->PigmiAllocID}"]["{$tran_date}"];
					}
					$ret_data["pg_tr"][$i]["{$tran_date}"] = $day_amt;
					$ret_data["pg_tr"][$i]["day_sum_row"] += $day_amt;
				}
				$ret_data["pg_tr"][$i]["col_sum"] += $ret_data["pg_tr"][$i]["day_sum_row"];
				$ret_data["dates_col_total_sum"] += $ret_data["pg_tr"][$i]["day_sum_row"];
			}
			
			$i = -1;
			$ret_data["dates_row_total_sum"] = 0;
			foreach($ret_data["dates"] as $key=>$date) {
				$temp = 0;
				foreach($ret_data["pg_tr"] as $tran) {
					$temp += $tran["{$date}"];
				}
				$ret_data["dates_row_sum"][$key] = $temp;
				$ret_data["dates_row_total_sum"] += $temp;
			}
			
			
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		
		public function next_date($data){
			return date("Y-m-d", strtotime("+1 day",strtotime($data["date"])));
		}
		
		public function dmy($data)
		{
			return date("d-m-Y",strtotime($data["date"]));
		}
		public function user_details($in_data){
			//$in_data["user_id"]
			
			$return_data=DB::table('user')
				->select('user.Uid','user.FirstName','address.Address','address.PhoneNo')
				->where('user.Uid','=',$in_data["user_id"])
				->join('address','address.Aid',"=",'user.Aid')
				->first();
				return $return_data;
		
		}
		
		public function loan_details_jl($data){
			$return_data=DB::table('jewelloan_allocation')
			->select(
						'JewelLoanId as loan_id',
						'JewelLoan_LoanNumber as loan_no'
					)
			->where('JewelLoan_Uid','=',$data['uid'])
			->get();
			return($return_data);
		}
		
		public function loan_details_pl($data){
			$return_data = DB::table('personalloan_allocation')
			->select(
						'PersLoanAllocID as loan_id',
						'PersLoan_Number as loan_no'
					)
			->join("members","members.Memid","=","personalloan_allocation.MemId")
			->join("user","user.Uid","=","members.Uid")
			->where('user.Uid','=',$data['uid'])
			->get();
			return($return_data);
		}
		
		public function search_agent($data){
			$return_data = DB::table('user')
			->select(
						'Uid as id',
						'CONCAT("FirstName","MiddleName","LastName") as name'
					)
			->where('user.Did','=',"4")
			->get();
			return($return_data);
		}
		
		public function get_agent_list($data){
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $Bid=$uname->Bid;
			$ret_data = array();
			$ret_data = DB::table('user')
			->select(
						'Uid as id',
						DB::raw('CONCAT(FirstName, " ", MiddleName, " ", LastName) as name')
					)
			->where('user.Did','=',"4")
			->where('user.Bid','=',$Bid)
			->get();
//			print_r($ret_data);exit();
			return($ret_data);
		}
		
		public function get_cal_days($data)
		{
			$cal_days = [];
			$temp_date = $data["from_date"];
			$end_date = $data["to_date"];
			$i = -1;
			while($temp_date <= $end_date) {
				//var_dump($temp_date);
				$cal_days[++$i] = $temp_date;
				$temp_date = date('Y-m-d', strtotime('+1 day', strtotime($temp_date)));
			}//print_r($cal_days);
			
			return $cal_days;
		}
		
		public function appraiser_commission_report_data($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			$from_date = "{$data['year_month']}-01";
			$to_date = date("Y-m-t",strtotime($from_date));
			$ret_data["cal_days"] = $this->get_cal_days(["from_date"=>$from_date,"to_date"=>$to_date]);
			$ret_data["appraiser_commission_details"] = array();
			$table = "jewelloan_allocation";
			$select_array = array(
									"{$table}.JewelLoan_LoanAmount as loan_amount",
									"{$table}.JewelLoan_SaraparaCharge as appraiser_charge",
									"{$table}.JewelLoan_StartDate as start_date"
								);
			$loan_allocation_list = DB::table($table)
				->select($select_array)
				->where("{$table}.JewelLoan_StartDate","like","%{$data['year_month']}%")
				->where("{$table}.JewelLoan_Bid",$BID)
				->get();
				
			$loan_amount_total_sum = 0;
			$appraiser_charge_total_sum = 0;
			$i = -1;
			foreach($ret_data["cal_days"] as $date) {
				$loan_amount_daily_sum = 0;
				$appraiser_charge_daily_sum = 0;
				foreach($loan_allocation_list as $row_jl) {	
					if($row_jl->start_date == $date) {
						$loan_amount_daily_sum += $row_jl->loan_amount;
						$appraiser_charge_daily_sum += $row_jl->appraiser_charge;
					}
				}
				$ret_data["appraiser_commission_details"][++$i]["date"] = $date;
				$ret_data["appraiser_commission_details"][$i]["loan_amount_daily_sum"] = $loan_amount_daily_sum;
				$ret_data["appraiser_commission_details"][$i]["appraiser_charge_daily_sum"] = $appraiser_charge_daily_sum;
				$loan_amount_total_sum += $loan_amount_daily_sum;
				$appraiser_charge_total_sum += $appraiser_charge_daily_sum;
			}
			$ret_data["loan_amount_total_sum"] = $loan_amount_total_sum;
			$ret_data["appraiser_charge_total_sum"] = $appraiser_charge_total_sum;
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function cash_chitta_data($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			
			$ret_data["date"] = $data["date"];
			$ret_data["chitta"] = [];
			$ret_data["receipt_amount_sum"] = 0;
			$ret_data["voucher_amount_sum"] = 0;
			
			$chitta_list = DB::table("cash_chitta_details")
				->where("deleted",0)
				->where("pk_field","!=","")
				->where("bid_field","!=","")
				->where("date_field","!=","")
				->where("transaction_type","!=",0)
				->get();
				
			$i = -1;
			foreach($chitta_list as $row_ch) {
				$bid_field = "{$row_ch->table_name}.{$row_ch->bid_field}";
				$date_field = "{$row_ch->table_name}.{$row_ch->date_field}";
				
				$select_array = array(
										"{$row_ch->table_name}.{$row_ch->pk_field} as pk",
										"{$row_ch->table_name}.{$row_ch->amount_field} as amount",
										"{$row_ch->table_containing_account_no}.{$row_ch->account_no_field} as account_no"
										//,"aa as bb"
									);
				switch($row_ch->transaction_type) {
					case CREDIT	:	
									$raw_obj = DB::raw("'CREDIT' as 'transaction_type'");
									break;
					case DEBIT	:	
									$raw_obj = DB::raw("'DEBIT' as 'transaction_type'");
									break;
					case BOTH	:	
									$raw_obj = DB::raw("{$row_ch->table_name}.{$row_ch->transaction_type_field} as 'transaction_type'");
									break;
				}
				
				array_push($select_array,$raw_obj);
				
				$where_list = DB::table("cash_chitta_where_clause")
					->where("deleted",0)
					->where("cash_chitta_id",$row_ch->cash_chitta_id)
					->get();
				$join_list = DB::table("cash_chitta_joining_tables")
					->where("deleted",0)
					->where("cash_chitta_id",$row_ch->cash_chitta_id)
					->get();
/*+++++++++++++++*/
				$temp = DB::table($row_ch->table_name);
				$temp = $temp->select($select_array);
				foreach($join_list as $row_jo) {
					$temp = $temp->join("{$row_jo->joining_table_1_name}","{$row_jo->joining_table_1_name}.{$row_jo->joining_table_1_field}","=",
											"{$row_jo->joining_table_2_name}.{$row_jo->joining_table_2_field}");
				}
				$temp = $temp->where($bid_field,$BID);
				$temp = $temp->where($date_field,$data["date"]);
				foreach($where_list as $row_wh) {
					$where_table = $row_wh->table_name;
					$where_operator = $row_wh->operator;
					$where_field = $row_wh->field_name;
					$where_value = $row_wh->field_value;
					$where_value = "\"{$where_value}\"";
					$where_value = str_replace(",","\",\"",$where_value);
					$where_value = explode(",", $where_value);
					switch($where_operator) {
						
						case "="		:	
						case "LIKE"		:	
						case "like"		:	
											$temp->where("{$where_table}.{$where_field}","{$where_operator}",$where_value);
											break;
						case "IN"		:
						case "in"		:
											$temp->whereIn("{$where_table}.{$where_field}",$where_value);
											break;
						case "NOT IN"	:
						case "not in"	:
											$temp->whereNotIn("{$where_table}.{$where_field}",$where_value);
											break;
					}
				}
				$temp = $temp->get();
				//print_r($temp);exit();
/*---------------*/
				foreach($temp as $row_te) {
					$ret_data["chitta"][++$i]["receipt_no"] = 0;
					$ret_data["chitta"][$i]["voucher_no"] = 0;
					$ret_data["chitta"][$i]["particulars"] = "{$row_ch->prefix} {$row_te->account_no} {$row_te->transaction_type}";
					$ret_data["chitta"][$i]["transaction_type"] = $row_te->transaction_type;
					switch($row_te->transaction_type) {
						case "CREDIT"	:	$ret_data["chitta"][$i]["receipt_amount"] = $row_te->amount;
											$ret_data["chitta"][$i]["voucher_amount"] = 0;
											break;
						case "DEBIT"	:	$ret_data["chitta"][$i]["receipt_amount"] = 0;
											$ret_data["chitta"][$i]["voucher_amount"] = $row_te->amount;
											break;
					}
					$ret_data["receipt_amount_sum"] += $ret_data["chitta"][$i]["receipt_amount"];
					$ret_data["voucher_amount_sum"] += $ret_data["chitta"][$i]["voucher_amount"];
				}
				
			}
			
				//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function cash_chitta_details_list($data)
		{
			$ret_data["chitta"] = [];
			$ret_data["tables"] = [];
			
			$table = "cash_chitta_details";
			$deleted_field = "{$table}.deleted";
			$select_array = array(
									"cash_chitta_id",
									"prefix",
									"table_name",
									"pk_field",
									"amount_field",
									"bid_field",
									"date_field",
									"transaction_type",
									"transaction_type_field",
									"table_containing_account_no",
									"account_no_field"
								);
			
			$cash_chitta_details_list = DB::table($table)
				->select($select_array)
				->where($deleted_field,NOT_DELETED);
			if(isset($data["cash_chitta_details_id"])) {
				$cash_chitta_details_list = $cash_chitta_details_list->where("{$table}.cash_chitta_id",$data["cash_chitta_details_id"]);
			}
			$cash_chitta_details_list = $cash_chitta_details_list->get();
				
			$i = -1;
			foreach($cash_chitta_details_list as $row_ca) {
				$ret_data["chitta"][++$i]["cash_chitta_id"] = $row_ca->cash_chitta_id;
				$ret_data["chitta"][$i]["prefix"] = $row_ca->prefix;
				$ret_data["chitta"][$i]["table_name"] = $row_ca->table_name;
				$ret_data["chitta"][$i]["pk_field"] = $row_ca->pk_field;
				$ret_data["chitta"][$i]["amount_field"] = $row_ca->amount_field;
				$ret_data["chitta"][$i]["bid_field"] = $row_ca->bid_field;
				$ret_data["chitta"][$i]["date_field"] = $row_ca->date_field;
				$ret_data["chitta"][$i]["transaction_type"] = $row_ca->transaction_type;
				$ret_data["chitta"][$i]["transaction_type_field"] = $row_ca->transaction_type_field;
				$ret_data["chitta"][$i]["table_containing_account_no"] = $row_ca->table_containing_account_no;
				$ret_data["chitta"][$i]["account_no_field"] = $row_ca->account_no_field;
			}
			
			
			$tables = DB::select('SHOW TABLES');
			$tables_in_member = "Tables_in_".DB::getDatabaseName();
			$i = -1;
			foreach($tables as $row_table)
			{
				$ret_data["tables"][++$i] = $row_table->$tables_in_member;
			}
			
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
	}
