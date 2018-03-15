<?php
	Route::group(['prefix' => '/'], function()
	{
		Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
		Route::get('/','AuthenticateController@index');
		Route::post('/authenticate', 'AuthenticateController@authenticate');
		Route::get('logout','AuthenticateController@logout');
		
		Route::group(['middleware' => ['auth']], function() {
			
			Route::group(['middleware' => ['revalidate']], function() {
				
				//ROUTES FOR DIVIDED CONTROLLERS GOES HERE
				
				//HomeController
				Route::get('/home','HomeController@showNestedViews');
				
				Route::get('/sharehandover','PurchaseshareController@sharehandover');
				Route::get('/GetMemberdetails','SearchController@GetMemberdetails');
					Route::post('/getshares','PurchaseshareController@getshares');
					Route::get('/adjustment_num','SearchController@adjustment_num');
					Route::post('/Getadjustmentdetails','DLRepaymentController@Getadjustmentdetails');
				//AccountTypeController
				Route::get('/acctype','AccountTypeController@show_accounttype');
				Route::get('/accounttypedetail','AccountTypeController@show_createacctype');
				Route::post('/createacctyp','AccountTypeController@createacctype');
				
				
				
				//AccountController
				Route::get('/AccountCreation','AccountController@show_account');
				Route::get('/sbacclist','AccountController@show_sbaccount');
				Route::get('/sb_joint_acclist','AccountController@show_sbaccount_joint');
				Route::get('/rdacclist','AccountController@show_rdaccount');
				Route::get('/searchacclist','AccountController@show_searchaccount');
				Route::get('/getSearchaccount','AccountController@GetSearchAccs');
				Route::get('/getSearchOldaccount','AccountController@GetSearchOldAccs');
				Route::get('/acccreation','AccountController@view_account');
				Route::post('/createacc','AccountController@create_account');
				Route::post('/updateacc','AccountController@UpdateAccount');
				Route::post('/checkaccount','AccountController@checkacc');
				Route::get('/accountdetails/{id}/{type?}','AccountController@Show_AccountDetails');
				Route::get('/accountdetails_joint/{id}/{type?}','AccountController@Show_AccountDetails_joint');
				Route::post('/GetBranchid','AccountController@GetBranchid');
				Route::get('/ViewCreateJointAcc','AccountController@ViewCreateJointAcc');
				Route::post('/CreateJointAcc','AccountController@CreateJointAcc');
				Route::get('/ViewMinorAccHome','AccountController@ViewMinorAccHome');
				Route::get('/ViewCreateMinorAcc','AccountController@ViewCreateMinorAcc');
				Route::post('/CreateMinorAccount','AccountController@CreateMinorAccount');
				
				Route::post('/get_account_balance','AccountController@get_account_balance');
				
				
				
				
				//AuthoriseController
				Route::get('/custauth','AuthorisedController@show_custauth');
				Route::get('/authaccount','AuthorisedController@show_anauthaccount');
				Route::get('/authcust','AuthorisedController@show_custAuthories');
				Route::get('/custrejectview','AuthorisedController@show_custrejAuthories');
				Route::get('/authpigmy','AuthorisedController@show_unauthpigmy');
				Route::get('/authorisecust/{id}','AuthorisedController@accept_custAuthories');
				Route::get('/rejectcust/{id}','AuthorisedController@reject_custAuthories');
				Route::get('/acceptaccount/{id}','AuthorisedController@accept_account');
				Route::get('/rejectedaccount','AuthorisedController@reject_accountview');
				Route::get('/rejectaccount/{id}','AuthorisedController@reject_account');
				Route::get('/acceptaccountpigmy/{id}','AuthorisedController@accept_accountpigmy');
				Route::get('/rejectedaccountpigmy/{id}','AuthorisedController@reject_accountpigmy');
				Route::get('/authemp','AuthorisedController@show_unauthemp');
				Route::get('/acceptemp/{id}','AuthorisedController@accept_empAuthories');
				Route::get('/rejectemp/{id}','AuthorisedController@reject_empAuthories');
				Route::get('/authloan','AuthorisedController@show_unauthLoan');
				Route::get('/acceptunauthloan/{id}','AuthorisedController@acceptunauthloan');
				Route::get('/rejectunauthloan/{id}','AuthorisedController@rejectunauthloan');
				Route::get('/authpigmydl','AuthorisedController@show_unauthPigmyDL');
				Route::get('/acceptunauthpigmydl/{id}','AuthorisedController@AcceptUnAuthPigmyDL');
				Route::get('/rejectunauthpigmydl/{id}','AuthorisedController@RejectUnAuthPigmyDL');
				Route::get('/authoriserejcust/{id}','AuthorisedController@accept_rejcustAuthories');
				Route::get('/acceptrejectaccount/{id}','AuthorisedController@acceptreject_account');
				Route::get('/authloan','AuthorisedController@show_unauthLoan');//13/04/2016
				Route::get('/authPL','AuthorisedController@show_unauthPLoan');//13/04/2016
				Route::post('/acceptPL','AuthorisedController@Accept_unauthPLoan');//19/04/2016
				Route::get('/rejectPL/{id}','AuthorisedController@Reject_unauthPLoan');//19/04/2016
				Route::get('/authDL','AuthorisedController@show_unauthDLoan');//26/04/2016
				Route::post('/acceptDL','AuthorisedController@Accept_unauthDLoan');//26/04/2016
				Route::get('/rejectDL/{id}','AuthorisedController@Reject_unauthDLoan');//19/04/2016
				Route::get('/authSL','AuthorisedController@show_unauthSLoan');
				Route::post('/acceptSL','AuthorisedController@Accept_unauthSLoan');
				Route::get('/rejectSL/{id}','AuthorisedController@Reject_unauthSLoan');
				Route::get('/authJL','AuthorisedController@show_unauthJLoan');
				Route::post('/acceptJL','AuthorisedController@Accept_unauthJLoan');
				Route::get('/rejectJL/{id}','AuthorisedController@Reject_unauthJLoan');
				
				
				//BranchController
				Route::get('/branch','BranchController@show_branch');
				Route::get('/showcreatebranch','BranchController@show_createbranch');
				Route::post('/createbranch1','BranchController@create_branch');
				Route::post('/updatebranch','BranchController@UpdateBranch');
				Route::get('/branchdetails/{id}/{type?}','BranchController@Show_BranchDetails');
				
				
				
				//BankController
				Route::get('/bank','BankController@show_bank');
				Route::get('/bankdetail','BankController@display_bank');
				Route::post('/crateaddbank','BankController@create_bank');
				
				
				
				//CompanyController
				Route::get('/company','CompanyController@show_company');
				Route::get('/companydetail','CompanyController@display_company');
				Route::post('/createcompany','CompanyController@create_company');
				
				
				
				//CustomerController
				Route::get('/customer','CustomerController@show_cust');
				Route::get('/createcustomer','CustomerController@show_createcust');
				Route::post('/updatecust','CustomerController@UpdateCustomer');
				Route::post('/createcust','CustomerController@create_cust');
				Route::get('/Getuid','CustomerController@GetUid');
				Route::get('/GetMaxUid','CustomerController@GetMaxUid'); //for minor customer
				Route::get('/customerdetails/{id}/{type?}','CustomerController@Show_CustDetails');
				Route::get('/userdetailscust/{id}/{type?}','CustomerController@userdetails');
				Route::post('/CreateMinorCust','CustomerController@CreateMinorCust');
				Route::get('/ShowGetMinDetails','CustomerController@ShowGetMinDetails');
				Route::get('/CustomerReceipt/{id}','CustomerController@CustomerReceipt'); //M 13-4-16
				Route::get('/CustSearchView','CustomerController@CustSearchView'); //M 13-4-16
				Route::get('/D_class_custm','CustomerController@D_class_custm');
				
				
				//DesignationController
				Route::post('/createdesig', 'DesignationController@create_desg');
				Route::get('/designation','DesignationController@showdesig');
				Route::get('/createdesgn','DesignationController@show_desg');
				
				
				
				//DepositController
				Route::get('/deposit','DepositController@show_deposit');
				Route::get('/depodetail','DepositController@display_deposit');
				Route::post('/crateaddeposit','DepositController@create_deposit');
				Route::post('/depgetbankdetail','DepositController@GetBankDetailForDeposite');
				Route::get('/depodetailbranch','DepositController@depodetailbranch');
				Route::post('/crateaddeposittobranch','DepositController@crateaddeposittobranch');
				
				//DocController
				Route::get('/Doctype','DocController@show_doctype');
				Route::get('/doccreate','DocController@create_doc');
				Route::post('/insertdoc','DocController@insert_doc');
				
				
				
				//EmployeeController
				Route::get('/emp','EmployeeController@show_emp');
				Route::get('/empcreate','EmployeeController@show_empcreate');
				Route::post('/insertemp','EmployeeController@create_employee');
				Route::post('/updateemp','EmployeeController@UpdateEmployee');
				Route::get('/Getusrid','EmployeeController@GetUid');
				Route::get('/empdetails/{id}/{type?}','EmployeeController@Show_EmpDetails');
				
				
				
				//ExpenceController
				Route::get('/expence','ExpenceController@show_expence');
				Route::get('/expencedetail','ExpenceController@display_expence');
				Route::post('/crateaexpence','ExpenceController@create_expence');
				
				Route::post('/crateatranexpence','ExpenceController@create_tranexpence');
				Route::post('/getbnkdetail','ExpenceController@GetBankDetail');
				
				Route::get('/GetExpenseSuBId','ExpenceController@GetExpenseSuBId');//T 29/4
				Route::get('/GetSubLedgerHead','ExpenceController@GetSubLedgerHead');//T 29/4
				Route::get('/createexp','ExpenceController@display_exp');
				Route::post('/createexp1','ExpenceController@create_exp');
				Route::get('/expenceBranch','ExpenceController@expenceBranch');
				Route::get('/expencetran','ExpenceController@display_tranexpence');
				//Route::get('/createexp','ExpenceController@display_exp');
				Route::post('/transferbranchamt','ExpenceController@transferbranchamt');
				Route::get('/ExReceipt/{id}','ExpenceController@ExReceipt');
				Route::get('/income','ExpenceController@income');
				Route::get('/createIncome','ExpenceController@createIncome');
				Route::post('/createincomes','ExpenceController@createincomes');
				
				Route::get('/IncomeReceipt/{id}','ExpenceController@IncomeReceipt');
				
				//FdController
				Route::get('/fdtype','FdTypeController@show_fdtype');
				Route::post('/createfdtyp','FdTypeController@createfdtype');
				Route::get('/fdtypedetail','FdTypeController@show_createfdtype');
				Route::post('/retriveaccdet','FdTypeController@GetFdvalues');
				
				
				
				//FdAllocationController
				Route::get('/fdallocation','FdAllocationController@Show_FdAlloc');
				Route::get('/crtfdallocation','FdAllocationController@show_crtfdalloc');
				//Route::get('/RetrieveCommission','FdAllocationController@retrieve_comm');
				Route::post('/crtfdalloc','FdAllocationController@create_fdalloc');
				Route::post('/retrivebranch','FdAllocationController@GetBranchCode');
				Route::get('/getBranchName','FdAllocationController@getbnknme');
				Route::post('/RetrieveSBAmount','FdAllocationController@GetSBAmt');
				Route::get('/FdCertificate/{id}','FdAllocationController@ShowFdCertificate');
				Route::get('/FDReceipt/{id}','FdAllocationController@ShowFDReceipt');
				Route::get('/FDedit/{id}','FdAllocationController@FDedit');
				Route::post('/editfd','FdAllocationController@editfd');
				Route::post('/prefdwithdrawal','FdAllocationController@prefdwithdrawal');
				Route::get('/FDSearchView','FdAllocationController@FDSearchView'); //M 13-4-16
				Route::post('/FdCertStatUpdate','FdAllocationController@FdCertStatUpdate'); //M 22-6-16
				Route::get('/kccallocation','FdAllocationController@kccallocation');
				Route::post('/crtkccalloc','FdAllocationController@crtkccalloc');
				Route::get('/crtkccallocation','FdAllocationController@crtkccallocation');
				Route::post('/fdrenew','FdAllocationController@fdrenew');
				Route::post('/fdrenewdetails','FdAllocationController@fdrenewdetails');
				//InterestController
				Route::get('/pigmiinterest','InterestController@pigmiInterest');
				Route::post('/pigmiInterestCalc','InterestController@pigmiInterestCalc');
				Route::get('/sbinterest','InterestController@index');
				Route::post('/sb_interest','InterestController@sbinterest_cal');
				Route::post('/rd_interest','InterestController@rdinterest_cal');
				Route::post('/FDwithdraw','InterestController@FDwithdraw');
				Route::post('/editrdInterestCalc','InterestController@editrdInterestCalc');
				Route::post('/editpigmiInterestCalc','InterestController@editpigmiInterestCalc');
				Route::post('/editrdInterestCalc','InterestController@editrdInterestCalc');
				Route::post('/SdInterest','InterestController@SdInterest');
				Route::get('/sdpay','InterestController@sdpay');
				Route::post('/getemployeeSD','InterestController@getemployeeSD');
				Route::post('/SDINTERESTPAY','InterestController@SDINTERESTPAY');
				
				
				//LoanType Controller
				Route::get('/Loantype','LoanTypeController@show_loantypedetail');
				Route::get('/loantypedetail','LoanTypeController@show_createloantype');
				Route::post('/createloantyp','LoanTypeController@createloantype');
				
				
				
				//LoanAllocation Controller
				Route::get('/Loanallocation','LoanController@show_loanalloc');
				Route::get('/crtloanalloc','LoanController@show_createaloanalloc');
				Route::post('/retrieveaccname','LoanController@retrieve_acname');
				Route::post('/crtloanallocation','LoanController@create_Loan');
				Route::post('/CreateDepositeLoanAllocation','LoanController@CreateDepositeLoan');
				Route::post('/getloancriteria','LoanController@loan_criteria');
				Route::post('/getbcode','LoanController@getbranchcode');
				Route::get('/RetrievePigmyAccDetail','LoanController@RetrievePigmyAccDetail'); //for Pigmy Loan Allocation
				Route::get('/RetrieveFdAccDetail','LoanController@RetrieveFdAccDetail'); //for FD Loan Allocation
				Route::get('/RetrieveRdAccDetail','LoanController@RetrieveRdAccDetail'); //for FD Loan Allocation
				Route::get('/GetBranchIDForDL','LoanController@GetBranchIDForDL'); //for DL
				Route::get('/GetSBForDL','LoanController@GetSBForDL'); //for DL
				Route::get('/StffLoan','LoanController@show_Staffloanalloc'); 
				Route::get('/staffloan_home','LoanController@show_Staffloanalloc1'); 
				Route::post('/GetEmployeeDetail','LoanController@Get_EmpDetails');
				Route::get('/PersonalLoan','LoanController@show_Persnloanalloc');
				Route::get('/PersonalLoan1','LoanController@show_Persnloanalloc1');
				Route::post('/GetMemSBDetail','LoanController@GetMemSBDetail');
				Route::get('/GetCharges','LoanController@GetCharges');
				Route::post('/GetMemSBDetailView','LoanController@GetMemSBDetailView');
				Route::post('/GetBankDetailsForPersLoan','LoanController@GetBankDetailsForPersLoan');
				Route::get('/getbankdetails','LoanController@GetBankDetailsForPersLoan');
				Route::post('/CreatePersLoanAllocation','LoanController@CreatePersLoanAllocation');
				Route::get('/jewelLoan','LoanController@jewelLoan');
				Route::get('/jewelLoan1','LoanController@jewelLoan1');
				Route::get('/GetJewelDetail','LoanController@GetJewelDetail');
				Route::post('/CheckSBForJewel','LoanController@CheckSBForJewel');
				Route::get('/getSBForJewel','LoanController@getSBForJewel');
				Route::post('/JewelLoanAllocation','LoanController@JewelLoanAllocation');
				Route::post('/getSBForStaff','LoanController@getSBForStaff');
				Route::post('/StaffLoanAllocation','LoanController@StaffLoanAllocation');
				Route::post('/StaffGetDiffYear','LoanController@StaffGetDiffYear');
				Route::post('/CheckSBForStaff','LoanController@CheckSBForStaff');
				Route::post('/GetMemDetailForPLAlloc','LoanController@GetMemDetailForPLAlloc');
				Route::post('/GetPigmyDetailForDL','LoanController@GetPigmyDetailForDL');
				Route::get('/RetrieveRdAccDetailfromrequesttable','LoanController@RetrieveRdAccDetailfromrequesttable');
				Route::get('/RetrieveFdAccDetailfromrequesttable','LoanController@RetrieveFdAccDetailfromrequesttable');
				Route::get('/getcustfromrequesttable','LoanController@getcustfromrequesttable');
				Route::post('/GetMonthDiffForDL','LoanController@GetMonthDiffForDL');
				Route::get('/getdetailsfromrequesttable','LoanController@getdetailsfromrequesttable');
				Route::get('/jlloanrecepit/{id}','LoanController@jlloanrecepit');
				Route::get('/dlloanrecepit/{id}','LoanController@dlloanrecepit');
				Route::get('/plloanrecepit/{id}','LoanController@plloanrecepit');
				Route::get('/jlsearchacc','LoanController@jlsearchacc');
				Route::get('/plsearchacc','LoanController@plsearchacc');
				Route::get('/slsearchacc','LoanController@slsearchacc');
				Route::get('/dlsearchacc','LoanController@dlsearchacc');
				Route::post('/getcd_of_employee','LoanController@getcd_of_employee');
				Route::get('/Loanpayment','LoanController@Loanpayment');
				Route::post('/partpaypartamt','LoanController@partpaypartamt');
				Route::post('/JewelLoanAllocation_Renewal','LoanController@JewelLoanAllocation_Renewal');
				
				//ModulesController
				Route::get('/modules','ModulesController@show_modules');
				Route::get('/ShowCreateModule','ModulesController@ShowModuleCreate');
				Route::post('/CreateModule','ModulesController@CreateModule');//have to add in controller
				//Route::post('/CreateModule','ModulesController@CreateModule');//have to add in controller
				Route::get('/ModuleEditView/{id}','ModulesController@ModuleEditView');//M 21-4-16
				Route::post('/EditModule','ModulesController@EditModule');//M 21-4-16
				Route::post('/UpdateModuleStatus','ModulesController@UpdateModuleStatus');//M 21-4-16
				
				
				//MemberController
				Route::get('/member','MemberController@Show_Mem');
				Route::get('/memberview','MemberController@view_Mem');
				Route::post('/createmem','MemberController@Member_Create');
				Route::post('/retrieveinfo','MemberController@retrieve_info');
				Route::get('/retrievemax','MemberController@retreive_max');
				Route::get('/Getmemuid','MemberController@GetUid');
				Route::post('/updatemem','MemberController@UpdateMember');
				Route::get('/memberdetails/{id}/{type?}','MemberController@Show_MemberDetails');
				Route::get('/transfercusttomem','MemberController@transfercusttomem');
				Route::post('/tranmember','MemberController@tranmember');
				Route::get('/MemSearchView','MemberController@MemSearchView');
				Route::post('/share_details','MemberController@share_details');
				Route::post('/share_details_data','MemberController@share_details_data');
				
				Route::post('/member_details','MemberController@member_details');
				
				
				
				//OpenCloseBalanceController
				Route::get('/openclose','OpenCloseBalanceController@viewopenclose');
				Route::get('/viewbal','OpenCloseBalanceController@show_balance');
				Route::get('/viewclosebal','OpenCloseBalanceController@show_closingbalance');
				Route::get('/viewdailybal','OpenCloseBalanceController@show_dailybalance');
				Route::get('/viewdailybal1','OpenCloseBalanceController@show_dailybalance1');
				Route::get('/viewFDInterest','OpenCloseBalanceController@viewFDInterest');
				Route::get('/fdinterstmonthly','OpenCloseBalanceController@fdinterstmonthly');
				Route::get('/dailytrandate_details','OpenCloseBalanceController@dailytrandate_details');
				Route::post('/create_fd_data','OpenCloseBalanceController@create_fd_data');
				Route::post('/edit_fd_data','OpenCloseBalanceController@edit_fd_data');
				Route::post('/delete_fd_int','OpenCloseBalanceController@delete_fd_int');
				Route::get('/SBINT','OpenCloseBalanceController@SBINT');
				Route::post('/edit_Sb_data','OpenCloseBalanceController@edit_Sb_data');
				Route::post('/create_SB_data','OpenCloseBalanceController@create_SB_data');
				Route::post('/delete_Sb_data','OpenCloseBalanceController@delete_Sb_data');
				
				
				//PermissionController
				Route::get('/permissions','PermissionController@show_permissions');
				Route::post('/PermissionUpdateC','PermissionController@AjaxUpdateCreate');
				Route::post('/PermissionUpdateR','PermissionController@AjaxUpdateRead');
				Route::post('/PermissionUpdateU','PermissionController@AjaxUpdateUpdate');
				Route::post('/PermissionUpdateD','PermissionController@AjaxUpdateDelete');
				
				
				
				//PurchaseShareController
				Route::get('/purchaseshare','PurchaseshareController@show_purshare');
				Route::get('/pursharesdetail','PurchaseshareController@view_purshare');
				Route::post('/retrieveval','PurchaseshareController@retrieve_val');
				Route::get('/retrievemaxcount','PurchaseshareController@retreive_maxcount');
				Route::post('/createpurshare','PurchaseshareController@create_PurShares');
				Route::get('/psharedetails/{id}','PurchaseshareController@ShowPshareDetails');
				//Route::get('/PshareReceipt/{id}','PurchaseshareController@PshareReceipt');
				Route::get('/PshareReceipt/{id}/{mid}','PurchaseshareController@PshareReceipt');
				Route::post('/UpdateReceiptNo','PurchaseshareController@UpdateReceiptNo');
				Route::get('/PurchaseShareSearchView','PurchaseshareController@PurchaseShareSearchView');//M 19-4-16
				Route::get('/shareclose/{id}','PurchaseshareController@shareclose');
				Route::post('/indshareclose','PurchaseshareController@indshareclose');
				Route::post('/ShareCloseTran','PurchaseshareController@ShareCloseTran');
				Route::post('/SingleShareCloseTran','PurchaseshareController@SingleShareCloseTran');
				
				
				//PigmiController
				Route::get('/pigmetype','PigmiController@show_pigmi');
				Route::get('/pigmedetail','PigmiController@show_pigmitype');
				Route::post('/createpigmityp','PigmiController@create_pigmitype');
				
				
				
				//PigmiAllocationController
				Route::get('/pigmiallocation','PigmiAllocationController@Show_PigmiAlloc');
				Route::get('/crtpigmiallocation','PigmiAllocationController@show_crtpigmialloc');
				Route::get('/RetrieveCommission','PigmiAllocationController@retrieve_comm');
				Route::post('/crtpigmialloc','PigmiAllocationController@create_pigmialloc');
				Route::post('/GetBranchID','PigmiAllocationController@Getbranchid');
				Route::get('/PigmiPendingAmt','PigmiAllocationController@PigmiPendingAmtView');
				Route::get('/ReceivePigmiPendingAmtView/{id}','PigmiAllocationController@ReceivePigmiPendingAmtView');
				Route::post('/ReceivePigmyPendingAmt','PigmiAllocationController@ReceivePigmyPendingAmt');
				Route::get('/PigmySearchView','PigmiAllocationController@PigmySearchView');//M 20-4-2016 for PigmiAllocation
				Route::get('/ViewPigallocEdit/{id}','PigmiAllocationController@ViewPigallocEdit');//for edit of pigmi allocation
				Route::post('/editpigmialloc','PigmiAllocationController@editpigmialloc');//for edit button  of pigmi allocation
				Route::get('/AgentPigmyEntryView','PigmiAllocationController@AgentPigmyEntryView');//M 18-5-2016 for AgentEntryHome
				Route::get('/extraamt','PigmiAllocationController@extraamt');
				Route::get('/paybackamt/{id}','PigmiAllocationController@paybackamt');
				Route::get('/changepigmiagent','PigmiAllocationController@changepigmiagent');
				
				Route::get('/allcust','PigmiAllocationController@allcust'); 
				Route::get('/singlecust','PigmiAllocationController@singlecust'); 
				Route::post('/changeallcust','PigmiAllocationController@changeallcust'); 
				Route::get('/changesinglecust','PigmiAllocationController@changesinglecust'); 
				Route::get('/changesinglecustcheck','PigmiAllocationController@changesinglecustcheck');
				
				//prewithdrawalController
				Route::get('/prepigmiinterest','prewithdrawalController@prepigmiinterest');
				Route::post('/prepigmiwithdrawal','prewithdrawalController@prepigmiwithdrawal');
				Route::post('/prerdwithdrawal','prewithdrawalController@prerdwithdrawal');
				
				
				
				
				
				//ReportController
				Route::get('/sbreport','ReportController@index');
				Route::get('/RDreport','ReportController@RDReport');
				Route::get('/LoanReport','ReportController@LoanReport');
				//Route::get('/sbreport','ReportController@getpigmy_pigmialloc');
				Route::get('/pigmireport','ReportController@pigmi_report');
				Route::get('/getSearchsbaccount','ReportController@checkaccsb');
				Route::get('/getpigmyacc','ReportController@getpigmy_pigmialloc');
				Route::get('/getSBacc','ReportController@GetSbPerReport');
				Route::get('/getRDacc','ReportController@GetRdPerReport');  ///for rd
				Route::get('/getLoanacc','ReportController@GetLoanPerReport');  ///for rd
				Route::get('/PigmiBranchWiseReport','ReportController@PigmiBranchWiseReport');//for PIGMY BW REPORT
				Route::get('/SbBranchWiseReport','ReportController@SbBranchWiseReport');//for SB BW REPORT
				Route::get('/GetBranchAgentsDD','ReportController@GetBranchAgentsDD');
				Route::get('/GetPigmyTranBranchWiseData','ReportController@GetPigmyTranBranchWiseData');
				Route::get('/GetSbTranBranchWiseData','ReportController@GetSbTranBranchWiseData');
				Route::get('/GetRDTranBranchWiseData','ReportController@GetRDTranBranchWiseData');
				Route::get('/RDBranchWiseReport','ReportController@RDBranchWiseReport');//for RD BW REPORT
				Route::get('/FDBranchWiseReport','ReportController@FDBranchWiseReport');//for FD BW REPORT
				Route::get('/GetFDTranBranchWiseData','ReportController@GetFDTranBranchWiseData');
				//Route::get('/depositReport','ReportController@depositReport');
				Route::get('/depositReport','ReportController@depReport');
				Route::get('/pigmyreport_paid_unpaid','ReportController@pigmyreport_paid_unpaid');
				Route::get('/ClosedPigmyReport','ReportController@ClosedPigmyReport');// M 25-03
				Route::get('/GetPigmyEndReport','ReportController@GetPigmyEndReport');// M 25-03
				Route::get('/GetSbprintPerData','ReportController@GetSbprintPerData');// M 25-03
				Route::get('/passbookprint','ReportController@passbookprint');// M 25-03
				Route::get('/expenseReport','ReportController@expenseReport');// Expense REport
				
				Route::get('/GetExpenceBranchWiseData','ReportController@GetExpenceBranchWiseData');//T 28-04 FOR  expensereport
				Route::get('/ExpBankBranchWiseReport','ReportController@ExpBranchWiseReport');//pending
				
				Route::get('/getDepositBranchwiseData','ReportController@getDepositBranchwiseData');//T 05-05 FOR  depositreport
				Route::get('/AgentPigmiReportView','ReportController@AgentPigmiReportView');//M 19-05 FOR  AgentPigmiReportHome view
				Route::get('/GetAgentPigmiReportData','ReportController@GetAgentPigmiReportData');//M 19-05 FOR  AgentPigmiReport Search view
				Route::get('/PigmiagentWiseReport','ReportController@PigmiagentWiseReport');
				Route::get('/pigmiagenttotalamt','ReportController@pigmiagenttotalamt');
				
				Route::get('/alltranreport','ReportController@alltranreport');
				
				Route::get('/alltotalamt','ReportController@alltotalamt');
				
				Route::get('/allreport_headoff','ReportController@allreport_headoff');
				
				Route::get('/getallamount','ReportController@getallamount');
				
				Route::get('/closeaccount','ReportController@closeaccount');
				
				Route::get('/getallaccount','ReportController@getallaccount');
				
				Route::get('/pigmidirectclose/{id}','ReportController@pigmidirectclose');
				
				Route::get('/pigmidirectDelete/{id}','ReportController@pigmidirectDelete');
				
				
				
				//SearchController
				Route::get('/getplacc_partpayment','SearchController@getplacc_partpayment');
				Route::get('/getjlacc_partpayment','SearchController@getjlacc_partpayment');
				Route::get('/getslacc_partpayment','SearchController@getslacc_partpayment');
				Route::get('/getdlacc_partpayment','SearchController@getdlacc_partpayment');
				Route::get('/GetBranches','SearchController@GetBranch'); //Used As GTD(Global_Typeahead_Data)
				Route::get('/GetBranchForAddBank','SearchController@GetBranchForAddBank');
				Route::get('/GetMembers','SearchController@GetMember');
				Route::get('/Getacctyp','SearchController@Getacctype');
				Route::get('/Getuser','SearchController@Getusers');
				Route::get('/GetDesignation','SearchController@GetDesignation');
				Route::get('/Getaccnum','SearchController@Getaccountnum');//GTD
				Route::get('/GetAccountType','SearchController@GetPigmitype');
				Route::get('/GetAgentName','SearchController@GetAgent');
				Route::get('/GetCustomer','SearchController@Getusers');
				Route::get('/getAllocateagentlist','SearchController@getAllocagent');
				Route::get('/GetAlocatedAgent1','SearchController@GetAlocatedAgent1');
				Route::get('/getAllocatesaraparalist','SearchController@getAllocatesaraparalist');
				Route::get('/GetFdtype','SearchController@getFdType');
				Route::get('/Getrdaccnum','SearchController@getrdaccount');//GTD
				Route::get('/GetSearchAcc','SearchController@GetSeachedAcc');
				Route::get('/GetSearchOldAcc','SearchController@GetSeachedOldAcc');
				Route::get('/GetSearchpigmyAcc','SearchController@GetSeachedpigmyAccount');
				Route::get('/GetpigmyAcc1','SearchController@GetpigmyAcc');
				Route::get('/GetSearchSbAcc','SearchController@GetSeachedSbAccount');
				Route::get('/GetSearchRdAcc','SearchController@GetSeachedRdAccount'); ///for rd
				Route::get('/GetSearchLoanAcc','SearchController@GetSeachedLoanAccount'); ///for Loan
				Route::get('/GetLoanType','SearchController@getloantype');
				Route::get('/GetDLoanType','SearchController@GetDLoanType');//07-04-16 FOR DL ALLOCA
				//Route::get('/GetAccNum','SearchController@Getloanaccountnum'); it has to be change becz both root are same url
				Route::get('/GetBranchCode','SearchController@GetBranch');//GTD
				Route::get('/GetBank','SearchController@Getbank');
				Route::get('/GetMinorUser','SearchController@GetMinorUser');
				Route::get('/Getbranchname','SearchController@GetBranch');//GTD
				Route::get('/Getrdbranchname','SearchController@GetBranch');//GTD
				Route::get('/Getpgmbranchname','SearchController@GetBranch');//GTD
				Route::get('/Getlnbranchname','SearchController@GetBranch');//GTD
				Route::get('/GetlnAccNum','SearchController@GetLoanAcct');//GTD
				Route::get('/Getpigmyacct','SearchController@Getpigmyacct');// to get pigmy account number
				Route::get('/GetFDBranches','SearchController@GetBranchForFD');//modified GetBranch to GetBranchForAddBank
				Route::get('/GetFDAgent','SearchController@GetAgent');//for FD
				Route::get('/GetPigmyAccForPayAmt','SearchController@GetPigmyAccForPayAmt');//For PayAmt PigmyAccNum
				Route::get('/GetBankNameForPayAmt','SearchController@GetBankNameForPayAmt');//For PayAmt BankName
				Route::get('/GetPigmyNum','SearchController@GetPigmyNumForLoanAlloc');//For Create Loan Allocation
				Route::get('/GetRDNum','SearchController@GetRDNumForLoanAlloc');//For Create Loan Allocation
				Route::get('/GetFDNum','SearchController@GetFDNumForLoanAlloc');//For Fd Prewithdrawal
				Route::get('/GetFDNumber','SearchController@GetFDNumberForLoanAlloc');//For Create Loan Allocation
				Route::get('/Getrdprewithdrawaccnum','SearchController@getrdprewithdraw');//For Create Loan Allocation
				Route::get('/GetSalary','SearchController@GetSalary');
				Route::get('/pigmydlacc','SearchController@pigmydlacc'); 
				Route::get('/Getjewelcust','SearchController@Getjewelcust');
				Route::get('/GetBranchForExpense','SearchController@GetBranch');//for expense branch
				Route::get('/GetPigmyIntAccForPayAmt','SearchController@GetIntPigmyAccForPayAmt');
				Route::get('/GetBranchForExpenseTran','SearchController@GetBranch');
				Route::get('/GetRDAccForPayAmt','SearchController@GetRDAccForPayAmt'); 
				Route::get('/GetRDIntAccForPayAmt','SearchController@GetRDIntAccForPayAmt'); 
				Route::get('/GetFDAccForPayAmt','SearchController@GetFDAccForPayAmt'); 
				Route::get('/GetFDMatuAccForPayAmt','SearchController@GetFDMatuAccForPayAmt'); 
				Route::get('/GetSearchSbAccWithOldAcc','SearchController@GetSearchSbAccWithOldAcc');//31-03-16
				Route::get('/GetSearchRdAccWithOldAcc','SearchController@GetSearchRdAccWithOldAcc');//04-04-16
				Route::get('/GetSearchFdAccWithOldAcc','SearchController@GetSearchFdAccWithOldAcc');//04-04-16
				Route::get('/GetSearchPigmyAccWithOldAcc','SearchController@GetSearchPigmyAccWithOldAcc');//01-04-16
				Route::get('/PigmiAccountForAgent','SearchController@PigmiAccountForAgent');//M 20-05-16 for agent report TA
				Route::get('/GetEmpName1','SearchController@GetEmployeeName'); //for Staff loan Employee typeahead
				Route::get('/GetMembersForPersLoan','SearchController@GetMembersForPersLoan');
				Route::get('/GetSuretyName','SearchController@GetSuretyName');
				Route::get('/SearchCustomer','SearchController@SearchCustomer');//M 19-04-16 For Customer.blade
				Route::get('/SearchFdAllocation','SearchController@SearchFdAllocation');//M 19-04-16 For fdallocation.blade
				Route::get('/SearchMember','SearchController@SearchMember');//M 19-04-16 For member.blade
				Route::get('/SearchPurchaseShare','SearchController@SearchPurchaseShare');//M 19-04-16 For member.blade
				Route::get('/SearchPigmy','SearchController@SearchPigmy');//M 20-04-16 For pigmyallocation.blade
				Route::get('/SearchPigmyPay','SearchController@SearchPigmyPay');//M 20-04-16 For PigmyPayAmountHome.blade
				Route::get('/SearchRdPay','SearchController@SearchRdPay');//M 20-04-16 For RdPayAmountHome.blade
				Route::get('/SearchFdPay','SearchController@SearchFdPay');//M 20-04-16 For FdPayAmountHome.blade
				Route::get('/GetPayModes','SearchController@GetPayMode');//inhand
				Route::get('/getplacc','SearchController@getplacc');
				Route::get('/getjlacc','SearchController@getjlacc');
				Route::get('/getslacc','SearchController@getslacc');
				Route::get('/Getcertificatnum','SearchController@Getcertificatnum');
				Route::get('/RDdlacc','SearchController@RDdlacc');
				Route::get('/FDdlacc','SearchController@FDdlacc');
				Route::get('/FDdlacc_fd','SearchController@FDdlacc_fd');
				Route::get('/loan_pl','SearchController@loan_pl');
				Route::get('/loan_dl','SearchController@loan_dl');
				Route::get('/loan_jl','SearchController@loan_jl');
				Route::get('/loan_sl','SearchController@loan_sl');
				Route::get('/SBdlacc','SearchController@SBdlacc');
				Route::get('/fdCertTypeAhead','SearchController@fdCertTypeAhead');
				Route::get('/GetKCCtype','SearchController@GetKCCtype');
				Route::get('/GetSeachedpigmyAccinterest','SearchController@GetSeachedpigmyAccinterest');
				Route::get('/GetPigmyNumForDLAlloc','SearchController@GetPigmyNumForDLAlloc');
				Route::get('/GetRDNumForDLAlloc','SearchController@GetRDNumForDLAlloc');
				Route::get('/GetFDNumForDLAlloc','SearchController@GetFDNumForDLAlloc');
				Route::get('/Getjewelcustfromrequesttable','SearchController@Getjewelcustfromrequesttable');
				Route::get('/getjlaccsearch','SearchController@getjlaccsearch');
				Route::get('/getplaccsearch','SearchController@getplaccsearch');
				Route::get('/getslaccsearch','SearchController@getslaccsearch');
				Route::get('/getdlaccsearch','SearchController@getdlaccsearch');
				Route::get('/getuser_forloan','SearchController@getuser_forloan');
				Route::get('/FdClosedAcc_Unpaid','SearchController@FdClosedAcc_Unpaid');
				
				//SharesContoller
				Route::get('/shares','ShareController@Show_Shares');
				Route::get('/sharesdetail','ShareController@view_Shares');
				Route::post('/createshares','ShareController@create_Shares');
				Route::get('/requestshares','ShareController@request_Shares');
				Route::get('/GetMembersForPersLoanAlloc','SearchController@GetMembersForPersLoanAlloc');
				Route::get('/GetEmpNameForSLAlloc','SearchController@GetEmpNameForSLAlloc');
				
				Route::get('/sharetypeedit/{id}','ShareController@sharetypeedit');
				Route::post('/shareedit','ShareController@shareedit');
				Route::get('/divident','ShareController@divident');
				Route::get('/getdivident','ShareController@getdivident');
				Route::post('/adddivident','ShareController@adddivident');
				Route::get('/divident_amt_view','ShareController@divident_amt_view');
				Route::post('/edit_div_amt','ShareController@edit_div_amt');
				Route::post('/create_divident','ShareController@create_divident');
				Route::get('/divident_pay_list_get_branch','ShareController@divident_pay_list_get_branch');
				Route::post('/divident_pay_list_data','ShareController@divident_pay_list_data');
				Route::post('/pay_individual_divident','ShareController@pay_individual_divident');
				Route::post('/pay_individual_divident_view','ShareController@pay_individual_divident_view');
				Route::post('/pay_multiple_divident','ShareController@pay_multiple_divident');
				Route::get('/divident_report','ShareController@divident_report');
				Route::post('/divident_report_data','ShareController@divident_report_data');
				Route::post('/RetrieveMemData','ShareController@RetrieveMemData');//
				//	DIVIDENT TRAN GET MEMBER DATA
				Route::post('/CreateDividentTransaction','ShareController@CreateDividentTransaction');//MA 31-05-16 FOR DIVIDENTTRAN CREATE DIVIDENT TRANSACION
				
				
				//TransactionController
				Route::get('/Transaction','TransactionController@ShowTeller');// FOR TELLER>Teller
				Route::get('/DepTransaction','TransactionController@ShowDepTeller');//FOR DEPOSIT>Teller
				Route::get('/AccTransaction','TransactionController@ShowAccTeller');//FOR ACCOUNTS>Teller
				Route::post('/retriveacc','TransactionController@retrive_val');
				Route::post('/createtransaction','TransactionController@create_transaction');
				Route::get('/getAccountnumber','TransactionController@getaccnum');
				Route::get('/getAccholdername','TransactionController@getAcctholder');
				Route::post('/createpigmitransaction','TransactionController@createpigmitrans');
				Route::post('/AgentPigmiTransaction','TransactionController@AgentPigmiTransaction'); //M FOR AgentEntry
				Route::post('/retrieverdacc','TransactionController@retrive_rdval');
				Route::post('/createrdtransaction','TransactionController@createrdtrans');
				Route::post('/retrieveloanacc','TransactionController@Retrieve_Loaninfo');
				Route::post('/RetrieveSBAmt','TransactionController@RetriveSB_Amt');
				Route::post('/inserloantrans','TransactionController@Create_LoanTrans');
				Route::get('/TranReceiptHome','TransactionController@TranReceiptHome'); 
				Route::get('/TransactionReceiptView','TransactionController@TransactionReceiptView'); //M 23-06-16
				Route::get('/TranReceipt/{type}/{id}','TransactionController@TranReceipt'); 
				
				//UnclearedCheque Controller
				Route::get('/unclearsb','UnclearedChequeController@show_detail');
				Route::get('/unclearedcheque','UnclearedChequeController@show_uncleareddetail');
				Route::post('/clearcheque','UnclearedChequeController@cheque_clear');
				Route::post('/rejectcheque','UnclearedChequeController@cheque_reject');
				Route::get('/unclearrd','UnclearedChequeController@Show_RDDetail');
				Route::get('/rdclearcheque/{id}','UnclearedChequeController@rd_clear');
				Route::post('/rdrejectcheque','UnclearedChequeController@rd_reject');
				Route::get('/unclearpgm','UnclearedChequeController@Show_PgmDetail');
				Route::get('/pgmclearcheque/{id}','UnclearedChequeController@pigmi_clear');
				Route::post('/pgmrejectcheque','UnclearedChequeController@Pgm_Reject');
				Route::get('/unclearloan','UnclearedChequeController@show_loandetail');
				Route::get('/loanclearcheque/{id}','UnclearedChequeController@loan_clear');
				Route::post('/loanrejectcheque','UnclearedChequeController@loan_reject');
				Route::get('/unclearfd','UnclearedChequeController@Show_FDDetail');
				Route::get('/fdclearcheque/{id}','UnclearedChequeController@fd_clear');
				Route::post('/fdrejectcheque','UnclearedChequeController@fd_reject');
				//Route::get('/uncleardl','UnclearedChequeController@Show_DLDetail');
				Route::get('/unclearexp','UnclearedChequeController@Show_ExpenseDetail');
				Route::get('/expclearcheque/{id}','UnclearedChequeController@Expense_clear');
				Route::post('/exprejectcheque','UnclearedChequeController@Expense_Reject');
				Route::get('/AcceptCheque/{repayid}/{loannum}/{type?}','UnclearedChequeController@AcceptCheque');
				Route::get('/rejectDLCheque/{repayid}/{type?}','UnclearedChequeController@rejectDLCheque');
				
				
				//UserController
				Route::get('/user','UserController@show_user');
				Route::get('/ShowUserCreate','UserController@ShowUsers');
				Route::post('/updateuser','UserController@UpdateUser');
				Route::post('/createuser','UserController@CreateUser');
				Route::get('/userdetails/{id}/{type?}','UserController@Show_UserDetails');
				
				
				
				//ViewsharesController
				Route::get('/authmemb','ViewsharesController@show_shares');
				Route::get('/memberejectview','ViewsharesController@show_rejshares');
				Route::get('/acceptshares/{mid}/{purid}','ViewsharesController@accept_shares');
				Route::get('/acceptsuspendshares/{purid}','ViewsharesController@accept_suspendshares');
				Route::get('/membesuspendview','ViewsharesController@show_suspendedshares');
				Route::get('/rejectshare/{mid}/{purid}','ViewsharesController@reject_Shares');
				Route::get('/AcceptRejectedShare/{mid}/{purid}','ViewsharesController@AcceptRejectedShare');
				Route::get('/RejectSuspendShare/{purid}','ViewsharesController@RejectSuspendShare');
				Route::get('/autoriseindividualshares','ViewsharesController@autoriseindividualshares');
				
				
				
				//PayAmtController
				Route::get('/PayAmountIndex','PayAmtController@PayAmountIndex');
				Route::get('/PigmyPayAmountView','PayAmtController@PigmyPayAmountView');
				Route::get('/RdPayAmountView','PayAmtController@RdPayAmountView');
				Route::get('/FDPayAmountView','PayAmtController@FDPayAmountView');
				Route::post('/PigmyPayAmount','PayAmtController@PigmyPayAmount');
				Route::get('/GetPigmyDetailsForPayAmt','PayAmtController@GetPigmyDetailsForPayAmt');//For PayAmt PigmyAccNum
				Route::get('/GetBankDetailsForPayAmt','PayAmtController@GetBankDetailsForPayAmt');//For PayAmt PigmyAccNum
				Route::get('/PigmyPayAmountReceipt/{id}','PayAmtController@PigmyPayAmountReceipt');//For PayAmt
				Route::get('/RdPayAmountReceipt/{id}','PayAmtController@RdPayAmountReceipt');//For PayAmt M 13-4-16
				Route::get('/FdPayAmountReceipt/{id}','PayAmtController@FdPayAmountReceipt');//For PayAmt M 15-4-16
				//Route::get('/PigPayMaxRecNum','PayAmtController@PigPayMaxRecNum');//For PayAmt PigmyAccNum
				//Route::post('/UpdatePigmyReceiptNo','PayAmtController@UpdatePigmyReceiptNo');//For PayAmt PigmyAccNum
				//Route::post('/UpdateRdReceiptNo','PayAmtController@UpdateRdReceiptNo');//For PayAmt M 13-4-16 
				//Route::post('/UpdateFdReceiptNo','PayAmtController@UpdateFdReceiptNo');//For PayAmt M 15-4-16 
				Route::get('/GetBankNameForRDPayAmt','PayAmtController@GetBankDetailsForPayAmt');//For RD PayAmt PigmyAccNum
				Route::post('/GetSBForPigmiPayAmt','PayAmtController@GetSBForPayAmt');//For PayAmt SB Cheque (Newly Added)
				Route::get('/GetPigmyIntDetailsForPayAmt','PayAmtController@GetPigmyIntDetailsForPayAmt');//For PayAmt get Interest Detail (Newly Added)
				Route::get('/RDPayAmountIndex','PayAmtController@RDPayAmountIndex');//For RD Pay Amount Home
				Route::get('/FDPayAmountIndex','PayAmtController@FDPayAmountIndex');//For FD Pay Amount home
				Route::get('/GetRDIntDetailsForPayAmt','PayAmtController@GetRDIntDetailsForPayAmt');//For PayAmt get Interest Detail
				Route::get('/GetRDDetailsForPayAmt','PayAmtController@GetRDDetailsForPayAmt');//For PayAmt get perwithdraw Detail	
				Route::post('/GetSBForRDPayAmt','PayAmtController@GetSBForRDPayAmt');//For PayAmt get perwithdraw Detail 
				Route::post('/RDPayAmount','PayAmtController@RDPayAmount');
				Route::post('/GetSBForFDPayAmt','PayAmtController@GetSBForFDPayAmt');
				Route::get('/GetFDMatuDetailsForPayAmt','PayAmtController@GetFDMatuDetailsForPayAmt');
				Route::get('/GetFDDetailsForPayAmt','PayAmtController@GetFDDetailsForPayAmt');
				Route::post('/FDPayAmount','PayAmtController@FDPayAmount');
				Route::post('/FDPayAmount','PayAmtController@FDPayAmount');
				Route::get('/PigmyPaySearchView','PayAmtController@PigmyPaySearchView');//M 20-4-16
				Route::get('/RdPaySearchView','PayAmtController@RdPaySearchView');//M 20-4-16
				Route::get('/FdPaySearchView','PayAmtController@FdPaySearchView');//M 20-4-16
				
				
				
				//RequestLoan Controller
				Route::get('/ReqPersonalLoan','RequestLoanController@RequestPersLoan');
				Route::get('/GetBranchIDForReqLoan','RequestLoanController@GetBranchIDForDL');
				Route::post('/ReqPersLoanAllocation','RequestLoanController@ReqPersLoanAllocation');
				Route::post('/GetMemSBDetailReq','RequestLoanController@GetMemSBDetailReq');
				//Route::get('/GetPersLoantype','RequestLoanController@GetPersLoantype');
				Route::get('/GetJltype','RequestLoanController@GetJltype');
				Route::get('/RequestLoan','RequestLoanController@RequestLoan');
				
				Route::get('/GetPersLoantype','SearchController@getloantype');//just added 04-07-2017
				
				
				//salarycontroller
				Route::get('/salary','salcontroller@showsal');
				Route::get('/salcreate','salcontroller@show_salcreate');
				Route::post('/getsal','salcontroller@get_saldet');
				Route::post('/salaryinsert','salcontroller@create_sal');
				Route::get('/getloandetaiforsalary','salcontroller@getloandetaiforsalary');
				Route::get('/salagent','salcontroller@salagent');
				Route::get('/RDagent','salcontroller@RDagent');
				Route::get('/sarapara','salcontroller@sarapara');
				Route::post('/payagentcommision','salcontroller@payagentcommision');
				Route::get('/getagentsalary','salcontroller@getagentsalary');
				Route::get('/getagentsalary_1','salcontroller@getagentsalary_1');
				Route::get('/getsaraparasalary','salcontroller@getsaraparasalary');
				Route::get('/getrdagentsalary','salcontroller@getrdagentsalary');
				
				
				
				//ShareReceiptController //pending work
				Route::get('/ShareReceipt','ShareReceiptController@ShareReceipt_Home');
				Route::get('/ShowCreateShareReceipt','ShareReceiptController@ShowCreateShareReceipt');
				
				
				
				//DepositeLedgerContoller
				Route::get('/SbLedgerIndex','DepositeLedgerController@SbLedgerIndex');
				Route::get('/RdLedgerIndex','DepositeLedgerController@RdLedgerIndex');//04-04-16
				Route::get('/FdLedgerIndex','DepositeLedgerController@FdLedgerIndex');//04-04-16
				Route::get('/PigmiLedgerIndex','DepositeLedgerController@PigmiLedgerIndex');//01-04-16
				Route::get('/GetSbLedgerPerData','DepositeLedgerController@GetSbLedgerPerData');
				Route::get('/GetRdLedgerPerData','DepositeLedgerController@GetRdLedgerPerData');//04-04-16
				Route::get('/GetFdLedgerPerData','DepositeLedgerController@GetFdLedgerPerData');//04-04-16
				Route::get('/GetPigmiLedgerPerData','DepositeLedgerController@GetPigmiLedgerPerData');
				
				
				
				//DLRepayment Controller
				Route::get('/pigmiDLPigmy','DLRepaymentController@pigmiDLPigmy');
				Route::post('/GetDLDetail','DLRepaymentController@GetDLDetail');
				Route::post('/GetFDDetail','DLRepaymentController@GetFDDetail');
				Route::post('/CalcDayDiff','DLRepaymentController@CalcDayDiff');
				Route::post('/GetPygmyAccDetail','DLRepaymentController@GetPygmyAccDetail');
				Route::post('/GetSBAccDetail','DLRepaymentController@GetSBAccDetail');
				Route::post('/createPigmyDL','DLRepaymentController@createPigmyDL');
/*****************************/
				Route::post('/dateComp','DLRepaymentController@dateComp');
				Route::post('/dateDiff','DLRepaymentController@dateDiff');
/*****************************/
				
				//Expense Head
				Route::get('/ExpenseHead','ExLedgerController@show_led');
				Route::post('/Exaddledger','ExLedgerController@create_led');
				Route::post('/Exaddsubled','ExLedgerController@create_ledger');
				
				//LEDGER Head
				Route::get('/ledger','ledgercontroller@show_led');
				Route::post('/addledger','ledgercontroller@create_led');
				Route::post('/addsubled','ledgercontroller@create_ledger');
				Route::post('/updateledger','ledgercontroller@Updateledger');
				Route::get('/ledgerReport','ledgercontroller@ledgerReport');
				Route::get('/balanceSheet','ledgercontroller@balanceSheet');
				Route::get('/ledgerdetails/{id}/{type?}','ledgercontroller@Show_ledgerDetails');
				
				Route::get('/LedSingleDetails/{id}','ledgercontroller@LedSingleDetails');
				
				Route::get('/create_head_subhead','ledgercontroller@create_head_subhead');
				Route::Post('/GetFieldNames','ledgercontroller@GetFieldNames');
				Route::Post('/create_all_head_subhead','ledgercontroller@create_all_head_subhead');
				Route::Post('/gernalentry','ledgercontroller@gernalentry');
				Route::get('/Journal_entry','ledgercontroller@Journal_entry');
				
				
				//SMS Subscription
				Route::get('/sms','SmsSubscriptionController@Subscription');
				Route::post('/SmsSubscription','SmsSubscriptionController@entry');
				
				//ReveresEntryController
				Route::get('/reveresentry','ReveresEntryController@reveresentry');
				Route::get('/reversentryindex','ReveresEntryController@reversentryindex');
				Route::post('/reversentrysb','ReveresEntryController@reversentrysb');
				Route::get('/reversentryindexpigmy','ReveresEntryController@reversentryindexpigmy');
				Route::post('/reversentrypigmy','ReveresEntryController@reversentrypigmy');
				Route::get('/reversentryindexrd','ReveresEntryController@reversentryindexrd');
				Route::post('/reversentryrd','ReveresEntryController@reversentryrd');
				Route::post('/UpdateCompanyModel','CompanyController@unable');
				Route::post('/UpdateBranchModel','BranchController@onoff');
				//LoanReportBranch
				Route::get('/LoanReportBranch','ReportController@LoanReportBranch');// T //19-5
				Route::get('/GetLoanBranchWiseData','ReportController@GetLoanBranchWiseData');// T //19-5
				//INCOME REPORT
				Route::get('/IncomeReport','ReportController@IncomeReport');// T //10-6
				Route::get('/GetIncomeBranchWiseData','ReportController@GetIncomeBranchWiseData');// T //10-6
				//PIGMY CUSTOMER REPORT
				Route::get('/PigmyCustomer','ReportController@PigmyCustomer');// T //26/04/2016
				Route::get('/GetPigmyCustPerData','ReportController@GetPigmyCustPerData');// T //26/04/2016
				
				//AGENT DATA DOWNLOAD
				Route::get('/AgentDataDownload','AgentCommisionController@AgentDataDownload');
				Route::post('/agentdownloadsubmit','AgentCommisionController@agentdownloadsubmit');
				
				//AGENT DATA UPLOAD
				Route::get('/AgentDataUpload','AgentCommisionController@AgentDataUpload');
				//LOAN REPAYMENT
				Route::get('/pigmiDLPigmy','DLRepaymentController@pigmiDLPigmy');
				Route::post('/GetDLDetail','DLRepaymentController@GetDLDetail');
				Route::post('/CalcDayDiff','DLRepaymentController@CalcDayDiff');
				Route::post('/jlCalcDayDiff','DLRepaymentController@jlCalcDayDiff');
				Route::post('/GetPygmyAccDetail','DLRepaymentController@GetPygmyAccDetail');
				Route::post('/GetSBAccDetail','DLRepaymentController@GetSBAccDetail');
				Route::post('/createPigmyDL','DLRepaymentController@createPigmyDL');
				Route::post('/DLRepayGetSBDetails','DLRepaymentController@DLRepayGetSBDetails');
				Route::post('/DLRepayGetFDDetails','DLRepaymentController@DLRepayGetFDDetails');
				Route::post('/GetplDetail','DLRepaymentController@GetplDetail');
				Route::post('/PersonalLoanRepay','DLRepaymentController@PersonalLoanRepay');
				Route::post('/GetjlDetail','DLRepaymentController@GetjlDetail');
				Route::post('/JewelLoanRepay','DLRepaymentController@JewelLoanRepay');
				Route::post('/GetslDetail','DLRepaymentController@GetslDetail');
				Route::post('/StaffLoanRepay','DLRepaymentController@StaffLoanRepay');
				Route::get('/LoanReportAll','DLRepaymentController@LoanReportAll');
				Route::get('/GetLoanAll','DLRepaymentController@GetLoanAll');
				
				Route::get('/loanrepayReceipt/{id}','DLRepaymentController@loanrepayReceipt');
				Route::get('/DLloanrepayReceipt/{id}','DLRepaymentController@DLloanrepayReceipt');
				Route::post('/DLRepayGetPgmDetails','DLRepaymentController@DLRepayGetPgmDetails');
				
				Route::post('/createDL_renew','DLRepaymentController@createDL_renew');
				Route::post('/DL_Renew_Allocation','DLRepaymentController@DL_Renew_Allocation');
				Route::post('/JewelLoanRepay_renewal','DLRepaymentController@JewelLoanRepay_renewal');
				
				//share details
				Route::get('/ShareReport','ReportController@ShareReport');// T //10-6
				Route::post('/shareedit','ShareController@shareedit');
				//Route::get('/ShareReport','ReportController@ShareReport');// T //10-6
				Route::get('/sharetypeedit/{id}','ShareController@sharetypeedit');
				//agent data upload
				Route::post('/agentUploadsubmit','AgentCommisionController@agentUploadsubmit');
				
				
				
			}); //group 'middleware' => 'revalidate' function ends here
		});		//group 'middleware' => 'auth' function ends here
		
		//API CONTROLLER
		Route::post('/authenticatemob','AuthenticatemobController@authenticate');
		Route::get('/getcustomer','APIController@getcustomer');
		Route::get('/getpigmydetails','APIController@getpigmydetails');
		Route::post('/pigmytransaction','APIController@pigmytransaction');
		Route::get('/agentprofile','APIController@agentprofile');
		Route::post('/changepass','APIController@changepass');
		Route::get('/pigmycustreport','APIController@pigmycustreport');
		Route::get('/pigmyagentreport','APIController@pigmyagentreport');
		
		
		
		
		
		//import
		Route::get('/import','ImportController@import');
		
		//jewelLoan Report
		Route::get('/jewelLoanPendingReport','LoanController@jewelLoanPendingReport');
		Route::get('/sendToJewelAuction','LoanController@sendToJewelAuction');
		Route::get('/jewelAuctionList','LoanController@jewelAuctionList');
		Route::get('/jewelAuction','LoanController@jewelAuction');
	/*	Route::get('/jewelAuctionPayDetails','LoanController@jewelAuctionPayDetails');*/
		Route::get('/jewelAuctionPay','LoanController@jewelAuctionPay');
		Route::get('/jewelAuctionExtraAmount','LoanController@jewelAuctionExtraAmount');
		Route::get('/jewelAuctionExtraAmountPayDetails','LoanController@jewelAuctionExtraAmountPayDetails');
		
		
/*******************************/
		Route::post('/jl_first_repay','DLRepaymentController@jl_first_repay');
		
		Route::match(["get","post"],'/cdreport','LoanController@cdreport');
		Route::get('/sdreport','LoanController@sdreport');
		Route::match(["get","post"],'/loan_pending_report','LoanController@loan_pending_report');
		Route::get('/create_head_subhead','ledgercontroller@create_head_subhead');
		Route::match(["get","post"],'/update_head_subhead','ledgercontroller@update_head_subhead');
		
		Route::post('edit_jl_net_wt','LoanController@edit_jl_net_wt');
/*******************************/

//	CLEAR CACHE
		Route::get('/cache', function() {
			return view('cache');
		});
		Route::get('/clear-cache', function() {
			$exitCode = Artisan::call('cache:clear');
			$exitCode = Artisan::call('view:clear');
			// return what you want
		});
		
		
		
	});				//group 'prefix' => '/' function ends here										