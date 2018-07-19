
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			
			<thead>
				<tr>
					<th>NAME</th>
					<th>BRANCH NAME</th>
					<th>MOBILE NUMBER</th>
					<th>PHONE NUMBER</th>
					<th colspan=2><center>ACTION</center></th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach ($c1['CustRejList'] as $customer)
				<tr>
					<td class="hidden">{{ $customer->Custid }}</td>
					<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet<?php echo $c1['module']->Mid; ?>">{{ $customer->FirstName }} {{ $customer->MiddleName }} {{ $customer->LastName }}</a></td>
					<td>{{ $customer->BName }}</td>
					<td>{{ $customer->MobileNo }}</td>
					<td>{{ $customer->PhoneNo }}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" id="edit_i_{{ $customer->Custid }}" class="btn btn-primary btn-sm edtbtn<?php echo $c1['module']->Mid; ?>" href="customerdetails/{{ $customer->Custid }}/edit" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="ACCEPT" id="accept_i_{{ $customer->Custid }}" class="btn btn-success btn-sm accept_i accustpbtn<?php echo $c1['module']->Mid; ?>" href="authoriserejcust/{{ $customer->Custid }}" data="{{ $customer->Custid }}" />
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		
<script>
	$('.custdet<?php echo $c1['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1_i").hide();
		$('#b2_i').load($(this).attr('href'));
	});
</script>
<script>
	$('.edtbtn<?php echo $c1['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1_i").hide();
		$('#b2_i').load($(this).attr('href'));
	});
</script>

<script>
	function disable_row_i(cust_id) {
		$("#edit_i_"+cust_id).prop("disabled",true);
		$("#accept_i_"+cust_id).prop("disabled",true);
	}
</script>

<script>
	$('.accept_i').click(function(e)
	{
		var url = $(this).attr('href');
		var cust_id = $(this).attr('data');
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row_i(cust_id);
				parent.html("<b>ACCEPTED</b>");
				// console.log($("#edit_"+cust_id).prop("disabled",true));
				// load_data();
			}
		});
		
	});
</script>