<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	$user_type_1_disabled = "";
	$user_type_2_disabled = "";
	$user_type_3_disabled = "";
	switch($cdsd_type) {
		case 1:
				$page_title = "CD INTEREST";
				$category = "CD";
				$user_type_2_disabled = "disabled";
				break;
		case 2:
				$page_title = "SD INTEREST";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

    $today_date = date("Y-m-d");

?>
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
			
			<div id="view_cdsd_tran">
				<div class="form-group">
					<div class="form-group col-md-12">
                        <div class="alert alert-info" style="height:80px;">
                            <div class="col-md-4">
                       			<label class="control-label col-sm-">USER TYPE:</label>
							</div>
                            <div class="col-md-4">
								<select id="int_emp_agt_type" class="form-control">
									<option value="1">EMPLOYEE</option>
									<option value="2" {{$user_type_2_disabled}}>AGENT</option>
								</select>
                            </div>
                        </div>
					</div>

                <div id="int_emp_agt"></div>
                 

				</div>
						
			</div>


	</div>
<script>
	function load_emp_agt() {
		show_loading_img("#int_emp_agt");
		var temp_post_data = {
			"cdsd_type": {{$cdsd_type}},
			"user_type": $("#int_emp_agt_type").val()
		}
		var post_data = JSON.stringify(temp_post_data);
		$.ajax({
			type:"post",
			url: "int_emp_agt",
			data: "&post_data="+post_data,
			success: function(data) {
				console.log("done");
				$("#int_emp_agt").html(data);
			}
		});
	}
	$("#int_emp_agt_type").change(function() {
		// console.log("sgfksghdfks");
		load_emp_agt();
	});
</script>
<script>
	$("document").ready(function() {
		console.log("rdy");
		load_emp_agt();
	});
</script>
