<link href="css/datepicker.css" rel='stylesheet'/>


<script src="js/jquery.min.js"></script>


<div id="content" class="col-md-12">
	<div class="row">
	
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>CREATE MINOR CUSTOMER</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
						
					</div>
					
			<div class="box-content">
				{!! Form::open(['url' => 'CreateMinorCust','class' => 'form-horizontal','id' => 'Form_MinCust','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
				
				<div class="col-md-6"><!-- customer SECTION-->
					<div class="row">
					
					<div class="box-header well col-md-12">
							<h2>MINOR CUSTOMER DETAILS</h2>
						</div>
						
						<div class="alert alert-info">	
						<!--CUSTOMER Detail-->
					
						<div class="form-group">
						<label class="control-label col-sm-4">FIRST NAME:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="fname" name="fname" placeholder="FIRST NAME" onblur="GetMaxUid();" required>
						</div>
						</div>
						
						
						
					
						
						<div class="col-sm-8" hidden>
							<div class="col-sm-8">
									<input type="text" class="form-control" id="usrid" name="usrid"/>
								</div>
						</div>
						
						
						
						
	   					<div class="form-group">
						<label class="control-label col-sm-4">MIDDLE NAME:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="mname" name="mname" placeholder="MIDDLE NAME">
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">LAST NAME:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="lname" name="lname" placeholder="LAST NAME">
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">FATHER NAME:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="fthrname" name="fthrname" placeholder="FATHER NAME" required>
						</div>
						</div>
						
						
						<div class="form-group">
						<label class="control-label col-sm-4">BRANCH:</label>
						<div id="the-basics" class="col-sm-8">
							<input class="typeahead form-control"  type="text" placeholder="SELECT BRANCH" id="custbranch" required>  
						</div>
						</div>
						
						<!--<div class="form-group">
						<label class="control-label col-sm-4">ACCOUNT NUMBER:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="acno" name="acno" placeholder="ACCOUNT NUMBER">
						</div>
						</div>-->
						
						<div class="form-group">
        <label class="control-label col-sm-4">Login Name:</label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="lon" name="lon" placeholder="LOGIN NAME">
        </div>
    </div>
	
	<div class="form-group">
        <label class="control-label col-sm-4">Password:</label>
        <div class="col-md-8">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="PASSWORD">
        </div>
    </div>
	
		<div class="form-group">
        <label class="control-label col-sm-4">Passcode:</label>
        <div class="col-md-8">
            <input type="password" class="form-control" id="passcode" name="passcode" placeholder="PASSCODE">
        </div>
    </div>
						
						<!--<div class="form-group">
						<label class="control-label col-sm-4">OPENING BALANCE</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="opbal" name="opbal" placeholder="OPENING BALANCE"/>
						</div>
						</div>-->

						
		
						<div class="form-group">
						<label class="control-label col-sm-4">GENDER:</label>
						<div class="col-sm-8">
							<select id="gender" name="gender" class="form-control" required>
								<option value=""></option>
								<option value="MALE">MALE</option>
								<option value="FEMALE">FEMALE</option>
							</select>
						</div>
						</div>
	
						
						
						
						<div class="form-group">
						<label class="control-label col-sm-4" >AGE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="age" name="age" placeholder="AGE"/>
						</div>
						</div>
						
						
						<div class="form-group">
							<label class="col-sm-4 control-label">BIRTH DATE</label>
								<div class="col-md-8 date">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control datepicker" name="bd"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
											<span class="glyphicon glyphicon-calendar">
											</span>
											</span>
									</div>
								</div>
						</div>

						<div class="form-group">
						<label class="control-label col-sm-4">MOBILE NUMBER:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="mn" name="mn" placeholder="MOBILE NUMBER" required/>
						</div>
						</div>
						
						
						
						
    
						<div class="form-group">
						<label class="control-label col-sm-4">ADDRESS:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="address" name="address" placeholder="ADDRESS" required/>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">CITY:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="city" name="city" placeholder="CITY" required/>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">DISTRICT:</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="dist" name="dist" placeholder="DISTRICT" required/>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-4">STATE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="state" name="state" placeholder="STATE" required/>
						</div>
						</div>

						
						<div class="form-group">
						<label class="control-label col-sm-4">PINCODE:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="pc" name="pc" placeholder="PINCODE" required/>
						</div>
						</div>
						
						
					</div> <!--CUSTOMER alert-info div ends-->
					</div>
				</div> <!-- CUSTOMER SECTION ENDS-->
				
				
				
				
				<div class="col-sm-8 hidden">
							<input type="text" class="form-control" id="branchid" name="branchid"/>
						</div>
						
				
				
				
				
				
				
				
				<div class="col-md-6">
					<div class="row">

						<div class="box-header well col-md-12">
							<h2>NOMINEE DETAILS</h2>
						</div>
						
						<div class="alert alert-danger">
				
						<!--Nominee Detail-->
						
						 <div class="form-group" >
							<label class="control-label col-sm-4">First Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nfname" name="nfname" placeholder="FIRST NAME" required>
							</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nmname" name="nmname" placeholder="MIDDLE NAME">
								</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-4">Last Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nlname" name="nlname" placeholder="LAST NAME">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Relationship:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="reltn" name="reltn" placeholder="RELATIONSHIP" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">EMail ID:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nemail" name="nemail" placeholder="EMAIL ID">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Gender:</label>
							<div class="col-md-8">
								 <select class="form-control" id="ngender" name="ngender" placeholder="SELECT GENDER" required>
									 <option value=""></option>
									 <option>Male</option>
									 <option>Female</option>
								 </select>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Marital Status:</label>
							<div class="col-md-8">
								 <select class="form-control" id="nmstate" name="nmstate" placeholder="SELECT MARITAL STATUS" required>
									 <option value=""></option>
									 <option>Married</option>
									 <option>Unmarried</option>
								 </select>
							</div>
						</div>
					 
						<div class="form-group">
								<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nage" name="nage" placeholder="AGE">
								</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Birth Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nbdate" name="nbdate" placeholder="BIRTH DATE">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Occupation:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="noccup" name="noccup" placeholder="OCCUPATION">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Mobile Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nmno" name="nmno" placeholder="MOBILE NUMBER" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Phone Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npno" name="npno" placeholder="PHONE NUMBER">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label  col-sm-5">Same as Member Address</label>
							<div class="col-sm-1">
							<input type="checkbox" class="form-control" id="chk" name="chk"/>
								
							</div>
						</div>
						
					
						 <div class="form-group">
								<label class="control-label col-sm-4">Address:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nadd" name="nadd" placeholder="ADDRESS" required>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">City:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ncity" name="ncity" placeholder="CITY" required>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">District:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ndist" name="ndist" placeholder="DISTRICT" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">State:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nstate" name="nstate" placeholder="STATE" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Pincode:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npin" name="npin" placeholder="PINCODE" required>
							</div>
						</div>
					
						
					
						
						

					</div>   <!-- DIV alert-danger ends here-->
				</div>
				</div>
				
				
				
				
				
				
				
				
				<div class="alert alert-success col-md-12">
					<div class="row">
					
					
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
						
									<div class="form-group">
										<label class="control-label col-sm-4">Birth Certificate:</label>
										<div class="col-md-8">
										</br></br></br>
										<input type="file" id="custidp" name="custidp" accept="image/*" onchange="loadFile1(event)">
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
									<label class="control-label col-sm-4">Photo:</label>
									<div class="col-md-8">
									</br></br>
									<input type="file" id="custphoto" name="custphoto" accept="image/*" onchange="loadFile3(event)">
									</div>
									</div>
									
									</div>
									
									<div class="col-md-8">
									
									<img id="emppic" height="150" width="130"/></br>
									
									</div>
								
							</div>
						</div>
						
						</div><!--row ends-->
						
					</div> <!--alert-success ends-->
				
				
				
				
				
				
				
				
				
				
				
				
						<center>
							<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" class="btn btn-info btn-sm" VALUE = "CLEAR">
							</div>
							</div>
						</center>
    
				
				{!! Form::close()!!}
			</div>
				</div>
			</div>
		</div>
	</div>





	
<script src="js/bootstrap-datepicker.js"/>
						<script>
							var m="";
							var uid="";
							//Loading UserID
							function GetMaxUid(){
							
								$.ajax({
											url: 'Getuid',
											type: 'get',
											success: function(result) {
												m=result;
												uid=(parseInt(m)+1);
												$('#usrid').val(uid);
												//alert(uid);
											}
									});
							}
						</script>



<script src="js/bootstrap-typeahead.js"></script>
<script>
//Address checkbox click
$('#chk').click(function(e){
	if($('#chk').is(":checked"))
	{
	add=$('#address').val();
	city=$('#city').val();
	dist=$('#dist').val();
	pin=$('#pc').val();
	state=$('#state').val();
	$('#nadd').val(add);
	$('#ncity').val(city);
	$('#ndist').val(dist);
	$('#nstate').val(state);
	$('#npin').val(pin);
	}
	else{
		$('#nadd').val('');
	$('#ncity').val('');
	$('#ndist').val('');
	$('#nstate').val('');
	$('#npin').val('');
	}
});





	$('.cnclbtn').click(function(e){
		    var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.custclassid').click();
                return true;
            }
            else{
                  return false;
            }
    });
	
/*	$('.sbmbtn').click( function(e) {
		branchid=$('ul.typeahead li.active').data('value');
		a=$('ul.typeahead li.active').data('value');
		branchid=a;
		// alert(a);
		e.preventDefault();
		
		$.ajax({
		        url: 'createcust',
				type: 'post',
				data: $('#form_cust').serialize() + '&branchid=' + a ,
				success: function(data) {
					//alert('success');
                   $('.custclassid').click();
				}
		});
	});*/
	
	$('input.typeahead').typeahead({
		ajax: '/GetBranches'
	});
	
	$('#custbranch').change(function(){
	 cbrnch=$('ul.typeahead li.active').data('value');
	
	 $.ajax({
			success:function(){
				 $('#branchid').val(cbrnch);
				//alert(cbrnch);
			}
		});
});
	
	$('.datepicker').datepicker();
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
	
	
	var loadFile3 = function(event) {
		var emppic = document.getElementById('emppic');
		emppic.src = URL.createObjectURL(event.target.files[0]);
	};
	
	


</script>



