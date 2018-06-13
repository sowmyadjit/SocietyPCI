<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\salmodel;
	use App\Http\Model\DLRepaymentModel;
	class salcontroller extends Controller
	{
		var $salary;
		public function __construct()
		{
			$this->pigmtDLrepay = new DLRepaymentModel;
			$this->salary = new salmodel;
			
		}
		
		public function showsal()
		{
			$s=$this->salary->getData();
			return view('sal',compact('s'));
			
		}

		public function salary_slip()
		{
			return view('salary_slip');
		}

		public function show_salcreate()
		{
			return view('s');
		}
		
		public function create_sal(Request $request)
		{
			$salary['emp1']=$request->input('emp1');
			$salary['ename']=$request->input('ename');
			$salary['bname']=$request->input('bname');
			$salary['uid']=$request->input('uid');
			$salary['bid']=$request->input('bid');
			$salary['ecode']=$request->input('ecode');
			$salary['bpay']=$request->input('bpay');
			$salary['hra']=$request->input('hra');
			$salary['pf']=$request->input('pf');
			$salary['it']=$request->input('it');
			$salary['cqno']=$request->input('cqno');
			$salary['cqdate']=$request->input('cqdate');
			$salary['sa']=$request->input('sa');
			$salary['eid']=$request->input('eid');
			$salary['date']=$request->input('date');
			$salary['year']=$request->input('year');
			$salary['ge']=$request->input('ge');
			$salary['pt']=$request->input('pt');
			$salary['gd']=$request->input('gd');
			$salary['npay']=$request->input('npay');
			$salary['desigid']=$request->input('desigid');
			$salary['ea']=$request->input('ea');
			$salary['totpf']=$request->input('totpf');
			$salary['totesi']=$request->input('totesi');
			$salary['noloan']=$request->input('noloan');
			$salary['staffpf']=$request->input('staffpf');
			$salary['socpf']=$request->input('socpf');
			$salary['esi']=$request->input('esi');
			$salary['socesi']=$request->input('socesi');
			$salary['slremamt']=$request->input('slremamt');
			$salary['slintamt']=$request->input('slintamt');
			$salary['EMI_Amount']=$request->input('EMI_Amount');
			$salary['loannum']=$request->input('loannum');
			$salary['charges']=$request->input('charges');
			$salary['amount']=$request->input('amount');
			$salary['loopid']=$request->input('loopid');
			
/*************edit**************/
			$salary['sal_extra_all']=$request->input('sal_extra_all');
/*************edit end**************/

			$id=$this->salary->insert($salary);
			return $id;
			
		}
		
		public function get_saldet(Request $request)
		{
			$emp1=$request->input('emp1');
			$sal['data'] = $this->salary->get_saldet($emp1);
			$sal['drop']=$this->pigmtDLrepay->chargeslist();
			
/*******edit**************/
			$sal['sal_extra_list'] = $this->salary->getSalExtra(1);
			$sal['sal_r_extra_list'] = $this->salary->getSalExtra(2);
			$sal['sal_rs_extra_list'] = $this->salary->getSalExtra(3);
/*******edit**************/

			return view('salary',compact('sal'));
		}
		
		public function getloandetaiforsalary(Request $request)
		{
			$loandetail['userid']=$request->input('userid');
			$get=$this->salary->getloandetaiforsalary($loandetail);
			
			
			if(!empty($get))
			{
				$id['loannum']=$get->StfLoan_Number;
				$id['remainigamt']=$get->StaffLoan_LoanRemainingAmount;
				$id['emiamt']=$get->EMI_Amount;
				$id['ac']=0;
			}
			else
			{
				$id['ac']=1;
			}
			return $id;
			
			
			
			
		}	
		public function salagent()
		{
		
		/****edit***/
			$sal_extra_type = 4;
			$sal['sal_extra_list'] = $this->salary->getSalExtra($sal_extra_type);
		/****edit***/
		
					$sal['drop']=$this->pigmtDLrepay->chargeslist();
			return view('Createagentsalary',compact('sal'));
			
		}
		
		public function RDagent()
		{
		/****edit***/
			$sal_extra_type = 4;
			$sal['sal_extra_list'] = $this->salary->getSalExtra($sal_extra_type);
		/****edit***/
			return view('createrdagent',compact('sal'));	
		}
		
		public function sarapara()
		{
			return view('createsarapara');	
		}
		public function getagentsalary_1(Request $request)
		{
			$agentsal['cp']=$request->input('cp');
			$agentsal['tds']=$request->input('tds');
			$agentsal['amount']=$request->input('amount');
			$agentsal['SecurityDepositNeeded'] = $request->input('SecurityDepositNeeded');
			$get=$this->salary->getagentsalary_1($agentsal);
			//print_r($get);
			//$id['amount']=$get['totamt'];
			$id['interest']=$get['interest'];
			$id['tds']=$get['tds'];
			$id['secutitydeposit']=$get['secutitydeposit'];
			return $id;
		}
		
		public function getagentsalary(Request $request)
		{
			$agentsal['startdate']=$request->input('startdate');
			$agentsal['enddate']=$request->input('enddate');
			$agentsal['Auid']=$request->input('Auid');
			$agentsal['cp']=$request->input('cp');
			$agentsal['tds']=$request->input('tds');
			$get=$this->salary->getagentsalary($agentsal);
			//print_r($get);
			$id['amount']=$get['totamt'];
			//$id['interest']=$get['interest'];
			//$id['tds']=$get['tds'];
			//$id['secutitydeposit']=$get['secutitydeposit'];
			
			
			return $id;
		}
		public function getrdagentsalary(Request $request)
		{
			$agentsal['startdate']=$request->input('startdate');
			$agentsal['enddate']=$request->input('enddate');
			$agentsal['Auid']=$request->input('Auid');
			$agentsal['cp']=$request->input('cp');
			$agentsal['tds']=$request->input('tds');
			$get=$this->salary->getrdagentsalary($agentsal);
			//print_r($get);
			$id['amount']=$get['totamt'];
			$id['interest']=$get['interest'];
			$id['tds']=$get['tds'];
			$id['secutitydeposit']=$get['secutitydeposit'];
			
			
			return $id;
		}
		public function getsaraparasalary(Request $request)
		{
			$agentsal['startdate']=$request->input('startdate');
			$agentsal['enddate']=$request->input('enddate');
			$agentsal['Auid']=$request->input('Auid');
			$agentsal['cp']=$request->input('cp');
			$agentsal['tds']=$request->input('tds');
			$get=$this->salary->getsaraparasalary($agentsal);
			//print_r($get);
			$id['amount']=$get['totamt'];
			$id['interest']=$get['interest'];
			$id['tds']=$get['tds'];
			$id['secutitydeposit']=$get['secutitydeposit'];
			$id['otherincome']=$get['otherincome'];
			
			
			return $id;
		}
		public function payagentcommision(Request $request)
		{
			$agentsal['aguid']=$request->input('aguid');
			$agentsal['cp']=$request->input('com_per');
			$agentsal['totalamt']=$request->input('totalamt');
			$agentsal['commdis']=$request->input('com_val');
			$agentsal['tdsval']=$request->input('tds_value');
			$agentsal['sdpo']=$request->input('sd_value');
			$agentsal['sbAcNo']=$request->input('sbAcNo');
			$agentsal['pmode']=$request->input('pmode');
			$agentsal['SBAvailhidn']=$request->input('SBAvailhidn');
			$agentsal['plremamt']=$request->input('plremamt');
			$agentsal['plintamt']=$request->input('plintamt');
			$agentsal['plemi']=$request->input('plemi');
			$agentsal['loannum']=$request->input('loannum');  
			$agentsal['noloan']=$request->input('noloan');  
			$agentsal['pay']=$request->input('pay');  
			$agentsal['charges']=$request->input('charges');  
			$agentsal['amount']=$request->input('amount');  
			$agentsal['loopid']=$request->input('loopid');
			
/*************edit**************/
			$agentsal['sal_extra_all']=$request->input('sal_extra_all');
/*************edit end**************/

			$get=$this->salary->payagentcommision($agentsal);
			
			
		}
		public function payagentcommision2(Request $request)
		{
			$agentsal['aguid']=$request->input('aguid');
			$agentsal['cp']=$request->input('cp');//com_per
			$agentsal['totalamt']=$request->input('totalamt');
			$agentsal['commdis']=$request->input('com_val');
			$agentsal['tdsval']=$request->input('tdsval');//tds_value
			$agentsal['sdpo']=$request->input('sdpo');//sd_value
			$agentsal['sbAcNo']=$request->input('sbAcNo');
			$agentsal['pmode']=$request->input('pmode');
			$agentsal['SBAvailhidn']=$request->input('SBAvailhidn');
			$agentsal['plremamt']=$request->input('plremamt');
			$agentsal['plintamt']=$request->input('plintamt');
			$agentsal['plemi']=$request->input('plemi');
			$agentsal['loannum']=$request->input('loannum');  
			$agentsal['noloan']=$request->input('noloan');  
			$agentsal['pay']=$request->input('pay');  
			$agentsal['charges']=$request->input('charges');  
			$agentsal['amount']=$request->input('amount');  
			$agentsal['loopid']=$request->input('loopid');
			
/*************edit**************/
			$agentsal['sal_extra_all']=$request->input('sal_extra_all');
/*************edit end**************/

			$get=$this->salary->payagentcommision($agentsal);
			
			
		}

		public function salary_slip_data(Request $request)
		{
			$ret_data = $this->salary->salary_slip_data([]);
			return $ret_data;
		}
		
	}
