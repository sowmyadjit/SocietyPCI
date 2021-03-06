
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	
	<thead>
		<tr>
			<th>FIRST NAME</th>
			<th>MIDDLE NAME</th>
			<th>LAST NAME</th>
			<th>BRANCH NAME</th>
			<th>MOBILE NUMBER</th>
			<th>PHONE NUMBER</th>
			<th>CUSTOMER TYPE</th>
			<th>MEMBER NUMBER</th>
			<th colspan=2><center>ACTION</center></th>
			
		</tr>
	</thead>
	
	<tbody>
		@foreach ($c as $customer)
		<tr>
			<td class="hidden">{{ $customer->Custid }}</td>
			<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet">{{ $customer->FirstName }}</a></td>
			<td>{{ $customer->MiddleName }}</td>
			<td>{{ $customer->LastName }}</td>
			<td>{{ $customer->BName }}</td>
			<td>{{ $customer->MobileNo }}</td>
			<td>{{ $customer->PhoneNo }}</td>
			<td>{{ $customer->custtyp }}</td>
			<td>{{ $customer->Member_No }}</td>
			
			<td>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="customerdetails/{{ $customer->Custid }}/edit"/>
					</div>
				</div>
			</td>
			@if($customer->custtyp=="CLASS D")
			<td>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="CustomerReceipt/{{ $customer->Custid }}"/>
					</div>
				</div>
			</td>
			@else
			<td>
				
			</td>
			@endif
			
		</tr>
		@endforeach
	</tbody>
</table>

<script>
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtcust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.custdet').click(function(e){
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
		$('.box-content').load($(this).attr('href'));
	});
</script>