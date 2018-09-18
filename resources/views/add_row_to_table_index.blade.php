

	<label class="control-label col-sm-1">TABLE:</label>
	<div class="col-md-3">
		<select class="form-control" id="table_name">
				<option value="">---------</option>
			@foreach($data["table_names"] as $key=>$value)
				<option value="{{$value}}">{{$value}}</option>
			@endforeach
		</select>
	</div>

	<button id="add_row_submit" class="btn btn-sm">ADD</button>

	

<script>
	$("#add_row_submit").click(function() {
		// console.log("9+");
		var da = {
			"table_name": $("#table_name").val()
		};

		$.ajax({
			type: 'post',
			url: 'add_row_to_table_submit',
			data: "&da="+JSON.stringify(da),
			success:  function(data) {
				console.log("done");
				$("#msg").html(data);
			}
		});
	});
</script>