
		<div id="content" class="col-lg-10 col-sm-10">
			<!-- content starts -->
			
			
			<div class="row">
				<div class="box_bdy_ box col-md-12">
					<div class="bdy_ box-inner">

						
<?php /* BOX MAIN START */?>
<div class="b_main">
						<div class="box-header well" data-original-title="">
							<h2><i class="glyphicon glyphicon-globe"></i> Loan Repayment</h2>
							
							
						</div>
						
						<div class="box-content">
							<script src="js/FileSaver.js"/>			
							<script src="js/tableExport.js"/>				
							<div class="alert alert-info">
								<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>																					  																			   
							</div>

							<div id="table_data">.</div>


							</div>	
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

			<?php /*		
					<div class="b_back">
						<center><button class="btn-sm btn-info ">back</button></center>
					</div>
			*/?>
					<div id="temp_loading_img" class="hide">
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




<script>
	$("document").ready(function() {
		setTimeout(() => {
			load_data();
		}, 2000);
	});

	function load_data() {
		var loading_img = $("#temp_loading_img").html();
		$("#table_data").html(loading_img);
		$.ajax({
			url: "pigmiDLPigmy_data",
			type: "post",
			data: "",
			success: function(data) {
				$("#table_data").html(data);
			}
		});
	}
</script>

<script>
	$(".refresh_data").click(function() {
		load_data();
	});
</script>

<script>
	$("").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});

	var is_day_open = "{{}}"; // "yes" or "no"

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
		$(".b_sub_1").html("");
	});
</script>
