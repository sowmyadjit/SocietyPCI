

<script src="js/jquery.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i>		&nbsp Pay Amount</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "CreatePayAmount",'class' => 'form-horizontal','id' => 'FormPayAmount','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Interest Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="PigIntMode" name="PigIntMode">
								<option value="">--Select Interest Type--</option>
								<option value="INTEREST">INTEREST</option>
								<option value="PREWITHDRAWAL">PREWITHDRAWAL</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Pigmy Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control PigmyAccNumTypeAhead" id="PigmyAccnum" name="PigmyAccnum" placeholder="SELECT Pigmy Account "/>
						</div>
					</div>
					
					<div class="form-group intacc">
						<label class="control-label col-sm-4" for="comment">Pigmy Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control PigmyIntAccNumTypeAhead" id="PigmyIntAccnum" name="PigmyIntAccnum" placeholder="SELECT Pigmy Account "/>
						</div>
					</div>	
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="account" name="account">
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Customer Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="PigPayFullName" name="PigPayFullName" placeholder="FULL NAME" disabled>
						</div>
					</div>
					
					<!--	<div class="form-group">
						<label class="control-label col-sm-4">First Name:</label>
						<div class="col-md-4">
						<input type="text" class="form-control" id="PigPayFName" name="PigPayFName" placeholder="FIRST NAME" disabled>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">Middle Name:</label>
						<div class="col-md-4">
						<input type="text" class="form-control" id="PigPayMName" name="PigPayMName" placeholder="MIDDLE NAME" disabled>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">Last Name:</label>
						<div class="col-md-4">
						<input type="text" class="form-control" id="PigPayLName" name="PigPayLName" placeholder="LAST NAME" disabled>
						</div>
						</div>
						
					-->
					<div class="form-group">
						<label class="control-label col-sm-4">Payable Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="PigPayableAmtReadOnly" name="PigPayableAmtReadOnly" placeholder="PAYABLE AMOUNT" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="PigPayableAmt" name="PigPayableAmt" placeholder="PAYABLE AMOUNT">
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="PigPayMode" name="PigPayMode">
								<option value="">--Select Payment Mode--</option>
								<option value="CASH">CASH</option>
								<option value="CHEQUE">CHEQUE</option>
							</select>
						</div>
					</div>
					
					<div class="alert alert-success PigCheque col-md-8 col-md-offset-2">
						
						<div class="form-group chequenum">
							
							<label class="control-label col-md-3">Cheque Number:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="PigPayChequeNum" name="PigPayChequeNum" placeholder="CHEQUE NUMBER">
							</div>
						</div>
						
						<div class="form-group chequedte">
							<label class="col-md-3 control-label">CHEQUE DATE</label>
							<div class="col-md-6 date">
								
								<div class="input-group input-append">
									<input type="text" name="PigPayChequeDate" id="PigPayChequeDate" class="form-control" value=""/>
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
								<input type="text" class="form-control BankNameTypeAhead" id="PigPayBankName" name="PigPayBankName" placeholder="SELECT BANK">
							</div>
						</div>
						
						
						<div class="form-group bnkbranch">
							<label class="control-label col-md-3">Bank Branch:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="PigPayBankBranch" name="PigPayBankBranch" placeholder="BANK BRANCH" disabled>
							</div>
						</div>		
						
						
						<div class="form-group ifsccde">
							<label class="control-label col-md-3">IFSC Code:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="PigPayIfsc" name="PigPayIfsc" placeholder="IFSC CODE" disabled>
							</div>
						</div>
						
						
						<div class="form-group ifsccde">
							<label class="control-label col-md-3">Account Number:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="PigPayAccountNumber" name="PigPayAccountNumber" placeholder="ACCOUNT NUMBER" disabled>
							</div>
						</div>
						
						
					</div> <!--alert-success for PigmyPayAmt Cheque ends-->
					
					
					
					<center>
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm PigPaySbmBtn"/>
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
	pp=0;
	$('.sbmbtn').click( function(e) {
	if(pp==0)
	{
		//branchid=$('ul.typeahead li.active').data('value');
		
		e.preventDefault();
		$.ajax({
			url: 'PigmyPayAmount',
			type: 'post',
			data: $('#FormPigmyPayAmount').serialize(),
			success: function(data) {
				alert('success');
				$('.payclassid').click();
			}
			
		});
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
	
	//PaymentMode Changed (Newly Added)
	$('#PigPayMode').change( function(e) {
		e.preventDefault();
		mode=$('#PigPayMode').val();
		if(mode=="CASH")
		{
			$('.PigCheque').hide();
            $('.chequedte').hide();
            $('.chequenum').hide();
			$('.bnknme').hide();
            $('.bnkbranch').hide();
            $('.ifsccde').hide();
            
		}
		else if(mode=="CHEQUE"){
			$('.PigCheque').show();
			$('.chequedte').show();
            $('.chequenum').show();
			$('.bnknme').show();
            $('.bnkbranch').show();
            $('.ifsccde').show();
		}
		
		else{
			
			$('.PigCheque').hide();
            alert("Please Select the Payment Mode");
		}
	});
</script>



<script>
	//Typeahead for Bank Branch Name from AddBank Table
	$('input.BankNameTypeAhead').typeahead({
		ajax:'/GetBankNameForPayAmt'
	});
	
	//Typeahead for Pigmy Account Number from PreWithdrawel Table
	$('input.PigmyAccNumTypeAhead').typeahead({
		ajax:'/GetPigmyAccForPayAmt'
	});
	
	//Typeahead for Pigmy Account Number from Interest Table (Newly Added)
	$('input.PigmyIntAccNumTypeAhead').typeahead({
		ajax:'/GetPigmyIntAccForPayAmt'
	});
	
	// Hide and show
	$('.preacc').hide();
	$('.intacc').show();
	
	//Interest Type Changed
	$('#PigIntMode').change(function(e){
		pim=$('#PigIntMode').val();
		if(pim=="INTEREST")
		{
			$('.preacc').hide();
			$('.intacc').show();
			$('#PigmyAccnum').val("");
			$('#PigmyIntAccnum').val("");
			$('#PigmyIntAccnum').data("");
			$('#PigmyAccnum').data("");
			$('#PigPayFullName').val("");
			$('#PigPayableAmtReadOnly').val("");
			$('#PigPayableAmt').val("");
		}
		else if(pim=="PREWITHDRAWAL")
		{
			$('.preacc').show();
			$('.intacc').hide();
			$('#PigmyAccnum').val("");
			$('#PigmyIntAccnum').val("");
			$('#PigmyIntAccnum').data("");
			$('#PigmyAccnum').data("");
			$('#PigPayFullName').val("");
			$('#PigPayableAmtReadOnly').val("");
			$('#PigPayableAmt').val("");
		}
		else
		{
			alert("Please select the interest type");
		}
		
	});
	
	//Typeahed of interest pigmy account number Changed
	$('#PigmyIntAccnum').change(function(e){
		PigmyIntac=$('#PigmyIntAccnum').val();
		e.preventDefault();
		$.ajax({
			url:'GetPigmyIntDetailsForPayAmt',
			type:'get',
			data:'&PigmyIntAccNum='+PigmyIntac,
			success:function(data)
			{
				$('#PigPayableAmt').val(data['TotIntPayAmt']);
				$('#PigPayableAmtReadOnly').val(data['TotIntPayAmt']);
				TEST=data['PigmyIntFn']+" . "+data['PigmyIntMn']+" . "+data['PigmyIntLn'];
				$('#PigPayFullName').val(TEST);
				$('#account').val(PigmyIntac);
				
			}
		});
		
	});
</script>

<script>
	//PigmiAccount Number Changed
	$('.PigmyAccNumTypeAhead').change(function(e){
		
		PigmyAN=$('.PigmyAccNumTypeAhead').val();
		e.preventDefault();
		$.ajax({
			url:'GetPigmyDetailsForPayAmt',
			type:'get',
			data:'&PigmyAccNum='+PigmyAN,
			success:function(data)
			{
				//$('#PigPayFName').val(data['PigmyFn']);
				//$('#PigPayMName').val(data['PigmyMn']);
				//$('#PigPayLName').val(data['PigmyLn']);
				$('#PigPayableAmt').val(data['TotPayAmt']);
				$('#PigPayableAmtReadOnly').val(data['TotPayAmt']);
				TEST=data['PigmyFn']+" . "+data['PigmyMn']+" . "+data['PigmyLn'];
				$('#PigPayFullName').val(TEST);
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
				$('#PigPayBankBranch').val(data['Branch']);
				
				$('#PigPayIfsc').val(data['IFSC']);
				
				$('#PigPayAccountNumber').val(data['AccountNo']);
				
			}
		});
	});
</script>

<script>
	//Pigmi Submit button
	
	$('.PigPaySbmBtn').click( function(e) {
		pmode=$('#PigPayMode').val();
		if(pmode=="CASH")
		{
			$("#FormPayAmount").validate({
				
				rules:{
					PigmyAccnum:"required",
					PigPayableAmt:{
						required:true,
						number:true
					},
					
					PigPayMode:"required",
					
					
				}
				
			});
		}
		
		else
		{
			$("#FormPayAmount").validate({
				
				rules:{
					PigmyAccnum:"required",
					PigPayableAmt:{
						required:true,
						number:true
					},
					
					PigPayMode:"required",
					PigPayChequeNum:"required",
					PigPayChequeDate:"required",
					PigPayBankName:"required",
					
					
				}
				
			});
			
			
		}
		
		if($("#FormPayAmount").valid())
		{
			//PayMode=$('#PigPayMode').val();
			Bnkid=$('.BankNameTypeAhead').data('value');
			//PigmyAN=$('.PigmyAccNumTypeAhead').val();
			e.preventDefault();
			$.ajax({
				url: 'PigmyPayAmount',
				type: 'post',
				data: $('#FormPayAmount').serialize()+'&BankId='+Bnkid,
				success: function(data) {
					alert('success');
					// $('.tranclassid').click();
				}
			});
		}
		
	});
</script>


<script>
	//PigmyPay Cheque Date
	//var PigPayChequeDate;
	
    $('input[name="PigPayChequeDate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
		    format: 'DD-MM-YYYY'
		},
		
		
	});
	
	//to get blank initially
	$('input[name="PigPayChequeDate"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
	});
	
    $('input[name="PigPayChequeDate"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
	});
    
	
</script>