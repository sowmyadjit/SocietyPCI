<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\EmployeeModel;
	use File;
	use Input;
	use App\Http\Model\CustomerModel;
	use App\Http\Model\ModulesModel;
	
	class EmployeeController extends Controller
	{
		var $employee;
		var $customer;
		public function __construct()
		{
			$this->employee = new EmployeeModel;
			$this->customer = new CustomerModel;
			$this->Modules= new ModulesModel;
			
		}
		public function show_emp()
		{
			$Url="emp";
			$e['module']=$this->Modules->GetAnyMid($Url);
			$e['Employee']=$this->employee->getData();
			
			return view('employee',compact('e'));
		}
		
		public function Show_EmpDetails($id,$type=null){
			
			$Url="emp";
			$ed['module']=$this->Modules->GetAnyMid($Url);
			$ed['employee']=$this->employee->GetEmployee($id);
			if($type!=null)
			$ed['type']='edit';
			else
			$ed['type']='';
			return view('employeedetails',compact('ed'));
			
		}
		
		public function show_empcreate()
		{
			$Url="emp";
			$ec['module']=$this->Modules->GetAnyMid($Url);
			return view('employeecreate',compact('ec'));
		}
		
		public function GetUid()
		{
			$id=$this->customer->maxid();
			return $id;
		}
		
		public function create_employee(Request $request)
		{
			$employee['fname']=$request->input('fname');
			$employee['mname']=$request->input('mname');
			$employee['lname']=$request->input('lname');
			$employee['empcode']=$request->input('empcode');
			$employee['gender']=$request->input('gender');
			$employee['maritalstatus']=$request->input('maritalstatus');
			$employee['occupation']=$request->input('occupation');
			$employee['age']=$request->input('age');
			$employee['bdate']=$request->input('bdate');
			$employee['phone']=$request->input('phone');
			$employee['address']=$request->input('address');
			$employee['email']=$request->input('email');
			$employee['city']=$request->input('city');
			$employee['state']=$request->input('state');
			$employee['mobile']=$request->input('mobile');
			$employee['pincode']=$request->input('pincode');
			$employee['dsgid']=$request->input('dsgid');
			$employee['dist']=$request->input('dist');
			$employee['brid']=$request->input('brid');
			$employee['bpay']=$request->input('bpay');
			$employee['itax']=$request->input('itax');
			$employee['pf']=$request->input('pf');
			$employee['hra']=$request->input('hra');
			$employee['dcid']=$request->input('dcid');
			
			$employee['loname']=$request->input('loname');
			$employee['password']=$request->input('password');
			$employee['passcode']=$request->input('passcode');
			
			$employee['emptype']=$request->input('emptype');
			$employee['jd']=$request->input('jd');
			$employee['sd']=$request->input('sd');
			$employee['esi']=$request->input('esi');
			$employee['sesi']=$request->input('sesi');
			$employee['spf']=$request->input('spf');
			
			$usr=$request->input('usrid');
			
			$fnme=$request->input('fname');
			$mnme=$request->input('mname');
			$lnme=$request->input('lname');
			
			$path = 'Upload/'.$usr."_".$fnme."_".$mnme."_".$lnme;
			
			
			if(!File::exists($path)) {
				//$result = File::makeDirectory($path); for WINDOWS machine
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				$fn=Input::file('empphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('empphoto')->getClientOriginalName();
					$employee['empphoto']=Input::file('empphoto')->move($destinationPath,$f);
				}
				else
				{
					$employee['empphoto']=$request->input('empphoto');
				}
				$fn1=Input::file('empidp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('empidp')->getClientOriginalName();
					$employee['empidp']=Input::file('empidp')->move($destinationPath,$f1);
				}
				else
				{
					$employee['empidp']=$request->input('empidp');
				}
				$fn2=Input::file('empadpf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('empadpf')->getClientOriginalName();
					$employee['empadpf']=Input::file('empadpf')->move($destinationPath,$f2);
				}
				else
				{
					$employee['empadpf']=$request->input('empadpf');
				}
				
				$fn3=Input::file('empsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('empsign')->getClientOriginalName();
					$employee['empsign']=Input::file('empsign')->move($destinationPath,$f3);
				}
				else
				{
					$employee['empsign']=$request->input('empsign');
				}
			}
			else
			{
				$destinationPath=$path;
				$fn=Input::file('empphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('empphoto')->getClientOriginalName();
					$employee['empphoto']=Input::file('empphoto')->move($destinationPath,$f);
				}
				else
				{
					$employee['empphoto']=$request->input('empphoto');
				}
				$fn1=Input::file('empidp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('empidp')->getClientOriginalName();
					$employee['empidp']=Input::file('empidp')->move($destinationPath,$f1);
				}
				else
				{
					$employee['empidp']=$request->input('empidp');
				}
				$fn2=Input::file('empadpf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('empadpf')->getClientOriginalName();
					$employee['empadpf']=Input::file('empadpf')->move($destinationPath,$f2);
				}
				else
				{
					$employee['empadpf']=$request->input('empadpf');
				}
				
				$fn3=Input::file('empsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('empsign')->getClientOriginalName();
					$employee['empsign']=Input::file('empsign')->move($destinationPath,$f3);
				}
				else
				{
					$employee['empsign']=$request->input('empsign');
				}
			}
			
			$id=$this->employee->insert($employee);
			return redirect('/home');
			
		}
		
		public function UpdateEmployee(Request $request)
		{
			$employee['aid']=$request->input('aid');
			$employee['uid']=$request->input('uid');
			$employee['eid']=$request->input('eid');
			$employee['branchid']=$request->input('branchid');
			$employee['docid']=$request->input('docid');
			$employee['fname']=$request->input('fname');
			$employee['mname']=$request->input('mname');
			$employee['lname']=$request->input('lname');
			$employee['empcode']=$request->input('empcode');
			$employee['gender']=$request->input('gender');
			$employee['maritalstatus']=$request->input('maritalstatus');
			$employee['occupation']=$request->input('occupation');
			$employee['age']=$request->input('age');
			$employee['bdate']=$request->input('bdate');
			$employee['phone']=$request->input('phone');
			$employee['address']=$request->input('address');
			$employee['email']=$request->input('email');
			$employee['city']=$request->input('city');
			$employee['state']=$request->input('state');
			$employee['mobile']=$request->input('mobile');
			$employee['pincode']=$request->input('pincode');
			$employee['desgnid']=$request->input('desgnid');
			$employee['dist']=$request->input('dist');
			$employee['branchid']=$request->input('branchid');
			$employee['bpay']=$request->input('bpay');
			$employee['itax']=$request->input('itax');
			$employee['pf']=$request->input('pf');
			$employee['hra']=$request->input('hra');
			
			$employee['emptype']=$request->input('emptype');
			
			$user=$request->input('uid');
			
			$fnme=$request->input('fname');
			$mnme=$request->input('mname');
			$lnme=$request->input('lname');
			$emp = $this->employee->Getemployee1($employee['eid']);
			//print_r($cust);
			$path = 'Upload/'.$user."_".$fnme."_".$mnme."_".$lnme;
			
			
			if(!File::exists($path)) {
				//$result = File::makeDirectory($path);  for WINDOWS
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$fn=Input::file('empphoto');
				if($fn!="")
				{
					$f="Photo.jpg";
					$fname=Input::file('empphoto')->getClientOriginalName();
					$employee['empphoto']=Input::file('empphoto')->move($destinationPath,$f);
				}
				else
				{
					$employee['empphoto']=$request->input('empphoto');
				}
				$fn1=Input::file('empidp');
				if($fn1!="")
				{
					$f1="ID_Proof.jpg";
					$fname1=Input::file('empidp')->getClientOriginalName();
					$employee['empidp']=Input::file('empidp')->move($destinationPath,$f1);
				}
				else
				{
					$employee['empidp']=$request->input('empidp');
				}
				$fn2=Input::file('empadpf');
				if($fn2!="")
				{
					$f2="Address_Proof.jpg";
					$fname2=Input::file('empadpf')->getClientOriginalName();
					$employee['empadpf']=Input::file('empadpf')->move($destinationPath,$f2);
				}
				else
				{
					$employee['empadpf']=$request->input('empadpf');
				}
				
				$fn3=Input::file('empsign');
				if($fn3!="")
				{
					$f3="Signature.jpg";
					$fname6=Input::file('empsign')->getClientOriginalName();
					$employee['empsign']=Input::file('empsign')->move($destinationPath,$f3);
				}
				else
				{
					$employee['empsign']=$request->input('empsign');
				}
				
			}
			else
			{
				$destinationPath=$path;
				$fn=Input::file('empeidp');
				//print_r ($fn);
				if($fn!='')
				{
					$f="ID_Proof.jpg";
					$fname=Input::file('empeidp')->getClientOriginalName();
					$employee['empeidp']=Input::file('empeidp')->move($destinationPath,$f);
				}
				else
				{
					$employee['empeidp']= $emp->ID_Proof;
				}
				
				$fn1=Input::file('empeadrp');
				if($fn1!='')
				{
					$f1="Address_Proof.jpg";
					$fname1=Input::file('empeadrp')->getClientOriginalName();
					$employee['empeadrp']=Input::file('empeadrp')->move($destinationPath,$f1);
				}
				else
				{
					$employee['empeadrp']= $emp->Address_Proof;
				}
				$fn2=Input::file('empephoto');
				if($fn2!='')
				{
					$f2="Photo.jpg";
					$fname2=Input::file('empephoto')->getClientOriginalName();
					$employee['empephoto']=Input::file('empephoto')->move($destinationPath,$f2);
				}
				else
				{
					$employee['empephoto']= $emp->Photo;
				}
				$fn3=Input::file('empesign');
				if($fn3!='')
				{
					$f3="Signature.jpg";
					$fname3=Input::file('empesign')->getClientOriginalName();
					$employee['empesign']=Input::file('empesign')->move($destinationPath,$f3);
				}
				else
				{
					$employee['empesign']= $emp->Signature;
				}
			}
			
			$id=$this->employee->updatecustomer($employee);
			return redirect('/home');
			
		}
		
		
		
		public function display_employee()
		{
			return view('employee');
		}
		
	}
