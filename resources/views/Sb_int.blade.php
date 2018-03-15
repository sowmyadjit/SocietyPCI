<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i> FD DATA</h2>
			</div>
			
			<div class="box-content">
				
				<div class="alert alert-info">
					
				</div>
				
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
							<th> SB ACCOUNT</th>
							<th>SB Account Intrest</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
						
						@foreach ($data as $d)
						<tr>
							
							<td>{{ $d->accno }}</td>
							<td>{{ $d->int_ }}</td>
							<td><div class="form-group">
							<span>
								<div class="col-sm-12">
									<button class="btn btn-info btn-sm" onclick="editNum({{ $d->sb_int }},{{ $d->int_ }})" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-pencil"></i></button>
									
								</div>
								</span>
								<span>
								<div class="col-sm-12">
									<button class="btn btn-info btn-sm" onclick="delete1({{ $d->sb_int }});" >
									<i class="glyphicon glyphicon-remove"></i></button>
									
								</div>
								</span>
							</div></td>
						</tr>
						
						@endforeach
					</tbody>
					
				</table>
				
			</div> 
			<center>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="create" class="btn btn-success btn-sm AddBankSbmBtn"/>
						
					</div>
				</div>
				
			</center>
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
				<h4 class="modal-title">SB EDIT AMOUNT</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-sm-5">Amount:</label>
					<div class="col-md-7">
						<input type="text" id="editFd" name="editFd" class="form-control">
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
	function delete1(a)
	{
	del=a;
		$.ajax({
		url: 'delete_Sb_data',
		type: 'post',
		data:'&sdid='+del,
		success: function(data) {
			alert('success');
			//$('.bankclassid').click();
		}
	});
		}
	addbankindex=0;
	$('.AddBankSbmBtn').click( function(e) {
	if(addbankindex==0){
		addbankindex++;
		
		
		
		e.preventDefault();
		$.ajax({
			url: 'create_SB_data',
			type: 'post',
			
			success: function(data) {
				alert('success');
				$('.bankclassid').click();
			}
		});
	}
});

/*-------------------------------------------------*/
function editNum(a,b)
{
	editNo=a;
	editAmount=b;
	//alert(editNo);
	//alert(editAmount);
	$('#editFd').val(editAmount);
}

$('.save').click( function(e) {
	amt=$('#editFd').val();
	$.ajax({
		url: 'edit_Sb_data',
		type: 'post',
		data:'&amount='+amt+'&sdid='+editNo,
		success: function(data) {
			alert('success');
			//$('.bankclassid').click();
		}
	});
	
	
});
</script>				