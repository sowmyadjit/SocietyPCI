<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	
	<thead>
		<tr>
			
			
			<th>Member Firstname</th>
			<th>Member MiddleName</th>
			<th>Member LastName</th>
			<th>Member ID</th>
			
			<th>Share Class</th>
			<th>Share Amount</th>
			<!--<th>Share Price</th>-->
			<th>Total Shares</th>
			<th>Total Amount</th>
			<th>Member Share ID</th>
			<th>Certificate ID</th>
			<th>SHARE STATUS</th>
			<th>CERTIFICATE</th>
			<th>RECEIPT</th>
			
		</tr>
	</thead>
	
	<tbody>
		
		@foreach ($ps as $purchaseshare)
		<tr>
			<td class="hidden">{{ $purchaseshare-> PURSH_Pid}}</td>
			<td>{{ $purchaseshare->FirstName}}</td>
			<td>{{ $purchaseshare->MiddleName }}</td>
			<td>{{ $purchaseshare->LastName }}</td>
			<td>{{ $purchaseshare->PURSH_Memid }}</td>
			<td>{{ $purchaseshare->PURSH_Shrclass }}</td>
			<td>{{ $purchaseshare->PURSH_Shareamt }}</td>
			<td>{{ $purchaseshare-> PURSH_Noofshares}}</td>
			<td>{{ $purchaseshare->PURSH_Totalamt }}</td>
			<td>{{ $purchaseshare->PURSH_Memshareid }}</td>
			<td>{{ $purchaseshare->PURSH_Certfid }}</td>
			<td>{{ $purchaseshare->Status }}</td>
			<td>
				
				
				<input type="button" value="CERTIFICATE" class="btn btn-info btn-sm edtbtn" href="psharedetails/{{ $purchaseshare->PURSH_Pid }}"/>
			</td>
			<td>
				<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="PshareReceipt/{{ $purchaseshare->PURSH_Pid }}/{{ $purchaseshare->PURSH_Memid }}"/>
				
				
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
	
	$('.purshrcrt').click(function(e)
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