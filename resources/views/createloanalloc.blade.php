<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<div id="content" class="col-md-12">
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
					
					
					{!! Form::open(['url' => 'crtloanallocation','class' => 'form-horizontal','id' => 'form_loanalloc','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
					
					
					
					
					
					<div class="col-md-12">
						<div class="row">
							
							
							<!--<div class="form-group">
								<label class="control-label col-sm-4">Loan Category:</label>
								<div class="col-sm-4">
								<select class="form-control LoanTypeDD"  id="LoanCategory" name="LoanCategory" placeholder="SELECT LoanCategory">  
								<option value="">--Select Loan Type--</option>
								<?php foreach($LoanCatNCharge['LoanCat'] as $key){
									echo "<option value='".$key->LoanCategoryName."' >" .$key->LoanCategoryName."";
									echo "</option>";
								}?>
								</select>
								</div>
							</div>-->
							<!--Deposite Loan Allocation Detail-->
							<div class="DepositeLoan">
								<div class="form-group">
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Deposite Type :</label>
										<div class="col-sm-4">
											<select class="form-control DepositeTypeDD"  id="DepositeType" name="DepositeType" placeholder="SELECT DepositeType">  
												<option value="">--Select Loan Type--</option>
												<option value="PIGMY">PIGMY</option>
												<option value="RD">RD</option>
												<option value="FD">FD</option>
												
											</select>
										</div>
									</div>
									
									
									<div class="form-group PigmiType">
										<label class="control-label col-sm-4">Pigmi Account Number:</label>
										<div id="the-basics" class="col-sm-4">
											<input class="PigmiTypeAhead form-control"  type="text" placeholder="SELECT Pigmy ACCOUNT NUMBER" id="PigmiAccNo">  
										</div>
									</div>
									
									<div class="form-group RDType">
										<label class="control-label col-sm-4">RD Account Number:</label>
										<div id="the-basics" class="col-sm-4">
											<input class="RDTypeAhead form-control"  type="text" placeholder="SELECT RD ACCOUNT NUMBER" id="RdAccNo">  
										</div>
									</div>
									
									<div class="form-group FDType">
										<label class="control-label col-sm-4">FD Account Number:</label>
										<div id="the-basics" class="col-sm-4">
											<input class="FDTypeAhead form-control"  type="text" placeholder="SELECT FD ACCOUNT NUMBER" id="FdAccNo">  
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Type:</label>
										<div class="col-sm-4">
											<input class="form-control DepLoanTTypeAhead"  type="text" placeholder="ENETER LOAN TYPE" id="DepLoanType" name="DepLoanType">  
										</div>
									</div>
									
									<input class="form-control hidden"  type="text" placeholder="ENETER LOAN TYPE" id="DepLoanTypeID" name="DepLoanTypeID">  
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Branch Name:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control"   placeholder=" BRANCH NAME" id="DepLoanBranch" name="DepLoanBranch">  
										</div>
									</div>
									
									<input class="form-control hidden"  type="text" placeholder="ENTER BRANCH NAME" id="DepLoanBranchid" name="DepLoanBranchid"> 
									
									<div class="form-group">
										<label class="control-label col-sm-4">old Loan Number:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="old" name="old" placeholder="old Loan Number" >
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Account Holder Name:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="AccHoldFullName" name="AccHoldFullName" placeholder="ENTER ACCOUNT HOLDER NAME">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Available Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepAvailableAmountReadOnly" name="DepAvailableAmountReadOnly" placeholder="AVAILABLE AMOUNT" disabled>
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepLoanAmt" name="DepLoanAmt" placeholder="ENTER LOAN AMOUNT" onblur="DepLoanCalc();">
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Charge:</label>
										<div class="col-sm-4">
											<select class="form-control LoanChargeDD"  id="LoanCharge" name="LoanCharge" >  
												<option value="">--Select Loan Charge--</option>
												<?php foreach($LoanCatNCharge['LoanCharge'] as $key){
													echo "<option value='".$key->LoanCharges_Amount."' >" .$key->LoanCharges_Amount."";
													echo "</option>";
												}?>
											</select>
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Payable Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="PayableAmount" name="PayableAmount" placeholder="PAYABLE AMOUNT">
										</div>
									</div>
									
									<!--<div class="form-group">
										<label class="control-label col-sm-4">Loan Duration:</label>&nbsp&nbsp&nbsp
										<label class="radio-inline"><input type="radio" id="DurRad1" name="DurRad">Days</label>&nbsp
										<label class="radio-inline"><input type="radio" id="DurRad2" name="DurRad">Years</label>
										</div>
										
										
										<div class="form-group DurTextDay">
										<label class="control-label col-sm-4">Days:</label>
										<div class="col-md-4">
										<input type="text" class="form-control" id="LoanDurationDays" name="LoanDurationDays" placeholder="ENTER DAYS" onblur="calcenddate();"/>
										
										</div>
										</div>
										
										<div class="form-group DurTextYear">
										<label class="control-label col-sm-4">Years:</label>
										<div class="col-md-4">
										<input type="text" class="form-control" id="LoanDurationYears" name="LoanDurationYears" placeholder="ENTER YEARS" onblur="calcenddate();" onkeyup="CalcDays();"/>
										
										</div>
									</div>-->
									
									<div class="form-group">
										<label class="control-label col-sm-4">EMI Amount Per Month:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="EMIAmount" name="EMIAmount" placeholder="EMI AMOUNT" onclick="CalcEMI();">
										</div>
									</div>
									
									
									
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Start Date:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepLoanStartDate" name="DepLoanStartDate" value="<?php echo date('Y-m-d');?>">
										</div>
									</div>
									
									<div class="form-group hidden">
										<label class="control-label col-sm-4">End Date:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepLoanEndDate" name="DepLoanEndDate" placeholder="ENTER END DATE">
										</div>
									</div>
									
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Payment Mode:</label>
										<div class="col-md-4">
											<select class="form-control" id="DepLoanPayMode" name="DepLoanPayMode">
												<option value="">--Select Payment Mode--</option>
												<option value="CASH">CASH</option>
												<option value="CHEQUE">CHEQUE</option>
												<option value="SB ACCOUNT">SB ACCOUNT</option>
											</select>
										</div>
									</div>
									
									<div class="form-group sbaccnumb">
										<label class="control-label col-sm-4">SB Account Number:</label>
										
										<div class="col-md-4">
											<input type="text" class="form-control hidden" id="DepLoanSBAcNum" name="DepLoanSBAcNum" >
											<input type="text" class="form-control" id="DepLoanSBAccountNum" name="DepLoanSBAccountNum" >
										</div>
									</div>
									<div class="form-group account">
										<label class ="control-label col-sm-4">Account Number:</label>
										<div class="col-md-4">
											<input class="typeahead form-control "  id="account" type="text" name="account" placeholder="SELECT Account Number">  
										</div>
									</div>
									
									<input type="text" class="form-control hidden" id="DepSBtype" name="DepSBtype">
									<div class="form-group sbavailable">
										
										<label class="control-label col-sm-4">SB Available Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepSBAvail" name="DepSBAvail">
										</div>
									</div>
									
									<div class="form-group sbtotamt">
										
										<label class="control-label col-sm-4">SB Total Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepLoanSBtotal" name="DepLoanSBtotal">
										</div>
									</div>
									
									
									<div class="alert alert-success DepLoanCheque col-md-8 col-md-offset-2">
										
										<div class="form-group chequenum">
											
											<label class="control-label col-md-3">Cheque Number:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="DepLoanChequeNum" name="DepLoanChequeNum" placeholder="CHEQUE NUMBER">
											</div>
										</div>
										
										
										<div class="form-group chequedte">
											<label class="col-md-3 control-label">CHEQUE DATE</label>
											<div class="col-md-6 date">
												
												<div class="input-group input-append">
													<input type="text" name="DepLoanChequeDte" id="DepLoanChequeDte" class="form-control" value=""/>
													<span class="input-group-addon add-on">
														<span class="glyphicon glyphicon-calendar">
														</span>
														<b class="caret"></b>
													</span> 
												</div>
												
											</div>
										</div>
										
										
										
										<div class="form-group bnknme">
											<label class="control-label col-md-3">Bank Name:</label>
											<div class="col-md-6">
												<input type="text" class="form-control DepLoanBankNameTypeAhead" id="DepLoanBankName" name="DepLoanBankName" placeholder="SELECT BANK">
											</div>
										</div>
										
										
										<div class="form-group bnkbranch">
											<label class="control-label col-md-3">Bank Branch:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="DepLoanBankBranch" name="DepLoanBankBranch" placeholder="BANK BRANCH" disabled>
											</div>
										</div>		
										
										
										<div class="form-group ifsccde">
											<label class="control-label col-md-3">IFSC Code:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="DepLoanIFSC" name="DepLoanIFSC" placeholder="IFSC CODE" disabled>
											</div>
										</div>
										
										
										<div class="form-group ifsccde">
											<label class="control-label col-md-3">Account Number:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="DepLoanBankAccNumber" name="DepLoanBankAccNumber" placeholder="ACCOUNT NUMBER" disabled>
											</div>
										</div>
										
										
									</div> <!--alert-success for PigmyPayAmt Cheque ends-->
									
									
									
									
									
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="lnmonth" name="lnmonth" value="12" >
									</div>
									
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="lnac" name="lnac">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="emimonth" name="emimonth">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="uid" name="uid" >
									</div>
									
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="DepositAccountNum" name="DepositAccountNum" >
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="DepAvailableAmount" name="DepAvailableAmount" >
									</div>
									
									<!--	<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="YearInDays" name="YearInDays" value="365">
									</div>-->
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="DepLoanChequeState" name="DepLoanChequeState" value="CLEARED">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="DepLoanInhand" name="DepLoanInhand">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="DepLoanSBAccid" name="DepLoanSBAccid">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="DepLoanSBAccTid" name="DepLoanSBAccTid">
									</div>
									
								</div>
							</div><!--Deposite Loan Allocation Detail ends-->
							
							
							
							
							
						</div></div>
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm DepSbmBtn"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									
								</div>
							</div>
						</center>
						
						
						
						
						{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>







<script>
	
	$('document').ready(function(){
		
		
		//$('.DepositeLoan').hide();
		$('.DurTextDay').hide();
		$('.DurTextYear').hide();
		$('.DepLoanCheque').hide();
		$('.sbavailable').hide();
		$('.sbaccnumb').hide();
		$('.sbtotamt').hide();
		$('.PigmiType').hide();
		$('.RDType').hide();
		$('.FDType').hide();
		$('.account').hide();
		//$('.DepSbmBtn').hide();
		//$('.cnclbtn').hide();
		
		
	});
	$('input.typeahead').typeahead({
		ajax: '/Getaccnum'
	});
	$('input.PigmiTypeAhead').typeahead({
		ajax:'/GetPigmyNumForDLAlloc'
	});
	
	$('input.RDTypeAhead').typeahead({
		ajax:'/GetRDNumForDLAlloc'
	});
	
	$('input.FDTypeAhead').typeahead({
		
		ajax:'/GetFDNumForDLAlloc'
		
	});
	
	//PaymentMode Changed (Newly Added)
	$('#DepLoanPayMode').change( function(e) {
		e.preventDefault();
		mode=$('#DepLoanPayMode').val();
		if(mode=="CASH")
		{
			$('.DepLoanCheque').hide();
            $('.DepLoanChequeDte').hide();
            $('.DepLoanChequeNum').hide();
			$('.DepLoanBankName').hide();
            $('.DepLoanBankBranch').hide();
            $('.DepLoanIFSC').hide();
            
		}
		else if(mode=="CHEQUE"){
			$('.DepLoanCheque').show();
			$('.DepLoanChequeDte').show();
            $('.DepLoanChequeNum').show();
			$('.DepLoanBankName').show();
            $('.DepLoanBankBranch').show();
            $('.DepLoanIFSC').show();
            $('#DepLoanChequeState').val("UNCLEARED");
			
		}
		else if(mode=="SB ACCOUNT"){
			$('.DepLoanCheque').hide();
			$('.DepLoanChequeDte').hide();
            $('.DepLoanChequeNum').hide();
			$('.DepLoanBankName').hide();
            $('.DepLoanBankBranch').hide();
            $('.DepLoanIFSC').hide();
			$('.sbavailable').show();
			$('.account').show();
			
            
			
		}
		
		else{
			
			$('.DepLoanCheque').hide();
            alert("Please Select the Payment Mode");
		}
	});
	
	$('.LoanChargeDD').change(function(e){
		LcId=$('.LoanChargeDD').val();
		if(LcId=="")
		{
			alert("Please Select Loan Charge");
		}
		else
		{
			reqamt=$('#DepLoanAmt').val();
			reqAmount=(parseFloat(reqamt));
			charge=(parseFloat(LcId));
			payable=reqAmount-charge;
			$('#PayableAmount').val(payable);
			
		}
		
	});
	
	$('.DepositeTypeDD').change(function(e){
		DepId=$('.DepositeTypeDD').val();
		if(DepId=="PIGMY")
		{
			
			$('.PigmiType').show();
			$('.RDType').hide();
			$('.FDType').hide();
			
			
		}
		else if(DepId=="RD")
		{
			$('.PigmiType').hide();
			$('.RDType').show();
			$('.FDType').hide();
			
		}
		else if(DepId=="FD")
		{
			$('.PigmiType').hide();
			$('.RDType').hide();
			$('.FDType').show();
			
		}
		
		else
		{
			alert("Please Select the Loan Category");
			$('.PigmiType').hide();
			$('.RDType').hide();
			$('.FDType').hide();
		}
		
	});
	
	
	$('.LoanTypeDD').change(function(e){
		LoanCat=$('.LoanTypeDD').val();
		if(LoanCat=="PERSONAL LOAN")
		{
			
			$('.PersonalLoan').show();
			$('.DepositeLoan').hide();
			$('.PersonalLoanSubmitBtn').show();
			$('.DepSbmBtn').hide();
			$('.cnclbtn').hide();
			
			
		}
		else if(LoanCat=="DEPOSITE LOAN")
		{
			$('.PersonalLoan').hide();
			$('.PersonalLoanSubmitBtn').hide();
			$('.DepositeLoan').show();
			$('.PigmiType').hide();
			$('.RDType').hide();
			$('.FDType').hide();
			$('.DepSbmBtn').show();
			$('.cnclbtn').show();
			
		}
		
		else
		{
			alert("Please Select the Loan Category");
			$('.PersonalLoan').hide();
			$('.DepositeLoan').hide();
		}
		
	});
</script>


<script>
	
	//EndDate Calculation
	
	
	
	//Cancel Window
	$('.cnclbtn').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.loanalcclassid').click();
			return true;
		}
		else{
			return false;
		}
	});
	
	$('.PlCncl').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.loanalcclassid').click();
			return true;
		}
		else{
			return false;
		}
	});
	
	$('.resetbtn').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            
			return true;
		}
		else{
			return false;
		}
	});
	
	
	//Get LoanType
	/*$('input.typeahead').typeahead({
		ajax: '/GetLoanType'
	});//Get LoanType*/
	
	$('input.DepLoanTTypeAhead').typeahead({
		ajax: '/GetDLoanType'
	});
	
	//Get Account Number
	$('input.typeahead1').typeahead({
		//loanbrch=$('#loanbranch').data('value');
		/*$.ajax({
			url:'GetAccNum',
			data:'&lbid='+loanbrch
		});*/
		ajax:'/GetAccNum'
	});
	
	
	
	
	
	//Get BranchCode
	$('input.typeahead2').typeahead({
		ajax:'/GetBranchCode'
	});
	
	//Get BranchCode for deposites
	/*$('input.DepBranchTypeAhead').typeahead({
		ajax:'/GetBranchCode'
	});*/
	
	var uid ='';
	$('#accno').change(function(e){
		//alert("hii");
		ac=$('#accno').data('value');
		//a=$('.typeahead1').val();
		//alert(a);
		//alert(ac);
		e.preventDefault();
		$.ajax({
			url:'retrieveaccname',
			type:'post',
			data:'&act='+ac,
			success:function(data){
				
				$('#achldrnme').val(data['fn']);
				$('#uid').val(data['uid']);
				$('#lnac').val(ac);
			}
		});
	});
	
	//Pigmy Account Typeahead On Change
	$('#PigmiAccNo').change(function(e){
		//alert('hi');
		Pac=$('#PigmiAccNo').data('value');
		e.preventDefault();
		$.ajax({
			url:'GetPigmyDetailForDL',
			type:'post',
			data:'&PigAccNum='+Pac,
			success:function(data){
				//	alert("hai");
				FullName=data['Pg_FName']+" . "+data['Pg_MName']+" . "+data['Pg_LName'];
				$('#AccHoldFullName').val(FullName);
				$('#DepAvailableAmount').val(data['Pg_Tot']);
				$('#DepAvailableAmountReadOnly').val(data['Pg_Tot']);
				$('#DepLoanAmt').val(data['Pg_LoanAmt']);
				//$('#DepLoanType').val(data['Pg_LType']);
				//$('#DepLoanTypeID').val(data['PgLoan_TID']);
				$('#DepLoanBranchid').val(data['Pg_Bid']);
				$('#DepLoanBranch').val(data['Pg_Bname']);
				$('#DepLoanEndDate').val(data['EDate']);
				edte=$('#DepLoanEndDate').val();
				sdte=$('#DepLoanStartDate').val();
				PigAccN=$('.PigmiTypeAhead').val();
				$('#DepositAccountNum').val(PigAccN); //hidden textbox for depaccnum's
				
				
			}
		});
		
		$.ajax({
			//if(edte!="")
			//{
			url:'GetMonthDiffForDL',
			type:'post',
			data:'&Start_Date='+sdte+'&End_Date='+edte,
			success:function(data){
				//alert(data);
				month=data;
				$('#emimonth').val(month);
				//}
			}
		});
	});
	
	//FD Account Typeahead On Change
	$('#FdAccNo').change(function(e){
		//alert('hi');
		Fac=$('#FdAccNo').data('value');
		e.preventDefault();
		$.ajax({
			url:'RetrieveFdAccDetailfromrequesttable',
			type:'get',
			data:'&FdAccNum='+Fac,
			success:function(data){
				//	alert("hai");
				FullName=data['Pg_FName']+" . "+data['Pg_MName']+" . "+data['Pg_LName'];
				$('#AccHoldFullName').val(FullName);
				$('#DepAvailableAmount').val(data['Pg_Tot']);
				$('#DepAvailableAmountReadOnly').val(data['Pg_Tot']);
				$('#DepLoanAmt').val(data['Pg_LoanAmt']);
				//$('#LoanDurationDays').val(data['PgDur_Day']);
				//$('#LoanDurationYears').val(data['PgDur_Year']);
				//$('#DepLoanType').val(data['Pg_LType']);
				//$('#DepLoanTypeID').val(data['PgLoan_TID']);
				$('#DepLoanBranchid').val(data['Pg_Bid']);
				$('#DepLoanBranch').val(data['Pg_Bname']);
				$('#DepLoanEndDate').val(data['EDate']);
				edte=$('#DepLoanEndDate').val();
				sdte=$('#DepLoanStartDate').val();
				PigAccN=$('.FDTypeAhead').val();
				$('#DepositAccountNum').val(PigAccN);
			}
		});
		
		$.ajax({
			//if(edte!="")
			//{
			url:'GetMonthDiffForDL',
			type:'post',
			data:'&Start_Date='+sdte+'&End_Date='+edte,
			success:function(data){
				//alert(data);
				month=data;
				$('#emimonth').val(month);
				//}
			}
		});
	});
	
	//RD Account Typeahead On Change
	$('#RdAccNo').change(function(e){
		//alert('hi');
		Rdac=$('#RdAccNo').data('value');
		e.preventDefault();
		$.ajax({
			url:'RetrieveRdAccDetailfromrequesttable',
			type:'get',
			data:'&RdAccNum='+Rdac,
			success:function(data){
				//	alert("hai");
				FullName=data['Pg_FName']+" . "+data['Pg_MName']+" . "+data['Pg_LName'];
				$('#AccHoldFullName').val(FullName);
				$('#DepAvailableAmount').val(data['Pg_Tot']);
				$('#DepAvailableAmountReadOnly').val(data['Pg_Tot']);
				$('#DepLoanAmt').val(data['Pg_LoanAmt']);
				//$('#LoanDurationDays').val(data['PgDur_Day']);
				//$('#LoanDurationYears').val(data['PgDur_Year']);
				//$('#DepLoanType').val(data['Pg_LType']);
				//$('#DepLoanTypeID').val(data['PgLoan_TID']);
				$('#DepLoanBranchid').val(data['Pg_Bid']);
				$('#DepLoanBranch').val(data['Pg_Bname']);
				$('#DepLoanEndDate').val(data['EDate']);
				edte=$('#DepLoanEndDate').val();
				sdte=$('#DepLoanStartDate').val();
				PigAccN=$('.RDTypeAhead').val();
				$('#DepositAccountNum').val(PigAccN);
			}
		});
		$.ajax({
			//if(edte!="")
			//{
			url:'GetMonthDiffForDL',
			type:'post',
			data:'&Start_Date='+sdte+'&End_Date='+edte,
			success:function(data){
				//alert(data);
				month=data;
				$('#emimonth').val(month);
				//}
			}
		});
	});
	
	
	$('#DepLoanType').change(function(e){
		//alert("hii");
		loantype=$('#loantype').data('value');
		//a=$('.typeahead1').val();
		//alert(a);
		//alert(ac);
		e.preventDefault();
		$.ajax({
			success:function(){
				//$('#achldrnme').val(data['fn']);
				$('#lntp').val(loantype);
				//alert(m);
			}
		});
	});
	
	
	//for deposite
	$('#DepLoanBranch').change(function(e){
		//alert("hii");
		loanbrch=$('#DepLoanBranch').data('value');
		//a=$('.typeahead1').val();
		//alert(a);
		//alert(ac);
		e.preventDefault();
		$.ajax({
			success:function(){
				//$('#achldrnme').val(data['fn']);
				$('#lnbc').val(loanbrch);
				//alert(m);
			}
		});
	});
	
	function loancriteria()
	{
		lnamt=$('#loanamt').val();
		account=$('#accno').data('value');
		if(lnamt>=20000)
		{
			//alert("Hi");
			$.ajax({
				url:'getloancriteria',
				type:'post',
				data:'&acc='+account,
				success:function(data)
				{
					m=$('#loan').val(data['ac']);
					//alert(m);
					if(m==1)
					{
						alert("This Person should have SB Account");
					}
					
					
				}
			});
		}
	}
	
	
	function DepLoanCalc()
	{
		DLoanAmt1=$('#DepLoanAmt').val();
		DPayableAmt1=$('#PayableAmount').val();
		Inhandcash=$('#DepLoanInhand').val();
		DLoanAmt=parseFloat(DLoanAmt1);
		DPayableAmt=parseFloat(DPayableAmt1);
		InhandAmt=parseFloat(Inhandcash);
		if(DLoanAmt>DPayableAmt)
		{
			
			alert("Loan Amount Should Be Less/Equal To Payable Amount");
			$('#DepLoanAmt').val("");
			
		}
		
		if(DLoanAmt>InhandAmt)
		{
			
			alert("Loan Amount Should Be Less than InHand Cash");
			$('#DepLoanAmt').val("");
			
		}
		if(DLoanAmt>=20000)
		{
			//alert("hi");
			DepType=$('#DepositeType').val();
			if(DepType=="PIGMY")
			{
				DepAccNo=$('.PigmiTypeAhead').val();
			}
			else if(DepType=="FD")
			{
				DepAccNo=$('.FDTypeAhead').val();
			}
			else if(DepType=="RD")
			{
				DepAccNo=$('.RDTypeAhead').val();
				
			}	
			
			
			//alert(PigAccNo);
			$.ajax({
				url:'GetSBForDL',
				type:'get',
				data:'&PAccNum='+DepAccNo+'&DepositType='+DepType,
				success:function(data)
				{
					m=$('#DepLoanSBAcNum').val(data['acn']);
					//m1=parseInt(m);
					//alert(m);
					if(m=="1")
					{
						alert("This Person should have SB Account");
						$('.accclassid').click();
					}
					else
					{
						DPLoanAmt=$('#DepLoanAmt').val();
						$('#DepLoanPayMode').val("SB ACCOUNT");
						$('#DepLoanSBAccountNum').val(data['acccn']);
						$('#DepSBAvail').val(data['tot']);
						$('#DepLoanSBAccid').val(data['acid']);
						$('#DepLoanSBAccTid').val(data['actid']);
						sbavail=$('#DepSBAvail').val();
						
						sbtotal=(parseFloat(sbavail)+parseFloat(DPLoanAmt));
						$('#DepLoanSBtotal').val(sbtotal);
						
						
						$('.sbavailable').show();
						$('.sbaccnumb').show();
						$('.sbtotamt').show();
						
						alert("Loan Amount Will Be Credited to SB Account");
						
					}
				}
			});
		}
		
		
	}
	
	
	
	
</script>
<script>
	
	
	/*$('#DurRad1').click(function(e)
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
		
	});*/
	
	/*function CalcDays()
		{
		DurYear=$('#LoanDurationYears').val();
		YearDay=$('#YearInDays').val();
		YearConv=(DurYear*YearDay);
		$('#LoanDurationDays').val(YearConv);
	}*/
	
	//End Date For Personal Loan (Year wise calculation)
	/*function PersonalLoanEndDate(){
		var year=$('#loanduratn').val();
		var month=year*12;
		var start_date = document.getElementById('loansdte').value;
		var c_start_date = start_date.split('/').reverse().join('/');;
		var c_start_date_obj = new Date(c_start_date);
		var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(month), c_start_date_obj.getDate());
		var c = (c_end_date_obj.getMonth())+1;
		var c_end_date = c_end_date_obj.getDate() + '/' + c + '/' + c_end_date_obj.getFullYear();
		document.getElementById('loanedte').value = c_end_date;
	}*/
	
	
	/*function calcenddate(){
		
		
		var days = $('#LoanDurationDays').val();
		var now = new Date();
		
		now = new Date(new Date().getTime()+(days*24*60*60*1000))
		
		var dd = now.getDate();
		var mm = now.getMonth()+1;//January is 0!
		var yyyy = now.getFullYear();
		
		if(dd<10){dd='0'+dd}
		if(mm<10){mm='0'+mm}
		
		var newDate = dd+'-'+mm+'-'+yyyy;
		document.getElementById('DepLoanEndDate').value = newDate;
		
		
	}*/
	
	
</script>

<script>
	x=0;
	$('.DepSbmBtn').click( function(e) {
		if(x==0)
		{
	x++;
			$("#form_loanalloc").validate({
				rules:{
					
					DepositeType:"required",
					DepLoanType:"required",
					DepLoanBranch:"required",
					PigmiAccNo:"required",
					LoanDurationDays:{
						required:true,
						number:true,
					},
					DepLoanAmt:{
						required:true,
						number:true,
					},
					LoanCharge:{
						required:true,
						number:true,
					},
					DepLoanStartDate:"required",
					DepLoanEndDate:"required",
					
				}
				
			});
			if($("#form_loanalloc").valid())
			{
				accnum=$('#account').data('value');
				DepLnT=$('.DepLoanTTypeAhead').data('value');
				DepBr=$('.DepBranchTypeAhead').data('value');
				Bankid=$('.DepLoanBankNameTypeAhead').data('value');
				
				e.preventDefault();
				$.ajax({
					url: 'CreateDepositeLoanAllocation',
					type: 'post',
					data: $('#form_loanalloc').serialize()+'&DepLoanType='+DepLnT+'&DepBranch='+DepBr+'&LoanBankId='+Bankid+'&sb='+accnum,
					success: function(data) {
						alert('success');
						// $('.loanalcclassid').click();
					}
				});
			}
		}
	});
	
</script>

<script>
	//Pigmi Cheque Date (Newly Added)
	var DepLoanChequeDte;
	
	$('input[name="DepLoanChequeDte"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'DD-MM-YYYY'
			},
		
		
	});
	
	//to get blank initially
	$('input[name="DepLoanChequeDte"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD-MM-YYYY'));
	});
	
	$('input[name="DepLoanChequeDte"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
</script>

<script>
	
	//Typeahead for Bank Branch Name from AddBank Table
	$('input.DepLoanBankNameTypeAhead').typeahead({
		ajax:'/GetBankNameForPayAmt'
	});
	
	
	//BankName Changed
	$('.DepLoanBankNameTypeAhead').change(function(e){
		
		Bnkid=$('.DepLoanBankNameTypeAhead').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'GetBankDetailsForPayAmt',
			type:'get',
			data:'&BankId='+Bnkid,
			success:function(data)
			{
				$('#DepLoanBankBranch').val(data['Branch']);
				
				$('#DepLoanIFSC').val(data['IFSC']);
				
				$('#DepLoanBankAccNumber').val(data['AccountNo']);
				
			}
		});
	});
	
	$('#DepLoanBranch').change(function(e){
		
		brid=$('#DepLoanBranch').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'GetBranchIDForDL',
			type:'get',
			data:'&BranchId='+brid,
			success:function(data)
			{
				$('#DepLoanInhand').val(data['inhand']);
			}
		});
	});
	
	$('#account').change(function(e){
		accnum=$('#account').attr('data-value');
		e.preventDefault();
		$.ajax({
			url:'retriveacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				//$('#DepSBAvail').val(data['crbal']);
				$('#DepSBtype').val(data['acid']);
				
			$.ajax({
			url:'get_account_balance',
			type:'post',
			data:'&acc_id='+accnum,
			success:function(data){
			$("#DepSBAvail").val(data);
			}
			});
			}
		});
	});
	
	//EMI Calculation
	function CalcEMI()
	{
		payable=$('#PayableAmount').val();
		payableamt=(parseFloat(payable));
		duration=$('#emimonth').val();
		totmonth=(parseInt(duration));
		EMIAmt=payableamt/totmonth;
		a=$('#EMIAmount').val(EMIAmt);
	}
</script>


<script>
	
	//Get Loan Type
	$('input.DepLoanTTypeAhead').typeahead({
		ajax: '/GetDLoanType'
	});
	
</script>
