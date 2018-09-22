<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\OpenCloseModel;
	use App\Http\Model\ModulesModel;
	use DB;
	use Auth;
	class OpenCloseBalanceController extends Controller
	{
		
		
		var $op;
		
		public function __construct()
		{
			$this->op = new OpenCloseModel;
			$this->Modules= new ModulesModel;
			
		}
		public function viewopenclose()
		{
			$Url="openclose";
			$OpCls['module']=$this->Modules->GetAnyMid($Url);
			$OpCls['is_day_open'] = $this->op->is_day_open(date("Y-m-d"));
			$OpCls['did'] = $this->op->get_did();
			//$OpCls=$this->op->GetOpClsModule();
			return view('openclose',compact('OpCls'));
		}
		public function show_balance()
		{
			$Url="openclose";
			$i['module']=$this->Modules->GetAnyMid($Url);
			$i['openbal']=$this->op->getbal();
			//$i['module']=$this->op->GetModule();
			return view('viewopeningbal',compact('i'));
			//return view('createaccount');
		}
		
		function show_closingbalance()
		{
			$Url="openclose";
			$i['module']=$this->Modules->GetAnyMid($Url);
			$i['data']=$this->op->getclosebal();
			return view('viewcloseingbal',compact('i'));
			//return view('createaccount');
		}
		function show_dailybalance1()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;

			$dte=date('Y-m-d');
			$trandaily['date'] = $dte;
			$trandaily['bid'] = $BID;
			//SB
			$trandaily['sb']=$this->op->show_dailysbbalance($dte);
			$trandaily['sbcredit']=$this->op->show_dailysbcreditbalance($dte);
			$trandaily['sbdebit']=$this->op->show_dailysbdebitbalance($dte);
			
			$trandaily['sb_adjust']=$this->op->show_dailysbbalance_adjust($dte);
			$trandaily['sbcredit_adjust']=$this->op->show_dailysbcreditbalance_adjust($dte);
			$trandaily['sbdebit_adjust']=$this->op->show_dailysbdebitbalance_adjust($dte);
			$trandaily['sb_int_paid']=$this->op->sb_int_paid($dte);
			//RD
			$trandaily['rd']=$this->op->show_dailyrdbalance($dte);
			$trandaily['rdcredit']=$this->op->show_dailyrdcreditbalance($dte);
			$trandaily['rddebit']=$this->op->show_dailyrddebitbalance($dte);
			
			$trandaily['rd_adjust']=$this->op->show_dailyrdbalance_adjust($dte);
			$trandaily['rdcredit_adjust']=$this->op->show_dailyrdcreditbalance_adjust($dte);
			$trandaily['rddebit_adjust']=$this->op->show_dailyrddebitbalance_adjust($dte);
			//pigmi
			$trandaily['pigmy']=$this->op->show_dailypigmybalance($dte);
			
			$trandaily['pigmycredit']=$this->op->show_dailypigmycreditbalance($dte);
			$trandaily['pigmydebit']=$this->op->show_dailypigmydebitbalance($dte);
			$trandaily['pigmycash']=$this->op->show_dailypigmybalance_cash($dte);
			$trandaily['pigmycashcredit']=$this->op->show_dailypigmybalance_cash_credit($dte);
			$trandaily['pigmycashdebit']=$this->op->show_dailypigmybalance_cash_debit($dte);
			$trandaily['pigmy_service_charge']=$this->op->show_pigmy_service_charge($dte);
			//pigmi paid amount
			$trandaily['pigmypayamt']=$this->op->show_dailypigmypayamtbalance($dte);
			$trandaily['pigmypayamttot']=$this->op->show_dailypigmypayamttotbalance($dte);
			
			$trandaily['pigmypayamt_adjust']=$this->op->show_dailypigmypayamtbalance_adjust($dte);
			$trandaily['pigmypayamttot_adjust']=$this->op->show_dailypigmypayamttotbalance_adjust($dte);
			
			$trandaily['pigmypayamt_per']=$this->op->show_dailypigmypayamtbalance_per($dte);
			$trandaily['pigmypayamttot_per']=$this->op->show_dailypigmypayamttotbalance_per($dte);
			
			$trandaily['pigmypayamt_per_adjust']=$this->op->show_dailypigmypayamtbalance_per_adjust($dte);
			$trandaily['pigmypayamttot_per_adjust']=$this->op->show_dailypigmypayamttotbalance_per_adjust($dte);
			
			$trandaily['show_pigmicharg']=$this->op->show_pigmicharg($dte);
			$trandaily['pigmicharg_comm']=$this->op->show_pigmichargtot_comm($dte);
			
			$trandaily['pigmicharg_amt']=$this->op->show_pigmichargtot_amt($dte);
			
			$trandaily['show_pigmicharg_adjust']=$this->op->show_pigmicharg_adjust($dte);
			$trandaily['pigmicharg_comm_adjust']=$this->op->show_pigmichargtot_comm_adjust($dte);
			$trandaily['pigmicharg_amt_adjust']=$this->op->show_pigmichargtot_amt_adjust($dte);
			
			$trandaily['rdpayamt']=$this->op->show_dailyrdpayamtbalance($dte);
			$trandaily['rdpayamttot']=$this->op->show_dailyrdpayamttotbalance($dte);
			
			$trandaily['fdallocamt']=$this->op->show_dailyfdallocamtbalance($dte);
			$trandaily['kccallocamt']=$this->op->show_dailykccallocamtbalance($dte);
			$trandaily['fdallocamttot']=$this->op->show_dailyfdallocamttotbalance($dte);
			
			$trandaily['fdallocamt_adjust']=$this->op->show_dailyfdallocamtbalance_adjust($dte);
			$trandaily['kccallocamt_adjust']=$this->op->show_dailykccallocamtbalance_adjust($dte);
			$trandaily['fdallocamttot_adjust']=$this->op->show_dailyfdallocamttotbalance_adjust($dte);
			
			$trandaily['fdpayamt']=$this->op->show_dailyfdpayamtbalance($dte);
			$trandaily['fdpayamttot']=$this->op->show_dailyfdpayamttotbalance($dte);
			
			$trandaily['fdpayamt_adjust']=$this->op->show_dailyfdpayamtbalance_adjust($dte);
			$trandaily['fdpayamttot_adjust']=$this->op->show_dailyfdpayamttotbalance_adjust($dte);
			
			$trandaily['share']=$this->op->show_dailysharebalance($dte);
			$trandaily['sharetot']=$this->op->show_dailysharetotbalance($dte);
			
			$trandaily['membshare']=$this->op->show_dailymembsharebalance($dte);
			$trandaily['membsharetot']=$this->op->show_dailymembsharetotbalance($dte);
			
			$trandaily['classd']=$this->op->show_dailymembclassdbalance($dte);
			$trandaily['classdtot']=$this->op->show_dailymembclassdtotbalance($dte);
			
			$trandaily['opbal']=$this->op->show_dailyopeningbalance($dte);
			$trandaily['runningbal']=$this->op->show_dailyrunningbalance($dte);
			
			$trandaily['expence']=$this->op->show_dailyexpencetran($dte);
			$trandaily['expencebal']=$this->op->show_dailyexpencebalance($dte);
			$trandaily['staff_addition_ta']=$this->op->staff_addition_ta($dte);
			
			$trandaily['income']=$this->op->show_dailyincometran($dte);
			$trandaily['incomebal']=$this->op->show_dailyincomebalance($dte);
			$trandaily['pg_prewithdrawal_charges']=$this->op->pg_prewithdrawal_charges($dte);
			
			$trandaily['dlallocation']=$this->op->show_dlallocationtran($dte);
			$trandaily['dlallocationbal']=$this->op->show_dlallocationbalance($dte);
			
			$trandaily['dlallocation_adjust']=$this->op->show_dlallocationtran_adjust($dte);
			$trandaily['dlallocationbal_adjust']=$this->op->show_dlallocationbalance_adjust($dte);
			
			$trandaily['dlallocation_charg']=$this->op->show_dlallocationtran_charg($dte);
			$trandaily['dlallocationbal_charg']=$this->op->show_dlallocationbalance_charg($dte);
			
			$trandaily['dlallocation_charg_adjust']=$this->op->show_dlallocationtran_charg_adjust($dte);
			$trandaily['dlallocationbal_charg_adjust']=$this->op->show_dlallocationbalance_charg_adjust($dte);
			
			$trandaily['plallocation']=$this->op->show_plallocationtran($dte);
			$trandaily['plallocation_charg']=$this->op->show_plallocationtran_charg($dte);
			$trandaily['plallocation_chargcash']=$this->op->show_plallocationtran_chargcash($dte);
			$trandaily['plallocationbal']=$this->op->show_plallocationbalance($dte);
			
			$trandaily['plallocation_adjust']=$this->op->show_plallocationtran_adjust($dte);
			$trandaily['plallocationbal_adjust']=$this->op->show_plallocationbalance_adjust($dte);
			
			$trandaily['jlallocation']=$this->op->show_jlallocationtran($dte);
			$trandaily['jlallocationbal']=$this->op->show_jlallocationbalance($dte);
			$trandaily['jlallocation_adjust']=$this->op->show_jlallocationtran_adjust($dte);
			$trandaily['jlallocationbal_adjust']=$this->op->show_jlallocationbalance_adjust($dte);
			
			$trandaily['slallocation']=$this->op->show_slallocationtran($dte);
			$trandaily['slallocationbal']=$this->op->show_slallocationbalance($dte);
			
			$trandaily['dlrepay']=$this->op->show_dlrepay($dte);
			$trandaily['dlrepaytot']=$this->op->show_dlrepaytot($dte);
			
			$trandaily['dlrepay_adjust']=$this->op->show_dlrepay_adjust($dte);
			$trandaily['dlrepaytot_adjust']=$this->op->show_dlrepaytot_adjust($dte);
			
			
			$trandaily['plrepay']=$this->op->show_plrepay($dte);
			$trandaily['plrepaytot']=$this->op->show_plrepaytot($dte);
			$trandaily['plrepay_adjust']=$this->op->show_plrepay_adjust($dte);
			$trandaily['plrepaytot_adjust']=$this->op->show_plrepaytot_adjust($dte);
			
			$trandaily['jlrepay']=$this->op->show_jlrepay($dte);
			$trandaily['jlrepaytot']=$this->op->show_jlrepaytot($dte);
			
			$trandaily['slrepay']=$this->op->show_slrepay($dte);
			$trandaily['show_slrepay_interest'] = $this->op->show_slrepay_interest($dte);
			$trandaily['slrepaytot']=$this->op->show_slrepaytot($dte);
			
			
			$trandaily['branch_branch_tran']=$this->op->branch_branch_tran($dte);
			$trandaily['branch_branch_tot']=$this->op->branch_branch_tot($dte);
			$trandaily['b2b_adj_tran'] = $this->op->b2b_adj_tran($dte);
			
			$trandaily['branch_branch_tran_credit']=$this->op->branch_branch_tran_credit($dte);
			$trandaily['branch_branch_tot_credit']=$this->op->branch_branch_tot_credit($dte);
			$trandaily['sal_extra_from_ho']=$this->op->sal_extra_from_ho($dte);
			
			$trandaily['Bank_Branch']=$this->op->Bank_Branch($dte);
			$trandaily['Bank_Branch_tot']=$this->op->Bank_Branch_tot($dte);
/********* opposite entry for expense cheque income cheque ********/
			$trandaily['expense_cheque']=$this->op->opposite_entry_for_expense_cheque($dte);
			$trandaily['income_cheque']=$this->op->opposite_entry_for_income_cheque($dte);
/********* opposite entry for expense cheque ********/
			
			$trandaily['Bank_Branch_extra']=$this->op->Bank_Branch_extra($dte);
			
			$trandaily['agentcoll_tran']=$this->op->agentcoll_tran($dte);
			$trandaily['agentcoll_tot']=$this->op->agentcoll_tot($dte);
			
/**********salary******/
			$date_dmY = date("d-m-Y");
			$trandaily['emp_sal']=$this->op->emp_sal($date_dmY);
			$trandaily['agent_sal']=$this->op->agent_sal($dte);
			$trandaily['agent_sal_appraiser']=$this->op->agent_sal_appraiser($dte);
/**********salary******/
/**********fd mon int******/


			$trandaily['fd_monthly_int']=$this->op->fd_monthly_int($dte);

/**********fd mon int******/

/********** loan charges transaction ******/
			$trandaily['loan_charge']=$this->op->loan_charge($dte);
/********** loan charges transaction ******/

/********** salary extra ******/
			$trandaily['emp_sal_extra']=$this->op->emp_sal_extra($dte);
			$trandaily['agent_sal_extra']=$this->op->agent_sal_extra($dte);
/********** salary extra ******/

			$trandaily['mdpayamt']=$this->op->mdpayamt($dte);
			$trandaily['cd_tran']=$this->op->cd_tran($dte);
			$trandaily['sd_tran']=$this->op->sd_tran($dte);
			$trandaily['tds']=$this->op->tds($dte);
			$trandaily['pf']=$this->op->pf($dte);
			$trandaily['esi']=$this->op->esi($dte);
			$trandaily['professional_tax']=$this->op->professional_tax($dte);

			
			
			
			$trandaily['jewel_auction_account']=$this->op->jewel_auction_account($dte);
			
			$trandaily['jlcharges_adjust']=$this->op->jlcharges_adjust($dte);
			$trandaily['jlcharges']=$this->op->jlcharges($dte);
			$trandaily['jewel_charges']=$this->op->jewel_charges($dte);

			
			$trandaily['bank_tran_inhand']=$this->op->bank_tran_inhand($dte);
			$trandaily['bank_tran_adjust']=$this->op->bank_tran_adjust($dte);
			$trandaily['bank_amt_deposit']=$this->op->bank_amt_deposit($dte);
			$trandaily['bank_amt_WITHDRAWL']=$this->op->bank_amt_WITHDRAWL($dte);
			$trandaily['daily_rep_all_charges']=$this->op->daily_rep_all_charges($dte);
			
			$Url="openclose";
			$trandaily['module']=$this->Modules->GetAnyMid($Url);
			//print_r($trandaily);exit();
			return view('viewdailybal_1',compact('trandaily'));
		}
/*		function show_dailybalance()
		{
			$dte=date('Y-m-d');
			//SB
			$trandaily['sb']=$this->op->show_dailysbbalance($dte);
			$trandaily['sbcredit']=$this->op->show_dailysbcreditbalance($dte);
			$trandaily['sbdebit']=$this->op->show_dailysbdebitbalance($dte);
			
			$trandaily['sb_adjust']=$this->op->show_dailysbbalance_adjust($dte);
			$trandaily['sbcredit_adjust']=$this->op->show_dailysbcreditbalance_adjust($dte);
			$trandaily['sbdebit_adjust']=$this->op->show_dailysbdebitbalance_adjust($dte);
			//RD
			$trandaily['rd']=$this->op->show_dailyrdbalance($dte);
			$trandaily['rdcredit']=$this->op->show_dailyrdcreditbalance($dte);
			$trandaily['rddebit']=$this->op->show_dailyrddebitbalance($dte);
			
			$trandaily['rd_adjust']=$this->op->show_dailyrdbalance_adjust($dte);
			$trandaily['rdcredit_adjust']=$this->op->show_dailyrdcreditbalance_adjust($dte);
			$trandaily['rddebit_adjust']=$this->op->show_dailyrddebitbalance_adjust($dte);
			//pigmi
			$trandaily['pigmy']=$this->op->show_dailypigmybalance($dte);
			
			$trandaily['pigmycredit']=$this->op->show_dailypigmycreditbalance($dte);
			$trandaily['pigmydebit']=$this->op->show_dailypigmydebitbalance($dte);
			$trandaily['pigmycash']=$this->op->show_dailypigmybalance_cash($dte);
			$trandaily['pigmycashcredit']=$this->op->show_dailypigmybalance_cash_credit($dte);
			$trandaily['pigmycashdebit']=$this->op->show_dailypigmybalance_cash_debit($dte);
			//pigmi paid amount
			$trandaily['pigmypayamt']=$this->op->show_dailypigmypayamtbalance($dte);
			$trandaily['pigmypayamttot']=$this->op->show_dailypigmypayamttotbalance($dte);
			
			$trandaily['pigmypayamt_adjust']=$this->op->show_dailypigmypayamtbalance_adjust($dte);
			$trandaily['pigmypayamttot_adjust']=$this->op->show_dailypigmypayamttotbalance_adjust($dte);
			
			$trandaily['pigmypayamt_per']=$this->op->show_dailypigmypayamtbalance_per($dte);
			$trandaily['pigmypayamttot_per']=$this->op->show_dailypigmypayamttotbalance_per($dte);
			
			$trandaily['pigmypayamt_per_adjust']=$this->op->show_dailypigmypayamtbalance_per_adjust($dte);
			$trandaily['pigmypayamttot_per_adjust']=$this->op->show_dailypigmypayamttotbalance_per_adjust($dte);
			
			$trandaily['show_pigmicharg']=$this->op->show_pigmicharg($dte);
			$trandaily['pigmicharg_comm']=$this->op->show_pigmichargtot_comm($dte);
			
			$trandaily['pigmicharg_amt']=$this->op->show_pigmichargtot_amt($dte);
			
			$trandaily['show_pigmicharg_adjust']=$this->op->show_pigmicharg_adjust($dte);
			$trandaily['pigmicharg_comm_adjust']=$this->op->show_pigmichargtot_comm_adjust($dte);
			$trandaily['pigmicharg_amt_adjust']=$this->op->show_pigmichargtot_amt_adjust($dte);
			
			$trandaily['rdpayamt']=$this->op->show_dailyrdpayamtbalance($dte);
			$trandaily['rdpayamttot']=$this->op->show_dailyrdpayamttotbalance($dte);
			
			$trandaily['fdallocamt']=$this->op->show_dailyfdallocamtbalance($dte);
			$trandaily['fdallocamttot']=$this->op->show_dailyfdallocamttotbalance($dte);
			
			$trandaily['fdallocamt_adjust']=$this->op->show_dailyfdallocamtbalance_adjust($dte);
			$trandaily['fdallocamttot_adjust']=$this->op->show_dailyfdallocamttotbalance_adjust($dte);
			
			$trandaily['fdpayamt']=$this->op->show_dailyfdpayamtbalance($dte);
			$trandaily['fdpayamttot']=$this->op->show_dailyfdpayamttotbalance($dte);
			
			$trandaily['fdpayamt_adjust']=$this->op->show_dailyfdpayamtbalance_adjust($dte);
			$trandaily['fdpayamttot_adjust']=$this->op->show_dailyfdpayamttotbalance_adjust($dte);
			
			$trandaily['share']=$this->op->show_dailysharebalance($dte);
			$trandaily['sharetot']=$this->op->show_dailysharetotbalance($dte);
			
			$trandaily['membshare']=$this->op->show_dailymembsharebalance($dte);
			$trandaily['membsharetot']=$this->op->show_dailymembsharetotbalance($dte);
			
			$trandaily['classd']=$this->op->show_dailymembclassdbalance($dte);
			$trandaily['classdtot']=$this->op->show_dailymembclassdtotbalance($dte);
			
			$trandaily['opbal']=$this->op->show_dailyopeningbalance($dte);
			$trandaily['runningbal']=$this->op->show_dailyrunningbalance($dte);
			
			$trandaily['expence']=$this->op->show_dailyexpencetran($dte);
			$trandaily['expencebal']=$this->op->show_dailyexpencebalance($dte);
			
			$trandaily['income']=$this->op->show_dailyincometran($dte);
			$trandaily['incomebal']=$this->op->show_dailyincomebalance($dte);
			
			$trandaily['dlallocation']=$this->op->show_dlallocationtran($dte);
			$trandaily['dlallocationbal']=$this->op->show_dlallocationbalance($dte);
			
			$trandaily['dlallocation_adjust']=$this->op->show_dlallocationtran_adjust($dte);
			$trandaily['dlallocationbal_adjust']=$this->op->show_dlallocationbalance_adjust($dte);
			
			$trandaily['dlallocation_charg']=$this->op->show_dlallocationtran_charg($dte);
			$trandaily['dlallocationbal_charg']=$this->op->show_dlallocationbalance_charg($dte);
			
			$trandaily['dlallocation_charg_adjust']=$this->op->show_dlallocationtran_charg_adjust($dte);
			$trandaily['dlallocationbal_charg_adjust']=$this->op->show_dlallocationbalance_charg_adjust($dte);
			
			$trandaily['plallocation']=$this->op->show_plallocationtran($dte);
			$trandaily['plallocation_charg']=$this->op->show_plallocationtran_charg($dte);
			$trandaily['plallocation_chargcash']=$this->op->show_plallocationtran_chargcash($dte);
			$trandaily['plallocationbal']=$this->op->show_plallocationbalance($dte);
			
			$trandaily['plallocation_adjust']=$this->op->show_plallocationtran_adjust($dte);
			$trandaily['plallocationbal_adjust']=$this->op->show_plallocationbalance_adjust($dte);
			
			$trandaily['jlallocation']=$this->op->show_jlallocationtran($dte);
			$trandaily['jlallocationbal']=$this->op->show_jlallocationbalance($dte);
			$trandaily['jlallocation_adjust']=$this->op->show_jlallocationtran_adjust($dte);
			$trandaily['jlallocationbal_adjust']=$this->op->show_jlallocationbalance_adjust($dte);
			
			$trandaily['slallocation']=$this->op->show_slallocationtran($dte);
			$trandaily['slallocationbal']=$this->op->show_slallocationbalance($dte);
			
			$trandaily['dlrepay']=$this->op->show_dlrepay($dte);
			$trandaily['dlrepaytot']=$this->op->show_dlrepaytot($dte);
			
			$trandaily['dlrepay_adjust']=$this->op->show_dlrepay_adjust($dte);
			$trandaily['dlrepaytot_adjust']=$this->op->show_dlrepaytot_adjust($dte);
			
			
			$trandaily['plrepay']=$this->op->show_plrepay($dte);
			$trandaily['plrepaytot']=$this->op->show_plrepaytot($dte);
			$trandaily['plrepay_adjust']=$this->op->show_plrepay_adjust($dte);
			$trandaily['plrepaytot_adjust']=$this->op->show_plrepaytot_adjust($dte);
			
			$trandaily['jlrepay']=$this->op->show_jlrepay($dte);
			$trandaily['jlrepaytot']=$this->op->show_jlrepaytot($dte);
			
			$trandaily['slrepay']=$this->op->show_slrepay($dte);
			$trandaily['show_slrepay_interest'] = $this->op->show_slrepay_interest($dte);
			$trandaily['slrepaytot']=$this->op->show_slrepaytot($dte);
			
			
			$trandaily['branch_branch_tran']=$this->op->branch_branch_tran($dte);
			$trandaily['branch_branch_tot']=$this->op->branch_branch_tot($dte);
			
			$trandaily['branch_branch_tran_credit']=$this->op->branch_branch_tran_credit($dte);
			$trandaily['branch_branch_tot_credit']=$this->op->branch_branch_tot_credit($dte);
			
			$trandaily['Bank_Branch']=$this->op->Bank_Branch($dte);
			$trandaily['Bank_Branch_tot']=$this->op->Bank_Branch_tot($dte);
			
			$trandaily['Bank_Branch_extra']=$this->op->Bank_Branch_extra($dte);
			
			$trandaily['agentcoll_tran']=$this->op->agentcoll_tran($dte);
			$trandaily['agentcoll_tot']=$this->op->agentcoll_tot($dte);
			
/**********salary******
			$date_dmY = date("d-m-Y");
			$trandaily['emp_sal']=$this->op->emp_sal($date_dmY);
			$trandaily['agent_sal']=$this->op->agent_sal($dte);
/**********salary******
/**********fd mon int******


			$trandaily['fd_monthly_int']=$this->op->fd_monthly_int($dte);

/**********fd mon int******

/********** loan charges transaction ******
			$trandaily['loan_charge']=$this->op->loan_charge($dte);
/********** loan charges transaction ******
			
			$trandaily['jlcharges_adjust']=$this->op->jlcharges_adjust($dte);
			$trandaily['jlcharges']=$this->op->jlcharges($dte);
			
			$trandaily['bank_tran_inhand']=$this->op->bank_tran_inhand($dte);
			$trandaily['bank_tran_adjust']=$this->op->bank_tran_adjust($dte);
			$trandaily['bank_amt_deposit']=$this->op->bank_amt_deposit($dte);
			$trandaily['bank_amt_WITHDRAWL']=$this->op->bank_amt_WITHDRAWL($dte);
			
			$Url="openclose";
			$trandaily['module']=$this->Modules->GetAnyMid($Url);
			
			
			return view('viewdailybal',compact('arthik'));
			
		}*/
		public function dailytrandate_details(Request $request)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$dte=$request->input('finddate');
			$trandaily["date"] = $dte;
			$trandaily['bid'] = $BID;
			//SB
			$trandaily['sb']=$this->op->show_dailysbbalance($dte);
			$trandaily['sbcredit']=$this->op->show_dailysbcreditbalance($dte);
			$trandaily['sbdebit']=$this->op->show_dailysbdebitbalance($dte);
			
			$trandaily['sb_adjust']=$this->op->show_dailysbbalance_adjust($dte);
			$trandaily['sbcredit_adjust']=$this->op->show_dailysbcreditbalance_adjust($dte);
			$trandaily['sbdebit_adjust']=$this->op->show_dailysbdebitbalance_adjust($dte);
			$trandaily['sb_int_paid']=$this->op->sb_int_paid($dte);
			//RD
			$trandaily['rd']=$this->op->show_dailyrdbalance($dte);
			$trandaily['rdcredit']=$this->op->show_dailyrdcreditbalance($dte);
			$trandaily['rddebit']=$this->op->show_dailyrddebitbalance($dte);
			
			$trandaily['rd_adjust']=$this->op->show_dailyrdbalance_adjust($dte);
			$trandaily['rdcredit_adjust']=$this->op->show_dailyrdcreditbalance_adjust($dte);
			$trandaily['rddebit_adjust']=$this->op->show_dailyrddebitbalance_adjust($dte);
			//pigmi
			$trandaily['pigmy']=$this->op->show_dailypigmybalance($dte);
			
			$trandaily['pigmycredit']=$this->op->show_dailypigmycreditbalance($dte);
			$trandaily['pigmydebit']=$this->op->show_dailypigmydebitbalance($dte);
			$trandaily['pigmycash']=$this->op->show_dailypigmybalance_cash($dte);
			$trandaily['pigmycashcredit']=$this->op->show_dailypigmybalance_cash_credit($dte);
			$trandaily['pigmycashdebit']=$this->op->show_dailypigmybalance_cash_debit($dte);
			$trandaily['pigmy_service_charge']=$this->op->show_pigmy_service_charge($dte);
			//pigmi paid amount
			$trandaily['pigmypayamt']=$this->op->show_dailypigmypayamtbalance($dte);
			$trandaily['pigmypayamttot']=$this->op->show_dailypigmypayamttotbalance($dte);
			
			$trandaily['pigmypayamt_adjust']=$this->op->show_dailypigmypayamtbalance_adjust($dte);
			$trandaily['pigmypayamttot_adjust']=$this->op->show_dailypigmypayamttotbalance_adjust($dte);
			
			$trandaily['pigmypayamt_per']=$this->op->show_dailypigmypayamtbalance_per($dte);
			$trandaily['pigmypayamttot_per']=$this->op->show_dailypigmypayamttotbalance_per($dte);
			
			$trandaily['pigmypayamt_per_adjust']=$this->op->show_dailypigmypayamtbalance_per_adjust($dte);
			$trandaily['pigmypayamttot_per_adjust']=$this->op->show_dailypigmypayamttotbalance_per_adjust($dte);
			
			$trandaily['show_pigmicharg']=$this->op->show_pigmicharg($dte);
			$trandaily['pigmicharg_comm']=$this->op->show_pigmichargtot_comm($dte);
			
			$trandaily['pigmicharg_amt']=$this->op->show_pigmichargtot_amt($dte);
			
			$trandaily['show_pigmicharg_adjust']=$this->op->show_pigmicharg_adjust($dte);
			$trandaily['pigmicharg_comm_adjust']=$this->op->show_pigmichargtot_comm_adjust($dte);
			$trandaily['pigmicharg_amt_adjust']=$this->op->show_pigmichargtot_amt_adjust($dte);
			
			$trandaily['rdpayamt']=$this->op->show_dailyrdpayamtbalance($dte);
			$trandaily['rdpayamttot']=$this->op->show_dailyrdpayamttotbalance($dte);
			
			$trandaily['fdallocamt']=$this->op->show_dailyfdallocamtbalance($dte);
			$trandaily['kccallocamt']=$this->op->show_dailykccallocamtbalance($dte);
			$trandaily['fdallocamttot']=$this->op->show_dailyfdallocamttotbalance($dte);
			
			$trandaily['fdpayamt']=$this->op->show_dailyfdpayamtbalance($dte);
			$trandaily['fdpayamttot']=$this->op->show_dailyfdpayamttotbalance($dte);
			
			$trandaily['fdallocamt_adjust']=$this->op->show_dailyfdallocamtbalance_adjust($dte);
			$trandaily['kccallocamt_adjust']=$this->op->show_dailykccallocamtbalance_adjust($dte);
			$trandaily['fdallocamttot_adjust']=$this->op->show_dailyfdallocamttotbalance_adjust($dte);
			
			$trandaily['fdpayamt_adjust']=$this->op->show_dailyfdpayamtbalance_adjust($dte);
			$trandaily['fdpayamttot_adjust']=$this->op->show_dailyfdpayamttotbalance_adjust($dte);
			
			$trandaily['share']=$this->op->show_dailysharebalance($dte);
			$trandaily['sharetot']=$this->op->show_dailysharetotbalance($dte);
			
			$trandaily['membshare']=$this->op->show_dailymembsharebalance($dte);
			$trandaily['membsharetot']=$this->op->show_dailymembsharetotbalance($dte);
			
			$trandaily['classd']=$this->op->show_dailymembclassdbalance($dte);
			$trandaily['classdtot']=$this->op->show_dailymembclassdtotbalance($dte);
			
			$trandaily['opbal']=$this->op->show_dailyopeningbalance($dte);
			$trandaily['runningbal']=$this->op->show_dailyrunningbalance($dte);
			
			$trandaily['expence']=$this->op->show_dailyexpencetran($dte);
			$trandaily['expencebal']=$this->op->show_dailyexpencebalance($dte);
			$trandaily['staff_addition_ta']=$this->op->staff_addition_ta($dte);
			
			$trandaily['income']=$this->op->show_dailyincometran($dte);
			$trandaily['incomebal']=$this->op->show_dailyincomebalance($dte);
			$trandaily['pg_prewithdrawal_charges']=$this->op->pg_prewithdrawal_charges($dte);
			
			$trandaily['dlallocation']=$this->op->show_dlallocationtran($dte);
			$trandaily['dlallocationbal']=$this->op->show_dlallocationbalance($dte);
			
			$trandaily['dlallocation_adjust']=$this->op->show_dlallocationtran_adjust($dte);
			$trandaily['dlallocationbal_adjust']=$this->op->show_dlallocationbalance_adjust($dte);
			
			$trandaily['dlallocation_charg']=$this->op->show_dlallocationtran_charg($dte);
			$trandaily['dlallocationbal_charg']=$this->op->show_dlallocationbalance_charg($dte);
			
			$trandaily['dlallocation_charg_adjust']=$this->op->show_dlallocationtran_charg_adjust($dte);
			$trandaily['dlallocationbal_charg_adjust']=$this->op->show_dlallocationbalance_charg_adjust($dte);
			
			$trandaily['plallocation']=$this->op->show_plallocationtran($dte);
			$trandaily['plallocation_charg']=$this->op->show_plallocationtran_charg($dte);
			$trandaily['plallocation_chargcash']=$this->op->show_plallocationtran_chargcash($dte);
			$trandaily['plallocationbal']=$this->op->show_plallocationbalance($dte);
			
			$trandaily['plallocation_adjust']=$this->op->show_plallocationtran_adjust($dte);
			$trandaily['plallocationbal_adjust']=$this->op->show_plallocationbalance_adjust($dte);
			
			$trandaily['jlallocation']=$this->op->show_jlallocationtran($dte);
			$trandaily['jlallocationbal']=$this->op->show_jlallocationbalance($dte);
			$trandaily['jlallocation_adjust']=$this->op->show_jlallocationtran_adjust($dte);
			$trandaily['jlallocationbal_adjust']=$this->op->show_jlallocationbalance_adjust($dte);
			
			$trandaily['slallocation']=$this->op->show_slallocationtran($dte);
			$trandaily['slallocationbal']=$this->op->show_slallocationbalance($dte);
			
			$trandaily['dlrepay']=$this->op->show_dlrepay($dte);
			$trandaily['dlrepaytot']=$this->op->show_dlrepaytot($dte);
			
			$trandaily['dlrepay_adjust']=$this->op->show_dlrepay_adjust($dte);
			$trandaily['dlrepaytot_adjust']=$this->op->show_dlrepaytot_adjust($dte);
			
			
			$trandaily['plrepay']=$this->op->show_plrepay($dte);
			$trandaily['plrepaytot']=$this->op->show_plrepaytot($dte);
			$trandaily['plrepay_adjust']=$this->op->show_plrepay_adjust($dte);
			$trandaily['plrepaytot_adjust']=$this->op->show_plrepaytot_adjust($dte);
			
			$trandaily['jlrepay']=$this->op->show_jlrepay($dte);
			$trandaily['jlrepaytot']=$this->op->show_jlrepaytot($dte);
			
			$trandaily['slrepay']=$this->op->show_slrepay($dte);
			$trandaily['show_slrepay_interest']=$this->op->show_slrepay_interest($dte);
			$trandaily['slrepaytot']=$this->op->show_slrepaytot($dte);
			
			
			$trandaily['branch_branch_tran']=$this->op->branch_branch_tran($dte);
			$trandaily['branch_branch_tot']=$this->op->branch_branch_tot($dte);
			$trandaily['b2b_adj_tran'] = $this->op->b2b_adj_tran($dte);
			
			$trandaily['branch_branch_tran_credit']=$this->op->branch_branch_tran_credit($dte);
			$trandaily['branch_branch_tot_credit']=$this->op->branch_branch_tot_credit($dte);
			$trandaily['sal_extra_from_ho']=$this->op->sal_extra_from_ho($dte);
			
			$trandaily['Bank_Branch']=$this->op->Bank_Branch($dte);
			$trandaily['Bank_Branch_tot']=$this->op->Bank_Branch_tot($dte);
/********* opposite entry for expense cheque income cheque ********/
			$trandaily['expense_cheque']=$this->op->opposite_entry_for_expense_cheque($dte);
			$trandaily['income_cheque']=$this->op->opposite_entry_for_income_cheque($dte);
/********* opposite entry for expense cheque income cheque ********/
			
			$trandaily['Bank_Branch_extra']=$this->op->Bank_Branch_extra($dte);
			
			$trandaily['agentcoll_tran']=$this->op->agentcoll_tran($dte);
			$trandaily['agentcoll_tot']=$this->op->agentcoll_tot($dte);
			
			
/**********salary******/
			$date_dmY = date("d-m-Y", strtotime($dte));
			$trandaily['emp_sal']=$this->op->emp_sal($date_dmY);
			$trandaily['agent_sal']=$this->op->agent_sal($dte);
			$trandaily['agent_sal_appraiser']=$this->op->agent_sal_appraiser($dte);
/**********salary******/

/**********fd mon int******/
			$trandaily['fd_monthly_int']=$this->op->fd_monthly_int($dte);
/**********fd mon int******/

/********** loan charges transaction ******/
			$trandaily['loan_charge']=$this->op->loan_charge($dte);
/********** loan charges transaction ******/

/********** salary extra ******/
			$trandaily['emp_sal_extra']=$this->op->emp_sal_extra($dte);
			$trandaily['agent_sal_extra']=$this->op->agent_sal_extra($dte);
/********** salary extra ******/

			$trandaily['mdpayamt']=$this->op->mdpayamt($dte);
			$trandaily['cd_tran']=$this->op->cd_tran($dte);
			$trandaily['sd_tran']=$this->op->sd_tran($dte);
			$trandaily['tds']=$this->op->tds($dte);
			$trandaily['pf']=$this->op->pf($dte);
			$trandaily['esi']=$this->op->esi($dte);
			$trandaily['professional_tax']=$this->op->professional_tax($dte);
			
			$trandaily['jewel_auction_account']=$this->op->jewel_auction_account($dte);
			
			
			$trandaily['jlcharges_adjust']=$this->op->jlcharges_adjust($dte);
			$trandaily['jlcharges']=$this->op->jlcharges($dte);
			$trandaily['jewel_charges']=$this->op->jewel_charges($dte);
			
			$trandaily['bank_tran_inhand']=$this->op->bank_tran_inhand($dte);
			$trandaily['bank_tran_adjust']=$this->op->bank_tran_adjust($dte);
			$trandaily['bank_amt_deposit']=$this->op->bank_amt_deposit($dte);
			$trandaily['bank_amt_WITHDRAWL']=$this->op->bank_amt_WITHDRAWL($dte);
			$trandaily['daily_rep_all_charges']=$this->op->daily_rep_all_charges($dte);
			
			//$trandaily['branch_to_branch']=$this->op->show_branch_to_branch($dte);
			
			return view('viewdailybal_1',compact('trandaily'));
		}
		public function fdinterstmonthly()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$this->op->fdinterstmonthly();
			$data=DB::table('fd_monthly_interest')->where('id','=',"1")->where('Bid','=',$Branchid)->get();
			return view('fd_sb_data',compact('data'));
			
		}
		
		public function viewFDInterest(Request $request)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			$data=DB::table('fd_monthly_interest')->where('id','=',"1")->where('Bid','=',$Branchid)->get();
			return view('fd_sb_data',compact('data'));
		}
		
		public function create_fd_data()
		{
			
			$this->op->create_fd_data();
			
		}
		public function edit_fd_data(Request $request)
		{
			$data['Fd_id']=$request->input('fdid');
			$data['Fd_Amount']=$request->input('amount');
			return $fdEdit=$this->op->editFDdata($data);
		}
		public function SBINT()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			
			$data=DB::table('sb_int')
			->where('sb_int.Bid','=',$Branchid)
			->join('createaccount','createaccount.AccNum','=','sb_int.accno')
			->get();
			return view('Sb_int',compact('data'));
		}
		public function edit_Sb_data(Request $request)
		{
			
			$data['sdid']=$request->input('sdid');
			$data['amount']=$request->input('amount');
			return $SBEdit=$this->op->editSBdata($data);
		}
		public function create_SB_data()
		{
			$this->op->create_SB_data();
		}
		public function delete_Sb_data(Request $request)
		{
		$sdid=$request->input('sdid');
			DB::table('sb_int')->where('sb_int','=',$sdid)->delete();
		}
		
		public function view_cash_details(Request $request)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;
			if($Branchid == 6){
				$data = array();
				$data = $this->op->view_cash_details();
				return view("view_cash_details",compact('data'));
			} else {
				return "--";
			}
		}
		
		public function view_bank_details(Request $request)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$Branchid=$uname->Bid;

			$data = array();
			$data = $this->op->view_bank_details();
			return view("view_bank_details",compact('data'));
		}
		
		public function edit_cash_details(Request $request)
		{
			$in_data = array();
			$in_data["cash_id"] = $request->input("cash_id");
			$in_data["amount"] = $request->input("amount");
			return $this->op->edit_cash_details($in_data);
		}
		
		public function update_cash_details(Request $request)
		{
			$in_data = array();
			$in_data["amount"] = $request->input("amount");
			return $this->op->update_cash_details($in_data);
		}
		
		public function check_day_open(Request $request)
		{
			$in_data = array();
			$in_data["date"] = $request->input("date");
			return $this->op->check_day_open($in_data);
		}
		
		public function appraiser_commission_report_index(Request $request)// saraf commition report
		{
			return view("appraiser_commission_report_index");
		}
		
		public function appraiser_commission_report_data(Request $request)
		{
			$in_data["year"] = $request->input("year");
			$in_data["month"] = $request->input("month");
			$data = $this->op->saraf_commission_report_data($in_data);
			return view("saraf_commission_report_data",compact("data"));
		}

		public function is_day_open()
		{
			$ret_data = $this->op->is_day_open(date("Y-m-d"));// "yes" or "no"
			return $ret_data;
		}
		
		
	}

	
	