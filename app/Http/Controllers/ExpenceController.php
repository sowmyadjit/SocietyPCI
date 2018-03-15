<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\ExpenceModel;
	use App\Http\Model\ReportModel;
	
	class ExpenceController extends Controller
	{
		
		
		
		public function __construct()
		{
			$this->creadexpencemodel = new ExpenceModel;
			$this->Modules= new ModulesModel;
			$this->Report_model = new ReportModel;
			
		}
		public function display_exp()
		{
			$Url="expence";
			$led['module']=$this->Modules->GetAnyMid($Url);
			$led['expense']=$this->creadexpencemodel->getExpensedata();
			return view('createexp',compact('led'));
		}
		public function show_expence()
		{
			$Url="expence";
			$ex['module']=$this->Modules->GetAnyMid($Url);
			$ex['expense']=$this->creadexpencemodel->GetAllExpence();
			
			return view('expence',compact('ex'));
		}
		
		public function create_expence(Request $request)
		{
			$ex['bankName']=$request->input('bankName');
			$ex['bank']=$request->input('bank');
			$ex['ta']=$request->input('ta');
			$ex['branchid']=$request->input('branchid');
			$ex['paymode']=$request->input('paymode');
			$ex['chqno']=$request->input('chqno');
			$ex['chdate']=$request->input('chdate');
			$ex['parti']=$request->input('parti');
			$ex['unclearedval']=$request->input('unclearedval');
			
			$id=$this->creadexpencemodel->insert($ex);
			return redirect('/');
			
		}
		
		public function create_exp(Request $request)
		{
			$ex['accnum']=$request->input('accnum');
			$ex['socbranch']=$request->input('socbranch');
			$ex['paydone']=$request->input('paydone');
			$ex['exphead']=$request->input('exphead');
			$ex['expsubhead']=$request->input('expsubhead');
			$ex['ta']=$request->input('ta');
			$ex['ta1']=$request->input('ta1');
			$ex['parti']=$request->input('parti');
			$ex['parti1']=$request->input('parti1');
			$ex['bn']=$request->input('bn');
			//$ex['bank']=$request->input('bank');
			$ex['bankid']=$request->input('bankid');
			$ex['totalamt']=$request->input('totalamt');
			$ex['branchid']=$request->input('branchid');
			$ex['bankName']=$request->input('bankName');
			$ex['ifsc']=$request->input('ifsc');
			
			$ex['chqno']=$request->input('chqno');
			$ex['chdate']=$request->input('chdate');
			
			$ex['unclearedval']=$request->input('unclearedval');
			$ex['exphead']=$request->input('exphead');
			$ex['expsubhead']=$request->input('expsubhead');
			$id=$this->creadexpencemodel->insertinhand($ex);
			return redirect('/');
			
		}
		
		public function display_expence()
		{
			$Url="expence";
			$ex['module']=$this->Modules->GetAnyMid($Url);
			//return view('createexpence',compact('Expense'));
			return view('createexpence',compact('ex'));
		}
		
		public function display_tranexpence()
		{
			$Url="expence";
			$ex['module']=$this->Modules->GetAnyMid($Url);
			return view('createtranexpence',compact('ex'));
		}
		
		public function create_tranexpence(Request $request)
		{
			$ex['bankName']=$request->input('bankName');
			$ex['bank']=$request->input('bank');
			$ex['bankName2']=$request->input('bankName2');
			$ex['bank2']=$request->input('bank2');
			$ex['ta']=$request->input('ta');
			$ex['branch']=$request->input('branch');
			
			$id=$this->creadexpencemodel->insert_tran($ex);
			return redirect('/');
			
		}
		
		public function GetBankDetail(Request $request)
		{
			$bnk['bankid']=$request->input('bankid');
			$get=$this->creadexpencemodel->GetBankDetail($bnk);
			$id['bnkbranch']=$get->Branch;
			$id['ifsc']=$get->AddBank_IFSC;
			$id['totamt']=$get->TotalAmt;
			return $id;
		}
		
		public function GetExpenseSuBId(Request $request)//T
		{
			$ExpenseListBW=$this->creadexpencemodel->GetExpenseDropD($request);
			
			return json_encode($ExpenseListBW);
			
		}
		
		public function GetSubLedgerHead(Request $request)//T
		{
			$Lid['LedgerId']=$request->input('LedgerId');
			$SubLedger=$this->creadexpencemodel->GetSubLedgerHead($Lid);
			return json_encode($SubLedger);
			
		}
		public function expenceBranch()
		{
			$branch['branch_data']=$this->Report_model->GetBranchDropD();
			$branch['led']=$this->creadexpencemodel->getExpensedata();
			$branch['tran']=$this->creadexpencemodel->getExpensetran();
			return view('branchtobranchtransfer',compact('branch'));
		}
		public function transferbranchamt(Request $request)
		{
			$branch['Br1']=$request->input('Br1');
			$branch['Br2']=$request->input('Br2');
			//$branch['Br1id']=$request->input('Br1id');
			//$branch['Br2id']=$request->input('Br2id');
			$branch['amt']=$request->input('amt');
			$branch['per']=$request->input('per');
			$branch['tt']=$request->input('tt');
			$branch['hid']=$request->input('hid');
			$branch['sid']=$request->input('sid');
			
			$this->creadexpencemodel->transferbranchamt($branch);
		}
		public function ExReceipt($id)
		{
			$ib=$this->creadexpencemodel->GetExpenceReceipt($id);
			// print_r($exp);
			return view('ExpenceReceipt',compact('ib'));
			
		}
		public function income()
		{
			// $ex=ExpenceModel::all();
			$ex=$this->creadexpencemodel->GetAllIncome();
			return view('income',compact('ex'));
		}
		public function createIncome()
		{
			$led=$this->creadexpencemodel->getExpensedata();
			return view('createincome',compact('led'));
		}
		public function createincomes(Request $request)
		{
			$ex['accnum']=$request->input('accnum');
			$ex['socbranch']=$request->input('socbranch');
			$ex['paydone']=$request->input('paydone');
			$ex['incomehead']=$request->input('incomehead');
			$ex['incomesubhead']=$request->input('incomesubhead');
			$ex['ta']=$request->input('ta');
			$ex['ta1']=$request->input('ta1');
			$ex['parti']=$request->input('parti');
			$ex['parti1']=$request->input('parti1');
			$ex['bn']=$request->input('bn');
			
			$ex['bankid']=$request->input('bankid');
/*edit 29SEP2017*/
			$ex['bankid2']=$request->input('bankid2');
/*edit END 29SEP2017*/
			$ex['totalamt']=$request->input('totalamt');
			$ex['branchid']=$request->input('branchid');
			$ex['bankName']=$request->input('bankName');
/*edit 29SEP2017*/
			$ex['bankName2']=$request->input('bankName2');
/*edit END 29SEP2017*/
			$ex['ifsc']=$request->input('ifsc');
			
			$ex['chqno']=$request->input('chqno');
			$ex['chdate']=$request->input('chdate');
			
			$ex['unclearedval']=$request->input('unclearedval');
			$ex['exphead']=$request->input('exphead');
			$ex['expsubhead']=$request->input('expsubhead');
			$id=$this->creadexpencemodel->createincomes($ex);
			return redirect('/');
			
		}
		public function IncomeReceipt($id)
		{
			$ib=$this->creadexpencemodel->GetIncomeReceipt($id);
			
			return view('IncomeReceipt',compact('ib'));
			
		}
	}
