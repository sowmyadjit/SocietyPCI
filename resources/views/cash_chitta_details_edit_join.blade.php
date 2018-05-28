				
		<?php
			$join_rows = $data["chitta"][0]["join"];
			$cash_chitta_id = $data["chitta"][0]["cash_chitta_id"];
		?>
		<div id="ej_box">
			<style>
				.xs_ip_box {
					width : 50px;
				}
				.sm_ip_box {
					width : 100px;
				}
				.sm_sel_box {
					width : 100px;
				}
				.lg_sel_box {
					width : 150px;
				}
			</style>
			<table>
				<!-- <tr>
					<th>cash_chitta_joining_tables_id</th>
					<th>cash_chitta_id</th>
					<th>joining_table_1_name</th>
					<th>joining_table_1_field</th>
					<th>joining_table_1_field</th>
					<th>joining_table_2_field</th>
					<th>deleted</th>
				</tr> -->
				<tr>
					<th>jid</th>
					<th>cid</th>
					<th>table 1</th>
					<th>field 1</th>
					<th>table 2</th>
					<th>field 2</th>
					<th>deleted</th>
				</tr>
				@foreach($join_rows as $join_row)
					<?php
						$pk = $join_row["cash_chitta_joining_tables_id"];
					?>
					<tr>
						<td>
							<input id="ej_cash_chitta_joining_tables_id_{{$pk}}" class="xs_ip_box" value="{{$join_row["cash_chitta_joining_tables_id"]}}" readonly />
						</td>
						<td>
							<input id="ej_cash_chitta_id_{{$pk}}" class="xs_ip_box" value="{{$join_row['cash_chitta_id']}}" readonly />
						</td>
						<td>
							<select id="ej_joining_table_1_name_{{$pk}}" class="ej_joining_table_1_name lg_sel_box" data="{{$pk}}" >
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
							<select id="ej_joining_table_1_field_{{$pk}}" class="sm_sel_box">
								<option>{{$join_row["joining_table_1_field"]}}</option>
							</select>
						</td>
						<td>
							<select id="ej_joining_table_2_name_{{$pk}}" class="ej_joining_table_2_name lg_sel_box" data="{{$pk}}" >
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
							<select id="ej_joining_table_2_field_{{$pk}}" class="lg_sel_box">
								<option>{{$join_row["joining_table_2_field"]}}</option>
							</select>
						</td>
						<td>
							<input id="ej_deleted_{{$pk}}" class="xs_ip_box" value="{{$join_row["deleted"]}}" />
						</td>
						<td><button class="btn-xs ej_save" data="{{$pk}}">SAVE</button></td>
					</tr>
				@endforeach
					<!--ADD JOIN-->
					<tr>
						<td>
							<input id="aj_cash_chitta_joining_tables_id" class="xs_ip_box" value="0" readonly />
						</td>
						<td>
							<input id="aj_cash_chitta_id" class="xs_ip_box" value="{{$cash_chitta_id}}" readonly />
						</td>
						<td>
							<select id="aj_joining_table_1_name" class="lg_sel_box" >
								@foreach($data["tables"] as $row_table)
									<option>{{$row_table}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select id="aj_joining_table_1_field" class="sm_sel_box">
								<option></option>
							</select>
						</td>
						<td>
							<select id="aj_joining_table_2_name" class="lg_sel_box">
								@foreach($data["tables"] as $row_table)
									<option>{{$row_table}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select id="aj_joining_table_2_field" class="lg_sel_box">
								<option></option>
							</select>
						</td>
						<td>
							<input id="aj_deleted" class="xs_ip_box" value="0" />
						</td>
						<td><button class="btn-xs cancel aj_save">ADD</button></td>
					</tr>
			</table>
		</div>


<script>
//SAVE EDIT JOIN
    $(".ej_save").click(function() {
		var id = $(this).attr("data");
		
        cash_chitta_joining_tables_id = $("#ej_cash_chitta_joining_tables_id_"+id).val();
        cash_chitta_id = $("#ej_cash_chitta_id_"+id).val();
        joining_table_1_name = $("#ej_joining_table_1_name_"+id).val();
        joining_table_1_field = $("#ej_joining_table_1_field_"+id).val();
        joining_table_2_name = $("#ej_joining_table_2_name_"+id).val();
        joining_table_2_field = $("#ej_joining_table_2_field_"+id).val();
        deleted = $("#ej_deleted_"+id).val();
		
        var fields = new Object;
        fields.cash_chitta_joining_tables_id = cash_chitta_joining_tables_id;
        fields.cash_chitta_id = cash_chitta_id;
        fields.joining_table_1_name = joining_table_1_name;
        fields.joining_table_1_field = joining_table_1_field;
        fields.joining_table_2_name = joining_table_2_name;
        fields.joining_table_2_field = joining_table_2_field;
        fields.deleted = deleted;

		fields = JSON.stringify(fields);
        table = "cash_chitta_joining_tables";
        operation = "update";
        pk = "cash_chitta_joining_tables_id";
        // console.log(fields);
        save_data(table,fields,operation,pk);
    });

//SAVE ADD JOIN
    $(".aj_save").click(function() {
		// var id = $(this).attr("data");
		
        // cash_chitta_joining_tables_id = $("#aj_cash_chitta_joining_tables_id).val();
        cash_chitta_id = $("#aj_cash_chitta_id").val();
        joining_table_1_name = $("#aj_joining_table_1_name").val();
        joining_table_1_field = $("#aj_joining_table_1_field").val();
        joining_table_2_name = $("#aj_joining_table_2_name").val();
        joining_table_2_field = $("#aj_joining_table_2_field").val();
        deleted = $("#aj_deleted").val();
		
        var fields = new Object;
        // fields.cash_chitta_joining_tables_id = cash_chitta_joining_tables_id;
        fields.cash_chitta_id = cash_chitta_id;
        fields.joining_table_1_name = joining_table_1_name;
        fields.joining_table_1_field = joining_table_1_field;
        fields.joining_table_2_name = joining_table_2_name;
        fields.joining_table_2_field = joining_table_2_field;
        fields.deleted = deleted;

		fields = JSON.stringify(fields);
        table = "cash_chitta_joining_tables";
        operation = "insert";
        pk = "";
        // console.log(fields);
        save_data(table,fields,operation,pk);
		$("#e_"+cash_chitta_id).trigger("click");
    });


//FUNCTION SAVE DATA
    function save_data(table,fields,operation,pk) {
        var flag = "save_data";
        $.ajax({
            url : "cash_chitta_details_edit",
            type : "post",
            data : "flag="+flag+
                    "&table="+table+
                    "&fields="+fields+
                    "&operation="+operation+
                    "&pk="+pk,
            success : function(data) {
                console.log("add_details: done");
            }
        });
    }

//EDIT JOIN
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
//ADD JOIN
    $("#aj_joining_table_1_name").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#aj_joining_table_1_field"];
        get_table_fields(table_name,selector_arr);
    });
    $("#aj_joining_table_2_name").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#aj_joining_table_2_field"];
        get_table_fields(table_name,selector_arr);
    });

    function get_table_fields(table_name,selector_arr) {

        $.ajax({
                url : "get_table_fields",
                type : "post",
                data : "table_name="+table_name,
                success : function(data) {
                    // console.log(data);
                    var select_ele = "<option>NA</option>";
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


		