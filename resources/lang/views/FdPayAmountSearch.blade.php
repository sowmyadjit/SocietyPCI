<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	
	<thead>
		<tr>
			
			
			<th>Customer Name</th>
			<th>Account Number</th>
			<th>FD Type</th>
			<th>Payed Date</th>
			<th>RECEIPT</th>
			
		</tr>
	</thead>
	
	<tbody>
		
		@foreach ($PayAmount as $PAmt)
		<tr>
			<td class="hidden">{{ $PAmt->FDPayId }}</td>
			<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
			
			<td>{{ $PAmt->FDPayAmt_AccNum }}</td>
			<td>{{ $PAmt->FdType }}</td>
			
			<td><?php $paydate=date("d-m-Y",strtotime($PAmt->FDPayAmtReport_PayDate)); echo $paydate;?></td>
			
			<td>
				<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="FdPayAmountReceipt/{{ $PAmt->FDPayId }}"/>
				
				
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