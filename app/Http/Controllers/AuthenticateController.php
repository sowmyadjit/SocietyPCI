<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use hash;
use Auth;
use App\User;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{
    public $uid;
    public $auth;
    public $remtoken;
	protected $table = 'user';

	 public function authenticate(Request $request)
    {
		$logged=false;
		$auth = user::where('LoginName',$request->input('LoginName'))
		/*->select('Uid','user.FirstName','user.MiddleName','user.LastName','Gender','LoginName','BName','DName','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo')
		->leftJoin('designation','designation.Did','=','user.Did')
		->leftJoin('address','address.Aid','=','user.Aid')
		->leftJoin('branch','branch.Bid','=','user.Bid')*/
		->first();
	 
		
		//print_r($auth); 
        if($auth){
					Auth::login($auth);
					$password = Auth::user()->Password;
					$authstat = Auth::user()->AuthStatus;
					//$this->$uid = Auth::user()->Uid;
					//$this->remtoken = Auth::user()->remember_token;
					//$pin = Auth::user()->Passcode;
					//$user_info=Auth::user();
					if($request->input('Password'))
					{
						if ($request->input('Password')==$password)
						{
							if ($authstat=="AUTHORISED")
							{
								
							
							$logged=true;
							//session()->regenerate();
							//$uid = Auth::user()->Uid;
							//$remtoken = Auth::user()->remember_token;
							//session(['uid' => $uid],['remtoken'=>$remtoken]);
							//session(['logged' => $logged]);
							}
							else{
								
								$data=['msg' => 'User is Not Authorised'];
								return $this->output_format($request,$data,404);
								$logged=false;
							}
						}
					
					}
					
					else
					{
						//$data=['error' => 'invalid_credentials'];
						//return $this->output_format($request,$data,401); 
						$data=['msg' => 'Invalid Username or Password'];
						return $this->output_format($request,$data,404);
						$logged=false;
						
						
						
					}
		}
			if($logged){
			// echo 'loggedin';
			$data=['home' => '/home'];
						return $this->output_format($request,$data,404);
			}
			 else
			{
				$data=['msg' => 'Invalid Username or Password'];
               return $this->output_format($request,$data,404);
			   //return redirect('/','data');
			   
			   
				
			}
			 
    }
	
	public function logout()
	{
		if(Auth::check())
		{
			//print_r($uid);
			
			//return $id;
			//$logged=false;
			Auth::logout();
			
			return redirect('/');
		}
		else
		{
			
			//$data=['error' => 'you_are_not_loggedin'];
			//return $this->output_format($request,$data,401);
			//print_r("you_are_not_loggedin");
			return redirect('/');
			
		}
	}
	
    public function index()
    {
        //
		return view('login');
    }

   	public function output_format(Request $request,$data,$status) {
		 $format=$request->input('format');
		 if($format=='jsonp')
			return response()->json($data,$status)->setCallback($request->input('callback'));
		else
			return response()->json($data,$status);
    }
}
