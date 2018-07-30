<?php /* deposit_data */ ?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="expense_details">
	
	<thead>
		<tr>
			<th>Date</th>
			<th>Bank Name</th>
			<th>Amount</th>							
			<th>Society Branch</th>							
			<th>perticulars</th>
		</tr>
	</thead>
	
	<tbody>
		
		@foreach ($depo['deposits'] as $deposit)
		<tr>
			<td class="hidden">{{ $deposit->d_id }}</td>
			<td>{{ $deposit->d_date }}</td>
			<td>{{ $deposit->depo_bank }}</td>
			<td>{{ $deposit->amount }}</td>
			<td>{{ $deposit->Branch }}</td>
			<td>{{ $deposit->reason }}</td>
			
		</tr>
		@endforeach
	</tbody>
</table>
<div id="toprint" style="position:fixed;opacity:0;">
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
	
	<thead>
		<tr>
			<th>Date</th>
			<th>Bank Name</th>
			<th>Amount</th>							
			<th>Society Branch</th>							
			<th>perticulars</th>
		</tr>
	</thead>
	
	<tbody>
		
		@foreach ($depo['deposits'] as $deposit)
		<tr>
			<td>{{ $deposit->d_date }}</td>
			<td>{{ $deposit->depo_bank }}</td>
			<td>{{ $deposit->amount }}</td>
			<td>{{ $deposit->Branch }}</td>
			<td>{{ $deposit->reason }}</td>
			
		</tr>
		@endforeach
	</tbody>
</table>


<script>
	
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
	
	$('#excel').click(function(e){
		$('#expense_details').tableExport({type:'excel',escape:'false'});
	});	
		
	</script>	