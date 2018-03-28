<div>
	<h2> Jewel Loan Details</h2>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
	<tr>
	<th>
	Loan Id
	</th>
	<th>
	Loan No
	</th>
	<th>
	View Report
	</th>
	</tr>
	</thead>
	<tbody>
	@foreach ($return_data as $data)
	<tr>
	<td>
	{{$data->JewelLoanId}}
	</td>
	<td>
	{{$data->JewelLoan_LoanNumber}}
	</td>
	<td>
	<button class="btn btn-info btn-sm view" id='view' data='{{$data->JewelLoanId}}'>View Report</button>
	</td>
	</tr>
	@endforeach
	</tbody>
	</table>
</div>
<div id='loan_individual_details'>
</div>
<script>
	$('.view').click(function(){
	loan_id=$(this).attr('data');
		alert($loan_id);
				$.ajax({
					url:'/jewel_loan_repay_report_data',
					type:'post',
					data:'&loan_allocation_id='+loan_id+'&loan_type=JL',
					success:function(data)
					{
						$('#loan_individual_details').html(data);
					}
	});
	});
</script>