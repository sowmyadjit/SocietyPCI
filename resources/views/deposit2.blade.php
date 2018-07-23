
<div id="content<?php echo $depo['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<!--  <div>
		<ul class="breadcrumb">
		<li> <a href="#">Home</a> </li>
		<li> <a class="clickme" >bank</a> </li>
		</ul>
	</div>-->
	
	<div class="row">
		<div class="box_bdy_<?php echo $depo['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $depo['module']->Mid; ?> box-inner">

					<?php /* BOX MAIN START */?>
					<div class="b_main">
							<div class="box-header well" data-original-title="">
								<h2><i class="glyphicon glyphicon-globe"></i> Deposit DETAIL</h2>
							</div>
							
							<div class="box-content">
								<script src="js/FileSaver.js"/>			
											<script src="js/tableExport.js"/>		
								
								<div class="alert alert-info">
									<a href="depodetail" class="btn btn-default CrtDeposit<?php echo $depo['module']->Mid; ?>">Deposit To Bank</a>
									
									<a href="depodetailbranch" class="btn btn-default crtds<?php echo $depo['module']->Mid; ?>">Bank To Branch</a>
									<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
									<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
									<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>
								</div>
							</div>

							<div id="table_data">.</div>
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
						<center><button id="back" class="btn-sm btn-info">back</button></center>
					</div>

			</div>
		</div> 
	</div>
</div>


	<script>
			$("document").ready(function() {
				load_data();
			});
		
			function load_data() {
				var loading_img = `
					<div>
						<center>
							<img src="img\\loading2.gif" width="50px" height="50px"/>
						</center>
					</div>`;
				$("#table_data").html(loading_img);
				$.ajax({
					url: "deposit_data",
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
			$(".CrtDeposit<?php echo $depo['module']->Mid; ?>").click(function(e) {
				e.preventDefault();
				var url = $(this).attr('href');
				load_url(url);
			});
			$(".crtds<?php echo $depo['module']->Mid; ?>").click(function(e) {
				e.preventDefault();
				var url = $(this).attr('href');
				load_url(url);
			});
		
			function load_url(url) {
				$(".b_main").hide();
				$(".b_sub_1").load(url);
			}
		</script>
		
		<script>
			$(".b_back").click(function() {
				$(".b_main").show();
				$(".b_sub_1").html("b_sub_1");
			});
		</script>