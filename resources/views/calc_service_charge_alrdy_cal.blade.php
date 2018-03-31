

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
		</tr>
	</thead>
	<tbody>
		@foreach ($return_data as $data)
			<tr>
				<td>
					{{$data->date}}
				</td>
				<td>
					{{$data->acc_no}}
				</td>
				<td>
					{{$data->service_charge_amount}}
				</td>
				<td>
					{{$data->last_transaction_date}}
				</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="2" >Service Charge Total</td>
			<td colspan="2" >{{$in_data["total_amount"]}}</td>
		</tr>
	</tbody>
	
</table>
<button class="btn btn-info btn-sm" id="Create">Create</button>
</div>
</div>
</div>


<script>
$("#Create").click(function(){
	x = confirm("Are You Sure ?");
	var type = "{{$in_data["type"]}}";
	if(x)
	{
		$.ajax({
			url: 'create_service_charge',
			type: 'post',
			data:'&type='+type,
			success: function(data) {
				alert('success');
				//$('.bankclassid').click();
			}
		});
	}
});
</script>
