
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="export_table">
	<thead>
		<tr>
			<th>Branch ID</th>
			<th>Branch Name</th>
			<th>Member No.</th>
			<th>Member Name</th>
			<th>Share Class</th>
			<th>No. of Share</th>
			<th>Share Amt</th>
			<th>Total Amount</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@foreach($data["share"] as $row)
				<tr>
					<td>{{$row->Bid}}</td>
					<td>{{$row->BName}}</td>
					<td>{{$row->Member_no}}</td>
					<td>{{$row->FirstName}}{{$row->MiddleName}}{{$row->LastName}}</td>
					<td>{{$row->PURSH_Shrclass}}</td>
					<td>{{$row->PURSH_Noofshares}}</td>
					<td>{{$row->PURSH_Shareamt}}</td>
					<td>{{$row->PURSH_Totalamt}}</td>
				</tr>
			@endforeach
		</tr>
	</tbody>
</table>