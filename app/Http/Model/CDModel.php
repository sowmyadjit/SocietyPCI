<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class CDModel extends Model
{
	public $tbl = 'compulsory_deposit';
	public $pk = 'cd_id';
	public $cd_acc_no_field = 'cd_acc_no';
	public $cd_old_acc_no_field = 'cd_old_acc_no';
	public $uid_field = 'uid';
	public $bid_field = 'bid';
	public $cd_start_date_field = 'cd_start_date';
	public $cd_close_date_field = 'cd_close_date';
	public $cd_closed_field = 'cd_closed';
	public $subhead_id_field = 'subhead_id';
	public $deleted_field = 'deleted';
	
	private $field_list = array(
		"cd_id",
		"cd_acc_no",
		"cd_old_acc_no",
		"uid",
		"bid",
		"cd_start_date",
		"cd_close_date",
		"cd_closed",
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
