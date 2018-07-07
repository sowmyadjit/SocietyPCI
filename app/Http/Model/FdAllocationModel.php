<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use App\Http\Model\SmsModel;
	use App\Http\Model\ReceiptVoucherModel;
	use App\Http\Controllers\ReceiptVoucherController;
	use App\Http\Model\SettingsModel;
	
	class FdAllocationModel extends Model
	{
		protected $table='fdallocation';
		public $smsmodel;
		public function __construct()
		{
			$this->smsmodel=new SmsModel;
			$this->rv_no = new ReceiptVoucherController;
			$this->settings = new SettingsModel;
		}
		public function InsertFdAlloc($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
			$respit=$respit1->Recp_No;
			$r=$respit+1;
			DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','BName','branch.Bid','bcode')
			
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$UID)
			->first();
			
			//$b=$udetail->BName;
			$bid=$udetail->Bid;
			
			$RecYear=date('my');
			$dte=date('Y-m-d');
			$branchcd=$udetail->bcode;
			$countinc=1;
			$pmode=$id['fdpaymode'];
			//$edr=$id['fdedte'];
			$fdamt=$id['fddep'];
			$reportenddate=$id['e_dte'];
			$s_date=$id['s_dte'];
		/*	$tempsDate = explode('/',$id['fdedte']);
			$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			//$sdate=date('Y-m-d',strtotime($consDate));
			$reportenddate=date('Y-m-d',strtotime($consDate));
		*/	
			//$reportenddate=date("Y-m-d",strtotime($edr));
		/*	$countfdal=DB::table('fdallocation')
			->where('Fd_CertificateNum','like','%'.$branchcd.'%')
			->count();
			if($countfdal=="")
			{
				$fdcertnum="PCIS".$branchcd."FD".$countinc;
				$FdReceipt=$branchcd.$RecYear."FDA-".$countinc;
			}
			else
			{
			$fdcertnum="PCIS".$branchcd."FD".($countfdal+1);
				$FdReceipt=$branchcd.$RecYear."FDA-".($countfdal+1);
			}
			*/
			
			$maxid=DB::table('fdallocation')->where('FDkcc','<>',"KCC")->where('Bid','=',$bid)->max('Fdid');
			$accnum1=DB::table('fdallocation')->select('Fd_CertificateNum')->where('Fdid','=',$maxid)->first();
			$accnum=$accnum1->Fd_CertificateNum;
		//	print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
				$paccno2=$matches[2];
				
				$paccno3=intval($paccno2)+1;
				$fdcertnum="PCIS".$branchcd."FD".$paccno3;
				
				/***** PREVENT CREATION OF DUPLICATE FD CERTIFICATE NO. *****/
				$got_unique = false;
				while(!$got_unique) {
					$existing_count = DB::table("fdallocation")
						->where("Fd_CertificateNum",$fdcertnum)
						->count();
					if($existing_count > 0) {
						$paccno3++;
						$fdcertnum="PCIS".$branchcd."FD".$paccno3;//NEW FD CERTIFICATE NO
					} else {
						$got_unique = true;
					}
				}
				/***** PREVENT CREATION OF DUPLICATE FD CERTIFICATE NO. *****/


				$FdReceipt=$branchcd.$RecYear."FDA".$paccno3;
			
			$depamt=$id['fddep'];
			$amtpayable=$id['mamt'];
			$intamt=$amtpayable-$depamt;
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$id['uid'],'Relationship'=>$id['reltn']]);
			
			$fd= DB::table('fdallocation')->insertGetId(['Accid'=> $id['accid_int'],'FdTid'=> $id['fdtid'],'Fd_DepositAmt'=> $id['fddep'],'Created_Date'=> $dte,'Fd_StartDate'=> $s_date,'FdReport_StartDate'=> $id['s_dte'],'Fd_CertificateNum'=> $fdcertnum,'Fd_Remarks'=> $id['fdrem'],'Fd_MatureDate'=> $id['e_dte'],'FdReport_MatureDate'=> $reportenddate,'Fd_TotalAmt'=>$id['mamt'],'Bid'=>$id['bid'],'FDPayment_Mode'=>$id['fdpaymode'],'FDChq_No'=>$id['fdchequeno'],'FDChq_Date'=>$id['fdchdate'],'FDBnk_Name'=>$id['FdBankName'],'FDIFSC_Code'=>$id['fdifsccode'],'FDSB_Amt'=>$id['fdsbamount'],'FDBnk_Branch'=>$id['fdbankbranch'],'FDUnclear_Bal'=>$id['fduncleared'],'FDCleared_State'=>$id['fdunclearedval'],'Nid'=>$Nid,'Uid'=>$id['userid'],'interest_amount'=>$intamt,'FD_ReceiptNum'=>$FdReceipt,'FD_resp_No'=>$r,'LedgerHeadId'=>"38",'SubLedgerId'=>"41",'createdBy'=>$UID,'intrest_needed'=>$id['intneeded'],'fdmonth'=>$id['month'],'interstmonth'=>$id['monthinterest'],'lastinterestpaid'=>$dte,'Accid'=>$id['accid_int'],'Days'=>$id['days']]);
			
				/***********/
				$fn_data["rv_payment_mode"] = $id['fdpaymode'];
				$fn_data["rv_transaction_id"] = $fd;
				$fn_data["rv_transaction_type"] = "CREDIT";
				$fn_data["rv_transaction_category"] = ReceiptVoucherModel::FD_ALLOCATION;//constant FD_ALLOCATION is declared in ReceiptVoucherModel
				$fn_data["rv_date"] = $id['s_dte'];
				$fn_data["rv_bid"] = null;
				$this->rv_no->save_rv_no($fn_data);
				unset($fn_data);
				/***********/

			if($pmode=="SB ACCOUNT")
			{
				/*$actid=DB::table('accounttype')
				->select('AccTid')
				->where('Acc_Type','like','%SB%')
				->first();
				$accountid=$actid->AccTid;*/
				$accountid=1;
				
				$sbamt=$id['fdsbamount'];
				$sbrem=$id['sbavailable'];
				$aciddd=$id['accid'];
				
				$id = DB::table('sb_transaction')->insertGetId(['AccTid' => $accountid,'Bid' => $BID,'Accid' => $id['accid'],'TransactionType' => "debit",'particulars' => "Amount debited for FD Account",'Amount' => $id['fddep'],'CurrentBalance' => $id['fdsbamount'],'tran_Date'=>$id['fdalloc'],'SBReport_TranDate'=>$dte,'Total_Bal'=>$id['sbavailable'],'Payment_Mode'=>"FD Account",'Cleared_State'=>"CLEARED",'Uncleared_Bal'=>$id['fdunclearedval']]);
				DB::table('createaccount')->where('Accid',$aciddd)
				->update(['Total_Amount'=>$sbrem]);
			}
			if($pmode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$totcash=$inhandcash1+$fdamt;
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$totcash]);
				
				$trandate=date('Y-m-d');
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to FD Account",'InhandTrans_Cash'=>$fdamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
			
	    	//if($id['acctype']==1)
			// {
				// $ac_det=DB::table('user')->select('user.FirstName','MobileNo')
				// ->leftJoin('address', 'address.Aid', '=', 'user.Aid')
				// ->where('user.Uid', '=', $id['userid'])->first();
				// $mobile=$ac_det->MobileNo;
				// $name=$ac_det->FirstName;
				
			//	$message='Dear '.$name.', Fixed Deposit bearing A/c No.'.$fdcertnum.' of Rs.'.$id['fddep'].' with maturity date '.$id['fdedte'].' has been created. Regards PCI Society';
				
				
				//	$this->smsmodel->SendMSG(60290,$mobile,$message);
				
				
			//}
		}
		
		public function getallocdetail()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			return DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum','Fd_OldCertificateNum','Days')
			->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
			//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->where('fdallocation.Bid','=',$BID)
			->orderby('Fdid','desc')
//			->paginate(15);
			->get();
		}
		
		public function getallocdetail_all()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			return DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum','Fd_OldCertificateNum','Days')
			->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
			//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->where('fdallocation.Bid','=',$BID)
			->orderby('Fdid','desc')
			->get();
		}
		
		public function FDSearchData($id)//M 19-4-16 For FDSearch.blade
		{
			
			return DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum','Days')
			->join('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
			//->join('createaccount','createaccount.Accid','=','fdallocation.Accid')
			->join('user','user.Uid','=','fdallocation.Uid')
			->where('Fdid','=',$id)
			->get();
		}
		
		public function GetBranchCode($fdbranch)
		{
			$id=DB::table('branch')
			->select('BCode')
			->where('Bid','=',$fdbranch)
			->first();
			return $id;
		}
		
		//Get Bank Name (Newly Added)
		/*	public function getbnknme($addbank)
			{
			$addbank=DB::table('addbank')
			->select('BankName','Bankid')
			->where('Branch','like',$addbank)
			//->where('Status','=',"AUTHORISED")
			->get();
			return $addbank;
		}*/
		
		//
		public function GetSBAmt($id)
		{
			$maxid=DB::table('sb_transaction')
			->where('Accid','=',$id)
			->max('Tranid');
			return DB::table('sb_transaction')
			->select('Total_Bal')
			->where('Accid','=',$id)
			->where('Tranid','=',$maxid)
			->first();
		}
		
		public function GetFdCertificate($id)
		{
			$id = DB::table('fdallocation')->select('Fdid','fdallocation.Accid','fdallocation.FdTid','fdallocation.Nid','fdallocation.Bid','createaccount.Uid','Custid','createaccount.AccNum','createaccount.AccTid','user.FirstName','user.MiddleName','user.LastName','user.Aid','Gender','MaritalStatus','Occupation','Age','Birthdate','address.Email','Address','City','District','State','PhoneNo','MobileNo','Pincode','BName','FdType','NumberOfDays','FdInterest','Nom_FirstName','Nom_MiddleName','Nom_LastName','Relationship','Nom_Address','Nom_Age','Nom_Birthdate','Nom_City','Nom_District','Nom_Email','Nom_Gender','Nom_Marital_Status','Nom_MobNo','Nom_Occupation','Nom_PhoneNo','Nom_Pincode','Nom_state','Fd_DepositAmt','Fd_StartDate','FdReport_StartDate','Fd_MatureDate','FdReport_MatureDate','Fd_CertificateNum','Fd_TotalAmt','Fd_Remarks','FDPayment_Mode','FDChq_No','FDChq_Date','FDBnk_Name','FDIFSC_Code','FDSB_Amt','FDBnk_Branch','FDUnclear_Bal','FDCleared_State','FatherName','SpouseName','CustomerType','FD_ReceiptNum','Fd_CertiPrint','FDkcc','Days')
			->leftJoin('createaccount','createaccount.Accid', '=' , 'fdallocation.Accid')
			->leftJoin('user','user.Uid', '=' , 'fdallocation.Uid')
			//->leftJoin('user','user.Uid', '=' , 'createaccount.Uid')
			->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
			->leftJoin('address','address.Aid', '=' , 'user.Aid')
			->leftJoin('branch', 'branch.Bid', '=' , 'fdallocation.Bid')
			->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
			->leftJoin('nominee', 'nominee.Nid', '=' , 'fdallocation.Nid')
			->where('Fdid',$id)
			->get();
			
			return $id;
			
		}
		
		public function GetFDNumForLoanAlloc($q)
		{
			//return DB::select("SELECT `Fdid` as id, CONCAT(`Fdid`,'-',`Fd_CertificateNum`) as name FROM `fdallocation` where `Fd_CertificateNum` LIKE '%".$q."%' ");
			
			return DB::table('fdallocation')
			->select(DB::raw('Fdid as id, CONCAT(`Fdid`,"-",`Fd_CertificateNum`) as name'))
			->where('Closed','=',"NO")
			->get();
			
		}
		
		public function GetFDNumberForLoanAlloc($q) //for DL allocation typeahead
		{
			//return DB::select("SELECT `Fdid` as id, CONCAT(`Fdid`,'-',`Fd_CertificateNum`) as name FROM `fdallocation` where `Fd_CertificateNum` LIKE '%".$q."%' ");
			
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('fdallocation')
			->select(DB::raw('Fdid as id,Fd_CertificateNum as name'))
			->where('Closed','=',"NO");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("fdallocation.Bid",$BID);
			}
			//->where('Loan_Allocated','=',"NO")
			//->where('Status','=',"AUTHORISED")
			$ret_data = $ret_data->get();
			return $ret_data;
			
		}
		
		
		public function GetSearchFdAccWithOldAcc($q) //FOR FdLedgerHome from Search Controller GetSearchFdAccWithOldAcc function
		{
			
			return DB::select("SELECT `Fdid` as id, CONCAT(`Fd_OldCertificateNum`,'/',`Fd_CertificateNum`,':',CASE Closed
			WHEN 'YES' THEN 'Closed'
			WHEN 'NO' THEN 'Active'
			ELSE Closed
            END) as name FROM `fdallocation` where `Fd_CertificateNum` LIKE '%FD%' ");
			
		}
		
		public function SearchFdAllocation($q)//M 19-4-16 For fdallocation.blade to search fdallocation
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
		
			return DB::table('fdallocation')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->select(DB::raw('Fdid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`," , ",`Fd_CertificateNum`," / ",`Fd_OldCertificateNum`) as name'))
			->where('fdallocation.Bid',$BID)
			->get();
		}
		
		public function SearchKCCAllocation($q)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
		
			return DB::table('fdallocation')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->select(DB::raw('Fdid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`," , ",`Fd_CertificateNum`," / ",`Fd_OldCertificateNum`) as name'))
			->where('fdallocation.Bid',$BID)
			->where('fdallocation.FdTid','1')
			->get();
		}
		
		public function FdCertStatUpdate($id)
		{
			$Fdid = $id['Fdid'];
			
			$stat1 = DB::table('fdallocation')
			->select('Fd_CertiPrint')
			->where('Fdid',$Fdid)
			->first();
			
			$stat = $stat1->Fd_CertiPrint;
			
			print_r($stat);
			if($stat=="NO")
			{
				DB::table('fdallocation')
				->where('Fdid',$Fdid)
				->update(['Fd_CertiPrint'=>"YES"]);
			}
		}
		public function crtkccalloc($id)
		{
			
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
			
			//$b=$udetail->BName;
			$bid=$udetail->Bid;
			
			$RecYear=date('my');
			$dte=date('Y-m-d');
			$branchcd=$id['branchcode'];
			$countinc=1;
			$pmode=$id['fdpaymode'];
			//$edr=$id['fdedte'];
			$fdamt=$id['fddep'];
			$tempsDate = explode('/',$id['fdedte']);
			$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			//$sdate=date('Y-m-d',strtotime($consDate));
			$reportenddate=date('Y-m-d',strtotime($consDate));
			
			//$reportenddate=date("Y-m-d",strtotime($edr));
			/*$countfdal=DB::table('fdallocation')
			->where('Fd_CertificateNum','like','%'.$branchcd.'%')
			->count();
			if($countfdal=="")
			{
				$fdcertnum="PCIS".$branchcd."FD".$countinc;
				$FdReceipt=$branchcd.$RecYear."FDA-".$countinc;
			}
			else
			{
				$fdcertnum="PCIS".$branchcd."FD".($countfdal+1);
				$FdReceipt=$branchcd.$RecYear."FDA-".($countfdal+1);
			}*/
			
			$maxid=DB::table('fdallocation')->where('Bid','=',$BID)->where('FDkcc','=',"KCC")->max('Fdid');
			if($maxid==0)
			{
				
				$paccno3=1;
			}
			else
			{
				$accnum1=DB::table('fdallocation')->select('Fd_CertificateNum')->where('Fdid','=',$maxid)->first();
			$accnum=$accnum1->Fd_CertificateNum;
			//print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
				$paccno2=$matches[2];
				$paccno3=intval($paccno2)+1;
				
			}
			
			
			$fdcertnum="PCIS".$branchcd."KCC".$paccno3;
			
			
			
			
			$depamt=$id['fddep'];
			$amtpayable=$id['mamt'];
			$intamt=$amtpayable-$depamt;
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$id['uid'],'Relationship'=>$id['reltn']]);
			
			$days = DB::table("fdtype")
				->where("FdTid","=",$id['fdtid'])
				->value("NumberOfDays");
			
			$fd= DB::table('fdallocation')->insertGetId(['Accid'=> $id['accid'],'FdTid'=> $id['fdtid'],'Fd_DepositAmt'=> $id['fddep'],'Created_Date'=> $dte,'Fd_StartDate'=> $id['fdalloc'],'FdReport_StartDate'=> $id['fdallocreport'],'Fd_CertificateNum'=> $fdcertnum,'Fd_Remarks'=> $id['fdrem'],'Fd_MatureDate'=> $id['fdedte'],'FdReport_MatureDate'=> $reportenddate,'Fd_TotalAmt'=>$id['mamt'],'Bid'=>$id['bid'],'FDPayment_Mode'=>$id['fdpaymode'],'FDChq_No'=>$id['fdchequeno'],'FDChq_Date'=>$id['fdchdate'],'FDBnk_Name'=>$id['FdBankName'],'FDIFSC_Code'=>$id['fdifsccode'],'FDSB_Amt'=>$id['fdsbamount'],'FDBnk_Branch'=>$id['fdbankbranch'],'FDUnclear_Bal'=>$id['fduncleared'],'FDCleared_State'=>$id['fdunclearedval'],'Nid'=>$Nid,'Uid'=>$id['userid'],'interest_amount'=>$intamt,'FD_resp_No'=>$r,'lastinterestpaid'=>$dte,'Accid'=>$id['accid'],'FDkcc'=>"KCC",'LedgerHeadId'=>"38",'SubLedgerId'=>"40","Days"=>$days]);
			
			if($pmode=="SB ACCOUNT")
			{
				$actid=DB::table('accounttype')
				->select('AccTid')
				->where('Acc_Type','like','%SB%')
				->first();
				$accountid=$actid->AccTid;
				
				$sbamt=$id['fdsbamount'];
				$sbrem=$id['sbavailable'];
				
				$id = DB::table('sb_transaction')->insertGetId(['AccTid' => $accountid,'Bid' => $id['bid'],'Accid' => $id['accid'],'TransactionType' => "debit",'particulars' => "Amount debited for KCC Account",'Amount' => $id['fddep'],'CurrentBalance' => $id['fdsbamount'],'tran_Date'=>$id['fdalloc'],'SBReport_TranDate'=>$id['fdallocreport'],'Total_Bal'=>$id['sbavailable'],'Payment_Mode'=>"FD Account",'Cleared_State'=>"CLEARED",'Uncleared_Bal'=>$id['fdunclearedval']]);
			}
			if($pmode=="CASH")
			{
				$inhandcashh=DB::table('cash')->select('InHandCash')->where('BID','=',$bid)->first();
				$inhandcash1=$inhandcashh->InHandCash;
				$totcash=$inhandcash1+$fdamt;
				DB::table('cash')->where('BID','=',$bid)
				->update(['InHandCash'=>$totcash]);
				
				$trandate=date('Y-m-d');
				DB::table('inhandcash_trans')
				->insert(['InhandTrans_Date'=>$trandate,'InhandTrans_Particular'=>"Amount Credited to FD Account",'InhandTrans_Cash'=>$fdamt,'InhandTrans_Bid'=>$bid,'InhandTrans_Type'=>"Credit",'Present_Inhandcash'=>$inhandcash1,'Total_InhandCash'=>$totcash]);
			}
		}
		public function kccallocation()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			
			return DB::table('fdallocation')->select('fdtype.NumberOfDays','fdtype.FdInterest','Fd_DepositAmt','Fd_StartDate','Fd_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fd_Remarks','Fdid','fdtype.FdTid','user.Uid','user.FirstName','user.MiddleName','user.LastName','Fd_CertificateNum','Fd_OldCertificateNum','Custid')
			->leftJoin('fdtype','fdtype.FdTid','=','fdallocation.FdTid')
			->leftJoin('user','user.Uid','=','fdallocation.Uid')
			->leftJoin('customer','customer.Uid','=','fdallocation.Uid')
			->where('fdallocation.Bid','=',$BID)
			->where('FDkcc','=',"KCC")
			->orderby('Fdid','desc')
			->get();
		}

		public function fdrenew($id)
		{
			$fdtyp=$id['fdtype'];
			$fdaccno=$id['fdaccno'];
			$fdmatur=$id['fdmatureaccno'];
			if($fdtyp=="MATURED")
			{
				$id = DB::table('fdallocation')->select('Fdid','fdallocation.Accid','fdallocation.FdTid','fdallocation.Nid','fdallocation.Bid','user.Uid','Custid','createaccount.AccNum','createaccount.AccTid','user.FirstName','user.MiddleName','user.LastName','user.Aid','Gender','MaritalStatus','Occupation','Age','Birthdate','address.Email','Address','City','District','State','PhoneNo','MobileNo','Pincode','BName','FdType','NumberOfDays','FdInterest','Nom_FirstName','Nom_MiddleName','Nom_LastName','Relationship','Nom_Address','Nom_Age','Nom_Birthdate','Nom_City','Nom_District','Nom_Email','Nom_Gender','Nom_Marital_Status','Nom_MobNo','Nom_Occupation','Nom_PhoneNo','Nom_Pincode','Nom_state','Fd_DepositAmt','Fd_StartDate','FdReport_StartDate','Fd_MatureDate','FdReport_MatureDate','Fd_CertificateNum','Fd_TotalAmt','Fd_Remarks','FDPayment_Mode','FDChq_No','FDChq_Date','FDBnk_Name','FDIFSC_Code','FDSB_Amt','FDBnk_Branch','FDUnclear_Bal','FDCleared_State','FatherName','SpouseName','CustomerType','FD_ReceiptNum','Fd_CertiPrint')
				->leftJoin('createaccount','createaccount.Accid', '=' , 'fdallocation.Accid')
				->leftJoin('user','user.Uid', '=' , 'fdallocation.Uid')
				//->leftJoin('user','user.Uid', '=' , 'createaccount.Uid')
				->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
				->leftJoin('address','address.Aid', '=' , 'user.Aid')
				->leftJoin('branch', 'branch.Bid', '=' , 'fdallocation.Bid')
				->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
				->leftJoin('nominee', 'nominee.Nid', '=' , 'fdallocation.Nid')
				->where('Fdid',$fdmatur)
				->first();
				//print_r($id);
				return $id;
			}
			else if($fdtyp=="PREWITHDRAWAL")
			{
				
			}
			
			
			
		}

		public function kccrenew($id)
		{
			$fdtyp=$id['fdtype'];
			$fdaccno=$id['fdaccno'];
			$fdmatur=$id['fdmatureaccno'];
			if($fdtyp=="MATURED")
			{
				$id = DB::table('fdallocation')
					->select('Fdid','fdallocation.Accid','fdallocation.FdTid','fdallocation.Nid','fdallocation.Bid','user.Uid','Custid','createaccount.AccNum','createaccount.AccTid','user.FirstName','user.MiddleName','user.LastName','user.Aid','Gender','MaritalStatus','Occupation','Age','Birthdate','address.Email','Address','City','District','State','PhoneNo','MobileNo','Pincode','BName','FdType','NumberOfDays','FdInterest','Nom_FirstName','Nom_MiddleName','Nom_LastName','Relationship','Nom_Address','Nom_Age','Nom_Birthdate','Nom_City','Nom_District','Nom_Email','Nom_Gender','Nom_Marital_Status','Nom_MobNo','Nom_Occupation','Nom_PhoneNo','Nom_Pincode','Nom_state','Fd_DepositAmt','Fd_StartDate','FdReport_StartDate','Fd_MatureDate','FdReport_MatureDate','Fd_CertificateNum','Fd_TotalAmt','Fd_Remarks','FDPayment_Mode','FDChq_No','FDChq_Date','FDBnk_Name','FDIFSC_Code','FDSB_Amt','FDBnk_Branch','FDUnclear_Bal','FDCleared_State','FatherName','SpouseName','CustomerType','FD_ReceiptNum','Fd_CertiPrint')
					->leftJoin('createaccount','createaccount.Accid', '=' , 'fdallocation.Accid')
					->leftJoin('user','user.Uid', '=' , 'fdallocation.Uid')
					->leftJoin('customer','customer.Uid', '=' , 'user.Uid')
					->leftJoin('address','address.Aid', '=' , 'user.Aid')
					->leftJoin('branch', 'branch.Bid', '=' , 'fdallocation.Bid')
					->leftJoin('fdtype', 'fdtype.FdTid', '=' , 'fdallocation.FdTid')
					->leftJoin('nominee', 'nominee.Nid', '=' , 'fdallocation.Nid')
					->where('Fdid',$fdmatur)
					->first();
				return $id;
			}
			else if($fdtyp=="PREWITHDRAWAL")
			{
				
			}
		}

		public function fdrenewdetails($id)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			$BID=$uname->Bid;
			$respit1=DB::table('branch')->select('Recp_No','BCode')->where('Bid',$BID)->first();
			$respit=$respit1->Recp_No;
			$branchcd=$respit1->BCode;
			$r=$respit+1;
			DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);
			$RecYear=date('my');
			$dte=date('Y-m-d');
			//$tempsDate = explode('/',$id['fdedtereadonly']);
			//$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			//$sdate=date('Y-m-d',strtotime($consDate));
			//$reportenddate=date('Y-m-d',strtotime($consDate));
			$reportenddate=$id['fdedte'];
			
			
		/*	$countfdal=DB::table('fdallocation')
			->where('Fd_CertificateNum','like','%'.$branchcd.'%')
			->count();
			$fdcertnum="PCIS".$branchcd."FD".($countfdal+1);*/
			
			
			
			
			$maxid=DB::table('fdallocation')->where('FDkcc','<>',"KCC")->where('Bid','=',$BID)->max('Fdid');
			$accnum1=DB::table('fdallocation')->select('Fd_CertificateNum')->where('Fdid','=',$maxid)->first();
			$accnum=$accnum1->Fd_CertificateNum;
		//	print_r($accnum);
			$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
				$paccno2=$matches[2];
				
				$paccno3=intval($paccno2)+1;
				$fdcertnum="PCIS".$branchcd."FD".$paccno3;
				//$FdReceipt=$branchcd.$RecYear."FDA".$paccno3;
				
				/***** PREVENT CREATION OF DUPLICATE FD CERTIFICATE NO. *****/
				$got_unique = false;
				while(!$got_unique) {
					$existing_count = DB::table("fdallocation")
						->where("Fd_CertificateNum",$fdcertnum)
						->count();
					if($existing_count > 0) {
						$paccno3++;
						$fdcertnum="PCIS".$branchcd."FD".$paccno3;//NEW FD CERTIFICATE NO
					} else {
						$got_unique = true;
					}
				}
				/***** PREVENT CREATION OF DUPLICATE FD CERTIFICATE NO. *****/
			
			
			$depamt=$id['depositamount'];
			$amtpayable=$id['mamt'];
			$intamt=$amtpayable-$depamt;
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$id['userid'],'Relationship'=>$id['reltn']]);
			
			$fd= DB::table('fdallocation')->insertGetId(['FdTid'=> $id['interest'],'Fd_DepositAmt'=> $id['depositamount'],'Created_Date'=> $dte,'Fd_StartDate'=> $id['fdallocstaet'],'FdReport_StartDate'=>$id['fdallocstaet'],'Fd_CertificateNum'=> $fdcertnum,'Fd_MatureDate'=>  $id['fdedte'],'FdReport_MatureDate'=> $id['fdedte'],'Fd_TotalAmt'=>$id['mamt'],'Bid'=>$id['branchid'],'FDPayment_Mode'=>"RENEWAL",'Nid'=>$Nid,'Uid'=>$id['userid'],'interest_amount'=>$intamt,'FD_resp_No'=>$r,'intrest_needed'=>$id['intneeded'],'fdmonth'=>$id['month'],'interstmonth'=>$id['monthinterest'],'lastinterestpaid'=>$id['fdallocstaet'],'Accid'=>$id['accid'],'Days'=>$id['days']]);
			$fdid=$id['fdallocid'];
			 
			$fd1=DB::table('fdallocation')->select('Fd_TotalAmt','Fd_CertificateNum')->where('Fdid','=',$fdid)->first();
			$fd=$fd1->Fd_TotalAmt;
			$fdacc=$fd1->Fd_CertificateNum;
			$remainamt=$fd-$depamt;
			if($remainamt <= 0)
			{
				DB::table('fdallocation')->where('Fdid','=',$fdid)->update(['Paid_State'=>"PAID"]);
			}
			DB::table('fd_payamount')->insertGetId(['FDPayAmt_AccNum'=>$fdacc,'FDPayAmt_PaymentMode'=>"RENEWAL",'FDPayAmt_PayableAmount'=>$id['depositamount'],'FDPayAmt_PayDate'=>$dte,'FDPayAmtReport_PayDate'=>$dte,'FDPayAmt_IntType'=>"MATURED",'Bid'=>$BID]);
			DB::table('fdallocation')->where('Fdid','=',$fdid)->update(['Fd_TotalAmt'=>$remainamt,"fd_renewed"=>"YES","renewed_amount"=>$id['mamt']]);
			
			
		}
		
		public function kccrenewdetails($id)
		{
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
			
			//$b=$udetail->BName;
			$bid=$udetail->Bid;
			
			$RecYear=date('my');
			$dte=date('Y-m-d');
			$respit1=DB::table('branch')->select('Recp_No','BCode')->where('Bid',$BID)->first();
			$branchcd=$respit1->BCode;
			// $branchcd=$id['branchcode'];
			$countinc=1;
			$pmode=$id['fdpaymode'];
			//$edr=$id['fdedte'];
			$fdamt=$id['fddep'];
			$tempsDate = explode('/',$id['fdedte']);
			$consDate = $tempsDate[2]."-".$tempsDate[1]."-".$tempsDate[0];
			//$sdate=date('Y-m-d',strtotime($consDate));
			$reportenddate=date('Y-m-d',strtotime($consDate));
			

			$maxid=DB::table('fdallocation')->where('Bid','=',$BID)->where('FDkcc','=',"KCC")->max('Fdid');
			if($maxid==0)
			{
				$paccno3=1;
			}
			else
			{
				$accnum1=DB::table('fdallocation')->select('Fd_CertificateNum')->where('Fdid','=',$maxid)->first();
				$accnum=$accnum1->Fd_CertificateNum;
				//print_r($accnum);
				$paccno1=preg_match('#([a-z]+)([\d]+)#i',$accnum,$matches);
				$paccno2=$matches[2];
				$paccno3=intval($paccno2)+1;
			}
			$fdcertnum="PCIS".$branchcd."KCC".$paccno3;
			
				/***** PREVENT CREATION KCC DUPLICATE FD CERTIFICATE NO. *****/
				$got_unique = false;
				while(!$got_unique) {
					$existing_count = DB::table("fdallocation")
						->where("Fd_CertificateNum",$fdcertnum)
						->count();
					if($existing_count > 0) {
						$paccno3++;
						$fdcertnum="PCIS".$branchcd."KCC".$paccno3;//NEW KCC CERTIFICATE NO
					} else {
						$got_unique = true;
					}
				}
				/***** PREVENT CREATION OF DUPLICATE KCC CERTIFICATE NO. *****/

			
			$depamt=$id['fddep'];
			$amtpayable=$id['mamt'];
			$intamt=$amtpayable-$depamt;
			
			$Nid=DB::table('nominee')->insertGetId(['Nom_Address'=>$id['nadd'],'Nom_Age'=>$id['nage'],'Nom_Birthdate'=>$id['nbdate'],'Nom_City'=>$id['ncity'],'Nom_District'=>$id['ndist'],'Nom_Email'=>$id['nemail'],'Nom_FirstName'=>$id['nfname'],'Nom_Gender'=>$id['ngender'],'Nom_LastName'=>$id['nlname'],'Nom_Marital_Status'=>$id['nmstate'],'Nom_MiddleName'=>$id['nmname'],'Nom_MobNo'=>$id['nmno'],'Nom_Occupation'=>$id['noccup'],'Nom_PhoneNo'=>$id['npno'],'Nom_Pincode'=>$id['npin'],'Nom_State'=>$id['nstate'],'Uid'=>$id['uid'],'Relationship'=>$id['reltn']]);
			
			$days = DB::table("fdtype")
				->where("FdTid","=",$id['fdtid'])
				->value("NumberOfDays");
			
			$fdid= DB::table('fdallocation')->insertGetId(['Accid'=> $id['accid'],'FdTid'=> $id['fdtid'],'Fd_DepositAmt'=> $id['fddep'],'Created_Date'=> $dte,'Fd_StartDate'=> $id['fdalloc'],'FdReport_StartDate'=> $id['fdallocreport'],'Fd_CertificateNum'=> $fdcertnum,'Fd_Remarks'=> $id['fdrem'],'Fd_MatureDate'=> $id['fdedte'],'FdReport_MatureDate'=> $reportenddate,'Fd_TotalAmt'=>$id['mamt'],'Bid'=>$BID,'FDPayment_Mode'=>$id['fdpaymode'],'FDChq_No'=>$id['fdchequeno'],'FDChq_Date'=>$id['fdchdate'],'FDBnk_Name'=>$id['FdBankName'],'FDIFSC_Code'=>$id['fdifsccode'],'FDSB_Amt'=>$id['fdsbamount'],'FDBnk_Branch'=>$id['fdbankbranch'],'FDUnclear_Bal'=>$id['fduncleared'],'FDCleared_State'=>$id['fdunclearedval'],'Nid'=>$Nid,'Uid'=>$id['userid'],'interest_amount'=>$intamt,'FD_resp_No'=>$r,'lastinterestpaid'=>$dte,'Accid'=>$id['accid'],'FDkcc'=>"KCC",'LedgerHeadId'=>"38",'SubLedgerId'=>"40","Days"=>$days]);
			
			$old_kcc_id = $id["old_kcc_id"];
			$fd1=DB::table('fdallocation')->select('Fd_TotalAmt','Fd_CertificateNum')->where('Fdid','=',$old_kcc_id)->first();
			$fd=$fd1->Fd_TotalAmt;
			$fdacc=$fd1->Fd_CertificateNum;
			$remainamt=$fd-$depamt;// var_dump($remainamt);
			if($remainamt <= 0)
			{
				DB::table('fdallocation')->where('Fdid','=',$old_kcc_id)->update(['Paid_State'=>"PAID"]);
			}
			DB::table('fd_payamount')->insertGetId(['FDPayAmt_AccNum'=>$fdacc,'FDPayAmt_PaymentMode'=>"RENEWAL",'FDPayAmt_PayableAmount'=>$id['fddep'],'FDPayAmt_PayDate'=>$dte,'FDPayAmtReport_PayDate'=>$dte,'FDPayAmt_IntType'=>"MATURED",'Bid'=>$BID]);
			DB::table('fdallocation')->where('Fdid','=',$old_kcc_id)->update(['Fd_TotalAmt'=>$remainamt,"fd_renewed"=>"YES","renewed_amount"=>$id['fddep']]);
			// var_dump($id['fddep']);
			return "done";
		}

		public function FDedit($id)
		{
			return DB::table('fdallocation')->select('Fd_CertificateNum','Fd_OldCertificateNum','FdReport_StartDate','FdReport_MatureDate','Fd_DepositAmt','Fd_TotalAmt','Fdid')->where('Fdid',$id)->first();
			
		}
		public function editfd($id)
		{
			return DB::table('fdallocation')->where('Fdid',$id['alocid'])->update(['FdReport_StartDate'=>$id['cd'],'FdReport_MatureDate'=>$id['ed'],'Fd_DepositAmt'=>$id['ta'],'Fd_TotalAmt'=>$id['ta1'],'Fd_StartDate'=>$id['cd'],'Fd_MatureDate'=>$id['ed']]);
			
			
			
		}
		public function crtfdalloc()
		{
			return DB::table('fdtype')->distinct()->get();
			
		}
	}
?>