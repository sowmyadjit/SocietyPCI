<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/bootstrap-datepicker.js"/>	
<link href="css/datepicker.css" rel='stylesheet'>
<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>Create Account</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "createacc",'class' => 'form-horizontal','id' => 'form_acc','method'=>'post']) !!}
					
					
					<div class="col-md-6"> <!-- ACCOUNT DETAILS SECTION-->
						<div class="row">
							
							<div class="box-header well col-md-12">
								<h2>ACCOUNT DETAILS</h2>
							</div>
							
							<div class="alert alert-success">	
								<!--ACCOUNT DETAILSDetail-->
								
								
								<!--	<div class="form-group">
									<label class="control-label col-sm-4">Creation Date:</label>
									<div class="col-md-8">
									<input type="text" class="form-control" id="crtdte" name="crtdte" value="<?php echo date('d/m/Y');?>">
									</div>
								</div>-->
								<!--	<div class="form-group">
									<label class="col-sm-4 control-label">CREATED DATE</label>
									<div class="col-md-8 date">
									<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control datepicker" name="crtdte" id="crtdte" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy"/>
									<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
									</span>
									</div>
									</div>
								</div>-->
								
								<div class="form-group">
									<label class="control-label col-sm-4">Account Type:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="typeahead1 form-control"  id="actyp" type="text" name="actype" placeholder="SELECT ACCOUNT TYPE">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">Old Account Number:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" id="oldaccno" name="oldaccno" placeholder="OLD ACCOUNT NUMBER">  
									</div>
								</div>
								
								<!--Newly Added-->
								<div class="form-group" id="agent">
									<label class="control-label col-sm-4">Through Agent:</label>
									<div class="col-md-8">
										<input type="checkbox" id="thragnt" name="thragnt">
									</div>
								</div>
								
								<div class="form-group fdagent">
									<label class="control-label col-sm-4">Agent Name:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="typeaheadagnt form-control" id="fdagent" type="text" name="fdagent" placeholder="SELECT AGENT">  
									</div>
								</div>
								<!--Ends-->
								<div class="form-group" id="durationyearclass">
									<label class="control-label col-sm-4">Duration IN Year:</label>
									<div class="col-md-8">
										<input type="checkbox" id="durationcheck" name="durationcheck">
									</div>
								</div>
								
								<div class="form-group" id="rdd">
									<label class="control-label col-sm-4">RD Duration(In Year's):</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="rddurtn" name="rddurtn" placeholder="RD DURATION" onblur="mdateyear();">
									</div>
								</div>
								
								<div class="form-group" id="rddyear">
									<label class="control-label col-sm-4">RD Duration(In Months's):</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="rddurtnmonth" name="rddurtnmonth" placeholder="RD DURATION" onblur="mdatemonth();">
									</div>
								</div>
								
								<div class="form-group" id="md">
									<label class="control-label col-sm-4"> Matured Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="m" name="m" placeholder="Date">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">Branch Name:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="typeahead2 form-control" id="branch" type="text" name="branch" placeholder="SELECT BRANCH">  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">User Name:</label>
									<div class="col-md-8">
										<input style="border-color:red"id="usr" class="typeahead3 form-control"  type="text" name="user" placeholder="SELECT user">  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Opening Blance:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ob" name="ob" placeholder="Opening Balance">
									</div>
								</div>
								
							</div>
							
							<div class="box-header well col-md-12">
								<h2>NOMINEE DETAILS</h2>
							</div>
							
							<div class="alert alert-danger">
								
								<!--Nominee Detail-->
								
								<div class="form-group">
									<label class="control-label col-sm-4">First Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nfname" name="nfname" placeholder="FIRST NAME">
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
										<input type="text" class="form-control" id="relation" name="relation" placeholder="RELATIONSHIP">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nemail" name="nemail" placeholder="EMAIL ID">
									</div>
								</div>
								
								
								
							</div>
							
							
							
						</div>
					</div>
					
					
					
					<div class="col-md-6">
						<div class="row">
							
							<div class="box-header well col-md-12">
								<h2>NOMINEE DETAILS continued</h2>
							</div>
							
							<div class="alert alert-danger">
								
								<!--Nominee Detail continued-->
								
								<div class="form-group">
									<label class="control-label col-sm-4">Gender:</label>
									<div class="col-md-8">
										<select class="form-control" id="ngender" name="ngender" placeholder="SELECT GENDER">
											<option value="">--Select Gender--</option>
											<option>Male</option>
											<option>Female</option>
										</select>
									</div>
								</div>
								
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Marital Status:</label>
									<div class="col-md-8">
										<select class="form-control" id="nmstate" name="nmstate" placeholder="SELECT MARITAL STATUS">
											<option value="">--Select Marital Status--</option>
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
										<input type="text" class="form-control" id="nmno" name="nmno" placeholder="MOBILE NUMBER">
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npno" name="npno" placeholder="PHONE NUMBER">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nadd" name="nadd" placeholder="ADDRESS">
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ncity" name="ncity" placeholder="CITY">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ndist" name="ndist" placeholder="DISTRICT">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nstate" name="nstate" placeholder="STATE">
									</div>
								</div>
								
								<div class="col-md-8 hidden">
									<input type="text" class="form-control" id="branchcd" name="branchcd">
								</div>
								
								<input type="text" class="form-control hidden" id="x" name="x" >
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npin" name="npin" placeholder="PINCODE">
									</div>
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


<script>
	$('#md').hide();
	$('#rdd').hide();
	$('#rddyear').hide();
	$('#agent').hide();//Newly Added
	$('.fdagent').hide();//Newly Added
	//Cancel button
	$('.cnclbtn').click(function(e)
	{
		alert('are you sure?');
		$('.accclassid').click();
	});
	
	
	//Get BranchCode
	$('#branch').change(function(e){
		branchid=$('#branch').data('value');
		$.ajax({
			url:'GetBranchid',
			type:'post',
			data:'&branch='+branchid,
			success:function(data)
			{
				$('#branchcd').val(data['bcode']);
			}
		});
	});
	
	
	
	//Submit button
	a=0;
	$('.sbmbtn').click( function(e) {
		if(a==0)
		{
			a++;
			$("#form_acc").validate({
				rules:{
					crtdte:{
						required:true,
						//date:true
					},
					actype:"required",
					m:{
						required:true,
						//date:true
					},
					bname:"required",
					user:"required",
					ob:
					{
						required:true,
						number:true
					},
					nfname:"required",
					ngender:"required",
					nmstate:"required",
					noccup:"required",
					nmno:{
						required:true,
						number:true,
						maxlength:10,
						minlength:10
					},
					nadd:"required",
					ncity:"required",
					ndist:"required",
					nstate:"required",
					npin:{
						required:true,
						number:true,
						maxlength:6,
						minlength:6
					},
				}
			});
			if($("#form_acc").valid())
			{
				a=$('.typeahead2').data('value');
				branchid=a;
				acttype=$('.typeahead1').val();
				acctyp=$('.typeahead1').data('value');
				user_name=$('.typeahead3').data('value');
				agentid=$('.typeaheadagnt').data('value');//Newly Added
				e.preventDefault();
				$.ajax({
					url: 'createacc',
					type: 'post',
					data: $('#form_acc').serialize()+ '&branchid=' + a + '&acctyp_11=' + acctyp + '&user_ss=' + user_name+'&atype='+acttype+'&agid='+agentid,
					success: function(data) {
						//alert('success');
						$('.accclassid').click();
					}
				});
			}
		}
	});
	$('.typeahead1').change(function(e){
		ft=$('.typeahead1').val();
		if(ft=="RD"||ft=="Recurring Deposit")
		{
			//$('#rdd').show();
			$('#md').show();
			$('#agent').show();//Newly Added
			//$('.fdagent').show();//Newly Added
		}
		else
		{
			$('#rdd').hide();
			$('#rddurtn').val("0");
			$('#md').hide();
			$('#m').val("0");
			$('#agent').hide();//Newly Added
			//$('.fdagent').hide();//Newly Added
		}
	});
	
	$('#usr').change(function(e){
		//alert("hai");
		user_name=$('#usr').data('value');
		//alert(user_name);
		e.preventDefault();
		$.ajax({
			url: 'checkaccount',
			type: 'post',
			data:'&userid='+user_name,
			success: function(data) {
				
				$('#x').val(data['chk']);
				
				m=$('#x').val();
				s=$('#actyp').val();
				
				if(m==user_name&&s=="SB")
				{
					alert("ACCOUNT ALREADY EXISTs");
					
					$('.accclassid').click();
				}
				
			}
		});
	});
	
	function mdateyear()
	{
		/*var year=$('#rddurtn').val();mdate
			//alert(year);
			var month=year*12;
			var start_date = document.getElementById('crtdte').value;
			//alert(start_date);
			var c_start_date = start_date.split('-').reverse().join('-');;
			var c_start_date_obj = new Date(c_start_date);
			var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(month), c_start_date_obj.getDate());
			var c = (c_end_date_obj.getMonth())+1;
			var c_end_date = c_end_date_obj.getDate() + '/' + c + '/' + c_end_date_obj.getFullYear();
		document.getElementById('m').value = c_end_date;*/
		
		//var start_date = document.getElementById('crtdte').value;
		var year1=$('#rddurtn').val();
		var dateObj = new Date();
		var month = dateObj.getUTCMonth() + 1; //months from 1-12
		var day = dateObj.getUTCDate();
		var year = dateObj.getUTCFullYear();
		var newdate2 = day + "/" + month + "/" + year;
		var totyears=parseInt(year)+parseInt(year1);
		var newdate1 = day + "/" + month + "/" + totyears;
		var m = moment(newdate1, 'DD/MM/YYYY');
		var hhx=m.isValid(); // false
		
		while(hhx==false)
		{
			
			day=parseInt(day)-1;
			newdate1 = day + "/" + month + "/" + totyears;
			m = moment(newdate1, 'DD/MM/YYYY');
			hhx=m.isValid(); // false
		}
		
		newDate=newdate1;
		document.getElementById('m').value = newDate;
		
		
	}
	function mdatemonth()
	{
		var months5=$('#rddurtnmonth').val();
		Date.isLeapYear = function (year) { 
			return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0)); 
		};
		
		Date.getDaysInMonth = function (year, month) {
			return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
		};
		
		Date.prototype.isLeapYear = function () { 
			return Date.isLeapYear(this.getFullYear()); 
		};
		
		Date.prototype.getDaysInMonth = function () { 
			return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
		};
		
		Date.prototype.addMonths = function (value) {
			var n = this.getDate();
			this.setDate(1);
			this.setMonth(this.getMonth() + value);
			this.setDate(Math.min(n, this.getDaysInMonth()));
			return this;
		};
		
		var myDate = new Date();
		var result1 = myDate.addMonths(months5);
		
		var dateObj1 = new Date(result1);
		var month = dateObj1.getUTCMonth() + 1; //months from 1-12
		var day = dateObj1.getUTCDate();
		var year = dateObj1.getUTCFullYear();
		var newdate5 = day + "/" + month + "/" + year;
		
		
		
		document.getElementById('m').value = newdate5;
		//document.getElementById('fdedtereadonly').value = newdate5;
	}	
	$('input.typeahead2').typeahead({
		ajax: '/GetBranches'
		
		
	});
	$('input.typeahead1').typeahead({
		ajax: '/Getacctyp'
	});
	$('input.typeahead3').typeahead({
		
		ajax: '/Getuser'
	});
	
	$('input.typeaheadagnt').typeahead({
		
		ajax: '/GetFDAgent'
	});
	$('#thragnt').click(function(e){
		if($('#thragnt').is(":checked"))
		{
			$('.fdagent').show();
		}
		else{
			$('.fdagent').hide();
		}
	});
	$('#durationcheck').click(function(e){
		if($('#durationcheck').is(":checked"))
		{
			$('#rdd').show();
			$('#rddyear').hide();
		}
		else{ rddurtnmonth
			$('#rdd').hide();
			$('#rddyear').show();
		}
	});

		$('.datepicker').datepicker().on('changeDate',function(e){
	$(this).datepicker('hide');
	});