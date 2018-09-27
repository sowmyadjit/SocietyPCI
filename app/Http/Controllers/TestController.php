<?php
	
	namespace App\Http\Controllers;
	use File;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\salmodel;
	use App\Http\Model\AllChargesModel;
	use Input;
	use DB;
	use Auth;
	use Exception;
	
	class TestController extends Controller
	{
		//var $loan;
	
		public function __construct()
		{
			$this->rv_no = new ReceiptVoucherController;
			$this->sal = new salmodel;
			$this->all_ch = new AllChargesModel;
			// $this->test = new salmodel;
		}
/* 
		public function test()
		{
			$aa = $this->test->salary_slip_data(["sal_id"=>216]);
			print_r($aa);
			return;
		}
 */
		public function update_settings(REQUEST $request)
		{
			$data["key"] = $request->input("key");
			$data["value"] = $request->input("value");
			DB::table("settings")
				->where("settings_key",$data["key"])
				->update(["settings_value"=>$data["value"]]);
			return "done";
		}
		
		public function rv()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			$to_date = date("Y-m-d"); //"2018-06-06";
			$cal_days = $this->get_cal_days(["from_date"=>"2018-04-01","to_date"=>date("Y-m-d",strtotime($to_date))]);
			//print_r($cal_days);

			echo "<br />\n";
			echo "<br />\n";
			foreach($cal_days as $cal_day) {
				echo "<br />\n";
				echo "-------------------------------------------------------------------------------------------------";
				echo "<br />\n";
				echo $cal_day;
				echo "<br />\n";
				echo "-------------------------------------------------------------------------------------------------";				
				echo "<br />\n";

				$rv_tran_cat_list = DB::table("receipt_voucher_transaction_category")
					->where("deleted",0)
					->lists("rv_tran_table","rv_tran_cat_id");
				foreach($rv_tran_cat_list as $key_category=>$tran_table) {

					$ch_row =  DB::table("cash_chitta_details")
						->where("table_name","{$tran_table}")
						->where("deleted",0)
						->first();
					if(empty($ch_row)) {
						continue;
					}
					
					$join_list = DB::table("cash_chitta_joining_tables")
						->where("deleted",0)
						->where("cash_chitta_id",$ch_row->cash_chitta_id)
						->get();
					$amount_list = DB::table("cash_chitta_amount_fields")
						->where("deleted",0)
						->where("cash_chitta_id",$ch_row->cash_chitta_id)
						->get();
					
					if(empty($ch_row)) {
						print_r($tran_table);
						throw new Exception("{$tran_table} not found in cash_chitta_details table}");
					}
					
					$select_array = array(
											"{$tran_table}.{$ch_row->pk_field} as rv_transaction_id",
											// "{$ch_row->payment_mode_field} as rv_payment_mode",
											// "{$ch_row->transaction_type} as rv_transaction_type",
											"{$tran_table}.{$ch_row->date_field} as rv_date"
										);
					
					if(!empty($ch_row->amount_field) && $ch_row->amount_field != "NA") {
						$select_ele = DB::raw("{$ch_row->table_name}.{$ch_row->amount_field} as amount");
						array_push($select_array,$select_ele);
					} else {
						$amt_fields = "(";
						$first_flag = true;
						//	print_r($amount_list);//exit();
						foreach($amount_list as $row_amt) {
							if($first_flag) {
								$first_flag = false;
								$amt_fields .= "{$row_amt->amount_table}.{$row_amt->amount_field}";
							} else {
								$amt_fields .= " + {$row_amt->amount_table}.{$row_amt->amount_field}";
							}
						}
						$amt_fields .= ")";
						// var_dump($amt_fields);
						$select_ele = DB::raw(" {$amt_fields} as 'amount'");
						array_push($select_array,$select_ele);
					}
					if($tran_table == "pending_pigmy" || $tran_table == "members" || $tran_table == "purchaseshare" || $tran_table == "customer") {
						$raw_obj = DB::raw("'CASH' as 'rv_payment_mode'");
						array_push($select_array,$raw_obj);
					} else {
						$raw_obj = DB::raw("{$ch_row->payment_mode_field} as 'rv_payment_mode'");
						array_push($select_array,$raw_obj);
					}
					if($tran_table == "pigmi_payamount") {
						$raw_obj = DB::raw("PayAmount_IntType as 'withdrawal_type'");
						array_push($select_array,$raw_obj);
					}

					switch($ch_row->transaction_type) {
						case CREDIT	:	//constant defined in route.php file
										$raw_obj = DB::raw("'CREDIT' as 'rv_transaction_type'");
										break;
						case DEBIT	:	
										$raw_obj = DB::raw("'DEBIT' as 'rv_transaction_type'");
										break;
						case BOTH	:	
										$raw_obj = DB::raw("{$ch_row->transaction_type_field} as 'rv_transaction_type'");
										break;
					}
					array_push($select_array,$raw_obj);

					//QUERY STARTS HERE
						$table_data = DB::table("{$tran_table}")
						->select($select_array);
						
						//JOINS
						foreach($join_list as $row_jo) {
							$table_data = $table_data->join("{$row_jo->joining_table_1_name}","{$row_jo->joining_table_1_name}.{$row_jo->joining_table_1_field}","=",
													"{$row_jo->joining_table_2_name}.{$row_jo->joining_table_2_field}");
						}

						$table_data = $table_data->where("{$tran_table}.{$ch_row->date_field}","{$cal_day}")
							->where("{$ch_row->table_containing_bid}.{$ch_row->bid_field}",$BID)
							->get();
					
					//continue;

					echo "<br />\n";
					echo $tran_table;
					echo "<br />\n";
					foreach($table_data as $table_row) {
						//print_r($table_row);exit();


						if($table_row->amount == 0) {
							continue;
						}
						
						switch($table_row->rv_transaction_type) {
							case "1"			:	
							case "Credit"		:	
							case "WITHDRAWL"	:	
													$table_row->rv_transaction_type = "CREDIT";
													break;
							case "2"			:	
							case "Debit"		:	
							case "Deposit"		:	//deposite to bank - deposit table
							case ""				:	//BLANK is deposit to bank
													$table_row->rv_transaction_type = "DEBIT";
													break;
						}

						echo $table_row->rv_transaction_id;
						echo " - ";
						/***********/
						$fn_data["rv_payment_mode"] = $table_row->rv_payment_mode;
						$fn_data["rv_transaction_id"] = $table_row->rv_transaction_id;
						$fn_data["rv_transaction_type"] = $table_row->rv_transaction_type;
						$fn_data["rv_transaction_category"] = $key_category;
						$fn_data["rv_date"] = $cal_day;
						$fn_ret_data = $this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						echo $fn_ret_data . "<br />\n";
						/***********/
						switch($tran_table) {
							case "pigmi_payamount"			:	if($table_row->withdrawal_type =="PREWITHDRAWAL") {
																	/***********/
																	$fn_data["rv_payment_mode"] = $table_row->rv_payment_mode;
																	$fn_data["rv_transaction_id"] = $table_row->rv_transaction_id;
																	$fn_data["rv_transaction_type"] = "CREDIT";
																	$fn_data["rv_transaction_category"] = $key_category;
																	$fn_data["rv_date"] = $cal_day;
																	$fn_ret_data = $this->rv_no->save_rv_no($fn_data);
																	unset($fn_data);
																	echo $fn_ret_data . "<br />\n";
																	/***********/
																}
																break;
							case "jewelloan_allocation"		:	if($tran_table == "jewelloan_allocation") {
																	/***********/
																	$fn_data["rv_payment_mode"] = $table_row->rv_payment_mode;
																	$fn_data["rv_transaction_id"] = $table_row->rv_transaction_id;
																	$fn_data["rv_transaction_type"] = "CREDIT";
																	$fn_data["rv_transaction_category"] = $key_category;
																	$fn_data["rv_date"] = $cal_day;
																	$fn_ret_data = $this->rv_no->save_rv_no($fn_data);
																	unset($fn_data);
																	echo $fn_ret_data . "<br />\n";
																	/***********/
																}
							case "depositeloan_allocation"	:	if($tran_table == "depositeloan_allocation") {
																	/***********/
																	$fn_data["rv_payment_mode"] = $table_row->rv_payment_mode;
																	$fn_data["rv_transaction_id"] = $table_row->rv_transaction_id;
																	$fn_data["rv_transaction_type"] = "CREDIT";
																	$fn_data["rv_transaction_category"] = $key_category;
																	$fn_data["rv_date"] = $cal_day;
																	$fn_ret_data = $this->rv_no->save_rv_no($fn_data);
																	unset($fn_data);
																	echo $fn_ret_data . "<br />\n";
																	/***********/
																}
						}
					}
					//break;
				}

				// break;
			}
		}
		
		public function get_cal_days($data)
		{
			$cal_days = [];
			$temp_date = $data["from_date"];
			$end_date = $data["to_date"];
			$i = -1;
			while($temp_date <= $end_date) {
				//var_dump($temp_date);
				$cal_days[++$i] = $temp_date;
				$temp_date = date('Y-m-d', strtotime('+1 day', strtotime($temp_date)));
			}//print_r($cal_days);
			
			return $cal_days;
		}

		public function chq() // CHEQUE GIVEN FOR CUSTOMER - FD RD PG PAY AMT
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			$start_date = "2018-04-01";
			$pigmi_payamount_list = DB::table("pigmi_payamount")
				->select(
					"PayId as payamt_id",
					"PayAmount_BankId as bank_id",
					"PayAmountReport_PayDate as date",
					"PayAmount_ChequeNum as cheque_no",
					"PayAmount_ChequeDate as cheque_date",
					"PayAmount_PayableAmount as amount",
					DB::raw(" 'PG' as 'type' ")
				)
				->where("PayAmountReport_PayDate",">=",$start_date)
				->where("PayAmount_PaymentMode","CHEQUE")
				->where("PayAmount_ChequeNum","!=","")
				->where("Bid",$BID)
				->get();
				
			$rd_payamount_list = DB::table("rd_payamount")
				->select(
					"RDPayId as payamt_id",
					"RDPayAmt_BankId as bank_id",
					"RDPayAmtReport_PayDate as date",
					"RDPayAmt_ChequeNum as cheque_no",
					"RDPayAmt_ChequeDate as cheque_date",
					"RDPayAmt_PayableAmount as amount",
					DB::raw(" 'RD' as 'type' ")
				)
				->where("RDPayAmtReport_PayDate",">=",$start_date)
				->where("RDPayAmt_PaymentMode","CHEQUE")
				->where("RDPayAmt_ChequeNum","!=","")
				->where("Bid",$BID)
				->get();
				
			$fd_payamount_list = DB::table("fd_payamount")
				->select(
					"FDPayId as payamt_id",
					"FDPayAmt_BankId as bank_id",
					"FDPayAmtReport_PayDate as date",
					"FDPayAmt_ChequeNum as cheque_no",
					"FDPayAmt_ChequeDate as cheque_date",
					"FDPayAmt_PayableAmount as amount",
					DB::raw(" 'FD' as 'type' ")
				)
				->where("FDPayAmtReport_PayDate",">=",$start_date)
				->where("FDPayAmt_PaymentMode","CHEQUE")
				->where("FDPayAmt_ChequeNum","!=","")
				->where("Bid",$BID)
				->get();

			$payamt_list = array_merge($pigmi_payamount_list, $rd_payamount_list, $fd_payamount_list);
			// print_r($payamt_list);exit();

			foreach($payamt_list as $row) {

				$type = $row->type;
				$payamt_id = $row->payamt_id;

				$bank_id = $row->bank_id;
				$date = $row->date;
				$cheque_no = $row->cheque_no;
				$cheque_date = $row->cheque_date;
				$amount = $row->amount;
				$reason = "PIGMY PAY AMOUNT THROUGH CHEQUE";
				$Deposit_type = "WITHDRAWL";

				// CHECK FOR DUPLICATE ENTRY
				echo "<br />\nTYPE:{$type} ";
				echo "- PAYAMT ID:{$payamt_id} ";
				echo "- cheque no:{$cheque_no} ";

				$existing_entries = DB::table("deposit")
					->where("cheque_no",$cheque_no)
					->count();

				if($existing_entries > 0) {
					echo "<font color='blue'>EXISTS</font>";
					continue;
				}
				
				$addbank = DB::table('addbank')
				->where('Bankid','=',$bank_id)
				->first();

				if(empty($addbank)) {
					echo "- <font color='red'>bank_id not found({$bank_id})</font>";
					continue;
				}

				$insert_array["Bid"] = $BID;
				$insert_array["d_date"] = date("d-m-Y",strtotime($date));
				$insert_array["date"] = date("Y-m-d",strtotime($date));
				$insert_array["Branch"] = $addbank->Branch;
				$insert_array["depo_bank"] = $addbank->BankName;
				$insert_array["depo_bank_id"] = $addbank->Bankid;
				$insert_array["pay_mode"] = "CHEQUE";
				$insert_array["cheque_no"] = $cheque_no;
				$insert_array["cheque_date"] = $cheque_date;
				$insert_array["bank_name"] = "";
				$insert_array["amount"] = $amount;
				$insert_array["paid"] = "yes";
				$insert_array["reason"] = $reason;
				// $insert_array["cd"] = "";
				$insert_array["Deposit_type"] = $Deposit_type;

				$insert_id = DB::table("deposit")
					->insertGetId($insert_array);
					
				echo "- <font color='green'>instered</font> ({$insert_id}) ";
			}

		}

		public function soc_cont()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			$start_date = date("Y-m-d",strtotime("2018-04-01"));
			$salary_extra_pay_list = DB::table("salary_extra_pay")
				->select(
					"salary_extra_pay.salpay_extra_id",
					"salary_extra_pay.sal_extra_id",
					"salary_extra_pay.date",
					"salary_extra_pay.LedgerHeadId",
					"salary_extra_pay.SubLedgerId",
					"salary_extra_pay.salpay_extra_amt",
					"salary_extra_pay.salpay_extra_particulars"
				)
				->join("salary_extra","salary_extra.sal_extra_id","=","salary_extra_pay.sal_extra_id")
				->where("salary_extra_pay.date",">=",$start_date)
				->where("salary_extra_pay.bid",$BID)
				->where("salary_extra.sal_extra_type",3)
				->get();

			foreach($salary_extra_pay_list as $row_sep) {
				echo "<br />\n";
				echo "sal_extra_pay {$row_sep->salpay_extra_id} :";
				// CHECKING FOR EXISTING ENTRIES
					$existing_entries = DB::table("branch_to_branch")
						->where("Branch_Branch1_Id",6)
						->where("Branch_Branch2_Id",$BID)
						->where("Branch_Tran_Date",$row_sep->date)
						->where("Branch_Amount",$row_sep->salpay_extra_amt)
						->count();
					if($existing_entries > 0) {
						echo "EXISTS";
						continue;
					}
				/******* ADJ ENTRY TO H.O. ******/
					$sal_extra_type = DB::table("salary_extra")
					->where("sal_extra_id",$row_sep->sal_extra_id)
					->value("sal_extra_type");
				
					$insert_array["Branch_Branch1_Id"] = 6;
					$insert_array["Branch_Branch2_Id"] = $BID;
					$insert_array["Branch_Tran_Date"] = $row_sep->date;
					$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
					$insert_array["LedgerHeadId"] = $row_sep->LedgerHeadId;
					$insert_array["SubLedgerId"] = $row_sep->SubLedgerId;
					$insert_array["Branch_Amount"] = $row_sep->salpay_extra_amt;
					$insert_array["Branch_per"] = $row_sep->salpay_extra_particulars;

					$branch_to_branch_id = DB::table("branch_to_branch")
						->insertGetId($insert_array);
					//GENERATE ADJ NO. FOR H.O.
						/***********/
						$fn_data["rv_payment_mode"] = "ADJUSTMENT";
						$fn_data["rv_transaction_id"] = $branch_to_branch_id;
						$fn_data["rv_transaction_type"] = "DEBIT";
						$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
						$fn_data["rv_date"] = $row_sep->date;
						$fn_data["rv_bid"] = 6;
						$adj_no = $this->rv_no->save_rv_no($fn_data);
						unset($fn_data);
						echo " adj no: {$adj_no}";
						/***********/
					//NO ADJ NO. FOR THIS BRANCH (ADJ CREDIT)
				/******* ADJ ENTRY TO H.O. ******/
			}
		}

		public function agent_ded()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			$start_date = date("Y-m-d",strtotime("2018-04-01"));
			$ag_com_list = DB::table("agent_commission_payment")
				->select(
					"agent_commission_payment.Agent_Commission_Id",
					"agent_commission_payment.Agent_Commission_Bid",
					"agent_commission_payment.Agent_Commission_PaidDate",
					"agent_commission_payment.Tds",
					"agent_commission_payment.securityDeposit"
				)
				->where("agent_commission_payment.Agent_Commission_PaidDate",">=",$start_date)
				->where("agent_commission_payment.Agent_Commission_Bid","=",$BID)
				->get();

			foreach($ag_com_list as $row_ag) {
				//ECHO ID
				echo "<br />\nAgent_Commission_Id: {$row_ag->Agent_Commission_Id} - ";

				//CHECK FOR EXISTING ENTRY
				$existing_entries = DB::table("salary_extra_pay")
					->where("salary_extra_pay.bid",$row_ag->Agent_Commission_Bid)
					->where("salary_extra_pay.date",$row_ag->Agent_Commission_PaidDate)
					->where("salary_extra_pay.employee_type",2)
					->where("salary_extra_pay.sal_id",$row_ag->Agent_Commission_Id)
					->count();
				if($existing_entries > 0) {
					echo "EXISTS({$existing_entries})";
					continue;
				}

				//INSERT
				/*********** sarafara tds,sd ***********/
					$temp_sal_extra_all = "9#{$row_ag->Tds}#TDS|11#{$row_ag->securityDeposit}#SD";
					$sal_extra_data['sal_extra_all'] = $temp_sal_extra_all;
					$sal_extra_data['sal_id'] = $row_ag->Agent_Commission_Id;
					$sal_extra_data['emp_type'] = 2;//AGENT
					$sal_extra_data['date'] = $row_ag->Agent_Commission_PaidDate;// DATE
					$this->sal->insertSalExtraPay($sal_extra_data);
				/*********** sarafara tds,sd ***********/
				echo " rows INSERTED";
			}
		}

		public function save_to_db(Request $request)
		{
			$table = $request->input("table");
			$pk = $request->input("pk");
			$pk_value = $request->input("pk_value");
			$field_name = $request->input("field_name");
			$field_value = $request->input("field_value");

			DB::table($table)
				->where($pk,$pk_value)
				->update([$field_name=>$field_value]);
			return "done";
		}

		public function chq_charge()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			$start_date = date("Y-m-d",strtotime("2018-04-01"));

			$sb_cheques = DB::table("sb_transaction")
				->select(
					"Tranid",
					"SBReport_TranDate",
					"Cheque_Number",
					"Cheque_Date",
					"Bid",
					"Amount",
					"CreatedBy"
				)
				->where("sb_transaction.Bid", $BID)
				->where("sb_transaction.particulars", "CHEQUE CHAREGE")
				->where("sb_transaction.tran_reversed", "no")
				->where("sb_transaction.SBReport_TranDate",">=",$start_date)
				->get();

			foreach($sb_cheques as $row_chq) {
				//ECHO ID
				echo "<br />\nSB TRAN ID: {$row_chq->Tranid} - ";

				if(empty($row_chq->Cheque_Number)) {
					echo " (cheque no is empty. can't check for existing entries.)";
					continue;
				}

				//CHECK FOR EXISTING ENTRY
				$existing_entries = DB::table("income")
					->where("income.Bid", $row_chq->Bid)
					->where("income.Income_date", $row_chq->SBReport_TranDate)
					->where("income.Income_amount", $row_chq->Amount)
					->where("income.Income_cheque_no", $row_chq->Cheque_Number)
					->count();
				
				if($existing_entries > 0) {
					echo "EXISTS({$existing_entries})";
					continue;
				}

				$insert_data["Income_Head_lid"] = 88;
				$insert_data["Income_SubHead_lid"] = 85;	//	BANK CHARGES SUBHEAD UNDER OTHER INCOME HEAD IS NOT PRESENT. SO OHTER INCOME SUBHEAD UNDER OTHER INCOME HEAD(85)
				$insert_data["Income_date"] = $row_chq->SBReport_TranDate;
				$insert_data["Income_cheque_no"] = $row_chq->Cheque_Number;
				$insert_data["Income_cheque_date"] = $row_chq->Cheque_Date;
				$insert_data["Bid"] = $row_chq->Bid;
				$insert_data["Income_pay_mode"] = "ADJUSTMENT";
				$insert_data["Income_amount"] = $row_chq->Amount;
				$insert_data["Income_Particulars"] = "CHEQUE CHARGE - {$row_chq->Cheque_Number}";
				$insert_data["Income_ExpenseBy"] = $row_chq->CreatedBy;
				$income_id = DB::table("income")
					->insertGetId($insert_data);
				echo " rows INSERTED({$income_id})";

				// NO ADJ NO FOR ADJ CREDIT
			}
				

			
		}

		//ALL CHARGES
		public function all_ch(Request $request)
		{
			$uname=''; if(Auth::user()) { $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid; } else {$BID = $UID = 0;}
			if(!in_array($BID,[1,2,3,4,5,6])) { // CHECK FOR LOGIN
				return "NOT LOGGED IN";
			}
			$fd["from_date"] = "2018-08-30";
			$this->loan_charges_to_all_charges($fd);
			$this->customer_charges_to_all_charges($fd);
			$this->dl_charges_to_all_charges($fd);
			$this->pl_charges_to_all_charges($fd);
			$this->pg_prewith_charges_to_all_charges($fd);
			$this->rd_prewith_charges_to_all_charges($fd);
			$this->jl_charges_to_all_charges($fd);

			return;
		}

		public function loan_charges_to_all_charges($data)
		{
			//loan charges from charges tran to all_charges
			$from_date = $data["from_date"];
			$date_field = "charg_tran_date";
			$data = DB::table("charges_tran")
				->join("chareges","chareges.charges_id","=","charges_tran.charges_id")
				->where("deleted", 0)
				->where($date_field,">=",$from_date)
				// ->orderBy("charg_id", "desc")
				// ->limit(5)
				->get();

			foreach($data as $key_ct => $row_ct) { // CHARGES TRANSACTION ROW
				echo "<br />\n";
				echo "charges_tran(id:{$row_ct->charg_id}) ";
				$ft = "charges_tran"; // FROM TABLE
				$fid  = $row_ct->charg_id; // FROM ID
				// 	PUT EACH ENTRY IN all_charges  TABLE
				// print_r($row_ct);//continue;
				// GET THE PAYMENT MODE
				switch(strtoupper($row_ct->loantype)) {
					case "DL" :
								$loan_repay = DB::table("depositeloan_repay")
									->where("DLRepay_DepAllocID",$row_ct->loanid)
									->where("DLRepay_Date",$row_ct->charg_tran_date)
									->first();
								if(!empty($loan_repay)) {
									$temp_pay_mode = $loan_repay->DLRepay_PayMode;
									$temp_tran_id = $loan_repay->DLRepay_ID;
									$temp_created_by = $loan_repay->Created_By;
								}
								$temp_tran_table = 27;
								break;
					case "PL" :
								$loan_repay = DB::table("personalloan_repay")
									->where("PLRepay_PLAllocID",$row_ct->loanid)
									->where("PLRepay_Date",$row_ct->charg_tran_date)
									->first();
								if(!empty($loan_repay)) {
									$temp_pay_mode = $loan_repay->PLRepay_PayMode;
									$temp_tran_id = $loan_repay->PLRepay_Id;
									$temp_created_by = $loan_repay->PLRepay_Created_By;
								}
								$temp_tran_table = 25;
								break;
					case "JL" :
								$loan_repay = DB::table("jewelloan_repay")
									->where("JLRepay_JLAllocID",$row_ct->loanid)
									->where("JLRepay_Date",$row_ct->charg_tran_date)
									->first();
								if(!empty($loan_repay)) {
									$temp_pay_mode = $loan_repay->JLRepay_PayMode;
									$temp_tran_id = $loan_repay->JLRepay_Id;
									$temp_created_by = $loan_repay->JLRepay_Created_By;
								}
								$temp_tran_table = 24;
								break;
					case "SL" :
								$loan_repay = DB::table("staffloan_repay")
									->where("SLRepay_SLAllocID",$row_ct->loanid)
									->where("SLRepay_Date",$row_ct->charg_tran_date)
									->first();
								if(!empty($loan_repay)) {
									$temp_pay_mode = $loan_repay->SLRepay_PayMode;
									$temp_tran_id = $loan_repay->SLRepay_Id;
									$temp_created_by = $loan_repay->SLRepay_Created_By;
								}
								$temp_tran_table = 26;
								break;
					default:
								$temp_pay_mode = "ADJUSTMENT";
								$temp_tran_table = 0;
								$temp_tran_id = 0;
								$temp_created_by = 0;
				}

				if(empty($temp_pay_mode)) {
					$temp_pay_mode = "ADJUSTMENT";
				}
				if(empty($temp_tran_id)) {
					$temp_tran_id = 0;
				}
				if(empty($temp_created_by)) {
					$temp_created_by = 0;
				}

			/* 	$existing_entries = DB::table("all_charges")
					->where("SubLedgerId",$row_ct->subhead)
					->where("tran_table",$temp_tran_table)
					->where("tran_id",$temp_tran_id)
					->where("deleted",0)
					->get(); */
				$tt = $temp_tran_table; // tt - tran table
				$tid = $temp_tran_id; // tid - tran id
				$existing_entries = DB::table("all_charges")
					->where("tran_table",$tt)
					->where("tran_id",$tid)
					->where("deleted",0)
					->where("tran_table","!=","")
					->where("tran_table","!=",0)
					->where("tran_id","!=",0)
					->get();
				if(count($existing_entries) > 0) {
					// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
					echo "EXISTS(ft:{$ft}, fid:{$fid})";
					continue;
				}
				
				/******************** ALL CHARGES ******************/
				if(!empty($row_ct->amount)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_ct->charg_tran_date;
					$fd["bid"] = $row_ct->bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $temp_pay_mode;
					$fd["amount"] = $row_ct->amount;
					$fd["particulars"] = $row_ct->charges_name;
					$fd["paid"] = 1;
					$fd["tran_table"] = $temp_tran_table; // tran table
					$fd["tran_id"] = $temp_tran_id;
					$fd["created_by"] = $temp_created_by;
					$fd["SubLedgerId"] = $row_ct->subhead;
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				}
				/******************** ALL CHARGES ******************/
			}

			echo "<br />\n---------------------------";
		}

		public function customer_charges_to_all_charges($data)
		{
			//charge from CUSTOMER TABLE to all_charges
			$from_date = $data["from_date"];
			$date_field = "Created_on";
			$data = DB::table("customer")
				->where($date_field,">=",$from_date)
				// ->orderBy("Custid", "desc")
				// ->limit(5)
				->get();
			
			// print_r($data);

			foreach($data as $key_cu => $row_cu) {
				echo "<br />\n";
				echo "customer(id:{$row_cu->Custid}) ";
				$ft = "customer"; // FROM TABLE
				$fid  = $row_cu->Custid; // FROM ID
				// print_r($row_cu);

				/************** CHECK FOR EXISTING ENTRIES *********************/
				/* 	$existing_entries = DB::table("all_charges")
						->where("SubLedgerId",86)
						->where("tran_table",6)
						->where("tran_id",$row_cu->Custid)
						->where("deleted",0)
						->get(); */
					$tt = 6; // tt - tran table
					$tid = $row_cu->Custid; // tid - tran id
					$existing_entries = DB::table("all_charges")
						->where("tran_table",$tt)
						->where("tran_id",$tid)
						->where("deleted",0)
						->where("tran_table","!=","")
						->where("tran_table","!=",0)
						->where("tran_id","!=",0)
						->get();
				if(count($existing_entries) > 0) {
					// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
					echo "EXISTS(ft:{$ft}, fid:{$fid})";
					continue;
				}
				/************** CHECK FOR EXISTING ENTRIES *********************/

				/******************** ALL CHARGES ******************/
				if(!empty($row_cu->Customer_Fee)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_cu->Created_on;
					$fd["bid"] = $row_cu->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = "CASH";
					$fd["amount"] = $row_cu->Customer_Fee;
					$fd["particulars"] = "MEMBER FEES";
					$fd["paid"] = 1;
					$fd["tran_table"] = 6; // tran table
					$fd["tran_id"] = $row_cu->Custid;
					$fd["created_by"] = $row_cu->CreatedBy;
					$fd["SubLedgerId"] = 86; // MEMBER FEES
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else {
					echo "amt 0";
				}
				/******************** ALL CHARGES ******************/
			}
			echo "<br />\n---------------------------";
		}

		public function dl_charges_to_all_charges($data)
		{
			//DL ALLOCATION CHARGE FROM  depositeloan_allocation TABLE to all_charges
			$from_date = $data["from_date"];
			$date_field = "DepLoan_LoanStartDate";
			$data = DB::table("depositeloan_allocation")
				->where($date_field,">=",$from_date)
				// ->orderBy("DepLoanAllocId", "desc")
				// ->limit(10)
				->get();

			// print_r($data);

			foreach($data as $key_dl => $row_dl) {
				echo "<br />\n";
				echo "depositeloan_allocation(id:{$row_dl->DepLoanAllocId}) ";
				$ft = "depositeloan_allocation"; // FROM TABLE
				$fid  = $row_dl->DepLoanAllocId; // FROM ID
				// print_r($row_dl);

				/************** CHECK FOR EXISTING ENTRIES *********************/
				/* 	$existing_entries = DB::table("all_charges")
						->where("SubLedgerId",90)
						->where("tran_table",29)
						->where("tran_id",$row_dl->DepLoanAllocId)
						->where("deleted",0)
						->get(); */
				$tt = 29; // tt - tran table
				$tid = $row_dl->DepLoanAllocId; // tid - tran id
				$existing_entries = DB::table("all_charges")
					->where("tran_table",$tt)
					->where("tran_id",$tid)
					->where("deleted",0)
					->where("tran_table","!=","")
					->where("tran_table","!=",0)
					->where("tran_id","!=",0)
					->get();
				if(count($existing_entries) > 0) {
					// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
					echo "EXISTS(ft:{$ft}, fid:{$fid})";
					continue;
				}
				/************** CHECK FOR EXISTING ENTRIES *********************/

				/******************** ALL CHARGES ******************/
				if(!empty($row_dl->DepLoan_LoanCharge)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_dl->DepLoan_LoanStartDate;
					$fd["bid"] = $row_dl->DepLoan_Branch;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = "CASH";
					$fd["amount"] = $row_dl->DepLoan_LoanCharge;
					$fd["particulars"] = "BOOKS AND FORMS";
					$fd["paid"] = 1;
					$fd["tran_table"] = 29; // tran table
					$fd["tran_id"] = $row_dl->DepLoanAllocId;
					$fd["created_by"] = 0;
					$fd["SubLedgerId"] = 90; // MEMBER FEES
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else {
					echo "amt 0";
				}
				/******************** ALL CHARGES ******************/
			}
			echo "<br />\n---------------------------";
		}

		public function pl_charges_to_all_charges($data)
		{
			//PL ALLOCATION CHARGE FROM  personalloan_payment TABLE to all_charges
			$from_date = $data["from_date"];
			$date_field = "pl_payment_date";
			$data = DB::table("personalloan_payment")
				->join("personalloan_allocation","personalloan_allocation.PersLoanAllocID","=","personalloan_payment.pl_allocation_id")
				->where($date_field,">=",$from_date)
				// ->orderBy("pl_payment_id", "desc")
				// ->limit(10)
				->get();

			// print_r($data);

			foreach($data as $key_pl => $row_pl) {
				echo "<br />\n";
				echo "personalloan_payment(id:{$row_pl->pl_payment_id}) ";
				$ft = "personalloan_payment"; // FROM TABLE
				$fid  = $row_pl->pl_payment_id; // FROM ID
				// print_r($row_pl); continue;
				/************** CHECK FOR EXISTING ENTRIES *********************/
				/* 	$existing_entries = DB::table("all_charges")
						->where("SubLedgerId",90)
						->where("tran_table",29)
						->where("tran_id",$row_dl->DepLoanAllocId)
						->where("deleted",0)
						->get(); */
				$tt = 30; // tt - tran table
				$tid = $row_pl->pl_payment_id; // tid - tran id
				$existing_entries = DB::table("all_charges")
					->where("tran_table",$tt)
					->where("tran_id",$tid)
					->where("deleted",0)
					->where("tran_table","!=","")
					->where("tran_table","!=",0)
					->where("tran_id","!=",0)
					->get();
				if(count($existing_entries) > 0) {
					// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
					echo "EXISTS(ft:{$ft}, fid:{$fid})";
					continue;
				}
				/************** CHECK FOR EXISTING ENTRIES *********************/

				/******************** ALL CHARGES (OTHER INCOME)******************/
				if(!empty($row_pl->otherCharges)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_pl->pl_payment_date;
					$fd["bid"] = $row_pl->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pl->PayMode;
					$fd["amount"] = $row_pl->otherCharges;
					$fd["particulars"] = "OTHER INCOME";
					$fd["paid"] = 1;
					$fd["tran_table"] = 30; // tran table
					$fd["tran_id"] = $row_pl->pl_payment_id;
					$fd["created_by"] = $row_pl->CreadtedBY;
					$fd["SubLedgerId"] = 88; // OTHER INCOME
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (OTHER INCOME)******************/
				/******************** ALL CHARGES (BOOKS AND FORMS)******************/
				if(!empty($row_pl->Book_FormCharges)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_pl->pl_payment_date;
					$fd["bid"] = $row_pl->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pl->PayMode;
					$fd["amount"] = $row_pl->Book_FormCharges;
					$fd["particulars"] = "BOOKS AND FORMS";
					$fd["paid"] = 1;
					$fd["tran_table"] = 30; // tran table
					$fd["tran_id"] = $row_pl->pl_payment_id;
					$fd["created_by"] = $row_pl->CreadtedBY;
					$fd["SubLedgerId"] = 90; // BOOKS AND FORMS
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (BOOKS AND FORMS)******************/
				/******************** ALL CHARGES (C CLASS SUSPEND SHARE CAPITAL - 1st)******************/
				if(!empty($row_pl->AjustmentCharges)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_pl->pl_payment_date;
					$fd["bid"] = $row_pl->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pl->PayMode;
					$fd["amount"] = $row_pl->AjustmentCharges; // 1st
					$fd["particulars"] = "C CLASS SUSPEND SHARE CAPITAL";
					$fd["paid"] = 1;
					$fd["tran_table"] = 30; // tran table
					$fd["tran_id"] = $row_pl->pl_payment_id;
					$fd["created_by"] = $row_pl->CreadtedBY;
					$fd["SubLedgerId"] = 59; // C CLASS SUSPEND SHARE CAPITAL
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (C CLASS SUSPEND SHARE CAPITAL - 1st)******************/
				/******************** ALL CHARGES (C CLASS SUSPEND SHARE CAPITAL - 2nd)******************/
				if(!empty($row_pl->ShareCharges)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_pl->pl_payment_date;
					$fd["bid"] = $row_pl->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pl->PayMode;
					$fd["amount"] = $row_pl->ShareCharges; // 2nd
					$fd["particulars"] = "C CLASS SUSPEND SHARE CAPITAL";
					$fd["paid"] = 1;
					$fd["tran_table"] = 30; // tran table
					$fd["tran_id"] = $row_pl->pl_payment_id;
					$fd["created_by"] = $row_pl->CreadtedBY;
					$fd["SubLedgerId"] = 59; // C CLASS SUSPEND SHARE CAPITAL
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (C CLASS SUSPEND SHARE CAPITAL - 2nd)******************/
				/******************** ALL CHARGES (INSURANCE)******************/
				if(!empty($row_pl->Insurance)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_pl->pl_payment_date;
					$fd["bid"] = $row_pl->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pl->PayMode;
					$fd["amount"] = $row_pl->Insurance; // 2nd
					$fd["particulars"] = "INSURANCE";
					$fd["paid"] = 1;
					$fd["tran_table"] = 30; // tran table
					$fd["tran_id"] = $row_pl->pl_payment_id;
					$fd["created_by"] = $row_pl->CreadtedBY;
					$fd["SubLedgerId"] = 93; // INSURANCE
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (INSURANCE)******************/
			}
			echo "<br />\n---------------------------";
		}

		public function pg_prewith_charges_to_all_charges($data)
		{
			//PG PREWITHDRAWAL CHARGE FROM  pigmi_prewithdrawal TABLE to all_charges
			$from_date = $data["from_date"];
			$date_field = "PayAmountReport_PayDate";
			$sa = array( //select array	
				"pigmi_prewithdrawal.PgmPrewithdraw_ID", // pigmi_prewithdrawal
				"pigmi_prewithdrawal.PigmiAcc_No",
				"pigmi_prewithdrawal.Withdraw_Date",
				"pigmi_prewithdrawal.Deduct_Commission",
				"pigmi_prewithdrawal.Deduct_Amount",
				"pigmi_payamount.PayId", // pigmi_payamount
				"pigmi_payamount.PayAmountReport_PayDate", 
				"pigmi_payamount.PayAmount_PaymentMode",
				"pigmiallocation.Bid",  // pigmiallocation
			);
			$data = DB::table("pigmi_prewithdrawal")
				->select($sa)
				->leftJoin("pigmi_payamount","pigmi_payamount.PayAmount_PigmiAccNum","=","pigmi_prewithdrawal.PigmiAcc_No")
				->leftJoin("pigmiallocation","pigmiallocation.PigmiAcc_No","=","pigmi_prewithdrawal.PigmiAcc_No")
				->where($date_field,">=",$from_date)
				->groupBy("pigmi_prewithdrawal.PigmiAcc_No")
				// ->orderBy("PgmPrewithdraw_ID", "desc")
				// ->limit(10)
				->get();
			
			// print_r($data);

			foreach($data as $key_pgpre => $row_pgpre) {
				echo "<br />\n";
				echo "pigmi_prewithdrawal(id:{$row_pgpre->PgmPrewithdraw_ID}) ";
				$ft = "pigmi_prewithdrawal"; // FROM TABLE
				$fid  = $row_pgpre->PgmPrewithdraw_ID; // FROM ID
				// print_r($row_pgpre);continue;

				
				if(!empty($row_pgpre->PayId)) {
					$temp_tran_table = 28; // pigmi_payamount
					$temp_tran_id = $row_pgpre->PayId;
					$temp_date = $row_pgpre->PayAmountReport_PayDate;
				} else {
					$temp_tran_table = 31; // pigmi_prewithdrawal
					$temp_tran_id = $row_pgpre->PgmPrewithdraw_ID;
					$temp_date = $row_pgpre->Withdraw_Date;
				}

				/************** CHECK FOR EXISTING ENTRIES *********************/
				/* 	$existing_entries = DB::table("all_charges")
						->where("SubLedgerId",)
						->where("tran_table",)
						->where("tran_id",$row_->)
						->where("deleted",0)
						->get(); */
				$tt = $temp_tran_table; // tt - tran table
				$tid = $temp_tran_id; // tid - tran id
				$existing_entries = DB::table("all_charges")
					->where("tran_table",$tt)
					->where("tran_id",$tid)
					->where("deleted",0)
					->where("tran_table","!=","")
					->where("tran_table","!=",0)
					->where("tran_id","!=",0)
					->get();
				if(count($existing_entries) > 0) {
					// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
					echo "EXISTS(ft:{$ft}, fid:{$fid})";
					continue;
				}
				/************** CHECK FOR EXISTING ENTRIES *********************/

				/******************** ALL CHARGES (OTHER INCOME)******************/
				if(!empty($row_pgpre->Deduct_Amount)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $temp_date;
					$fd["bid"] = $row_pgpre->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pgpre->PayAmount_PaymentMode;
					$fd["amount"] = $row_pgpre->Deduct_Amount;
					$fd["particulars"] = "OTHER INCOME";
					$fd["paid"] = 1;
					$fd["tran_table"] = $temp_tran_table; // tran table
					$fd["tran_id"] = $temp_tran_id;
					$fd["created_by"] = 0;
					$fd["SubLedgerId"] = 88; // OTHER INCOME
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (OTHER INCOME)******************/
				/******************** ALL CHARGES (PIGMY COMMISSION)******************/
				if(!empty($row_pgpre->Deduct_Commission)) { // SKIP 0 AMT
					if(!empty($row_pgpre->PayId)) {
						$temp_tran_table = 28; // pigmi_payamount
						$temp_tran_id = $row_pgpre->PayId;
						$temp_date = $row_pgpre->PayAmountReport_PayDate;
					} else {
						$temp_tran_table = 31; // pigmi_prewithdrawal
						$temp_tran_id = $row_pgpre->PgmPrewithdraw_ID;
						$temp_date = $row_pgpre->Withdraw_Date;
					}
					unset($fd);
					$fd["date"] = $temp_date;
					$fd["bid"] = $row_pgpre->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_pgpre->PayAmount_PaymentMode;
					$fd["amount"] = $row_pgpre->Deduct_Commission;
					$fd["particulars"] = "PIGMY COMMISSION";
					$fd["paid"] = 1;
					$fd["tran_table"] = $temp_tran_table; // tran table
					$fd["tran_id"] = $temp_tran_id;
					$fd["created_by"] = 0;
					$fd["SubLedgerId"] = 82; // PIGMY COMMISSION
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (PIGMY COMMISSION)******************/
			}
			echo "<br />\n---------------------------";
		}

		public function rd_prewith_charges_to_all_charges($data)
		{
			//RD PREWITHDRAWAL CHARGE FROM  rd_prewithdrawal TABLE to all_charges
			$from_date = $data["from_date"];
			$date_field = "RDPayAmtReport_PayDate";
			$sa = array( //select array	
				"rd_prewithdrawal.RdPrewithdraw_ID", // rd_prewithdrawal
				"rd_prewithdrawal.RdAcc_No",
				"rd_prewithdrawal.Withdraw_Date",
				"rd_prewithdrawal.Deduct_Amt",
				"rd_payamount.RDPayId", // rd_payamount
				"rd_payamount.RDPayAmtReport_PayDate", 
				"rd_payamount.RDPayAmt_PaymentMode",
				"createaccount.Bid",  // createaccount
			);
			$data = DB::table("rd_prewithdrawal")
				// ->select($sa)
				->leftJoin("rd_payamount","rd_payamount.RDPayAmt_AccNum","=","rd_prewithdrawal.RdAcc_No")
				->leftJoin("createaccount","createaccount.AccNum","=","rd_prewithdrawal.RdAcc_No")
				->where($date_field,">=",$from_date)
				->groupBy("rd_prewithdrawal.RdAcc_No")
				// ->orderBy("RdPrewithdraw_ID", "desc")
				// ->limit(10)
				->get();
			
			// print_r($data);

			foreach($data as $key_rdpre => $row_rdpre) {
				echo "<br />\n";
				echo "rd_prewithdrawal(id:{$row_rdpre->RdPrewithdraw_ID}) ";
				$ft = "rd_prewithdrawal"; // FROM TABLE
				$fid  = $row_rdpre->RdPrewithdraw_ID; // FROM ID
				// print_r($row_rdpre);

				
				if(!empty($row_rdpre->RDPayId)) {
					$temp_tran_table = 33; // rd_payamount
					$temp_tran_id = $row_rdpre->RDPayId;
					$temp_date = $row_rdpre->RDPayAmtReport_PayDate;
				} else {
					$temp_tran_table = 32; // rd_prewithdrawal
					$temp_tran_id = $row_rdpre->RdPrewithdraw_ID;
					$temp_date = $row_rdpre->Withdraw_Date;
				}

				/************** CHECK FOR EXISTING ENTRIES *********************/
				/* 	$existing_entries = DB::table("all_charges")
						->where("SubLedgerId",)
						->where("tran_table",)
						->where("tran_id",$row_->)
						->where("deleted",0)
						->get(); */
				$tt = $temp_tran_table; // tt - tran table
				$tid = $temp_tran_id; // tid - tran id
				$existing_entries = DB::table("all_charges")
					->where("tran_table",$tt)
					->where("tran_id",$tid)
					->where("deleted",0)
					->where("tran_table","!=","")
					->where("tran_table","!=",0)
					->where("tran_id","!=",0)
					->get();
				if(count($existing_entries) > 0) {
					// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
					echo "EXISTS(ft:{$ft}, fid:{$fid})";
					continue;
				}
				/************** CHECK FOR EXISTING ENTRIES *********************/

				/******************** ALL CHARGES (OTHER INCOME)******************/

				if(!empty($row_rdpre->Deduct_Amt)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $temp_date;
					$fd["bid"] = $row_rdpre->Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_rdpre->RDPayAmt_PaymentMode;
					$fd["amount"] = $row_rdpre->Deduct_Amt;
					$fd["particulars"] = "OTHER INCOME";
					$fd["paid"] = 1;
					$fd["tran_table"] = $temp_tran_table; // tran table
					$fd["tran_id"] = $temp_tran_id;
					$fd["created_by"] = 0;
					$fd["SubLedgerId"] = 88; // OTHER INCOME
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (OTHER INCOME)******************/
			}
			echo "<br />\n---------------------------";
		}

		public function jl_charges_to_all_charges($data)
		{
			// JL ALLOCATION CHARGE FROM  jewelloan_allocation TABLE to all_charges
			$from_date = $data["from_date"];
			$date_field = "JewelLoan_StartDate";
			$sa = array(
				"JewelLoanId",
				"JewelLoan_Bid",
				"JewelLoan_SaraparaCharge",
				"JewelLoan_InsuranceCharge",
				"JewelLoan_BookAndFormCharge",
				"JewelLoan_OtherCharge",
				"JewelLoan_StartDate",
				"JewelLoan_PaymentMode",
				"JewelLoan_CreatedBy"
			);

			$data = DB::table("jewelloan_allocation")
				->select($sa)
				->where($date_field,">=",$from_date)
				// ->orderBy("jewelloan_allocation.JewelLoanId", "desc")
				// ->limit(10)
				->get();

			// print_r($data);

			foreach($data as $key_jl => $row_jl) {
				echo "<br />\n";
				echo "jewelloan_allocation(id:{$row_jl->JewelLoanId}) ";
				$ft = "jewelloan_allocation"; // FROM TABLE
				$fid  = $row_jl->JewelLoanId; // FROM ID
				// print_r($row_jl);


				/************** CHECK FOR EXISTING ENTRIES *********************/
				/* 	$existing_entries = DB::table("all_charges")
						->where("SubLedgerId",)
						->where("tran_table",)
						->where("tran_id",$row_->)
						->where("deleted",0)
						->get(); */
				$tt = 35; // tt - tran table
				$tid = $row_jl->JewelLoanId; // tid - tran id
				$existing_entries = DB::table("all_charges")
					->where("tran_table",$tt)
					->where("tran_id",$tid)
					->where("deleted",0)
					->where("tran_table","!=","")
					->where("tran_table","!=",0)
					->where("tran_id","!=",0)
					->get();
					if(count($existing_entries) > 0) {
						// echo "EXISTS(subhead:{$row_ct->subhead}, table:{$temp_tran_table}, tran_id:{$temp_tran_id})";
						echo "EXISTS(ft:{$ft}, fid:{$fid})";
						continue;
					}
				/************** CHECK FOR EXISTING ENTRIES *********************/
				/******************** ALL CHARGES (APPRAISER COMMISSION)******************/
				if(!empty($row_jl->JewelLoan_SaraparaCharge)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_jl->JewelLoan_StartDate;
					$fd["bid"] = $row_jl->JewelLoan_Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_jl->JewelLoan_PaymentMode;
					$fd["amount"] = $row_jl->JewelLoan_SaraparaCharge;
					$fd["particulars"] = "APPRAISER COMMISSION";
					$fd["paid"] = 1;
					$fd["tran_table"] = 35; // tran table
					$fd["tran_id"] = $row_jl->JewelLoanId;
					$fd["created_by"] = $row_jl->JewelLoan_CreatedBy;
					$fd["SubLedgerId"] = 66; // APPRAISER COMMISSION
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (APPRAISER COMMISSION)******************/
				/******************** ALL CHARGES (INSURANCE)******************/
				if(!empty($row_jl->JewelLoan_InsuranceCharge)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_jl->JewelLoan_StartDate;
					$fd["bid"] = $row_jl->JewelLoan_Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_jl->JewelLoan_PaymentMode;
					$fd["amount"] = $row_jl->JewelLoan_InsuranceCharge;
					$fd["particulars"] = "INSURANCE";
					$fd["paid"] = 1;
					$fd["tran_table"] = 35; // tran table
					$fd["tran_id"] = $row_jl->JewelLoanId;
					$fd["created_by"] = $row_jl->JewelLoan_CreatedBy;
					$fd["SubLedgerId"] = 93; // INSURANCE
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (INSURANCE)******************/
				/******************** ALL CHARGES (BOOKS AND FORMS)******************/
				if(!empty($row_jl->JewelLoan_BookAndFormCharge)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_jl->JewelLoan_StartDate;
					$fd["bid"] = $row_jl->JewelLoan_Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_jl->JewelLoan_PaymentMode;
					$fd["amount"] = $row_jl->JewelLoan_BookAndFormCharge;
					$fd["particulars"] = "BOOKS AND FORMS";
					$fd["paid"] = 1;
					$fd["tran_table"] = 35; // tran table
					$fd["tran_id"] = $row_jl->JewelLoanId;
					$fd["created_by"] = $row_jl->JewelLoan_CreatedBy;
					$fd["SubLedgerId"] = 90; // BOOKS AND FORMS
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (BOOKS AND FORMS)******************/
				/******************** ALL CHARGES (OTHER INCOME)******************/
				if(!empty($row_jl->JewelLoan_OtherCharge)) { // SKIP 0 AMT
					unset($fd);
					$fd["date"] = $row_jl->JewelLoan_StartDate;
					$fd["bid"] = $row_jl->JewelLoan_Bid;
					$fd["transaction_type"] = 2; // DEBIT
					$fd["payment_mode"] = $row_jl->JewelLoan_PaymentMode;
					$fd["amount"] = $row_jl->JewelLoan_OtherCharge;
					$fd["particulars"] = "OTHER INCOME";
					$fd["paid"] = 1;
					$fd["tran_table"] = 35; // tran table
					$fd["tran_id"] = $row_jl->JewelLoanId;
					$fd["created_by"] = $row_jl->JewelLoan_CreatedBy;
					$fd["SubLedgerId"] = 88; // OTHER INCOME
					$fd["deleted"] = 0;
					$fd["ft"] = $ft;//TEMPORARY
					$fd["fid"] = $fid;//TEMPORARY
					$this->all_ch->clear_row_data();
					$this->all_ch->set_row_data($fd);
					$insert_id_all_ch = $this->all_ch->insert_row();
					echo "DONE({$insert_id_all_ch})";
				} else { echo "amt 0";}
				/******************** ALL CHARGES (OTHER INCOME)******************/
			}
		}


		
	}