
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>SL NO.</th>
									<th>Customer ID</th>
									<th>Name</th>
									<th style="width:50px;">Loan Number</th>
									<th>Loan Amount</th>
									<th>Pending Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>EMI</th>
									<th>CD</th>
									<th>CD</th>
									<th>Last Paid Date</th>
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
											<td><a id="user_name_{{$row['loan_id']}}" class="user_name" href="" data="{{$row['loan_id']}}">{{ $row['name'] }}</a></td>
											<td style="width:50px;">{{ $row['loan_no'] }}/{{ $row['loan_old_no'] }}</td>
											<td>{{ $row['loan_amount']}}</td>
											<td>{{ $row['ramaining_amount']}}</td>
											<td>{{ $row['start_date']}}</td>
											<td>{{ $row['end_date']}}</td>
											<td>{{ $row['emi']}}</td>
											<td>{{ $row['cd']}}</td>
											<td>{{ $row['cd']}}</td>
											<td>{{ $row['last_paid_date']}}</td>
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_ln_amt}}</b></td>
										<td><b>{{$total_rm_amt}}</b></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
							

<script>
	$(".user_name").click(function(e) {
		e.preventDefault();
		var loan_id = $(this).attr("data");

		$.ajax({
			url:"view_loan_data",
			type:"post",
			data:"&category=SL"+"&loan_id="+loan_id,
			success: function(data) {
				console.log("done");
				$("#loan_details_box").hide();
				show_loading_img("#page_2");
				$('#page_2').html(data);
			}
		});

	});
</script>
							

