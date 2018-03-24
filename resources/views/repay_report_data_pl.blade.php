<?php
	$loan_allocation_id = $data["allocation_details"]["loan_allocation_id"];
?>
<style type="text/css" >
	
	[id^='charges_sum_'] {
		color: rgba(0,0,200,1);
	}
	
	[id^='charges_sum_']:hover {
		cursor: pointer;
	}
	.emi_width{
	width:360px;
	}
</style>

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
                    Member No :
                </th>
                <td>
					{{$data["customer_details"]["member_no"]}}
                </td>
				<th>
                </th>
                <td>
                </td>
			</tr>
            <tr>
                <th>
                    Guarantor :
                </th>
                <td>
					{{$data["customer_details"]["guarantor_name"]}}
                </td>
                <th>
                    Guarantor Ph No:
                </th>
                <td>
					{{$data["customer_details"]["guarantor_mobile"]}}
                </td>
            </tr>
			<tr>
                <th>
                    Guarantor Address:
                </th>
                <td  colspan="3">
					{{$data["customer_details"]["guarantor_address"]}}
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
                    EMI Amount
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
					{{$data["allocation_details"]["emi"]}}
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
		
		<h2>Repayment Details</h2> 
        <div id="repayment_details_table">			   
<?php
	$principle_balance_amount = $data["allocation_details"]["sanctioned_amount"];
?>
			
			<table class="table table-striped bootstrap-datatable datatable responsive">
			<thead style="display:block;">
				<tr>
					<th style="width: 85px;">
						Serial No.
					</th>
					<th style="width: 90px;">
						Date
					</th>
					<th style="width: 150px;">
						Principal Amount
					</th>
					<th style="width: 150px;">
						Interest Paid Till
					</th>
					<th style="width: 150px;">
						Interest
					</th>
					<th style="width: 150px;">
						Charges
					</th>
					<th style="width: 150px;">
						Principle Balance
					</th>
				</tr>
			</thead>
			<tbody style="display:block;max-height:200px;overflow-y: auto;overflow-x: hidden;">
				<?php $i = 0; ?>
				@foreach($data["repayments"] as $key_repay => $row_repay)
					<tr>
						<td style="width: 85px;">
							{{++$i}}
						</td>
						<td style="width: 90px;">
							<span id="repay_dtae_{{$row_repay["repayment_id"]}}">{{$row_repay["repayment_date"]}}</span>
						</td>
						<td style="width: 150px;">
							<span id="principle_amount_{{$row_repay["repayment_id"]}}">{{$row_repay["repayment_paid_principle_amount"]}}</span>
						</td>
						<td style="width: 150px;">
							<span id="interest_paid_till_{{$row_repay["repayment_id"]}}">{{$row_repay["interest_paid_upto"]}}</span>
						</td>
						<td style="width: 150px;">
							<span id="interest_amount_{{$row_repay["repayment_id"]}}">{{$row_repay["repayment_paid_interest_amount"]}}</span>
						</td>
						<td style="width: 150px;">
							<span id="charges_sum_{{$row_repay["repayment_id"]}}" data-toggle="modal" data-target="#modal_charges_transaction">
								{{$row_repay["charges_sum"]}}
							</span>
						</td>
						<?php 
							$principle_balance_amount -= $row_repay["repayment_paid_principle_amount"];
						?>
						<td style="width: 150px;">
							{{$principle_balance_amount}}
						</td>
						<td>
							<button type="button" class="btn btn-primary btn-sm btn_edit" data-toggle="modal" data-target="#modal_repay_edit" data="{{$row_repay["repayment_id"]}}">
							  <span class="glyphicon glyphicon-pencil" ></span>
							</button>
							<button type="button" class="btn btn-primary btn-sm btn_edit ReceiptPrint" href="Receipt">
								Print
							</button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<table>
				<tr>
					<th>Total :</th>
					<td>{{$data["allocation_details"]["sanctioned_amount"]}}</td>
					<th>Balance :</th>
					<td>{{$data["allocation_details"]["balance"]}}</td>
				<tr>
				</tr>
			</table>
        </div>
		
		
		
		
        <div>
			<h2>EMI Details</h2>  
			<div id="emi_details_table">
				<table class="table table-striped bootstrap-datatable datatable responsive">
				<thead style="display:block;">
					<tr>
						<th class='emi_width'>
							Installment no.
						</th>
						<th class='emi_width'>
							Date
						</th>
						<th class='emi_width'>
							Paid EMI
						</th>
					</tr>
				</thead>
					<tbody style="display:block;max-height:200px;overflow-y: auto;overflow-x: hidden;">
					<?php
						$emi = $data["allocation_details"]["emi"];
						$repay_principle_sum = $data["allocation_details"]["repay_principle_sum"];
						$start_date = $data["allocation_details"]["start_date"];
						$end_date = $data["allocation_details"]["end_date"];
						
						$temp_date = $start_date;
						$temp_arr = explode("-",$temp_date);
						$temp_d = $temp_arr[2];
						$temp_m = $temp_arr[1];
						$temp_y = $temp_arr[0];
						$installment_no = 0;
						
						while($temp_date < $end_date) {
							++$installment_no;
							$temp_m++;
							if($temp_m == 13) {
								$temp_m = 1;
								$temp_y++;
							}
							$temp_time_string = "{$temp_y}-{$temp_m}-{$temp_d}";
							$temp_date = date("Y-m-d",strtotime($temp_time_string));
							
							if($repay_principle_sum > $emi) {
								$paid_emi = $emi;
								$repay_principle_sum -= $emi;
							} else {
								$paid_emi = $repay_principle_sum;
								$repay_principle_sum = 0;
							}
							
							echo "<tr>
									<td class='emi_width'>{$installment_no}</td>
									<td class='emi_width'>{$temp_date}</td>
									<td class='emi_width'>{$paid_emi}</td>
								</tr>";
						}
							
						
						
					?>
					</tbody>
				</table>
			</div>
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
			<label class="control-label col-sm-4" for="modal_interest_paid_till">Interest Paid Till:</label>
			<div class="col-md-4">
				<input type="text" class="form-control datepicker" id="modal_interest_paid_till" name="modal_interest_paid_till" placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" autofocus>
			</div>
		</div>
		<div class="form-group ">
			<label class="control-label col-sm-4" for="modal_principle_amount">Principle Amount:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" id="modal_principle_amount" name="modal_principle_amount" >
			</div>
		</div>
		<div class="form-group ">
			<label class="control-label col-sm-4" for="modal_interest_amount">Interest Amount:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" id="modal_interest_amount" name="modal_interest_amount" >
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
<!-- Modal End -->

<!-- Modal charges tran-->
<div class="modal fade" id="modal_charges_transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CHARGES TRANSACTIONS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div id="charges_transaction_report"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal charges tran End -->


<script>
	$(".btn_edit").click(function() {
		var repay_id = $(this).attr("data");
		console.log("repay_id="+repay_id);
		var int_date = $("#interest_paid_till_"+repay_id).html();
		var principle_amount = $("#principle_amount_"+repay_id).html();
		var interest_amount = $("#interest_amount_"+repay_id).html();
		console.log(int_date);
		if(int_date != "0000-00-00") {
			$("#modal_interest_paid_till").val(int_date);
		} else {
			$("#modal_interest_paid_till").val("");
		}
		$("#modal_principle_amount").val(principle_amount);
		$("#modal_interest_amount").val(interest_amount);
		
		$("#store_repay_id").val(repay_id);
	});
</script>
<script>
	$("#button_save").click(function() {
		console.log("save");
		
		var loan_type = "PL";
		var repay_id = $("#store_repay_id").val();
		var int_date = $("#modal_interest_paid_till").val();
		var principle_amount = $("#modal_principle_amount").val();
		var interest_amount = $("#modal_interest_amount").val();
		
		$.ajax({
			url:"save_repay_data",
			type:"post",
			data:"&loan_type="+loan_type+"&repay_id="+repay_id+"&int_date="+int_date+"&principle_amount="+principle_amount+"&interest_amount="+interest_amount,
			success: function() {
				console.log("save_repay_data: done");
				$("#interest_paid_till_"+repay_id).html(int_date);
				$("#principle_amount_"+repay_id).html(principle_amount);
				$("#interest_amount_"+repay_id).html(interest_amount);
				interest_calc_pl();
			}
		});
		
	});
</script>

<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
	$("#repayment_details_table").change(function() {
		//$("#").val("0");
	});
</script>

<script>
/*********** CHARGES TRANSACTIONS************/
	$("[id^='charges_sum_']").click(function() {
		
		var this_id = $(this).attr("id");
		var prefix = "charges_sum_";
		var prefix_length = prefix.length;
		var repay_id = this_id.substr(prefix_length);
		var charges_date = $("#repay_dtae_"+repay_id).html();
		var loan_category = "PL";
		var loan_allocation_id = {{$loan_allocation_id}};
		
		$.ajax({
			url:"charges_transaction_report",
			type:"post",
			data:"&loan_allocation_id="+loan_allocation_id+"&loan_category="+loan_category+"&charges_date="+charges_date,
			success: function(data) {
				console.log("charges_transaction_report: done");
				$("#charges_transaction_report").html(data);
			}
		});
		
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