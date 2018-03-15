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
                    Sancation Amount
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
					</td>
					<td>
						{{$row_repay["repayment_paid_principle_amount"]}}
					</td>
					<td>
						{{$row_repay["repayment_paid_interest_amount"]}}
					</td>
					<td>
						{{$row_repay["charges_sum"]}}
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
