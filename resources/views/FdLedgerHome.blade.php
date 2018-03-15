<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $FdLM['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $FdLM['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   FD Ledger</h2>
					
					
				</div>
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							<label class="control-label inline col-md-2">Select Mode:
								
								<select class="form-control" id="FdMode" name="FdMode">
									<option value="">SELECT MODE</option>
									<option value="SINGLE">SINGLE</option>
									<option value="MULTIPLE">MULTIPLE</option>
								</select>
							</label>
							
							<label class="control-label inline col-md-3 Single">Select Account Number / ALL:
								<input class="SearchTypeaheadFDL<?php echo $FdLM['module']->Mid; ?> form-control" id="searchaccFDL<?php echo $FdLM['module']->Mid; ?>" type="text" name="searchaccFDL<?php echo $FdLM['module']->Mid; ?>" placeholder="SELECT FD ACCOUNT / ALL"> 
							</label>
							
							
							<label class="control-label inline col-md-2 Multiple">Select Status:
								
								<select class="form-control" id="FdStatus" name="FdStatus">
									<option value=""></option>
									<option value="CLOSED">CLOSED</option>
									<option value="ACTIVE">ACTIVE</option>
									<option value="ALL">ALL</option>
								</select>
							</label>
							
							<div class="SerchParams">
								<div class="col-md-3">
									<label class="control-label pull-left">DATE RANGE(Opening Date):
										<div id="reportrange<?php echo $FdLM['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
											
											
											<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
											<span></span> <b class="caret"></b>
											
										</div>
									</label>
								</div>
								
								
								<label class="control-label inline col-md-1">Show In Kannada:
									<input type="checkbox" id="KanCheck<?php echo $FdLM['module']->Mid; ?>" name="KanCheck<?php echo $FdLM['module']->Mid; ?>" value="0"/>
									
								</label>
								
								<div class="col-md-2">
									<a class="btn btn-default SearchFdl<?php echo $FdLM['module']->Mid; ?>">SEARCH</a>
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				
				
				</br></br>
				
				
				<div class='SearchRes<?php echo $FdLM['module']->Mid; ?>'> 
					
					
					
					
				</div>
				
				
			</div>
		</div>
	</div>
	
</div>


<script>
	$('.Single').hide();
	$('.Multiple').hide();
	$('.SerchParams').hide();
	
	$('#FdMode').change( function(e) {
		e.preventDefault();
		mode=$('#FdMode').val();
		if(mode=="SINGLE")
		{
            $('.Single').show();
            $('.SerchParams').show();
            $('.Multiple').hide();
		}
		else if(mode=="MULTIPLE"){
			$('.Multiple').show();
			$('.SerchParams').show();
            $('.Single').hide();
		}
		
		else{
			$('.Single').hide();
			$('.Multiple').hide();
			$('.SerchParams').hide();
			alert("Please Select the Mode");
		}
	});
	
	
	
	$('.SearchFdl<?php echo $FdLM['module']->Mid; ?>').click(function(e){
		
		
		
		e.preventDefault();
		if($('#KanCheck<?php echo $FdLM['module']->Mid; ?>').is(":checked"))
		{
			kanche="1";
			
		}
		else
		{
			kanche="0";
		}
		//alert(kanche);
		searchvalue=$('#searchaccFDL<?php echo $FdLM['module']->Mid; ?>').data('value');
		FdStat=$('#FdStatus').val();
		All=$('#searchaccFDL<?php echo $FdLM['module']->Mid; ?>').val();
		
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetFdLedgerPerData',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&Kannada='+kanche+'&AllorNot='+All+'&FdStatus='+FdStat,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes<?php echo $FdLM['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $FdLM['module']->Mid; ?>').html(data);
			}
		});
	});
	
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#maincontents').load($(this).attr('href'));
	});
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('input.SearchTypeaheadFDL<?php echo $FdLM['module']->Mid; ?>').typeahead({


	//	ajax: '/GetSearchFdAccWithOldAcc' 
		source:GetSearchFdAccWithOldAcc
	});
	
</script>


<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var edate;
	$(function() {
		
		function cb(start, end) {
			$('#reportrange<?php echo $FdLM['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			
		}
		cb(moment(), moment());
		
		
		$('#reportrange<?php echo $FdLM['module']->Mid; ?>').daterangepicker({
			
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