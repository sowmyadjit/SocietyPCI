<?php


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

class BranchModel extends Model
{
   	protected $table = 'branch';
	
	public function insert($id)
    {
		$id = DB::table('branch')->insertGetId(['BCode'=> $id['bcode'],'BName'=>$id['bname'],'BAddress'=>$id['baddress'],'BCity'=>$id['bcity'],'BState'=>$id['bstate'],'BPhoneNo'=>$id['bphone'],'BMobileNo'=>$id['bmobile'],'BPincode'=>$id['bpincode'],'Cid'=>$id['cid']]);
	
        return $id;
	}
	
	public function updatebranch($id)
    {
		$id = DB::table('branch')->where('Bid',$id['bid'])
								->update(['Bid'=> $id['bid'],'BCode'=> $id['bcode'],'BName'=>$id['bname'],'BAddress'=>$id['baddress'],'BCity'=>$id['bcity'],'BState'=>$id['bstate'],'BPhoneNo'=>$id['bphone'],'BMobileNo'=>$id['bmobile'],'BPincode'=>$id['bpincode'],'Cid'=>$id['cid']]);
	
        return $id;
	}
	
	public function GetBranch($q)
    {
		return DB::select("SELECT `Bid` as id, CONCAT(`BCode`,'-',`BName`) as name FROM `branch` where `BName` LIKE '%".$q."%' ");
		
	
	}
	
	public function GetBranchForAddBank($q)
    {
		return DB::select("SELECT `Bid` as id,`BName` as name FROM `branch` where `BName` LIKE '%".$q."%' ");
		
	
	}
	
	public function GetData()
    {
		$id = DB::table('branch')->select('Bid','Cname','BCode','BName','BAddress','BCity','BState','BPhoneNo','BMobileNo','BPincode','branch.SMS')
									->leftJoin('company', 'company.Cid', '=' , 'branch.Cid')
									 ->paginate(10);
	
        return $id;
	}
	
	public function GetBranches($id)
    {
		return DB::table('branch')->select('Bid','branch.Cid','Cname','BCode','BName','BAddress','BCity','BState','BPhoneNo','BMobileNo','BPincode')
									->leftJoin('company', 'company.Cid', '=' , 'branch.Cid')
									->where('Bid',$id)
									 ->get();
	}
	
	public function GetBranchForFD($q)
    {
		return DB::select("SELECT `Bid` as id,`BName` as name FROM `branch` where `BName` LIKE '%".$q."%' ");
		
	
	}
	
	public function SmsPermission($id)
		{
			DB::table('branch')->where('Bid',$id['BranchId'])->update(['SMS'=>$id['SMSStatus']]);
		}

}

