
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
				<div id="deposit_details_box">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>MATURITY DEPOSIT</h2>
						
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
								<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
								<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
							<?php /*	<div class="col-md-5 pull-right">
									<input class="SearchTypeahead form-control" id="search_box" type="text" name="SearchFd" placeholder="SEARCH MATURITY ACCOUNT">
								</div>*/?>
								<div class="col-md-4" style="height:38px;">
									ACCOUNT TYPE:
									<select id="closed_status" style="height:38px;">
										<option value="NO">LIVE</option>
										<option value="YES">CLOSED</option>
									</select>
									<button class="btn-sm"><span class="glyphicon glyphicon-refresh" id="refresh" /></button>
								</div>
							</div>
						</div>
								
							<div id="deposit_account_list_box">Loading...</div>
								
					</div>
				</div>
				<div id="temp_box"></div>
				<button class="btn btn-info btn-sm" id="back" style="margin-left:47.5%;margin-bottom:50px;">BACK</button>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$("#back").hide();
		deposit_account_list("");
	});
	
	$("#closed_status").change(function() {
		$("#deposit_account_list_box").html("Loading...");
		deposit_account_list("");
	});

	$("#refresh").click(function() {
		$("#closed_status").trigger("change");
	});
	
	$("#search_box").change(function() {
		$("#search_box").val("");
		var allocation_id = $(this).attr("data-value");
		console.log(allocation_id);
		deposit_account_list(allocation_id);
	});
	
	function deposit_account_list(allocation_id) {
		var closed = $("#closed_status").val();
		$.ajax({
			url:"deposit_account_list",
			type:"post",
			data:"&category=MD&closed="+closed+"&allocation_id="+allocation_id,
			success: function(data) {
				console.log("done");
				$("#back").show();
				$("#deposit_account_list_box").html(data);
			}
		});
	}
</script>