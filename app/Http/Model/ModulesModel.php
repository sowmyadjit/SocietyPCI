<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class ModulesModel extends Model
{
    protected $table = 'modules';
	
	public function CreateModule($id)
    {
		$id = DB::table('modules')->insertGetId(['MName'=>$id['modulename'],'MUrl'=>$id['moduleurl'],'MToolTip'=>$id['modulett'],'MIcon'=>$id['moduleico']]);
	    $d = DB::table('designation')->get();
		foreach($d as $did)
		{
			DB::table('permission')->insert(['Mid'=>$id,'Did'=>$did->Did,'Create'=>'0','View'=>'0','UDate'=>'0','Delete'=>'0']);
		}	
		return $id;
	}
		
		public function UpdateModule($id)
		{
			return $id = DB::table('modules')->where('Mid',$id['moduleid'])
			->update(['MName'=>$id['modulename'],'MOrderId'=>$id['moduleorderid'],'MUrl'=>$id['moduleurl'],'MClassId'=>$id['modulecid'],'MToolTip'=>$id['modulett'],'MIcon'=>$id['moduleico']]);
		}
		
		public function UpdateModuleStatus($id)
		{
			return $id = DB::table('modules')->where('Mid',$id['ModuleId'])
			->update(['MStatus'=>$id['ModuleStatus']]);
		}
		
		public function GetModules()
		{
			$id['moddata']= DB::table('modules')->select('Mid','MOrderId','MName','MUrl','MClassId','MToolTip','MIcon','MStatus')
			->orderBy('MOrderId','asc')
			->paginate(15);
			
			$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','modules')
			->first();
			
			
			return $id;
		}
		
		public function GetModuleData($id)
		{
			return $ModData = DB::table('modules')->select('Mid','MOrderId','MName','MUrl','MClassId','MToolTip','MIcon')
			->where('Mid','=',$id)
			->get();
		}
		
		public function GetAnyMid($id)
		{
			$id = DB::table('modules')->select('Mid')
			->where('MUrl','=',$id)
			->first();
			//print_r($id);
			return $id;	
		}
	}
