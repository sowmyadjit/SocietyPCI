<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $SbLM['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $SbLM['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   SB Ledger</h2>
					
				</div>
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<label class="control-label inline col-md-4">Select Account Number:
								<input class="SearchTypeaheadSBL<?php echo $SbLM['module']->Mid; ?> form-control" id="searchaccSBL<?php echo $SbLM['module']->Mid; ?>" type="text" name="searchaccSBL<?php echo $SbLM['module']->Mid; ?>" placeholder="SELECT SB ACCOUNT"> 
							</label>
							
							
							
							<div class="col-md-3">
								<label class="control-label pull-left">DATE RANGE:
									<div id="reportrange<?php echo $SbLM['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
							</div>
							
							
							<label class="control-label inline col-md-1">Show In Kannada:
								<input type="checkbox" id="KanCheck<?php echo $SbLM['module']->Mid; ?>" name="KanCheck<?php echo $SbLM['module']->Mid; ?>" value="0"/>
								
							</label>
							
							<div class="col-md-2">
								<a class="btn btn-default SearchSb<?php echo $SbLM['module']->Mid; ?>">SEARCH</a>
								
							</div>
							
							
							
							
							
						</div>
					</div>
				</div>
				
				
				
				</br></br>
				
				
				<div class='SearchRes<?php echo $SbLM['module']->Mid; ?>'> 
					
					
					
					
				</div>
				
				
			</div>
		</div>
	</div>
	
</div>



<script>
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	$('.SearchSb<?php echo $SbLM['module']->Mid; ?>').click(function(e){
		
		e.preventDefault();
		if($('#KanCheck<?php echo $SbLM['module']->Mid; ?>').is(":checked"))
		{
			kanche="1";
			
		}
		else
		{
			kanche="0";
		}
		//alert(kanche);
		searchvalue=$('#searchaccSBL<?php echo $SbLM['module']->Mid; ?>').data('value');
		
		
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetSbLedgerPerData',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&Kannada='+kanche,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes<?php echo $SbLM['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $SbLM['module']->Mid; ?>').html(data);
			}
		});
	});
	
	
	$("#pagei<?php echo $SbLM['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $SbLM['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $SbLM['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $SbLM['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('input.SearchTypeaheadSBL<?php echo $SbLM['module']->Mid; ?>').typeahead({
		//ajax: '/GetSearchSbAccWithOldAcc' 
		source:GetSearchSbAccWithOldAcc
	});
	
	
	
	
</script>


<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var edate;
	$(function() {
		
		function cb(start, end) {
			//$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); //original code
			//$('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
			$('#reportrange<?php echo $SbLM['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			//sdate=start.format('DD/MM/YYYY');
			//edate=end.format('DD/MM/YYYY');
			//alert(sdate);
			//alert(edate);
			//alert(moment());
			
		}
		cb(moment(), moment());
		
		
		$('#reportrange<?php echo $SbLM['module']->Mid; ?>').daterangepicker({
			
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




