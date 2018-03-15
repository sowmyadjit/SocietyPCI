<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	class RequestLoanModel extends Model
	{
		protected $table = 'request_loan';
		
		public function ReqPersLoanAllocation($id)
		{
			$AccBID=$id['ReqPLBranchID'];
			$dte=date('Y-m-d');
			$reportdatee=date('Y-m-d');
			$dm=date('m');
			$dy=date('Y');
			$tm=date('h:i:s');
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$memid=$id['ReqPLMembID'];
			$loancat=$id['LoanCategory'];
			$loancat1=$id['loantypetext'];
			
			if($loancat1=="PERSONAL LOAN")
			{
				if($id['custtype']=="MEMBERS")
				{
					$uid1=DB::table('members')->select('Uid')->where('Memid','=',$memid)->first();
					$usrid=$uid1->Uid;
				}
				else
				{
					$countofid=DB::table('members')->where('Uid','=',$id['userid'])->count('Memid');
					if($countofid=="0")
					{
						$userdetails=DB::table('user')->select('Aid','Bid','FirstName','MiddleName','LastName')->where('Uid','=',$id['userid'])->first();
						
						$Aid=$userdetails->Aid;
						$Bid=$userdetails->Bid;
						$FirstName=$userdetails->FirstName;
						$MiddleName=$userdetails->MiddleName;
						$LastName=$userdetails->LastName;
						$memid=DB::table('members')->insertGetId(['Bid'=>$Bid,'Aid'=>$Aid,'FirstName'=>$FirstName,'MiddleName'=>$MiddleName,'LastName'=>$LastName,'Uid'=>$id['userid'],'status'=>"AUTHORISED",'agent_member'=>"1"]);
						$usrid=$id['userid'];
					}
					else
					{
						$uid1=DB::table('members')->select('Memid')->where('Uid','=',$id['userid'])->first();
						$memid=$uid1->Memid;
						$usrid=$id['userid'];
					}
				}
				$perslid = DB::table('request_loan')->insertGetId(['Bid'=> $id['ReqPLBranchID'],'RL_MemId'=>$memid,'Requested_LoanAmt'=>$id['ReqPersLoanAmt'],'LoandurationYears'=>$id['LoanDurationYears'],'LoandurationDays'=>$id['LoanDurationDays'],'CreadtedBY'=>$UID,'Request_Date'=>$id['ReqPersLoanDate'],'LoanType_ID'=>$id['loantypeid'],'Loan_Category'=>$id['LoanCategory'],'Uid'=>$usrid]);
				
				DB::table('members')
				->where('Memid',$memid)
				->update(['Loan_Allocated'=>"NO"]);
				
			}
			else if($loancat1=="DEPOSITE LOAN")
			{
				$accno=$id['DepositAccountNum'];
				$perslid = DB::table('request_loan')->insertGetId(['Bid'=> $id['ReqPLBranchID'],'Requested_LoanAmt'=>$id['ReqDepReqLoanAmt'],'LoandurationYears'=>$id['LoanDurationYears'],'LoandurationDays'=>$id['LoanDurationDays'],'CreadtedBY'=>$UID,'Request_Date'=>$id['ReqPersLoanDate'],'LoanType_ID'=>$id['loantypeid'],'Loan_Category'=>$id['LoanCategory'],'DepLoan_AccNo'=>$id['DepositAccountNum'],'Payable_Amount'=>$id['ReqDepLoanAmt'],'Uid'=>$id['UID']]);
			}
			else if($loancat1=="STAFF LOAN")
			{
				
				$perslid = DB::table('request_loan')->insertGetId(['Bid'=> $id['ReqPLBranchID'],'Requested_LoanAmt'=>$id['ReqStfReqLoanAmt'],'LoandurationYears'=>$id['LoanDurationYears'],'LoandurationDays'=>$id['LoanDurationDays'],'CreadtedBY'=>$UID,'Request_Date'=>$id['ReqPersLoanDate'],'Loan_Category'=>$id['LoanCategory'],'Payable_Amount'=>$id['ReqStfLoanAmt'],'Uid'=>$id['ReqEmpID'],'LoanType_ID'=>"3"]);
			}
			else //For JEWEL LOAN
			{
				
				$perslid = DB::table('request_loan')->insertGetId(['Bid'=> $id['ReqPLBranchID'],'Requested_LoanAmt'=>$id['ReqJwlLoanAmt'],'JewelLoan_Duration'=>$id['ReqJewelDuration'],'CreadtedBY'=>$UID,'Request_Date'=>$id['ReqPersLoanDate'],'Loan_Category'=>$id['LoanCategory'],'Payable_Amount'=>$id['ReqJwlRate'],'Gold_Rate'=>$id['ReqJwlRate'],'Jewel_Description'=>$id['ReqJwlDesc'],'Uid'=>$id['ReqCustID'],'Payable_Amount'=>$id['ReqJwlRate'],'GrossWeight'=>$id['grossweight'],'NetWeight'=>$id['netweight'],'LoanType_ID'=>$id['jlid']]);
			}
			
			/*if($paymode!="CHEQUE")
				{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				
				$inhandcash1=$inhandcashh->InHandCash;
				$tot=$inhandcash1-$payamt;
				
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$tot]);
				}
				
				if($paymode=="CHEQUE")
				{
				$BankTotAmt = DB::table('addbank')->select('TotalAmt')
				->where('Bankid','=',$bankid)
				->first();
				
				$BankAmt=$BankTotAmt->TotalAmt;
				
				$ResultAmt=($BankAmt-$payamt);
				
				DB::table('addbank')->where('Bankid','=',$BankId)
				->update(['TotalAmt'=>$ResultAmt]);
				}
				
				else if($paymode=="CASH")
				{
				$total=$inhandcash1-$payamt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$dte,'InhandTrans_Particular'=>"Amount Credited from Personal Loan",'InhandTrans_Cash'=>$payamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"CREDIT",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$total]);
				
			}*/
			
			return $id;
		}
		
		/*public function GetPygmyDetailsForReqLoan($id)
			{
			return DB::table('pigmiallocation')
			->select('Total_Amount')
			->where('PigmiAllocID','=',$id)
			->first();
		}*/
		/*public function GetRDDetailsForReqLoan($id)
			{
			return DB::table('createaccount')
			->select('Total_Amount')
			->where('Accid','=',$id)
			->first();
		}*/
		
		/*public function GetRDNumForPersLoanReq()
			{
			return DB::table('createaccount')
			->select(DB::raw('Accid as id, AccNum as name'))
			->where('AccNum','like','%RD%')
			->get();
		}*/
		
		public function GetPersLoantype($q)
		{
			return DB::table('loan_type')
			->join('loancategory','loancategory.LoanCategoryId','=','loan_type.Loan_CategoryId')
			->select(DB::raw('loan_type.LoanType_ID as id, LoanType_Name as name'))
			->where('LoanType_Name','like','%'.$q.'%')
			->where('loancategory.LoanCategoryName','=',"PERSONAL LOAN")
			->get();
		}
		public function GetJltype($q)
		{
			return DB::table('loan_type')
			->join('loancategory','loancategory.LoanCategoryId','=','loan_type.Loan_CategoryId')
			->select(DB::raw('loan_type.LoanType_ID as id, LoanType_Name as name'))
			->where('LoanType_Name','like','%'.$q.'%')
			->where('loancategory.LoanCategoryName','=',"JEWEL LOAN")
			->get();
		}
		public function GetRequestLoanData()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BranchId=$uname->Bid;
			
			
			$id = DB::table('request_loan')
			->where('request_loan.Bid',$BranchId)
			->select('FirstName','MiddleName','LastName','PersLoanAllocID','Requested_LoanAmt','LoandurationYears','Request_Date','AmountDecideBy_Board','Loan_Category','DepLoan_AccNo','Payable_Amount','Auth_Status')
			
			->leftJoin('user','user.Uid','=','request_loan.Uid')// M 16-6-16
			//->leftJoin('members','members.Memid','=','request_loan.RL_MemId')
			->get();
			
			return $id;
			
		}
	}
	
