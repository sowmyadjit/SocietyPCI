<?php

namespace App\Http\Model;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;
class LogModel extends Model
{
	protected $table = "db_update_log";
	
	protected $log_user_id;
	protected $table_name;
	protected $field_name;
	protected $pk_name;
	protected $pk_value;
	protected $updated_from;
	protected $updated_to;
	
	public function __construct()
	{
		$this->log_user_id = "";
		$this->table_name = "";
		$this->field_name = "";
		$this->pk_name = "";
		$this->pk_value = "";
		$this->updated_from = "";
		$this->updated_to = "";
	}
	
	public function set_values($data)
	{
		if(isset($data["log_user_id"]))
			$this->log_user_id = $data["log_user_id"];
		if(isset($data["table_name"]))
			$this->table_name = $data["table_name"];
		if(isset($data["field_name"]))
			$this->field_name = $data["field_name"];
		if(isset($data["field_name"]))
			$this->field_name = $data["field_name"];
		if(isset($data["pk_name"]))
			$this->pk_name = $data["pk_name"];
		if(isset($data["pk_value"]))
			$this->pk_value = $data["pk_value"];
		if(isset($data["updated_from"]))
			$this->updated_from = $data["updated_from"];
		if(isset($data["updated_to"]))
			$this->updated_to = $data["updated_to"];
	}
	
	public function print_values()
	{
		echo "log_user_id: {$this->log_user_id}<br />\n";
		echo "table_name: {$this->table_name}<br />\n";
		echo "field_name: {$this->field_name}<br />\n";
		echo "pk_name: {$this->pk_name}<br />\n";
		echo "pk_value: {$this->pk_value}<br />\n";
		echo "updated_from: {$this->updated_from}<br />\n";
		echo "updated_to: {$this->updated_to}<br />\n";
	}
	
	public function insert_log()
	{
		if(Auth::user()) $uname= Auth::user(); $this->log_user_id=$uname->Uid; $branch_id=$uname->Bid;
		$insert_array = array(
								"log_user_id"	=>	$this->log_user_id,
								"table_name"	=>	$this->table_name,
								"pk_name"		=>	$this->pk_name,
								"pk_value"		=>	$this->pk_value,
								"field_name"	=>	$this->field_name,
								"updated_from"	=>	$this->updated_from,
								"updated_to"	=>	$this->updated_to
							);
		DB::table($this->table)
			->insertGetId($insert_array);
	}
	
	
	public function get_updated_from()
	{
		return DB::table($this->table_name)
			->where($this->pk_name,"=",$this->pk_value)
			->value($this->field_name);
	}
}
