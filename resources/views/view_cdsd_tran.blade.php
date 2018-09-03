<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				$page_title = "CD Transaction";
				$category = "CD";
				break;
		case 2:
				$page_title = "SD Transaction";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

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
                                <label class="control-label col-sm-2">NAME: </label>
                                <label class="control-label col-sm-4">{{$data["cdsd_acc_info"]["name"]}}</label>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-sm-2">ACCOUNT NO.:</label>
                                <label class="control-label col-sm-4">{{$data["cdsd_acc_info"]["cdsd_acc_no"]}} / {{$data["cdsd_acc_info"]["cdsd_oldacc_no"]}}</label>
                            </div>
                        </div>
					</div>

                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Payment Mode</th>
                                <th>Credit</th>
                                <th>Debit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                $sum_cr = 0;
                                $sum_db = 0;
                                $total = 0;
                            ?>
                                @foreach ($data['cdsd_tran'] as $row_tran)
                                    <tr>
                                    <?php
                                            $temp_amount = 0;
                                            $payment_mode = "";
                                            if($row_tran->payment_mode == 1) {
                                                $temp_payment_mode = "CASH";
                                            } else {
                                                $temp_payment_mode = "ADJUSTMENT";
                                            }

                                        ?>
                                            <td>{{++$i}}({{$row_tran->cdsd_tran_id}})</td>
                                            <td>{{$row_tran->date}}</td>
                                            <td>{{$row_tran->particulars}}</td>
                                            <td>{{$temp_payment_mode}}</td>
                                            @if($row_tran->transaction_type == 1)
                                                <?php
                                                    $temp_amount = $row_tran->amount;
                                                    $sum_cr += $temp_amount;
                                                ?>
                                                <td>{{$temp_amount}}</td>
                                                <td></td>
                                            @elseif($row_tran->transaction_type == 2)
                                                <?php
                                                    $temp_amount = $row_tran->amount;
                                                    $sum_db += $temp_amount;
                                                ?>
                                                <td></td>
                                                <td>{{$temp_amount}}</td>
                                            @endif
                                    </tr>
                                @endforeach
                                <?php
                                    $total = $sum_cr - $sum_db;
                                ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td><b>{{$sum_cr}}</b></td>
                                    <td><b>{{$sum_db}}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan=2><b>{{$total}}</b></td>
                                </tr>
                            </tbody>
                    </table>

				</div>
						
			</div>


	</div>
