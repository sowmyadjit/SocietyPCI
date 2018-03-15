<script  src="js/jquery.validate.min.js"></script>
<div id="content<?php echo $c['module']->Mid; ?>" class="col-md-12">
            <!-- content starts -->
        <div class="row">
			<div class="box_bdy_<?php echo $c['module']->Mid; ?> box col-md-12">
				<div class="bdy_<?php echo $c['module']->Mid; ?> box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   Create COMPANY</h2>
						
						
					</div>
					
			<div class="box-content">	
				{!! Form::open(['url' => "createcompany",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">COMPANY NAME:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="cname" name="cname" placeholder="COMPANY NAME">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">COMPANY INITIAL:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="cinitial" name="cinitial" placeholder="COMPANY INITIAL"/>
					</div>
				</div>
		
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">COMPANY ADDRESS:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="caddress" name="caddress" placeholder="ADDRESS">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">COMPANY PHONE NO:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="cphoneno" name="cphoneno" placeholder="PHONE NO">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">COMPANY CITY:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="ccity" name="ccity" placeholder="CITY">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">COMPANY STATE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="cstate" name="cstate" placeholder="STATE">
					</div>
				</div>
		
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">COMPANY PINCODE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="cpincode" name="cpincode" placeholder="PINCODE">
					</div>
				</div>
	 
				<center>
    
					<div class="form-group">
						<div class="col-sm-12">
						<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $c['module']->Mid; ?>"/>
						<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $c['module']->Mid; ?>"/>
						<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
						
						<!--<input type="button" value="back" class="btn btn-info btn-sm backbtn"/>-->
						<!--<a href="{{ URL::previous() }}" class="btn btn-default">Back</a>-->
						<a href="{{ URL::previous() }}">Go Back</a>
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
companyindex=0;
	$('.cnclbtn<?php echo $c['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.companyclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	$('.backbtn').click(function(e){
		
		$('.companyclassid').click();
	});
	
	$('.sbmbtn<?php echo $c['module']->Mid; ?>').click( function(e) {
		
		
	$("#form_des").validate({
                rules: {
                    cname: "required",
					cinitial: "required",
					caddress:"required",
					cphoneno:{
					required:true,
					number:true,
					maxlength:15
					},
					ccity:"required",
					cstate:"required",
					cpincode:
					{
					required:true,
					number:true,
					maxlength:6,
					minlength:6
					},
					
					}
					});
					
					if($("#form_des").valid())
					{
						if(companyindex==0){
					companyindex++;
		e.preventDefault();
		$.ajax({
				url: 'createcompany',
				type: 'post',
				data: $('#form_des').serialize(),
				success: function(data) {
					alert('success');
					$('.companyclassid').click();
                }
		});
						}
		}
	});
	
</script>
