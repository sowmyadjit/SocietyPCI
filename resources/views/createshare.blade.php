<script src="js/jquery.validate.min.js"></script>
<div id="content<?php echo $s['module']->Mid; ?>" class="col-md-12">
	<div class="row">
		<div class="box_bdy_<?php echo $s['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $s['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> CREATE SHARE</h2>
					
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
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $s['module']->Mid; ?>"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $s['module']->Mid; ?>"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
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
	$('.cnclbtn<?php echo $s['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.shareclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	indexid=0;
	$('.sbmbtn<?php echo $s['module']->Mid; ?>').click( function(e) {
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
			if(indexid==0)
			{
				
				indexid++;
				e.preventDefault();
				$.ajax({
					url: 'createshares',
					type: 'post',
					data: $('#form_shares').serialize(),
					success: function(data) {
						alert('success');
						// $('.shareclassid').click();
						//window.location.href ='/shares';
						//window.location.replace('/shares');  
					}
				});
			}
		}
	});
	
</script>
