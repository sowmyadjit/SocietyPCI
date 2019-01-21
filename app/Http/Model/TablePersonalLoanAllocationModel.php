<?php
namespace App\Http\Model;

use DB;

class TablePersonalLoanAllocationModel extends DBTableModel
{
    public $tbl = "personalloan_allocation";//table
    public $pk = "PersLoanAllocID";//primary key
    
    protected $row = [];
    protected $field_list = array(
        "PersLoanAllocID",
        "PersLoan_Number",
        "Old_PersLoan_Number",
        "Bid",
        "DocId",
        "MemId",
        "MEMBER_NO",
        "LoanAmt",
        "otherCharges",
        "Book_FormCharges",
        "AjustmentCharges",
        "ShareCharges",
        "Insurance",
        "PayableAmt",
        "LoandurationYears",
        "LoandurationDays",
        "FirstSurety",
        "SecondSurety",
        "MEMBER_NO_FirstSurety",
        "MEMBER_NO_Second_Surety",
        "allocation_date",
        "StartDate",
        "EndDate",
        "PayMode",
        "accid",
        "CreadtedBY",
        "Auth_Status",
        "BankID",
        "ChequeDate",
        "ChequeNumber",
        "Request_Date",
        "EMI_Amount",
        "RemainingLoan_Amt",
        "LoanType_ID",
        "board_resolution_no",
        "old_data_intrest",
        "RemainingInterest_Amt",
        "caldate",
        "EMIremaining",
        "partpayment_amount",
        "Closed",
        "ClosedDate",
        "ExtraAmount",
        "LedgerHeadId",
        "SubLedgerId",
        "fake_value",
        "deleted"
    );

    protected $unique_fields = array(
        "PersLoanAllocID"
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