<?php
	
	namespace App\Http\Controllers;
	
	use App\User_model;
	use DB;
	use Auth;
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	
	class HomeController extends Controller
	{
		
		public function showNestedViews()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$uID=$uname->Uid;
			$BID=$uname->Bid;
			
			$udetail= DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','Gender','LoginName','BName','DName','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo')
			->leftJoin('designation','designation.Did','=','user.Did')
			->leftJoin('address','address.Aid','=','user.Aid')
			->leftJoin('branch','branch.Bid','=','user.Bid')
			->where('user.Uid','=',$uID)
			->first();
			
			$Side_Detail['did']=DB::table('user')->select('Did')
			->where('user.Uid','=',$uID)
			->first();
			
			$Side_Detail['modules']=DB::table('modules')->orderBy('MOrderId','asc')->get();
			
			$Side_Detail['permission']=DB::table('permission')->where('Did','=',$Side_Detail['did']->Did)->where('Bid','=',$BID)->get();
			
			//$BNAME=$udetail->BName;
			//print_r($BNAME);
			
			return view('topbar',compact('udetail')).view('sidebar',compact('Side_Detail')).view('body'). view('footer'). view('FloatingBox');
		}
	}
