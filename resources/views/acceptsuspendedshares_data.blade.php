
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Share Class</th>
					<th>Number Of Shares</th>
					<th>Total Share Price</th>
					<th>Remaining Amount</th>
					<th>Enter Amount</th>
					<th>Remarks</th>
					<th>Status</th>
					<th colspan=2><center>ACTION</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($m['data'] as $members)
				<tr>
					<td class="hidden">{{ $members->Memid }}</td>
					<td class="hidden pursid<?php echo $members->PURSH_Pid;?>">{{ $members->PURSH_Pid }}</td>
					<td><a  href="memberdetails/{{ $members->Memid }}" class="memdet_i">{{ $members->FirstName }}.{{ $members->MiddleName }}.{{ $members->LastName }}</a></td>
					<td>{{$members->CreatedDate}}</td>
					<td>{{$members->PURSH_Shrclass}}</td>
					<td>{{$members->PURSH_Noofshares}}</td>
					<td>{{$members->PURSH_TotalShareValue}}</td>
					<td class="pendamt<?php echo $members->PURSH_Pid;?>">{{$members->PURSH_PendingAmount}}</td>
					<td>
						<div class="form-group ">
							<div class="col-md-12">
								<input type="text" class="form-control" id="amt<?php echo "$members->PURSH_Pid";?>" name="amt<?php echo $members->PURSH_Pid;?>" style="padding:0;" />
							</div>
						</div>
					</td>
					<td>{{$members->Remarks}}</td>
					<td>{{$members->Status}}</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" id="edit_i_{{ $members->PURSH_Pid }}" class="btn btn-info btn-sm edit_i edtbtn<?php echo $m['module']->Mid; ?>" href="memberdetails/{{ $members->Memid }}/edit"/>
							</div>
						</div>
					</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" id="accept_i_{{ $members->PURSH_Pid }}" class="btn btn-info btn-sm accept_i accept_suspended_share accbtn<?php echo $members->PURSH_Pid;?>" href="acceptsuspendshares/{{ $members->PURSH_Pid }}/{{$members->PURSH_PendingAmount}}" onclickkkk="accept_suspended_share({{$members->PURSH_Pid}})" data="{{ $members->PURSH_Pid }}" />
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>



<script>
	$('.memdet_i, .edit_i').click(function(e)
	{
		step++;
		console.log(step);
		e.preventDefault();
		$(".b1_i").hide();
		$('#b2_i').load($(this).attr('href'));
	});
</script>

<script>
	function disable_row(purch_id) {
		$("#edit_i_"+purch_id).prop("disabled",true);
		$("#accept_i_"+purch_id).prop("disabled",true);
		$("#amt"+purch_id).prop("disabled",true);
	}
</script>

<script>
	$('.accept_i').click(function(e)
	{
		// var url = $(this).attr('href');
		var purch_id = $(this).attr('data');
		var amt = $("#amt"+purch_id).val();
		url = "acceptsuspendshares/"+purch_id+"/"+amt;
		// console.log("url: "+url);
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(purch_id);
				parent.html("<b>ACCEPTED</b>");
				// console.log($("#edit_"+purch_id).prop("disabled",true));
				// load_data();
			}
		});
		
	});
</script>