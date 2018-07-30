
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
					<thead>
					
						<tr>
						<th>EMPLOYEE CODE</th>
						<th>FIRST NAME</th>
						<th>MIDDLE NAME</th>
						<th>LAST NAME</th>
						<th>BRANCH NAME</th>
						<th>DESIGNATION</th>
						<th>MOBILE NUMBER</th>
						<th>PHONE NUMBER</th>
						<th>CD</th>
						
						<th>Action</th>
						</tr>
						
					</thead>
					
					<tbody>

					
						@foreach ($e['Employee'] as $employee)
						<tr>
							<td class="hidden">{{ $employee->Eid }}</td>
							<td><a  href="empdetails/{{ $employee->Eid }}" class="empdet">{{$employee->ECode}}</a></td>
							<td><a  href="empdetails/{{ $employee->Eid }}" class="empdet">{{ $employee->FirstName }}</a></td>
							<td>{{ $employee->MiddleName}}</td>
							<td>{{$employee->LastName}}</td>
							<td>{{$employee->BName}}</td>
							<td>{{$employee->DName}}</td>
							<td>{{$employee->MobileNo}}</td>
							<td>{{$employee->PhoneNo}}</td>
							<td>{{$employee->CD}}</td>
							
							
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="empdetails/{{ $employee->Eid }}/edit"/>
										</div>
									</div>
							</td>
							 
						</tr>

						@endforeach

					</tbody>
				</table>
				







<script>
	$(".empdet").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url,false);
	});
	$(".edtbtn").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url,false);
	});
</script>