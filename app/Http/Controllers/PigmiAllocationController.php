<?php
	
	namespace App\Http\Controllers;
	use Auth;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\PigmiAllocationModel;
	use App\Http\Model\PigmiModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\OpenCloseModel;
	use App\Http\Model\ReportModel;
	class PigmiAllocationController extends Controller
	{
		/**
			* Display a listing of the resource.
			*
			* @return \Illuminate\Http\Response
		*/
		public function __construct()
		{
			$this->pigmiallocation_model= new PigmiAllocationModel;
			$this->pigmi_model=new PigmiModel;
			$this->Modules= new ModulesModel;
			$this->OP_model=new OpenCloseModel;
			$this->Report_model = new ReportModel;
		}
		
		public function Show_PigmiAlloc()
		{
			$Url="pigmiallocation";
			$pa['module']=$this->Modules->GetAnyMid($Url);
			$pa['data']=$this->pigmiallocation_model->getallocdetail();
			$pa['open']=$this->OP_model->openstate();
			$pa['close']=$this->OP_model->openclosestate();
			
			if(empty($pa['open']))
			{
				$pa['open']=0;
			}
			else
			{
				$pa['open']=1;
			} 
			if(empty($pa['close']))
			{
				$pa['close']=0;
			}
			else
			{
				$pa['close']=1;
			}
			return view('pigmiallocation',compact('pa'));
		}
		
		public function Show_PigmiAlloc2()
		{
			$Url="pigmiallocation";
			$pa['module']=$this->Modules->GetAnyMid($Url);
			$agent_data = $this->pigmiallocation_model->get_agents();
			return view('pigmiallocation_index',compact('pa','agent_data'));
		}
		
		public function PigmySearchView(Request $request) //M 20-4-16 For pigmiallocation
		{
			$id=$request->input('SearchAccId');
			$pa=$this->pigmiallocation_model->GetSearchData($id);
			return view('PigmyAllocationSearch',compact('pa'));
		}
		public function show_crtpigmialloc()
		{
			return view('createpigmiallocation');
		}
		public function retrieve_comm(Request $request)
		{
			$pgm['pigmiid']=$request->input('pigmiid');
			$get=$this->pigmi_model->getpigmi($pgm);
			$id['commission']=$get->Commission;
			return $id;
		}
		public function create_pigmialloc(Request $request)
		{
			$pigmialloc['pigmid']=$request->input('pigmid');
			$pigmialloc['agid']=$request->input('agid');
			$pigmialloc['uid']=$request->input('uid');
			$pigmialloc['pgcmsn']=$request->input('pgcmsn');
			$pigmialloc['opngbal']=$request->input('opngbal');
			$pigmialloc['pgalloc']=$request->input('pgalloc');
			$pigmialloc['pgsdte']=$request->input('pgsdte');
			$pigmialloc['pgedte']=$request->input('pgedte');
			$pigmialloc['branch']=$request->input('branch');
			$pigmialloc['branchid']=$request->input('branchid');
			
			$id=$this->pigmiallocation_model->insert($pigmialloc);
			return redirect('/');
		}
		
		public function Getbranchid(Request $request)
		{
			$branch['branch']=$request->input('branch');
			$get=$this->pigmiallocation_model->Getbranchid($branch);
			$id['bcde']=$get->BCode;
			return $id;
		}
		
		public function PigmiPendingAmtView()
		{
			$Url="PigmiPendingAmt";
			$PendingList['module']=$this->Modules->GetAnyMid($Url);
			$PendingList['data']=$this->pigmiallocation_model->PigmiPendingAmtView();
			$PendingList['open']=$this->OP_model->openstate();
			$PendingList['close']=$this->OP_model->openclosestate();
			
			if(empty($PendingList['open']))
			{
				$PendingList['open']=0;
			}
			else
			{
				$PendingList['open']=1;
			} 
			if(empty($PendingList['close']))
			{
				$PendingList['close']=0;
			}
			else
			{
				$PendingList['close']=1;
			}
			return view('PendingPigmyAmountHome',compact('PendingList'));
		}
		
		public function ReceivePigmiPendingAmtView($id)
		{
			$PendingAgent=$this->pigmiallocation_model->ReceivePigmiPendingAgentData($id);
			return view('ReceivePigmiPendingAmount',compact('PendingAgent'));
		}
		public function ReceivePigmyPendingAmt(Request $request)
		{
			$ReceivedPigmy['PPrPpId']=$request->input('PPrPpId');
			$ReceivedPigmy['PPrPaidAmt']=$request->input('PPrPaidAmt');
			$ReceivedPigmy['PPrPendingBal']=$request->input('PPrPendingBal');
			$ReceivedPigmy['PPrPendingAmt']=$request->input('PPrPendingAmt');
			$id=$this->pigmiallocation_model->ReceivePigmyPendingAmt($ReceivedPigmy);
			return redirect('/');
		}
		public function ViewPigallocEdit($id)
		{
			
			$pigallocid=$this->pigmiallocation_model->ViewPigallocEdit($id);
			
			return view('createpigmiallocationedit',compact('pigallocid'));
			
		}
		public function editpigmialloc(Request $request)
		{
			$param['cd']=$request->input('cd');
			$param['sd']=$request->input('sd');
			$param['ed']=$request->input('ed');
			$param['ta']=$request->input('ta');
			$param['alocid']=$request->input('alocid');
			$id=$this->pigmiallocation_model->editpigmialloc($param);
			return redirect('/pigmiallocation');
		}
		public function AgentPigmyEntryView()
		{
			$Url="AgentPigmyEntryView";
			$ae['module']=$this->Modules->GetAnyMid($Url);
			$ae['PigCustList']=$this->pigmiallocation_model->PigmyCustomerList();
			return view('AgentPigmyEntryHome',compact('ae'));
		}
		public function extraamt()
		{
			$amtdetails=$this->pigmiallocation_model->extraamt();
			return view('ExtraAgementAmt',compact('amtdetails'));
		}
		public function paybackamt($id)
		{
			$amtdetails=$this->pigmiallocation_model->paybackamt($id);
			return;
		}
		public function changepigmiagent()
		{
				return view('agentchangehome');
		}
		public function allcust()
		{
			$allcust=$this->Report_model->GetPigCust();
			
			return view('agentchangeallcustview',compact('allcust'));
		}
		public function singlecust()
		{
			$allcust=$this->Report_model->GetPigCust();
			
			return view('agentchangesinglecustview',compact('allcust'));
		}
		public function changeallcust(Request $request)
		{
			$allcust['agent1']=$request->input('agent1');
			$allcust['agent2']=$request->input('agent2');
			$id=$this->pigmiallocation_model->changeallcust($allcust);
		}
		public function changesinglecust(Request $request)
		{
			$allcust['agent1']=$request->input('agent1');
			$alldetails=$this->pigmiallocation_model->changesinglecust($allcust);
			return view('changeagentsingltcustallaccno',compact('alldetails'));
		}
		public function changesinglecustcheck(Request $request)
		{
			$allcust['agent1']=$request->input('agent1');
			$allcust['agent2']=$request->input('agent2');
			$allcust['alocid']=$request->input('alocid');
			$allcust['loopid']=$request->input('loopid');
			$id=$this->pigmiallocation_model->changesinglecustcheck($allcust);
			
			
			
		}
	}
