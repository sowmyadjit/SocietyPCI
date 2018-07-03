
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
						<h2><i class="glyphicon glyphicon-user"></i>PIGMI ALLOCATION DETAIL</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
						<div class="alert alert-info" style="height:123px;">
							<div class="col-md-12">
								<div class="col-md-4" style="height:38px;">
									AGENT NAME:
									<select id="agent_id" style="height:38px;">
										@foreach($agent_data as $row)
											<option value="{{$row->Uid}}">{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</option>
										@endforeach
									</select>
								</div>
								
								<div class="col-md-4" style="height:38px;">
									ACCOUNT TYPE:
									<select id="closed_status" style="height:38px;">
										<option value="NO">LIVE</option>
										<option value="YES">CLOSED</option>
									</select>
									<button class="btn-sm"><span class="glyphicon glyphicon-refresh" id="refresh" /></button>
								</div>
								<div class="col-md-4 pull-right">
									<input class="SearchTypeahead form-control" id="search_box" type="text" name="SearchPigmy" placeholder="SEARCH PIGMY">
								</div>
							</div>
							<div class="col-md-12" style="padding-top:15px;">
								<a href="crtpigmiallocation" class="btn btn-default crtpal<?php echo $pa['module']->Mid; ?> col-md-4">PIGMI ALLOCATION</a>
								<input type="button" value="Export to Excel" class="btn btn-default col-md-4" id="excel">
								<input type="button" value="Print" class="btn btn-default print col-md-4" id="print">
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
		
		setTimeout(function(){
			deposit_account_list("");
		}, 5*1000);
	});
	
	$("#closed_status, #agent_id").change(function() {
		$("#deposit_account_list_box").html("Loading...");
		deposit_account_list("");
	});

	$("#refresh").click(function() {
		$("#closed_status").trigger("change");
	});
	
	$("#search_box").change(function() {
		var allocation_id = $(this).attr("data-value");
		console.log(allocation_id);
		deposit_account_list(allocation_id);
	});
	
	function deposit_account_list(allocation_id) {
		$("#deposit_account_list_box").html("");
		var closed = $("#closed_status").val();
		var agent_id = $("#agent_id").val();
		$.ajax({
			url:"deposit_account_list",
			type:"post",
			data:"&category=PG&closed="+closed+"&agent_id="+agent_id+"&allocation_id="+allocation_id,
			success: function(data) {
				console.log("done");
				$("#back").show();
				$("#deposit_account_list_box").html(data);
			}
		});
	}
</script>

<script>
	$('#search_box').typeahead({
        source:SearchPigmy
	});
</script>

<script>
	$('.crtpal<?php echo $pa['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$("#deposit_details_box").hide();
		$('#temp_box').load($(this).attr('href'));
	});
</script>

<script>
	$("#back").click(function() {
		$("#temp_box").html("");
		$("#deposit_details_box").show();
	})
</script>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});
	
	
	$('#excel').click(function(e){
	$('#toprint').tableExport({type:'excel',escape:'false'});
	});	
</script>


