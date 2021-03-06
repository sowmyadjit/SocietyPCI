<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!!!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "COMPUSORY DEPOSIT";
				$category = "CD";
				break;
		case 2:
				$page_title = "SECURITY DEPOSIT...";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
    }
    
	$day_open_status = $data["day_open_status"];
?>

<style>
	.hide_it {
		opacity: 0.5;
		height: 1px;
		overflow: scroll;
	}
    .cdsd_amount {
        color:rgba(0,10,200,1);
    }
    .cdsd_amount:hover {
        cursor:pointer;
        color:rgba(0,0,0,01);
        font-weight:bold;
    }
</style>



    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
        <thead>
            <tr>
                <th>SL. NoO.</th>
                <th>CUSTOMER ID</th>
                <th>CUSTOMER NAME</th>
                <th>USER TYPE</th>
                <th>ACCOUNT NUMBER</th>
                <th>SB ACC NO</th>
                @if($cdsd_type == 1)
                    <th>COMPUSORY DEPOSIT AMOUNT</th>
                @else
                    <th>SECURITY DEPOSIT AMOUNT</th>
                @endif
                <th>START DATE</th>
                <th>CLOSED DATE</th>
            </tr>
        </thead>
    <tbody>
        <?php $i=0;?>
        <tr>
            @foreach ($data['deposit_details'] as $row)
                <tr>
                    <td><span title="acc id: {{$row['allocation_id']}}">{{++$i}}</span></td>
                    <td>{{ $row['user_id'] }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['user_type'] }}</td>
                    <td>{{$row['account_no'] }} / {{$row['old_account_no'] }}</td>
                    <td>{{ $row['sb_acc_no'] }}</td>
                    <td><span class="cdsd_amount" data="{{$row['allocation_id']}}" title="VIEW TRANSACTIONS">{{ $row['amount']}}</span></span></td>
                    <td>{{ $row['start_date']}}</td>
                    <td>{{ $row['close_date']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
        
        
        
    <div id="toprint_data" class="hide_it">
    </div>

    <script>
        $(".cdsd_amount").click(function() {
            console.log("vw tran");
            var cdsd_id = $(this).attr("data");
            var post_data = {
                "cdsd_type":{{$cdsd_type}},
                "cdsd_id":cdsd_id
            };
            $.ajax({
                type: "post",
                url: "view_cdsd_tran",
                data: "&post_data="+JSON.stringify(post_data),
                success: function(data) {
                    console.log("done");
                    $(".b_main").hide();
                    $(".b_sub_1").html(data);
                    $(".b_sub_1").show();
                }
            });
        });
    </script>
		