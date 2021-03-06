<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $depo['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<!--  <div>
		<ul class="breadcrumb">
		<li> <a href="#">Home</a> </li>
		<li> <a class="clickme" >bank</a> </li>
		</ul>
	</div>-->
	
	<div class="row">
		<div class="box_bdy_<?php echo $depo['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $depo['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Deposit DETAIL</h2>
					
				</div>
				
				<div class="box-content">
				<script src="js/FileSaver.js"/>			
							<script src="js/tableExport.js"/>		
					
					<div class="alert alert-info">
						<a href="depodetail" class="btn btn-default CrtDeposit<?php echo $depo['module']->Mid; ?>">Deposit To Bank</a>
						
						<a href="depodetailbranch" class="btn btn-default crtds<?php echo $depo['module']->Mid; ?>">Bank To Branch</a>
						<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
						<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
						</div>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="expense_details">
						
						<thead>
							<tr>
								<th>Date</th>
								<th>Bank Name</th>
								<th>Amount</th>							
								<th>Society Branch</th>							
								<th>perticulars</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($depo['deposits'] as $deposit)
							<tr>
								<td class="hidden">{{ $deposit->d_id }}</td>
								<td>{{ $deposit->d_date }}</td>
								<td>{{ $deposit->depo_bank }}</td>
								<td>{{ $deposit->amount }}</td>
								<td>{{ $deposit->Branch }}</td>
								<td>{{ $deposit->reason }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
					<div id="toprint" style="position:fixed;opacity:0;">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
						
						<thead>
							<tr>
								<th>Date</th>
								<th>Bank Name</th>
								<th>Amount</th>							
								<th>Society Branch</th>							
								<th>perticulars</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($depo['deposits'] as $deposit)
							<tr>
								<td>{{ $deposit->d_date }}</td>
								<td>{{ $deposit->depo_bank }}</td>
								<td>{{ $deposit->amount }}</td>
								<td>{{ $deposit->Branch }}</td>
								<td>{{ $deposit->reason }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
				</div> 
			</div>
		</div>
	</div>
</div>

<script>
	$('.clickme').click(function(e){
		$('.depositclassid').click();
	});
	
	$('.CrtDeposit<?php echo $depo['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $depo['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.crtds<?php echo $depo['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $depo['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $depo['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $depo['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $depo['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $depo['module']->Mid; ?>_content').load($(this).attr('href'));
	});
			$('#excel').click(function(e){
	$('#expense_details').tableExport({type:'excel',escape:'false'});
	});			
</script>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});
	
	
</script>	