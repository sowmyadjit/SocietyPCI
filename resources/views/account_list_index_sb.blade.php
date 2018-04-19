
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
	
	<div class="row" >
		<div class="box col-md-12">
		
		
			<div class="box-inner">
				<span id="top" />
				<div id="account_details_box">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>CREATE ACCOUNT</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove" id="remove_{{$a['module']->Mid}}"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<div class="alert alert-info" style="height:160px;">
							<div class="pull-right">
								<a href="acccreation" class="btn btn-default CreateAcc<?php echo $a['module']->Mid; ?>">Create Account</a>
								<a href="ViewCreateJointAcc" class="btn btn-default JointAcc<?php echo $a['module']->Mid; ?>">Create Joint Account</a>
								<a href="ViewMinorAccHome" class="btn btn-default ViewMinAcc<?php echo $a['module']->Mid; ?>">Create Minor Account</a>
							</div>
							<div class="col-md-3">
								<select class="form-control" id="ExportType" name="ExportType">
									<option value="">SELECT TYPE TO EXPORT</option>
									<option value="word">WORD</option>
									<option value="excel">EXCEL</option>
									<option value="pdf">PDF</option>
								</select>
							</div>
							<input type="button" value="Print" class="btn btn-info btn-sm print col-md-1" id="print">
							
							<div class="col-md-12">
								<div class="col-md-3" style="height:38px;">
									ACCOUNT TYPE:
									<select id="account_type" style="height:38px;">
										<option value="1">SB</option>
										<option value="2">RD</option>
									</select>
								</div>
								<div class="col-md-3" style="height:38px;">
									CLOSED TYPE:
									<select id="closed_status" style="height:38px;">
										<option value="NO">LIVE</option>
										<option value="YES">CLOSED</option>
									</select>
								</div>
								<div class="col-md-3">
									<input class="SearchTypeahead form-control" id="search_acc" type="text" name="search_acc" placeholder="SEARCH ACCOUNT">
								</div>
							</div>
							
						</div>
								
							<div id="account_list_box">Loading...</div>
								
					</div>
				</div>
				<div id="temp_box"></div>
				<button class="btn btn-info btn-sm" id="back" style="margin-left:47.5%;margin-bottom:50px;">BACK</button>
				<a href="#top"><button class="btn btn-info btn-sm" id="back" >TOP</button></a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
	$("#back").hide();
		account_list_sb("");
	});
	
	$("#closed_status").change(function() {
		account_list_sb("");
	});
	
	$("#account_type").change(function() {
		account_list_sb("");
	});
	
	$("#search_acc").change(function() {
		$("#search_acc").val("");
		var account_id = $(this).attr("data-value");
		console.log(account_id);
		account_list_sb(account_id);
	});
	
	function account_list_sb(account_id) {
		var closed = $("#closed_status").val();
		var account_type = $("#account_type").val();
		$("#account_list_box").html("Loading...");
		$.ajax({
			url:"account_list_sb",
			type:"post",
			data:"&account_type="+account_type+"&closed="+closed+"&account_id="+account_id,
			success: function(data) {
				console.log("done");
				$("#back").show();
				$("#account_list_box").html(data);
			}
		});
	}
</script>
<script>
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSearchAcc'
	});
</script>

<script>
	$(".CreateAcc{{$a['module']->Mid}}, .JointAcc{{$a['module']->Mid}}, .ViewMinAcc{{$a['module']->Mid}}").click(function(e) {
		e.preventDefault();
		$("#account_details_box").hide();
		$('#temp_box').load($(this).attr('href'));
	})
</script>

<script>
	$("#back").click(function() {
		$("#temp_box").html("");
		$("#account_details_box").show();
	})
</script>
<script>
	//CLOSE TAB
	$("#remove_{{$a['module']->Mid}}").click(function() {
		var selector = "#{{$a['module']->Mid}} > .remove";
		$(selector).trigger("click");
	
	})
</script>


