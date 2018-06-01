<?php
	
	namespace App\Http\Controllers;
	use File;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ReceiptVoucherModel;
	use Input;
	use DB;
	
	class TestController extends Controller
	{
		//var $loan;
	
		public function __construct()
		{
			$this->rv_no = new ReceiptVoucherModel;
		}
		
		public function test()
		{
			//date_default_timezone_set("Asia/Kolkata");
			var_dump(date("Y-m-d H:i:s"));
			
			exit();
		}
		
	}