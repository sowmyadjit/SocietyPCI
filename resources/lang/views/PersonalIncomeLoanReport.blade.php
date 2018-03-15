<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Name</th>
						<th>Other Charges</th>
						<th>Book And Form Charges</th>
						<th>Adjustment Charge</th>
						<th>Share Charge</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($incomepers['datapers'] as $pers)
						<tr>
							<td class="hidden">{{ $pers->PersLoanAllocID }}</td>
							
							
							<td>{{ $pers->PersLoan_Number }}/{{ $pers-> Old_PersLoan_Number }}</td>
							<td>{{ $pers->FirstName }}.{{ $pers->MiddleName }}.{{ $pers->LastName }}</td>
							<td>{{ $pers->otherCharges }}</td>
							<td>{{ $pers->Book_FormCharges }}</td>
							<td>{{ $pers->AjustmentCharges }}</td>
							<td>{{ $pers->ShareCharges }}</td>
							
						
						
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
			
				{!!$incomepers['datapers']->appends(Input::except('page'))->render() !!}

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