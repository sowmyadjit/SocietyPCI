

<script src="js/jquery.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<div id="content" class="col-md-12">
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
					
					<div class="form-group preacc">
						<label class="control-label col-sm-4" for="comment">Pigmy Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control PigmyAccNumTypeAhead" id="PigmyAccnum" name="PigmyAccnum" placeholder="SELECT Pigmy Account "/>
						</div>
					</div>
					
					<div class="form-group intacc">
						<label class="control-label col-sm-4" for="comment">Pigmy Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control PigmyIntAccNumTypeAhead" id="PigmyIntAccnum" name="PigmyIntAccnum" placeholder="SELECT IntPigmy Account "/>
						</div>
					</div>	
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="account" name="account">
					</div>
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="uid" name="uid">
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Customer Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="PigPayFullName" name="PigPayFullName" placeholder="FULL NAME" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="PigTot" name="PigTot" placeholder="TOTAL AMOUNT" disabled>
							<input type="text" class="form-control hidden" id="PigTotRec" name="PigTotRec">
						</div>
					</div>
					
					<div class="form-group pgint">
						<label class="control-label col-sm-4">Interest Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="Pigintamt" name="Pigintamt" placeholder="INTEREST AMOUNT" disabled>
						</div>
					</div>
					
					<div class="form-group pgcmded">
						<label class="control-label col-sm-4">Deduct Commission:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="Pigdedcom" name="Pigdedcom" placeholder="COMMISSION" disabled>
							<input type="text" class="form-control hidden" id="PigdedcomRec" name="PigdedcomRec">
						</div>
					</div>
					
					<div class="form-group pgdedamt">
						<label class="control-label col-sm-4">Deduction Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="Pigdedamt" name="Pigdedamt" placeholder="COMMISSION" disabled>
							<input type="text" class="form-control hidden" id="PigdedamtRec" name="PigdedamtRec">
						</div>
					</div>
					
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
								<option value="SB ACCOUNT">SB ACCOUNT</option>
							</select>
						</div>
					</div>
					<div class="form-group sbaccno">
						
						
						<div class="form-group sbaccnumb">
									<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
									<div class="col-sm-4">
										<input class="SBAccNumTypeAhead form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNum">  
					</div>
					</div>
						
						
						
						
						<div class="col-md-4">
							<input type="text" class="form-control hidden" id="sbaccnoreadonly" name="sbaccnoreadonly" placeholder="SB ACCOUNT NUMBER" disabled>
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
						<input type="text" class="form-control hidden" id="acnvalue" name="acnvalue">
						<input type="text" class="form-control hidden" id="actid" name="actid">
						<input type="text" class="form-control hidden" id="PigMaxRecId" name="PigMaxRecId">
						<input type="text" class="form-control hidden" id="PigFinalMaxRecId" name="PigFinalMaxRecId">
						
						
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
<script src="js/sidebar/sidebar.js"></script>
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
		pp++;
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
	$('.sbavailamtreadonly').hide();
	$('.sbremamtreadonly').hide();
	$('.sbaccno').hide();
	$('.ReceiptBtn').hide();
	
	
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
			$('.sbavailamtreadonly').hide();
			$('.sbremamtreadonly').hide();
			$('.sbaccno').hide();
			
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
			$('.sbaccno').hide();
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
			$('.sbaccno').show();
			/*usr=$('#uid').val();
			$.ajax({
				url:'GetSBForPigmiPayAmt',
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
						payamt=$('#PigPayableAmt').val();
						sbtotal=(parseFloat(payamt)+parseFloat(sbamt));
						$('#sbremamtreadonly').val(sbtotal);
						$('#sbremamt').val(sbtotal);
						$('#actid').val(data['actid']);
					}
					else
					{
						alert("SB Account Does not exist for this Customer. Please Create a SB Account");
					}
					
				}
			});*/
			
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
		//source:GetPigmyAccForPayAmt
	});
	
	//Typeahead for Pigmy Account Number from Interest Table (Newly Added)
	$('input.PigmyIntAccNumTypeAhead').typeahead({
		ajax:'/GetPigmyIntAccForPayAmt'
		//source:GetPigmyIntAccForPayAmt
	});
	
	// Hide and show
	$('.preacc').hide();
	$('.intacc').show();
	$('.pgint').show();
	$('.pgcmded').hide();
	$('.pgdedamt').hide();
	
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
			$('#PigTot').val("");
			$('#PigTotRec').val("");
			$('#Pigintamt').val("");
			$('#Pigdedcom').val("");
			$('#PigdedcomRec').val("");
			$('#Pigdedamt').val("");
			$('#PigdedamtRec').val("");
			$('.pgint').show();
			$('.pgcmded').hide();
			$('.pgdedamt').hide();
			$('.ReceiptBtn').hide();
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
			$('#Pigintamt').val("");
			$('#PigTot').val("");
			$('#PigTotRec').val("");
			$('#Pigdedamt').val("");
			$('#PigdedamtRec').val("");
			$('#Pigintamt').val("");
			$('#Pigdedcom').val("");
			$('#PigdedcomRec').val("");
			$('.pgint').hide();
			$('.pgcmded').show();
			$('.pgdedamt').show();
			$('.ReceiptBtn').show();
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
				$('#uid').val(data['uid']);
				$('#PigTot').val(data['mtot']);
				$('#PigTotRec').val(data['mtot']);
				$('#Pigintamt').val(data['intrst']);
				
				totamt=$('#PigPayableAmt').val();
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
				$('#uid').val(data['uid']);
				$('#account').val(PigmyAN);
				$('#PigTot').val(data['PgTot']);
				$('#PigTotRec').val(data['PgTot']);
				$('#Pigdedcom').val(data['PgCom']);
				$('#PigdedcomRec').val(data['PgCom']);
				$('#Pigdedamt').val(data['PgDed']);
				$('#PigdedamtRec').val(data['PgDed']);
				totamt1=$('#PigPayableAmt').val();
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
	
	$('.SBAccNumTypeAhead').typeahead({
		ajax:'/SBdlacc'
	});
	
	$('.SBAccNumTypeAhead').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAhead').data('value');
					a=1;
				$('#accid').val(AccNum);
				$('#actid').val(a);
			
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
					
						
						$('#sbavailamt').val(data['totamt']);
						sbamt=$('#sbavailamt').val();
						$('#sbavailamtreadonly').val(sbamt);
						$('#sbaccno').val(data['acnum']);
						$('#sbaccnoreadonly').val(data['acnum']);
						
					//	$('#accid').val(data['acid']);
						payamt=$('#PigPayableAmt').val();
						sbtotal=(parseFloat(payamt)+parseFloat(sbamt));
						$('#sbremamtreadonly').val(sbtotal);
						$('#sbremamt').val(sbtotal);
						//$('#actid').val(data['actid']);
					
					
					
					
						
					}
				});
			});
	
</script>						