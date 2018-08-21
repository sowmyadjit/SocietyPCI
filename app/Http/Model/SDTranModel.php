<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class SDTranModel extends Model
{
	public $tbl = 'sd_transaction';
	public $pk = 'sd_tran_id';
	public $sd_id_field = 'sd_id';
	public $date_field = 'date';
	public $time_field = 'time';
	public $bid_field = 'bid';
	public $transaction_type_field = 'transaction_type';
	public $sd_amount_field = 'sd_amount';
	public $paid_field = 'paid';
	public $payment_mode_field = 'payment_mode';
	public $particulars_field = 'particulars';
	public $cheque_no_field = 'cheque_no';
	public $cheque_date_field = 'cheque_date';
	public $bank_id_field = 'bank_id';
	public $subhead_id_field = 'subhead_id';
	public $deleted_field = 'deleted';
	
	private $field_list = array(
		"sd_tran_id",
		"sd_id",
		"date",
		"time",
		"bid",
		"transaction_type",
		"sd_amount",
		"paid",
		"payment_mode",
		"particulars",
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
		$this->common->required($this->row_data,$this->tbl->pk);
		$update_row_pk = $this->row_data[$this->pk];
		unset($this->row_data[$this->pk]);

		if(count($this->row_data) == 0) {
			return;
		}

		return DB::table($this->tbl)
			->where("{$this->tbl}.{$this->pk}", $update_row_pk)
			->update($this->row_data);
	}

	public function get_sd_amount($data)
	{
		$table = $this->tbl;
		$allocation_id_field = $this->sd_id_field;
		$amount_field = $this->sd_amount_field;
		$deleted_field = $this->deleted_field;
		$transaction_type_field = $this->transaction_type_field;
		$paid_field = $this->paid_field;
		
		$credit_amount = DB::table($table)
			->where($allocation_id_field,$data[$this->sd_id_field])
			->where($deleted_field,NOT_DELETED)
			->where($transaction_type_field,CREDIT)
			->where($paid_field,PAID)
			->sum($amount_field);
		
		$debit_amount = DB::table($table)
			->where($allocation_id_field,$data[$this->sd_id_field])
			->where($deleted_field,NOT_DELETED)
			->where($transaction_type_field,DEBIT)
			->where($paid_field,PAID)
			->sum($amount_field);
			// print_r($credit_amount);
		return $credit_amount - $debit_amount;
	}
}
