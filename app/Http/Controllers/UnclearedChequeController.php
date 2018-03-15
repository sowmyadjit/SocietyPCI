<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\UnclearedChequeModel;
	use App\Http\Model\ModulesModel;
	
	class UnclearedChequeController extends Controller
	{
		
		
		
		
		var $unclrcheque;
		
		public function __construct()
		{
			$this->unclrcheque = new UnclearedChequeModel;
			$this->Modules= new ModulesModel;
		}
		public function show_detail()
		{
			$Url="unclearedcheque";
			$cheque['module']=$this->Modules->GetAnyMid($Url);
			$cheque['data']=$this->unclrcheque->get_transdetail();
			//print_r($cheque);
			return view('UnclearedSBCheque',compact('cheque'));
		}
		
		public function show_uncleareddetail()
		{
			$Url="unclearedcheque";
			$uc=$this->Modules->GetAnyMid($Url);
			//$uc['data']=$this->unclrcheque->GetModuleData();
			return view('UnclearedCheque',compact('uc'));
		}
		public function cheque_clear(Request $request)
		{
			$chqaccept['cheqchrge']=$request->input('cheqchrge');
			$chqaccept['tid']=$request->input('tid');
			$chequeclr=$this->unclrcheque->ClearCheque($chqaccept);
			//return redirect('/');
		}
		public function rd_clear($id)
		{
			$rdchequeclr=$this->unclrcheque->ClearRDCheque($id);
			//return redirect('/');
		}
		
		public function pigmi_clear($id)
		{
			$pgmchequeclr=$this->unclrcheque->ClearPgmCheque($id);
			//return redirect('/');
		}
		
		public function loan_clear($id)
		{
			$loanchequeclr=$this->unclrcheque->ClearloanCheque($id);
			//return redirect('/');
		}
		public function fd_clear($id)
		{
			$fdchequeclr=$this->unclrcheque->ClearfdCheque($id);
			//return redirect('/');
		}
		public function Expense_clear($id)
		{
			$expchequeclr=$this->unclrcheque->Expense_clear($id);
			//return redirect('/');
		}
		
		public function cheque_reject(Request $request)
		{
			$chqrjct['cheqchrge']=$request->input('cheqchrge');
			$chqrjct['tid']=$request->input('tid');
			$chqrjct['bankamt']=$request->input('bankamt');
			
			$chequerjct=$this->unclrcheque->RejectCheque($chqrjct);
		}
		
		public function rd_reject(Request $request)
		{
			$rdchqrjct['cheqchrge']=$request->input('cheqchrge');
			$rdchqrjct['tid']=$request->input('tid');
			
			$chequerjct=$this->unclrcheque->RDRejectCheque($rdchqrjct);
		}
		public function Pgm_Reject(Request $request)
		{
			$pgmchqrjct['cheqchrge']=$request->input('cheqchrge');
			$pgmchqrjct['tid']=$request->input('tid');
			
			$chequerjct=$this->unclrcheque->PgmRejectCheque($pgmchqrjct);
		}
		public function loan_reject(Request $request)
		{
			$loanchqrjct['cheqchrge']=$request->input('cheqchrge');
			$loanchqrjct['tid']=$request->input('tid');
			
			$chequerjct=$this->unclrcheque->LoanRejectCheque($loanchqrjct);
		}
		public function fd_reject(Request $request)
		{
			$fdchqrjct['cheqchrge']=$request->input('cheqchrge');
			$fdchqrjct['tid']=$request->input('tid');
			
			$chequerjct=$this->unclrcheque->FDRejectCheque($fdchqrjct);
		}
		public function Expense_Reject(Request $request)
		{
			$expchqrjct['cheqchrge']=$request->input('cheqchrge');
			$expchqrjct['tid']=$request->input('tid');
			
			$chequerjct=$this->unclrcheque->Expense_Reject($expchqrjct);
		}
		
		public function Show_RDDetail()
		{
			
			$Url="unclearedcheque";
			$rdcheque['module']=$this->Modules->GetAnyMid($Url);
			$rdcheque['data']=$this->unclrcheque->get_rdtransdetail();
			//print_r($cheque);
			return view('UnclearedRDCheque',compact('rdcheque'));
		}
		
		public function Show_PgmDetail()
		{
			$Url="unclearedcheque";
			$pgmcheque['module']=$this->Modules->GetAnyMid($Url);
			$pgmcheque['data']=$this->unclrcheque->get_pgmtransdetail();
			//print_r($cheque);
			return view('UnclearedPgmCheque',compact('pgmcheque'));
		}
		public function show_loandetail()
		{
			$Url="unclearedcheque";
			$loancheque['module']=$this->Modules->GetAnyMid($Url);
			$loancheque['dl']=$this->unclrcheque->get_dlcheque();
			$loancheque['pl']=$this->unclrcheque->get_plcheque();
			$loancheque['jl']=$this->unclrcheque->get_jlcheque();
			
			//print_r($cheque);
			return view('UnclearedLoanCheque',compact('loancheque'));
		}
		public function Show_FDDetail()
		{
			$Url="unclearedcheque";
			$fdcheque['module']=$this->Modules->GetAnyMid($Url);
			$fdcheque['data']=$this->unclrcheque->get_fdtransdetail();
			//print_r($cheque);
			return view('UnclearedFDCheque',compact('fdcheque'));
		} 
		
		public function Show_ExpenseDetail()
		{
			$Url="unclearedcheque";
			$exp['module']=$this->Modules->GetAnyMid($Url);
			$exp['data']=$this->unclrcheque->get_Expensedetail();
			//print_r($cheque);
			return view('UnclearedExpenseCheque',compact('exp'));
		}
		
		public function AcceptCheque($repayid,$loanid,$type)
		{
			if($type=="dl")
			{
				$repaydetailss=DB::table('depositeloan_repay')->select('DLRepay_DepAllocID','DLRepay_PrincipalPaid','Dl_CreditBank','DLRepay_PaidAmt')
				->where('DLRepay_ID',$repayid)->first();
				DB::table('depositeloan_repay')->where('DLRepay_ID',$repayid)->update(['Dl_Cheque_Status'=>"0"]);
				$allocid=$repaydetailss->DLRepay_DepAllocID;
				$paidamt=$repaydetailss->DLRepay_PrincipalPaid;
				$bankid=$repaydetailss->Dl_CreditBank;
				$DLRepay_PaidAmt=$repaydetailss->DLRepay_PaidAmt;
				$principalamt1=DB::table('depositeloan_allocation')->select('DepLoan_RemailningAmt')->where('DepLoanAllocId',$allocid)->first();
				$principalamt=$principalamt1->DepLoan_RemailningAmt;
				$tot=$principalamt-$paidamt;
				DB::table('depositeloan_allocation')->where('DepLoanAllocId',$allocid)->update(['DepLoan_RemailningAmt'=>$tot]);
				$bankamt1=DB::table('addbank')->select('TotalAmt')->where('Bankid',$bankid)->first();
				$bankamt=$bankamt1->TotalAmt;
				$totbankamt=$bankamt+$DLRepay_PaidAmt;
				DB::table('addbank')->where('Bankid',$bankid)->update(['TotalAmt'=>$totbankamt]);
				
				
			}
			else if($type=="pl")
			{
				$repaydetailss=DB::table('personalloan_repay')->select('PLRepay_PLAllocID','PLRepay_Amtpaidtoprincpalamt','PL_CreditBank','PLRepay_PaidAmt')
				->where('PLRepay_Id',$repayid)->first();
				DB::table('personalloan_repay')->where('PLRepay_Id',$repayid)->update(['PL_ChequeStatus'=>"0"]);
				$allocid=$repaydetailss->PLRepay_PLAllocID;
				$paidamt=$repaydetailss->PLRepay_Amtpaidtoprincpalamt;
				$bankid=$repaydetailss->PL_CreditBank;
				$PLRepay_PaidAmt=$repaydetailss->PLRepay_PaidAmt;
				$principalamt1=DB::table('personalloan_allocation')->select('RemainingLoan_Amt')->where('PersLoanAllocID',$allocid)->first();
				$principalamt=$principalamt1->RemainingLoan_Amt;
				$tot=$principalamt-$paidamt;
				DB::table('personalloan_allocation')->where('PersLoanAllocID',$allocid)->update(['RemainingLoan_Amt'=>$tot]);
				$bankamt1=DB::table('addbank')->select('TotalAmt')->where('Bankid',$bankid)->first();
				$bankamt=$bankamt1->TotalAmt;
				$totbankamt=$bankamt+$PLRepay_PaidAmt;
				DB::table('addbank')->where('Bankid',$bankid)->update(['TotalAmt'=>$totbankamt]);
				
			}
			else if($type=="jl")
			{
				$repaydetailss=DB::table('jewelloan_repay')->select('JLRepay_JLAllocID','JLRepay_paidtoprincipalamt','JL_CreditBank','JLRepay_PaidAmt')
				->where('JLRepay_Id',$repayid)->first();
				DB::table('jewelloan_repay')->where('JLRepay_Id',$repayid)->update(['JL_Status'=>"0"]);
				$allocid=$repaydetailss->JLRepay_JLAllocID;
				$paidamt=$repaydetailss->JLRepay_paidtoprincipalamt;
				$bankid=$repaydetailss->JL_CreditBank;
				$JLRepay_PaidAmt=$repaydetailss->JLRepay_PaidAmt;
				$principalamt1=DB::table('jewelloan_allocation')->select('JewelLoan_LoanRemainingAmount')->where('JewelLoanId',$allocid)->first();
				$principalamt=$principalamt1->JewelLoan_LoanRemainingAmount;
				$tot=$principalamt-$paidamt;
				DB::table('jewelloan_allocation')->where('JewelLoanId',$allocid)->update(['JewelLoan_LoanRemainingAmount'=>$tot]);
				$bankamt1=DB::table('addbank')->select('TotalAmt')->where('Bankid',$bankid)->first();
				$bankamt=$bankamt1->TotalAmt;
				$totbankamt=$bankamt+$JLRepay_PaidAmt;
				DB::table('addbank')->where('Bankid',$bankid)->update(['TotalAmt'=>$totbankamt]);
				
			}
			
			
			
		}
	}
