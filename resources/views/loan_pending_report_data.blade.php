



						<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table" id="loan_pending_report_table">
							<thead>
								<tr>
									<th>No.</th>
									<th>Name</th>
									<th>Loan No.</th>
									<th>Remaining Amount</th>
									<th>End Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data['det'] as $key=>$row)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
										<td>{{ $row->ln_no }}</td>
										<td>{{ $row->rem_amt }}</td>
										<td>{{ $row->end_date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div id="toprint" style="position:fixed;opacity:0;">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
							<thead>
								<tr>
									<th>No.</th>
									<th>Name</th>
									<th>Loan No.</th>
									<th>Remaining Amount</th>
									<th>End Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data['det'] as $key=>$row)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
										<td>{{ $row->ln_no }}</td>
										<td>{{ $row->rem_amt }}</td>
										<td>{{ $row->end_date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						</div>
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