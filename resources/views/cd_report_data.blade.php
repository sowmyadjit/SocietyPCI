


							<h5>FROM :{{$data["from_date"]}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TO : {{$data["to_date"]}}</h5>
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table" id="cd_report_table">
								<thead>
									<tr>
										<th>DATE</th>
										<th>Name</th>
										<th>CD ACCOUNT</th>
										<th>CD TYPE</th>
										<th>CD AMOUNT</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($data['det'] as $row)
										<tr>
											<td>{{ $row->CD_Date }}</td>
											<td><span  class="details_link"> {{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }} </span></td>
											<td>{{ $row->CD_Account }}</td>
											<td>{{ $row->CD_Type }}</td>
											<td>{{ $row->CD_Amount }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>