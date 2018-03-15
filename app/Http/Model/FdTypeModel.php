<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	
	class FdTypeModel extends Model
	{
		//
		protected $table='fdtype';
		public function insert($id)
		{
			$id = DB::table('fdtype')->insertGetId(['FdType'=> $id['fdtype'],'NumberOfYears'=> $id['fdyear'],'NumberOfDays'=> $id['fddays'],'FdInterest'=>$id['interest']]);
			
			return $id;
		}
		
		public function GetFdtype($q)
		{
			//	return DB::select("SELECT `Bid` as id, CONCAT(`BCode`,'-',`BName`) as name FROM `branch` where `BName` LIKE '%".$q."%' ");
			return DB::select("SELECT `FdTid` as id, `FdType` as name FROM `fdtype` where `FdType` LIKE '%".$q."%' ");
			
			
		}
		
		
		public function GetFdvalues($id)
		{
			
			return DB::table('fdtype')
			->where('FdTid','=',$id)
			->select('NumberOfDays','FdInterest','NumberOfYears','NumberOfMonth','BasedON')
			->first();
		}
		
		
		public function GetFdTypes()
		{
			$id= DB::table('fdtype')->select('FdTid','FdType','NumberOfYears','NumberOfDays','FdInterest')
			->paginate(10);
			
			/*$id['module'] = DB::table('modules')->select('Mid')
				->where('MUrl','=','fdtype')
			->first();*/
			
			
			return $id;
			
		}
		
		public function GetKCCtype($q)
		{
			//	return DB::select("SELECT `Bid` as id, CONCAT(`BCode`,'-',`BName`) as name FROM `branch` where `BName` LIKE '%".$q."%' ");
			//	return DB::select("SELECT `FdTid` as id, `FdType` as name FROM `fdtype` where `FdType` LIKE '%".$q."%' ");
			
			return DB::table('fdtype')
			->select(DB::raw('FdTid as id, CONCAT(`FdTid`,"-",`FdType`) as name'))
			->where('FdType','like','%KCC%')
			->get();
			
			
		}
	}
