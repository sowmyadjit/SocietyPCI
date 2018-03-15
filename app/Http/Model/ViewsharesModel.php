<?php

namespace App\Http\Model;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;
class ViewsharesModel extends Model
{
    //
	protected $table='members';
	public function Getshares()
		{
			$id=DB::table('members')->select('Memid','FirstName','MiddleName','LastName','CreatedDate','Remarks','purchaseshare.Status','PURSH_Shrclass','PURSH_Pid','PURSH_Noofshares','PURSH_TotalShareValue')
			->leftJoin('purchaseshare','purchaseshare.PURSH_Memid','=','members.Memid')
			->where('purchaseshare.Status','=','PENDING')
			->get();
			return $id;
		}
	public function Getrejectshares()
	{
		
		
		$id=DB::table('members')->select('Memid','FirstName','MiddleName','LastName','CreatedDate','Remarks','purchaseshare.Status','PURSH_Shrclass','PURSH_Pid','PURSH_Noofshares','PURSH_TotalShareValue')
								->leftJoin('purchaseshare','purchaseshare.PURSH_Memid','=','members.Memid')
								->where('purchaseshare.Status','=','rejected')
								->get();
								return $id;
	}
	public function AcceptShares($mid,$purid)
	{		
			$uname='';			//	TO GET THE LOGIN USER UID
			if(Auth::user())	
			$uname= Auth::user();
			$UID=$uname->Uid;
		
			$u=DB::table('members')->select('Uid')
								->where('Memid','=',$mid)
								->first();
			$a=$u->Uid;
			
			DB::table('members')->where('Memid',$mid)
								   ->update(['Status'=>"AUTHORISED"]);
			
			DB::table('members')->where('Memid',$mid) //TO UPDATE THE LOGIN USERS UID
								->update(['AuthorisedBy'=>$UID]);
			
			$id=DB::table('purchaseshare')->where('PURSH_Pid',$purid)
								   ->update(['Status'=>"SUSPEND"]);
			
			DB::table('purchaseshare')->where('PURSH_Pid',$purid) //TO UPDATE THE LOGIN USERS UID
								->update(['AuthorisedBy'=>$UID]);
			
			DB::table('user')->where('Uid',$a)
								   ->update(['AuthStatus'=>"AUTHORISED"]);
			
									
								   
			return $id;								   
		
	
	}
	public function rejectShares($mid,$purid)
		{
			
			$uname='';			//	TO GET THE LOGIN USER UID
			if(Auth::user())	
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			
			$u=DB::table('members')->select('Uid','Member_Fee')
			->where('Memid','=',$mid)
			->first();
			$a=$u->Uid;
			$memfee=$u->Member_Fee;
			
			$pur=DB::table('purchaseshare')->select('PURSH_Totalamt')
			->where('PURSH_Memid','=',$mid)
			->first();
			
			$purtot=$pur->PURSH_Totalamt;
			$memamt=$memfee+$purtot;
			
			DB::table('members')->where('Memid',$mid)
			->update(['Status'=>"rejected"]);
			
			DB::table('members')->where('Memid',$mid) //TO UPDATE THE LOGIN USERS UID
			->update(['AuthorisedBy'=>$UID]);
			
			$id=DB::table('purchaseshare')->where('PURSH_Pid',$purid)
			->update(['Status'=>"rejected",'AuthorisedBy'=>$UID]);
			
			//DB::table('purchaseshare')->where('PURSH_Pid',$purid) //TO UPDATE THE LOGIN USERS UID
			//->update(['AuthorisedBy'=>$UID]);
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"rejected"]);
			
			$cash=DB::table('cash')->select('InHandCash')
			->where('BID','=',$bid)
			->first();
			
			$incash=$cash->InHandCash;
			$totcash=$incash-$memamt;
			
			DB::table('cash')->where('BID',$bid)
			->update(['InHandCash'=>$totcash]);
			
			$trandate=date('Y-m-d');
			//$memfee=$amount1+$shamt;
			//$totcash=$inhandcash1+$memfee;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Member and Share Rejected",'InhandTrans_Cash'=>$memamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$incash,'Total_InhandCash'=>$totcash]);
			
			
			return $id;								   
			
			
		}
	
	
	
	public function RejectSuspendShare($purid)
		{
			
			$uname='';			//	TO GET THE LOGIN USER UID
			if(Auth::user())	
			$uname= Auth::user();
			$UID=$uname->Uid;
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			$pur=DB::table('purchaseshare')->select('PURSH_Totalamt')
			->where('PURSH_Pid','=',$purid)
			->first();
			
			$purtot=$pur->PURSH_Totalamt;
			
			$id=DB::table('purchaseshare')->where('PURSH_Pid',$purid)
			->update(['Status'=>"rejected"]);
			
			DB::table('purchaseshare')->where('PURSH_Pid',$purid) //TO UPDATE THE LOGIN USERS UID
			->update(['AuthorisedBy'=>$UID]);
			
			$cash=DB::table('cash')->select('InHandCash')
			->where('BID','=',$bid)
			->first();
			
			$incash=$cash->InHandCash;
			$totcash=$incash-$purtot;
			
			DB::table('cash')->where('BID',$bid)
			->update(['InHandCash'=>$totcash]);
			
			$trandate=date('Y-m-d');
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Member and Share Rejected",'InhandTrans_Cash'=>$purtot,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$incash,'Total_InhandCash'=>$totcash]);
			
			return $id;								   
			
			
		}
	
	
	
	public function Getsuapendedshares()
		{
			$id=DB::table('members')->select('Memid','PURSH_Pid','FirstName','MiddleName','LastName','CreatedDate','Remarks','purchaseshare.Status','PURSH_Shrclass','PURSH_Noofshares','PURSH_TotalShareValue','PURSH_PendingAmount')
			->leftJoin('purchaseshare','purchaseshare.PURSH_Memid','=','members.Memid')
			->where('purchaseshare.Status','=','SUSPEND')
			->get();
			return $id;
		}
		
	public function AcceptsuspendShares($id)
		{
			$purid=$id['purid'];
			$amt=$id['amt'];
			
			
			$uname='';			//	TO GET THE LOGIN USER UID
			if(Auth::user())	
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			
			
			$id=DB::table('purchaseshare')->where('PURSH_Pid',$purid)
			->update(['Status'=>"Active",'PURSH_PendingAmount'=>"0"]);
			DB::table('purchaseshare')->where('PURSH_Pid',$purid) //TO UPDATE THE LOGIN USERS UID
			->update(['AuthorisedBy'=>$UID]);
			
			$certifi=DB::table('purchaseshare')->select('PURSH_Certfid')
			->where('PURSH_Pid',$purid) 
			->first();
			$certificateid=$certifi->PURSH_Certfid;
			DB::table('individual_shares')->where('individual_share_certificateid','=',$certificateid)
			->update(['individual_share_status'=>"Active"]);
			
			$susprndeshares=DB::table('suspended_shares_detail')->select('Suspended_Shares_suspend_Date','Suspended_Shares_Active_Date','Suspended_Shares_Certificate','Suspended_Shares_SuspendDays','Suspended_Shares_Id')
												->where('Suspended_Shares_Certificate',$certificateid)
												->get();
												
			foreach ($susprndeshares as $shares)
			{
				$activedate=$shares->Suspended_Shares_Active_Date;
				if($activedate=="0000-00-00")
				{
					$activedate=Date('Y-m-d');
					$suspendedate=$shares->Suspended_Shares_suspend_Date;
					$sid=$shares->Suspended_Shares_Id;
					$date1=date_create($suspendedate);
					$date2=date_create($activedate);
					$difday=date_diff($date1,$date2);
					$nofdays=$difday->format('%a');
					DB::table('suspended_shares_detail')->where('Suspended_Shares_Id',$sid)
														->update(['Suspended_Shares_Active_Date'=>					$activedate,'Suspended_Shares_SuspendDays'=>$nofdays]);
					
					
					
					
				}
				
			}
			
			
			
			
			
			return $id;								   
			
			
		}
	
	public function AcceptRejectedShare($mid,$purid)
		{
			$uname='';			//	TO GET THE LOGIN USER UID
			if(Auth::user())	
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			
		    $u=DB::table('members')->select('Uid','Member_Fee')
			->where('Memid','=',$mid)
			->first();
			$a=$u->Uid;
			$memfee=$u->Member_Fee;
			$pur=DB::table('purchaseshare')->select('PURSH_Totalamt')
			->where('PURSH_Memid','=',$mid)
			->first();
			
			$purtot=$pur->PURSH_Totalamt;
			$memamt=$memfee+$purtot;
			
			DB::table('members')->where('Memid',$mid)
			->update(['Status'=>"AUTHORISED"]);
			
			DB::table('members')->where('Memid',$mid) //TO UPDATE THE LOGIN USERS UID
			->update(['AuthorisedBy'=>$UID]);
			
			$id=DB::table('purchaseshare')->where('PURSH_Pid',$purid)
			->update(['Status'=>"Active"]);
			
			DB::table('purchaseshare')->where('PURSH_Pid',$purid) //TO UPDATE THE LOGIN USERS UID
			->update(['AuthorisedBy'=>$UID]);
			
			DB::table('user')->where('Uid',$a)
			->update(['AuthStatus'=>"AUTHORISED"]);
			
			$cash=DB::table('cash')->select('InHandCash')
			->where('BID','=',$bid)
			->first();
			
			$incash=$cash->InHandCash;
			$totcash=$incash+$memamt;
			
			DB::table('cash')->where('BID',$bid)
			->update(['InHandCash'=>$totcash]);
			
			$trandate=date('Y-m-d');
			//$memfee=$amount1+$shamt;
			//$totcash=$inhandcash1+$memfee;
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Rejected Member and Share Accepted",'InhandTrans_Cash'=>$memamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$incash,'Total_InhandCash'=>$totcash]);
			
			
			return $id;								   
			
			
		}
		
		public function autoriseindividualshares()
		{
			$id=DB::table('members')->select('Memid','individual_share_ID','FirstName','MiddleName','LastName','individual_share_Date','individual_share_status','individual_share_Class','individual_share_certificateid','individual_shares_PendingAmount')
			->leftJoin('individual_shares','individual_shares.individual_share_Mid','=','members.Memid')
			->where('individual_shares.individual_share_status','=','SUSPEND')
			->get();
			return $id;
			
		}
		public function acceptsuspendindividualshares($id)
		{
			$uname='';			//	TO GET THE LOGIN USER UID
			if(Auth::user())	
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			
			$dte=Date('Y-m-d');
			$purid=$id['pid'];
			$amt=$id['amt'];
			$cid=$id['cid'];
			
			DB::table('individual_shares')->where('individual_share_ID','=',$purid)
			->update(['individual_share_status'=>"Active",'individual_shares_PendingAmount'=>"0",'individual_share_Autorised'=>$UID]);
			
			$tot=DB::table('purchaseshare')->select('PURSH_PendingAmount','PURSH_Pid')
			->where('PURSH_Certfid','=',$cid)
			->first();
			$pendingamt=$tot->PURSH_PendingAmount;
			$pid=$tot->PURSH_Pid;
			$totalamt=(Floatval($pendingamt)-Floatval($amt));
			DB::table('purchaseshare')->where('PURSH_Pid',$pid)
			->update(['PURSH_PendingAmount'=>$totalamt]);
			
			$suspended_details=DB::table('suspended_shares_detail')->select('Suspended_Shares_Active_Date','Suspended_Shares_Id','Suspended_Shares_suspend_Date')
			->where('Suspended_Shares_indivauId',$purid)
			->get();
			
			
			print_r($suspended_details);
			foreach ($suspended_details as $suspended_shares)
			{
				
				$activedate=$suspended_shares->Suspended_Shares_Active_Date;
				$susdate=$suspended_shares->Suspended_Shares_suspend_Date;
				$sid=$suspended_shares->Suspended_Shares_Id;
				
				$date1=date_create($susdate);
				$date2=date_create($dte);
				$difday=date_diff($date1,$date2);
				//	print_r($difday);
				$nofdays=$difday->format('%a');
				
				
				if($activedate=="0000-00-00")
				{
					DB::table('suspended_shares_detail')->where('Suspended_Shares_Id',$sid)
					->update(['Suspended_Shares_Active_Date'=>$dte,'Suspended_Shares_SuspendDays'=>$nofdays]);
					
				}
			}
			
		}
	
	
}
