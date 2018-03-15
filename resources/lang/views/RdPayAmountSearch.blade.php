<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	
	<thead>
		<tr>
			
			
			<th>Customer Name</th>
			<th>Account Number</th>
			<th>Payed Date</th>
			<th>RECEIPT</th>
			
		</tr>
	</thead>
	
	<tbody>
		
		@foreach ($PayAmount as $PAmt)
		<tr>
			<td class="hidden">{{ $PAmt->RDPayId }}</td>
			<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
			
			<td>{{ $PAmt->RDPayAmt_AccNum }}</td>
			
			<td><?php $paydate=date("d-m-Y",strtotime($PAmt->RDPayAmtReport_PayDate)); echo $paydate;?></td>
			
			<td>
				<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="RdPayAmountReceipt/{{ $PAmt->RDPayId }}"/>
				
				
			</td>
		</tr>
		
		@endforeach
	</tbody>
	
	
	
</table>

<script>
	
	$('.clickme').click(function(e)
	{
		$('.rdpayclassid').click();
	});
	
	$('.PayAmountLink').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.ReceiptPrint').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
</script>