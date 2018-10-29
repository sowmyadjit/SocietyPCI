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
use App\Http\Model\CDSDModel;
use App\Http\Model\CDSDTranModel;

class DepositModel extends Model
{
	protected $table = 'deposit';
	
	public function __construct() {
		$this->op = new OpenCloseModel;
		$this->rv_no = new ReceiptVoucherController;
		$this->settings = new SettingsModel;
		$this->cdsd = new CDSDModel;
		$this->cdsd_tran = new CDSDTranModel;
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
		/***************FETCH SUB HEAD ID OF BANK ************/
			$bank_id = $id['bank'];
			$dep_subhead_id = DB::table("addbank")->where("Bankid",$bank_id)->value("SubLedgerId");
		/***************FETCH HEAD ID OF BANK ************/
		
		$id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>$dte1,'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$pay_mode,'Bid'=>$BID,"paid"=>"yes","Deposit_type"=>"Deposit","SubLedgerId"=>$dep_subhead_id]);
		
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
		$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
		// return DB::select("SELECT `Bankid` as id, CONCAT(`BankName`,'-',`AccountNo`) as name FROM `addbank` where `BankName` LIKE '%".$q."%' ");
		return DB::select("SELECT `Bankid` as id, CONCAT(`BankName`,'-',`AccountNo`) as name FROM `addbank` where `addbank`.`Bid` = {$BID} AND `BankName` LIKE '%".$q."%' ");
		
	
	}

	public function GetBank_all_branch($q)
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
		$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
		$id= DB::table('deposit')
			->select('d_id','depo_bank','Branch','amount','date','d_date','depo_bank_id','reason','pay_mode','cheque_no','cheque_date','bank_name','paid','cd')
			->where("deposit.Bid", $BID)
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
		/***************FETCH SUB HEAD ID OF BANK ************/
			$bank_id = $id['bank'];
			$dep_subhead_id = DB::table("addbank")->where("Bankid",$bank_id)->value("SubLedgerId");
		/***************FETCH HEAD ID OF BANK ************/
		$tran_id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>date('Y-m-d'),'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$id['paymode'],'Bid'=>$BID,'Deposit_type'=>"WITHDRAWL","paid"=>"yes","SubLedgerId"=>$dep_subhead_id]);
		
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
									->where("createaccount.deleted",0)
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
								$user_type = "AGENT";
								break;
					case 3:
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
		
		
	//COMPUSLORY DEPOSIT
		public function deposit_account_list_sd($data)
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
			$table = "security_deposit";
			$deleted_field = "deleted";
			$closed_field = "sd_closed";
			$user_type_field = "user_type";
			$branch_id_field = "{$table}.bid";
			$user_id_field = "{$table}.uid";
			$allocation_id_field = "{$table}.sd_id";
			$select_array = array(
									"{$table}.sd_id as allocation_id",
									"{$table}.sd_acc_no as account_no",
									"{$table}.sd_old_acc_no as old_account_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$table}.sd_closed as closed",
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
				$ret_data['deposit_details'][$i]['amount'] = $this->get_sd_amount(["allocation_id"=>$row->allocation_id]);//calc dynami
				$ret_data['deposit_details'][$i]['closed'] = $row->closed;
				$ret_data['deposit_details'][$i]['account_type'] = $data["category"];
				switch($row->user_type) {
					case 1:
								$user_type = "EMPLOYEE";
								break;
					case 2:
								$user_type = "AGENT";
								break;
					case 3:
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
		
		public function get_sd_amount($data)
		{
			$table = "sd_transaction";
			$allocation_id_field = "sd_id";
			$amount_field = "sd_amount";
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
				// print_r($credit_amount);
			return $credit_amount - $debit_amount;
		}
		
		
	//CDSD
		public function deposit_account_list_cdsd($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			if(strcasecmp($data["closed"],"YES") == 0) {
				$data["closed"] = 1;
			} else {
				$data["closed"] = 0;
			}
			$ret_data["cdsd_type"] = $data["cdsd_type"];
			$ret_data['deposit_details'] = array();
			$ret_data['deposit_category'] = $data["category"];
			$ret_data['deposit_closed'] = $data["closed"];
			$ret_data['day_open_status'] = $this->op->check_day_open(["date"=>date("Y-m-d")]);
			$table = $this->cdsd->tbl;
			$deleted_field = $this->cdsd->deleted_field;
			$closed_field = $this->cdsd->cdsd_closed_field;
			$user_type_field = $this->cdsd->user_type_field;
			$branch_id_field = "{$this->cdsd->tbl}.{$this->cdsd->bid_field}";
			$user_id_field = "{$this->cdsd->tbl}.{$this->cdsd->uid_field}";
			$allocation_id_field = "{$this->cdsd->tbl}.{$this->cdsd->pk}";
			$select_array = array(
									"{$this->cdsd->tbl}.{$this->cdsd->pk} as allocation_id",
									"{$this->cdsd->tbl}.{$this->cdsd->cdsd_acc_no_field} as account_no",
									"{$this->cdsd->tbl}.{$this->cdsd->cdsd_oldacc_no_field} as old_account_no",
									"user.Uid as user_id",
									"user.FirstName as first_name",
									"user.MiddleName as middle_name",
									"user.LastName as last_name",
									"{$this->cdsd->tbl}.{$this->cdsd->cdsd_closed_field} as closed",
									"{$this->cdsd->tbl}.{$this->cdsd->user_type_field} as user_type",
									"{$this->cdsd->tbl}.{$this->cdsd->cdsd_start_date_field} as start_date",
									"{$this->cdsd->tbl}.{$this->cdsd->cdsd_close_date_field} as close_date",
									"createaccount.AccNum as sb_acc_no"
								);
								
			$deposit_account_list = DB::table($this->cdsd->tbl)
				->select($select_array)
				->join("user","user.Uid","=","{$user_id_field}")
				->leftJoin("createaccount","createaccount.Accid","=","cdsd_account.sb_acc_id")
				->where("createaccount.deleted",0)
				->where("cdsd_type","=",$data["cdsd_type"])
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
										->orderByRaw(" CAST(cdsd_oldacc_no AS DECIMAL(10,2)) ASC ")
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
				$ret_data['deposit_details'][$i]['name'] = strtoupper("{$row->first_name} {$row->middle_name} {$row->last_name}");
				$ret_data['deposit_details'][$i]['amount'] = $this->cdsd_tran->get_cdsd_amount(["cdsd_type"=>$data["cdsd_type"], "{$this->cdsd_tran->cdsd_id_field}"=>$row->allocation_id]);//calc dynami
				$ret_data['deposit_details'][$i]['closed'] = $row->closed;
				$ret_data['deposit_details'][$i]['account_type'] = $data["category"];
				$ret_data['deposit_details'][$i]['start_date'] = $row->start_date;
				$ret_data['deposit_details'][$i]['close_date'] = $row->close_date;
				$ret_data['deposit_details'][$i]['sb_acc_no'] = $row->sb_acc_no;
				switch($row->user_type) {
					case 1:
								$user_type = "EMPLOYEE";
								break;
					case 2:
								$user_type = "AGENT";
								break;
					case 3:
								$user_type = "CUSTOMER";
								break;
					default :
								$user_type = "";
								break;
				}
				$ret_data['deposit_details'][$i]['user_type'] = $user_type;
			}
			// print_r($ret_data);exit();
			return $ret_data;
		}

		public function cdsd_int_calc_all_acc($data)
		{
			$cdsd_type = $data["cdsd_type"];
			$user_type = $data["user_type"];
			$fn_data["user_type"] = $data["user_type"];
			//CALCULATE CDSD INTEREST
			// print_r($data);
			$int_till_date = $data["cdsd_int_calc_date"];
			$int_rate = $data["cdsd_int_rate"];
			$cdsd_acc_list = $this->get_live_cdsd_acc(["user_type"=>$user_type]);//GET ALL CDSD LIVE ACCOUNTS FOR INTEREST CALCULATION
			print_r($cdsd_acc_list);
			foreach($cdsd_acc_list as $row_acc) {
				//CALCULATE INTEREST FOR EACH ACCOUNT
				unset($fn_data);
				$fn_data["cdsd_type"] = $data["cdsd_type"];
				$fn_data["user_type"] = $user_type;
				$fn_data["cdsd_int_calc_date"] = $data["cdsd_int_calc_date"];
				$fn_data["cdsd_id"] = $row_acc->cdsd_id;
				$fn_data["cdsd_int_rate"] = $data["cdsd_int_rate"];
				if($cdsd_type == 2) {
					$interest_amt = $this->cdsd_int_calc($fn_data);
				} else {
					$interest_amt = $this->cd_int_calc($fn_data);
				}
			}
			return;
		}

		public function get_live_cdsd_acc($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data = [];
			$ret_data = DB::table("cdsd_account")
				->where("deleted",0)
				->where("bid",  $BID)
				->where("user_type",  $data["user_type"])
				->where("cdsd_closed", 0)
				->get();
			// print_r($ret_data);exit();
			return $ret_data;
		}

		public function cdsd_int_calc($data)
		{
			$cdsd_type = $data["cdsd_type"];
			$user_type = $data["user_type"];
			$last_int_calc_date_time = $this->get_last_int_calc_date_time([ "cdsd_type"=>$cdsd_type, "{$this->cdsd_tran->cdsd_id_field}"=>$data[$this->cdsd_tran->cdsd_id_field] ]);//GET DATE OF LAST INTEREST CALCULATION FOR THIS ACCOUNT
			$last_int_calc_date = $last_int_calc_date_time["last_int_calc_date"];
			$last_int_calc_time = $last_int_calc_date_time["last_int_calc_time"];
			$int_till_date = $data["cdsd_int_calc_date"];
			// echo "<br />\n";
			// echo "last_int_calc_date  = {$last_int_calc_date}";
			// echo "<br />\n";
			// echo "last_int_calc_time  = {$int_till_date}";
			$int_days_from_last_int_calc = $this->dateDiff(["first"=>$last_int_calc_date, "second"=>$int_till_date]);
			// echo "int_days  = {$int_days}";
			if($user_type == 1) {
				$include_tran_at_till_time  = true;
			} elseif($user_type == 2) {
				$include_tran_at_till_time = false;
			}
			$amt_till_last_int_calc_date_time = $this->cdsd_tran->get_cdsd_amount(["cdsd_type"=>$cdsd_type, "{$this->cdsd_tran->cdsd_id_field}"=>$data[$this->cdsd_tran->cdsd_id_field], "till_date"=>$last_int_calc_date, "till_time"=>$last_int_calc_time, "include_tran_at_till_time"=>$include_tran_at_till_time]);
			// echo "amt_till_last_int_calc_date_time  = {$amt_till_last_int_calc_date_time}";
			$cdsd_tran_after_last_int_calc_date = $this->get_cdsd_tran_after_last_int_calc_date(["cdsd_type"=>$cdsd_type,"{$this->cdsd_tran->cdsd_id_field}"=>$data[$this->cdsd_tran->cdsd_id_field],"last_tran_date"=>$last_int_calc_date, "last_tran_time"=>$last_int_calc_time]);
			
			//INTEREST CACULATION
			$total_int = 0;
			$int_for_amt_till_last_int_calc = ($amt_till_last_int_calc_date_time)*($int_days_from_last_int_calc/365)*($data["cdsd_int_rate"]/100);
			echo "{$amt_till_last_int_calc_date_time}*({$int_days_from_last_int_calc}/365)*({$data["cdsd_int_rate"]}/100)<br />\n";
			foreach($cdsd_tran_after_last_int_calc_date as $row_tran) {
				if($row_tran->transaction_type == 1) {
					$int_days = $this->dateDiff(["first"=>$row_tran->{$this->cdsd_tran->date_field}, "second"=>$int_till_date]);
					$tran_amt = $row_tran->{$this->cdsd_tran->amount_field};
					$int_amt = ($tran_amt)*($int_days/365)*($data["cdsd_int_rate"]/100);
					echo "{$tran_amt}*({$int_days}/365)*({$data["cdsd_int_rate"]}/100)<br />\n";
					$total_int += (float)$int_amt;
				} elseif($row_tran->transaction_type == 2) {
					$int_days = $this->dateDiff(["first"=>$row_tran->{$this->cdsd_tran->date_field}, "second"=>$int_till_date]);
					$tran_amt = $row_tran->{$this->cdsd_tran->amount_field};
					$int_amt = ($tran_amt)*($int_days/365)*($data["cdsd_int_rate"]/100);
					echo "-{$tran_amt}*({$int_days}/365)*({$data["cdsd_int_rate"]}/100)<br />\n";
					$total_int -= (float)$int_amt;
				}
			}
			$total_int += $int_for_amt_till_last_int_calc;
			$wn = (int)$total_int;
			$fn = $total_int - $wn;
			//	0 - 50 paise round to 0 paise
			//	51 - 99 paise round to 1 rupee
			if($fn == 0.5){
				$total_int -= 0.5;
			}
			$total_int = round($total_int,0);

			DB::table($this->cdsd->tbl)
				->where("cdsd_id", $data["cdsd_id"])
				->update(["int_prev"=>$total_int]);
			// print_r($total_int);
			return $total_int;
		}

		public function cd_int_calc($data)
		{
			$cdsd_type = $data["cdsd_type"];
			$user_type = $data["user_type"];

			$int_flag = true;
			
			unset($fd);
			$fd["cdsd_type"] = $cdsd_type;
			$fd["cdsd_id"] = $data["cdsd_id"];
			$amount = $this->cdsd_tran->get_cdsd_amount($fd);
			// var_dump($amount);

			$acc_info = $this->cdsd->get_row(["cdsd_type"=>$cdsd_type, "cdsd_id"=>$data["cdsd_id"] ]);
			// print_r($acc_info);

			$start_date = $acc_info->cdsd_start_date;
			$int_calc_date = $data["cdsd_int_calc_date"];
			$last_int_tran = $this->get_last_int_calc_date_time(["cdsd_type"=>$cdsd_type, "cdsd_id"=>$data["cdsd_id"]]);//
			$last_int_date = $last_int_tran["last_int_calc_date"];
			if($data["user_type"] == 3 /* || $data["user_type"] == 2*/) {	// for custoemrs 0 interest for 1st 6 years
				$y1 = date("Y",strtotime($start_date));
				$md1 = date("-m-d",strtotime($start_date));
				// var_dump($y1);
				$y2 = $y1 + 6;
				$date1 = $start_date;
				$date2 = "{$y2}{$md1}";
				// var_dump($date2);

				if($int_calc_date < $date2) {
					$int_flag = false;
				}
				// $start_date = $date2;	// start date for interest calc is from 6th year
				// $last_int_date = $date2;
			}
			if($int_flag) {
				$days = $this->dateDiff(["first"=>$last_int_date, "second"=>$int_calc_date]);
				$int_rate = $data["cdsd_int_rate"];
				$int = ($amount)*($days/365)*($int_rate/100);
				echo "<br />\n{$amount}*({$days}/365)*({$int_rate}/100)<br />\n";
			} else {
				$int = 0;
			}

			$wn = (int)$int;
			$fn = $int - $wn;
			//	0 - 50 paise round to 0 paise
			//	51 - 99 paise round to 1 rupee
			if($fn == 0.5){
				$int -= 0.5;
			}
			$int = round($int);

			DB::table($this->cdsd->tbl)
				->where("cdsd_id", $data["cdsd_id"])
				->update(["int_prev"=>$int]);
			// print_r($total_int);
			return $int;
		}

		public function get_last_int_calc_date_time($data)
		{
			$ret_data = [];

			$last_int_tran = DB::table($this->cdsd_tran->tbl)
				->where($this->cdsd_tran->cdsd_type_field,$data["cdsd_type"])
				->where($this->cdsd_tran->cdsd_id_field, $data[$this->cdsd_tran->cdsd_id_field])
				->where($this->cdsd_tran->interest_tran_field, 1)
				->orderBy($this->cdsd_tran->date_field, "desc")
				->orderBy($this->cdsd_tran->time_field, "desc")
				->first();
			$bal_cf_tran = DB::table($this->cdsd_tran->tbl)
				->where($this->cdsd_tran->cdsd_type_field,$data["cdsd_type"])
				->where($this->cdsd_tran->cdsd_id_field, $data[$this->cdsd_tran->cdsd_id_field])
				->where($this->cdsd_tran->interest_tran_field, 1)
				->where("bal_cf", 1)
				->orderBy($this->cdsd_tran->date_field, "asc")
				->orderBy($this->cdsd_tran->time_field, "asc")
				->first();

			$cdsd_acc_info = $this->cdsd->get_row([ "{$this->cdsd->pk}"=>$data[$this->cdsd->pk] ]);

			if(empty($last_int_tran) && empty($bal_cf_tran)) {
				$temp_date = $cdsd_acc_info->{$this->cdsd->cdsd_start_date_field};
				$temp_time = "00:00:00";
			} elseif(empty($last_int_tran) && !empty($bal_cf_tran)) {
				$temp_date = $bal_cf_tran->date;
				$temp_time = $bal_cf_tran->time;
			} elseif(!empty($last_int_tran) && empty($bal_cf_tran)) {
				$temp_date = $last_int_tran->date;
				$temp_time = $last_int_tran->time;
			} elseif(!empty($last_int_tran) && !empty($bal_cf_tran)) {
				if($last_int_tran->date > $bal_cf_tran->date) {
					$temp_date = $last_int_tran->date;
					$temp_time = $last_int_tran->time;
				} else {
					$temp_date = $bal_cf_tran->date;
					$temp_time = $bal_cf_tran->time;
				}
			}

			$ret_data["last_int_calc_date"] = $temp_date;
			$ret_data["last_int_calc_time"] = $temp_time;
			// print_r($ret_data);exit();
			return $ret_data;
		}
		
		public function dateDiff($data)
		{
			$first = $data['first'];
			$second = $data['second'];
			$first_date = date_create($first);
			$second_date = date_create($second);
			$diff = date_diff($first_date,$second_date);
			$diff_days = $diff->format('%a');
			$days = (int)$diff_days;
			
			// print_r($days);exit();
			return $days;
		}
		
		public function get_cdsd_tran_after_last_int_calc_date($data)
		{
			$ret_data = DB::table($this->cdsd_tran->tbl)
				->where($this->cdsd_tran->cdsd_id_field, $data[$this->cdsd_tran->cdsd_id_field])
				->where(function($query) use($data) {
					$query = $query->where($this->cdsd_tran->date_field,"=",$data["last_tran_date"])
						->where($this->cdsd_tran->time_field,">=",$data["last_tran_time"])
						->orWhere($this->cdsd_tran->date_field,">",$data["last_tran_date"]);
				})
				// ->where($this->cdsd_tran->date_field,">=",$data["last_tran_date"])
				// ->where("transaction_type", 1)
				// ->where("interest_tran", 0)
				->where($this->cdsd_tran->deleted_field, NOT_DELETED)
				->get();
			if(empty($ret_data)) {
				$ret_data = [];
			}
			// print_r($ret_data);
			return $ret_data;
		}
		
		public function cdsd_close($data)
		{

			DB::table("cdsd_account")
				->where("cdsd_id", $data["cdsd_id"])
				->update(["cdsd_closed"=>1,"cdsd_close_date"=>date("Y-m-d")]);
			
		}
		
		public function cdsd_create_int_tran($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			if($data["cdsd_type"] == 1) {
				$category = "CD";
				$temp_subhead_id = 105; //CD INTEREST
			} else {
				$category = "SD";
				$temp_subhead_id = 109; // SD INT PAID
			}

			if(isset($data["payment_mode"])) {
				$temp_payment_mode = $data["payment_mode"];
			} else {
				$temp_payment_mode = 2;
			}

			if(isset($data["closing_interest"])) {
				$closing_interest = $data["closing_interest"];
			} else {
				$closing_interest = "NO";
			}
			
			$cdsd_acc_info = $this->cdsd->get_row(["cdsd_id"=>$data["cdsd_id"]]);

			$sd_cr_id = DB::table("cdsd_transaction")
				->insertGetId(["cdsd_type"=>$cdsd_acc_info->cdsd_type, "cdsd_id"=>$cdsd_acc_info->cdsd_id, "date"=>date("Y-m-d"), "time"=>date("H:i:s"), "bid"=>$BID, "transaction_type"=>1, "amount"=>$cdsd_acc_info->int_prev, "paid"=>1, "payment_mode"=>$temp_payment_mode, "particulars"=>"{$category} INTEREST", "interest_tran"=>1, "subhead_id"=>$temp_subhead_id ]);

				/****** RV SD CREDIT *****/
				unset($fn_data);
				$fn_data["rv_payment_mode"] = "ADJUSTMENT";
				$fn_data["rv_transaction_id"] = $sd_cr_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::CDSD_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $data['date'];
				$fn_data["rv_bid"] = $cdsd_acc_info->bid;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/


			if(($data["cdsd_type"] == 2 && $data["user_type"] == 2) || ($data["cdsd_type"] == 1 && $data["user_type"] == 1)) {/*&& (strcasecmp($closing_interest, "YES") == 0)*/
				if($cdsd_acc_info->sb_acc_id > 0) {	//DEBITI ENTRY FOR SD ACCOUNT
					
					if($data["cdsd_type"] == 1) { // CD
						$temp_subhead_id = 44;
					} else { //SD
						switch($data["user_type"]) {
							case 1:
									$temp_subhead_id = 156;
									break;
							case 2:
									$temp_subhead_id = 283;
									break;
							case 3:
									$temp_subhead_id = 45;
									break;
							default:
									$temp_subhead_id = "";
						}
					}

					unset($fd);
					$fd["cdsd_id"] = $data["cdsd_id"];
					$fd["cdsd_type"] = $data["cdsd_type"];
					$fd["date"] = $data["date"];
					$fd["time"] = date("H:i:s");
					$fd["bid"] = $cdsd_acc_info->bid;
					$fd["transaction_type"] = 2;
					$fd["amount"] = $cdsd_acc_info->int_prev;
					$fd["paid"] = 1;
					$fd["payment_mode"] = 2;
					$fd["particulars"] = "TO ADJ SB";
					$fd["interest_tran"] = 3; //3 - TRANSFERING INTEREST
					// $fd["cheque_no"] = 
					// $fd["cheque_date"] = 
					// $fd["bank_id"] = 
					$fd["subhead_id"] = $temp_subhead_id; // SD INTEREST
					$fd["deleted"] = 0;
					$this->cdsd_tran->clear_row_data();
					$this->cdsd_tran->set_row_data($fd);
					$cdsd_db_id = $this->cdsd_tran->insert_row();
					/****** SD DEBIT *****/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $cdsd_db_id;
					$fn_data["rv_transaction_type"] = "DEBIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::CDSD_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = $data['date'];
					$fn_data["rv_bid"] = $cdsd_acc_info->bid;
					$this->rv_no->save_rv_no($fn_data);
					unset($fn_data);
					/***********/


					//sb acc info 
					$sb_acc_info = DB::table("createaccount")
						->where("Accid",$cdsd_acc_info->sb_acc_id)
						->first();

					//IF CURRENT BRANCH IS HO,  THEN ADD B2B TRAN  FROM HO TO BRANCH
					if($cdsd_acc_info->bid == 6) {
						
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

						unset($insert_array);
						$insert_array["Branch_Branch1_Id"] = $sb_acc_info->Bid;
						$insert_array["Branch_Branch2_Id"] = $cdsd_acc_info->bid;
						$insert_array["Branch_Tran_Date"] = $data["date"];
						$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
						$insert_array["LedgerHeadId"] = 296;
						$insert_array["SubLedgerId"] = $temp_subhead_id;
						$insert_array["Branch_Amount"] = $cdsd_acc_info->int_prev;
						$insert_array["Branch_per"] = "TO ADJ SB";

						$branch_to_branch_id = DB::table("branch_to_branch")
							->insertGetId($insert_array);
						//GENERATE ADJ NO. FOR H.O.
							/***********/
							unset($fn_data);
							$fn_data["rv_payment_mode"] = "ADJUSTMENT";
							$fn_data["rv_transaction_id"] = $branch_to_branch_id;
							$fn_data["rv_transaction_type"] = "DEBIT";
							$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
							$fn_data["rv_date"] = $data["date"];
							$fn_data["rv_bid"] = $sb_acc_info->Bid;
							$adj_no = $this->rv_no->save_rv_no($fn_data);
							// echo " adj no: {$adj_no}";
							/***********/
					}


					//CREDIT ENTRY FOR SB ACOUNT

					$ia_sb = array(
						"Accid"=>$cdsd_acc_info->sb_acc_id,
						"AccTid"=>1,
						"TransactionType"=>"CREDIT",
						"particulars"=>"TO ADJ SB",
						"Amount"=>$cdsd_acc_info->int_prev,
						"tran_Date"=>$data["date"],
						"SBReport_TranDate"=>$data["date"],
						"Time"=>date("Y-m-d H:i:s"),
						"Month"=>date("m",strtotime($data["date"])),
						"Year"=>date("Y",strtotime($data["date"])),
						"Bid"=>$sb_acc_info->Bid,
						"Payment_Mode"=>"ADJUSTMENT",
						"CreatedBy"=>$UID,
						"tran_reversed"=>"NO"
					);
					$sb_tran_id = DB::table("sb_transaction")
						->insertGetId($ia_sb);
					
					/****** SB CREDIT *****/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $sb_tran_id;
					$fn_data["rv_transaction_type"] = "CREDIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SB_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = $data['date'];
					$fn_data["rv_bid"] = $sb_acc_info->Bid;
					$this->rv_no->save_rv_no($fn_data);
					unset($fn_data);
					/***********/
				}
				
			}

			//RESTE INT PREV AMT
			DB::table("cdsd_account")
				->where("cdsd_id",$cdsd_acc_info->cdsd_id)
				->update(["int_prev"=>0]);
		}

		public function cdsd_close_interest($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			if($data["cdsd_type"] == 1) {
				$category = "CD";
			} else {
				$category = "SD";
			}
			
			$cdsd_acc_info = $this->cdsd->get_row(["cdsd_id"=>$data["cdsd_id"]]);

			$sd_cr_id = DB::table("cdsd_transaction")
				->insertGetId(["cdsd_type"=>$cdsd_acc_info->cdsd_type, "cdsd_id"=>$cdsd_acc_info->cdsd_id, "date"=>date("Y-m-d"), "time"=>date("H:i:s"), "bid"=>$BID, "transaction_type"=>1, "amount"=>$cdsd_acc_info->int_prev, "paid"=>1, "payment_mode"=>2, "particulars"=>"{$category} INTEREST", "interest_tran"=>1, "subhead_id"=>249 ]);

				/****** RV SD CREDIT *****/
				unset($fn_data);
				$fn_data["rv_payment_mode"] = "ADJUSTMENT";
				$fn_data["rv_transaction_id"] = $sd_cr_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::CDSD_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $data['date'];
				$fn_data["rv_bid"] = $cdsd_acc_info->bid;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
		}

		public function cdsd_pay_closing_int($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$cdsd_type = $data["cdsd_type"];
			$cdsd_id = $data["cdsd_id"];
			
			if($data["cdsd_type"] == 1) {
				$category = "CD";
			} else {
				$category = "SD";
			}

			if(isset($data["payment_mode"])) {
				$temp_payment_mode = $data["payment_mode"];
			} else {
				$temp_payment_mode = 2;
			}

			$cdsd_acc_info = $this->cdsd->get_row(["cdsd_type"=>$cdsd_type, "cdsd_id"=>$data["cdsd_id"]]);
			if($cdsd_acc_info->cdsd_type == 1) { // CD
				$temp_subhead_id = 105; // CD INT
			} else { // SD
				$temp_subhead_id = 109; // SD INT PAID
			}
		
				$sd_cr_id = DB::table("cdsd_transaction")
					->insertGetId(["cdsd_type"=>$cdsd_acc_info->cdsd_type, "cdsd_id"=>$cdsd_acc_info->cdsd_id, "date"=>date("Y-m-d"), "time"=>date("H:i:s"), "bid"=>$BID, "transaction_type"=>2, "amount"=>$cdsd_acc_info->int_prev, "paid"=>1, "payment_mode"=>$temp_payment_mode, "particulars"=>"{$category} INTEREST", "interest_tran"=>2, "subhead_id"=>$temp_subhead_id ]);
						
				/****** RV SD CREDIT *****/
				unset($fn_data);
				$fn_data["rv_payment_mode"] = "ADJUSTMENT";
				$fn_data["rv_transaction_id"] = $sd_cr_id;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::CDSD_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $data['date'];
				$fn_data["rv_bid"] = $cdsd_acc_info->bid;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/
			
			DB::table("cdsd_account")
				->where("cdsd_id", $data["cdsd_id"])
				->update(["int_prev"=>0]);
		
		}
		
		public function cdsd_int_remove($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$cdsd_acc_info = $this->cdsd->get_row(["cdsd_id"=>$data["cdsd_id"]]);

			DB::table("cdsd_account")
				->where("cdsd_id",$cdsd_acc_info->cdsd_id)
				->update(["int_prev"=>0]);
		}
		
		public function calculated_interest($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			$ret_data =  DB::table("cdsd_account")
				->join("user", "user.Uid", "=", "cdsd_account.uid")
				->where("deleted", 0)
				// ->where("cdsd_closed", 0)
				->where("cdsd_type", $data["cdsd_type"])
				->where("user_type", $data["user_type"])
				->where("cdsd_account.bid", $BID)
				->where("int_prev", ">", 0)
				->get();

			foreach($ret_data as $key=>$row) {
				switch($row->user_type) {
					case 1:
							$ret_data[$key]->user_type = "EMP";
							break;
					case 2:
							$ret_data[$key]->user_type = "AGENT";
							break;
					case 3:
							$ret_data[$key]->user_type = "CUSTOMER";
							break;
					default:
							$ret_data[$key]->user_type = "";
				}
			}
			// print_r($ret_data);
			return $ret_data;
		}
		
		public function cdsd_pay($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			// print_r($data);
			$cdsd_type = $data["cdsd_type"];
			if($cdsd_type == 1) {
				$category = "CD";
			} else {
				$category = "SD";
			}
			$acc_info = $this->cdsd->get_row(["cdsd_id"=>$data["cdsd_id"] ]);
			$balnce_amt = $this->cdsd_tran->get_cdsd_amount(["cdsd_id"=>$data["cdsd_id"], "cdsd_type"=>$cdsd_type ]);
			if(strcasecmp($data["pay_mode"], "CASH") == 0) {
				$temp_payment_mode = 1;
			} else {
				$temp_payment_mode = 2;
			}
			// if($data["pay_amt"] > $balnce_amt) {
			// 	return "amt is more than balance";
			// } else {
			// 	// $rem_amt = $balnce_amt - $data["pay_amt"];
			// }

			// $acc_info = $this->cdsd->get_row(["cdsd_type"=>$cdsd_type, "cdsd_id"=>$data["cdsd_id"] ]);
			unset($fd);
			$fd["cdsd_type"] = $cdsd_type;
			$fd["cdsd_id"] = $data["cdsd_id"];
			$amt = $this->cdsd_tran->get_cdsd_amount($fd);

			
			if($data["cdsd_type"] == 1) { //CD
				$temp_subhead_id = 44; //CD TRAN
			} else { //SD
				switch($acc_info->user_type) { // SD TRAN
					case 1:
							$temp_subhead_id = 156;
							break;
					case 2:
							$temp_subhead_id = 283;
							break;
					case 3:
							$temp_subhead_id = 45;
							break;
					default:
							$temp_subhead_id = "";
				}
			}


			DB::table("cdsd_transaction")
				->insertGetId(["cdsd_type"=>$data["cdsd_type"], "cdsd_id"=>$data["cdsd_id"], "date"=>$data["pay_date"], "time"=>date("H:i:s"), "bid"=>$BID, "transaction_type"=>2, "amount"=>$amt/*$data["pay_amt"]*/, "paid"=>1, "payment_mode"=>$temp_payment_mode, "particulars"=>"{$category} PAY", "interest_tran"=>0, "bal_cf"=>0, "bank_id"=>$data["bank"], "cheque_no"=>$data["cheque_no"], "cheque_date"=>$data["cheque_date"], 'subhead_id'=>$temp_subhead_id  ]);

			/* if(strcasecmp($data["pay_mode"], "SB") == 0) {
				$insert_array_sb = array(
					"Accid"=>$data["sb_acc_id"],
					"AccTid"=>1,
					"TransactionType"=>"CREDIT",
					"particulars"=>"SD PAY AMT",
					"Amount"=>$data["pay_amt"],
					"SBReport_TranDate"=>$data["pay_date"],
					"Time"=>date("Y-m-d H:i:s"),
					"Month"=>date("m",strtotime($data["pay_date"])),
					"Year"=>date("Y",strtotime($data["pay_date"])),
					"Bid"=>$BID,
					"Payment_Mode"=>"ADJUSTMENT",
					"CreatedBy"=>$UID,
					"tran_reversed"=>"NO"
				);
				DB::table("sb_transaction")
					->insertGetId($insert_array_sb);
			} */
			return;
		}

		public function get_cdsd_acc_info($data)
		{
			$ret_data = DB::table("cdsd_account")
				->join("user", "user.Uid","=","cdsd_account.uid")
				->where("cdsd_id", $data["cdsd_id"])
				->first();
			return $ret_data;
		}

		public function get_ho_acc_id($data)
		{
			$ret_data = DB::table("cdsd_account")
				->where("uid", $data["uid"])
				->where("deleted", 0)
				->where("bid", 6)
				->value("cdsd_id");
			return $ret_data;
		}

		public function cdsd_pay_cheque_entry($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$cdsd_type = $data["cdsd_type"];
			if($cdsd_type == 1) {
				$category = "CD";
			} else {
				$category = "SD";
			}

			/***************FETCH SUB HEAD ID OF BANK ************/
				$bank_id = $data["bank"];
				$dep_subhead_id = DB::table("addbank")->where("Bankid",$bank_id)->value("SubLedgerId");
			/***************FETCH HEAD ID OF BANK ************/

			unset($fd);
			$fd["Bid"] = $BID;
			$fd["date"] = date("Y-m-d");
			$fd["depo_bank_id"] = $data["bank"];
			$fd["pay_mode"] = "CHEQUE";
			$fd["cheque_no"] = $data["cheque_no"];
			$fd["cheque_date"] = $data["cheque_date"];
			$fd["amount"] = $data["pay_amt"];
			$fd["paid"] = "yes";
			$fd["reason"] = "{$category} PAY AMOUNT";
			$fd["SubLedgerId"] = $dep_subhead_id;
			$fd["Deposit_type"] = "WITHDRAWL";

			$dep_id = DB::table("deposit")
				->insertGetId($fd);

			/****** RV DEPOSIT *****/
			unset($fn_data);
			$fn_data["rv_payment_mode"] = "ADJUSTMENT";
			$fn_data["rv_transaction_id"] = $dep_id;
			$fn_data["rv_transaction_type"] = "DEBIT";
			$fn_data["rv_transaction_category"] = ReceiptVoucherModel::DEPOSIT;//constant DEPOSIT is declared in ReceiptVoucherModel
			$fn_data["rv_date"] = date("Y-m-d");
			$fn_data["rv_bid"] = $BID;
			$this->rv_no->save_rv_no($fn_data);
			unset($fn_data);
			/***********/
		}

		public function cdsd_pay_sb_entry($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;

			$cdsd_type = $data["cdsd_type"];
			if($cdsd_type == 1) {
				$category = "CD";
			} else {
				$category = "SD";
			}

			$sb_acc_info = DB::table("createaccount")->where("Accid", $data["sb_acc_id"])->first();

			unset($fd);
			$fd["Accid"] = $data["sb_acc_id"];
			$fd["AccTid"] = 1;
			$fd["TransactionType"] = "CREDIT";
			$fd["particulars"] = "{$category} PAY AMOUNT";
			$fd["Amount"] = $data["pay_amt"];
			$fd["SBReport_TranDate"] = date("Y-m-d");
			$fd["Month"] = date("m");
			$fd["Year"] = date("Y");
			$fd["Bid"] = $sb_acc_info->Bid;
			$fd["Payment_Mode"] = "ADJUSTMENT";
			$fd["CreatedBy"] = $UID;
			$fd["tran_reversed"] = "no";
			$fd["SubLedgerId"] = 42;
			$fd["deleted"] = 0;

			$sb_id = DB::table("sb_transaction")
				->insertGetId($fd);
				
			/****** RV SB *****/
			unset($fn_data);
			$fn_data["rv_payment_mode"] = "ADJUSTMENT";
			$fn_data["rv_transaction_id"] = $sb_id;
			$fn_data["rv_transaction_type"] = "CREDIT";
			$fn_data["rv_transaction_category"] = ReceiptVoucherModel::SB_TRAN;//constant SB_TRAN is declared in ReceiptVoucherModel
			$fn_data["rv_date"] = date("Y-m-d");
			$fn_data["rv_bid"] = $BID;
			$this->rv_no->save_rv_no($fn_data);
			unset($fn_data);
			/***********/

			if($BID != $sb_acc_info->Bid) { // SB account in different branch
				
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
				unset($insert_array);
				$insert_array["Branch_Branch1_Id"] = $sb_acc_info->Bid;
				$insert_array["Branch_Branch2_Id"] = $BID;
				$insert_array["Branch_Tran_Date"] = date("Y-m-d");
				$insert_array["Branch_payment_Mode"] = "ADJUSTMENT";
				$insert_array["LedgerHeadId"] = 296;
				$insert_array["SubLedgerId"] = $temp_subhead_id;
				$insert_array["Branch_Amount"] = $data["pay_amt"];
				$insert_array["Branch_per"] = "{$category} PAY AMOUNT";

				$branch_to_branch_id = DB::table("branch_to_branch")
					->insertGetId($insert_array);
				//GENERATE ADJ NO.
					/***** for branch ******/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $branch_to_branch_id;
					$fn_data["rv_transaction_type"] = "DEBIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = date("Y-m-d");
					$fn_data["rv_bid"] = $sb_acc_info->Bid;
					$adj_no = $this->rv_no->save_rv_no($fn_data);
					/***********/
					/***** for HO ******/
					unset($fn_data);
					$fn_data["rv_payment_mode"] = "ADJUSTMENT";
					$fn_data["rv_transaction_id"] = $branch_to_branch_id;
					$fn_data["rv_transaction_type"] = "CREDIT";
					$fn_data["rv_transaction_category"] = ReceiptVoucherModel::B2B_TRAN;//constant B2B_TRAN is declared in ReceiptVoucherModel
					$fn_data["rv_date"] = date("Y-m-d");
					$fn_data["rv_bid"] = $BID;
					$adj_no = $this->rv_no->save_rv_no($fn_data);
					/***********/
			}
		}
	}
