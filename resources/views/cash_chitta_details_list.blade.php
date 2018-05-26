



	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
		<thead>
			<tr>
				<th>cash_chitta_id</th>
				<th>prefix</th>
				<th>table_name</th>
				<th>action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data["chitta"] as $row)
				<?php
					$pk = $row['cash_chitta_id'];
				?>
				<tr id="row_{{$row['cash_chitta_id']}}" data="{{$row['cash_chitta_id']}}">
					<td>{{$row["cash_chitta_id"]}}</td>
					<td>{{$row["prefix"]}}</td>
					<td>{{$row["table_name"]}}</td>
					<td>
						<button class="btn-xs edit" data="{{$row['cash_chitta_id']}}"><span class="glyphicon  glyphicon-pencil" /></button>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="row_edit" id="row_edit_{{$row['cash_chitta_id']}}" data="{{$row['cash_chitta_id']}}">
						<div id="row_edit_data_{{$row['cash_chitta_id']}}"></div>
						<div id="row_edit_join_{{$row['cash_chitta_id']}}"></div>
						<div id="row_edit_where_{{$row['cash_chitta_id']}}"></div>
						<button class="btn-sm cancel_row_edit" data="{{$pk}}">CANCEL</button>
					</td>
				<tr>
			@endforeach
		</tbody>
	</table>
	
	<script>
		$(".cancel_row_edit").click(function() {
			var id = $(this).attr("data");
			$("#row_edit_data_"+id).html("");
			$("#row_edit_join_"+id).html("");
			$("#row_edit_where_"+id).html("");
			$("#row_edit_"+id).hide();
		});
	</script>

	<script>
		$(".row_edit").hide();
		
		$(".edit").click(function() {
			var cash_chitta_details_id = $(this).attr("data");
			var row_edit_id = "row_edit_"+cash_chitta_details_id;
			var row_edit_data_id = "row_edit_data_"+cash_chitta_details_id;
			var row_edit_join_id = "row_edit_join_"+cash_chitta_details_id;
			var row_edit_where_id = "row_edit_where_"+cash_chitta_details_id;

			console.log(cash_chitta_details_id);
			$("#"+row_edit_id).show();
			var flag = "data";
			$.ajax({
				url : "cash_chitta_details_edit",
				type : "post",
				data : "flag="+flag+"&cash_chitta_details_id="+cash_chitta_details_id,
				success : function(data) {
					$("#"+row_edit_data_id).html(data);
				}
			});
			
			var flag = "join_data";
			$.ajax({
				url : "cash_chitta_details_edit",
				type : "post",
				data : "flag="+flag+"&cash_chitta_details_id="+cash_chitta_details_id,
				success : function(data) {
					$("#"+row_edit_join_id).html(data);
				}
			});
			
			var flag = "where_data";
			$.ajax({
				url : "cash_chitta_details_edit",
				type : "post",
				data : "flag="+flag+"&cash_chitta_details_id="+cash_chitta_details_id,
				success : function(data) {
					$("#"+row_edit_where_id).html(data);
				}
			});
		});
	</script>
	