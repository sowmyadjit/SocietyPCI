<div  id="toprint<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>BRANCH</th>
				<th>AGENT</th>
				<th>Transaction Date</th>
				
				<th>Collected Amount</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($PigmyTranBranchWiseData['BranchAgentData'] as $PigmyBWD)
			
			
			<tr>
				
				<td>{{ $PigmyBWD->BName }}</td>
				<td>{{ $PigmyBWD->FirstName }}.{{ $PigmyBWD->MiddleName }}.{{ $PigmyBWD->LastName }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($PigmyBWD->PigReport_TranDate)); echo $trandate; ?></td>
				<td>
					@foreach ($PigmyTranBranchWiseData['AgentCollection']['parent'] as $parent)
					@foreach ($parent as $p)
					
					
					@foreach ($PigmyTranBranchWiseData['AgentCollection'][$p->Agentid]['child1'] as $child1)
					@foreach ($child1 as $c1)
					@foreach ($PigmyTranBranchWiseData['AgentCollection'][$p->Agentid][$c1->PigReport_TranDate] as $c2)
					
					
					<?php 
						if($PigmyBWD->Agentid == $p->Agentid && $PigmyBWD->PigReport_TranDate == $c1->PigReport_TranDate){
						?>
						{{ $c2->sum }}
						<?php
						}
					?>
					@endforeach
					
					
					
					@endforeach
					@endforeach 
					
					
					
					
					@endforeach
					
					
					@endforeach 
					
					
					
				</td>
				
			</tr>
			@endforeach
			
			
			
		</tbody>
	</table>
	
	
	<div id='pagei<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>'>
		
		
		
		{!! $PigmyTranBranchWiseData['BranchAgentData']->appends(Input::except('page'))->render() !!}
		
	</div>
</div>

<script>
	
	
	
	
	
	$("#pagei<?php echo $PigmyTranBranchWiseData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>
