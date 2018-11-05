
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						<th>Name</th>
						<th>Agent Name</th>
						<th>PIGMI Type</th>
						<th>Interest</th>
						<th>Commission</th>
						<th>Opening Balance</th>
						<th colspan=2><center>Action</center></th>
							
						</tr>
						</thead>
						<tbody>
							
							
							@foreach ($p['data'] as $pigmitype)
							<tr>
								<td class="hidden">{{ $pigmitype->PigmiTypeid }}</td>
								<td class="hidden">{{ $pigmitype->PigmiAllocID }}</td>
								<td>{{ $pigmitype->FirstName }} {{ $pigmitype->MiddleName }} {{ $pigmitype->LastName }}</td>
								<td>{{ $pigmitype->agent_name}}</td>
								<td>{{ $pigmitype->Pigmi_Type }}</td>	
								<td>{{ $pigmitype->Interest}}</td>
								<td>{{$pigmitype->Max_Commission}}</td>
								<td>
									<input id="opening_balance_{{$pigmitype->PigmiAllocID}}" />
								</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="ACCEPT" id="accept_{{ $pigmitype->PigmiAllocID }}" class="btn btn-success btn-sm accpigmy<?php echo $p['module']->Mid; ?>" href="acceptaccountpigmy/{{ $pigmitype->PigmiAllocID }}" data="{{ $pigmitype->PigmiAllocID }}" />
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="REJECT" id="reject_{{ $pigmitype->PigmiAllocID }}" class="btn btn-danger btn-sm rejbtn<?php echo $p['module']->Mid; ?>" href="rejectedaccountpigmy/{{ $pigmitype->PigmiAllocID }}" data="{{ $pigmitype->PigmiAllocID }}" />
										</div>
									</div>
								</td>
								
							</tr>
							
						</thead>
					</tbody>
					@endforeach
				</table>


				

<script>
	function disable_row(pg_id) {
		$("#opening_balance_"+pg_id).prop("disabled",true);
		$("#accept_"+pg_id).prop("disabled",true);
		$("#reject_"+pg_id).prop("disabled",true);
	}
</script>

<script>
	$('.accpigmy<?php echo $p['module']->Mid; ?>').click(function(e)
	{
		var url = $(this).attr('href');
		var pg_id = $(this).attr('data');
		disable_row(pg_id);
		// console.log("url: "+url);
		var parent = $(this).parent();
		var opening_balance = $("#opening_balance_"+pg_id).val();

		// console.log("opening_balance ",opening_balance);

		if(opening_balance == "") {
			alert("Enter opening balance");
		} else {
			$.ajax({
				url: url,
				type: 'get',
				data: "&opening_balance="+opening_balance,
				success: function(data) {
					disable_row(pg_id);
					parent.html("<b>ACCEPTED</b>");
					// console.log($("#edit_"+pg_id).prop("disabled",true));
					// load_data();
				}
			});
		}
		
	});
</script>

<script>
	$('.rejbtn<?php echo $p['module']->Mid; ?>').click(function(e)
	{
		var url = $(this).attr('href');
		var pg_id = $(this).attr('data');
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(pg_id);
				parent.html("<b>REJECTED</b>");
				// load_data();
			}
		});
		
	});
</script>
				