<?php
    namespace App\Http\Model;

    use Illuminate\Database\Eloquent\Model;
    use DB;
    use Auth;
    use Exception;

    class ReceiptVoucherModel extends Model
    {
        protected $tbl = "receipt_voucher";//table
        public $pk = "receipt_voucher_id";//primary key
        public $date_field = "date";
        public $time_field = "time";
		public $bid_field = "bid";
		public $receipt_voucher_type_field = "receipt_voucher_type";
		public $receipt_voucher_no_field = "receipt_voucher_no";
		public $transaction_category_field = "transaction_category";
		public $transaction_id_field = "transaction_id";
		public $deleted_field = "deleted";
		
		private $row_data = array();

		const RECEIPT = 1;
		const VOUCHER = 2;

		const SB_TRAN = 1;
		const RD_TRAN = 2;
		const PG_TRAN = 3;
		const B2B_TRAN = 4;
		const EXPENSE = 5;
		const DEPOSIT = 6;
		const INCOME = 7;
		const FD_ALLOCATION = 8;
		const AGENT_COLLECTION = 9;
		const MD_TRAN = 10;
		const MEMBER_ALLOCATION = 11;
		const SHARE_ALLOCATION = 12;
		const SHARE_CLOSE = 13;
		
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
			if(isset($data["{$this->date_field}"])) {
				$this->row_data["{$this->date_field}"] = $data["{$this->date_field}"];
			}
			if(isset($data["{$this->time_field}"])) {
				$this->row_data["{$this->time_field}"] = $data["{$this->time_field}"];
			}
			if(isset($data["{$this->bid_field}"])) {
				$this->row_data["{$this->bid_field}"] = $data["{$this->bid_field}"];
			}
			if(isset($data["{$this->receipt_voucher_type_field}"])) {
				$this->row_data["{$this->receipt_voucher_type_field}"] = $data["{$this->receipt_voucher_type_field}"];
			}
			if(isset($data["{$this->receipt_voucher_no_field}"])) {
				$this->row_data["{$this->receipt_voucher_no_field}"] = $data["{$this->receipt_voucher_no_field}"];
			}
			if(isset($data["{$this->transaction_category_field}"])) {
				$this->row_data["{$this->transaction_category_field}"] = $data["{$this->transaction_category_field}"];
			}
			if(isset($data["{$this->transaction_id_field}"])) {
				$this->row_data["{$this->transaction_id_field}"] = $data["{$this->transaction_id_field}"];
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
			$ret_data = $this->parse_row_object(["row_data"=>$row]);
			return $ret_data;
		}
		
		public function get_value($data)
		{
			$this->required($data,"{$this->pk}");
			$value = DB::table($this->tbl)
				->where("{$this->tbl}.{$this->pk}",$data["{$this->pk}"])
				->value($data["field"]);
			return $value;
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

		public function get_next_receipt_no($data = NULL)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			if(!empty($data["date"])) {
				$year = date("Y",strtotime($data["date"]));
				$month = date("m",strtotime($data["date"]));
			} else {
				$year = date("Y");
				$month = date("m");
			}

			if($month <= 3) {//BEFORE 31TS MARCH
				$from_year = $year - 1;
			} else {//AFTER 31TS MARCH
				$from_year = $year;
			}
			$to_year = $from_year + 1;

			$from_date = "{$from_year}-04-01";
			$to_date = "{$to_year}-03-31";

			$last_rec_no = DB::table($this->tbl)
				->where($this->bid_field,$BID)
				->where($this->receipt_voucher_type_field,self::RECEIPT)
				->where($this->deleted_field,0)
				->whereBetween($this->date_field,[$from_date,$to_date])
				->max($this->receipt_voucher_no_field);
			if(empty($last_rec_no)) {
				$last_rec_no = 0;
			}
			$next_receipt_no = $last_rec_no + 1;
			return $next_receipt_no;
		}

		public function get_next_voucher_no($data = NULL)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			
			if(!empty($data["date"])) {
				$year = date("Y",strtotime($data["date"]));
				$month = date("m",strtotime($data["date"]));
			} else {
				$year = date("Y");
				$month = date("m");
			}

			if($month <= 3) {//BEFORE 31TS MARCH
				$from_year = $year - 1;
			} else {//AFTER 31TS MARCH
				$from_year = $year;
			}
			$to_year = $from_year + 1;

			$from_date = "{$from_year}-04-01";
			$to_date = "{$to_year}-03-31";

			$last_voucher_no = DB::table($this->tbl)
				->where($this->bid_field,$BID)
				->where($this->receipt_voucher_type_field,self::VOUCHER)
				->where($this->deleted_field,0)
				->whereBetween($this->date_field,[$from_date,$to_date])
				->max($this->receipt_voucher_no_field);
			if(empty($last_voucher_no)) {
				$last_voucher_no = 0;
			}
			$next_voucher_no = $last_voucher_no + 1;
			return $next_voucher_no;
		}

    }
