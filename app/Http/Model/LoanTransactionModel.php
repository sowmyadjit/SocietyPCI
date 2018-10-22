<?php
namespace App\Http\Model;
use DB;
use App\Http\Model\CommonModel;

class LoanTransactionModel
{
    public $tbl = "loan_transaction";
    public $pk = "loan_transaction_id";

    private $row_data = [];
    

    private $field_list = array(
        "loan_transaction_id",
        "loan_transaction_category",
        "loan_transaction_date",
        "loan_transaction_time",
        "loan_transaction_bid",
        "loan_transaction_loan_id",
        "loan_transaction_principle_amount",
        "loan_transaction_principle_subhead_id",
        "loan_transaction_interest_amount",
        "loan_transaction_interest_subhead_id",
        "loan_transaction_paid",
        "loan_transaction_type",
        "loan_transaction_payment_mode",
        "loan_transaction_particulars",
        "loan_transaction_cheque_cleared",
        "loan_transaction_cheque_no",
        "loan_transaction_cheque_date",
        "loan_transaction_bank_id",
        "loan_transaction_interest_paid_till",
        "loan_transaction_sb_tran_id",
        "loan_transaction_repay_through_auction",
        "loan_transaction_created_by",
        "loan_transaction_deleted"
    );

    public function __construct()
    {
        $this->common = new CommonModel();
    }

    public function clear_row_data()
    {
        $this->row_data = [];
    }

    public function set_row_data($data)
    {
        foreach($this->field_list as $field) {
            if(!empty($data[$field])) {
                $this->row_data[$field] = $data[$field];
            }
        }
    }

    public function print_row_data()
    {
        print_r($this->row_data);
    }

    public function get_field_list()
    {
        return $this->field_list;
    }

    public function get_pk()
    {
        return $this->pk;
    }

    public function insert()
    {
        return DB::table($this->tbl)
            ->insertGetId($this->row_data);
    }
	
	public function update_row()
	{
		$this->common->required($this->row_data,"{$this->pk}");
		$update_row_pk = $this->row_data["{$this->pk}"];
		unset($this->row_data["{$this->pk}"]);
		
		if(count($this->row_data) == 0) {
			return;
		}
		
		return DB::table($this->tbl)
			->where("{$this->tbl}.{$this->pk}",$update_row_pk)
			->update($this->row_data);
	}



}