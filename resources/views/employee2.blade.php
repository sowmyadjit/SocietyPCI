

<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a class="clickme" >EMPLOYEE</a>
            </li>
        </ul>
    </div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">




		<?php /* BOX MAIN START */?>
		<div class="b_main">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>EMPLOYEE</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="empcreate" class="btn btn-default empcrt">Create Employee</a>
						<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>
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
	function show_loading_img(selector) {
		var loading_img = $("#temp_loading_img").html();
		$(selector).html(loading_img);
	}
</script>

<script>
	$("document").ready(function() {
		load_data();
	});

	function load_data() {
		show_loading_img("#table_data");
		$.ajax({
			url: "employee_data",
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
	$(".empcrt").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});

	var is_day_open = "{{$e['is_day_open']}}"; // "yes" or "no"

	// console.log("is_day_open:", is_day_open);

	function load_url(url,check_day_open=true) {
		if(is_day_open == "yes" || !check_day_open) {
			$(".b_main").hide();
			show_loading_img(".b_sub_1");
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
