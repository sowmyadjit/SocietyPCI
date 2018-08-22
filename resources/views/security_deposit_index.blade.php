
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
							<h2><i class="glyphicon glyphicon-user"></i>SECURITY DEPOSIT</h2>
							
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
									
									<button id="create_sd" class="btn btn-default">Create SD</button>
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
						<center><button id="back_sd" class="btn-sm btn-info">back</button></center>
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
	$(document).ready(function() {
		$("#back").hide();
		deposit_account_list("");
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
			data:"&category=SD&closed="+closed+"&user_type="+user_type+"&allocation_id="+allocation_id,
			success: function(data) {
				console.log("done");
				$("#back").show();
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
	$("#create_sd").click(function(e) {
		e.preventDefault();
		
		$.ajax({
			url:"create_sd_index",
			type:"post",
			data:"",
			success: function(data) {
				console.log("done");
				$(".b_main").hide();
				$(".b_sub_1").html(data);
				$(".b_sub_1").show();

			}
		});
	});
</script>

<script>
	$("#back_sd").click(function() {
		$(".b_sub_1").html("");
		$(".b_main").show();
	});
</script>