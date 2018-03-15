<?php
	
	namespace App\Http\Model;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use App\Http\Model\SmsModel;
	
	class RoundModel extends Model
	{
		
	public	function Roundall($amt)
		{
			
			$amt=Floatval($amt);
			$amt=number_format((float)$amt, 2,'.','');
			$PigmiRound = explode('.',$amt);
			$paisaamt =$PigmiRound[1];
			$rupeamt =$PigmiRound[0];
			
			if($paisaamt>50)
			{
				$roundedamt=$rupeamt+1;
				return($roundedamt);
			}
			else
			{
				$roundedamt=$rupeamt;
				return($roundedamt);
			}
			
		}
	}
