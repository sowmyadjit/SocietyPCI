<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ReceiptVoucherModel;
	use Auth;
	
	class ReceiptVoucherController extends Controller
	{
		private $rv_no;

		function __construct()
		{
			$this->rv_no = new ReceiptVoucherModel;
		}

		public function save_rv_no($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;
			if(isset($data["rv_bid"])) {
				$BID = $data["rv_bid"];
			}
			
			if(strcasecmp($data["rv_payment_mode"], "CASH") == 0 || strcasecmp($data["rv_payment_mode"], "INHAND") == 0) {
				$fn_data["{$this->rv_no->date_field}"] = $data["rv_date"];
				$fn_data["{$this->rv_no->time_field}"] = date("H:i:s");
				$fn_data["{$this->rv_no->bid_field}"] = $BID;
				switch($data["rv_transaction_type"]) {
					case "CREDIT"	:
								$temp_receipt_voucher_type_field = $this->rv_no::RECEIPT;//RECEIPT is CONSTANT DECLARED IN ReceiptVoucherModel CLASS
								$rv_no = $this->rv_no->get_next_receipt_no(["bid"=>$BID]);//["date"=>$id['dte']  - date is optional
								break;
					case "DEBIT"	:
								$temp_receipt_voucher_type_field = $this->rv_no::VOUCHER;
								$rv_no = $this->rv_no->get_next_voucher_no(["bid"=>$BID]);//["date"=>$id['dte']  - date is optional
								break;
				}
				$fn_data["{$this->rv_no->receipt_voucher_type_field}"] = $temp_receipt_voucher_type_field;
				$fn_data["{$this->rv_no->receipt_voucher_no_field}"] = $rv_no;
				$fn_data["{$this->rv_no->transaction_category_field}"] = $data["rv_transaction_category"];
				$fn_data["{$this->rv_no->transaction_id_field}"] = $data["rv_transaction_id"];
				$fn_data["{$this->rv_no->deleted_field}"] = ReceiptVoucherModel::NOT_DELETED;

				$this->rv_no->required($fn_data,"{$this->rv_no->date_field}");
				$this->rv_no->required($fn_data,"{$this->rv_no->time_field}");
				$this->rv_no->required($fn_data,"{$this->rv_no->bid_field}");
				$this->rv_no->required($fn_data,"{$this->rv_no->receipt_voucher_type_field}");
				$this->rv_no->required($fn_data,"{$this->rv_no->receipt_voucher_no_field}");
				$this->rv_no->required($fn_data,"{$this->rv_no->transaction_category_field}");
				$this->rv_no->required($fn_data,"{$this->rv_no->transaction_id_field}");

				if($this->rv_no->exists($fn_data)) {
					return "EXISTS";
				}
				
				$this->rv_no->clear_row_data();
				$this->rv_no->set_row_data($fn_data);
				$insert_id = $this->rv_no->insert_row();
			} else {
				return "NOT A CASH TRANSACTION";
			}
			return "DONE,  INSERT ID : {$insert_id}";
		}




	}
