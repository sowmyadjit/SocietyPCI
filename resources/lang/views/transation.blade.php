<script src="js/jquery.validate.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>	
<link href="css/datepicker.css" rel='stylesheet'>
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a>
			</li>
			<li>
				<a class="clickme" >Transaction</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Transaction</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				
				<div class="alert alert-info">
					<div class="form-group">
						
						<div class="row table-row">
							
							<center>
								<a href="TranReceiptHome" class="btn btn-primary ReceView">RECEIPT</a>
							</center>
							
							
						</div>
					</div>
				</div>
				
				
				{!! Form::open(['url' => "createtransaction",'class' => 'form-horizontal','id' => 'form_tran','method'=>'post']) !!}
				<div class="Message1">
					<h1 style="color:red;"><center>Day Is Not Open, Please Contact The Manager</center></h1>
				</div>
				
				<div class="Message2">
					<h1 style="color:red;"><center>Day Is Closed, Please Contact The Manager</center></h1>
				</div>
				
				
				
				<div class="tran">
					<div class="form-group">
						<label class="control-label col-sm-4">Transaction Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="tt" name="tt">
								<option>-----select  Transaction-----</option>
								<option>SB Transaction</option>
								<option>PIGMI Transaction</option>
								<option>RD Transaction</option>
								<option>Loan Transaction</option>
								<option>Divident Transaction</option>
							</select>
						</div>
					</div>
				</div>
				
				
				<!--SB Transaction-->
				<div class="row sb">
					
					
					<input type="text" class="form-control hidden" id="acctype" name="acctype">
					
					
					<!--	<div class="form-group">
						<label class="control-label col-sm-4">Date:</label>
						<div class="col-md-4">
						<!--<input class="form-control"  id="dte" name="dte" type="text" value="<?php echo date('d/m/Y');?>">  
						<input class="form-control"  id="dte" name="dte" type="text" value="<?php echo date('Y-m-d');?>">  
						</div>
					</div>-->
					
					<div class="form-group">
						<label class="col-sm-4 control-label">CREATED DATE</label>
						<div class="col-md-4 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="dte"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="hidden">
						<label class="control-label col-sm-4">Time:</label>
						<div class="col-md-4">
							<input class="form-control"  id="tme" name="tme" type="text" value="<?php echo date('H:i:s');?>">  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Branch Name:</label>
						<div class="col-md-4">
							<input class="typeahead3 form-control"  id="branchnme" type="text" name="branchnme" placeholder="SELECT BRANCH">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Account Number:</label>
						<div class="col-md-4">
							<input class="typeahead form-control"  id="account" type="text" name="account" placeholder="SELECT Account Number">  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Account Holder Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="ACCOUNT HOLDER NAME" disabled>
						</div>
					</div>
					
					<div class="form-group hidden">
						<label class="control-label col-sm-4" for="comment">Account Type:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="at" name="at" placeholder="ACCOUNT TYPE" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Transaction Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="trantyp" name="trantyp">
								<option>--Select Transaction--</option>
								<option>CREDIT</option>
								<option>DEBIT</option>
							</select>
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="paymode" name="paymode">
								<option>--Select Payment Mode--</option>
								<option>CASH</option>
								<option>CHEQUE</option>
							</select>
						</div>
					</div>
					<div class="form-group chequenum">
						<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="chequeno" name="chequeno" placeholder="CHEQUE NUMBER">
						</div>
					</div>
					
					
					
					
					
					
					<div class="form-group chequedte">
						<label class="col-sm-4 control-label">CHEQUE DATE</label>
						<div class="col-md-4 date">
							
							
							<!--<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="chequedate" id="chequedate"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
								<span class="glyphicon glyphicon-calendar">
								</span>
								</span>
							</div>-->
							<div class="input-group input-append">
								<input type="text" name="chdate" id="chdate" class="form-control" />
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
									<b class="caret"></b>
								</span> 
								
								
								
								
							</div>
						</div>
					</div>
					
					
					
					<div class="form-group bnknme">
						<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bankname" name="bankname" placeholder="BANK NAME">
						</div>
					</div>
					<div class="form-group banktyp">
						<label class="control-label col-sm-4">Bank Name:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="typeaheadbank form-control"  type="text" id="bn" placeholder="SELECT Bank"  >  
						</div>
					</div>
					
					<div class="form-group bnkbranch">
						<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bankbranch" name="bankbranch" placeholder="BANK BRANCH">
						</div>
					</div>			
					
					<div class="form-group ifsccde">
						<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ifsccode" name="ifsccode" placeholder="IFSC CODE">
						</div>
					</div>
					
					
					
					
					
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="uncleared" name="uncleared">
					</div>
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="unclearedval" name="unclearedval" value="CLEARED">
					</div>
					
					
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Particulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="par" name="par" placeholder="Particulars">
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Current Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="cbreadonly" name="cbreadonly" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="cb" name="cb" placeholder="Current Balance:">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="sb_amount" name="sb_amount" placeholder="Amount" onblur="calculate();" onkeyup="calculate();" required>
						</div>
					</div>
					
					
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Total Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="tbredonly" name="tbredonly" disabled required>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="tb" name="tb" placeholder="Total Balance" required>
					
					
					<center>
						
						<div >
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
				</div>
				
				
				<!--Pigmi Transaction-->
				<div class="row pigmi">	
					
					<!--<div class="form-group">
						<label class="control-label col-sm-4">Transaction Date:</label>
						<div class="col-md-4">
						<input class="form-control"  id="ptdte" name="ptdte" type="text" value="<?php echo date('d/m/Y');?>">  
						</div>
					</div>-->
					
					<div class="form-group">
						<label class="col-sm-4 control-label">CREATED DATE</label>
						<div class="col-md-4 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="ptdte"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					<div class="hidden">
						<label class="control-label col-sm-4">Transaction Time:</label>
						<div class="col-sm-4">
							<input class="form-control"  id="pttme" name="pttme" type="text" value="<?php echo Date('H:i:s');?>">  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Branch Name:</label>
						<div class="col-md-4">
							<input class="typeahead5 form-control"  id="pgmbranchnme" type="text" name="pgmbranchnme" placeholder="SELECT BRANCH">  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Agent Name:</label>
						<div class="col-md-4">
							<input class="typeahead1 form-control ptagnt"  id="ptagnt" name="ptagnt" placeholder="SELECT AGENT NAME" required>  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Account Number:</label>
						<div class="col-md-4">
							<div id='shw'><select class="form-control pigaccnumdd"  id="pigaccnumdd" name="pigaccnumdd"  >
								<option value="">--Select Account Number--</option>
							</select>
							</div>
							<div id='hd'></div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Customer Name:</label>
						<div class="col-md-4">
							<input class="form-control" type="text"  id="custname" name="custname" placeholder="CUSTOMER NAME" disabled>  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Pigmi Type:</label>
						<div class="col-md-4">
							<input class="form-control hidden" type="text"  id="pgtype" name="pgtype" placeholder="PIGMI TYPE">  
							<input class="form-control" type="text"  id="pgtypereadonly" name="pgtypereadonly" placeholder="PIGMI TYPE" disabled>  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Current Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="curbalreadonly" name="curbalreadonly" placeholder="CURRENT BALANCE" disabled>
						</div>
					</div>
					
					<input type="text" class="form-control hidden" id="curbal" name="curbal" placeholder="CURRENT BALANCE">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Transaction Type:</label>
						<div class="col-md-4">
							<input class="form-control" type="text" id="trtypereadonly" name="trtypereadonly" value="CREDIT" disabled>
						</div>
					</div>
					<input class="form-control hidden" type="text" id="trtype" name="trtype" value="CREDIT">
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="pgmpaymode" name="pgmpaymode">
								<option>--Select Payment Mode--</option>
								<option>CASH</option>
								<option>CHEQUE</option>
							</select>
						</div>
					</div>
					<div class="form-group pgmchequenum">
						<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgmchequeno" name="pgmchequeno" placeholder="CHEQUE NUMBER">
						</div>
					</div>
					
					
					<div class="form-group pgmchequedte">
						<label class="col-sm-4 control-label">CHEQUE DATE</label>
						<div class="col-md-4 date">
							
							<div class="input-group input-append">
								<input type="text" name="pgmchdate" id="pgmchdate" class="form-control" />
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar"></span>
									<b class="caret"></b>
								</span> 
								
							</div>
						</div>
					</div>
					
					
					
					<div class="form-group pgmbnknme">
						<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgmbankname" name="pgmbankname" placeholder="BANK NAME">
						</div>
					</div>
					
					
					<div class="form-group pgmbnkbranch">
						<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgmbankbranch" name="pgmbankbranch" placeholder="BANK BRANCH">
						</div>
					</div>			
					
					<div class="form-group pgmifsccde">
						<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgmifsccode" name="pgmifsccode" placeholder="IFSC CODE">
						</div>
					</div>
					
					
					
					
					
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="pgmuncleared" name="pgmuncleared">
					</div>
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="pgmunclearedval" name="pgmunclearedval" value="CLEARED">
					</div>
					
					
					
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Particulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ptpar" name="ptpar" placeholder="Particulars">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgamount" name="pgamount" placeholder="AMOUNT" onblur="pgcalculate();" onkeyup="pgcalculate();">
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgbalamtreadonly" name="pgbalamtreadonly" placeholder="TOTAL AMOUNT"disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="pgbalamt" name="pgbalamt" placeholder="TOTAL AMOUNT">
					<input type="text" class="form-control hidden" id="pgtid" name="pgtid">
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn1"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
				</div>
				
				
				<!--RD Transaction-->
				<div class="row rd">
					<div >
						
						<input type="text" class="form-control hidden" id="rdacctype" name="rdacctype">
					</div>
					
					<!--	<div class="form-group">
						<label class="control-label col-sm-4">Date:</label>
						<div class="col-sm-4">
						
						<input class="form-control"  id="rddte" name="rddte" type="text" value="<?php echo date('Y-m-d');?>">  
						</div>
					</div>-->
					
					
					<div class="form-group">
						<label class="col-sm-4 control-label">CREATED DATE</label>
						<div class="col-md-4 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="rddte"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="hidden">
						<label class="control-label col-sm-4">Time:</label>
						<div class="col-sm-4">
							<input class="form-control"  id="rdtme" name="rdtme" type="text" value="<?php echo date('H:i:s');?>">  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Branch Name:</label>
						<div class="col-md-4">
							<input class="typeahead4 form-control"  id="rdbranchnme" type="text" name="rdbranchnme" placeholder="SELECT BRANCH">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Account Number:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="typeahead2 form-control" id="rdaccount" type="text" placeholder="ACCOUNT NUMBER">  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Account Holder Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdnamereadonly" name="rdnamereadonly" placeholder="ACCOUNT HOLDER NAME" disabled>
						</div>
					</div>
					
					<input type="text" class="form-control hidden" id="rdname" name="rdname" placeholder="ACCOUNT HOLDER NAME">
					
					<div class="form-group">
						<label class="control-label col-sm-4">Account Type:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdatreadonly" name="rdatreadonly" placeholder="ACCOUNT TYPE" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="rdat" name="rdat" placeholder="ACCOUNT TYPE">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">RD Duration:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rddurationreadonly" name="rddurationreadonly" placeholder="RD DURATION" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="rdduration" name="rdduration" placeholder="RD DURATION">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Transaction Type:</label>
						<div class="col-sm-4">
							<input class="form-control" id="rdtrantypreadonly" name="rdtrantypreadonly" value="CREDIT" disabled>
						</div>
					</div>
					<input class="form-control hidden" id="rdtrantyp" name="rdtrantyp" value="CREDIT">
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="rdpaymode" name="rdpaymode">
								<option>--Select Payment Mode--</option>
								<option>CASH</option>
								<option>CHEQUE</option>
							</select>
						</div>
					</div>
					<div class="form-group rdchequenum">
						<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdchequeno" name="rdchequeno" placeholder="CHEQUE NUMBER">
						</div>
					</div>
					
					
					
					
					
					
					<div class="form-group rdchequedte">
						<label class="col-sm-4 control-label">CHEQUE DATE</label>
						<div class="col-md-4 date">
							
							
							<!--<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="chequedate" id="chequedate"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
								<span class="glyphicon glyphicon-calendar">
								</span>
								</span>
							</div>-->
							<div class="input-group input-append">
								<input type="text" name="rdchdate" id="rdchdate" class="form-control" />
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
									<b class="caret"></b>
								</span> 
								
								
								
								
							</div>
						</div>
					</div>
					
					
					
					<div class="form-group rdbnknme">
						<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdbankname" name="rdbankname" placeholder="BANK NAME">
						</div>
					</div>
					
					
					<div class="form-group rdbnkbranch">
						<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdbankbranch" name="rdbankbranch" placeholder="BANK BRANCH">
						</div>
					</div>			
					
					<div class="form-group rdifsccde">
						<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdifsccode" name="rdifsccode" placeholder="IFSC CODE">
						</div>
					</div>
					
					
					
					
					
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="rduncleared" name="rduncleared">
					</div>
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="rdunclearedval" name="rdunclearedval" value="CLEARED">
					</div>
					
					
					
					
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Particulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdpar" name="rdpar" placeholder="PARTICULARS">
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Current Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdcbreadonly" name="rdcbreadonly" placeholder="CURRENT BALANCE" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="rdcb" name="rdcb" placeholder="CURRENT BALANCE">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdamount" name="rdamount" placeholder="AMOUNT" onblur="calculaterd();" onkeyup="calculaterd();">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdtbreadonly" name="rdtbreadonly" placeholder="TOTAL BALANCE" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="rdtb" name="rdtb" placeholder="TOTAL BALANCE">
					
					
					<center>
						
						<div >
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn2"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
				</div>
				
				
				
				<!--Loan Transaction-->
				<div class="row loan">
					<div>
						
						<input type="text" class="form-control hidden" id="lnacctype" name="lnacctype">
					</div>
					
					<!--<div class="form-group">
						<label class="control-label col-sm-4">Date:</label>
						<div class="col-sm-4">
						
						<input class="form-control"  id="lndte" name="lndte" type="text" value="<?php echo date('Y-m-d');?>">  
						</div>
					</div>-->
					<div class="form-group">
						<label class="col-sm-4 control-label">CREATED DATE</label>
						<div class="col-md-8 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="lndte"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="hidden">
						<label class="control-label col-sm-4">Time:</label>
						<div class="col-sm-4">
							<input class="form-control"  id="lntme" name="lntme" type="text" value="<?php echo date('H:i:s');?>">  
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Branch Name:</label>
						<div class="col-md-4">
							<input class="typeahead6 form-control"  id="lnbranchnme" type="text" name="lnbranchnme" placeholder="SELECT BRANCH" required>  
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Account Number:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="typeahead7 form-control" id="lnaccount" type="text" placeholder="ACCOUNT NUMBER" required>  
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Account Holder Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnnamereadonly" name="lnnamereadonly" placeholder="ACCOUNT HOLDER NAME" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="lnname" name="lnname" placeholder="ACCOUNT HOLDER NAME">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Loan Type:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnatreadonly" name="lnatreadonly" placeholder="LOAN TYPE" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="lnat" name="lnat" placeholder="LOAN TYPE">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Loan Duration:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lndurationreadonly" name="lndurationreadonly" placeholder="LOAN DURATION" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="lnduration" name="lnduration" placeholder="LOAN DURATION">
					
					<div class="form-group">
						<label class="control-label col-sm-4">Loan Amount:</label>
						<div class="col-sm-4">
							<input class="form-control" id="lnamtreadonly" name="lnamtreadonly" placeholder="LOAN AMOUNT" disabled>
						</div>
					</div>
					<input class="form-control hidden" id="lnamt" name="lnamt" placeholder="LOAN AMOUNT">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Remaining Amount:</label>
						<div class="col-sm-4">
							<input class="form-control" id="lnremamtreadonly" name="lnremamtreadonly" placeholder="REMAINING AMOUNT" disabled>
						</div>
					</div>
					<input class="form-control hidden" id="lnremamt" name="lnremamt" placeholder="REMAINING AMOUNT">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="lnpaymode" name="lnpaymode" required>
								<option>--Select Payment Mode--</option>
								<option>CASH</option>
								<option>CHEQUE</option>
								<option>SB ACCOUNT</option>
							</select>
						</div>
					</div>
					<div class="form-group lnchequenum">
						<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnchequeno" name="lnchequeno" placeholder="CHEQUE NUMBER" required>
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					<div class="form-group lnchequedte">
						<label class="col-sm-4 control-label">CHEQUE DATE</label>
						<div class="col-md-4 date">
							
							<div class="input-group input-append">
								<input type="text" name="lnchdate" id="lnchdate" class="form-control" required/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
									<b class="caret"></b>
								</span> 
							</div>
						</div>
					</div>
					
					
					
					<div class="form-group lnbnknme">
						<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnbankname" name="lnbankname" placeholder="BANK NAME" required>
						</div>
					</div>
					
					
					<div class="form-group lnbnkbranch">
						<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnbankbranch" name="lnbankbranch" placeholder="BANK BRANCH" required>
						</div>
					</div>			
					
					<div class="form-group lnifsccde">
						<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnifsccode" name="lnifsccode" placeholder="IFSC CODE">
						</div>
					</div>
					
					<div class="form-group lnsbamt">
						<label class="control-label col-sm-4" for="first_name">Amount Available:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="amtavailreadonly" name="amtavailreadonly" placeholder="AMOUNT AVAILABLE" disabled>
						</div>
					</div>		
					<input type="text" class="form-control hidden" id="amtavail" name="amtavail" placeholder="AMOUNT AVAILABLE">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Amount Payable:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="payamt" name="payamt" placeholder="AMOUNT PAYABLE" onblur="LoanCalc();" onkeyup="LoanCalc();" required>
						</div>
					</div>			
					
					
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="lnuncleared" name="lnuncleared">
					</div>
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="lnunclearedval" name="lnunclearedval" value="CLEARED">
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Particulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnpar" name="lnpar" placeholder="PARTICULARS" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Remaining Total:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="lnremtotreadonly" name="lnremtotreadonly" placeholder="REMAINING TOTAL" disabled required>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="lnremtot" name="lnremtot" placeholder="REMAINING TOTAL">
					
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="lnsbrem" name="lnsbrem" placeholder="REMAINING TOTAL">
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					<center>
						
						<div >
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm loansbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="RESET" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
				</div>
				
				
				<!--DIVIDENT DIV STARTS-->
				<div class="row divident">
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Certificate Number:</label>
						<div class="col-md-4">
							<input class="typeaheadcetificate form-control"  id="cn" type="text" name="cn" placeholder="SELECT Certificate Number">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Member Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="MemNameReadonly" name="MemNameReadonly" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Share Class:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ShareClassReadonly" name="ShareClassReadonly" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Total Shares:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="TotShareReadonly" name="TotShareReadonly" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Divident Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="DividentReadonly" name="DividentReadonly" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Amount To Pay:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="DividentAmountPay" name="DividentAmountPay" placeholder="AMOUNT TO PAY" required>
						</div>
					</div>
					
					<input type="text" class="form-control hidden" id="MemIdHidden" name="MemIdHidden" placeholder="AMOUNT TO PAY">
					
					<input type="text" class="form-control hidden" id="CertIdHidden" name="CertIdHidden" placeholder="AMOUNT TO PAY">
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="dividentpm" name="dividentpm">
								<option>-----select  Transaction-----</option>
								<option>CASH</option>
								<option>SB</option>
								
							</select>
						</div>
					</div>
					<div class="dividentsbacc">
						<div class="form-group">
							<label class="control-label col-sm-4">select SB Account:</label>
							<div class="col-md-4">
								<input class="typeaheaddvidentSb form-control"  id="dvidentsb" type="text" name="dvidentsb" placeholder="SELECT SB ACCOUNT Number">  
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Account Holder Name :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="DividentName" name="DividentName">
							</div>
						</div>
						
						
					</div>
					
					<center>
						
						<div >
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm DividentPaySbmBtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm DividentPayCncl"/>
								<input type="reset" value="RESET" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
					
					
				</div>
				<!--DIVIDENT DIV ENDS-->
				
			</form>
			
			
		</div>
	</div>
</div>
</div>






<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>


<div class="container">
	<!-- Trigger the modal with a button -->
	<button style='display:none;' type="button" class=" modal_btn btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Attention!</h4>
				</div>
				<div class="modal-body">
					<p>Please Contact The Manager To Open The Daily Transaction</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			
		</div>
	</div>
	
</div>


<script>
	$('.ReceView').click(function(e){
		e.preventDefault();
		$('.box').load($(this).attr('href'));
	});
	
	$('.tran').hide();
	$('.Message1').hide();
	$('.Message2').hide();
	$('.banktyp').hide();
	
	$temp1="<?php echo $state['open'];?>";
	$temp2="<?php echo $state['close'];?>";
	if($temp1==1)
	{
		if($temp2==0)
		{
			$('.tran').show();
		}
		else if($temp2==1)
		{
			
			$('.tran').hide();
			$('.Message2').show();
			$(".modal_btn").click();
			
		}
	}
	else if($temp1==0)
	{
		
		$('.tran').hide();
		$('.Message1').show();
		$(".modal_btn").click();
	}
	
	
	
	
	
	//Hide Cheque Number and Cheque Date (Newly Added)
	$('.chequedte').hide();
	$('.chequenum').hide();
	$('.bnknme').hide();
	$('.bnkbranch').hide();
	$('.ifsccde').hide();
	
	$('.rdchequedte').hide();
	$('.rdchequenum').hide();
	$('.rdbnknme').hide();
	$('.rdbnkbranch').hide();
	$('.rdifsccde').hide();
	
	$('.pgmchequedte').hide();
	$('.pgmchequenum').hide();
	$('.pgmbnknme').hide();
	$('.pgmbnkbranch').hide();
	$('.pgmifsccde').hide();
	
	$('.lnchequedte').hide();
	$('.lnchequenum').hide();
	$('.lnbnknme').hide();
	$('.lnbnkbranch').hide();
	$('.lnifsccde').hide();
	$('.lnsbamt').hide();
	
	
	//PaymentMode Changed (Newly Added)
	$('#paymode').change( function(e) {
		e.preventDefault();
		mode=$('#paymode').val();
		if(mode=="CASH")
		{
			$('.chequedte').hide();
			$('.chequenum').hide();
			$('.bnknme').hide();
			$('.bnkbranch').hide();
			$('.ifsccde').hide();
			
		}
		else if(mode=="CHEQUE"){
			tran=$('#trantyp').val();
			if(tran=="CREDIT")
			{
				$('.chequedte').show();
				$('.chequenum').show();
				$('.bnknme').show();
				$('.bnkbranch').show();
				$('.ifsccde').show();
			}
			else
			{
				$('.chequedte').show();
				$('.chequenum').show();
				$('.banktyp').show();
				$('.bnkbranch').show();
				$('.ifsccde').show();
				
			}
		}
		
		else{
			alert("Please Select the Payment Mode");
		}
	});
	
	//RDPaymentMode Changed (Newly Added)
	$('#rdpaymode').change( function(e) {
		e.preventDefault();
	rdmode=$('#rdpaymode').val();
	if(rdmode=="CASH")
	{
		$('.rdchequedte').hide();
		$('.rdchequenum').hide();
		$('.rdbnknme').hide();
		$('.rdbnkbranch').hide();
		$('.rdifsccde').hide();
	}
	else if(rdmode=="CHEQUE"){
		$('.rdchequedte').show();
		$('.rdchequenum').show();
		$('.rdbnknme').show();
		$('.rdbnkbranch').show();
		$('.rdifsccde').show();
	}
	else{
		alert("Please Select the Payment Mode");
	}
	});
	
	//PigmiPaymentMode Changed (Newly Added)
	$('#pgmpaymode').change( function(e) {
		e.preventDefault();
		pgmmode=$('#pgmpaymode').val();
		if(pgmmode=="CASH")
		{
			$('.pgmchequedte').hide();
			$('.pgmchequenum').hide();
			$('.pgmbnknme').hide();
			$('.pgmbnkbranch').hide();
			$('.pgmifsccde').hide();
		}
		else if(pgmmode=="CHEQUE"){
			$('.pgmchequedte').show();
			$('.pgmchequenum').show();
			$('.pgmbnknme').show();
			$('.pgmbnkbranch').show();
			$('.pgmifsccde').show();
		}
		else{
			alert("Please Select the Payment Mode");
		}
	});
	
	//LoanPaymentMode Changed (Newly Added)
	$('#lnpaymode').change( function(e) {
		e.preventDefault();
		lnmode=$('#lnpaymode').val();
		if(lnmode=="CASH")
		{
			$('.lnchequedte').hide();
			$('.lnchequenum').hide();
			$('.lnbnknme').hide();
			$('.lnbnkbranch').hide();
			$('.lnifsccde').hide();
			$('.lnsbamt').hide();
		}
		else if(lnmode=="CHEQUE"){
			$('.lnchequedte').show();
			$('.lnchequenum').show();
			$('.lnbnknme').show();
			$('.lnbnkbranch').show();
			$('.lnifsccde').show();
			$('.lnsbamt').hide();
		}
		else if(lnmode=="SB ACCOUNT"){
			$('.lnsbamt').show();
			$('.lnchequedte').hide();
			$('.lnchequenum').hide();
			$('.lnbnknme').hide();
			$('.lnbnkbranch').hide();
			$('.lnifsccde').hide();
			acct=$('#lnaccount').data('value');
			$.ajax({
				url:'RetrieveSBAmt',
				type:'post',
				data:'&actid='+acct,
				success:function(data)
				{
					$('#amtavail').val(data['total']);
					$('#amtavailreadonly').val(data['total']);
				}
			});
		}
		else{
			alert("Please Select the Payment Mode");
		}
	});
	
	//Calculate Loan Amount 
	function LoanCalc()
	{
		lnmode=$('#lnpaymode').val();
		if(lnmode=="SB ACCOUNT")
		{
			sbamt=$('#amtavail').val();
			remamt=$('#lnremamt').val();
			amtpay=$('#payamt').val();
			if(sbamt>250)
			{
				totremamt=(parseFloat(sbamt)-parseFloat(amtpay));
				if(amtpay>sbamt-250)
				{
					
					alert("Insufficient Balance in Your Account");
					$('#lnremtot').val("");
					$('#lnremtotreadonly').val("");
					$('#lnsbrem').val("");
					$('#payamt').val("");
					
				}
				else
				{
					totloanremain=(parseFloat(remamt)-parseFloat(amtpay));
					$('#lnremtot').val(totloanremain);
					$('#lnremtotreadonly').val(totloanremain);
					$('#lnsbrem').val(totremamt);
					
				}
			}
			else
			{
				
				alert("Insufficient Balance in Your Account");
				$('#lnremtot').val("");
				$('#lnremtotreadonly').val("");
				$('#lnsbrem').val("");
				
			}
		}
		else if(lnmode=="CASH")
		{
			remamt=$('#lnremamt').val();
			amtpay=$('#payamt').val();
			totloanremain=(parseFloat(remamt)-parseFloat(amtpay));
			$('#lnremtot').val(totloanremain);
			$('#lnremtotreadonly').val(totloanremain);
		}
		else if(lnmode=="CHEQUE")
		{
			remamt=$('#lnremamt').val();
			amtpay=$('#payamt').val();
			totloanremain=(parseFloat(remamt)-parseFloat(amtpay));
			$('#lnremtot').val(totloanremain);
			$('#lnremtotreadonly').val(totloanremain);
			$('#lnuncleared').val(amtpay);
			$('#lnunclearedval').val("UNCLEARED");
			
			
		}
		else
		{
			alert("Select Payment Mode");
		}
	}
	
	//Loan Submit Button
	$('.loansbmbtn').click(function(){
		$("#form_tran").validate({
			rules:{
				lndte:{
					required:true,
					date:true
				},
				lnbranchnme:"required",
				lnaccount:"required",
				payamt:"required",
				lnpar:"required",
				lnremtotreadonly:"required",
			}
			
		});
		if($("#form_tran").valid()){
			bid=$('#lnbranchnme').data('value');
			actid=$('#lnaccount').data('value');
			//alert(actid);
			$.ajax({
				url:'inserloantrans',
				type:'post',
				data:$('#form_tran').serialize()+'&branch='+bid+'&account='+actid,
				success:function(data)
				{
					//alert("Success");
					$('.tranclassid').click();
				}
			});
		}
	});
	
	$('.clickme').click(function(e)
	{
		$('.tranclassid').click();
	}); 
	
	
	$('input.typeaheadbank').typeahead({
		ajax: '/GetBank'
	});
	//SB Transaction Calculation
	
	function calculate()
	{ 
		amt=$('#sb_amount').val(); 
		ob=$('#cb').val();   //AVAILABLE AMOUNT
		
		trantype=$('#trantyp').val();
		pmode=$('#paymode').val();
		if(pmode=="CASH")
		{
			if(trantype=="CREDIT")
			{
				tot=(parseFloat(amt)+parseFloat(ob));
				//alert(tot);
				$('#tb').val(tot);
				$('#tbredonly').val(tot);
				
			}
			else
			{
				if(ob<=250)			//changed by manju
				{
					
					
					alert("Account Balance is low");     //changed by manju
				}
				else
				{
					
					if(amt<=ob-250)  //added by manju
					{
						tot=(parseFloat(ob)-parseFloat(amt));
						//alert(tot);
						$('#tb').val(tot);
						$('#tbredonly').val(tot);
						
					}
					else  //added by manju
					{
						
						$('#sb_amount').val("");
						alert("Account Balance is low");
						$('#tb').val("");
						$('#tbredonly').val("");
					}
					
					
				}
				
			}
		}
		
		
		else if(pmode=="CHEQUE")
		{
			if(trantype=="CREDIT")
			{
				//tot=(parseFloat(ob));
				//alert(tot);
				//unclear=(parseFloat(amt));
				$('#tb').val(ob);
				$('#tbredonly').val(ob);
				$('#uncleared').val(amt);
				$('#unclearedval').val("UNCLEARED");
			}
			else
			{
				
				if(ob<=250)			//changed by manju
				{
					
					
					alert("Account Balance is low");     //changed by manju
				}
				else
				{
					
					if(amt<=ob-250)  //added by manju
					{
						$('#tb').val(ob);
						$('#tbredonly').val(ob);
						$('#uncleared').val(amt);
						$('#unclearedval').val("UNCLEARED");
						
					}
					else  //added by manju
					{
						alert("Account Balance is low");
						$('#sb_amount').val("");
						
						$('#tb').val("");
						$('#tbredonly').val("");
					}
					
					
				}
				
			}
		}
	}
	
	
	
	//Hide and show design
	
	$('document').ready(function(){
		$('.sb').hide();
		$('.pigmi').hide();
		$('.rd').hide();
		$('.loan').hide(); //added
		$('.divident').hide(); //added
		
	});
	
	$('#tt').change(function(e){
		sbtran=$('#tt').val();
		if(sbtran=="SB Transaction")
		{
			
			$('.sb').show();
			$('.pigmi').hide();
			$('.rd').hide();
			$('.loan').hide(); //added
			$('.divident').hide();
			
		}
		else if(sbtran=="PIGMI Transaction")
		{
			$('.sb').hide();
			$('.pigmi').show();
			$('.rd').hide();
			$('.loan').hide(); //added
			$('.divident').hide();
			
		}
		else if(sbtran=="RD Transaction")
		{
			$('.sb').hide();
			$('.pigmi').hide();
			$('.rd').show();
			$('.loan').hide(); //added
			$('.divident').hide();
			
		}
		else if(sbtran=="Loan Transaction") //Added else if
		{
			$('.sb').hide();
			$('.pigmi').hide();
			$('.rd').hide();
			$('.loan').show(); 
			$('.divident').hide();
		}
		else if(sbtran=="Divident Transaction") //Added else if
		{
			$('.sb').hide();
			$('.pigmi').hide();
			$('.rd').hide();
			$('.loan').hide(); 
			$('.divident').show();
		}
		else
		{
			alert("Please Select the Transaction Type");
		}
		
	});
	
	//Cancel Window
	
	$('.cnclbtn').click(function(e)
	{
		alert('are you sure?');
		$('.tranclassid').click();
	});
	
	//SB Submit button
	s=0;
	$('.sbmbtn').click( function(e) {
		if(s==0)
		{
			s++;
			$("#form_tran").validate({
				rules:{
					dte:{
						required:true,
						date:true
					},
					account:"required",
					name:"required",
					at:"required",
					trantyp:"required",
					par:"required",
					sb_amount:{
						required:true,
						number:true
					},
					cb:{
						required:true,
						number:true
					},
					tb:{
						required:true,
						number:true
					},
				}
				
			});
			if($("#form_tran").valid()){
				bankid=$('.typeaheadbank').data('value');
				accnum=$('#account').data('value');
				brid=$('#branchnme').data('value');
				
				e.preventDefault();
				$.ajax({
					url: 'createtransaction',
					type: 'post',
					data: $('#form_tran').serialize()+'&actid='+accnum+'&branchid='+brid+'&bankid='+bankid,
					success: function(data) {
						//alert('success');
						$('.tranclassid').click();
					}
				});
			}
		}
	});
	
	
	
	
	
	
	//divident typeahead change
	$('#cn').change(function(e){
		
		PURPid=$('#cn').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'RetrieveMemData',
			type:'post',
			data:'&PURSH_Pid='+PURPid,
			success:function(data){
				MemName=data['FirstName']+" . "+data['MiddleName']+" . "+data['LastName'];
				$('#MemNameReadonly').val(MemName);
				$('#TotShareReadonly').val(data['PURSH_Noofshares']);
				$('#DividentReadonly').val(data['Divident_Amt']);
				$('#ShareClassReadonly').val(data['PURSH_Shrclass']);
				
				$('#MemIdHidden').val(data['PURSH_Memid']);
				$('#CertIdHidden').val(data['PURSH_Certfid']);
				
			}
		});
		
	});
	
	//SBAccount number change
	
	$('#account').change(function(e){
		accnum=$('#account').data('value');
		e.preventDefault();
		$.ajax({
			url:'retriveacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				$('#cb').val(data['crbal']);
				$('#cbreadonly').val(data['crbal']);
				$('#at').val(data['actype']);
				$('#name').val(data['fname']);
				$('#acctype').val(data['acid']);
			}
		});
	});
	//Agent name Changed
	
	$('.typeahead1').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		agent=$('.ptagnt').data('value');
		//alert(agent);
		e.preventDefault();
		$.ajax({
			url:'getAccountnumber',
			type:'get',
			data:'&agentID='+agent,
			success:function(data)
			{
				//alert(data);
				$('#shw').hide();
				$('#hd').html(data);
			}
		});
	});
	
	//PigmiAccount Number Changed
	
	function getacnum()
	{
		acc=$('#acctno').val();
		//alert(acc);
		$.ajax({
			url:'getAccholdername',
			type:'get',
			data:'&accname='+acc,
			success:function(data)
			{
				$('#custname').val(data['fstname']);
				$('#pgtype').val(data['pgmtype']);
				$('#pgtypereadonly').val(data['pgmtype']);
				$('#curbal').val(data['opbal']);
				$('#curbalreadonly').val(data['opbal']);
				$('#pgtid').val(data['ptid']);
			}
		});
	}
	
	//Pigmi Amount Calculation
	
	function pgcalculate()
	{
		pgmmode=$('#pgmpaymode').val();
		
		if(pgmmode=="CASH")
		{
			pgcur=$('#curbal').val();
			pgamt=$('#pgamount').val();
			total=(parseFloat(pgcur)+parseFloat(pgamt));
			$('#pgbalamt').val(total);
			$('#pgbalamtreadonly').val(total);
		}
		else if(pgmmode=="CHEQUE")
		{
			pgcur=$('#curbal').val();
			pgamt=$('#pgamount').val();
			//total=(parseFloat(pgcur)+parseFloat(pgamt));
			$('#pgbalamt').val(pgcur);
			$('#pgbalamtreadonly').val(pgcur);
			$('#pgmuncleared').val(pgamt);
			$('#pgmunclearedval').val("UNCLEARED");
		}
		else
		{
			alert("Please Select the Payment Mode");
		}
	}
	
	//Pigmi Submit button
	p=0;
	$('.sbmbtn1').click( function(e) {
		if(p==0)
		{
			p++;
			$("#form_tran").validate({
				rules:{
					ptdte:{
						required:true,
						date:true
					},
					ptagnt:"required",
					pigaccnumdd:"required",
					custname:"required",
					pgtype:"required",
					curbal:{
						required:true,
						number:true
					},
					trtype:"required",
					ptpar:"required",
					pgamount:{
						required:true,
						number:true
					},
					pgbalamt:{
						required:true,
						number:true
					},
					
				}
			});
			if($("#form_tran").valid())
			{
				agntno=$('.typeahead1').data('value');
				branch=$('#pgmbranchnme').data('value');
				e.preventDefault();
				$.ajax({
					url: 'createpigmitransaction',
					type: 'post',
					data: $('#form_tran').serialize()+'&agtid='+agntno+'&pgmbranch='+branch,
					success: function(data) {
						//alert('success');
						$('.tranclassid').click();
					}
				});
			}
		}
	});
	
	//typeahead events
	
	$('input.typeahead').typeahead({
		ajax: '/Getaccnum'
	});
	
	$('input.typeahead1').typeahead({
		ajax: '/getAllocateagentlist'
	});
	$('input.typeahead2').typeahead({
		ajax:'/Getrdaccnum'
	});
	
	//Typeahead for SB Branch Name (Newly Added)
	$('input.typeahead3').typeahead({
		ajax:'/Getbranchname'
	});
	
	//Typeahead for RD Branch Name (Newly Added)
	$('input.typeahead4').typeahead({
		ajax:'/Getrdbranchname'
	});
	//Typeahead for Pigmi Branch Name (Newly Added)
	$('input.typeahead5').typeahead({
		ajax:'/Getpgmbranchname'
	});
	
	//Typeahead for Loan Branch Name (Newly Added)
	$('input.typeahead6').typeahead({
		ajax:'/Getlnbranchname'
	});
	
	//Typeahead for Loan Account Number (Newly Added)
	$('input.typeahead7').typeahead({
		ajax:'/GetlnAccNum'
	});
	
	$('input.typeaheadcetificate').typeahead({
		ajax:'/Getcertificatnum'
	});
	
	$('input.typeaheaddvidentSb').typeahead({
		ajax: '/Getaccnum'
	});
	
	//RD Account Number Changed
	
	$('#rdaccount').change(function(e){
		accnum=$('#rdaccount').data('value');
		e.preventDefault();
		$.ajax({
			url:'retrieverdacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				$('#rdcb').val(data['rdcrbal']);
				$('#rdcbreadonly').val(data['rdcrbal']);
				$('#rdat').val(data['rdactype']);
				$('#rdatreadonly').val(data['rdactype']);
				$('#rdname').val(data['rdfname']);
				$('#rdnamereadonly').val(data['rdfname']);
				$('#rdacctype').val(data['rdacid']);
				$('#rdacctypereadonly').val(data['rdacid']);
				$('#rdduration').val(data['rdduration']);
				$('#rddurationreadonly').val(data['rdduration']);
			}
		});
	});
	
	//Calculate RD Total AMOUNT (Modified)
	function calculaterd()
	{
		rdpmode=$('#rdpaymode').val();
		if(rdpmode=="CASH")
		{
			amt=$('#rdamount').val();
			ob=$('#rdcb').val();
			tot=(parseFloat(amt)+parseFloat(ob));
			$('#rdtb').val(tot);
			$('#rdtbreadonly').val(tot);
		}
		else if(rdpmode=="CHEQUE")
		{
			amt=$('#rdamount').val();
			ob=$('#rdcb').val();
			//tot=(parseFloat(amt)+parseFloat(ob));
			$('#rdtb').val(ob);
			$('#rdtbreadonly').val(ob);
			$('#rduncleared').val(amt);
			$('#rdunclearedval').val("UNCLEARED");
		}
		else
		{
			alert("Please Select Payment Mode");
		}
		
	}
	
	//RD Submit button
	r=0;
	$('.sbmbtn2').click( function(e) {
		if(r==0)
		{
			r++;
			$("#form_tran").validate({
				rules:{
					rddte:{
						required:true,
						date:true
					},
					rdaccount:{
						required:true,
						number:true
					},
					rdname:"required",
					rdat:"required",
					rdduration:{
						required:true,
						number:true,
						maxlength:2
					},
					rdtrantyp:"required",
					rdpar:"required",
					rdamount:{
						required:true,
						number:true
					},
					rdcb:{
						required:true,
						number:true
					},
					rdtb:{
						required:true,
						number:true
					},
					
				}
				
			});
			if($("#form_tran").valid())
			{
				rdaccnum=$('.typeahead2').data('value');
				rdbrid=$('#rdbranchnme').data('value');
				e.preventDefault();
				$.ajax({
					url: 'createrdtransaction',
					type: 'post',
					data: $('#form_tran').serialize()+'&rdactid='+rdaccnum+'&rdbranch='+rdbrid,
					success: function(data) {
						//alert('success');
						$('.tranclassid').click();
					}
				});
			}
		}
	});
	
	//Loan Account Number Changed
	
	$('#lnaccount').change(function(e){
		accnum=$('#lnaccount').data('value');
		//alert(accnum);
		e.preventDefault();
		$.ajax({
			url:'retrieveloanacc',
			type:'post',
			data:'&actno='+accnum,
			success:function(data){
				//alert(data);
				$('#lnname').val(data['fname']);
				$('#lnnamereadonly').val(data['fname']);
				$('#lnat').val(data['loantype']);
				$('#lnatreadonly').val(data['loantype']);
				$('#lndurationreadonly').val(data['loandur']);
				$('#lnduration').val(data['loandur']);
				$('#lnamt').val(data['loanamt']);
				$('#lnamtreadonly').val(data['loanamt']);
				$('#lnremamt').val(data['remtotal']);
				$('#lnremamtreadonly').val(data['remtotal']);
			}
		});
	});
	
	
	$('.DividentPaySbmBtn').click( function(e) {
		$("#form_tran").validate({
			rules:{
				
				DividentAmountPay:"required",
				
			}
			
		});
		if($("#form_tran").valid()){
			Memid=$('#MemIdHidden').val();
			CertId=$('#CertIdHidden').val();
			DividAmtPay=$('#DividentAmountPay').val();
			DividAmt=$('#DividentReadonly').val();
			
			accnum=$('#dvidentsb').data('value');
			e.preventDefault();
			if(parseFloat(DividAmtPay)<=parseFloat(DividAmt))
			{
				
				$.ajax({
					url: 'CreateDividentTransaction',
					type: 'post',
					data: '&MemberId='+Memid+'&CertificateId='+CertId+'&DividentPaid='+DividAmtPay+'&accid='+accnum,
					success: function(data) {
						//alert('success');
						$('.tranclassid').click();
					}
				});
			}
			else
			{
				alert("Cannot Pay More Than Divident Amount");
			}
		}
	});
	
	$('#dividentpm').change(function(e){
		mode=$('#dividentpm').val();
		
		if(mode=="CASH")
		{
			$('.dividentsbacc').hide();
			
		}
		else if(mode=="SB"){
			$('.dividentsbacc').show();
			
		}
		
		else{
			alert("Please Select the Payment Mode");
		}
		
	});
	
</script>


<script>
	//SB Cheque Date (Newly Added)
	var chdate;
	
	$(function() {
		
		$(function() {
			$('input[name="chdate"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: 'DD-MM-YYYY'
				},
				
			}, 
			function(start, end, label) {
				
				// var years = moment().diff(start, 'years');
				//alert("You are " + years + " years old.");
			});
		});
		
	});
</script>
<script>
	//RD Cheque Date (Newly Added)
	var rdchdate;
	
	$(function() {
		
		$(function() {
			$('input[name="rdchdate"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: 'DD-MM-YYYY'
				},
				
				
				
				
			}, 
			function(start, end, label) {
				
				// var years = moment().diff(start, 'years');
				//alert("You are " + years + " years old.");
			});
		});
		
	});
</script>
<script>
	//Pigmi Cheque Date (Newly Added)
	var pgmchdate;
	
	$(function() {
		
		$(function() {
			$('input[name="pgmchdate"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: 'DD-MM-YYYY'
				},
				
				
				
				
			}, 
			function(start, end, label) {
				
				// var years = moment().diff(start, 'years');
				//alert("You are " + years + " years old.");
			});
		});
		
	});
</script>
<script>
	//Loan Cheque Date (Newly Added)
	var lndate;
	
	$(function() {
		
		$(function() {
			$('input[name="lnchdate"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: 'DD-MM-YYYY'
				},
				
			}, 
			function(start, end, label) {
				
				// var years = moment().diff(start, 'years');
				//alert("You are " + years + " years old.");
			});
		});
		
	});
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

