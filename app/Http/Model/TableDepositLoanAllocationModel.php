<?php
namespace App\Http\Model;

use DB;

class TableDepositLoanAllocationModel extends DBTAbleModel
{
    public $tbl = "depositeloan_allocation";//table
    public $pk = "DepLoanAllocId";//primary key
    
    protected $row = [];
    protected $field_list = array(
        "DepLoanAllocId",
        "DepLoan_SbTranId",
        "DepLoan_LoanNum",
        "Old_loan_number",
        "DepLoan_DepositeType",
        "DepLoan_LoanTypeID",
        "DepLoan_Branch",
        "DepLoan_AccNum",
        "Old_Accnum",
        "DepLoan_LoanAmount",
        "DepLoan_LoanCharge",
        "DepLoan_LoanStartDate",
        "DepLoan_LoanEndDate",
        "DepLoan_LoanDurationDays",
        "DepLoan_PaymentMode",
        "DepLoan_ChequeNumber",
        "DepLoan_ChequeDate",
        "DepLoan_BankId",
        "DepLoan_Authorise",
        "DepLoan_ChequeClear",
        "DepLoan_AuthBy",
        "DepLoan_RemailningAmt",
        "DepLoan_Uid",
        "LoanClosed_State",
        "LoanClosed_Date",
        "EMI_Amount",
        "DepLoan_RemailninginterestAmt",
        "DepLoan_lastpaiddate",
        "ExtraAmount",
        "LedgerHeadId",
        "SubLedgerId",
        "fake_value",
        "partpayment_amount",
        "deleted"
    );

    protected $unique_fields = array(
        "DepLoanAllocId"
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