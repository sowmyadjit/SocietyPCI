<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\DLRepaymentModel;
	use App\Http\Model\ReportModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\CompanyModel;
	use App\Http\Model\LoanModel;
	use App\Http\Model\AccountModel;
	use App\Http\Model\OpenCloseModel;
	use Auth;
	
	class DLRepaymentController extends Controller
	{
		
		
		public function __construct()
		{
				$this->pigmtDLrepay = new DLRepaymentModel;
				$this->Report_model = new ReportModel;
				$this->Modules= new ModulesModel;
				$this->loan = new LoanModel;
				$this->acc = new AccountModel;
				$this->op=new OpenCloseModel;
		}
		
		public function pigmiDLPigmy()
		{
			$Url="pigmiDLPigmy";	
			//$chargeslist['module']=$this->Modules->GetAnyMid($Url);
			$chargeslist=$this->pigmtDLrepay->chargeslist();
			// return view('DLRepayment',compact('chargeslist'));
			$data["is_day_open"] = $this->op->is_day_open(date("Y-m-d"));
			return view('DLRepayment2',compact('chargeslist','data'));
		}
		
		public function pigmiDLPigmy_data()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$Url="pigmiDLPigmy";	
			//$chargeslist['module']=$this->Modules->GetAnyMid($Url);
			$chargeslist=$this->pigmtDLrepay->chargeslist();
			// return view('DLRepayment',compact('chargeslist'));
			$data["BID"] = $BID;
			$data["BNAME"] = DB::table("branch")->where("Bid", $BID)->value("BName");
			return view('DLRepayment_data',compact('chargeslist','data'));
		}

		public function Receipt(){
			return view('jewel_loan_repay_report_data_print',compact(''));
		}

		public function GetDLDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$pigmyDl['DLAlcID']=$request->input('DLAlcID');
			$get=$this->pigmtDLrepay->GetDLDetail($pigmyDl);
			$id['did']=$request->input('DLAlcID');
			$id['DLloanno']=$get->DepLoan_LoanNum;
			$id['reamt']=$get->DepLoan_RemailningAmt;
			$id['FN']=$get->FirstName;
			$id['MN']=$get->MiddleName;
			$id['LN']=$get->LastName;
			$id['StDte']=$get->DepLoan_lastpaiddate;
			$id['DepLoan_LoanAmount']=$get->DepLoan_LoanAmount;
			$id['partpayment_amount']=$get->partpayment_amount;
			$id['LoanType_Interest']=$get->LoanType_Interest;
			$id['loan_due_interest']=$get->loan_due_interest;
			$id['EMI_Amount']=$get->EMI_Amount;
			return $id;
		}
		
		public function GetFDDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$fdid=$request->input('fdid');
			$get=$this->pigmtDLrepay->GetFDDetail($fdid);
/************************/
			$data['Fd_CertificateNum'] = $get->Fd_CertificateNum;
			$data['Fd_Withdraw'] = $get->Fd_Withdraw;
			$adj_amt = $this->pigmtDLrepay->getFdAdjAmt($data);
			$id['adj_amt'] = $adj_amt;
/************************/
			$id['Fdid']=$get->Fdid;
			$id['Fd_CertificateNum']=$get->Fd_CertificateNum;
			$id['Fd_TotalAmt']=$get->Fd_TotalAmt;
			return $id;
		}
		
		public function CalcDayDiff(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$get['module']=$this->Modules->GetAnyMid($Url);
			$DayDiff['dlsdate']=$request->input('dlsdate');
			$DayDiff['pid']=$request->input('pid');
			$DayDiff['did']=$request->input('did');
			$get=$this->pigmtDLrepay->CalcDayDiff($DayDiff);
			
			return $get;
		}
		public function jlCalcDayDiff(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$get['module']=$this->Modules->GetAnyMid($Url);
			$DayDiff['strdate']=$request->input('strdate');
			$DayDiff['dlsdate']=$request->input('dlsdate');
			$get=$this->pigmtDLrepay->jlCalcDayDiff($DayDiff);
			
			return $get;
		}
		
		public function GetPygmyAccDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$PgAcc['PgAcNo']=$request->input('PgAcNo');
			$get=$this->pigmtDLrepay->GetPygmyAccDetail($PgAcc);
			$id['pgtotal']=$get->Total_Amount;
			$id['pgallocid']=$get->PigmiAllocID;
			$id['pgtypeid']=$get->PigmiTypeid;
			$id['pgagntid']=$get->Agentid;
			return $id;
		}
		
		public function GetSBAccDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$PgAccNo['PgAcNo']=$request->input('PgAcNo');
			$get=$this->pigmtDLrepay->GetSBAccDetail($PgAccNo);
			$id['acid']=$get->Accid;
			$id['acnum']=$get->AccNum;
			$id['actid']=$get->AccTid;
			$id['totamt']=$get->Total_Amount;
			return $id;
		}
		
		public function createPigmyDL(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$redirect['module']=$this->Modules->GetAnyMid($Url);
			
			$PgDL['BranchIDP']=$request->input('BranchIDP');
			$PgDL['BranchIDR']=$request->input('BranchIDR');
			$PgDL['BranchIDF']=$request->input('BranchIDF');
			$PgDL['dltype']=$request->input('dltype');
			$PgDL['charges']=$request->input('charges');
			$PgDL['amount']=$request->input('amount');
			$PgDL['loopid']=$request->input('loopid');
			
			//FOR PIGMY DL REPAY
			$PgDL['DLAlloc']=$request->input('DLAlloc');
			$PgDL['DLAccNum']=$request->input('DLAccNum');
			$PgDL['pgpayamt']=$request->input('pgpayamt');
			$PgDL['PgPayMode']=$request->input('PgPayMode');
			$PgDL['Pgremtotamt']=$request->input('Pgremtotamt');
			$PgDL['PgAvailhidn']=$request->input('PgAvailhidn');
			$PgDL['Pgallocid']=$request->input('Pgallocid');
			$PgDL['Pgtypeid']=$request->input('Pgtypeid');
			$PgDL['Pgagentid']=$request->input('Pgagentid');
			$PgDL['Pgacid']=$request->input('Pgacid');
			$PgDL['Pgactid']=$request->input('Pgactid');
			$PgDL['PgSBAvailhidn']=$request->input('PgSBAvailhidn');
			$PgDL['PgAvailhidn']=$request->input('PgAvailhidn');
			$PgDL['pgintamt']=$request->input('pgintamt');
			$PgDL['pgremamt']=$request->input('pgremamt');
			$PgDL['bank_pigmy']=$request->input('bank_pigmy');
			$PgDL['chequeno_pigmy']=$request->input('chequeno_pigmy');
			$PgDL['chequedate_pigmy']=$request->input('chequedate_pigmy');
			$PgDL['bankname_pigmy']=$request->input('bankname_pigmy');
			$PgDL['bankbranch_pigmy']=$request->input('bankbranch_pigmy');
			$PgDL['ifsccode_pigmy']=$request->input('ifsccode_pigmy');
			
			//FOR RD DL REPAY
			$PgDL['RDDLAlloc']=$request->input('RDDLAlloc');
			$PgDL['RDDLAccNum']=$request->input('RDDLAccNum');
			$PgDL['rdpayamt']=$request->input('rdpayamt');
			$PgDL['RdPayMode']=$request->input('RdPayMode');
			$PgDL['rdremtotamt']=$request->input('rdremtotamt');
			$PgDL['RdAvailhidn']=$request->input('RdAvailhidn');
			$PgDL['rdallocid']=$request->input('rdallocid');
			$PgDL['rdtypeid']=$request->input('rdtypeid');
			$PgDL['rdagentid']=$request->input('rdagentid');
			$PgDL['rdacid']=$request->input('rdacid');
			$PgDL['rdactid']=$request->input('rdactid');
			$PgDL['RdSBAvailhidn']=$request->input('RdSBAvailhidn');
			$PgDL['PgacidforRD']=$request->input('PgacidforRD');
			$PgDL['PgAvailhidnforRD']=$request->input('PgAvailhidnforRD');
			$PgDL['rdintamt']=$request->input('rdintamt');
			$PgDL['rdremamt']=$request->input('rdremamt');
			$PgDL['bank_rd']=$request->input('bank_rd');
			$PgDL['chequeno_rd']=$request->input('chequeno_rd');
			$PgDL['chequedate_rd']=$request->input('chequedate_rd');
			$PgDL['bankname_rd']=$request->input('bankname_rd');
			$PgDL['bankbranch_rd']=$request->input('bankbranch_rd');
			$PgDL['ifsccode_rd']=$request->input('ifsccode_rd');
			
			//FOR FD DL REPAY
			$PgDL['FDDLAlloc']=$request->input('FDDLAlloc');
			$PgDL['FDDLAccNum']=$request->input('FDDLAccNum');
			$PgDL['fdpayamt']=$request->input('fdpayamt');
			$PgDL['FdPayMode']=$request->input('FdPayMode');
			$PgDL['fdremtotamt']=$request->input('fdremtotamt');
			$PgDL['FdAvailhidn']=$request->input('FdAvailhidn');
			$PgDL['fdallocid']=$request->input('fdallocid');
			$PgDL['fdtypeid']=$request->input('fdtypeid');
			$PgDL['fdagentid']=$request->input('fdagentid');
			$PgDL['fdacid']=$request->input('fdacid');
			$PgDL['fdactid']=$request->input('fdactid');
			$PgDL['fdSBAvailhidn']=$request->input('fdSBAvailhidn');
			$PgDL['fdintamt']=$request->input('fdintamt');
			$PgDL['fdremamt']=$request->input('fdremamt');
			$PgDL['bank_fd']=$request->input('bank_fd');
			$PgDL['chequeno_fd']=$request->input('chequeno_fd');
			$PgDL['chequedate_fd']=$request->input('chequedate_fd');
			$PgDL['bankname_fd']=$request->input('bankname_fd');
			$PgDL['bankbranch_fd']=$request->input('bankbranch_fd');
			$PgDL['ifsccode_fd']=$request->input('ifsccode_fd');
			$PgDL['FD_pay_num']=$request->input('FD_pay_num');
			
			if(isset($PgDL['FD_pay_num'])) {
				$PgDL['FD_pay_num'] = $request->input('Fdid');
			}
			
			$PgDL['FDAccNumFDL']=$request->input('FDAccNumFDL');
			$PgDL['fdamt']=$request->input('fdamt');
			
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			$dl_type=$PgDL['dltype'];
			switch($dl_type) {
				case "pygmy DL":
						$allocation_id_key = "DLAlloc";
						break;
				case "RD DL":
						$allocation_id_key = "RDDLAlloc";
						break;
				case "FD DL":
						$allocation_id_key = "FDDLAlloc";
						break;
			}
			unset($fd);
			$fd["loan_type"] = "DL";
			$fd["allocation_id"] = $PgDL[$allocation_id_key];
			$fd["date"] = date('Y-m-d');
			$fd["total_amt_paid"] = $PgDL['fdpayamt'];
			if(empty($fd["allocation_id"])) {
				$fd["allocation_id"] = 0;
			}
			if(empty($fd["date"])) {
				$fd["date"] = date("Y-m-d");
			}
			if(empty($fd["total_amt_paid"])) {
				$fd["total_amt_paid"] = 0;
			}
			if($this->pigmtDLrepay->check_for_duplicate_loan_repay($fd)) {
				return "duplicate entry!";
			}
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			$id=$this->pigmtDLrepay->createPigmyDL($PgDL);
			// return redirect('/');
		}
		
		public function createDL_renew(Request $request)
		{
			
			
			$PgDL['DLAlloc']=$request->input('DLAlloc');
			$PgDL['Bid']=$request->input('Bid');
			$PgDL['DlAccNo']=$request->input('DlAccNo');
			$PgDL['remamt']=$request->input('remamt');
			$PgDL['intamt']=$request->input('intamt');
			$PgDL['charges']=$request->input('charges');
			$PgDL['amount']=$request->input('amount');
			
			$chargid=$request->input('charges');
			$chargamt=$request->input('amount');
			$PgDL['loopid']=$request->input('loopid');
			$PgDL['dl']=$request->input('dl');
			$PgDL['loannum']=$request->input('loannum');
			
			$chargsum=0;
			for($i=1;$i<$PgDL['loopid'];$i++)
			{
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
			}
			$totsum=$chargsum+$PgDL['remamt']+$PgDL['intamt'];
			$PgDL['tot']=$totsum;
			
			
			
			$PgDL['LoanCharge']=$this->loan->GetLoanChargesDropD();
			
			//$id=$this->pigmtDLrepay->createDL_renew($PgDL);
			return view('DL_Loan_Renewal',compact('PgDL'));
		}
		public function DLRepayGetSBDetails(Request $request)
		{
			/*********/
			$fn_data["acc_id"] =  $request->input('sbAcNo');
			$sb_balance = $this->acc->get_account_balance($fn_data);
			/*********/
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$AccNo['sbAcNo']=$request->input('sbAcNo');
			$get=$this->pigmtDLrepay->DLRepayGetSBDetails($AccNo);
			$id['acid']=$get->Accid;
			$id['acnum']=$get->AccNum;
			$id['actid']=$get->AccTid;
			$id['totamt'] = $sb_balance; //$get->Total_Amount;
			return $id;
		}
		
		public function DLRepayGetPgmDetails(Request $request)//M 15-6-16 FOR DLRepayment Paymode pigmy pigmy acc TA change
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$AccNo['pgAcNo']=$request->input('pgAcNo');
			$get=$this->pigmtDLrepay->DLRepayGetPgmDetails($AccNo);
			$id['acid']=$get->PigmiAllocID;
			$id['acnum']=$get->PigmiAcc_No;
			$id['actid']=$get->PigmiTypeid;
			$id['totamt']=$get->Total_Amount;
			$id['agentid']=$get->Agentid;
			return $id;
		}
		public function GetplDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$placc['plAlcID']=$request->input('plAlcID');
			$get=$this->pigmtDLrepay->GetplDetail($placc);
			
			$id['pid'] = $request->input('plAlcID');
			$id['reamt']=$get->RemainingLoan_Amt;
			$id['FN']=$get->FirstName;
			$id['MN']=$get->MiddleName;
			$id['LN']=$get->LastName;
			$id['StDte']=$get->caldate;
			$id['emi']=$get->EMI_Amount;
			$id['LoanAmt']=$get->LoanAmt;
			$id['partpayment_amount']=$get->partpayment_amount;
			$id['LoanType_Interest']=$get->LoanType_Interest;
			$id['loan_due_interest']=$get->loan_due_interest;
			$id['emi']=$get->EMI_Amount;
			$id['remaining_interest']=$get->RemainingInterest_Amt;
			$id['EMIremaining']=$get->EMIremaining;
			return $id;
		}
		public function GetjlDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$jlacc['jlAlcID']=$request->input('jlAlcID');
									  
			$jlacc1=$request->input('jlAlcID');
			$get=$this->pigmtDLrepay->GetjlDetail($jlacc);
			
	
			$auction_status=$get->auction_status;
			
			if($auction_status == 2) {
				$id['auc_status']=1;
				$auc_amt = DB::table('jewel_auction')->select('jewel_auction_amount')
								->where('JewelLoanId','=',$jlacc1)
								->first();
								$id['auc_amt']=$auc_amt->jewel_auction_amount;
			} else {
				$id['auc_status']=0;
			}
			$id['reamt']=$get->JewelLoan_LoanRemainingAmount;
			$id['FN']=$get->FirstName;
			$id['MN']=$get->MiddleName;
			$id['LN']=$get->LastName;
			$id['StDte']=$get->JewelLoan_StartDate;
			$id['datecal']=$get->JewelLoan_lastpaiddate;
			$id['EndDte']=$get->JewelLoan_EndDate;
			$id['partpayment_amount']=$get->partpayment_amount;
			$id['LoanAmt']=$get->JewelLoan_LoanAmount;
			$id['LoanType_Interest']=$get->LoanType_Interest;
			$id['loan_due_interest']=$get->loan_due_interest;
			$id['JewelLoan_remaininginterest']=$get->JewelLoan_remaininginterest;
			return $id;
		}
		
		public function GetslDetail(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$id['module']=$this->Modules->GetAnyMid($Url);
			$slacc['slAlcID']=$request->input('slAlcID');
			$get=$this->pigmtDLrepay->GetslDetail($slacc);
			
			$id['reamt']=$get->StaffLoan_LoanRemainingAmount;
			$id['FN']=$get->FirstName;
			$id['MN']=$get->MiddleName;
			$id['LN']=$get->LastName;
			$id['StDte']=$get->LastPaidDate;
			$id['EMI_Amount']=$get->EMI_Amount ;
			$id['partpayment_amount']=$get->partpayment_amount ;
			$id['LoanAmt']=$get->LoanAmt ;
			$id['loan_due_interest']=$get->loan_due_interest ;
			$id['emi']=$get->EMI_Amount ;
			return $id;
		}
		public function PersonalLoanRepay(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$redirect['module']=$this->Modules->GetAnyMid($Url);
			$plall['branch']=$request->input('branch');
			$plall['plAlloc']=$request->input('plAlloc');
			$plall['plloanno']=$request->input('plloanno');
			$plall['plpayamt']=$request->input('plpayamt');
			$plall['plPayMode']=$request->input('plPayMode');
			$plall['plremtotamt']=$request->input('plremtotamt');
			$plall['plAvailhidn']=$request->input('plAvailhidn');
			$plall['plallocid']=$request->input('plallocid');
			$plall['placid']=$request->input('placid');
			$plall['plactid']=$request->input('plactid');
			$plall['plSBAvailhidn']=$request->input('plSBAvailhidn');
			$plall['plpigmiid']=$request->input('plpigmiid');
			$plall['PgAvailhidnforPL']=$request->input('PgAvailhidnforPL');
			$plall['pgyagentid']=$request->input('pgyagentid');
			$plall['pgytypid']=$request->input('pgytypid');
			$plall['plremamt']=$request->input('plremamt');
			$plall['plintamt']=$request->input('plintamt');
			$plall['plemi']=$request->input('plemi');
			$plall['charges']=$request->input('charges');
			$plall['amount']=$request->input('amount');
			$plall['loopid']=$request->input('loopid');
			$plall['bank_pl']=$request->input('bank_pl');
			$plall['chequeno_pl']=$request->input('chequeno_pl');
			$plall['chequedate_pl']=$request->input('chequedate_pl');
			$plall['bankname_pl']=$request->input('bankname_pl');
			$plall['bankbranch_pl']=$request->input('bankbranch_pl');
			$plall['ifsccode_pl']=$request->input('ifsccode_pl');
			$plall['adid']=$request->input('adid');
			$plall['interest_upto_pl']=$request->input('interest_upto_pl');
			$plall['rec_date_pl']=$request->input('rec_date_pl');//receipt date
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			unset($fd);
			$fd["loan_type"] = "PL";
			$fd["allocation_id"] = $plall['plAlloc'];
			$fd["date"] = date('Y-m-d',strtotime($plall["rec_date_pl"]));
			$fd["total_amt_paid"] = $plall['plpayamt'];
			$fd['check_before_insert']=$request->input('check_before_insert');
			if(empty($fd["allocation_id"])) {
				$fd["allocation_id"] = 0;
			}
			if(empty($fd["date"])) {
				$fd["date"] = date("Y-m-d");
			}
			if(empty($fd["total_amt_paid"])) {
				$fd["total_amt_paid"] = 0;
			}
			if(!isset($fd["check_before_insert"])) {
				$fd["check_before_insert"] = 1;
			}
			if($fd["check_before_insert"] == 1) {
				$check_before_insert = true;
			} else {
				$check_before_insert = false;
			}
			if($check_before_insert && $this->pigmtDLrepay->check_for_duplicate_loan_repay($fd)) {
				// return "duplicate entry!";
				return -1;
			}
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			$id=$this->pigmtDLrepay->PersonalLoanRepay($plall);
			// return redirect('/');
		}
		public function JewelLoanRepay(Request $request)
		{
			$Url="pigmiDLPigmy";
			$redirect['module']=$this->Modules->GetAnyMid($Url);
			$jlall['branch']=$request->input('branch');
			$jlall['jlAlloc']=$request->input('jlAlloc');
			$jlall['jlloanno']=$request->input('jlloanno');
			$jlall['jlpayamt']=$request->input('jlpayamt');
			$jlall['jlPayMode']=$request->input('jlPayMode');
			$jlall['jlremtotamt']=$request->input('jlremtotamt');
			$jlall['jlAvailhidn']=$request->input('jlAvailhidn');
			$jlall['jlallocid']=$request->input('jlallocid');
			$jlall['jlacid']=$request->input('jlacid');
			$jlall['jlactid']=$request->input('jlactid');
			$jlall['jlSBAvailhidn']=$request->input('jlSBAvailhidn');
			$jlall['jlintamt']=$request->input('jlintamt');
			$jlall['jlloanremainigamt']=$request->input('jlloanremainigamt');
			$jlall['charges']=$request->input('charges');
			$jlall['amount']=$request->input('amount');
			$jlall['loopid']=$request->input('loopid');
			$jlall['jlremamt']=$request->input('jlremamt');
			$jlall['bank_jl']=$request->input('bank_jl');
			$jlall['chequeno_jl']=$request->input('chequeno_jl');
			$jlall['chequedate_jl']=$request->input('chequedate_jl');
			$jlall['bankname_jl']=$request->input('bankname_jl');
			$jlall['bankbranch_jl']=$request->input('bankbranch_jl');
			$jlall['ifsccode_jl']=$request->input('ifsccode_jl');
			$jlall['interest_upto']=$request->input('interest_upto');
			$jlall['rec_date_jl']=$request->input('rec_date_jl');
												  
			$jlall['auc_amt']=$request->input('auc_amt');
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			unset($fd);
			$fd["loan_type"] = "JL";
			$fd["allocation_id"] = $jlall['jlAlloc'];
			$fd["date"] = date('Y-m-d',strtotime($jlall["rec_date_jl"]));
			$fd["total_amt_paid"] = $jlall['jlpayamt'];
			if(empty($fd["allocation_id"])) {
				$fd["allocation_id"] = 0;
			}
			if(empty($fd["date"])) {
				$fd["date"] = date("Y-m-d");
			}
			if(empty($fd["total_amt_paid"])) {
				$fd["total_amt_paid"] = 0;
			}
			if($this->pigmtDLrepay->check_for_duplicate_loan_repay($fd)) {
				return "duplicate entry!";
			}
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			$id=$this->pigmtDLrepay->JewelLoanRepay($jlall);
	
			$auc_amt=$request->input('auc_amt');
			$pay_amt=$jlall['jlpayamt'];
			$jlAlloc = $jlall['jlAlloc'];
			//var_dump($auc_amt);
			if($auc_amt != '') {
				print_r($auc_amt);echo "**";
				$this->pigmtDLrepay->JewelAuctionRepay($auc_amt,$pay_amt,$jlAlloc);
			}
		//	return redirect('/');
		}
		
		public function StaffLoanRepay(Request $request)
		{
			$Url="pigmiDLPigmy";	
			$redirect['module']=$this->Modules->GetAnyMid($Url);
			$slall['branch']=$request->input('branch');
			$slall['slAlloc']=$request->input('slAlloc');
			$slall['slloanno']=$request->input('slloanno');
			$slall['slpayamt']=$request->input('slpayamt');
			$slall['slPayMode']=$request->input('slPayMode');
			$slall['slremtotamt']=$request->input('slremtotamt');
			$slall['slAvailhidn']=$request->input('slAvailhidn');
			$slall['slallocid']=$request->input('slallocid');
			$slall['slacid']=$request->input('slacid');
			$slall['slactid']=$request->input('slactid');
			$slall['slSBAvailhidn']=$request->input('slSBAvailhidn');
			
			$slall['charges']=$request->input('charges');
			$slall['amount']=$request->input('amount');
			$slall['xsl']=$request->input('xsl');
			$slall['slintamt']=$request->input('slintamt');
			
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			unset($fd);
			$fd["loan_type"] = "SL";
			$fd["allocation_id"] = $slall['slAlloc'];
			$fd["date"] = date('Y-m-d');
			$fd["total_amt_paid"] = $slall['slpayamt'];
			if(empty($fd["allocation_id"])) {
				$fd["allocation_id"] = 0;
			}
			if(empty($fd["date"])) {
				$fd["date"] = date("Y-m-d");
			}
			if(empty($fd["total_amt_paid"])) {
				$fd["total_amt_paid"] = 0;
			}
			if($this->pigmtDLrepay->check_for_duplicate_loan_repay($fd)) {
				return "duplicate entry!";
			}
			/******************** CHECK FOR DUPLICATE ENTRY ********************/
			$id=$this->pigmtDLrepay->StaffLoanRepay($slall);
			// return redirect('/');
		}
		public function loanrepayReceipt($id)
		{
			$Url="pigmiDLPigmy";	
			$plReceiptData['module']=$this->Modules->GetAnyMid($Url);
			$plReceiptData['data']=$this->pigmtDLrepay->GetplCertificate($id);
			return view('plReceipt',compact('plReceiptData'));
			
		}
		
		public function DLloanrepayReceipt($id)
		{
			
			$Url="pigmiDLPigmy";	
			$dlReceiptData['module']=$this->Modules->GetAnyMid($Url);
			$dlReceiptData['data']=$this->pigmtDLrepay->GetdlCertificate($id);
			return view('dlReceipt',compact('dlReceiptData'));
			
		}
		public function jlloanrepayReceipt($id)
		{
			$Url="pigmiDLPigmy";	
			$jlReceiptData['module']=$this->Modules->GetAnyMid($Url);
			$jlReceiptData['data']=$this->pigmtDLrepay->GetjlCertificate($id);
			return view('jlReceipt',compact('jlReceiptData'));
			
		}
		public function LoanReportAll()
		{
			
			$Url="pigmiDLPigmy";	
			$loan['module']=$this->Modules->GetAnyMid($Url);
			$loan['LT']=$this->Report_model->GetLoanDropD();
			$loan['PLT']=$this->Report_model->GetPLoanDropD();
			return view('LoanrepayAllHome',compact('loan'));
		}
		public function GetLoanAll(Request $request)
		{
			$Url="pigmiDLPigmy";	
			
			$loanParam['LoanDD']=$request->input('LoanDD');
			$loanParam['PLoanDD']=$request->input('PLoanDD');
			$loanParam['startdate']=$request->input('startdate');
			$loanParam['enddate']=$request->input('enddate');
			$loanParam['loanid']=$request->input('loanid');
			if($loanParam['LoanDD']=="PERSONAL_LOAN")
			{
				
				$loanpersonal['module']=$this->Modules->GetAnyMid($Url);
				$loanpersonal['datapersonal']=$this->pigmtDLrepay->GetLoanrepay($loanParam);
				return view('PersonalLoanrepayReport',compact('loanpersonal'));
			}
			else if($loanParam['LoanDD']=="DEPOSITE_LOAN")
			{
					
				$loandeposit['module']=$this->Modules->GetAnyMid($Url);
				$loandeposit['datadeposit']=$this->pigmtDLrepay->GetLoanrepay($loanParam);
				return view('DepositLoanRepayReport',compact('loandeposit'));
			}
			else if($loanParam['LoanDD']=="STAFF_LOAN")
			{
					
				$loanstaff['module']=$this->Modules->GetAnyMid($Url);
				$loanstaff['datastaff']=$this->pigmtDLrepay->GetLoanrepay($loanParam);
				return view('StaffLoanReport',compact('loanstaff'));
			}
			else if($loanParam['LoanDD']=="JEWEL_LOAN")
			{
				
				$loanjewel['module']=$this->Modules->GetAnyMid($Url);
				$loanjewel['datajewel']=$this->pigmtDLrepay->GetLoanrepay($loanParam);
				return view('JewelLoanrepayReport',compact('loanjewel'));
			}
		}
		
		public function DL_Renew_Allocation(Request $request)
		{
		        
			$dl['loannum']=$request->input('loannum');
			$dl['AccNo']=$request->input('AccNo');
			$dl['old_principalamt']=$request->input('old_principalamt');
			$dl['old_interst_amt']=$request->input('old_interst_amt');
			$dl['bid']=$request->input('bid');
			$dl['DepLoanAmt']=$request->input('DepLoanAmt');
			$dl['dl']=$request->input('dl');
			$dl['LoanCharge']=$request->input('LoanCharge');
			$dl['PayableAmount']=$request->input('PayableAmount');
			$dl['loopid']=$request->input('loopid');
			$dl['amount']=$request->input('amount');
			$dl['charges']=$request->input('charges');
			$dl['DepLoanPayMode']=$request->input('DepLoanPayMode');
			$dl['Bnkid']=$request->input('Bnkid');
			$dl['accid']=$request->input('accid');
			$dl['DepSBAvail']=$request->input('DepSBAvail');
			
			$dl['datajewel']=$this->pigmtDLrepay->DL_Renew_Allocation($dl);
		}
		public function JewelLoanRepay_renewal(Request $request)
		{
			
			
			
			$jlall['jlAlloc']=$request->input('jlAlloc');
			$jlall['jlloanno']=$request->input('jlloanno');
			$jlall['jlintamt']=$request->input('jlintamt');
			$jlall['jlremamt']=$request->input('jlremamt');
			$jlall['charges']=$request->input('charges');
			$jlall['amount']=$request->input('amount');
			
			$chargid=$request->input('charges');
			$chargamt=$request->input('amount');
			$jlall['loopid']=$request->input('loopid');
			$chargsum=0;
			$z=0;
			for($i=1;$i<$jlall['loopid'];$i++)
			{
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
			}
			$totsum=$chargsum+$jlall['jlremamt']+$jlall['jlintamt'];
			$jlall['tot']=$totsum;
		
			
		
			return view('jl_renewal',compact('jlall'));
		}
		public function PersonalLoanRepay_renewal(Request $request)
		{
		
		
			$plall['plAlloc']=$request->input('plAlloc');
			$plall['branch']=$request->input('branch');
			$plall['plloanno']=$request->input('plloanno');
			$plall['charges']=$request->input('charges');
			$plall['amount']=$request->input('amount');
			
			$chargid=$request->input('charges');
			$chargamt=$request->input('amount');
			$plall['loopid']=$request->input('loopid');
			$plall['plintamt']=$request->input('plintamt');
			$plall['plremamt']=$request->input('plremamt');
			$chargsum=0;
			$z=0;
			for($i=1;$i<$plall['loopid'];$i++)
			{
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
			}
			$totsum=$chargsum+$plall['plremamt']+$plall['plintamt'];
			$plall['tot']=$totsum;
		
			
		
			return view('pl_renewal',compact('plall'));
			
			
			
		}
		public function Getadjustmentdetails(Request $request)
		{
			$adid=$request->input('adid');
			$amount1=DB::table('branch_to_branch')->select('Branch_Amount')->where('Branch_Id',$adid)->first();
			$amt['amount']=$amount1->Branch_Amount;
			
			return $amt;
		}
		
		public function dateComp(Request $request)
		{
			$data['first'] = $request->input('first');
			$data['second'] = $request->input('second');
			return $this->pigmtDLrepay->dateComp($data);
		}
		
		public function dateDiff(Request $request)
		{
			$data['first'] = $request->input('first');
			$data['second'] = $request->input('second');
			return $this->pigmtDLrepay->dateDiff($data);
		}
		
		public function is_jl_first_repay_done(Request $request)
		{
			$data['jlaccid'] = $request->input('jlaccid');
			return $this->pigmtDLrepay->is_jl_first_repay_done($data);
		}
	}

	