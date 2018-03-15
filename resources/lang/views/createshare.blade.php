<script src="js/jquery.validate.min.js"></script>
<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> CREATE SHARE</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
			<div class="box-content">
			{!! Form::open(['url' => "createshares",'class' => 'form-horizontal','id' => 'form_shares','method'=>'post']) !!}

				<div class="form-group">
				<label class="control-label col-sm-4" for="first_name">SHARE CLASS:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="Sclass" name="Sclass" placeholder="Share Class">
				</div>
				</div>
	
				<div class="form-group">
				<label class="control-label col-sm-4" for="comment">FACEVALUE:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="facevalue" name="facevalue" placeholder="Facevalue"/>
				</div>
				</div>
	
				<div class="form-group">
				<label class="control-label col-sm-4" for="first_name">SHARE Fee:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="shareprice" name="shareprice" placeholder="Share Price">
				</div>
				</div>
				
				<center>
    
					<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
						<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
						<input type="reset" value="CLEAR" class="btn btn-info btn-sm cnclbtn"/>
					</div>
					</div>
				</center>
			{!! Form::close()!!}
			</div>
			</div>
		</div>
	</div>
</div>


<script>
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.shareclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.sbmbtn').click( function(e) {
	$("#form_shares").validate({
	rules:
	{
	Sclass:"required",
	facevalue:{
	required:true,
	number:true
	
	},
	shareprice:
	{
	required:true,
	number:true
	},
	}
	});
	if($("#form_shares").valid())
	{
		e.preventDefault();
		$.ajax({
				url: 'createshares',
				type: 'post',
				data: $('#form_shares').serialize(),
				success: function(data) {
						 //alert('success');
						 $('.shareclassid').click();
                }
		});
		}
	});
	
</script>
