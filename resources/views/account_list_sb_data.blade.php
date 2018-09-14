<style>
	.hide_it {
		opacity: 0.5;
		height: 1px;
		overflow: scroll;
	}
</style>
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>SL NO.</th>
									<th>Customer ID</th>
									<th>Name</th>
									<th>Account Type</th>
									@if($ret_data["account_type"] == 2)
										<th>Agent</th>
									@endif
									<th>Account Number</th>
									<th>Start Date</th>
									@if($ret_data["account_type"] == "RD")
										<th>Mature Date</th>
									@endif
									@if($ret_data["account_type"] == 2)
										<th>Duration</th>
									@endif
									<th>Balance Amount</th>
									<th>
										<div>
											(editable<input id="closed_editable" type="checkbox" />)
										</div>
										Close
									</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									<?php
										$total_dep_amt = 0;
									?>
									@foreach ($ret_data['account_list'] as $row)
										<?php
											$total_dep_amt += $row['balance'];
										?>
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{$row['name']}}</td>
											<td>{{$row['account_type']}}</td>
											@if($ret_data["account_type"] == 2)
												<td>{{ $row['agent_name']}}</td>
											@endif
											<td>
												<a  href="accountdetails/{{$row['account_id']}}" class="viwbtn">
													{{$row['account_no']}}/{{$row['old_account_no']}}
												</a>
											</td>
											<td>{{$row['start_date']}}</td>
											@if($ret_data["account_type"] == "RD")
												<td>{{ $row['end_date']}}</td>
											@endif
											@if($ret_data["account_type"] == 2)
												<td>{{ $row['duration']}}</td>
											@endif
											<td>{{$row['balance']}}</td>
											
											<td>
												<?php
													$selected_yes = "";
													$selected_no = "";
													
													if($row['closed'] == "YES") {
														$selected_yes = "selected";
													} else {
														$selected_no = "selected";
													}
													//{{ $row['closed']}}
												?>
												<select class="closed_edit" data="{{$row['account_id']}}">
													<option {{$selected_no}}>NO</option>
													<option {{$selected_yes}}>YES</option>
												</select>
											</td>
											<td>
												<div class="form-group">
													<div class="col-sm-12">
														<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="accountdetails/{{$row['account_id']}}/edit"/>
													</div>
												</div>
											</td>	
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_dep_amt}}</b></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
							
							<div class="hide_it to_print" >
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive ">
							<thead>
								<tr>
									<th>SL NO.</th>
									<th>Customer ID</th>
									<th>Name</th>
									<th>Account Type</th>
									<th>Account Number</th>
									<th>Start Date</th>
									@if($ret_data["account_type"] == "RD")
										<th>Mature Date</th>
									@endif
									<th>Balance Amount</th>
									<th>
										Close
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($ret_data['account_list'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{$row['name']}}</td>
											<td>{{$row['account_type']}}</td>
											<td>{{$row['account_no']}}/{{$row['old_account_no']}}</td>
											<td>{{$row['start_date']}}</td>
											@if($ret_data["account_type"] == "RD")
												<td>{{ $row['end_date']}}</td>
											@endif
											<td>{{$row['balance']}}</td>
											
											<td>{{ $row['closed']}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							</div>
							
							
							
	

<script>
	$('.viwbtn').click(function(e)
	{
		e.preventDefault();
		$("#account_details_box").hide();
		show_loading_img("#temp_box");
		$('#temp_box').load($(this).attr('href'));
		$("#back").show();
	});
</script>
<script>
	$('.edtbtn').click(function(e)
	{
		e.preventDefault();
		$("#account_details_box").hide();
		show_loading_img("#temp_box");
		$('#temp_box').load($(this).attr('href'));
		$("#back").show();
	});
</script>



<script>
	$(document).ready(function() {
		disable_closed_state_edit();
	});
	
	$("#closed_editable").change(function() {
		if($(this).prop("checked")) {
			enable_closed_state_edit();
		} else {
			disable_closed_state_edit();
		}
	});
	function enable_closed_state_edit() {
		$('.closed_edit').prop("disabled",false);
	}
	
	function disable_closed_state_edit() {
		$('.closed_edit').prop("disabled",true);
	}
	
	$(".closed_edit").change(function() {
		var account_id = $(this).attr("data");
		var closed = $(this).val();
		console.log("account_id="+account_id+"\n colsed="+closed);
		account_edit_sb_rd(account_id,closed);
	});	
	
	function account_edit_sb_rd(account_id,closed) {
		$.ajax({
			url:"account_edit_sb_rd",
			type:"post",
			data:"&account_type={{$ret_data['account_type']}}&closed="+closed+"&account_id="+account_id,
			success: function(data) {
				console.log("account_edit_sb_rd:done");
			}
		});
	}
	
	
</script>



<script>
	$(function() {
		$(".print").click(function() {
			//var divContents = $("#toprint").html();
			var divContents = $(".to_print").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});
</script>



<script>
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		
		if(type=="word")
		{
			
			$('.to_print').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('.to_print').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			//alert("Please Select Type For Export");
			$('.to_print').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
			
		}
		
	});
</script>
