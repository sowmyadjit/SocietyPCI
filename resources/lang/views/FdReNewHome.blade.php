<script src="js/bootstrap-typeahead.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>

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
										<input style="border-color:red" class=" form-control"  id="branchname" value="<?php echo $fdrenew->BName; ?>" readonly >  
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">User Name:</label>
									<div class="col-md-8">
										<input style="border-color:red"id="usr" class=" form-control"  type="text" name="user" value="<?php echo $fdrenew->FirstName;echo $fdrenew->MiddleName;echo $fdrenew->LastName; ?>" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">FD Type:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="fdtypeahead form-control" id="fdtype" type="text" placeholder="SELECT FD TYPE">  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">FD Days:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdyear" name="fdyear" disabled>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">FD Interest:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdint" name="fdint" disabled>
									</div>
								</div>
								
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
								
								
								
								
							<!--	<div class="form-group">
									<label class="control-label col-sm-4">Payment Mode:</label>
									<div class="col-md-8">
										<select class="form-control" id="fdpaymode" name="fdpaymode">
											<option>--Select Payment Mode--</option>
											<option>CASH</option>
											<option>CHEQUE</option>
											<option>SB ACCOUNT</option>
										</select>
									</div>
								</div>
								
								<div class="form-group"id=accnum>
									<label class="control-label col-sm-4">Account Number:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="acctypeahead form-control"  id="account" type="account" placeholder="SELECT Account Number">  
									</div>
								</div>
								
								
								<div class="form-group fdsbamt">
									<label class="control-label col-sm-4">SB Amount:</label>
									<div class="col-md-8">
										<!--<input type="text" class="form-control" id="fdsbamount" name="fdsbamount" placeholder="SB AMOUNT" onblur="enddate();"
										<input type="text" class="form-control" id="fdsbamountreadonly" name="fdsbamountreadonly" placeholder="SB AMOUNT" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="fdsbamount" name="fdsbamount" placeholder="SB AMOUNT" >
								
								
								
								
								<div class="form-group fdchequenum">
									<label class="control-label col-sm-4">Cheque Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdchequeno" name="fdchequeno" placeholder="CHEQUE NUMBER">
									</div>
								</div>
								
								<div class="form-group fdchequedte">
									<label class="col-sm-4 control-label">CHEQUE DATE</label>
									<div class="col-md-8 date">
										
										<div class="input-group input-append">
											<input type="text" name="fdchdate" id="fdchdate" class="form-control" />
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
												<b class="caret"></b>
											</span> 
											
										</div>
									</div>
								</div>
								
								<!--	<div class="form-group fdbnknme">
									<label class="control-label col-sm-4">Bank Name:</label>
									<div class="col-md-8">
									<div id='shw'><select class="form-control"  >
									<option>--Select Bank Name--</option>
									</select>
									</div>
									<div id='hd'></div>
									
									</div>
								</div>
								
								<div class="form-group fdbnkname">
									<label class="control-label col-sm-4">Bank Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="FdBankName" name="FdBankName" placeholder="BANK NAME">
									</div>
								</div>
								
								
								<div class="form-group fdbnkbranch">
									<label class="control-label col-sm-4">Bank Branch:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdbankbranch" name="fdbankbranch" placeholder="BANK BRANCH">
									</div>
								</div>			
								
								<div class="form-group fdifsccde">
									<label class="control-label col-sm-4">IFSC Code:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdifsccode" name="fdifsccode" placeholder="IFSC CODE">
									</div>
								</div>
								
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="fduncleared" name="fduncleared">
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="fdunclearedval" name="fdunclearedval" value="CLEARED">
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="sbavailable" name="sbavailable">
								</div>-->
								
								<label class="control-label">Without Interest:
									<input type="checkbox" id="interstckeck" name="interstckeck" value="0" onclick="display();"/>
									
								</label>
								
								
								<div class="form-group fddep">
									<label class="control-label col-sm-4">Deposit Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fddep" name="fddep"  value="<?php echo round($fdrenew->Fd_DepositAmt); ?>" readonly>
										
										<input type="text" class="form-control hidden" id="fddephidden" name="fddephidden"  value="<?php echo round($fdrenew->Fd_DepositAmt); ?>" >
									</div>
								</div>
								<div class="form-group fddepwithinterest">
									<label class="control-label col-sm-4">Deposit Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fddepwithinterest" name="fddepwithinterest"  value="<?php echo round($fdrenew->Fd_TotalAmt); ?>" readonly>
										
										<input type="text" class="form-control hidden" id="fddepwithinteresthidden" name="fddepwithinteresthidden"  value="<?php echo round($fdrenew->Fd_TotalAmt); ?>" >
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Start Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdallocreadonly" name="fdallocreadonly" value="<?php echo $fdrenew->FdReport_MatureDate; ?>" readonly>
										<input type="text" class="form-control hidden" id="fdallocstaet" name="fdallocstaet" value="<?php echo $fdrenew->FdReport_MatureDate; ?>" >
									</div>
								</div>
								
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">End Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdedtereadonly" name="fdedtereadonly" >
										
									</div>
								</div>
								<input type="text" class="form-control hidden" id="fdedte" name="fdedte">
								
								
								
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
										<input type="text" class="form-control" id="nfname" name="nfname" placeholder="FIRST NAME" value="<?php echo $fdrenew->Nom_FirstName; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Middle Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmname" name="nmname" value="<?php echo $fdrenew->Nom_MiddleName; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Last Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nlname" name="nlname" value="<?php echo $fdrenew->Nom_LastName; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Relationship:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="reltn" name="reltn" value="<?php echo $fdrenew->Relationship; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nemail" name="nemail" value="<?php echo $fdrenew->Nom_Email; ?>">
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
										<input type="text" class="form-control" id="nage" name="nage" value="<?php echo $fdrenew->Nom_Age; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Birth Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nbdate" name="nbdate"value="<?php echo $fdrenew->Nom_Birthdate; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="noccup" name="noccup" value="<?php echo $fdrenew->Nom_Occupation; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmno" name="nmno" value="<?php echo $fdrenew->Nom_MobNo; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npno" name="npno" value="<?php echo $fdrenew->Nom_PhoneNo; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nadd" name="nadd" value="<?php echo $fdrenew->Nom_Address; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ncity" name="ncity" value="<?php echo $fdrenew->Nom_City; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ndist" name="ndist"value="<?php echo $fdrenew->Nom_District; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nstate" name="nstate" value="<?php echo $fdrenew->Nom_state; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npin" name="npin" value="<?php echo $fdrenew->Nom_Pincode; ?>" required>
									</div>
								</div>
								
								
								<input type="text" id="monthinterest"name="monthinterest" class="hidden"/>
								<input type="text" id="userid"name="userid" class="hidden"value="<?php echo $fdrenew->Uid; ?>"/>
								<input type="text" id="branchid"name="branchid" class="hidden"value="<?php echo $fdrenew->Bid; ?>"/>
								<input type="text" id="fdid"name="fdid" class="hidden"value="<?php echo $fdrenew->FdTid; ?>"/>
								<input type="text" id="fdallocid"name="fdallocid" class="hidden"value="<?php echo $fdrenew->Fdid; ?>"/>
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
	var depositamt;
	$('.fddep').hide();
	$('.fddepwithinterest').hide();
	intneeded=" ";
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
	/*var days = $('#NumberOfMonth').val();
		var now = new Date();
		
		now = new Date(new Date().getTime()+(days*24*60*60*1000))
		//alert(now);
		var dd = now.getDate();
		var mm = now.getMonth()+1;//January is 0!
		var yyyy = now.getFullYear();
		
		if(dd<10){dd='0'+dd}
		if(mm<10){mm='0'+mm}
		
		var newDate = dd+'/'+mm+'/'+yyyy;
		document.getElementById('fdedte').value = newDate;
		document.getElementById('fdedtereadonly').value = newDate;*/
		
		
		


var start_date = document.getElementById('fdallocstaet').value;
var c_start_date = start_date.split('/').reverse().join('/');;
var tenure = document.getElementById('NumberOfMonth').value; 
var c_start_date_obj = new Date(c_start_date);
var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(tenure), c_start_date_obj.getDate());
var c = (c_end_date_obj.getMonth())+1;
var c_end_date = c_end_date_obj.getDate() + '/' + c + '/' + c_end_date_obj.getFullYear();
document.getElementById('fdedtereadonly').value = c_end_date;
document.getElementById('fdedte').value = c_end_date;


		
		
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
			if(intneeded=="YES")
			{
				month=$('#fdintmonthly').val();
				if(month=="1 Month(30 days)")
				{
					days=30;
				}
				else if(month=="3 Month(90 days)")
				{
						days=90;
				}
				else if(month=="6 Month(180 days)")
				{
						days=180;
				}
			var a= (days*depositamt*interestamt)/365;
			a=Math.round(a);
			$('#monthinterest').val(a);
			$('#mamt').val(depositamt);
			$('#mamtreadonly').val(depositamt);
			}
			else
			{
				
			var noofdays=$('#fdyear').val();
			var a= (noofdays*depositamt*interestamt)/365;
			var x=(parseFloat(a)+parseFloat(depositamt));
			//x=+x.toFixed(2);
			x=Math.round(x);
			$('#mamt').val(x);
			$('#mamtreadonly').val(x);
			}
	
}	
	
	
	$('.sbmbtn').click( function(e) {
		
		month=$('#fdintmonthly').val();
		fdtype=$('#fdtype').data('value');
		acc1=$('.acctypeahead1').data('value');
		
		alert(depositamt);
		e.preventDefault();
		$.ajax({
			
			url: 'fdrenewdetails',
			type: 'post',
			data: $('#form_fdalloc').serialize()+'&accid='+acc1+'&depositamount='+depositamt+'&intneeded='+intneeded+'&month='+month+'&fdtype='+fdtype,
			success: function(data) {
				//alert('success');
				$('.tranclassid').click();
				//window.location.reload(true);
			}
		});
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
</script>
