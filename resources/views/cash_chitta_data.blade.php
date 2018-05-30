<?php
	$class_debit = "red-text";
	$class_credit = "green-text";
	$opening_balance = $data["opening_balance"];
	$receipt_amount_sum = $data["receipt_amount_sum"];
	$voucher_amount_sum = $data["voucher_amount_sum"];
	$op_rec_sum = $opening_balance + $receipt_amount_sum;
	$total_remaining_bal = $op_rec_sum - $voucher_amount_sum;
?>

<style>
	.green-text {
		color: #014204;
	}
	.red-text {
		color: #600101;
	}
</style>

	<h1>Date : {{$data["date"]}}</h1>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
		<thead>
			<tr>
				<th>Receipt No.</th>
				<th>Voucher No.</th>
				<th>Particulars</th>
				<th>Receipt Amount</th>
				<th>Payment Amount</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data["chitta"] as $row)
				<?php
				if(strcasecmp($row["transaction_type"],"CREDIT") == 0) {
					$row_class = $class_credit;
				} else {
					$row_class = $class_debit;
				}
				?>
				<tr class="{{$row_class}}">
					<td>{{$row["receipt_no"]}}</td>
					<td>{{$row["voucher_no"]}}</td>
					<td>{{$row["particulars"]}}</td>
					<td>{{$row["receipt_amount"]}}</td>
					<td>{{$row["voucher_amount"]}}</td>
				</tr>
			@endforeach
				<tr>
					<td></td>
					<td></td>
					<td><b>TOTAL</b></td>
					<td><span class="green-text"><b>{{$data["receipt_amount_sum"]}}</b></span></td>
					<td><span class="red-text"><b>{{$data["voucher_amount_sum"]}}</b></span></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><b>OP BAL / CL BAL</b></td>
					<td><b>{{$data["opening_balance"]}}</b></td>
					<td><b>{{$total_remaining_bal}}</b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><b>GRAND TOTAL</b></td>
					<td><b>{{$op_rec_sum}}</b></td>
					<td><b>{{$op_rec_sum}}</b></td>
				</tr>
		</tbody>
	</table>
	