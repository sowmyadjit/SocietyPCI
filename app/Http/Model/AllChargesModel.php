<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\CommonModel;
use App\Http\Model\SettingsModel;
use DB;
use Auth;

class AllChargesModel extends Model
{
	public $tbl = 'all_charges';

	public $pk = 'all_charges_id';
	public $date = 'date';
	public $time = 'time';
	public $bid = 'bid';
	public $transaction_type = 'transaction_type';
	public $payment_mode = 'payment_mode';
	public $amount = 'amount';
	public $particulars = 'particulars';
	public $paid = 'paid';
	public $tran_table = 'tran_table';
	public $tran_id = 'tran_id';
	public $created_by = 'created_by';
	public $SubLedgerId = 'SubLedgerId';
	public $deleted = 'deleted';
	
	private $field_list = array(
		"all_charges_id",
		"date",
		"time",
		"bid",
		"transaction_type",
		"payment_mode",
		"amount",
		"particulars",
		"paid",
		"tran_table",
		"tran_id",
		"created_by",
		"SubLedgerId",
		"deleted",
		"ft",
		"fid"
	);


	private $row_data = array();

	public function __construct()
	{
		$this->common = new CommonModel;
		$this->settings = new SettingsModel;
	}

	public function clear_row_data()
	{
		$this->row_data = array();
	}

	public function print_row_data()
	{
		print_r($this->row_data);
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

}
