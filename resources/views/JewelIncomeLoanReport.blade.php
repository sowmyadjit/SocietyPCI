<div  id="toprint<?php echo $incomejewel['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Name</th>
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
							<td>{{ $jew->JewelLoan_LoanNumber }}/{{ $jew->jewelloan_Oldloan_No }}</td>
							<td>{{ $jew->FirstName }}.{{ $jew->MiddleName }}.{{ $jew->LastName }}</td>
							<td>{{ $jew->JewelLoan_AppraisalValue }}</td>
							<td>{{ $jew->JewelLoan_SaraparaCharge }}</td>
							<td>{{ $jew->JewelLoan_InsuranceCharge }}</td>
							<td>{{ $jew->JewelLoan_BookAndFormCharge }}</td>
							<td>{{ $jew->JewelLoan_OtherCharge }}</td>
							
						
						
						
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei<?php echo $incomejewel['module']->Mid; ?>'>
			
				{!!$incomejewel['datajewel']->appends(Input::except('page'))->render() !!}

				</div>
</div>
				
				
	<script>
	
	$("#pagei<?php echo $incomejewel['module']->Mid; ?>ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc<?php echo $incomejewel['module']->Mid; ?>");
  
});
$('.loadmc<?php echo $incomejewel['module']->Mid; ?>').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.SearchRes<?php echo $incomejewel['module']->Mid; ?>').load($(this).attr('href'));
});
	</script>