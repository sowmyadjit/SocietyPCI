<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\ShareModel;
use App\Http\Model\ModulesModel;
use App\Http\Model\OpenCloseModel;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	// var share_model;
	 public function __construct()
    {
        $this->share_model= new ShareModel;
		$this->Modules= new ModulesModel;
				$this->OP_model=new OpenCloseModel;
    }
	
	public function Show_Shares()
	{
		//$s=ShareModel::all();
		$Url="shares";
		$s['module']=$this->Modules->GetAnyMid($Url);
		$s['shares']=$this->share_model->GetShareTypes();
		return view('share',compact('s'));
	}
	public function view_Shares()
	{
		$Url="shares";
		$s['module']=$this->Modules->GetAnyMid($Url);
		return view('createshare',compact('s'));
	}
	public function create_Shares(Request $request)
	{
		
	
		$shares['Sclass']=$request->input('Sclass');
		$shares['facevalue']=$request->input('facevalue');
		$shares['shareprice']=$request->input('shareprice');
		
		$id=$this->share_model->insert($shares);
		return;
	
	}
	
	
	
    public function request_Shares()
    {
		$Url="requestshares";
		$interest['module']=$this->Modules->GetAnyMid($Url);
		
      $interest['open']=$this->OP_model->openstate();
			$interest['close']=$this->OP_model->openclosestate();
			if(empty($interest['open']))
			{
				$interest['open']=0;
			}
			else
			{
				$interest['open']=1;
			} 
			if(empty($interest['close']))
			{
				$interest['close']=0;
			}
			else
			{
				$interest['close']=1;
			}
			
			return view('requestshares',compact('interest'));
       
    }
	
	public function sharetypeedit($id)
	{
			
			$share=$this->share_model->sharetypeedit($id);
			
			return view('sharetypeedit',compact('share'));
			
		}
		public function shareedit(Request $request)
		{
		$shares['facevalue']=$request->input('facevalue');
		$shares['shareid']=$request->input('shareid');
		$id=$this->share_model->shareedit($shares);
		//return redirect('/');
			
		}
/*		public function divident()
		{
			$shares=$this->share_model->All();
			return view('divident',compact('shares'));
		}
		public function adddivident(Request $request)
		{
			$shares['shareclassid']=$request->input('shareclassid');
			$shares['classname']=$request->input('classname');
			$shares['da']=$request->input('da');
			$id=$this->share_model->adddivident($shares);
			
		}*/
		
		public function divident()
		{
			$Url = "divident";
			$shares['module'] = $this->Modules->GetAnyMid($Url);
		//	$shares = $this->share_model->All();
			$shares['det'] = $this->share_model->shareDetails();
			return view('divident',compact('shares'));
		}
		
		public function getdivident(Request $request)
		{
			$Url = "divident";
			$data['class'] = $this->share_model->shareDetails();
			$data['module'] = $this->Modules->GetAnyMid($Url);
			return view("getdivident",compact("data"));
		}
		
		public function adddivident(Request $request)
		{
			$shares['share_class_id']=$request->input('shareclassid');
//			$shares['share_class']=$request->input('share_classclassname');
			$shares['start_date']=$request->input('start_date');
			$shares['end_date']=$request->input('end_date');
			$shares['div_percent']=$request->input('div_percent');
print_r($shares);
			$id=$this->share_model->adddivident($shares);
			return "done";
		}
		
		public function divident_amt_view(Request $request)
		{
			$data = $this->share_model->divident_amt_view();
			return view('divident_amt_view',compact('data'));
			return $div_edit = $this->share_model->divident_amt_view($data);
			
		}
		
		public function edit_div_amt(Request $request)
		{
			$data['divident_amt']=$request->input('divident_amt');
			$data['id']=$request->input('id');
			return $this->share_model->edit_div_amt($data);
		}
		
		public function create_divident(Request $request)
		{
			$this->share_model->create_divident();
			return "done";
		}
		
		public function divident_pay_list_get_branch(Request $request)
		{
			$data["branch"] = $this->share_model->get_branches();
			$data["share_class"] = $this->share_model->get_share_classes();
			return view('divident_pay_list_get_branch',compact('data'));
		}
		
		public function divident_pay_list_data(Request $request)
		{
			$in_data["bid"] = $request->input("bid");
			$in_data["share_class_id"] = $request->input("share_class_id");
			$data["transactions"] = $this->share_model->divident_pay_list_data($in_data);
			return view('divident_pay_list_data',compact('data'));
		}
		
		public function pay_individual_divident_view(Request $request)
		{
			$data["member_id"] = $request->input("member_id");
			$data["member_no"] = $request->input("member_no");
			$data["name"] = $request->input("name");
			$data["div_amt"] = $request->input("div_amt");
			$data["pay_amt"] = $request->input("pay_amt");
			return view('pay_individual_divident_view',compact('data'));
		}
		
		public function old_pay_individual_divident(Request $request)
		{
		/*	$in_data["amount"] = $request->input("amount");
			$in_data["member_id"] = $request->input("member_id");
			$this->share_model->pay_individual_divident($in_data);
			return "done";*/
		}
		
		public function pay_individual_divident(Request $request)
		{
			$in_data["member_id"] = $request->input("member_id");
			$in_data["member_no"] = $request->input("member_no");
			$in_data["name"] = $request->input("name");
			$in_data["date"] = $request->input("date");
			$in_data["div_amt"] = $request->input("div_amt");
			$in_data["pay_amt"] = $request->input("pay_amt");
			$in_data["payment_mode"] = $request->input("payment_mode");
			$in_data["chq_no"] = $request->input("chq_no");
			$in_data["chq_date"] = $request->input("chq_date");
			$in_data["bank_name"] = $request->input("bank_name");
			$in_data["bank_id"] = $request->input("bank_id");
			return $this->share_model->pay_individual_divident($in_data);
			return "done";
		}
		
		public function pay_multiple_divident(Request $request)
		{
			$in_data["amounts"] = $request->input("amounts");
			$in_data["member_ids"] = $request->input("member_ids");
			$in_data["total_amount"] = $request->input("total_amount");
//			$in_data["branch_id"] = $request->input("branch_id");
//			$in_data["share_class_id"] = $request->input("share_class_id");
			
//			print_r($in_data); return;
			$this->share_model->pay_multiple_divident($in_data);
			return "done";
		}
		
		public function divident_report(Request $request)
		{
			$data["branch"] = $this->share_model->get_branches();
			$data["share_class"] = $this->share_model->get_share_classes();
			return view('divident_report',compact('data'));
		}
		
		public function divident_report_data(Request $request)
		{
			$in_data["bid"] = $request->input("bid");
			$in_data["share_class_id"] = $request->input("share_class_id");
			$data["transactions"] = $this->share_model->divident_report_data($in_data);
			return view('divident_report_data',compact('data'));
		}
		
		public function RetrieveMemData(Request $request)//MA 31-05-16 FOR DIVIDENT TRAN GET MEMBER DATA
		{
			$shares['PURSH_Pid']=$request->input('PURSH_Pid');
			$id=$this->share_model->RetrieveMemData($shares);
			$details['PURSH_Certfid']=$id->PURSH_Certfid;
			$details['FirstName']=$id->FirstName;
			$details['MiddleName']=$id->MiddleName;
			$details['LastName']=$id->LastName;
			$details['PURSH_Noofshares']=$id->PURSH_Noofshares;
			$details['Divident_Amt']=$id->Divident_Amt;
			$details['PURSH_Memid']=$id->PURSH_Memid;
			$details['PURSH_Shrclass']=$id->PURSH_Shrclass;
			
			return $details;
			
		}
		
		public function CreateDividentTransaction(Request $request)//MA 31-05-16 FOR DIVIDENTTRAN CREATE DIVIDENT TRANSACION
		{
			$param['MemberId']=$request->input('MemberId');
			$param['CertificateId']=$request->input('CertificateId');
			$param['DividentPaid']=$request->input('DividentPaid');
			$param['accid']=$request->input('accid');
			
			
			$id=$this->share_model->CreateDividentTransaction($param);
			return redirect('/');
		}

    
}

