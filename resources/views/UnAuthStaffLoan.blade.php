

<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
		<h2> Unauthorised Staff Loans</h2>
	</div>
	
	<div class="box-content">
	<?php /*
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
	*/?>
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					<th>Date</th>
					<th>Branch Name</th>
					<th>Name</th>
					<th>Requested Loan Amount</th>
					<th>Amount Decided by Board</th>
					<th>Resolution Number</th>
					<th colspan=2><center>Actions</center></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach ($Sloan as $Staff_Loan)
				<tr>
					<td class="hidden sloanid">{{$Staff_Loan->PersLoanAllocID}}</td>
					
					<td>{{ $Staff_Loan->Request_Date }}</td>
					<td>{{ $Staff_Loan->BName }}</td>
					<td>{{ $Staff_Loan->FirstName }} {{ $Staff_Loan->MiddleName }} {{ $Staff_Loan->LastName }}</td>
					<td>{{ $Staff_Loan->Requested_LoanAmt }}</td>
					<td><input type="text" class="form-control" id="amt_by_board_{{$Staff_Loan->PersLoanAllocID}}" placeholder="ENTER AMOUNT" data="{{$Staff_Loan->PersLoanAllocID}}" /></td>
					<td><input type="text" class="form-control" id="resolution_no_{{$Staff_Loan->PersLoanAllocID}}" placeholder="Resolution Number" value="0" data="{{$Staff_Loan->PersLoanAllocID}}" /></td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" id="accept_{{$Staff_Loan->PersLoanAllocID}}" class="btn btn-success btn-sm acceptbtn" data="{{$Staff_Loan->PersLoanAllocID}}" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Reject" id="reject_{{$Staff_Loan->PersLoanAllocID}}" class="btn btn-danger btn-sm rejbtn" href="rejectSL/{{ $Staff_Loan->PersLoanAllocID }}" data="{{$Staff_Loan->PersLoanAllocID}}" />
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
/* 
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
	 */
</script>	



<script>
		function disable_row(req_id) {
			$("#amt_by_board_"+req_id).prop("disabled","true");
			$("#resolution_no_"+req_id).prop("disabled","true");
			$("#accept_"+req_id).prop("disabled","true");
			$("#reject_"+req_id).prop("disabled","true");
		}
	</script>

	<script>
		$('.acceptbtn').click(function(e) {
			e.preventDefault();
			var req_id = $(this).attr("data");
			console.log("req_id="+req_id);
			var amt_by_board = $("#amt_by_board_"+req_id).val();
			var resolution_no = $("#resolution_no_"+req_id).val();
			// console.log("amt_by_board="+amt_by_board);
			// console.log("resolution_no="+resolution_no);

			if(amt_by_board == "") {
				alert("Please Enter Amount Decided by Board");
				return;
			}
			if(resolution_no == "") {
				alert("Please Enter Resolution Number");
				return;
			}

			$.ajax({
				url:'acceptSL',
				type:'post',
				data:'&sacceptamt='+amt_by_board+'&sreslnno='+resolution_no+'&sloanal='+req_id,
				success:function(data)
				{
					disable_row(req_id);
					$("#accept_"+req_id).parent().html("<b>ACCEPTED</b>");
					// alert("Loan Accepted");
				}
			});
		});
	</script>

	<script>
		$('.rejbtn').click(function(e) {
			e.preventDefault();
			var req_id = $(this).attr("data");
			console.log("req_id="+req_id);
			var rej_url = $(this).attr("href");
			console.log(rej_url);

			$.ajax({
				url: rej_url,
				type:'get',
				data:'',
				success:function(data)
				{
					disable_row(req_id);
					$("#reject_"+req_id).parent().html("<b>REJECTED</b>");;
				}
			});
		});
	</script>