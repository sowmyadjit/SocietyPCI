<script src="js/bootstrap-typeahead.js"></script> 
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $FDBranchWise['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $FDBranchWise['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  FD Branch Wise Report</h2>
					
				</div>
				
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							<label class="control-label inline col-md-2">BRANCH:
								<select class="form-control BranchListDDBWFD<?php echo $FDBranchWise['module']->Mid; ?>"  id="BranchListDDBWFD<?php echo $FDBranchWise['module']->Mid; ?>" name="BranchListDDBWFD<?php echo $FDBranchWise['module']->Mid; ?>" onchange="BranchDDChange();">  
									<option value="ALL">ALL</option>
									<?php foreach($FDBranchWise['BranchList'] as $key){
										echo "<option value='".$key->Bid."' >" .$key->BName."";
										echo "</option>";
									}?>
								</select>
								
							</label>
							<label class="control-label inline col-md-3">Account Number:
								<input class="SearchTypeaheadBWFD<?php echo $FDBranchWise['module']->Mid; ?> form-control" id="SearchAccNumBWFD<?php echo $FDBranchWise['module']->Mid; ?>" type="text" name="SearchAccNumBWFD<?php echo $FDBranchWise['module']->Mid; ?>" placeholder="SELECT FD ACCOUNT"> 
							</label>
							
							
							<div class="inline col-md-3">  
								<label class="control-label pull-left">DATE RANGE:
									
									<div id="reportrange<?php echo $FDBranchWise['module']->Mid; ?>"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
								
								
							</div>
							
							
							
							<div class="col-md-2">
								<a class="btn btn-default SearchBWFD<?php echo $FDBranchWise['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-1 pull-left">
								<a class="btn btn-default PrintBWFD<?php echo $FDBranchWise['module']->Mid; ?>">PRINT</a>
								
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes<?php echo $FDBranchWise['module']->Mid; ?>'>
					<div  id="toprint<?php echo $FDBranchWise['module']->Mid; ?>">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>Certificate Number</th>
									
									<th>First Name</th>
									<th>Middle Name</th>
									<th>Last Name</th>
									
									<th>Number Of Days</th>
									<th>Interest</th>
									<th>Deposit Amount</th>
									<th>Start Date</th>
									<th>Mature Date</th>
									<th>Maturity Amount</th>
									<th>Remarks</th>
									
									
								</tr>
							</thead>
							
							<tbody>
								
								
								@foreach($FDBranchWise['FDReportBWData'] as $fdallocation)
								<tr>
									
									
									<td>{{ $fdallocation->Fd_CertificateNum }}</td>
									
									<td>{{ $fdallocation->FirstName }}</td>
									<td>{{ $fdallocation->MiddleName}}</td>
									<td>{{ $fdallocation->LastName }}</td>
									
									<td>{{ $fdallocation->NumberOfDays }}</td>
									<td>{{ $fdallocation->FdInterest }}</td>
									<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
									<td>{{$fdallocation->Fd_StartDate}}
										<td>{{ $fdallocation->Fd_MatureDate}}</td>
										<td>{{ $fdallocation->Fd_TotalAmt}}</td>
										<td>{{ $fdallocation->Fd_Remarks}}</td>
										
									</tr>
									@endforeach
									
									
								</tbody>
							</table>
						</div>
						
						<div id='pagei<?php echo $FDBranchWise['module']->Mid; ?>'>
							{!! $FDBranchWise['FDReportBWData']->render() !!}
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
		
	</div>
	<script>
		$('document').ready(function(){
			
			BranchDD=$('#BranchListDDBWFD<?php echo $FDBranchWise['module']->Mid; ?>').val();
			//GetAgent(BranchDD);
			
		});
		
		
		
	</script>
	
	<script>
		var $searchvalue;
		
		$("#pagei<?php echo $FDBranchWise['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $FDBranchWise['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $FDBranchWise['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $FDBranchWise['module']->Mid; ?>_content').load($(this).attr('href'));
	});
		
		
		
		
		$('input.SearchTypeaheadBWFD<?php echo $FDBranchWise['module']->Mid; ?>').typeahead({
			ajax: '/GetFDNumber' 
			//source:GetFDNumber
		});
		
		$('.SearchBWFD<?php echo $FDBranchWise['module']->Mid; ?>').click(function(e){
			
			BrDD=$('#BranchListDDBWFD<?php echo $FDBranchWise['module']->Mid; ?>').val();
			AN=$('#SearchAccNumBWFD<?php echo $FDBranchWise['module']->Mid; ?>').data('value');
			//AgDD=$('#AgentListDD').val();
			
			e.preventDefault();
			$.ajax({
				url:'GetFDTranBranchWiseData',
				type:'get',
				data:'&BranchDD='+BrDD+'&startdate='+sdate+'&enddate='+edate+'&SBAccNum='+AN,
				success:function(data)
				{
					//alert("success");
					//$('.box').html(data);
					$('.SearchRes<?php echo $FDBranchWise['module']->Mid; ?>').html('');
					$('.SearchRes<?php echo $FDBranchWise['module']->Mid; ?>').html(data);
					
					
					
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
				
				$('#reportrange<?php echo $FDBranchWise['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
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
			
			
			$('#reportrange<?php echo $FDBranchWise['module']->Mid; ?>').daterangepicker({
				
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
			$(".PrintBWFD<?php echo $FDBranchWise['module']->Mid; ?>").click(function() {
				//alert('test');
				//$("#toprint").print();
				
				var divContents = $("#toprint<?php echo $FDBranchWise['module']->Mid; ?>").html();
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