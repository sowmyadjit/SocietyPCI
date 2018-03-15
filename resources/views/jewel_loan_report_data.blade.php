<?php
	$i = 0;
?>
<script src="js/FileSaver.js"/>			
<script src="js/tableExport.js"/>


<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php //echo $data['module']->Mid; ?> box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>JEWEL LOAN REPORT</h2>
				</div>

				<div class="box-content">
					<div class="alert alert-info">
					<?php /*<a  class="btn btn-default export <?php //echo $data['module']->Mid; ?>">Export</a>*/?>
								
							<div class="row table-row">
								<button class="btn btn-info pull-right" id="btn_excel">EXCEL</button>
							</div>
					</div>

					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="export_table">
						<thead>
							<tr>
								<th>SERIAL NO.</th>
								<th>LOAN NO.</th>
								<th>USER ID</th>
								<th>NAME</th>
								<th>BRANCH</th>
								<th>LOAN AMOUNT</th>
								<th>REPAID PRINCIPLE AMT</th>
								<th>REPAID INTEREST AMT</th>
								<th>REMAINING AMOUNT</th>
								<th>LAST PAID DATE</th>
								<th>NO. OF DAYS FROM LAST PAID DATE</th>
								<th>LOAN CLOSED?</th>
								<th>INTEREST RATE</th>
								<th>JEWEL DESCRIPTION</th>
								<th>JEWEL GROSS WEIGHT</th>
								<th>JEWEL NET WEIGHT</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data["report_data"] as $row)
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $row->JewelLoan_LoanNumber }}</td>
									<td>{{ $row->JewelLoan_Uid }}</td>
									<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
									<td>{{ $row->BName }}</td>
									<td>{{ $row->JewelLoan_LoanAmount }}</td>
									<td>{{ $row->principle_paid }}</td>
									<td>{{ $row->interest_paid }}</td>
									<td>{{ $row->JewelLoan_LoanRemainingAmount }}</td>
									<td>{{ $row->JewelLoan_lastpaiddate }}</td>
									<td>{{ $row->no_days_from_last_pay }}</td>
									<td>{{ $row->JewelLoan_Closed }}</td>
									<td>{{ $row->LoanType_Interest }}</td>
									<td>{{ $row->jewelloan_Description }}</td>
									<td>{{ $row->jewelloan_Gross_weight }}</td>
									<td>{{ $row->jewelloan_Net_weight }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#btn_excel").click(function() {
		console.log("exporting to excel");
		$("#export_table").tableExport({
			bootstrap: false
		});
	});
</script>