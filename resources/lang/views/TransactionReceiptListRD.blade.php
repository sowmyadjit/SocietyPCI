<div  id="toprint">
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Account Number</th>
				<th>Name</th>
				<th>Date</th>
				<th>Receipt Num</th>
				
				<th>Transaction Type</th>
				<th>Perticulars</th>
				<!--<th>Previous Balance</th>-->
				<th>Amount</th>
				<!--	<th>Total Balance</th>-->
				<th>Action</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($ReceiptData as $RSB)
			<tr>
				
				<td class="hidden">{{ $RSB->RD_TransID }}</td>
				<td>{{ $RSB->AccNum }}  /  {{ $RSB->Old_AccNo }}</td>
				<td>{{ $RSB->FirstName }}.{{ $RSB->MiddleName }}.{{ $RSB->LastName }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($RSB->RDReport_TranDate)); echo $trandate; ?> </td>
				<td>{{ $RSB->RD_resp_No }}</td>
				
				<td>{{ $RSB->RD_Trans_Type }}</td>
				<td>{{ $RSB->RD_Particulars }}</td>
				<!--<td>{{ $RSB->RD_CurrentBalance }}</td>-->
				<td>{{ $RSB->RD_Amount }}</td>
				<!--<td>{{ $RSB->RD_Total_Bal }}</td>-->
				<td>
					<div class="form-group">
						<div class="col-sm-12">
	<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="TranReceipt/RD/{{ $RSB->RD_TransID }}"/>
						</div>
					</div>	
					
				</td>
				
			</tr>
			@endforeach
			
			
		</tbody>
	</table>
	
	
	<div id='pagei'>
		{!! $ReceiptData->appends(Input::except('page'))->render() !!}
	</div>
	
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