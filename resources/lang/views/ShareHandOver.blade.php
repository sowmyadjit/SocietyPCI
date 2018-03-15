<div class="SearchRes">
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		<thead>
			<tr>
				<th>Cetificate Number</th>
				<th>Number Of Shares</th>
				<th>Total value</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
			
			
			<h3>SHARE DETAILS</h3>
			
			@foreach ($shares['data1'] as $hugeshares)
			<tr>
				<td class="hidden">{{ $hugeshares->PURSH_Pid }}</td>
				
				
				<td>{{ $hugeshares->PURSH_Certfid }}</td>
				<td>{{ $hugeshares->PURSH_Noofshares }}</td>
				<td>{{ $hugeshares->PURSH_TotalShareValue }}</td>
				
				<td>
										
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="CLOSE" class="btn btn-info btn-sm edtbtn" href="shareclose/{{$hugeshares->PURSH_Pid}}"/>
											</div>
										</div>
									</td>
				
				
				
				
				
			</tr>
			@endforeach
		</tbody>
	</table>
	<h3> INDIVIDUAL  SHARE DETAILS</h3>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		<thead>
			<tr>
				<th>Share Number</th>
				<th>Cetificate Number</th>
				<th> Shares Amount</th>
				<th> Action</th>
				
				
			</tr>
		</thead>
		<tbody>
			
			
			
			
			@foreach ($shares['data2'] as $indvshares)
			<tr>
				<td >{{ $indvshares->individual_share_ID }}</td>
				
				
				<td>{{ $indvshares->individual_share_certificateid }}</td>
				<td>{{ $indvshares->PURSH_Shareamt }}</td>
				<td>
										
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="CLOSE" class="btn btn-info btn-sm edtbtn1" href="indshareclose/{{$indvshares->individual_share_ID}}"/>
											</div>
										</div>
									</td>
				
				
				
				
				
				
				
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>



<script>
	
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn1').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	
</script>			