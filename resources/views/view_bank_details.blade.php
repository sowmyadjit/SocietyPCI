<div>
	<table class="table table-striped bootstrap-datatable datatable responsive">
		<thead>
			<tr>
				<th> Bank ID </th>
				<th> Bank Name </th>
				<th> Branch </th>
				<th> IFSC </th>
				<th> Account No. </th>
				<th> Balance </th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $row) 
				<tr>
					<td> {{$row->Bankid}} </td>
					<td> {{$row->BankName}} </td>
					<td> {{$row->Branch}} </td>
					<td> {{$row->AddBank_IFSC}} </td>
					<td> {{$row->AccountNo}} </td>
					<td> {{$row->TotalAmt}} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>