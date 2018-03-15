
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->


<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $AgentPigmiRep['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $AgentPigmiRep['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  Agent Pigmy Report</h2>
					
					
				</div>
				
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							<label class="control-label inline col-md-2">Select Mode:
								
								<select class="form-control" id="ARMode" name="ARMode">
									<option value="">SELECT MODE</option>
									<option value="SINGLE">SINGLE</option>
									<option value="MULTIPLE">MULTIPLE</option>
								</select>
							</label>
							
							<label class="control-label inline col-md-4 Single">Select Account Number / ALL:
								<input class="SearchTypeaheadAPR form-control" id="searchaccAPR<?php echo $AgentPigmiRep['module']->Mid; ?>" type="text" name="searchaccAPR<?php echo $AgentPigmiRep['module']->Mid; ?>" placeholder="SELECT PIGMY ACCOUNT"> 
							</label>
							
							
							<div class="SerchParams">
								
								<div class="inline col-md-3">  
									<label class="control-label pull-left">DATE RANGE:
										
										<div id="reportrange<?php echo $AgentPigmiRep['module']->Mid; ?>"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
											
											<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
											
											<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
											<span></span> <b class="caret"></b>
											
										</div>
									</label>
									
									
								</div>
								
								
								
								<div class="col-md-2">
									<a class="btn btn-default SearchAPR<?php echo $AgentPigmiRep['module']->Mid; ?> pull-left">SEARCH</a>
								</div>
								
								<div class="col-md-1 pull-left">
									<a class="btn btn-default PrintAPR<?php echo $AgentPigmiRep['module']->Mid; ?>">PRINT</a>
									
									
								</div>
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes<?php echo $AgentPigmiRep['module']->Mid; ?>'>
					<div  id="toprint<?php echo $AgentPigmiRep['module']->Mid; ?>">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									
									<th>Transaction Date</th>
									<th>Account Number</th>
									<th>Full Name</th>
									
									<th>Current Balance</th>
									<th>Credited Amount</th>
									<th>Total Balance</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								
								@foreach($AgentPigmiRep['AgentTodayReport'] as $PABD)
								<tr>
									<td class="hidden">{{ $PABD->PigmiTrans_ID }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($PABD->PigReport_TranDate)); echo $trandate; ?></td>
									<td>{{ $PABD->PigmiAcc_No }} - {{ $PABD->old_pigmiaccno }}</td>
									<td>{{ $PABD->FirstName }}.{{ $PABD->MiddleName }}.{{ $PABD->LastName }}</td>
									<td><p class="text-right"><?php $amt=$PABD->Current_Balance; echo round($amt,2); ?></p></td>
									
									<td><p class="text-right">{{ $PABD->Amount }}</p></td>
									<td><p class="text-right"><?php $amt=$PABD->Total_Amount; echo round($amt,2); ?></p></td>
									
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
					
					<div id='pagei<?php echo $AgentPigmiRep['module']->Mid; ?>'>
						{!! $AgentPigmiRep['AgentTodayReport']->render() !!}
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>


<script>
	
	$('.Single').hide();
	//$('.Multiple').hide();
	$('.SerchParams').hide();
	
	$('#ARMode').change( function(e) {
		e.preventDefault();
		mode=$('#ARMode').val();
		if(mode=="SINGLE")
		{
			$('.Single').show();
			$('.SerchParams').show();
			//$('.Multiple').hide();
		}
		else if(mode=="MULTIPLE"){
			//$('.Multiple').show();
			$('.SerchParams').show();
			$('.Single').hide();
		}
		
		else{
			$('.Single').hide();
			//$('.Multiple').hide();
			$('.SerchParams').hide();
			alert("Please Select the Mode");
		}
	});
	
	
	//LOCAL TYPEAHEAD DATA STARTS
	var agent_cust_list;
	$.get( "PigmiAccountForAgent", function( data ) {
		agent_cust_list=data;
		// alert( "Load was performed." );
	});
		
	$('input.SearchTypeaheadAPR').typeahead({
		source: agent_cust_list
	});
	//LOCAL TYPEAHEAD DATA ENDS
	
	
	
	
	var $searchvalue;
	$("#pagei<?php echo $AgentPigmiRep['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $AgentPigmiRep['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $AgentPigmiRep['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $AgentPigmiRep['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	
	
	$('.SearchAPR<?php echo $AgentPigmiRep['module']->Mid; ?>').click(function(e){
		//e.preventDefault();
		All=$('#searchaccAPR<?php echo $AgentPigmiRep['module']->Mid; ?>').val();
		Rmode=$('#ARMode<?php echo $AgentPigmiRep['module']->Mid; ?>').val();
		if(Rmode=="SINGLE")
		{
			searchvalue=$('ul.typeahead li.active').data('value');//searchkey;	//LOCAL TYPEAHEAD DATA
		}
		else if(Rmode=="MULTIPLE")
		{
			searchvalue="no";
		}
		
		$.ajax({
			url:'GetAgentPigmiReportData',
			type:'get',
			data:'&APRmode='+Rmode+'&SearchAccId='+searchvalue+'&AllorNot='+All+'&startdate='+sdate+'&enddate='+edate,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('#searchaccAPR<?php echo $AgentPigmiRep['module']->Mid; ?>').val("");
				
				//$('.SearchTypeaheadAPR<?php echo $AgentPigmiRep['module']->Mid; ?>').typeahead('destroy');
				//window.localStorage.clear();
				//myVal="";
				//$('.SearchTypeaheadAPR<?php echo $AgentPigmiRep['module']->Mid; ?>').typeahead('val', myVal);
				//$('.SearchTypeaheadAPR<?php echo $AgentPigmiRep['module']->Mid; ?>').typeahead('destroy','NoCached') 
				$('.SearchRes<?php echo $AgentPigmiRep['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $AgentPigmiRep['module']->Mid; ?>').html(data);
				
				
				
			}
		});
		
	});
	
	
	
	
	
</script>




<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var $stdate=sdate;
	var edate;
	var $endate=edate;
	$(function() {
		
		function cb(start, end) {
			
			$('#reportrange<?php echo $AgentPigmiRep['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
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
		
		
		$('#reportrange<?php echo $AgentPigmiRep['module']->Mid; ?>').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY',
				
			},
			"showDropdowns": true,
			"opens": "right",
			
			"autoApply": true,
			
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

<script>
	
	$(function() {
		$(".PrintAPR<?php echo $AgentPigmiRep['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint<?php echo $AgentPigmiRep['module']->Mid; ?>").html();
			var printWindow = window.open('', '', 'height=400,width=800');
			printWindow.document.write('<html><head><title>SB transaction</title>');
			printWindow.document.write('</head><body >');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
</script>	