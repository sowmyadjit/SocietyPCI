
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>Customer Name</th>
			<th>Account Number</th>
			<th>Pigmy Type</th>
			<th>Paid Date</th>
<?php /*	<th>RECEIPT</th> /*/?>
		</tr>
	</thead>
	
	<tbody>
		<?php
			$i = 0;
		?>
		@foreach ($PayAmount['data'] as $PAmt)
			<tr>
				<td>{{++$i}}</td>
		<?php /*<td class="hidden">{{ $PAmt->PayId }}</td> */ ?>
				<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
				<td>{{ $PAmt->PayAmount_PigmiAccNum }}</td>
				<td>{{ $PAmt->Pigmi_Type }}</td>
				<td><?php $paydate=date("d-m-Y",strtotime($PAmt->PayAmountReport_PayDate)); echo $paydate;?></td>
<?php /*				<td>
					<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $PayAmount['module']->Mid; ?>" href="PigmyPayAmountReceipt/{{ $PAmt->PayId }}"/>
				</td>*/?>
			</tr>
		@endforeach
	</tbody>
</table>


<script>
</script>