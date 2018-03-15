<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>

<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> Create Branch</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "createbranch1",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}
					
					@foreach($shares as $shr)
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">NAME:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="Name" name="Name" value="{{$shr->FirstName}}.{{$shr->MiddleName}}.{{$shr->LastName}}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">CERTIFICATE NUMBER:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="cn" name="cn" value="{{$shr->PURSH_Certfid}}" readonly>
							
							<input type="text" class="form-control hidden " id="cnhidden" name="cnhidden" value="{{$shr->PURSH_Certfid}}">
							
							<input type="text" class="form-control hidden" id="pid" name="pid" value="{{$shr->PURSH_Pid}}">
							
							<input type="text" class="form-control hidden" id="sid" name="sid" value="{{$shr->individual_share_ID}}">
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">PAYABLE AMOUNT:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bcity" name="bcity" value="{{$shr->PURSH_Shareamt}}" readonly>
							
							<input type="text" class="form-control hidden" id="payamt" name="payamt" value="{{$shr->PURSH_Shareamt}}">
						</div>
					</div>
					
					@endforeach
					<center>
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="PAY" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
					
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	branchid=0;
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.branchclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.sbmbtn').click( function(e) {
		pid=$('#pid').val();
		sid=$('#sid').val();
		cerificateid=$('#cnhidden').val();
		payamt=$('#payamt').val();
		e.preventDefault();
		$.ajax({
			url: 'SingleShareCloseTran',
			type: 'post',
			data: '&pid='+pid+'&cerificateid='+cerificateid+'&payamt='+payamt+'&sid='+sid,
			success: function(data) {
				//alert('success');
				$('.branchclassid').click();
			}
			
		});
		
	});
	
</script>