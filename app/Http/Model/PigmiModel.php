<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB; 

class PigmiModel extends Model
{
    //
	protected $table='pigmitype';
	public function insert($id)
    {
        $id = DB::table('pigmitype')->insertGetId(['Pigmi_Type' => $id['pt'],'max_Interest'=>$id['mi'],'Interest'=>$id['inter'],'Max_Commission'=>$id['mcomm'],'Commission'=>$id['comm']]);
        return $id;
    }
	public function GetPigmitype($q)
    {
		return DB::select("SELECT `PigmiTypeid` as id, CONCAT(`Pigmi_Type`) as name FROM `pigmitype` where `Pigmi_Type` LIKE '%".$q."%' ");
	}
	
	public function getpigmi($id)
	{
		$id=DB::table('pigmitype')->select('Commission')->where('PigmiTypeid','=',$id['pigmiid'])->first();
		
		return $id;
	}
	
	
		public function GetPigmyType()
		{
			$id= DB::table('pigmitype')->select('PigmiTypeid','Pigmi_Type','max_Interest','Interest','created_on','Max_Commission','Commission')
			->paginate(10);
			
			/*
			$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','pigmetype')
			->first();
			*/
			
			return $id;
		}
		
		
	}
