<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "CREATE COMPUSORY DEPOSIT";
				$category = "CD";
				break;
		case 2:
				$page_title = "CREATE SECURITY DEPOSIT...";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

?>
		<script src="js/bootstrap-typeahead.js"></script>
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
			
			<div id="create_cdsd">
				<div class="form-group">
					<div class="form-group col-md-12">
						<label class="control-label col-sm-4">SELECT USER TYPE:</label>
						<div class="col-md-4">
							<select  class="form-control" id="cr_user_type"  placeholder="SELECT USER TYPE">
								<option value="0" disabled></option>
								<option value="1">EMPLOYEE</option>
								<option value="0" disabled></option>
								<option value="2">AGENT</option>
								<option value="0" disabled></option>
								<option value="3">CUSTOMER</option>
								<option value="0" disabled></option>
							</select>
						</div>
					</div>

					<div class="form-group col-md-12 search_user" id="search_employee_box">
						<label class="control-label col-sm-4">SELECT EMPLOYEE:</label>
						<div class="col-md-4">
							<input  class="form-control cr_user_typeahead_employee" id="cr_user_employee" placeholder="SELECT EMPLOYEE">
						</div>
					</div>
					<div class="form-group col-md-12 search_user" id="search_agent_box">
						<label class="control-label col-sm-4">SELECT AGENT:</label>
						<div class="col-md-4">
							<input  class="form-control cr_user_typeahead_agent" id="cr_user_agent" placeholder="SELECT AGENT">
						</div>
					</div>
					<div class="form-group col-md-12 search_user" id="search_customer_box">
						<label class="control-label col-sm-4">SELECT CUSTOMER:</label>
						<div class="col-md-4">
							<input  class="form-control cr_user_typeahead_customer" id="cr_user_customer" placeholder="SELECT CUSTOMER">
						</div>
					</div>

					<div class="form-group col-md-12">
						<label class="control-label col-sm-4">SELECT OLD ACCOUNT NO.:</label>
						<div class="col-md-4">
							<input  class="form-control" id="cr_old_acc_no" placeholder="SELECT OLD ACCOUNT NO.">
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-sm-4">SELECT START DATE:</label>
						<div class="col-md-4">
							<input  class="form-control datepicker" id="cr_start_date" data-date-format="yyyy-mm-dd" name="start_date" placeholder="SELECT START DATE">
						</div>
					</div>
				</div>
						
			</div>

			
		<center>
			<div class="form-group">
				<div class="col-sm-12">
					<input type="button" id="cr_submit" value="CREATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
				</div>
			</div>
		</center>


		</div>

		
<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
	function reset()
	{
		sd_submit_count = 0;
		// $("#cr_user_type").val("");
		$("#cr_user_employee").attr("data-value","");
		$("#cr_user_agent").attr("data-value","");
		$("#cr_user_customer").attr("data-value","");
		$("#cr_user_employee").val();
		$("#cr_user_agent").val();
		$("#cr_user_customer").val();
		$("#cr_old_acc_no").val("");
		$("#cr_start_date").val("");

	}
</script>

<script>
	var sd_submit_count = 0;
	$("#submit_sd").click(function() {
		console.log("submit");
		var error_flag = false;

		var cr_user_type = $("#cr_user_type").val();
		switch(cr_user_type) {
			case "1":
					var cr_user_id = $("#cr_user_employee").attr("data-value");
					break;
			case "2":
					var cr_user_id = $("#cr_user_agent").attr("data-value");
					break;
			case "3":
					var cr_user_id = $("#cr_user_customer").attr("data-value");
					break;
			default :
					var cr_user_id = "";
		}
		var cr_old_acc_no = $("#cr_old_acc_no").val();
		var cr_start_date = $("#cr_start_date").val();


		if(cr_user_type == "") {
			error_flag = true;
			alert("select user type");
		} else if(cr_user_id == "" || cr_user_id === undefined) {
			error_flag = true;
			alert("select user");
		} else if(cr_old_acc_no == "") {
			error_flag = true;
			alert("select old account no.");
		} else if(cr_start_date == "") {
			error_flag = true;
			alert("select start date");
		}

		if(error_flag) {
			//
		} else {

			var post_data = {
				"cdsd_type" : {{$cdsd_type}},
				"cr_user_type" : cr_user_type,
				"cr_user_id" : cr_user_id,
				"cr_old_acc_no" : cr_old_acc_no,
				"cr_start_date" : cr_start_date
			};

			if(sd_submit_count == 0) {
				sd_submit_count++;
				$.ajax({
					type:"post",
					url:"create_cdsd",
					data: "&post_data="+JSON.encode(post_data),
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

<script>
	function select_user_type()
	{
		console.log($("#cr_user_type").val());
		var cr_user_type = $("#cr_user_type").val();
		switch(cr_user_type) {
			case "1":
					$(".search_user").hide();
					$("#search_employee_box").show();
					break;
			case "2":
					$(".search_user").hide();
					$("#search_agent_box").show();
					break;
			case "3":
					$(".search_user").hide();
					$("#search_customer_box").show();
					break;
			default :
					$("#search_user").hide();
					break;
		}
	}

	$("#cr_user_type").change(function() {
		select_user_type();
	});

	$("#cr_user_type").trigger("change");
</script>


<script>
		$('.cr_user_typeahead').typeahead({
			ajax: '/Getuser'
			// source:Getuser
		});
</script>

<script>
		$('.cr_user_typeahead_employee').typeahead({
			ajax: '/search_employee_for_cdsd'
			// source:
		});
		$('.cr_user_typeahead_agent').typeahead({
			ajax: '/search_agent_for_cdsd'
			// source:
		});
		$('.cr_user_typeahead_customer').typeahead({
			ajax: '/search_customer_for_cdsd'
			// source:
		});
</script>