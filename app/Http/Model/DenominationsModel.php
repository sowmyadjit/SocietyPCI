<?php
    namespace App\Http\Model;

    use Illuminate\Database\Eloquent\Model;
    use DB;
    use Auth;
    use Exception;

    class DenominationsModel extends Model
    {
        protected $tbl = "denominations";//table
        public $pk = "denominations_id";//primary key
        public $date_field = "date";
        public $bid_field = "bid";
        public $value_2000_field = "value_2000";
        public $value_500_field = "value_500";
        public $value_200_field = "value_200";
        public $value_100_field = "value_100";
        public $value_50_field = "value_50";
        public $value_20_field = "value_20";
        public $value_10_field = "value_10";
        public $value_5_field = "value_5";
        public $value_2_field = "value_2";
        public $value_1_field = "value_1";
        public $value_other_field = "value_other";
        public $entered_by_field = "by_uid";
        public $deleted_field = "deleted";
		
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
			if(isset($data["{$this->value_2000_field}"])) {
				$this->row_data["{$this->value_2000_field}"] = $data["{$this->value_2000_field}"];
			}
			if(isset($data["{$this->value_500_field}"])) {
				$this->row_data["{$this->value_500_field}"] = $data["{$this->value_500_field}"];
			}
			if(isset($data["{$this->value_200_field}"])) {
				$this->row_data["{$this->value_200_field}"] = $data["{$this->value_200_field}"];
			}
			if(isset($data["{$this->value_100_field}"])) {
				$this->row_data["{$this->value_100_field}"] = $data["{$this->value_100_field}"];
			}
			if(isset($data["{$this->value_50_field}"])) {
				$this->row_data["{$this->value_50_field}"] = $data["{$this->value_50_field}"];
			}
			if(isset($data["{$this->value_20_field}"])) {
				$this->row_data["{$this->value_20_field}"] = $data["{$this->value_20_field}"];
			}
			if(isset($data["{$this->value_10_field}"])) {
				$this->row_data["{$this->value_10_field}"] = $data["{$this->value_10_field}"];
			}
			if(isset($data["{$this->value_5_field}"])) {
				$this->row_data["{$this->value_5_field}"] = $data["{$this->value_5_field}"];
			}
			if(isset($data["{$this->value_2_field}"])) {
				$this->row_data["{$this->value_2_field}"] = $data["{$this->value_2_field}"];
			}
			if(isset($data["{$this->value_1_field}"])) {
				$this->row_data["{$this->value_1_field}"] = $data["{$this->value_1_field}"];
			}
			if(isset($data["{$this->value_other_field}"])) {
				$this->row_data["{$this->value_other_field}"] = $data["{$this->value_other_field}"];
			}
			if(isset($data["{$this->entered_by_field}"])) {
				$this->row_data["{$this->entered_by_field}"] = $data["{$this->entered_by_field}"];
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
			return (array)$row;
		}
		
		public function get_value($data)
		{
			$this->required($data,"{$this->pk}");
			$value = DB::table($this->tbl)
				->where("{$this->tbl}.{$this->pk}",$data["{$this->pk}"])
				->value($data["field"]);
			return $value;
        }

        public function get_denominations($data)
        {
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
            $ret_data = DB::table($this->tble)
                ->where($deleted_field,0)
                ->where($date_field,$data["date"])
                ->where($bid_field,$BID)
                ->first();
            return $ret_data;
        }
        

    }
