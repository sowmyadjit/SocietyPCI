<?php
	function dmy($date)
	{
		return date("d-m-Y",strtotime($date));
	}
?>
<div>
<script src="js/FileSaver.js"/>			
<script src="js/tableExport.js"/>	
<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
<table  class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="expense_details">
	<thead>
		<tr>
			<th>allocation_id</th>
			<th>pigmy_no</th>
			<th>Name</th>
			<th>Amount till previous  day</td>
			@foreach($data["dates"] as $tran_date)
			<th>{{dmy($tran_date)}}</th>
			@endforeach
			<th>Total Balance</th>
		</tr>
	</thead>
	@foreach($data["pg_tr"] as $key_det => $row_det)
	<tr>
		<td>{{$row_det["allocation_id"]}}</td>
		<td>{{$row_det["pigmy_no"]}}</td>
		<td>{{$row_det["customer_name"]}}</td>
		<td>{{$row_det["prev_amt"]}}</td>
		@foreach($data["dates"] as $tran_date)
			<td>{{$row_det["{$tran_date}"]}}</td>
		@endforeach
		<td>{{$row_det["total_amt"]}}</td>
	</tr>
	@endforeach
</table>

<div id="toprint" style="position:fixed;opacity:0;">
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
	<tr>
		<th>allocation_id</th>
		<th>pigmy_no</th>
		<th>Name</th>
		<th>Amount till previous  day</td>
		@foreach($data["dates"] as $tran_date)
			<th>{{dmy($tran_date)}}</th>
		@endforeach
		<th>Total Balance</th>
	</tr>
	@foreach($data["pg_tr"] as $key_det => $row_det)
	<tr>
		<td>{{$row_det["allocation_id"]}}</td>
		<td>{{$row_det["pigmy_no"]}}</td>
		<td>{{$row_det["customer_name"]}}</td>
		<td>{{$row_det["prev_amt"]}}</td>
		@foreach($data["dates"] as $tran_date)
			<td>{{$row_det["{$tran_date}"]}}</td>
		@endforeach
		<td>{{$row_det["total_amt"]}}</td>
	</tr>
	@endforeach
</table>
</div>
</div>
<script>
$('#excel').click(function(e){
	alert("excel");
	$('#expense_details').tableExport({type:'excel',escape:'false'});
	});	</script>
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
</script>	