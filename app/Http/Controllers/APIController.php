<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\API_Model;
class APIController extends Controller
{
	
	var $apimodel;
	 public $auth;
	public function __construct()
    {
	if(Auth::user())
		 $this->auth=Auth::user();
        $this->apimodel = new API_Model;
		
	 
    }
	
	public function getcustomer(Request $request)
	{
		$uid=$request->input('uid');
		$c=API_Model::getcustomer($uid);
	  return response()->json($c);
	}
	public function getpigmydetails(Request $request)
	{
		$pigmyinfo =$request->input('accNum');
		$get=$this->apimodel->getpigmydetails($pigmyinfo);
		 return response()->json($get);
		//$id['chk']=$get->Uid;
	
		
	}
	public function pigmytransaction(Request $request)
	{
		
		$pigmyinfo['agtid']=$request->input('agtid');
		$pigmyinfo['accNum']=$request->input('accNum');
		$pigmyinfo['acctno']=$request->input('acctno');
		$pigmyinfo['curbal']=$request->input('curbal');
		//$pigmyinfo=$request->input('trtype');
		$pigmyinfo['pgamount']=$request->input('pgamount');
		$pigmyinfo['ptpar']=$request->input('ptpar');
		$pigmyinfo['pgbalamt']=$request->input('pgbalamt');
		$pigmyinfo['pgmpaymode']=$request->input('pgmpaymode');
		$pigmyinfo['pgmchequeno']=$request->input('pgmchequeno');
		$pigmyinfo['pgmchdate']=$request->input('pgmchdate');
		$pigmyinfo['pgmbankname']=$request->input('pgmbankname');
		$pigmyinfo['pgmbankbranch']=$request->input('pgmbankbranch');
		$pigmyinfo['pgmifsccode']=$request->input('pgmifsccode');
		$pigmyinfo['pgmbranch']=$request->input('pgmbranch');
		//$pigmyinfo=$request->input('UID');
		return $this->apimodel->pigmytransaction($pigmyinfo);
		/*if(isset($get))
	{
		return false;
	}
	else
	{
		return true;
	}
		*/
		
	}
	public function agentprofile(Request $request)
	{
		$agentinfo=$request->input('uid');
		$get=$this->apimodel->agentprofile($agentinfo);
		 return response()->json($get);
	}
	public function changepass(Request $request)
	{
		$agentpass['uid']=$request->input('uid');
		$agentpass['newpass']=$request->input('newpass');
		
		$get=$this->apimodel->changepass($agentpass);
		 return response()->json($get);
		
	}
	public function pigmycustreport(Request $request)
	{
		$pigmyreport['accnum']=$request->input('accnum');
		$pigmyreport['fromdate']=$request->input('fromdate');
		$pigmyreport['todate']=$request->input('todate');
		$get=$this->apimodel->pigmycustreport($pigmyreport);
		 return response()->json($get);
	}
	public function pigmyagentreport(Request $request)
	{
		$pigmyreport['uid']=$request->input('uid');
		$pigmyreport['fromdate']=$request->input('fromdate');
		$pigmyreport['todate']=$request->input('todate');
		$get=$this->apimodel->pigmyagentreport($pigmyreport);
		 return response()->json($get);
		
	}
	
	
	
	
	
	
   
}
