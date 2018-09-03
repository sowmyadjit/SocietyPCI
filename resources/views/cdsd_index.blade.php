<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "COMPUSORY DEPOSIT";
				$category = "CD";
				break;
		case 2:
				$page_title = "SECURITY DEPOSIT...";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}
	// var_dump($data);
	// $is_day_open = "";

?>


<script src="js/bootstrap-typeahead.js"></script>
<script src="js/bootstrap-table.js"/>
<script src="js/FileSaver.js"/>			
<script src="js/tableExport.js"/>			
<script src="js/jquery.base64.js"/>			
<script src="js/sprintf.js"/>
<script src="js/jspdf.js"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>

<script src="js/bootstrap-table-export.js"/>
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">

<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	<div class="row">
		<div class="box col-md-12">
		
		
			<div class="box-inner">

				
<?php /* BOX MAIN START */?>
<div class="b_main">
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
						
						<div class="box-content">
							<div class="alert alert-info" style="height:60px;">
								<div>
									<div class="col-md-3" style="height:38px;">
										ACCOUNT TYPE:
										<select id="closed_status" style="height:38px;">
											<option value="NO">LIVE</option>
											<option value="YES">CLOSED</option>
										</select>
									</div>
									<div class="col-md-3" style="height:38px;">
										USER TYPE:
										<select id="user_type" style="height:38px;">
											<option value="1">EMPLOYEE</option>
											<option value="2">AGENT</option>
											<option value="3">CUSTOMER</option>
										</select>
										<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>
									</div>
								@if($cdsd_type == 1)
									<button id="create_cdsd" class="btn btn-default">Create CD</button>
									<button id="cdsd_transaction" class="btn btn-default">CD Transaction</button>
									<button id="cdsd_interest" class="btn btn-default">CD INTEREST</button>
									<button id="cdsd_close" class="btn btn-default">CD CLOSE</button>
									<button id="cdsd_pay" class="btn btn-default">CD PAY</button>
								@else
									<button id="create_cdsd" class="btn btn-default">Create SD</button>
									<button id="cdsd_transaction" class="btn btn-default">SD Transaction</button>
									<button id="cdsd_interest" class="btn btn-default">SD INTEREST</button>
									<button id="cdsd_close" class="btn btn-default">SD CLOSE</button>
									<button id="cdsd_pay" class="btn btn-default">SD PAY</button>
								@endif
								</div>
							</div>
									
								<div id="deposit_account_list_box">...</div>
									
						</div>

					</div>
				</div>
				<?php /* BOX MAIN END */?>


					<?php /* BOX SUB 1 START */?>
					<div class="b_sub_1">
					</div>
					<?php /* BOX SUB 1 END */?>


					<?php /* BOX SUB 2 START */?>
					<div class="b_sub_2">
					</div>
					<?php /* BOX SUB 2 END */?>

					
					<div class="b_back">
						<center><button id="back_cdsd" class="btn-sm btn-info">back</button></center>
					</div>
					<div id="temp_loading_img" class="hide">
						<div>
							<center>
								<img src="img\\loading2.gif" width="100px" height="100px"/>
							</center>
						</div>
					</div>






				</div>
				<div id="temp_box"></div>
			</div>
		</div>
	</div>
</div>


<script>
	function show_loading_img(selector) {
		var loading_img = $("#temp_loading_img").html();
		$(selector).html(loading_img);
	}
</script>
	
<script>
	var is_day_open = "{{$data['is_day_open']}}";
	$(document).ready(function() {
		$("#back_cdsd").hide();
		setTimeout(() => {
			deposit_account_list("");
		}, 1000);
	});
	
	$("#closed_status, #user_type").change(function() {
		deposit_account_list("");
	});
	
	$("#search_box").change(function() {
		$("#search_box").val("");
		var allocation_id = $(this).attr("data-value");
		console.log(allocation_id);
		deposit_account_list(allocation_id);
	});
	
	function deposit_account_list(allocation_id) {
		show_loading_img("#deposit_account_list_box");
		var closed = $("#closed_status").val();
		var user_type = $("#user_type").val();
		$.ajax({
			url:"deposit_account_list",
			type:"post",
			data:"&category={{$category}}&cdsd_type={{$cdsd_type}}&closed="+closed+"&user_type="+user_type+"&allocation_id="+allocation_id,
			success: function(data) {
				console.log("done");
				$("#back_cdsd").show();
				$("#deposit_account_list_box").html(data);
			}
		});
	}
	
</script>

<script>
	$(".refresh_data").click(function() {
		deposit_account_list("");
	});
</script>

<script>
	$("#back_cdsd").click(function() {
		$(".b_sub_1").html("");
		$(".b_main").show();
	});
</script>


<script>
	$("#create_cdsd").click(function(e) {
		e.preventDefault();
		if(is_day_open == "yes") {
			$.ajax({
				url:"create_cdsd_index",
				type:"post",
				data:"cdsd_type="+{{$data["cdsd_type"]}},
				success: function(data) {
					console.log("done");
					$(".b_main").hide();
					$(".b_sub_1").html(data);
					$(".b_sub_1").show();
				}
			});
		} else {
			alert("DAY IS NOT OPEN");
		}
	});
</script>

<script>
	$("#cdsd_transaction").click(function(e) {
		e.preventDefault();
		
		if(is_day_open == "yes") {
			$.ajax({
				url:"cdsd_transaction_index",
				type:"post",
				data:"&cdsd_type={{$cdsd_type}}",
				success: function(data) {
					console.log("done");
					$(".b_main").hide();
					$(".b_sub_1").html(data);
					$(".b_sub_1").show();
				}
			});
		} else {
			alert("DAY IS NOT OPEN");
		}
	});
</script>

<script>
	$("#cdsd_interest").click(function(e) {
		e.preventDefault();
		
		if(is_day_open == "yes") {
			$.ajax({
				url:"cdsd_interest_index",
				type:"post",
				data:"&cdsd_type={{$cdsd_type}}",
				success: function(data) {
					console.log("done");
					$(".b_main").hide();
					$(".b_sub_1").html(data);
					$(".b_sub_1").show();
				}
			});
		} else {
			alert("DAY IS NOT OPEN");
		}
	});
</script>

<script>
	$("#cdsd_close").click(function(e) {
		e.preventDefault();
		
		if(is_day_open == "yes") {
			$.ajax({
				url:"cdsd_close_index",
				type:"post",
				data:"&cdsd_type={{$cdsd_type}}",
				success: function(data) {
					console.log("done");
					$(".b_main").hide();
					$(".b_sub_1").html(data);
					$(".b_sub_1").show();
				}
			});
		} else {
			alert("DAY IS NOT OPEN");
		}
	});
</script>

<script>
	$("#cdsd_pay").click(function(e) {
		e.preventDefault();
		
		if(is_day_open == "yes") {
			$.ajax({
				url:"cdsd_pay_index",
				type:"post",
				data:"&cdsd_type={{$cdsd_type}}",
				success: function(data) {
					console.log("done");
					$(".b_main").hide();
					$(".b_sub_1").html(data);
					$(".b_sub_1").show();
				}
			});
		} else {
			alert("DAY IS NOT OPEN");
		}
	});
</script>


<!-- -------------------------------------------------------------------------------------------------------------------------- -->