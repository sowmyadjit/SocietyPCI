


						<script src="js/bootstrap-table.js"/>
						<script src="js/FileSaver.js"/>			
						<script src="js/tableExport.js"/>			
						<script src="js/jquery.base64.js"/>			
						<script src="js/sprintf.js"/>
						<script src="js/jspdf.js"/>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
						
						<script src="js/bootstrap-table-export.js"/>
						<link href="css/bootstrap-table.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">


						
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php //echo $data['module']->Mid; ?> box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> SD REPORT</h2>
				</div>

				<div class="box-content">
					<div class="alert alert-info">
					<?php /*<a  class="btn btn-default export <?php //echo $data['module']->Mid; ?>">Export</a>*/?>
								
							<div class="row table-row">
								<div class="col-md-6">
									<label class="control-label col-sm-4">EXPORT :</label>
									<div class="col-md-6">
										<select class="form-control" id="ExportType" name="ExportType">
											<option value=""> SELECT TYPE</option>
											<option value="word">WORD</option>
											<option value="excel">EXCEL</option>
											<?php /*<option value="pdf">PDF</option>*/?>
											
										</select>
									</div>
								</div>
								<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">																						
							</div>
					</div>

					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="sd_report_table">
						<thead>
							<tr>
								<th>Employee Name</th>
								<th>SD AMOUNT</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data['det'] as $row)
								<tr>
									<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
									<td>{{ $row->Emp_Secutity_Deposit }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div id="toprint" style="position:fixed;opacity:0;">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th>Employee Name</th>
								<th>SD AMOUNT</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data['det'] as $row)
								<tr>
									<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
									<td>{{ $row->Emp_Secutity_Deposit }}</td>
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
	$(".export").click(function() {
		console.log("exporting");
	});
</script>

<script>
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		
		if(type=="word")
		{
			$('#sd_report_table').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('#sd_report_table').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			$('#sd_report_table').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
		}
		
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