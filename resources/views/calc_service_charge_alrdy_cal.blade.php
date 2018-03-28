<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
<script src="js/bootstrap-table.js"/>
<script src="js/FileSaver.js"/>			
<script src="js/tableExport.js"/>			
<script src="js/jquery.base64.js"/>			
<script src="js/sprintf.js"/>
<script src="js/jspdf.js"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
							
<script src="js/bootstrap-table-export.js"/>
<link href="css/bootstrap-table.css" rel='stylesheet' type="text/css" media="all">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive bootstrapTable">
	<thead>
		<tr>
			<th>
				Date
			</th>
			<th>
				Account Number
			</th>
			<th>
				Service Charge Amount
			</th>
			<th>
				last_transaction_date
			</th>
			<th>
				charge_collected
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($return_data as $data)
			<tr>
				<td>
					{{$data->service_charge_date}}
				</td>
				<td>
					{{$data->service_charge_amount}}
				</td>
				<td>
					{{$data->last_transaction_date}}
				</td>
				<td>
					{{$data->charge_collected}}
				</td>
			</tr>
		@endforeach
	</tbody>
	
</table>
</div>
</div>
</div>
