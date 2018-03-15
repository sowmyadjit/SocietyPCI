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
							
							
							
							<div class="DepositeLoan">
								<div class="form-group">
									
									<div class="form-group ">
										<label class="control-label col-sm-4"> Account Number:</label>
										<div id="the-basics" class="col-sm-4">
											<input class="form-control"  type="text" id="AccNo" value="{{$PgDL['DlAccNo']}}">  
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4"> Loan Number:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="loannum" name="loannum" value="{{$PgDL['loannum']}}"  >
										</div>
									</div>
									
								
									
									<div class="form-group">
										<label class="control-label col-sm-4">Old Loan Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="old_principalamt" name="old_principalamt" value="{{$PgDL['remamt']}}" >
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Old Loan Interest Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="old_interst_amt" name="old_interst_amt" value="{{$PgDL['intamt']}}" >
										</div>
									</div>
									
									<input type="text"id="charges" name="charges" class="hidden" value="{{$PgDL['charges']}}"/>
									<input type="text"id="amount" name="amount" class="hidden" value="{{$PgDL['amount']}}"/>
									<input type="text"id="loopid" name="loopid" class="hidden" value="{{$PgDL['loopid']}}"/>
									  	
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Amount:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="DepLoanAmt" name="DepLoanAmt" placeholder="ENTER LOAN AMOUNT">
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Charge:</label>
										<div class="col-sm-4">
											<select class="form-control LoanChargeDD"  id="LoanCharge" name="LoanCharge" >  
												<option value="">--Select Loan Charge--</option>
												<?php foreach($PgDL['LoanCharge'] as $key){
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
			payable=payable-<?php echo $PgDL['tot'];?>;
			$('#PayableAmount').val(payable);
			
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
				$('#DepLoanType').val(data['Pg_LType']);
				$('#DepLoanTypeID').val(data['PgLoan_TID']);
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
				$('#DepLoanType').val(data['Pg_LType']);
				$('#DepLoanTypeID').val(data['PgLoan_TID']);
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
				$('#DepLoanType').val(data['Pg_LType']);
				$('#DepLoanTypeID').val(data['PgLoan_TID']);
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
	
	
	
	
	
	
	
</script>


<script>
	x=0;
	$('.DepSbmBtn').click( function(e) {
		if(x==0)
		{
			x++;
			Bnkid=$('.DepLoanBankNameTypeAhead').data('value');
			accid=$('.typeahead').data('value');
			e.preventDefault();
			$.ajax({
				url: 'DL_Renew_Allocation',
				type: 'post',
				data: $('#form_loanalloc').serialize()+'&Bnkid='+Bnkid+'&accid='+accid,
				success: function(data) {
					//alert('success');
					$('.loanalcclassid').click();
				}
			});
		}
		
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
		accnum=$('#account').data('value');
		e.preventDefault();
		$.ajax({
			url:'retriveacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				$('#DepSBAvail').val(data['crbal']);
				$('#DepSBtype').val(data['acid']);
				
			}
		});
	});
	
	
</script>
