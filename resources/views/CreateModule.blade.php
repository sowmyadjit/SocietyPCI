<script  src="js/jquery.validate.min.js"></script>
<div id="content<?php echo $M['module']->Mid; ?>" class="col-md-12">
	<div class="row">
			<div class="box_bdy_<?php echo $M['module']->Mid; ?> box col-md-12">
				<div class="bdy_<?php echo $M['module']->Mid; ?> box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-briefcase"></i> Create Module</h2>

					</div>
					
				<div class="box-content">
				
				{!! Form::open(['url' => 'createmodule','class' => 'form-horizontal','id' => 'form_mod','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4" for="modulename">MODULE ORDER ID:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="moduleorderid" name="moduleorderid" placeholder="MODULE ORDER ID">
					</div>
				</div>
				
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
					<label class="control-label col-sm-4" for="comment">MODULE CLASSID:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="modulecid" name="modulecid" placeholder="MODULE CLASSID"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">MODULE TOOL TIP:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="modulett" name="modulett" placeholder="MODULE TOOL TIP"/>
						<textarea style="resize:none" rows="5" class="form-control" id="modulett" name="modulett" placeholder="MODULE TOOL TIP"></textarea>
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
					<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $M['module']->Mid; ?>"/>
					<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $M['module']->Mid; ?>"/>
					<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn<?php echo $M['module']->Mid; ?>"/>
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

	$('.cnclbtn<?php echo $M['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.modulesclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.resetbtn<?php echo $M['module']->Mid; ?>').click(function(e)
{
	var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
           
                return true;
            }
            else{
                return false;
            }
});
	
	$('.sbmbtn<?php echo $M['module']->Mid; ?>').click( function(e) {
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