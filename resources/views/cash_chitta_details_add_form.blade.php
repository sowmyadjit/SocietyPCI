

<form id="form_add_details">
    <table>
        <tr>
            <th>prefix</th>
            <td><input name="prefix" /></td>
        </tr>
        <tr>
            <th>table_name</th>
            <td>
                <select id="ad_table_name">
                    @foreach($data["tables"] as $row_table)
                        <option>{{$row_table}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>pk_field</th>
            <td>
                <select id="ad_pk_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>amount_field</th>
            <td>
                <select id="ad_amount_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>bid_field</th>
            <td>
                <select id="ad_bid_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>date_field</th>
            <td>
                <select id="ad_date_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>transaction_type</th>
            <td>
                <select>
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>transaction_type_field</th>
            <td>
                <select id="ad_transaction_type_field">
                    <option value="1">CREDIT</option>
                    <option value="2">DEBIT</option>
                    <option value="3">BOTH</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>table_containing_account_no</th>
            <td>
                <select id="ad_table_containing_account_no">
                    @foreach($data["tables"] as $row_table)
                        <option>{{$row_table}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>account_no_field</th>
            <td>
                <select id="ad_account_no_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>deleted</th>
            <td><input name="deleted" value="0" /></td>
        </tr>
    </table>
    <button id="add_details" class="btn-sm">add_details</button>
</form>
 
<script>
    $("#add_details").click(function(e) {
        e.preventDefault();
        form_data = $("#form_add_details").serialize();
        var flag = "add_details";
        $(".add").click(function() {
            $.ajax({
                url : "cash_chitta_details_edit",
                type : "post",
                data : form_data,
                success : function(data) {
                    console.log("add_details: done");
                }
            });
        });
        
    });
</script>

<script>
    $("#ad_table_name").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#ad_pk_field","#ad_amount_field","#ad_bid_field","#ad_date_field","#ad_transaction_type_field"];
        get_table_fields(table_name,selector_arr);
    });
    $("#ad_table_containing_account_no").change(function() {
        var table_name = $(this).val();
        var selector_arr = ["#ad_account_no_field"];
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