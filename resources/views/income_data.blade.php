
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export">
					<thead>
						<tr>
							<th>Date</th>
							
							<th>Income For</th>
							<th>Amount</th>							
							<th>Particulars</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
						
						@foreach ($ex as $expence)
						<tr>
							<td class="hidden">{{ $expence->Income_id }}</td>
							<td>{{ $expence->Income_date }}</td>
							
							<td>{{ $expence->lname }}</td>
							<td>{{ $expence->Income_amount }}</td>
							<td>{{ $expence->Income_Particulars }}</td>
							<td>
								
								<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="IncomeReceipt/{{ $expence->Income_id }}"/>
								
							</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
					<div id="toprint" style="position:fixed;opacity:0;">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
						
						<thead>
							<tr>
								<th>Date</th>
								
								<th>Income For</th>
								<th>Amount</th>							
								<th>Particulars</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($ex as $expence)
							<tr>
								<td>{{ $expence->Income_date }}</td>
								
								<td>{{ $expence->lname }}</td>
								<td>{{ $expence->Income_amount }}</td>
								<td>{{ $expence->Income_Particulars }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>


<script>
	$(".ReceiptPrint").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url,false);
	});
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
</script>