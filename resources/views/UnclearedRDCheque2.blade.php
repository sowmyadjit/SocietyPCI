
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			<th>Transaction Date</th>
			<th>Account Number</th>
			<th>Name</th>
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
		@foreach ($rdcheque['data'] as $rd_transaction)
			<tr>
				<td class="hidden rejecttransid">{{ $rd_transaction->RD_TransID }}</td>
				<td class="hidden">{{ $rd_transaction->Accid }}</td>
				<td class="hidden">{{ $rd_transaction->Uid }}</td>
				
				<td><?php $transcdte=date("d-m-Y",strtotime($rd_transaction->RD_Date));echo $transcdte;?></td>
				<td>{{$rd_transaction->AccNum}}</td>
				<td>{{ $rd_transaction->FirstName }}.{{ $rd_transaction->MiddleName }}.{{ $rd_transaction->LastName }}</td>
				
				<td>{{ $rd_transaction->RD_Trans_Type }}</td>
				<td>{{ $rd_transaction->RDCheque_Number}}</td>	
				<td>{{ $rd_transaction->RDCheque_Date}}</td>
				<td>{{$rd_transaction->RDBank_Name}}</td>
				<td>{{$rd_transaction->RDBank_Branch}}</td>
				<td>{{$rd_transaction->RDIFSC_Code}}</td>
				<td>{{$rd_transaction->RDUncleared_Bal}}</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_{{ $rd_transaction->RD_TransID }}" class="btn btn-success btn-sm accpbtn<?php echo $rdcheque['module']->Mid; ?>" href="rdclearcheque/{{ $rd_transaction->RD_TransID }}" data="{{ $rd_transaction->RD_TransID }}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_{{ $rd_transaction->RD_TransID }}" class="btn btn-danger btn-sm rejbtn<?php echo $rdcheque['module']->Mid; ?>"  data="{{ $rd_transaction->RD_TransID }}" data-toggle="modal" data-target="#popup" />
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
	$('.accpbtn<?php echo $rdcheque['module']->Mid; ?>').click(function(e)
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
		$(".rejbtn<?php echo $rdcheque['module']->Mid; ?>").click(function() {
			console.log($(this).attr("data"));
			var tran_id = $(this).attr("data");
	
			var popup_title = "Cheque Reject";
			var popup_submit_data = "rd_reject";
			var popup_data =
				 `
					 <div  style="display:inline-block;">
						<label class="control-label col-sm-6">Cheque Reject Amount:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="rdchqrjct" name="rdchqrjct" placeholder="CHEQUE REJECT AMOUNT">
						</div>
					</div>
					<input id="id" class="hide" value="`+tran_id+`">
					
				`;
			$(".popup_title").html(popup_title);
			$(".popup_data").html(popup_data);
			$(".popup_submit").attr("data",popup_submit_data);
		});
</script>