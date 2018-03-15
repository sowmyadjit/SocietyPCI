<div  id="toprint<?php echo $Pigmycust['module']->Mid; ?>">
	
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
	<!--this css should be inside the toprint div , for printing the table borders-->  
	<div class="col-md-4"></div>
	<center>
		
		<label class="control-label col-md-3 inline">EXPORT
			
			<select class="form-control" id="ExportType" name="ExportType">
				<option value="">		SELECT TYPE</option>
				<option value="word">WORD</option>
				<option value="excel">EXCEL</option>
				<option value="pdf">PDF</option>
				
			</select>
		</label>
		
	</center>
	
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive bootstrapTable" id="CustList<?php echo $Pigmycust['module']->Mid; ?>" style='font-family:arial;font-size:10' data-tableexport-display="always">
		
		<thead>
			<tr>
				
				<th>Name</th>
				<th>Old Account Number</th>
				<th>New Account Number</th>
				
				
			</tr>
		</thead>
		
		<tbody>
			@foreach ($Pigmycust['age'] as $pigcust)
			<tr>
				<td class="hidden">{{ $pigcust->PigmiAllocID }}</td>
				
				<td>{{ $pigcust->FirstName }}.{{ $pigcust->MiddleName }}.{{ $pigcust->LastName }}</td>
				<td>{{ $pigcust->old_pigmiaccno }}</td>
				<td>{{ $pigcust->PigmiAcc_No }}</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>


<script>
	
	/*function ExportExcel(){
		$('#CustList<?php echo $Pigmycust['module']->Mid; ?>').tableExport({type:'doc',escape:'false'});	
	}*/
	
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		
		if(type=="word")
		{
			
			$('#CustList<?php echo $Pigmycust['module']->Mid; ?>').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('#CustList<?php echo $Pigmycust['module']->Mid; ?>').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			//alert("Please Select Type For Export");
			$('#CustList<?php echo $Pigmycust['module']->Mid; ?>').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
			
		}
		
	});
	
	
	
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $Pigmycust['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $Pigmycust['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes<?php echo $Pigmycust['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>
