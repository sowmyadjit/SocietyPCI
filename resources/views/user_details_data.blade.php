<div>
	<div style="padding:15px;">
		<h2>Customer Details</h2>    
		<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;" id="customer">
			<tr>
				<th style="width:20%;text-align: left;">
					Customer Name:
				</th>
				<td id="customer_name" style="width:30%;text-align: left;">
					{{$return_data->FirstName}}
				</td>
				<th style="width:20%;text-align: left;">
					Customer ID:
				</th>
				<td  style="width:30%;text-align: left;">
					{{$return_data->Uid}}
				</td>
			</tr>
			<tr>
				<th style="width:20%;text-align: left;">
					Customer Address:
				</th>
				<td id="customer_address" style="width:30%;text-align: left;">
					{{$return_data->Address}}
				</td>
				<th style="width:20%;text-align: left;">
					Customer Ph No:
				</th>
				<td id="customer_phone_no" style="width:30%;text-align: left;">
					{{$return_data->PhoneNo}}
				</td>
			</tr>
		</table>
	</div>
</div>