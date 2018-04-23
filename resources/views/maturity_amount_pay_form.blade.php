

<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>

					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i>Maturity Deposit Pay Amount</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="col-md-8 col-md-offset-2 form-group">
						<div class="box-content">
							<div class="form-group">
								<label class="control-label col-sm-4">Payable Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="payable_amt" placeholder="PAYABLE AMOUNT" value="{{$data->Fd_TotalAmt}}" disabled>
								</div>
							</div>
						</div>
					</div>
						
					<div class="col-md-8 col-md-offset-2 form-group">
						<div class="box-content">
							<div class="form-group">
								<label class="control-label col-sm-4">Account Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="payable_amt" placeholder="PAYABLE AMOUNT" value="{{$data->Fd_CertificateNum}}" disabled>
								</div>
							</div>
						</div>
					</div>
						
					<div class="col-md-8 col-md-offset-2 form-group">
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
					</div>
					
					
					
					<div class="alert alert-success col-md-8 col-md-offset-2 mode_cheque hide">
						<div class="form-group chequenum col-md-12">
							
							<label class="control-label col-md-3">Cheque Number:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="FDPayChequeNum" name="FDPayChequeNum" placeholder="CHEQUE NUMBER">
							</div>
						</div>	
						
						<div class="form-group chequedte col-md-12">
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
						
						<div class="form-group bnknme col-md-12">
							<label class="control-label col-md-3">Bank Name:</label>
							<div class="col-md-6">
								<input type="text" class="form-control BankNameTypeAhead" id="FDPayBankName" name="FDPayBankName" placeholder="SELECT BANK">
							</div>
						</div>
						
						<div class="form-group bnkbranch col-md-12">
							<label class="control-label col-md-3">Bank Branch:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="FDPayBankBranch" name="FDPayBankBranch" placeholder="BANK BRANCH" disabled>
							</div>
						</div>		
						
						<div class="form-group ifsccde col-md-12">
							<label class="control-label col-md-3">IFSC Code:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="FDPayIfsc" name="FDPayIfsc" placeholder="IFSC CODE" disabled>
							</div>
						</div>
						
						<div class="form-group ifsccde col-md-12">
							<label class="control-label col-md-3">Account Number:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="FDPayAccountNumber" name="FDPayAccountNumber" placeholder="ACCOUNT NUMBER" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="acnvalue" name="acnvalue">
						<input type="text" class="form-control hidden" id="actid" name="actid">
					</div>
					
					<div class="alert alert-success col-md-8 col-md-offset-2 mode_sb">
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">Account Number:</label>
							<div class="col-md-4">
								<input class="typeahead form-control"  id="account" type="text" name="account" placeholder="SELECT Account Number">  
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<label class="control-label col-md-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sbaccnoreadonly" name="sbaccnoreadonly" placeholder="SB ACCOUNT NUMBER" disabled>
							</div>
						</div>
					
						<div class="form-group col-md-12">
							<label class="control-label col-md-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sbavailamtreadonly" name="sbavailamtreadonly" placeholder="SB AVAILABLE BALANCE" disabled>
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<label class="control-label col-md-4">SB Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sbremamtreadonly" name="sbremamtreadonly" placeholder="SB REMAINING BALANCE" disabled>
							</div>
						</div>
					</div>
				
				
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm" id="maturity_amt_create" />
							</div>
						</div>
					</center>
					
					
					

<script>
	$("#back").click(function() {
		$("#temp_box").html("");
		$("#deposit_details_box").show();
	})
</script>

<script>
	
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
</script>
<script src="js/bootstrap-typeahead.js"></script>
<script>
	//Typeahead for Bank Branch Name from AddBank Table
	$('input.BankNameTypeAhead').typeahead({
		ajax:'/GetBankNameForPayAmt'
	});
	$('input.typeahead').typeahead({
		//ajax: '/Getaccnum'
		source:Getaccnum
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
					$('#sbaccnoreadonly').val(data['acccn']);
					$('#sbavailamtreadonly').val(data['tot']);
					var tot_amt = parseInt ($('#sbavailamtreadonly').val());
					tot_amt += parseInt ($("#payable_amt").val());
					console.log(tot_amt);
					$('#sbremamtreadonly').val(tot_amt);
				}
				else
				{
					alert("SB Account Does not exist for this Customer. Please Create a SB Account");
				}
				
			}
		});
	});
</script>
