

<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
		<h2> Unauthorised Staff Loans</h2>
	</div>
	
	<div class="box-content">
		<div class="row table-row detail">
			<div class="form-group col-md-6">
				<label class="control-label col-sm-4">Amount Decided by Board:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="AcceptAmt" name="AcceptAmt" placeholder="ENTER AMOUNT" Required>
				</div>
			</div>
			
			<div class="form-group col-md-6">
				<label class="control-label col-sm-4">Resolution Number:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="AcceptResoNo" name="AcceptResoNo" placeholder="RESOLUTION NUMBER" Required>
				</div>
			</div>
		</div>
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					<th>Date</th>
					<th>Branch Name</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Requested Loan Amount</th>
					<th colspan=2><center>Actions</center></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach ($Sloan as $Staff_Loan)
				<tr>
					<td class="hidden sloanid">{{$Staff_Loan->PersLoanAllocID}}</td>
					
					<td>{{ $Staff_Loan->Request_Date }}</td>
					<td>{{ $Staff_Loan->BName }}</td>
					<td>{{ $Staff_Loan->FirstName }}</td>
					<td>{{ $Staff_Loan->MiddleName }}</td>
					<td>{{ $Staff_Loan->LastName }}</td>
					<td>{{ $Staff_Loan->Requested_LoanAmt }}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" class="btn btn-success btn-sm acceptbtn"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Reject" class="btn btn-danger btn-sm rejbtn" href="rejectSL/{{ $Staff_Loan->PersLoanAllocID }}"/>
							</div>
						</div>
					</td>
					
				</tr>
				
				@endforeach
			</tbody>
			
		</table>
		
		<center>
			<div class="form-group">
				<div class="col-sm-12">
					<input type="button" value="Back" class="btn btn-info btn-sm backbtn" />
				</div>
			</div>
		</center></br>
	</div>	
</div>

<script>
	$('.acceptbtn').click(function(e)
	{
		samt=$('#AcceptAmt').val();
		srno=$('#AcceptResoNo').val();
		sloanal=$('.sloanid').html();
		e.preventDefault();
		if(samt==""||srno=="")
		{
			alert("Please Enter amount and Resolution Number");
		}
		else
		{
			$.ajax({
				url:'acceptSL',
				type:'post',
				data:'&sacceptamt='+samt+'&sreslnno='+srno+'&sloanal='+sloanal,
				success:function(data)
				{
					alert("Loan Accepted");
					$('.custauhclassid').click();
				}
			});
		}
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.backbtn').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn').click(function(e){
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
		alert("Loan Rejected");
		$('.custauhclassid').click();
	});
</script>	