<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<script src="js/jquery.validate.min.js"></script>
<div id="content<?php echo $a['module']->Mid; ?>" class="col-md-12">
            <!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $a['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>Create Account Type</h2>

						
				</div>
					
				<div class="box-content">

				{!! Form::open(['url' => "createacctyp",'class' => 'form-horizontal','id' => 'form_acctyp','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">ACCOUNT TYPE :</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="acctyp" name="acctyp" placeholder="ACCOUNT TYPE">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">INTEREST:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="intrest" name="intrest" placeholder="INTREST"/>
					</div>
				</div>

				<center>
    					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $a['module']->Mid; ?>"/>
							<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $a['module']->Mid; ?>"/>
							<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn<?php echo $a['module']->Mid; ?>"/>
						</div>
						</div>
				</center>
				<!--</form>-->
				{!! Form::open() !!}

				</div>
			</div>
		</div>
	</div>
</div>

<script>
acctypeindex=0;
	$('.cnclbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.acctypclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.resetbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.sbmbtn<?php echo $a['module']->Mid; ?>').click( function(e) {
	$("#form_acctyp").validate({
	rules:
	{
	acctyp:"required",
	intrest:
	{
	required:true,
	number:true
	},
	}
	});
	if($("#form_acctyp").valid())
	{
		if(	acctypeindex==0){
		acctypeindex++;
		e.preventDefault();
		$.ajax({
				url: 'createacctyp',
				type: 'post',
				data: $('#form_acctyp').serialize(),
				success: function(data) {
				alert('success');
				$('.acctypclassid').click();
                }
		});
		}
		}
	});
	
</script>
