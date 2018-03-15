
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<script src="js/bootstrap-typeahead.js"></script>    

<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $SbBranchWise['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $SbBranchWise['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  SB Branch Wise Report</h2>
					
				</div>
				
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							<label class="control-label inline col-md-2">BRANCH:
								<select class="form-control BranchListDDBWSB<?php echo $SbBranchWise['module']->Mid; ?>"  id="BranchListDDBWSB<?php echo $SbBranchWise['module']->Mid; ?>" name="BranchListDDBWSB<?php echo $SbBranchWise['module']->Mid; ?>" onchange="BranchDDChange();">  
									<option value="ALL">ALL</option>
									<?php foreach($SbBranchWise['BranchList'] as $key){
										echo "<option value='".$key->Bid."' >" .$key->BName."";
										echo "</option>";
									}?>
								</select>
								
							</label>
							<label class="control-label inline col-md-3">Account Number:
								<input class="SearchTypeaheadBWSB<?php echo $SbBranchWise['module']->Mid; ?> form-control" id="SearchAccNumBWSB<?php echo $SbBranchWise['module']->Mid; ?>" type="text" name="SearchAccNumBWSB<?php echo $SbBranchWise['module']->Mid; ?>" placeholder="SELECT SB ACCOUNT"> 
							</label>
							
							
							<div class="inline col-md-3">  
								<label class="control-label pull-left">DATE RANGE:
									
									<div id="reportrange<?php echo $SbBranchWise['module']->Mid; ?>"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
								
								
							</div>
							
							
							
							<div class="col-md-2">
								<a class="btn btn-default SearchBWSB<?php echo $SbBranchWise['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-1 pull-left">
								<a class="btn btn-default PrintBWSB<?php echo $SbBranchWise['module']->Mid; ?>">PRINT</a>
								
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes<?php echo $SbBranchWise['module']->Mid; ?>'>
					<div  id="toprint<?php echo $SbBranchWise['module']->Mid; ?>">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>BRANCH</th>
									
									<th>Date</th>
									<th>Account Number</th>
									<th>Transaction Type</th>
									<th>Perticulars</th>
									<th>Previous Balance</th>
									<th>Amount</th>
									<th>Total Balance</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								
								@foreach($SbBranchWise['SbReportBWData'] as $SBBD)
								<tr>
									<td class="hidden">{{ $SBBD->Tranid }}</td>
									<td>{{ $SBBD->BName }}</td>
									<td class="hidden">{{ $SBBD->Tranid }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($SBBD->SBReport_TranDate)); echo $trandate; ?> </td>
									<td>{{ $SBBD->AccNum }}</td>
									<td>{{ $SBBD->TransactionType }}</td>
									<td>{{ $SBBD->particulars }}</td>
									<td>{{ $SBBD->CurrentBalance }}</td>
									<td>{{ $SBBD->Amount }}</td>
									<td>{{ $SBBD->Total_Bal }}</td>
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
					
					<div id='pagei<?php echo $SbBranchWise['module']->Mid; ?>'>
						{!! $SbBranchWise['SbReportBWData']->render() !!}
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>
<script>
	$('document').ready(function(){
		
		BranchDD=$('#BranchListDDBWSB<?php echo $SbBranchWise['module']->Mid; ?>').val();
		//GetAgent(BranchDD);
		
	});
	
	
	
</script>

<script>
	var $searchvalue;
	
	$("#pagei<?php echo $SbBranchWise['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $SbBranchWise['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $SbBranchWise['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $SbBranchWise['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	
	
	$('input.SearchTypeaheadBWSB<?php echo $SbBranchWise['module']->Mid; ?>').typeahead({
		ajax: '/GetSearchSbAcc' 
		//source:GetSearchSbAcc
	});
	
	$('.SearchBWSB<?php echo $SbBranchWise['module']->Mid; ?>').click(function(e){
		
		BrDD=$('#BranchListDDBWSB<?php echo $SbBranchWise['module']->Mid; ?>').val();
		AN=$('#SearchAccNumBWSB<?php echo $SbBranchWise['module']->Mid; ?>').data('value');
		//AgDD=$('#AgentListDD').val();
		
		e.preventDefault();
		$.ajax({
			url:'GetSbTranBranchWiseData',
			type:'get',
			data:'&BranchDD='+BrDD+'&startdate='+sdate+'&enddate='+edate+'&SBAccNum='+AN,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes<?php echo $SbBranchWise['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $SbBranchWise['module']->Mid; ?>').html(data);
				
				
				
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
			
			$('#reportrange<?php echo $SbBranchWise['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
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
		
		
		$('#reportrange<?php echo $SbBranchWise['module']->Mid; ?>').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY',
				
			},
			"showDropdowns": true,
			"opens": "left",
			
			//"autoApply": true,
			
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
		$(".PrintBWSB<?php echo $SbBranchWise['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint<?php echo $SbBranchWise['module']->Mid; ?>").html();
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