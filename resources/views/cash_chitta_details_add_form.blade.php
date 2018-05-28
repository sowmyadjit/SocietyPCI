

<form id="form_add_details">
    <table>
        <tr>
            <th>prefix</th>
            <td><input id="ad_prefix" name="prefix" /></td>
        </tr>
        <tr>
            <th>table_name</th>
            <td>
                <select id="ad_table_name" name="table_name">
                    @foreach($data["tables"] as $row_table)
                        <option>{{$row_table}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>pk_field</th>
            <td>
                <select id="ad_pk_field" name="pk_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>amount_field</th>
            <td>
                <select id="ad_amount_field" name="amount_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>bid_field</th>
            <td>
                <select id="ad_bid_field" name="bid_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>date_field</th>
            <td>
                <select id="ad_date_field" name="date_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>transaction_type</th>
            <td>
                <select id="ad_transaction_type" name="transaction_type">
                    <option value="1">CREDIT</option>
                    <option value="2">DEBIT</option>
                    <option value="3">BOTH</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>transaction_type_field</th>
            <td>
                <select id="ad_transaction_type_field" name="transaction_type_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>table_containing_account_no</th>
            <td>
                <select id="ad_table_containing_account_no" name="table_containing_account_no">
                    @foreach($data["tables"] as $row_table)
                        <option>{{$row_table}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>account_no_field</th>
            <td>
                <select id="ad_account_no_field" name="account_no_field">
                    <option></option>
                </select>
            </td>
        </tr>
        <tr>
            <th>deleted</th>
            <td><input id="ad_deleted" name="deleted" value="0" /></td>
        </tr>
    </table>
    <button id="add_details" class="btn-sm">add_details</button>
</form>
 
<script>
    $("#add_details").click(function(e) {
        e.preventDefault();
            
        prefix = $("#ad_prefix").val();
        table_name = $("#ad_table_name").val();
        pk_field = $("#ad_pk_field").val();
        amount_field = $("#ad_amount_field").val();
        bid_field = $("#ad_bid_field").val();
        date_field = $("#ad_date_field").val();
        transaction_type = $("#ad_transaction_type").val();
        transaction_type_field = $("#ad_transaction_type_field").val();
        table_containing_account_no = $("#ad_table_containing_account_no").val();
        account_no_field = $("#ad_account_no_field").val();
        deleted = $("#ad_deleted").val();

        var fields = new Object;
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
        operation = "insert";
        pk = "";
        // console.log(fields);
        save_data(table,fields,operation,pk);
        $(".refresh").trigger("click");
    });

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