<?php
	
	namespace App\Http\Controllers;
	use File;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\salmodel;
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

		public function chq()
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


		
	}