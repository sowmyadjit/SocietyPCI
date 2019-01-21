<?php
namespace App\Http\Model;

use DB;

class TableStaffLoanAllocationModel extends DBTableModel
{
    public $tbl = "staffloan_allocation";//table
    public $pk = "StfLoanAllocID";//primary key
    
    protected $row = [];
    protected $field_list = array(
        "StfLoanAllocID",
        "StfLoan_Number",
        "old_saffloan_no",
        "Bid",
        "DocId",
        "Uid",
        "LoanAmt",
        "otherCharges",
        "Book_FormCharges",
        "AjustmentCharges",
        "ShareCharges",
        "PayableAmt",
        "LoandurationYears",
        "LoanduratiobDays",
        "Staff_Surety",
        "Loan_Type",
        "time",
        "StartDate",
        "EndDate",
        "ClosedDate",
        "PayMode",
        "accid",
        "CreadtedBY",
        "Status",
        "BankID",
        "ChequeDate",
        "ChequeNumber",
        "StaffLoan_LoanRemainingAmount",
        "EMI_Amount",
        "fake_value",
        "cd_id",
        "LastPaidDate",
        "partpayment_amount",
        "LedgerHeadId",
        "SubLedgerId",
        "deleted"
    );

    protected $unique_fields = array(
        "StfLoanAllocID"
    );
    
    public function __construct()
    {
        
    }

    /*
    *	methods inhrited from DBTableModel are:
    *		public insert_row(array)
    *		public update_row(array)
    *
    *		public get_field_list()
    *		public get_tbl()
    *		public get_pk()
    *
    *		public set_row(array)
    *		public print_row()
    */

    /******************************************************************/



}