<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Response;
	use App\Http\Model\BranchModel;
	use App\Http\Model\AccountTypeModel;
	use App\Http\Model\UserModel;
	use App\Http\Model\DesignationModel;
	use App\Http\Model\CustomerModel;
	use App\Http\Model\MemberModel;
	use App\Http\Model\AccountModel;
	use App\Http\Model\PigmiModel;
	use App\Http\Model\PigmiAllocationModel;
	use App\Http\Model\FdTypeModel;
	use App\Http\Model\LoanTypeModel;
	use App\Http\Model\DepositModel;
	use App\Http\Model\LoanModel;
	use App\Http\Model\prewithdrawalModel;
	use App\Http\Model\FdAllocationModel;
	use App\Http\Model\PayAmtModel;
	use App\Http\Model\salmodel;
	use App\Http\Model\EmployeeModel;
	use App\Http\Model\DLRepaymentModel;
	use App\Http\Model\PurchaseshareModel;
	use App\Http\Model\RequestLoanModel;
	use App\Http\Model\ShareModel;
	use App\Http\Model\ReportModel;
	use App\Http\Model\SDModel;
	use App\Http\Model\CDSDModel;
	
	class SearchController extends Controller
	{
		
		var $get_branch;
		var $get_acctyp;
		var $get_user;
		var $get_desig;
		var $get_cust;
		var $get_accnum;
		var $get_loantype;
		var $get_deposit;
		var $get_loan;
		var $get_prewyth;
		var $get_FdAllocation;
		var $get_PayAmt;
		var $get_sal;
		var $GetPurchaseShare;
		
		
		var $get_Emp;
		public function __construct()
		{ 
			$this->get_branch = new BranchModel;
			$this->get_acctyp = new AccountTypeModel;
			$this->get_user = new UserModel;
			$this->get_desig = new DesignationModel;
			$this->get_member=new MemberModel;
			$this->get_cust=new CustomerModel;
			$this->get_accnum=new AccountModel;
			$this->get_pigmitype=new PigmiModel;
			$this->get_pigmialloc=new PigmiAllocationModel;
			$this->get_fdtype=new FdTypeModel;
			$this->get_loantype=new LoanTypeModel;
			$this->get_deposit=new DepositModel;
			$this->get_loan=new LoanModel;
			$this->get_prewyth=new prewithdrawalModel;
			$this->GetPreWithdrawal=new prewithdrawalModel;
			$this->GetFdAllocation=new FdAllocationModel;
			$this->get_PayAmt=new PayAmtModel;
			$this->get_sal=new salmodel;
			$this->get_Emp=new EmployeeModel;
			$this->get_DL=new DLRepaymentModel;
			$this->GetPurchaseShare=new PurchaseshareModel;
			$this->Loan_Req=new RequestLoanModel;
			$this->Loan=new LoanModel;
			$this->Getsharemodel=new ShareModel;
			$this->rep_mdl=new ReportModel;
			$this->sd=new SDModel;
			$this->cdsd=new CDSDModel;
		}
		
		public function GetBranch(Request $request)
		{
			
			return ($this->get_branch->GetBranch($request->search));
		}
		
		public function GetBranchForAddBank(Request $request)
		{
			
			return ($this->get_branch->GetBranchForAddBank($request->search));
		}
		
		public function Getacctype(Request $request)
		{
			
			return ($this->get_acctyp->Getacctype($request->search));
		}
		
		public function Getusers(Request $request)
		{
			
			return ($this->get_user->Getusr($request));//dp edited
		}
		
		public function GetDesignation(Request $request)
		{
			
			return ($this->get_desig->GetDesignation($request->search));
		}
		
		public function GetMember(Request $request)
		{
			
			return ($this->get_member->GetMember($request->search));
		}
		
		public function Getaccountnum(Request $request)
		{
			
			return ($this->get_accnum->Getaccountnum($request->search));
		}
		public function GetPigmitype(Request $request)
		{
			return($this->get_pigmitype->GetPigmitype($request->search));
		}
		
		public function getFdType(Request $request)
		{
			return($this->get_fdtype->GetFdtype($request->search));
		}
		public function GetKCCtype(Request $request)
		{
			return($this->get_fdtype->GetKCCtype($request->search));
		}
		
		public function GetAgent(Request $request)
		{
			return($this->get_user->GetAgent($request->search));
		}
		public function getAllocagent(Request $request)
		{
			return($this->get_pigmialloc->GetAlocatedAgent($request->search));
		}
		public function GetAlocatedAgent1(Request $request)
		{
			return($this->get_pigmialloc->GetAlocatedAgent1($request->search));
		}
		public function getplacc_partpayment(Request $request)//for fetch sb account
		{
			return($this->get_DL->getplacc_partpayment($request->search));
		}
		public function getjlacc_partpayment(Request $request)//for fetch sb account
		{
			return($this->get_DL->getjlacc_partpayment($request->search));
		}
		public function getslacc_partpayment(Request $request)//for fetch sb account
		{
			return($this->get_DL->getslacc_partpayment($request->search));
		}
		public function getdlacc_partpayment(Request $request)//for fetch sb account
		{
			return($this->get_DL->getdlacc_partpayment($request->search));
		}
		public function getrdaccount(Request $request)
		{
			
			return ($this->get_accnum->getrdaccount($request->search));
		}
		public function get_running_rd_num(Request $request)
		{
			
			return ($this->get_accnum->get_running_rd_num($request->search));
		}
		
		public function GetSeachedAcc(Request $request)
		{
			
			return ($this->get_accnum->GetSeachedAcc($request->search));
			
		}
		public function GetSeachedpigmyAccount(Request $request)
		{
			
			return ($this->get_pigmialloc->GetSeachedpigmyAcc($request->search));
			
		}
		public function GetSeachedpigmyAccinterest(Request $request)
		{
			
			return ($this->get_pigmialloc->GetSeachedpigmyAccinterest($request->search));
			
		}
		public function GetpigmyAcc(Request $request)
		{
			
			return ($this->get_pigmialloc->GetpigmyAcc($request->search));
			
		}
		
		public function GetSeachedSbAccount(Request $request)
		{
			
			return ($this->get_accnum->GetSeachedSbAcc($request->search));
			
		}
		public function GetSearchSbAccWithOldAcc(Request $request)
		{
			
			return ($this->get_accnum->GetSearchSbAccWithOldAcc($request->search));
			
		}
		public function GetSearchRdAccWithOldAcc(Request $request)
		{
			
			return ($this->get_accnum->GetSearchRdAccWithOldAcc($request->search));
			
		}
		public function GetSearchFdAccWithOldAcc(Request $request)//04-04-16
		{
			
			return ($this->GetFdAllocation->GetSearchFdAccWithOldAcc($request->search));
			
		}
		public function GetSearchPigmyAccWithOldAcc(Request $request)
		{
			
			return ($this->get_pigmialloc->GetSearchPigmyAccWithOldAcc($request->search));
			
		}
		
		public function GetSeachedRdAccount(Request $request)
		{
			
			return ($this->get_accnum->GetSeachedRdAcc($request->search));
			
		}
		
		public function GetSeachedLoanAccount(Request $request)
		{
			
			return ($this->get_loan->GetLoanAcct($request->search));
			
		}
		
		public function getloantype(Request $request)
		{
			return ($this->get_loantype->getloantype($request->search));
		}
		
		public function GetDLoanType(Request $request)//7-4-16 FOR DL ALLOC
		{
			return ($this->get_loantype->GetDLoanType($request->search));
		}
		
		public function Getloanaccountnum(Request $request)
		{
			return ($this->get_accnum->Getloanaccount($request->search));
		}
		
		public function Getbank(Request $request)
		{
			return ($this->get_deposit->Getbankdetail($request->search));
		}
		
		public function GetBank_all_branch(Request $request)
		{
			return ($this->get_deposit->GetBank_all_branch($request->search));
		}
		
		//Newly Added
		public function GetLoanAcct(Request $request)
		{
			return ($this->get_loan->GetLoanAcct($request->search));
		}
		
		public function GetMinorUser(Request $request)
		{
			return ($this->get_cust->GetMinorUser($request->search));
		}
		
		public function GetBranchForFD(Request $request)
		{
			
			return ($this->get_branch->GetBranchForFD($request->search));
		}
		
		public function Getpigmyacct(Request $request)
		{
			
			return ($this->get_prewyth->Getpigmyacct($request->search));
		}
		
		
		public function GetBankNameForPayAmt(Request $request)
		{
			
			return ($this->GetPreWithdrawal->GetBankNameForPayAmt($request->search));
		}
		
		
		
		
		public function GetPigmyNumForLoanAlloc(Request $request)
		{
			
			return ($this->get_pigmialloc->GetPigmyNumForLoanAlloc($request->search));
		}
		
		public function GetRDNumForLoanAlloc(Request $request)
		{
			
			return ($this->get_accnum->GetRDNumForLoanAlloc($request->search));
		}
		
		public function GetFDNumForLoanAlloc(Request $request)
		{
			
			return ($this->GetFdAllocation->GetFDNumForLoanAlloc($request->search));
		}
		
		public function GetFDNumberForLoanAlloc(Request $request)//for DL allocation
		{
			
			return ($this->GetFdAllocation->GetFDNumberForLoanAlloc($request->search));
		}
		
		public function GetFDandKCCNumberForLoanAlloc(Request $request)//for DL allocation
		{
			
			return ($this->GetFdAllocation->GetFDandKCCNumberForLoanAlloc($request->search));
		}
		
		public function GetKCCNumberForLoanAlloc(Request $request)//for DL allocation
		{
			
			return ($this->GetFdAllocation->GetKCCNumberForLoanAlloc($request->search));
		}
		
		public function getrdprewithdraw(Request $request)
		{
			
			return ($this->GetPreWithdrawal->getrdprewithdraw($request->search));
		}
		
		//Newly Added from here and Modified
		public function GetPigmyAccForPayAmt(Request $request)
		{
			
			return ($this->get_PayAmt->GetPigmyAccForPayAmt($request->search));
		}
		
		//Get Pigmy Account Number from Interest Table(Newly Added)
		public function GetIntPigmyAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetIntPigmyAccForPayAmt($request->search));
		}
		public function GetRDAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetRDAccForPayAmt($request->search));
		}
		
		public function GetRDIntAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetRDIntAccForPayAmt($request->search));
		}
		
		public function GetFDAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetFDAccForPayAmt($request->search));
		}
		
		public function GetKCCAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetKCCAccForPayAmt($request->search));
		}
		
		public function GetFDMatuAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetFDMatuAccForPayAmt($request->search));
		}
		
		public function GetKCCMatuAccForPayAmt(Request $request)
		{
			return ($this->get_PayAmt->GetKCCMatuAccForPayAmt($request->search));
		}
		
		public function GetSalary(Request $request)
		{
			
			return ($this->get_sal->GetSalary($request->search));
		}
		
		public function GetEmployeeName(Request $request)
		{
			return ($this->get_Emp->GetEmployeeName($request->search));
		}	
		public function pigmydlacc(Request $request)//for pigmy repayment
		{
			return($this->get_DL->pigmydlacc($request->search));
		}
		public function GetMembersForPersLoan(Request $request)
		{
			return ($this->get_member->GetMembersForPersLoan($request->search));
		}
		public function Getjewelcust(Request $request)//new for jewel customer
		{
			return ($this->get_user->Getjewelcust($request->search));
		}
		
		public function GetSuretyName(Request $request)//new for Staff Surety
		{
			return ($this->get_Emp->GetSuretyName($request->search));
		}
		
		public function SearchCustomer(Request $request)//M 19-4-16 Comman Search For Customer
		{
			return ($this->get_cust->SearchCustomer($request->search));
		}
		public function SearchCustomer_usertable(Request $request)//M 19-4-16 Comman Search For Customer
		{
			return ($this->get_cust->SearchCustomer_usertable($request->search));
		}
		
		public function SearchFdAllocation(Request $request)//M 19-4-16 Comman Search For Fdallocation
		{
			return ($this->GetFdAllocation->SearchFdAllocation($request->search));
		}
		
		public function SearchKCCAllocation(Request $request)//M 19-4-16 Comman Search For Fdallocation
		{
			return ($this->GetFdAllocation->SearchKCCAllocation($request->search));
		}
		
		public function SearchMember(Request $request)//M 19-4-16 Search For member
		{
			return ($this->get_member->SearchMember($request->search));
		}
		
		public function SearchPurchaseShare(Request $request)//M 19-4-16 Search For purchase share
		{
			return ($this->GetPurchaseShare->SearchPurchaseShare($request->search));
		}
		
		public function SearchPigmy(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			return ($this->get_pigmialloc->SearchPigmy($request->search));
		}
		
		public function SearchPigmyPay(Request $request)//M 20-4-16 Search For PigmyPayAmountHome
		{
			return ($this->get_PayAmt->SearchPigmyPay($request->search));
		}
		
		public function SearchRdPay(Request $request)//M 20-4-16 Search For RdPayAmountHome
		{
			return ($this->get_PayAmt->SearchRdPay($request->search));
		}
		
		public function SearchFdPay(Request $request)//M 20-4-16 Search For FdPayAmountHome
		{
			return ($this->get_PayAmt->SearchFdPay($request->search));
		}
		
		public function GetSeachedOldAcc(Request $request)//M 
		{
			return ($this->get_accnum->GetSeachedOldAcc($request->search));
		}
		
		public function PigmiAccountForAgent(Request $request) //LOCAL TYPE AHEAD DATA
		{
			
			return response()->json($this->get_pigmialloc->PigmiAccountForAgent($request->search));
			
		}
		
		public function GetMembersForPersLoanAlloc(Request $request)
		{
			return ($this->Loan->GetMembersForPersLoanAlloc($request->search));
		}
		
		//Get Pygmy Account For Deposit Loan Allocation
		public function GetPigmyNumForDLAlloc(Request $request)
		{
			return ($this->Loan->GetPigmyNumForDLAlloc($request->search));
		}
		
		//Get RD Account For Deposit Loan Allocation
		public function GetRDNumForDLAlloc(Request $request)
		{
			return ($this->Loan->GetRDNumForDLAlloc($request->search));
		}
		
		//Get FD Account For Deposit Loan Allocation
		public function GetFDNumForDLAlloc(Request $request)
		{
			return ($this->Loan->GetFDNumForDLAlloc($request->search));
		}
		public function Getjewelcustfromrequesttable(Request $request)
		{
			return ($this->Loan->Getjewelcustfromrequesttable($request->search));
		}
		
		public function GetEmpNameForSLAlloc(Request $request)
		{
			return ($this->Loan->GetEmpNameForSLAlloc($request->search));
		}
		public function RDdlacc(Request $request)//for pigmy repayment
		{
			return($this->get_DL->RDdlacc($request->search));
		}
		public function FDdlacc(Request $request)//for pigmy repayment
		{
			return($this->get_DL->FDdlacc($request->search));
		}
		public function FDdlacc_fd(Request $request)//for pigmy repayment
		{
			return($this->get_DL->FDdlacc_fd($request->search));
		}
		public function loan_pl(Request $request)//for pigmy repayment
		{
			return($this->get_DL->loan_pl($request->search));
		}
		public function loan_dl(Request $request)//for pigmy repayment
		{
			return($this->get_DL->loan_dl($request->search));
		}
		public function loan_sl(Request $request)//for pigmy repayment
		{
			return($this->get_DL->loan_sl($request->search));
		}public function loan_jl(Request $request)//for pigmy repayment
		{
			return($this->get_DL->loan_jl($request->search));
		}
		public function fdCertTypeAhead(Request $request)//for pigmy repayment
		{
			return($this->get_DL->fdCertTypeAhead($request->search));
		}
		public function SBdlacc(Request $request)//for fetch sb account
		{
			return($this->get_DL->SBdlacc($request->search));
		}
		public function getplacc(Request $request)//for fetch sb account
		{
			return($this->get_DL->getplacc($request->search));
		}
		public function getjlacc(Request $request)//for fetch sb account
		{
			return($this->get_DL->getjlacc($request->search));
		}
		public function getslacc(Request $request)//for fetch sb account
		{
			return($this->get_DL->getslacc($request->search));
		}
		public function getdlacc(Request $request)//for fetch sb account
		{
			return($this->get_DL->getdlacc($request->search));
		}
		public function Getcertificatnum(Request $request)
		{
			return ($this->Getsharemodel->Getcertificatnum($request->search));
		}
		public function getjlaccsearch(Request $request)//for fetch sb account
		{
			return($this->get_DL->getjlaccsearch($request->search));
		}
		public function getplaccsearch(Request $request)
		{
			return($this->get_DL->getplaccsearch($request->search));
		}
		public function getslaccsearch(Request $request)
		{
			return($this->get_DL->getslaccsearch($request->search));
		}
		public function getdlaccsearch(Request $request)
		{
			return($this->get_DL->getdlaccsearch($request->search));
		}
		public function GetMemberdetails(Request $request)
		{
			return($this->GetPurchaseShare->GetMemberdetails($request->search));
		}
		public function getuser_forloan(Request $request)
		{
			return($this->get_user->getuser_forloan($request->search));
		}
		public function adjustment_num(Request $request)
		{
			return($this->get_DL->adjustment_num($request->search));
		}
		public function getAllocatesaraparalist(Request $request)
		{
			return($this->get_pigmialloc->getAllocatesaraparalist($request->search));
		}
		public function FdClosedAcc_Unpaid(Request $request)
		{
			return($this->get_DL->FdClosedAcc_Unpaid($request->search));
		}
		
		public function search_agent(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			return ($this->rep_mdl->search_agent($request->search));
		}
		
		/* public function search_sd_acc_no(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			return ($this->sd->search_sd_acc_no($request->search));
		} */

		public function search_cdsd_acc_no(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			$fn_data["query_string"] = $request->input("query");
			$fn_data["cdsd_type"] = $request->input("cdsd_type");
			$fn_data["user_type"] = $request->input("user_type");
			$fn_data["cdsd_closed"] = $request->input("cdsd_closed");
			// print_r($fn_data);
			return $this->cdsd->search_cdsd_acc_no($fn_data);
		}
		
		public function search_employee_for_cdsd(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			return ($this->cdsd->search_employee_for_cdsd($request->search));
		}
		
		public function search_agent_for_cdsd(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			return ($this->cdsd->search_agent_for_cdsd($request->search));
		}
		
		public function search_customer_for_cdsd(Request $request)//M 20-4-16 Search For pigmiallocation
		{
			return ($this->cdsd->search_customer_for_cdsd($request->search));
		}
		
		public function search_sb_for_cdsd(Request $request)
		{
			$fn_data["query_string"] = $request->input("query");
			$fn_data["allow_inter_branch"] = $request->input("allow_inter_branch");
			return ($this->cdsd->search_sb_for_cdsd($fn_data));
		}

	}
	