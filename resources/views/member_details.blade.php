<?php
	$sl_no = 0;
?>

			
			<div class="alert alert-info">
				<div class="row table-row">
						<button class="btn btn-default pull-right" id="btn_excel">EXCEL</button>
				</div>
			</div>
			
			
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="export_table">
				<thead>
					<tr>
						<th>SERIAL NO.</th>
						<th>OLD MEMBER NO.</th>
						<th>NEW MEMBER NO.</th>
						<th>MEMBER ID</th>
						<th>MEMBER NAME</th>
						<th>FATHER NAME</th>
						<th>BRANCH ID</th>
						<th>SHARE CLASS</th>
						<th>CERTIFICATE ID</th>
						<th>NO OF SHARES</th>
						<th>SHARE AMOUT</th>
						<th>SHARES TOTAL AMOUNT</th>
						<th>PURCHASE DATE</th>
						<th>SHARE STATUS</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data["member_details"] as $row)
						<tr>
							<td class="center">{{++$sl_no}}</td>
							<td class="center">{{$row["old_member_no"]}}</td>
							<td class="center">{{$row["new_member_no"]}}</td>
							<td class="center">{{$row["member_id"]}}</td>
							<td class="center">{{$row["member_name"]}}</td>
							<td class="center">{{$row["FatherName"]}}</td>
							<td class="center">{{$row["bid"]}}</td>
							<td class="center">{{$row["share_class"]}}</td>
							<td class="center">{{$row["certificate_id"]}}</td>
							<td class="center">{{$row["no_of_shares"]}}</td>
							<td class="center">{{$row["share_amt"]}}</td>
							<td class="center">{{$row["share_total_amt"]}}</td>
							<td class="center">{{$row["share_purchase_date"]}}</td>
							<td class="center">{{$row["share_status"]}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			
<script>
	$("#btn_excel").click(function() {
		console.log("exporting to excel");
		$("#export_table").tableExport({
			bootstrap: false
		});//*/
	});
</script>
	
	
	
	
