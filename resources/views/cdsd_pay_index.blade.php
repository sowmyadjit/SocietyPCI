<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "CD PAY";
				$category = "CD";
				break;
		case 2:
				$page_title = "SD PAY";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

    $today_date = date("Y-m-d");

?>

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

                    
                    <script src="js/bootstrap-typeahead.js"></script>
                    <script src="js/bootstrap-datepicker.js"/>
		

                    
                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">DATE:</label>
                        <div class="col-md-4">
                            <input  class="form-control datepicker" id="cdsd_pay_date" data-date-format="yyyy-mm-dd" value="{{$today_date}}" placeholder="yyyy-mm-dd">
                        </div>
                    </div>

                    @if($cdsd_type == 1)
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">CD ACCOUNT NO:</label>
                            <div class="col-md-4">
                                <input  class="form-control cdsd_acc_no_typeahead" id="cdsd_pay_acc_no" placeholder="SELECT CD ACCOUNT NO.">
                            </div>
                        </div>
                    @elseif($cdsd_type == 2)
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">SD ACCOUNT NO:</label>
                            <div class="col-md-4">
                                <input  class="form-control cdsd_acc_no_typeahead" id="cdsd_pay_acc_no" placeholder="SELECT SD ACCOUNT NO.">
                            </div>
                        </div>
                    @endif

                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">NAME:</label>
                        <div class="col-md-4">
                            <input  class="form-control" id="name" placeholder="NAME" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">BALANCE AMOUNT:</label>
                        <div class="col-md-4">
                            <input id="balance_amt"  class="form-control" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">INTEREST AMOUNT:</label>
                        <div class="col-md-4">
                            <input id="interest_amt"  class="form-control" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">PAYMENT MODE:</label>
                        <div class="col-md-4">
                            <select id="pay_mode" class="form-control">
                                <option value="CASH">CASH</option>
                                <option value="SB" >SB</option>
                                <option value="CHEQUE">CHEQUE</option>
                            </select>
                        </div>
                    </div>

                    <div id="pay_mode_sb">
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">SELECT SB ACCOUNT NO:</label>
                            <div class="col-md-4">
                                <input id="sb_acc_id"  class="form-control typeahead_sb" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div id="pay_mode_cheque">
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">SELECT BANK:</label>
                            <div class="col-md-4">
                                <input id="bank"  class="form-control typeaheadbank" placeholder="">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">CHEQUE NO:</label>
                            <div class="col-md-4">
                                <input id="cheque_no"  class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label col-sm-4">CHEQUE DATE:</label>
                            <div class="col-md-4">
                                <input id="cheque_date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-sm-4">PAY AMOUNT:</label>
                        <div class="col-md-4">
                            <input id="pay_amt"  class="form-control" placeholder="" readonly>
                        </div>
                    </div>
                    
                    <center>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="button" id="cdsd_pay_btn" value="PAY" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
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
		$('.cdsd_acc_no_typeahead').typeahead({
			ajax: '/search_cdsd_acc_no?cdsd_type={{$cdsd_type}}&cdsd_closed=1'
			// source:search_cdsd_acc_no
		});
		$('.typeaheadbank').typeahead({
			ajax: '/GetBank'
			// source:GetBank
		});
		$('.typeahead_sb').typeahead({
			ajax: '/Getaccnum'
			// source:Getaccnum
		});
</script>

<script>
    var submit_count = 0;
    $("#cdsd_pay_btn").click(function() {
        var cdsd_type = {{$cdsd_type}};
        var cdsd_id = $("#cdsd_pay_acc_no").attr("data-value");
        var pay_date = $("#cdsd_pay_date").val();
        var pay_mode = $("#pay_mode").val();
        var sb_acc_id = $("#sb_acc_id").attr("data-value");
        var bank = $("#bank").attr("data-value");
        var cheque_no = $("#cheque_no").val();
        var cheque_date = $("#cheque_date").val();
        var pay_amt = $("#pay_amt").val();
        var temp_post_data = {
            "cdsd_type": cdsd_type,
            "cdsd_id": cdsd_id,
            "pay_date": pay_date,
            "pay_mode": pay_mode,
            "sb_acc_id": sb_acc_id,
            "bank": bank,
            "cheque_no": cheque_no,
            "cheque_date": cheque_date,
            "pay_amt": pay_amt
        };
        var post_data = JSON.stringify(temp_post_data, function(k, v) { if (v === undefined) { return 0; } return v;});
        if(submit_count == 0) {
            submit_count++;
            $.ajax({
                type:"post",
                url: "cdsd_pay",
                data: "&post_data="+post_data,
                success: function(data) {
                    console.log("done");
                    alert("success");
                }
            });
        }
    });
</script>

<script>
    $("#cdsd_pay_acc_no").change(function() {
        var cdsd_id = $(this).attr("data-value");
        var tpd = {
            "cdsd_type": {{$cdsd_type}},
            "cdsd_id":cdsd_id
        };
        pd = JSON.stringify(tpd);
        if(cdsd_id !== undefined) {
            $.ajax({
                type:"post",
                url: "cdsd_acc_details",
                data: "&pd="+pd,
                success: function(data) {
                    console.log(data);
                    $("#balance_amt").val(data["bal_amt"]);
                    $("#interest_amt").val(data["acc_info"].int_prev);
                    var pay_amt = parseFloat(data["bal_amt"]) + parseFloat(data["acc_info"].int_prev);
                    $("#pay_amt").val(pay_amt);
                    var name = data["acc_info"].FirstName + " " + data["acc_info"].MiddleName + " " + data["acc_info"].LastName;
                    $("#name").val(name);
                    
                }
            });
        }
    });
</script>

<script>
    $("#pay_mode").change(function() {
        // console.log($(this).val());
        var pay_mode = $(this).val();
        switch(pay_mode) {
            case "CASH":
                            $("#pay_mode_cheque").hide();
                            $("#pay_mode_sb").hide();
                            break;
            case "CHEQUE":
                            $("#pay_mode_cheque").show();
                            $("#pay_mode_sb").hide();
                            break;
            case "SB":
                            $("#pay_mode_cheque").hide();
                            $("#pay_mode_sb").show();
                            break;
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#pay_mode_cheque").hide();
        $("#pay_mode_sb").hide();
    });
</script>