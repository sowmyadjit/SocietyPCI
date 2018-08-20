<?php
	
	namespace App\Http\Models;
	use DB;
	use Illuminate\Database\Eloquent\Model;
	
	class CommonModel extends Model
	{

		const ACTIVE = 1;
		const INACTIVE = 0;
		
		function __construct()
		{
			
		}
		
		public function required($data,$var)
		{
			if(!isset($data["{$var}"])) {
				$dbg = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2);
				//print_r($dbg);
				throw new \Exception("\"{$var}\" value must be provided \n\nclass : {$dbg[1]["class"]}\n function: {$dbg[1]["function"]}() \n line : {$dbg[0]["line"]}");
			}
		}
		
		public function parse_table($table)
		{
			$ret_data = [];
			$i = -1;
			foreach($table as $row_data_obj) {
				$row_data_arr = (array)$row_data_obj;
				$i++;
				foreach($row_data_arr as $key_data => $value_data) {
					$ret_data[$i]["{$key_data}"] = $value_data;
				}
			}
			return $ret_data;
		}
		
		public function parse_row($row)
		{
			$ret_data = [];
			$row_data_arr = (array)$row;
			foreach($row_data_arr as $key_data => $value_data) {
				$ret_data["{$key_data}"] = $value_data;
			}
			return $ret_data;
		}
		
		

	}


