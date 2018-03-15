
<script srcccc="js/bootstrap-table.js"/>
<script srcccc="js/FileSaver.js"/>			
<script src="js/tableExport.js"/>			
<script srcccc="js/jquery.base64.js"/>			
<script srcccc="js/sprintf.js"/>
<script srcccc="js/jspdf.js"/>
<script srcccc="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>

<script srcccc="js/bootstrap-table-export.js"/>
<link hreffff="css/bootstrap-table.css" rel='stylesheet' type="text/css" media="all">
<link hreffff="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
<link hreffff="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class=" box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SHARE DETAILS</h2>
					<span class = "pull-right back_btn">back</span>
				</div>

				<div class="box-content">
					
					<div class="alert alert-info">
						<div class="row table-row">
							<div class="col-md-5">
								<label class="control-label col-sm-4">BRANCH :</label>
								<div class="col-md-6">
									<select class="form-control" id="branch_id" name="branch_id">
										<option value="0">--SELECT BRANCH--</option>
										<option value="0">ALL</option>
										@foreach($data["branch"] as $row)
											<option value="{{$row->Bid}}">{{$row->BName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<label class="control-label col-sm-4">SHARE CLASS :</label>
								<div class="col-md-6">
									<select class="form-control" id="share_class_id" name="share_class_id">
										<option value="0">--SELECT SHARE CLASS--</option>
										<option value="0">ALL</option>
										@foreach($data["share_class"] as $row)
											<option value="{{$row->Share_ID}}">{{$row->Share_Class}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-1" style="margin:0px;padding:0px;">
								<input type="button" value="VIEW" class="btn btn-info btn-sm" id="view" />
							</div>
							
						</div>
						<div class="row table-row" style="margin: 20px 0 0 20px;">
							<button class="btn btn-default pull-right" id="excel_export" >EXCEL EXPORT</button>
						</div>
					</div>
					
					<div id="table_data">
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	$("#view").click(function() {
		var bid = $("#branch_id").val();
		var share_class_id = $("#share_class_id").val();
		$.ajax({
			url:"share_details_data",
			type:"post",
			data:"&bid="+bid+"&share_class_id="+share_class_id,
			success: function(data) {
				$("#table_data").html(data);
				$("#excel_export").show();
			}
		});
		
	});
</script>

<script>
	$("#excel_export").hide();
	
	$("#excel_export").click(function() {
		console.log("exporting");
		$('#export_table').tableExport({type:'excel',escape:'false'});
	});
</script>
