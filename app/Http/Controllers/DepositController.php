<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\DepositModel;
	
	class depositController extends Controller
	{
		
		
		
		public function __construct()
		{
			$this->creadepositmodel = new DepositModel;
			$this->Modules= new ModulesModel;
		}
		
		public function show_deposit()
		{
			$Url="deposit";
			$depo['module']=$this->Modules->GetAnyMid($Url);
			$depo['deposits']=$this->creadepositmodel->GetDepositData();
			return view('deposit',compact('depo'));
		}
		
		public function create_deposit(Request $request)
		{
			$depo['bankName']=$request->input('bankName');
			$depo['bank']=$request->input('bank');
			$depo['ta']=$request->input('ta');
			$depo['branch']=$request->input('branch');
			$depo['perti']=$request->input('perti');
			$depo['bbbranch']=$request->input('bbbranch');
			$depo['chdate']=$request->input('chdate');
			$depo['chqno']=$request->input('chqno');
			$depo['paymode']=$request->input('paymode');
			$id=$this->creadepositmodel->insert($depo);
			return redirect('/');
			
		}
		
		public function display_deposit()
		{
			$Url="deposit";
			$branch['module']=$this->Modules->GetAnyMid($Url);
			//$branch=$this->creadepositmodel->GetBranchDropD();
			//return view('createdeposit',['branch'=>$branch]);
			$branch['Blist']=$this->creadepositmodel->GetBranchDropD();
			return view('createdeposit',compact('branch'));
		}
		
		public function GetBankDetailForDeposite(Request $request)
		{
			
			$deposit['bankid']=$request->input('bankid');
			$get=$this->creadepositmodel->GetBankDetailForDeposite($deposit);
			$id['bnkbranch']=$get->Branch;
			$id['ifsc']=$get->AddBank_IFSC;
			$id['totamt']=$get->TotalAmt;
			
			return $id;
		}
		
		public function depodetailbranch()
		{
			$branch=$this->creadepositmodel->GetBranchDropD();
			return view('deposittobranch',['branch'=>$branch]);
			
			
		}
		public function crateaddeposittobranch(Request $request)
	{
		$depo['bankName']=$request->input('bankName');
		$depo['bank']=$request->input('bank');
		$depo['ta']=$request->input('ta');
		$depo['branch']=$request->input('branch');
		$depo['perti']=$request->input('perti');
		$depo['paymode']=$request->input('paymode');
		$depo['bank']=$request->input('bank');
		$id=$this->creadepositmodel->crateaddeposittobranch($depo);
		return redirect('/');
	
	}
	
	//	PIGMY FD KCC MATURITY-DEPOSIT
		public function deposit_account_list(Request $request)
		{
			$in_data['category'] = $request->input("category");
			$in_data['closed'] = $request->input("closed");
			$in_data['agent_id'] = $request->input("agent_id");
			$in_data['allocation_id'] = $request->input("allocation_id");
			switch($in_data['category']) {
				case "PG":	$ret_data = $this->creadepositmodel->deposit_account_list_pg($in_data);
							return view("deposit_account_list_data",compact("ret_data"));
							break;
				case "FD":	$ret_data = $this->creadepositmodel->deposit_account_list_fd($in_data);
							return view("deposit_account_list_data_fd",compact("ret_data"));
							break;
				case "KCC":	$ret_data = $this->creadepositmodel->deposit_account_list_fd($in_data);
							return view("deposit_account_list_data_kcc",compact("ret_data"));
							break;
				case "MD":	$ret_data = $this->creadepositmodel->deposit_account_list_md($in_data);
							return view("deposit_account_list_data_md",compact("ret_data"));
							break;
			}
		}
	
		public function deposit_account_edit(Request $request)
		{
			$in_data['category'] = $request->input("category");
			$in_data['closed'] = $request->input("closed");
			$in_data['allocation_id'] = $request->input("allocation_id");
			switch($in_data['category']) {
				case "PG":	$ret_data = $this->creadepositmodel->deposit_account_edit_pg($in_data);
							break;
				case "FD":	
				case "KCC":	
							$ret_data = $this->creadepositmodel->deposit_account_edit_fd($in_data);//SAME FN FOR FD AND KCC
							break;
			}
			return "deposit_account_edit: done";
		}
		
		public function maturity_deposit_index()
		{
			$data = [];
			return view("maturity_deposit_index",compact('data'));
		}
		
		public function maturity_amount_pay_form(Request $request)
		{
			$data = [];
			$in_data["allocation_id"] = $request->input("allocation_id");
			$data = $this->creadepositmodel->maturity_amount_pay_form($in_data);
			return view("maturity_amount_pay_form",compact('data'));
		}
		
		public function maturity_amt_create(Request $request)
		{
			$in_data["md_id"] = $request->input("md_id");
			$in_data["tran_date"] = $request->input("tran_date");
			$in_data["payable_amt"] = $request->input("payable_amt");
			$in_data["particulars"] = $request->input("particulars");///////////////include it in view
			$in_data["account_no"] = $request->input("account_no");
			$in_data["pay_mode"] = $request->input("pay_mode");
			$in_data["cheque_no"] = $request->input("cheque_no");
			$in_data["cheque_date"] = $request->input("cheque_date");
			$in_data["bank_id"] = $request->input("bank_id");
			$in_data["bank_branch"] = $request->input("bank_branch");
			$in_data["ifsc_code"] = $request->input("ifsc_code");
			$in_data["bank_acc_no"] = $request->input("bank_acc_no");
			$in_data["actid"] = $request->input("actid");
			$in_data["type_ahead_sb_acc_no"] = $request->input("type_ahead_sb_acc_no");
			$in_data["sb_acc_no"] = $request->input("sb_acc_no");
			$in_data["sb_available_amount"] = $request->input("sb_available_amount");
			$in_data["sb_remaining_amount"] = $request->input("sb_remaining_amount");
			$data = $this->creadepositmodel->maturity_amt_create($in_data);
			return "done";
		}
	}
