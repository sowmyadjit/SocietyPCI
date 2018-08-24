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
</style>



    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
        <thead>
            <tr>
                <th>Sl. No.</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>User Type</th>
                <th>Account Number</th>
                <th>Security Deposit Amount</th>
                <th>Start Date</th>
                <th>Closed Date</th>
            </tr>
        </thead>
    <tbody>
        <?php $i=0;?>
        <tr>
            @foreach ($data['deposit_details'] as $row)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{ $row['user_id'] }}</td>
                    <td>{{ $row['name'] }}</td>	
                    <td>{{ $row['user_type'] }}</td>	
                    <td>{{$row['account_no'] }} / {{$row['old_account_no'] }}</td>
                    <td>{{ $row['amount']}}</td>
                    <td>{{ $row['start_date']}}</td>
                    <td>{{ $row['close_date']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
        
        
        
    <div id="toprint_data" class="hide_it">
    </div>
							
		