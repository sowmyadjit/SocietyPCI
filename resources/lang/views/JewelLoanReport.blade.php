<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Name</th>
						<th>Appraisal Value</th>
						<th>Duration</th>
						<th>Amount</th>
						<th>GROSS WEIGHT</th>
						<th>NET WEIGHT</th>
						<th>PER GRM RATE</th>
						<th>Jewel Description</th>
						
						<th>Start Date</th>
						<th>End Date</th>
						<th>Remaining Amount</th>
					
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($loanjewel['datajewel'] as $jewel)
						<tr>
							<td class="hidden">{{ $jewel->JewelLoanId }}</td>
							
							
							<td>{{ $jewel->JewelLoan_LoanNumber }}/{{ $jewel->jewelloan_Oldloan_No }}</td>
							
							<td>{{ $jewel->FirstName }}.{{ $jewel->MiddleName }}.{{ $jewel->LastName }}</td>
							<td>{{ $jewel->JewelLoan_AppraisalValue }}</td>
							
						
							<td>{{ $jewel->JewelLoan_LoanDuration }}</td>
							<td>{{ $jewel->JewelLoan_LoanAmount }}</td>
							
							
							
							<td>{{ $jewel->jewelloan_Gross_weight }}</td>
							<td>{{ $jewel->jewelloan_Net_weight }}</td>
							<td>{{ $jewel->jewelloan_pergram_value }}</td>
							<td>{{ $jewel->jewelloan_Description }}</td>
							
							
							<td>{{ $jewel->JewelLoan_StartDate }}</td>
							<td>{{ $jewel->JewelLoan_EndDate }}</td>
							<td>{{ $jewel->JewelLoan_LoanRemainingAmount }}</td>
							
						
						
						
							
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
	</script>