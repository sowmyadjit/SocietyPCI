<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Name</th>
						<th> Account Number</th>
						<th>Transaction Date</th>
						<th>Credited Amount</th>
						<th>Total Balance</th>
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($alldetails as $PigmyBWD)
								<tr>
									<td class="hidden">{{ $PigmyBWD->PigmiTrans_ID }}</td>
								
								<td>{{ $PigmyBWD->FirstName }}.{{ $PigmyBWD->MiddleName }}.{{ $PigmyBWD->LastName }}</td>
								<td>{{ $PigmyBWD->old_pigmiaccno }}/{{ $PigmyBWD->PigmiAcc_No }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($PigmyBWD->PigReport_TranDate)); echo $trandate; ?></td>
								
								
								<td>{{ $PigmyBWD->Amount }}</td>	
								<td>{{ $PigmyBWD->Total_Amount }}</td>
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
				
				
		
		{!! $alldetails->appends(Input::except('pagei'))->render() !!}
		
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
	$('.SearchRes').load($(this).attr('href'));// append the required param after href with + ,before that store those params in a global variable inside other div which is comman
});
	</script>
