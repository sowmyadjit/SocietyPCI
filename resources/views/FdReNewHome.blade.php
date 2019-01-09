<script src="js/bootstrap-typeahead.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>	
<link href="css/datepicker.css" rel='stylesheet'>
<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>FD ALLOCATION DETAILS</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => 'crtfdalloc','class' => 'form-horizontal','id' => 'form_fdalloc','method'=>'post']) !!}
					<div class="col-md-6">
						<div class="row">
							<div class="box-header well col-md-12">
								<h2>FD ALLOCATION DETAILS</h2>
							</div>
							<div class="alert alert-success">
								<div class="form-group">
									<label class="control-label col-sm-4">Branch Name:</label>
									<div class="col-md-8">
										<input style="border-color:red" class=" form-control"  id="branchname" value="<?php echo $fdrenew['data']->BName; ?>" readonly >  
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">User Name:</label>
									<div class="col-md-8">
										<input style="border-color:red"id="usr" class=" form-control"  type="text" name="user" value="<?php echo $fdrenew['data']->FirstName;echo $fdrenew['data']->MiddleName;echo $fdrenew['data']->LastName; ?>" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Start Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdallocreadonly" name="fdallocreadonly" value="<?php echo $fdrenew['data']->FdReport_MatureDate; ?>" readonly>
										<input type="text" class="form-control hidden" id="fdallocstaet" name="fdallocstaet" value="<?php echo $fdrenew['data']->FdReport_MatureDate; ?>" >
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label">End DATE</label>
									<div class="col-md-8 date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="fdedte" id="fdedte"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"onchange="datecalu();"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">Number Of Days:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="days form-control"  id="days"name="days" type="text" >  
									</div>
								</div>
								<div class="form-group">
									<label class="control-label inline col-sm-4">Interest:	</label>
									<div class="col-md-8">
										<select class="form-control interest"  id="interest" name="interest">  
											
											<?php foreach($fdrenew['int'] as $key){
												echo "<option value='".$key->FdTid."' >" .$key->FdInterest."";
												echo "</option>";
											} ?>
										</select>
									</div>
								</div>
								<input type="text" class="fdint hidden"id="fdint"/>
								<div class="form-group">
									<label class="control-label col-sm-4">Transaction Type:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdtrtype" name="fdtrtype" value="CREDIT" disabled>
									</div>
								</div>
								<label class="control-label">Interest Needed:
									<input type="checkbox" id="KanCheck" name="KanCheck" value="0" onclick="intrest();"/>
									
								</label>
								<div class="fdintmonthly">
									<div class="form-group ">
										<label class="control-label col-sm-4">Interest Needed For:</label>
										<div class="col-md-8">
											<select class="form-control" id="fdintmonthly" name="fdintmonthly">
												<option value="">--Select Month--</option>
												<option>1 Month(30 days)</option>
												<option>3 Month(90 days)</option>
												<option>6 Month(180 days)</option>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Account Number:</label>
										<div class="col-md-8">
											<input style="border-color:red" class="acctypeahead1 form-control"  id="account1" type="account1" placeholder="SELECT Account Number">  
										</div>
									</div>
								</div>
								
								
								
								
								
								<label class="control-label">Without Interest:
									<input type="checkbox" id="interstckeck" name="interstckeck" value="0" onclick="display();"/>
									
								</label>
								
								
								<div class="form-group fddep">
									<label class="control-label col-sm-4">Deposit Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fddep" name="fddep"  value="<?php echo round($fdrenew['data']->Fd_DepositAmt); ?>" readonly>
										
										<input type="text" class="form-control hidden" id="fddephidden" name="fddephidden"  value="<?php echo round($fdrenew['data']->Fd_DepositAmt); ?>" >
									</div>
								</div>
								<div class="form-group fddepwithinterest">
									<label class="control-label col-sm-4">Deposit Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fddepwithinterest" name="fddepwithinterest"  value="<?php echo round($fdrenew['data']->Fd_TotalAmt); ?>" readonly>
										
										<input type="text" class="form-control hidden" id="fddepwithinteresthidden" name="fddepwithinteresthidden"  value="<?php echo round($fdrenew['data']->Fd_TotalAmt); ?>" >
									</div>
								</div>
								
								
								
								
								
								
								
								
								<!--<div class="form-group">
									<label class="control-label col-sm-4">End Date:</label>
									<div class="col-md-8">
									<input type="text" class="form-control" id="fdedtereadonly" name="fdedtereadonly" >
									
									</div>
									</div>
								<input type="text" class="form-control hidden" id="fdedte" name="fdedte">-->
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Maturity Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="mamtreadonly" name="mamtreadonly" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="mamt" name="mamt" >
								
								
								
								
								
								
							</div>
							
						</div>
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
										<input type="text" class="form-control" id="nfname" name="nfname" placeholder="FIRST NAME" value="<?php echo $fdrenew['data']->Nom_FirstName; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Middle Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmname" name="nmname" value="<?php echo $fdrenew['data']->Nom_MiddleName; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Last Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nlname" name="nlname" value="<?php echo $fdrenew['data']->Nom_LastName; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Relationship:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="reltn" name="reltn" value="<?php echo $fdrenew['data']->Relationship; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nemail" name="nemail" value="<?php echo $fdrenew['data']->Nom_Email; ?>">
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
										<input type="text" class="form-control" id="nage" name="nage" value="<?php echo $fdrenew['data']->Nom_Age; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Birth Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nbdate" name="nbdate"value="<?php echo $fdrenew['data']->Nom_Birthdate; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="noccup" name="noccup" value="<?php echo $fdrenew['data']->Nom_Occupation; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmno" name="nmno" value="<?php echo $fdrenew['data']->Nom_MobNo; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npno" name="npno" value="<?php echo $fdrenew['data']->Nom_PhoneNo; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nadd" name="nadd" value="<?php echo $fdrenew['data']->Nom_Address; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ncity" name="ncity" value="<?php echo $fdrenew['data']->Nom_City; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ndist" name="ndist"value="<?php echo $fdrenew['data']->Nom_District; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nstate" name="nstate" value="<?php echo $fdrenew['data']->Nom_state; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npin" name="npin" value="<?php echo $fdrenew['data']->Nom_Pincode; ?>" required>
									</div>
								</div>
								
								
								<input type="text" id="monthinterest"name="monthinterest" class="hidden"/>
								<input type="text" id="userid"name="userid" class="hidden"value="<?php echo $fdrenew['data']->Uid; ?>"/>
								<input type="text" id="branchid"name="branchid" class="hidden"value="<?php echo $fdrenew['data']->Bid; ?>"/>
								<input type="text" id="fdid"name="fdid" class="hidden"value="<?php echo $fdrenew['data']->FdTid; ?>"/>
								<input type="text" id="fdallocid"name="fdallocid" class="hidden"value="<?php echo $fdrenew['data']->Fdid; ?>"/>
								<input type="text" id="NumberOfMonth"name="NumberOfMonth" class="hidden"/>
								
								
								
							</div>   <!-- DIV alert-danger ends here-->
						</div>
					</div>
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" class="btn btn-info btn-sm" VALUE = "CLEAR">
								
							</div>
						</div>
					</center>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<script>
	
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	var depositamt;
	$('.fddep').hide();
	$('.fddepwithinterest').hide();
	intneeded="NO";
	$('.fdchequenum').hide();
	$('.fdchequedte').hide();
	$('.fdbnknme').hide();
	$('.fdbnkbranch').hide();
	$('.fdbnkname').hide();
	$('.fdifsccde').hide();
	$('.fdsbamt').hide();
	$('#accnum').hide();
	$('.fdintmonthly').hide();
	
	function display()
	{
		
		
		if($('#interstckeck').is(":checked"))
		{
			
			$('.fddep').show();
			$('.fddepwithinterest').hide();
			depositamt=$('#fddephidden').val();
			//alert(depositamt);
			
		}
		else
		{
			
			$('.fddep').hide();
			$('.fddepwithinterest').show();
			depositamt=$('#fddepwithinteresthidden').val();
			//alert(depositamt);
		}
		
		
		var interestamt1=$('#fdint').val();
		var interestamt=interestamt1/100;
		
		
		
		if(intneeded=="NO")
		{	
			
			
			
				
				var interestamt1=$('#fdint').val();
				var interestamt=interestamt1/100;
				
				var noofdays=$('#days').val();
				var a= (noofdays*depositamt*interestamt)/365;
				var x=(parseFloat(a)+parseFloat(depositamt));
			
				
				//x=+x.toFixed(2);
				x=Math.round(x);
				$('#mamt').val(x);
				$('#mamtreadonly').val(x);
			
		}
		else
		{
			
			//var depositamt=$('#fddep').val();
			$('#mamt').val(depositamt);
			$('#mamtreadonly').val(depositamt);
			
				
			
		}
		
	}	
	
	var f=0;
	$('.sbmbtn').click( function(e) {
		
		month=$('#fdintmonthly').val();
		fdtype=$('#fdtype').data('value');
		acc1=$('.acctypeahead1').data('value');
		e.preventDefault();
		if(f == 0) {
			f=f+1;
			$.ajax({
				
				url: 'fdrenewdetails',
				type: 'post',
				data: $('#form_fdalloc').serialize()+'&accid='+acc1+'&depositamount='+depositamt+'&intneeded='+intneeded+'&month='+month+'&fdtype='+fdtype,
				success: function(data) {
					alert('success');
					$('.tranclassid').click();
					
				},
				error: function() {
					alert("FAILED!");
					console.log("Ajax call failed!");
					f = 0;
				}
			});
		}
	});
	
	
	
	
	
	
</script>
<script>
	
	$('input.acctypeahead1').typeahead({
		ajax: '/Getaccnum'
	});
	function intrest()
	{
		if($('#KanCheck').is(":checked"))
		{
			intneeded="YES";
			$('.fdintmonthly').show();
			
		}
		else
		{
			intneeded="NO";
			$('.fdintmonthly').hide();
		}
		
	}
	$('input.fdtypeahead').typeahead({
		ajax:'/GetFdtype'
	});
	$('#fdtype').change(function(e){
		fdtype=$('#fdtype').data('value');
		e.preventDefault();
		$.ajax({
			url:'retriveaccdet',
			type:'post',
			data:'&fdtypeid='+fdtype,
			success:function(data){
				
				$('#fdyear').val(data['fddayval']);
				$('#fdint').val(data['fdintval']);
				$('#NumberOfMonth').val(data['NumberOfMonth']);
				
				
			}
		});
	});
	
	function datecalu()
	{
		
		a=$('#fdallocstaet').val();
		
		ab=$('#fdedte').val();
		alert(ab);
		
		var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
		var firstDate = new Date(a);
		var secondDate = new Date(ab);
		
		var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
		
		$('#days').val(diffDays);
	}
	
	
	$('#interest').change(function(e){
		fdtype=$('#interest').val();
		e.preventDefault();
		$.ajax({
			url:'retriveaccdet',
			type:'post',
			data:'&fdtypeid='+fdtype,
			success:function(data){
				
				
				$('#fdint').val(data['fdintval']);
				
				
			}
		});
	});
</script>
