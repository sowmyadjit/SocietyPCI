<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			<th>PIGMI Type</th>
			<th>Customer Name</th>
			<th>Old Account Number</th>
			<th>Account Number</th>
			<th>Allocation Date</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Total Balance</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		
		@foreach ($pa as $pigmiallocation)
		<tr>
			<td class="hidden">{{ $pigmiallocation->PigmiAllocID }}</td>
			<td>{{ $pigmiallocation->Pigmi_Type }}</td>
			<td>{{ $pigmiallocation->FirstName }}</td>	
			<td>{{$pigmiallocation->old_pigmiaccno}}</td>
			<td>{{$pigmiallocation->PigmiAcc_No}}</td>
			<td><?php $crdate=date("d-m-Y",strtotime($pigmiallocation->AllocationDate)); echo $crdate; ?></td>
			<td><?php $crdate=date("d-m-Y",strtotime($pigmiallocation->StartDate)); echo $crdate; ?></td>
			<td><?php $crdate=date("d-m-Y",strtotime($pigmiallocation->EndDate)); echo $crdate; ?></td>
			<td>{{$pigmiallocation->Total_Amount}}</td> 
								<td>
								
								<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="ViewPigallocEdit/{{ $pigmiallocation->PigmiAllocID }}"/>
											</div>
										</div>
								</td>
		</tr>
		@endforeach
		
	</tbody>
</table>


<script>
	$('.clickme').click(function(e)
	{
		$('.pigmiallocclassid').click();
	});
	
	$('.crtpal').click(function(e)
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
</script>