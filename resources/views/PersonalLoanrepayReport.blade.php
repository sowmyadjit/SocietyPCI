<div  id="SearchRes<?php echo $loanpersonal['module']->Mid; ?>">
	<div  id="toprint<?php echo $loanpersonal['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->   
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					<th>Date</th>
					<th>LOAN Number</th>
					<th>Amount Paid</th>
					
					<th>Interest Amount calculated</th>
					<th>Interest Amount paid</th>
					<th>Interest Amount pending</th>
					<th>principal Amount</th>
					<th>principal Amount paid</th>
					<th>EMI remaining</th>
					<th>Action</th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach ($loanpersonal['datapersonal'] as $PCR)
				<tr>
					<td class="hidden">{{ $PCR->PLRepay_Id }}</td>
					
					<td><?php $trandate=date("d-m-Y",strtotime($PCR->PLRepay_Date)); echo $trandate; ?> </td>
					<td>{{ $PCR->PersLoan_Number }}</td>
					
					<td>{{ $PCR->PLRepay_PaidAmt }}</td>
					
					<td>{{ $PCR->PLRepay_CalculatedInterest }}</td>
					
					<td>{{ $PCR->PLRepay_PaidInterest }}</td>	
					<td>{{ $PCR->RemainingInterest_Amt }}</td>	
					
					<td>{{ $PCR->RemainingLoan_Amt }}</td>	
					<td>{{ $PCR->PLRepay_Amtpaidtoprincpalamt }}</td>	
					
					<td>{{ $PCR->PLRepay_EMIremaining }}</td>
					
					<td>
						
						<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $loanpersonal['module']->Mid; ?>" href="loanrepayReceipt/{{ $PCR->PLRepay_Id }}"/>
						
					</td>
					
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
		<div id='pagei<?php echo $loanpersonal['module']->Mid; ?>'>
			
			{!! $loanpersonal['datapersonal']->appends(Input::except('page'))->render() !!}
			
		</div>
	</div>
</div>


<script>
	
	$("#pagei<?php echo $loanpersonal['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $loanpersonal['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $loanpersonal['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes<?php echo $loanpersonal['module']->Mid; ?>').load($(this).attr('href'));
		});
		$('.ReceiptPrint<?php echo $loanpersonal['module']->Mid; ?>').click(function(e){
			e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
</script>