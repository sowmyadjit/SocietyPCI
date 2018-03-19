<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class DepositModel extends Model
{
	protected $table = 'deposit';
	
	public function insert($id)
    {   $dte=date('d-m-Y');
	 $dte1=date('Y-m-d');
		$bankID=$id['bank'];
		$amount1=$id['ta'];
		$bran=$id['branch'];
		$pay_mode=$id['paymode'];
		
				$uname='';
				if(Auth::user())
				$uname= Auth::user();
				//$UID=$uname->Uid;
				$BID=$uname->Bid;
		
		$id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>$dte1,'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$pay_mode,'Bid'=>$BID]);
		$totamt=DB::table('addbank')->select('TotalAmt')
							->where('Bankid','=',$bankID)
							->first();
		$tt=$totamt->TotalAmt;
		$amt=$tt+$amount1;
		DB::table('addbank')->where('Bankid','=',$bankID)
		                       ->update(['TotalAmt'=>$amt]);
							   
		if($pay_mode=="inhand")
		{
			
		$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
		$inhandcash1=$inhandcashh->InHandCash;
		$x=$inhandcash1-$amount1;
		DB::table('cash')->where('BID','=',$BID)
						->update(['InHandCash'=>$x]);
		
		}			
	
		return $id;
	}
	public function Getbankdetail($q)
    {
		return DB::select("SELECT `Bankid` as id, CONCAT(`BankName`,'-',`AccountNo`) as name FROM `addbank` where `BankName` LIKE '%".$q."%' ");
		
	
	}
	
	public function GetBranchDropD()
    {

       $branch = DB::table('cash')->select('Branch','BID')->get();
        return $branch;
    }
		public function GetBankDetailForDeposite($id)
		{
			return $id=DB::table('addbank')
			->select('Branch','AddBank_IFSC','TotalAmt')
			->where('Bankid','=',$id)
			->first();
			
		}
		public function GetDepositData()
		{
			$id= DB::table('deposit')->select('d_id','depo_bank','Branch','amount','date','d_date','depo_bank_id','reason','pay_mode','cheque_no','cheque_date','bank_name','paid','cd')
			->paginate(10);
			
			
			return $id;
		}
		public function crateaddeposittobranch($id)
    {   $dte=date('d-m-Y');
		$bankID=$id['bank'];
		$amount1=$id['ta'];
		$bran=$id['branch'];
		if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$BID=$uname->Bid;
		$id = DB::table('deposit')->insertGetId(['depo_bank'=> $id['bankName'],'Branch'=>$id['branch'],'amount'=>$id['ta'],'d_date'=>$dte,'date'=>date('Y-m-d'),'depo_bank_id'=>$id['bank'],'reason'=>$id['perti'],'pay_mode'=>$id['paymode'],'Bid'=>$BID,'Deposit_type'=>"WITHDRAWL"]);
		$totamt=DB::table('addbank')->select('TotalAmt')
							->where('Bankid','=',$bankID)
							->first();
		$tt=$totamt->TotalAmt;
		$amt=$tt-$amount1;
		DB::table('addbank')->where('Bankid','=',$bankID)
		                       ->update(['TotalAmt'=>$amt]);
							   
		$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
		$inhandcash1=$inhandcashh->InHandCash;
		$x=$inhandcash1+$amount1;
		DB::table('cash')->where('BID','=',$BID)
						->update(['InHandCash'=>$x]);
		
						
	
		return $id;
	}
	}
