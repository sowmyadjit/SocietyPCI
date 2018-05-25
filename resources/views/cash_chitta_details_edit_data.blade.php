				
		<?php
			$row = $data["chitta"][0];
		?>
		<div id="ed_box">
			<table>
				<tr>
					<th>cash_chitta_id</th>
					<td><input id="ed_cash_chitta_id" value="{{$row['cash_chitta_id']}}" readonly /></td>
				</tr>
				<tr>
					<th>prefix</th>
					<td><input id="ed_prefix" name="prefix" value="" /></td>
				</tr>
				<tr>
					<th>table_name</th>
					<td>
						<select id="ed_table_name" name="table_name">
							@foreach($data["tables"] as $row_table)
								<?php 
									if($row_table == $row['table_name']) {
										$selected = "selected";
									} else {
										$selected = "";
									}
								?>
								<option {{$selected}}>{{$row_table}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<th>pk_field</th>
					<td>
						<select id="ed_pk_field" name="pk_field">
							<option>{{$row["pk_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>amount_field</th>
					<td>
						<select id="ed_amount_field" name="amount_field">
							<option>{{$row["amount_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>bid_field</th>
					<td>
						<select id="ed_bid_field" name="bid_field">
							<option>{{$row["bid_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>date_field</th>
					<td>
						<select id="ed_date_field" name="date_field">
							<option>{{$row["date_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>transaction_type</th>
					<td>
						<select id="ed_transaction_type" name="transaction_type">
						<?php
							switch($row["transaction_type"]) {
								case 1 :	
											$cr_selected = "selected";
											$db_selected = "";
											$both_selected = "";
											break;
								case 2 :	
											$cr_selected = "";
											$db_selected = "selected";
											$both_selected = "";
											break;
								case 3 :	
											$cr_selected = "";
											$db_selected = "";
											$both_selected = "selected";
											break;
							}
						?>
							<option {{$cr_selected}} value="1">CREDIT</option>
							<option {{$db_selected}} value="2">DEBIT</option>
							<option {{$both_selected}} value="3">BOTH</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>transaction_type_field</th>
					<td>
						<select id="ed_transaction_type_field" name="transaction_type_field">
							<option>{{$row["transaction_type_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>table_containing_account_no</th>
					<td>
						<select id="ed_table_containing_account_no" name="table_containing_account_no">
							@foreach($data["tables"] as $row_table)
								<?php 
									if($row_table == $row['table_name']) {
										$selected = "selected";
									} else {
										$selected = "";
									}
								?>
								<option>{{$row_table}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<th>account_no_field</th>
					<td>
						<select id="ed_account_no_field" name="account_no_field">
							<option>{{$row["account_no_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>deleted</th>
					<td><input id="ed_deleted" name="deleted" value="0" /></td>
				</tr>
			</table>

			<button class="btn-xs cancel" id="ed_cancel">cancel</button>
		</div>
				
	<script>
		$("#ed_cancel").click(function() {
			$("#ed_box").remove();
		});
	</script>

	<script>
		$("#").change();
	</script>

<script>
    $("#ed_table_name").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#ed_pk_field","#ed_amount_field","#ed_bid_field","#ed_date_field","#ed_transaction_type_field"];
        get_table_fields(table_name,selector_arr);
    });
    $("#ed_table_containing_account_no").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#ed_account_no_field"];
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
