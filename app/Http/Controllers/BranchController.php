<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\BranchModel;
	use App\Http\Model\CompanyModel;
	use App\Http\Model\ModulesModel;
	use Illuminate\Pagination\Paginator;
	class BranchController extends Controller
	{
		var $branch_model;
		var $search_branch;
		
		public function __construct()
		{
			$this->branch_model= new BranchModel;  
			$this->search_branch= new BranchModel;
			$this->company_model= new CompanyModel;
			$this->Modules= new ModulesModel;
			
			$this->branch = new BranchModel;
		}
		
		public function show_branch(){
			$Url="branch";
			$b['module']=$this->Modules->GetAnyMid($Url);
			$b['branch']=$this->branch->GetData();
			return view('branch',compact('b'));
		}
		
		public function create_branch(Request $request)
		{
			$branch['cid']=$request->input('cid');
			$branch['bname']=$request->input('bname');
			$branch['bcode']=$request->input('bcode');
			$branch['baddress']=$request->input('baddress');
			$branch['bcity']=$request->input('bcity');
			$branch['bstate']=$request->input('bstate');
			$branch['bphone']=$request->input('bphone');
			$branch['bmobile']=$request->input('bmobile');
			$branch['bpincode']=$request->input('bpincode');
			$id=$this->branch_model->insert($branch);
			return redirect('/');
			
		}
		
		public function UpdateBranch(Request $request)
		{
			$branch['cid']=$request->input('cid');
			$branch['bid']=$request->input('bid');
			$branch['bname']=$request->input('bname');
			$branch['bcode']=$request->input('bcode');
			$branch['baddress']=$request->input('baddress');
			$branch['bcity']=$request->input('bcity');
			$branch['bstate']=$request->input('bstate');
			$branch['bphone']=$request->input('bphone');
			$branch['bmobile']=$request->input('bmobile');
			$branch['bpincode']=$request->input('bpincode');
			$id=$this->branch_model->updatebranch($branch);
			return redirect('/');
			
		}
		
		public function show_createbranch()
		{
			
			$Url="branch";
			$company['module']=$this->Modules->GetAnyMid($Url);
			$company['branch']= $this->company_model->GetCompany();
			//return view ('createbranch',['company' => $company]);
			return view ('createbranch',compact('company'));
			
		}
		
		public function Show_BranchDetails($id,$type=null)
		{
			$company= $this->company_model->GetCompany();
			$Url="branch";
			$bd['module']=$this->Modules->GetAnyMid($Url);
			$bd['branch']=$this->branch->GetBranches($id);
			if($type!=null)
			$bd['type']='edit';
			else
			$bd['type']='';
			return view('branchdetails',compact('bd'),['company' => $company]);
		}
public function onoff(Request $request)
	{
	    	$sms['SMSStatus']=$request->input('SMSStatus');
	    	$sms['BranchId']=$request->input('BranchId');
		$id=$this->branch_model->SmsPermission($sms);
		return redirect('/home');
	}
	}
