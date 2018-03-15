<script src="js/pace.min.js"></script>

<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/daterangepicker.css" rel="stylesheet">
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>LOAN ALLOCATION DETAILS</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					
					<form method="POST" action="http://localhost:8000/crtloanallocation" accept-charset="UTF-8" class="form-horizontal" id="form_stfloanalloc" enctype="multipart/form-data"><input name="_token" value="JJbYYs5X7TfRMYIdXZhzShOTNcHog4vdG8HkCmiO" type="hidden">
						
						
						
						<div class="StaffLoan">
							<div class="form-group">
								
								<div class="col-md-6 alert-success">
									<div class="row">
										
										<div class="form-group">
											<label class="control-label col-sm-4">Employee Name:</label>
											<div id="the-basics" class="col-sm-6">
												<input class="StfEmpnameTypeahead form-control" placeholder="SELECT EMPLOYEE NAME" id="StfEmpname" type="text"> 
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Loan Type:</label>
											<div class="col-sm-6">
												<input class="form-control" placeholder="ENTER LOAN TYPE" id="StfLoanType" name="StfLoanType" type="text">  
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Branch Name:</label>
											<div class="col-sm-6">
												<input class="form-control" id="StfLoanBranch" name="StfLoanBranch" type="text">  
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Employee Type:</label>
											<div class="col-md-6">
												<input class="form-control" id="Stfemptype" name="Stfemptype" placeholder="EMPLOYEE TYPE" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Employee Salary:</label>
											<div class="col-md-6">
												<input class="form-control" id="Stfempsal" name="Stfempsal" placeholder="EMPLOYEE SALARY" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Work Experience:</label>
											<div class="col-md-6">
												<input class="form-control" id="Stfempwrkexp" name="Stfempwrkexp" placeholder="WORK EXPERIENCE" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Amount to Pay:</label>
											<div class="col-md-6">
												<input class="form-control" id="Stfamttopay" name="Stfamttopay" placeholder="AMOUNT TO PAY" type="text">
											</div>
										</div>
										
										
										<div class="form-group">
											<label class="control-label col-sm-4">Compulsory Deposite:</label>
											<div class="col-md-6">
												<input class="form-control" id="Compulsory_Deposit" name="Compulsory_Deposit" placeholder="Compulsory Deposite" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Other Charge(%):</label>
											<div class="col-md-6">
												<input class="form-control" id="StfOthrChrge" name="StfOthrChrge" placeholder="OTHER CHARGE" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Book and Forms Charge(%):</label>
											<div class="col-md-6">
												<input class="form-control" id="StfBkfrmChrg" name="StfBkfrmChrg" placeholder="BOOK AND FORMS CHARGE" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Share Charge:</label>
											<div class="col-md-6">
												<input class="form-control" id="staffcharge" name="staffcharge" placeholder="SHARE CHARGE"type="text">
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-6 alert-success">
									<div class="row">
										
										
										<div class="form-group">
											<label class="control-label col-sm-4">Payable Amount:</label>
											<div class="col-md-6">
												<input class="form-control" id="StfPayAmt" name="StfPayAmt" placeholder="PAYABLE AMOUNT" type="text">
											</div>
										</div>
										
										
										
										
										<!--<div class="form-group">
											<label class="control-label col-sm-4">Loan Duration:</label>&nbsp&nbsp&nbsp
											<label class="radio-inline"><input type="radio" id="DurRad1" name="DurRad">Days</label>&nbsp
											<label class="radio-inline"><input type="radio" id="DurRad2" name="DurRad">Years</label>
										</div>-->
										
										
										<div class="form-group DurTextDay">
											<label class="control-label col-sm-4">Days:</label>
											<div class="col-md-6">
												<input class="form-control" id="LoanDurationDays" name="LoanDurationDays" placeholder="ENTER DAYS" <!--onblur="calcenddate();-->" type="text">
												
											</div>
										</div>
										
										<div class="form-group DurTextYear">
											<label class="control-label col-sm-4">Years:</label>
											<div class="col-md-6">
												<input class="form-control" id="LoanDurationYears" name="LoanDurationYears" placeholder="ENTER YEARS" <!--="" onblur="StfEndDate();" onkeyup="CalcDays();-->" type="text">
												
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Loan Witness</label>
											<div id="the-basics" class="col-sm-6">
												<input class="StfWitnessTypeAhead form-control" placeholder="SELECT WITNESS NAME" id="StfWitness" type="text"><ul class="typeahead dropdown-menu"></ul>  
											</div>
										</div>
										
										
										
										
										<div class="form-group">
											<label class="control-label col-sm-4">Start Date:</label>
											<div class="col-md-6">
												<input class="form-control" id="StfLoanStartDate" name="StfLoanStartDate" value="03-05-2016" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">End Date:</label>
											<div class="col-md-6">
												<input class="form-control" id="StfLoanEndDate" name="StfLoanEndDate" placeholder="ENTER END DATE" type="text">
											</div>
										</div>
										
										
										
										
										<div class="form-group">
											<label class="control-label col-sm-4">Payment Mode:</label>
											<div class="col-md-6">
												<select class="form-control" id="StfLoanPayMode" name="StfLoanPayMode">
													<option value="">--Select Payment Mode--</option>
													<option value="CASH">CASH</option>
													<option value="CHEQUE">CHEQUE</option>
													<option value="SB ACCOUNT">SB ACCOUNT</option>
												</select>
											</div>
										</div>
										
										<div style="display: none;" class="form-group sbaccnumb">
											<label class="control-label col-sm-4">SB Account Number:</label>
											<div class="col-md-6">
												<input class="form-control" id="SfLoanSBAcNumReadOnly" name="SfLoanSBAcNumReadOnly" disabled="" type="text">
											</div>
										</div>
										<input class="form-control hidden" id="StfLoanSBAcNum" name="SfLoanSBAcNum" type="text">
										
										
										<div style="display: none;" class="form-group sbavailable">
											
											<label class="control-label col-sm-4">SB Available Amount:</label>
											<div class="col-md-6">
												<input class="form-control" id="StfSBAvailReadOnly" name="StfSBAvailReadOnly" disabled="" type="text">
											</div>
										</div>
										<input class="form-control hidden" id="StfSBAvail" name="StfSBAvail" type="text">
										<div style="display: none;" class="form-group sbtotamt">
											
											<label class="control-label col-sm-4">SB Total Amount:</label>
											<div class="col-md-6">
												<input class="form-control" id="StfLoanSBtotalReadOnly" name="StfLoanSBtotalReadOnly" disabled="" type="text">
											</div>
										</div>
										<input class="form-control hidden" id="StfLoanSBtotal" name="StfLoanSBtotal" type="text">
										
										<div style="display: none;" class="StfLoanCheque">
											
											<div class="form-group chequenum">
												
												<label class="control-label col-md-4">Cheque Number:</label>
												<div class="col-md-6">
													<input class="form-control" id="StfLoanChequeNum" name="StfLoanChequeNum" placeholder="CHEQUE NUMBER" type="text">
												</div>
											</div>
											
											
											<div class="form-group chequedte">
												<label class="col-md-4 control-label">CHEQUE DATE</label>
												<div class="col-md-6 date">
													
													<div class="input-group input-append">
														<input name="StfLoanChequeDte" id="StfLoanChequeDte" class="form-control" value="" type="text">
														<span class="input-group-addon add-on">
															<span class="glyphicon glyphicon-calendar">
															</span>
															<b class="caret"></b>
														</span> 
													</div>
													
												</div>
											</div>
											
											
											
											<div class="form-group bnknme">
												<label class="control-label col-md-4">Bank Name:</label>
												<div class="col-md-6">
													<input class="form-control StfLoanBankNameTypeAhead" id="StfLoanBankName" name="StfLoanBankName" placeholder="SELECT BANK" type="text"><ul class="typeahead dropdown-menu"></ul>
												</div>
											</div>
											
											
											<div class="form-group bnkbranch">
												<label class="control-label col-md-4">Bank Branch:</label>
												<div class="col-md-6">
													<input class="form-control" id="StfLoanBankBranch" name="StfLoanBankBranch" placeholder="BANK BRANCH" disabled="" type="text">
												</div>
											</div>		
											
											
											<div class="form-group ifsccde">
												<label class="control-label col-md-4">IFSC Code:</label>
												<div class="col-md-6">
													<input class="form-control" id="StfLoanIFSC" name="StfLoanIFSC" placeholder="IFSC CODE" disabled="" type="text">
												</div>
											</div>
											
											
											<div class="form-group ifsccde">
												<label class="control-label col-md-4">Account Number:</label>
												<div class="col-md-6">
													<input class="form-control" id="StfLoanBankAccNumber" name="StfLoanBankAccNumber" placeholder="ACCOUNT NUMBER" disabled="" type="text">
												</div>
											</div>
											
											
										</div> <!--alert-success for PigmyPayAmt Cheque ends-->
										
										
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="staffuid" name="staffuid" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="staffbid" name="staffbid" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="staffduration" name="staffduration" type="text">
										</div>
										<div class="col-md-4 hidden">
											<input class="form-control" id="staffloanid" name="staffloanid" type="text">
										</div>
										
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="lnmonth" name="lnmonth" value="12" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="Stfacval" name="Stfacval" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="uid" name="uid" type="text">
										</div>
										<div class="col-md-4 hidden">
											<input class="form-control" id="joindate" name="joindate" type="text">
										</div>
										
										
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="YearInDays" name="YearInDays" value="365" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfLoanChequeState" name="StfLoanChequeState" value="CLEARED" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfLoanInhand" name="StfLoanInhand" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfLoanSBAccid" name="StfLoanSBAccid" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfLoanSBAccTid" name="StfLoanSBAccTid" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfFName" name="StfFName" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfMName" name="StfMName" type="text">
										</div>
										
										<div class="col-md-4 hidden">
											<input class="form-control" id="StfLName" name="StfLName" type="text">
										</div>
										
										
										
										
										
										
									</div>
								</div>
								
								
								
							</div>
						</div>
						<div class="alert alert-success col-md-12">
							<div class="row">
								
								
								<div class="col-md-6">
									<div class="row table-row">
										<div class="col-md-4">
											
											<div class="form-group">
												<label class="control-label col-md-2">Security1:</label>
												<div class="col-md-8">
													<br><br><br>
													<input id="stfsec1" name="stfsec1" accept="image/*" onchange="loadFile1(event)" type="file">
												</div>
											</div>
											
										</div>
										
										<div class="col-md-8">
											
											<img id="stfsecurity1" height="150" width="250"><br>
											
										</div>
										
									</div>
								</div>
								
								
								<div class="col-md-6">
									<div class="row table-row">
										<div class="col-md-4">
											
											<div class="form-group">
												<label class="control-label col-md-2">Security2:</label>
												<div class="col-md-8">
													<br><br><br>
													<input id="stfsec2" name="stfsec2" accept="image/*" onchange="loadFile2(event)" type="file">
												</div>
											</div>
										</div>
										
										<div class="col-md-8">
											<img id="stfsecurity2" height="150" width="250"><br>
										</div>
										
									</div>
								</div>
								
							</div>
							
							
							<br>
							
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="row table-row">
										<div class="col-md-4">
											
											<div class="form-group">
												<label class="control-label col-md-2">Security3:</label>
												<div class="col-md-8">
													<br><br>
													<input id="stfsec3" name="stfsec3" accept="image/*" onchange="loadFile3(event)" type="file">
												</div>
											</div>
										</div>
										
										<div class="col-md-8">
											<img id="stfsecurity3" height="150" width="130"><br>
										</div>
										
									</div>
								</div>
								
								
								<div class="col-md-6">
									<div class="row table-row">
										<div class="col-md-4">
											
											<div class="form-group">
												<label class="control-label col-md-2">Security4:</label>
												<div class="col-md-8">
													<br><br>
													<input id="stfsec4" name="stfsec4" accept="image/*" onchange="loadFile4(event)" type="file">
												</div>
											</div>
										</div>
										
										<div class="col-md-8">
											<img id="stfsecurity4" height="150" width="250"><br>
										</div>
										
									</div>
								</div>
								
							</div>
							
						</div> 
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input value="CREATE" class="btn btn-success btn-sm StfSbmBtn" type="button">
									<input value="CANCEL" class="btn btn-danger btn-sm cnclbtn" type="button">
									
								</div>
							</div>
						</center><!--Deposite Loan Allocation Detail ends-->
						
						
						
						
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	//$('document').ready(function(){
	
	//$('.DurTextDay').hide();
	//$('.DurTextYear').hide();
	$('.StfLoanCheque').hide();
	$('.sbavailable').hide();
	$('.sbaccnumb').hide();
	$('.sbtotamt').hide();
	
	
	//});
	
	/*$('input.StfLoanTTypeAhead').typeahead({
		ajax: '/GetLoanType'
	});*/
	
	//Get Branch
	/*$('input.StfBranchTypeAhead').typeahead({
		ajax:'/GetBranchCode'
	});*/
	
	$('input.StfEmpnameTypeahead').typeahead({
		
		ajax:'/GetEmpNameForSLAlloc'
		
	});
	
	//To get Employee Detail when Employee name is selected
	
	/*	$('.StfEmpnameTypeahead').change(function(e){
		usr=$('.StfEmpnameTypeahead').data('value');
		$.ajax({
		url:'/CheckSBForStaff',
		type:'post',
		data:'&usrid='+usr,
		success:function(data)
		{
		$('#Stfacval').val(data['acn']);
		acval=$('#Stfacval').val();
		if(acval==1)
		{
		alert("This Staff Does not have SB Account");
		$('#Stfacval').val("");
		//$('.accclassid').click();
		}
		}
		});
		$.ajax({
		url:'/GetEmployeeDetail',
		type:'post',
		data:'&usrid='+usr,
		success:function(data)
		{
		$('#Stfemptype').val(data['emptype']);
		$('#joindate').val(data['joindte']);
		$('#Stfempsal').val(data['sal_amt']);
		jdte=$('#joindate').val();
		sal=$('#Stfempsal').val();
		emp_sal=parseFloat(sal);
		payamt=emp_sal*20;
		$('#StfPayAmt').val(payamt);
		}
		});
		
		$.ajax({
		url:'/StaffGetDiffYear',
		type:'post',
		data:'&jDate='+jdte,
		success:function(data)
		{
		yearDiff=data;
		//alert(yearDiff);
		$('#Stfempwrkexp').val(yearDiff);
		}
		});
		
		$.ajax({
		url:'/GetCharges',
		type:'get',
		success:function(data)
		{
		$('#StfOthrChrge').val(data['other_charge']);
		$('#StfBkfrmChrg').val(data['book_form']);
		$('#StfAdjCharge').val(data['adj_charge']);
		}
		});
	});*/
	
	function GetLoanCharge()
	{
		LoanAmt=$('#StfLoanAmt').val();
		Othrchrg=$('#StfOthrChrge').val();
		BkfrmChrg=$('#StfBkfrmChrg').val();
		AdjChrg=$('#StfAdjCharge').val();
		TotOthrchrg=((LoanAmt*Othrchrg)/100);
		//alert(TotOthrchrg);
		TotBkfrmChrg=((LoanAmt*BkfrmChrg)/100);
		//alert(TotBkfrmChrg);
		TotAdjChrg=((LoanAmt*AdjChrg)/100);
		//alert(TotAdjChrg);
		ShareChrg=$('#StfShrChrg').val();
		amt=(parseFloat(TotOthrchrg)+parseFloat(TotBkfrmChrg)+parseFloat(TotAdjChrg)+parseFloat(ShareChrg));
		amttopay=LoanAmt-amt;
		$('#Stfamttopay').val(amttopay);
		//Lnamt=$('#PersLoanAmt').val();
		incash1=$('#StfLoanInhand').val();
		//alert(incash1);
		incash=(parseFloat(incash1));
		if(LoanAmt>=incash)
		{
			alert("Your InHandCash is low. Your Balance is:"+incash);
		}
		
		Amount=(parseFloat(LoanAmt));
		if(Amount>50000)
		{
			alert("Loan Amount is Greater than 50,000. So, Please Collect Required Documents From Customer");
		}
		if(Amount>20000)
		{
			alert("Loan Amount is Greater than 20,000. So, Please Transfer amount to Staff SB Account");
		}
		payable=$('#StfPayAmt').val();
		payableamt=parseFloat(payable);
		if(Amount>payableamt)
		{
			alert("Loan Amount Should be Less than Payable Amount");
		}
	}
	
	
	$('#DurRad1').click(function(e)
	{
		
		$('.DurTextDay').show();
		$('.DurTextYear').hide();
		$('#LoanDurationYears').val("");
		
	});
	
	$('#DurRad2').click(function(e)
	{
		$('.DurTextDay').hide();
		$('.DurTextYear').show();
		$('#LoanDurationDays').val("");
		
	});
	
	function CalcDays()
	{
		DurYear=$('#LoanDurationYears').val();
		YearDay=$('#YearInDays').val();
		YearConv=(DurYear*YearDay);
		$('#LoanDurationDays').val(YearConv);
	}
	
	//End Date For Personal Loan (Year wise calculation)
	/*	function StfEndDate(){
		var year=$('#LoanDurationYears').val();
		var month=year*12;
		var start_date = document.getElementById('StfLoanStartDate').value;
		var c_start_date = start_date.split('-').reverse().join('-');;
		var c_start_date_obj = new Date(c_start_date);
		var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(month), c_start_date_obj.getDate());
		var c = (c_end_date_obj.getMonth())+1;
		var c_end_date = c_end_date_obj.getDate() + '-' + c + '-' + c_end_date_obj.getFullYear();
		document.getElementById('StfLoanEndDate').value = c_end_date;
		}
		
		
		function calcenddate(){
		
		
		var days = $('#LoanDurationDays').val();
		var now = new Date();
		
		now = new Date(new Date().getTime()+(days*24*60*60*1000))
		
		var dd = now.getDate();
		var mm = now.getMonth()+1;//January is 0!
		var yyyy = now.getFullYear();
		
		if(dd<10){dd='0'+dd}
		if(mm<10){mm='0'+mm}
		
		var newDate = dd+'-'+mm+'-'+yyyy;
		document.getElementById('StfLoanEndDate').value = newDate;
		
		
		}
	*/
	//Get Loan Witness
	$('input.StfWitnessTypeAhead').typeahead({
		//ajax:'/GetSuretyName'
		ajax:'/GetSuretyName'
		
	});
	
	//To check whether Surety Have SB Account
	$('.StfWitnessTypeAhead').change(function(e){
		usr=$('.StfWitnessTypeAhead').data('value');
		$.ajax({
			url:'/CheckSBForStaff',
			type:'post',
			data:'&usrid='+usr,
			success:function(data)
			{
				$('#Stfacval').val(data['acn']);
				acval=$('#Stfacval').val();
				if(acval==1)
				{
					alert("This Surety Staff Does not have SB Account");
					$('#Stfacval').val("");
					//$('.accclassid').click();
				}
			}
		});
	});
	
	//PaymentMode Changed (Newly Added)
	$('#StfLoanPayMode').change( function(e) {
		e.preventDefault();
		mode=$('#StfLoanPayMode').val();
		if(mode=="CASH")
		{
			$('.StfLoanCheque').hide();
            $('.StfLoanChequeDte').hide();
            $('.StfLoanChequeNum').hide();
			$('.StfLoanBankName').hide();
            $('.StfLoanBankBranch').hide();
            $('.StfLoanIFSC').hide();
			$('.sbavailable').hide();
			$('.sbaccnumb').hide();
			$('.sbtotamt').hide();
            
		}
		else if(mode=="CHEQUE"){
			$('.StfLoanCheque').show();
			$('.StfLoanChequeDte').show();
            $('.StfLoanChequeNum').show();
			$('.StfLoanBankName').show();
            $('.StfLoanBankBranch').show();
            $('.StfLoanIFSC').show();
            $('#StfLoanChequeState').val("UNCLEARED");
			$('.sbavailable').hide();
			$('.sbaccnumb').hide();
			$('.sbtotamt').hide();
			
		}
		else if(mode=="SB ACCOUNT"){
			$('.StfLoanCheque').hide();
			$('.StfLoanChequeDte').hide();
            $('.StfLoanChequeNum').hide();
			$('.StfLoanBankName').hide();
            $('.StfLoanBankBranch').hide();
            $('.StfLoanIFSC').hide();
            $('.sbavailable').show();
			$('.sbaccnumb').show();
			$('.sbtotamt').show();
			
			usr=$('.StfEmpnameTypeahead').data('value');
			//usr=$('#staffuid').val();
			$.ajax({
				url:'/getSBForStaff',
				type:'post',
				data:'&userid='+usr,
				success:function(data)
				{
					$('#SfLoanSBAcNumReadOnly').val(data['sbacno']);
					$('#SfLoanSBAcNum').val(data['sbacno']);
					$('#StfSBAvailReadOnly').val(data['sbtot']);
					$('#StfSBAvail').val(data['sbtot']);
					$('#StfLoanSBAccid').val(data['sbaccid']);
					$('#StfFName').val(data['fn']);
					$('#StfMName').val(data['mn']);
					$('#StfLName').val(data['ln']);
					sbavai=$('#StfSBAvail').val();
					sbavailamt=parseFloat(sbavai);
					amtpaid=$('#Stfamttopay').val();
					paidamt=parseFloat(amtpaid);
					sbtot=sbavailamt+paidamt;
					$('#StfLoanSBtotalReadOnly').val(sbtot);
					
				}
			});
		}
		
		else{
			
			//$('.StfLoanCheque').hide();
            alert("Please Select the Payment Mode");
		}
	});
	
	//Cheque date
	var StfLoanChequeDte;
	
	$('input[name="StfLoanChequeDte"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'YYYY-MM-DD'
		},
		
		
	});
	
	//to get blank initially
	$('input[name="StfLoanChequeDte"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
	});
	
	$('input[name="StfLoanChequeDte"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
	});
	
	
	//Typeahead for Bank Branch Name from AddBank Table
	$('input.StfLoanBankNameTypeAhead').typeahead({
		ajax:'/GetBankNameForPayAmt'
	});
	
	
	//BankName Changed
	$('.StfLoanBankNameTypeAhead').change(function(e){
		
		Bnkid=$('.StfLoanBankNameTypeAhead').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'GetBankDetailsForPersLoan',
			type:'post',
			data:'&BankId='+Bnkid,
			success:function(data)
			{
				$('#StfLoanBankBranch').val(data['Branch']);
				$('#StfLoanIFSC').val(data['IFSC']);
				$('#StfLoanBankAccNumber').val(data['AccountNo']);
			}
		});
	});
	
	
	//Cancel Window
	$('.cnclbtn').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			$('.stloanclassid').click();
			return true;
		}
		else
		{
			return false;
		}
	});
	
	$('.StfSbmBtn').click( function(e) {
		
		//StfLnT=$('.StfLoanTTypeAhead').data('value');
		//StfBr=$('.StfBranchTypeAhead').data('value');
		Bankid=$('.StfLoanBankNameTypeAhead').data('value');
		surety=$('.StfWitnessTypeAhead').data('value');
		Staff=$('.StfEmpnameTypeahead').data('value');
		
		e.preventDefault();
		$.ajax({
			url: 'StaffLoanAllocation',
			type: 'post',
			data: $('#form_stfloanalloc').serialize()+'&StfBankId='+Bankid+'&suretyid='+surety+'&StaffID='+Staff,
			success: function(data) {
				//alert('success');
				$('.stloanclassid').click();
			}
		});
		
	});
	
	
	$('.StfEmpnameTypeahead').change(function(e){
		emp=$('.StfEmpnameTypeahead').data('value');
		$.ajax({
			url:'/getdetailsfromrequesttable',
			type:'get',
			data:'&empid='+emp,
			success:function(data)
			{     
				//StfLoanStartDate StfLoanEndDate
				
				
				$('#staffloanid').val(data['Loan_TID']);
				$('#LoanDurationDays').val(data['Dur_Day']);
				$('#Stfamttopay').val(data['LoanAmt']);
				$('#LoanDurationYears').val(data['Dur_Year']);
				$('#staffbid').val(data['Bid']);
				$('#StfLoanType').val(data['LType']);
				$('#staffuid').val(data['uid']);
				$('#StfLoanBranch').val(data['Bname']);
				loanamt=data['LoanAmt'];
				usr=$('#staffuid').val();
				
				day=$('#LoanDurationDays').val();
				yr=$('#LoanDurationYears').val();
				if(day==0)
				{
					var year=$('#LoanDurationYears').val();
					var month=year*12;
					var start_date = document.getElementById('StfLoanStartDate').value;
					var c_start_date = start_date.split('-').reverse().join('-');;
					var c_start_date_obj = new Date(c_start_date);
					var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(month), c_start_date_obj.getDate());
					var c = (c_end_date_obj.getMonth())+1;
					var c_end_date = c_end_date_obj.getDate() + '-' + c + '-' + c_end_date_obj.getFullYear();
					document.getElementById('StfLoanEndDate').value = c_end_date;
					
				}
				else if(yr==0)
				{
					var days = $('#LoanDurationDays').val();
					var now = new Date();
					
					now = new Date(new Date().getTime()+(days*24*60*60*1000))
					
					var dd = now.getDate();
					var mm = now.getMonth()+1;//January is 0!
					var yyyy = now.getFullYear();
					
					if(dd<10){dd='0'+dd}
					if(mm<10){mm='0'+mm}
					
					var newDate = dd+'-'+mm+'-'+yyyy;
					document.getElementById('StfLoanEndDate').value = newDate;
					
					
				}
				$.ajax({
					url:'/GetEmployeeDetail',
					type:'post',
					data:'&usrid='+usr,
					success:function(data)
					{
						$('#Stfemptype').val(data['emptype']);
						$('#joindate').val(data['joindte']);
						$('#Stfempsal').val(data['sal_amt']);
						//jdte=$('#joindate').val();
						sal=$('#Stfempsal').val();
						emp_sal=parseFloat(sal);
						payamt=emp_sal*20;
						//$('#StfPayAmt').val(payamt);
						jdte=data['joindte'];
						
						$.ajax({
							url:'/StaffGetDiffYear',
							type:'post',
							data:'&jDate='+jdte,
							success:function(data)
							{
								yearDiff=data;
								//alert(yearDiff);
								$('#Stfempwrkexp').val(yearDiff);
							}
						});
						
					}
				});
				
				
				
				$.ajax({
					url:'/GetCharges',
					type:'get',
					success:function(data)
					{
						//bal=Math.round(bal);
						
						
						cd=data['Compulsory_Deposit'];
						
						sc=data['staffcharge'];
						bf=data['book_form'];
						oc=data['other_charge'];
						
						//loanamt=$('Stfamttopay').val();
						//loanamt
						cd1=parseFloat(cd);
						cd=((cd1*loanamt)/100);
						//alert(cd);
						cd=Math.round(cd);
						
						//sc=((parseFloat(sc)*loanamt)/100);
						bf=((parseFloat(bf)*loanamt)/100);
						bf=Math.round(bf);
						oc=((parseFloat(oc)*loanamt)/100);
						oc=Math.round(oc);
						$('#StfOthrChrge').val(oc);
						$('#StfBkfrmChrg').val(bf);
						$('#Compulsory_Deposit').val(cd);
						$('#staffcharge').val(sc);
						totamount=parseFloat(oc)+parseFloat(bf)+parseFloat(cd)+parseFloat(sc);
						tot=loanamt-totamount;
						$('#StfPayAmt').val(tot);
					}
				});
			}
		});
		
		
		
		
		
		
	});
</script>

<style>
	input[type=file]{ 
	color:transparent;
    }
</style>
<script>
	var loadFile1 = function(event) {
		var stfsecurity1 = document.getElementById('stfsecurity1');
		stfsecurity1.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile2 = function(event) {
		var stfsecurity2 = document.getElementById('stfsecurity2');
		stfsecurity2.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile3 = function(event) {
		var stfsecurity3 = document.getElementById('stfsecurity3');
		stfsecurity3.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile4 = function(event) {
		var stfsecurity4 = document.getElementById('stfsecurity4');
		stfsecurity4.src = URL.createObjectURL(event.target.files[0]);
	};
</script>