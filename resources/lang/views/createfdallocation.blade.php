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
										<input style="border-color:red" class="typeahead1 form-control"  id="branchname"  placeholder="SELECT BRANCH NAME">  
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">User Name:</label>
									<div class="col-md-8">
										<input style="border-color:red"id="usr" class="typeahead3 form-control"  type="text" name="user" placeholder="SELECT user">  
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
									<input type="checkbox" id="KanCheck" name="KanCheck" value="0" onblur="intrest();"/>
									
								</label>
								<div class="fdintmonthly">
									<div class="form-group ">
										<label class="control-label col-sm-4">Interest Needed For:</label>
										<div class="col-md-8">
											<select class="form-control" id="fdintmonthly" name="fdintmonthly">
												<option>--Select Month--</option>
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
								
								<div class="form-group">
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
										<!--<input type="text" class="form-control" id="fdsbamount" name="fdsbamount" placeholder="SB AMOUNT" onblur="enddate();">-->
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
								</div>-->
								
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
								</div>
								
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Deposit Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fddep" name="fddep" onblur="enddate();" onkeyup="enddate();">
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Start Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="fdallocreadonly" name="fdallocreadonly" value="<?php echo date("d/m/Y");?>" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="fdalloc" name="fdalloc" value="<?php echo date("d/m/Y");?>" >
								<input type="text" class="form-control hidden" id="fdallocreport" name="fdallocreport" value="<?php echo date("Y-m-d");?>" >
								
								
								
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
										<input type="text" class="form-control" id="mamtreadonly" name="mamtreadonly" disabled>
									</div>
								</div>
								<input type="text" class="form-control hidden" id="mamt" name="mamt" >
								
								
								
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
								
								<input type="text" id="monthinterest"name="monthinterest" class="hidden"/>
								<input type="text" id="NumberOfMonth"name="NumberOfMonth" class="hidden"/>
								<input type="text" id="NumberOfYears"name="NumberOfYears" class="hidden"/>
								<input type="text" id="BasedON"name="BasedON" class="hidden"/>
								
								
								
								
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
	var newdate;
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
		
		var days = $('#fdyear').val();
		var base = $('#BasedON').val();
		var month1 = $('#NumberOfMonth').val();
		var year1 = $('#NumberOfYears').val();
		var mon=parseInt(month1);
		
		var dateObj = new Date();
		var month = dateObj.getUTCMonth() + 1; //months from 1-12
		var day = dateObj.getUTCDate();
		var year = dateObj.getUTCFullYear();
		var newdate2 = month + "/" + day + "/" + year;
		if(base=="YEAR")
		{
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
			
		}
		else if(base=="DAYS")
		{
			var now = new Date();
			
			now = new Date(new Date().getTime()+(days*24*60*60*1000))
			
			var dd = now.getDate();
			var mm = now.getMonth()+1;//January is 0!
			var yyyy = now.getFullYear();
			
			if(dd<10){dd='0'+dd}
			if(mm<10){mm='0'+mm}
			
			var newDate = dd+'/'+mm+'/'+yyyy;
			document.getElementById('fdedte').value = newDate;
			document.getElementById('fdedtereadonly').value = newDate;
			
		}
		else if(base=="MONTHS")
		{
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
			var result1 = myDate.addMonths(mon);
			
			var dateObj1 = new Date(result1);
		var month = dateObj1.getUTCMonth() + 1; //months from 1-12
		var day = dateObj1.getUTCDate();
		var year = dateObj1.getUTCFullYear();
		var newdate5 = day + "/" + month + "/" + year;
			
			
			
			document.getElementById('fdedte').value = newdate5;
			document.getElementById('fdedtereadonly').value = newdate5;
		}
		
		
		//FD Maturity Amount Calculation(Modified By Sush)
		fdmode=$('#fdpaymode').val();
		if(fdmode=="CASH")
		{
			var depositamt=$('#fddep').val();
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
		
		else if(fdmode=="CHEQUE")
		{
			var depositamt=$('#fddep').val();
			var interestamt1=$('#fdint').val();
			var interestamt=interestamt1/100;
			var noofdays=$('#fdyear').val();
			var a= (noofdays*depositamt*interestamt)/365;
			var x=(parseFloat(a)+parseFloat(depositamt));
			//x=+x.toFixed(2);
			x=Math.round(x);
			$('#mamt').val(x);
			$('#mamtreadonly').val(x);
			$('#fduncleared').val(depositamt);
			$('#fdunclearedval').val("UNCLEARED");
		}
		
		else if(fdmode=="SB ACCOUNT")
		{
			var depositamt=$('#fddep').val();
			var interestamt1=$('#fdint').val();
			var interestamt=interestamt1/100;
			var noofdays=$('#fdyear').val();
			var a= (noofdays*depositamt*interestamt)/365;
			var x=(parseFloat(a)+parseFloat(depositamt));
			//x=+x.toFixed(2);
			x=Math.round(x);
			var sbamt=$('#fdsbamount').val();
			if(sbamt>250)
			{
				var rem=(parseFloat(sbamt)-parseFloat(depositamt));
				if(rem<250)
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
			acc1=$('.acctypeahead1').data('value');
			user=$('.typeahead3').data('value');
			fd=$('.fdtypeahead').data('value');
			branch=$('#branchname').data('value');
			//alert(branch);
			e.preventDefault();
			$.ajax({
				
				url: 'crtfdalloc',
				type: 'post',
				data: $('#form_fdalloc').serialize() + '&accid=' + acc +'&fdtid='+fd+'&bid='+branch+'&userid='+user+'&month='+month+'&intneeded='+intneeded+'&accid='+acc1,
				success: function(data) {
					//alert('success');
					$('.fdallocclassid').click();
					//window.location.reload(true);
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
				$('#BasedON').val(data['BasedON']);
				
				
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
		ajax:'/GetFdtype'
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
