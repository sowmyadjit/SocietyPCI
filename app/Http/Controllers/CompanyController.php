<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\CompanyModel;
use App\Http\Model\ModulesModel;
use Redirect;
class CompanyController extends Controller
{
    
    var $comp;
	
	public function __construct()
    {
        $this->comp = new CompanyModel;
		$this->Modules= new ModulesModel;
    }
	
	public function show_company()
	{
		$Url="company";
		$c['module']=$this->Modules->GetAnyMid($Url);
		$c['company'] =$this->comp->GetCompanyDet();
		
        return view('company',compact('c'));
	}
	
	public function create_company(Request $request)
	{
		$company['cname']=$request->input('cname');
		$company['cinitial']=$request->input('cinitial');
		$company['caddress']=$request->input('caddress');
		$company['cphoneno']=$request->input('cphoneno');
		$company['ccity']=$request->input('ccity');
		$company['cstate']=$request->input('cstate');
		$company['cpincode']=$request->input('cpincode');
		$id=$this->comp->insert($company);
		return redirect('/company');
		//return Redirect::route('company');
		//return Redirect::action('BranchController@show_branch');
	}
	
	public function display_company()
	{
		$Url="company";
		$c['module']=$this->Modules->GetAnyMid($Url);
		return view('createcompany',compact('c'));
	}


	public function unable(Request $request)
	{
	    	$sms['SSMSStatus']=$request->input('SSMSStatus');
	    	$sms['CompanyId']=$request->input('CompanyId');
		$id=$this->comp->SmsPer($sms);
		return redirect('/home');
	}
   
}
