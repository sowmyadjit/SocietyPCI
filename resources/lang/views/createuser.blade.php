<script src="js/jquery.validate.min.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"/>
<div id="content" class="col-md-12">
<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> Create User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
			<div class="box-content">
				{!! Form::open(['url' => 'createuser','class' => 'form-horizontal','id' => 'form_user','method'=>'post']) !!}
				<div class="col-md-6">
					<div class="row">
					
						<div class="form-group">
							<label class="control-label col-sm-4" for="fname">FIRST NAME:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="fname" name="fname" placeholder="FIRST NAME" autocomplete>
							</div>
						</div>
					
					
					
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">MIDDLE NAME:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="mname" name="mname" placeholder="MIDDLE NAME">
							</div>
						</div>
					
					
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">LAST NAME:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="lname" name="lname" placeholder="LAST NAME">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="branch">BRANCH NAME:</label>
							<div class="col-sm-8">
								<input style="border-color:red" class="typeahead form-control"  type="text" name="bname" placeholder="SELECT BRANCH">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="branch">DESIGNATION:</label>
							<div class="col-sm-8">
								<input style="border-color:red" class="typedesig form-control"  type="text" name="desig" placeholder="SELECT DESIGNATION">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">LOGIN NAME:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="loname" name="loname" placeholder="LOGIN NAME">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">PASSWORD:</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4" for="email">EMAIL ADDRESS:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email" placeholder="EMAIL ADDRESS"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">PASSCODE:</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="passcode" name="passcode" placeholder="PASSCODE"/>
							</div>
						</div>
		
						<div class="form-group">
							<label class="control-label col-sm-4">GENDER:</label>
								<div class="col-sm-8">
									<select id="gender" name="gender" class="form-control" required>
										<option value="">SELECT GENDER</option>
										<option value="MALE">MALE</option>
										<option value="FEMALE">FEMALE</option>
									</select>
								</div>
						</div>
	
						
						<!--<div class="form-group">
							<label class="control-label col-sm-4" for="phone">MARITAL STATUS:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="ms" name="ms" placeholder="MARITAL STATUS"/>
							</div>
						</div>-->
						<div class="form-group">
							<label class="control-label col-sm-4">MARITAL STATUS:</label>
								<div class="col-sm-8">
									<select id="ms" name="ms" class="form-control" required>
										<option value="">SELECT MARITAL STATUS</option>
										<option value="MARRIED">MARRIED</option>
										<option value="UNMARRIED">UNMARRIED</option>
									</select>
								</div>
						</div>
						
						
						
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="row">
					
						
						
					
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">OCCUPATION:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="oc" name="oc" placeholder="OCCUPATION"/>
							</div>
						</div>						
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">AGE:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="age" name="age" placeholder="AGE"/>
							</div>
						</div>
						
						<!--<div class="form-group">
							<label class="control-label col-sm-4" for="phone">BIRTH DATE:</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" id="bd" name="bd" placeholder="YYYY/MM/DD"/>
							</div>
						</div>-->
						
						<div class="form-group">
							<label class="col-sm-4 control-label">BIRTH DATE</label>
								<div class="col-md-8 date">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control datepicker" name="bd" placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
											<span class="glyphicon glyphicon-calendar">
											</span>
											</span>
									</div>
								</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">MOBILE NUMBER:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="mn" name="mn" placeholder="MOBILE NUMBER"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">PHONE:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="phone" name="phone" placeholder="PHONE"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4" for="address">ADDRESS:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="address" name="address" placeholder="ADDRESS"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">CITY:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="city" name="city" placeholder="CITY"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">DISTRICT:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="dist" name="dist" placeholder="DISTRICT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">STATE:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="state" name="state" placeholder="STATE"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="phone">PINCODE:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="pc" name="pc" placeholder="PINCODE"/>
							</div>
						</div>
	
						
					
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
<script src="js/bootstrap-datepicker.js"/>
<script>
	$('.cnclbtn').click(function(e){
		//alert('are you sure?');
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.userclassid').click();
                return true;
            }
            else{
                return false;
            }
	});

	$('.sbmbtn').click( function(e) {
		$("#form_user").validate({
		rules:{
		fname:"required",
		/*mname:"required",
		lname:"required",*/
		bname:"required",
		desig:"required",
		loname:"required",
		password:"required",
		email:
		{
		required:true,
		email:true
		},
		passcode:"required",
		gender:"required",
		ms:"required",
		oc:"required",
		/*age:{
		required:true,
		number:true,
		maxlength:3
		},
		bd:{
		required:true,
		date:true
		},*/
		mn:{
		required:true,
		number:true,
		maxlength:10,
		minlength:10
		},
		address:"required",
		city:"required",
		dist:"required",
		state:"required",
		pc:{
		required:true,
		number:true,
		maxlength:6,
		minlength:6
		},
		}
		});
		if($("#form_user").valid())
		{
		a=$('ul.typeahead li.active').data('value');
		branchid=a;
		des=$('.typedesig').data('value');
		desig=des;
		alert(des);
		//alert(a);
		e.preventDefault();
		
		$.ajax({
				url: 'createuser',
				type: 'post',
				data: $('#form_user').serialize() + '&branchid=' + a + '&desig=' + des,
				success: function(data) {
						 //alert('success');
						 $('.userclassid').click();
                }
		});
		}
	});
	
$('.clickme').click(function(e){
		//alert('hi');
		$('.userclassid').click();
	});
	
	$('input.typeahead').typeahead({
		ajax: '/GetBranches'
	});
	
	$('input.typedesig').typeahead({
      ajax: '/GetDesignation'
});
		
	$('.datepicker').datepicker()
</script>