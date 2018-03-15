<script src="js/bootstrap-typeahead.js"></script> 
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
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
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  RD Branch Wise Report</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<!--<div class="col-md-4">
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT PIGMY ACCOUNT"> 
							</div>-->
							
							<!--<label class="control-label col-md-1">BRANCH:</label>-->
							<label class="control-label inline col-md-2">BRANCH:
								<select class="form-control BranchListDD"  id="BranchListDD" name="BranchListDD" onchange="BranchDDChange();">  
									<option value="ALL">ALL</option>
									<?php foreach($RDBranchWise['BranchList'] as $key){
										echo "<option value='".$key->Bid."' >" .$key->BName."";
										echo "</option>";
									}?>
								</select>
								
							</label>
							<label class="control-label inline col-md-3">Account Number:
								<input class="SearchTypeahead form-control" id="SearchAccNum" type="text" name="SearchAccNum" placeholder="SELECT RD ACCOUNT"> 
							</label>
							
							
							<div class="inline col-md-3">  
								<label class="control-label pull-left">DATE RANGE:
									
									<div id="reportrange"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
								
								
							</div>
							
							
							
							<div class="col-md-2">
								<a class="btn btn-default SearchBWRD pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-1 pull-left">
								<a class="btn btn-default PrintSB">PRINT</a>
								
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes'>
					<div  id="toprint">
						
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
								
								
								@foreach($RDBranchWise['RDReportBWData'] as $SBBD)
								<tr>
									<td class="hidden">{{ $SBBD->RD_TransID }}</td>
									<td>{{ $SBBD->BName }}</td>
									<td class="hidden">{{ $SBBD->RD_TransID }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($SBBD->RDReport_TranDate)); echo $trandate; ?> </td>
									<td>{{ $SBBD->AccNum }}</td>
									<td>{{ $SBBD->RD_Trans_Type }}</td>
									<td>{{ $SBBD->RD_Particulars }}</td>
									<td>{{ $SBBD->RD_CurrentBalance }}</td>
									<td>{{ $SBBD->RD_Amount }}</td>
									<td>{{ $SBBD->RD_Total_Bal }}</td>
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
					
					<div id='pagei'>
						{!! $RDBranchWise['RDReportBWData']->render() !!}
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>
<script>
	$('document').ready(function(){
		
		BranchDD=$('#BranchListDD').val();
		//GetAgent(BranchDD);
		
	});
	
	
	
</script>

<script>
	var $searchvalue;
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#maincontents').load($(this).attr('href'));
	});
	
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSearchRdAcc' 
	});
	
	$('.SearchBWRD').click(function(e){
		
		BrDD=$('#BranchListDD').val();
		AN=$('#SearchAccNum').data('value');
		//AgDD=$('#AgentListDD').val();
		
		e.preventDefault();
		$.ajax({
			url:'GetRDTranBranchWiseData',
			type:'get',
			data:'&BranchDD='+BrDD+'&startdate='+sdate+'&enddate='+edate+'&SBAccNum='+AN,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
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
		$(".PrintSB").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint").html();
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