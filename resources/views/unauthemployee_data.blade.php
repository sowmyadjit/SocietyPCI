
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
					<thead>
					
						<tr>
							<th>EMPLOYEE CODE</th>
							<th>NAME</th>
							<th>BRANCH NAME</th>
							<th>DESIGNATION</th>
							<th>MOBILE NUMBER</th>
							<th colspan="3">Action</th>
						</tr>
						
					</thead>
					
					<tbody>

					
						@foreach ($emp1['UnAuthEmp'] as $employee)
						<tr>
							<td class="hidden">{{ $employee->Eid }}</td>
							<td>{{$employee->ECode}}</td>
							<td><a  href="empdetails/{{ $employee->Eid }}" class="empdet">{{ $employee->FirstName }} {{ $employee->MiddleName}} {{$employee->LastName}}</a></td>
							<td>{{$employee->BName}}</td>
							<td>{{$employee->DName}}</td>
							<td>{{$employee->MobileNo}}</td>
							
							
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" id="edit_{{ $employee->Eid }}" value="EDIT" class="btn btn-primary btn-sm edtbtn" href="empdetails/{{ $employee->Eid }}/edit" data="{{ $employee->Eid }}" />
										</div>
									</div>
							</td>
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" id="accept_{{ $employee->Eid }}" value="Accept" class="btn btn-success btn-sm accemp" href="acceptemp/{{ $employee->ECode }}" data="{{ $employee->Eid }}" />
										</div>
									</div>
								</td>
									<td>
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" id="reject_{{ $employee->Eid }}" value="REject" class="btn btn-danger btn-sm rejbtn" href="rejectemp/{{ $employee->ECode }}" data="{{ $employee->Eid }}" />
										</div>
									</div>
									</td>
		
							 
						</tr>

						@endforeach

					</tbody>
				</table>
			
				
			
<script>
	$('.empdet, .edtbtn').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>

<script>
	function disable_row(emp_id) {
		$("#edit_"+emp_id).prop("disabled",true);
		$("#accept_"+emp_id).prop("disabled",true);
		$("#reject_"+emp_id).prop("disabled",true);
	}
</script>

<script>
	$('.accemp').click(function(e)
	{
		var url = $(this).attr('href');
		var emp_id = $(this).attr('data');
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(emp_id);
				parent.html("<b>ACCEPTED</b>");
				// console.log($("#edit_"+cust_id).prop("disabled",true));
				// load_data();
			}
		});
		
	});
</script>