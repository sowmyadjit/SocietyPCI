<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Member Number</th>
						<th>Member Name</th>
						
						<th>Number Of Shares</th>
						<th>Total Amount</th>
						
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($shr['data']['details'] as $share)
						<tr>
							
							
							
							<td class="hidden">{{ $share->PURSH_Memid }}</td>
							<td>{{ $share->New_Member_No}}/{{ $share->Member_no}}</td>
							<td>{{ $share->FirstName }}.{{ $share->MiddleName }}.{{ $share->LastName }}</td>
							@foreach($shr['data'][$share->PURSH_Memid]['noshr'] as $key)
							@foreach($key as $c1)
							
							<td>{{ $c1}}</td>
							
							
							@endforeach
							@endforeach
							@foreach($shr['data'][$share->PURSH_Memid]['totamt'] as $keys)
							@foreach($keys as $c2)
							<td>{{ $c2 }}</td>
						
						@endforeach
						@endforeach
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