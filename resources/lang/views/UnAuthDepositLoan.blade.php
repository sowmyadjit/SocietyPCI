

<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
		<h2> Unauthorised Deposit Loans</h2>
		
		
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
					<th>Account Number</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Requested Loan Amount</th>
					<th colspan=2><center>Actions</center></th>
				</tr>
			</thead>
			
			<tbody>
				
				@foreach ($Dloan as $Deposit_Loan)
				<tr>
					<td class="hidden dloanid">{{$Deposit_Loan->PersLoanAllocID}}</td>
					
					<td>{{ $Deposit_Loan->Request_Date }}</td>
					<td>{{ $Deposit_Loan->BName }}</td>
					<td>{{ $Deposit_Loan->DepLoan_AccNo }}</td>
					<td>{{ $Deposit_Loan->FirstName }}</td>
					<td>{{ $Deposit_Loan->MiddleName }}</td>
					<td>{{ $Deposit_Loan->LastName }}</td>
					<td>{{ $Deposit_Loan->Requested_LoanAmt }}</td>
					
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
								<input type="button" value="Reject" class="btn btn-danger btn-sm rejbtn" href="rejectDL/{{ $Deposit_Loan->PersLoanAllocID }}"/>
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
	
	$('.acceptbtn').click(function(e){
		
		//$('.detail').show();     
		damt=$('#AcceptAmt').val();
		drno=$('#AcceptResoNo').val();
		dloanal=$('.dloanid').html();
		e.preventDefault();
		if(damt==""||drno=="")
		{
			alert("Please Enter amount and Resolution Number");
		}
		else
		{
			$.ajax({
				url:'acceptDL',
				type:'post',
				data:'&dacceptamt='+damt+'&dreslnno='+drno+'&dloanal='+dloanal,
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