<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $r['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $r['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   SB REPORT</h2>
					
					
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<div class="col-md-4" >
								<input class="SearchTypeaheadSBR<?php echo $r['module']->Mid; ?> form-control" id="searchaccSBR<?php echo $r['module']->Mid; ?>" type="text" name="searchaccSBR<?php echo $r['module']->Mid; ?>" placeholder="SELECT SB ACCOUNT"> 
							</div>
							
							
							
							<div class="col-md-3">
								<div id="reportrange<?php echo $r['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</div>
							
							<div class="col-md-2">
								<a class="btn btn-default SearchSb<?php echo $r['module']->Mid; ?>">SEARCH</a>
							</div>
							
							<div class="col-md-3 pull-left">
								<a class="btn btn-default PrintSb<?php echo $r['module']->Mid; ?>">PRINT</a>
								
								<a class="btn btn-default PrintAllSb<?php echo $r['module']->Mid; ?>">PRINT ALL</a>
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				</br></br>
				
				
				<div class='SearchRes<?php echo $r['module']->Mid; ?>'> 
					<div  id="toprint<?php echo $r['module']->Mid; ?>">
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
						
						<!--this css should be inside the toprint div , for printing the table borders-->
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
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
								@foreach ($r['data'] as $sb_transaction)
								<tr>
									<td class="hidden">{{ $sb_transaction->Tranid }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($sb_transaction->SBReport_TranDate)); echo $trandate; ?> </td>
									<td>{{ $sb_transaction->AccNum }}</td>
									<td>{{ $sb_transaction->TransactionType }}</td>
									<td>{{ $sb_transaction->particulars }}</td>
									<td>{{ $sb_transaction->CurrentBalance }}</td>
									<td>{{ $sb_transaction->Amount }}</td>
									<td>{{ $sb_transaction->Total_Bal }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div> <!--toprint ends-->
					
					<div id='pagei<?php echo $r['module']->Mid; ?>'>
						{!! $r['data']->render() !!}
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
	
</div>


<script>

	
	$('.SearchSb<?php echo $r['module']->Mid; ?>').click(function(e){
		
		
		
		e.preventDefault();
		
		
		searchvalue=$('#searchaccSBR<?php echo $r['module']->Mid; ?>').data('value');
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'getSBacc',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate,
			success:function(data)
			{
				
				$('.SearchRes<?php echo $r['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $r['module']->Mid; ?>').html(data);
				
				
				
			}
		});
	});
	
	$("#pagei<?php echo $r['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $r['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $r['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $r['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('input.SearchTypeaheadSBR<?php echo $r['module']->Mid; ?>').typeahead({
		ajax: '/GetSearchSbAcc'
		//source:GetSearchSbAcc
		//SEND BID OF THE LOGGED IN USER ALONG WITH  THIS
	});
	
	
	
	
</script>


<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var edate;
	$(function() {
		
		function cb(start, end) {
			$('#reportrange<?php echo $r['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
		}
		//cb(moment(), moment());
		cb(moment().subtract(29, 'days'), moment());
		
		$('#reportrange<?php echo $r['module']->Mid; ?>').daterangepicker({
			
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

<script>
	
	$(function() {
		$(".PrintSb<?php echo $r['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint<?php echo $r['module']->Mid; ?>").html();
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



