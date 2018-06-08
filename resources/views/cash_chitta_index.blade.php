
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
<style>
	.right_text{
	text-align: right;
    vertical-align: middle;
    margin-top: 10px;
	}
</style>

	
<div id="content" class="col-lg-10 col-sm-10">
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Day Book<!-- cash chitta--></h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
					
				</div>
				<div class="box-content" style="height: auto;">
					<div class="alert alert-info" style="height:75px;">
						
						<div class="col-md-12" style="height:50px;">
							<label class="control-label col-sm-5 right_text" for="year_month">Select Date :</label>
							<div class="col-md-7 pull-right">
								<input id="date" class="date-picker" type="date" value="{{date('Y-m-d')}}"/>
								<button class="btn-sm refresh"><span class="glyphicon  glyphicon-refresh" /></button>
							</div>
						</div> 
						
					</div>
					<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
					<div id="toprint_data1">
					<div id="data_box"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	$("#date").change(function() {
		var date = $("#date").val();
		$("#data_box").html("");
		$.ajax({
			url : "cash_chitta_data",
			type : "post",
			data : "date="+date,
			success : function(data) {
				$("#data_box").html(data);
				get_denominations(date);
			}
		});
	});
	
	$(function() {
		$("#date").trigger("change");
	});
	
	$(".refresh").click(function() {
		$("#date").trigger("change");
	});

	function get_denominations(date) {
		$.ajax({
			url : "get_denominations",
			type : "post",
			data : "date="+date,
			success : function(data) {
				$("#data_box").append(data);
			}
		});
	}
	
</script>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint_data1").html();
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
	$('#toprint_data').tableExport({type:'excel',escape:'false'});
	});	
</script>