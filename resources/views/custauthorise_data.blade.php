
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			
			<thead>
				<tr>
					<th>NAME</th>
					<th>ADDRESS</th>
					<th>BRANCH NAME</th>
					<th>MOBILE NUMBER</th>
					<th>MEMEBR NUMBER</th>
					<th colspan=3><center>ACTION</center></th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach ($c['CustAuth'] as $customer)
				<tr>
					<td class="hidden">{{ $customer->Custid }} {{ $customer->MiddleName }} {{ $customer->LastName }}</td>
					<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet<?php echo $c['module']->Mid; ?>">{{ $customer->FirstName }}</a></td>
					<td>{{ $customer->Address }}</td>
					<td>{{ $customer->BName }}</td>
					<td>{{ $customer->MobileNo }}</td>
					<td>{{ $customer->Member_No }}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" id="edit_{{ $customer->Custid }}" class="btn btn-primary btn-sm edtbtn<?php echo $c['module']->Mid; ?>" href="customerdetails/{{ $customer->Custid }}/edit"  data="{{ $customer->Custid }}" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="ACCEPT" id="accept_{{ $customer->Custid }}" class="btn btn-success btn-sm accustpbtn<?php echo $c['module']->Mid; ?>" href="authorisecust/{{ $customer->Custid }}"   data="{{ $customer->Custid }}" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="REJECT" id="reject_{{ $customer->Custid }}" class="btn btn-danger btn-sm rejbtn<?php echo $c['module']->Mid; ?>" href="rejectcust/{{ $customer->Custid }}"   data="{{ $customer->Custid }}" />
							</div>
						</div>
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>


		
<script>
	$('.custdet<?php echo $c['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>
<script>
	$('.edtbtn<?php echo $c['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>

<script>
	function disable_row(cust_id) {
		$("#edit_"+cust_id).prop("disabled",true);
		$("#accept_"+cust_id).prop("disabled",true);
		$("#reject_"+cust_id).prop("disabled",true);
	}
</script>

<script>
	$('.accustpbtn<?php echo $c['module']->Mid; ?>').click(function(e)
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
				disable_row(cust_id);
				parent.html("<b>ACCEPTED</b>");
				// console.log($("#edit_"+cust_id).prop("disabled",true));
				// load_data();
			}
		});
		
	});
</script>

<script>
	$('.rejbtn<?php echo $c['module']->Mid; ?>').click(function(e)
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
				disable_row(cust_id);
				parent.html("<b>REJECTED</b>");
				// load_data();
			}
		});
		
	});
</script>
	