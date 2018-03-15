<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	
	<thead>
		<tr>
			
			
			<th>Customer Name</th>
			<th>Account Number</th>
			<th>Pigmy Type</th>
			<th>Payed Date</th>
			<th>RECEIPT</th>
			
		</tr>
	</thead>
	
	<tbody>
		
		@foreach ($PayAmount as $PAmt)
		<tr>
			<td class="hidden">{{ $PAmt->PayId }}</td>
			<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
			
			<td>{{ $PAmt->PayAmount_PigmiAccNum }}</td>
			<td>{{ $PAmt->Pigmi_Type }}</td>
			<td><?php $paydate=date("d-m-Y",strtotime($PAmt->PayAmountReport_PayDate)); echo $paydate;?></td>
			
			<td>
				<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="PigmyPayAmountReceipt/{{ $PAmt->PayId }}"/>
				
				
			</td>
		</tr>
		
		@endforeach
	</tbody>
	
</table>

<script>
	
	$('.clickme').click(function(e)
	{
		$('.purshareclassid').click();
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