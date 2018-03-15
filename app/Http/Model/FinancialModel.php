<?php
	namespace App\Http\Model;
	use DB;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	
	class FinancialModel extends Model
	{
		protected $table='financial';
		
		public function getdata()
		{
			$id = DB::table('legder')->select('lname','lid')->get();
			return $id;
			
		}
		public function getgroup()
		{
		$id = DB::table('legder')->select('lname','lid')
		->where('subhead','=',0)
		->get();
			return $id;
			
		}
	
		
		
		public function InhandCashForFin()
		{
		$uname='';
		if(Auth::user())
		$uname=Auth::user();
		$BrId=$uname->Bid;
		print_r($BrId);
		
			$id = DB::table('cash')->select('InHandCash','cashId','Branch','BID')
			->where('BID','=',$BrId)
			->first();
			return $id;
			
		}
		
		public function getldata()
		{
			$id = DB::table('legder')->select('lname','lid')->get();
			return $id;
			
		} 
		public function getaccto()
		{
			$id = DB::table('legder')->select('lname','lid')->get();
			return $id;
			
		} 
		
		public function pgetaccto()
		{
			$id = DB::table('legder')->select('lname','lid')->get();
			return $id;
			
		} 
		
		public function pgetaccby()
		{
			$id = DB::table('legder')->select('lname','lid')->get();
			return $id;
			
		} 
		
		public function jgetparticular()
		{
		$id = DB::table('legder')->select('lname','lid')->get();
		return $id;
		
		} 
		
		public function jgetparto()
		{
		$id = DB::table('legder')->select('lname','lid')->get();
		return $id;
		
		} 
		public function getbank()
		{
		$id = DB::table('addbank')->select('BankName','Bankid')->get();
		return $id;
		
		} 
		public function getpb()
		{
		$id = DB::table('addbank')->select('BankName','Bankid')->get();
		return $id;
		
		} 
		
		
		public function getlda()
		{
		$id = DB::table('legder')->select('lname','lid')
		->where('subhead','=','0')
		->get();
		return $id;
		
		}	
		
		public function insert($id)
		{
		DB::table('financial')->insertGetId(['credit'=>$id['credit'],'date'=>$id['date'],'stype'=>$id['rtype'],'curbalance'=>$id[curbal],'accountheaderto'=>$id['ahto'],'amountcredit'=>$id['ac'],'amountdebit'=>$id['ad'],'narration'=>$id['narration'],'accountheaderby'=>$id['aby']]);
		DB::table('financial')->insertGetId(['debit'=>$id['debit'],'date'=>$id['date'],'accountheaderto'=>$id['aby'],'curbalance'=>$id[curbal],'amountcredit'=>$id['ad'],'amountdebit'=>$id['ac'],'narration'=>$id['narration'],'accountheaderby'=>$id['ahto']]);
		}
		
		
		
		public function insertion($id)
		{
		DB::table('financial')->insertGetId(['credit'=>$id['cr'],'date'=>$id['dat'],'stype'=>$id['rtype'],'accountheaderto'=>$id['aht'],'amountcredit'=>$id['acre'],'amountdebit'=>$id['adeb'],'narration'=>$id['narr'],'accountheaderby'=>$id['abhy'],'transactiontype'=>$id['ttr'],'chequeno'=>$id['cno'],'chequedate'=>$id['cdate'],'bname'=>$id['bname']]);
		DB::table('financial')->insertGetId(['debit'=>$id['deb'],'date'=>$id['dat'],'accountheaderto'=>$id['abhy'],'amountcredit'=>$id['adeb'],'amountdebit'=>$id['acre'],'narration'=>$id['narr'],'accountheaderby'=>$id['aht'],'transactiontype'=>$id['ttr'],'chequeno'=>$id['cno'],'chequedate'=>$id['cdate'],'bname'=>$id['bname']]);
		}
		
		public function insertp($id)
		{
		DB::table('payment')->insertGetId(['deb'=>$id['dr'],'pdate'=>$id['pdate'],'ptype'=>$id['ptype'],'accheaderto'=>$id['pabhy'],'pacredit'=>$id['pacre'],'padebit'=>$id['padeb'],'pnarration'=>$id['pnarr'],'accheaderby'=>$id['pahy']]);
		DB::table('payment')->insertGetId(['cre'=>$id['cred'],'pdate'=>$id['pdate'],'accheaderto'=>$id['pahy'],'pacredit'=>$id['padeb'],'padebit'=>$id['pacre'],'pnarration'=>$id['pnarr'],'accheaderby'=>$id['pabhy']]);
		}
		
		
		public function insertpr($id)
		{
		DB::table('payment')->insertGetId(['deb'=>$id['pdr'],'pdate'=>$id['pdat'],'ptype'=>$id['ptype'],'accheaderto'=>$id['pabh'],'pacredit'=>$id['pacred'],'padebit'=>$id['padebit'],'pnarration'=>$id['pnarrat'],'accheaderby'=>$id['pahyt'],'ptrantype'=>$id['pttr'],'cheqno'=>$id['pcno'],'cheqdate'=>$id['pcdate'],'bname'=>$id['pbname']]);
		DB::table('payment')->insertGetId(['cre'=>$id['pcred'],'pdate'=>$id['pdat'],'accheaderto'=>$id['pahyt'],'pacredit'=>$id['padebit'],'padebit'=>$id['pacred'],'pnarration'=>$id['pnarrat'],'accheaderby'=>$id['pabh'],'ptrantype'=>$id['pttr'],'cheqno'=>$id['pcno'],'cheqdate'=>$id['pcdate'],'bname'=>$id['pbname']]);
		}
		
		public function insertJ($id)
		{
		DB::table('journal')->insertGetId(['jdebit'=>$id['jpdr'],'jdate'=>$id['jpdat'],'jparticulars'=>$id['jpabh'],'jamcredit'=>$id['jpacred'],'jamdebit'=>$id['jpadebit'],'jnarration'=>$id['jpnarrat'],'jtoparticulars'=>$id['jpahyt']]);
		DB::table('journal')->insertGetId(['jcredit'=>$id['jpcred'],'jdate'=>$id['jpdat'],'jparticulars'=>$id['jpahyt'],'jamcredit'=>$id['jpadebit'],'jamdebit'=>$id['jpacred'],'jnarration'=>$id['jpnarrat'],'jtoparticulars'=>$id['jpabh']]);
		}
		
	/*public function getopening()
	{
	$id=DB::table('inhandcash_trans')->min('InhandTrans_ID')
															   ->where(
	}*/
		
		}
				