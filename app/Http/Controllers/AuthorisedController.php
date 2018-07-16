<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\AuthorisedModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\LoanTypeModel;
	class AuthorisedController extends Controller
	{
		public function __construct()
		{
			
			$this->viewcust= new AuthorisedModel;
			$this->Modules= new ModulesModel;
			$this->loantype= new LoanTypeModel;
		}
		public function show_custauth()
		{
			$Url="custauth";
			$ua['module']=$this->Modules->GetAnyMid($Url);
			return view('authorised',compact('ua'));
		}
		public function show_custAuthories()
		{
			
			$Url="custauth";
			$c['module']=$this->Modules->GetAnyMid($Url);
			$c['CustAuth']=$this->viewcust->GetcustAuthories();
			return view('custauthorise',compact('c'));
		}

		public function custauthorise_data()
		{
			$Url="custauth";
			$c['module']=$this->Modules->GetAnyMid($Url);
			$c['CustAuth']=$this->viewcust->GetcustAuthories();
			return view('custauthorise_data',compact('c'));
		}

		public function show_unauthemp()
		{
			$Url="custauth";
			$emp1['module']=$this->Modules->GetAnyMid($Url);
			$emp1['UnAuthEmp']=$this->viewcust->GetAuthEmployee();
			return view('unauthemployee',compact('emp1'));
		}

		public function unauthemployee_data()
		{
			$Url="custauth";
			$emp1['module']=$this->Modules->GetAnyMid($Url);
			$emp1['UnAuthEmp']=$this->viewcust->GetAuthEmployee();
			return view('unauthemployee_data',compact('emp1'));
		}

		public function show_custrejAuthories()
		{
			
			$Url="custauth";
			$c1['module']=$this->Modules->GetAnyMid($Url);
			$c1['CustRejList']=$this->viewcust->GetcustrejAuthories();
			return view('custrejectview',compact('c1'));
		}
		
		public function accept_custAuthories($id)
		{
			
			$accrejcust=$this->viewcust->AcceptcustAuthories($id);
			//return redirect('authcust');
			return redirect('/authcust');
			
		}
		public function reject_custAuthories($id)
		{
			$rejectcust=$this->viewcust->rejectcustAuthories($id);
			return redirect('custrejectview');
			
		}
		public function show_anauthaccount()
		{
			$Url="custauth";
			$a['module']=$this->Modules->GetAnyMid($Url);
			$a['data']=$this->viewcust->Getunauthaccount();
			$a['data_joint']=$this->viewcust->Getunauthaccount_joint();
			return view('anauthaccount',compact('a'));
		}
		public function accept_account($id)
		{
			$acceptaccount=$this->viewcust->AcceptAccount($id);
			return redirect('authaccount');
		}
		public function reject_account($id)
		{
			$reject=$this->viewcust->rejectAccount($id);
			return redirect('authaccount');
		}
		
		public function reject_accountview()
		{
			$Url="custauth";
			$rejectacc['module']=$this->Modules->GetAnyMid($Url);
			$rejectacc['data']=$this->viewcust->rejectAccountview();
			return view('rejectedaccount',compact('rejectacc'));
		}
		
		public function show_unauthpigmy()
		{
			
			$Url="custauth";
			$p['module']=$this->Modules->GetAnyMid($Url);
			$p['data']=$this->viewcust->Getunauthpigmy();
			return view('anauthpigmyacc',compact('p'));
		}
		public function accept_accountpigmy($id)
		{
			$acceptaccounpigmyt=$this->viewcust->AcceptAccountpigmy($id);
			return redirect('authpigmy');
		}
		public function reject_accountpigmy($id)
		{
			$rejectaccounpigmyt=$this->viewcust->rejectAccountpigmy($id);
			return redirect('authpigmy');
		}
		public function accept_empAuthories($id)
		{
			
			$authemp=$this->viewcust->AcceptempAuthories($id);
			//return redirect('authcust');
			//return redirect('/custauth');
			
		}
		public function reject_empAuthories($id)
		{
			$rejectemp=$this->viewcust->rejectempAuthories($id);
			//return redirect('custrejectview');
			
		}
		public function show_unauthLoan()
		{
			$LoanCat=$this->loantype->GetLoanCategoryDropD();
			return view('unauthloan',compact('LoanCat'));
		}
		public function show_unauthPigmyDL()
		{
			$pigmydl=$this->viewcust->GetUnauthPigmyDL();
			return view('UnAuthPigmiDL',compact('pigmydl'));
		}
		public function acceptunauthloan($id)
		{
			
			$authemp=$this->viewcust->acceptunauthloan($id);
			//return redirect('authcust');
			//return redirect('/authcust');
			
		}
		
		public function AcceptUnAuthPigmyDL($id)
		{
			
			$authpigmydl=$this->viewcust->AcceptUnAuthPigmyDL($id);
			//return redirect('authcust');
			//return redirect('/authcust');
			
		}
		public function rejectunauthloan($id)
		{
			$rejectemp=$this->viewcust->rejectunauthloan($id);
			//return redirect('custrejectview');
			
		}
		public function RejectUnAuthPigmyDL($id)
		{
			$rejectpigmydl=$this->viewcust->RejectUnAuthPigmyDL($id);
			//return redirect('custrejectview');
			
		}
		
		public function accept_rejcustAuthories($id)
		{
			$accrejectcust=$this->viewcust->accept_rejcustAuthories($id);
			return redirect('/authcust');
			
		}
		
		public function acceptreject_account($id)
		{
			$acceptrejaccount=$this->viewcust->AcceptRejectAccount($id);
			return redirect('authaccount');
		}
		
		//Get Details of Unauthorised Personal Loan
		public function show_unauthPLoan(Request $request)
		{
			$lcat['Loan_Cat']=$request->input('Loan_Cat');
			$Ploan=$this->viewcust->show_unauthPLoan($lcat);
			return view('UnAuthPersonalLoan',compact('Ploan'));
		}
		
		//Accept Unauthorised Personal Loan
		public function Accept_unauthPLoan(Request $request)
		{
			$accptploan['acceptamt']=$request->input('acceptamt');
			$accptploan['reslnno']=$request->input('reslnno');
			$accptploan['ploanalc']=$request->input('ploanalc');
			$authpigmydl=$this->viewcust->Accept_unauthPLoan($accptploan);
		}
		
		//Reject Unauthorised Personal Loan
		public function Reject_unauthPLoan($id)
		{
			$rejectpl=$this->viewcust->Reject_unauthPLoan($id);
		}
		
		//Get Details of Unauthorised Deposit Loan
		public function show_unauthDLoan(Request $request)
		{
			$lcat['Loan_Cat']=$request->input('Loan_Cat');
			$Dloan=$this->viewcust->show_unauthDLoan($lcat);
			return view('UnAuthDepositLoan',compact('Dloan'));
		}
		
		//Accept Unauthorised Deposit Loan
		public function Accept_unauthDLoan(Request $request)
		{
			$accptdloan['dacceptamt']=$request->input('dacceptamt');
			$accptdloan['dreslnno']=$request->input('dreslnno');
			$accptdloan['dloanal']=$request->input('dloanal');
			$authdl=$this->viewcust->Accept_unauthDLoan($accptdloan);
		}
		
		//Reject Unauthorised Deposit Loan
		public function Reject_unauthDLoan($id)
		{
			$rejectdl=$this->viewcust->Reject_unauthDLoan($id);
		}
		
		//Get Details of Unauthorised Staff Loan
		public function show_unauthSLoan(Request $request)
		{
			$lcat['Loan_Cat']=$request->input('Loan_Cat');
			$Sloan=$this->viewcust->show_unauthSLoan($lcat);
			return view('UnAuthStaffLoan',compact('Sloan'));
		}
		
		//Accept Unauthorised Staff Loan
		public function Accept_unauthSLoan(Request $request)
		{
			$accptsloan['sacceptamt']=$request->input('sacceptamt');
			$accptsloan['sreslnno']=$request->input('sreslnno');
			$accptsloan['sloanal']=$request->input('sloanal');
			$authsl=$this->viewcust->Accept_unauthSLoan($accptsloan);
		}
		
		//Reject Unauthorised Staff Loan
		public function Reject_unauthSLoan($id)
		{
			$rejectsl=$this->viewcust->Reject_unauthSLoan($id);
		}
		
		//Get Details of Unauthorised Jewel Loan
		public function show_unauthJLoan(Request $request)
		{
			$lcat['Loan_Cat']=$request->input('Loan_Cat');
			$Jloan=$this->viewcust->show_unauthJLoan($lcat);
			return view('UnAuthJewelLoan',compact('Jloan'));
		}
		
		//Accept Unauthorised Jewel Loan
		public function Accept_unauthJLoan(Request $request)
		{
			$accptjloan['jacceptamt']=$request->input('jacceptamt');
			$accptjloan['jreslnno']=$request->input('jreslnno');
			$accptjloan['jloanal']=$request->input('jloanal');
			$authjl=$this->viewcust->Accept_unauthJLoan($accptjloan);
		}
		
		//Reject Unauthorised Jewel Loan
		public function Reject_unauthJLoan($id)
		{
			$rejectjl=$this->viewcust->Reject_unauthJLoan($id);
		}
		
	}

	