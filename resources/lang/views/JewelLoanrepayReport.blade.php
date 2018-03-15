<div  id="toprint">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->   
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Date</th>
				<th>LOAN Number</th>
				<th>NAME</th>
				<th>Amount Paid</th>
				
				<th>Interest Amount calculated</th>
				<th>Interest Amount paid</th>
				<th>Interest Amount pending</th>
				<th>principal Amount</th>
				<th>principal Amount paid</th>
				<th>Action</th>
				
				
				
			</tr>
		</thead>
		
		<tbody>
			@foreach($loanjewel['datajewel'] as $jew)
			<tr>
				<td class="hidden">{{ $jew->JLRepay_Id }}</td>
				
				<td class=>{{ $jew->JLRepay_Date }}</td>
				<td>{{ $jew->JewelLoan_LoanNumber }}/{{ $jew->jewelloan_Oldloan_No }}</td>
				<td>{{ $jew->FirstName }}.{{ $jew->MiddleName }}.{{ $jew->LastName }}</td>
				<td>{{ $jew->JLRepay_PaidAmt }}</td>
				<td>{{ $jew->JLRepay_interestcalculated }}</td>
				<td>{{ $jew->JLRepay_interestpaid }}</td>
				<td>{{ $jew->JLRepay_interestpending }}</td>
				<td>{{ $jew->JewelLoan_LoanRemainingAmount }}</td>
				<td>{{ $jew->JLRepay_paidtoprincipalamt }}</td>
				<td>
					
					<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="jlloanrepayReceipt/{{ $jew->JLRepay_Id }}"/>
					
				</td>
				
				
				
				
				
				
				
				
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<div id='pagei'>
		
		{!!$loanjewel['datajewel']->appends(Input::except('page'))->render() !!}
		
	</div>
</div>


<script>
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes').load($(this).attr('href'));
	});
	$('.ReceiptPrint').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
</script>