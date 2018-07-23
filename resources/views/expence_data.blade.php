<?php /* expence_data */ ?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="expense_details">
	
	<thead>
		<tr>
			<th>Date</th>
			
			<th>Expence For</th>
			<th>Amount</th>							
			<th>Particulars</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
		@foreach ($ex['expense'] as $expence)
		<tr>
			<td class="hidden">{{ $expence->id }}</td>
			<td>{{ $expence->e_date }}</td>
			
			<td>{{ $expence->lname }}</td>
			<td>{{ $expence->amount }}</td>
			<td>{{ $expence->Particulars }}</td>
			<td>
				
				<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $ex['module']->Mid; ?>" href="ExReceipt/{{ $expence->id }}"/>
				
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
			<th>Expence For</th>
			<th>Amount</th>							
			<th>Particulars</th>
		</tr>
	</thead>
	<br>
	<tbody>	
		@foreach ($ex['expense'] as $expence)
		<tr>
			<td>{{ $expence->e_date }}</td>	
			<td>{{ $expence->lname }}</td>
			<td>{{ $expence->amount }}</td>
			<td>{{ $expence->Particulars }}</td>	
		</tr>
		@endforeach
	</tbody>
</table>


<script>
	$(".ReceiptPrint<?php echo $ex['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});
	
	function load_url(url) {
		$(".b_main").hide();
		$(".b_sub_1").load(url);
	}
</script>

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