
<style>
	.right_text{
	text-align: right;
    vertical-align: middle;
    margin-top: 10px;
	}
</style>
	
<!--<script src="js/jquery.js"></script>-->
<script src="js/jquery-ui.min.js"></script>
<link href="css/jquery-ui.css" rel="stylesheet"></link>
	
<div id="content" class="col-lg-10 col-sm-10">
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Appraiser Commission Report</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
					
				</div>
				<div class="box-content" style="height: auto;">
					<div class="alert alert-info" style="height:75px;">
						
						<div class="col-md-12" style="height:50px;">
							<label class="control-label col-sm-5 right_text" for="year_month">Select Month :</label>
							<div class="col-md-7 pull-right">
							
								<input id="year_month" class="date-picker" type="month" value="1997-11"/>
								
							</div>
						</div> 
					</div>
					
					<div id="data_box"></div>
					
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	
	
	$("#year_month").change(function() {
		appraiser_commission_report_data();
	});
	
	function appraiser_commission_report_data() {
		var year_month = $("#year_month").val();
		$("#data_box").html("1");
		$.ajax({
			url:"appraiser_commission_report_data",
			type:"post",
			data:"&year_month="+year_month,
			success:function(data) {
				$("#data_box").html(data);
			}
		});
	}
</script>
<script>
	
	$(document).ready(function(){
		appraiser_commission_report_data();
	});
</script>