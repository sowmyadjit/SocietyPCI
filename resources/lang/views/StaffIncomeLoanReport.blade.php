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
						<th>Adjustment Charges</th>
						<th>Share Charges</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($incomestaff['datastaff'] as $staf)
						<tr>
							<td class="hidden">{{ $staf->StfLoanAllocID }}</td>
							
							
							<td>{{ $staf->StfLoan_Number }}</td>
							<td>{{ $staf->FirstName }}.{{ $staf->MiddleName }}.{{ $staf->LastName }}</td>
							<td>{{ $staf->otherCharges }}</td>
							<td>{{ $staf->Book_FormCharges }}</td>
							<td>{{ $staf->AjustmentCharges }}</td>
							<td>{{ $staf->ShareCharges }}</td>
							
							
						
						
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
			
				{!!$incomestaff['datastaff']->appends(Input::except('page'))->render() !!}

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