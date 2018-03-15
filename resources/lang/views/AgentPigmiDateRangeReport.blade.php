<div  id="toprint">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
	
	
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				
				<th>Transaction Date</th>
				
				<th>Collected Amount</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			@foreach($AgentPigmiRepData['AgentRangeReport'] as $PigmyBWD)
			
			
			
			<tr>
				
				
				<td><?php $trandate=date("d-m-Y",strtotime($PigmyBWD->PigReport_TranDate)); echo $trandate; ?></td>
				<td>
					
					@foreach ($AgentPigmiRepData['AgentCollection']['child1'] as $child1)
					@foreach ($child1 as $c1)
					@foreach ($AgentPigmiRepData['AgentCollection'][$c1] as $c2)
					
					
					<?php 
						if($PigmyBWD->PigReport_TranDate == $c1){
						?>
						{{ $c2->sum }}
						<?php
						}
					?>
					@endforeach
					
					
					
					@endforeach
					@endforeach 
					
					
					
					
					
					
					
					
				</td>
				
			</tr>
			@endforeach
			
			
			
		</tbody>
	</table>
	
	
	<div id='pagei'>
		
		
		
		{!! $AgentPigmiRepData['AgentRangeReport']->appends(Input::except('page'))->render() !!}
		
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
