
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class=" box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SHARE DIVIDENT REPORT</h2>
					<span class="pull-right back_btn">back</span>
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
			url:"divident_report_data",
			type:"post",
			data:"&bid="+bid+"&share_class_id="+share_class_id,
			success: function(data) {
				$("#table_data").html(data);
			}
		});
		
	});
</script>

<script>
	$(".back_btn").click(function() {
		$.ajax({
			url:"divident",
			type:"get",
			success: function(data) {
				$("#maintest").html(data);
			}
		});
	});
</script>