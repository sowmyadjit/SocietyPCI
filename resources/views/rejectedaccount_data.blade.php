
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Account Number</th>
				<th>Account Type</th>
				<th>Branch</th>
				<th> Name</th>
				<th>Mobile Number</th>
				<th>Phone Number</th>
		
				<th colspan=2><center>ACTION</center></th>
				
			</tr>
		</thead>
		
		<tbody>
			
			@foreach ($rejectacc['data'] as $createaccount)
			<tr>
				<td class="hidden">{{ $createaccount->Accid }}</td>
				<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn_i viwbtn<?php echo $rejectacc['module']->Mid; ?>">{{ $createaccount->AccNum }}</a></td>
				<td>{{ $createaccount->Acc_Type }}</td>
				<td>{{ $createaccount->BName }}</td>
				<td>{{ $createaccount->FirstName }} {{ $createaccount->MiddleName }} {{ $createaccount->LastName }}</td>
				<td>{{ $createaccount->MobileNo }}</td>
				<td>{{ $createaccount->PhoneNo }}</td>
				<!--<td>
					
					<div class="form-group">
					<div class="col-sm-12">
					<input type="button" value="VIEW" class="btn btn-info btn-sm viwbtn" href="accountdetails/{{ $createaccount->Accid }}"/>
					</div>
					</div>
					
				</td>-->
				
				<td>
					
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="EDIT" id="edit_{{ $createaccount->Accid }}" class="btn btn-primary btn-sm edtbtn_i edtbtn<?php echo $rejectacc['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
						</div>
					</div>
					
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_{{ $createaccount->Accid }}" class="btn btn-success btn-sm accbtn<?php echo $rejectacc['module']->Mid; ?>" href="acceptaccount/{{ $createaccount->Accid }}" data="{{ $createaccount->Accid }}" />
						</div>
					</div>
				</td>
				
			</tr>
			
			@endforeach
		</tbody>
		
	</table>

	

<script>
	$('.viwbtn_i, .edtbtn_i').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
		$("#back").hide();
	});
</script>

<script>
	function disable_row(acc_id) {
		$("#edit_"+acc_id).prop("disabled",true);
		$("#accept_"+acc_id).prop("disabled",true);
	}
</script>

<script>
	$('.accbtn<?php echo $rejectacc['module']->Mid; ?>').click(function(e)
	{
		var url = $(this).attr('href');
		var acc_id = $(this).attr('data');
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(acc_id);
				parent.html("<b>ACCEPTED</b>");
				// console.log($("#edit_"+acc_id).prop("disabled",true));
				// load_data();
			}
		});
		
	});
</script>
