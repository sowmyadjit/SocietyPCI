<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Appraisal value</th>
						<th>Sarapara Charge</th>
						<th>Insurance Charge</th>
						<th>Book And Form Charge</th>
						<th>Other Charge</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($incomejewel['datajewel'] as $jew)
						<tr>
							<td class="hidden">{{ $jew->JewelLoanId }}</td>
							<td>{{ $jew->JewelLoan_LoanNumber }}</td>
							<td>{{ $jew->JewelLoan_AppraisalValue }}</td>
							<td>{{ $jew->JewelLoan_SaraparaCharge }}</td>
							<td>{{ $jew->JewelLoan_InsuranceCharge }}</td>
							<td>{{ $jew->JewelLoan_BookAndFormCharge }}</td>
							<td>{{ $jew->JewelLoan_OtherCharge }}</td>
							
						
						
						
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
			
				{!!$incomejewel['datajewel']->appends(Input::except('page'))->render() !!}

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