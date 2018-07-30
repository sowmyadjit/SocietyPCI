
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			
			<th>Account Number</th>
			<th>Name</th>
			<th>Cheque Number</th>
			<th>Cheque Date</th>
			<th>Bank Name</th>
			<th>Bank Branch</th>
			<th>IFSC Code</th>
			<th>Amount</th>
			<th colspan=2><center>Action</center></th>
		</tr>
	</thead>
	<tbody>
		<?php /********** DL ********/?>
		@foreach ($loancheque['dl'] as $loan_transaction)
			<tr>
				<td class="hidden">{{$loan_transaction->DLRepay_ID}}</td>
				<td>{{$loan_transaction->DepLoan_LoanNum}}/{{$loan_transaction->Old_loan_number}}</td>
				<td>{{ $loan_transaction->FirstName }}
					{{ $loan_transaction->MiddleName }}
				{{ $loan_transaction->LastName }}</td>
				
				<td>{{ $loan_transaction->Dl_Cheque_No}}</td>	
				<td>{{ $loan_transaction->Dl_Cheque_Date}}</td>
				<td>{{$loan_transaction->Dl_BankName}}</td>
				<td>{{$loan_transaction->Dl_BankBranch}}</td>
				<td>{{$loan_transaction->Dl_IFSC}}</td>
				<td>{{$loan_transaction->DLRepay_PaidAmt}}</td>
				
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_dl_{{$loan_transaction->DLRepay_ID}}" class="btn btn-success btn-sm accept_dl accpbtn<?php echo $loancheque['module']->Mid; ?>"href="AcceptCheque/{{$loan_transaction->DLRepay_ID}}/{{$loan_transaction->DepLoan_LoanNum}}/dl" data="{{$loan_transaction->DLRepay_ID}}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_dl_{{$loan_transaction->DLRepay_ID}}" class="btn btn-danger btn-sm reject_dl rejbtn<?php echo $loancheque['module']->Mid; ?>"href="rejectDLCheque/{{$loan_transaction->DLRepay_ID}}/dl" data="{{$loan_transaction->DLRepay_ID}}" data-toggle="modal" data-target="#popup" />
						</div>
					</div>
				</td>
			</tr>
		@endforeach
		
		<?php /********** PL ********/?>
		@foreach ($loancheque['pl'] as $loan_transaction)
			<tr>
				<td class="hidden">{{$loan_transaction->PLRepay_Id}}</td>
				<td>{{$loan_transaction->PersLoan_Number}}/{{$loan_transaction->Old_PersLoan_Number}}</td>
				<td>{{ $loan_transaction->FirstName }}
					{{ $loan_transaction->MiddleName }}
				{{ $loan_transaction->LastName }}</td>
				<td>{{ $loan_transaction->PL_ChequeNO}}</td>	
				<td>{{ $loan_transaction->PL_ChequeDate}}</td>
				<td>{{$loan_transaction->PL_BankName}}</td>
				<td>{{$loan_transaction->PL_BankBranch}}</td>
				<td>{{$loan_transaction->PL_IFSC}}</td>
				
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_pl_{{$loan_transaction->PLRepay_Id}}" class="btn btn-success btn-sm accept_pl accpbtn<?php echo $loancheque['module']->Mid; ?>" href="AcceptCheque/{{$loan_transaction->PLRepay_Id}}/{{$loan_transaction->PersLoan_Number}}/pl" data="{{$loan_transaction->PLRepay_Id}}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_pl_{{$loan_transaction->PLRepay_Id}}" class="btn btn-danger btn-sm reject_pl rejbtn<?php echo $loancheque['module']->Mid; ?>"href="rejectDLCheque/{{$loan_transaction->PLRepay_Id}}/pl" data="{{$loan_transaction->PLRepay_Id}}" data-toggle="modal" data-target="#popup" />
						</div>
					</div>
				</td>
			</tr>
		@endforeach
			
		<?php /********** JL ********/?>
		@foreach ($loancheque['jl'] as $loan_transaction)
			<tr>
				<td class="hidden">{{$loan_transaction->JLRepay_Id}}</td>
				<td>{{$loan_transaction->JewelLoan_LoanNumber}}/{{$loan_transaction->jewelloan_Oldloan_No}}</td>
				<td>{{ $loan_transaction->FirstName }}
					{{ $loan_transaction->MiddleName }}
				{{ $loan_transaction->LastName }}</td>
				
				<td>{{ $loan_transaction->JL_ChequeNo}}</td>	
				<td>{{ $loan_transaction->JL_ChequeDate}}</td>
				<td>{{$loan_transaction->JL_BankName}}</td>
				<td>{{$loan_transaction->JL_BankBranch}}</td>
				<td>{{$loan_transaction->JL_IFSC}}</td>
				
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_jl_{{$loan_transaction->JLRepay_Id}}" class="btn btn-success btn-sm accept_jl accpbtn<?php echo $loancheque['module']->Mid; ?>" href="AcceptCheque/{{$loan_transaction->JLRepay_Id}}/{{$loan_transaction->JewelLoan_LoanNumber}}/jl" data="{{$loan_transaction->JLRepay_Id}}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_jl_{{$loan_transaction->JLRepay_Id}}" class="btn btn-danger btn-sm reject_jl rejbtn<?php echo $loancheque['module']->Mid; ?>"href="rejectDLCheque/{{$loan_transaction->JLRepay_Id}}/jl" data="{{$loan_transaction->JLRepay_Id}}" data-toggle="modal" data-target="#popup" />
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
																			


<script>
		function disable_row_dl(id) {
			$("#accept_dl_"+id).prop("disabled",true);
			$("#reject_dl_"+id).prop("disabled",true);
		}
</script>
<script>
		function disable_row_pl(id) {
			$("#accept_pl_"+id).prop("disabled",true);
			$("#reject_pl_"+id).prop("disabled",true);
		}
</script>
<script>
		function disable_row_jl(id) {
			$("#accept_jl_"+id).prop("disabled",true);
			$("#reject_jl_"+id).prop("disabled",true);
		}
</script>

<script>
	$('.accept_dl').click(function(e)
	{
		var url = $(this).attr('href');
		var id = $(this).attr('data');
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row_dl(id);
				parent.html("<b>ACCEPTED</b>");
			}
		});
		
	});
</script>
<script>
	$('.accept_pl').click(function(e)
	{
		var url = $(this).attr('href');
		var id = $(this).attr('data');
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row_pl(id);
				parent.html("<b>ACCEPTED</b>");
			}
		});
		
	});
</script>
<script>
	$('.accept_jl').click(function(e)
	{
		var url = $(this).attr('href');
		var id = $(this).attr('data');
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row_jl(id);
				parent.html("<b>ACCEPTED</b>");
			}
		});
		
	});
</script>


<script>
		$(".reject_dl").click(function(e) {
			e.preventDefault();
			console.log($(this).attr("data"));
			var tran_id = $(this).attr("data");
	
			var popup_title = "Cheque Reject";
			var popup_submit_data = "ln_dl_reject";
			var popup_data =
				 `
					<div  style="display:inline-block;">
						<label class="control-label col-sm-6">Cheque Reject Amount:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="loanchqrjct" name="loanchqrjct" placeholder="CHEQUE REJECT AMOUNT">
						</div>
					</div>
					<input id="id" class="hide" value="`+tran_id+`">
					
				`;
			$(".popup_title").html(popup_title);
			$(".popup_data").html(popup_data);
			$(".popup_submit").attr("data",popup_submit_data);
		});
</script>
<script>
		$(".reject_pl").click(function(e) {
			e.preventDefault();
			console.log($(this).attr("data"));
			var tran_id = $(this).attr("data");
	
			var popup_title = "Cheque Reject";
			var popup_submit_data = "ln_pl_reject";
			var popup_data =
				 `
					<div  style="display:inline-block;">
						<label class="control-label col-sm-6">Cheque Reject Amount:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="loanchqrjct" name="loanchqrjct" placeholder="CHEQUE REJECT AMOUNT">
						</div>
					</div>
					<input id="id" class="hide" value="`+tran_id+`">
					
				`;
			$(".popup_title").html(popup_title);
			$(".popup_data").html(popup_data);
			$(".popup_submit").attr("data",popup_submit_data);
		});
</script>
<script>
		$(".reject_jl").click(function(e) {
			e.preventDefault();
			console.log($(this).attr("data"));
			var tran_id = $(this).attr("data");
	
			var popup_title = "Cheque Reject";
			var popup_submit_data = "ln_jl_reject";
			var popup_data =
				 `
					<div  style="display:inline-block;">
						<label class="control-label col-sm-6">Cheque Reject Amount:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="loanchqrjct" name="loanchqrjct" placeholder="CHEQUE REJECT AMOUNT">
						</div>
					</div>
					<input id="id" class="hide" value="`+tran_id+`">
					
				`;
			$(".popup_title").html(popup_title);
			$(".popup_data").html(popup_data);
			$(".popup_submit").attr("data",popup_submit_data);
		});
</script>
