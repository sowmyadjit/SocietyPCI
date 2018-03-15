<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	class ExLedgerModel extends Model
	{
		protected $table='exlegder';
		
		public function getleddata()
		{
			$id = DB::table('exlegder')->select('lname','lid')
			                         ->where('subhead','=',0)
			                         ->get();
			return $id;
			
		}
		
		
		
		public function insert($id)
		{
			$id = DB::table('exlegder')->insertGetId(['lname'=> $id['lhname'],'Date'=>$id['date']]);
		}
		
		public function insertion($id)
		{
			DB::table('exlegder')->insertGetId(['lname'=> $id['subhead'],'subhead'=>$id['ledgerhead']]);
		}
		
		/*public function insertingj($id)
			{
			$id = DB::table('legder')->insertGetId(['date'=>$id['date'],'amountdebit'=>$id['adebit'],'amountcredit'=>$id['acredit'],'narration'=>$id['narration'],'toparticulars'=>$id['topar']]);
		}*/
		
		
		public function Getledger($id)
		{
			return DB::table('exlegder')->select('lid','lname','subhead')
			
			->where('lid',$id)
			->get();
		}
		
		
		
		
	}
