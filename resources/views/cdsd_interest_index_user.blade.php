<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
		$user_type = $data["user_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
                $page_title = "CD INTEREST";
				$category = "CD";
                $int_rate = 4;
				break;
		case 2:
				$page_title = "SD INTEREST";
				$category = "SD";
                $int_rate = 9;
				break;
		default:
				$page_title = "";
				$category = "";
	}

    $today_date = date("Y-m-d");

?>
	
                  <!-- cdsd_interest_index_employee -->
                    <script src="js/bootstrap-typeahead.js"></script>
                    <script src="js/bootstrap-datepicker.js"/>
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">DATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control datepicker" id="cdsd_int_calc_date" data-date-format="yyyy-mm-dd" value="{{$today_date}}" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">INTEREST RATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control" id="cdsd_int_rate"  value="{{$int_rate}}" placeholder="INTEREST RATE">
                        </div>
                    </div>

                    
                    <center>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="button" id="cdsd_int_calc" value="CALCULATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
                            </div>
                        </div>
                    </center>

<button id="reload_int_prev_data" class="glyphicon glyphicon-repeat btn-sm "></button>
<div id="calculated_int"></div>



<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
    $("#cdsd_int_calc").click(function() {
        console.log("interest calculate");
		var cdsd_int_calc_date = $("#cdsd_int_calc_date").val();
		var cdsd_int_rate = $("#cdsd_int_rate").val();
        var post_data = {
            "cdsd_type": {{$cdsd_type}},
            "user_type": {{$user_type}},
            "cdsd_int_calc_date": cdsd_int_calc_date,
            "cdsd_int_rate": cdsd_int_rate
        };
        $.ajax({
            type: "post",
            url: "cdsd_int_calc_all_acc",
            data: "&post_data="+JSON.stringify(post_data),
            success: function(data) {
                console.log("calculated");
                alert("SUCCESS");
				load_int_prev_data();
            }
        });
    });
</script>

<script>
	function load_int_prev_data()
	{
		show_loading_img("#calculated_int");
		console.log("int_prev");
		var post_data = {
			cdsd_type: {{$cdsd_type}},
			user_type: {{$user_type}}
		};
		$.ajax({
            type: "post",
            url: "cdsd_int_prev_data",
            data: "&post_data="+JSON.stringify(post_data),
            success: function(data) {
                console.log("done");
				$("#calculated_int").html(data);
            }
		});
	}
</script>

<script>
	$("document").ready(function() {
		load_int_prev_data();
	});
</script>

<script>
	$("#reload_int_prev_data").click(function() {
		load_int_prev_data();
	});
</script>