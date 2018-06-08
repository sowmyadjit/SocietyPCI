<?php
	$class_debit = "red-text";
	$class_credit = "green-text";
	$opening_balance = $data["opening_balance"];
	$receipt_amount_sum = $data["receipt_amount_sum"];
	$voucher_amount_sum = $data["voucher_amount_sum"];
	$op_rec_sum = $opening_balance + $receipt_amount_sum;
	$total_remaining_bal = $op_rec_sum - $voucher_amount_sum;
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
<style>
	.green-text {
		color: #014204;
	}
	.red-text {
		color: #600101;
	}
</style>
<!-- <input type="button" value="Print" class="btn btn-info btn-sm print" id="print"> -->
<div id="toprint_data">
	<h1 style="font-size:17px;">Date : {{$data["date"]}}</h1>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
		<thead>
			<tr>
				<th>Receipt No.</th>
				<th>Voucher No.</th>
				<th>Particulars</th>
				<th>Receipt Amount</th>
				<th>Payment Amount</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data["chitta"] as $row)
				<?php
				if(strcasecmp($row["transaction_type"],"CREDIT") == 0) {
					$row_class = $class_credit;
				} else {
					$row_class = $class_debit;
				}
				?>
				<tr class="{{$row_class}}">
					<td>{{$row["receipt_no"]}}</td>
					<td>{{$row["voucher_no"]}}</td>
					<td>{{$row["particulars"]}}</td>
					<td>{{$row["receipt_amount"]}}</td>
					<td>{{$row["voucher_amount"]}}</td>
				</tr>
			@endforeach
				<tr>
					<td></td>
					<td></td>
					<td><b>TOTAL</b></td>
					<td><span class="green-text"><b>{{$data["receipt_amount_sum"]}}</b></span></td>
					<td><span class="red-text"><b>{{$data["voucher_amount_sum"]}}</b></span></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><b>OP BAL / CL BAL</b></td>
					<td><b>{{$data["opening_balance"]}}</b></td>
					<td><b>{{$total_remaining_bal}}</b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><b>GRAND TOTAL</b></td>
					<td><b>{{$op_rec_sum}}</b></td>
					<td><b>{{$op_rec_sum}}</b></td>
				</tr>
		</tbody>
	</table>
</div>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint_data").html();
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