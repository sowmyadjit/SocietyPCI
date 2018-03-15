<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Illuminate\Http\Response;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\AccountModel;
	use App\Http\Model\AgentCommisionModel;
	use App\Http\Model\ModulesModel;
	use File;
	use Input;
	use Storage;
	class AgentCommisionController extends Controller
	{
		
		var $acc;
		
		public function __construct()
		{
			$this->acc = new AgentCommisionModel;
				$this->Modules= new ModulesModel;
			
			
		}
		
		public function AgentDataDownload()
		{
			
			$Url="AgentDataDownload";
			$b['module']=$this->Modules->GetAnyMid($Url);

			return view('agentdowwnload',compact('b'));
			
			
		}
		public function agentdownloadsubmit(Request $request)
		{
			$Url="AgentDataDownload";
			$account['module']=$this->Modules->GetAnyMid($Url);
			$account['agentid']=$request->input('agentid');
			$id=$this->acc->agentdownloadsubmit($account);
			return $id['file_url'];
			
			
		}
		public function AgentDataUpload()
		{
			$Url="AgentDataUpload";
			$agentuplode['module']=$this->Modules->GetAnyMid($Url);
			return view('agentuplode',compact('agentuplode'));
			
		}
	
		public function agentUploadsubmit(Request $request)
		{
			$agentfile=$request->input('agentfile');
			//$fname111=Input::file('agentfile')->getClientOriginalExtension();
		$fname111=basename($request->file('agentfile')->getClientOriginalName(), '.'.$request->file('agentfile')->getClientOriginalExtension());
					print_r($fname111);
			$result = preg_replace("/[^A-Z]+/", "", $fname111);
			print_r($result);
			
			
			if($result=="U")
			{
				
			$agentid=$request->input('agentid');
			$agentupldate1=Date('m');
			$agentupldate=Date('d');
			$path = 'agent_files/upload/';
			$agentid=$agentid;//trim from last 3 digit
		//	$agentupldate=$agentupldate//get datemonth
			
			$filenme=$agentid.$agentupldate.$agentupldate1.'.txt';
			if(!File::exists($path)) {
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				$fn=Input::file('agentfile');
				
				if($fn!="")
				{
					$f=$filenme;
					$fname=Input::file('agentfile')->getClientOriginalName();
					
					$a=Input::file('agentfile')->move($destinationPath,$f);
					$x=$x+1;
				}
				else
				{
					$a=null;//$request->input('agentfile');

					
				}
			}
			else
			{
		
				$destinationPath=$path;
				
				$fn=Input::file('agentfile');
				if($fn!="")
				{
					$f=$filenme;
					$fname=Input::file('agentfile')->getClientOriginalName();

					$a=Input::file('agentfile')->move($destinationPath,$f);
					
				}
				else
				{
					$a=null;//$request->input('agentfile');
				}
				
			}
			
			if($a)
				$id=$this->acc->demo($path.$filenme);
				//$id=$this->acc->demo('w');
				return $id;
			}	
		}
	}

