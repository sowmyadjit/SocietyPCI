<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\CommonModel;
use DB;
use Auth;

class SDModel extends Model
{
	public $tbl = 'security_deposit';
	public $pk = 'sd_id';
	public $sd_ho_id_field = 'sd_ho_id';
	public $sd_acc_no_field = 'sd_acc_no';
	public $sd_old_acc_no_field = 'sd_old_acc_no';
	public $user_type_field = 'user_type';
	public $uid_field = 'uid';
	public $bid_field = 'bid';
	public $sd_start_date_field = 'sd_start_date';
	public $sd_close_date_field = 'sd_close_date';
	public $sd_closed_field = 'sd_closed';
	public $subhead_id_field = 'subhead_id';
	public $deleted_field = 'deleted';
	
	private $field_list = array(
		"sd_id",
		"sd_ho_id",
		"sd_acc_no",
		"sd_old_acc_no",
		"user_type",
		"uid",
		"bid",
		"sd_start_date",
		"sd_close_date",
		"sd_closed",
		"subhead_id",
		"deleted"
	);

	const SD_HO_AMOUNT_LIMIT = 100000;

	private $row_data = array();

	public function __construct()
	{
		$this->common = new CommonModel;
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

	/* --------------------------------------------------------------------------------------------- */

	public function get_sd_ho_id($sd_id)
	{
		if(!empty($sd_id)) {
			$ret_data = DB::table($this->tbl)
			->where("{$this->tbl}.{$this->pk}", $temp_sd_id)
			->value($this->sd_hd_id_field);
		} else {
			$ret_data = 0;
		}

		return $ret_data;
	}

	public function get_row($data)
	{
		$row = DB::table($this->tbl);
		if(isset($data[$this->pk])) {
			$row = $row->where("{$this->tbl}.{$this->pk}", $data[$this->pk]);
		} elseif(isset($data[$this->sd_acc_no_field])) {
			$row = $row->where("{$this->tbl}.{$this->sd_acc_no_field}", $data[$this->sd_acc_no_field]);
		} elseif(isset($data[$this->uid_field])) {
			$row = $row->where("{$this->tbl}.{$this->uid_field}", $data[$this->uid_field]);
		}
		$row = $row->first();
		
		return $row;
	}
	
	public function get_next_sd_account_no($data)
	{
		$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

		if(!empty($data["bid"])) {
			$BID = $data["bid"];
		}

		$sd_no_list = DB::table($this->tbl)
			->select("{$this->sd_acc_no_field}")
			->where($this->bid_field, $BID)
			->get();
		$number_list = [];
		$i = -1;
		foreach($sd_no_list as $key => $row) {
			$sd_no = $row->{$this->sd_acc_no_field};
			$number = (int)preg_replace('/[^0-9]/', '', $sd_no);
			$number_list[++$i] = $number;
		}

		if(!empty($number_list)) {
			$max_number = max($number_list);
		} else {
			$max_number = 0;
		}
		$new_number = $max_number + 1;

		switch($BID) {
			case 1:
					$branch_code = "KUL";
					break;
			case 2:
					$branch_code = "TOK";
					break;
			case 3:
					$branch_code = "KRI";
					break;
			case 4:
					$branch_code = "JOK";
					break;
			case 5:
					$branch_code = "TAL";
					break;
			case 6:
					$branch_code = "HO";
					break;
			default:
					$branch_code = "";
		}
		$new_sd_acc_no = "PCISSD{$branch_code}{$new_number}";
		return $new_sd_acc_no;
	}

/* 	public function is_sd_no_exists($sd_acc_no)
	{
		$sd_row = DB::table($this->tbl)
			->where($sd_acc_no_field, $sd_acc_no)
			->where($deleted_field, NOT_DELETED)
			->frist();
		
		if(!empty($sd_row)) {
			$ret_data = true;
		} else {
			$ret_data = false;
		}

		return $ret_data;
	} */
}
