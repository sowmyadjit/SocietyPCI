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
				$page_title = "CD CLOSE";
				$category = "CD";
				break;
		case 2:
				$page_title = "SD CLOSSE";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

    $today_date = date("Y-m-d");

?>
<!-- cdsd_close_index_user -->
                    <script src="js/bootstrap-typeahead.js"></script>
                    <script src="js/bootstrap-datepicker.js"/>
		

                    
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">CLOSE DATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control datepicker" id="cdsd_int_calc_date" data-date-format="yyyy-mm-dd" value="{{$today_date}}" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">INTEREST RATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control" id="cdsd_int_rate"  value="9" placeholder="INTEREST RATE">
                        </div>
                    </div>
                    @if($cdsd_type == 1)
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">CD ACCOUNT NO:</label>
                            <div class="col-md-4">
                                <input  class="form-control cdsd_acc_no_typeahead" id="cdsd_acc_no" placeholder="SELECT CD ACCOUNT NO.">
                            </div>
                        </div>
                    @elseif($cdsd_type == 2)
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">SD ACCOUNT NO:</label>
                            <div class="col-md-4">
                                <input  class="form-control cdsd_acc_no_typeahead" id="cdsd_acc_no" placeholder="SELECT SD ACCOUNT NO.">
                            </div>
                        </div>
                    @endif

                    
                    <center>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="button" id="cdsd_preview_btn" value="PREVIEW INTEREST" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
                                <input type="button" id="cdsd_close_btn" value="CLOSE ACCOUNT" class="btn btn-danger btn-sm" style="margin-bottom:10px;"/>
                            </div>
                        </div>
                    </center>



<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>
<script>
		$('.cdsd_acc_no_typeahead').typeahead({
			ajax: '/search_cdsd_acc_no?cdsd_type={{$cdsd_type}}&user_type={{$user_type}}&cdsd_closed=0'
			// source:search_cdsd_acc_no
		});
		
</script>

<script>
    var preview = "NO";

    function cdsd_close_submit() {
        console.log("cdsd close");
        var cdsd_int_calc_date = $("#cdsd_int_calc_date").val();
        var cdsd_int_rate = $("#cdsd_int_rate").val();
        var cdsd_acc_no = $("#cdsd_acc_no").val();
        var cdsd_acc_id = $("#cdsd_acc_no").attr("data-value");
        var post_data = {
            "cdsd_type": {{$cdsd_type}},
            "user_type": {{$user_type}},
            "cdsd_int_calc_date": cdsd_int_calc_date,
            "preview": preview,
            "cdsd_int_rate": cdsd_int_rate,
            "cdsd_acc_no": cdsd_acc_no,
            "cdsd_acc_id": cdsd_acc_id
        };
        $.ajax({
            type: "post",
            url: "cdsd_close",
            data: "&post_data="+JSON.stringify(post_data),
            success: function(data) {
                console.log("calculated");
                alert("INTEREST: \n\n"+data);
            }
        });
    }
    
    $("#cdsd_close_btn").click(function() {
        preview = "NO";
        cdsd_close_submit();
    });
    $("#cdsd_preview_btn").click(function() {
        console.log("click");
        preview = "YES";
        cdsd_close_submit();
    });
</script>