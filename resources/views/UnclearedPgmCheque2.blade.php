
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			<th>Transaction Date</th>
			<th>Account Number</th>
			<th>Full Name</th>
			<th>Transaction Type</th>
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
		@foreach ($pgmcheque['data'] as $pigmi_transaction)
			<tr>
				<td class="hidden rejecttransid">{{ $pigmi_transaction->PigmiTrans_ID }}</td>
				<td class="hidden">{{ $pigmi_transaction->PigmiAllocID }}</td>
				<td class="hidden">{{ $pigmi_transaction->Uid }}</td>
				
				<td><?php $transcdte=date("d-m-Y",strtotime($pigmi_transaction->Trans_Date));echo $transcdte;?></td>
				<td>{{$pigmi_transaction->PigmiAcc_No}}</td>
				<td>{{ $pigmi_transaction->FirstName }}.{{ $pigmi_transaction->MiddleName }}.{{ $pigmi_transaction->LastName }}</td>
				<td>{{ $pigmi_transaction->Transaction_Type }}</td>
				<td>{{ $pigmi_transaction->PgmCheque_Number}}</td>	
				<td>{{ $pigmi_transaction->PgmCheque_Date}}</td>
				<td>{{$pigmi_transaction->PgmBank_Name}}</td>
				<td>{{$pigmi_transaction->PgmBank_Branch}}</td>
				<td>{{$pigmi_transaction->PgmIFSC_Code}}</td>
				<td>{{$pigmi_transaction->PgmUncleared_Bal}}</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_{{ $pigmi_transaction->PigmiTrans_ID }}" class="btn btn-success btn-sm accpbtn<?php echo $pgmcheque['module']->Mid; ?>" href="pgmclearcheque/{{ $pigmi_transaction->PigmiTrans_ID }}" data="{{ $pigmi_transaction->PigmiTrans_ID }}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_{{ $pigmi_transaction->PigmiTrans_ID }}" class="btn btn-danger btn-sm rejbtn<?php echo $pgmcheque['module']->Mid; ?>" data="{{ $pigmi_transaction->PigmiTrans_ID }}" data-toggle="modal" data-target="#popup" />
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
	




<script>
		function disable_row(id) {
			$("#accept_"+id).prop("disabled",true);
			$("#reject_"+id).prop("disabled",true);
		}
</script>

<script>
	$('.accpbtn<?php echo $pgmcheque['module']->Mid; ?>').click(function(e)
	{
		var url = $(this).attr('href');
		var id = $(this).attr('data');
		var parent = $(this).parent();

		$.ajax({
			url: url,
			type: 'get',
			data: "",
			success: function(data) {
				disable_row(id);
				parent.html("<b>ACCEPTED</b>");
			}
		});
		
	});
</script>


<script>
		$(".rejbtn<?php echo $pgmcheque['module']->Mid; ?>").click(function() {
			console.log($(this).attr("data"));
			var tran_id = $(this).attr("data");
	
			var popup_title = "Cheque Reject";
			var popup_submit_data = "pg_reject";
			var popup_data =
				 `
					<div  style="display:inline-block;">
						<label class="control-label col-sm-6">Cheque Reject Amount:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="pgmchqrjct" name="pgmchqrjct" placeholder="CHEQUE REJECT AMOUNT">
						</div>
					</div>
					<input id="id" class="hide" value="`+tran_id+`">
					
				`;
			$(".popup_title").html(popup_title);
			$(".popup_data").html(popup_data);
			$(".popup_submit").attr("data",popup_submit_data);
		});
</script>

