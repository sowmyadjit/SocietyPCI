<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	Use DB;
	Use Auth;
	class LoanTypeModel extends Model
	{
		protected $table='loan_type';
		public function insert($id)
		{
			$dte=date('d-m-Y');
			$id = DB::table('loan_type')->insertGetId(['LoanType_Name'=> $id['loantyp'],'LoanType_Member'=>$id['member'],'LoanType_Customer'=>$id['customer'],'LoanType_Staff'=>$id['staff'],'LoanType_Agent'=>$id['agent'],'LoanType_Interest'=>$id['intrest'],'LoanType_Date'=>$dte,'Loan_CategoryId'=>$id['LoanCategory'],'loan_due_interest'=>$id['due_intrest']]);
			
			return $id;
		}
		
		public function getloantype($q)
		{
			//return DB::select("SELECT `LoanType_ID` as id, CONCAT(`LoanType_ID`,'-',`LoanType_Name`) as name FROM `loan_type` where `LoanType_Name` LIKE '%".$q."%' ");
			
			return DB::table('loan_type')
			->select(DB::raw('LoanType_ID as id, CONCAT(`LoanType_ID`,"-",`LoanType_Name`) as name'))
			->where('loan_type.Active','=',"1")
			->get();
		}
		
		public function GetDLoanType($q)
		{
			return DB::table('loan_type')
			->select(DB::raw('LoanType_ID as id, CONCAT(`LoanType_ID`,"-",`LoanType_Name`) as name'))
			->where('loan_type.Loan_CategoryId','=',"2")
			->get();
		}
		
		public function getdetail()
		{
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('depositeloan_allocation')
			->select('DepLoan_LoanNum','Old_loan_number','DepLoan_DepositeType','DepLoan_AccNum','Old_Accnum','DepLoan_LoanAmount','DepLoan_LoanCharge','DepLoan_LoanStartDate','DepLoan_LoanEndDate','DepLoan_RemailningAmt','user.FirstName','user.MiddleName','user.LastName','DepLoanAllocId','DepLoan_Uid')
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			//->join('customer','customer.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('DepLoan_Branch','=',$BID)
			//->get();
			->paginate(10);
		}
		
		public function getdetail_all()
		{
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
			return DB::table('depositeloan_allocation')
			->select('DepLoan_LoanNum','Old_loan_number','DepLoan_DepositeType','DepLoan_AccNum','Old_Accnum','DepLoan_LoanAmount','DepLoan_LoanCharge','DepLoan_LoanStartDate','DepLoan_LoanEndDate','DepLoan_RemailningAmt','user.FirstName','user.MiddleName','user.LastName','DepLoanAllocId','DepLoan_Uid')
			->join('user','user.Uid','=','depositeloan_allocation.DepLoan_Uid')
			//->join('customer','customer.Uid','=','depositeloan_allocation.DepLoan_Uid')
			->where('DepLoan_Branch','=',$BID)
			->get();
			//->paginate(10);
		}
		
		public function GetLoanCategoryDropD()
		{
			
			$LoanCategory = DB::table('loancategory')->select('LoanCategoryID','LoanCategoryName')->get();
			return $LoanCategory;
		}
		
		public function GetPerLoanCategory()
		{
			$PersLoanType = DB::table('loancategory')
			->select('loan_type.LoanType_ID','loan_type.LoanType_Name')
			->join('loan_type','loan_type.Loan_CategoryId','=','loancategory.LoanCategoryID')
			->where('loancategory.LoanCategoryName','like','%PERSONAL%')
			->get();
			return $PersLoanType;
		}
		public function GetLoanTypes()//for landing page
		{
			$id= DB::table('loan_type')->select('LoanType_ID','LoanType_Name','LoanType_Member','LoanType_Customer','LoanType_Staff','LoanType_Agent','LoanType_Interest','LoanType_Date','Loan_CategoryId')
			->paginate(10);
			
			return $id;
		}
		public function show_Persnloanalloc1()
		{
			return DB::table('personalloan_allocation')->select('PersLoanAllocID','PersLoan_Number','Old_PersLoan_Number','LoanAmt','PayableAmt','StartDate','EndDate','RemainingLoan_Amt','EMI_Amount','FirstName','MiddleName','LastName','Uid','EMI_Amount','LoanType_ID')
			->join('members','members.Memid','=','personalloan_allocation.MemId')
			->get();
		}
		
		public function show_Persnloanalloc1_all()
		{
			return DB::table('personalloan_allocation')->select('PersLoanAllocID','PersLoan_Number','Old_PersLoan_Number','LoanAmt','PayableAmt','StartDate','EndDate','RemainingLoan_Amt','EMI_Amount','FirstName','MiddleName','LastName','Uid')
			->join('members','members.Memid','=','personalloan_allocation.MemId')
			->get();
		}
		public function Staffloanallocetail()
		{
			return DB::table('staffloan_allocation')->select('StfLoanAllocID','StfLoan_Number','old_saffloan_no','LoanAmt','PayableAmt','StartDate','EndDate','StaffLoan_LoanRemainingAmount','EMI_Amount','FirstName','MiddleName','LastName','user.Uid','LastPaidDate','AjustmentCharges','ShareCharges')
			->join('user','user.Uid','=','staffloan_allocation.Uid')
			->get();
		}
		
		public function edit_emi($data)
		{
			return DB::table("personalloan_allocation")->where("PersLoanAllocID","=",$data['id'])->update(["EMI_Amount"=>$data['value']]);
		}
		
		public function edit_int_rate($data)
		{
			return DB::table("personalloan_allocation")->where("PersLoanAllocID","=",$data['id'])->update(["LoanType_ID"=>$data['value']]);
		}
	
	}
    
	
	
