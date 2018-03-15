<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<div id="content<?php echo $rdr['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $rdr['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   RD REPORT</h2>
					
					
				</div>
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<div class="col-md-4">
								<input class="SearchTypeaheadRDR<?php echo $rdr['module']->Mid; ?> form-control" id="searchaccRDR<?php echo $rdr['module']->Mid; ?>" type="text" name="searchaccRDR<?php echo $rdr['module']->Mid; ?>" placeholder="SELECT RD ACCOUNT"> 
							</div>
							
							
							
							<div class="col-md-3">
								<div id="reportrange<?php echo $rdr['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</div>
							
							<div class="col-md-2">
								<a class="btn btn-default SearchRd<?php echo $rdr['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-3 pull-left">
								<a class="btn btn-default PrintRd<?php echo $rdr['module']->Mid; ?>">PRINT</a>
								
								<a class="btn btn-default PrintAllRd<?php echo $rdr['module']->Mid; ?>">PRINT ALL</a>
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				</br></br>
				
				
				<div class='SearchResRd<?php echo $rdr['module']->Mid; ?>'> 
					<div  id="toprint<?php echo $rdr['module']->Mid; ?>">
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
						
						<!--these css should be inside the toprint div , for printing the table borders-->
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>Date</th>
									<th>Name</th>
									<th>Account Number</th>
									<th>Transaction Type</th>
									<th>Perticulars</th>
									<th>Amount</th>
									<th>Current Blance</th>
									<th>Total Blance</th>
									
								</tr>
							</thead>
							
							<tbody>
								@foreach ($rdr['RdReport'] as $rd_transaction)
								<tr>
									<td class="hidden">{{ $rd_transaction->RD_TransID }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($rd_transaction->RDReport_TranDate)); echo $trandate; ?></td>
									<td>{{ $rd_transaction->FirstName }}.{{ $rd_transaction->MiddleName }}.{{ $rd_transaction->LastName }}</td>
									<td>{{ $rd_transaction->AccNum }}</td>
									<td>{{ $rd_transaction->RD_Trans_Type }}</td>
									<td>{{ $rd_transaction->RD_Particulars }}</td>
									<td>{{ $rd_transaction->RD_Amount }}</td>
									<td>{{ $rd_transaction->RD_CurrentBalance }}</td>
									<td>{{ $rd_transaction->RD_Total_Bal }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					
					<div id='pagei<?php echo $rdr['module']->Mid; ?>'>
						{!! $rdr['RdReport']->render() !!}
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	
</div>


<script>
	
	$("#pagei<?php echo $rdr['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $rdr['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $rdr['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $rdr['module']->Mid; ?>_content').load($(this).attr('href'));
	});	
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	$('.SearchRd<?php echo $rdr['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		searchvalue=$('#searchaccRDR<?php echo $rdr['module']->Mid; ?>').data('value');
		
		//alert(searchvalue);
		
		$.ajax({
			url:'getRDacc',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate,
			success:function(data)
			{
				$('.SearchResRd<?php echo $rdr['module']->Mid; ?>').html('');
				$('.SearchResRd<?php echo $rdr['module']->Mid; ?>').html(data);
				
			}
		});
	});
	
	
	
	
	
	
	
	
	$('input.SearchTypeaheadRDR<?php echo $rdr['module']->Mid; ?>').typeahead({
		ajax: '/GetSearchRdAcc'
		//source:GetSearchRdAcc
		//SEND BID OF THE LOGGED IN USER ALONG WITH  THIS
	});
	
	
	
	
</script>


<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var edate;
	$(function() {
		
		function cb(start, end) {
			$('#reportrange<?php echo $rdr['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			//sdate=start.format('DD-MM-YYYY');
			edate=end.format('YYYY-MM-DD');
			//edate=end.format('DD-MM-YYYY');
		}
		//cb(moment(), moment());
		 cb(moment().subtract(29, 'days'), moment());
		
		
		$('#reportrange<?php echo $rdr['module']->Mid; ?>').daterangepicker({
			
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
		$(".PrintRd<?php echo $rdr['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint<?php echo $rdr['module']->Mid; ?>").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>RD transaction</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
</script>