


						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
									<th>Jewel Description</th>
									<th colspan="2">Net Weight</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									@foreach ($jewelLoan as $loan_allocation)
									<tr>
										<td class="hidden">{{ $loan_allocation->JewelLoanId }}</td>
										<td class="hidden">{{ $loan_allocation->Custid }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td><a  href="customerdetails/{{ $loan_allocation->Custid }}" class="custdet">{{ $loan_allocation->JewelLoan_LoanNumber }}/{{ $loan_allocation->jewelloan_Oldloan_No }}</a></td>	
										
										<td>{{ $loan_allocation->JewelLoan_LoanAmount}}</td>
										<td>{{ $loan_allocation->JewelLoan_StartDate}}</td>
										<td>{{$loan_allocation->JewelLoan_EndDate}}</td>
										<td>{{$loan_allocation->JewelLoan_LoanRemainingAmount}}</td>
										<td>{{$loan_allocation->jewelloan_Description}}</td>
										<td id="net_wt_{{$loan_allocation->JewelLoanId}}">{{$loan_allocation->jewelloan_Net_weight}} </td>
										<td><span class="glyphicon glyphicon-pencil btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="edit_net_wt('{{$loan_allocation->jewelloan_Net_weight}}', '{{$loan_allocation->JewelLoanId}}');" ></span></td>
										<td>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="jlloanrecepit/{{ $loan_allocation->JewelLoanId }}"/>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						

<!-- model--->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Jewel Net Weight</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-sm-5">Net Weight:</label>
					<div class="col-md-7">
						<input type="text" id="net_wt" name="net_wt" class="form-control">
						<input type="text" id="jewel_alloc_id" name="jewel_alloc_id" class="form-control hidden">
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
			$('.clickme').click(function(e)
			{
				$('.pigmiallocclassid').click();
			});
			$('.crtlal').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			$('.edtbtn').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			$('.custdet').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$("ul.pagination li a").each(function() {
				
				$(this).addClass("loadmc");
				
			});
			$('.loadmc').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('#maincontents').load($(this).attr('href'));
			});		
			
			
			</script>
			
<script>
/*-------------------------------------------------*/
function edit_net_wt(net_wt, jewel_alloc_id)
{
	$('#net_wt').val(net_wt);
	$('#jewel_alloc_id').val(jewel_alloc_id);
}

$('.save').click( function(e) {
	net_wt=$('#net_wt').val();
	jewel_alloc_id=$('#jewel_alloc_id').val();
	$.ajax({
		url: 'edit_jl_net_wt',
		type: 'post',
		data:'&net_wt='+net_wt+'&jewel_alloc_id='+jewel_alloc_id,
		success: function(data) {
			//alert('success');
			$("#net_wt_"+jewel_alloc_id).html(net_wt);
		}
	});
	
	
});
</script>