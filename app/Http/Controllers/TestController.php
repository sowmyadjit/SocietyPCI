<?php
	
	namespace App\Http\Controllers;
	use File;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
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
		}
		
		public function test()
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
						print_r($tran_table);
						throw new Exception("{$tran_table} not found in cash_chitta_details table}");
					}
					
					$select_array = array(
											"{$ch_row->pk_field} as rv_transaction_id",
											// "{$ch_row->payment_mode_field} as rv_payment_mode",
											// "{$ch_row->transaction_type} as rv_transaction_type",
											"{$ch_row->date_field} as rv_date"
										);
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

					$table_data = DB::table("{$tran_table}")
						->select($select_array)
						->where("{$ch_row->date_field}","{$cal_day}")
						->where("{$ch_row->bid_field}",$BID)
						->get();
						
					

					//continue;

					echo "<br />\n";
					echo $tran_table;
					echo "<br />\n";
					foreach($table_data as $table_row) {
						//print_r($table_row);exit();

						
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
		
	}