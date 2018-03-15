

<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
		<h2> Unauthorised Jewel Loans</h2>
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
					<th>Jewel Description</th>
					<th>Gold Rate</th>
					<th>Loan Duration</th>
					<th>Requested Loan Amount</th>
					<th colspan=2><center>Actions</center></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach ($Jloan as $Jewel_Loan)
				<tr>
					<td class="hidden jloanid">{{$Jewel_Loan->PersLoanAllocID}}</td>
					
					<td>{{ $Jewel_Loan->Request_Date }}</td>
					<td>{{ $Jewel_Loan->BName }}</td>
					<td>{{ $Jewel_Loan->FirstName }}</td>
					<td>{{ $Jewel_Loan->MiddleName }}</td>
					<td>{{ $Jewel_Loan->LastName }}</td>
					<td>{{ $Jewel_Loan->Jewel_Description }}</td>
					<td>{{ $Jewel_Loan->Gold_Rate }}</td>
					<td>{{ $Jewel_Loan->JewelLoan_Duration }}</td>
					<td>{{ $Jewel_Loan->Requested_LoanAmt }}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" class="btn btn-success btn-sm acceptbtn" onclick="s({{$Jewel_Loan->PersLoanAllocID}});"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Reject" class="btn btn-danger btn-sm rejbtn" href="rejectSL/{{ $Jewel_Loan->PersLoanAllocID }}"/>
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
	var a=0;
	function s(a1)
	{
		//
		a=a1;
	}
	$('.acceptbtn').click(function(e)
	{
		jamt=$('#AcceptAmt').val();
		jrno=$('#AcceptResoNo').val();
		jloanal=a;
		//alert(a);
		e.preventDefault();
		if(jamt==""||jrno=="")
		{
			alert("Please Enter amount and Resolution Number");
		}
		else
		{
			$.ajax({
				url:'acceptJL',
				type:'post',
				data:'&jacceptamt='+jamt+'&jreslnno='+jrno+'&jloanal='+jloanal,
				success:function(data)
				{
					alert("Loan Accepted");
					$('.custauhclassid').click();
				}
			});
		}
		
	});
	$('.box-inner').load($(this).attr('href'));
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