<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user_model= new UserModel;
        $this->user= new UserModel;
    }
	
	/*public function show_user()
	{
		$u=UserModel::all();
        return view('user',compact('u'));
	}*/
	
	public function show_user(){
		//$b=BranchModel::all();
		//$c= $this->company_model->GetCompany();
		//return view('branch',compact('b'));
		$u=$this->user->getData();
		return view('user',compact('u'));
	}
	
	public function Show_UserDetails($id,$type=null){
		
	$ud['user']=$this->user->GetUser($id);
		if($type!=null)
			$ud['type']='edit';
		else
			$ud['type']='';
		return view('userdetails',compact('ud'));
	}

	public function ShowUsers()
	{
		return view('createuser');
	}
	
	public function CreateUser(Request $request)
    {
        //
        $user['loname']=$request->input('loname');
        $user['password']=$request->input('password');
        $user['passcode']=$request->input('passcode');
		
        $user['email']=$request->input('email');
        //$user['bid']=$request->input('bid');
		$user['fname']=$request->input('fname');
		$user['mname']=$request->input('mname');
      $user['lname']=$request->input('lname');
	$user['gender']=$request->input('gender');
	$user['ms']=$request->input('ms');
	$user['oc']=$request->input('oc');
	$user['age']=$request->input('age');
	$user['bd']=$request->input('bd');
		$user['address']=$request->input('address');
			$user['city']=$request->input('city');
			$user['dist']=$request->input('dist');
				$user['state']=$request->input('state');
					$user['mn']=$request->input('mn');
		$user['pc']=$request->input('pc');
			$user['phone']=$request->input('phone');
			$user['branchid']=$request->input('branchid');
			$user['desig']=$request->input('desig');
			
        $id=$this->user_model->insert($user);
		
        //user::create($user);
        return redirect('/');
        //echo $id;

		
	}
	
	
	
	public function UpdateUser(Request $request)
    {
        //
		$user['uid']=$request->input('uid');
		$user['aid']=$request->input('aid');
        $user['logname']=$request->input('logname');
        $user['email']=$request->input('email');
        //$user['bid']=$request->input('bid');
		$user['fname']=$request->input('fname');
		$user['mname']=$request->input('mname');
      $user['lname']=$request->input('lname');
	$user['gender']=$request->input('gender');
	$user['ms']=$request->input('ms');
	$user['oc']=$request->input('oc');
	$user['age']=$request->input('age');
	$user['bd']=$request->input('bd');
		$user['address']=$request->input('address');
			$user['city']=$request->input('city');
			$user['dist']=$request->input('dist');
				$user['state']=$request->input('state');
					$user['mn']=$request->input('mn');
		$user['pc']=$request->input('pc');
			$user['phone']=$request->input('phone');
			$user['branchid']=$request->input('branchid');
			$user['desig']=$request->input('desig');
			
        $id=$this->user_model->updateuser($user);
		
        //user::create($user);
        return redirect('/');
        //echo $id;

		
	}
	
	public function change_branch_index(Request $request)
	{
		return view('change_branch_inex');
	}
	
	public function change_branch(Request $request)
	{
		$this->user_model->change_branch(["branch_id" => $request->input("branch_id")]);
		return;
	}
}
