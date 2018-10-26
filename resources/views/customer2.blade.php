

<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $id['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div class="SearchRes">	
		
		<div class="row">
			<div class="box col-md-12">
				<div class="bdy_<?php echo $id['module']->Mid; ?> box-inner">
					
						
<?php /* BOX MAIN START */?>
<div class="b_main">



					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> Customers Detail</h2>
						
					</div>
					
					<div class="box-content">
						
						
						
						<div class="alert alert-info">
							<div class="form-group">
								
								<div class="row table-row">
									<a href="createcustomer" class="btn btn-default crtcust<?php echo $id['module']->Mid; ?>">Create Customer</a>
<?php /*
									<div class="msg1 pull-left blink1"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
									<div class="msg2 pull-left blink2"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
*/ ?>

									<input type="button" value="D class Customer" class="btn btn-info crtdclasscust" href="D_class_custm" />
									<div class="col-md-5 pull-right">
										<input class="SearchTypeahead form-control" id="SearchCust" type="text" name="SearchCust" placeholder="SEARCH CUSTOMER">
										
										
									</div>
									<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>
								</div>
							</div>
						</div>

						<div id="table_data">.</div>
						
					</div>

				</div>
				<?php /* BOX MAIN END */?>


				<?php /* BOX SUB 1 START */?>
				<div class="b_sub_1">
				</div>
				<?php /* BOX SUB 1 END */?>


				<?php /* BOX SUB 2 START */?>
				<div class="b_sub_2">
				</div>
				<?php /* BOX SUB 2 END */?>

				
				<div class="b_back">
					<center><button class="btn-sm btn-info ">back</button></center>
				</div>







				</div>
			</div>
		</div>
	</div>
</div>





<script>
		$("document").ready(function() {
			load_data("");
		});
	
		function load_data(customer_id) {
			var loading_img = `
				<div>
					<center>
						<img src="img\\loading2.gif" width="50px" height="50px"/>
					</center>
				</div>`;
			$("#table_data").html(loading_img);
			$.ajax({
				url: "customer_data",
				type: "post",
				data: "&customer_id="+customer_id,
				success: function(data) {
					$("#table_data").html(data);
				}
			});
		}
	</script>

	<script>
		$('input.SearchTypeahead').typeahead({
			ajax: '/SearchCustomer2'
		});
	</script>
	
	<script>
		$(".refresh_data").click(function() {
			load_data("");
		});
	</script>
	
	<script>
		$("#SearchCust").change(function() {
			$("#SearchCust").val("");
			var customer_id = $(this).attr("data-value");
			console.log(customer_id);
			load_data(customer_id);
		});
	</script>
	
	<script>
		$(".crtcust<?php echo $id['module']->Mid; ?>").click(function(e) {
			e.preventDefault();
			var url = $(this).attr('href');
			load_url(url);
		});
		$(".crtdclasscust").click(function(e) {
			e.preventDefault();
			var url = $(this).attr('href');
			load_url(url);
		});
	
		var is_day_open = "{{$id['is_day_open']}}"; // "yes" or "no"
	
		// console.log("is_day_open:", is_day_open);
	
		function load_url(url,check_day_open=true) {
			if(is_day_open == "yes" || !check_day_open) {
				$(".b_main").hide();
				$(".b_sub_1").load(url);
			} else {
				alert("Day is not open!");
			}
		}
	</script>
	
	<script>
		$(".b_back").click(function() {
			$(".b_main").show();
			$(".b_sub_1").html("b_sub_1");
		});
	</script>
	