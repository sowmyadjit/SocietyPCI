
		<script src="js/bootstrap-datepicker.js"/>
		<div id="deposit_details_box">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i>CREATE SECURITY DEPOSIT</h2>
				
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
						<label class="control-label col-sm-4">SELECT USER:</label>
						<div class="col-md-4">
							<input  class="form-control user_typeahead" id="user" name="user" placeholder="SELECT USER">
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-sm-4">SELECT USER TYPE:</label>
						<div class="col-md-4">
							<select  class="form-control" id="user_type" name="user_type" placeholder="SELECT USER TYPE">
								<option value="1">EMPLOYEE</option>
								<option value="2">AGENT</option>
								<option value="3">CUSTOMER</option>
							</select>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-sm-4">SELECT OLD ACCOUNT NO.:</label>
						<div class="col-md-4">
							<input  class="form-control" id="old_acc_no" name="old_acc_no" placeholder="SELECT OLD ACCOUNT NO.">
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-sm-4">SELECT START DATE:</label>
						<div class="col-md-4">
							<input  class="form-control datepicker" id="start_date" data-date-format="yyyy-mm-dd" name="start_date" placeholder="SELECT START DATE">
						</div>
					</div>
				</div>
						
			</div>

			
		<center>
			<div class="form-group">
				<div class="col-sm-12">
					<input type="button" id="submit_sd" value="CREATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
				</div>
			</div>
		</center>


		</div>

		
<script>
		$('.user_typeahead').typeahead({
			ajax: '/Getuser'
			// source:Getuser
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
		sd_submit_count = 0;
		$("#user").val("");
		$("#user").attr("data-value","");
		// $("#user_type").val();
		$("#old_acc_no").val("");
		$("#start_date").val("");

	}
</script>

<script>
	var sd_submit_count = 0;
	$("#submit_sd").click(function() {
		console.log("submit");
		var error_flag = false;
		var user_id = $("#user").attr("data-value");
		var user_type = $("#user_type").val();
		var old_acc_no = $("#old_acc_no").val();
		var start_date = $("#start_date").val();

		if(user_id == "" || user_id === undefined) {
			error_flag = true;
			alert("select user");
		} else if(user_type == "") {
			error_flag = true;
			alert("select user type");
		} else if(old_acc_no == "") {
			error_flag = true;
			alert("select old account no.");
		} else if(start_date == "") {
			error_flag = true;
			alert("select start date");
		}

		if(error_flag) {
			//
		} else {
			if(sd_submit_count == 0) {
				sd_submit_count++;
				$.ajax({
					type:"post",
					url:"create_sd",
					data:"&user_id="+user_id+"&user_type="+user_type+"&old_acc_no="+old_acc_no+"&start_date="+start_date,
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

