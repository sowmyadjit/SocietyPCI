<?php
	
	namespace App\Http\Model;
	use DB;
	use Auth;
	
	use Illuminate\Database\Eloquent\Model;
	define ("smsdomain","sms.djitsoft.com");
	define ('smsuid','7063736f6369657479');
	define ('smspin','6896ee0c17c9b602b16441dd5922a89e');
	class SmsModel extends Model
	{
		public $sender='KGKSSN';
		public $pushid=1;
		
		public function SendMSG($tempid,$mobile,$message)
		{
			
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$smschkbracnch=DB::table('branch')->select('SMS')->where('Bid',$BID)->first();
			$smschke=$smschkbracnch->SMS;
			
			
			$smschk1=DB::table('company')->select('SMS')->where('Cid',"1")->first();
			$smschk=$smschk1->SMS;
			print_r($smschk);
			if(($smschk=="YES")&&($smschke=="YES"))
			{
				$parameters="uid=".smsuid."&pin=".smspin."&sender=".$this->sender."&route=5&tempid=".$tempid."&mobile=".$mobile."&message=".urlencode($message)."&pushid=".$this->pushid."";
				
				$fp = fopen("http://".smsdomain."/api/sms.php?$parameters", "r");
				$response = stream_get_contents($fp);
				fpassthru($fp);
				fclose($fp);
				return $response;
			}
		}
		
		
		
	}
