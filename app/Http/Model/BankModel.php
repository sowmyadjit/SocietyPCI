<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class BankModel extends Model
{
	protected $table = 'addbank';
	
	public function insert($id)
    {
		$id = DB::table('addbank')->insertGetId(['BankName'=> $id['bn'],'Branch'=>$id['branch'],'AddBank_IFSC'=>$id['ifsc'],'AccountNo'=>$id['acc'],'TotalAmt'=>$id['ta'],'SocietyBranch'=>$id['branchlist'],'Bid'=>$id['branchid']]);
	
		return $id;
	}
		
		public function GetBankData()
		{
			$id= DB::table('addbank')->select('Bankid','BankName','Branch','Bid','AddBank_IFSC','AccountNo','TotalAmt','SocietyBranch')
			->paginate(10);
			
			return $id;
			
		}
		
		
	}
