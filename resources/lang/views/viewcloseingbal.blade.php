    
		
	
			<div class="box col-md-12">
				<div class="box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   opening balance Detail</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>DAte</th>
						<th>satus</th>
						<th>Total BAl</th>
						<th>Bank Name</th>
						<th>Bank Branch</th>
						
					</tr>
					</thead>
					
					<tbody>
						@foreach ($i as $inhand)
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
	  
	  $('.clickme').click(function(e){
			$('.companyclassid').click();
		}); 
		
	  $('.crtds').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		
</script>