<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Member Name</th>
						<th>Member Number</th>
						<th>Purchase Date</th>
						<th>Share Class</th>
						<th>Member Share Id</th>
						<th>Certificate Id</th>
						<th>Number Of Shares</th>
						<th>Total Amount</th>
						<th>Status</th>
						<th>Receipt Number</th>
						
						
						
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($IndiShrDet as $share)
						<tr>
							
							
							
							<td class="hidden">{{ $share->PURSH_Memid }}</td>
							<td>{{ $share->FirstName }}.{{ $share->MiddleName }}.{{ $share->LastName }}</td>
							<td>{{ $share->New_Member_No}}/{{ $share->Member_no}}</td>
		<td><?php $trandate=date("d-m-Y",strtotime($share->PURSH_Date)); echo $trandate; ?></td>
							<td>{{ $share->PURSH_Shrclass}}</td>
							<td>{{ $share->PURSH_Memshareid}}</td>
							<td>{{ $share->PURSH_Certfid}}</td>
							<td>{{ $share->PURSH_Noofshares}}</td>
							<td>{{ $share->PURSH_Totalamt}}</td>
							<td>{{ $share->Status}}</td>
							<td>{{ $share->PURSH_ReceiptNo}}</td>
						
						</tr>
						@endforeach
					</tbody>
					</table>
				
				
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