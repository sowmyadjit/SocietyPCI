<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						
						<th>AGENT Name</th>
						<th>Total Balance</th>
						
					</tr>
					</thead>
					
					<tbody>
					<tr>
						<td> <?php echo $Pigmyagent['details']->FirstName; ?> </td>
						<td><?php echo $Pigmyagent['amt']; ?></td>
					</tr>
						
							
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
				
				
		

		
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
	$('.SearchRes').load($(this).attr('href'));// append the required param after href with + ,before that store those params in a global variable inside other div which is comman
});
	</script>
