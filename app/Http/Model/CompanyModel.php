<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class CompanyModel extends Model
{
	protected $table = 'company';
	
	public function insert($id)
    {
		$id = DB::table('company')->insertGetId(['CInitial'=> $id['cinitial'],'Cname'=>$id['cname'],'CAddress'=>$id['caddress'],'CPhoneNo'=>$id['cphoneno'],'CCity'=>$id['ccity'],'CState'=>$id['cstate'],'CPincode'=>$id['cpincode']]);
	
		return $id;
	}
	
	public function GetCompany()
    {
        $company = DB::table('company')->select('cname', 'cid')->get();
        return $company;
    }
	
	public function SmsPer($id)
		{
			DB::table('company')->where('Cid',$id['CompanyId'])->update(['SMS'=>$id['SSMSStatus']]);
		}
	
	
	public function GetCompanyDet()
    {
        $company= DB::table('company')->get();
        /*$company['module'] = DB::table('modules')->select('Mid')
		->where('MUrl','=','company')
		->first();*/
        return $company;
    }
}
