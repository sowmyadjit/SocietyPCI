<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
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
					{!! Form::open(['url' => 'CreatePersLoanAllocation','class' => 'form-horizontal','id' => 'form_loanalloc','method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}
					
					
					<div class="StaffLoan">
						<div class="form-group">
							<div class="col-md-6 alert-success">
								<div class="row">
									
									
								
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Account Number:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="accno" name="accno" value="{{$plall['plloanno']}}">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Old Principal Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="oldprincpalamt" name="oldprincpalamt"value="{{$plall['plremamt']}}">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Old Interest Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="oldinterestamt" name="oldinterestamt"value="{{$plall['plintamt']}}">
											
											<input type="text" class="form-control" id="amount" name="amount"value="{{$plall['amount']}}">
											<input type="text" class="form-control" id="charges" name="charges"value="{{$plall['charges']}}">
											<input type="text" class="form-control" id="loopid" name="loopid"value="{{$plall['loopid']}}">
											<input type="text" class="form-control" id="tot" name="tot"value="{{$plall['tot']}}">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Duration In Years:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="LoanDurationYears" name="LoanDurationYears" placeholder="ENTER YEARS"/>
											
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="loanamt" name="loanamt" onblur="GetLoanCharge();">
										</div>
									</div>
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Other Charge(%):</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersOthrChrges" name="PersOthrChrges" placeholder="OTHER CHARGE" onclick="CheckInCash()">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Book and Forms Charge(%):</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersBkfrmChrg" name="PersBkfrmChrg" placeholder="BOOK AND FORMS CHARGE">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Adjustment Charge(%):</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersAdjChrg" name="PersAdjChrg" placeholder="ADJUSTMENT CHARGE">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Share Charge:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersShrChrg" name="PersShrChrg" value="630">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Insurance Charge:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="Insurance" name="Insurance" placeholder="Insurance CHARGE"onblur="deduct()">
										</div>
									</div>
									
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Payable Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersPayAmt" name="PersPayAmt" placeholder="PAYABLE AMOUNT" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Duration In Years:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="LoanDurationYears" name="LoanDurationYears" placeholder="ENTER YEARS" onblur="LoanEndDate();" onkeyup="CalcDays();"/>
											
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="col-md-6 alert-success">
								<div class="row">
									
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Start Date:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersLoanStartDate" name="PersLoanStartDate" value="<?php echo date('Y-m-d');?>">
										</div>
									</div>
									<input type="text" class="form-control hidden" id="PersLoanStartDate1" name="PersLoanStartDate1" value="<?php echo date('d/m/Y');?>">
									<div class="form-group">
										
										<label class="control-label col-sm-4">End Date:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersLoanEndDate" name="PersLoanEndDate" placeholder="ENTER END DATE" Required>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Payment Mode:</label>
										<div class="col-md-6">
											<select class="form-control" id="PersLoanPayMode" name="PersLoanPayMode">
												<option value="">--Select Payment Mode--</option>
												<option value="CASH">CASH</option>
												<option value="CHEQUE">CHEQUE</option>
												<option value="SB ACCOUNT">SB ACCOUNT</option>
											</select>
										</div>
									</div>
									
									<div class="form-group sbaccnumb">
										<label class="control-label col-sm-4">SB Account Number:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersLoanSBAccountNum" name="PersLoanSBAccountNum" disabled>
										</div>
									</div>
									<input type="text" class="form-control hidden" id="PersLoanSBAcNum" name="PersLoanSBAcNum" >
									
									<div class="form-group sbavailable">
										<label class="control-label col-sm-4">SB Available Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersSBAvail" name="PersSBAvail" disabled>
											<input type="text" class="form-control hidden" id="PersSBAvailhidn" name="PersSBAvailhidn">
										</div>
									</div>
									
									<div class="form-group sbtotamt">
										<label class="control-label col-sm-4">SB Total Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="PersLoanSBtotal" name="PersLoanSBtotal" disabled>
											<input type="text" class="form-control hidden" id="PersLoanSBtotalhidn" name="PersLoanSBtotalhidn">
										</div>
									</div>
									
									<div class="PersLoanCheque">
										<div class="form-group">
											<label class="control-label col-md-4">Cheque Number:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="PersLoanChequeNum" name="PersLoanChequeNum" placeholder="CHEQUE NUMBER">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-4 control-label">CHEQUE DATE</label>
											<div class="col-md-6 date">
												<div class="input-group input-append">
													<input type="text" name="PersLoanChequeDte" id="PersLoanChequeDte" class="form-control" value=""/>
													<span class="input-group-addon add-on">
														<span class="glyphicon glyphicon-calendar">
														</span>
														<b class="caret"></b>
													</span> 
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-4">Bank Name:</label>
											<div class="col-md-6">
												<input type="text" class="form-control PersLoanBankNameTypeAhead" id="PersLoanBankName" name="PersLoanBankName" placeholder="SELECT BANK">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-4">Bank Branch:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="PersLoanBankBranch" name="PersLoanBankBranch" placeholder="BANK BRANCH" disabled>
											</div>
										</div>		
										
										<div class="form-group">
											<label class="control-label col-md-4">IFSC Code:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="PersLoanIFSC" name="PersLoanIFSC" placeholder="IFSC CODE" disabled>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-4">Account Number:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="PersLoanBankAccNumber" name="PersLoanBankAccNumber" placeholder="ACCOUNT NUMBER" disabled>
											</div>
										</div>
										<!-- alert-success for PigmyPayAmt Cheque ends-->
									</div>
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="PersLoanSBCheck" name="PersLoanSBCheck">
									</div>
									
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="Persmname" name="Persmname">
									</div>
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="Persfname" name="Persfname" >
									</div>
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="Perslname" name="Perslname" >
									</div>
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="Persuid" name="Persuid" >
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="YearInDays" name="YearInDays" value="365">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="PersLoanInhand" name="PersLoanInhand">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="PersLoanSBAccid" name="PersLoanSBAccid">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="PersLoanSBAccTid" name="PersLoanSBAccTid">
									</div>
									
									<div class="col-md-4 hidden">
										<input type="text" class="form-control" id="PersLoanBankID" name="PersLoanBankID">
									</div>
								</div>
							</div>	
						</div>
					</div>
					
					
					
						
						
						
						
					</div> 
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<!--<input type="button" value="CREATE" class="btn btn-success btn-sm PersSbmBtn"/>-->
								<input type="submit" value="CREATE" class="btn btn-success btn-sm PersSbmBtn"/>
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
	//$('.DurTextDay').hide();
	//$('.DurTextYear').hide();
	$('.PersLoanCheque').hide();
	$('.sbavailable').hide();
	$('.sbaccnumb').hide();
	$('.sbtotamt').hide();
	
	//PaymentMode Changed Event
	$('#PersLoanPayMode').change( function(e) {
		e.preventDefault();
		mode=$('#PersLoanPayMode').val();
		if(mode=="CASH")
		{
			$('.PersLoanCheque').hide();
			$('.sbavailable').hide();
			$('.sbaccnumb').hide();
			$('.sbtotamt').hide();
		}
		else if(mode=="CHEQUE"){
			$('.PersLoanCheque').show();
			$('.sbavailable').hide();
			$('.sbaccnumb').hide();
			$('.sbtotamt').hide();
			
		}
		else if(mode=="SB ACCOUNT"){
			$('.PersLoanCheque').hide();
            $('.sbavailable').show();
			$('.sbaccnumb').show();
			$('.sbtotamt').show();
			memidsb=$('#PersMemname').data('value');
			$.ajax({
				url:'/GetMemSBDetailView',
				type:'post',
				data:'&sbmembrid='+memidsb,
				success:function(data)
				{
					$('#PersLoanSBAccountNum').val(data['sbacno']);
					$('#PersLoanSBAcNum').val(data['sbacno']);
					$('#PersSBAvail').val(data['sbtot']);
					$('#PersSBAvailhidn').val(data['sbtot']);
					$('#PersLoanSBAccid').val(data['sbaccid']);
					$('#PersLoanSBAccTid').val(data['sbactid']);
					$('#Persuid').val(data['uid']);
					$('#Persfname').val(data['fn']);
					$('#Persmname').val(data['mn']);
					$('#Perslname').val(data['ln']);
					
					sbavail=$('#PersSBAvailhidn').val();
					pay=$('#PersPayAmt').val();
					sbavailamt=(parseFloat(sbavail)+parseFloat(pay));
					sbavailamt1=parseFloat(sbavailamt);
					$('#PersLoanSBtotal').val(sbavailamt1);
					$('#PersLoanSBtotalhidn').val(sbavailamt1);
				}
			});
		}
		else
		{
            alert("Please Select the Payment Mode");
		}
	});
	
	//Get Members using typeahead
	$('input.PersMemnameTypeahead').typeahead({
		ajax: '/GetMembersForPersLoanAlloc'
	});
	
	//Get First Surety using typeahead
	$('input.PersWitness1TypeAhead').typeahead({
		ajax: '/GetMembers'
	});
	
	//Get Second Surety using typeahead
	$('input.persWitness2TypeAhead').typeahead({
		ajax: '/GetMembers'
	});
	
	//End Date Calculation While Duration in Years
	
	
	
	
	
	
	
	//Get details of loan charges  and Calculate Payable Amount
	function GetLoanCharge()
	{
		
		$.ajax({
			url:'/GetCharges',
			type:'get',
			success:function(data)
			{
				
				Othrchrg=data['other_charge'];
				BkfrmChrg=data['book_form'];
				AdjChrg=data['adj_charge'];
				
				
				LoanAmt=$('#loanamt').val();
				
				
				TotOthrchrg=((LoanAmt*Othrchrg)/100);
				TotBkfrmChrg=((LoanAmt*BkfrmChrg)/100);
				TotAdjChrg=((LoanAmt*AdjChrg)/100);
				
				
				ShareChrg=630;
				
				TotAdjChrg=TotAdjChrg/200;
				
				TotAdjChrg=Math.ceil(TotAdjChrg);
				
				totadjustcharg=TotAdjChrg*200;
				adjuctfees=TotAdjChrg*10;
				TotAdjChrg=totadjustcharg+adjuctfees;
				
				TotOthrchrg=Math.round(TotOthrchrg);
				TotBkfrmChrg=Math.round(TotBkfrmChrg);
				TotAdjChrg=Math.round(TotAdjChrg);
				
				$('#PersOthrChrges').val(TotOthrchrg);
				$('#PersBkfrmChrg').val(TotBkfrmChrg);
				$('#PersAdjChrg').val(TotAdjChrg);
				
				ShareChrg=Math.round(ShareChrg);
				amt=(parseFloat(TotOthrchrg)+parseFloat(TotBkfrmChrg)+parseFloat(TotAdjChrg)+parseFloat(ShareChrg));
				LoanAmt=Math.round(LoanAmt);
				amt=Math.round(amt);
				payamt=LoanAmt-amt;
				//insu=$('#Insurance').val();
				$('#PersPayAmt').val(payamt);
				
				
				Amount=(parseFloat(LoanAmt));
				
			}
		});
		var year1=$('#LoanDurationYears').val();
		var dateObj = new Date();
		var month = dateObj.getUTCMonth() + 1; //months from 1-12
		var day = dateObj.getUTCDate();
		var year = dateObj.getUTCFullYear();
		var newdate2 = day + "/" + month + "/" + year;
		var totyears=parseInt(year)+parseInt(year1);
		var newdate1 = day + "/" + month + "/" + totyears;
		var m = moment(newdate1, 'DD/MM/YYYY');
		var hhx=m.isValid(); // false
		
		while(hhx==false)
		{
			
			day=parseInt(day)-1;
			newdate1 = day + "/" + month + "/" + totyears;
			m = moment(newdate1, 'DD/MM/YYYY');
			hhx=m.isValid(); // false
		}
		
		newDate=newdate1;
		document.getElementById('PersLoanEndDate').value = newDate;
	}
	
	//Typeahead for Bank Branch Name from AddBank Table
	$('input.PersLoanBankNameTypeAhead').typeahead({
		ajax:'/GetBankNameForPayAmt'
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
	
	
	//To get Cheque Date
	var PersLoanChequeDte;
	$('input[name="PersLoanChequeDte"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'YYYY-MM-DD'
		},
	});
	
	//to get blank initially
	$('input[name="PersLoanChequeDte"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY-MM-DD'));
	});
	
	$('input[name="PersLoanChequeDte"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
	
	//BankName Changed
	$('.PersLoanBankNameTypeAhead').change(function(e){
		
		Bnkid=$('.PersLoanBankNameTypeAhead').data('value');
		$('#PersLoanBankID').val(Bnkid);
		e.preventDefault();
		$.ajax({
			url:'GetBankDetailsForPersLoan',
			type:'post',
			data:'&BankId='+Bnkid,
			success:function(data)
			{
				$('#PersLoanBankBranch').val(data['Branch']);
				$('#PersLoanIFSC').val(data['IFSC']);
				$('#PersLoanBankAccNumber').val(data['AccountNo']);
			}
		});
	});
	
	//Submit Button Code
	indexid=0;
	$('.PersSbmBtn').click( function(e) 
	{
		if(indexid==0)
		{
			//indexid++;
			
			e.preventDefault();
			$.ajax({
				url: 'CreatePersLoanAllocation_renewal',
				type: 'post',
				data: $('#form_loanalloc').serialize(),
				success: function(data) {
					//$('.ploanclassid').click();
				}
			});
		}
	});
	
	//EMI Calculation
	function CalcEMI()
	{
		payable=$('#PersPayAmt').val();
		payableamt=(parseFloat(payable));
		dur=$('#LoanDurationYears').val();
		duration=dur*12;
	totmonth=(parseInt(duration));
	EMIAmt=payableamt/totmonth;
	$('#PersEMIAmt').val(EMIAmt);
	}
	
	
	
	function deduct()
	{
		
		insu=$('#Insurance').val();
		payable=$('#PersPayAmt').val();
		amt=payable-insu;
		
		$('#PersPayAmt').val(amt);
		
	}
	
</script>


<style>
	input[type=file]{ 
	color:transparent;
    }
</style>

