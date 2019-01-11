<?php

?>


<div style="margin-top:50px;">
	<center>
		<h3>LAST DAY OPEN / CLOSE DETAILS</h3>
	</center>
	<table class="table table-striped bootstrap-datatable datatable responsive">
		<thead>
			<tr>
                <th>Sl.No.</th>
                <th>DATE</th>
                <th>STATUS</th>
                <th>DESCRIPTION</th>
				<th>OPENING / CLOSING AMOUNT</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = 0;
				$id_list_str = "";
			?>
			@foreach($data["day_open_close_details"] as $row_oc) 
			<?php
				$i++;
			?>
				<tr>
					<td title="{{$row_oc->Dailyopenclose_Id}}"> {{$i}} </td>
					<td> {{$row_oc->Daily_Date}} </td>
					<td> {{$row_oc->Daily_Status}} </td>
					<td> {{$row_oc->Daily_Description}} </td>
					<td> {{$row_oc->Daily_TotBal}} </td>
					<td>
							<input type="number" id="amount_edit_box_{{$row_oc->Dailyopenclose_Id}}" class="form-control amount_edit_box" value="{{$row_oc->Daily_TotBal}}" />
							<button id="amount_save_btn_{{$row_oc->Dailyopenclose_Id}}" class="btn glyphicon glyphicon-ok green amount_save_btn" title="SAVE" data="{{$row_oc->Dailyopenclose_Id}}"	></button>
							<button class="btn glyphicon glyphicon-pencil blue amount_edit_btn title="EDIT AMOUNT" data="{{$row_oc->Dailyopenclose_Id}}"	></button>
					</td>
				</tr>
				<?php
					if(empty($id_list_str)) {
						$id_list_str .= $row_oc->Dailyopenclose_Id;
					} else {
						$id_list_str .= ",".$row_oc->Dailyopenclose_Id;
					}
				?>
			@endforeach
		</tbody>
		<tr>
			<td title="DELETE LAST  DAY OPEN / DAY CLOSE  ENTRIES">
				<button id="delete_last_oc_entries" class="btn glyphicon glyphicon-trash red"></button>
			</td>
			<td colspan="5"></td>
		</tr>
	</table>
</div>

<script>
	$(".amount_edit_box").hide();
	$(".amount_save_btn").hide();
	$(".amount_edit_btn").click(function() {
		// console.log("--edit--");
		var oc_id = $(this).attr("data");
		// console.log(oc_id);
		$("#amount_edit_box_"+oc_id).show();
		$("#amount_save_btn_"+oc_id).show();
		$(this).hide();
	});
</script>

<script>
	$(".amount_save_btn").click(function() {
		// console.log("--save--");
		var oc_id = $(this).attr("data");
		// console.log(oc_id);
		var amount_new_value = $("#amount_edit_box_"+oc_id).val();
		// console.log(amount_new_value);
		$.ajax({
			type: "post",
			url: "daily_open_close_update_new_amount",
			data: "oc_id="+oc_id+"&amount_new_value="+amount_new_value,
			success:function() {
				$("#refresh").trigger("click");
				console.log("done");
				alert("SUCCESS");
			}
		});
	});
</script>

<script>
	$("#delete_last_oc_entries").click(function() {
		// console.log("--delete last oc entries--");
		var id_list_str = '{{$id_list_str}}';
		// console.log(id_list_str);
		var confirmed = confirm("Are you sure?");
		if(confirmed) {
			$.ajax({
				type: "post",
				url: "daily_open_close_delete_last_entries",
				data: "id_list_str="+id_list_str,
				success:function() {
					$("#refresh").trigger("click");
					console.log("done");
					alert("SUCCESS");
				}
			});
		}
	});
</script>