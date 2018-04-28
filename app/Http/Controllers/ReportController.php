<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\ReportModel;
	use App\Http\Model\LoanTypeModel;
	use App\Http\Model\ExpenceModel;
	use App\Http\Model\ModulesModel;
	use App\Http\Model\MemberModel;
	class ReportController extends Controller
	{
		public function __construct()
		{
			$this->Report_model = new ReportModel;	
			$this->creadexpencemodel = new ExpenceModel;
			$this->Modules= new ModulesModel;
			$this->member_model= new MemberModel;
		}
		
		
		
		public function index()
		{
			$Url="sbreport";
			$r['module']=$this->Modules->GetAnyMid($Url);
			
			$r['data']=$this->Report_model->getData();
			return view('report',compact('r'));
		}
		public function RDReport()
		{
			
			$rdr['RdReport']=$this->Report_model->GetRdData();
			$rdr['module']=$this->Report_model->GetRDReportModule();
			
			return view('RdReport',compact('rdr'));
		}
		
		public function pigmi_report()
		{
			$Url="pigmireport";
			$pr['module']=$this->Modules->GetAnyMid($Url);
			$pr['data']=$this->Report_model->getpigmireport();
			return view('pigmireport',compact('pr'));
		}
		
		public function ClosedPigmyReport() //M 25-03
		{
			//$ClosedPigmiReport=$this->Report_model->ClosedPigmyData();
			//return view('ClosedPigmiReport',compact('ClosedPigmiReport'));
			$CPR['module']=$this->Report_model->GetClosedPigmyReportModule();
			return view('ClosedPigmiReport',compact('CPR'));
		}
		
		public function GetPigmyEndReport(Request $request) //M 29-03
		{
			$PigClsType['ClosingTypeDD']=$request->input('ClosingTypeDD');
			
			$PigEndRep['SearchAccId']=$request->input('SearchAccId');
			$PigEndRep['startdate']=$request->input('startdate');
			$PigEndRep['enddate']=$request->input('enddate');
			
			if($PigClsType['ClosingTypeDD']=="MATURED")
			{
				$MaturedPigmiReport['Matured']=$this->Report_model->MaturedPigmiReport($PigEndRep);
				$MaturedPigmiReport['module']=$this->Report_model->GetClosedPigmyReportModule();
				return view('PigmyCloseReport',compact('MaturedPigmiReport'));
			}
			else if($PigClsType['ClosingTypeDD']=="PREWITHDRAWAL")
			{
				$PrewithPigmiReport['PreWith']=$this->Report_model->PrewithPigmiReport($PigEndRep);
				$PrewithPigmiReport['module']=$this->Report_model->GetClosedPigmyReportModule();
				return view('PigmyWithdrawnReport',compact('PrewithPigmiReport'));
			}
			
			
			
		}
		
		public function PigmiBranchWiseReport()
		{
			$PigmyBranchWise['PigmiReportBWData']=$this->Report_model->PigmiBranchWiseReport();
			$PigmyBranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			$PigmyBranchWise['module']=$this->Report_model->GetPigmiBranchWiseReportModule();
			//$PigmyBranchWise['AgentList']=$this->Report_model->GetAgentDropD();
			//return view('createdeposit',['branch'=>$branch]);
			return view('PigmiBranchWiseReport',compact('PigmyBranchWise'));
		}
		
		public function SbBranchWiseReport()
		{
			$SbBranchWise['SbReportBWData']=$this->Report_model->SbBranchWiseReport();
			
			$SbBranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			$SbBranchWise['module']=$this->Report_model->GetSbBranchWiseReportModule();
			//$PigmyBranchWise['AgentList']=$this->Report_model->GetAgentDropD();
			//return view('createdeposit',['branch'=>$branch]);
			return view('SbBranchWiseReport',compact('SbBranchWise'));
		}
		
		public function GetPigmyTranBranchWiseData(Request $request)
		{
			$PigRepBrAgDt['BranchDD']=$request->input('BranchDD');
			$PigRepBrAgDt['AgentDD']=$request->input('AgentDD');
			$PigRepBrAgDt['startdate']=$request->input('startdate');
			$PigRepBrAgDt['enddate']=$request->input('enddate');
			
			if($PigRepBrAgDt['startdate']==$PigRepBrAgDt['enddate'])
			{
				$PigmyTranBranchWiseData['PgBWData']=$this->Report_model->GetPigmyTranBranchWiseData($PigRepBrAgDt);
				$PigmyTranBranchWiseData['module']=$this->Report_model->GetPigmiBranchWiseReportModule();
				return view('PigmiBranchSingleDayReport',compact('PigmyTranBranchWiseData'));
			}
			else if($PigRepBrAgDt['startdate']!=$PigRepBrAgDt['enddate'])
			{
				$PigmyTranBranchWiseData['BranchAgentData']=$this->Report_model->GetPigmyTranBranchWiseData($PigRepBrAgDt);
				$PigmyTranBranchWiseData['AgentCollection']=$this->Report_model->GetPigmyAgentTotalCollectPD($PigRepBrAgDt);
				$PigmyTranBranchWiseData['module']=$this->Report_model->GetPigmiBranchWiseReportModule();
				//print_r($PigmyTranBranchWiseData['AgentCollection']);
				return view('PigmiBranchDateRangeReport',compact('PigmyTranBranchWiseData'));
			}
			
			
			
		}
		
		public function GetSbTranBranchWiseData(Request $request)
		{
			$SbRepBrDt['BranchDD']=$request->input('BranchDD');
			$SbRepBrDt['SBAccNum']=$request->input('SBAccNum');
			//$PigRepBrAgDt['AgentDD']=$request->input('AgentDD');
			$SbRepBrDt['startdate']=$request->input('startdate');
			$SbRepBrDt['enddate']=$request->input('enddate');
			
			$SbTranBranchWiseData['SbBWData']=$this->Report_model->GetSbTranBranchWiseData($SbRepBrDt);
			$SbTranBranchWiseData['module']=$this->Report_model->GetSbBranchWiseReportModule();
			return view('SbBranchWiseDateRangeReport',compact('SbTranBranchWiseData'));
			
			
		}
		
		
		public function GetBranchAgentsDD(Request $request)
		{
			$AgentListBW=$this->Report_model->GetAgentDropD($request);
			
			return json_encode($AgentListBW);
			
		}
		
		public function LoanReport()
		{
			$Url="LoanReport";
			$LoanRepo['module']=$this->Modules->GetAnyMid($Url);
			
			$LoanRepo['LoanRepo']=$this->Report_model->GetLoanData();
			$LoanRepo['module']=$this->Report_model->GetLoanReportModule();
			return view('LoanReport',compact('LoanRepo'));
		}
		
		
		/*public function checkaccsb(Request $request)
			{
			$accsear['SearchAccId']=$request->input('SearchAccId');
			$sbs=$this->Report_model->GetDatasb($accsear);
			return view('sbperreport',compact('sbs'));
			
		}*/
		
		
		public function getpigmy_pigmialloc(Request $request)
		{
			$accsear['SearchAccId']=$request->input('SearchAccId');
			$accsear['startdate']=$request->input('startdate');
			$accsear['enddate']=$request->input('enddate');
			$accsear['AllorNot']=$request->input('AllorNot');
			
			$psr['PigmyPerData']=$this->Report_model->GetDatapigmy($accsear);
			$psr['PigmyPerDatatotal']=$this->Report_model->GetDatapigmytotal($accsear);
			$psr['module']=$this->Report_model->GetPigmyReportModule();
			
			return view('pigmiperreport',compact('psr'));
		}
		
		public function GetSbPerReport(Request $request)
		{
			$accsear['SearchAccId']=$request->input('SearchAccId');
			$accsear['startdate']=$request->input('startdate');
			$accsear['enddate']=$request->input('enddate');
			$sbsr['module']=$this->Report_model->GetSBReportModule();
			$sbsr['SbPerData']=$this->Report_model->GetSbPerReport($accsear);
			return view('sbperreport',compact('sbsr'));
		}
		
		public function GetRdPerReport(Request $request)
		{
			$accsear['SearchAccId']=$request->input('SearchAccId');
			$accsear['startdate']=$request->input('startdate');
			$accsear['enddate']=$request->input('enddate');
			
			$rdsr['module']=$this->Report_model->GetRDReportModule();
			$rdsr['RdPerData']=$this->Report_model->GetRdPerReport($accsear);
			$rdsr['RdDet']=$this->Report_model->GetRdDetails($accsear);
			//$rdsr['startdate']=$accsear['startdate'];
			//$rdsr['enddate']=$accsear['enddate'];
			//$rdsr['SearchAccId']=$accsear['SearchAccId'];
			return view('RdPerReport',compact('rdsr'));
		}
		
		public function GetLoanPerReport(Request $request)
		{
			$accsear['SearchAccId']=$request->input('SearchAccId');
			$accsear['startdate']=$request->input('startdate');
			$accsear['enddate']=$request->input('enddate');
			$rdsr=$this->Report_model->GetLoanPerReport($accsear);
			//$rdsr['startdate']=$accsear['startdate'];
			//$rdsr['enddate']=$accsear['enddate'];
			//$rdsr['SearchAccId']=$accsear['SearchAccId'];
			return view('RdPerReport',compact('rdsr'));
			
		}
		
		//To get Branchwise Expense detail
		public function ExpBranchWiseReport()
		{
			$ExpBranchWise['ExpReportBWData']=$this->Report_model->ExpBranchWiseReport();
			$ExpBranchWise['BranchListexp']=$this->Report_model->GetBranchDropD();
			//$PigmyBranchWise['AgentList']=$this->Report_model->GetAgentDropD();
			//return view('createdeposit',['branch'=>$branch]);
			return view('ExpenseBranchWiseReport',compact('ExpBranchWise'));
		}
		
		public function RDBranchWiseReport()
		{
			$RDBranchWise['RDReportBWData']=$this->Report_model->RDBranchWiseReport();
			
			$RDBranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			$RDBranchWise['module']=$this->Report_model->GetRdBranchWiseReportModule();
			//$PigmyBranchWise['AgentList']=$this->Report_model->GetAgentDropD();
			//return view('createdeposit',['branch'=>$branch]);
			return view('RdBranchWiseReport',compact('RDBranchWise'));
		}
		public function FDBranchWiseReport()
		{
			$FDBranchWise['FDReportBWData']=$this->Report_model->FDBranchWiseReport();
			
			$FDBranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			$FDBranchWise['module']=$this->Report_model->GetFdBranchWiseReportModule();
			//$PigmyBranchWise['AgentList']=$this->Report_model->GetAgentDropD();
			//return view('createdeposit',['branch'=>$branch]);
			return view('FdBranchWiseReport',compact('FDBranchWise'));
		}
		
		public function GetRDTranBranchWiseData(Request $request)//pending
		{
			$RDRepBrDt['BranchDD']=$request->input('BranchDD');
			$RDRepBrDt['SBAccNum']=$request->input('SBAccNum');
			//$PigRepBrAgDt['AgentDD']=$request->input('AgentDD');
			$RDRepBrDt['startdate']=$request->input('startdate');
			$RDRepBrDt['enddate']=$request->input('enddate');
			
			$RDTranBranchWiseData['RdBWData']=$this->Report_model->GetRDTranBranchWiseData($RDRepBrDt);
			$RDTranBranchWiseData['module']=$this->Report_model->GetRdBranchWiseReportModule();
			return view('RDBranchWiseDateRangeReport',compact('RDTranBranchWiseData'));
			
			
		}
		public function GetFDTranBranchWiseData(Request $request)//pending
		{
			$FDRepBrDt['BranchDD']=$request->input('BranchDD');
			$FDRepBrDt['SBAccNum']=$request->input('SBAccNum');
			//$PigRepBrAgDt['AgentDD']=$request->input('AgentDD');
			$FDRepBrDt['startdate']=$request->input('startdate');
			$FDRepBrDt['enddate']=$request->input('enddate');
			
			$FDTranBranchWiseData['FdBWData']=$this->Report_model->GetFDTranBranchWiseData($FDRepBrDt);
			$FDTranBranchWiseData['module']=$this->Report_model->GetFdBranchWiseReportModule();
			return view('FDBranchWiseDateRangeReport',compact('FDTranBranchWiseData'));
			
			
		}
		
		public function depositReport()
		{
			return view('DepositReport');
		}
		
		public function pigmyreport_paid_unpaid(Request $request)
		{
			
			
		}
		public function passbookprint()
		{
			$SBPass=$this->Report_model->GetSBPassModule();
			return view('SbprintHome',compact('SBPass'));
		}
		
		
		public function GetSbprintPerData(Request $request)
		{
			$SbprintPar['SearchAccId']=$request->input('SearchAccId');
			$SbprintPar['startdate']=$request->input('startdate');
			$SbprintPar['enddate']=$request->input('enddate');
			$SbprintPerData['Kannada']=$request->input('Kannada');
			$SbprintPerData['num']=$request->input('num');
			$SbprintPerData['pnum']=$request->input('pnum');
			$SbprintPerData['previous_bal']=$request->input('pbval');
			$SbprintPar['tranid']=$request->input('tranid');
			$lineval1=$request->input('lineval');
			if($lineval1>1)
			{
				$lineval1+=1;
			}
			$SbprintPerData['lineval']=$lineval1;
			
			$SbprintPerData['CustomerDetails']=$this->Report_model->GetSbprintPerData($SbprintPar);
			$SbprintPerData['TransactionDetails']=$this->Report_model->GetSbprinttranPerData($SbprintPar);
/********************/
			$SbprintPerData['prev_balance']=$this->Report_model->get_prev_balance($SbprintPar);
/********************/
			
			$SbprintPerData['module']=$this->Report_model->GetSBPassModule();
			$fn_data["SearchAccId"] = $request->input('SearchAccId');
			$SbprintPerData["usre2"] = $this->Report_model->sb_print_joint_acc_2nd_name($fn_data);		//print_r($SbprintPerData["usre2"]);
			
			return view('Sbprtintperview',compact('SbprintPerData'));
		}
		public function expenseReport()
		{
			$data['branch']=$this->Report_model->getbranch();
			$data['exp']=$this->Report_model->getExData();
			$data['led']=$this->creadexpencemodel->getExpensedata();
			$data['module']=$this->Report_model->GetExpenseBranchWiseReportModule();
			return view('expensereport',compact('data'));
		}
		public function GetExpenceBranchWiseData(Request $request) //T  28-04 FOR expencereport
		{
			$ExpenceParam['BranchDD']=$request->input('BranchDD');
			
			$ExpenceParam['paymode']=$request->input('paymode');
			$ExpenceParam['startdate']=$request->input('startdate');
			$ExpenceParam['enddate']=$request->input('enddate');
			$ExpenceParam['HeadID']=$request->input('HeadID');
			$ExpenceParam['SubHeadID']=$request->input('SubHeadID');
			
			if($ExpenceParam['paymode']=="INHAND")
			{
				$ExpenceInhandRep['BExpInHand']=$this->Report_model->GetExpenceReport($ExpenceParam);
				$ExpenceInhandRep['module']=$this->Report_model->GetExpenseBranchWiseReportModule();
				return view('BranchExpenceInhandReport',compact('ExpenceInhandRep'));
			}
			else if($ExpenceParam['paymode']=="CHEQUE")
			{
				$ExpenceInhandChq['BExpCheque']=$this->Report_model->GetExpenceReport($ExpenceParam);
				$ExpenceInhandChq['module']=$this->Report_model->GetExpenseBranchWiseReportModule();
				return view('BranchExpenceChequeReport',compact('ExpenceInhandChq'));
			}
			
			
			
		}
		
		public function GetExPerReport(Request $request)
		{
			$accsear['SearchAccId']=$request->input('SearchAccId');
			$accsear['startdate']=$request->input('startdate');
			$accsear['enddate']=$request->input('enddate');
			$accsear['searchid']=$request->input('searchid');
			$expr=$this->Report_model->GetExPerReport($accsear);
			return view('exPerReport',compact('expr'));
			
		}
		
		
		public function depReport()
		{
		    $data['bnk']=$this->Report_model->getbank();
			$data['dep']=$this->Report_model->getdepData();
			return view('depreport',compact('data'));
		}
		
		
		
		public function getDepositBranchwiseData(Request $request) //T  5-05 FOR depositReport
		{
			$DepositParam['BankDD']=$request->input('BankDD');
			$DepositParam['paymode']=$request->input('paymode');
			
			
			$DepositParam['startdate']=$request->input('startdate');
			$DepositParam['enddate']=$request->input('enddate');
			
			if($DepositParam['paymode']=="inhand")
			{
				$DepositInhandRep=$this->Report_model->GetDepositReport($DepositParam);
				return view('BranchDepositInhandReport',compact('DepositInhandRep'));
			}
			else if($DepositParam['paymode']=="cheque")
			{
				$DepositInhandChq=$this->Report_model->GetDepositReport($DepositParam);
				return view('BranchDepositChequeReport',compact('DepositInhandChq'));
			}
			
		}
		
		public function AgentPigmiReportView()
		{
			$Url="AgentPigmiReportView";
			$AgentPigmiRep['module']=$this->Modules->GetAnyMid($Url);
			$AgentPigmiRep['AgentTodayReport']=$this->Report_model->AgentPigmiTodayReport();
			return view('AgentPigmiReportHome',compact('AgentPigmiRep'));
			//return view('test',compact('AgentPigmiRep'));
		}
		
		
		public function GetAgentPigmiReportData(Request $request)
		{
			$AgentPigmiRepDt['startdate']=$request->input('startdate');
			$AgentPigmiRepDt['enddate']=$request->input('enddate');
			$AgentPigmiRepDt['SearchAccId']=$request->input('SearchAccId');
			$AgentPigmiRepDt['AllorNot']=$request->input('AllorNot');
			$AgentPigmiRepDt['APRmode']=$request->input('APRmode');
			
			$ReportMode=$AgentPigmiRepDt['APRmode'];
			$SearchCriteria=$AgentPigmiRepDt['AllorNot'];
			
			$Url="AgentPigmiReportView";
			
			if($ReportMode=="MULTIPLE")
			{	
				
				if($AgentPigmiRepDt['startdate']==$AgentPigmiRepDt['enddate'])
				{
					$AgentPigmiRepData['AgentSingleDayReport']=$this->Report_model->GetAgentPigmiReportData($AgentPigmiRepDt);
					$AgentPigmiRepData['module']=$this->Modules->GetAnyMid($Url);
					
					return view('AgentPigmiSingleDayReport',compact('AgentPigmiRepData'));
				}
				else if($AgentPigmiRepDt['startdate']!=$AgentPigmiRepDt['enddate'])
				{
					$AgentPigmiRepData['AgentRangeReport']=$this->Report_model->GetAgentPigmiReportData($AgentPigmiRepDt);
					$AgentPigmiRepData['AgentCollection']=$this->Report_model->PigmiAgentReportSum($AgentPigmiRepDt);
					
					$AgentPigmiRepData['module']=$this->Modules->GetAnyMid($Url);
					
					return view('AgentPigmiDateRangeReport',compact('AgentPigmiRepData'));
				}
				
			}
			else if($ReportMode=="SINGLE")
			{
				
				//if($SearchCriteria=="ALL"||$SearchCriteria=="all"||$SearchCriteria=="All")
				//{
				$AgentPigmiRepData['AgentSingleDayReport']=$this->Report_model->GetAgentPigmiReportCustData($AgentPigmiRepDt);
				$AgentPigmiRepData['module']=$this->Modules->GetAnyMid($Url);
				
				return view('AgentPigmiSingleDayReport',compact('AgentPigmiRepData'));
				
				//}
				/*else
					{
					$AgentPigmiRepData['AgentSingleDayReport']=$this->Report_model->GetAgentPigmiReportCustData($AgentPigmiRepDt);
					$AgentPigmiRepData['module']=$this->Modules->GetAnyMid($Url);
					
					return view('AgentPigmiSingleDayReport',compact('AgentPigmiRepData'));
					
				}*/
				
				
			}
			
		}
		
		
		public function LoanReportBranch()
		{
			$Url="LoanReportBranch";
			$loan['module']=$this->Modules->GetAnyMid($Url);
			$loan['LT']=$this->Report_model->GetLoanDropD();
			$loan['PLT']=$this->Report_model->GetPLoanDropD();
			return view('LoanBranchWiseReport',compact('loan'));
		}
		public function GetLoanBranchWiseData(Request $request)
		{
			$Url="LoanReportBranch";
			
			$loanParam['LoanDD']=$request->input('LoanDD');
			$loanParam['PLoanDD']=$request->input('PLoanDD');
			$loanParam['startdate']=$request->input('startdate');
			$loanParam['enddate']=$request->input('enddate');
			if($loanParam['LoanDD']=="PERSONAL_LOAN")
			{
				
				$loanpersonal['module']=$this->Modules->GetAnyMid($Url);
				$loanpersonal['datapersonal']=$this->Report_model->GetLoanReport($loanParam);
				
				return view('PersonalLoanReport',compact('loanpersonal'));
			}
			else if($loanParam['LoanDD']=="DEPOSITE_LOAN")
			{
				$loandeposit['module']=$this->Modules->GetAnyMid($Url);
				$loandeposit['datadeposit']=$this->Report_model->GetLoanReport($loanParam);
				return view('DepositLoanReport',compact('loandeposit'));
			}
			else if($loanParam['LoanDD']=="STAFF_LOAN")
			{
				$loanstaff['module']=$this->Modules->GetAnyMid($Url);
				$loanstaff['datastaff']=$this->Report_model->GetLoanReport($loanParam);
				return view('StaffLoanReport',compact('loanstaff'));
			}
			else if($loanParam['LoanDD']=="JEWEL_LOAN")
			{
				$loanjewel['module']=$this->Modules->GetAnyMid($Url);
				$loanjewel['datajewel']=$this->Report_model->GetLoanReport($loanParam);
				return view('JewelLoanReport',compact('loanjewel'));
			}
		}
		
		
		
		public function IncomeReport()
		{
			$Url="IncomeReport";
			$IncomeReport['module']=$this->Modules->GetAnyMid($Url);
			
			return view('IncomeReport',compact('IncomeReport'));
			//return view('IncomeReport');
		}
		
		
		public function GetIncomeBranchWiseData(Request $request)
		{
			$Url="IncomeReport";
			$IncomeParam['income']=$request->input('income');
			$IncomeParam['startdate']=$request->input('startdate');
			$IncomeParam['enddate']=$request->input('enddate');
			if($IncomeParam['income']=="customerfees")
			{
				$incomecust['module']=$this->Modules->GetAnyMid($Url);
				$incomecust['datacustmer']=$this->Report_model->GetIncomeReport($IncomeParam);
				return view('CustomerIncomeReport',compact('incomecust'));
			}
			else if($IncomeParam['income']=="jewelloancharges")
			{
				$incomejewel['module']=$this->Modules->GetAnyMid($Url);
				$incomejewel['datajewel']=$this->Report_model->GetIncomeReport($IncomeParam);
				return view('JewelIncomeLoanReport',compact('incomejewel'));
			}
			else if($IncomeParam['income']=="personalloancharges")
			{
				$incomepers['module']=$this->Modules->GetAnyMid($Url);
				$incomepers['datapers']=$this->Report_model->GetIncomeReport($IncomeParam);
				return view('PersonalIncomeLoanReport',compact('incomepers'));
			}
			else if($IncomeParam['income']=="depositloancharges")
			{
				$incomedepo['module']=$this->Modules->GetAnyMid($Url);
				$incomedepo['datadep']=$this->Report_model->GetIncomeReport($IncomeParam);
				return view('DepositIncomeLoanReport',compact('incomedepo'));
			}
			else if($IncomeParam['income']=="staffloancharges")
			{
				$incomestaff['module']=$this->Modules->GetAnyMid($Url);
				$incomestaff['datastaff']=$this->Report_model->GetIncomeReport($IncomeParam);
				return view('StaffIncomeLoanReport',compact('incomestaff'));
			}
			
			
		}
		
		public function PigmyCustomer()
		{
			$Url="PigmyCustomer";
			$pig['module']=$this->Modules->GetAnyMid($Url);
			$pig['data']=$this->Report_model->GetPigCust();
			return view('pigmycust',compact('pig'));
		}
		public function GetPigmyCustPerData(Request $request)
		{
			$Url="PigmyCustomer";
			
			
			$param['age']=$request->input('age');
			$Pigmycust['age']=$this->Report_model->PigmyCustPerData($param);
			$Pigmycust['module']=$this->Modules->GetAnyMid($Url);
			//$PigmyBranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			//$PigmyBranchWise['AgentList']=$this->Report_model->GetAgentDropD();
			//return view('createdeposit',['branch'=>$branch]);
			return view('pigCustPerReport',compact('Pigmycust'));
			
		}	 
		public function GetShareBranchWiseData(Request $request)//To
		{
			
			
			$share['sha']=$request->input('sha');
			//$share['startdate']=$request->input('startdate');
			//$share['enddate']=$request->input('enddate');
			//$accsear['AllorNot']=$request->input('AllorNot');
			$shr['data']=$this->Report_model->getsharereport($share);
			$shr['param']=$share['sha'];
			return view('purshasereport',compact('shr'));
			
			
			
		}
		
		public function loanrepayreport(Request $request)//To
		
		{
			$repay=$this->Report_model->loanrepayreport();
			return view('loanrepayreport',compact('repay'));
		}
		public function PigmiagentWiseReport(Request $request)
		{
				$Url="PigmiagentWiseReport";
				$PigmyBranchWise['module']=$this->Modules->GetAnyMid($Url);
				$PigmyBranchWise['BranchList']=$this->Report_model->GetBranchDropD();
				return view('pigmiagentbranchwisereport',compact('PigmyBranchWise'));
		}
		public function pigmiagenttotalamt(Request $request)
		{
			$alltran=$request->input('displaytran');
			
			$PigRepBrAgDt['BranchDD']=$request->input('BranchDD');
			$PigRepBrAgDt['AgentDD']=$request->input('AgentDD');
			$PigRepBrAgDt['startdate']=$request->input('startdate');
			$PigRepBrAgDt['enddate']=$request->input('enddate');
			if($alltran==0)
			{
			$Pigmyagent['details']=$this->Report_model->pigmiagentdetails($PigRepBrAgDt);
			$Pigmyagent['amt']=$this->Report_model->pigmiagenttotalamt($PigRepBrAgDt);
			return view('pigmiagenttotal',compact('Pigmyagent'));
			}
			else
			{
				$alldetails=$this->Report_model->pigmiagentalltrandetails($PigRepBrAgDt);
				return view('pigmiagentalltrantdetails',compact('alldetails'));
			}
			
			
		}
		public function alltranreport()
		{
			$tot=$this->Report_model->alltotalamt();
			
			return view('AllTranReportHome',compact('tot'));
		}
		public function allreport_headoff(Request $request)
		{
			$Url="allreport_headoff";
				$BranchWise['module']=$this->Modules->GetAnyMid($Url);
			$BranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			return view('AllBranchTranReportHome',compact('BranchWise'));
		}
		public function getallamount(Request $request)
		{
			$branch=$request->input('BranchDD');
			
			$tot=$this->Report_model->getallamount($branch);
				return view('AllTranReportHome',compact('tot'));
		}
		public function getallaccount(Request $request)
		{
			$accounttype=$request->input('accounttype');
			$id=$request->input('id');
			if($accounttype=="PIGMI Account")
			{
					$usr=DB::table('pigmiallocation')->select('UID')->where('PigmiAllocID',$id)->first();
					$useid=$usr->UID;
					$detail=$this->Report_model->getallaccountpigmi($useid);
					
					return view('AllAccountPigmiHome',compact('detail'));
			}
			else if($accounttype=="SB Account")
			{
		
					$usr=DB::table('createaccount')->select('Uid')->where('Accid',$id)->first();
					$useid=$usr->Uid;
					$detail=$this->Report_model->getallaccountpigmi($useid);
					return view('AllAccountPigmiHome',compact('detail'));
			}
			else if($accounttype=="RD Account")
			{
		
					$usr=DB::table('createaccount')->select('Uid')->where('Accid',$id)->first();
					$useid=$usr->Uid;
					$detail=$this->Report_model->getallaccountpigmi($useid);
					return view('AllAccountPigmiHome',compact('detail'));
			}
			
		}
		public function closeaccount(Request $request)
		{
			$Url="closeaccount";
				$BranchWise['module']=$this->Modules->GetAnyMid($Url);
			$BranchWise['BranchList']=$this->Report_model->GetBranchDropD();
			return view('AllAccountCloseHome',compact('BranchWise'));
		}
		public function pigmidirectclose($pigno)
		{
			DB::table('pigmiallocation')->where('PigmiAcc_No',$pigno)
			->update(['Closed'=>"YES"]);
			
		}
		
		public function pigmidirectDelete($pigno)
		{
		
			$this->Report_model->pigmidirectDelete($pigno);
			
			
		}
		
		public function Loanclosed()
		{
		    $closedLoan['select']=$this->Report_model->GetLoanDropD();
		    $closedLoan['select1']=$this->Report_model->GetPLoanDropD();
		    $closedLoan['select2']=$this->Report_model->GetPLoanDropDL();
		    return view('NewClosedReport',compact('closedLoan'));
		}
		
		public function closedLoanDetails(Request $request)
		{
		    $data['loanId']=$request->input('loanId');
		    $data['startdate']=$request->input('startdate');
		    $data['enddate']=$request->input('enddate');
		    $view['types']=$request->input('types');
		    $view['fontdata']=$this->Report_model->ClosedreportS($data);
			//$view['count']=$this->Report_model->counts($data);
		    return view('NewClosedReportDetails',compact('view'));
		}
		public function closedLoanDetails1(Request $request)
		{
		    $data['loanId']=$request->input('loanId');
		    $data['startdate']=$request->input('startdate');
		    $data['enddate']=$request->input('enddate');
			$view['types']=$request->input('types');
		    $view['fontdata']=$this->Report_model->ClosedreportS1($data);
		    //$view['count']=$this->Report_model->counts($data);
			
		    return view('NewClosedReportDetails',compact('view'));
		}
		public function closedStaffJLDetails(Request $request)
		{
		    $data['loanId']=$request->input('loanId');
		    $data['startdate']=$request->input('startdate');
		    $data['enddate']=$request->input('enddate');
			$view['types1']=$request->input('types1');
		    $view['fontdata']=$this->Report_model->closedStaffJLD($data);
		    return view('ClosedJlANDSL',compact('view'));
		}
		
		public function pigmy_report(Request $request)
		{
			$in_data["agent_uid"] = $request->input("agent_uid");//27939;//
			$in_data["print"] = $request->input("print");
			$in_data["from_date"] = $request->input("from_date");
			$in_data["to_date"] = $request->input("to_date");
			$in_data["allocation_id"] =$request->input("allocation_id");
			if(empty($in_data["from_date"])) {
				$data['agent'] = $this->Report_model->get_agent_list([]);
				return view("pigmy_report",compact('data'));
			} else {
				$data = $this->Report_model->pigmy_report($in_data);//return 11;
				$data["print"] = $in_data["print"];
				return view('pigmy_report_data',compact('data'));
			}
		}
		public function common_report(Request $request){
			return view("commmon_report");
		}
		public function user_details(Request $request){
			$in_data["user_id"]=$request->input("user_id");
			$return_data=$this->Report_model->user_details($in_data);
			return view('user_details_data',compact('return_data'));
		}
		public function loan_details(Request $request)
		{
			$type = $request->input("type");
			$data['uid']=$request->input('user_id');
			
			switch($type) {
				case "JL":	
							$return_data=$this->Report_model->loan_details_jl($data);
							return view('loan_details',compact('return_data'));
							break;
				case "PL":	
							$return_data=$this->Report_model->loan_details_pl($data);
							return view('loan_details',compact('return_data'));
							
							break;
			}
			
				
		}
		
		public function cash_chitta_index(Requestn $request)
		{
			return view("cash_chitta_index");
		}
		
		public function cash_chitta_data(Requestn $request)
		{
			
			$data = $this->Report_model->cash_chitta_data();
			return view("cash_chitta_data",compact('data'));
		}
	}
