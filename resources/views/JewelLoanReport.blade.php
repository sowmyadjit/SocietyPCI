<div  id="toprint<?php echo $loanjewel['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Appraisal Value</th>
						<th>Duration</th>
						<th>Amount</th>
						<th>Sarapara Charges</th>
						<th>Insurance Charges</th>
						<th>Book and Form Charges</th>
						<th>Other Charges</th>
						<th>Loan Amount After Deduction</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Remaining Amount</th>
					
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($loanjewel['datajewel'] as $jewel)
						<tr>
							<td class="hidden">{{ $jewel->JewelLoanId }}</td>
							
							
							<td>{{ $jewel->JewelLoan_LoanNumber }}</td>
							<td>{{ $jewel->JewelLoan_AppraisalValue }}</td>
							
						
							<td>{{ $jewel->JewelLoan_LoanDuration }}</td>
							<td>{{ $jewel->JewelLoan_LoanAmount }}</td>
							<td>{{ $jewel->JewelLoan_SaraparaCharge }}</td>
							<td>{{ $jewel->JewelLoan_InsuranceCharge }}</td>
							<td>{{ $jewel->JewelLoan_BookAndFormCharge }}</td>
							<td>{{ $jewel->JewelLoan_OtherCharge }}</td>
							<td>{{ $jewel->JewelLoan_LoanAmountAfterDeduct }}</td>
							<td>{{ $jewel->JewelLoan_StartDate }}</td>
							<td>{{ $jewel->JewelLoan_EndDate }}</td>
							<td>{{ $jewel->JewelLoan_LoanRemainingAmount }}</td>
							
						
						
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei<?php echo $loanjewel['module']->Mid; ?>'>
			
				{!!$loanjewel['datajewel']->appends(Input::except('page'))->render() !!}

				</div>
</div>
				
				
	<script>
	
	$("#pagei<?php echo $loanjewel['module']->Mid; ?>.pagination li a").each(function() {
 
    $(this).addClass("loadmc<?php echo $loanjewel['module']->Mid; ?>");
  
});
$('.loadmc<?php echo $loanjewel['module']->Mid; ?>').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.SearchRes<?php echo $loanjewel['module']->Mid; ?>').load($(this).attr('href'));
});
	</script>