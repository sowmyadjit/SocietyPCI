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

				<div class="form-group">
					<label class="control-label col-sm-4" for="last_name">COMPANY NAME:</label>
					
					<div class="col-sm-4">
					<select class="form-control" id="cid" name="cid" placeholder="COMPANY NAME" >
						<?php foreach ($company as $key) {
						//print_r($key);
						echo "<option value='".$key->cid."' >".$key->cname."";
						echo "</option>";
						}?>
					</select>
            		</div>
					
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">BRANCH CODE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bcode" name="bcode" placeholder="BRANCH CODE"/>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">BRANCH NAME:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bname" name="bname" placeholder="BRANCH NAME">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">ADDRESS:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="baddress" name="baddress" placeholder="ADDRESS">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">CITY:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bcity" name="bcity" placeholder="CITY">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">STATE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bstate" name="bstate" placeholder="STATE">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">PHONE NUMBER:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bphone" name="bphone" placeholder="PHONE NUMBER">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">MOBILE NUMBER:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bmobile" name="bmobile" placeholder="MOBILE NUMBER">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">PINCODE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bpincode" name="bpincode" placeholder="PINCODE">
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
	//branchid=$('ul.typeahead li.active').data('value');
	$("#form_des").validate({
rules:{
     cid:"required",
	 bcode:"required",
	 bname:"required",
	 baddress:"required",
	 bcity:"required",
	 bstate:"required",
	 bphone:
	 {
	 required:true,
	 number:true,
	 maxlength:15
	 },
	/* bmobile:
	 {
	 required:true,
	 number:true,
	 maxlength:10,
	 minlength:10
	 },*/
	 bpincode:
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
	e.preventDefault();
		$.ajax({
			url: 'createbranch1',
			type: 'post',
			data: $('#form_des').serialize(),
			success: function(data) {
				//alert('success');
				$('.branchclassid').click();
			}
			
		});
		}
	});

</script>