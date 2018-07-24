
			
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			<th>Allocation Date</th>
<?php /*	<th>Account Number</th> */?>
			<th>Full Name</th>
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
		@foreach ($kcccheque['data'] as $kccallocation)
			<tr>
				<td class="hidden rejecttransid">{{ $kccallocation->Fdid }}</td>
				<td class="hidden">{{ $kccallocation->Accid }}</td>
				<td class="hidden">{{ $kccallocation->Uid }}</td>
				
				<td><?php $transcdte=date("d-m-Y",strtotime($kccallocation->FD_StartDate));echo $transcdte;?></td>
	<?php /*	<td>{{$kccallocation->AccNum}}</td> */?>
				<td>{{ $kccallocation->FirstName }}.{{ $kccallocation->MiddleName }}.{{ $kccallocation->LastName }}</td>
				<td>{{ $kccallocation->FDChq_No}}</td>	
				<td>{{ $kccallocation->FDChq_Date}}</td>
				<td>{{$kccallocation->FDBnk_Name}}</td>
				<td>{{$kccallocation->FDBnk_Branch}}</td>
				<td>{{$kccallocation->FDIFSC_Code}}</td>
				<td>{{$kccallocation->FDUnclear_Bal}}</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" id="accept_{{ $kccallocation->Fdid }}" class="btn btn-success btn-sm accpbtn<?php echo $kcccheque['module']->Mid; ?>" href="fdclearcheque/{{ $kccallocation->Fdid }}" data="{{ $kccallocation->Fdid }}" />
							
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="REJECT" id="reject_{{ $kccallocation->Fdid }}" class="btn btn-danger btn-sm rejbtn<?php echo $kcccheque['module']->Mid; ?>" data="{{ $kccallocation->Fdid }}" data-toggle="modal" data-target="#popup" />
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
	$('.accpbtn<?php echo $kcccheque['module']->Mid; ?>').click(function(e)
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
		$(".rejbtn<?php echo $kcccheque['module']->Mid; ?>").click(function() {
			console.log($(this).attr("data"));
			var tran_id = $(this).attr("data");
	
			var popup_title = "Cheque Reject";
			var popup_submit_data = "fd_reject";
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

