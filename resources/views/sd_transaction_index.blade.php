<?php
	$today_date = date("Y-m-d");
?>
		<script src="js/bootstrap-datepicker.js"/>
		<div id="deposit_details_box">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i>SD TRANSACTION</h2>
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
					class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			
			<div>
				<div class="form-group">
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">DATE:</label>
							<div class="col-md-4">
								<input  class="form-control datepicker" id="sd_tran_date" data-date-format="yyyy-mm-dd" value="{{$today_date}}" placeholder="yyyy-mm-dd">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">SD ACCOUNT:</label>
							<div class="col-md-4">
								<input  class="form-control sd_acc_no_typeahead" id="sd_acc_no" placeholder="SELECT SD ACCOUNT NO.">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">TRANSACTION TYPE:</label>
							<div class="col-md-4">
								<select  class="form-control" id="sd_transaction_type">
									<option value="0" disabled></option>
									<option value="1" >CREDIT</option>
									<option value="0" disabled></option>
									<option value="2">DEBIT</option>
									<option value="0" disabled></option>
								</select>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">PAYMENT MODE:</label>
							<div class="col-md-4">
								<select  class="form-control" id="sd_payment_mode">
										<option value="0" disabled></option>
									<option value="1">CASH</option>
									<option value="0" disabled></option>
									<option value="2">ADJUSTMENT</option>
									<option value="0" disabled></option>
								</select>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">AMOUNT:</label>
							<div class="col-md-4">
								<input  class="form-control" id="sd_amount" placeholder="ENTER AMOUNT">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">PARTICULARS:</label>
							<div class="col-md-4">
								<input  class="form-control" id="sd_perticulars" placeholder="PARTICULARS">
							</div>
						</div>
				</div>
						
			</div>

			
		<center>
			<div class="form-group">
				<div class="col-sm-12">
					<input type="button" id="submit_sd_transaction" value="CREATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
				</div>
			</div>
		</center>


		</div>

		
<script>
		$('.sd_acc_no_typeahead').typeahead({
			ajax: '/search_sd_acc_no'
			// source:search_sd_acc_no
		});
		
</script>
<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
	function reset()
	{
		sd_tran_submit_count = 0;
		$("#sd_tran_date").val("{{$today_date}}");
		$("#sd_acc_no").val("");
		$("#sd_acc_no").attr("data-value", "");
		// $("#sd_transaction_type").val("");
		// $("#sd_payment_mode").val("");
		$("#sd_amount").val("");
		$("#sd_perticulars").val("");
	}
</script>

<script>
	var sd_tran_submit_count = 0;
	$("#submit_sd_transaction").click(function() {
		console.log("sd_tran");
		var error_flag = false;
		var sd_tran_date = $("#sd_tran_date").val();
		var sd_acc_no = $("#sd_acc_no").val();
		var sd_id = $("#sd_acc_no").attr("data-value");
		var sd_transaction_type = $("#sd_transaction_type").val();
		var sd_payment_mode = $("#sd_payment_mode").val();
		var sd_amount = $("#sd_amount").val();
		var sd_perticulars = $("#sd_perticulars").val();

		if(sd_tran_date == "") {
			error_flag = true;
			alert("select date");
		} else if(sd_id == "" || sd_id === undefined) {
			error_flag = true;
			alert("select sd account no");
		} else if(sd_transaction_type == "") {
			error_flag = true;
			alert("select transaction type");
		} else if(sd_payment_mode == "") {
			error_flag = true;
			alert("select payment mode");
		} else if(sd_amount == "") {
			error_flag = true;
			alert("enter amount");
		} else if(sd_perticulars == "") {
			error_flag = true;
			alert("enter particulars");
		}

		var post_data = {
			"sd_tran_date" : sd_tran_date,
			"sd_acc_no" : sd_acc_no,
			"sd_id" : sd_id,
			"sd_transaction_type" : sd_transaction_type,
			"sd_payment_mode" : sd_payment_mode,
			"sd_amount" : sd_amount,
			"sd_perticulars" : sd_perticulars,
		}

		// console.log(JSON.stringify(post_data));


		if(error_flag) {
			//
		} else {
			if(sd_tran_submit_count == 0) {
				sd_tran_submit_count++;
				$.ajax({
					type:"post",
					url:"create_sd_transaction",
					data: "post_data="+JSON.stringify(post_data),
					success: function(data) {
						console.log("created");
						alert("success");
						reset();
					}
				});
			}
		}

	});
</script>

