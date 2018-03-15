<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $IncomeReport['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $IncomeReport['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  INCOME REPORT</h2>
					
					
				</div>
				
				
				<div class="form-group">
					<div class="alert alert-info">
						
						
						<div class="row table-row">
							
							
							<label class="control-label inline col-md-3">Select Income:
								<select class="form-control IncomeListDD"  id="income" name="income">  
									<option value="">------SELECT-------</option>
									<option value="customerfees">Customer Fees</option>
									<option value="jewelloancharges">Jewel Loan Charge</option>
									<option value="personalloancharges">Personal Loan Charge</option>
									<option value="depositloancharges">Deposit Loan Charge</option>
									<option value="staffloancharges">Staff Loan Charge</option>
								</select>
							</label>
							
							
							
							
							
							
							<label class="control-label inline col-md-3" >Date Range:
								<div id="reportrange" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</label>
							
						</div>
						
						
						
						<div class="row table-row">
							<center>
								
								<a class="btn btn-default Searchex<?php echo $IncomeReport['module']->Mid; ?> btn-success">
								<i class="glyphicon glyphicon-search"> SEARCH</i></a>
								
								
								
								<a class="btn btn-default PrintRd<?php echo $IncomeReport['module']->Mid; ?> btn-info">
								<i class="glyphicon glyphicon-print"> PRINT</i></a>
								
								<!--<a class="btn btn-default PrintAllRd">PRINT ALL</a>
								</div>-->
								
								
							</center>
						</div>
					
					
				</div>
				
				
				
				
				
				
				<div class='SearchRes<?php echo $IncomeReport['module']->Mid; ?>'> 
					<div  id="toprint<?php echo $IncomeReport['module']->Mid; ?>">
						
						
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
	
			
	</div>

	
	
	
	<script>
		
		
		
		
		
		
		
		
		
		
		
		
		
		$('.Searchex<?php echo $IncomeReport['module']->Mid; ?>').click(function(e){
			
			inc=$('#income').val();
			//HeadDD=$('#HeadiD').val();
			//SubHeadDD=$('#expsubhead').val();
			//alert(SubHeadDD);
			//pay=$('#paymode').val();
			e.preventDefault();
			$.ajax({
				url:'GetIncomeBranchWiseData',
				type:'get',
				data:'&income='+inc+'&startdate='+sdate+'&enddate='+edate,
				success:function(data)
				{
					//alert("success");
					$('.SearchRes<?php echo $IncomeReport['module']->Mid; ?>').html('');
					$('.SearchRes<?php echo $IncomeReport['module']->Mid; ?>').html(data);
					
					
					
				}
			});
			
		});
		
		
		$("#pagei<?php echo $IncomeReport['module']->Mid; ?>> ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc");
			
		});
		
	
		$('.loadmc<?php echo $IncomeReport['module']->Mid; ?>').click(function(e)
		{
			e.preventDefault();
			$('#<?php echo $IncomeReport['module']->Mid; ?>content').load($(this).attr('href'));
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
				$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
				//alert(start.format('DD-MM-YYYY'));
				//alert(start.format('DD-MM-YYYY'));
				sdate=start.format('YYYY-MM-DD');
				//sdate=start.format('DD-MM-YYYY');
				edate=end.format('YYYY-MM-DD');
				//edate=end.format('DD-MM-YYYY');
				//sdate=start.format('DD/MM/YYYY');
				//edate=end.format('DD/MM/YYYY');
				//alert(sdate);
				//alert(edate);
				//alert(moment());
				
			}
			cb(moment(), moment());
			
			
			$('#reportrange').daterangepicker({
				
				locale: {
					
					format: 'DD-MM-YYYY'
				},
				"showDropdowns": true,
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
	
	<script>
		
		$(function() {
			$(".PrintRd<?php echo $IncomeReport['module']->Mid; ?>").click(function() {
				//alert('test');
				//$("#toprint<?php echo $IncomeReport['module']->Mid; ?>").print();
				
				var divContents = $("#toprint<?php echo $IncomeReport['module']->Mid; ?>").html();
				var printWindow = window.open('', '', 'height=400,width=800');
				printWindow.document.write('<html><head><title>SB transaction</title>');
				printWindow.document.write('</head><body >');
				printWindow.document.write(divContents);
				printWindow.document.write('</body></html>');
				printWindow.document.close();
				printWindow.print();
				//$.print("#toprint<?php echo $IncomeReport['module']->Mid; ?>");
			});
		});
		
		
	</script>
	
