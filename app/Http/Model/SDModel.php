<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\CommonModel;
use DB;

class SDModel extends Model
{
	public $tbl = 'security_deposit';
	public $pk = 'sd_id';
	public $sd_acc_no_field = 'sd_acc_no';
	public $sd_old_acc_no_field = 'sd_old_acc_no';
	public $uid_field = 'uid';
	public $bid_field = 'bid';
	public $sd_start_date_field = 'sd_start_date';
	public $sd_close_date_field = 'sd_close_date';
	public $sd_closed_field = 'sd_closed';
	public $subhead_id_field = 'subhead_id';
	public $deleted_field = 'deleted';
	
	private $field_list = array(
		"sd_id",
		"sd_acc_no",
		"sd_old_acc_no",
		"uid",
		"bid",
		"sd_start_date",
		"sd_close_date",
		"sd_closed",
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
			if(in_array($value, $data)) {
				$row_data[$value] = $data[$value];
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
}
