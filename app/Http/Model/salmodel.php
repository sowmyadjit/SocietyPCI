<?php
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\RoundModel;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;

	class salmodel extends Model
	{
		protected $table='salary';
		public $roundamt;
		public function __construct()
		{
			$this->roundamt=new RoundModel;
			$this->rv_no = new ReceiptVoucherController;
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
					
					$chargtabid=DB::table('charges_tran')->insertGetId(['charges_id'=>$x,'amount'=>$y,'loanid'=>$loannum,'bid'=>$id['bid'],'charg_tran_date'=>$RepayDte,'loantype'=>"sL",'LedgerHeadId'=>$head,'SubLedgerId'=>$subhead]);
					$z++;
					$chargsum=Floatval($y)+Floatval($chargsum);
					
					//	print_r($chargsum);
				}
				



				$a=$EMI_Amount;//+$slintamt+$chargsum;
				$totamt=$remaingamt-$a;
				
				DB::table('staffloan_allocation')->where('StfLoanAllocID','=',$id['loannum'])->update(['StaffLoan_LoanRemainingAmount'=>$totamt,'LastPaidDate'=>$dte]);
				
				DB::table('staffloan_repay')->insertGetId(['SLRepay_Date'=>$dte,'SLRepay_SLAllocID'=>$id['loannum'],'SLRepay_PaidAmt'=>$a,'SLRepay_PayMode'=>"SALARY",'SLRepay_Created_By'=>$id['uid'],'SLRepay_Bid'=>$id['bid'],'SLRepay_Interest'=>$id['slintamt'],'paid_principle'=>$EMI_Amount]);
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
			
			$res = DB::table('sb_transaction')->insertGetId(['Accid'=> $accid,'AccTid' =>"1",'TransactionType' =>"CREDIT",'particulars' =>"SALARY AMOUNT",'Amount' => $netpay,'CurrentBalance' => $accbal,'Total_Bal' => $totbal,'tran_Date' =>$dte,'SBReport_TranDate'=>  $dte,'Month'=>$mnt,'Year'=>$year,'Payment_Mode'=>"SALARY",'Bid'=>$id['bid'],'CreatedBy'=>$UID]);
			DB::table('createaccount')->where('Accid',$accid)->update(['Total_Amount'=>$totbal]);
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
			$agt_cmm_id = DB::table('agent_commission_payment')->insertGetId(['Agent_Commission_Uid'=>$id['aguid'],'Agent_Commission_Bid'=>$BID,'Agent_Commission_PaidDate'=>$dte,'Agent_Commission_PaidforAmt'=>$id['totalamt'],'Agent_Commission_PaidAmount'=>$id['pay'],'Agent_Commission_PaidStatus'=>"PAID",'Agent_Commission_PaidBY'=>$UID,'Agent_Commission_Persent'=>$id['cp'],'securityDeposit'=>$id['sdpo'],'Tds'=>$id['tdsval'],'paymentmode'=>$pmode,'sbtranid'=>$tranid]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $pmode;
				$fn_data["rv_transaction_id"] = $agt_cmm_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::AGENT_COMMISSION_PAYMENT;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $dte;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

/*************edit**************/
			if(!empty($id['sal_extra_all'])) {
				$sal_extra_data['sal_extra_all'] = $id['sal_extra_all'];
				$sal_extra_data['sal_id'] = $agt_cmm_id;
				$sal_extra_data['emp_type'] = 2;//AGENT
				$this->insertSalExtraPay($sal_extra_data);
			}
/*************edit**************/
			
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
			$BID=$uname->Bid;
			
			$sal_extra_all = $sal_extra_data['sal_extra_all'];
			$sal_id = $sal_extra_data['sal_id'];
			$emp_type = $sal_extra_data['emp_type'];
			
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
				$data['date']= date("Y-m-d");
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

	