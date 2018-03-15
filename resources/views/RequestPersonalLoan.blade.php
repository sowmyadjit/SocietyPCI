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
					<h2><i class="glyphicon glyphicon-user"></i>REQUEST FOR LOAN</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => 'ReqPersLoanAllocation','class' => 'form-horizontal','id' => 'form_ReqPerLoan','method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}
					
					
					
					
					<div class="form-group">
						<label class="control-label col-md-2 col-md-offset-3">Loan Category:</label>
						<div class="col-md-3">
							<select class="form-control LoanTypeDD"  id="LoanCategory" name="LoanCategory" placeholder="SELECT LoanCategory">  
								<option value="">--Select Loan Type--</option>
								<?php foreach($LoanCat as $key){
									echo "<option value='".$key->LoanCategoryID."' >" .$key->LoanCategoryName."";
									echo "</option>";
								}?>
							</select>
						</div>
					</div>
					
					<div class="form-group branch">
						<label class="control-label col-md-2 col-md-offset-3">Branch Name:</label>
						<div id="the-basics" class="col-md-3">
							<input class="ReqPersBranchTypeAhead form-control"  type="text" placeholder="SELECT BRANCH NAME" id="ReqPersLoanBranch" Required>  
						</div>
					</div>
					
					
					<!--Personal Loan Request-->
					<div class="PersonalLoan">
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Personal Loan Type:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqPersLoantypeTypeahead form-control"  type="text" placeholder="SELECT LOAN NAME" id="ReqPersLoanType" Required>  
							</div>
						</div>
						
						<input class="form-control hidden"  type="text" id="ReqPLBranchID" name="ReqPLBranchID"> 
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Customer Type :</label>
							<div class="col-md-3">
								<select class="form-control custtype"  id="custtype" name="custtype" placeholder="SELECT CustomerType">  
									<option value="">--Select Customer Type--</option>
									<option value="MEMBERS">MEMBERS</option>
									<option value="OTHERS">OTHERS</option>
									
									
								</select>
							</div>
						</div>
						
						
						
						<div class="form-group member">
							<label class="control-label col-md-2 col-md-offset-3">Member Name:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqPersMemnameTypeahead form-control"  type="text" placeholder="SELECT MEMBER NUMBER/NAME" id="ReqPersMemname" Required>  
							</div>
						</div>
						
						<div class="form-group user">
							<label class="control-label col-md-2 col-md-offset-3">User Name:</label>
							<div id="the-basics" class="col-md-3">
								<input class="userTypeahead form-control"  type="text" placeholder="SELECT User NUMBER/NAME" id="username" Required>  
							</div>
						</div>
						
						
						<input class="form-control hidden"  type="text" id="ReqPLMembID" name="ReqPLMembID"> 
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Loan Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqPersLoanAmt" name="ReqPersLoanAmt" placeholder="ENTER LOAN AMOUNT" Required>
							</div>
						</div>
					</div>
					<!--Personal Loan Request Ends-->
					
					<!--Deposit Loan Request-->
					<div class="DepositeLoan">
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Deposite Type :</label>
							<div class="col-md-3">
								<select class="form-control DepositeTypeDD"  id="DepositeType" name="DepositeType" placeholder="SELECT DepositeType">  
									<option value="">--Select Loan Type--</option>
									<option value="PIGMY">PIGMY</option>
									<option value="RD">RD</option>
									<option value="FD">FD</option>
									
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Loan Type:</label>
							<div id="the-basics" class="col-md-3">
								<input class="DepLoanTTypeAhead form-control"  type="text" placeholder="SELECT LOAN TYPE" id="DepLoanType">  
							</div>
						</div>
						
						<div class="form-group PigmiType">
							<label class="control-label col-md-2 col-md-offset-3">Pygmy Account Number:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqDepPigmiTypeAhead form-control"  type="text" placeholder="SELECT PYGMY ACCOUNT NUMBER" id="ReqDepPigmiAccNo">  
							</div>
						</div>
						
						<div class="form-group RDType">
							<label class="control-label col-md-2 col-md-offset-3">RD Account Number:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqDepRDTypeAhead form-control"  type="text" placeholder="SELECT RD ACCOUNT NUMBER" id="ReqDepRdAccNo">  
							</div>
						</div>
						
						<div class="form-group FDType">
							<label class="control-label col-md-2 col-md-offset-3">FD Account Number:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqDepFDTypeAhead form-control"  type="text" placeholder="SELECT FD ACCOUNT NUMBER" id="ReqDepFdAccNo">  
							</div>
						</div>
						
						<div class="col-md-4 hidden">
							<input type="text" class="form-control" id="DepositAccountNum" name="DepositAccountNum" >
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Account Holder Name:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqDepAccHoldFullName" name="ReqDepAccHoldFullName" placeholder="ENTER ACCOUNT HOLDER NAME">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Available Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqDepAvailableAmountReadOnly" name="ReqDepAvailableAmountReadOnly" placeholder="AVAILABLE AMOUNT" disabled>
							</div>
						</div>
						<div class="col-md-4 hidden">
							<input type="text" class="form-control" id="ReqDepAvailableAmount" name="ReqDepAvailableAmount">
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Payable Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqDepLoanAmt" name="ReqDepLoanAmt" placeholder="ENTER LOAN AMOUNT" Required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Requested Loan Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqDepReqLoanAmt" name="ReqDepReqLoanAmt" placeholder="ENTER LOAN AMOUNT" Required>
							</div>
						</div>
						<div class="col-md-4 hidden">
							<input type="text" class="form-control" id="UID" name="UID">
						</div>
					</div>
					<!--Deposit Loan Request Ends-->
					
					<!--Jewel Loan Request-->
					<div class="JewelLoan">
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Customer Name:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqJwlCustnameTypeahead form-control"  type="text" placeholder="SELECT CUSTOMER NAME" id="ReqJwlCustname" Required>  
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Jewel Loan Type:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqJLtypeTypeahead form-control"  type="text" placeholder="SELECT LOAN NAME" id="JL_T" Required>  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Jewel Description:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqJwlDesc" name="ReqJwlDesc" placeholder="ENTER JEWEL DESCRIPTION" Required>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Gold Rate:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqJwlRate" name="ReqJwlRate" placeholder="ENTER GOLD RATE" Required>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Requested Loan Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqJwlLoanAmt" name="ReqJwlLoanAmt" placeholder="ENTER LOAN AMOUNT" Required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Loan Duration:</label>
							<div class="col-md-3">
								<select class="form-control" id="ReqJewelDuration" name="ReqJewelDuration">
									<option value="">--Select Duration--</option>
									<option value="6 MONTHS">6 MONTHS</option>
									<option value="1 YEAR">1 YEAR</option>
									
								</select>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Gross Weight:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="grossweight" name="grossweight" placeholder="ENTER GROSS WEIGHT" Required>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Net Weight:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="netweight" name="netweight" placeholder="ENTER NET WEIGHT" Required>
							</div>
						</div>
						
						
						
					</div>
					<!--Jewel Loan Request Ends-->
					
					<!--Staff Loan Request-->
					<div class="StaffLoan">
						
						
						
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Employee Name:</label>
							<div id="the-basics" class="col-md-3">
								<input class="ReqStfEmpnameTypeahead form-control"  type="text" placeholder="SELECT EMPLOYEE NAME" id="ReqStfEmpname" Required>  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Employee Type:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqStfemptype" name="ReqStfemptype" placeholder="EMPLOYEE TYPE">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Employee Salary:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqStfempsal" name="ReqStfempsal" placeholder="EMPLOYEE SALARY">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Work Experience:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqStfempwrkexp" name="ReqStfwrkexp" placeholder="WORK EXPERIENCE">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Payable Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqStfLoanAmt" name="ReqStfLoanAmt" placeholder="ENTER LOAN AMOUNT" Required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-3">Requested Loan Amount:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="ReqStfReqLoanAmt" name="ReqStfReqLoanAmt" placeholder="ENTER LOAN AMOUNT" Required>
							</div>
						</div>
						
						<div class="col-md-4 hidden">
							<input type="text" class="form-control" id="joindate" name="joindate" >
						</div>
						
					</div>
					<!--Staff Loan Request Ends-->
					
					<div class="form-group loandur">
						<label class="control-label col-md-2 col-md-offset-3">Loan Duration:</label>&nbsp&nbsp&nbsp
						<label class="radio-inline"><input type="radio" id="DurRad1" name="DurRad">Days</label>&nbsp
						<label class="radio-inline"><input type="radio" id="DurRad2" name="DurRad">Years</label>
					</div>
					
					
					<div class="form-group DurTextDay">
						<label class="control-label col-md-2 col-md-offset-3">Days:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" id="LoanDurationDays" name="LoanDurationDays" placeholder="ENTER DAYS"/>
							
						</div>
					</div>
					
					<div class="form-group DurTextYear">
						<label class="control-label col-md-2 col-md-offset-3">Years:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" id="LoanDurationYears" name="LoanDurationYears" placeholder="ENTER YEARS" onkeyup="CalcDays();"/>
							
						</div>
					</div>
					<div class="form-group reqdte">
						<label class="control-label col-md-2 col-md-offset-3">Request Date:</label>
						<div class="col-md-3">
							<input type="text" class="form-control" id="ReqPersLoanDate" name="ReqPersLoanDate" value="<?php echo date('Y-m-d');?>">
						</div>
					</div>
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="ReqDepYearInDays" name="YearInDays" value="365">
					</div>
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="loantypeid" name="loantypeid">
						<input type="text" class="form-control" id="loantypetext" name="loantypetext">
					</div>
					<!--</div>-->
					
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="SUBMIT REQUEST" class="btn btn-success btn-sm ReqPersSbmBtn"/>
								
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
							</div>
						</div>
					</center><!--Deposite Loan Allocation Detail ends-->
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	//Hide the fields while page load
	$('.PersonalLoan').hide();
	$('.DepositeLoan').hide();
	$('.JewelLoan').hide();
	$('.StaffLoan').hide();
	$('.branch').hide();
	$('.loandur').hide();
	$('.reqdte').hide();
	$('.DurTextDay').hide();
	$('.DurTextYear').hide();
	$('.member').hide();
	$('.user').hide();
	//Get Branches using typeahead
	$('input.ReqPersBranchTypeAhead').typeahead({
		ajax:'/GetBranchCode'
	});
	
	
	//Get Members using typeahead
	$('input.ReqPersMemnameTypeahead').typeahead({
		ajax: '/GetMembersForPersLoan'
	});
		$('input.userTypeahead').typeahead({
		ajax: '/getuser_forloan'
	});
	//Days Radiobutton Click
	$('#DurRad1').click(function(e)
	{
		$('.DurTextDay').show();
		$('.DurTextYear').hide();
		$('#LoanDurationYears').val("");
	});
	
	//years radio Button Click
	$('#DurRad2').click(function(e)
	{
		$('.DurTextDay').hide();
		$('.DurTextYear').show();
		$('#LoanDurationDays').val("");
	});
	
	//Days Calculation While enter Years
	function CalcDays()
	{
		DurYear=$('#LoanDurationYears').val();
		YearDay=$('#YearInDays').val();
		YearConv=(DurYear*YearDay);
		$('#LoanDurationDays').val(YearConv);
	}
	
	
	//Member Name selected Check for SB Account
	$('#ReqPersMemname').change(function(e){
		memid=$('#ReqPersMemname').data('value');
		$('#ReqPLMembID').val(memid);
		$.ajax({
			url:'/GetMemSBDetailReq',
			type:'post',
			data:'&membrid='+memid,
			success:function(data)
			{
				$('#ReqPersLoanSBCheck').val(data['acn']);
				SBCheckval=$('#ReqPersLoanSBCheck').val();
				if(SBCheckval==1)
				{
					alert("Please Create SB Account and then Allocate the Loan");
					$('#ReqPersLoanSBCheck').val("");
					$('.accclassid').click();
				}
			}
		});
	});
	
	//Cancel Window
	$('.cnclbtn').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			$('.ploanclassid').click();
			return true;
		}
		else
		{
			return false;
		}
	});
	indexid=0;
	$('.ReqPersSbmBtn').click( function(e) 
	{
		if(indexid==0)
		{
			indexid++;
			PLBrnch=$('.ReqPersBranchTypeAhead').data('value');
			Member=$('#ReqPersMemname').data('value');
			Empid=$('.ReqStfEmpnameTypeahead').data('value');
			Custid=$('.ReqJwlCustnameTypeahead').data('value');
			userid=$('.userTypeahead').data('value');
			jlid=$('#JL_T').data('value');
			custtype=$('.custtype').val();
			e.preventDefault();
			$.ajax({
				url: 'ReqPersLoanAllocation',
				type: 'post',
				data: $('#form_ReqPerLoan').serialize()+'&ReqPLBranchID='+PLBrnch+'&ReqPLMembID='+Member+'&ReqEmpID='+Empid+'&ReqCustID='+Custid+'&userid='+userid+'&custtype='+custtype+'&jlid='+jlid,
				success: function(data) {
				alert("success");
					$('.Reqploanclassid').click();
				}
			});
		}
	});
	
	$('#LoanCategory').change(function(e){
		$('.branch').show();
		$('.reqdte').show();
		loancat=$('#LoanCategory').val();
		loancat1=$('#LoanCategory :selected').text();
		$('#loantypetext').val(loancat1);
		if(loancat1=="PERSONAL LOAN")
		{
			$('.PersonalLoan').show();
			$('.DepositeLoan').hide();
			$('.JewelLoan').hide();
			$('.StaffLoan').hide();
			$('.DurTextDay').hide();
			$('.DurTextYear').hide();
			$('.loandur').show();
		}
		else if(loancat1=="DEPOSITE LOAN")
		{
			$('.PersonalLoan').hide();
			$('.DepositeLoan').show();
			$('.JewelLoan').hide();
			$('.StaffLoan').hide();
			$('.DurTextDay').hide();
			$('.DurTextYear').hide();
			$('.loandur').show();
		}
		else if(loancat1=="STAFF LOAN")
		{
			$('.PersonalLoan').hide();
			$('.DepositeLoan').hide();
			$('.JewelLoan').hide();
			$('.StaffLoan').show();
			$('.DurTextDay').hide();
			$('.DurTextYear').hide();
			$('.loandur').show();
			
		}
		else if(loancat1=="JEWEL LOAN")
		{
			$('.PersonalLoan').hide();
			$('.DepositeLoan').hide();
			$('.JewelLoan').show();
			$('.StaffLoan').hide();
			$('.DurTextDay').hide();
			$('.DurTextYear').hide();
			$('.loandur').hide();
		}
		else
		{
			alert("Please Select Loan Category");
			$('.PersonalLoan').hide();
			$('.DepositeLoan').hide();
			$('.JewelLoan').hide();
			$('.StaffLoan').hide();
			$('.branch').hide();
			$('.loandur').hide();
			$('.reqdte').hide();
			$('.DurTextDay').hide();
			$('.DurTextYear').hide();
		}
	});
	
	
	//Get Loan type using typeahead
	$('input.ReqPersLoantypeTypeahead').typeahead({
		ajax:'/GetPersLoantype'
	});
	
	$('input.ReqJLtypeTypeahead').typeahead({
		ajax:'/GetJltype'
	});
	
	$('.custtype').change(function(e){
		custtype=$('.custtype').val();
		if(custtype=="MEMBERS")
		{
			$('.member').show();
			$('.user').hide();
			
			
		}
		else if(custtype=="OTHERS")
		{
			$('.member').hide();
			$('.user').show();
			
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
	
	//Get Loan Type
	$('input.DepLoanTTypeAhead').typeahead({
		ajax: '/GetDLoanType'
	});
	
	//Get Branches using typeahead
	
	$('input.ReqDepPigmiTypeAhead').typeahead({
		ajax:'/GetPigmyNum'
	});
	
	$('input.ReqDepRDTypeAhead').typeahead({
		
		ajax:'/GetRDNum'
		
	});
	
	$('input.ReqDepFDTypeAhead').typeahead({
		
		ajax:'/GetFDNumber'
		
	});
	$('input.ReqStfEmpnameTypeahead').typeahead({
		ajax: '/GetEmpName1'
	});
	
	//Pigmy Account Typeahead On Change
	$('#ReqDepPigmiAccNo').change(function(e){
		//alert('hi');
		Pac=$('#ReqDepPigmiAccNo').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'RetrievePigmyAccDetail',
			type:'get',
			data:'&PigAccNum='+Pac,
			success:function(data){
				FullName=data['PigmyFn']+" . "+data['PigmyMn']+" . "+data['PigmyLn'];
				$('#ReqDepAccHoldFullName').val(FullName);
				$('#ReqDepAvailableAmount').val(data['AvailBal']);
				$('#ReqDepAvailableAmountReadOnly').val(data['AvailBal']);
				$('#UID').val(data['Pg_Uid']);
				PigAvail=$('#ReqDepAvailableAmount').val();
				
				PigPayable=(parseFloat(PigAvail)*0.8);
				$('#ReqDepLoanAmt').val(PigPayable);
				alert("Pigavail"+PigAvail+"PigPay"+PigPayable);
				PigAccN=$('.ReqDepPigmiTypeAhead').val();
				$('#DepositAccountNum').val(PigAccN); //hidden textbox for depaccnum's
			}
		});
	});
	
	//RD Account Typeahead On Change
	$('#ReqDepRdAccNo').change(function(e){
		Rdac=$('#ReqDepRdAccNo').data('value');
		e.preventDefault();
		$.ajax({
			url:'RetrieveRdAccDetail',
			type:'get',
			data:'&RdAccNum='+Rdac,
			success:function(data){
				FullName=data['RDFn']+" . "+data['RDMn']+" . "+data['RDLn'];
				$('#ReqDepAccHoldFullName').val(FullName);
				$('#ReqDepAvailableAmount').val(data['AvailBal']);
				$('#ReqDepAvailableAmountReadOnly').val(data['AvailBal']);
				$('#UID').val(data['Rd_Uid']);
				RdAvail=$('#ReqDepAvailableAmount').val();
				RdPayable=(parseFloat(RdAvail)*0.8);
				$('#ReqDepLoanAmt').val(RdPayable);
				RdAccN=$('.ReqDepRDTypeAhead').val();
				$('#DepositAccountNum').val(RdAccN); //hidden textbox for depaccnum's
			}
		});
	});
	
	//FD Account Typeahead On Change
	$('#ReqDepFdAccNo').change(function(e){
		Fac=$('#ReqDepFdAccNo').data('value');
		e.preventDefault();
		$.ajax({
			url:'RetrieveFdAccDetail',
			type:'get',
			data:'&FdAccNum='+Fac,
			success:function(data){
				FullName=data['FDFn']+" . "+data['FDMn']+" . "+data['FDLn'];
				$('#ReqDepAccHoldFullName').val(FullName);
				$('#ReqDepAvailableAmount').val(data['AvailBal']);
				$('#ReqDepAvailableAmountReadOnly').val(data['AvailBal']);
				$('#UID').val(data['Fd_Uid']);
				FdAvail=$('#ReqDepAvailableAmount').val();
				FdPayable=(parseFloat(FdAvail)*0.8);
				$('#ReqDepLoanAmt').val(FdPayable);
				//alert(PigAvail);
				FdAccN=$('.ReqDepFDTypeAhead').val();
				$('#DepositAccountNum').val(FdAccN); //hidden textbox for depaccnum's
			}
		});
	});
	
	$('#ReqPersLoanType').change(function(e){
		loanid=$('#ReqPersLoanType').data('value');
		//loantext=$('#ReqPersLoanType :selected').text();
		$('#loantypeid').val(loanid);
	});
	
	$('#DepLoanType').change(function(e){
		dloanid=$('#DepLoanType').data('value');
		$('#loantypeid').val(dloanid);
	});
	
	/*$('input.ReqStfEmpnameTypeahead').typeahead({
		ajax:'/GetEmpName'
	});*/
	
	
	
	//To get Employee Detail when Employee name is selected
	
	$('.ReqStfEmpnameTypeahead').change(function(e){
		usr=$('.ReqStfEmpnameTypeahead').data('value');
		
		$.ajax({
			url:'/GetEmployeeDetail',
			type:'post',
			data:'&usrid='+usr,
			success:function(data)
			{
				$('#ReqStfemptype').val(data['emptype']);
				$('#joindate').val(data['joindte']);
				$('#ReqStfempsal').val(data['sal_amt']);
				//jdte=$('#joindate').val();
				jdte=data['joindte'].value();
				sal=$('#ReqStfempsal').val();
				emp_sal=parseFloat(sal);
				payamt=emp_sal*20;
				$('#ReqStfLoanAmt').val(payamt);
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
				$('#ReqStfempwrkexp').val(yearDiff);
			}
		});
		
	});
	
	$('input.ReqJwlCustnameTypeahead').typeahead({
		ajax:'/Getjewelcust'
	});
	
	</script>
	
