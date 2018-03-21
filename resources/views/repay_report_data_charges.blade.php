<?PHP
	$charges_sum = 0;
?>
        <link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
        <link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<table class="table table-striped bootstrap-datatable datatable responsive">
			<tr>
				<th>Rec. Date</th>
				<th>Charge Info</th>
				<th>Amount</th>
			</tr>
			@foreach($data["charges"] as $key_ch => $row_ch)
				<tr>
					<td>{{$row_ch["charg_tran_date"]}}</td>
					<td>{{$row_ch["charges_name"]}}</td>
					<td>{{$row_ch["amount"]}}</td>
				</tr>
				<?php
					$charges_sum += $row_ch["amount"];
				?>
			@endforeach
			<tr>
				<td colspan="2"><b>Total</b></td>
				<td><b>{{$charges_sum}}</b></td>
			</tr>
		</table>