<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class DesignationModel extends Model
{
   	protected $table = 'designation';
		
	public function insert($id)
    {
		$id = DB::table('designation')->insertGetId(['DInitial'=> $id['dinitial'],'DName'=>$id['dname'],'DLevel'=>$id['DesigLevel']]);
		$m = DB::table('modules')->get();
     
		foreach($m as $mid)
		{
			DB::table('permission')->insert(['Did'=>$id,'Mid'=>$mid->Mid,'Create'=>'0','View'=>'0','UDate'=>'0','Delete'=>'0']);
		}	
		
		return $id;
	}
	
	public function GetDesignation($d)
    {
		return DB::select("SELECT `Did` as id, CONCAT(`Did`,'-',`DName`) as name FROM `designation` where `DName` LIKE '%".$d."%' ");
		
	}
		
		public function GetDesignations()
		{
			$id = DB::table('designation')->select('Did','DName','DLevel','DInitial')
			->paginate(10);
			
			/*$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','designation')
			->first();*/
			
			
			return $id;
			
		}
		
		
	}
