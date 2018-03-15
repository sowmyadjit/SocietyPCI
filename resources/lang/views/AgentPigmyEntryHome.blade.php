<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.infinitescroll.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Agent Pigmy Entry</h2>
					
					
				</div>
				
				<!--<div style="height: 500px;display: block;overflow-y: scroll;" class="box-content">-->
				<form action='/AgentPigmiTransaction' method='post'>
					
					<table  class="table table-striped table-bordered bootstrap-datatable datatable responsive AgentEntryTable" id="AgentEntryTable">
						
						<thead>
							<tr>
								<th>Serial.Num</th>
								<th>Account Number</th>
								<th>Full Name</th>
								<!--<th>Mobile Number</th>-->
								<th>Available Amount</th>
								<th><center>Collection Date</center></th>
								<th><center>Amount</center></th>
								
							</tr>
						</thead>
						
						
						<tbody>
							<?php $count=1; 
							$count=(($ae->currentPage() - 1 ) * $ae->perPage() ) + $count; ?>
							<input class='hidden' id='pgno' type="text" value="<?php echo $count;?>">
							
							@foreach ($ae as $PigList)
							
							<tr id="Entry-Item">
								<td class="hidden"><input name='allocid[]' type='text' value="{{ $PigList->PigmiAllocID }}"/></td>
								
								<td><?php echo $count++;?></td>
								<td>{{ $PigList->PigmiAcc_No }}  -  {{ $PigList->old_pigmiaccno }}</td>
								<td>{{ $PigList->FirstName }} . {{ $PigList->MiddleName }} . {{ $PigList->LastName }}</td>
								
								<td><p class="text-right"><?php $amt=$PigList->Total_Amount; echo round($amt,2); ?></p></td>
								<td>
									
									<div class="col-md-12 date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control <?php echo $ae->currentPage();?>datepicker" name="PigmyCollectDate[]"  value="<?php echo date('d-m-Y',strtotime(' -1 day'));?>" data-date-format="dd-mm-yyyy"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
									
									
									
									
								</td>
								<td>
									
									<div class="form-group">
										<div class="col-md-12">
											<input type="text" class="form-control" id="PigAmt" name="PigAmt[]" value='0' placeholder="AMOUNT">
										</div>
									</div>
									
								</td>
								
							</tr>
							
							@endforeach
						</tbody>
						
					</table>
					
					<div id="pagination" style="display: none">{!! $ae->render() !!}</div>
					
					<center>
						<input type='submit' value='SUBMIT' class="btn btn-success btn-md">
					</center>
				</form>
				
				<!--	</div>	-->
				
				
				
			</div>
		</div>	
	</div>	
</div>	
</div>	


<script src="js/bootstrap-datepicker.js"></script>
<script src="js/moment.min.js"></script>
<script>
	pgno1=$('#pgno').val();
	pgno=parseInt(pgno1);
	$('.'+pgno+'datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	
	
	(function(){
		
		var loading_options = {
			finishedMsg: "End of rows",
			msgText: "Loading new rows...",
			img: "img/ajax-loaders/ajax-loader-7.gif"
		};
		
		$('table.table tbody').infinitescroll({
			loading : loading_options,
			navSelector : "#pagination .pagination",
			nextSelector : "#pagination .pagination li.active + li a",
			itemSelector : "#Entry-Item"
			},function(){
			pgno=parseInt(pgno)+1;
			$('#pgno').val(pgno);
			pgno=$('#pgno').val();
			$('.'+pgno+'datepicker').datepicker().on('changeDate',function(e){
				$(this).datepicker('hide');
			});
		});
	})();
	
	
	
	</script>																				