<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>


<div>
        <link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
        <link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
        <div>
            <h2>Customer Details</h2>    
        <table class="table table-striped bootstrap-datatable datatable responsive">
            <tr>
                <th>
                    Customer Name:
                </th>
                <td>
					{{$data["customer_details"]["name"]}}
                </td>
                <th>
                    Customer ID:
                </th>
                <td>
					{{$data["customer_details"]["user_id"]}}
                </td>
            </tr>
            <tr>
                <th>
                    Customer Address:
                </th>
                <td>
					{{$data["customer_details"]["address"]}}
                </td>
                <th>
                    Customer Ph No:
                </th>
                <td>
                    {{$data["customer_details"]["mobile"]}}
                </td>
            </tr>
            <tr>
                <th>
                    Guarantor :
                </th>
                <td>
                    {{$data["customer_details"]["guarantor"]}}
                </td>
                <th>
                    Guarantor Ph No:
                </th>
                <td>
                    {{$data["customer_details"]["guarantor_mobile"]}}
                </td>
            </tr>
        </table>
        </div>
        <div>
                <h2>Allocation Details</h2>    
        <table class="table table-striped bootstrap-datatable datatable responsive">
            <tr>
 <?php /*               <th>
                    Request Date
                </th>*/?>
                <th>
                    Start Date
                </th>
                <th>
                    Sanction Amount
                </th>
                <th>
                    Due Date
                </th>
                <th>
                    Interest Rate
                </th>
                <th>
                    Post Due Date Interest Rate
                </th>
            </tr>
            <tr>
<?php /*                <td>
					{{$data["allocation_details"]["request_date"]}}
                </td>*/?>
                <td>
					{{$data["allocation_details"]["start_date"]}}
                </td>
                <td>
					{{$data["allocation_details"]["sanctioned_amount"]}}
                </td>
                <td style="user-select: none;">
					<div id="div_end_date">
                        {{$data["allocation_details"]["end_date"]}}
                        <button id="btn_edit_end_date" class="btn btn-xs glyphicon glyphicon-pencil blue"></button>
                    </div>
                    <div id="edit_box_end_date" style="display: inline-flex;" >
                        <input id="input_end_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" value="{{$data['allocation_details']['end_date']}}" />
                        <button id="btn_save_end_date" class="btn btn-sm glyphicon glyphicon-ok green" title="save" style="margin-left: 5px;" ></button>
                        <button id="btn_cancel_end_date" class="btn btn-sm glyphicon glyphicon-remove red" title="cancel" style="margin-left: 5px;" ></button>
                    </div>
                </td>
                <td>
					{{$data["allocation_details"]["interest_rate"]}}
                </td>
                <td>
					{{$data["allocation_details"]["post_due_date_interest_rate"]}}
                </td>
            </tr>
        </table>
        </div>
        <div>
        <h2>Repayment Details</h2>    
        <table class="table table-striped bootstrap-datatable datatable responsive">
            <tr>
                <th>
                    Serial No.
                </th>
                <th>
                    Date
                </th>
                <th>
                    Principal Amount
                </th>
                <th>
                    Interest Paid Till
                </th>
                <th>
                    Interest
                </th>
                <th>
                    Charges
                </th>
  <?php /*              <th>
                    Paid Upto
                </th>*/?>
                <th></th>
            </tr>
			<?php $i = 0; ?>
			@foreach($data["repayments"] as $key_repay => $row_repay)
				<tr>
					<td>
						{{++$i}}
					</td>
					<td>
						{{$row_repay["repayment_date"]}}
					<td>
						{{$row_repay["repayment_paid_principle_amount"]}}
					</td>
					<td >
						<span id="interest_paid_till_{{$row_repay["repayment_id"]}}">{{$row_repay["paid_up_to"]}}</span>
					</td>
					<td>
						{{$row_repay["repayment_paid_interest_amount"]}}
					</td>
					<td>
						{{$row_repay["charges_sum"]}}
					</td>
					<td>
                        @if($data["loan_category"] == "JL")
                            <button type="button" class="btn btn-primary btn-sm btn_edit" data-toggle="modal" data-target="#modal_repay_edit" data="{{$row_repay["repayment_id"]}}">
                            <span class="glyphicon glyphicon-pencil" ></span>
                            </button>

                            <button type="button" class="btn btn-primary btn-sm btn_edit ReceiptPrint" href="Receipt">
                            Print
                            </button>
                        @endif
					</td>
<?php /*					<td>
						{{$row_repay["paid_up_to"]}}
					</td>*/?>
				</tr>
			@endforeach
        </table>
        <table>
            <tr>
                <th>Total :</th>
                <td>{{$data["allocation_details"]["sanctioned_amount"]}}</td>
                <th>Balance :</th>
                <td>{{$data["allocation_details"]["balance"]}}</td>
            <tr>
 <?php /*               <th>Balance Interest :</th>
                <td>--</td>*/?>
            </tr>
        </table>
        </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_repay_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDIT REPAYMENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
		<div class="form-group ">
			<input class="hidden" id="store_repay_id" value=""/>
			<label class="control-label col-sm-4" for="first_name">Interest Paid Till:</label>
			<div class="col-md-4">
				<input type="text" class="form-control datepicker" id="modal_interest_paid_till" name="modal_interest_paid_till" placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd">
			</div>
		</div>
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="button_save" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(".btn_edit").click(function() {
		var repay_id = $(this).attr("data");
		console.log("repay_id="+repay_id);
		var int_date = $("#interest_paid_till_"+repay_id).html();
		console.log(int_date);
		if(int_date != "0000-00-00") {
			$("#modal_interest_paid_till").val(int_date);
		} else {
			$("#modal_interest_paid_till").val("");
		}
		$("#store_repay_id").val(repay_id);
	});
</script>
<script>
	$("#button_save").click(function() {
		console.log("save");
		
		var repay_id,int_date,loan_type;
		loan_type = "JL";
		repay_id = $("#store_repay_id").val();
		int_date = $("#modal_interest_paid_till").val();
		
		$.ajax({
			url:"save_repay_data",
			type:"post",
			data:"&loan_type="+loan_type+"&repay_id="+repay_id+"&int_date="+int_date,
			success: function() {
				console.log("save_repay_data: done");
				$("#interest_paid_till_"+repay_id).html(int_date);
			}
		});
		
	});
</script>

<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	$('.ReceiptPrint').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				//$('.box-inner').load($(this).attr('href'));
				$('.box-inner').hide();
				$('.receipt_print').show();
				$('.receipt_print').load($(this).attr('href'));
			});
</script>

<script>
    hide_edit_box_end_date();
	$('#btn_edit_end_date').click(function(e){
        e.preventDefault();
        show_edit_box_end_date();
	});

	$('#btn_save_end_date').click(function(e){
        e.preventDefault();
        // console.log("ok");
        // var loan_category = "JL";
        var loan_category = <?php echo "'{$data['loan_category']}'";?>;
        if(loan_category == "JL") {
            var loan_id = $(".JLAccNumTypeAhead").attr("data-value");
            var refresh_btn_id = "refresh_jl";
        } else if(loan_category == "SL") {
            var loan_id = $(".SLAccNumTypeAhead").attr("data-value");
            var refresh_btn_id = "refresh_sl";
        } else if(loan_category == "DL") {
            var dl_type = $("#dl").val();
            // console.log("dl_type: "+ dl_type);
            switch(dl_type) {
                case "pygmy DL" :
                    var loan_id = $(".PygmyAccNumTypeAhead").attr("data-value");
                    var refresh_btn_id = "refresh_dl_pg";
                case "RD DL" :
                    var loan_id = $(".RDAccNumTypeAhead").attr("data-value");
                    var refresh_btn_id = "refresh_dl_rd";
                case "FD DL" :
                    var loan_id = $(".FDAccNumTypeAhead").attr("data-value");
                    var refresh_btn_id = "refresh_dl_fd";
            }
        }
        var loan_end_date = $("#input_end_date").val();

		$.ajax({
			url:"save_loan_end_date",
			type:"post",
			data:"loan_category="+loan_category+"&loan_id="+loan_id+"&loan_end_date="+loan_end_date,
			success: function() {
				console.log("done");
                hide_edit_box_end_date();
                $("#"+refresh_btn_id).trigger("click");
                setTimeout(() => {
                    alert("SUCCESS");
                }, 2000);
			}
		});

	});

	$('#btn_cancel_end_date').click(function(e){
        e.preventDefault();
        hide_edit_box_end_date();
	});

    function show_edit_box_end_date() {
	    $('#div_end_date').hide();
	    $('#edit_box_end_date').show();
    }

    function hide_edit_box_end_date() {
	    $('#div_end_date').show();
	    $('#edit_box_end_date').hide();
    }
</script>
