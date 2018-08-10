
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
						<h2><i class="glyphicon glyphicon-user"></i> STAFF ALLOCATION DETAIL</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
						<div class="alert alert-info" style="height:60px;">

							<a href="staffloan_home" class="btn btn-default crtlal">LOAN ALLOCATION</a>
							<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
							<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
							<button class="btn-sm glyphicon glyphicon-refresh" id="refresh" ></button>
							<div class="col-md-5 pull-right">
								<input class="SearchTypeahead form-control" id="search_loan_id" type="text" name="search_loan_id" placeholder="SEARCH STAFF LOAN ACCOUNT">
							</div>

						</div>
								
							<div id="account_list_box">Loading...</div>
								
					</div>
				</div>
				<div id="receipt_box"></div>
				<button class="btn btn-info btn-sm" id="back" style="margin-left:47.5%;margin-bottom:50px;">BACK</button>
				<div id="temp_loading_img" class="hide">
					<div>
						<center>
							<img src="img\\loading2.gif" width="100px" height="100px"/>
						</center>
					</div>
				</div>
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
		account_list("");
	});
	
/* 	$("#closed_status").change(function() {
		$("#account_list_box").html("Loading...");
		account_list("");
	}); */
	
	$("#refresh").click(function() {
		account_list("");
	});
	
	$("#search_loan_id").change(function() {
		var loan_id = $(this).attr("data-value");
		console.log(loan_id);
		account_list(loan_id);
	});
	
	function account_list(loan_id) {
		show_loading_img("#account_list_box");
		var closed = $("#closed_status").val();
		$.ajax({
			url:"account_list",
			type:"post",
			data:"&category=SL&closed="+closed+"&loan_id="+loan_id,
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
		// ajax: '/slsearchacc'
		ajax: '/getslaccsearch'
	});
</script>
<script>
	$("#back").click(function() {
		$("#receipt_box").html("");
		$("#loan_details_box").show();
	})
</script>

<script>
	$('.crtlal').click(function(e)
	{
		e.preventDefault();
		$("#loan_details_box").hide();
		show_loading_img("#receipt_box");
		$('#receipt_box').load($(this).attr('href'));
		$("#back").show();
	});
</script>
