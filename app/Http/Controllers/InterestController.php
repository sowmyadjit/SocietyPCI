<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\InterestModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\OpenCloseModel;
	
	class InterestController extends Controller
	{
		public function __construct()
		{
			$this->interest_model= new InterestModel;
			$this->Modules= new ModulesModel;
			$this->OP_model=new OpenCloseModel;
		}
/*		
		public function sbinterest_cal(Request $request)
		{
			
			$interst['acctyp_11']=$request->input('acctyp_11');
			$interst['calculation_month_value']=$request->input('calculation_month_value');
			$interst['interest_year']=$request->input('interest_year');
			$sb=$this->interest_model->sbinterest_cal($interst);
		} */
		
		public function sbinterest_cal2(Request $request)
		{
			$data["int_month"] = $request->input('calculation_month_value');
			$data["int_year"] = $request->input('interest_year');
			$data['acctype'] = $request->input('acctyp_11');
			$sb=$this->interest_model->sbinterest_cal2($data);//sbinterest_cal()
		}
		
		public function pigmiInterest()
		{
			$Url="pigmiinterest";
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
			
			return view('pigmiinterest',compact('interest'));
		}
		
		public function pigmiInterestCalc(Request $request)
		{
			
			$interest['acc11']=$request->input('acc11');
			$pa=$this->interest_model->pigmiintcalc($interest);
			return $pa;
		}
		
		public function rdinterest_cal(Request $request)
		{
			$interst['rdaccid']=$request->input('rdaccid');
			
			$rd=$this->interest_model->rdinterest_cal($interst);
			return $rd;
		}
		
		public function FDwithdraw(Request $request)
		{
			$interst['fdalocid']=$request->input('fdalocid');
			$FD=$this->interest_model->FDwithdraw($interst);
		}
		public function editpigmiInterestCalc(Request $request)
		{
			$interst['intrestamt']=$request->input('intrestamt');
			$interst['acc11']=$request->input('acc11');
			$interst['acualamt']=$request->input('acualamt');
			$FD=$this->interest_model->editpigmiInterestCalc($interst);
			return $FD;
		}
		public function editrdInterestCalc(Request $request)
		{
			$interst['intrestamt']=$request->input('intrestamt');
			$interst['acc11']=$request->input('acc11');
			$interst['acualamt']=$request->input('acualamt');
			$FD=$this->interest_model->editrdInterestCalc($interst);
			return $FD;
		}
		public function sdpay()
		{
			return view('sdpay');
			
		}
		public function getemployeeSD(Request $request)
		{
			$uid=$request->input('selectemp');
			
			$sd1=DB::table('employee')->select('Emp_Secutity_Deposit')->where('Uid',$uid)->first();
			$sd['sd']=$sd1->Emp_Secutity_Deposit;
			return $sd;
		}
		public function SDINTERESTPAY(Request $request)
		{
			$dte=date('Y-m-d');
			$m=date('m');
			$y=date('Y');
			$sd['accnum']=$request->input('accnum');
			$sd['selectemp']=$request->input('selectemp');
			$sd['sdi']=$request->input('sdi');
			$tot1=DB::table('createaccount')->select('Total_Amount','Bid')->where('Accid',$sd['accnum'])->first();
			$tot=$tot1->Total_Amount;
			$Bid=$tot1->Bid;
			$amt=$sd['sdi']+$tot;
			DB::table('sb_transaction')->insert(['Accid'=>$sd['accnum'],'AccTid'=>"1",'TransactionType'=>"CREDIT",'particulars'=>"SD INTEREST",'Amount'=>$sd['sdi'],'CurrentBalance'=>$tot,'tran_Date'=>$dte,'SBReport_TranDate'=>$dte,'Month'=>$m,'Year'=>$y,'Total_Bal'=>$amt,'Bid'=>$Bid,'Payment_Mode'=>"SD"]);
			DB::table('createaccount')->where('Accid',$sd['accnum'])->update(['Total_Amount'=>$amt]);
		}
		
		public function calc_service_charge(Request $request)
		{
			$in_data["type"] = $request->input("type");
			$in_data["year"] = $request->input("year");
//			var_dump($in_data);exit();
			if(!empty($in_data["type"]) && !empty($in_data["year"])) {
				switch($in_data["type"]) {
					case "SB":	$this->interest_model->calc_service_charge_sb($in_data);
								break;
					case "PIGMY":	$this->interest_model->calc_service_charge_pg($in_data);
								break;
					return 11;
				}
			}
			
		}
		
		public function calc_service_charge_initial(Request $request)
		{
			return view('service_charge_interest');	
		}
		
		public function calc_service_charge_alrdy_cal(Request $request){
			$in_data["type"] = $request->input("type");
			$return_data=$this->interest_model->calc_service_charge_alrdy_cal($in_data);
			return view('calc_service_charge_alrdy_cal',compact('return_data'));
		}
		
	}
