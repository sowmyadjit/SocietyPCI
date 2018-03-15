
<script src="js/bootstrap-table.js"/>
<script src="js/tableExport.js"/>
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>
<style>
	.auto_height{
	height:auto !important;
	}
	.padding_null{
	padding:0px !important;
	}
</style>


<div id="content" class="col-lg-10 col-sm-10 col-md-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a>
			</li>
			<li>
				<a class="clickme" >Account</a>
			</li>
		</ul>
	</div>
	
	<div class="row loadper">
		<div class="box col-md-12">
			<div class="box-inner col-md-12">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Account Detail</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
				
				
<?php /******************* date range **********************/?>

					
					<div class="alert alert-info" style=" padding-bottom: 60px !important;">
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

<?php /******************* date range **********************/?>
				<div class="box">
				</div>
					
				</div>	
			</div>	
			
			
		</div>
	</div>	
</div>	



	

<script type="text/javascript">
	$("#view").click(function() {
		var from_date = $("#from_date").val();
		var to_date = $("#to_date").val();
		
		$.ajax({
			url:'ledgerReport',
			type:'get',
			data:'&from_date=' + from_date + '&to_date=' + to_date,
			success:function(data)
			{
				
				$('.box').html(data);
				
				$('.box-content').addClass("auto_height");
				$('.box-inner').addClass("col-md-12 padding_null");
			}
		});
	}
	);
</script>

<script type="text/javascript">
	
$('.datepicker').datepicker().on('changeDate',function(e){
	$(this).datepicker('hide');
});

</script>

<script>
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		alert();
		if(type=="WORD")
		{
			$('.export_table_1').tableExport({type:'doc',escape:'false',fileName: 'tableExport1'});
		}
		else if(type=="EXCEL")
		{
			$('.export_table_1').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="PDF")
		{
			$('.export_table_1').tableExport({type:'pdf',escape:'false',fileName: 'tableExport1'});
		}
		
	});
	
	function export_fn()
	{
		$('.export_table_1').tableExport({type:'excel',escape:'false'});
		$('.table_export_2').tableExport({type:'excel',escape:'false'});
	}
</script>