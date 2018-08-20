
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>SL NO.</th>
									<th>Customer ID</th>
									<th>Name</th>
									<th style="width:50px;">Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Duration</th>
									<th>Pending Amount</th>
									<th>Close</th>
									<th>Interest Paid Till</th>
									<th>Paid Principle Amt.</th>
									@if($ret_data['loan_category'] == "JL")
										<th>Jewel Description</th>
										<th>Gross Weight</th>
										<th>Net Weight</th>
										<th>Edit</th>
										<th></th>
									@endif
								</tr>
							</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
								<?php
									$total_ln_amt = 0;
									$total_rm_amt = 0;
								?>
									@foreach ($ret_data['loan_details'] as $row)
										<?php
											$total_ln_amt += $row['loan_amount'];
											$total_rm_amt += $row['ramaining_amount'];
										?>
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{ $row['name'] }}</td>	
											<td style="width:50px;">{{ $row['loan_no'] }}/{{ $row['loan_old_no'] }}</td>
											<td>{{ $row['loan_amount']}}</td>
											<td>{{ $row['start_date']}}</td>
											<td>{{ $row['end_date']}}</td>
											<td>{{ $row['duration']}}</td>
											<td>{{ $row['ramaining_amount']}}</td>
											<td>{{ $row['closed']}}</td>
											<td>{{ $row['interest_paid_upto']}}</td>
											<td>{{ $row['paid_principle_amt']}}</td>
											@if($ret_data['loan_category'] == "JL")
												<td>{{$row['jewel_description']}}</td>
												<td>{{$row['gross_weight']}}</td>
												<td><span id="net_wt_{{$row['loan_id']}}">{{$row['net_weight']}}</span></td>
												<td>
													<span class="glyphicon glyphicon-pencil btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="edit_net_wt('{{$row['net_weight']}}', '{{$row['loan_id']}}','{{ $row['closed']}}');" >
													</span>
												</td>
							<?php /*			<td>
													<div class="form-group">
														<div class="col-sm-12">
															<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="jlloanrecepit/{{ $row['loan_id'] }}"/>
														</div>
													</div>
												</td>
							*/?>
											@endif
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_ln_amt}}</b></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_rm_amt}}</b></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
						><?php /*		<td></td> */?>
									</tr>
								</tbody>
							</table>
							
<!-- model--->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Jewel</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-sm-5">Net Weight:</label>
					<div class="col-md-7">
						<input type="text" id="net_wt" name="net_wt" class="form-control">
						<input type="text" id="jewel_alloc_id" name="jewel_alloc_id" class="form-control hidden">
					</div>
					<label class="control-label col-sm-5">Closed Status:</label>
					<div class="col-md-7">
						<?php
							if(strcasecmp($row['closed'], "YES") == 0) {
								$yes_selected = "selected";
								$no_selected = "";
							} else {
								$yes_selected = "";
								$no_selected = "selected";
							}
						?>
						<select class="form-control closed_drop" id="closed_drop" name="closed_drop">
							<option value="NO" {{$no_selected}} >NO</option>		
							<option value="YES" {{$yes_selected}} >YES</option>					
						</select>
					</div>
				</div>
				<br>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm edit btn-success save" data-dismiss="modal" >SAVE</button>
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
				
			</div>
		</div>
		
	</div>
</div>		
<!--- model close--->



<script>
function edit_net_wt(net_wt, jewel_alloc_id,closedstatus)
{
	$('#net_wt').val(net_wt);
	$('#jewel_alloc_id').val(jewel_alloc_id);
}

$('.save').click( function(e) {
	net_wt=$('#net_wt').val();
	jewel_alloc_id=$('#jewel_alloc_id').val();
	 closed_status=$('#closed_drop').val();
	 console.log(closed_status);
	
	$.ajax({
		url: 'edit_jl_net_wt',
		type: 'post',
		data:'&net_wt='+net_wt+'&jewel_alloc_id='+jewel_alloc_id+'&closed_status='+closed_status,
		success: function(data) {
			//alert('success');
			$("#net_wt_"+jewel_alloc_id).html(net_wt);
		}
	});
});
</script>



<script>
	$('.edtbtn').click(function(e)
	{
		e.preventDefault();
		$("#loan_details_box").hide();
		$('#receipt_box').load($(this).attr('href'));
	});
</script>