				
		<?php
			$where_rows = $data["chitta"][0]["where"];
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
			<!-- 	<tr>
					<th>cash_chitta_where_clause_id</th>
					<th>cash_chitta_id</th>
					<th>table_name</th>
					<th>field_name</th>
					<th>field_type</th>
					<th>operator</th>
					<th>field_value</th>
					<th>deleted</th>
				</tr> -->
				<tr>
					<th>wid</th>
					<th>cid</th>
					<th>table</th>
					<th>field name</th>
					<th>field type</th>
					<th>operator</th>
					<th>field value</th>
					<th>deleted</th>
				</tr>
				@foreach($where_rows as $where_row)
					<?php
						$pk = $where_row["cash_chitta_where_clause_id"];
					?>
					<tr>
						<td>
							<input id="ew_cash_chitta_where_clause_id_{{$pk}}" class="xs_ip_box" value="{{$where_row["cash_chitta_where_clause_id"]}}" readonly />
						</td>
						<td>
							<input id="ew_cash_chitta_id_{{$pk}}" class="xs_ip_box" value="{{$where_row['cash_chitta_id']}}" readonly />
						</td>
						<td>
							<select id="ew_table_name_{{$pk}}" class="ej_table_name lg_sel_box" data="{{$pk}}" >
								@foreach($data["tables"] as $row_table)
									<?php 
										if($row_table == $where_row["table_name"]) {
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
							<select id="ew_field_name_{{$pk}}" class="sm_sel_box">
								<option>{{$where_row["field_name"]}}</option>
							</select>
						</td>
						<td>
							<select id="ew_field_type_{{$pk}}" class="sm_sel_box">
								<?php
									$int_selected = "selected";
									$str_selected = "";
									$str_arr_selected = "";
									$float_selected = "";
									$date_selected = "";
									switch($where_row["field_type"]) {
										case "INT"	:	
													$int_selected = "selected";
													break;
										case "STR"	:	
													$str_selected = "selected";
													break;
										case "STR_ARR"	:	
													$str_arr_selected = "selected";
													break;
										case "FLOAT"	:	
													$float_selected = "selected";
													break;
										case "DATE"	:	
													$date_selected = "selected";
													break;
									}
								?>
								<option></option>
								<option {{$int_selected}}>INT</option>
								<option {{$str_selected}}>STR</option>
								<option {{$str_arr_selected}}>STR_ARR</option>
								<option {{$float_selected}}>FLOAT</option>
								<option {{$date_selected}}>DTAE</option>
							</select>
						</td>
						<td>
							<input id="ew_operator_{{$pk}}" class="sm_ip_box" value="{{$where_row["operator"]}}" />
						</td>
						<td>
							<input id="ew_field_value_{{$pk}}" value="{{$where_row["field_value"]}}" />
						</td>
						<td>
							<input id="ew_deleted_{{$pk}}" class="xs_ip_box" value="{{$where_row["deleted"]}}" />
						</td>
						<td><button class="btn-xs ew_save" data="{{$pk}}">SAVE</button></td>
					</tr>
				@endforeach
					<!--ADD JOIN-->
					<tr>
						<td>
							<input id="aw_cash_chitta_where_clause_id" class="xs_ip_box" value="0" readonly />
						</td>
						<td>
							<input id="aw_cash_chitta_id" class="xs_ip_box" value="{{$cash_chitta_id}}" readonly />
						</td>
						<td>
							<select id="aw_table_name" class="lg_sel_box">
								@foreach($data["tables"] as $row_table)
									<option>{{$row_table}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select id="aw_field_name" class="sm_sel_box">
								<option></option>
							</select>
						</td>
						<td>
							<select id="aw_field_type" class="sm_sel_box">
								<option></option>
								<option>INT</option>
								<option>STR</option>
								<option>STR_ARR</option>
								<option>FLOAT</option>
								<option>DTAE</option>
							</select>
						</td>
						<td>
							<input id="aw_operator" class="sm_ip_box" value="=" />
						</td>
						<td>
							<input id="aw_field_value" value="" />
						</td>
						<td>
							<input id="aw_deleted" value="0" class="xs_ip_box" />
						</td>
						<td><button class="btn-xs aw_save">ADD</button></td>
					</tr>
			</table>
		</div>


<script>
//SAVE EDIT WHERE
    $(".ew_save").click(function() {
		var id = $(this).attr("data");
		
        cash_chitta_where_clause_id = $("#ew_cash_chitta_where_clause_id_"+id).val();
        cash_chitta_id = $("#ew_cash_chitta_id_"+id).val();
        table_name = $("#ew_table_name_"+id).val();
        field_name = $("#ew_field_name_"+id).val();
        field_type = $("#ew_field_type_"+id).val();
        operator = $("#ew_operator_"+id).val();
        field_value = $("#ew_field_value_"+id).val();
        deleted = $("#ew_deleted_"+id).val();
		
        var fields = new Object;
        fields.cash_chitta_where_clause_id = cash_chitta_where_clause_id;
        fields.cash_chitta_id = cash_chitta_id;
        fields.table_name = table_name;
        fields.field_name = field_name;
        fields.field_type = field_type;
        fields.operator = operator;
        fields.field_value = field_value;
        fields.deleted = deleted;

		fields = JSON.stringify(fields);
        table = "cash_chitta_where_clause";
        operation = "update";
        pk = "cash_chitta_where_clause_id";
        // console.log(fields);
        save_data(table,fields,operation,pk);
    });

//SAVE ADD WHERE
    $(".aw_save").click(function() {
		// var id = $(this).attr("data");
		
        // cash_chitta_where_clause_id = $("#ew_cash_chitta_where_clause_id_"+id).val();
        cash_chitta_id = $("#aw_cash_chitta_id").val();
        table_name = $("#aw_table_name").val();
        field_name = $("#aw_field_name").val();
        field_type = $("#aw_field_type").val();
        operator = $("#aw_operator").val();
        field_value = $("#aw_field_value").val();
        deleted = $("#aw_deleted").val();
		
        var fields = new Object;
        // fields.cash_chitta_where_clause_id = cash_chitta_where_clause_id;
        fields.cash_chitta_id = cash_chitta_id;
        fields.table_name = table_name;
        fields.field_name = field_name;
        fields.field_type = field_type;
        fields.operator = operator;
        fields.field_value = field_value;
        fields.deleted = deleted;

		fields = JSON.stringify(fields);
        table = "cash_chitta_where_clause";
        operation = "insert";
        pk = "";
        // console.log(fields);
        save_data(table,fields,operation,pk);
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
    $(".ej_table_name").change(function() {
		var id = $(this).attr("data");
        var table_name = $(this).val();
        var selector_arr = ["#ew_field_name_"+id];
        get_table_fields(table_name,selector_arr);
    });
//ADD JOIN
    $("#aw_table_name").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#aw_field_name"];
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


		