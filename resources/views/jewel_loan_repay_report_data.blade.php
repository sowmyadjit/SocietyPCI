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
                <td>
					{{$data["allocation_details"]["end_date"]}}
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
						<button type="button" class="btn btn-primary btn-sm btn_edit" data-toggle="modal" data-target="#modal_repay_edit" data="{{$row_repay["repayment_id"]}}">
						  <span class="glyphicon glyphicon-pencil" ></span>
						</button>
						<button type="button" class="btn btn-primary btn-sm btn_edit ReceiptPrint" href="DLReceipt">
						  Print
						</button>
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
				$('.box-inner').load($(this).attr('href'));
			});
</script>
