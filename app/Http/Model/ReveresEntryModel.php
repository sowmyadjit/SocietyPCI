<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	
	
	class ReveresEntryModel extends Model
	{

		protected $table = 'customer';
		
		public function reversentryindex($id)
		{
			$acid=$id['accid'];
			$dat=$id['startdate'];
			return DB::table('sb_transaction')->select('Tranid','sb_transaction.Accid','sb_transaction.AccTid','TransactionType','particulars','Amount','tran_Date','Total_Bal','AccNum','FirstName','MiddleName','LastName')
			->join('createaccount','createaccount.Accid','=','sb_transaction.Accid')
			->join('user','user.Uid','=','createaccount.Uid')
			->where('sb_transaction.Accid','=',$acid)
			->where('SBReport_TranDate','=',$dat)
			->where('tran_reversed','=',"NO")
			->where("createaccount.deleted",0)
			->paginate(10);
										
			
		}
		
		public function reversentryindexpigmy($id)
		{
			//print_r($id);
			$acid1=$id['accid'];
			$acid=intval($acid1);
			$dat=$id['startdate'];
			$id = DB::table('pigmi_transaction')->select('Trans_Date','PigmiTrans_ID','Transaction_Type','Amount','Particulars','pigmi_transaction.Total_Amount','FirstName','MiddleName','LastName','PigmiAcc_No')
										
										->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
										->join('user','user.Uid','=','pigmiallocation.Uid')
										->where('pigmi_transaction.PigmiAllocID','=',$acid)
										->where('PigReport_TranDate','=',$dat)
										->where('tran_reversed','=',"NO")
										->get();
										//->paginate(10);
										//print_r($id);
										return $id;
										
			
		}
		public function reversentrysb($id)
		{
		
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
				$BID=$uname->bid;
			$tran=$id['tranid'];
			$perticulars=$id['perticulsb'];
			
			$sbdetails=DB::table('sb_transaction')->select('sb_transaction.Accid','sb_transaction.AccTid','TransactionType','particulars','Amount','tran_Date','Total_Bal','Total_Amount','SBReport_TranDate','Time','Month','Year','sb_transaction.Bid')
													->leftJoin('createaccount','createaccount.Accid','=','sb_transaction.Accid')
													->where('Tranid','=',$tran)
													->where("createaccount.deleted",0)
													->first();
			$trntype=$sbdetails->TransactionType;
			$amt=$sbdetails->Amount;
			$tot=$sbdetails->Total_Amount;
			$acid=$sbdetails->Accid;
			$actid=$sbdetails->AccTid;
			$branch=$sbdetails->Bid;
			$dte=Date('Y-m-d');
			
			if($trntype=="credit"||$trntype=="CREDIT"||$trntype=="Credit")
			{
				
				$totamt=(Floatval($tot)-Floatval($amt));
				DB::table('sb_transaction')->insert(['Accid'=>$acid,'AccTid'=>$actid,'TransactionType'=>"DEBIT",'Amount'=>$amt,'Total_Bal'=>$totamt,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
				/*'Month'=>$totamt,'Year'=>$totamt,*/
				DB::table('createaccount')->where('Accid','=',$acid)
										->update(['Total_Amount'=>$totamt]);
										
										
				DB::table('sb_transaction')->where('Tranid','=',$tran)
										->update(['tran_reversed'=>"YES"]);
										
				
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$branch)
				->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1-$amt;
				DB::table('cash')->where('BID','=',$branch)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Debited to SB Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$branch,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
										
										
			}
			else if($trntype=="debit"||$trntype=="DEBIT"||$trntype=="Debit")
			{
				
				$totamt=(Floatval($tot)+Floatval($amt));
				DB::table('sb_transaction')->insert(['Accid'=>$acid,'AccTid'=>$actid,'TransactionType'=>"CREDIT",'Amount'=>$amt,'Total_Bal'=>$totamt,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,/*'Month'=>$totamt,'Year'=>$totamt,*/'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
				
				DB::table('createaccount')->where('Accid','=',$acid)
										->update(['Total_Amount'=>$totamt]);
				DB::table('sb_transaction')->where('Tranid','=',$tran)
										->update(['tran_reversed'=>"YES"]);
										
										
										
										
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$branch)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$amt;
				DB::table('cash')->where('BID','=',$branch)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to SB Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$branch,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			
		}
		
		public function reversentrypigmy($id)
		{
		
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
			$tran=$id['tranid'];
			$perticulars=$id['perticulpigmy'];
			
			$sbdetails= DB::table('pigmi_transaction')->select('PigReport_TranDate','PigmiTrans_ID','Transaction_Type','Amount','Particulars','pigmi_transaction.PigmiAllocID','pigmi_transaction.Bid','pigmi_transaction.PigmiTypeid','pigmiallocation.Total_Amount','PigReport_TranDate','pigmi_transaction.Agentid')
			->join('pigmiallocation','pigmiallocation.PigmiAllocID','=','pigmi_transaction.PigmiAllocID')
			->where('PigmiTrans_ID','=',$tran)
			->first();
			$trntype=$sbdetails->Transaction_Type;
			$amt=$sbdetails->Amount;
			$tot=$sbdetails->Total_Amount;
			$acid=$sbdetails->PigmiAllocID;
			$actid=$sbdetails->PigmiTypeid;
			$branch=$sbdetails->Bid;
			$Trans_Date=$sbdetails->PigReport_TranDate;
			$Agentid=$sbdetails->Agentid;
			$dte=Date('Y-m-d');
			
			if($trntype=="credit"||$trntype=="CREDIT"||$trntype=="Credit")
			{
				
				$totamt=(Floatval($tot)-Floatval($amt));
				DB::table('pigmi_transaction')->insert(['PigmiAllocID'=>$acid,'PigmiTypeid'=>$actid,'Transaction_Type'=>"DEBIT",'Amount'=>$amt,'Total_Amount'=>$totamt,'Trans_Date'=>$dte,'PigReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
				/*'Month'=>$totamt,'Year'=>$totamt,*/
				DB::table('pigmiallocation')->where('PigmiAllocID','=',$acid)
										->update(['Total_Amount'=>$totamt]);
										
										
				DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tran)
										->update(['tran_reversed'=>"YES"]);
										
										
				$pigmy=DB::table('pending_pigmy')->select('PenPigmy_AmountReceived')
				->where('PendPigmy_AgentUid','=',$Agentid)
				->where('PendPigmy_CollectionDate','=',$Trans_Date)
				->first();
				if(!(empty($pigmy)))
				{
				$pigmyamt=$pigmy->PenPigmy_AmountReceived;
					$totpigmyamt=$pigmyamt-$amt;		
				DB::table('pending_pigmy')
				->where('PendPigmy_AgentUid','=',$Agentid)
				->where('PendPigmy_CollectionDate','=',$Trans_Date)
				->update(['PenPigmy_AmountReceived'=>$totpigmyamt]);
				}
										
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$branch)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1-$amt;
				DB::table('cash')->where('BID','=',$branch)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Debited to SB Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$branch,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			else if($trntype=="debit"||$trntype=="DEBIT"||$trntype=="Debit")
			{
				
				$totamt=(Floatval($tot)+Floatval($amt));
				DB::table('pigmi_transaction')->insert(['PigmiAllocID'=>$acid,'PigmiTypeid'=>$actid,'Transaction_Type'=>"DEBIT",'Amount'=>$amt,'Total_Amount'=>$totamt,'Trans_Date'=>$dte,'PigReport_TranDate'=>$dte,'Bid'=>$branch,'particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
				/*'Month'=>$totamt,'Year'=>$totamt,*/
			DB::table('pigmiallocation')->where('PigmiAllocID','=',$acid)
										->update(['Total_Amount'=>$totamt]);
										
										
				DB::table('pigmi_transaction')->where('PigmiTrans_ID','=',$tran)
										->update(['tran_reversed'=>"YES"]);
										
										
			$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$branch)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$amt;
				DB::table('cash')->where('BID','=',$branch)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to pigmy Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$branch,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);							
		
			}
			
		}
		public function reversentryindexrd($id)
		{
			$acid=$id['accid'];
			$dat=$id['startdate'];
			$id= DB::table('rd_transaction')->select('RD_TransID','RD_Date','FirstName','MiddleName','LastName','rd_transaction.Accid','rd_transaction.AccTid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_Total_Bal','Total_Amount','AccNum')
										
										->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
										->join('user','user.Uid','=','createaccount.Uid')
										->where('rd_transaction.Accid','=',$acid)
										->where('RDReport_TranDate','=',$dat)
										->where('tran_reversed','=',"NO")
										->where("createaccount.deleted",0)
										//->paginate(10);
										->get();
										//print_r($id);
							return $id;
		}
		
		public function reversentryrd($id)
		{
		
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$UID=$uname->Uid;
			$tran=$id['tranid'];
			$perticulars=$id['perrd'];
			
			$sbdetails=DB::table('rd_transaction')->select('RD_TransID','RD_Date','rd_transaction.Accid','rd_transaction.AccTid','RD_Trans_Type','RD_Particulars','RD_Amount','RD_Total_Bal','Total_Amount','AccNum','rd_transaction.Bid')
													->join('createaccount','createaccount.Accid','=','rd_transaction.Accid')
													->where('RD_TransID','=',$tran)
													->where("createaccount.deleted",0)
													->first();
			$trntype=$sbdetails->RD_Trans_Type;
			$amt=$sbdetails->RD_Amount;
			$tot=$sbdetails->Total_Amount;
			$acid=$sbdetails->Accid;
			$actid=$sbdetails->AccTid;
			$branch=$sbdetails->Bid;
			$dte=Date('Y-m-d');
			
			if($trntype=="credit"||$trntype=="CREDIT"||$trntype=="Credit")
			{
				
				$totamt=(Floatval($tot)-Floatval($amt));
				DB::table('rd_transaction')->insert(['Accid'=>$acid,'AccTid'=>$actid,'RD_Trans_Type'=>"DEBIT",'RD_Amount'=>$amt,'RD_Total_Bal'=>$totamt,'RD_Date'=>$dte,'RDReport_TranDate'=>$dte,'Bid'=>$branch,'RD_Particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
				/*'Month'=>$totamt,'Year'=>$totamt,*/
				DB::table('createaccount')->where('Accid','=',$acid)
										->update(['Total_Amount'=>$totamt]);
										
										
				DB::table('rd_transaction')->where('RD_TransID','=',$tran)
										->update(['tran_reversed'=>"YES"]);
										
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$branch)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1-$amt;
				DB::table('cash')->where('BID','=',$branch)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Debited to RD  Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$branch,'InhandTrans_Type'=>"Debit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			else if($trntype=="debit"||$trntype=="DEBIT"||$trntype=="Debit")
			{
				
				$totamt=(Floatval($tot)+Floatval($amt));
				DB::table('rd_transaction')->insert(['Accid'=>$acid,'AccTid'=>$actid,'RD_Trans_Type'=>"DEBIT",'RD_Amount'=>$amt,'RD_Total_Bal'=>$totamt,'RD_Date'=>$dte,'RDReport_TranDate'=>$dte,'Bid'=>$branch,'RD_Particulars'=>$perticulars,'CreatedBy'=>$UID,'tran_reversed'=>"YES",'Reveresed_Tran_Id'=>$tran]);
				/*'Month'=>$totamt,'Year'=>$totamt,*/
				DB::table('createaccount')->where('Accid','=',$acid)
										->update(['Total_Amount'=>$totamt]);
										
										
				DB::table('rd_transaction')->where('RD_TransID','=',$tran)
										->update(['tran_reversed'=>"YES"]);
										
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$branch)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$x=$inhandcash1+$amt;
				DB::table('cash')->where('BID','=',$branch)
				->update(['InHandCash'=>$x]);
				
				$trandate=date('Y-m-d');
				//$bid=$udetail->Bid;
				$totcash=$inhandcash1+$amt;
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to RD Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$branch,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			
		}
		
	}
