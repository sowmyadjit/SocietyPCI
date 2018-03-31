<?php
	$type=$in_data["type"]
?>
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
<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive bootstrapTable" id="excel_export">
	<thead>
		<tr>
			<th>
				Date
			</th>
		<?php if($type=="PIGMY"){ ?>
			<th>
				Old Account Number
			</th>
		<?php } ?>
			<th>
				Account Number
			</th>
			<th>
				Service Charge Amount
			</th>
			<th>
				last_transaction_date
			</th>
		<?php if($type=="PIGMY"){	?>
			<th>
				Agent Name
			</th>
		<?php } ?>
		</tr>
	</thead>
	<tbody>
		@foreach ($return_data as $data)
			<tr>
				<td>
					{{$data->date}}
				</td>
		<?php 	if($type=="PIGMY"){ ?>
				<td>
				{{$data->old_acc_no}}
				</td>
		<?php } ?>
				<td>
					{{$data->acc_no}}
				</td>
				<td>
					{{$data->service_charge_amount}}
				</td>
				<td>
					{{$data->last_transaction_date}}
				</td>
		<?php	if($type=="PIGMY"){ ?>
				<td>
				{{$data->FirstName}} {{$data->MiddleName}} {{$data->LastName}}
				</td>
		<?php } ?>
			</tr>
		@endforeach
		<tr>
			<td colspan="3" >Service Charge Total</td>
			<td colspan="3" >{{$in_data["total_amount"]}}</td>
		</tr>
	</tbody>
	
</table>
<button class="btn btn-info btn-sm" id="Create">Create</button>
</div>
</div>
</div>
<script>
$( document).ready(function(){
	if($type=='PIGMY'){
	
	}
	
});
$('#excel').click(function(e){
	$('#excel_export').tableExport({type:'excel',escape:'false'});
});		
</script>
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
