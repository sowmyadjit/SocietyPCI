<script  src="js/jquery.validate.min.js"></script>
<div id="content<?php echo $d['module']->Mid; ?>" class="col-md-12">
	<div class="row">
		<div class="box_bdy_<?php echo $d['module']->Mid; ?> box col-md-12">
			<div class="<?php echo $d['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-briefcase"></i> Create Designation</h2>
					
					
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
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $d['module']->Mid; ?>"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $d['module']->Mid; ?>"/>
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
designationindex=0;
	
	$('.cnclbtn<?php echo $d['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.designationclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.sbmbtn<?php echo $d['module']->Mid; ?>').click( function(e) {
		$("#form_des").validate({
			rules:{
				dname:"required",
				dinitial:"required",
			}
		});
		if($("#form_des").valid())
			
		{
			if(designationindex==0){
					designationindex++;
			e.preventDefault();
			$.ajax({
				url: 'createdesig',
				type: 'post',
				data: $('#form_des').serialize(),
				success: function(data) {
					alert('success');
					$('.designationclassid').click();
				}
			});
			}
		}
	});
	
</script>