<?php
	
	$maturity_amt = $fdrenew['data']->Fd_DepositAmt * 2;

?>



<script src="js/bootstrap-typeahead.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>

<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>KCC ALLOCATION DETAILS</h2>
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
								<h2>KCC ALLOCATION DETAILS</h2>
							</div>
							<div class="alert alert-success">
								<div class="form-group">
									<label class="control-label col-sm-4">Branch Name:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="typeahead1 form-control"  id="branchname"  placeholder="SELECT BRANCH NAME"  value="<?php echo $fdrenew['data']->BName; ?>" readonly >  
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">User Name:</label>
									<div class="col-md-8">
										<input style="border-color:red"id="usr" class="typeahead3 form-control"  type="text" name="user" placeholder="SELECT user" value="<?php echo $fdrenew['data']->FirstName;echo $fdrenew['data']->MiddleName;echo $fdrenew['data']->LastName; ?>" data-value="<?php echo $fdrenew['data']->Uid; ?>" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">KCC Type:</label>
									<div class="col-md-8">
										<input style="border-color:red" class="fdtypeahead form-control" id="fdtype" type="text" placeholder="SELECT FD TYPE" onblur="enddate();" onkeyup="enddate();">  
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">Transaction Type:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdtrtype" name="fdtrtype" value="CREDIT" disabled>
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Payment Mode:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdpaymode" name="fdpaymode" value="RENEWAL" readonly>
									</div>
								</div>
								
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Deposit Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fddep" name="fddep" value="{{$fdrenew['data']->Fd_DepositAmt}}" data="{{$fdrenew['data']->Fd_DepositAmt}}" onblur="enddate();" onkeyup="enddate();" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">With Interest:</label>
									<div class="col-md-8">
										<input type="checkbox" id="with_interest" name="with_interest"  data="{{$fdrenew['data']->interest_amount}}" />
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Start Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdallocreadonly" name="fdallocreadonlysd" value="<?php echo date("d/m/Y",strtotime($fdrenew['data']->FdReport_MatureDate));?>" disabled>
										
										<input type="text" class="form-control hidden" id="fdallocreadonlysd" name="fdallocreadonlysd" value="<?php echo date("d/m/Y",strtotime($fdrenew['data']->FdReport_MatureDate));?>" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="fdalloc" name="fdalloc" value="<?php echo date("d/m/Y",strtotime($fdrenew['data']->FdReport_MatureDate));?>" >
								<input type="text" class="form-control hidden" id="fdallocreport" name="fdallocreport" value="<?php echo date("Y-m-d",strtotime($fdrenew['data']->FdReport_MatureDate));?>" >
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">End Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdedtereadonly" name="fdedtereadonly" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="fdedte" name="fdedte">
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Maturity Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="mamtreadonly" name="mamtreadonly" value="{{$maturity_amt}}" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="mamt" name="mamt" value="{{$maturity_amt}}">
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Remarks:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdrem" name="fdrem" placeholder="REMARKS" >
									</div>
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="branchcode" name="branchcode">
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="uid" name="uid">
								</div>
								
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
										<input type="text" class="form-control" id="nmname" name="nmname" placeholder="MIDDLE NAME" value="<?php echo $fdrenew['data']->Nom_MiddleName; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Last Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nlname" name="nlname" placeholder="LAST NAME" value="<?php echo $fdrenew['data']->Nom_LastName; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Relationship:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="reltn" name="reltn" placeholder="RELATIONSHIP" value="<?php echo $fdrenew['data']->Relationship; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nemail" name="nemail" placeholder="EMAIL ID" value="<?php echo $fdrenew['data']->Nom_Email; ?>">
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
										<input type="text" class="form-control" id="nage" name="nage" placeholder="AGE" value="<?php echo $fdrenew['data']->Nom_Age; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Birth Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nbdate" name="nbdate" placeholder="BIRTH DATE" value="<?php echo $fdrenew['data']->Nom_Birthdate; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="noccup" name="noccup" placeholder="OCCUPATION" value="<?php echo $fdrenew['data']->Nom_Occupation; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmno" name="nmno" placeholder="MOBILE NUMBER" value="<?php echo $fdrenew['data']->Nom_MobNo; ?>"  required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npno" name="npno" placeholder="PHONE NUMBER" value="<?php echo $fdrenew['data']->Nom_PhoneNo; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nadd" name="nadd" placeholder="ADDRESS" value="<?php echo $fdrenew['data']->Nom_Address; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ncity" name="ncity" placeholder="CITY" value="<?php echo $fdrenew['data']->Nom_City; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ndist" name="ndist" placeholder="DISTRICT" value="<?php echo $fdrenew['data']->Nom_District; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nstate" name="nstate" placeholder="STATE" value="<?php echo $fdrenew['data']->Nom_state; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npin" name="npin" placeholder="PINCODE" value="<?php echo $fdrenew['data']->Nom_Pincode; ?>" required>
									</div>
								</div>
								
								<input type="text" id="monthinterest"name="monthinterest" class="hidden"/>
								<input type="text" id="NumberOfMonth"name="NumberOfMonth" class="hidden"/>
								
								<input type="text" id="NumberOfYears"name="NumberOfYears" class="hidden"/>
								
								
								
								
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
	
	function enddate()
	{
		
		/*var start_date = document.getElementById('fdallocreadonlysd').value;
var c_start_date = start_date.split('/').reverse().join('/');;
var tenure = document.getElementById('NumberOfMonth').value; 
var c_start_date_obj = new Date(c_start_date);
var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(tenure), c_start_date_obj.getDate());
var c = (c_end_date_obj.getMonth())+1;
var c_end_date = c_end_date_obj.getDate() + '/' + c + '/' + c_end_date_obj.getFullYear();
document.getElementById('fdedtereadonly').value = c_end_date;
document.getElementById('fdedte').value = c_end_date;*/

var year1=$('#NumberOfYears').val();
		var start_date = $("#fdallocreport").val();
		var dateObj = new Date(start_date);
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
		document.getElementById('fdedte').value = newDate;
		document.getElementById('fdedtereadonly').value = newDate;
		


		
		fdmode=$('#fdpaymode').val();
		if(fdmode=="CASH")
		{
			var depositamt=$('#fddep').val();
			
			var a= (depositamt*2);
			$('#mamt').val(a);
			$('#mamtreadonly').val(a);
			
		}
		
		else if(fdmode=="CHEQUE")
		{
			var depositamt=$('#fddep').val();
			
			var x= (depositamt*2);
		
			$('#mamt').val(x);
			$('#mamtreadonly').val(x);
			$('#fduncleared').val(depositamt);
			$('#fdunclearedval').val("UNCLEARED");
		}
		
		else if(fdmode=="SB ACCOUNT")
		{
			
			var depositamt=$('#fddep').val();
			
			var x= (depositamt*2);
			
			var sbamt=$('#fdsbamount').val();
			if(sbamt>250)
			{
				var rem=(parseFloat(sbamt)-parseFloat(depositamt));
				if(depositamt>sbamt-250)
				{
					alert("Your SB Balance is low");
					$('#sbavailable').val("");
					$('#mamt').val("");
					$('#mamtreadonly').val("");
					$('#fddep').val("");
				}
				
				else
				{
					$('#sbavailable').val(rem);
					$('#mamt').val(x);
					$('#mamtreadonly').val(x);
				}	
			}
			else
			{
				alert("Your SB Balance is low");
				$('#sbavailable').val("");
				$('#mamt').val("");
				$('#mamtreadonly').val("");
				$('#fddep').val("");
			}
		}
	}
	
	
	$('.cnclbtn').click(function(e)
	{
		alert('are you sure?');
		$('.fdallocclassid').click();
	});
	
	f=0;
	$('.sbmbtn').click( function(e) {
		if(f==0)
		{
			f=f+1;
			
			//alert("hi");monthinterest
			month=$('#fdintmonthly').val();
			acc=$('.acctypeahead').data('value');
			// acc1=$('.acctypeahead1').data('value');
			user=$('.typeahead3').data('value');
			fd=$('.fdtypeahead').data('value');
			branch=$('#branchname').data('value');
			//alert(branch);
			e.preventDefault();

			var old_kcc_id = {{$fdrenew['data']->old_kcc_id}};
			$.ajax({
				
				url: 'kccrenewdetails',
				type: 'post',
				data: $('#form_fdalloc').serialize() + '&accid=' + acc +'&fdtid='+fd+'&bid='+branch+'&userid='+user+'&old_kcc_id='+old_kcc_id,//+'&accid='+acc1,
				success: function(data) {
					alert('success');
					$('.kccallocclassid').click();
					//window.location.reload(true);
				},
				error: function() {
					alert("FAILED!");
					console.log("Ajax call failed!");
					f = 0;
				}
			});
			
		}
	});
	
	//SBAccount number change
	
	$('#account').change(function(e){
		accnum=$('#account').data('value');
		e.preventDefault();
		$.ajax({
			url:'RetrieveSBAmount',
			type:'post',
			data:'&actid='+accnum,
			success:function(data)
			{
				$('#fdsbamount').val(data['total']);
				$('#fdsbamountreadonly').val(data['total']);
			}
		});
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
				$('#NumberOfYears').val(data['NumberOfYears']);
				
				
			}
		});
	});
	
	
	//Branch changed get Bank Name Number Changed
	
	$('#branchname').change(function(e){
		branch=$('#branchname').val();
		brid=$('#branchname').data('value');
		e.preventDefault();
		/*$.ajax({
			url:'getBranchName',
			type:'get',
			data:'&branchname='+branch,
			success:function(data)
			{
			$('#shw').hide();
			$('#hd').html(data);
			}
		});*/
		$.ajax({
			url:'retrivebranch',
			type:'post',
			data:'&branch='+brid,
			success:function(data){
				$('#branchcode').val(data['bcode']);
			}
		});
	});
	
	//Payment Mode Changed
	
	$('#fdpaymode').change(function(e){
		e.preventDefault();
		fdmode=$('#fdpaymode').val();
		if(fdmode=="CASH")
		{
			$('.fdchequenum').hide();
			$('.fdchequedte').hide();
			$('.fdbnknme').hide();
			$('.fdbnkbranch').hide();
			$('.fdbnkname').hide();
			$('.fdifsccde').hide();
			$('.fdsbamt').hide();
			$('#accnum').hide();
		}
		else if(fdmode=="CHEQUE")
		{
			$('.fdchequenum').show();
			$('.fdchequedte').show();
			$('.fdbnknme').show();
			$('.fdbnkbranch').show();
			$('.fdbnkname').show();
			$('.fdifsccde').show();
			$('.fdsbamt').hide();
			$('#accnum').hide();
		}
		else if(fdmode=="SB ACCOUNT"){
			$('.fdsbamt').show();
			$('.fdchequenum').hide();
			$('.fdchequedte').hide();
			$('.fdbnknme').hide();
			$('.fdbnkbranch').hide();
			$('.fdbnkname').hide();
			$('.fdifsccde').hide();
			//$('.fdsbamt').show();
			$('#accnum').show();
			
		}
		else{
			alert("Please Select the Payment Mode");
		}
	});
</script>
<script>
	$('input.acctypeahead1').typeahead({
		ajax: '/Getaccnum'
	});
	$('input.acctypeahead').typeahead({
		ajax: '/Getaccnum'
	});
	$('input.fdtypeahead').typeahead({
		ajax:'/GetKCCtype'
	});
	$('input.typeahead1').typeahead({
		ajax:'/GetFDBranches' //made changes: GetBranches  to GetFDBranches
	});
	$('input.typeahead3').typeahead({
		
		ajax: '/Getuser'
	});
	
	
	/*$('.chk').click(function(e)
		{
		e.preventDefault();
		a=$('ul.typeahead li.active').data('value');
		branchid=a;
		
	});*/
	
	//date("Y-m-d",strtotime(date("Y-m-d").'+24 months'));
</script>
<script>
	
	//FD Cheque Date (Newly Added)
	var fdchdate;
	
	$(function() {
		
		$(function() {
			$('input[name="fdchdate"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: 'DD-MM-YYYY'
				},
			}, 
			function(start, end, label) {
				
			});
		});
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
</script>

<script>
	// CAN BE RENEWED WITH INTEREST
	$("#with_interest").change(function() {
		var prev_kcc_amt = $("#fddep").attr("data");
		var prev_interest_amt = $("#with_interest").attr("data");
		// console.log("prev_kcc_amt = "+prev_kcc_amt);
		// console.log("prev_interest_amt = "+prev_interest_amt);

		var new_kcc_amt = 0;
		var new_maturity_amt = 0;

		if($(this).prop("checked")) { // with interest
			new_kcc_amt = parseFloat(prev_kcc_amt) + parseFloat(prev_interest_amt);
		} else { // WITHOUT INTEREST
			new_kcc_amt = parseFloat(prev_kcc_amt);
		}
		new_maturity_amt = parseFloat(new_kcc_amt) * 2;
		// console.log("new_kcc_amt = "+new_kcc_amt);
		$("#fddep").val(new_kcc_amt);
		$("#mamtreadonly").val(new_maturity_amt);
		$("#mamt").val(new_maturity_amt);
	});
</script>
