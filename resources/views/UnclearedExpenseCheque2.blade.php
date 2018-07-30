
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			<th>Expense Date</th>
			<th>Branch Name</th>
			<th>Bank Name</th>
			<th>Account Number</th>
			<th>Bank Branch</th>
			<th>IFSC Code</th>
			<th>Cheque Number</th>
			<th>Cheque Date</th>
			<th>Amount</th>
			<th colspan=2><center>Action</center></th>
		</tr>
	</thead>
	<tbody>
		@foreach($exp['data'] as $expense)
			<tr>
				<td class="hidden rejecttransid">{{ $expense->id }}</td>
				<td class="hidden">{{ $expense->Bankid }}</td>
				
				<td><?php $transcdte=date("d-m-Y",strtotime($expense->e_date));echo $transcdte;?></td>
				<td>{{$expense->SocietyBranch}}</td>
				<td>{{ $expense->BankName }}</td>
				<td>{{ $expense->AccountNo }}</td>
				<td>{{ $expense->Branch }}</td>
				<td>{{ $expense->AddBank_IFSC}}</td>	
				<td>{{ $expense->cheque_no}}</td>
				<td>{{$expense->cheque_date}}</td>
				<td>{{$expense->amount}}</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_{{ $expense->id }}" class="btn btn-success btn-sm accpbtn<?php echo $exp['module']->Mid; ?>" href="expclearcheque/{{ $expense->id }}" data="{{ $expense->id }}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_{{ $expense->id }}" class="btn btn-danger btn-sm rejbtn<?php echo $exp['module']->Mid; ?>" data="{{ $expense->id }}" data-toggle="modal" data-target="#popup"  />
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
$('.accpbtn<?php echo $exp['module']->Mid; ?>').click(function(e)
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
	$(".rejbtn<?php echo $exp['module']->Mid; ?>").click(function() {
		console.log($(this).attr("data"));
		var tran_id = $(this).attr("data");

		var popup_title = "Cheque Reject";
		var popup_submit_data = "ex_reject";
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

