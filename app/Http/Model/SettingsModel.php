<?php
	
	namespace App\Http\Model;
	use DB;
	use Auth;
	use Exception;
	
	use Illuminate\Database\Eloquent\Model;
	
	class SettingsModel extends Model
	{
        public $tbl = "settings";//table
        public $pk = "settings_id";//primary key
        public $settings_key_field = "settings_key";
		public $settings_value_field = "settings_value";
		public $deleted_field = "settings_deleted";
		
		private $row_data = array();
		
		const DELETED = 1;
		const NOT_DELETED = 0;
		
		function __construct()
		{
			
		}
		
		public function required($data,$var)
		{
			if(!isset($data["{$var}"])) {
				$dbg = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2);
				//print_r($dbg);
				throw new Exception("{$var} value must be provided \n\nclass : {$dbg[1]["class"]}\n function: {$dbg[1]["function"]}() \n line : {$dbg[0]["line"]}");
			}
		}
		
		public function clear_row_data()
		{
			$this->row_data = array();
		}
		
		public function set_row_data($data)
		{
			if(isset($data["{$this->pk}"])) {
				$this->row_data["{$this->pk}"] = $data["{$this->pk}"];
			}
			if(isset($data["{$this->settings_key_field}"])) {
				$this->row_data["{$this->settings_key_field}"] = $data["{$this->settings_key_field}"];
			}
			if(isset($data["{$this->settings_value_field}"])) {
				$this->row_data["{$this->settings_value_field}"] = $data["{$this->settings_value_field}"];
			}
			if(isset($data["{$this->deleted_field}"])) {
				$this->row_data["{$this->deleted_field}"] = $data["{$this->deleted_field}"];
			}
			return;
		}
		
		public function print_row_data()
		{
			print_r($this->row_data);exit();
		}
		
		public function insert_row()
		{
			 return DB::table($this->tbl)
				->insertGetId($this->row_data);
		}
		
		public function update_row()
		{
			$this->required($this->row_data,"{$this->pk}");
			$update_row_pk = $this->row_data["{$this->pk}"];
			unset($this->row_data["{$this->pk}"]);
			
			if(count($this->row_data) == 0) {
				return;
			}
			
			return DB::table($this->tbl)
				->where("{$this->tbl}.{$this->pk}",$update_row_pk)
				->update($this->row_data);
		}
		
		
		/* --------------------------------------------------------------------- */
		
		public function get_table($data = ["only_not_deleted" => false])
		{
			if($data["only_not_deleted"]) {
				return DB::table($this->tbl)
					->where("{$this->deleted_field}",0)
					->get();
			} else {
				return DB::table($this->tbl)
					->get();
			}
		}
		
		public function get_row($data)
		{
			$this->required($data,"{$this->pk}");
			$row = DB::table($this->tbl)
				->where("{$this->tbl}.{$this->pk}",$data["{$this->pk}"])
				->first();
			$ret_data = $this->parse_row_object(["row_data"=>$row]);
			return $ret_data;
		}
		
		public function parse_row_object($data)
		{
			$ret_data = [];
			$row_data = (array)$data["row_data"];
			foreach($row_data as $key_data=>$value_data) {
				$ret_data["{$key_data}"] = $value_data;
			}
			return $ret_data;
        }
		
		public function parse_table_objects($data)
		{
			$ret_data = [];
			$i = -1;
			foreach($data["table_data"] as $row_data_obj) {
				$row_data_arr = (array)$row_data_obj;
				$i++;
				foreach($row_data_arr as $key_data => $value_data) {
					$ret_data[$i]["{$key_data}"] = $value_data;
				}
			}
			return $ret_data;
		}
		/* --------------------------------------------------------------------- */
		
		public function get_value($key)
		{
			$this->validate_key($key);
			$value = DB::table($this->tbl)
				->where("{$this->tbl}.{$this->settings_key_field}",$key)
				->where("{$this->tbl}.{$this->deleted_field}",self::NOT_DELETED)
				->value("{$this->tbl}.{$this->settings_value_field}");
			return $value;
        }
		
		public function validate_key($key)
		{
			$count = DB::table($this->tbl)
				->where("{$this->tbl}.{$this->settings_key_field}",$key)
				->where("{$this->tbl}.{$this->deleted_field}",self::NOT_DELETED)
				->count();

			if($count < 1) {
				throw new Exception("\nSettings Key : \"{$key}\" not found \n\n");
			}
			return;
		}

	}
