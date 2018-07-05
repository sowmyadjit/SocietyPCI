<?php

namespace App\Http\Model;

define("SUBHEAD_MATURITY_DEPOSIT",195);

define("ACCOUNT_TYPE_PIGMY",2);

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Model\OpenCloseModel;
use App\Http\Model\ReceiptVoucherModel;
use App\Http\Controllers\ReceiptVoucherController;
use App\Http\Model\SettingsModel;

class DepositModel extends Model
{
	protected $table = 'deposit';
	
	public function __construct() {
		$this->op = new OpenCloseModel;
		$this->rv_no = new ReceiptVoucherController;
		$this->settings = new SettingsModel;
	}
	
	public function insert($id)
    {
		$dte=date('d-m-Y');
		$dte1=date('Y-m-d');
		$bankID=$id['bank'];
		$amount1=$id['ta'];
		$bran=$id['branch'];
		$pay_mode=$id['paymode'];
		
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				//$UID=$uname->Uid;
				$BID=$uname->Bid;
		
		$id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>$dte1,'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$pay_mode,'Bid'=>$BID,"paid"=>"yes","Deposit_type"=>"Deposit"]);
		
			/***********/
			$fn_data["rv_payment_mode"] = $pay_mode;
			$fn_data["rv_transaction_id"] = $id;
			$fn_data["rv_transaction_type"] = "DEBIT";
			$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
			$fn_data["rv_date"] = $dte1;
			$fn_data["rv_bid"] = null;//BY DEFAULT LOGIN BRANCH ID
			$this->rv_no->save_rv_no($fn_data);
			unset($fn_data);
			/***********/
		
		$totamt=DB::table('addbank')->select('TotalAmt')
							->where('Bankid','=',$bankID)
							->first();
		$tt=$totamt->TotalAmt;
		$amt=$tt+$amount1;
		DB::table('addbank')->where('Bankid','=',$bankID)
		                       ->update(['TotalAmt'=>$amt]);
							   
		if($pay_mode=="inhand")
		{
			
		$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
		$inhandcash1=$inhandcashh->InHandCash;
		$x=$inhandcash1-$amount1;
		DB::table('cash')->where('BID','=',$BID)
						->update(['InHandCash'=>$x]);
		
		}			
	
		return $id;
	}
	public function Getbankdetail($q)
    {
		return DB::select("SELECT `Bankid` as id, CONCAT(`BankName`,'-',`AccountNo`) as name FROM `addbank` where `BankName` LIKE '%".$q."%' ");
		
	
	}
	
	public function GetBranchDropD()
    {

       $branch = DB::table('cash')->select('Branch','BID')->get();
        return $branch;
    }
	public function GetBankDetailForDeposite($id)
	{
		return $id=DB::table('addbank')
		->select('Branch','AddBank_IFSC','TotalAmt')
		->where('Bankid','=',$id)
		->first();
		
	}
	public function GetDepositData()
	{
		$id= DB::table('deposit')->select('d_id','depo_bank','Branch','amount','date','d_date','depo_bank_id','reason','pay_mode','cheque_no','cheque_date','bank_name','paid','cd')
		->get();
		
		
		return $id;
	}
	public function crateaddeposittobranch($id)
    {   $dte=date('d-m-Y');
		$bankID=$id['bank'];
		$amount1=$id['ta'];
		$bran=$id['branch'];
		if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$BID=$uname->Bid;
		$tran_id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>date('Y-m-d'),'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$id['paymode'],'Bid'=>$BID,'Deposit_type'=>"WITHDRAWL","paid"=>"yes"]);
		
			/***********/
			$fn_data["rv_payment_mode"] = $id['paymode'];
			$fn_data["rv_transaction_id"] = $tran_id;
			$fn_data["rv_transaction_type"] = "CREDIT";
			$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
			$fn_data["rv_date"] = date('Y-m-d');
			$fn_data["rv_bid"] = null;
			$this->rv_no->save_rv_no($fn_data);
			unset($fn_data);
			/***********/
			
		$totamt=DB::table('addbank')->select('TotalAmt')
							->where('Bankid','=',$bankID)
							->first();
		$tt=$totamt->TotalAmt;
		$amt=$tt-$amount1;
		DB::table('addbank')->where('Bankid','=',$bankID)
		                       ->update(['TotalAmt'=>$amt]);
							   
		$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
		$inhandcash1=$inhandcashh->InHandCash;
		$x=$inhandcash1+$amount1;
		DB::table('cash')->where('BID','=',$BID)
						->update(['InHandCash'=>$x]);
		
						
	
		return $tran_id;
	}
	
		public function deposit_account_list_pg($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data['deposit_details'] = array();
			$ret_data['deposit_category'] = $data["category"];
			$table = "pigmiallocation";
			$closed_field = "Closed";
			$agent_id_field = "Agentid";
			$branch_id_field = "{$table}.Bid";
			$user_id_field = "{$table}.UID";
			$allocation_id_field = "{$table}.PigmiAllocID";
			$select_array = array(
									"{$table}.PigmiAllocID as allocation_id",
									"{$table}.PigmiAcc_No as account_no",
									"{$table}.old_pigmiaccno as old_account_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.Total_Amount as total_amount",
									"{$table}.AllocationDate as allocation_date",
									"{$table}.StartDate as start_date",
									"{$table}.EndDate as end_date",
									"{$table}.Closed as closed",
									"pigmitype.Pigmi_Type as pigmy_type"
								);
			$deposit_account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$user_id_field}")
				->join("pigmitype","pigmitype.PigmiTypeid","=","{$table}.PigmiTypeid")
				->where("{$table}.Status","AUTHORISED");
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$deposit_account_list = $deposit_account_list->where($branch_id_field,"=",$BID);
				}
			if(!empty($data['allocation_id'])) {
				$deposit_account_list = $deposit_account_list->where($allocation_id_field,'=',$data['allocation_id']);
			} else {
				$deposit_account_list = $deposit_account_list->where($closed_field,"=",$data['closed']);
				$deposit_account_list = $deposit_account_list->where($agent_id_field,"=",$data['agent_id']);
			}
			//$deposit_account_list = $deposit_account_list->limit(1);
			if(!empty($data["skip"])) {
				$deposit_account_list = $deposit_account_list->skip($data["skip"]);
			}
			if(!empty($data["limit"])) {
				$deposit_account_list = $deposit_account_list->limit($data["limit"]);
			}
										//->skip(1)
										//->limit(10)
			$deposit_account_list = $deposit_account_list->get();
				
			if(empty($deposit_account_list)) {
				return $ret_data;
			}
			
			$i = -1;
			foreach($deposit_account_list as $row) {
				$ret_data['deposit_details'][++$i]['allocation_id'] = $row->allocation_id;
				$ret_data['deposit_details'][$i]['account_no'] = $row->account_no;
				$ret_data['deposit_details'][$i]['old_account_no'] = $row->old_account_no;
				$ret_data['deposit_details'][$i]['user_id'] = $row->user_id;
				$ret_data['deposit_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['deposit_details'][$i]['total_amount'] = $this->get_pigmy_account_balance(["allocation_id"=>$row->allocation_id]);//$row->total_amount;
				$ret_data['deposit_details'][$i]['allocation_date'] = $row->allocation_date;
				$ret_data['deposit_details'][$i]['start_date'] = $row->start_date;
				$ret_data['deposit_details'][$i]['end_date'] = $row->end_date;
				$ret_data['deposit_details'][$i]['closed'] = $row->closed;
				$ret_data['deposit_details'][$i]['pigmy_type'] = $row->pigmy_type;
			}
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function deposit_account_edit_pg($data)
		{
			$table = "pigmiallocation";
			$allocation_id_field = "{$table}.PigmiAllocID";
			$closed_field = "Closed";
			
			$update_array = array(
										"{$closed_field}"=>$data["closed"]
								);
			
			DB::table($table)
				->where($allocation_id_field,'=',$data['allocation_id'])
				->update($update_array);
		}
		
		public function deposit_account_list_fd($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data['deposit_details'] = array();
			$ret_data['deposit_category'] = $data["category"];
			$table = "fdallocation";
			$closed_field = "Closed";
			$branch_id_field = "{$table}.Bid";
			$user_id_field = "{$table}.Uid";
			$allocation_id_field = "{$table}.Fdid";
			$select_array = array(
									"{$table}.Fdid as allocation_id",
									"{$table}.Fd_CertificateNum as account_no",
									"{$table}.Fd_OldCertificateNum as old_account_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.Fd_DepositAmt as total_amount",
									"{$table}.FdReport_StartDate as allocation_date",
									"{$table}.FdReport_StartDate as start_date",
									"{$table}.FdReport_MatureDate as end_date",
									"{$table}.Closed as closed",
									"{$table}.Days as days",
									"{$table}.Fd_TotalAmt as maturity_amount",
									"{$table}.Fd_Remarks as remarks",
									"fdtype.FdInterest as interest_rate"
								);
								
			$deposit_account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$user_id_field}")
				->join("fdtype","fdtype.FdTid","=","{$table}.FdTid");
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$deposit_account_list = $deposit_account_list->where($branch_id_field,"=",$BID);
				}
			if($data["category"] == "FD") {//FD
				$deposit_account_list = $deposit_account_list->where("fdtype.FdTid","!=",1);
			} else {//KCC
				$deposit_account_list = $deposit_account_list->where("fdtype.FdTid","=",1);
			}
			if(!empty($data['allocation_id'])) {
				$deposit_account_list = $deposit_account_list->where($allocation_id_field,'=',$data['allocation_id']);
			} else {
				$deposit_account_list = $deposit_account_list->where($closed_field,"=",$data['closed']);
			}
			$deposit_account_list = $deposit_account_list//->limit(1)
										->get();
				
			if(empty($deposit_account_list)) {
				return $ret_data;
			}
			
			$i = -1;
			foreach($deposit_account_list as $row) {
				$ret_data['deposit_details'][++$i]['allocation_id'] = $row->allocation_id;
				$ret_data['deposit_details'][$i]['account_no'] = $row->account_no;
				$ret_data['deposit_details'][$i]['old_account_no'] = $row->old_account_no;
				$ret_data['deposit_details'][$i]['user_id'] = $row->user_id;
				$ret_data['deposit_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['deposit_details'][$i]['total_amount'] = $row->total_amount;
				$ret_data['deposit_details'][$i]['allocation_date'] = $row->allocation_date;
				$ret_data['deposit_details'][$i]['start_date'] = $row->start_date;
				$ret_data['deposit_details'][$i]['end_date'] = $row->end_date;
				$ret_data['deposit_details'][$i]['closed'] = $row->closed;
				$ret_data['deposit_details'][$i]['days'] = $row->days;
				$ret_data['deposit_details'][$i]['maturity_amount'] = $row->maturity_amount;
				$ret_data['deposit_details'][$i]['remarks'] = $row->remarks;
				$ret_data['deposit_details'][$i]['interest_rate'] = $row->interest_rate;
			}
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function deposit_account_list_md($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			if(strcasecmp($data["closed"],"YES") == 0) {
				$data["closed"] = 1;
			} else {
				$data["closed"] = 0;
			}
			$ret_data['deposit_details'] = array();
			$ret_data['deposit_category'] = $data["category"];
			$ret_data['deposit_closed'] = $data["closed"];
			$ret_data['day_open_status'] = $this->op->check_day_open(["date"=>date("Y-m-d")]);
			$table = "maturity_deposit";
			$deleted_field = "deleted";
			$closed_field = "md_closed";
			$branch_id_field = "{$table}.bid";
			$user_id_field = "{$table}.uid";
			$allocation_id_field = "{$table}.md_id";
			$select_array = array(
									"{$table}.md_id as allocation_id",
									"{$table}.md_acc_no as account_no",
									"{$table}.md_old_acc_no as old_account_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.md_closed as closed",
									"{$table}.md_amount as maturity_amount"
								);
								
			$deposit_account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$user_id_field}")
				->where($deleted_field,"=",0);
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$deposit_account_list = $deposit_account_list->where($branch_id_field,"=",$BID);
				}
			if(!empty($data['allocation_id'])) {
				$deposit_account_list = $deposit_account_list->where($allocation_id_field,'=',$data['allocation_id']);
			} else {
				$deposit_account_list = $deposit_account_list->where($closed_field,"=",$data["closed"]);
			}
			$deposit_account_list = $deposit_account_list//->limit(1)
										->get();
				
			if(empty($deposit_account_list)) {
				return $ret_data;
			}
			
			$i = -1;
			foreach($deposit_account_list as $row) {
				$ret_data['deposit_details'][++$i]['allocation_id'] = $row->allocation_id;
				$ret_data['deposit_details'][$i]['account_no'] = $row->account_no;
				$ret_data['deposit_details'][$i]['old_account_no'] = $row->old_account_no;
				$ret_data['deposit_details'][$i]['user_id'] = $row->user_id;
				$ret_data['deposit_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['deposit_details'][$i]['maturity_amount'] = $row->maturity_amount;
				$ret_data['deposit_details'][$i]['closed'] = $row->closed;
				$ret_data['deposit_details'][$i]['account_type'] = "MD";
			}
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function maturity_amount_pay_form($data)
		{
			$ret_data = [];
			
			$table = "maturity_deposit";
			$allocation_id_field = "md_id";
			$select_array = array(
									"md_id",
									"md_acc_no",
									"md_amount"
								);
			
			$ret_data = DB::table($table)
				->select($select_array)
				->where($allocation_id_field,"=",$data["allocation_id"])
				->first();
				
			return $ret_data;
		}
		
		public function deposit_account_edit_fd($data)
		{
			$table = "fdallocation";
			$allocation_id_field = "{$table}.Fdid";
			$closed_field = "Closed";
			
			$update_array = array(
										"{$closed_field}"=>$data["closed"]
								);
			
			DB::table($table)
				->where($allocation_id_field,'=',$data['allocation_id'])
				->update($update_array);
		}
		
		public function get_pigmy_account_balance($data)
		{
			$table = "pigmiallocation";
			$allocation_id_field = "PigmiAllocID";
			$total_amount_field = "Total_Amount";
			
			$total_amount = DB::table($table)
				->where($allocation_id_field,"=",$data["allocation_id"])
				->value($total_amount_field);
				
			$total_service_charge_amount = $this->total_service_charge_amount($data);
			
			$current_balance = $total_amount - $total_service_charge_amount;
			return ($current_balance < 0)? 0 : $current_balance;
		}
		
/*		public function total_service_charge_amount($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$table = "service_charge";
			$account_type_field = "acc_type";
			$allocation_id_field = "acc_id";
			$branch_id_field = "bid";
			$service_charge_amount_field = "service_charge_amount";
			$deleted_field = "deleted";
			$paid_state = "charge_collected";
			
			return DB::table($table)
				->where($account_type_field,"=",ACCOUNT_TYPE_PIGMY)
				->where($allocation_id_field,"=",$data["allocation_id"])
				->where($branch_id_field,"=",$BID)
				->where($deleted_field,"=",0)
				->where($paid_state,"=",0)
				->sum($service_charge_amount_field);
		}*/
		
		public function total_service_charge_amount($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			return DB::table("pigmi_transaction")
				->where("PigmiAllocID","=",$data["allocation_id"])
				->where("Bid","=",$BID)
				->where("tran_reversed","=","NO")
				->where("service_charge","=",1)
				->where("PigReport_TranDate",">","2018-01-01")
				->sum("Amount");
		}
		
		public function maturity_amt_create($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$tran_date_str = date("Y-m-d",strtotime($data["tran_date"]));
			$cheque_date_str = date("Y-m-d",strtotime($data["cheque_date"]));
			$tran_date = strtotime($tran_date_str);
			$old_tran = false;
			if($tran_date_str != date("Y-m-d")) {
				$old_tran = true;
			}
			$voucher_no = "";
			switch($data["pay_mode"]) {
				case "CASH" : 
								if(!$old_tran) {
									$prev_amt = DB::table("cash")->where("BID",$BID)->value("InHandCash");
									$cur_amt = $prev_amt - $data["payable_amt"];
									DB::table("cash")->where("BID",$BID)->update(["InHandCash"=>$cur_amt]);
								}
								break;
				case "CHEQUE" : 
								if(!$old_tran) {
									$prev_amt = DB::table("addbank")->where("Bankid",$data["bank_id"])->value("TotalAmt");
									$cur_amt = $prev_amt - $data["payable_amt"];
									DB::table("addbank")->where("Bankid",$data["bank_id"])->update(["TotalAmt"=>$cur_amt]);
								}
								break;
				case "SB ACCOUNT" : 
								
								$table = "createaccount";
								$acc_no_field = "AccNum";
								$acc_id = DB::table($table)
									->where($acc_no_field,"=",$data["sb_acc_no"])
									->value("Accid");
								
								$table = "sb_transaction";
								$insert_array = array(
														"Accid"				=>	$acc_id,
														"AccTid"			=>	"1",
														"TransactionType"	=>	"CREDIT",
														"particulars"		=>	"MATURITY DEPOSIT PAYMENT",
														"Amount"			=>	$data["payable_amt"],
														//"CurrentBalance"	=>	"",
														"tran_Date"			=>	date("d-m-Y",$tran_date),
														"SBReport_TranDate"	=>	date("Y-m-d",$tran_date),
														"Time"				=>	date("Y-m-d H:i:s",$tran_date),
														"Month"				=>	date("d",$tran_date),
														"Year"				=>	date("Y",$tran_date),
														//"Total_Bal"			=>	"",
														"Bid"				=>	$BID,
														"Payment_Mode"		=>	"ADJUSTMENT",
														"CreatedBy"			=>	$UID,
														"tran_reversed"		=>	"no",
														"LedgerHeadId"		=>	38,
														"SubLedgerId"		=>	42
													);
								
								
								$sb_tran_id = DB::table($table)
									->insertGetId($insert_array);
								unset($insert_array);
								/***********/
								$fn_data["rv_payment_mode"] = "ADJUSTMENT";
								$fn_data["rv_transaction_id"] = $sb_tran_id;
								$fn_data["rv_transaction_type"] = "CREDIT";
								$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SB_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
								$fn_data["rv_date"] = date("Y-m-d",$tran_date);
								$this->rv_no->save_rv_no($fn_data);
								unset($fn_data);
								/***********/
								
								break;
			}
			
			$table = "md_transaction";
			$insert_array = array(
									"md_tran_date" => date("Y-m-d",$tran_date),
									"md_entry_time" => date("Y-m-d H:i:s"),
									"md_id" => $data["md_id"],
									"bid" => $BID,
									"payment_mode" => $data["pay_mode"],
									"md_amount" => $data["payable_amt"],
									"transaction_type" => DEBIT,
									"particulars" => "{$data["particulars"]}",
									"cheque_no" => $data["cheque_no"],
									"cheque_date" => $cheque_date_str,
									"bank_id" => $data["bank_id"],
									"voucher_no" => $voucher_no,
									"subhead_id" => SUBHEAD_MATURITY_DEPOSIT,
									"paid" => PAID,
									"deleted" => NOT_DELETED
								);
			
			$md_tran_id = DB::table($table)
				->insertGetId($insert_array);
				
				/***********/
				$fn_data["rv_payment_mode"] = $data["pay_mode"];
				$fn_data["rv_transaction_id"] = $md_tran_id;
				$fn_data["rv_transaction_type"] = "DEBIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::MD_TRAN;//constant MD_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = date("Y-m-d",$tran_date);
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
				
			$table = "maturity_deposit";
			$closed_field = "md_closed";
			DB::table($table)
				->where("md_id","=",$data["md_id"])
				->update([$closed_field=>1]);
		}
		
//COMPUSLORY DEPOSIT

		public function deposit_account_list_cd($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			if(strcasecmp($data["closed"],"YES") == 0) {
				$data["closed"] = 1;
			} else {
				$data["closed"] = 0;
			}
			$ret_data['deposit_details'] = array();
			$ret_data['deposit_category'] = $data["category"];
			$ret_data['deposit_closed'] = $data["closed"];
			$ret_data['day_open_status'] = $this->op->check_day_open(["date"=>date("Y-m-d")]);
			$table = "compulsory_deposit";
			$deleted_field = "deleted";
			$closed_field = "cd_closed";
			$user_type_field = "user_type";
			$branch_id_field = "{$table}.bid";
			$user_id_field = "{$table}.uid";
			$allocation_id_field = "{$table}.cd_id";
			$select_array = array(
									"{$table}.cd_id as allocation_id",
									"{$table}.cd_acc_no as account_no",
									"{$table}.cd_old_acc_no as old_account_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.cd_closed as closed",
									"{$table}.user_type as user_type"
								);
								
			$deposit_account_list = DB::table($table)
				->select($select_array)
				->join("user","user.Uid","=","{$user_id_field}")
				->where($deleted_field,"=",0);
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$deposit_account_list = $deposit_account_list->where($branch_id_field,"=",$BID);
				}
			if(!empty($data['allocation_id'])) {
				$deposit_account_list = $deposit_account_list->where($allocation_id_field,'=',$data['allocation_id']);
			} else {
				$deposit_account_list = $deposit_account_list->where($closed_field,"=",$data["closed"]);
				$deposit_account_list = $deposit_account_list->where($user_type_field,"=",$data["user_type"]);
			}
			$deposit_account_list = $deposit_account_list//->limit(1)
										->get();
				
			if(empty($deposit_account_list)) {
				return $ret_data;
			}
			
			$i = -1;
			foreach($deposit_account_list as $row) {
				$ret_data['deposit_details'][++$i]['allocation_id'] = $row->allocation_id;
				$ret_data['deposit_details'][$i]['account_no'] = $row->account_no;
				$ret_data['deposit_details'][$i]['old_account_no'] = $row->old_account_no;
				$ret_data['deposit_details'][$i]['user_id'] = $row->user_id;
				$ret_data['deposit_details'][$i]['name'] = "{$row->first_name} {$row->middle_name} {$row->last_name}";
				$ret_data['deposit_details'][$i]['amount'] = $this->get_cd_amount(["allocation_id"=>$row->allocation_id]);//calc dynami
				$ret_data['deposit_details'][$i]['closed'] = $row->closed;
				$ret_data['deposit_details'][$i]['account_type'] = $data["category"];
				switch($row->user_type) {
					case 1:
								$user_type = "EMPLOYEE";
								break;
					case 2:
								$user_type = "CUSTOMER";
								break;
					default :
								$user_type = "";
								break;
				}
				$ret_data['deposit_details'][$i]['user_type'] = $user_type;
			}
			//print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function cd_interest_calculatoin($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$today_date_str = date("Y-m-d",strtotime($data["date"]));
			$today_date = strtotime($today_date_str);
			
			//select non closed employee accounts whose interest is not calculated this year march 31
			$table = "compulsory_deposit";
			$deleted_field = "{$table}.deleted";
			$closed_field = "{$table}.cd_closed";
			$branch_id_field = "{$table}.bid";
			$select_array = array(
									"{$table}.cd_id"
								);
			$cd_list = DB::table($table)
				->select($select_array)
				->where($deleted_field,NOT_DELETED)
				->where($closed_field,NOT_CLOSED)
				->where($branch_id_field,$BID)
				->get();
			
			//calculate cd int
			$interest_rate = DB::table("company")->where("Cid",1)->value("cd_interest");
			foreach($cd_list as $row_cd_list) {
				$cd_amount = 
				
				
				// dump it to cd int table
			/*	$insert_array = array(
										"date"					=>	date("Y-m-d",$today_date),
										"cd_id"					=>	$row_cd_list->cd_id,
										"cd_amount"				=>	
										"cd_interest_rate"		=>	$interest_rate,
										"cd_interest_days"		=>	
										"cd_interest_amount"	=>	
										"paid_state"			=>	0,
										"deleted"				=>	0
									);**/
				DB::table("cd_interest")
					->insertGetId($insert_array);
			}
			
			
			return "done";
		}
		
		public function get_cd_amount($data)
		{
			$table = "cd_transaction";
			$allocation_id_field = "cd_id";
			$amount_field = "cd_amount";
			$deleted_field = "deleted";
			$transaction_type_field = "transaction_type";
			$paid_field = "paid";
			
			$credit_amount = DB::table($table)
				->where($allocation_id_field,$data["allocation_id"])
				->where($deleted_field,NOT_DELETED)
				->where($transaction_type_field,CREDIT)
				->where($paid_field,PAID)
				->sum($amount_field);
			
			$debit_amount = DB::table($table)
				->where($allocation_id_field,$data["allocation_id"])
				->where($deleted_field,NOT_DELETED)
				->where($transaction_type_field,DEBIT)
				->where($paid_field,PAID)
				->sum($amount_field);
				
			return $credit_amount - $debit_amount;
		}
		
	}
