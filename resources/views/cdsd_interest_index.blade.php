<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "CD INTEREST";
				$category = "CD";
				break;
		case 2:
				$page_title = "SD INTEREST";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

    $today_date = date("Y-m-d");

?>
		<script src="js/bootstrap-typeahead.js"></script>
		<script src="js/bootstrap-datepicker.js"/>
		<div id="deposit_details_box">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i>{{$page_title}}</h2>
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
					class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			
			<div id="view_cdsd_tran">
				<div class="form-group">
					<div class="form-group col-md-12">
                        <div class="alert alert-info" style="height:80px;">
                            <div class="col-md-12">
                            </div>
                        </div>
					</div>

                    
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">DATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control datepicker" id="cdsd_int_calc_date" data-date-format="yyyy-mm-dd" value="{{$today_date}}" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">INTEREST RATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control" id="cdsd_int_rate"  value="4" placeholder="INTEREST RATE">
                        </div>
                    </div>

                    
                    <center>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="button" id="cdsd_int_calc" value="CALCULATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
                            </div>
                        </div>
                    </center>


				</div>
						
			</div>


	</div>

<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
    $("#cdsd_int_calc").click(function() {
        console.log("interest calculate");
        var post_data = {
            "cdsd_type": {{$cdsd_type}}
        };
        $.ajax({
            type: "post",
            url: "cdsd_int_calc",
            data: "&post_data="+JSON.stringify(post_data),
            success: function(data) {
                console.log("calculated");
                alert("SUCCESS");
            }
        });
    });
</script>