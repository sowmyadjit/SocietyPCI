
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
					
						<th>Name</th>
						<th>Date</th>
						<th>Share Class</th>
						<th>Number Of Shares</th>
						<th>Total Share Price</th>
						<th>Remarks</th>
						<th>Status</th>
						<th colspan=3><center>Action</center></th>
						</tr>
					
					</thead>
					
					<tbody>
					
						@foreach ($m['data'] as $members)
						<tr>
							 <td class="hidden">{{ $members->Memid }}</td>
							 <td class="hidden">{{ $members->PURSH_Pid }}</td>
							 
							 <td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }} {{ $members->MiddleName }} {{ $members->LastName }}</a></td>
							 <td>{{$members->CreatedDate}}</td>
							 <td>{{$members->PURSH_Shrclass}}</td>
							 <td>{{$members->PURSH_Noofshares}}</td>
							 <td>{{$members->PURSH_TotalShareValue}}</td>
							 <td>{{$members->Remarks}}</td>
							 <td>{{$members->Status}}</td>
							
							 <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" id="edit_{{ $members->Memid }}" class="btn btn-primary btn-sm edtbtn<?php echo $m['module']->Mid; ?>" href="memberdetails/{{ $members->Memid }}/edit"/>
										</div>
									</div>
								</td>	
								<td>	
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="ACCEPT" id="accept_{{ $members->Memid }}" class="btn btn-success btn-sm accbtn<?php echo $m['module']->Mid; ?>" href="acceptshares/{{ $members->Memid }}/{{ $members->PURSH_Pid }}" data="{{ $members->Memid }}" />
										</div>
									</div>
								</td>
								<td>
									
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="REJECT" id="reject_{{ $members->Memid }}" class="btn btn-danger btn-sm rejbtn<?php echo $m['module']->Mid; ?>" href="rejectshare/{{ $members->Memid }}/{{ $members->PURSH_Pid }}" data="{{ $members->Memid }}" />
										</div>
									</div>
									
							 </td>
							 
						</tr>
						@endforeach
						
					</tbody>
					
					</table>


		

<script>
	$('.memdet').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>

<script>
	$('.edtbtn<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>

<script>
	function disable_row(mem_id) {
		$("#edit_"+mem_id).prop("disabled",true);
		$("#accept_"+mem_id).prop("disabled",true);
		$("#reject_"+mem_id).prop("disabled",true);
	}
</script>

<script>
	$('.accbtn<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		var url = $(this).attr('href');
		var mem_id = $(this).attr('data');
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(mem_id);
				parent.html("<b>ACCEPTED</b>");
				// console.log($("#edit_"+mem_id).prop("disabled",true));
				// load_data();
			}
		});
		
	});
</script>

<script>
	$('.rejbtn<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		var url = $(this).attr('href');
		var mem_id = $(this).attr('data');
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(mem_id);
				parent.html("<b>REJECTED</b>");
				// load_data();
			}
		});
		
	});
</script>
	
