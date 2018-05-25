



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
				<tr id="row_{{$row['cash_chitta_id']}}" data="{{$row['cash_chitta_id']}}">
					<td>{{$row["cash_chitta_id"]}}</td>
					<td>{{$row["prefix"]}}</td>
					<td>{{$row["table_name"]}}</td>
					<td>
						<button class="btn-xs edit" data="{{$row['cash_chitta_id']}}"><span class="glyphicon  glyphicon-pencil" /></button>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="row_edit" id="row_edit_{{$row['cash_chitta_id']}}" data="{{$row['cash_chitta_id']}}"></td>
				<tr>
			@endforeach
		</tbody>
	</table>
	
	<script>
		$(".row_edit").hide();
		
		$(".edit").click(function() {
			var cash_chitta_details_id = $(this).attr("data");
			var row_id = "row_edit_"+cash_chitta_details_id;

			console.log(cash_chitta_details_id);
			var flag = "data";
			$.ajax({
				url : "cash_chitta_details_edit",
				type : "post",
				data : "flag="+flag+"&cash_chitta_details_id="+cash_chitta_details_id,
				success : function(data) {
					$("#"+row_id).html(data);
					$("#"+row_id).show();
				}
			});
		});
	</script>
	