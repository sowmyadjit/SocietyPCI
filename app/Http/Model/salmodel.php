<?php
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\RoundModel;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\SDModel;
	use App\Http\Model\SDTranModel;

	class salmodel extends Model
	{
		protected $table='salary';
		public $roundamt;
		public function __construct()
		{
			$this->roundamt=new RoundModel;
			$this->rv_no = new ReceiptVoucherController;
			$this->sd = new SDModel;
			$this->sd_tran = new SDTranModel;
			$this->cdsd = new CDSDModel;
			$this->cdsd_tran = new CDSDTranModel;
		}
		public function insert($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			
			$dte=date('Y-m-d');
			$dte1=date('d-m-Y');
			$mnt=date('m');
			$year=date('Y');
			//$bid=DB::table('bank')->insertGetId(['bankname'=>$id['bname'],'Eid'=>$id['eid']]);
			//$eid = DB::table('employee')->insertGetId(['ECode'=>$id['ecode'],'basicpay'=>$id['bpay'],'hra'=>$id['hra'],'pf'=>$id['pf'],'incometax'=>$id['it']]); 
			$usrid=$id['uid'];
			$pf=$id['totpf'];
			$esi=$id['totesi'];
			$empinfo1=DB::table('employee')->select('emp_PfAccon','emp_EsiAccon','accid')
			->where('Uid',$usrid)
			->first();
			$RepayDte=date("Y-m-d");
			$emppf=$empinfo1->emp_PfAccon;
			$empesi=$empinfo1->emp_EsiAccon;
			$accid=$empinfo1->accid;
			$totpf=$emppf+$pf;
			$totesi=$empesi+$esi;
			$netpay=$id['npay'];
			$noloan=$id['noloan'];
			DB::table('employee')->where('Uid',$usrid)->update(['emp_PfAccon'=>$totpf,'emp_EsiAccon'=>$totesi]);
			
			
			
			if($noloan=="NO")
			{
					

				$staffloan_allocation= DB::table('staffloan_allocation')
					->join("user","user.Uid","=","staffloan_allocation.Uid")
					->where('StfLoanAllocID','=',$id['loannum'])
					->first();

				$bid_of_loan_account = $staffloan_allocation->Bid;
				$staff_loan_no = $staffloan_allocation->StfLoan_Number;
				$staff_loan_name = "{$staffloan_allocation->FirstName} {$staffloan_allocation->MiddleName} {$staffloan_allocation->LastName}";
				$login_bid = $BID;

				$remaingamt=$id['slremamt']; 
				$EMI_Amount=$id['EMI_Amount']; 
				$slintamt=$id['slintamt']; 
				
				$n=$id['loopid'];
				$chargid=$id['charges'];
				$chargamt=$id['amount'];
				$loannum=$id['loannum'];
				$chargsum=0;
				$z=0;
				for($i=1;$i<$n;$i++)
				{
					$charges=explode(",",$chargid);
					$chaamount=explode(",",$chargamt);
					$x=$charges[$z];
					$y=$chaamount[$z];
					
					$head_sub=DB::table('chareges')->select('head','subhead')
					->where('charges_id',$x)
					->first();
					$head=$head_sub->head;
					$subhead=$head_sub->subhead;
					
					if($login_bid == $bid_of_loan_account) {	//SAME BRANCH - ADD REPAYMENT
						$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$loannum,'bid'=>$id['bid'],'charg_tran_date'=>$RepayDte,'loantype'=>"sL",'LedgerHeadId'=>$head,'SubLedgerId'=>$subhead]);
					}
					$z++;
					$chargsum=Floatval($y)+Floatval($chargsum);
					
					//	print_r($chargsum);
				}
				



				$a=$EMI_Amount;//+$slintamt+$chargsum;
				$totamt=$remaingamt-$a;


				/************************* ************************/
				$principle = $id['EMI_Amount'];
				$interest = $id['slintamt'];
				$total_charges = $chargsum;
				$total_paid = $principle + $interest + $total_charges;

				if($login_bid == $bid_of_loan_account) {	//SAME BRANCH - ADD REPAYMENT
					DB::table('staffloan_allocation')->where('StfLoanAllocID','=',$id['loannum'])->update(['StaffLoan_LoanRemainingAmount'=>$totamt,'LastPaidDate'=>$dte]);
					
					DB::table('staffloan_repay')->insertGetId(['SLRepay_Date'=>$dte,'SLRepay_SLAllocID'=>$id['loannum'],'SLRepay_PaidAmt'=>$total_paid,'SLRepay_PayMode'=>"SALARY",'SLRepay_Created_By'=>$id['uid'],'SLRepay_Bid'=>$id['bid'],'SLRepay_Interest'=>$id['slintamt'],'paid_principle'=>$EMI_Amount]);
				} else {	//DIFFERENT BRANCH - TRANSFER AAMOUNT TO H.O.
				
					//	HO to branch entry
					$insert_array["Branch_Branch1_Id"] = 6;
					$insert_array["Branch_Branch2_Id"] = $login_bid;
					$insert_array["Branch_Tran_Date"] = $dte;
					$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
					$insert_array["LedgerHeadId"] = 57;
					$insert_array["SubLedgerId"] = 61;
					$insert_array["Branch_Amount"] = $total_paid;
					$insert_array["Branch_per"] = "STAFF LOAN REPAYMENT AMOUNT ({$staff_loan_no} - $staff_loan_name)";

					$branch_to_branch_id = DB::table("branch_to_branch")
						->insertGetId($insert_array);

					//GENERATE ADJ NO. FOR HO
						/***********/
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $branch_to_branch_id;
						$fn_data["rv_transaction_type"] = "DEBIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $dte;
						$fn_data["rv_bid"] = 6;
						$adj_no = $this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						unset($insert_array);
						echo " adj no: {$adj_no}";
						/***********/
					//NO ADJ NO. FOR H.O. (ADJ CREDIT)
				}
				/************************* ************************/
			}
			$iid = DB::table('salary')->insertGetId(['chequeno' => $id['cqno'],'date'=>$dte1,'rep_date'=>$dte,'Did'=>$id['desigid']/*,'sallowance'=>$id['sa']*/,'Eid'=>$id['eid'],'bid'=>$BID,'Uid'=>$id['uid'],'year'=>$id['year'],'gearning'=>$id['ge'],'pftax'=>$id['pt'],'gdeduction'=>$id['gd'],'netpay'=>$id['npay'],'LedgerHeadId'=>'131','SubLedgerId'=>'132' /*,'staffPF'=>$id['staffpf'],'societyPF'=>$id['socpf'],'staffESI'=>$id['esi'],'societyESI'=>$id['socesi']*/]);
			
/*************edit**************/
			$sal_extra_data['sal_extra_all'] = $id['sal_extra_all'];
			$sal_extra_data['sal_id'] = $iid;
			$sal_extra_data['emp_type'] = 1;//STAFF
			$this->insertSalExtraPay($sal_extra_data);
/*************edit end**************/

			$accbal1=DB::table('createaccount')->select('Total_Amount')->where('Accid',$accid)->first();
			$accbal=$accbal1->Total_Amount;
			$totbal=$accbal+$netpay;

			
			/****************** */
			$sb_acc_info = DB::table("createaccount")
			->where("Accid", $accid)
			->first();
			if(!empty($sb_acc_info)) {
				$temp_bid = $sb_acc_info->Bid;
			} else {
				$temp_bid = 0;
			}
			/****************** */
			
			$res = DB::table('sb_transaction')->insertGetId(['Accid'=> $accid,'AccTid' =>"1",'TransactionType' =>"CREDIT",'particulars' =>"SALARY AMOUNT",'Amount' => $netpay,'CurrentBalance' => $accbal,'Total_Bal' => $totbal,'tran_Date' =>$dte,'SBReport_TranDate'=>  $dte,'Month'=>$mnt,'Year'=>$year,'Payment_Mode'=>"SALARY",'Bid'=>$temp_bid/*$id['bid']*/,'CreatedBy'=>$UID]);
			DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$totbal]);

			/************ HO SALARY - TRANSFER SB AMOUNT TO BRANCH(KULAI) **********/
			if($BID == 6) {// ONLY FOR HO SALARY
				
				if(!empty($sb_acc_info)) {
					switch($sb_acc_info->Bid) {
						case 1:
								$temp_subhead_id = 297;
								break;
						case 2:
								$temp_subhead_id = 298;
								break;
						case 3:
								$temp_subhead_id = 299;
								break;
						case 4:
								$temp_subhead_id = 300;
								break;
						case 5:
								$temp_subhead_id = 301;
								break;
						default:
								$temp_subhead_id = 0;
					}

					$insert_array["Branch_Branch1_Id"] = $sb_acc_info->Bid;
					$insert_array["Branch_Branch2_Id"] = 6;
					$insert_array["Branch_Tran_Date"] = date("Y-m-d");
					$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
					$insert_array["LedgerHeadId"] = 296;
					$insert_array["SubLedgerId"] = $temp_subhead_id;
					$insert_array["Branch_Amount"] = $netpay;
					$insert_array["Branch_per"] = "SALARY AMOUNT FROM HO";
	
					$branch_to_branch_id = DB::table("branch_to_branch")
						->insertGetId($insert_array);
					/****** GENERATE ADJ NO. - HO CREDIT *****/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $branch_to_branch_id;
					$fn_data["rv_transaction_type"] = "CREDIT";//DEBIT
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = date("Y-m-d");
					$fn_data["rv_bid"] = 6;
					$adj_no = $this->rv_no->save_rv_no($fn_data);
					/***********/
					/****** GENERATE ADJ NO. *****/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $branch_to_branch_id;
					$fn_data["rv_transaction_type"] = "DEBIT";//CREDIT
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = date("Y-m-d");
					$fn_data["rv_bid"] = $sb_acc_info->Bid;
					$adj_no = $this->rv_no->save_rv_no($fn_data);
					/***********/
				}
			}
			/********************* */

			return $iid;
		}
		
		
		public function getData(){
			$id = DB::table('salary')->select('salid','FirstName','basicpay','date','netpay','salary.Eid','salary.Uid')
			->leftJoin('employee','employee.Eid','=','salary.Eid')
			->leftJoin('user','user.Uid','=','salary.Uid')
			->orderBy("salid","desc")
			->get();
			return $id;
		}
		
		public function GetSalary($id){
			return DB::table('employee')
			->join('designation','designation.Did','=','employee.Did')
			->join('user','user.Uid','=','employee.Uid')
			->where('employee.Did','<>',"4")
			->select(DB::raw('employee.Uid as id,CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->get();
		}
		
		public function get_saldet($emp1)
		{
			return DB::table('employee')
			->join('user','user.Uid','=','employee.Uid')
			->join('designation','designation.Did','=','employee.Did')
			->select('basicpay','incometax','hra','pf','FirstName','ECode','DName','employee.Did','Eid','user.Uid','employee.Bid','LoanDetails','esi','spf','sesi')
			->where('employee.Uid',$emp1)
			->first();
			
		}
		
		public function getloandetaiforsalary($id)
		{
			return DB::table('staffloan_allocation')
			->select('StfLoan_Number','StaffLoan_LoanRemainingAmount','EMI_Amount')
			->where('Uid','=',$id)
			->first();
			
		}
		public function getagentsalary($id)
		{	
			$dte=Date('Y-m-d');
			$agentid=$id['Auid'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$cp=$id['cp'];
			$tds=$id['tds'];
			
			$tot=DB::table('pigmi_transaction')
			->where('Agentid','=',$agentid)
			->where('pigmi_transaction.tran_reversed','=',"NO")
			->where('pigmi_transaction.PgmPayment_Mode','<>',"INTEREST AMOUNT")
			->where('Transaction_Type','=',"CREDIT")
			->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->sum('Amount');
			
			/*	$totdebit=DB::table('pigmi_transaction')
				->where('Agentid','=',$agentid)
				->whereRaw("DATE(pigmi_transaction.PigReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
				->where('tran_reversed','=',"YES")
				->where('Transaction_Type','=',"DEBIT")
				->sum('Amount');
				
			$bvc['totamt']=$tot-$totdebit;*/
			$bvc['totamt']=$tot;
			$agentinterest=(($bvc['totamt']*$cp)/100);
			$agentinterest=$this->roundamt->Roundall($agentinterest);
			/*	$bvc['interest']=(($bvc['totamt']*$cp)/100);*/
			$tdsamt=(($agentinterest*$tds)/100);
			$tdsamt=$this->roundamt->Roundall($tdsamt);
			$bvc['tds']=$tdsamt;
			$securitydepoamt=(($agentinterest*10)/100);
			$securitydepoamt=$this->roundamt->Roundall($securitydepoamt);
			$bvc['secutitydeposit']=$securitydepoamt;
			
			$totaldecution=$bvc['tds']+$bvc['secutitydeposit'];
			$bvc['interest']=$agentinterest-$totaldecution;
			return $bvc;
		}
		
		public function getagentsalary_1($id)
		{	
			
			$tot=$id['amount'];
			$cp=$id['cp'];
			$tds=$id['tds'];
			$SecurityDepositNeeded=$id['SecurityDepositNeeded'];
			
			if($SecurityDepositNeeded == "YES") {
				$securityDepositRate = 0.10;
			} else {
				$securityDepositRate = 0;
			}
			
			$bvc['totamt']=$tot;
			$agentinterest=(($bvc['totamt']*$cp)/100);
			$agentinterest=$this->roundamt->Roundall($agentinterest);
			
			$tdsamt=(($agentinterest*$tds)/100);
			$tdsamt=$this->roundamt->Roundall($tdsamt);
			$bvc['tds']=$tdsamt;
			$securitydepoamt = ($agentinterest * $securityDepositRate);
/*			$securitydepoamt=(($agentinterest*10)/100);*/
			$securitydepoamt=$this->roundamt->Roundall($securitydepoamt);
			$bvc['secutitydeposit']=$securitydepoamt;
			
			$totaldecution=$bvc['tds']+$bvc['secutitydeposit'];
			$bvc['interest']=$agentinterest-$totaldecution;
			return $bvc;
		}
		
		public function getrdagentsalary($id)
		{	
			$dte=Date('Y-m-d');
			$agentid=$id['Auid'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$cp=$id['cp'];
			$tds=$id['tds'];
			
			$tot=DB::table('rd_transaction')
			->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
			->where('createaccount.Agent_ID','=',$agentid)
			->where('tran_reversed','=',"NO")
			->where('RD_Particulars','!=',"RD INTEREST CAL")
			->whereRaw("DATE(rd_transaction.RDReport_TranDate) BETWEEN '".$start."' AND '".$end."'")
			->sum('RD_Amount');
			
			$bvc['totamt']=$tot;
			$agentinterest=(($bvc['totamt']*$cp)/100);
			$agentinterest=$this->roundamt->Roundall($agentinterest);
			/*	$bvc['interest']=(($bvc['totamt']*$cp)/100);*/
			$tdsamt=(($agentinterest*$tds)/100);
			$tdsamt=$this->roundamt->Roundall($tdsamt);
			$bvc['tds']=$tdsamt;
			$securitydepoamt=(($agentinterest*10)/100);
			$securitydepoamt=$this->roundamt->Roundall($securitydepoamt);
			$bvc['secutitydeposit']=$securitydepoamt;
			
			$totaldecution=$bvc['tds']+$bvc['secutitydeposit'];
			$bvc['interest']=$agentinterest-$totaldecution;
			return $bvc;
		}
		
		public function getsaraparasalary($id)
		{	
			$dte=Date('Y-m-d');
			$agentid=$id['Auid'];
			$start=$id['startdate'];
			$end=$id['enddate'];
			$cp=$id['cp'];
			$tds=$id['tds'];
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			$tot=DB::table('jewelloan_allocation')
			
			->whereRaw("DATE(JewelLoan_StartDate) BETWEEN '".$start."' AND '".$end."'")
			->where('JewelLoan_Bid',$BID)
			->sum('JewelLoan_SaraparaCharge');
			
			if($tot>2000)
			{
				
				$bvc['totamt']=$tot;
				$a=$tot-2000;
				$b=$a/2;
				$b=$this->roundamt->Roundall($b);
				//$agentinterest1=((1000000*$cp)/100);
				//$rem_amt=$tot-1000000;
				//$agentinterest2=(($rem_amt*.01)/100);
				//$agentinterest=$agentinterest1+$agentinterest2;
				$agentinterest=$b+2000;
				$bvc['otherincome']=$b;
			}
			else
			{
			$bvc['totamt']=$tot;
			//$agentinterest=(($bvc['totamt']*$cp)/100);
			$agentinterest=$tot;
			$agentinterest=$this->roundamt->Roundall($agentinterest);
			$bvc['otherincome']=0;
			}
			/*	$bvc['interest']=(($bvc['totamt']*$cp)/100);*/
			$tdsamt=(($agentinterest*$tds)/100);
			$tdsamt=$this->roundamt->Roundall($tdsamt);
			$bvc['tds']=$tdsamt;
			$securitydepoamt=(($agentinterest*10)/100);
			$securitydepoamt=$this->roundamt->Roundall($securitydepoamt);
			$bvc['secutitydeposit']=$securitydepoamt;
			
			$totaldecution=$bvc['tds']+$bvc['secutitydeposit'];
			$bvc['interest']=$agentinterest-$totaldecution;
			return $bvc;
		}
		
		public function payagentcommision($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$dte=Date('Y-m-d');
			$mnt=Date('m');
			$year=Date('Y');
			$pmode=$id['pmode'];
			$accid=$id['sbAcNo'];
			$RepayDte = Date('Y-m-d');
			if($pmode=="SB ACCOUNT")
			{
			$avilablebal=$id['SBAvailhidn'];
			$total=$avilablebal+$id['pay'];
			}
			$tranid=0;
			if($id['noloan']=="NO")
			{
				$remaining=$id['plremamt'];
				$intrerst=$id['plintamt'];
				$emi=$id['plemi'];
				$n=$id['loopid'];
				$chargid=$id['charges'];
				$chargamt=$id['amount'];
				$loannum=$id['loannum'];
				$chargsum=0;
				$z=0;
/*******/
	$loan_charge_sum = 0;
/*******/
			for($i=1;$i<$n;$i++)
			{
				
				$charges=explode(",",$chargid);
				$chaamount=explode(",",$chargamt);
				$x=$charges[$z];
				$y=$chaamount[$z];
				
	$loan_charge_sum += $y;
				
				$head_sub=DB::table('chareges')->select('head','subhead')
				->where('charges_id',$x)
				->first();
				$head=$head_sub->head;
				$subhead=$head_sub->subhead;
				
				
				$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$loannum,'bid'=>$BID,'charg_tran_date'=>$RepayDte,'loantype'=>"SL",'LedgerHeadId'=>$head,'SubLedgerId'=>$subhead]);
				$z++;
				$chargsum=Floatval($y)+Floatval($chargsum);
				
				//	print_r($chargsum);
			}
	/*****/
	$repay_amt = $id['plemi'] + $id['plintamt'] + $loan_charge_sum;
	/*****/
	
			$aloan=$emi;//+$intrerst+$chargsum;
				$paidprincipal=$id["plemi"];//$remaining-$intrerst;
				$loanremainingamt=$remaining-$aloan;
				$plTran=DB::table('personalloan_repay')->InsertGetId(['PLRepay_PLAllocID'=>$id['loannum'],'PLRepay_PaidAmt'=>$repay_amt/*$id['pay']*/,'PLRepay_PayMode'=>"SALARY",'PLRepay_Bid'=>$BID,'PLRepay_Created_By'=>$UID,'PLRepay_Date'=>$dte,'PLRepay_CalculatedInterest'=>$id['plintamt'],'RemainingInterest_Amt'=>"0",'PLRepay_PaidInterest'=>$id['plintamt'],'PLRepay_Amtpaidtoprincpalamt'=>$paidprincipal,'PLRepay_EMIremaining'=>"0","interest_paid_upto"=>$dte]);
				
				DB::table('personalloan_allocation')
				->where('PersLoanAllocID',$id['loannum'])
				->update(['RemainingLoan_Amt'=>$loanremainingamt,'caldate'=>$dte]);
				
			}
			if($pmode=="SB ACCOUNT")
			{
				$tranid=DB::table('sb_transaction')->insertGetId(['Accid'=>$id['sbAcNo'],'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"AGENT COMMISION",'Amount'=>$id['pay'],'CurrentBalance'=>$avilablebal,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$mnt,'Year'=>$year,'Total_Bal'=>$total,'Bid'=>$BID,'Payment_Mode'=>"SALARY",'CreatedBy'=>$UID]);
				DB::table('createaccount')->where('Accid','=',$accid)->update(['Total_Amount'=>$total]);
			}
			$agt_cmm_id = DB::table('agent_commission_payment')->insertGetId(['Agent_Commission_Uid'=>$id['aguid'],'Agent_Commission_Bid'=>$BID,'Agent_Commission_PaidDate'=>$dte,'Agent_Commission_PaidforAmt'=>$id['totalamt'],'Agent_Commission_PaidAmount'=>$id['pay'],'Agent_Commission_PaidStatus'=>"PAID",'Agent_Commission_PaidBY'=>$UID,'Agent_Commission_Persent'=>$id['cp'],'securityDeposit'=>$id['sdpo'],'Tds'=>$id['tdsval'],'paymentmode'=>$pmode,'sbtranid'=>$tranid,'total_commission'=>$id["com_total_val"]/*$id['commdis']*/]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $pmode;
				$fn_data["rv_transaction_id"] = $agt_cmm_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::AGENT_COMMISSION_PAYMENT;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

				/**************SD TRAN**************/
				$subhead_id_agent_sd = 283;
				$head_id_agent_sd = 38;
				$sd_amt = $id['sdpo'];
				$agent_uid = $id['aguid'];
				$temp_sd_id = DB::table("employee")
					->where("Uid",$agent_uid)
					->value("cdsd_id");
				// var_dump($temp_sd_id);
				if(!empty($temp_sd_id)) {
					$cdsd_row = $this->cdsd->get_row(["{$this->cdsd->pk}"=>$temp_sd_id]);
					print_r($cdsd_row);

					unset($fn_data);
					$fn_data[$this->cdsd_tran->cdsd_type_field] = 2;
					$fn_data[$this->cdsd_tran->cdsd_id_field] = $temp_sd_id;
					$fn_data[$this->cdsd_tran->date_field] = date("Y-m-d");
					$fn_data[$this->cdsd_tran->time_field] = date("H:i:s");
					$fn_data[$this->cdsd_tran->bid_field] = $BID;
					$fn_data[$this->cdsd_tran->transaction_type_field] = CREDIT;
					$fn_data[$this->cdsd_tran->amount_field] = $sd_amt;
					$fn_data[$this->cdsd_tran->paid_field] = PAID;
					$fn_data[$this->cdsd_tran->payment_mode_field] = 2;// ADJUSTMENT
					$fn_data[$this->cdsd_tran->particulars_field] = $id['sd_particulars'];
					// $fn_data[$this->cdsd_tran->cheque_no_field] = 
					// $fn_data[$this->cdsd_tran->cheque_date_field] = 
					// $fn_data[$this->cdsd_tran->bank_id_field] = 
					$fn_data[$this->cdsd_tran->subhead_id_field] = $subhead_id_agent_sd;
					$fn_data[$this->cdsd_tran->deleted_field] = NOT_DELETED;
					$this->cdsd_tran->clear_row_data($fn_data);
					$this->cdsd_tran->set_row_data($fn_data);
					unset($fn_data);
					$this->cdsd_tran->insert_row();
					$temp_sd_ho_id = $cdsd_row->{$this->cdsd->sd_ho_id_field};
					var_dump($temp_sd_ho_id);

					$sd_ho_amt = $this->cdsd_tran->get_cdsd_amount(["cdsd_type"=>2, "{$this->cdsd_tran->cdsd_id_field}"=>$temp_sd_ho_id]);
					var_dump($sd_ho_amt);

					$ho_remaining_transferable_amount = SDModel::SD_HO_AMOUNT_LIMIT - $sd_ho_amt;
					

					if($sd_amt < $ho_remaining_transferable_amount) {
						$transfer_amount = $sd_amt;
					} else {
						$transfer_amount = $ho_remaining_transferable_amount;
					}

					if($sd_ho_amt < SDModel::SD_HO_AMOUNT_LIMIT) {
						$transfer_amount = $sd_amt;
					} else {
						$transfer_amount = 0;
					}
					var_dump($transfer_amount);

					if($cdsd_row->{$this->cdsd_tran->bid_field} != 6 && $transfer_amount > 0) {
						//transaction from branch to ho

						//B2B
						unset($insert_array);
						$insert_array["Branch_Branch1_Id"] = 6;
						$insert_array["Branch_Branch2_Id"] = $BID;
						$insert_array["Branch_Tran_Date"] = date("Y-m-d");
						$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
						$insert_array["LedgerHeadId"] = $head_id_agent_sd;
						$insert_array["SubLedgerId"] = $subhead_id_agent_sd;
						$insert_array["Branch_Amount"] = $id['sdpo'];
						$insert_array["Branch_per"] = "SD Amount";
						$branch_to_branch_id = DB::table("branch_to_branch")
							->insertGetId($insert_array);
							/****** ADJ NO FOR BRANCH *****/
							unset($fn_data);
							$fn_data["rv_payment_mode"] = "ADJUSTMENT";
							$fn_data["rv_transaction_id"] = $branch_to_branch_id;
							$fn_data["rv_transaction_type"] = "CREDIT"; // DEBIT
							$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
							$fn_data["rv_date"] = date("Y-m-d");
							$fn_data["rv_bid"] = $BID;
							$this->rv_no->save_rv_no($fn_data);
							/***********/
							/****** ADJ NO FOR HO *****/
							unset($fn_data);
							$fn_data["rv_payment_mode"] = "ADJUSTMENT";
							$fn_data["rv_transaction_id"] = $branch_to_branch_id;
							$fn_data["rv_transaction_type"] = "DEBIT"; //CREDIT
							$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
							$fn_data["rv_date"] = date("Y-m-d");
							$fn_data["rv_bid"] = 6;
							$this->rv_no->save_rv_no($fn_data);
							/***********/

						//BRNCH - SD DEB
						unset($fn_data);
						$fn_data[$this->cdsd_tran->cdsd_type_field] = 2;
						$fn_data[$this->cdsd_tran->cdsd_id_field] = $temp_sd_id;
						$fn_data[$this->cdsd_tran->date_field] = date("Y-m-d");
						$fn_data[$this->cdsd_tran->time_field] = date("H:i:s");
						$fn_data[$this->cdsd_tran->bid_field] = $BID;
						$fn_data[$this->cdsd_tran->transaction_type_field] = DEBIT;
						$fn_data[$this->cdsd_tran->amount_field] = $id['sdpo'];
						$fn_data[$this->cdsd_tran->paid_field] = PAID;
						$fn_data[$this->cdsd_tran->payment_mode_field] = 2;// ADJUSTMENT
						$fn_data[$this->cdsd_tran->particulars_field] = $id['sd_particulars'];
						// $fn_data[$this->cdsd_tran->cheque_no_field] = 
						// $fn_data[$this->cdsd_tran->cheque_date_field] = 
						// $fn_data[$this->cdsd_tran->bank_id_field] = 
						$fn_data[$this->cdsd_tran->subhead_id_field] = $subhead_id_agent_sd;
						$fn_data[$this->cdsd_tran->deleted_field] = NOT_DELETED;
						$this->cdsd_tran->set_row_data($fn_data);
						unset($fn_data);
						$this->cdsd_tran->insert_row();
						
						//HO - SD CREDIT
						unset($fn_data);
						$fn_data[$this->cdsd_tran->cdsd_type_field] = 2;
						$fn_data[$this->cdsd_tran->cdsd_id_field] = $temp_sd_ho_id;
						$fn_data[$this->cdsd_tran->date_field] = date("Y-m-d");
						$fn_data[$this->cdsd_tran->time_field] = date("H:i:s");
						$fn_data[$this->cdsd_tran->bid_field] = 6;
						$fn_data[$this->cdsd_tran->transaction_type_field] = CREDIT;
						$fn_data[$this->cdsd_tran->amount_field] = $id['sdpo'];
						$fn_data[$this->cdsd_tran->paid_field] = PAID;
						$fn_data[$this->cdsd_tran->payment_mode_field] = 2;// ADJUSTMENT
						$fn_data[$this->cdsd_tran->particulars_field] = $id['sd_particulars'];
						// $fn_data[$this->cdsd_tran->cheque_no_field] = 
						// $fn_data[$this->cdsd_tran->cheque_date_field] = 
						// $fn_data[$this->cdsd_tran->bank_id_field] = 
						$fn_data[$this->cdsd_tran->subhead_id_field] = $subhead_id_agent_sd;
						$fn_data[$this->cdsd_tran->deleted_field] = NOT_DELETED;
						$this->cdsd_tran->set_row_data($fn_data);
						unset($fn_data);
						$this->cdsd_tran->insert_row();
						
					}
				}
				/**************SD TRAN***************/

/*************edit**************/
			if(!empty($id['sal_extra_all'])) {
				$sal_extra_data['sal_extra_all'] = $id['sal_extra_all'];
				$sal_extra_data['sal_id'] = $agt_cmm_id;
				$sal_extra_data['emp_type'] = 2;//AGENT
				$this->insertSalExtraPay($sal_extra_data);
			}
/*************edit**************/

/*********** sarafara tds,sd ***********/
			if(isset($id['sarafara_payment'])) {
				if($id['sarafara_payment'] == true) {
					$temp_sal_extra_all = "9#{$id['tdsval']}#TDS|11#{$id['sdpo']}#SD";
					$sal_extra_data['sal_extra_all'] = $temp_sal_extra_all;
					$sal_extra_data['sal_id'] = $agt_cmm_id;
					$sal_extra_data['emp_type'] = 2;//AGENT
					$this->insertSalExtraPay($sal_extra_data);
				}
			}
/*********** sarafara tds,sd ***********/
			
			return $agt_cmm_id;
		}
		
		/*
		sal_extra_type:
		1 - add
		2 - remove from gross pay
		3 - remove from socitey
		*/
		public function getSalExtra($sal_extra_type=NULL)
		{
			if($sal_extra_type != NULL) {
				return DB::table('salary_extra')
					->select()
					->where('sal_extra_type','=',$sal_extra_type)
					->get();
			} else {
				return DB::table('salary_extra')
					->select()
					->get();
			}
		}
		
		public function insertSalExtra($data)
		{
			return DB::table('salary_extra')
					->insertGetId($data);
		}
		
		public function insertSalExtraPay($sal_extra_data)//combine
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID = $uname->Uid;
			$BID=$uname->Bid;
			
			$sal_extra_all = $sal_extra_data['sal_extra_all'];
			$sal_id = $sal_extra_data['sal_id'];
			$emp_type = $sal_extra_data['emp_type'];
			if(isset($sal_extra_data['date'])) {
				$tran_date = $sal_extra_data['date'];//IF DATE PROVIDED
			} else {
				$tran_date = date("Y-m-d");//OTHER WISE TAKE TODAY'S DATE
			}
			
			$sal_extra_arr = explode('|',$sal_extra_all);
			$sal_extra = array();
			$count=0;
			$ex_key = array();
			$value = array();
			$part = array();
			foreach($sal_extra_arr as $val) {
				$temp = explode('#',$val);
				if($temp[0] == 'undefined' || $temp[0] == '-')
						continue;
				if($temp[1] == 0)
						continue;
				$ex_key[$count] = $temp[0];
				$value[$count] = $temp[1];
				$part[$count] = $temp[2];
				$count++;
			}
			
			$data = array();
			$sal_extra_table = DB::table('salary_extra')->get();
			foreach($sal_extra_table as $key=>$row) {
				$sal_extra_list[$row->sal_extra_id] = $row;
			}
			
			print_r($ex_key);
			for($i=0;$i<$count;$i++) {
				$data['date']= $tran_date;
				$data['bid']= $BID;
				$data['sal_id']= $sal_id;
				$data['employee_type']= $emp_type;
				$data['sal_extra_id'] = $temp_key =  $ex_key[$i];
				//$data['sal_extra_type']= $sal_extra_list[$temp_key];
				$data['salpay_extra_amt']= $value[$i];
				$data['salpay_extra_particulars']= $part[$i];
				$data['LedgerHeadId']= $sal_extra_list[$temp_key]->head;
				$data['SubLedgerId']= $sal_extra_list[$temp_key]->sub_head;
				DB::table('salary_extra_pay')
					->insertGetId($data);

				/******* ADJ ENTRY TO EXPENSE ******/
					$sal_extra_type = DB::table("salary_extra")
						->where("sal_extra_id",$data['sal_extra_id'])
						->value("sal_extra_type");
					if($sal_extra_type == 3) { // ONLY FOR SOCIETY CONTRIBUTION
						$insert_array["Head_lid"] =  $data['LedgerHeadId'];
						$insert_array["SubHead_lid"] = $data['SubLedgerId'];
						$insert_array["e_date"] = $data['date'];
						$insert_array["Bid"] = $BID;
						$insert_array["pay_mode"] = "ADJUSTMENT";
						$insert_array["amount"] = $data['salpay_extra_amt'];
						$insert_array["Particulars"] = $data['salpay_extra_particulars'];
						$insert_array["ExpenseBy"] = $UID;

						$expense_id = DB::table("expense")
							->insertGetId($insert_array);

						//GENERATE ADJ NO. FOR EXPENSE
						/***********/
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $expense_id;
						$fn_data["rv_transaction_type"] = "DEBIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::EXPENSE;//constant B2B_TRAN is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $data['date'];
						// $fn_data["rv_bid"] = ;
						$this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						unset($insert_array);
						/***********/

					}
				/******* ADJ ENTRY TO EXPENSE ******/
				

				/******* ADJ ENTRY TO H.O. ******/
					$sal_extra_type = DB::table("salary_extra")
						->where("sal_extra_id",$data['sal_extra_id'])
						->value("sal_extra_type");
					if($sal_extra_type == 3) { // ONLY FOR SOCIETY CONTRIBUTION
						$insert_array["Branch_Branch1_Id"] = 6;
						$insert_array["Branch_Branch2_Id"] = $BID;
						$insert_array["Branch_Tran_Date"] = $data['date'];
						$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
						$insert_array["LedgerHeadId"] = $data['LedgerHeadId'];
						$insert_array["SubLedgerId"] = $data['SubLedgerId'];
						$insert_array["Branch_Amount"] = $data['salpay_extra_amt'];
						$insert_array["Branch_per"] = $data['salpay_extra_particulars'];

						$branch_to_branch_id = DB::table("branch_to_branch")
							->insertGetId($insert_array);
						//GENERATE ADJ NO. FOR H.O.
						/***********/
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $branch_to_branch_id;
						$fn_data["rv_transaction_type"] = "DEBIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $data['date'];
						$fn_data["rv_bid"] = 6;
						$this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						unset($insert_array);
						/***********/
						//NO ADJ NO. FOR THIS BRANCH (ADJ CREDIT)
					}
				/******* ADJ ENTRY TO H.O. ******/
			}
			
			return;
		}

		public function salary_slip_data($data){
			$ret_data["deduction"] = [];
			$ret_data["adition"] = [];

			$ret_data["sal_details"] = DB::table("salary")
				->select(
							DB::raw("rtrim(concat(`user`.`FirstName`,' ',`user`.`MiddleName`,' ',`user`.`LastName`)) as 'full_name'"),
							DB::raw("`Joining_Date` as 'date_of_joining'"),
							DB::raw("'--' as 'pf_no'"),
							DB::raw("`AccNum` as 'sb_no'"),
							DB::raw("'--' as 'worked_days'"),
							DB::raw("'--' as 'lop_days'"),
							DB::raw("`DName` as 'designation'"),
							DB::raw("'month' as 'month'"),
							DB::raw("'year' as 'year'"),
							"rep_date"
						)
				->join("user","user.Uid","=","salary.Uid")
				->join("employee","employee.Uid","=","salary.Uid")
				->join("createaccount","createaccount.Accid","=","employee.accid")
				->join("designation","designation.Did","=","employee.Did")
				->where("salid",$data["sal_id"])
				->first();

			if(empty($ret_data["sal_details"])) {
				return "Salary entry not found";
			}

			$ret_data["sal_details"]->month = date("F",strtotime($ret_data["sal_details"]->rep_date));
			$ret_data["sal_details"]->year = date("Y",strtotime($ret_data["sal_details"]->rep_date));

			$ret_data["deduction"] = DB::table("salary_extra_pay")
				->select(
							"sal_extra_display_name",
							"salpay_extra_amt"
						)
				->join("salary_extra","salary_extra.sal_extra_id","=","salary_extra_pay.sal_extra_id")
				->where("sal_id",$data["sal_id"])
				->where("salary_extra.sal_extra_type",2)
				->get();
			$ret_data["adition"] = DB::table("salary_extra_pay")
				->select(
							"sal_extra_display_name",
							"salpay_extra_amt"
						)
				->join("salary_extra","salary_extra.sal_extra_id","=","salary_extra_pay.sal_extra_id")
				->where("sal_id",$data["sal_id"])
				->where("salary_extra.sal_extra_type",1)
				->get();

			return $ret_data;
		}
		
	}

	