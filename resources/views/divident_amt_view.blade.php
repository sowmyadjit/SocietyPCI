
<!-- content starts -->


	<div class="row">
		<div class="box col-md-12">
			<div class=" box-inner">
			
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SHARE DIVIDENT VIEW</h2>
				</div>

				<div class="box-content">
					<div class="alert alert-info">
					<a href="create_divident" class="btn btn-default  create">Create</a>
					<a href="divident" class="btn btn-default  back pull-right">Back</a>
					</div>

					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th></th>
								<th>Memid</th>
								<th>Member_no</th>
								<th>name</th>
								<th>divident_amt</th>
								<th>status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
							?>
							@foreach ($data as $row)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $row->Memid }}</td>
									<td>{{ $row->Member_no }}</td>
									<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
									<td id = "divident_amt_{{ $row->id }}">{{ $row->divident_amt }}</td>
									<td>{{ $row->status }}</td>
									<td><div class="form-group">
										<div class="col-sm-12">
											<button class="btn btn-info btn-sm" onclick="editNum({{ $row->id }},{{ $row->divident_amt }})" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-pencil"></i></button>
										</div>
									</div></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- model--->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">FD EDIT AMOUNT</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-sm-5">Amount:</label>
					<div class="col-md-7">
						<input type="text" id="edit_div" name="edit_div" class="form-control" autofocus>
					</div>
				</div>
				<br>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm edit btn-success save" data-dismiss="modal" >SAVE</button>
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		
	</div>
</div>		
<!--- model close--->

<script>
	function editNum(a,b)
	{
		id=a;
		editAmount=b;
		$('#edit_div').val(editAmount);
	}
	
	$('.save').click( function(e) {
		divident_amt=$('#edit_div').val();
		$.ajax({
			url: 'edit_div_amt',
			type: 'post',
			data:'&divident_amt='+divident_amt+'&id='+id,
			success: function(data) {
//				alert('success');
				$('#divident_amt_'+id).html(divident_amt);
			}
		});
	});
</script>

<script>
/*	$(".add_divident").click(function(event){
		event.preventDefault();
		$(".box").load($(this).attr("href"));
	});*/
</script>

<script>
	$(".create").click(function(e) {
		e.preventDefault();
		$.ajax({
			url:"create_divident",
			type:"post",
			success: function(data){
				console.log("create ajax:"+data);
			}
		});
	});
</script>