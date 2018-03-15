


							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table" id="cd_report_table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Sub head id</th>
										<th>Table Name</th>
										<th>Amount Field</th>
										<th>Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($data['det'] as $row)
										<tr>
											<td>{{ $row->TableAndFiled_Id }}</td>
											<td>{{ $row->TableAndFiled_Lid }} - {{$row->lname}}</td>
											<td>{{ $row->TableAndFiled_TableName }}</td>
											<td>{{ $row->TableAndFiled_Amount }}</td>
											<td>{{ $row->Type }}</td>
											<td><button class="btn btn-info btn-sm edit" data="{{$row->TableAndFiled_Id}}">EDIT</button></td>
										</tr>
									@endforeach
								</tbody>
							</table>
							
							<script>
									$(".edit").click(function(e) {
										e.preventDefault();
										var entry_id = $(this).attr("data");
										console.log("entry_id = "+ entry_id);
										
										$.ajax({
											url: "update_head_subhead",
											type:"post",
											data: "$&update=2&entry_id="+entry_id,
											success: function(data) {
												console.log("ajax complete");
												$("#content").html(data);
											}
										});
										
									});
							</script>