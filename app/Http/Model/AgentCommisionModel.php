<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Http\Response;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	use File;
	use Storage;
	//use App\Http\Model\AgentCommisionModel;
	
	class AgentCommisionModel extends Model
	{
		
		protected $table = 'pigmiallocation';
		
		
		public function agentdownloadsubmit($id)
		{
			$agid = $id['agentid'];
			
			$allaccount=DB::table('pigmiallocation')->select('pigmiallocation.PigmiAcc_No','pigmiallocation.old_pigmiaccno','pigmiallocation.PigmiTypeid','pigmiallocation.UID','Agentid','AllocationDate','StartDate','EndDate','Opening_Balance','Total_Amount','pigmiallocation.Bid','FirstName','MiddleName','LastName')
			->join('user','user.Uid','=','pigmiallocation.UID')
			->where('Agentid',$agid)
			->where('Closed','NO')
			->where('pigmiallocation.Status','=',"AUTHORISED")
			->get();
			$WriteTo_Dfile='';
			
			foreach($allaccount as $accno)
			{
				
				
				
				
				$Branch_Id=$accno->Bid;
				//print_r($Branch_Id);
				//$bid=DB::table('branch')->select('BCode')->where('Bid',$Branch_Id)->first();
				$Branch_Id = str_pad($Branch_Id, 3, " ", STR_PAD_LEFT);
				$Category_Code=2;
				$Scheme_Code="000";
				$EMPTY="0000000000000000000000";
				$Account_No1=$accno->PigmiAcc_No;
				
				$Account_No2=preg_match('#([a-z]+)([\d]+)#i',$Account_No1,$matches);
				$Account_No=$matches[2];
				$Account_No = str_pad($Account_No, 7, '0', STR_PAD_LEFT);
				
				$Customer_Id=$accno->UID;
				$Customer_Id = str_pad($Customer_Id, 6, " ", STR_PAD_LEFT);
				$Customer_FName=$accno->FirstName;
				$Customer_MName=$accno->MiddleName;
				$Customer_LName=$accno->LastName;
				$Customer_Name=$Customer_FName.$Customer_MName.$Customer_LName;
				$Customer_Name = str_pad($Customer_Name, 50, " " , STR_PAD_RIGHT);
				
				$OPENING_Balance1=$accno->Total_Amount;
				
				$OPENING_Balance2=Floatval($OPENING_Balance1);
				$OPENING_Balance=round($OPENING_Balance2,2);
				$OPENING_Balance=number_format((float)$OPENING_Balance, 2, '.', '');
				//$OPENING_Balance = str_pad($OPENING_Balance.'.00', 13, " ", STR_PAD_LEFT);
				$OPENING_Balance = str_pad($OPENING_Balance, 13, '0', STR_PAD_LEFT);
				
				$Agent_ID=$accno->Agentid;
				$Agent_ID = str_pad($Agent_ID, 15, " ", STR_PAD_LEFT);
				$Account_Opening_Date=$accno->StartDate;
				$Account_Opening_Date = str_pad($Account_Opening_Date, 10, " ", STR_PAD_LEFT);
				$Agreed_Amount=100;
				
				$Agreed_Amount = str_pad($Agreed_Amount, 8, " ", STR_PAD_LEFT);
				/* 
				$tra=DB::table('pigmiallocation')
				->join('pigmi_transaction','pigmi_transaction.PigmiAllocID','=','pigmiallocation.PigmiAllocID')
				->where('PigmiAcc_No',$Account_No1)
				->max('PigmiTrans_ID');
				
				$lasttran=DB::table('pigmi_transaction')->select('PigReport_TranDate')->where('PigmiTrans_ID','=',$tra)->first();
				 */
				
				//$Closing_Balance_Date=$lasttran->PigReport_TranDate;
				//$Last_Transaction_Date=$lasttran->PigReport_TranDate;
				
				$Closing_Balance_Date="0000000000";
				$Last_Transaction_Date="0000000000";
				$MAXTRANS="000";
				$FILENAMEPOS="0000000";
				$CLOSING_BAL="0000000000";
				$Closing_Balance_Date = str_pad($Closing_Balance_Date, 10, " ", STR_PAD_LEFT);
				$Last_Transaction_Date = str_pad($Last_Transaction_Date, 10, " ", STR_PAD_LEFT);
				
				$WriteTo_Dfile.=$Branch_Id.$Category_Code.$Scheme_Code.$EMPTY.$Account_No.$Customer_Id.$Customer_Name.$OPENING_Balance.$Agreed_Amount.$Closing_Balance_Date.$Agent_ID.$Account_Opening_Date.$Last_Transaction_Date."\n";
				
				//File::append('../public/test/test.txt',$WriteTo_Dfile);
				
				
			}
			$path='download/'.date('Y').'/'.date('m').'/'.date('d').'/';
			$agentid=substr($accno->Agentid,2,5).date('d').date('m');
			//echo $agentid;
			Storage::disk('public')->put($path.$agentid.'D.txt', $WriteTo_Dfile);
			$data['file_url']=url().'/agent_files/'.$path.$agentid.'D.txt';
			$data['file_path']='..\\..\\..\\public\\agent_files\\'.$path.$agentid.'D.txt';
			$data['name']=$agentid.'D.txt';
			return $data;
			
			/*	$myfile = fopen("$file", "w") or die("Unable to open file!");
				$txt = "John Doe\n";
				fwrite($myfile, $txt);
				$txt = "Jane Doe\n";
				fwrite($myfile, $txt);
			fclose($myfile);*/
		}
		
		public function demo($path)
		{
			
			//$filename = 'agent_files/upload/test.txt';
			$filename = $path;
			
			if (file_exists($filename) && is_readable ($filename)) {
				$fileResource  = fopen($filename, "r");
				if ($fileResource) {
					while (($line = fgets($fileResource)) !== false) {
						
						$this->data($line);
						// echo $line.'$$$$next-line$$$$';
					}
					fclose($fileResource);
				}
			}
			
			//File::open('../agent_files/abc/test.txt');
			//$a=Storage::disk('public')->get($path);
			//return $a;
		}
		public function data($line)
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$UID=$uname->Uid;
			/*$BID=$uname->Bid;
				$respit1=DB::table('branch')->select('Recp_No')->where('Bid',$BID)->first();
				$respit=$respit1->Recp_No;
				$r=$respit+1;
			DB::table('branch')->where('Bid',$BID)->update(['Recp_No'=>$r]);*/
			
			$temp=$line;
			$bid=substr($temp,0,3);
			$bid=intval($bid);
			$Account_No1=substr($temp,29,7);
			$Account_No1=intval($Account_No1);
			$bcode1=DB::table('branch')->select('BCode')->where('Bid','=',$bid)->first();
			$bcode=$bcode1->BCode;
			$Account_No='PCISPG'.$bcode.$Account_No1;
			$agentid=substr($temp,123,15);
			$agentid=intval($agentid);
			$amt=substr($temp,138,10);
			$amt=Floatval($amt);
			$trandate=substr($temp,148,10);
			$time=substr($temp,159,5);
			$billnum=substr($temp,164,4);
			$day=substr($trandate,0,2);
			$month=substr($trandate,3,2);
			$year=substr($trandate,6,4);
			$tranrepodate=$year.'-'.$month.'-'.$day;
			$pigmydata=DB::table('pigmiallocation')->select('PigmiAllocID','Total_Amount','PigmiTypeid','Closed')->where('PigmiAcc_No','=',$Account_No)->first();
			$pigmyallocationid=$pigmydata->PigmiAllocID;
			$pigmyallocationtotamt=$pigmydata->Total_Amount;
			$pigmyallocationPigmiTypeid=$pigmydata->PigmiTypeid;
			$tot=$amt+$pigmyallocationtotamt;
			$Closedsate=$pigmydata->Closed;
			
			if($Closedsate=="NO")
			{
				
				$data=DB::table('pigmi_transaction')
				->where('Agentid','=',$agentid)
				->where('PigReport_TranDate','=',$tranrepodate)
				->where('bill_no','=',$billnum)
				->where('trantime','=',$time)
				->count('PigmiTrans_ID');
				
				if($data==0)
				{
					
					$pid = DB::table('pigmi_transaction')->insertGetId(['Trans_Date'=>$trandate,'PigReport_TranDate'=>$tranrepodate,'Agentid'=>$agentid,'PigmiAllocID'=>$pigmyallocationid,'Current_Balance'=>$pigmyallocationtotamt,'Transaction_Type'=>"CREDIT",'Amount'=>$amt,'Particulars'=>"CASH CREDITED",'PigmiTypeid'=>$pigmyallocationPigmiTypeid,'Total_Amount'=>$tot,'Month'=>$month,'Year'=>$year,'PgmPayment_Mode'=>"CASH",'Bid'=>$bid,'CreatedBy'=>$UID,'bill_no'=>$billnum,'trantime'=>$time]);
					
					DB::table('pigmiallocation')->where('PigmiAcc_No','=',$Account_No)->update(['Total_Amount'=>$tot]);
					
					$data1=DB::table('pending_pigmy')->where('PendPigmy_AgentUid','=',$agentid)
					->where('PendPigmy_CollectionDate','=',$tranrepodate)
					->count('PpId');
					
					if($data1==0)
					{
						DB::table('pending_pigmy')->insertGetId(['PendPigmy_AgentUid'=>$agentid,'PendPigmy_CollectionDate'=>$tranrepodate,'PendPigmy_PendingAmount'=>$amt,'PendPigmy_Bid'=>$bid]);
						
					}
					else
					{
						$totamt1=DB::table('pending_pigmy')->select('PendPigmy_PendingAmount')
						->where('PendPigmy_AgentUid','=',$agentid)
						->where('PendPigmy_CollectionDate','=',$tranrepodate)
						->first();
						$totamt=$totamt1->PendPigmy_PendingAmount;
						$totalamount=$totamt+$amt;
						
						DB::table('pending_pigmy')->where('PendPigmy_AgentUid','=',$agentid)
						->where('PendPigmy_CollectionDate','=',$tranrepodate)
						->update(['PendPigmy_PendingAmount'=>$totalamount,'PendPigmy_Status'=>"PENDING"]);
						
					}
					
				}
			}
			else if($Closedsate=="YES")
			{
				
				DB::table('extraagentamount')->insert(['ExtraAmt_AgentId'=>$agentid,'ExtraAmt_AccountNum'=>$Account_No,'ExtraAmt_Amount'=>$amt,'ExtraAmt_Date'=>$tranrepodate,'ExtraAmt_Bid'=>$bid]);
				
			}
		}
	}	