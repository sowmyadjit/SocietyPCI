<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Date</th>
						<th>Account Number</th>
						<th>Transaction Type</th>
						<th>Perticulars</th>
						<th>Previous Balance</th>
						<th>Amount</th>
						<th>Total Balance</th>
						
					</tr>
					</thead>
					
					<tbody>
						@foreach ($sbsr as $sb_transaction)
						<tr>
							<td class="hidden">{{ $sb_transaction->Tranid }}</td>
							<td><?php $trandate=date("d-m-Y",strtotime($sb_transaction->SBReport_TranDate)); echo $trandate; ?></td>
							<td>{{ $sb_transaction->AccNum }}</td>
							<td>{{ $sb_transaction->TransactionType }}</td>
							<td>{{ $sb_transaction->particulars }}</td>
							<td>{{ $sb_transaction->CurrentBalance }}</td>
							<td>{{ $sb_transaction->Amount }}</td>
							<td>{{ $sb_transaction->Total_Bal }}</td>
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
				<!--{!! $sbsr->render() !!}-->
				{!! $sbsr->appends(Input::except('page'))->render() !!}
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
	</script>
				