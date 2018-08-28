<?php
	if(!empty($data["cdsd_type"])){
		$cdsd_type = $data["cdsd_type"];
	} else {
		echo "<script>console.log(\"data['cdsd_type'] is empty!\");</script>";
		return;
	}
	switch($cdsd_type) {
		case 1:
				// $page_title = "CD CLOSE";
				$category = "CD";
				break;
		case 2:
				// $page_title = "SD CLOSSE";
				$category = "SD";
				break;
		default:
				$page_title = "";
				$category = "";
	}

    $today_date = date("Y-m-d");

?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
	<thead>
		<tr>
			<th><input type="checkbox" id="cdsd_int_select_all" /></th>
			<th>Sl. No.</th>
			<th>Customer ID</th>
			<th>Customer Name</th>
			<th>Account Number</th>
			<th>Interest Amount</th>
		</tr>
	</thead>
<tbody>
	<?php $i=0;?>
	<tr>
		@foreach ($data['calculated_int'] as $row)
			<tr>
				<td><input type="checkbox" id="select_{{$row->cdsd_id}}" class="select_cdsd_int" data="{{$row->cdsd_id}}" ></td>
				<td>{{++$i}}</td>
				<td>{{ $row->uid }}</td>
				<td></td>	
				<td>{{$row->cdsd_acc_no}} / {{$row->cdsd_oldacc_no}}</td>
				<td>{{$row->int_prev}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
			
<center>
	<div class="form-group">
		<div class="col-sm-12">
			<input type="button" id="cdsd_int_create" value="CREATE" class="btn btn-success btn-sm" style="margin-bottom:10px;"/>
			<input type="button" id="cdsd_int_remove" value="REMOVE" class="btn btn-danger btn-sm" style="margin-bottom:10px;"/>
		</div>
	</div>
</center>

<script>
	$("#cdsd_int_select_all").click(function() {
		if($(this).is(":checked")) {
			$(".select_cdsd_int").prop("checked", true);
		} else {
			$(".select_cdsd_int").prop("checked", false);
		}
	});
</script>

<script>
	$("#cdsd_int_create").click(function() {
		var cdsd_id_arr = Array();
		var i = -1;
		$(".select_cdsd_int").each(function() {
			if($(this).prop("checked")) {
				cdsd_id_arr[++i] = $(this).attr("data");
			}
		});

		temp_post_data = {
			"cdsd_type": {{$cdsd_type}},
			"id_list": cdsd_id_arr
		};
		var post_data = JSON.stringify(temp_post_data);

		$.ajax({
			"type": "post",
			"url": "cdsd_int_create",
			data: "&post_data="+post_data,
			success: function() {
				console.log("done");
				alert("SUCCESS");
				load_int_prev_data();
			}
		});

	});

	$("#cdsd_int_remove").click(function() {
		// clonsole.log("remove");
		var cdsd_id_arr = Array();
		var i = -1;
		$(".select_cdsd_int").each(function() {
			if($(this).prop("checked")) {
				cdsd_id_arr[++i] = $(this).attr("data");
			}
		});

		temp_post_data = {
			"cdsd_type": {{$cdsd_type}},
			"id_list": cdsd_id_arr
		};
		var post_data = JSON.stringify(temp_post_data);

		$.ajax({
			"type": "post",
			"url": "cdsd_int_remove",
			data: "&post_data="+post_data,
			success: function() {
				console.log("done");
				alert("SUCCESS");
				load_int_prev_data();
			}
		});
	});
</script>

