<?php

namespace App\Http\Model;

define("ACCOUNT_TYPE_PIGMY",2);

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class DepositModel extends Model
{
	protected $table = 'deposit';
	
	public function insert($id)
    {   $dte=date('d-m-Y');
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
		
		$id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>$dte1,'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$pay_mode,'Bid'=>$BID]);
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
		$id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>date('Y-m-d'),'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$id['paymode'],'Bid'=>$BID,'Deposit_type'=>"WITHDRAWL"]);
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
		
						
	
		return $id;
	}
	
		public function deposit_account_list_pg($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			
			$ret_data['deposit_details'] = array();
			$ret_data['deposit_category'] = $data["category"];
			$table = "pigmiallocation";
			$closed_field = "Closed";
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
				->where($branch_id_field,"=",$BID);
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
				->join("fdtype","fdtype.FdTid","=","{$table}.FdTid")
				->where($branch_id_field,"=",$BID);
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
				->where("pigmy_tran_type","=",1)
				->sum("Amount");
		}
		
	}
