				
		<?php
			$row = $data["chitta"][0];
			$pk = $row["cash_chitta_id"];
		?>
		<div id="ed_box">
			<table>
				<tr>
					<th>cash_chitta_id</th>
					<td><input id="ed_cash_chitta_id_{{$pk}}" value="{{$row['cash_chitta_id']}}" readonly /></td>
				</tr>
				<tr>
					<th>prefix</th>
					<td><input id="ed_prefix_{{$pk}}" name="prefix" value="" /></td>
				</tr>
				<tr>
					<th>table_name</th>
					<td>
						<select id="ed_table_name_{{$pk}}" name="table_name">
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
						<select id="ed_pk_field_{{$pk}}" name="pk_field">
							<option>{{$row["pk_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>amount_field</th>
					<td>
						<select id="ed_amount_field_{{$pk}}" name="amount_field">
							<option>{{$row["amount_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>bid_field</th>
					<td>
						<select id="ed_bid_field_{{$pk}}" name="bid_field">
							<option>{{$row["bid_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>date_field</th>
					<td>
						<select id="ed_date_field_{{$pk}}" name="date_field">
							<option>{{$row["date_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>transaction_type</th>
					<td>
						<select id="ed_transaction_type_{{$pk}}" name="transaction_type">
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
						<select id="ed_transaction_type_field_{{$pk}}" name="transaction_type_field">
							<option>{{$row["transaction_type_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>table_containing_account_no</th>
					<td>
						<select id="ed_table_containing_account_no_{{$pk}}" name="table_containing_account_no">
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
						<select id="ed_account_no_field_{{$pk}}" name="account_no_field">
							<option>{{$row["account_no_field"]}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>deleted</th>
					<td><input id="ed_deleted_{{$pk}}" name="deleted" value="0" /></td>
				</tr>
			</table>

			<button class="btn-xs" class="ed_save" data="{{$pk}}">SAVE</button>
		</div>

<script>
//SAVE CHITTA DETAILS
	
$(".ed_save").click(function() {
		var id = $(this).attr("data");
		
        cash_chitta_id = $("#ed_cash_chitta_id_"+id).val();
        prefix = $("#ed_prefix_"+id).val();
        table_name = $("#ed_table_name_"+id).val();
        pk_field = $("#ed_pk_field_"+id).val();
        amount_field = $("#ed_amount_field_"+id).val();
        bid_field = $("#ed_bid_field_"+id).val();
        date_field = $("#ed_date_field_"+id).val();
        transaction_type = $("#ed_transaction_type_"+id).val();
        transaction_type_field = $("#ed_transaction_type_field_"+id).val();
        table_containing_account_no = $("#ed_table_containing_account_no_"+id).val();
        account_no_field = $("#ed_account_no_field_"+id).val();
        deleted = $("#ed_deleted_"+id).val();
		
        var fields = new Object;
        fields.cash_chitta_id = cash_chitta_id;
        fields.prefix = prefix;
        fields.table_name = table_name;
        fields.pk_field = pk_field;
        fields.amount_field = amount_field;
        fields.bid_field = bid_field;
        fields.date_field = date_field;
        fields.transaction_type = transaction_type;
        fields.transaction_type_field = transaction_type_field;
        fields.table_containing_account_no = table_containing_account_no;
        fields.account_no_field = account_no_field;
        fields.deleted = deleted;

		fields = JSON.stringify(fields);
		table = "cash_chitta_details";
		operation = "update";
		pk = "cash_chitta_id";
		// console.log(fields);
		save_data(table,fields,operation,pk);
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
