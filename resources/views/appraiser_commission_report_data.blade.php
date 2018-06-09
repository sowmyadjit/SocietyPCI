
					<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
						<div id="to_print" >
						
							<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive ">
								<thead>
									<tr>
										<th>Sl. No.</th>
										<th>Date</th>
										<th>Jewel Allocaiton Amount</th>
										<th>Appraiser Commission</th>
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($data['appraiser_commission_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{$row["date"]}}</td>
											<td>{{$row["loan_amount_daily_sum"]}}</td>
											<td>{{$row["appraiser_charge_daily_sum"]}}</td>
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td>{{$data["loan_amount_total_sum"]}}</td>
										<td>{{$data["appraiser_charge_total_sum"]}}</td>
									</tr>
								</tbody>
							</table>
						</div>
							
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#to_print").html();
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
							