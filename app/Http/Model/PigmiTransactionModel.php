<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\SmsModel;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	
	class PigmiTransactionModel extends Model
	{
		protected $table='pigmi_transaction';
		public $smsmodel;
		public function __construct()
		{
			$this->smsmodel=new SmsModel;
			$this->rv_no = new ReceiptVoucherController;
		}
		
		
		public function AgentPigmiTransaction($allocid,$APdate,$amt)
		{
		
			print_r($allocid);
		
		
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			
			
			//$dte=date("Y-m-d", strtotime($APdate));
			$reportdte=date("Y-m-d", strtotime($APdate));
			
			$Date = date_parse_from_format("Y-m-d",$reportdte);
			$year = $Date["year"];
			$mnt = $Date["month"];
			$time=Date('H:i:s');
			
			//print_r($Date);
			//print_r($dte);
			//print_r($reportdte);
			//print_r($year);
			//print_r($mnt);
			
			$curamt = DB::table('pigmiallocation')->where('PigmiAllocID',$allocid)
			->select('Total_Amount','PigmiTypeid')
			->first();
			
			$CurrentAmount = $curamt->Total_Amount;
			$PigmyTypeId = $curamt->PigmiTypeid;
			$TotalAmount=$CurrentAmount+$amt;
			
			
			DB::table('pigmi_transaction')->insert(['Trans_Date'=>$APdate,'PigReport_TranDate'=>$reportdte,'Trans_Time'=>$time,'Agentid'=>$UID,'PigmiAllocID'=>$allocid,'Current_Balance'=>$CurrentAmount,'Transaction_Type'=>"CREDIT",'Amount'=>$amt,'Particulars'=>"CASH",'PigmiTypeid'=>$PigmyTypeId,'Total_Amount'=>$TotalAmount,'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>"CASH",'PgmCleared_State'=>"CLEARED",'Bid'=>$bid,'CreatedBy'=>$UID,'Pigmy_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"102"]);
			
			$updt=DB::table('pigmiallocation')->where('PigmiAllocID',$allocid)
			->update(['Total_Amount'=>$TotalAmount]);
			
			
			$inhandcashh=DB::table('cash')->select('InHandCash')->where('Bid','=',$bid)->first();
			$inhandcash1=$inhandcashh->InHandCash;
			$totcash=$inhandcash1+$amt;
			DB::table('cash')->where('Bid','=',$bid)
			->update(['InHandCash'=>$totcash]);
			
			
			DB::table('inhandcash_trans')
			->insert(['InhandTrans_Date'=>$reportdte,'InhandTrans_Particular'=>"Amount Credited to Pigmy Account",'InhandTrans_Cash'=>$amt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			
			$msg_dep_amount=$amt;
			$msg_totbal=$TotalAmount;
			$ac_det=DB::table('pigmiallocation')
			->where('PigmiAllocID','=',$allocid)
			->join('user', 'user.Uid', '=', 'pigmiallocation.Uid')
			->join('address', 'address.Aid', '=', 'user.Aid')
			->select('pigmiallocation.PigmiAcc_No','address.MobileNo','user.FirstName','user.MiddleName','user.LastName')
			->first();
			//print_r($id['acctno']);
			//print_r($ac_det);
			$name=$ac_det->FirstName.' '.$ac_det->MiddleName.' '.$ac_det->LastName;
			$mobile=$ac_det->MobileNo;
			$acn=$ac_det->PigmiAcc_No;
			$acn=str_replace("PCIS","****",$acn);
			$acn=str_replace("PG","02**00",$acn);
			$message='Dear '.$name.', Amount of ';
			$message.=$msg_dep_amount;
			$message.=' has been received towards pigmy A/C ';
			$message.=$acn;
			$message.='. Available balance is ';
			$message.=$msg_totbal;
			$message.='. Regards PCI Society.';
			echo $mobile;
			echo '</br>'.$message;
			//$this->smsmodel->SendMSG(60451,$mobile,$message);
			
			
		}
		
		public function insert_pgtran($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			
			$ptdte = $id['ptdte'];
			$allocation_id = $id['acctno'];
			$agent_id = $id['agtid'];
			$amount = $id['pgamount'];
			
			$last_tran_date = DB::table("pigmi_transaction")
				->where("PigmiAllocID",$allocation_id)
				->orderBy("PigReport_TranDate","desc")
				->value("PigReport_TranDate");
			
			if($ptdte < $last_tran_date) {
				return ["error" => "date not valid (date should be greater than {$last_tran_date})"];
			}
			
			
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
				DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			$b=$udetail->BName;
			$bid=$udetail->Bid;
			//echo $b;
			$amount1=$id['pgamount'];
			$pgpay=$id['pgmpaymode'];
			
			
			
			//$dte=date('d-m-Y');
			//$reportdte=date('Y-m-d');
			$mnt=date('m',strtotime($ptdte));
			$year=date('Y',strtotime($ptdte));
			$palid=$id['acctno'];
			$amt=$id['pgbalamt'];
			date_default_timezone_set('Asia/Kolkata');
			$pttme=date('H:i:s');
			
			$pid = DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$id['ptdte'],'PigReport_TranDate'=>$id['ptdte'],'Trans_Time'=>$pttme,'Agentid'=>$id['agtid'],'PigmiAllocID'=>$id['acctno'],'Current_Balance'=>$id['curbal'],'Transaction_Type'=>$id['trtype'],'Amount'=>$id['pgamount'],'Particulars'=>$id['ptpar'],'PigmiTypeid'=>$id['pgtid'],'Total_Amount'=>$id['pgbalamt'],'Month'=>$mnt,'Year'=>$year,'PgmPayment_Mode'=>$id['pgmpaymode'],'PgmCheque_Number'=>$id['pgmchequeno'],'PgmCheque_Date'=>$id['pgmchdate'],'PgmCleared_State'=>$id['pgmunclearedval'],'PgmUncleared_Bal'=>$id['pgmuncleared'],'PgmBank_Name'=>$id['pgmbankname'],'PgmBank_Branch'=>$id['pgmbankbranch'],'PgmIFSC_Code'=>$id['pgmifsccode'],'Bid'=>$id['pgmbranch'],'CreatedBy'=>$UID,'Pigmy_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"102"]);
			
				/***********/
				/* $fn_data["rv_payment_mode"] = $pgpay;
				$fn_data["rv_transaction_id"] = $pid;
				$fn_data["rv_transaction_type"] = $id['trtype'];
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::PG_TRAN;//constant RD_TRAN is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['ptdte'];
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data); */
				/***********/

			$updt=DB::table('pigmiallocation')->where('PigmiAllocID',$palid)
			->update(['Total_Amount'=>$amt]);
			
			
			
			
			
			$msg_dep_amount=$id['pgamount'];
			$msg_totbal=$id['pgbalamt'];
			$ac_det=DB::table('pigmiallocation')
			->where('PigmiAllocID','=',$palid)
			->join('user', 'user.Uid', '=', 'pigmiallocation.Uid')
			->join('address', 'address.Aid', '=', 'user.Aid')
			->select('pigmiallocation.PigmiAcc_No','address.MobileNo','user.FirstName','user.MiddleName','user.LastName')
			->first();
			//print_r($id['acctno']);
			//print_r($ac_det);
			$name=$ac_det->FirstName.' '.$ac_det->MiddleName.' '.$ac_det->LastName;
			$mobile=$ac_det->MobileNo;
			$acn=$ac_det->PigmiAcc_No;
			$acn=str_replace("PCIS","****",$acn);
			$acn=str_replace("PG","02**00",$acn);
			$message='Dear '.$name.', Amount of ';
			$message.=$msg_dep_amount;
			$message.=' has been received towards pigmy A/C ';
			$message.=$acn;
			$message.='. Available balance is ';
			$message.=$msg_totbal;
			$message.='. Regards PCI Society.';
			//echo $mobile;
			//echo '</br>'.$message;
			//$this->smsmodel->SendMSG(60451,$mobile,$message);
			
			
			$pending_pigmy_entry = DB::table("pending_pigmy")
				->where("PendPigmy_AgentUid",$agent_id)//111111)//
				->where("PendPigmy_Status","PENDING")
				->where("PendPigmy_Bid",$BID)
				->orderBy("PendPigmy_CollectionDate","desc")
				->first();
				
			if(!empty($pending_pigmy_id)) {//update
				$pending_pigmy_id = $pending_pigmy_entry->PpId;
				$prev_pending_amount = $pending_pigmy_entry->PendPigmy_PendingAmount;
				$current_pending_amount = $prev_pending_amount + $amount;
				DB::table("pending_pigmy")->where("PpId",$pending_pigmy_id)->update(["PendPigmy_PendingAmount"=>$current_pending_amount]);
			} else {//insert
				$insert_array = array(
										"PendPigmy_AgentUid"		=>	$agent_id,
										"PendPigmy_CollectionDate"	=>	$ptdte,
										"PendPigmy_PendingAmount"	=>	$amount,
										"PendPigmy_Status"			=>	"PENDING",
										"PendPigmy_Bid"				=>	$BID,
										"PenPigmy_AmountReceived"	=>	0,
									);
				DB::table("pending_pigmy")
					->insert($insert_array);
			}
			
			
			if($pgpay!="CHEQUE")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$BID)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$totcash=$inhandcash1+$amount1;
				
				if($ptdte == date("Y-m-d")) {
					DB::table('cash')->where('BID','=',$BID)
					->update(['InHandCash'=>$totcash]);
				
					$trandate=date('Y-m-d',strtotime($ptdte));
					DB::table('inhandcash_trans')
					->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to Pigmy Account",'InhandTrans_Cash'=>$amount1,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
				}
			}
			
			return;
		}
	}

	