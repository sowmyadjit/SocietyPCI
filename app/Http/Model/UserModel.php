<?php
	
	namespace App\Http\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	use DB;
	use Auth;
	use Input;
	use App\Http\Model\SettingsModel;
	
	class UserModel extends Model
	{
		
		protected $table = 'user';

		public function __construct()
		{
			$this->settings = new SettingsModel;
		}
		
		public function insert($id)
		{
			$Aid = DB::table('address')->insertGetId(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'MaritalStatus' => $id['ms'],'Occupation' => $id['oc'],'Age' => $id['age'],'Birthdate' => $id['bd'],'Email' => $id['email'],'Address' => $id['address'],'City' => $id['city'],'District' => $id['dist'],'State' => $id['state'],'MobileNo' => $id['mn'],'Pincode' => $id['pc'],'PhoneNo'=>$id['phone']]); 
			$id = DB::table('user')->insertGetId(['LoginName' => $id['loname'],'Password'=>$id['password'],'PassCode'=>$id['passcode'],'Aid'=>$Aid,'FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Email' => $id['email'],'Bid'=>$id['branchid'],'Did'=>$id['desig']]);
			return $id;
		}
		
		public function updateuser($id)
		{
			DB::table('address')->where('Aid',$id['aid'])
			->update(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'MaritalStatus' => $id['ms'],'Occupation' => $id['oc'],'Age' => $id['age'],'Birthdate' => $id['bd'],'Email' => $id['email'],'Address' => $id['address'],'City' => $id['city'],'District' => $id['dist'],'State' => $id['state'],'MobileNo' => $id['mn'],'Pincode' => $id['pc'],'PhoneNo'=>$id['phone']]); 
			
			$id = DB::table('user')->where('Uid',$id['uid'])
			->update(['FirstName'=> $id['fname'],'Aid'=>$id['aid'],'user.LoginName' => $id['logname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Email' => $id['email'],'Bid'=>$id['branchid'],'Did'=>$id['desig']]);
			return $id;
		}
		
		public function GetData()
		{
			$id = DB::table('user')->select('Uid','user.FirstName','user.MiddleName','user.LastName','Gender','LoginName','BName','DName','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			->leftJoin('designation', 'designation.Did', '=' , 'user.Did')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->paginate(10);
			
			return $id;
		}
		
		public function GetUser($id)
		{
			return DB::table('user')->select('Uid','user.Aid','user.FirstName','user.MiddleName','user.LastName','Gender','LoginName','BName','DName','user.Email','MaritalStatus','Occupation','Age','Birthdate','Address','City','District','State','MobileNo','Pincode','PhoneNo')
			->leftJoin('branch', 'branch.Bid', '=' , 'user.Bid')
			->leftJoin('designation', 'designation.Did', '=' , 'user.Did')
			->leftJoin('address', 'address.Aid', '=' , 'user.Aid')
			->where('Uid',$id)
			->get();
		}
		
		/*	public function Getusr($q)
			{
			return DB::table('user')
			
			->select(DB::raw('user.Uid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->where('AuthStatus','=',"AUTHORISED")
			->where('UserType','=',"MAJOR")
			->get();
		}*/
		
		public function GetAgent($agi)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid;
			//return DB::table('user')
			$test = DB::table('user')
			
			->select(DB::raw('user.Uid as id, CONCAT(`Uid`," - ",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->leftJoin('designation','designation.Did','=','user.Did')
			->where('designation.DName','like','%AGENT%')
			->where('AuthStatus','=',"AUTHORISED")
			->where('Bid','=',$BID)
			->get();
			//echo $test;
			return $test;
		}
		
		public function Getusr($q)
		{
			$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;
				$ret_data = DB::table('user')
				
				/*->select(DB::raw('user.Uid as id, CONCAT(user.`Uid`,"-",user.`FirstName`,"-",user.`MiddleName`,"-",customer.`SpouseName`,"-",customer.`FatherName`,"-",user.`LastName`,"-",address.`Address`) as name'))
				->Join('address','address.Aid','=','user.Aid')
				->Join('customer','customer.Uid','=','user.Uid')
				->where('user.AuthStatus','=',"AUTHORISED")
				->where('UserType','=',"MAJOR")
				->where('user.Bid','=',$BID)*/
				
				->select(DB::raw('user.Uid as id, CONCAT(user.`Uid`,"-",user.`FirstName`,"-",user.`MiddleName`,"-",user.`LastName`,"-",address.`Address`) as name'))
				->Join('address','address.Aid','=','user.Aid')
				//->Join('customer','customer.Uid','=','user.Uid')
				->where('user.AuthStatus','=',"AUTHORISED")
				->where('UserType','=',"MAJOR");
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$ret_data = $ret_data->where('user.Bid','=',$BID);
				}
				$ret_data = $ret_data->orwhere('user.Bid','=',"6")
					->get();
			return $ret_data;
			
			/*$t=Input::all();
			//print_r($t);
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			return DB::table('user')
			
			->selectRaw('user.Uid as id, CONCAT(user.`FirstName`,"-",user.`MiddleName`,"-",user.`LastName`,"-",address.`Address`) as name')
			->leftJoin('address','address.Aid','=','user.Aid')
			->where('AuthStatus','=',"AUTHORISED")
			->where('UserType','=',"MAJOR")
			->where('user.FirstName','like','%'.$t['query'].'%')
			->where('Bid','=',$BID)
			->get();*/
		}
		
		public function Getjewelcust()
		{
			$uname='';
			if(Auth::user())
			$uname= Auth::user();
			$BID=$uname->Bid;
			$ret_data = DB::table('user')
				->select(DB::raw('user.Uid as id, CONCAT(`Uid`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
				->where('AuthStatus','=',"AUTHORISED")
				->where('UserType','=',"MAJOR");
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where('Bid','=',$BID);
			}
			$ret_data = $ret_data->orWhere('Bid',"6")
				->where('Jewelloan','=',"NO")
				->get();
			return $ret_data;
		}
		public function getuser_forloan()
		{
						$uname='';
				if(Auth::user())
				$uname= Auth::user();
				$BID=$uname->Bid;

				$ret_data = DB::table('user')
				->select(DB::raw('user.Uid as id, CONCAT(user.`Uid`,"-",user.`FirstName`,"-",user.`MiddleName`,"-",user.`LastName`,"-",`Member_No`) as name'))
				//->Join('customer','customer.Uid','=','user.Uid')
				->where('user.AuthStatus','=',"AUTHORISED")
				->where('UserType','=',"MAJOR");
				if($this->settings->get_value("allow_inter_branch") == 0) {
					$ret_data = $ret_data->where('user.Bid','=',$BID);
				}
				//->orwhere('user.Bid','=',"6")
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		public function change_branch($data)
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $BID=$uname->Bid; $UID=$uname->Uid;
			DB::table("user")
				->where("Uid","=",$UID)
				->update(["Bid"=>$data["branch_id"]]);
		}
		
		
	}
?>