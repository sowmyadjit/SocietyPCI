<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	
	class SmsSubscriptionModel extends Model
	{
		public function SmsSubscriptionData($id)
		{
			$i=$id['userid'];
			DB::table('user')->where('Uid','=',$i)->update(['Sms'=>$id['smsval']]);
		}
		
		
	
	}
