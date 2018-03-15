<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.infinitescroll.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $ae['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box_bdy_<?php echo $ae['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $ae['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Agent Pigmy Entry</h2>
					
					
				</div>
				
				<div class="box-content"><form action='/AgentPigmiTransaction' method='post'>
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="AgentEntryTable">
						
						<thead>
							<tr>
								<!--<th>Branch</th>-->
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
							
							
							@foreach ($ae['PigCustList'] as $PigList)
							<tr id="Entry-Item">
							
								<td class="hidden"><input name='allocid[]' type='text' value='{{ $PigList->PigmiAllocID }}'/></td>
								<!--<td>{{ $PigList->BName }}</td>-->
								<td>{{ $PigList->PigmiAcc_No }}  -  {{ $PigList->old_pigmiaccno }}</td>
								<td>{{ $PigList->FirstName }} . {{ $PigList->MiddleName }} . {{ $PigList->LastName }}</td>
								<!--<td>{{ $PigList->MobileNo }}</td>-->
		<td><p class="text-right"><?php $amt=$PigList->Total_Amount; echo round($amt,2); ?></p></td>
								<td>
									
									<div class="col-md-12 date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="PigmyCollectDate[]"  value="<?php echo date('d-m-Y',strtotime(' -1 day'));?>" data-date-format="dd-mm-yyyy"/>
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
					
					
					<center>
						<input type='submit' value='SUBMIT' class="btn btn-success btn-md">
					</center>
				</form>
				
				</div>	
				
				
				
			</div>
		</div>	
	</div>	
</div>	
</div>	
<div id='results'></div>

<script src="js/bootstrap-datepicker.js"></script>
<script src="js/moment.min.js"></script>
<script>
	
	table = $('#AgentEntryTable').DataTable(
	{
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		//"bInfo": true,
		"bAutoWidth": false,
		
	}
	);
	
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	
	
	$('.clickme').click(function(e)
	{
		$('.accclassid').click();
	}); 
	$('.CreateAcc<?php echo $ae['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.SbList<?php echo $ae['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.RdList<?php echo $ae['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.ViewMinAcc<?php echo $ae['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.JointAcc<?php echo $ae['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.viwbtn<?php echo $ae['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $ae['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $ae['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $ae['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $ae['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $ae['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $ae['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('input.SearchTypeahead').typeahead({
		//ajax: '/GetSearchAcc'
		source:GetSearchAcc
	});
	
	$('input.SearchOldAccTypeahead').typeahead({
		//ajax: '/GetSearchOldAcc'
			source:GetSearchOldAcc
	});
	
	$('.SearchTypeahead').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		searchvalue=$('#searchacc').data('value');
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'getSearchaccount',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.box_bdy_<?php echo $ae['module']->Mid; ?>').html(data);
				
				
			}
		});
	});
	
	$('.SearchOldAccTypeahead').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		searcholdvalue=$('#searcholdacc').data('value');
		//alert(searcholdacc);
		e.preventDefault();
		$.ajax({
			url:'getSearchOldaccount',
			type:'get',
			data:'&SearchOldAccId='+searcholdvalue,
			success:function(data)
			{
				//alert("success");
				$('.box_bdy_<?php echo $ae['module']->Mid; ?>').html(data);
				
				
			}
		});
	});
	var data1=[];
	j=0;
	var formData = new FormData();
	tempd=[],tempv=[];
	$('#subm').click(function(e){
		e.preventDefault();
		showValues();
		//alert(JSON.stringify(data1));
		a=JSON.stringify(data1);
		
	/*	allocid=$('#alocid').val();
		PigmyCollectDate=$('#pgmidata').val();
		PigAmt=$('#PigAmt').val();*/
		
		
		//alert(allocid);
		$.ajax({
			url: 'AgentPigmiTransaction',
			type: 'post',
			data:a,//+'&PigmyCollectDate='+PigmyCollectDate+'&PigAmt='+PigAmt,
			success: function(data) {
				//alert('success');
				$('.expenceclassid').click();
			}
		});
	});
		
	  function showValues() {
    var fields = $( "#form1" ).serializeArray();
    $( "#form1" ).empty();
	
    jQuery.each( fields, function( i, field ) {
		if(j==3)
		{
			if(tempv[2]!=0){
			data1.push({ data:'allocid[]',value: tempv[0]}); 
			data1.push({ data:'PigmyCollectDate[]',value: tempv[1]}); 
			data1.push({ data:'PigAmt[]',value: tempv[2]}); 
			}
			//tempd[1]: tempv[1], tempd[2]: tempv[2] });
			//formData.append('allocid[]', tempv[0]);
			j=0;
		}
		tempv[j]=field.value;
		tempd[j]=field.data;
		j++;
	
    });
	
	
  
  }
  
  
  
  
  
  
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