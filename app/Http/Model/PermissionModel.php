<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class PermissionModel extends Model
{
	protected $table = 'permission';
	
	public function insert($id)
    {
		$id = DB::table('permission')->insertGetId(['Pid'=> $id['pid']]);
		return $id;
	}
	
	public function getData()
    {
		$id['permission'] = DB::table('permission')->select('Pid','MName','DName','DLevel','Create','View','UDate','Delete','BName')
									 ->leftJoin('modules', 'modules.Mid', '=', 'permission.Mid')
									 ->leftJoin('designation', 'designation.Did', '=', 'permission.Did')
									 ->leftJoin('branch', 'branch.Bid', '=', 'permission.Bid')
									 ->orderBy('DLevel','asc')
									 ->orderBy('DName')
									 ->orderBy('MOrderId','asc')
									 ->paginate(15);
									 
		$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','permissions')
			->first();
	
        return $id;
	}
	
	public function AjaxUpdateCreate($pid,$val)
    {
		return DB::table('permission')->where('Pid', $pid)
									  ->update(['Create' => $val]);
	}
	
	public function AjaxUpdateRead($pid,$val)
    {
		return DB::table('permission')->where('Pid', $pid)
									  ->update(['View' => $val]);
	}
	
	public function AjaxUpdateUpdate($pid,$val)
    {
		return DB::table('permission')->where('Pid', $pid)
									  ->update(['UDate' => $val]);
	}
	
	public function AjaxUpdateDelete($pid,$val)
    {
		return DB::table('permission')->where('Pid', $pid)
									  ->update(['Delete' => $val]);
	}
	
	
}
