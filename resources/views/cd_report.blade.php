

<script src="js/bootstrap-table.js"/>
<script src="js/tableExport.js"/>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>
<script src="js/bootstrap-typeahead.js"></script>


	<?php /*
						<script src="js/FileSaver.js"/>					
						<script src="js/jquery.base64.js"/>			
						<script src="js/sprintf.js"/>
						<script src="js/jspdf.js"/>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
						
						<script src="js/bootstrap-table-export.js"/>
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">

*/ ?>
						
<div id="content" class="col-lg-10 col-sm-12">
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php //echo $data['module']->Mid; ?> box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> CD REPORT</h2>
				</div>

				<div class="box-content">
					<form id="form_data">
							<?php /*<a  class="btn btn-default export <?php //echo $data['module']->Mid; ?>">Export</a>*/?>
							
						<div class="alert alert-info" style=" padding-bottom: 60px !important;">
							
							
							<div class="row table-row"  style="margin:10px;" >
								<div class="col-md-6">
									<label class="control-label col-sm-4">Select SL No. :</label>
									<div class="col-md-6">
										<input type="text" class="form-control SLAccNumTypeAhead" name="sl_no" id="sl_no"  placeholder="SL No." />
									</div>
								</div>
							</div>
						
							<div class="col-md-12 date">
								<div class="col-md-2 date">From:</div>
								<div class="col-md-3 date">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control datepicker" name="from_date" id="from_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
									</div>
								</div>
								<div class="col-md-2 date">To:</div>
								<div class="col-md-3 date">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control datepicker" name="to_date" id="to_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
									</div>
								</div>	
								<div class="col-md-2 date">
									<input type="button" id="view" value="VIEW" class="btn btn-info viewreport" />
								</div>
							</div>
						</div>
							
						
						<div class="alert alert-info">
							<div class="row table-row">
								<div class="col-md-6">
									<label class="control-label col-sm-4">EXPORT :</label>
									<div class="col-md-6">
										<select class="form-control" id="ExportType" name="ExportType">
											<option value="">		SELECT TYPE</option>
											<option value="word">WORD</option>
											<option value="excel">EXCEL</option>
											<?php /*<option value="pdf">PDF</option>*/?>
											
										</select>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
						<div id="cd_report">
							<h5>FROM :{{$data["from_date"]}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TO : {{$data["to_date"]}}</h5>
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table" id="cd_report_table">
								<thead>
									<tr>
										<th>DATE</th>
										<th>Name</th>
										<th>CD ACCOUNT</th>
										<th>CD TYPE</th>
										<th>CD AMOUNT</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($data['det'] as $row)
										<tr>
											<td>{{ $row->CD_Date }}</td>
											<td><span  class="details_link"> {{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }} </span></td>
											<td>{{ $row->CD_Account }}</td>
											<td>{{ $row->CD_Type }}</td>
											<td>{{ $row->CD_Amount }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div id="personal_details">
							Nothing...
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	
	$('.SLAccNumTypeAhead').typeahead({
		ajax:'/getslacc'
	});
	
</script>
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
/****************** FN *******************/
	function disp_toggle(display_flag)
	{
console.log("display_flag = "+display_flag);
		
		switch(display_flag) {
			case "cd_report":	
				$("#cd_report").show();
				$("#personal_details").hide();
				console.log("cd_report");
				break;
				
			case "personal_details": 
				$("#cd_report").hide();
				$("#personal_details").show();
				console.log("cd_report"); 
				break;
				
			default :  
				$("#cd_report").show();
				$("#personal_details").hide();
				console.log("default"); 
				break;
		}
	}
/****************** FN *******************/
</script>

<script>
	$("#personal_details").hide();
	
	$(".details_link").click(function() {
		var display_flag = "cd_report";
	//	disp_toggle(display_flag);
	});
	
	$("#view").click(function() {
		$.ajax({
			url: "cdreport",
			type:"post",
			data: $("#form_data").serialize()+"&first_time=NO",
			success: function(data) {
				console.log("ajax:cdreport success");
				$("#cd_report").html(data);
			}
		});
	});
	
</script>



