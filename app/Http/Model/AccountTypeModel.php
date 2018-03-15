<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class AccountTypeModel extends Model
{
    //
	protected $table='accounttype';
	public function insert($id)
    {
		$id = DB::table('accounttype')->insertGetId(['Acc_Type'=> $id['acctyp'],'Intrest'=>$id['intrest']]);
	
		return $id;
	}
	
	public function Getacctype($q)
    {
	//	return DB::select("SELECT `Bid` as id, CONCAT(`BCode`,'-',`BName`) as name FROM `branch` where `BName` LIKE '%".$q."%' ");
		return DB::select("SELECT `AccTid` as id, `Acc_Type` as name FROM `accounttype` where `Acc_Type` LIKE '%".$q."%' ");
		
	
	}
}
