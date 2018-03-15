


<div class="box_bdy_<?php echo $i['module']->Mid; ?> box col-md-12">
	<div class="bdy_<?php echo $i['module']->Mid; ?> box-inner">
		
		<div class="box-header well" data-original-title="">
			<h2>
				<a class="btn btn-setting ViewOpnBalBackBtn_<?php echo $i['module']->Mid; ?>"></a>
				
				<i class="glyphicon glyphicon-globe"></i>    Opening Balance Detail
			</h2>
		</div>
		
		
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					<th>Date</th>
					<th>Status</th>
					<th>Total Balance</th>
					<th>Bank Name</th>
					<th>Bank Branch</th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach ($i['openbal'] as $inhand)
				<tr>
					
					
					<td>{{ $inhand->Daily_Date }}</td>
					<td>{{ $inhand->Daily_Status }}</td>
					<td>{{ $inhand->Daily_TotBal }}</td>
					<td>{{ $inhand->Daily_Description }}</td>
					<td>{{ $inhand->Branch }}</td>
					
				</tr>
				@endforeach
			</div>
		</div>
		
		
		<script>
			
			
			
			$('.ViewOpnBalBackBtn_<?php echo $i['module']->Mid; ?>').click(function(e){
				
				$('.opencloseclassid_<?php echo $i['module']->Mid; ?>').click();//same as clicking sidebar link,so it prevents creating new tab and does nothing
					
			});
			
		</script>							