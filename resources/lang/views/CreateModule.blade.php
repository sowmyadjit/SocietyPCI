<script  src="js/jquery.validate.min.js"></script>
<div id="content" class="col-md-12">
	<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-briefcase"></i> Create Module</h2>

						<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				
				{!! Form::open(['url' => 'createmodule','class' => 'form-horizontal','id' => 'form_mod','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4" for="modulename">MODULE NAME:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="modulename" name="modulename" placeholder="MODULE NAME">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">MODULE URL:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="moduleurl" name="moduleurl" placeholder="MODULE URL"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">MODULE TOOL TIP:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="modulett" name="modulett" placeholder="MODULE TOOL TIP"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">MODULE ICON:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="moduleico" name="moduleico" placeholder="MODULE ICON"/>
					</div>
				</div>
				
				

				<center>
				<div class="form-group">
					<div class="col-sm-12">
					<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
					<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
					<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
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
            $('.modulesclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.resetbtn').click(function(e)
{
	var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
           
                return true;
            }
            else{
                return false;
            }
});
	
	$('.sbmbtn').click( function(e) {
	/*$("#form_mod").validate({
	rules:{
	modulename:"required",
	moduleurl:"required",
	}
	});
	if($("#form_des").valid())
	{*/
		e.preventDefault();
			$.ajax({
				url: 'CreateModule',
				type: 'post',
				data: $('#form_mod').serialize(),
				success: function(data) {
						 //alert('success');
						$('.modulesclassid').click();
                }
			});
			//}
	});
	
</script>