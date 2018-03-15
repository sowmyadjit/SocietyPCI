<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\AccountModel;
use App\Http\Model\ModulesModel;
use App\Http\Model\OpenCloseModel;
class AccountController extends Controller
{
	
	 var $acc;
	
	public function __construct()
    {
        $this->acc = new AccountModel;
		$this->Modules= new ModulesModel;
		$this->OP_model=new OpenCloseModel;
	 
    }
	
	/*public function show_account()
	{
		$a=AccountModel::all();
        return view('createaccount',compact('a'));
	}*/
	public function show_account()
	{
		$Url="AccountCreation";
		$a['module']=$this->Modules->GetAnyMid($Url);
		$a['accounts']=$this->acc->getData();
		$a['accounts_all']=$this->acc->getData_all();
		 $a['open']=$this->OP_model->openstate();
	   $a['close']=$this->OP_model->openclosestate();

		if(empty($a['open']))
	   {
			$a['open']=0;
		}
		else
		{
			$a['open']=1;
		} 
		if(empty($a['close']))
		{
			$a['close']=0;
		}
		else
		{
			$a['close']=1;
		}

       return view('createaccount',compact('a'));
        //return view('createaccount');
	}
	
	public function show_sbaccount()
	{
		$Url="AccountCreation";
		$a['module']=$this->Modules->GetAnyMid($Url);
		$a['SbList']=$this->acc->getSBData();
		
        return view('sbAccountList',compact('a'));
	}
	
	public function show_searchaccount()
	{
		return view('SearchedAccount');
		
	}
	
	public function show_rdaccount()
	{
		$Url="AccountCreation";
		$a['module']=$this->Modules->GetAnyMid($Url);
		$a['RdList']=$this->acc->getRDData();
		$a['RdList2']=$this->acc->getRDData2();
        return view('rdAccountList',compact('a'));
	}
	
	public function Show_AccountDetails($id,$type=null)
	{
		$Url="AccountCreation";
		$acd['module']=$this->Modules->GetAnyMid($Url);
		$acd['account']=$this->acc->GetAccount($id);
		if($type!=null)
			$acd['type']='edit';
		else
			$acd['type']='';
		return view('accountdetails',compact('acd'));
		
	}
	
	public function Show_AccountDetails_joint($id,$type=null)
	{
		$Url="AccountCreation";
		$acd['module']=$this->Modules->GetAnyMid($Url);
		$acd['account']=$this->acc->GetAccount_joint($id);
		if($type!=null)
			$acd['type']='edit';
		else
			$acd['type']='';
		return view('accountdetails',compact('acd'));
		
	}
	
	public function view_account()
	{
		$Url="AccountCreation";
		$AccCreate['module']=$this->Modules->GetAnyMid($Url);
		return view('acccreation',compact('AccCreate'));
	}
	
	public function ViewCreateJointAcc()
	{
		$Url="AccountCreation";
		$JAccCreate['module']=$this->Modules->GetAnyMid($Url);
		return view('CreateJointAccount',compact('JAccCreate'));
	}
	
	public function ViewMinorAccHome()
	{
		$Url="AccountCreation";
		$MAccHome['module']=$this->Modules->GetAnyMid($Url);
		return view('MinorAccountHome',compact('MAccHome'));
	}
	

	
	
	public function ViewCreateMinorAcc()
	{
		$Url="AccountCreation";
		$MAccCrt['module']=$this->Modules->GetAnyMid($Url);
		return view('CreateMinorAccount',compact('MAccCrt'));
	}
	
	public function create_account(Request $request)
	{
		$account['ob']=$request->input('ob');
		$account['branchid']=$request->input('branchid');
		$account['acctyp_11']=$request->input('acctyp_11');
		$account['user_ss']=$request->input('user_ss'); //this is user id
		$account['nfname']=$request->input('nfname');
		$account['nmname']=$request->input('nmname');
		$account['nlname']=$request->input('nlname');
		$account['nadd']=$request->input('nadd');
		$account['nage']=$request->input('nage');
		$account['nbdate']=$request->input('nbdate');
		$account['ncity']=$request->input('ncity');
		$account['nemail']=$request->input('nemail');
		$account['ngender']=$request->input('ngender');
		$account['nmstate']=$request->input('nmstate');
		$account['npno']=$request->input('npno');
		$account['nmno']=$request->input('nmno');
		$account['noccup']=$request->input('noccup');
		$account['npin']=$request->input('npin');
		$account['ndist']=$request->input('ndist');
		$account['nstate']=$request->input('nstate');
		//$account['crtdte']=$request->input('crtdte');
		$account['fddurtn']=$request->input('fddurtn');
		$account['oldaccno']=$request->input('oldaccno');
		$account['relation']=$request->input('relation');
		$account['atype']=$request->input('atype');
		   $account['rddurtn']=$request->input('rddurtn');
		$account['m']=$request->input('m');
		$account['branchcd']=$request->input('branchcd');
	
	$account['AccNum']=$request->input('AccNum');
		$account['SBAccountNum']=$request->input('SBAccountNum');
		$account['SBAvailhidn']=$request->input('SBAvailhidn');
		$account['AgentPayMode']=$request->input('AgentPayMode');
		
		
		$account['agid']=$request->input('agid');//Newly Added

		






		$id=$this->acc->insert($account);
		//return redirect('/');
		return redirect()->back();
	
	}
	
	public function UpdateAccount(Request $request)
	{
		
		
		$account['nid']=$request->input('nnid'); 
		$account['uid']=$request->input('nuid'); 
		$account['nfname']=$request->input('nfname');
		$account['nmname']=$request->input('nmname');
		$account['nlname']=$request->input('nlname');
		$account['nadd']=$request->input('nadd');
		$account['nage']=$request->input('nage');
		$account['nbdate']=$request->input('nbdate');
		$account['ncity']=$request->input('ncity');
		$account['nemail']=$request->input('nemail');
		$account['ngender']=$request->input('ngender');
		$account['nmstate']=$request->input('nmstate');
		$account['npno']=$request->input('npno');
		$account['nmno']=$request->input('nmno');
		$account['noccup']=$request->input('noccup');
		$account['npin']=$request->input('npin');
		$account['ndist']=$request->input('ndist');
		$account['nstate']=$request->input('nstate');
		$account['relation']=$request->input('relation'); 
		$account['totamt']=$request->input('totamt'); 
		$account['acid']=$request->input('acid'); 
		
		$id=$this->acc->updateaccount($account);
		
      
        return redirect('/');
		
		
	}
	public function checkacc(Request $request)
	{
		$a['userid']=$request->input('userid');
		
		$get=$this->acc->checkaccount($a);
		
		$id['chk']=$get->Uid;
		return $id;
	}
	
	public function usrty(Request $request)
	{
		$tyval = $request->brnch;
		$val = $this->acc->tyval($tyval);
		echo $val;
	}
	
	public function GetSearchAccs(Request $request)
	{
		$accsear['SearchAccId']=$request->input('SearchAccId');
		
		$Url="AccountCreation";
		$sac['module']=$this->Modules->GetAnyMid($Url);
		$sac['AccData']=$this->acc->GetSearchAccs($accsear);
		return view('SearchedAccount',compact('sac'));
		
	}
	
	public function GetSearchOldAccs(Request $request)
	{
		$oldaccsear['SearchOldAccId']=$request->input('SearchOldAccId');
		
		$Url="AccountCreation";
		$soac['module']=$this->Modules->GetAnyMid($Url);
		$soac['AccData']=$this->acc->GetSearchOldAccs($oldaccsear);
		return view('SearchedOldAccount',compact('soac'));
		
	}
	
	public function GetBranchid(Request $request)
	{
		$branch['branch']=$request->input('branch');
		$get=$this->acc->GetBranchid($branch);
		$id['bcode']=$get->BCode;
		return $id;
	}
	
	public function CreateJointAcc(Request $request)
	{
		//$account['accnum']=$request->input('accnum');
		$account['ob']=$request->input('ob');
		$account['branchid']=$request->input('branchid');
		$account['acctyp_11']=$request->input('acctyp_11');
		$account['jointuid']=$request->input('jointuid'); //this is joined user id like 1,2,3
		$account['nfname']=$request->input('nfname');
		$account['nmname']=$request->input('nmname');
		$account['nlname']=$request->input('nlname');
		$account['nadd']=$request->input('nadd');
		$account['nage']=$request->input('nage');
		$account['nbdate']=$request->input('nbdate');
		$account['ncity']=$request->input('ncity');
		$account['nemail']=$request->input('nemail');
		$account['ngender']=$request->input('ngender');
		$account['nmstate']=$request->input('nmstate');
		$account['npno']=$request->input('npno');
		$account['nmno']=$request->input('nmno');
		$account['noccup']=$request->input('noccup');
		$account['npin']=$request->input('npin');
		$account['ndist']=$request->input('ndist');
		$account['nstate']=$request->input('nstate');
		$account['crtdte']=$request->input('crtdte');
		$account['fddurtn']=$request->input('fddurtn');
		$account['oldaccno']=$request->input('oldaccno');
		$account['relation']=$request->input('relation');
		$account['atype']=$request->input('atype');
		   $account['rddurtn']=$request->input('rddurtn');
		$account['m']=$request->input('m');
		$account['branchcd']=$request->input('branchcd');

		



		$id=$this->acc->CreateJointAcc($account);
		return redirect('/');
	
	}
	
	public function CreateMinorAccount(Request $request)
	{
		//$account['accnum']=$request->input('accnum');
		$account['ob']=$request->input('ob');
		$account['branchid']=$request->input('branchid');
		$account['acctyp_11']=$request->input('acctyp_11');
		$account['user_ss']=$request->input('user_ss'); //this is joined user id like 1,2,3
		$account['nfname']=$request->input('nfname');
		$account['nmname']=$request->input('nmname');
		$account['nlname']=$request->input('nlname');
		$account['nadd']=$request->input('nadd');
		$account['nage']=$request->input('nage');
		$account['nbdate']=$request->input('nbdate');
		$account['ncity']=$request->input('ncity');
		$account['nemail']=$request->input('nemail');
		$account['ngender']=$request->input('ngender');
		$account['nmstate']=$request->input('nmstate');
		$account['npno']=$request->input('npno');
		$account['nmno']=$request->input('nmno');
		$account['noccup']=$request->input('noccup');
		$account['npin']=$request->input('npin');
		$account['ndist']=$request->input('ndist');
		$account['nstate']=$request->input('nstate');
		$account['crtdte']=$request->input('crtdte');
		$account['fddurtn']=$request->input('fddurtn');
		$account['oldaccno']=$request->input('oldaccno');
		$account['relation']=$request->input('relation');
		$account['atype']=$request->input('atype');
		   $account['rddurtn']=$request->input('rddurtn');
		$account['m']=$request->input('m');
		$account['branchcd']=$request->input('branchcd');

		



		$id=$this->acc->CreateMinorAccount($account);
		return redirect('/');
	
	}
	
	public function get_account_balance(Request $request)
	{
		$in_data["acc_id"] = $request->input("acc_id");
		$balance = $this->acc->get_account_balance($in_data);
		return $balance;
	}
	
	public function swap_sb_tranid(Request $request)
	{
		$in_data["sb_tran_id_1"] = $request->input("sb_tran_id_1");
		$in_data["sb_tran_id_2"] = $request->input("sb_tran_id_2");
		$out_data = $this->acc->swap_sb_tranid($in_data);
		return json_encode($out_data);
	}
	
	public function delete_sb_tranid(Request $request)
	{
		$in_data["sb_tran_id"] = $request->input("sb_tran_id");
		$out_data = $this->acc->delete_sb_tranid($in_data);
		return json_encode($out_data);
	}
	

	
}

