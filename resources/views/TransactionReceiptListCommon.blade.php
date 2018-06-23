<div  id="toprint">
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Account Number</th>
				<th>Name</th>
				<th>Date</th>
				<th>Receipt/Voucher Num</th>
				<th>Transaction Type</th>
				<th>Perticulars</th>
				<!--<th>Previous Balance</th>-->
				<th>Amount</th>
				<!--	<th>Total Balance</th>-->
				<th>Action</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($data as $RSB)
			<tr>
				
				<td class="hidden">{{ $RSB->tran_id }}</td>
				<td>{{ $RSB->acc_no }}  /  {{ $RSB->old_acc_no }}</td>
				<td>{{ $RSB->name }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($RSB->date)); echo $trandate; ?> </td>
				<td>
			@if($RSB->transaction_type=="CREDIT")
			
			
			<?php $temp=$RSB->receipt_voucher_no; echo $temp; ?>
			
			
			@elseif($RSB->transaction_type=="DEBIT")
			
				<?php $temp=$RSB->receipt_voucher_no; echo $temp; ?>
				
			
			@endif
				</td>
				
				<td>{{ $RSB->transaction_type }}</td>
				<td>{{ $RSB->particulars }}</td>			
				<td>{{ $RSB->amount }}</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<?php /*		<input type="button"  data="{{$RSB->tran_id}}" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="TranReceipt/SB/{{ $RSB->tran_id }}"/> */?>
							<input type="button"  data="{{$RSB->tran_id}}"class="btn btn-info btn-sm rv_print_btn" value="RECEIPT" />
						</div>
					</div>	
					
				</td>
				
			</tr>
			@endforeach
			
			
		</tbody>
	</table>
	
	
</div>

<script>
	$('.ReceiptPrint').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#toprint').load($(this).attr('href'));
	});
	
	var $searchvalue;
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes').load($(this).attr('href'));
	});
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
</script>


<script>

	$('.rv_print_btn').click(function(e){
		var tran_category=$('#ReceiptTypeDD').val();
		console.log(tran_category);
		var tran_id = $(this).attr("data");
			$.ajax({
				url:'rv_print',
				type:'post',
				data:'&tran_category='+tran_category+"&tran_id="+tran_id,
				success:function(data)
				{
					$("#toprint").html(data);
				}
			});
		
	});
</script>
	