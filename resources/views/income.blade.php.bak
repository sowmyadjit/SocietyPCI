		<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

			</div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
		<script src="js/FileSaver.js"/>			
					<script src="js/tableExport.js"/>
            <!-- content starts -->
                <div>
					<ul class="breadcrumb">
						<li> <a href="#">Home</a> </li>
						<li> <a class="clickme" >bank</a> </li>
					</ul>
				</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i> INCOME DETAIL</h2>

						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
   
						<div class="alert alert-info">
						<a href="createIncome" class="btn btn-default crtds">Income</a>
						<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
						<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">			  
						</div>
						
						
										<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="excel_export">
						
						<thead>
							<tr>
								<th>Date</th>
								
								<th>Income For</th>
								<th>Amount</th>							
								<th>Particulars</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($ex as $expence)
							<tr>
								<td class="hidden">{{ $expence->Income_id }}</td>
								<td>{{ $expence->Income_date }}</td>
								
								<td>{{ $expence->lname }}</td>
								<td>{{ $expence->Income_amount }}</td>
								<td>{{ $expence->Income_Particulars }}</td>
								<td>
									
									<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="IncomeReceipt/{{ $expence->Income_id }}"/>
									
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
								
								<th>Income For</th>
								<th>Amount</th>							
								<th>Particulars</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($ex as $expence)
							<tr>
								<td class="hidden">{{ $expence->Income_id }}</td>
								<td>{{ $expence->Income_date }}</td>
								
								<td>{{ $expence->lname }}</td>
								<td>{{ $expence->Income_amount }}</td>
								<td>{{ $expence->Income_Particulars }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
					</div> 
				</div>
			</div>
		</div>
	</div>
	
    <script>
	  $('.clickme').click(function(e){
			$('.expenceclassid').click();
		});
		
	  $('.crtds').click(function(e){
			e.preventDefault();
			$('.box-inner').load($(this).attr('href'));
		});
		$('.ReceiptPrint').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
		$('#excel').click(function(e){
	$('#excel_export').tableExport({type:'excel',escape:'false'});
	});
	</script>
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