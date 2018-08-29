<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "CD TRANSACTION";
				$category = "CD";
				break;
		case 2:
				$page_title = "SD TRANSACTION...";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
    }
    
	$today_date = date("Y-m-d");
?>
		<script src="js/bootstrap-datepicker.js"/>
		<div id="deposit_details_box">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i>{{$page_title}}</h2>
				
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
								<input  class="form-control datepicker" id="cdsd_tran_date" data-date-format="yyyy-mm-dd" value="{{$today_date}}" placeholder="yyyy-mm-dd">
							</div>
                        </div>
                        @if($cdsd_type == 1)
                            <div class="form-group col-md-12">
                                <label class="control-label col-sm-4">CD ACCOUNT:</label>
                                <div class="col-md-4">
                                    <input  class="form-control cdsd_acc_no_typeahead" id="cdsd_acc_no" placeholder="SELECT CD ACCOUNT NO.">
                                </div>
                            </div>
                        @elseif($cdsd_type == 2)
                            <div class="form-group col-md-12">
                                <label class="control-label col-sm-4">SD ACCOUNT:</label>
                                <div class="col-md-4">
                                    <input  class="form-control cdsd_acc_no_typeahead" id="cdsd_acc_no" placeholder="SELECT SD ACCOUNT NO.">
                                </div>
                            </div>
                        @endif
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">TRANSACTION TYPE:</label>
							<div class="col-md-4">
								<select  class="form-control" id="cdsd_transaction_type">
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
								<select  class="form-control" id="cdsd_payment_mode">
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
								<input  class="form-control" id="cdsd_amount" placeholder="ENTER AMOUNT">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">PARTICULARS:</label>
							<div class="col-md-4">
								<input  class="form-control" id="cdsd_perticulars" placeholder="PARTICULARS">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-sm-4">IS INTEREST TRAN.?</label>
							<div class="col-md-4">
								<input type="checkbox"  id="is_interest_tran">
							</div>
						</div>
				</div>
						
			</div>

			
		<center>
			<div class="form-group">
				<div class="col-sm-12">
					<input type="button" id="submit_cdsd_transaction" value="CREATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
				</div>
			</div>
		</center>


		</div>

		
<script>
		$('.cdsd_acc_no_typeahead').typeahead({
			ajax: '/search_cdsd_acc_no?cdsd_type={{$cdsd_type}}&cdsd_closed=0'
			// source:search_cdsd_acc_no
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
		cdsd_tran_submit_count = 0;
		$("#cdsd_tran_date").val("{{$today_date}}");
		$("#cdsd_acc_no").val("");
		$("#cdsd_acc_no").attr("data-value", "");
		// $("#cdsd_transaction_type").val("");
		// $("#cdsd_payment_mode").val("");
		$("#cdsd_amount").val("");
		$("#cdsd_perticulars").val("");
	}
</script>

<script>
	var cdsd_tran_submit_count = 0;
	$("#submit_cdsd_transaction").click(function() {
		console.log("sd_tran");
		var error_flag = false;
		var cdsd_tran_date = $("#cdsd_tran_date").val();
		var cdsd_acc_no = $("#cdsd_acc_no").val();
		var cdsd_id = $("#cdsd_acc_no").attr("data-value");
		var cdsd_transaction_type = $("#cdsd_transaction_type").val();
		var cdsd_payment_mode = $("#cdsd_payment_mode").val();
		var cdsd_amount = $("#cdsd_amount").val();
		var cdsd_perticulars = $("#cdsd_perticulars").val();
		if($("#is_interest_tran").is(":checked")) {
			var is_interest_tran = 1;
		} else {
			var is_interest_tran = 0;
		}

		if(cdsd_tran_date == "") {
			error_flag = true;
			alert("select date");
		} else if(cdsd_id == "" || cdsd_id === undefined) {
			error_flag = true;
			alert("select sd account no");
		} else if(cdsd_transaction_type == "") {
			error_flag = true;
			alert("select transaction type");
		} else if(cdsd_payment_mode == "") {
			error_flag = true;
			alert("select payment mode");
		} else if(cdsd_amount == "") {
			error_flag = true;
			alert("enter amount");
		} else if(cdsd_perticulars == "") {
			error_flag = true;
			alert("enter particulars");
		}

		var post_data = {
			"cdsd_type" : {{$cdsd_type}},
			"cdsd_tran_date" : cdsd_tran_date,
			"cdsd_acc_no" : cdsd_acc_no,
			"cdsd_id" : cdsd_id,
			"cdsd_transaction_type" : cdsd_transaction_type,
			"cdsd_payment_mode" : cdsd_payment_mode,
			"cdsd_amount" : cdsd_amount,
			"cdsd_perticulars" : cdsd_perticulars,
			"is_interest_tran" : is_interest_tran
		}

		// console.log(JSON.stringify(post_data));


		if(error_flag) {
			//
		} else {
			if(cdsd_tran_submit_count == 0) {
				cdsd_tran_submit_count++;
				$.ajax({
					type:"post",
					url:"create_cdsd_transaction",
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

