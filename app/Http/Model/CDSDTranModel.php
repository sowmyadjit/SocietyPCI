<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class CDSDTranModel extends Model
{
	public $tbl = 'cdsd_transaction';
	public $pk = 'cdsd_tran_id';
	public $cdsd_id_field = 'cdsd_id';
	public $cdsd_type_field = 'cdsd_type';
	public $date_field = 'date';
	public $time_field = 'time';
	public $bid_field = 'bid';
	public $transaction_type_field = 'transaction_type';
	public $amount_field = 'amount';
	public $paid_field = 'paid';
	public $payment_mode_field = 'payment_mode';
	public $particulars_field = 'particulars';
	public $interest_tran_field = 'interest_tran';
	public $cheque_no_field = 'cheque_no';
	public $cheque_date_field = 'cheque_date';
	public $bank_id_field = 'bank_id';
	public $subhead_id_field = 'subhead_id';
	public $deleted_field = 'deleted';
	
	private $field_list = array(
		"cdsd_tran_id",
		"cdsd_id",
		"cdsd_type",
		"date",
		"time",
		"bid",
		"transaction_type",
		"amount",
		"paid",
		"payment_mode",
		"particulars",
		"interest_tran",
		"cheque_no",
		"cheque_date",
		"bank_id",
		"subhead_id",
		"deleted"
	);

	private $row_data = array();

	public function __construct()
	{
		$this->common = new CommonModel;
	}

	public function clear_row_data()
	{
		$this->row_data = array();
	}

	public function set_row_data($data)
	{
		foreach($this->field_list as $value) {
			if(isset($data[$value])) {
				$this->row_data[$value] = $data[$value];
			}
		}
	}
	
	public function insert_row()
	{
		 return DB::table($this->tbl)
			->insertGetId($this->row_data);
	}

	public function update_row()
	{
		$this->common->required($this->row_data,$this->pk);
		$update_row_pk = $this->row_data[$this->pk];
		unset($this->row_data[$this->pk]);

		if(count($this->row_data) == 0) {
			return;
		}

		return DB::table($this->tbl)
			->where("{$this->tbl}.{$this->pk}", $update_row_pk)
			->update($this->row_data);
	}

	public function get_cdsd_amount($data)
	{
		/*
			$data["till_date"] is optional
		*/
		$table = $this->tbl;
		$allocation_id_field = $this->cdsd_id_field;
		$amount_field = $this->amount_field;
		$deleted_field = $this->deleted_field;
		$transaction_type_field = $this->transaction_type_field;
		$paid_field = $this->paid_field;
		$cdsd_type_field = $this->cdsd_type_field;
		
		$credit_amount = DB::table($table)
			->where($allocation_id_field,$data[$this->cdsd_id_field])
			->where($deleted_field,NOT_DELETED)
			->where($transaction_type_field,CREDIT)
			->where($paid_field,PAID)
			->where($paid_field,PAID)
			->where($cdsd_type_field,$data["cdsd_type"]);
		if(isset($data["till_date"])) {
			if(isset($data["till_time"])) {//IF TIME IS GIVEN
				$credit_amount = $credit_amount->where(function($query) use($data) {
					$query = $query->where($this->date_field,"=",$data["till_date"])
						->where($this->time_field,"<=",$data["till_time"])
						->orWhere($this->date_field,"<",$data["till_date"]);
				});
			} else {//ONLY DATE IS GIVEN
				$credit_amount = $credit_amount->where($this->date_field,"<=",$data["till_date"]);
			}
		}
		$credit_amount = $credit_amount->sum($amount_field);

			// print_r($credit_amount);//return 0;
		
		$debit_amount = DB::table($table)
			->where($allocation_id_field,$data[$this->cdsd_id_field])
			->where($deleted_field,NOT_DELETED)
			->where($transaction_type_field,DEBIT)
			->where($cdsd_type_field,$data["cdsd_type"]);
		if(isset($data["till_date"])) {
			if(isset($data["till_time"])) {//IF TIME IS GIVEN
				$debit_amount = $debit_amount->where(function($query) use($data) {
					$query = $query->where($this->date_field,"=",$data["till_date"])
						->where($this->time_field,"<=",$data["till_time"])
						->orWhere($this->date_field,"<",$data["till_date"]);
				});
			} else {//ONLY DATE IS GIVEN
				$debit_amount = $debit_amount->where($this->date_field,"<=",$data["till_date"]);
			}
		}
		$debit_amount = $debit_amount->sum($amount_field);
			// print_r($debit_amount);
		return $credit_amount - $debit_amount;
	}

	public function get_cdsd_tran($data)
	{
		$cdsd_type = $data["cdsd_type"];

		$ret_data = DB::table($this->tbl)
			->where("{$this->tbl}.{$this->cdsd_id_field}", $data[$this->cdsd_id_field])
			->where("{$this->tbl}.{$this->cdsd_type_field}", $cdsd_type)
			->get();
		return $ret_data;
	}

}
