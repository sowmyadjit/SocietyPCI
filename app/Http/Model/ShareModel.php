<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class ShareModel extends Model
{
    //
	protected $table='shares';
	
	public function insert($id)
    {
		$id = DB::table('shares')->insertGetId(['Share_Class'=> $id['Sclass'],'Facevalue'=>$id['facevalue'],'Share_Price'=>$id['shareprice']]);
	
		return $id;
	}
	
	public function getpurshare()
    {

       $shares = DB::table('shares')->select('Share_Class','Share_Class')->get();
        return $shares;
    }
	
	public function getvalue($id)
	{
		$id=DB::table('shares')->select('Facevalue','Share_Price')->where('Share_Class','=',$id['shclass'])->first();
		
		return $id;
	}
	
	public function sharetypeedit($id)
		{
			
			$id= DB::table('shares')->select('Share_ID','Share_Class','Facevalue','Share_Price')
			->where('Share_ID','=',$id)
			->first();
			return $id;
		}
		public function shareedit($id)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$dte=date('Y-m-d');
			$sid=$id['shareid'];
			$value=$id['facevalue'];
			DB::table('shares')->where('Share_ID','=',$sid)
			->update(['Facevalue'=>$value]);
			$class_name=DB::table('shares')->select('Share_Class')
			->where('Share_ID','=',$sid)
			->first();
			$name=$class_name->Share_Class;
			
			DB::table('sharevalueedited')->insert(['sharevalue_change_Date'=>$dte,'sharevalue'=>$value,'class_Name'=>$name,'sharevalue_changedBY'=>$UID]);
			
			DB::table('individual_shares')->where('individual_share_Class','=',$name)
			->update(['individual_share_status'=>"SUSPEND",'individual_shares_PendingAmount'=>$value]);
			
			//DB::table('purchaseshare')->where('PURSH_Shrclass','=',$name)
			//->update(['Status'=>"SUSPEND"]);
			
			$allshares=DB::table('purchaseshare')->select('PURSH_Shrclass','PURSH_Pid','PURSH_PendingAmount','PURSH_Noofshares')
			->where('PURSH_Shrclass','=',$name)
			->get();
			
			foreach($allshares as $shares)
			{
				$shareclass=$shares->PURSH_Shrclass;
				$purchaseid=$shares->PURSH_Pid;
				$pendingamt=$shares->PURSH_PendingAmount;
				$noushare=$shares->PURSH_Noofshares;
				
				$sharevalue=$value*$noushare;
				
				$totpemdingamt=$pendingamt+$sharevalue;
				
				DB::table('purchaseshare')->where('PURSH_Pid','=',$purchaseid)
				->update(['PURSH_PendingAmount'=>$totpemdingamt,'Status'=>"SUSPEND"]);
				
				
				
				
			}
			
			$allsuspendshares=DB::table('individual_shares')->select('individual_share_Mid','individual_share_Class','individual_share_certificateid','individual_share_ID')
											->where('individual_share_Class',$name)
											->get();
			foreach ($allsuspendshares as $shares)
			{
				$mid=$shares->individual_share_Mid;
				$classname=$shares->individual_share_Class;
				$cid=$shares->individual_share_certificateid;
				$Sid=$shares->individual_share_ID;
				
				DB::table('suspended_shares_detail')->insert(['Suspended_Shares_suspend_Date'=>$dte,'Suspended_Shares_Mid'=>$mid,'Suspended_Shares_Certificate'=>$cid,'Suspended_Shares_Class'=>$classname,'Suspended_Shares_indivauId'=>$Sid]);
				
			}
			
			
			
			
		}
		
/*		public function adddivident($id)
		{
			$dte=Date('Y-m-d');
			$Sid=$id['shareclassid'];
			$SClass=$id['classname'];
			$amt=$id['da'];
			$SusS="2016-04-01";
			$SusE="2016-07-01";
			
		
			DB::table('divident_details')->insert(['Divident_Details_Date'=>$dte,'Divident_Details_Class'=>$SClass,'Divident_Details_Amt'=>$amt]);
			
			
			
			$certificateno=DB::table('purchaseshare')->select('PURSH_Certfid')
									->where('PURSH_Shrclass',$SClass)
									->get();
			foreach ($certificateno as $num)
			{
				$a=$num->PURSH_Certfid;
				
				$shares=DB::table('suspended_shares_detail')->select('Suspended_Shares_Id','Suspended_Shares_suspend_Date','Suspended_Shares_Active_Date','Suspended_Shares_Mid','Suspended_Shares_Certificate','Suspended_Shares_Class','Suspended_Shares_indivauId','Suspended_Shares_SuspendDays')
									->where('Suspended_Shares_Certificate',$a)
									->whereRaw("DATE(Suspended_Shares_suspend_Date) BETWEEN '".$SusS."' AND '".$SusE."'")
									->get();
				foreach ($shares as $s)
				{
					$DaysSuspended=$s->Suspended_Shares_SuspendDays;
					//$DaysSuspended=Intval($DaysSuspended1);
					print_r($DaysSuspended);
					if($DaysSuspended=='NULL')
					{
						//print_r('hai');
						$suspenddate=$s->Suspended_Shares_suspend_Date;
						$activeddate=$s->Suspended_Shares_Active_Date;
						$shre_id=$s->Suspended_Shares_Id;
						$shre_Mid=$s->Suspended_Shares_Mid;
						$shre_Class=$s->Suspended_Shares_Class;
						$shre_Sid=$s->Suspended_Shares_indivauId;
						$shre_Cid=$s->Suspended_Shares_Certificate;
						if($activeddate=="0000-00-00")
						{
							$activeddate=$SusE;
						}
						$date1=date_create($suspenddate);
						$date2=date_create($activeddate);
						$difday=date_diff($date1,$date2);
						$nofdays=$difday->format('%a');
						
						DB::table('suspended_shares_detail')->where('Suspended_Shares_Id',$shre_id)
															->update(['Suspended_Shares_SuspendDays'=>$nofdays]);
															
						DB::table('suspended_shares_detail')->insert(['Suspended_Shares_suspend_Date'=>$SusE,'Suspended_Shares_Mid'=>$shre_Mid,'Suspended_Shares_Certificate'=>$shre_Cid,'Suspended_Shares_Class'=>$shre_Class,'Suspended_Shares_indivauId'=>$shre_Sid]);
						
						
					}
				}
					$supendedays=DB::table('suspended_shares_detail')->where('Suspended_Shares_Certificate',$a)
														->sum('Suspended_Shares_SuspendDays');
														
														
					$tot=DB::table('purchaseshare')->where('PURSH_Certfid',$a)
											->select('Divident_Amt','PURSH_Noofshares')
											->first();
											
					$perviousDividentAmt=$tot->Divident_Amt;	
					$nofshares=$tot->PURSH_Noofshares;	
					
					$totalamt=$nofshares*$amt;
														
					$perday=$amt/365;						
					$deductamt=(Floatval($perday)*Intval($supendedays));
					$totamt=$totalamt-$deductamt;
					
					
											
					
					$DividentAmt=$perviousDividentAmt+$totamt;
					DB::table('purchaseshare')->where('PURSH_Certfid',$a)
											->update(['Divident_Amt'=>$DividentAmt]);
					
					
				
				
			}
			
			
			
			
		}*/
		
		public function adddivident($data)
		{
//			$share_class = $data["share_class"];
			$share_class_id = $data["share_class_id"];
			$percent = $data["div_percent"];
			$start_date = $data["start_date"];
			$end_date = $data["end_date"];
			$diff = date_diff(date_create($start_date),date_create($end_date));
			$total_days = $diff->format('%a');
			print_r($total_days);echo "<br><br>";
			
			$share_class = DB::table("shares")
				->where("Share_ID","=",$share_class_id)
				->value("Share_Class");
			
			$members=DB::table('members')
				->select('Memid','FirstName','MiddleName','LastName','members.Bid','CreatedDate','Remarks','members.status','FatherName','Member_no','classtype',DB::raw("sum(`PURSH_Noofshares`) AS no_of_shares, sum(`PURSH_Totalamt`) as total_share_amt"))
				->join("purchaseshare","purchaseshare.PURSH_Memid","=","members.Memid")
				->where("PURSH_Shrclass","=",$share_class)
				->groupBy("purchaseshare.PURSH_Memid")
				->get();
				
			foreach($members as $key=>$row1)
			{
				$purchaseshare = DB::table("purchaseshare")
					->select("PURSH_Certfid","Divident_Amt","PURSH_Noofshares",'PURSH_Shareamt')
					->where("PURSH_Memid","=",$row1->Memid)
					->where("PURSH_Shrclass","=",$share_class)
					->get();
				$member_divident = 0;
				
				foreach ($purchaseshare as $row2)
				{
					$suspended_shares_detail = DB::table('suspended_shares_detail')
						->select('Suspended_Shares_Id','Suspended_Shares_suspend_Date','Suspended_Shares_Active_Date','Suspended_Shares_Mid', 'Suspended_Shares_Certificate','Suspended_Shares_Class','Suspended_Shares_indivauId','Suspended_Shares_SuspendDays')
						->where('Suspended_Shares_Certificate',"=",$row2->PURSH_Certfid)
						->where('Suspended_Shares_Class',"=",$share_class)
						->whereRaw("DATE(Suspended_Shares_suspend_Date) BETWEEN {$start_date} AND {$end_date}")
						->get();
						
					foreach($suspended_shares_detail as $row3)
					{
						$DaysSuspended=$s->Suspended_Shares_SuspendDays;
						if($DaysSuspended=='NULL')
						{
							$suspend_date=$s->Suspended_Shares_suspend_Date;
							$actived_date=$s->Suspended_Shares_Active_Date;
							$share_id=$s->Suspended_Shares_Id;
							$share_Mid=$s->Suspended_Shares_Mid;
							$share_Class=$s->Suspended_Shares_Class;
							$shre_Sid=$s->Suspended_Shares_indivauId;
							$shre_Cid=$s->Suspended_Shares_Certificate;
							if($actived_date=="0000-00-00")
								$actived_date=$end_date;
							$date1=date_create($suspend_date);
							$date2=date_create($actived_date);
							$difday=date_diff($date1,$date2);
							$nofdays=$difday->format('%a');
							
							DB::table('suspended_shares_detail')
								->where('Suspended_Shares_Id',$share_id)
								->update(['Suspended_Shares_SuspendDays'=>$nofdays]);
								
							DB::table('suspended_shares_detail')
								->insert(['Suspended_Shares_suspend_Date'=>$SusE,'Suspended_Shares_Mid'=>$share_Mid,'Suspended_Shares_Certificate'=>$shre_Cid,'Suspended_Shares_Class'=>$share_Class,'Suspended_Shares_indivauId'=>$shre_Sid]);
						}
					}
					
					$supended_days = DB::table('suspended_shares_detail')
						->where('Suspended_Shares_Certificate',$row2->PURSH_Certfid)
						->sum('Suspended_Shares_SuspendDays');
						
					$div_days = $total_days - $supended_days;
					$div_years = $div_days / 365;
					$div_percent = $percent / 100;
					
					$previous_divident_amount = $row2->Divident_Amt;	
					$no_of_shares = $row2->PURSH_Noofshares;
					$purchase_share_amount = $row2->PURSH_Shareamt;
					$total_share_amount = $no_of_shares * $purchase_share_amount;
					
					$total_divident_amount = round($total_share_amount * $div_years * $div_percent);
					
					$divident_amount = $previous_divident_amount + $total_divident_amount;
/*					DB::table('purchaseshare')
						->where('PURSH_Certfid',$a)
						->update(['Divident_Amt'=>$divident_amount]);*/
						
//					$member_divident += $total_divident_amount;
					$member_divident += $divident_amount;
				}
				
				DB::table('divident')
					->insertGetId(['Memid'=>$row1->Memid,'calculated_date'=>date("Y-m-d"),'start_date'=>$start_date,'end_date'=>$end_date,'bid'=>$row1->Bid,'share_class_id'=>$share_class_id,'divident_amt'=>$member_divident,'status'=>0]);
				
				static $i = 5;//break after 10 entries
				if(!$i--) break;
			}
			
			return;
		}
		
		public function divident_amt_view()
		{
			$divident = DB::table("divident")
				->select("divident.id","divident.Memid","members.Member_no","divident.calculated_date","divident.divident_amt","divident.status","divident.Bid","FirstName","MiddleName","LastName")
				->join("members","members.Memid","=","divident.Memid")
				->where("deleted","=",0)
				->get();
				
			return $divident;
		}
		
		public function edit_div_amt($data)
		{
			return DB::table('divident')
				->where('id',$data['id'])
				->update(['divident_amt'=>$data['divident_amt']]);
		}
		
		public function create_divident()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$divident = DB::table("divident")
				->select()
				->where("deleted","=",0)
				->where("status","=",0)
				->get();
				
			foreach($divident as $row)
			{
				$date = date("Y-m-d");
				$last_transaction = DB::table("divident_transactions")
					->select()
					->where("member_id","=",$row->Memid)
					->orderBy('divident_transactions.transaction_date', 'DESC')
					->orderBy('divident_transactions.div_tran_id', 'DESC')
					->first();
					
				if(!empty($last_transaction)) {
					$current_amount = $last_transaction->total_amount;
				} else {
					$current_amount = 0;
				}
				
				$insert_data["bid"] = $row->bid;
				$insert_data["transaction_date"] = $date;
				$insert_data["member_id"] = $row->Memid;
				$insert_data["current_amount"] = $current_amount;
				$insert_data["divident_amount"] = $row->divident_amt;
				$insert_data["total_amount"] = $current_amount + $row->divident_amt;
				$insert_data["payment_mode"] = "ADJUSTMENT";
				$insert_data["transaction_type"] = 1;	//credit for member account
				$insert_data["particulars"] = "SHARE DIVIDENT";
				$insert_data["start_date"] = $row->start_date;
				$insert_data["end_date"] = $row->end_date;
				$insert_data["share_class_id"] = $row->share_class_id;
				$insert_data["reciept_no"] = 0;
				$insert_data["deleted"] = 0;
				$insert_data["employee_id"] = $UID;
				$insert_data["SubLedgerId"] = DB::table("shares")->where("Share_ID","=",$row->share_class_id)->value("SubLedgerId");
				
				DB::table("divident_transactions")
					->insertGetId($insert_data);
					
				DB::table("divident")
					->where("Memid","=",$row->Memid)
					->update(["status"=>1,"deleted"=>1]);
			}
			return;
		}
		
		public function divident_pay_list_data($data)
		{
			if($data["bid"] == 0) {
				$branch = DB::table("branch")
					->select()
					->get();
				foreach($branch as $row)
					$bids[] = $row->Bid;
			} else {
				$bids[] = $data["bid"];
			}
			
			if($data["share_class_id"] == 0) {
				$shares = DB::table("shares")
					->select()
					->get();
				foreach($shares as $row)
					$share_class_ids[] = $row->Share_ID;
			} else {
				$share_class_ids[] = $data["share_class_id"];
			}
			
			$divident_transactions = array();
			
			$mem_ids = DB::table("divident_transactions")
				->select("member_id")
				->whereIn("bid",$bids)
				->whereIn("share_class_id",$share_class_ids)
				->groupBy("member_id")
				->get();
				
			foreach($mem_ids as $obj)
			{
				$divident_transactions[] = DB::table("divident_transactions")
					->select("FirstName","MiddleName","LastName","member_id","members.Member_no","divident_transactions.bid","total_amount","divident_transactions.bid","Share_Class")
					->join("members","members.Memid","=","divident_transactions.member_id")
				->join("shares","shares.Share_ID","=","divident_transactions.share_class_id")
					->orderBy('divident_transactions.transaction_date', 'DESC')
					->orderBy('divident_transactions.div_tran_id', 'DESC')
					->where("member_id","=",$obj->member_id)
					->first();
			}
			return $divident_transactions;
		}
		
		public function old_pay_individual_divident($data)
		{
		/*	$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$date = date("Y-m-d");
				
			$last_transaction = DB::table("divident_transactions")
				->select()
				->where("member_id","=",$data["member_id"])
				->orderBy('divident_transactions.transaction_date', 'DESC')
				->orderBy('divident_transactions.div_tran_id', 'DESC')
				->first();
				
			$payment_mode = "ADJUSTMENT";
			$particulars = "SHARE DIVIDEND PAY";
		
			$insert_data["bid"] = $last_transaction->bid;
			$insert_data["transaction_date"] = $date;
			$insert_data["member_id"] = $last_transaction->member_id;
			$insert_data["current_amount"] = $last_transaction->total_amount;
			$insert_data["divident_amount"] = $data["amount"];
			$insert_data["total_amount"] = $insert_data["current_amount"] - $insert_data["divident_amount"];
			$insert_data["payment_mode"] = $payment_mode;
			$insert_data["transaction_type"] = 2;	//debit for member account
			$insert_data["particulars"] = $particulars;
			$insert_data["start_date"] = $last_transaction->start_date;
			$insert_data["end_date"] = $last_transaction->end_date;
			$insert_data["share_class_id"] = $last_transaction->share_class_id;
			$insert_data["reciept_no"] = 0;
			$insert_data["deleted"] = 0;
			$insert_data["employee_id"] = $UID;
			$insert_data["SubLedgerId"] = $last_transaction->SubLedgerId;
			
			DB::table("divident_transactions")
				->insertGetId($insert_data);
				
			unset($insert_data);
			$insert_data["Branch_Branch1_Id"] = $last_transaction->bid;
			$insert_data["Branch_Branch2_Id"] = 6;
			$insert_data["Branch_Tran_Date"] = $date;
			$insert_data["Branch_payment_Mode"] = $payment_mode;
			$insert_data["LedgerHeadId"] = 32;
			$insert_data["SubLedgerId"] = $last_transaction->SubLedgerId;
			$insert_data["Branch_Amount"] = $data["amount"];
			$insert_data["Branch_per"] = $particulars;
			
			DB::table("branch_to_branch")
				->insertGetId($insert_data);*/
		}
		
		public function pay_individual_divident($data)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
				
			$last_transaction = DB::table("divident_transactions")
				->select()
				->where("member_id","=",$data["member_id"])
				->orderBy('divident_transactions.transaction_date', 'DESC')
				->orderBy('divident_transactions.div_tran_id', 'DESC')
				->first();
				print_r($last_transaction);
			$particulars = "SHARE DIVIDEND PAY";
			
			$insert_data["bid"] = $last_transaction->bid;
			$insert_data["transaction_date"] = $data["date"];;
			$insert_data["member_id"] = $last_transaction->member_id;
			$insert_data["current_amount"] = $last_transaction->total_amount;
			$insert_data["divident_amount"] = $data["pay_amt"];
			$insert_data["payment_mode"] = $data["payment_mode"];
			$insert_data["transaction_type"] = 2;	//debit for member account
			$insert_data["particulars"] = $particulars;
			$insert_data["start_date"] = $last_transaction->start_date;
			$insert_data["end_date"] = $last_transaction->end_date;
			$insert_data["share_class_id"] = $last_transaction->share_class_id;
			$insert_data["reciept_no"] = 0;
			$insert_data["deleted"] = 0;
			$insert_data["employee_id"] = $UID;
			$insert_data["SubLedgerId"] = $last_transaction->SubLedgerId;
			
			if($data["payment_mode"] == "CASH") {
				$insert_data["total_amount"] = $insert_data["current_amount"] - $insert_data["divident_amount"];
				$insert_data["paid"] = 1;
			} else if($data["payment_mode"] == "CHEQUE") {
				$insert_data["total_amount"] = $insert_data["current_amount"] - $insert_data["divident_amount"];
				$insert_data["chq_no"] = $data["chq_no"];
				$insert_data["chq_date"] = $data["chq_date"];
				$insert_data["bank_id"] = $data["bank_id"];
				$insert_data["paid"] = 1;
			}
			DB::table("divident_transactions")
				->insertGetId($insert_data);
				
			/*unset($insert_data);
			$insert_data["Branch_Branch1_Id"] = $last_transaction->bid;
			$insert_data["Branch_Branch2_Id"] = 6;
			$insert_data["Branch_Tran_Date"] = $date;
			$insert_data["Branch_payment_Mode"] = $data["payment_mode"];
			$insert_data["LedgerHeadId"] = 32;
			$insert_data["SubLedgerId"] = $last_transaction->SubLedgerId;
			$insert_data["Branch_Amount"] = $data["amount"];
			$insert_data["Branch_per"] = $particulars;
			
			DB::table("branch_to_branch")
				->insertGetId($insert_data);*/
		}
		
		public function pay_multiple_divident($data)
		{
			$branches = $this->get_branches();
			$share_classes = $this->get_share_classes();
			foreach($branches as $row1)
				foreach($share_classes as $row2) {
					$branch_amount[$row1->Bid][$row2->Share_ID] = 0;
					$sub_heads[$row2->Share_ID] = $row2->SubLedgerId;
				}
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			
			$date = date("Y-m-d");
			
			$member_ids = explode("#",$data["member_ids"]);
			$amounts = explode("#",$data["amounts"]);
			
			
			foreach($member_ids as $key=>$member_id) {
				$last_transaction = DB::table("divident_transactions")
					->select()
					->where("member_id","=",$member_id)
					->orderBy('divident_transactions.transaction_date', 'DESC')
					->orderBy('divident_transactions.div_tran_id', 'DESC')
					->first();
				$payment_mode = "ADJUSTMENT";
				$particulars = "SHARE DIVIDEND PAY";
				$insert_data["bid"] = $last_transaction->bid;
				$insert_data["transaction_date"] = $date;
				$insert_data["member_id"] = $last_transaction->member_id;
				$insert_data["current_amount"] = $last_transaction->total_amount;
				$insert_data["divident_amount"] = $amounts[$key];
				$insert_data["total_amount"] = $insert_data["current_amount"] - $insert_data["divident_amount"];
				$insert_data["payment_mode"] = $payment_mode;
				$insert_data["transaction_type"] = 2;	//debit for member account
				$insert_data["particulars"] = $particulars;
				$insert_data["start_date"] = $last_transaction->start_date;
				$insert_data["end_date"] = $last_transaction->end_date;
				$insert_data["share_class_id"] = $last_transaction->share_class_id;
				$insert_data["reciept_no"] = 0;
				$insert_data["deleted"] = 0;
				$insert_data["employee_id"] = $UID;
				$insert_data["paid"] = 1;
				$insert_data["SubLedgerId"] = $last_transaction->SubLedgerId;
				DB::table("divident_transactions")
					->insertGetId($insert_data);
					
				$bid = $insert_data["bid"];
				$amt = $amounts[$key];
				$shr_cl_id = $insert_data["share_class_id"];
				$branch_amount[$bid][$shr_cl_id] += $amt;
//			print_r($branch_amount);echo "<br>";
			}
			
			foreach($branch_amount as $bid=>$shr_cl_ids) {
				foreach($shr_cl_ids as $shr_cl_id=>$amt) {
					if($amt != 0 && $bid != 6) {
						$insert_data_b2b["Branch_Branch1_Id"] = 6;
						$insert_data_b2b["Branch_Branch2_Id"] = $bid;
						$insert_data_b2b["Branch_Tran_Date"] = $date;
						$insert_data_b2b["Branch_payment_Mode"] = $payment_mode;
						$insert_data_b2b["LedgerHeadId"] = 32;
						$insert_data_b2b["SubLedgerId"] = $sub_heads[$shr_cl_id];
						$insert_data_b2b["Branch_Amount"] = $amt;
						$insert_data_b2b["Branch_per"] = $particulars;
						DB::table("branch_to_branch")
							->insertGetId($insert_data_b2b);
					}
				}
			}
			
		}
		
		public function divident_report_data($data)
		{
			if($data["bid"] == 0) {
				$branch = DB::table("branch")
					->select()
					->get();
				foreach($branch as $row)
					$bids[] = $row->Bid;
			} else {
				$bids[] = $data["bid"];
			}
			
			if($data["share_class_id"] == 0) {
				$shares = DB::table("shares")
					->select()
					->get();
				foreach($shares as $row)
					$share_class_ids[] = $row->Share_ID;
			} else {
				$share_class_ids[] = $data["share_class_id"];
			}
			
			$divident_transactions = array();
				
			$divident_transactions = DB::table("divident_transactions")
				->select("FirstName","MiddleName","LastName","member_id","members.Member_no","divident_transactions.bid","total_amount","transaction_date","divident_amount","start_date","end_date","Share_Class","branch.BName")
				->join("members","members.Memid","=","divident_transactions.member_id")
				->join("shares","shares.Share_ID","=","divident_transactions.share_class_id")
				->join("branch","branch.Bid","=","divident_transactions.bid")
				->where("transaction_type","=",2)
				->whereIn("divident_transactions.bid",$bids)
				->whereIn("share_class_id",$share_class_ids)
				->orderBy('divident_transactions.transaction_date', 'DESC')
				->orderBy('divident_transactions.div_tran_id', 'DESC')
				->get();
				
			return $divident_transactions;
		}
		
		
		public function Getcertificatnum($id)
		{
			
			
			/*return DB::select("SELECT `Accid` as id, CONCAT(`Accid`,'-',`AccNum`) as name FROM `createaccount` where `AccNum` LIKE '%".$q."%' ");
				return DB::table('purchaseshare')
				->select(DB::raw('PURSH_Pid as id,CONCAT(`PURSH_Certfid`,'-',`PURSH_Shrclass`) as name'))
				->where('Status','=',"Active")
			->get();*/
			
			return DB::table('purchaseshare')
			//->select(DB::raw('PURSH_Pid as id, CONCAT(`PURSH_Certfid`,"-",`PURSH_Shrclass`) as name'))
			->select(DB::raw('PURSH_Pid as id, CONCAT(`PURSH_Certfid`) as name'))
			->where('Status','=',"Active")
			->get();
			
			
		}
		
		public function RetrieveMemData($id) //MA 31-05-16 FOR DIVIDENT TRAN GET MEMBER DATA
		{
			
			$id = DB::table('purchaseshare')
			->select('PURSH_Certfid','FirstName','MiddleName','LastName','PURSH_Noofshares','Divident_Amt','PURSH_Memid','PURSH_Shrclass')
			->leftJoin('members','members.Memid','=','purchaseshare.PURSH_Memid')
			->where('PURSH_Pid',$id)
			->first();
			return $id;
		}
		
/*		public function CreateDividentTransaction($id)//MA 31-05-16 FOR DIVIDENTTRAN CREATE DIVIDENT TRANSACION
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$dte=Date('Y-m-d');
			$dte1=date_create($dte);
			$month=$dte1->format('%m');
			$year=$dte1->format('%Y');
			
			
			$DividentDate=date('Y-m-d');
			$DividentPaid=$id['DividentPaid'];
			
			$DivAmt = DB::table('purchaseshare')
			->select('Divident_Amt','PURSH_PaidDividentAmt')
			->where('PURSH_Certfid',$id['CertificateId'])
			->first();
			
			$DividentAmt=$DivAmt->Divident_Amt;
			$DividentAmtPaid=$DivAmt->PURSH_PaidDividentAmt;
			$RemainingDividentAmt=(floatval($DividentAmt)-floatval($DividentPaid));
			$PaidDividentAmt=(floatval($DividentAmtPaid)+floatval($DividentPaid));
			
			
			$divtran = DB::table('divident_transaction')
			->insertGetId(['Divident_MemId'=>$id['MemberId'],'Divident_CertificateId'=>$id['CertificateId'],'Divident_DividentPaidAmt'=>$id['DividentPaid'],'Divident_PaidDate'=>$DividentDate]);
			
			if(!empty($divtran))
			{
				return DB::table('purchaseshare')->where('PURSH_Certfid',$id['CertificateId'])
				->update(['Divident_Amt'=>$RemainingDividentAmt,'PURSH_PaidDividentAmt'=>$PaidDividentAmt]);
			}
			
			$bal=DB::table('createaccount')->select('Total_Amount')
									->where('Accid',$accid)
									->first();
			$tot=$bal->Total_Amount;
			$totalamt=$tot+$DividentPaid;
			
		DB::table('sb_transaction')->insertGetId(['Accid'=>$id['accid'],'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"DIVIDENT PAID",'Amount'=>$DividentPaid,'CurrentBalance'=>$tot,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$month,'Year'=>$year,'Payment_Mode'=>"SB",'CreatedBy'=>$UID]);
			
			
			
			
		}*/

		public function GetShareTypes()
		{
			$id= DB::table('shares')->select('Share_ID','Share_Class','Facevalue','Share_Price')
			->paginate(10);
			
			/*
			$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','shares')
			->first();
			*/
			
			return $id;
		}
		
		public function GetReqSharesModule()
		{
			$id['module'] = DB::table('modules')->select('Mid')
			->where('MUrl','=','requestshares')
			->first();
			return $id;
		}
		
		public function shareDetails()
		{
			return DB::table('shares')
				->select()
				->get();
		}
		
		public function get_branches()
		{
			return DB::table('branch')
				->select()
				->get();
		}
		
		public function get_share_classes()
		{
			return DB::table('shares')
				->select()
				->get();
		}
	}

	