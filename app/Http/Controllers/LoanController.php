<?php
	
	namespace App\Http\Controllers;
	use File;
	use Illuminate\Http\Request;
	
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Http\Model\LoanModel;
	use App\Http\Model\LoanTypeModel;
	use App\Http\Model\PayAmtModel;
	use App\Http\Model\ReportModel;
	use App\Http\Model\ExpenceModel;
	use Input;
	
	class LoanController extends Controller
	{
		var $loan;
		var $idget;
		var $loantype;
		var $PayAmtMod;
		public function __construct()
		{
			$this->loan = new LoanModel;
			$this->loantype=new LoanTypeModel;
			$this->PayAmtMod=new PayAmtModel;
			$this->Report_model = new ReportModel;
			$this->creadexpencemodel = new ExpenceModel;
		}
		public function show_loanalloc()
		{
			$loanalc['data']=$this->loantype->getdetail();
			$loanalc['data_all']=$this->loantype->getdetail_all();
			//print_r($loanalc);
			return view('loanallocation',compact('loanalc'));
		} 
		
		public function show_Staffloanalloc()
		{
			$staff=$this->loantype->Staffloanallocetail();
			return view('staffloan_home',compact('staff'));
		}
		public function show_Staffloanalloc1()
		{
			//$loanalc=$this->loantype->getdetail();
			//$LoanCatCharge['LoanCat']=$this->loantype->GetLoanCategoryDropD();
			return view('createstaffloan');
		}
		
		public function show_Persnloanalloc()
		{
			//$loanalc=$this->loantype->getdetail();
			$PersLoanCatCharge=$this->loantype->GetPerLoanCategory();
			return view('createpersonalloan',['PersLoanCatCharge'=>$PersLoanCatCharge]);
		}
		
		public function show_Persnloanalloc1()
		{
			//$loanalc=$this->loantype->getdetail();
			$PersLoan['data']=$this->loantype->show_Persnloanalloc1();
			$PersLoan['data_all']=$this->loantype->show_Persnloanalloc1_all();
			return view('plloanallocation',compact('PersLoan'));
		}
	/*****************************closed loan**************************/	
		public function Loanclosed()
		{
			//$loanalc=$this->loantype->getdetail();
			$loan['LT']=$this->Report_model->GetLoanDropD();
			$loan['PLT']=$this->Report_model->GetPLoanDropD();
			return view('closedLoan',compact('loan'));
		}
		
		public function show_createaloanalloc()
		{
			$LoanCatNCharge['LoanCat']=$this->loantype->GetLoanCategoryDropD();
			$LoanCatNCharge['LoanCharge']=$this->loan->GetLoanChargesDropD();
			return view('createloanalloc',compact('LoanCatNCharge'));
			//return view('createloanalloc');
		}
		
		public function retrieve_acname(Request $request)
		{
			$acn['act']=$request->input('act');
			$get=$this->loan->getaccname($acn);
			$id['fn']=$get->FirstName;
			$id['uid']=$get->Uid;
			//$this->idget=$id['uid'];
			
			//$id['sharep']=$get->Share_Price;
			return $id;
		}
		
		
		public function loan_criteria(Request $request)
		{
			$ln['acc']=$request->input('acc');
			$get=$this->loan->loan_criteria($ln);
			//$id['ac']=$get->Accid;
			if(!empty($get->Accid))
			$id['ac']=0;
			else
			$id['ac']=1;
			return $id;
		}
		
		
		public function CreateDepositeLoan(Request $request)
		{
			$CrDepLn['DepLoanType']=$request->input('DepLoanType');
			$CrDepLn['DepBranch']=$request->input('DepBranch');
			$CrDepLn['DepositeType']=$request->input('DepositeType');
			$CrDepLn['DepLoanAmt']=$request->input('DepLoanAmt');
			$CrDepLn['LoanCharge']=$request->input('LoanCharge');
			$CrDepLn['DepLoanStartDate']=$request->input('DepLoanStartDate');
			$CrDepLn['DepLoanEndDate']=$request->input('DepLoanEndDate');
			$CrDepLn['LoanDurationDays']=$request->input('LoanDurationDays');
			$CrDepLn['DepositAccountNum']=$request->input('DepositAccountNum');
			$CrDepLn['DepLoanPayMode']=$request->input('DepLoanPayMode');
			$CrDepLn['LoanBankId']=$request->input('LoanBankId');
			$CrDepLn['DepLoanChequeNum']=$request->input('DepLoanChequeNum');
			$CrDepLn['DepLoanChequeDte']=$request->input('DepLoanChequeDte');
			$CrDepLn['DepLoanChequeState']=$request->input('DepLoanChequeState');
			
			
			$CrDepLn['DepLoanSBAccountNum']=$request->input('DepLoanSBAccountNum');
			$CrDepLn['DepSBAvail']=$request->input('DepSBAvail');
			$CrDepLn['DepLoanSBtotal']=$request->input('DepLoanSBtotal');
			$CrDepLn['DepLoanSBAccid']=$request->input('DepLoanSBAccid');
			$CrDepLn['DepLoanSBAccTid']=$request->input('DepLoanSBAccTid');
			$CrDepLn['sb']=$request->input('sb');
			$CrDepLn['DepSBtype']=$request->input('DepSBtype');
			$CrDepLn['DepLoanBranchid']=$request->input('DepLoanBranchid');
			$CrDepLn['DepLoanTypeID']=$request->input('DepLoanTypeID');
			$CrDepLn['emimonth']=$request->input('emimonth');
			$CrDepLn['EMIAmount']=$request->input('EMIAmount');
			$CrDepLn['PayableAmount']=$request->input('PayableAmount');
			$CrDepLn['old']=$request->input('old');
			
			
			
			$id=$this->loan->CreateDepositeLoan($CrDepLn);
			//return redirect('/home');
		}
		
		public function RetrievePigmyAccDetail(Request $request)
		{
			$PigmyAccNumber['PigAccNum']=$request->input('PigAccNum');
			$get=$this->loan->RetrievePigmyAccDetail($PigmyAccNumber);
			$id['PigmyFn']=$get->FirstName;
			$id['PigmyMn']=$get->MiddleName;
			$id['PigmyLn']=$get->LastName;
			$id['AvailBal']=$get->Total_Amount;
			$id['Pg_Uid']=$get->Uid;
			
			return $id;
		}
		
		public function RetrieveFdAccDetail(Request $request)
		{
			$FdAccNumber['FdAccNum']=$request->input('FdAccNum');
			$get=$this->loan->RetrieveFdAccDetail($FdAccNumber);
			$id['FDFn']=$get->FirstName;
			$id['FDMn']=$get->MiddleName;
			$id['FDLn']=$get->LastName;
			$id['AvailBal']=$get->Fd_DepositAmt;
			$id['Fd_Uid']=$get->Uid;
			
			return $id;
		}
		
		public function RetrieveRdAccDetail(Request $request)
		{
			$RdAccNumber['RdAccNum']=$request->input('RdAccNum');
			$get=$this->loan->RetrieveRdAccDetail($RdAccNumber);
			$id['RDFn']=$get->FirstName;
			$id['RDMn']=$get->MiddleName;
			$id['RDLn']=$get->LastName;
			$id['AvailBal']=$get->Total_Amount;
			$id['Rd_Uid']=$get->Uid;
			
			
			return $id;
		}
		
		public function GetBranchIDForDL(Request $request)
		{
			$BranchID['BranchId']=$request->input('BranchId');
			$get=$this->loan->GetBranchIDForDL($BranchID);
			$id['inhand']=$get->InHandCash;
			return $id;
		}
		
		public function GetSBForDL(Request $request)
		{
			$PDLNum['PAccNum']=$request->input('PAccNum');
			$PDLNum['DepositType']=$request->input('DepositType');
			$get=$this->loan->GetSBForDL($PDLNum);
			
			if(!empty($get->AccNum))  //if have SB Account
			{
				$id['acn']=0;
				$id['tot']=$get->Total_Amount;
				$id['acccn']=$get->AccNum;
				$id['acid']=$get->Accid;
				$id['actid']=$get->AccTid;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		
		//Get Employee Details
		public function Get_EmpDetails(Request $request)
		{
			$loanemp['usrid']=$request->input('usrid');
			$get=$this->loan->Get_EmpDetails($loanemp);
			$id['emptype']=$get->Emp_Type;
			$id['joindte']=$get->Joining_Date;
			$id['sal_amt']=$get->basicpay;
			return $id;
		}
		
		public function GetMemSBDetail(Request $request)
		{
			$MemID['membrid']=$request->input('membrid');
			$get=$this->loan->GetMemSBDetail($MemID);
			if(!empty($get->AccNum))  
			{
				$id['acn']=0;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		
		public function CheckSBForStaff(Request $request)
		{
			$UserID['usrid']=$request->input('usrid');
			$get=$this->loan->CheckSBForStaff($UserID);
			if(!empty($get->AccNum))  
			{
				$id['acn']=0;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		
		public function GetCharges()
		{
			$get=$this->loan->GetCharges();
			$id['book_form']=$get->book_formcharges;
			$id['other_charge']=$get->other_Charges;
			$id['adj_charge']=$get->Adjustment_Charge;
			$id['Compulsory_Deposit']=$get->Compulsory_Deposit;
			$id['staffcharge']=$get->staffcharge;
			return $id;
		}
		
		public function GetMemSBDetailView(Request $request)
		{
			$SBMemID['sbmembrid']=$request->input('sbmembrid');
			$get=$this->loan->GetMemSBDetailView($SBMemID);
			$id['sbacno']=$get->AccNum;
			$id['sbtot']=$get->Total_Amount;
			$id['sbaccid']=$get->Accid;
			$id['sbactid']=$get->AccTid;
			$id['uid']=$get->Uid;
			$id['fn']=$get->FirstName;
			$id['mn']=$get->MiddleName;
			$id['ln']=$get->LastName;
			return $id;
		}
		
		
		
		public function GetBankDetailsForPersLoan(Request $request) //for PayAmt
		{
			$Bank['BankId']=$request->input('BankId');
			$get=$this->PayAmtMod->GetBankDetailsForPayAmt($Bank);
			
			$id['BankName']=$get->BankName;
			$id['IFSC']=$get->AddBank_IFSC;
			$id['Branch']=$get->Branch;
			$id['AccountNo']=$get->AccountNo;
			return $id;
		}
		
		
		public function CreatePersLoanAllocation(Request $request)
		{
			$PersLoan['PersLoanCategory']=$request->input('PersLoanCategory');
			$PersLoan['PersLoanAmt']=$request->input('PersLoanAmt');
			$PersLoan['PersOthrChrges']=$request->input('PersOthrChrges');
			$PersLoan['PersBkfrmChrg']=$request->input('PersBkfrmChrg');
			$PersLoan['PersAdjChrg']=$request->input('PersAdjChrg');
			$PersLoan['PersShrChrg']=$request->input('PersShrChrg');
			$PersLoan['PersPayAmt']=$request->input('PersPayAmt');
			$PersLoan['LoanDurationDays']=$request->input('LoanDurationDays');
			$PersLoan['LoanDurationYears']=$request->input('LoanDurationYears');
			$PersLoan['PersLoanStartDate']=$request->input('PersLoanStartDate');
			$PersLoan['PersLoanEndDate']=$request->input('PersLoanEndDate');
			$PersLoan['PersLoanPayMode']=$request->input('PersLoanPayMode');
			$PersLoan['PersSBAvailhidn']=$request->input('PersSBAvailhidn');
			$PersLoan['PersLoanSBtotalhidn']=$request->input('PersLoanSBtotalhidn');
			$PersLoan['PersLoanChequeNum']=$request->input('PersLoanChequeNum');
			$PersLoan['PersLoanChequeDte']=$request->input('PersLoanChequeDte');
			$PersLoan['PersLoanSBAccid']=$request->input('PersLoanSBAccid');
			$PersLoan['PersLoanSBAccTid']=$request->input('PersLoanSBAccTid');
			$PersLoan['PLBranchID']=$request->input('PLBranchID');
			$PersLoan['PLBankID']=$request->input('PLBankID');
			$PersLoan['PLSurety1ID']=$request->input('PLSurety1ID');
			$PersLoan['PLSurety2ID']=$request->input('PLSurety2ID');
			$PersLoan['PLMembID']=$request->input('PLMembID');
			$PersLoan['PersEMIAmt']=$request->input('PersEMIAmt');
			$PersLoan['PersLoanBankID']=$request->input('PersLoanBankID');
			$PersLoan['Insurance']=$request->input('Insurance');
			$PersLoan['partpayment']=$request->input('partpayment');
			$PersLoan['uid']=$request->input('uid');
			$PersLoan['Persloantypeid']=$request->input('Persloantypeid');
			$PersLoan['request_id']=$request->input('request_id');
		/*******/
			$PersLoan['partpay']=$request->input('partpay');
		/*******/


			$uid=$request->input('Persuid');
			$fname=$request->input('Persfname');
			$mname=$request->input('Persmname');
			$lname=$request->input('Perslname');
			//$id = $idget;
			//$id=1;
			
			$path = 'Upload/'.$uid."_".$fname."_".$mname."_".$lname;
			
			
			if(!File::exists($path)) {
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$sc1=Input::file('sec1');
				if($sc1!="")
				{
					$secu1="Security1.jpg";
					$security1=Input::file('sec1')->getClientOriginalName();
					$PersLoan['sec1']=Input::file('sec1')->move($destinationPath,$secu1);
				}
				else
				{
					$PersLoan['sec1']=$request->input('sec1');
				}
				
				$sc2=Input::file('sec2');
				if($sc2!="")
				{
					$secu2="Security2.jpg";
					$security2=Input::file('sec2')->getClientOriginalName();
					$PersLoan['sec2']=Input::file('sec2')->move($destinationPath,$secu2);
				}
				else
				{
					$PersLoan['sec2']=$request->input('sec2');
				}
				
				$sc3=Input::file('sec3');
				if($sc3!="")
				{
					$secu3="Security3.jpg";
					$security3=Input::file('sec3')->getClientOriginalName();
					$PersLoan['sec3']=Input::file('sec3')->move($destinationPath,$secu3);
				}
				else
				{
					$PersLoan['sec3']=$request->input('sec3');
				}
				
				$sc4=Input::file('sec4');
				if($sc4!="")
				{
					$secu4="Security4.jpg";
					$security4=Input::file('sec4')->getClientOriginalName();
					$PersLoan['sec4']=Input::file('sec4')->move($destinationPath,$secu4);
				}
				else
				{
					$PersLoan['sec4']=$request->input('sec4');
				}
			}
			else
			{
				$destinationPath=$path;
				
				$sc1=Input::file('sec1');
				if($sc1!="")
				{
					$secu1="Security1.jpg";
					$security1=Input::file('sec1')->getClientOriginalName();
					$PersLoan['sec1']=Input::file('sec1')->move($destinationPath,$secu1);
				}
				else
				{
					$PersLoan['sec1']=$request->input('sec1');
				}
				
				$sc2=Input::file('sec2');
				if($sc2!="")
				{
					$secu2="Security2.jpg";
					$security2=Input::file('sec2')->getClientOriginalName();
					$PersLoan['sec2']=Input::file('sec2')->move($destinationPath,$secu2);
				}
				else
				{
					$PersLoan['sec2']=$request->input('sec2');
				}
				
				$sc3=Input::file('sec3');
				if($sc3!="")
				{
					$secu3="Security3.jpg";
					$security3=Input::file('sec3')->getClientOriginalName();
					$PersLoan['sec3']=Input::file('sec3')->move($destinationPath,$secu3);
				}
				else
				{
					$PersLoan['sec3']=$request->input('sec3');
				}
				
				$sc4=Input::file('sec4');
				if($sc4!="")
				{
					$secu4="Security4.jpg";
					$security4=Input::file('sec4')->getClientOriginalName();
					$PersLoan['sec4']=Input::file('sec4')->move($destinationPath,$secu4);
				}
				else
				{
					$PersLoan['sec4']=$request->input('sec4');
				}
			}
			
			
			$id=$this->loan->CreatePersonalLoan($PersLoan);
			return redirect('/home');
		}	
		
		    
		public function CreatePersLoanAllocation_renewal(Request $request)
		{
			$PersLoan['oldinterestamt']=$request->input('oldinterestamt');
			$PersLoan['oldprincpalamt']=$request->input('oldprincpalamt');
			$PersLoan['accno']=$request->input('accno');
			$PersLoan['loanamt']=$request->input('loanamt');
			$PersLoan['charges']=$request->input('charges');
			$PersLoan['amount']=$request->input('amount');
			$PersLoan['loopid']=$request->input('loopid');
			//$PersLoan['PersLoanAmt']=$request->input('PersLoanAmt');
			$PersLoan['PersOthrChrges']=$request->input('PersOthrChrges');
			$PersLoan['PersBkfrmChrg']=$request->input('PersBkfrmChrg');
			$PersLoan['PersAdjChrg']=$request->input('PersAdjChrg');
			$PersLoan['PersShrChrg']=$request->input('PersShrChrg');
			$PersLoan['PersPayAmt']=$request->input('PersPayAmt');
			$PersLoan['LoanDurationYears']=$request->input('LoanDurationYears');
			$PersLoan['PersLoanStartDate']=$request->input('PersLoanStartDate');
			$PersLoan['PersLoanEndDate']=$request->input('PersLoanEndDate');
			$PersLoan['PersLoanPayMode']=$request->input('PersLoanPayMode');
			$PersLoan['PersSBAvailhidn']=$request->input('PersSBAvailhidn');
			$PersLoan['PersLoanSBtotalhidn']=$request->input('PersLoanSBtotalhidn');
			$PersLoan['PersLoanChequeNum']=$request->input('PersLoanChequeNum');
			$PersLoan['PersLoanChequeDte']=$request->input('PersLoanChequeDte');
			$PersLoan['PersLoanSBAccid']=$request->input('PersLoanSBAccid');
			$PersLoan['PersLoanSBAccTid']=$request->input('PersLoanSBAccTid');
			$PersLoan['PLBranchID']=$request->input('PLBranchID');
			$PersLoan['PLBankID']=$request->input('PLBankID');
			$PersLoan['PersLoanBankID']=$request->input('PersLoanBankID');
			$PersLoan['Insurance']=$request->input('Insurance');
			$PersLoan['tot']=$request->input('tot');
			$id=$this->loan->CreatePersLoanAllocation_renewal($PersLoan);
			return redirect('/home');
		}
		
		public function jewelLoan()
		{
			
			return view('createjewelloan');
		}
		
		public function jewelLoan1()
		{
			$jewelLoan['data']=$this->loan->jewelLoan1();
			$jewelLoan['data_all']=$this->loan->jewelLoan1_all();
			return view('jewelloanallocation',compact('jewelLoan'));
		//	return view('jewelloanallocation_index',compact('jewelLoan'));
		}
		
		public function GetJewelDetail()
		{
			//$jewelloan['Jeweldurationdetails']=$request->input('Jeweldurationdetails');
			$get=$this->loan->GetJewelDetail();
			
			$id['6month']=$get->six_Month;
			$id['1year']=$get->one_year;
			$id['sapacom']=$get->sarapara_commission;
			$id['book_form']=$get->Book_Form_charges;
			$id['insurance']=$get->Insurance_charges;
			$id['other_charges']=$get->other_charges;
			
			return $id;
			
		}
		public function CheckSBForJewel(Request $request)
		{
			$CheckSBJewel['userID']=$request->input('userID');
			$get=$this->loan->CheckSBForJewel($CheckSBJewel);
			
			if(!empty($get->AccNum))  //if have SB Account
			{
				$id['acn']=0;
			}
			else //if dont have SB Account
			{
				$id['acn']=1;
			}
			return $id;
		}
		
		
		public function getSBForJewel(Request $request)
		{
			$jewelloan['userID']=$request->input('userID');
			$get=$this->loan->getSBForJewel($jewelloan);
			
			$id['acc']=$get->AccNum;
			$id['tot']=$get->Total_Amount;
			
			
			return $id;
			
		}
		
		public function JewelLoanAllocation(Request $request)
		{
			
			$JewelLoanParam['LoanType']=$request->input('LoanType');
			$JewelLoanParam['BranchId']=$request->input('BranchId');
			$JewelLoanParam['UserId']=$request->input('UserId');
			$JewelLoanParam['BankId']=$request->input('BankId');
			
			$JewelLoanParam['Jewelappval']=$request->input('Jewelappval');
			$JewelLoanParam['JewelDuration']=$request->input('JewelDuration');
			$JewelLoanParam['JewelAmt']=$request->input('JewelAmt');
			$JewelLoanParam['JewelspacomVal']=$request->input('JewelspacomVal');
			$JewelLoanParam['JewelinsuVal']=$request->input('JewelinsuVal');
			$JewelLoanParam['JewelBkfrmChrgVal']=$request->input('JewelBkfrmChrgVal');
			$JewelLoanParam['JewelOthrChrges']=$request->input('JewelOthrChrges');
			$JewelLoanParam['JewelPayAmountAfter']=$request->input('JewelPayAmountAfter');
			$JewelLoanParam['JewelStartDate']=$request->input('JewelStartDate');
			$JewelLoanParam['JewelEndDate']=$request->input('JewelEndDate');
			$JewelLoanParam['JewelPayMode']=$request->input('JewelPayMode');
			$JewelLoanParam['JewelChequeNum']=$request->input('JewelChequeNum');
			$JewelLoanParam['JewelChequeDte']=$request->input('JewelChequeDte');
			$JewelLoanParam['Jewelduration']=$request->input('Jewelduration');
			$JewelLoanParam['bid']=$request->input('bid');
			$JewelLoanParam['loantyp']=$request->input('loantyp');
			$JewelLoanParam['jeweluid']=$request->input('jeweluid');
			$JewelLoanParam['Jewel_Description']=$request->input('Jewel_Description');
			$JewelLoanParam['old']=$request->input('old');
			$JewelLoanParam['JewelSBAvail']=$request->input('JewelSBAvail');
			$JewelLoanParam['JewelSBtotal']=$request->input('JewelSBtotal');
			$JewelLoanParam['accid']=$request->input('accid');
			$JewelLoanParam['PersLoanAllocID']=$request->input('PersLoanAllocID'); 
			$JewelLoanParam['PersLoanAllocID']=$request->input('PersLoanAllocID'); 
			
			$id=$this->loan->JewelLoanAllocation($JewelLoanParam);
			
			return redirect('/');
			
		}
		
		public function JewelLoanAllocation_Renewal(Request $request)
		{
			
			
			$JewelLoanParam['BankId']=$request->input('BankId');
			$JewelLoanParam['account_num']=$request->input('account_num');
			$JewelLoanParam['old_principal_num']=$request->input('old_principal_num');
			$JewelLoanParam['old_interest_num']=$request->input('old_interest_num');
			$JewelLoanParam['charges']=$request->input('charges');
			$JewelLoanParam['amount']=$request->input('amount');
			$JewelLoanParam['loopid']=$request->input('loopid');
			$JewelLoanParam['tot']=$request->input('tot');
			  
			
			$JewelLoanParam['JewelDuration']=$request->input('JewelDuration');
			$JewelLoanParam['JewelAmt']=$request->input('JewelAmt');
			$JewelLoanParam['JewelspacomVal']=$request->input('JewelspacomVal');
			$JewelLoanParam['JewelinsuVal']=$request->input('JewelinsuVal');
			$JewelLoanParam['JewelBkfrmChrgVal']=$request->input('JewelBkfrmChrgVal');
			$JewelLoanParam['JewelOthrChrges']=$request->input('JewelOthrChrges');
			$JewelLoanParam['JewelPayAmountAfter']=$request->input('JewelPayAmountAfter');
			$JewelLoanParam['JewelStartDate']=$request->input('JewelStartDate');
			$JewelLoanParam['JewelEndDate']=$request->input('JewelEndDate');
			$JewelLoanParam['JewelPayMode']=$request->input('JewelPayMode');
			$JewelLoanParam['JewelChequeNum']=$request->input('JewelChequeNum');
			$JewelLoanParam['JewelChequeDte']=$request->input('JewelChequeDte');
			$JewelLoanParam['Jewelduration']=$request->input('Jewelduration');
			$JewelLoanParam['Jewel_Description']=$request->input('Jewel_Description');
			$JewelLoanParam['JewelSBAvail']=$request->input('JewelSBAvail');
			$JewelLoanParam['JewelSBtotal']=$request->input('JewelSBtotal');
			$JewelLoanParam['accid']=$request->input('accid');
			$JewelLoanParam['Amt_recive']=$request->input('Amt_recive');
			 
			
			$id=$this->loan->JewelLoanAllocation_Renewal($JewelLoanParam);
			
			return redirect('/');
			
		}
		
		public function StaffGetDiffYear(Request $request)
		{
			$JDate['jDate']=$request->input('jDate');
			$get=$this->loan->StaffGetDiffYear($JDate);
			return $get;
		}
		
		public function getSBForStaff(Request $request)
		{
			$User['userid']=$request->input('userid');
			$get=$this->loan->getSBForStaff($User);
			$id['sbacno']=$get->AccNum;
			$id['sbtot']=$get->Total_Amount;
			$id['sbaccid']=$get->Accid;
			$id['sbactid']=$get->AccTid;
			$id['fn']=$get->FirstName;
			$id['mn']=$get->MiddleName;
			$id['ln']=$get->LastName;
			return $id;
		}
		
		public function StaffLoanAllocation(Request $request)
		{
			
			$StfLoanParam['StfLoanAmt']=$request->input('StfLoanAmt');
			$StfLoanParam['Compulsory_Deposit']=$request->input('Compulsory_Deposit');
			$StfLoanParam['StfOthrChrge']=$request->input('StfOthrChrge');
			$StfLoanParam['StfBkfrmChrg']=$request->input('StfBkfrmChrg');
			
			$StfLoanParam['staffcharge']=$request->input('staffcharge');
			$StfLoanParam['Stfamttopay']=$request->input('Stfamttopay');
			$StfLoanParam['LoanDurationDays']=$request->input('LoanDurationDays');
			$StfLoanParam['LoanDurationYears']=$request->input('LoanDurationYears');
			$StfLoanParam['StfLoanStartDate']=$request->input('StfLoanStartDate');
			$StfLoanParam['StfLoanEndDate']=$request->input('StfLoanEndDate');
			$StfLoanParam['StfLoanPayMode']=$request->input('StfLoanPayMode');
			$StfLoanParam['StfLoanSBAcNum']=$request->input('StfLoanSBAcNum');
			$StfLoanParam['StfSBAvail']=$request->input('StfSBAvail');
			$StfLoanParam['StfLoanSBtotal']=$request->input('StfLoanSBtotal');
			$StfLoanParam['StfLoanChequeNum']=$request->input('StfLoanChequeNum');
			$StfLoanParam['StfLoanChequeDte']=$request->input('StfLoanChequeDte');
			$StfLoanParam['StfLoanSBAccid']=$request->input('StfLoanSBAccid');
			$StfLoanParam['StfLoanSBAccTid']=$request->input('StfLoanSBAccTid');
			$StfLoanParam['StfLoanType']=$request->input('StfLoanType');
			$StfLoanParam['StfBranch']=$request->input('StfBranch');
			$StfLoanParam['StfBankId']=$request->input('StfBankId');
			$StfLoanParam['suretyid']=$request->input('suretyid');
			$StfLoanParam['StaffID']=$request->input('StaffID');
			$StfLoanParam['StfPayAmt']=$request->input('StfPayAmt');
			$StfLoanParam['staffbid']=$request->input('staffbid');
			
			$uid=$request->input('StaffID');
				$fname=$request->input('StfFName');
				$mname=$request->input('StfFName');
				$lname=$request->input('StfFName');
				//$id = $idget;
				//$id=1;
				
				$path = 'Upload/'.$uid."_".$fname."_".$mname."_".$lname;
				
				
				if(!File::exists($path)) {
				$result = File::makeDirectory($path,0777);
				$destinationPath=$path;
				
				$sc1=Input::file('stfsec1');
				if($sc1!="")
				{
				$secu1="Security1.jpg";
				$security1=Input::file('sec1')->getClientOriginalName();
				$StfLoanParam['stfsec1']=Input::file('stfsec1')->move($destinationPath,$secu1);
				}
				else
				{
				$StfLoanParam['stfsec1']=$request->input('stfsec1');
				}
				
				$sc2=Input::file('stfsec2');
				if($sc2!="")
				{
				$secu2="Security2.jpg";
				$security2=Input::file('stfsec2')->getClientOriginalName();
				$StfLoanParam['stfsec2']=Input::file('stfsec2')->move($destinationPath,$secu2);
				}
				else
				{
				$StfLoanParam['stfsec2']=$request->input('stfsec2');
				}
				
				$sc3=Input::file('stfsec3');
				if($sc3!="")
				{
				$secu3="Security3.jpg";
				$security3=Input::file('stfsec3')->getClientOriginalName();
				$StfLoanParam['stfsec3']=Input::file('stfsec3')->move($destinationPath,$f2);
				}
				else
				{
				$StfLoanParam['stfsec3']=$request->input('stfsec3');
				}
				
				$sc4=Input::file('stfsec4');
				if($sc4!="")
				{
				$secu4="Security4.jpg";
				$security4=Input::file('stfsec4')->getClientOriginalName();
				$StfLoanParam['stfsec4']=Input::file('stfsec4')->move($destinationPath,$f3);
				}
				else
				{
				$StfLoanParam['stfsec4']=$request->input('stfsec4');
				}
				}
				else
				{
				$destinationPath=$path;
				
				$sc1=Input::file('stfsec1');
				if($sc1!="")
				{
				$secu1="Security1.jpg";
				$security1=Input::file('stfsec1')->getClientOriginalName();
				$StfLoanParam['stfsec1']=Input::file('stfsec1')->move($destinationPath,$secu1);
				}
				else
				{
				$StfLoanParam['stfsec1']=$request->input('stfsec1');
				}
				
				$sc2=Input::file('stfsec2');
				if($sc2!="")
				{
				$secu2="Security2.jpg";
				$security2=Input::file('stfsec2')->getClientOriginalName();
				$StfLoanParam['stfsec2']=Input::file('stfsec2')->move($destinationPath,$secu2);
				}
				else
				{
				$StfLoanParam['stfsec2']=$request->input('stfsec2');
				}
				
				$sc3=Input::file('stfsec3');
				if($sc3!="")
				{
				$secu3="Security3.jpg";
				$security3=Input::file('stfsec3')->getClientOriginalName();
				$StfLoanParam['stfsec3']=Input::file('stfsec3')->move($destinationPath,$f2);
				}
				else
				{
				$StfLoanParam['stfsec3']=$request->input('stfsec3');
				}
				
				$sc4=Input::file('stfsec4');
				if($sc4!="")
				{
				$secu4="Security4.jpg";
				$security4=Input::file('stfsec4')->getClientOriginalName();
				$StfLoanParam['stfsec4']=Input::file('stfsec4')->move($destinationPath,$f3);
				}
				else
				{
				$StfLoanParam['stfsec4']=$request->input('stfsec4');
				}
			}
			
			$id=$this->loan->StaffLoanAllocation($StfLoanParam);
			
			return redirect('/');
			
		}
		
		
		public function GetMemDetailForPLAlloc(Request $request)
		{
			$MemDet['membrid']=$request->input('membrid');
			$get=$this->loan->GetMemDetailForPLAlloc($MemDet['membrid']);
			//$id['Req_Amt']=$get->Requested_LoanAmt;
			$id["request_id"] = $get->PersLoanAllocID;
			$id['Dur_Year']=$get->LoandurationYears;
			$id['Dur_Day']=$get->LoandurationDays;
			$id['Board_Amt']=$get->AmountDecideBy_Board;
			$id['Branch_Name']=$get->BName;
			$id['Loan_Type']=$get->LoanType_Name;
			$id['Branch_ID']=$get->Bid;
			$id['LType_ID']=$get->LoanType_ID;
			$id['uid']=$get->Uid;
			$id['first_payment'] = $this->loan->pl_is_first_payment(["member_id"=>$MemDet['membrid']]);
			if($id['first_payment'] == "NO") {
				$id['emi'] = "0";
				$id['pending_part_amt'] = "0";

				$pl_allocation_details_for_partpayment = $this->loan->pl_details_for_partpayment(["member_id"=>$MemDet['membrid']]);
				if(!empty($pl_allocation_details_for_partpayment)) {
					$id['emi'] = $pl_allocation_details_for_partpayment->EMI_Amount;
					$id['start_date'] = $pl_allocation_details_for_partpayment->StartDate;
					$id['end_date'] = $pl_allocation_details_for_partpayment->EndDate;
					$id['pending_part_amt'] = $this->loan->pending_part_amt(["allocation_id"=>$pl_allocation_details_for_partpayment->PersLoanAllocID, "total_amt"=>$id['Board_Amt']]);
				}
			}
			
			return $id;
		}
		
		//To retrieve pygmy detail for DL Allocation
		public function GetPigmyDetailForDL(Request $request)
		{
			$PigmyAcc['PigAccNum']=$request->input('PigAccNum');
			$get=$this->loan->GetPigmyDetailForDL($PigmyAcc);
			$id['Pg_FName']=$get->FirstName;
			$id['Pg_MName']=$get->MiddleName;
			$id['Pg_LName']=$get->LastName;
			$id['Pg_Tot']=$get->Total_Amount;
			$id['Pg_UID']=$get->Uid;
			$id['PgLoan_TID']=$get->LoanType_ID;
			$id['Pg_Bname']=$get->BName;
			$id['Pg_LoanAmt']=$get->AmountDecideBy_Board;
			//$id['PgDur_Year']=$get->LoandurationYears;
			//$id['PgDur_Day']=$get->LoandurationDays;
			$id['Pg_Bid']=$get->Bid;
			$id['Pg_LType']=$get->LoanType_Name;
			$id['EDate']=$get->EndDate;
			
			return $id;
		}
		public function RetrieveRdAccDetailfromrequesttable(Request $request)
		{
			$RdAccNumber['RdAccNum']=$request->input('RdAccNum');
			$get=$this->loan->RetrieveRdAccDetailfromrequesttable($RdAccNumber);
			$id['Pg_FName']=$get->FirstName;
			$id['Pg_MName']=$get->MiddleName;
			$id['Pg_LName']=$get->LastName;
			$id['Pg_Tot']=$get->Total_Amount;
			$id['Pg_UID']=$get->Uid;
			$id['PgLoan_TID']=$get->LoanType_ID;
			$id['Pg_Bname']=$get->BName;
			$id['Pg_LoanAmt']=$get->AmountDecideBy_Board;
			//$id['PgDur_Year']=$get->LoandurationYears;
			//$id['PgDur_Day']=$get->LoandurationDays;
			$id['Pg_Bid']=$get->Bid;
			$id['Pg_LType']=$get->LoanType_Name;
			$id['EDate']=$get->Maturity_Date;
			
			return $id;
		}
		
		public function RetrieveFdAccDetailfromrequesttable(Request $request)
		{
			$FDAccNumber['FdAccNum']=$request->input('FdAccNum');
			$get=$this->loan->RetrieveFdAccDetailfromrequesttable($FDAccNumber);
			$id['Pg_FName']=$get->FirstName;
			$id['Pg_MName']=$get->MiddleName;
			$id['Pg_LName']=$get->LastName;
			$id['Pg_Tot']=$get->Fd_DepositAmt;
			$id['Pg_UID']=$get->Uid;
			$id['PgLoan_TID']=$get->LoanType_ID;
			$id['Pg_Bname']=$get->BName;
			$id['Pg_LoanAmt']=$get->AmountDecideBy_Board;
			//$id['PgDur_Year']=$get->LoandurationYears;
			//$id['PgDur_Day']=$get->LoandurationDays;
			$id['Pg_Bid']=$get->Bid;
			$id['Pg_LType']=$get->LoanType_Name;
			$id['EDate']=$get->FdReport_MatureDate;
			
			
			return $id;
		}
		public function getcustfromrequesttable(Request $request)
		{
			$AccNumber['customer']=$request->input('customer');
			$get=$this->loan->getcustfromrequesttable($AccNumber);
			//	$id['Pg_FName']=$get->FirstName;
			//$id['Pg_MName']=$get->MiddleName;
			//$id['Pg_LName']=$get->LastName;
			//$id['Pg_Tot']=$get->Fd_DepositAmt;
			//$id['Pg_UID']=$get->Uid;
			$id['PgLoan_TID']=$get->LoanType_ID;
			$id['Pg_Bname']=$get->BName;
			$id['Pg_LoanAmt']=$get->AmountDecideBy_Board;
			$id['PgDur_Year']=$get->LoandurationYears;
			$id['PgDur_Day']=$get->LoandurationDays;
			$id['Pg_Bid']=$get->Bid;
			$id['Pg_LType']=$get->LoanType_Name;
			$id['appraisalvalue']=$get->Gold_Rate;
			$id['duration']=$get->JewelLoan_Duration;
			$id['uid']=$get->Uid;
			$id['Jewel_Description']=$get->Jewel_Description;
			$id['PersLoanAllocID']=$get->PersLoanAllocID;
			return $id;
		}
		
		public function GetMonthDiffForDL(Request $request)
		{
			$GetMDiff['Start_Date']=$request->input('Start_Date');
			$GetMDiff['End_Date']=$request->input('End_Date');
			$get=$this->loan->GetMonthDiffForDL($GetMDiff);
			
			return $get;
		}
		public function getdetailsfromrequesttable(Request $request)
		{
			$Getstaffemp['empid']=$request->input('empid');
			$get=$this->loan->getdetailsfromrequesttable($Getstaffemp);
			$id['Loan_TID']=$get->LoanType_ID;
			$id['Bname']=$get->BName;
			$id['LoanAmt']=$get->AmountDecideBy_Board;
			$id['Dur_Year']=$get->LoandurationYears;
			$id['Dur_Day']=$get->LoandurationDays;
			$id['Bid']=$get->Bid;
			$id['LType']=$get->LoanType_Name;
			$id['uid']=$get->Uid;
			return $id;
			
			
		}
		public function dlloanrecepit($id)
		{
			$dlloanrecepit=$this->loan->dlloanrecepit($id);
			return view('dlloanrecepit',compact('dlloanrecepit'));
		}
		public function plloanrecepit($id)
		{
			$plloanrecepit=$this->loan->plloanrecepit($id);
			return view('plloanrecepit',compact('plloanrecepit'));
		}
		public function jlloanrecepit($id)
		{
			$jlloanrecepit=$this->loan->jlloanrecepit($id);
			return view('jlloanrecepit',compact('jlloanrecepit'));
		}
		public function jlsearchacc(Request $request)
		{
			$jl['SearchAccId']=$request->input('SearchAccId');
			$jewelLoan=$this->loan->jlsearchacc($jl);
			return view('jlsearch',compact('jewelLoan'));
			
		}
		public function plsearchacc(Request $request)
		{
			$pl['SearchAccId']=$request->input('SearchAccId');
			$data=$this->loan->plsearchacc($pl);
			return view('plsearch',compact('data'));
			
		}
		public function slsearchacc(Request $request)
		{
			$sl = $request->input('SearchAccId');
			$data = $this->loan->slsearchacc($sl);
			return view('slsearch',compact('data'));
			
		}
		public function dlsearchacc(Request $request)
		{
			$dl = $request->input('SearchAccId');
			$data = $this->loan->dlsearchacc($dl);
			return view('dlsearch',compact('data'));
			
		}
	/*	public function dlsearchacc(Request $request)
		{
			$jl['SearchAccId']=$request->input('SearchAccId');
			$loanalc=$this->loan->dlsearchacc($jl);
			return view('dlsearch',compact('loanalc'));
			
		}*/
		public function getcd_of_employee(Request $request)
		{
			$cd=$request->input('AcNo');
			
			$cd_amt=$this->loan->getcd_of_employee($cd);
			
			$id['cd_amt_']=$cd_amt->CD_Amount;
			return $id;
			
		}
		public function Loanpayment()
		{
			return view('loanpayment');
			
		}
		public function partpaypartamt(Request $request)
		{
			$loanpart['type']=$request->input('type');
			$loanpart['alloc']=$request->input('alloc');
			$loanpart['ea']=$request->input('ea');
			
			return $this->loan->partpaypartamt($loanpart);
		}
		
		public function getbankdetails(Request $request) //for PayAmt
		{
			$Bank['BankId']=$request->input('bankid');
			$get=$this->PayAmtMod->GetBankDetailsForPayAmt($Bank);
			
			$id['BankName']=$get->BankName;
			$id['IFSC']=$get->AddBank_IFSC;
			$id['Branch']=$get->Branch;
			$id['AccountNo']=$get->AccountNo;
			$id['TotalAmt']=$get->TotalAmt;
			return $id;
		}
		

		//0
		public function jewelLoanPendingReport()
		{
			$data = $this->loan->getPendingJewelList();
			return view('jewelLoanPendingReport',compact('data'));
		}
		//1
		public function sendToJewelAuction(Request $request)
		{
			$acc_id = array();
			$ids = $request->input('val');
			$acc_id = explode(",",$ids);
			print_r($acc_id);
			$this->loan->sendToJewelAuction($acc_id);
			return "ok";
		}
		//2
		public function jewelAuctionList()
		{
		//	$data = $this->loan->getPendingJewelList();
			$data = $this->loan->jewelAuctionList();
			return view('jewelAuctionList',compact('data'));
		}
		
		public function jewelAuction(Request $request)
		{
		
			$string = $request->input('val');
			$a = explode(',', $string);

			foreach ($a as $result) {
			$b = explode(' ', $result);
			$array[$b[0]] = $b[1];
			}
		
			$c = $this->loan->jewelAuction($array);
			return $array;
		}
		
/*		public function jewelAuctionPayDetails(Request $request)
		{
			$data['acc'] = $request->input("acc",true);
			$data['cname'] = $request->input("name",true);
			$data['ln_no'] = $request->input("ln_no",true);
			$data['st_date'] = $request->input("st_date",true);
			$data['end_date'] = $request->input("end_date",true);
			$data['gross_wt'] = $request->input("gross_wt",true);
			$data['net_wt'] = $request->input("net_wt",true);
			$data['app_val'] = $request->input("app_val",true);
			$data['ln_amt'] = $request->input("ln_amt",true);
			$data['rem_amt'] = $request->input("rem_amt",true);
			$data['auc_amt'] = $request->input("auc_amt",true);
			$data['branch_data']=$this->Report_model->GetBranchDropD();
			$data['led']=$this->creadexpencemodel->getExpensedata();
		//	return $data;
			return view('jewelAuctionPayDetails',compact("data"));
		}*/
		//3
		public function jewelAuctionPay(Request $request)
		{
			$data['jl_alloc_id'] = $request->input("jl_alloc_id",true);
			$data['cname'] = $request->input("cname",true);
			$data['ln_no'] = $request->input("ln_no",true);
			$data['st_date'] = $request->input("st_date",true);
			$data['end_date'] = $request->input("end_date",true);
			$data['gross_wt'] = $request->input("gross_wt",true);
			$data['net_wt'] = $request->input("net_wt",true);
			$data['app_val'] = $request->input("app_val",true);
			$data['ln_amt'] = $request->input("ln_amt",true);
			$data['rem_amt'] = $request->input("rem_amt",true);
			$data['rem_int'] = $request->input("rem_int",true);
			$data['charges'] = $request->input("charges",true);
//			$data['other_charges'] = $request->input("other_charges",true);//ADD OTHER CHARGES - NOTICES CHARGE, AUCTION CHARGE...
			$data['auc_amt'] = $request->input("auc_amt",true);
			$data['branch_data']=$this->loan->GetBranchDropD();
			$data['led']=$this->creadexpencemodel->getExpensedata();
			/**/
			
			$data['bname'] = $request->input("bname",true);
			$data['bid2'] = $request->input("bid2",true);
			$data['pay_mode'] = $request->input("pay_mode",true);
			$data['chequeno'] = $request->input("chequeno",true);
			$data['cheque_date'] = $request->input("cheque_date",true);
			$data['cheque_bank_id'] = $request->input("cheque_bank_id",true);
			$data['pay_type'] = $request->input("pay_type",true);
			$data['buyer_acc_no'] = $request->input("buyer_acc_no",true);
			$data['bk_name'] = $request->input("bk_name",true);
			$data['by_ac_no'] = $request->input("by_ac_no",true);
			$data['head_id'] = $request->input("head_id",true);
			$data['subhead_id'] = $request->input("subhead_id",true);
			$data['per'] = $request->input("per",true);
			$data['auc_date'] = $request->input("auc_date",true);
			$data['paper_charge'] = $request->input("paper_charge",true);
			$data['amount_to_branch'] = $request->input("amount_to_branch",true);
			
			if($data['bname'] !== true)
			{
				$this->loan->jlAuction($data);//4
				return "aaa";
			}
			return view('jewelAuctionPayDetails',compact("data"));//3
		}
		
		public function jewelAuctionExtraAmount(Request $request)
		{
			$data = $this->loan->jewelAuctionExtraAmountList();
			return view('jewelAuctionExtraAmount',compact("data"));
		}
		
		public function jewelAuctionExtraAmountPayDetails(Request $request)
		{
			$data['jl_alloc_id'] = $request->input("jl_alloc_id");
			$data['cname'] = $request->input("cname",true);
			$data['ln_no'] = $request->input("ln_no",true);
			$data['st_date'] = $request->input("st_date",true);
			$data['end_date'] = $request->input("end_date",true);
			$data['gross_wt'] = $request->input("gross_wt",true);
			$data['net_wt'] = $request->input("net_wt",true);
			$data['ln_amt'] = $request->input("ln_amt",true);
//			$data['rem_amt'] = $request->input("rem_amt",true);
			$data['auc_amt'] = $request->input("auc_amt",true);
			$data['extra_amt'] = $request->input("extra_amt",true);
			$data['acc_no'] = $request->input("acc_no",true);
			
			
			
			/**/
			$data['pay_mode'] = $request->input("pay_mode","");
			$data['buyer_acc_no'] = $request->input("buyer_acc_no","");
			$data['cheque_no'] = $request->input("cheque_no","");
			$data['cheque_date'] = $request->input("cheque_date","");
			$data['bank_acc_no'] = $request->input("bank_acc_no","");
			$data['pay_date'] = $request->input("pay_date","");
			$data['per'] = $request->input("per","");
			if($data['pay_mode'] !== "") {
				$this->loan->jewelAuctionExtraAmountPay($data);//5
				return "succuss";
			}
			else {
				return view('jewelAuctionExtraAmountPayDetails',compact("data"));
			}
		}
		
		public function cdreport(Request $request)
		{
			//$Url = "cdreport";
			//$data["module"] = $this->Modules->GetAnyMid($Url);
			
			
			$in_data["sl_no"] = $request->input("sl_no");
			$in_data["from_date"] = $request->input("from_date");
			$in_data["to_date"] = $request->input("to_date");
			
			$data = $this->loan->get_cdreport($in_data);
			
			$first_time = $request->input("first_time");
			if(empty($first_time)) {
				return view("cd_report",compact("data"));
			} else {
				return view("cd_report_data",compact("data"));
			}
		}
		
		public function sdreport(Request $request)
		{
			$Url = "sdreport";
			//$data["module"] = $this->Modules->GetAnyMid($Url);
			$data["det"] = $this->loan->get_sdreport();
			return view("sd_report",compact("data"));
		}
		
		public function loan_pending_report(Request $request)
		{
			$ln_type = $request->input("ln_type");
			
			if(empty($ln_type)){
				$data = array();
				$data['det'] = array();
				return view("loan_pending_report",compact("data"));
			} else {
			
							$data = array();
				$data['det'] = array();
				
				switch($ln_type)
				{
					case "PL":	$data["det"] = $this->loan->loan_pending_report_pl();
								return view("loan_pending_report_data",compact("data"));
								break;
					case "JL":	$data["det"] = $this->loan->loan_pending_report_jl();
								return view("loan_pending_report_data",compact("data"));
								break;
					case "SL":	$data["det"] = $this->loan->loan_pending_report_sl();
								return view("loan_pending_report_data",compact("data"));
								break;
					case "DL":	$dl_type = $request->input("dl_type");
								$data["det"] = $this->loan->loan_pending_report_dl($dl_type);
								return view("loan_pending_report_data",compact("data"));
								break;
					default : ;
				}
				return -1;
			}
		}
		
		public function edit_jl_net_wt(Request $request)
		{
			$in_data["jewel_alloc_id"] = $request->input("jewel_alloc_id");
			$in_data["net_wt"] = $request->input("net_wt");
			$in_data["closed_status"] = $request->input("closed_status");
			$this->loan->edit_jl_net_wt($in_data);
			return;
		}
		
		public function jewel_loan_report(Request $request)
		{
			$data=[];
			$data["report_data"] = $this->loan->jewel_loan_report();
			return view("jewel_loan_report_data",compact("data"));
		}
		
		public function jewel_loan_individual_report_data(Request $request)
		{
			
			return view("jewel_loan_individual_report_data",compact("data"));
		}
		
/*		public function jewel_loan_individual_report_data(Request $request)
		{
			$data["rep"] = $this->loan->jewel_loan_individual_report_data();
			return view("jewel_loan_individual_report_data",compact("data"));
		}*/
		
		public function add_charges_index(Request $request)
		{
			$data = array();
			return view("add_charges_index",compact("data"));
		}
		
		public function jewel_loan_repay_report_data(Request $request)
		{
			$in_data = array();
			$in_data["loan_allocation_id"] = $request->input("loan_allocation_id");//7007;//
			$data = array();
			$data = $this->loan->jewel_loan_repay_report_data($in_data);
			$data["loan_category"] = "JL";
			
//			print_r($data);exit;
			return view("jewel_loan_repay_report_data",compact("data"));
		}
		
		public function repay_report_data(Request $request)
		{
			$in_data = array();
			$data = array();
			$in_data["loan_category"] = $request->input("loan_category");//PL,JL,...
			$in_data["loan_allocation_id"] = $request->input("loan_allocation_id");//204;
			
			switch($in_data["loan_category"]) {
				case "PL":	
							$data = $this->loan->repay_report_data_pl($in_data);
							//print_r($data);exit();
							return view("repay_report_data_pl",compact("data"));
							break;
				case "DL":	
							$data = $this->loan->repay_report_data_dl($in_data);
							$data["loan_category"] = $in_data["loan_category"];
							// print_r($data);exit();
							return view("jewel_loan_repay_report_data",compact("data"));
							// return view("repay_report_data_dl",compact("data"));
							break;
				case "SL":	
							$data = $this->loan->repay_report_data_sl($in_data);
							$data["loan_category"] = $in_data["loan_category"];
							// print_r($data);exit();
							return view("jewel_loan_repay_report_data",compact("data"));
							// return view("repay_report_data_dl",compact("data"));
							break;
			}
		}
		
		public function save_repay_data(Request $request)
		{
			$in_data = array();
			$in_data["loan_type"] = $request->input("loan_type");
			$in_data["repay_id"] = $request->input("repay_id");
			$in_data["int_date"] = $request->input("int_date");
			$in_data["principle_amount"] = $request->input("principle_amount");
			$in_data["interest_amount"] = $request->input("interest_amount");
			$in_data["pigmy_commission"] = $request->input("pigmy_commission");
			
			switch($in_data["loan_type"]) {
				case "JL":	$this->loan->save_repay_data_jl($in_data);
							break;
				case "PL":	$this->loan->save_repay_data_pl($in_data);
							break;
			}
			return "done";
		}
		
		public function calculate_jewel_interest(Request $request)
		{
			$in_data = array();
			$in_data["loan_allocation_id"] = $request->input("loan_allocation_id");
			$in_data["interest_upto"] = $request->input("interest_upto",date("Y-m-d"));
			$this->loan->calculate_jewel_interest($in_data);
			return;
		}
		
		public function interest_calc_pl(Request $request)
		{
			$in_data = array();
			$in_data["loan_allocation_id"] = $request->input("loan_allocation_id");//424;//
			$in_data["interest_upto"] = $request->input("interest_upto_pl",date("Y-m-d"));
			$ret_data = $this->loan->interest_calc_pl($in_data);
//			var_dump($ret_data);exit();
			return $ret_data;
		}
		
		public function charges_transaction_report(Request $request)
		{
			$in_data["loan_allocation_id"] = $request->input("loan_allocation_id");
			$in_data["loan_category"] = $request->input("loan_category");
			$in_data["charges_date"] = $request->input("charges_date");
			$data["charges"] = $this->loan->charges_transaction_report($in_data);
			return view("repay_report_data_charges",compact('data'));
		}
		
		public function edit_emi(Request $request)
		{
			$fn_data['id'] = $request->input("id");
			$fn_data['value'] = $request->input("value");
			return $this->loantype->edit_emi($fn_data);
		}
		
		public function edit_int_rate(Request $request)
		{
			$fn_data['id'] = $request->input("id");
			$fn_data['value'] = $request->input("value");
			return $this->loantype->edit_int_rate($fn_data);
		}
		
		public function jewelLoan2()//JEWEL LOAN
		{
			return view('jewelloanallocation_index');
		}
		
		public function show_Persnloanalloc2()//PERSONAL LOAN
		{
			return view('personal_loanallocation_index');
		}
		
		public function show_loanalloc2()//DEPOSIT LOAN
		{
			return view('deposit_loanallocation_index');
		}
		
		public function show_Staffloanalloc2()//DEPOSIT LOAN
		{
			return view('staff_loanallocation_index');
		}
		
		public function account_list(Request $request)
		{
			$in_data['category'] = $request->input("category");
			$in_data['closed'] = $request->input("closed");
			$in_data['pl_type'] = $request->input("pl_type");
			$in_data['loan_id'] = $request->input("loan_id");
			switch($in_data['category']) {
				case "JL":	$ret_data = $this->loan->account_list_jl($in_data);
							return view("jewelloanallocation_data",compact("ret_data"));
							break;
				case "PL":	$ret_data = $this->loan->account_list_pl($in_data);
							return view("personal_loanallocation_data",compact("ret_data"));
							break;
				case "DL":	$ret_data = $this->loan->account_list_dl($in_data);
							return view("deposit_loanallocation_data",compact("ret_data"));
							break;
				case "SL":	$ret_data = $this->loan->account_list_sl($in_data);
							return view("staff_loanallocation_data",compact("ret_data"));
							break;
			}
		}
			
		public function account_list_edit(Request $request)
		{
			$in_data['category'] = $request->input("category");
			$in_data['closed'] = $request->input("closed");
			$in_data['loan_id'] = $request->input("loan_id");
			switch($in_data['category']) {
				//case "JL":	$ret_data = $this->loan->account_list_jl($in_data);
				//			return view("jewelloanallocation_data",compact("ret_data"));
				//			break;
				case "PL":	$ret_data = $this->loan->account_list_pl_edit($in_data);
							break;
				case "DL":	$ret_data = $this->loan->account_list_dl_edit($in_data);
							break;
				
			}
			return "deposit_account_edit: done";
		}
		
		
	}
