<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $c['module']->Mid; ?>" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box_bdy_<?php echo $c['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $c['module']->Mid; ?> box-inner">
					
						
<?php /* BOX MAIN START */?>
<div class="b_main2">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> D Class Customer List</h2>
					
				</div>
				<div class="box-content">
					<script src="js/FileSaver.js"/>
					<div class="alert alert-info">
						<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
						<input type="button" value="Print" class="btn btn-info btn-sm print2" id="print2">
						<button class="refresh_data2 btn-sm glyphicon glyphicon-refresh"></button>
						<div class="col-md-5 pull-right">
							<input class="SearchTypeahead_d_class form-control" id="Search_d_clss_cust" type="text" name="Search_d_clss_cust" placeholder="SEARCH D Class Customer">
						</div>
					</div>
					
					
					<div id="table_data2">.</div>
				</div>	

				</div>
				<?php /* BOX MAIN END */?>


				<?php /* BOX SUB 1 START */?>
				<div class="b_sub_12">
				</div>
				<?php /* BOX SUB 1 END */?>


				<?php /* BOX SUB 2 START */?>
				<div class="b_sub_22">
				</div>
				<?php /* BOX SUB 2 END */?>

								
				<div class="b_back2">
					<center><button class="btn-sm btn-info ">Back to D Class Customers</button></center>
					<?php /*<a href="#top"><button class="btn btn-info btn-sm" id="back" >TOP</button></a> */?>
					<div id="temp_loading_img2" class="hide">
						<div>
							<center>
								<img src="img\\loading2.gif" width="100px" height="100px"/>
							</center>
						</div>
					</div>
				</div>
							




			</div>	
			
			
		</div>	
	</div>	
</div>

	<script>
		function show_loading_img2(selector) {
			var loading_img2 = $("#temp_loading_img2").html();
			$(selector).html(loading_img2);
		}
	</script>

	<script>
		$('input.SearchTypeahead_d_class').typeahead({
			ajax: '/SearchCustomer_d_class'
		});
	</script>

	<script>
		$("document").ready(function() {
			load_data2("");
		});
	
		function load_data2(customer_id) {
			show_loading_img2("#table_data2");
			$.ajax({
				url: "D_class_custm_data",
				type: "post",
				data: "&customer_id="+customer_id,
				success: function(data) {
					$("#table_data2").html(data);
				}
			});
		}
	</script>
	
	<script>
		$(".refresh_data2").click(function() {
			load_data2("");
		});
	</script>
	
	<script>
		$("#Search_d_clss_cust").change(function() {
			$("#Search_d_clss_cust").val("");
			var customer_id2 = $(this).attr("data-value");
			console.log(customer_id2);
			load_data2(customer_id2);
		});
	</script>
	
	
	<script>
		function load_url2(url,check_day_open=true) {
			show_loading_img2(".b_sub_12");
			if(is_day_open == "yes" || !check_day_open) {
				$(".b_main2").hide();
				$(".b_sub_12").load(url);
			} else {
				alert("Day is not open!");
			}
		}
	</script>
	
	<script>
		$(".b_back2").click(function() {
			$(".b_main2").show();
			$(".b_sub_12").html("");
		});
	</script>
<script src="js/tableExport.js"/>
<script>
	$('#excel2').click(function(e){
		$('#table_data2').tableExport({type:'excel',escape:'false'});
	});	
</script>