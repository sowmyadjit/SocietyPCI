


<script src="js/jquery.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<div class="SearchRes">
	<div id="content" class="col-md-12">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i>		&nbsp FD Pay Amount</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					
					<div class="box-content">
						{!! Form::open(['url' => "CreateFDPayAmount",'class' => 'form-horizontal','id' => 'FDFormPayAmount','method'=>'post']) !!}
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Type:</label>
							<div class="col-md-4">
								<select class="form-control" id="FDPaymntMode" name="FDPaymntMode">
									<option value="">--Select Payment Type--</option>
									<option value="MATURED">MATURED PAYMENT</option>
									<option value="PREWITHDRAWAL">PREWITHDRAWAL PAYMENT</option>
								</select>
							</div>
						</div>
						
						<div class="form-group preacc">
							<label class="control-label col-sm-4" for="comment">FD Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control FDAccNumTypeAhead" id="FDAccnum" name="FDAccnum" placeholder="SELECT FD ACCOUNT "/>
							</div>
						</div>
						
						<div class="form-group intacc">
							<label class="control-label col-sm-4" for="comment">FD Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control FDMatuAccNumTypeAhead" id="FDMatuAccnum" name="FDMatuAccnum" placeholder="SELECT FD INTEREST ACCOUNT "/>
							</div>
						</div>	
						
						<div class="col-md-4 ">
							<input type="text" class="form-control" id="fdaccount" name="fdaccount">
						</div>
						
						<div class="col-md-4 hidden">
							<input type="text" class="form-control" id="uid" name="uid">
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="FDPayFullName" name="FDPayFullName" placeholder="FULL NAME" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Total Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdTot" name="fdTot" placeholder="TOTAL AMOUNT" disabled>
							</div>
						</div>
						
						<div class="form-group rdint">
							<label class="control-label col-sm-4">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdintamt" name="fdintamt" placeholder="INTEREST AMOUNT" disabled>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payable Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="FDPayableAmtReadOnly" name="FDPayableAmtReadOnly" placeholder="PAYABLE AMOUNT" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="FDPayableAmt" name="FDPayableAmt" placeholder="PAYABLE AMOUNT">
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="FDPayMode" name="FDPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
							</div>
						</div>
						<div class="form-group sbaccnoreadonly">
							<div class="form-group">
								<label class="control-label col-sm-4">Account Number:</label>
								<div class="col-md-4">
									<input class="typeahead form-control"  id="account" type="text" name="account" placeholder="SELECT Account Number">  
								</div>
							</div>
							
							<label class="control-label col-md-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sbaccnoreadonly" name="sbaccnoreadonly" placeholder="SB ACCOUNT NUMBER" disabled>
							</div>
						</div>
						
						<div class="form-group sbavailamtreadonly">
							
							<label class="control-label col-md-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sbavailamtreadonly" name="sbavailamtreadonly" placeholder="SB AVAILABLE BALANCE" disabled>
							</div>
						</div>
						<div class="form-group sbremamtreadonly">
							
							<label class="control-label col-md-4">SB Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sbremamtreadonly" name="sbremamtreadonly" placeholder="SB REMAINING BALANCE" disabled>
							</div>
						</div>
						
						<input type="text" class="form-control hidden" id="sbremamt" name="sbremamt">
						
						<input type="text" class="form-control hidden" id="sbavailamt" name="sbavailamt">
						<input type="text" class="form-control hidden" id="accid" name="accid">
						<input type="text" class="form-control hidden" id="sbaccno" name="sbaccno">
						
						<div class="alert alert-success PigCheque col-md-8 col-md-offset-2">
							
							<div class="form-group chequenum">
								
								<label class="control-label col-md-3">Cheque Number:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="FDPayChequeNum" name="FDPayChequeNum" placeholder="CHEQUE NUMBER">
								</div>
							</div>	
							
							<div class="form-group chequedte">
								<label class="col-md-3 control-label">CHEQUE DATE</label>
								<div class="col-md-6 date">
									
									<div class="input-group input-append">
										<input type="text" name="FDPayChequeDate" id="FDPayChequeDate" class="form-control" value=""/>
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
									<input type="text" class="form-control BankNameTypeAhead" id="FDPayBankName" name="FDPayBankName" placeholder="SELECT BANK">
								</div>
							</div>
							
							
							<div class="form-group bnkbranch">
								<label class="control-label col-md-3">Bank Branch:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="FDPayBankBranch" name="FDPayBankBranch" placeholder="BANK BRANCH" disabled>
								</div>
							</div>		
							
							
							<div class="form-group ifsccde">
								<label class="control-label col-md-3">IFSC Code:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="FDPayIfsc" name="FDPayIfsc" placeholder="IFSC CODE" disabled>
								</div>
							</div>
							
							
							<div class="form-group ifsccde">
								<label class="control-label col-md-3">Account Number:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="FDPayAccountNumber" name="FDPayAccountNumber" placeholder="ACCOUNT NUMBER" disabled>
								</div>
							</div>
							<input type="text" class="form-control hidden" id="acnvalue" name="acnvalue">
							<input type="text" class="form-control hidden" id="actid" name="actid">
							
						</div> <!--alert-success for PigmyPayAmt Cheque ends-->
						
						
						
						<center>
							
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm FDPaySbmBtn"/>
									<input type="button" value="Renew" class="btn btn-success btn-sm FDPayrenew"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
						
						
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!--------------------------------------------------------------------------------->	
<script src="js/bootstrap-typeahead.js"></script>

<script src="js/jquery.validate.min.js"></script>
<script>
	branchid=0;
	
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			$('.payclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.resetbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			
			return true;
		}
		else{
			return false;
		}
		
	});
	
</script>


<script>
	//Hide Cheque Number and Cheque Date (Newly Added)
	$('.PigCheque').hide();
	$('.chequedte').hide();
	$('.chequenum').hide();
	$('.bnknme').hide();
	$('.bnkbranch').hide();
	$('.ifsccde').hide();
	$('.sbavailamtreadonly').hide();
	$('.sbremamtreadonly').hide();
	$('.sbaccnoreadonly').hide();
	
	//PaymentMode Changed (Newly Added)
	$('#FDPayMode').change( function(e) {
		e.preventDefault();
		mode=$('#FDPayMode').val();
		
		if(mode=="CASH")
		{
			$('.PigCheque').hide();
			$('.chequedte').hide();
			$('.chequenum').hide();
			$('.bnknme').hide();
			$('.bnkbranch').hide();
			$('.ifsccde').hide();
			$('.sbavailamtreadonly').hide();
			$('.sbremamtreadonly').hide();
			$('.sbaccnoreadonly').hide();
			
		}
		else if(mode=="CHEQUE"){
			$('.PigCheque').show();
			$('.chequedte').show();
			$('.chequenum').show();
			$('.bnknme').show();
			$('.bnkbranch').show();
			$('.ifsccde').show();
			$('.sbavailamtreadonly').hide();
			$('.sbremamtreadonly').hide();
			$('.sbaccnoreadonly').hide();
		}
		else if(mode=="SB ACCOUNT"){
			$('.PigCheque').hide();
			$('.chequedte').hide();
			$('.chequenum').hide();
			$('.bnknme').hide();
			$('.bnkbranch').hide();
			$('.ifsccde').hide();
			$('.sbavailamtreadonly').show();
			$('.sbremamtreadonly').show();
			$('.sbaccnoreadonly').show();
			
			
		}
		
		else{
			
			//$('.PigCheque').hide();
			alert("Please Select the Payment Mode");
		}
	});
</script>



<script>
	
	$('#account').change( function(e) {
		usr=$('#account').data('value');
		$.ajax({
			url:'GetSBForFDPayAmt',
			type:'post',
			data:'&usrid='+usr,
			success:function(data){
				
				$('#acnvalue').val(data['acn']);
				acnval=$('#acnvalue').val();
				if(acnval==0)
				{
					//alert(acn);
					$('#sbavailamt').val(data['tot']);
					sbamt=$('#sbavailamt').val();
					$('#sbavailamtreadonly').val(sbamt);
					$('#sbaccno').val(data['acccn']);
					$('#sbaccnoreadonly').val(data['acccn']);
					$('#accid').val(data['acid']);
					payamt=$('#FDPayableAmt').val();
					sbtotal=(parseFloat(payamt)+parseFloat(sbamt));
					//	sbtotal=payamt+sbamt;
					
					$('#sbremamtreadonly').val(sbtotal);
					$('#sbremamt').val(sbtotal);
					$('#actid').val(data['actid']);
				}
				else
				{
					alert("SB Account Does not exist for this Customer. Please Create a SB Account");
				}
				
			}
		});
	});
	
	$('input.typeahead').typeahead({
		//ajax: '/Getaccnum'
		source:Getaccnum
	});
	//Typeahead for Bank Branch Name from AddBank Table
	$('input.BankNameTypeAhead').typeahead({
		ajax:'/GetBankNameForPayAmt'
	});
	
	//Typeahead for Pigmy Account Number from PreWithdrawel Table
	$('input.FDAccNumTypeAhead').typeahead({
		ajax:'/GetFDAccForPayAmt'
	});
	
	//Typeahead for Pigmy Account Number from Interest Table (Newly Added)
	$('input.FDMatuAccNumTypeAhead').typeahead({
		ajax:'/GetFDMatuAccForPayAmt'
	});
	
	// Hide and show
	$('.preacc').hide();
	$('.intacc').show();
	
	//Interest Type Changed
	$('#FDPaymntMode').change(function(e){
		pim=$('#FDPaymntMode').val();
		if(pim=="MATURED")
		{
			$('.preacc').hide();
			$('.intacc').show();
			$('#FDAccnum').val("");
			$('#FDMatuAccnum').val("");
			$('#FDMatuAccnum').data("");
			$('#FDAccnum').data("");
			$('#FDPayFullName').val("");
			$('#FDPayableAmtReadOnly').val("");
			$('#FDPayableAmt').val("");
			$('#fdTot').val("");
			$('#fdintamt').val("");
		}
		else if(pim=="PREWITHDRAWAL")
		{
			$('.preacc').show();
			$('.intacc').hide();
			$('#FDAccnum').val("");
			$('#FDMatuAccnum').val("");
			$('#FDMatuAccnum').data("");
			$('#FDAccnum').data("");
			$('#FDPayFullName').val("");
			$('#FDPayableAmtReadOnly').val("");
			$('#FDPayableAmt').val("");
			$('#fdTot').val("");
			$('#fdintamt').val("");
		}
		else
		{
			alert("Please select the interest type");
		}
		
	});
	
	//Typeahed of interest RD account number Changed
	$('#FDMatuAccnum').change(function(e){
		FDMatuac=$('#FDMatuAccnum').val();
		e.preventDefault();
		$.ajax({
			url:'GetFDMatuDetailsForPayAmt',
			type:'get',
			data:'&FDMatuAccNum='+FDMatuac,
			success:function(data)
			{
				$('#FDPayableAmt').val(data['FDIntPayAmt']);
				
				$('#FDPayableAmtReadOnly').val(data['FDIntPayAmt']);
				TEST=data['FDIntFn']+" . "+data['FDIntMn']+" . "+data['FDIntLn'];
				$('#FDPayFullName').val(TEST);
				$('#fdaccount').val(FDMatuac);
				$('#uid').val(data['uid']);
				$('#fdTot').val(data['FDIntTot']);
				$('#fdintamt').val(data['FDIntAmt']);
				//payamt=parseFloat(totamt);
				//alert(totamt);
				totamt=$('#FDPayableAmt').val();
				payamt=parseFloat(totamt);
				if(payamt>20000)
				{
					alert("Amount Payable is Greater than 20,000. Please Transfer to SB Account");
				}
				
				
				
			}
		});
		
	});
</script>

<script>
	//PigmiAccount Number Changed
	$('.FDAccNumTypeAhead').change(function(e){
		
		FDAN=$('.FDAccNumTypeAhead').val();
		e.preventDefault();
		$.ajax({
			url:'GetFDDetailsForPayAmt',
			type:'get',
			data:'&FDAccNum='+FDAN,
			success:function(data)
			{
				
				$('#FDPayableAmt').val(data['FDPayAmt']);
				$('#FDPayableAmtReadOnly').val(data['FDPayAmt']);
				TEST=data['FDFn']+" . "+data['FDMn']+" . "+data['FDLn'];
				$('#FDPayFullName').val(TEST);
				$('#uid').val(data['uid']);
				$('#fdTot').val(data['FDTot']);
				$('#fdintamt').val(data['FDIntAmt'])
				$('#fdaccount').val(data['acc'])
				$('#rdaccount').val(FDAN);
				totamt1=$('#FDPayableAmt').val();
				payamt1=parseFloat(totamt1);
				if(payamt1>20000)
				{
					alert("Amount Payable is Greater than 20,000. Please Transfer to SB Account");
				}
				
			}
		});
	});
	
	//BankName Changed
	$('.BankNameTypeAhead').change(function(e){
		
		Bnkid=$('.BankNameTypeAhead').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'GetBankDetailsForPayAmt',
			type:'get',
			data:'&BankId='+Bnkid,
			success:function(data)
			{									   
				$('#FDPayBankBranch').val(data['Branch']);
				
				$('#FDPayIfsc').val(data['IFSC']);
				
				$('#FDPayAccountNumber').val(data['AccountNo']);
				
				$('#FDPayBankName').val(data['BankName']);
				
			}
		});
	});
</script>

<script>//CHANGES DONE TILL HERE, SUBMIT FUNCTION AND TABLE FOR RDPAYAMT HAS TO DONE
	//Pigmi Submit button
	pf=0;
	$('.FDPaySbmBtn').click( function(e) {
		if(pf==0)
		{
			pf++;
			
			fdaccno=$('#FDAccnum').val();
			pmode=$('#FDPayMode').val();
			if(pmode=="CASH")
			{
				//alert("CASH");
				$("#FDFormPayAmount").validate({
					
					rules:{
						FDAccnum:"required",
						FDPayableAmt:{
							required:true,
							number:true
						},
						
						//RDPayMode:"required",
						
						
					}
					
				});
			}
			
			else
			{
				$("#FDFormPayAmount").validate({
					
					rules:{
						FDAccnum:"required",
						FDPayableAmt:{
							required:true,
							number:true
						},
						
						FDPayMode:"required",
						//RDChequeNum:"required",
						//RDPayChequeDate:"required",
						//RDPayBankName:"required",
						
						
					}
					
				});
				
				
			}
			
			if($("#FDFormPayAmount").valid())
			{
				//PayMode=$('#PigPayMode').val();
				Bnkid=$('.BankNameTypeAhead').data('value');
				//PigmyAN=$('.PigmyAccNumTypeAhead').val();
				e.preventDefault();
				$.ajax({
					url: 'FDPayAmount',
					type: 'post',
					data: $('#FDFormPayAmount').serialize()+'&BankId='+Bnkid+'$fdaccno='+fdaccno,
					success: function(data) {
						alert('success');
						// $('.tranclassid').click();
					}
				});
			}
		}
	});
</script>


<script>
	//PigmyPay Cheque Date
	//var PigPayChequeDate;
	
	$('input[name="FDPayChequeDate"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'DD-MM-YYYY'
		},
		
		
	});
	
	//to get blank initially
	$('input[name="FDPayChequeDate"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD-MM-YYYY'));
	});
	
	$('input[name="FDPayChequeDate"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
	$('.FDPayrenew').click( function(e) {
		
		fdtype=$('#FDPaymntMode').val();
		fdaccno=$('#FDAccnum').data('value');
		fdmatureaccno=$('#FDMatuAccnum').data('value');
		
		$.ajax({
			url: 'fdrenew',
			type: 'post',
			data: '&fdtype='+fdtype+'&fdaccno='+fdaccno+'&fdmatureaccno='+fdmatureaccno,
			success: function(data) {
				alert('success');
				// $('.tranclassid').click();
				
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
			}
		});
	});
	
</script>							