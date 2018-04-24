<style>
	#create {
		margin-bottom : 20px;
	}
</style>

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
				
				<form id="form_data" name="form_data">
					<div class="col-md-8 col-md-offset-2 form-group">
						<label class="col-md-4 control-label">DATE</label>
						<div class="col-md-4 date">
							
							<div class="input-group input-append">
								<input type="text" id="tran_date" name="tran_date" class="form-control" value="{{date('d-m-Y')}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
									<b class="caret"></b>
								</span> 
							</div>
							
						</div>
					</div>
						
					<div class="col-md-8 col-md-offset-2 form-group">
						<div class="box-content">
							<div class="form-group">
								<label class="control-label col-sm-4">Payable Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="payable_amt" name="payable_amt" placeholder="PAYABLE AMOUNT" value="{{$data->md_amount}}" readonly>
								</div>
							</div>
						</div>
					</div>
						
					<div class="col-md-8 col-md-offset-2 form-group">
						<div class="box-content">
							<div class="form-group">
								<label class="control-label col-sm-4">Account Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="account_no" name="account_no" placeholder="ACCOUNT NUMBER" value="{{$data->md_acc_no}}" readonly>
									<input type="text" class="hide" name="md_id" value="{{$data->md_id}}" readonly>
								</div>
							</div>
						</div>
					</div>
						
					<div class="col-md-8 col-md-offset-2 form-group">
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="pay_mode" name="pay_mode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
							</div>
						</div>
					</div>
					
					
					
					<div class="alert alert-success col-md-8 col-md-offset-2 mode_cheque">
						<div class="form-group chequenum col-md-12">
							
							<label class="control-label col-md-4">Cheque Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="cheque_no" name="cheque_no" placeholder="CHEQUE NUMBER">
							</div>
						</div>
						
						<div class="form-group chequedte col-md-12">
							<label class="col-md-4 control-label">CHEQUE DATE</label>
							<div class="col-md-4 date">
								
								<div class="input-group input-append">
									<input type="text" name="cheque_date" id="cheque_date" name="cheque_date" class="form-control" value=""/>
									<span class="input-group-addon add-on">
										<span class="glyphicon glyphicon-calendar">
										</span>
										<b class="caret"></b>
									</span> 
								</div>
								
							</div>
						</div>
						
						<div class="form-group bnknme col-md-12">
							<label class="control-label col-md-4">Bank Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control BankNameTypeAhead" id="bank_name" name="bank_name" placeholder="SELECT BANK">
							</div>
						</div>
						
						<div class="form-group bnkbranch col-md-12">
							<label class="control-label col-md-4">Bank Branch:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="BANK BRANCH" readonly>
							</div>
						</div>		
						
						<div class="form-group ifsccde col-md-12">
							<label class="control-label col-md-4">IFSC Code:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC CODE" readonly>
							</div>
						</div>
						
						<div class="form-group ifsccde col-md-12">
							<label class="control-label col-md-4">Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="bank_acc_no" name="bank_acc_no" placeholder="ACCOUNT NUMBER" readonly>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="acnvalue" name="acnvalue">
						<input type="text" class="form-control hidden" id="actid" name="actid">
					</div>
					
					<div class="alert alert-success col-md-8 col-md-offset-2 mode_sb">
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">Account Number:</label>
							<div class="col-md-4">
								<input class="typeahead form-control"  id="type_ahead_sb_acc_no" type="text" name="type_ahead_sb_acc_no" placeholder="SELECT Account Number">  
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<label class="control-label col-md-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sb_acc_no" name="sb_acc_no" placeholder="SB ACCOUNT NUMBER" readonly>
							</div>
						</div>
					
						<div class="form-group col-md-12">
							<label class="control-label col-md-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sb_available_amount" name="sb_available_amount" placeholder="SB AVAILABLE BALANCE" readonly>
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<label class="control-label col-md-4">SB Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="sb_remaining_amount" name="sb_remaining_amount" placeholder="SB REMAINING BALANCE" readonly>
							</div>
						</div>
					</div>
				
				
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm" id="create" />
							</div>
						</div>
					</center>
				</form>
					
					
					

<script>
	$(".mode_cheque").hide();
	$(".mode_sb").hide();
	disable_create_button();
	$("#pay_mode").change(function() {
		var pay_mode = $(this).val();
		//console.log("pay_mode : "+ pay_mode);
		switch(pay_mode) {
			case "CASH":
							$(".mode_cheque").hide();
							$(".mode_sb").hide();
							enable_create_button();
							break;
			case "CHEQUE":
							$(".mode_cheque").show();
							$(".mode_sb").hide();
							enable_create_button();
							break;
			case "SB ACCOUNT":
							$(".mode_sb").show();
							$(".mode_cheque").hide();
							enable_create_button();
							break;
			default : disable_create_button();
		}
	});
	
	$("#create").click(function() {
		flag = false;
		flag = confirm("Are you sure?");
		
		if(flag) {
			var form_data = $("#form_data").serialize();
			console.log(form_data);
			var bank_id = $("#bank_name").attr("data-value");
			$.ajax({
				url : "maturity_amt_create",
				type : "post",
				data : form_data+"&bank_id="+bank_id,
				success : function(data) {
					console.log(data);
					disable_create_button();
					deposit_account_list("");
				}
			});
		}
	});
	
	function disable_create_button() {
		$("#create").prop("disabled",true);
	}
	
	function enable_create_button() {
		$("#create").prop("disabled",false);
	}

</script>

<script>
	$("#back").click(function() {
		$("#temp_box").html("");
		$("#deposit_details_box").show();
	})
</script>

<script>
	
	$('input[name="cheque_date"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'DD-MM-YYYY'
		},
		
		
	});
	
	//to get blank initially
	$('input[name="cheque_date"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD-MM-YYYY'));
	});
	
	$('input[name="cheque_date"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
</script>

<script>
	
	$('input[name="tran_date"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'DD-MM-YYYY'
		},
		
		
	});
	
	//to get blank initially
	$('input[name="tran_date"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD-MM-YYYY'));
	});
	
	$('input[name="tran_date"]').on('cancel.daterangepicker', function(ev, picker) {
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
		Bnkid=$('.BankNameTypeAhead').attr('data-value');
		e.preventDefault();
		$.ajax({
			url:'GetBankDetailsForPayAmt',
			type:'get',
			data:'&BankId='+Bnkid,
			success:function(data)
			{									   
				$('#bank_branch').val(data['Branch']);
				$('#ifsc_code').val(data['IFSC']);
				$('#bank_acc_no').val(data['AccountNo']);
				$('#bank_id').val(data['BankName']);
			}
		});
	});
	
	
	
	$('#type_ahead_sb_acc_no').change( function(e) {
		usr=$('#type_ahead_sb_acc_no').attr('data-value');
		$.ajax({
			url:'GetSBForFDPayAmt',
			type:'post',
			data:'&usrid='+usr,
			success:function(data){
				
				$('#acnvalue').val(data['acn']);
				acnval=$('#acnvalue').val();
				if(acnval==0)
				{
					$('#sb_acc_no').val(data['acccn']);
					$('#sb_available_amount').val(data['tot']);
					var tot_amt = parseInt ($('#sb_available_amount').val());
					tot_amt += parseInt ($("#payable_amt").val());
					console.log(tot_amt);
					$('#sb_remaining_amount').val(tot_amt);
				}
				else
				{
					alert("SB Account Does not exist for this Customer. Please Create a SB Account");
				}
				
			}
		});
	});
</script>
