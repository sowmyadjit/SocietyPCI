				
		<?php
			$join_rows = $data["chitta"][0]["join"];
		?>
		<div id="ej_box">
			<table>
				<tr>
					<th>cash_chitta_joining_tables_id</th>
					<th>cash_chitta_id</th>
					<th>joining_table_1_name</th>
					<th>joining_table_1_field</th>
					<th>joining_table_1_field</th>
					<th>joining_table_2_field</th>
					<th>deleted</th>
				</tr>
				@foreach($join_rows as $join_row)
					<?php
						$pk = $join_row["cash_chitta_joining_tables_id"];
					?>
					<tr>
						<td>
							<input id="ej_cash_chitta_joining_tables_id_{{$pk}}" value="{{$join_row["cash_chitta_joining_tables_id"]}}" readonly />
						</td>
						<td>
							<input id="ej_cash_chitta_id_{{$pk}}" value="{{$join_row['cash_chitta_id']}}" readonly />
						</td>
						<td>
							<select id="ej_joining_table_1_name_{{$pk}}" class="ej_joining_table_1_name" data="{{$pk}}" >
								@foreach($data["tables"] as $row_table)
									<?php 
										if($row_table == $join_row["joining_table_1_name"]) {
											$selected = "selected";
										} else {
											$selected = "";
										}
									?>
									<option {{$selected}}>{{$row_table}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select id="ej_joining_table_1_field_{{$pk}}">
								<option>{{$join_row["joining_table_1_field"]}}</option>
							</select>
						</td>
						<td>
							<select id="ej_joining_table_2_name_{{$pk}}" class="ej_joining_table_2_name" data="{{$pk}}" >
								@foreach($data["tables"] as $row_table)
									<?php 
										if($row_table == $join_row["joining_table_2_name"]) {
											$selected = "selected";
										} else {
											$selected = "";
										}
									?>
									<option {{$selected}}>{{$row_table}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select id="ed_joining_table_2_field_{{$pk}}">
								<option>{{$join_row["joining_table_2_field"]}}</option>
							</select>
						</td>
						<td>
							<input id="ej_cash_chitta_joining_tables_id_{{$pk}}" value="{{$join_row["deleted"]}}" />
						</td>
					</tr>
				@endforeach
			</table>
		</div>


<script>
    $(".ej_joining_table_1_name").change(function() {
		var id = $(this).attr("data");
        var table_name = $(this).val();
        var selector_arr = ["#ej_joining_table_1_field_"+id];
        get_table_fields(table_name,selector_arr);
    });
    $(".ej_joining_table_2_name").change(function() {
		var id = $(this).attr("data");
        var table_name = $(this).val();
        var selector_arr = ["#ej_joining_table_2_field_"+id];
        get_table_fields(table_name,selector_arr);
    });

    function get_table_fields(table_name,selector_arr) {

        $.ajax({
                url : "get_table_fields",
                type : "post",
                data : "table_name="+table_name,
                success : function(data) {
                    // console.log(data);
                    var select_ele = "";
                    for(i=0; i<data.length; i++) {
                        select_ele += "<option>"+data[i]+"</option>";
                    }
                    for(i=0; i<selector_arr.length; i++) {
                        $(selector_arr[i]).html(select_ele);
                    }
                }
            });

    }
</script>


		