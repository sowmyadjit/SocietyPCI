
<script src="js/bootstrap-table.js"/>
<script src="js/tableExport.js"/>

<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php //echo $data['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> LOAN PENDING REPORT</h2>
				</div>
				<div class="box-content">
					<form id="form_data">
					
						<div class="alert alert-info">
							<div class="row table-row"  style="margin:10px;" >
								<div class="col-md-6">
									<label class="control-label col-sm-5">Loan Type:</label>
									<div class="col-md-6">
										<select class="form-control" id="ln_type" name="ln_type">
											<option>SELECT TYPE</option>
											<option value="DL">DL</option>
											<option value="PL">PL</option>
											<option value="JL">JL</option>
											<option value="SL">SL</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-4" id="dl_type_box">
									<label class="control-label col-sm-4">DL Type :</label>
									<div class="col-md-8">
										<select class="form-control" id="dl_type" name="dl_type">
											<option value="">SELECT TYPE</option>
											<option value="PIGMY">Pigmy</option>
											<option value="RD">RD</option>
											<option value="FD">FD</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-2" id="dl_type_box">
									<input type="button" class="btn btn-info" id="search" value="VIEW"  />
								</div>
							</div>
						</div>
							
						<div class="alert alert-info" id="export_box">
							<div class="row table-row">
								<div class="col-md-6">
									<label class="control-label col-sm-4">EXPORT :</label>
									<div class="col-md-6">
										<select class="form-control" id="ExportType" name="ExportType">
											<option value="">SELECT TYPE</option>
											<option value="word">WORD</option>
											<option value="excel">EXCEL</option>
											<?php /*<option value="pdf">PDF</option>*/?>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div id="loan_pending_report">
			<?php /*
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table" id="loan_pending_report_table">
								<thead>
									<tr>
										<th>DATE</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($data['det'] as $row)
										<tr>
											<td>{{ $row->CD_Date }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						*/?>
						</div>
						<div class ="hidden"  id="personal_details">
							Nothing...
						</div>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		
		if(type=="word")
		{
			$('.export_table').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('.export_table').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			$('.export_table').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
		}
		
	});
</script>
<script>
/************ FN ***************/
	function toggle_dl_type(toggle_flag)
	{
		switch(toggle_flag) {
			case "DL":	$("#dl_type_box").show();
						break;
			default:	$("#dl_type_box").hide();
		}
	}
	
	function toggle_search(toggle_flag)
	{
		switch(toggle_flag) {
			case "DL":	$("#search").attr("disabled",true);
						console.log("disabled = "+ $("#search").attr("disabled"));
						break;
			case "PL":	
			case "JL":	
			case "SL":	
			case "PIGMY":	
			case "RD":	
			case "FD":	$("#search").attr("disabled",false);
						console.log("disabled = "+ $("#search").attr("disabled"));
						break;
			default:	$("#search").attr("disabled",true);
						console.log("disabled = "+ $("#search").attr("disabled"));
		}
	}
	
	function toggle_export(toggle_flag)
	{
		switch(toggle_flag) {
			case "SHOW":	$("#export_box").show();
							break;
			default:	$("#export_box").hide();
		}
	}
		
/************ FN ***************/
</script>

<script>
/************ GLOBAL ***************/
	toggle_dl_type("default");
	toggle_search("default");
	toggle_export("default");
/************ GLOBAL ***************/
</script>

<script>
	
	
	$("#ln_type").change(function() {
		var ln_type = $(this).val();
console.log("ln_type = "+ln_type);
		toggle_dl_type(ln_type);
		toggle_search(ln_type);
	});
	
	$("#dl_type").change(function() {
		var dl_type = $(this).val();
console.log("dl_type = "+dl_type);
		toggle_search(dl_type);
	});
	
	$("#search").click(function(e) {
		e.preventDefault();
		
		$.ajax({
			url: "loan_pending_report",
			type: "post",
			data: $('#form_data').serialize(),
			success: function(data) {
console.log("ajax success");
				$("#loan_pending_report").html(data);
				toggle_export("SHOW");
			}
		});
	});
	
</script>


