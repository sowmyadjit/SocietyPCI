<?php
	
	namespace App\Http\Controllers;
	use File;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ExpenceModel;
	use Input;
	use DB;
	
	class TestController extends Controller
	{
		//var $loan;
		
		public function __construct()
		{
			//$this->loan = new LoanModel;
		}
		
	/*	public function test()
		{
			return "11";
			$allocation_list = DB::table("personalloan_allocation")->get();//print_r($allocation_list);exit();//->limit(5)
			
			foreach($allocation_list as $key=>$row_al) {
				$existing_count = DB::table("personalloan_payment")
					->where("pl_allocation_id",$row_al->PersLoanAllocID)
					->count();
				if($existing_count == 0) {
					$insert_array = array(
											"pl_payment_date"	=>	$row_al->StartDate,
											"pl_allocation_id"	=>	$row_al->PersLoanAllocID,
											"paid_amount"	=>	$row_al->LoanAmt,
											"paid_status"	=>	1,
											"payment_mode"	=>	$row_al->PayMode,
											"particulars"	=>	"PL PAYMENT",
											"SubLedgerId"	=>	$row_al->SubLedgerId,
											"deleted"	=>	0
										);
					DB::table("personalloan_payment")
						->insert($insert_array);
				}
				//var_dump($existing_count);exit();
			}
			return "done";
		}*/
		
	}