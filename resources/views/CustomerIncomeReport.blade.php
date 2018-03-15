<div  id="toprint<?php echo $incomecust['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Customer Fees</th>
						<th>Receipt Number</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($incomecust['datacustmer'] as $cust)
						<tr>
							<td class="hidden">{{ $cust->Custid }}</td>
							
							
							<td>{{ $cust->FirstName }}</td>
							<td>{{ $cust->MiddleName }}</td>
							
						
						
							<td>{{ $cust->LastName }}</td>
							<td>{{ $cust->Customer_Fee }}</td>
							<td>{{ $cust->Customer_ReceiptNum }}</td>
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei<?php echo $incomecust['module']->Mid; ?>'>
			
				{!!$incomecust['datacustmer']->appends(Input::except('page'))->render() !!}

				</div>
</div>
				
				
	<script>
	
	$("#pagei<?php echo $incomecust['module']->Mid; ?>ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc<?php echo $incomecust['module']->Mid; ?>");
  
});
$('.loadmc<?php echo $incomecust['module']->Mid; ?>').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.SearchRes<?php echo $incomecust['module']->Mid; ?>').load($(this).attr('href'));
});
	</script>