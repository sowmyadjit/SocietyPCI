<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\FdAllocationModel;
use App\Http\Model\AccountModel;
use App\Http\Model\prewithdrawalModel;
use App\Http\Model\OpenCloseModel;
use App\Http\Model\ModulesModel;
class FdAllocationController extends Controller
{
    
	  public function __construct()
    {
        $this->fdallocation_model= new FdAllocationModel;
		$this->acc=new AccountModel;
		$this->prewithdraw=new prewithdrawalModel;
		$this->OP_model=new OpenCloseModel;
		$this->Modules= new ModulesModel;
		
    }
	
public function Show_FdAlloc()
		{
			$Url="fdallocation";
			$fda['module']=$this->Modules->GetAnyMid($Url);
			$fda['data']=$this->fdallocation_model->getallocdetail();
			$fda['data_all']=$this->fdallocation_model->getallocdetail_all();
			$fda['open']=$this->OP_model->openstate();
			$fda['close']=$this->OP_model->openclosestate();
			if(empty($fda['open']))
			{
				$fda['open']=0;
			}
			else
			{
				$fda['open']=1;
			} 
			if(empty($fda['close']))
			{
				$fda['close']=0;
			}
			else
			{
				$fda['close']=1;
			}
			return view('fdallocation',compact('fda'));
		}
	
		public function Show_FdAlloc2()
		{
			$Url="fdallocation";
			$fda['module']=$this->Modules->GetAnyMid($Url);
			return view('fd_allocation_index',compact('fda'));
		}
		
		public function FDSearchView(Request $request) //M 19-4-16 for fdsearch
		{
			$id=$request->input('SearchAccId');
			$fda=$this->fdallocation_model->FDSearchData($id);
			return view('FDSearch',compact('fda'));
		}
		public function show_crtfdalloc()
		{
			$fda=$this->fdallocation_model->crtfdalloc();
			return view('createfdallocation',compact('fda'));
		}
		
		public function create_fdalloc(Request $request)
		{
			$fdalloc['accid']=$request->input('accid');
			$fdalloc['accid_int']=$request->input('accid_int');
			$fdalloc['userid']=$request->input('userid');
			$fdalloc['fdtid']=$request->input('interest');
			$fdalloc['fddep']=$request->input('fddep');
			$fdalloc['mamt']=$request->input('mamt');
			$fdalloc['days']=$request->input('days');
			
			$fdalloc['fdalloc']=$request->input('fdalloc');
			$fdalloc['fdallocreport']=$request->input('fdallocreport');
			$fdalloc['s_dte']=$request->input('s_dte');
			$fdalloc['e_dte']=$request->input('e_dte');
			$fdalloc['fdrem']=$request->input('fdrem');
			
			$fdalloc['branchcode']=$request->input('branchcode');
			$fdalloc['FdBankName']=$request->input('FdBankName');
			
			$fdalloc['fdpaymode']=$request->input('fdpaymode');
			$fdalloc['fdsbamount']=$request->input('fdsbamount');
			$fdalloc['fdchequeno']=$request->input('fdchequeno');
			$fdalloc['fdchdate']=$request->input('fdchdate');
			$fdalloc['bnk']=$request->input('bnk');
			$fdalloc['fdbankbranch']=$request->input('fdbankbranch');
			$fdalloc['fdifsccode']=$request->input('fdifsccode');
			$fdalloc['fduncleared']=$request->input('fduncleared');
			$fdalloc['fdunclearedval']=$request->input('fdunclearedval');
			$fdalloc['sbavailable']=$request->input('sbavailable');
			$fdalloc['bid']=$request->input('bid');
			$fdalloc['uid']=$request->input('uid');
			
			
			$fdalloc['nfname']=$request->input('nfname');
			$fdalloc['nmname']=$request->input('nmname');
			$fdalloc['nlname']=$request->input('nlname');
			$fdalloc['reltn']=$request->input('reltn');
			$fdalloc['nemail']=$request->input('nemail');
			$fdalloc['ngender']=$request->input('ngender');
			$fdalloc['nmstate']=$request->input('nmstate');
			$fdalloc['nage']=$request->input('nage');
			$fdalloc['nbdate']=$request->input('nbdate');
			$fdalloc['noccup']=$request->input('noccup');
			$fdalloc['nmno']=$request->input('nmno');
			$fdalloc['npno']=$request->input('npno');
			$fdalloc['nadd']=$request->input('nadd');
			$fdalloc['ncity']=$request->input('ncity');
			$fdalloc['ndist']=$request->input('ndist');
			$fdalloc['nstate']=$request->input('nstate');
			$fdalloc['npin']=$request->input('npin');
			$fdalloc['intneeded']=$request->input('intneeded');
			$fdalloc['month']=$request->input('month');
			$fdalloc['monthinterest']=$request->input('monthinterest');
			$fdalloc['accid']=$request->input('accid');
			
			$id=$this->fdallocation_model->InsertFdAlloc($fdalloc);
			return redirect('/');
		}
	
	public function retfdDetail(Request $request)
	{
		$acc['acttype']=$request->input('acttype');
		$get=$this->acc->getvalue($acc);
		//print_r($get);
		$id['crbal']=$get->Total_Bal;
		$id['actype']=$get->Acc_Type;
		$id['fname']=$get->FirstName;
		$id['acid']=$get->AccTid;
		return $id;
	}
	
	public function GetBranchCode(Request $request)
	{
		$fdbranch['branch']=$request->input('branch');
		$get=$this->fdallocation_model->GetBranchCode($fdbranch);
		$id['bcode']=$get->BCode;
		return $id;
	}
	
	//To get bank Name in Dropdown list (Newly Added)
	/*public function getbnknme(Request $request)
    {
		$data ='';
		$bnk['branchname']=$request->input('branchname');
        $addbank=$this->fdallocation_model->getbnknme($bnk);
		$data.='<select class="form-control"  id="bnk" name="bnk">';
			$data.='<option></option>';
			foreach( $addbank as $key){
				$data.='<option value='.$key->Bankid.' >'.$key->BankName.'</option>';
			
			}
			$data.='</select> ';
		echo $data;
		
    }*/
	
	public function GetSBAmt(Request $request)
    {


	 $sbamt=$request->input('actid');

			/*********/
			$fn_data["acc_id"] =  $request->input('actid');
			$sb_balance = $this->acc->get_account_balance($fn_data);
			/*********/


		$get=$this->fdallocation_model->GetSBAmt($sbamt);
		$id['total'] = $sb_balance; // $get->Total_Bal;
		return $id;

    }
    
	
	
	public function ShowFdCertificate($id)
	{
		$FdCert['FdCertificate']=$this->fdallocation_model->GetFdCertificate($id);
		return view('FdCertificate',compact('FdCert'));
		
	}
	
	public function ShowFDReceipt($id)
	{
		$FdReceiptData['FdReceipt']=$this->fdallocation_model->GetFdCertificate($id);
		return view('FdReceipt',compact('FdReceiptData'));
		
	}
	
	public function prefdwithdrawal(Request $request)
	{
		$fdwithdrw['fdaccount']=$request->input('fdaccount');
		$id=$this->prewithdraw->prefdwithdrawal($fdwithdrw);
	}
		public function FdCertStatUpdate(Request $request)
		{
			$fdid['Fdid']=$request->input('Fdid');
			$this->fdallocation_model->FdCertStatUpdate($fdid);
			
			
		}
		public function kccallocation(Request $request)
		{
			//return view('kccalocation');
			$fda['data']=$this->fdallocation_model->kccallocation();
			$fda['open']=$this->OP_model->openstate();
			$fda['close']=$this->OP_model->openclosestate();
			if(empty($fda['open']))
			{
				$fda['open']=0;
			}
			else
			{
				$fda['open']=1;
			} 
			if(empty($fda['close']))
			{
				$fda['close']=0;
			}
			else
			{
				$fda['close']=1;
			}
			return view('kcclist',compact('fda'));
		}
		
		public function kccallocation2(Request $request)
		{
			$Url="kccallocation";
			$fda['module']=$this->Modules->GetAnyMid($Url);
			return view('kcc_allocation_index',compact('fda'));
		}
			
		
		
		public function crtkccallocation()
		{
			return view('kccalocation');
			
		}
		
		public function crtkccalloc(Request $request)
		{
			
			$fdalloc['accid']=$request->input('accid');
			$fdalloc['userid']=$request->input('userid');
			$fdalloc['fdtid']=$request->input('fdtid');
			$fdalloc['fddep']=$request->input('fddep');
			$fdalloc['mamt']=$request->input('mamt');
			
			$fdalloc['fdalloc']=$request->input('fdalloc');
			$fdalloc['fdallocreport']=$request->input('fdallocreport');
			$fdalloc['fdedte']=$request->input('fdedte');
			$fdalloc['fdrem']=$request->input('fdrem');
			
			$fdalloc['branchcode']=$request->input('branchcode');
			$fdalloc['FdBankName']=$request->input('FdBankName');
			
			$fdalloc['fdpaymode']=$request->input('fdpaymode');
			$fdalloc['fdsbamount']=$request->input('fdsbamount');
			$fdalloc['fdchequeno']=$request->input('fdchequeno');
			$fdalloc['fdchdate']=$request->input('fdchdate');
			$fdalloc['bnk']=$request->input('bnk');
			$fdalloc['fdbankbranch']=$request->input('fdbankbranch');
			$fdalloc['fdifsccode']=$request->input('fdifsccode');
			$fdalloc['fduncleared']=$request->input('fduncleared');
			$fdalloc['fdunclearedval']=$request->input('fdunclearedval');
			$fdalloc['sbavailable']=$request->input('sbavailable');
			$fdalloc['bid']=$request->input('bid');
			$fdalloc['uid']=$request->input('uid');
			
			
			$fdalloc['nfname']=$request->input('nfname');
			$fdalloc['nmname']=$request->input('nmname');
			$fdalloc['nlname']=$request->input('nlname');
			$fdalloc['reltn']=$request->input('reltn');
			$fdalloc['nemail']=$request->input('nemail');
			$fdalloc['ngender']=$request->input('ngender');
			$fdalloc['nmstate']=$request->input('nmstate');
			$fdalloc['nage']=$request->input('nage');
			$fdalloc['nbdate']=$request->input('nbdate');
			$fdalloc['noccup']=$request->input('noccup');
			$fdalloc['nmno']=$request->input('nmno');
			$fdalloc['npno']=$request->input('npno');
			$fdalloc['nadd']=$request->input('nadd');
			$fdalloc['ncity']=$request->input('ncity');
			$fdalloc['ndist']=$request->input('ndist');
			$fdalloc['nstate']=$request->input('nstate');
			$fdalloc['npin']=$request->input('npin');
			
			$fdalloc['accid']=$request->input('accid');
			
			
			$id=$this->fdallocation_model->crtkccalloc($fdalloc);
			return redirect('/');
			
		}

		public function fdrenew(Request $request)
		{
			$fdrenew['fdtype']=$request->input('fdtype');
			$fdrenew['fdaccno']=$request->input('fdaccno');
			$fdrenew['fdmatureaccno']=$request->input('fdmatureaccno');
				
			$fdrenew['data']=$this->fdallocation_model->fdrenew($fdrenew);
			$fdrenew['int']=$this->fdallocation_model->crtfdalloc();
			return view('FdReNewHome',compact('fdrenew'));
			
		}
		
		public function kccrenew(Request $request)
		{
			$fdrenew['fdtype']=$request->input('fdtype');
			$fdrenew['fdaccno']=$request->input('fdaccno');
			$fdrenew['fdmatureaccno']=$request->input('fdmatureaccno');
			
			$fdrenew['data']=$this->fdallocation_model->kccrenew($fdrenew);
			$fdrenew['data']->old_kcc_id = $request->input('fdmatureaccno');

			$fdrenew['int']=$this->fdallocation_model->crtfdalloc();
			return view('KccReNewHome',compact('fdrenew'));
		}

		public function fdrenewdetails(Request $request)
		{
			
			$fdalloc['nfname']=$request->input('nfname');
			$fdalloc['nmname']=$request->input('nmname');
			$fdalloc['nlname']=$request->input('nlname');
			$fdalloc['reltn']=$request->input('reltn');
			$fdalloc['nemail']=$request->input('nemail');
			$fdalloc['ngender']=$request->input('ngender');
			$fdalloc['nmstate']=$request->input('nmstate');
			$fdalloc['nage']=$request->input('nage');
			$fdalloc['nbdate']=$request->input('nbdate');
			$fdalloc['noccup']=$request->input('noccup');
			$fdalloc['nmno']=$request->input('nmno');
			$fdalloc['npno']=$request->input('npno');
			$fdalloc['nadd']=$request->input('nadd');
			$fdalloc['ncity']=$request->input('ncity');
			$fdalloc['ndist']=$request->input('ndist');
			$fdalloc['nstate']=$request->input('nstate');
			$fdalloc['npin']=$request->input('npin');
			$fdalloc['intneeded']=$request->input('intneeded');
			$fdalloc['month']=$request->input('month');
			$fdalloc['monthinterest']=$request->input('monthinterest');
			$fdalloc['accid']=$request->input('accid');
			$fdalloc['depositamount']=$request->input('depositamount');
			$fdalloc['mamt']=$request->input('mamt');
			$fdalloc['fdedtereadonly']=$request->input('fdedtereadonly');
			$fdalloc['fdallocstaet']=$request->input('fdallocstaet');
			$fdalloc['userid']=$request->input('userid');
			$fdalloc['branchid']=$request->input('branchid');
			$fdalloc['fdid']=$request->input('fdid');
			$fdalloc['fdallocid']=$request->input('fdallocid');
			$fdalloc['fdtype']=$request->input('fdtype');
			$fdalloc['fdedte']=$request->input('fdedte');
			$fdalloc['days']=$request->input('days');
			$fdalloc['interest']=$request->input('interest');
			
			$this->fdallocation_model->fdrenewdetails($fdalloc);
		}
		
		public function kccrenewdetails(Request $request)
		{
			$fdalloc['old_kcc_id'] = $request->input("old_kcc_id");
			
			$fdalloc['accid']=$request->input('accid');
			$fdalloc['userid']=$request->input('userid');
			$fdalloc['fdtid']=$request->input('fdtid');
			$fdalloc['fddep']=$request->input('fddep');
			$fdalloc['mamt']=$request->input('mamt');
			
			$fdalloc['fdalloc']=$request->input('fdalloc');
			$fdalloc['fdallocreport']=$request->input('fdallocreport');
			$fdalloc['fdedte']=$request->input('fdedte');
			$fdalloc['fdrem']=$request->input('fdrem');
			
			$fdalloc['branchcode']=$request->input('branchcode');
			$fdalloc['FdBankName']="";
			
			$fdalloc['fdpaymode']=$request->input('fdpaymode');
			$fdalloc['fdsbamount']="";
			$fdalloc['fdchequeno']="";
			$fdalloc['fdchdate']="";
			$fdalloc['bnk']="";
			$fdalloc['fdbankbranch']="";
			$fdalloc['fdifsccode']="";
			$fdalloc['fduncleared']="";
			$fdalloc['fdunclearedval']="CLEARED";
			$fdalloc['sbavailable']=$request->input('sbavailable');
			$fdalloc['bid']=$request->input('bid');
			$fdalloc['uid']=$request->input('uid');
			
			
			$fdalloc['nfname']=$request->input('nfname');
			$fdalloc['nmname']=$request->input('nmname');
			$fdalloc['nlname']=$request->input('nlname');
			$fdalloc['reltn']=$request->input('reltn');
			$fdalloc['nemail']=$request->input('nemail');
			$fdalloc['ngender']=$request->input('ngender');
			$fdalloc['nmstate']=$request->input('nmstate');
			$fdalloc['nage']=$request->input('nage');
			$fdalloc['nbdate']=$request->input('nbdate');
			$fdalloc['noccup']=$request->input('noccup');
			$fdalloc['nmno']=$request->input('nmno');
			$fdalloc['npno']=$request->input('npno');
			$fdalloc['nadd']=$request->input('nadd');
			$fdalloc['ncity']=$request->input('ncity');
			$fdalloc['ndist']=$request->input('ndist');
			$fdalloc['nstate']=$request->input('nstate');
			$fdalloc['npin']=$request->input('npin');
			
			
			$this->fdallocation_model->kccrenewdetails($fdalloc);
		}

		public function FDedit($id)
		{
			$fddetails=$this->fdallocation_model->FDedit($id);
			return view('fdedit',compact('fddetails'));
			
		}
		public function editfd(Request $request)
		{
			
			$fddetails['cd']=$request->input('cd');
			$fddetails['ed']=$request->input('ed');
			$fddetails['ta']=$request->input('ta');
			$fddetails['ta1']=$request->input('ta1');
			$fddetails['alocid']=$request->input('alocid');
			$this->fdallocation_model->editfd($fddetails);
		}
}
