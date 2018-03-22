<?php
	function dmy($date)
	{
		return date("d-m-Y",strtotime($date));
	}
?>

<table>
	<tr>
		<th>allocation_id</th>
		<th>pigmy_no</th>
		<th>Name</th>
		<th>Amount till previous  day</td>
		@foreach($data["dates"] as $tran_date)
			<th>{{dmy($tran_date)}}</th>
		@endforeach
		<th>Total Balance</th>
	</tr>
	@foreach($data["pg_tr"] as $key_det => $row_det)
	<tr>
		<td>{{$row_det["allocation_id"]}}</td>
		<td>{{$row_det["pigmy_no"]}}</td>
		<td>{{$row_det["customer_name"]}}</td>
		<td>{{$row_det["prev_amt"]}}</td>
		@foreach($data["dates"] as $tran_date)
			<td>{{$row_det["{$tran_date}"]}}</td>
		@endforeach
		<td>{{$row_det["total_amt"]}}</td>
	</tr>
	@endforeach
</table>