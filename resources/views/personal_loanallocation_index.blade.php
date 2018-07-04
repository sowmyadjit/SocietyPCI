
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
	<div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >LOAN ALLOCATION DETAIL</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
		
		
			<div class="box-inner">
				<div id="loan_details_box">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>LOAN ALLOCATION DETAIL</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
						<div class="alert alert-info" style="height:120px;">
							<div class="col-md-12">
								<div class="col-md-3">
									<input class="SearchTypeahead form-control" id="search_loan_id" type="text" name="search_loan_id" placeholder="SEARCH JEWEL ACCOUNT">
								</div>
								<div class="col-md-4" style="height:38px;">
									ACCOUNT TYPE:
									<select id="closed_status" style="height:38px;">
										<option value="NO">LIVE</option>
										<option value="YES">CLOSED</option>
									</select>
									<button class="btn-sm" id="refresh" ><span class="glyphicon glyphicon-refresh" /></button>
								</div>
								<div class="col-md-4" style="height:38px;">
									PL TYPE:
									<select id="pl_type" style="height:38px;">
										<option value="ASL">ASL</option>
										<option value="CSL">CSL</option>
										<option value="AMTL">AMTL</option>
										<option value="CMTL">CMTL</option>
									</select>
								</div>
							</div>

							<div class="col-md-12" style="margin-top: 10px;">
								<div class="col-md-2">
									<select class="form-control" id="ExportType" name="ExportType">
										<option value="">SELECT TYPE TO EXPORT</option>
										<option value="word">WORD</option>
										<option value="excel">EXCEL</option>
										<option value="pdf">PDF</option>
									</select>
								</div>
								<a href="PersonalLoan" class="btn btn-info btn-sm col-md-2 crtlal">LOAN ALLOCATION</a>
								
								<input type="button" value="Print" class="btn btn-info btn-sm print col-md-1" id="print">
							</div>
						</div>
					</div>
								
							<div id="account_list_box">Loading...</div>
								
					</div>
				</div>
				<div id="receipt_box"></div>
				<button class="btn btn-info btn-sm" id="back" style="margin-left:47.5%;margin-bottom:50px;">BACK</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
	$("#back").hide();
		account_list("");
	});
	
	$("#closed_status").change(function() {
		account_list("");
	});
	
	$("#pl_type").change(function() {
		account_list("");
	});
	
	$("#search_loan_id").change(function() {
		var loan_id = $(this).attr("data-value");
		console.log(loan_id);
		account_list(loan_id);
	});
	
	$("#refresh").click(function() {
		$("#closed_status").trigger("change");
	});
	
	function account_list(loan_id) {
		var closed = $("#closed_status").val();
		var pl_type = $("#pl_type").val();
		$("#account_list_box").html("Loading...");
		$.ajax({
			url:"account_list",
			type:"post",
			data:"&category=PL&closed="+closed+"&loan_id="+loan_id+"&pl_type="+pl_type,
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
		ajax: '/getplaccsearch'
	});
</script>
<script>
	$("#back").click(function() {
		$("#receipt_box").html("");
		$("#loan_details_box").show();
	})
</script>



<script>
	$(function() {
		$(".print").click(function() {
			//var divContents = $("#toprint").html();
			var divContents = $("#account_list_box").html();
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
</script>



<script>
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		
		if(type=="word")
		{
			
			$('#account_list_box').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('#account_list_box').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			//alert("Please Select Type For Export");
			$('#account_list_box').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
			
		}
		
	});
</script>



<script>
	$('.crtlal').click(function(e)
	{
		e.preventDefault();
		$("#loan_details_box").hide();
		$('#receipt_box').load($(this).attr('href'));
	});
</script>
