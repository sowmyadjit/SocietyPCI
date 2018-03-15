
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $loan['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >Report</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $loan['module']->Mid; ?>box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  Loan Branch Wise Report</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							
							<label class="control-label inline col-md-3">Loan Types:
								<select class="form-control BranchListDD"  id="LoanListDD" name="LoanListDD">  
									<option value="">SELECT LOAN TYPE</option>
									<?php 
										
										foreach($loan['LT'] as $key)
										{
												echo "<option value='".$key->LoanCategoryName."' >" .$key->LoanCategoryName."";
												echo "</option>";
										}
										
									?>
								</select>
							</label>
							
							
							<div class="PLT">
								<label class="control-label inline col-md-3">Personal Loan Types:
									<select class="form-control BranchListDD"  id="PLoanListDD" name="PLoanListDD">  
										<option value="ALL">ALL</option>
										<?php foreach($loan['PLT'] as $key){
											echo "<option value='".$key->LoanType_Name."' >" .$key->LoanType_Name."";
											echo "</option>";
										}?>
									</select>
								</label>
							</div>
							
							
							
							
							
							<div class="inline col-md-3">  
								<label class="control-label pull-left">DATE RANGE:
									
									<div id="reportrange"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
								
								
							</div>
							
							
							
							<div class="col-md-2">
								<a class="btn btn-default SearchBWloan<?php echo $loan['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-1 pull-left">
								<a class="btn btn-default PrintPig<?php echo $loan['module']->Mid; ?>">PRINT</a>
								
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				
				<div class='SearchRes<?php echo $loan['module']->Mid; ?>'>
					<div  id="toprint<?php echo $loan['module']->Mid; ?>">
						
						
						
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>


<script>
	var $searchvalue;
	
	
	$('.PLT').hide();
	
	$('#LoanListDD').change( function(e) {
		e.preventDefault();
		LTY=$('#LoanListDD').val();
		if(LTY=="PERSONAL LOAN")
		{
			$('.PLT').show();
			
		}
		else if(LTY=="DEPOSITE LOAN"){
			$('.PLT').hide();
		}
		else if(LTY=="STAFF LOAN"){
			$('.PLT').hide();
		}
		else if(LTY=="JEWEL LOAN"){
			$('.PLT').hide();
		}
		else{
			alert("Please Select The Loan Type");
			$('.PLT').hide();
		}
	});
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	
	$('.SearchBWloan<?php echo $loan['module']->Mid; ?>').click(function(e){
		
		temp=$('#LoanListDD').val();
		temp1=$('#PLoanListDD').val();
		//alert(temp);
		if(temp=="PERSONAL LOAN")
		{
			BrDD="PERSONAL_LOAN";
			$('.PLT').show();
		}
		else if(temp=="DEPOSITE LOAN")
		{
			BrDD="DEPOSITE_LOAN";
			$('.PLT').hide();
		}
		else if(temp=="STAFF LOAN")
		{
			BrDD="STAFF_LOAN";
			$('.PLT').hide();
		}
		else if(temp=="JEWEL LOAN")
		{
			BrDD="JEWEL_LOAN";
			$('.PLT').hide();
		}
		
		
		
		
		//AgDD=$('#AgentListDD').val();
		
		e.preventDefault();
		$.ajax({
			url:'GetLoanBranchWiseData',
			type:'get',
			data:'&LoanDD='+BrDD+'&PLoanDD='+temp1+'&startdate='+sdate+'&enddate='+edate,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes<?php echo $loan['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $loan['module']->Mid; ?>').html(data);
				
				
				
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
			
			$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
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
		
		
		$('#reportrange').daterangepicker({
			
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
		$(".PrintPig<?php echo $loan['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint<?php echo $loan['module']->Mid; ?>").html();
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