<link href="css/datepicker.css" rel='stylesheet'>



<div id="content<?php echo $ec['module']->Mid; ?>" class="col-md-12">
	<div class="row">
		<div class="box_bdy_<?php echo $ec['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $ec['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>CREATE EMPLOYEE</h2>
					
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => 'insertemp','class' => 'form-horizontal','id' => 'empcreateForm','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
					<div class="col-md-6">
						<div class="row">
							
							<div class="form-group">
								<label class="control-label col-sm-4">First Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="fname" name="fname" placeholder="FIRST NAME" onblur="LoadUid();" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mname" name="mname" placeholder="MIDDLE NAME" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Last Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="lname" name="lname" placeholder="LAST NAME">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Branch Name:</label>
								<div class="col-md-8">
									<input class="typeahead1 form-control" placeholder="SELECT BRANCH" id="branch" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Employee Code:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="empcode" name="empcode" placeholder="EMPLOYEE CODE" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Employee Type:</label>
								<div class="col-md-8">
									<select class="form-control" id="emptype" name="emptype">
										<option></option>
										<option value="TEMPORARY EMPLOYEE">TEMPORARY EMPLOYEE</option>
										<option value="PERMANENT EMPLOYEE">PERMANENT EMPLOYEE</option>
										<option value="OTHER">OTHER</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Designation:</label>
								<div class="col-md-8">
									<input class="typeahead desig form-control" placeholder="SELECT DESIGNATION" id="dsgn" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4" for="first_name">Secutity Deposit:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="sd" name="sd" placeholder="Secutity Deposit Amount">
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
								<label class="control-label col-sm-4" for="comment">PASSCODE:</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="passcode" name="passcode" placeholder="PASSCODE"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">EMAIL ID:</label>
								<div class="col-sm-8">
									<input type="email" class="form-control" id="email" name="email" placeholder="EMAIL ID"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Gender:</label>
								<div class="col-md-8">
									<select id="gender" name="gender" class="form-control" required>
										<option></option>
										<option>MALE</option>
										<option>FEMALE</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Marital Status:</label>
								<div class="col-md-8">
									<select class="form-control" id="maritalstatus" name="maritalstatus" required>
										<option></option>
										<option>MARRIED</option>
										<option>UNMARRIED</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Occupation:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="occupation" name="occupation" placeholder="OCCUPATION">
								</div>
							</div>
							
							
							
							
							
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="row">
							
							
							<div class="form-group">
								<label class="col-sm-4 control-label"> Joining Date</label>
								<div class="col-md-8 date">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control datepicker" name="jd"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
											<span class="glyphicon glyphicon-calendar">
											</span>
											</span>
									</div>
								</div>
						</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="age" name="age" placeholder="AGE">
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Birth Date:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="bdate" name="bdate" placeholder="BIRTH DATE">
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Mobile Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mobile" name="mobile" placeholder="MOBILE NUMBER" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Phone Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="phone" name="phone" placeholder="PHONE">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Address:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="address" name="address" placeholder="ADDRESS" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">City:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="city" name="city" placeholder="CITY" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">DISTRICT:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="dist" name="dist" placeholder="DISTRICT" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">State:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="state" name="state" placeholder="STATE" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pincode:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="pincode" name="pincode" placeholder="PINCODE" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Basic Pay:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="bpay" name="bpay" placeholder="BASIC PAY" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Income Tax:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="itax" name="itax" placeholder="INCOME TAX" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">PF:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="pf" name="pf" placeholder="PF" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">ESI:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="esi" name="esi" placeholder="ESI" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"> Society PF:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="spf" name="spf" placeholder="Society PF" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Society ESI:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="sesi" name="sesi" placeholder="Society ESI" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">HRA:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="hra" name="hra" placeholder="HRA" required>
								</div>
							</div>
							
							
							
							<div class="col-md-8 hidden">
								<input type="text" class="form-control" id="brid" name="brid">
							</div>
							
							<div class="col-md-8 hidden">
								<input type="text" class="form-control" id="dsgid" name="dsgid">
							</div>
							
							<div class="col-md-8 hidden">
								<input type="text" class="form-control" id="usrid" name="usrid">
							</div>
						</div>
					</div>
					
					</br>
					
					<div class="alert alert-success col-md-12">
						<div class="row">
							
							
							<div class="col-md-6">
								<div class="row table-row">
									<div class="col-md-4">
										
										<div class="form-group">
											<label class="control-label col-md-2">ID Proof:</label>
											<div class="col-md-8">
												</br></br></br>
												<input type="file" id="empidp" name="empidp" accept="image/*" onchange="loadFile1(event)">
											</div>
										</div>
										
									</div>
									
									<div class="col-md-8">
										
										<img id="idproof" height="150" width="250"/></br>
										
									</div>
									
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="row table-row">
									<div class="col-md-4">
										
										<div class="form-group">
											<label class="control-label col-md-2">Address Proof:</label>
											<div class="col-md-8">
												</br></br></br>
												<input type="file" id="empadpf" name="empadpf" accept="image/*" onchange="loadFile2(event)">
											</div>
										</div>
									</div>
									
									<div class="col-md-8">
										<img id="addproof" height="150" width="250"/></br>
									</div>
									
								</div>
							</div>
							
						</div>
						
						
						</br>
						
						
						<div class="row">
							
							<div class="col-md-6">
								<div class="row table-row">
									<div class="col-md-4">
										
										<div class="form-group">
											<label class="control-label col-md-2">Photo:</label>
											<div class="col-md-8">
												</br></br>
												<input type="file" id="empphoto" name="empphoto" accept="image/*" onchange="loadFile3(event)">
											</div>
										</div>
									</div>
									
									<div class="col-md-8">
										<img id="emppic" height="150" width="130"/></br>
									</div>
									
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="row table-row">
									<div class="col-md-4">
										
										<div class="form-group">
											<label class="control-label col-md-2">Signature:</label>
											<div class="col-md-8">
												</br></br>
												<input type="file" id="empsign" name="empsign" accept="image/*" onchange="loadFile4(event)">
											</div>
										</div>
									</div>
									
									<div class="col-md-8">
										<img id="sign" height="150" width="250"/></br>
									</div>
									
								</div>
							</div>
							
						</div>
						
					</div> <!--alert-success ends-->
					<center>
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $ec['module']->Mid; ?>"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $ec['module']->Mid; ?>"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn<?php echo $ec['module']->Mid; ?>"/>
							</div>
						</div>
						
					</center>
					{!! Form::close() !!}
				</div>
				
				
				
			</div>
		</div>
	</div>
</div>




<script src="js/bootstrap-typeahead.js"></script>
<script src="js/bootstrap-datepicker.js"/>
<script>
$('.datepicker').datepicker().on('changeDate',function(e){
	$(this).datepicker('hide');
});
	
	function LoadUid()
	{
		$.ajax({
			url: 'Getusrid',
			type: 'get',
			success: function(result) {
				m=result;
				uid=(parseInt(m)+1);
				$('#usrid').val(uid);
			}
		});
	}
	
	
	
	
	$('.cnclbtn<?php echo $ec['module']->Mid; ?>').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.empclassid').click();
			return true;
		}
		else{
			return false;
		}
	});
	
	$('.resetbtn<?php echo $ec['module']->Mid; ?>').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			
			return true;
		}
		else{
			return false;
		}
	});
	
	/*$('.sbmbtn').click( function(e) {
		//DTid=$('ul.typeahead li.active').data('value');
		a=$('.desig').data('value');
		des=a;
		branch=$('.typeahead1').data('value');
		branch1=branch;
		//alert(branch);
		
		// alert(a);
		e.preventDefault();
		$.ajax({
		
        url: 'insertemp',
        type: 'post',
        data: $('#empcreateForm').serialize()+ '&des=' + a + '&branch1=' + branch ,
        success: function(data) {
		//alert('success');
		$('.empclassid').click();
		
		}
		});
	});*/
	
	//Designation Change
	$('#dsgn').change(function(e){
		DTid=$('#dsgn').data('value');
		
		//alert(DTid);
		$.ajax({
			success:function(){
				$('#dsgid').val(DTid);
				// alert(DTid);
			}
		});
	});
	
	//Branch Change
	
	$('#branch').change(function(e){
		branchid=$('.typeahead1').data('value');
		$.ajax({
			success:function(){
				$('#brid').val(branchid);
			}
		});
	});
	
</script>
<script>
	
	$('input.typeahead').typeahead({
		//ajax: '/GetDesignation'
		source:GetDesignation
	});
	$('input.typeahead1').typeahead({
		//ajax: '/GetBranches'
		source:GetBranches
	});
	
</script>

<style>
	input[type=file]{ 
	color:transparent;
    }
</style>


<script>
	
	var loadFile1 = function(event) {
		var idproof = document.getElementById('idproof');
		idproof.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile2 = function(event) {
		var addproof = document.getElementById('addproof');
		addproof.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile3 = function(event) {
		var emppic = document.getElementById('emppic');
		emppic.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile4 = function(event) {
		var sign = document.getElementById('sign');
		sign.src = URL.createObjectURL(event.target.files[0]);
	};
	
	
</script>

