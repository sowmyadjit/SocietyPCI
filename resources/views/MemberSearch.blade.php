<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	
	<thead>
		<tr>
			
			<th>Member Number</th>
			<th>Name</th>
			<th>Father Name</th>
			<th>Date</th>
			<th>Status</th>
			<th>No. of Shares</th>
			<th>Total Share Amt</th>
			<th>Remarks</th>
			<th>ACTION</th>
		</tr>
		
	</thead>
	
	<tbody>
		
		@foreach ($m as $members)
		<tr>
			<td>{{ $members->Memid }}/{{ $members->Member_no }}</td>
			
			<td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}
			{{ $members->MiddleName }}
			{{ $members->LastName }}</a></td>
			<td>{{ $members->FatherName }}</td>
			<td><?php $crdate=date("d-m-Y",strtotime($members->CreatedDate)); echo $crdate; ?> </td>
			
			<td>{{$members->status}}</td>
			<td>{{$members->no_of_shares}}</td>
			<td>{{$members->total_share_amt}}</td>
			
			<td>{{$members->Remarks}}</td>
			<td>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="memberdetails/{{ $members->Memid }}/edit"/>
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
		$('.memclassid').click();
	});
	
	$('.crtmem').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.memdet').click(function(e){
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