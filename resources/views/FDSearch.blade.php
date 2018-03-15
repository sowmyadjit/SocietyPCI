<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			
			<th>Certificate Number</th>
			
			<th> Name</th>
			<th>Number Of Days</th>
			<th>Interest</th>
			<th>Deposit Amount</th>
			<th>Start Date</th>
			<th>Mature Date</th>
			<th>Maturity Amount</th>
			<th>Remarks</th>
			<th colspan=3><center>ACTION</center></th>
			
			
		</tr>
	</thead>
	<tbody>
		
		<tr>
			@foreach ($fda as $fdallocation)
			<tr>
				<td class="hidden">{{ $fdallocation->Fdid }}</td>
				<td class="hidden">{{ $fdallocation->FdTid }}</td>
				<td class="hidden">{{ $fdallocation->Uid }}</td>
				
				
				<td>{{ $fdallocation->Fd_CertificateNum }}</td>
				
				<td>{{ $fdallocation->FirstName }}
				{{ $fdallocation->MiddleName}}
				{{ $fdallocation->LastName }}</td>
				
				<td>{{ $fdallocation->NumberOfDays }}</td>
				<td>{{ $fdallocation->FdInterest }}</td>
				<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
				<td>{{$fdallocation->Fd_StartDate}}
					<td>{{ $fdallocation->Fd_MatureDate}}</td>
					<td>{{ $fdallocation->Fd_TotalAmt}}</td>
					<td>{{ $fdallocation->Fd_Remarks}}</td>
					<td>
						<input type="button" value="CERTIFICATE" class="btn btn-success btn-sm CertiBtn" href="FdCertificate/{{ $fdallocation->Fdid }}"/>
					</td>
					<td>
						
						<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="FDReceipt/{{ $fdallocation->Fdid }}"/>
						
					</td>
					<td>
						
						<input type="button" value="EDIT" class="btn btn-info btn-sm ReceiptPrint" href="FDedit/{{ $fdallocation->Fdid }}"/>
						
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
		
		<script>
			$('.clickme').click(function(e)
			{
				$('.fdallclassid').click();
			});
			
			$('.CertiBtn').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$('.ReceiptPrint').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$('.crtpal').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
		</script>		