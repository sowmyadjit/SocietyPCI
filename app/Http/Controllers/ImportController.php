<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Http\Model\ImportModel;
use DB;

class ImportController extends Controller
{
	public function __construct()
	{
	//	$this->imp_model= new ImportModel;
	}
	
	
	public function import() {
		$file_name = 'http://localhost/sb_transaction4.csv';
		$file = fopen($file_name,'r');
		while(($data = fgetcsv($file, 1000000, ',', '"')) !== false) {
			DB::table('createaccount')->where('Accid','=',$data[1])->update(['Total_Amount'=>$data[6]]);
			$a = $data[1];
			$b = $data[6];
			echo "$a - $b ";
			echo "<br>";
		}
	}
	
	
	
	/*
	
	
	public function import3() {
		
			DB::table('createaccount')->where('Accid','=',975)->update(['Total_Amount'=>70517]);
			echo "975 - 70517<br>";
		}
	
	*/
	
	
	
	
   
}
