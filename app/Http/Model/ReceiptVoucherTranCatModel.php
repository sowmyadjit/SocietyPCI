<?php
    namespace App\Http\Model;

    use Illuminate\Database\Eloquent\Model;
    use DB;
    use Auth;
    use Exception;

    class ReceiptVoucherTranCatModel extends Model
    {
        public $tbl = "receipt_voucher_transaction_category";//table
        public $pk = "rv_tran_cat_id";//primary key
        public $rv_tran_cat_name_field = "rv_tran_cat_name";
        public $rv_tran_table_field = "rv_tran_table";
		public $deleted_field = "deleted";
		
		private $row_data = array();

		function __construct()
		{
		
		}

    }
