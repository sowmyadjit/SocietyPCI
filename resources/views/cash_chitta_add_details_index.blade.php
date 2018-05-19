

<style>
	.right_text{
	text-align: right;
    vertical-align: middle;
    margin-top: 10px;
	}
</style>

	
<div id="content" class="col-lg-10 col-sm-10">
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Cash Chitta</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
					
				</div>
				<div class="box-content" style="height: auto;">
					<div class="alert alert-info" style="height:75px;">
						
						<div class="col-md-12" style="height:50px;">
							<div class="col-md-7 pull-right">
								
								<button class="btn-sm btn-dark add"><span class="glyphicon  glyphicon-plus" /></button>
								<button class="btn-sm btn-dark refresh"><span class="glyphicon  glyphicon-refresh" /></button>
								
							</div>
						</div> 
						
					</div>
					
					<div id="add_box"></div>
					<div id="data_box"></div>
					
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	$(".refresh").click(function() {
		cash_chitta_details_list();
	});
	
	function cash_chitta_details_list() {
		
		$.ajax({
			url : "cash_chitta_details_list",
			type : "post",
			data : "",
			success : function(data) {
				$("#data_box").html(data);
			}
		});
	}
</script>