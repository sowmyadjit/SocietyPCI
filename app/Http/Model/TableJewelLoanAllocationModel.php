<?php
namespace App\Http\Model;

use DB;

class TableJewelLoanAllocationModel extends DBTAbleModel
{
    public $tbl = "jewelloan_allocation";//table
    public $pk = "JewelLoanId";//primary key
    
    protected $row = [];
    protected $field_list = array(
        "JewelLoanId",
        "JewelLoan_LoanNumber",
        "jewelloan_Oldloan_No",
        "JewelLoan_LoanTypeId",
        "JewelLoan_Bid",
        "JewelLoan_Uid",
        "JewelLoan_AppraisalValue",
        "JewelLoan_LoanDuration",
        "JewelLoan_LoanAmount",
        "JewelLoan_SaraparaCharge",
        "JewelLoan_InsuranceCharge",
        "JewelLoan_BookAndFormCharge",
        "JewelLoan_OtherCharge",
        "JewelLoan_LoanAmountAfterDe",
        "time",
        "JewelLoan_StartDate",
        "JewelLoan_EndDate",
        "JewelLoan_PaymentMode",
        "JewelLoan_ChqNum",
        "JewelLoan_ChqDate",
        "JewelLoan_Bankid",
        "JewelLoan_CreatedBy",
        "JewelLoan_AuthorisedBy",
        "JewelLoan_Status",
        "JewelLoan_AuthorisedDate",
        "JewelLoan_Closed",
        "JewelLoan_Closed_Date",
        "JewelLoan_LoanRemainingAmou",
        "jewelloan_Gross_weight",
        "jewelloan_Net_weight",
        "jewelloan_pergram_value",
        "jewelloan_Description",
        "JewelLoan_remaininginterest",
        "JewelLoan_lastpaiddate",
        "jewelloan_RequestID",
        "partpayment_amount",
        "ExtraAmount",
        "fake_value",
        "LedgerHeadId",
        "SubLedgerId",
        "auction_status",
        "auction_sent_date",
        "deleted"
    );

    protected $unique_fields = array(
        "JewelLoanId"
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