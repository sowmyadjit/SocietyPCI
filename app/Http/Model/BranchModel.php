<?php


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Http\Model\SettingsModel;

class BranchModel extends Model
{
	protected $table = 'branch';
	
	public function __construct()
	{
		$this->settings = new SettingsModel;
	}
	
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
		$uname='';
		if(Auth::user())
		$uname= Auth::user();
		$UID=$uname->Uid;
		$BID=$uname->Bid;

		$branch_where = "";
		
		if($this->settings->get_value("allow_inter_branch") == 0) {
			$branch_where = " AND `branch`.`Bid` = {$BID} ";
		}

		return DB::select("SELECT `Bid` as id, CONCAT(`BCode`,'-',`BName`) as name FROM `branch` where `BName` LIKE '%".$q."%' {$branch_where} ");
		
	
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
		$uname='';
		if(Auth::user())
		$uname= Auth::user();
		$UID=$uname->Uid;
		$BID=$uname->Bid;

		$branch_where = "";
		
		if($this->settings->get_value("allow_inter_branch") == 0) {
			$branch_where = " AND `branch`.`Bid` = {$BID} ";
		}
		return DB::select("SELECT `Bid` as id,`BName` as name FROM `branch` where `BName` LIKE '%".$q."%' {$branch_where} ");
		
	
	}
	
	public function SmsPermission($id)
		{
			DB::table('branch')->where('Bid',$id['BranchId'])->update(['SMS'=>$id['SMSStatus']]);
		}

}

