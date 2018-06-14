<?php
	
	namespace App\Http\Model;
	use DB;
	use Auth;
	use Illuminate\Database\Eloquent\Model;
	use App\Http\Model\SettingsModel;
	
	class EmployeeModel extends Model
	{
		protected $table='employee';

		public function __construct()
		{
			
			$this->settings = new SettingsModel;
		}

		public function insert($id)
		{
			
			$Aid = DB::table('address')->insertGetId(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'MaritalStatus' => $id['maritalstatus'],'Occupation' => $id['occupation'],'Age' => $id['age'],'Email' => $id['email'],'District' => $id['dist'],'Birthdate' => $id['bdate'],'PhoneNo' => $id['phone'],'Address' => $id['address'],'City' => $id['city'],'State' => $id['state'],'MobileNo' => $id['mobile'],'Pincode' => $id['pincode']]); 
			
			$dcid=DB::table('docprovided')->insertGetId(['ID_Proof'=>$id['empidp'],'Address_Proof'=>$id['empadpf'],'Photo'=>$id['empphoto'],'Signature'=>$id['empsign']]);
			
			$uid = DB::table('user')->insertGetId(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'LoginName'=>$id['loname'],'Password'=>$id['password'],'PassCode'=>$id['passcode'],'Email'=>$id['email'],'Aid'=>$Aid,'Did'=>$id['dsgid'],'Bid'=>$id['brid']]); 
			
			$id = DB::table('employee')->insertGetId(['ECode' => $id['empcode'],'Aid'=>$Aid,'Did'=>$id['dsgid'], 'Bid'=>$id['brid'],'basicpay'=>$id['bpay'],'incometax'=>$id['itax'],'pf'=>$id['pf'],'hra'=>$id['hra'],'Uid'=>$uid,'DocProvid'=>$dcid,'Emp_Type'=>$id['emptype'],'Emp_Secutity_Deposit'=>$id['sd'],'esi'=>$id['esi'],'spf'=>$id['spf'],'sesi'=>$id['sesi']]);
			return $id;
		}
		
		public function updatecustomer($id)
		{
			
			DB::table('address')->where('Aid',$id['aid'])
			->update(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Gender' => $id['gender'],'MaritalStatus' => $id['maritalstatus'],'Occupation' => $id['occupation'],'Age' => $id['age'],'Email' => $id['email'],'District' => $id['dist'],'Birthdate' => $id['bdate'],'PhoneNo' => $id['phone'],'Address' => $id['address'],'City' => $id['city'],'State' => $id['state'],'MobileNo' => $id['mobile'],'Pincode' => $id['pincode']]); 
			DB::table('docprovided')->where('DocProvid',$id['docid'])
			->update(['ID_Proof'=>$id['empeidp'],'Address_Proof'=>$id['empeadrp'],'Photo'=>$id['empephoto'],'Signature'=>$id['empesign']]);
			
			DB::table('user')->where('Uid',$id['uid'])
			->update(['FirstName'=> $id['fname'],'MiddleName' => $id['mname'],'LastName' => $id['lname'],'Email'=>$id['email'],'Aid'=>$id['aid'],'Did'=>$id['desgnid'],'Bid'=>$id['branchid']]);
			
			$id = DB::table('employee')->where('Eid',$id['eid'])
			->update(['ECode' => $id['empcode'],'Aid'=>$id['aid'],'Did'=>$id['desgnid'], 'Bid'=>$id['branchid'],'basicpay'=>$id['bpay'],'incometax'=>$id['itax'],'pf'=>$id['pf'],'hra'=>$id['hra'],'Emp_Type'=>$id['emptype']]);
			return $id;
		}
		
		
		public function getData(){
			$id = DB::table('employee')->select('Eid','ECode','basicpay','incometax','pf','hra','Gender','MaritalStatus','Occupation','Age','Birthdate','user.Email','Address','District','City','State','PhoneNo','MobileNo','Pincode','BName','DName','user.FirstName','user.MiddleName','user.LastName','employee.CD')
			->leftJoin('designation','designation.Did','=','employee.Did')
			->leftJoin('branch','branch.Bid', '=' , 'employee.Bid')
			->leftJoin('address','address.Aid','=','employee.Aid')
			->leftJoin('user','user.Uid','=','employee.Uid')
			->get();
			return $id;
		}
		
		public function GetEmployee($id){
			return DB::table('employee')->select('Eid','ECode','employee.Aid','basicpay','incometax','pf','hra','Gender','MaritalStatus','Occupation','Age','Birthdate','user.Email','Address','District','City','State','PhoneNo','MobileNo','Pincode','BName','DName','user.FirstName','user.MiddleName','user.LastName','employee.Bid','employee.Did','ID_Proof','Address_Proof','Photo','Signature','employee.DocProvid','user.Uid','employee.Emp_Type')
			->leftJoin('designation','designation.Did','=','employee.Did')
			->leftJoin('branch','branch.Bid', '=' , 'employee.Bid')
			->leftJoin('address','address.Aid','=','employee.Aid')
			->leftJoin('user','user.Uid','=','employee.Uid')
			->leftJoin('docprovided', 'docprovided.DocProvid', '=' , 'employee.DocProvid')
			->where('Eid',$id)
			->get();
		}
		
		public function Getemployee1($id){
			return DB::table('employee')->select('Eid','ID_Proof','Address_Proof','Photo','Signature','employee.DocProvid')
			->leftJoin('docprovided', 'docprovided.DocProvid', '=' , 'employee.DocProvid')
			->where('Eid',$id)
			->first();
		}
		
		public function GetEmployeeName()
		{
			$uname=''; if(Auth::user()) $uname= Auth::user(); $UID=$uname->Uid; $BID=$uname->Bid;

			$ret_data = DB::table('employee')
			->select(DB::raw('user.Uid as id, CONCAT(`ECode`,"-",`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->join('user','user.Uid','=','employee.Uid');
			//->where('Emp_Type','=',"PERMANENT EMPLOYEE")
			//->where('Loan_Allocated','=',"NO")
			if($this->settings->get_value("allow_inter_branch") == 0) {
				$ret_data = $ret_data->where("employee.Bid",$BID);
			}
			$ret_data = $ret_data->get();
			return $ret_data;
		}
		
		public function GetSuretyName()
		{
			return DB::table('user')->select(DB::raw('user.Uid as id, CONCAT(`FirstName`,"-",`MiddleName`,"-",`LastName`) as name'))
			->whereIn('Did', [1, 2, 3, 4, 6])
			->get();
		}
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
