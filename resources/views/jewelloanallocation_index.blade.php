
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
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> LOAN ALLOCATION DETAIL</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info">
						
						<!-- <a href="crtloanallocation" class="btn btn-default crtlal">LOAN ALLOCATION</a>-->
						<a href="jewelLoan" class="btn btn-default crtlal">LOAN ALLOCATION</a>
						<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
						<div class="col-md-5 pull-right">
							<input class="SearchTypeahead form-control" id="search_loan_id" type="text" name="search_loan_id" placeholder="SEARCH JEWEL ACCOUNT">
						</div>
						<div class="col-md-4">
							<select class="form-control" id="ExportType" name="ExportType">
								<option value="">SELECT TYPE TO EXPORT</option>
								<option value="word">WORD</option>
								<option value="excel">EXCEL</option>
								<option value="pdf">PDF</option>
							</select>
						</div>
						
						<div>
							ACCOUNT TYPE:
							<select id="closed_status">
								<option value="NO">LIVE</option>
								<option value="YES">CLOSED</option>
							</select>
						</div>
					</div>
							
						<div id="account_list_box">---</div>
							
				</div>
				
				
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		account_list();
	});
	
	$("#closed_status").change(function() {
		account_list();
	});
	
	function account_list() {
		var closed = $("#closed_status").val();
		$.ajax({
			url:"account_list",
			type:"post",
			data:"&category=JL&closed="+closed,
			success: function(data) {
				console.log("done");
				$("#account_list_box").html(data);
			}
		});
	}
</script>
<script>
	$('input.SearchTypeahead').typeahead({
		ajax: '/getjlaccsearch'
	});
</script>

