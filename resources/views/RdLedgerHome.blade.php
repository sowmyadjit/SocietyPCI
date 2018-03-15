<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $RdLM['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $RdLM['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   RD Ledger</h2>
					
				</div>
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<label class="control-label inline col-md-4">Select Account Number:
								<input class="SearchTypeaheadRDL<?php echo $RdLM['module']->Mid; ?> form-control" id="searchaccRDL<?php echo $RdLM['module']->Mid; ?>" type="text" name="searchaccRDL<?php echo $RdLM['module']->Mid; ?>" placeholder="SELECT RD ACCOUNT"> 
							</label>
							
							
							
							<div class="col-md-3">
								<label class="control-label pull-left">DATE RANGE:
									<div id="reportrange<?php echo $RdLM['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
							</div>
							
							
							<label class="control-label inline col-md-1">Show In Kannada:
								<input type="checkbox" id="KanCheck<?php echo $RdLM['module']->Mid; ?>" name="KanCheck<?php echo $RdLM['module']->Mid; ?>" value="0"/>
								
							</label>
							
							<div class="col-md-2">
								<a class="btn btn-default SearchRdl<?php echo $RdLM['module']->Mid; ?>">SEARCH</a>
								
							</div>
							
							
							
							
							
						</div>
					</div>
				</div>
				
				
				
				</br></br>
				
				
				<div class='SearchRes<?php echo $RdLM['module']->Mid; ?>'> 
					
					
					
					
				</div>
				
				
			</div>
		</div>
	</div>
	
</div>


<script>
	
	
	$('.SearchRdl<?php echo $RdLM['module']->Mid; ?>').click(function(e){
		
		
		
		e.preventDefault();
		if($('#KanCheck<?php echo $RdLM['module']->Mid; ?>').is(":checked"))
		{
			kanche="1";
			
		}
		else
		{
			kanche="0";
		}
		//alert(kanche);
		searchvalue=$('#searchaccRDL<?php echo $RdLM['module']->Mid; ?>').data('value');
		
		
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetRdLedgerPerData',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&Kannada='+kanche,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes<?php echo $RdLM['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $RdLM['module']->Mid; ?>').html(data);
				
				
				
			}
		});
		
		
		
		
		
		
	});
	
	$("#pagei<?php echo $RdLM['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $RdLM['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $RdLM['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $RdLM['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('input.SearchTypeaheadRDL<?php echo $RdLM['module']->Mid; ?>').typeahead({
		//ajax: '/GetSearchRdAccWithOldAcc' 
		source:GetSearchRdAccWithOldAcc
	});
	
	
	
	
</script>


<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var edate;
	$(function() {
		
		function cb(start, end) {
			$('#reportrange<?php echo $RdLM['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			
		}
		cb(moment(), moment());
		
		
		$('#reportrange<?php echo $RdLM['module']->Mid; ?>').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY'
			},
			"showDropdowns": true,
			//autoUpdateInput: false,
			//"autoApply": true,
			//"minDate": "01-01-1950"
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);
		
	});
</script>