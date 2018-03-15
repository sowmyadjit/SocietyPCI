<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $ex['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box_bdy_<?php echo $ex['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $ex['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Expense DETAIL</h2>
					
					
				</div>
				
				<div class="box-content">
										<script src="js/FileSaver.js"/>			
							<script src="js/tableExport.js"/>				
					<div class="alert alert-info">
						<!--<a href="expencedetail" class="btn btn-default CrtExpenseBtn<?php echo $ex['module']->Mid; ?>">Expense Bank</a>
						<a href="expencetran" class="btn btn-default CrtExpTranBtn<?php echo $ex['module']->Mid; ?>">Expense Transfer</a>
						<a href="createexp" class="btn btn-default CrtExpense<?php echo $ex['module']->Mid; ?>">Expense</a>-->
						
						<a href="expenceBranch" class="btn btn-default CrtExpenseBtn<?php echo $ex['module']->Mid; ?>">Branch TO Branch</a>
						<a href="expencetran" class="btn btn-default CrtExpTranBtn<?php echo $ex['module']->Mid; ?>">Bank TO Bank transfer</a>
						<a href="createexp" class="btn btn-default CrtExpense<?php echo $ex['module']->Mid; ?>">Expense</a>
						<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
						<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
						<!--<input type="button" value="Print" class="btn btn-info btn-sm" id="print">-->																						  																			   
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="expense_details">
						
						<thead>
							<tr>
								<th>Date</th>
								
								<th>Expence For</th>
								<th>Amount</th>							
								<th>Particulars</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($ex['expense'] as $expence)
							<tr>
								<td class="hidden">{{ $expence->id }}</td>
								<td>{{ $expence->e_date }}</td>
								
								<td>{{ $expence->lname }}</td>
								<td>{{ $expence->amount }}</td>
								<td>{{ $expence->Particulars }}</td>
								<td>
									
									<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $ex['module']->Mid; ?>" href="ExReceipt/{{ $expence->id }}"/>
									
								</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
					<div id="toprint" style="position:fixed;opacity:0;">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
						<thead>
							<tr>
								<th>Date</th>
								<th>Expence For</th>
								<th>Amount</th>							
								<th>Particulars</th>
							</tr>
						</thead>
						<br>
						<tbody>	
							@foreach ($ex['expense'] as $expence)
							<tr>
								<td class="hidden">{{ $expence->id }}</td>
								<td>{{ $expence->e_date }}</td>	
								<td>{{ $expence->lname }}</td>
								<td>{{ $expence->amount }}</td>
								<td>{{ $expence->Particulars }}</td>	
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>	
			</div>
		</div>
	</div>

<script>
	$('.clickme').click(function(e){
		$('.expenceclassid').click();
	});
	
	$('.ReceiptPrint<?php echo $ex['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $ex['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.CrtExpenseBtn<?php echo $ex['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $ex['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.CrtExpense<?php echo $ex['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $ex['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.CrtExpTranBtn<?php echo $ex['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $ex['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $ex['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $ex['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $ex['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $ex['module']->Mid; ?>_content').load($(this).attr('href'));
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