
<?php /*
			<div class="chequereject">
				<div>
					<label class="control-label col-sm-2">Cheque Reject Amount:</label>
					<div class="col-md-2">
						<input type="text" class="form-control" id="chqrjct" name="chqrjct" placeholder="CHEQUE REJECT AMOUNT">
					</div>
				</div>
				<div>
					<label class="control-label col-sm-2">Cheque Reject Amount IN Bank:</label>
					<div class="col-md-2">
						<input type="text" class="form-control" id="chqrjctbank" name="chqrjctbank" placeholder="CHEQUE REJECT AMOUNT bank">
					</div>
				</div>
			</div>

			<div class="chequeaccept">
				<label class="control-label col-sm-4">Cheque Accept Amount:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="chaccept" name="chaccept" placeholder="CHEQUE  CHAREGES">
				</div>
			</div>
*/?>
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
							<!--<th>IFSC Code</th>-->
							<th>Amount</th>
							<th colspan=2><center>Action</center></th>
							
						</tr>
					</thead>
					<tbody>
						
						<tr>
							@foreach ($cheque['data'] as $sb_transaction)
							<tr>
								<td class="hidden rejecttransid">{{ $sb_transaction->Tranid }}</td>
								<td class="hidden">{{ $sb_transaction->Accid }}</td>
								<td class="hidden">{{ $sb_transaction->Uid }}</td>
								
								<td><?php $transcdte=date("d-m-Y",strtotime($sb_transaction->tran_Date));echo $transcdte;?></td>
								<td>{{$sb_transaction->AccNum}}</td>
								<td>{{ $sb_transaction->FirstName }}.{{ $sb_transaction->MiddleName }}.{{ $sb_transaction->LastName }}</td>
								<td>{{ $sb_transaction->TransactionType }}</td>
								<td>{{ $sb_transaction->Cheque_Number}}</td>	
								<td>{{ $sb_transaction->Cheque_Date}}</td>
								<td>{{$sb_transaction->Bank_Name}}</td>
								<td>{{$sb_transaction->Bank_Branch}}</td>
								<!--<td>{{$sb_transaction->IFSC_Code}}</td>-->
								<td>{{$sb_transaction->Uncleared_Bal}}</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="ACCEPT" id="accept_{{ $sb_transaction->Tranid }}" class="btn btn-success btn-sm accept accpbtn<?php echo $cheque['module']->Mid; ?>"onclickkkk="acceptcheqe({{ $sb_transaction->Tranid }});" data="{{ $sb_transaction->Tranid }}" data-toggle="modal" data-target="#popup" />
											
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										
										<div class="col-sm-12">
											<input type="button" value="REJECT" id="reject_{{ $sb_transaction->Tranid }}" class="btn btn-danger btn-sm reject  rejbtn<?php echo $cheque['module']->Mid; ?>"onclickkkk="rejectcheqe({{ $sb_transaction->Tranid }});"  data="{{ $sb_transaction->Tranid }}" data-toggle="modal" data-target="#popup" /> 
										</div>
									</div>
								</td>
								
							</tr>
							@endforeach
							
						</tbody>
					</table>
				
				
				
				
				<script>
					/* 
					$('.chequereject').hide();
					$('.chequeaccept').hide();
					
					/*$('.crtds').click(function(e)
						{
						e.preventDefault();
						$('.box-inner').load($(this).attr('href'));
					});* /
					$('.accpbtn<?php echo $cheque['module']->Mid; ?>').click(function(e){
						e.preventDefault();
						//$('.box-inner').load($(this).attr('href'));
						$('.bdy_<?php echo $cheque['module']->Mid; ?>').load($(this).attr('href'));
						//$('.clearclassid').click();
					});
					
					
					function rejectcheqe(s)
					{
						
						$('.chequereject').show();
						m=$('#chqrjct').val();
						bankamt=$('#chqrjctbank').val();
						a=s;
						//alert(a);
						if(m==""||bankamt=="")
						{
							alert("Please Enter the Cheque Reject Amount");
						}
						else
						{
							$.ajax({
								url:'rejectcheque',
								type:'post',
								data:'&cheqchrge='+m+'&tid='+a+'&bankamt='+bankamt,
								success:function()
								{
									$('.clearclassid').click();
								}
							});
							/*$('.box-inner').load($(this).attr('href'));* /
							
						}
					}
					function acceptcheqe(a)
					{
						
						$('.chequereject').hide();
						$('.chequeaccept').show();
						
						m=$('#chaccept').val();
						//a=$('.rejecttransid').html();
						alert(a);
						if(m=="")
						{
							alert("Please Enter the Cheque Charge");
						}
						else
						{
							$.ajax({
								url:'clearcheque',
								type:'post',
								data:'&cheqchrge='+m+'&tid='+a,
								success:function()
								{
									$('.tranclassid').click();
								}
							});
							/*$('.box-inner').load($(this).attr('href'));* 
							
						}
					}
					 */
				</script>

				
<script>
		function disable_row(id) {
			$("#accept_"+id).prop("disabled",true);
			$("#reject_"+id).prop("disabled",true);
		}
</script>

<script>
	$(".accept").click(function() {
		// console.log($(this).attr("data"));
		var tran_id = $(this).attr("data");

		var popup_title = "Accept Amount";
		var popup_submit_data = "sb_accept";
		var popup_data =
				`
				<div style="display:inline-block;">
					<label class="control-label col-sm-6">Cheque Accept Amount:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="chaccept" name="chaccept" placeholder="CHEQUE  CHAREGES">
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
	$(".reject").click(function() {
		console.log($(this).attr("data"));
		var tran_id = $(this).attr("data");

		var popup_title = "Cheque Reject";
		var popup_submit_data = "sb_reject";
		var popup_data =
			 `
				 <div  style="display:inline-block;">
					<label class="control-label col-sm-6">Cheque Reject Amount:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="chqrjct" name="chqrjct" placeholder="CHEQUE REJECT AMOUNT">
					</div>
				</div>
				<div  style="display:inline-block;">
					<label class="control-label col-sm-6">Cheque Reject Amount IN Bank:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="chqrjctbank" name="chqrjctbank" placeholder="CHEQUE REJECT AMOUNT bank">
					</div>
				</div>
				<input id="id" class="hide" value="`+tran_id+`">
				
			`;
		$(".popup_title").html(popup_title);
		$(".popup_data").html(popup_data);
		$(".popup_submit").attr("data",popup_submit_data);
	});
</script>