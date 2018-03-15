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
						<th>Amount</th>
						<th>Current Blance</th>
						<th>Total Blance</th>
						
					</tr>
					</thead>
					
					<tbody>
						@foreach ($rdsr as $rd_transaction)
						<tr>
							<td class="hidden">{{ $rd_transaction->RD_TransID }}</td>
							<td><?php $trandate=date("d-m-Y",strtotime($rd_transaction->RDReport_TranDate)); echo $trandate; ?></td>
							<td>{{ $rd_transaction->AccNum }}</td>
							<td>{{ $rd_transaction->RD_Trans_Type }}</td>
							<td>{{ $rd_transaction->RD_Particulars }}</td>
							<td>{{ $rd_transaction->RD_Amount }}</td>
							<td>{{ $rd_transaction->RD_CurrentBalance }}</td>
							<td>{{ $rd_transaction->RD_Total_Bal }}</td>
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
				<!--{!! $rdsr->render() !!}-->
				{!! $rdsr->appends(Input::except('page'))->render() !!}

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