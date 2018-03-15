
<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<div id="content" class="col-md-10">
	<!-- content starts -->
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Update Ledger Head Subhead</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					
					<form id="form_data">
						<div class="form-group">
							<label class="control-label col-sm-4">Select Head :</label>
							<div class="col-md-5">
								<select class="form-control" id="head_id">
									<option>-----select----</option>
									@foreach($data['head'] as $row)
										<option value="{{$row->lid}}"><?php echo $row->lname;?></option>
									@endforeach
								<select>
							</div>
						</div>
						
						<div id="data_box">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>

	
<script>
	$("#head_id").change(function() {
		var head_id = $("#head_id").val();
	
console.log("ajax");
		$.ajax({
			url: "update_head_subhead",
			type: "post",
			data: "&update=1&head_id="+head_id,
			success: function(data) {
				console.log("ajax complete");
				$("#data_box").html(data);
			}
		});	
	});
	
	
</script>


