<script  src="js/jquery.validate.min.js"></script>
<div id="content" class="col-md-12">
	<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-briefcase"></i> Create Designation</h2>

						<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				
				{!! Form::open(['url' => 'createuser','class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">DESIGNATION NAME:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="dname" name="dname" placeholder="DESIGNATION NAME">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">DESIGNATION INITIAL:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="dinitial" name="dinitial" placeholder="INITIAL"/>
					</div>
				</div>
				
				<div class="form-group">
							<label class="control-label col-sm-4">LEVEL:</label>
								<div class="col-md-4">
									<select id="DesigLevel" name="DesigLevel" class="form-control" required>
										<option value="">SELECT DESIGNATION LEVEL</option>
										<option value="LEVEL1">LEVEL1</option>
										<option value="LEVEL2">LEVEL2</option>
										<option value="LEVEL3">LEVEL3</option>
										<option value="LEVEL4">LEVEL4</option>
										<option value="LEVEL5">LEVEL5</option>
										
									</select>
								</div>
				</div>

				<center>
				<div class="form-group">
					<div class="col-sm-12">
					<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
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

	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.designationclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.sbmbtn').click( function(e) {
	$("#form_des").validate({
	rules:{
	dname:"required",
	dinitial:"required",
	}
	});
	if($("#form_des").valid())
	{
		e.preventDefault();
			$.ajax({
				url: 'createdesig',
				type: 'post',
				data: $('#form_des').serialize(),
				success: function(data) {
						 //alert('success');
						$('.designationclassid').click();
                }
			});
			}
	});
	
</script>