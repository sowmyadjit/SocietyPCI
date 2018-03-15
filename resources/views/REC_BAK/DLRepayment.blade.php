<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>
<div id="content" class="col-md-10">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Deposit Loan Repayment</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "dlrepay",'class' => 'form-horizontal','id' => 'form_dlrepay','method'=>'post']) !!}
					<div class="form-group">
						<label class="control-label col-sm-4">REPAYMENT TYPE:</label>
						<div class="col-md-4">
							<select class="form-control" id="repay" name="repay">
								<option value="">--Select REPAYMENT TYPE--</option>
								<option value="DEPOSIT LOAN">DEPOSIT LOAN</option>
								<option value="PERSONAL LOAN">PERSONAL LOAN</option>
								<option value="JEWEL LOAN">JEWEL LOAN</option>
								<option value="STAFF LOAN">STAFF LOAN</option>
							</select>
						</div>
					</div>
					<div class="dloan">
						<div class="form-group">
							<label class="control-label col-sm-4"> TYPES DEPOSIT LOAN:</label>
							<div class="col-md-4">
								<select class="form-control" id="dl" name="dl">
									<option value="">--Select TYPES DEPOSIT LOAN--</option>
									<option value="pygmy DL">pygmy DL</option>
									<option value="RD DL">RD DL</option>
									<option value="FD DL">FD DL</option>
								</select>
							</div>
						</div>
					</div>
					
					
					
					
					<!--PIGMY SECTION STARTS HERE-->
					<div class="pygmy">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Branch Name :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="BranchTypeAheadPG form-control"  type="text" placeholder="SELECT BRANCH" id="PgBranch">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Pygmy Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="PygmyAccNumTypeAhead form-control"  type="text" placeholder="SELECT PYGMY ACCOUNT NUMBER" id="PygmyAccNum">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Loan Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pgloannum" name="pgloannum" placeholder="LOAN NUMBER"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pgcustname" name="pgcustname" placeholder="CUSTOMER NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pgremamt" name="pgremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pgintamt" name="pgintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pay Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="pgpayamt" name="pgpayamt" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="PgPayMode" name="PgPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
									<option value="PIGMI ACCOUNT">PIGMI ACCOUNT</option>
									<option value="FD_ACCOUNT">FD ACCOUNT</option>
								</select>
							</div>
						</div>
						<div class="cheque_pigmy">
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequeno_pigmy" name="chequeno_pigmy" placeholder="CHEQUE NUMBER">
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Date:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequedate_pigmy" name="chequedate_pigmy" placeholder="CHEQUE DATE">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankname_pigmy" name="bankname_pigmy" placeholder="BANK NAME">
								</div>
							</div>
							
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankbranch_pigmy" name="bankbranch_pigmy" placeholder="BANK BRANCH">
								</div>
							</div>			
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ifsccode_pigmy" name="ifsccode_pigmy" placeholder="IFSC CODE">
								</div>
								
							</div>
							
							
							<div class="form-group  ">
								<label class="control-label col-sm-4">Credit Bank:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbankcrditbank form-control"  type="text" id="creditbank_pigmy" placeholder="SELECT Bank"  >  
								</div>
							</div>
						</div>
						<div class="PMSbForPDL">
							<div class="form-group sbacc">
								<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
								<div id="the-basics" class="col-sm-4">
									<input class="SBAccNumTypeAhead form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNum">  
								</div>
							</div>
							
							<div class="form-group pgsbaccnumb">
								<label class="control-label col-sm-4">SB Account Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="PgSBAccountNum" name="PgSBAccountNum" disabled>
								</div>
							</div>
							<input type="text" class="form-control hidden" id="PgSBAcNum" name="PgSBAcNum" >
							
							<div class="form-group pgsbavailable">
								<label class="control-label col-sm-4">SB Available Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="PgSBAvail" name="PgSBAvail" disabled>
									<input type="text" class="form-control hidden" id="PgSBAvailhidn" name="PgSBAvailhidn">
								</div>
							</div>
						</div>
						
						<!--<div class="form-group pgsbtotamt">
							<label class="control-label col-sm-4">SB Total Amount:</label>
							<div class="col-md-4">
							<input type="text" class="form-control" id="PgSBtotal" name="PgSBtotal" disabled>
							<input type="text" class="form-control hidden" id="PgSBtotalhidn" name="PgSBtotalhidn">
							</div>
						</div>-->
						<div class="PMPgmForPDL">
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pigmy Account Number :</label>
								<div id="the-basics" class="col-sm-4">
									<input class="PGMAccNumTypeAheadPDL form-control"  type="text" placeholder="SELECT PIGMY ACCOUNT NUMBER" id="PGMAccNumPDL">  
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pigmy Available Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="PgAvail" name="PgAvail" disabled>
									<input type="text" class="form-control hidden" id="PgAvailhidn" name="PgAvailhidn">
								</div>
							</div>
							
						</div>
						<div class="fdforPDL">
						<div class="form-group">
								<label class="control-label col-sm-4">FD Account Number :</label>
								<div id="the-basics" class="col-sm-4">
									<input class="FDAccNumTypeAheadPDL form-control"  type="text" placeholder="SELECT FD ACCOUNT NUMBER" id="FDAccNumPDL">  
								</div>
							</div>
						</div>
						
						<input type="button" value="Add charages" class="btn btn-success btn-sm pdladdcharg"/>
						<div class="form-group" id="pdlcharge">
						</div>
						
						<input type="text" class="form-control hidden" id="Pgtotalhidn" name="Pgtotalhidn">
						<input type="text" class="form-control hidden" id="PgStdate" name="PgStdate">
						<input type="text" class="form-control hidden" id="Pgremtotamt" name="Pgremtotamt">
						<input type="text" class="form-control hidden" id="Pgacid" name="Pgacid">
						<input type="text" class="form-control hidden" id="Pgactid" name="Pgactid">
						<input type="text" class="form-control hidden" id="Pgallocid" name="Pgallocid">
						<input type="text" class="form-control hidden" id="Pgtypeid" name="Pgtypeid">
						<input type="text" class="form-control hidden" id="Pgagentid" name="Pgagentid">
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
									
									<input type="button" value="RENEW" class="btn btn-success btn-sm sbmbtn_renew" data-toggle="modal" data-target="#myModal"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
					</div>
					<!--PIGMY SECTION ENDS HERE-->
					
					
					
					
					<!--RD SECTION STARTS HERE-->
					<div class="RD">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Branch Name :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="BranchTypeAheadRD form-control"  type="text" placeholder="SELECT BRANCH" id="PgBranch">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">RD Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="RDAccNumTypeAhead form-control"  type="text" placeholder="SELECT RD ACCOUNT NUMBER" id="RDAccNum">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Loan Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdloannum" name="rdloannum" placeholder="LOAN NUMBER"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdcustname" name="rdcustname" placeholder="CUSTOMER NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdremamt" name="rdremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdintamt" name="rdintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pay Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdpayamt" name="rdpayamt" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="RdPayMode" name="RdPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
							</div>
						</div>
						<div class="cheque_rd">
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequeno_rd" name="chequeno_rd" placeholder="CHEQUE NUMBER">
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Date:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequedate_rd" name="chequedate_rd" placeholder="CHEQUE DATE">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankname_rd" name="bankname_rd" placeholder="BANK NAME">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4">Bank Name:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbank form-control"  type="text" id="bn_rd" placeholder="SELECT Bank"  >  
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankbranch_rd" name="bankbranch_rd" placeholder="BANK BRANCH">
								</div>
							</div>			
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ifsccode_rd" name="ifsccode_rd" placeholder="IFSC CODE">
								</div>
								
							</div>
							
							
							<div class="form-group  ">
								<label class="control-label col-sm-4">Credit Bank:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbankcrditbank form-control"  type="text" id="creditbank_rd" placeholder="SELECT Bank"  >  
								</div>
							</div>
						</div>
						<div class="form-group sbaccrd">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAheadRD form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumRD">  
							</div>
						</div>
						
						<div class="form-group rdsbaccnumb">
							<label class="control-label col-sm-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdSBAccountNum" name="rdSBAccountNum" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="rdSBAcNum" name="rdSBAcNum" >
						
						<div class="form-group rdsbavailable">
							<label class="control-label col-sm-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdSBAvail" name="rdSBAvail" disabled>
								<input type="text" class="form-control hidden" id="rdSBAvailhidn" name="rdSBAvailhidn">
							</div>
						</div>
						
						<!--<div class="form-group pgsbtotamt">
							<label class="control-label col-sm-4">SB Total Amount:</label>
							<div class="col-md-4">
							<input type="text" class="form-control" id="PgSBtotal" name="PgSBtotal" disabled>
							<input type="text" class="form-control hidden" id="PgSBtotalhidn" name="PgSBtotalhidn">
							</div>
						</div>-->
						
						<div class="form-group pgavailable">
							<label class="control-label col-sm-4">RD Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="rdAvail" name="rdAvail" disabled>
								<input type="text" class="form-control hidden" id="rdAvailhidn" name="rdAvailhidn">
							</div>
						</div>
						<div class="PMPgmForRDL">
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pigmy Account  :</label>
								<div id="the-basics" class="col-sm-4">
									<input class="PGMAccNumTypeAheadRDL form-control"  type="text" placeholder="SELECT PIGMY ACCOUNT NUMBER" id="PGMAccNumRDL">  
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pigmy Available Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="PgAvailforRD" name="PgAvailforRD" disabled>
									<input type="text" class="form-control hidden" id="PgAvailhidnforRD" name="PgAvailhidnforRD">
								</div>
							</div>
							
						</div>
						
						
						<input type="button" value="Add charages" class="btn btn-success btn-sm rddladdcharg"/>
						<div class="form-group" id="rddlcharge">
						</div>
						
						<input type="text" class="form-control hidden" id="rdtotalhidn" name="rdtotalhidn">
						<input type="text" class="form-control hidden" id="rdStdate" name="rdStdate">
						<input type="text" class="form-control hidden" id="rdremtotamt" name="rdremtotamt">
						<input type="text" class="form-control hidden" id="rdacid" name="rdacid">
						<input type="text" class="form-control hidden" id="rdactid" name="rdactid">
						<input type="text" class="form-control hidden" id="rdallocid" name="rdallocid">
						<input type="text" class="form-control hidden" id="rdtypeid" name="rdtypeid">
						<input type="text" class="form-control hidden" id="rdagentid" name="rdagentid">
						<input type="text" class="form-control hidden" id="PgacidforRD" name="PgacidforRD">
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
									<input type="button" value="RENEW" class="btn btn-success btn-sm sbmbtn_renew" data-toggle="modal" data-target="#myModal"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
					</div>
					<!--RD SECTION ENDS HERE-->
					
					
					
					
					
					<!--FD SECTION STARTS HERE-->
					<div class="FD">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Branch Name :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="BranchTypeAheadFD form-control"  type="text" placeholder="SELECT BRANCH" id="PgBranch">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">FD Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="FDAccNumTypeAhead form-control"  type="text" placeholder="SELECT FD ACCOUNT NUMBER" id="FDAccNum">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Loan Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdloannum" name="fdloannum" placeholder="LOAN NUMBER"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdcustname" name="fdcustname" placeholder="CUSTOMER NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdremamt" name="fdremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdintamt" name="fdintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pay Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdpayamt" name="fdpayamt" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="FdPayMode" name="FdPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="SB ACCOUNT">SB ACCOUNT</option>
<!--edit-->							<option value="FD_ACCOUNT">FD ACCOUNT</option>
								</select>
							</div>
						</div>
<!--edit-->
						<div class="fdforFDL">
							<div class="form-group">
								<label class="control-label col-sm-4">FD Account Number :</label>
								<div id="the-basics" class="col-sm-4">
										<input class="fdCertTypeAhead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH FD ACCOUNT">
									
								</div>
							</div>
							<div class="form-group fdfdavailable">
								<label class="control-label col-sm-4">FD Available Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="fdFDAvail" name="fdFDAvail" disabled>
									<input type="text" class="form-control hidden" id="Fdid" name="Fdid" disabled>
									<input type="text" class="form-control hidden" id="Fd_CertificateNum" name="Fd_CertificateNum">
								</div>
							</div>
							<div class="form-group fdfdavailable">
								<label class="control-label col-sm-4">FD Remaining Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="fdFDRem" name="fdFDRem" disabled>
								</div>
							</div>
						</div>
<!--edit-->
						<div class="cheque_fd">
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequeno_fd" name="chequeno_fd" placeholder="CHEQUE NUMBER">
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Date:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequedate_fd" name="chequedate_fd" placeholder="CHEQUE DATE">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankname_fd" name="bankname_fd" placeholder="BANK NAME">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4">Bank Name:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbank form-control"  type="text" id="bn_fd" placeholder="SELECT Bank"  >  
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankbranch_fd" name="bankbranch_fd" placeholder="BANK BRANCH">
								</div>
							</div>			
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ifsccode_fd" name="ifsccode_fd" placeholder="IFSC CODE">
								</div>
								
							</div>
							
							
							<div class="form-group  ">
								<label class="control-label col-sm-4">Credit Bank:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbankcrditbank form-control"  type="text" id="creditbank_fd" placeholder="SELECT Bank"  >  
								</div>
							</div>
						</div>
						<div class="form-group sbaccfd">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAheadFD form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumFD">  
							</div>
						</div>
						
						<div class="form-group fdsbaccnumb">
							<label class="control-label col-sm-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdSBAccountNum" name="fdSBAccountNum" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="fdSBAcNum" name="fdSBAcNum" >
						
						<div class="form-group fdsbavailable">
							<label class="control-label col-sm-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="fdSBAvail" name="fdSBAvail" disabled>
								<input type="text" class="form-control hidden" id="fdSBAvailhidn" name="fdSBAvailhidn">
							</div>
						</div>
						
						<!--<div class="form-group pgsbtotamt">
							<label class="control-label col-sm-4">SB Total Amount:</label>
							<div class="col-md-4">
							<input type="text" class="form-control" id="PgSBtotal" name="PgSBtotal" disabled>
							<input type="text" class="form-control hidden" id="PgSBtotalhidn" name="PgSBtotalhidn">
							</div>
						</div>-->
						
						<div class="form-group pgavailable">
							<label class="control-label col-sm-4">FD Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="FdAvail" name="FdAvail" disabled>
								<input type="text" class="form-control hidden" id="FdAvailhidn" name="FdAvailhidn">
							</div>
						</div>
						
						<input type="button" value="Add charages" class="btn btn-success btn-sm fddladdcharg"/>
						<div class="form-group" id="fddlcharge">
						</div>
						
						<input type="text" class="form-control hidden" id="fdtotalhidn" name="fdtotalhidn">
						<input type="text" class="form-control hidden" id="fdStdate" name="fdStdate">
						<input type="text" class="form-control hidden" id="fdremtotamt" name="fdremtotamt">
						<input type="text" class="form-control hidden" id="fdacid" name="fdacid">
						<input type="text" class="form-control hidden" id="fdactid" name="fdactid">
						<input type="text" class="form-control hidden" id="fdallocid" name="fdallocid">
						<input type="text" class="form-control hidden" id="fdtypeid" name="fdtypeid">
						<input type="text" class="form-control hidden" id="fdagentid" name="fdagentid">
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
									<input type="button" value="RENEW" class="btn btn-success btn-sm sbmbtn_renew" data-toggle="modal" data-target="#myModal"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
					</div>
					<!--FD SECTION ENDS HERE-->
					
					<!--personal loan SECTION STARTS HERE-->
					<div class="personal_loan">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Branch Name :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="BranchTypeAheadPL form-control"  type="text" placeholder="SELECT BRANCH" id="plBranch">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">PL Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="PLAccNumTypeAhead form-control"  type="text" placeholder="SELECT PL ACCOUNT NUMBER" id="PLAccNum">  
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plcustname" name="plcustname" placeholder="CUSTOMER NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plremamt" name="plremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plintamt" name="plintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">EMI Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plemi" name="plemi" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pending EMI Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plpendemi" name="plpendemi" placeholder="PENDING PAY AMOUNT" required/>
							</div>
						</div>
						<!--<div class="form-group">
							<label class="control-label inline col-sm-4">chareges:	</label>
							<div class="col-md-4">
							<select class="form-control "  id="cgarg" name="cgarg">  
							
							<?php foreach($chargeslist as $key){
								echo "<option value='".$key->charges_id."' >" .$key->charges_name."";
								echo "</option>";
							}?>
							</select>
							</div>
							
							
						</div>-->
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pay Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plpayamt" name="plpayamt" value="0" placeholder="PAY AMOUNT"onblur="getdata1();" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="plPayMode" name="plPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
									<option value="ADJUSTMENT">ADJUSTMENT</option>
								</select>
							</div>
						</div>
						
						
						<div class="form-group adjust">
							<label class="control-label col-sm-4" for="first_name">ADjustment Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="adjustmentTypeAheadPL form-control"  type="text"  id="adjustnum">  
							</div>
						</div>
						
						<div class="cheque_pl">
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequeno_pl" name="chequeno_pl" placeholder="CHEQUE NUMBER">
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Date:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequedate_pl" name="chequedate_pl" placeholder="CHEQUE DATE">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankname_pl" name="bankname_pl" placeholder="BANK NAME">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4">Bank Name:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbank form-control"  type="text" id="bn_pl" placeholder="SELECT Bank"  >  
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankbranch_pl" name="bankbranch_pl" placeholder="BANK BRANCH">
								</div>
							</div>			
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ifsccode_pl" name="ifsccode_pl" placeholder="IFSC CODE">
								</div>
								
							</div>
							
							
							<div class="form-group  ">
								<label class="control-label col-sm-4">Credit Bank:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbankcrditbank form-control"  type="text" id="creditbank_pl" placeholder="SELECT Bank"  >  
								</div>
							</div>
						</div>
						<div class="form-group sbaccpl">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAheadPL form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumpl">  
							</div>
						</div>
						
						<div class="form-group plsbaccnumb">
							<label class="control-label col-sm-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plSBAccountNum" name="plSBAccountNum" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="plSBAcNum" name="plSBAcNum" >
						
						<div class="form-group plsbavailable">
							<label class="control-label col-sm-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="plSBAvail" name="plSBAvail" disabled>
								<input type="text" class="form-control hidden" id="plSBAvailhidn" name="plSBAvailhidn">
							</div>
						</div>
						
						<input type="button" value="Add charages" class="btn btn-success btn-sm addcharg"/>
						
						<div class="pigmyforPL">
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pigmy Account  :</label>
								<div id="the-basics" class="col-sm-4">
									<input class="PGMAccNumTypeAheadPL form-control"  type="text" placeholder="SELECT PIGMY ACCOUNT NUMBER" id="PGMAccNumPL">  
								</div>
							</div>	
							
							<div class="form-group">
								<label class="control-label col-sm-4">Pigmy Available Amount:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="PgAvailforPL" name="PgAvailforPL" disabled>
									<input type="text" class="form-control hidden" id="PgAvailhidnforPL" name="PgAvailhidnforPL">
								</div>
							</div>
						</div>
						
						<div class="form-group" id="charge">
						</div>
						<input type="button" value="Add adjustment" class="btn btn-success btn-sm adjustmentcarg pull-right"/>
						<div class="form-group" id="adjustcharge">
						</div>
						
						<input type="text" class="form-control hidden" id="pltotalhidn" name="pltotalhidn">
						<input type="text" class="form-control hidden" id="plStdate" name="plStdate">
						<input type="text" class="form-control hidden" id="plremtotamt" name="plremtotamt">
						<input type="text" class="form-control hidden" id="placid" name="placid">
						<input type="text" class="form-control hidden" id="plactid" name="plactid">
						<input type="text" class="form-control hidden" id="plallocid" name="plallocid">
						<input type="text" class="form-control hidden" id="pltypeid" name="pltypeid">
						<input type="text" class="form-control hidden" id="plagentid" name="plagentid">
						<input type="text" class="form-control hidden" id="plpigmiid" name="plpigmiid">
						<input type="text" class="form-control hidden" id="pgyagentid" name="pgyagentid">
						<input type="text" class="form-control hidden" id="pgytypid" name="pgytypid">
						<input type="text" class="form-control hidden" id="balamt" name="balamt">
						<input type="text" class="form-control hidden" id="test" name="test">
						
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm PLRPSbmBtn"/>
									<input type="button" value="RENEW" class="btn btn-success btn-sm sbmbtn_plrenew" data-toggle="modal" data-target="#myModal_pl"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
						
					</div>
					<!--personal loan ENDS HERE-->
					
					
					<!--jewel loan SECTION STARTS HERE-->
					<div class="jewel_loan">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Branch Name :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="BranchTypeAheadJL form-control"  type="text" placeholder="SELECT BRANCH" id="jlBranch">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Receipt Date :</label>
							<div class="input-group input-append date col-sm-4" id="datePicker">
								<input type="text" class="form-control datepicker" name="rec_date" id="rec_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Interest upto :</label>
							<div class="input-group input-append date col-sm-4" id="datePicker">
								<input type="text" class="form-control datepicker" name="interest_upto" id="interest_upto"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">JL Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="JLAccNumTypeAhead form-control"  type="text" placeholder="SELECT PL ACCOUNT NUMBER" id="JLAccNum">  
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Customer Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jlcustname" name="jlcustname" placeholder="CUSTOMER NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jlremamt" name="jlremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jlintamt" name="jlintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group auction">
							<label class="control-label col-sm-4" for="comment">Auction Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="auc_amt" name="auc_amt" placeholder="AUCTION AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pay Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jlpayamt" name="jlpayamt" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="jlPayMode" name="jlPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="SB ACCOUNT">SB ACCOUNT</option>
									<option value="ADJUSTMENT">ADJUSTMENT</option>
								</select>
							</div>
						</div>
						
						
						<div class="form-group jladjust">
							<label class="control-label col-sm-4" for="first_name">ADjustment Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="adjustmentTypeAheadJL form-control"  type="text"  id="jladjust">  
							</div>
						</div>
						
						<div class="cheque_jl">
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequeno_jl" name="chequeno_jl" placeholder="CHEQUE NUMBER">
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Date:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequedate_jl" name="chequedate_jl" placeholder="CHEQUE DATE">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankname_jl" name="bankname_jl" placeholder="BANK NAME">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4">Bank Name:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbank form-control"  type="text" id="bn_jl" placeholder="SELECT Bank"  >  
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankbranch_jl" name="bankbranch_jl" placeholder="BANK BRANCH">
								</div>
							</div>			
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ifsccode_jl" name="ifsccode_jl" placeholder="IFSC CODE">
								</div>
								
							</div>
							
							
							<div class="form-group  ">
								<label class="control-label col-sm-4">Credit Bank:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbankcrditbank form-control"  type="text" id="creditbank_jl" placeholder="SELECT Bank"  >  
								</div>
							</div>
						</div>
						<div class="form-group sbaccjl">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAheadJL form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumjl">  
							</div>
						</div>
						
						<div class="form-group jlsbaccnumb">
							<label class="control-label col-sm-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jlSBAccountNum" name="jlSBAccountNum" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="jlSBAcNum" name="jlSBAcNum" >
						
						<div class="form-group jlsbavailable">
							<label class="control-label col-sm-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jlSBAvail" name="jlSBAvail" disabled>
								<input type="text" class="form-control hidden" id="jlSBAvailhidn" name="jlSBAvailhidn">
							</div>
						</div>
						<input type="button" value="Add charages" class="btn btn-success btn-sm jladdcharg"/>
						<div class="form-group" id="jlcharge">
						</div>
						<input type="text" class="form-control hidden" id="jltotalhidn" name="jltotalhidn">
						<input type="text" class="form-control hidden" id="jlStdate" name="jlStdate">
						<input type="text" class="form-control hidden" id="jlEnddate" name="jlEnddate">
						<input type="text" class="form-control hidden" id="jlremtotamt" name="jlremtotamt">
						<input type="text" class="form-control hidden" id="jlacid" name="jlacid">
						<input type="text" class="form-control hidden" id="jlactid" name="jlactid">
						<input type="text" class="form-control hidden" id="jlallocid" name="jlallocid">
						<input type="text" class="form-control hidden" id="jltypeid" name="jltypeid">
						<input type="text" class="form-control hidden" id="jlagentid" name="jlagentid">
						<input type="text" class="form-control hidden" id="jlloanremainigamt" name="jlloanremainigamt">
						<input type="text" class="form-control hidden" id="jldatecal" name="jldatecal">
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm JLRPSbmBtn"/>
									<input type="button" value="RENEW" class="btn btn-success btn-sm sbmbtn_renew_jwl" data-toggle="modal" data-target="#myModal_jl"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
					</div>
					<!--jewel loan ENDS HERE-->
					
					
					
					<!--staff loan SECTION STARTS HERE-->
					<div class="staff_loan">
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">Branch Name :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="BranchTypeAheadSL form-control"  type="text" placeholder="SELECT BRANCH" id="slBranch">  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="first_name">SL Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SLAccNumTypeAhead form-control"  type="text" placeholder="SELECT SL ACCOUNT NUMBER" id="SLAccNum">  
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Employee Name:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="slcustname" name="slcustname" placeholder="EMPLOYEE NAME"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Remaining Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="slremamt" name="slremamt" placeholder="REMAINING AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Interest Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="slintamt" name="slintamt" placeholder="INTEREST AMOUNT"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Pay Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="slpayamt" name="slpayamt" placeholder="PAY AMOUNT" onblur="cdamtchange();" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="slPayMode" name="slPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="CD">CD</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
							</div>
						</div>
						<div class="cheque_sl">
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Number:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequeno_sl" name="chequeno_sl" placeholder="CHEQUE NUMBER">
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Cheque Date:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="chequedate_sl" name="chequedate_sl" placeholder="CHEQUE DATE">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Name:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankname_sl" name="bankname_sl" placeholder="BANK NAME">
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-sm-4">Bank Name:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbank form-control"  type="text" id="bn_sl" placeholder="SELECT Bank"  >  
								</div>
							</div>
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">Bank Branch:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="bankbranch_sl" name="bankbranch_sl" placeholder="BANK BRANCH">
								</div>
							</div>			
							
							<div class="form-group ">
								<label class="control-label col-sm-4" for="first_name">IFSC Code:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ifsccode_sl" name="ifsccode_sl" placeholder="IFSC CODE">
								</div>
								
							</div>
							
							
							<div class="form-group  ">
								<label class="control-label col-sm-4">Credit Bank:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeaheadbankcrditbank form-control"  type="text" id="creditbank_sl" placeholder="SELECT Bank"  >  
								</div>
							</div>
						</div>
						<div class="form-group sbaccsl">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAheadSL form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumsl">  
							</div>
						</div>
						
						<div class="form-group CD">
							<label class="control-label col-sm-4">CD Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="cdamt_dis" name="cdamt_dis" >
								<input type="text" class="form-control hidden" id="cdamt" name="cdamt">
							</div>
						</div>
						
						<div class="form-group slsbaccnumb">
							<label class="control-label col-sm-4">SB Account Number:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="slSBAccountNum" name="slSBAccountNum" disabled>
							</div>
						</div>
						<input type="text" class="form-control hidden" id="slSBAcNum" name="slSBAcNum" >
						
						<div class="form-group slsbavailable">
							<label class="control-label col-sm-4">SB Available Amount:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="slSBAvail" name="slSBAvail" disabled>
								<input type="text" class="form-control hidden" id="slSBAvailhidn" name="slSBAvailhidn">
							</div>
						</div>
						
						
<!---------------------------sl add charge ------------------>

						<input type="button" value="Add charages" class="btn btn-success btn-sm sladdcharg"/>
						<div class="form-group" id="slcharge">
						</div>
<!---------------------------sl add charge ------------------>
						
						<input type="text" class="form-control hidden" id="sltotalhidn" name="sltotalhidn">
						<input type="text" class="form-control hidden" id="slStdate" name="slStdate">
						<input type="text" class="form-control hidden" id="slremtotamt" name="slremtotamt">
						<input type="text" class="form-control hidden" id="slacid" name="slacid">
						<input type="text" class="form-control hidden" id="slactid" name="slactid">
						<input type="text" class="form-control hidden" id="slallocid" name="slallocid">
						<input type="text" class="form-control hidden" id="sltypeid" name="sltypeid">
						<input type="text" class="form-control hidden" id="slagentid" name="slagentid">
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm SLRPSbmBtn"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
					</div>
					<!--staff loan ENDS HERE-->
					
				<div id="jewel_repayment">
				</div>
					
				</div>
				<!--</form>-->
				{!! Form::open() !!}
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="10" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> LOAN RENEWAL</h4>
			</div>
			<div class="modal-body">
				Are you sure for Renewal
			</div>
			
			
			<div class="modal-footer">
				
				
				<button class="btn btn-success btn-sm sbmbtn_renew1" id="save"  data-dismiss="modal">
					<span class="glyphicon glyphicon-send"></span> RENEWAL
				</button>
			<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button></center>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="myModal_jl" tabindex="10" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> LOAN RENEWAL</h4>
			</div>
			<div class="modal-body">
				Are you sure for Renewal
			</div>
			
			
			<div class="modal-footer">
				
				
				<button class="btn btn-success btn-sm sbmbtn_renew_jl" id="save"  data-dismiss="modal">
					<span class="glyphicon glyphicon-send"></span> RENEWAL
				</button>
			<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button></center>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="myModal_pl" tabindex="10" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> LOAN RENEWAL</h4>
			</div>
			<div class="modal-body">
				Are you sure for Renewal
			</div>
			
			
			<div class="modal-footer">
				
				
				<button class="btn btn-success btn-sm sbmbtn_renew_pl" id="save"  data-dismiss="modal">
					<span class="glyphicon glyphicon-send"></span> RENEWAL
				</button>
			<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button></center>
		</div>
	</div>
</div>
</div>

<script>
	$('.fdforPDL').hide();
	$('.fdforFDL').hide();//edit
	$('.cheque_pigmy').hide();
	$('.cheque_rd').hide();
	$('.cheque_fd').hide();
	$('.cheque_pl').hide();
	$('.cheque_jl').hide();
	$('.cheque_sl').hide();
	$('.pgsbaccnumb').hide();
	$('.pgsbavailable').hide();
	$('.pgsbtotamt').hide();
	$('.pgavailable').hide();
	$('.pgtotamt').hide();
	$('.pygmy').hide();
	$('.RD').hide();
	$('.FD').hide();
	$('.dloan').hide();
	$('.sbacc').hide();
	$('.sbaccrd').hide();
	$('.rdsbaccnumb').hide();
	$('.rdsbavailable').hide();
	$('.sbaccfd').hide();
	$('.fdsbaccnumb').hide();
	$('.fdsbavailable').hide();	
	$('.sbaccpl').hide();
	$('.plsbaccnumb').hide();
	$('.plsbavailable').hide();
	$('.personal_loan').hide();
	$('.jlsbaccnumb').hide();
	$('.jlsbavailable').hide();
	$('.jewel_loan').hide();
	$('.sbaccjl').hide();
	$('.slsbaccnumb').hide();
	$('.slsbavailable').hide();
	$('.staff_loan').hide();
	$('.sbaccsl').hide();
	$('.PMPgmForPDL').hide();
	$('.PMPgmForRDL').hide();
	$('.pigmyforPL').hide();
	$('.auction').hide();
	$('.CD').hide();
	$('.adjust').hide();
	$('.adjustmentcarg').hide();
	$('.jladjust').hide();
	$('#repay').change(function(e)
	{
		repay1=$('#repay').val();
		if(repay1=="DEPOSIT LOAN")
		{
			$('.dloan').show();
			$('.personal_loan').hide();
			$('.jewel_loan').hide();
			$('.staff_loan').hide();
			$('.adjustmentcarg').hide();
		}
		else if(repay1=="PERSONAL LOAN")
		{
			$('.dloan').hide();
			$('.personal_loan').show();
			$('.adjustmentcarg').hide();
		}
		else if(repay1=="JEWEL LOAN")
		{
			$('.dloan').hide();
			$('.personal_loan').hide();
			$('.jewel_loan').show();
			$('.adjustmentcarg').hide();
		}
		else if(repay1=="STAFF LOAN")
		{
			$('.dloan').hide();
			$('.personal_loan').hide();
			$('.jewel_loan').hide();
			$('.staff_loan').show();
			$('.adjustmentcarg').hide();
		}
	});
	
	$('#dl').change(function(e)
	{
		dl=$('#dl').val();
		if(dl=="pygmy DL")
		{
			$('.pygmy').show();
			$('.RD').hide();
			$('.FD').hide();
			$('.adjustmentcarg').hide();
		}
		else if(dl=="RD DL")
		{
			$('.RD').show();
			$('.pygmy').hide();
			$('.FD').hide();
			$('.adjustmentcarg').hide();
		}
		else if(dl=="FD DL")
		{
			$('.RD').hide();
			$('.pygmy').hide();
			$('.FD').show();
			$('.adjustmentcarg').hide();
		}
		else
		{
			alert("Please Select The DL Type");
			$('.RD').hide();
			$('.pygmy').hide();
			$('.FD').hide();
			$('.adjustmentcarg').hide();
			
		}
	});
	
	$('#PgPayMode').change(function(e)
	{
		
		pmode=$('#PgPayMode').val();
		if(pmode=="CASH")
		{
			$('.pgsbaccnumb').hide();
			$('.pgsbavailable').hide();
			$('.pgsbtotamt').hide();
			$('.pgavailable').hide();
			$('.pgtotamt').hide();
			$('.sbacc').hide();
			$('.PMPgmForPDL').hide();
			$('.cheque_pigmy').hide();
			$('.adjustmentcarg').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{
			$('.cheque_pigmy').hide();
			$('.pgsbaccnumb').show();
			$('.sbacc').show();
			$('.pgsbavailable').show();
			$('.pgsbtotamt').show();
			$('.pgavailable').hide();
			$('.pgtotamt').hide();
			$('.PMPgmForPDL').hide();
			$('.adjustmentcarg').hide();
			$('.SBAccNumTypeAhead').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAhead').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#Pgacid').val(data['acid']);
						$('#PgSBAccountNum').val(data['acnum']);
						$('#PgSBAcNum').val(data['acnum']);
						$('#Pgactid').val(data['actid']);
						$('#PgSBAvail').val(data['totamt']);
						$('#PgSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		else if(pmode=="PIGMI ACCOUNT")
		{
			$('.cheque').hide();
			//$('.pgsbaccnumb').show();
			//$('.sbacc').show();
			//$('.pgsbavailable').show();
			//$('.pgsbtotamt').show();
			//$('.pgavailable').hide();
			$('.PMPgmForPDL').show();
			$('.PMSbForPDL').hide();
			$('.adjustmentcarg').hide();
			$('.PGMAccNumTypeAheadPDL').change(function(e)
			{
				AccNum=$('.PGMAccNumTypeAheadPDL').data('value');
				$.ajax({
					url:'/DLRepayGetPgmDetails',
					type:'post',
					data:'&pgAcNo='+AccNum,
					success:function(data)
					
					{
						
						/*$('#PgSBAccountNum').val(data['acnum']);
							$('#PgSBAcNum').val(data['acnum']);
							$('#Pgactid').val(data['actid']);
							$('#PgSBAvail').val(data['totamt']);
						$('#PgSBAvailhidn').val(data['totamt']);*/
						$('#Pgacid').val(data['acid']);
						$('#PgAvail').val(data['totamt']);
						$('#PgAvailhidn').val(data['totamt']);
					}
				});
			});
		}else if(pmode=="FD_ACCOUNT")
		{
			$('.cheque').hide();
			//$('.pgsbaccnumb').show();
			//$('.sbacc').show();
			//$('.pgsbavailable').show();
			//$('.pgsbtotamt').show();
			//$('.pgavailable').hide();
			$('.fdforPDL').show();
			$('.PMPgmForPDL').hide();
			$('.PMSbForPDL').hide();
			$('.adjustmentcarg').hide();
			/*$('.FDAccNumTypeAheadPDL').change(function(e)
			{
				AccNum=$('.PGMAccNumTypeAheadPDL').data('value');
				$.ajax({
					url:'/DLRepayGetPgmDetails',
					type:'post',
					data:'&pgAcNo='+AccNum,
					success:function(data)
					
					{
						
						
						$('#Pgacid').val(data['acid']);
						$('#PgAvail').val(data['totamt']);
						$('#PgAvailhidn').val(data['totamt']);
					}
				});
			});*/
		}
		else if(pmode=="CHEQUE")
		{
			$('.cheque_pigmy').show();
			$('.PMPgmForPDL').hide();
			$('.PMSbForPDL').hide();
			$('.pgsbaccnumb').hide();
			$('.sbacc').hide();
			$('.pgsbavailable').hide();
			$('.pgsbtotamt').hide();
			$('.pgavailable').hide();
			$('.pgtotamt').hide();
			$('.PMPgmForPDL').hide();
			$('.adjustmentcarg').hide();
		}
		else
		{
			alert("Please Select Payment Mode");
			
			$('.pgsbaccnumb').hide();
			$('.sbacc').hide();
			$('.pgsbavailable').hide();
			$('.pgsbtotamt').hide();
			$('.pgavailable').hide();
			$('.pgtotamt').hide();
			$('.cheque_pigmy').hide();
			$('.adjustmentcarg').hide();
			$('.PMPgmForPDL').hide();
		}
		
	});
	$('.cheque1').hide();
	$('#RdPayMode').change(function(e)
	{
		
		pmode=$('#RdPayMode').val();
		if(pmode=="CASH")
		{$('.adjustmentcarg').hide();
			$('.cheque_rd').hide();
			$('.rdsbaccnumb').hide();
			$('.rdsbavailable').hide();
			$('.rdsbtotamt').hide();
			$('.rdavailable').hide();
			$('.rdtotamt').hide();
			$('.sbaccrd').hide();
			$('.PMPgmForRDL').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.cheque_rd').hide();
			$('.rdsbaccnumb').show();
			$('.sbaccrd').show();
			$('.rdsbavailable').show();
			$('.rdsbtotamt').show();
			$('.rdavailable').hide();
			$('.rdtotamt').hide();
			$('.PMPgmForRDL').hide();
			$('.SBAccNumTypeAheadRD').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAheadRD').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#rdacid').val(data['acid']);
						$('#rdSBAccountNum').val(data['acnum']);
						$('#rdSBAcNum').val(data['acnum']);
						$('#rdactid').val(data['actid']);
						$('#rdSBAvail').val(data['totamt']);
						$('#rdSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		else if(pmode=="PYGMY ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.cheque_rd').hide();
			$('.rdsbaccnumb').hide();
			$('.sbaccrd').hide();
			$('.rdsbavailable').hide();
			$('.rdsbtotamt').hide();
			$('.rdavailable').hide();
			$('.rdtotamt').hide();
			$('.PMPgmForRDL').hide();
			$('.PMPgmForRDL').show();
			$('.PGMAccNumTypeAheadRDL').change(function(e)
			{
				AccNum=$('.PGMAccNumTypeAheadRDL').data('value');
				$.ajax({
					url:'/DLRepayGetPgmDetails',
					type:'post',
					data:'&pgAcNo='+AccNum,
					success:function(data)
					
					{ 
						$('#PgacidforRD').val(data['acid']);
						$('#PgAvailforRD').val(data['totamt']);
						$('#PgAvailhidnforRD').val(data['totamt']);
					}
				});
			});
			
		}
		else if(pmode=="CHEQUE")
		{$('.adjustmentcarg').hide();
			
			$('.cheque_rd').show();
			$('.rdsbaccnumb').hide();
			$('.rdsbavailable').hide();
			$('.rdsbtotamt').hide();
			$('.rdavailable').hide();
			$('.rdtotamt').hide();
			$('.sbaccrd').hide();
			$('.PMPgmForRDL').hide();
		}
		
	});
	
	$('#FdPayMode').change(function(e)
	{
		
		pmode=$('#FdPayMode').val();
		if(pmode=="CASH")
		{$('.adjustmentcarg').hide();
			$('.fdsbaccnumb').hide();
			$('.fdsbavailable').hide();
			$('.fdsbtotamt').hide();
			$('.fdavailable').hide();
			$('.fdtotamt').hide();
			$('.sbaccfd').hide();
			$('.cheque_fd').hide();
			$('.fdforFDL').hide();//edit
		}
		else if(pmode=="SB ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.fdsbaccnumb').show();
			$('.sbaccfd').show();
			$('.fdsbavailable').show();
			$('.fdsbtotamt').show();
			$('.fdavailable').hide();
			$('.fdtotamt').hide();
			$('.fdforFDL').hide();//edit
			$('.SBAccNumTypeAheadFD').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAheadFD').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#fdacid').val(data['acid']);
						$('#fdSBAccountNum').val(data['acnum']);
						$('#fdSBAcNum').val(data['acnum']);
						$('#fdactid').val(data['actid']);
						$('#fdSBAvail').val(data['totamt']);
						$('#fdSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		else if(pmode=="CHEQUE")
		{$('.adjustmentcarg').hide();
			$('.cheque_fd').show();
			$('.fdsbaccnumb').hide();
			$('.fdsbavailable').hide();
			$('.fdsbtotamt').hide();
			$('.fdavailable').hide();
			$('.fdtotamt').hide();
			$('.sbaccfd').hide();
			$('.fdforFDL').hide();//edit
		}
		else if(pmode=="FD_ACCOUNT")
		{
			$('.adjustmentcarg').hide();
			$('.fdsbaccnumb').hide();
			$('.fdsbavailable').hide();
			$('.fdsbtotamt').hide();
			$('.fdavailable').hide();
			$('.fdtotamt').hide();
			$('.sbaccfd').hide();
			$('.cheque_fd').hide();
			$('.fdforFDL').show();//edit
			$('.SBAccNumTypeAheadFD').change(function(e)
			{
				AccNum=$('.FDAccNumTypeAheadFD').data('value');
				$.ajax({
					url:'/DLRepayGetFDDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#fdacid').val(data['acid']);
						$('#fdSBAccountNum').val(data['acnum']);
						$('#fdSBAcNum').val(data['acnum']);
						$('#fdactid').val(data['actid']);
						$('#fdSBAvail').val(data['totamt']);
						$('#fdSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		
	});
	
	$('#plPayMode').change(function(e)
	{
		
		pmode=$('#plPayMode').val();
		if(pmode=="CASH")
		{$('.adjustmentcarg').hide();
			$('.cheque_pl').hide();
			$('.plsbaccnumb').hide();
			$('.plsbavailable').hide();
			$('.plsbtotamt').hide();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.sbaccpl').hide();
			$('.pigmyforPL').hide();
			$('.adjust').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.cheque_pl').hide();
			$('.plsbaccnumb').show();
			$('.sbaccpl').show();
			$('.plsbavailable').show();
			$('.plsbtotamt').show();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.pigmyforPL').hide();
			$('.adjust').hide();
			$('.SBAccNumTypeAheadPL').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAheadPL').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#placid').val(data['acid']);
						$('#plSBAccountNum').val(data['acnum']);
						$('#plSBAcNum').val(data['acnum']);
						$('#plactid').val(data['actid']);
						$('#plSBAvail').val(data['totamt']);
						$('#plSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		else if(pmode=="PYGMY ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.cheque_pl').hide();
			$('.plsbaccnumb').hide();
			$('.sbaccpl').hide();
			$('.plsbavailable').hide();
			$('.plsbtotamt').hide();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.pigmyforPL').show();
			$('.adjust').hide();
			$('.PGMAccNumTypeAheadPL').change(function(e)
			{
				AccNum=$('.PGMAccNumTypeAheadPL').data('value');
				$.ajax({
					url:'/DLRepayGetPgmDetails',
					type:'post',
					data:'&pgAcNo='+AccNum,
					success:function(data)
					
					{ 
						$('#plpigmiid').val(data['acid']);
						$('#PgAvailhidnforPL').val(data['totamt']);
						$('#PgAvailforPL').val(data['totamt']);
						$('#pgytypid').val(data['actid']);
						$('#pgyagentid').val(data['agentid']);
					}
				});
			});
			
		}
		else if(pmode=="ADJUSTMENT")
		{$('.adjustmentcarg').show();
			$('.cheque_pl').hide();
			$('.plsbaccnumb').hide();
			$('.plsbavailable').hide();
			$('.plsbtotamt').hide();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.sbaccpl').hide();
			$('.pigmyforPL').hide();
			$('.adjust').show();
		}
		else if(pmode=="CHEQUE")
		{$('.adjustmentcarg').hide();
			$('.cheque_pl').show();
			$('.plsbaccnumb').hide();
			$('.plsbavailable').hide();
			$('.plsbtotamt').hide();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.sbaccpl').hide();
			$('.pigmyforPL').hide();
			$('.adjust').hide();
		}
	});
	
	$('#jlPayMode').change(function(e)
	{
		
		pmode=$('#jlPayMode').val();
		if(pmode=="CASH")
		{$('.adjustmentcarg').hide();
			$('.cheque_jl').hide();
			$('.jlsbaccnumb').hide();
			$('.jlsbavailable').hide();
			$('.jlsbtotamt').hide();
			$('.jlavailable').hide();
			$('.jltotamt').hide();
			$('.sbaccjl').hide();
			$('.jladjust').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.cheque_jl').hide();
			$('.jlsbaccnumb').show();
			$('.sbaccjl').show();
			$('.jlsbavailable').show();
			$('.jlsbtotamt').show();
			$('.jlavailable').hide();
			$('.jltotamt').hide();
			$('.jladjust').hide();
			$('.SBAccNumTypeAheadJL').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAheadJL').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#jlacid').val(data['acid']);
						$('#jlSBAccountNum').val(data['acnum']);
						$('#jlSBAcNum').val(data['acnum']);
						$('#jlactid').val(data['actid']);
						$('#jlSBAvail').val(data['totamt']);
						$('#jlSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		else if(pmode=="CHEQUE")
		{$('.adjustmentcarg').hide();
			$('.cheque_jl').show();
			$('.jlsbaccnumb').hide();
			$('.jlsbavailable').hide();
			$('.jlsbtotamt').hide();
			$('.jlavailable').hide();
			$('.jltotamt').hide();
			$('.sbaccjl').hide();
			$('.jladjust').hide();
		}
		else if(pmode=="ADJUSTMENT")
		{$('.adjustmentcarg').hide();
			$('.cheque_jl').hide();
			$('.jlsbaccnumb').hide();
			$('.jlsbavailable').hide();
			$('.jlsbtotamt').hide();
			$('.jlavailable').hide();
			$('.jltotamt').hide();
			$('.sbaccjl').hide();
			$('.jladjust').show();
		}
	});
	
	$('#slPayMode').change(function(e)
	{
		
		pmode=$('#slPayMode').val();
		if(pmode=="CASH")
		{$('.adjustmentcarg').hide();
			$('.cheque_sl').hide();
			$('.slsbaccnumb').hide();
			$('.slsbavailable').hide();
			$('.slsbtotamt').hide();
			$('.slavailable').hide();
			$('.sltotamt').hide();
			$('.sbaccsl').hide();
			$('.CD').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{$('.adjustmentcarg').hide();
			$('.cheque_sl').hide();
			$('.slsbaccnumb').show();
			$('.sbaccsl').show();
			$('.slsbavailable').show();
			$('.slsbtotamt').show();
			$('.slavailable').hide();
			$('.sltotamt').hide();
			$('.CD').hide();
			$('.SBAccNumTypeAheadSL').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAheadSL').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#slacid').val(data['acid']);
						$('#slSBAccountNum').val(data['acnum']);
						$('#slSBAcNum').val(data['acnum']);
						$('#slactid').val(data['actid']);
						$('#slSBAvail').val(data['totamt']);
						$('#slSBAvailhidn').val(data['totamt']);
					}
				});
			});
		}
		else if(pmode=="CD")
		{$('.adjustmentcarg').hide();
			$('.cheque_sl').hide();
			$('.CD').show();
			AccNum=$('.SLAccNumTypeAhead').data('value');
			$.ajax({
				url:'/getcd_of_employee',
				type:'post',
				data:'&AcNo='+AccNum,
				success:function(data)
				
				{
					$('#cdamt').val(data['cd_amt_']);
					$('#cdamt_dis').val(data['cd_amt_']);
					
					$('#slpayamt').val(data['cd_amt_']);
					
					/*$('#slSBAccountNum').val(data['acnum']);
						$('#slSBAcNum').val(data['acnum']);
						$('#slactid').val(data['actid']);
						$('#slSBAvail').val(data['totamt']);
					$('#slSBAvailhidn').val(data['totamt']);*/
				}
			});
		}
		else if(pmode=="CHEQUE")
		{$('.adjustmentcarg').hide();
			$('.cheque_sl').show();
			$('.slsbaccnumb').hide();
			$('.slsbavailable').hide();
			$('.slsbtotamt').hide();
			$('.slavailable').hide();
			$('.sltotamt').hide();
			$('.sbaccsl').hide();
			$('.CD').hide();
		}
		
	});
	
	function cdamtchange()
	{
		/*pmode=$('#slPayMode').val();
			if(pmode=="CD")
			{
			$amt=$('#slpayamt').val();
			$cdamt=$('#cdamt').val();
			alert($amt);
			alert($cdamt);
			
			
			if($amt<=$cdamt)
			{
			alert("less");
			$('#slpayamt').val('amt');
			}
			if($amt>$cdamt)
			{
			alert("high");
			$('#slpayamt').val('0');
			
			}
			
		}*/
		
	}
	$('.PygmyAccNumTypeAhead').typeahead({
		ajax:'/pigmydlacc'
	});
	$('.SBAccNumTypeAhead').typeahead({
		ajax:'/SBdlacc'
	});
	$('.SBAccNumTypeAheadRD').typeahead({
		ajax:'/SBdlacc'
	});
	$('.SBAccNumTypeAheadFD').typeahead({
		ajax:'/SBdlacc'
	});
	$('.FDAccNumTypeAheadFD').typeahead({
		ajax:'/FDdlacc'
	});
	$('.SBAccNumTypeAheadPL').typeahead({
		ajax:'/SBdlacc'
	});
	$('.SBAccNumTypeAheadJL').typeahead({
		ajax:'/SBdlacc'
	});
	$('.SBAccNumTypeAheadSL').typeahead({
		ajax:'/SBdlacc'
	});
	$('.RDAccNumTypeAhead').typeahead({
		ajax:'/RDdlacc'
	});
	
	$('.FDAccNumTypeAhead').typeahead({
		ajax:'/FDdlacc'
	});
	$('.BranchTypeAheadPG').typeahead({
		ajax:'/GetBranches'
	});
	
	$('.BranchTypeAheadRD').typeahead({
		ajax:'/GetBranches'
	});
	
	$('.BranchTypeAheadFD').typeahead({
		ajax:'/GetBranches'
	});
	$('.BranchTypeAheadPL').typeahead({
		ajax:'/GetBranches'
	});
	
	$('.BranchTypeAheadJL').typeahead({
		ajax:'/GetBranches'
	});
	
	$('.BranchTypeAheadSL').typeahead({
		ajax:'/GetBranches'
	});
	
	$('.PLAccNumTypeAhead').typeahead({
		ajax:'/getplacc'
	});
	$('.JLAccNumTypeAhead').typeahead({
		ajax:'/getjlacc'
	});
	$('.SLAccNumTypeAhead').typeahead({
		ajax:'/getslacc'
	});
	
	$('.PGMAccNumTypeAheadPDL').typeahead({
		ajax:'/GetSearchpigmyAcc'
	});
	$('.PGMAccNumTypeAheadRDL').typeahead({
		ajax:'/GetSearchpigmyAcc'
	});
	$('.PGMAccNumTypeAheadPL').typeahead({
		ajax:'/GetSearchpigmyAcc'
	});
	$('.adjustmentTypeAheadPL').typeahead({
		ajax:'/adjustment_num'
	});
	$('.adjustmentTypeAheadJL').typeahead({
		ajax:'/adjustment_num'
	});
	$('.FDAccNumTypeAheadPDL').typeahead({
		ajax:'/FdClosedAcc_Unpaid'
	});
//edit	
	$('input.fdCertTypeAhead').typeahead({
		ajax:'/fdCertTypeAhead'
	});
//edit	
	
	
	
/********************DL PYGMI********************/
	$('.PygmyAccNumTypeAhead').change(function(e){
		dlalid=$('.PygmyAccNumTypeAhead').data('value');
		//dlalid=$('.PygmyAccNumTypeAhead').val();
		$.ajax({
			url:'/GetDLDetail',
			type:'post',
			data:'&DLAlcID='+dlalid,
			success:function(data)
			{
				$('#pgloannum').val(data['DLloanno']);
				$('#pgremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#pgcustname').val(fullname);
				$('#PgStdate').val(data['StDte']);
				sdate=$('#PgStdate').val();
				bal=$('#pgremamt').val();
				sdate=data['StDte'];
				did = data['did'];
				bal=data['reamt'];
				LoanType_Interest=data['LoanType_Interest'];
				loan_due_interest=data['loan_due_interest'];
				emi=data['EMI_Amount'];
				
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate+'&did='+did,
					success:function(data)
					{
						daydiff=data;
						
						/*interest*//*
								var totbal,int_total,due_total,yeardiff,daydiff,due_days,due_years,inerest,pend_inst,due_interest,
								yeardiff = daydiff / 365;
								inerest=(parseFloat(LoanType_Interest))/100;
								int_total = Math.round((bal * yeardiff * inerest),2);
								if(daydiff > 90) {
									pend_inst = Math.floor(daydiff / 30);//no_of_installments_pending
									//alert("pend_inst = "+pend_inst);
									pending_emi = emi * pend_inst;
									due_days = daydiff - 90;
									due_years = due_days/365;
									due_interest = (parseFloat(loan_due_interest)) /100;
									due_total = Math.round((pending_emi * due_years * due_interest),2);
									alert("\ndue_total = "+due_total+"\np = "+pending_emi+"\nt = "+due_days+"/365 \nr ="+due_interest);
								}else{
									due_total = 0;
								}
								totbal = int_total + due_total;
						/*interest*/
								
								
						
						//alert(bal);
						inerest=(parseFloat(LoanType_Interest))/100;
						days=daydiff/365;
						totbal=days*inerest*bal;
						totbal=Math.round(totbal);
						bal=Math.round(bal);
						//alert(totbal);
						$('#pgintamt').val(totbal);
						totamt=(parseFloat(totbal)+parseFloat(bal));
						alert(bal+" "+totbal+" "+totamt);
						$('#Pgremtotamt').val(totamt);
						//$('#Pgremtotamt').val(totamt);
						//
					}
				});

				
				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&DLAlcID='+dlalid+'&loan_type=PG',
				success:function(data){
				 
				}
				});
			}
		});
		
	});
	
/********************DL RD********************/
	$('.RDAccNumTypeAhead').change(function(e){
		dlalid=$('.RDAccNumTypeAhead').data('value');
		//dlalid=$('.RDAccNumTypeAhead').val();
		$.ajax({
			url:'/GetDLDetail',
			type:'post',
			data:'&DLAlcID='+dlalid,
			success:function(data)
			{
				$('#rdloannum').val(data['DLloanno']);
				$('#rdremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#rdcustname').val(fullname);
				$('#rdStdate').val(data['StDte']);
				sdate=$('#rdStdate').val();
				bal=$('#rdremamt').val();
				sdate=data['StDte'];
				bal=data['reamt'];
				did = data['did'];
				LoanType_Interest=data['LoanType_Interest'];
				loan_due_interest=data['loan_due_interest'];
				emi=data['EMI_Amount'];
				alert("did = "+did);
				
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate+'&did='+did,
					success:function(data)
					{
						daydiff=data;
						
						
						
						/*interest*//*
								var totbal,int_total,due_total,yeardiff,daydiff,due_days,due_years,inerest,pend_inst,due_interest,
								yeardiff = daydiff / 365;
								inerest=(parseFloat(LoanType_Interest))/100;
								int_total = Math.round((bal * yeardiff * inerest),2);
								if(daydiff > 90) {
									pend_inst = Math.floor(daydiff / 30);//no_of_installments_pending
									//alert("pend_inst = "+pend_inst);
									pending_emi = emi * pend_inst;
									due_days = daydiff - 90;
									due_years = due_days/365;
									due_interest = (parseFloat(loan_due_interest)) /100;
									due_total = Math.round((pending_emi * due_years * due_interest),2);
									alert("\ndue_total = "+due_total+"\np = "+pending_emi+"\nt = "+due_days+"/365 \nr ="+due_interest);
								}else{
									due_total = 0;
								}
								totbal = int_total + due_total;
						/*interest*/
						
						
						//alert(bal);
						inerest=(parseFloat(LoanType_Interest))/100;
						days=daydiff/365;
						totbal=days*inerest*bal;
						totbal=Math.round(totbal);
						bal=Math.round(bal);
						//alert(totbal);
						$('#rdintamt').val(totbal);
						totamt=(parseFloat(totbal)+parseFloat(bal));
						alert(bal+" "+totbal+" "+totamt);
						$('#rdremtotamt').val(totamt);
						//$('#Pgremtotamt').val(totamt);
						
					}
				});

				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&DLAlcID='+dlalid+'&loan_type=RD',
				success:function(data){
				 
				}
				});
				
				
			}
		});
		
	});
	
/********************DL FD********************/
	$('.FDAccNumTypeAhead').change(function(e){
		//dlalid=$('.PygmyAccNumTypeAhead').data('value');
		//dlalid=$('.FDAccNumTypeAhead').data('value');
		dlalid=$('.FDAccNumTypeAhead').data('value');
		$.ajax({
			url:'/GetDLDetail',
			type:'post',
			data:'&DLAlcID='+dlalid,
			success:function(data)
			{
				$('#fdloannum').val(data['DLloanno']);
				$('#fdremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#fdcustname').val(fullname);
				$('#fdStdate').val(data['StDte']);
				sdate=$('#fdStdate').val();
				bal=$('#fdremamt').val();
				sdate=data['StDte'];
				bal=data['reamt'];
				did = data['did'];
				LoanType_Interest=data['LoanType_Interest'];
				loan_due_interest=data['loan_due_interest'];
				emi=data['EMI_Amount'];
				alert("did = "+did);
				
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate+'&did='+did,
					success:function(data)
					{
						daydiff=data;
						//daydiff++;
						
						
console.log("days="+daydiff);
console.log("Interest="+LoanType_Interest);
console.log("amt="+bal);
						
						
						
						/*interest*//*
								var totbal,int_total,due_total,yeardiff,daydiff,due_days,due_years,inerest,pend_inst,due_interest,
								yeardiff = daydiff / 365;
								inerest=(parseFloat(LoanType_Interest))/100;
								int_total = Math.round((bal * yeardiff * inerest),2);
								if(daydiff > 90) {
									pend_inst = Math.floor(daydiff / 30);//no_of_installments_pending
									//alert("pend_inst = "+pend_inst);
									pending_emi = emi * pend_inst;
									due_days = daydiff - 90;
									due_years = due_days/365;
									due_interest = (parseFloat(loan_due_interest)) /100;
									due_total = Math.round((pending_emi * due_years * due_interest),2);
									alert("\ndue_total = "+due_total+"\np = "+pending_emi+"\nt = "+due_days+"/365 \nr ="+due_interest);
								}else{
									due_total = 0;
								}
								totbal = int_total + due_total;
						/*interest*/
						
						
						inerest=(parseFloat(LoanType_Interest))/100;
						days=daydiff/365;
						//alert(bal);
						totbal=days*inerest*bal;
						totbal=Math.round(totbal);
						//alert(totbal);
						$('#fdintamt').val(totbal);
						totamt=(parseFloat(totbal)+parseFloat(bal));
						alert(bal+" "+totbal+" "+totamt);
						$('#fdremtotamt').val(totamt);
						
					}
				});

				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&DLAlcID='+dlalid+'&loan_type=FD',
				success:function(data){
				 
				}
				});
			}
		});
		
	});
	
	
/********************PL********************/
	$('.PLAccNumTypeAhead').change(function(e)
	{
console.log("\n\nPL\n");
		placcid=$('.PLAccNumTypeAhead').data('value');
		
		$.ajax({
			url:'/GetplDetail',
			type:'post',
			data:'&plAlcID='+placcid,
			success:function(data)
			{
				
				$('#plremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#plcustname').val(fullname);
				$('#plStdate').val(data['StDte']);
				emi=data['emi'];
				//emi=+emi.toFixed(2);
				//$('#plemi').val(data['emi']);
				$('#plemi').val(emi);
				sdate=$('#plStdate').val();
				//bal=$('#plremamt').val();
				sdate=data['StDte'];
				bal=data['reamt'];
				pid = data['pid'];
				LoanType_Interest=data['LoanType_Interest'];
				loan_due_interest=data['loan_due_interest'];
				emi=data['emi'];
				remaining_interest=parseFloat(data['remaining_interest']);
				EMIremaining = parseFloat(data['EMIremaining']);
console.log("EMIremaining="+EMIremaining);
				if(isNaN(remaining_interest)) {
					remaining_interest = 0.0;
				}
				alert('pid ='+pid);
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate+'&pid='+pid,
					success:function(data)
					{
						
						//alert(data);
						daydiff=data;
						//daydiff++;
						
						
						/*interest*/
								var totbal,int_total,due_total,yeardiff,daydiff,due_days,due_years,inerest,pend_inst,due_interest;
console.log("days = "+daydiff);
								yeardiff = daydiff / 365;
								inerest=(parseFloat(LoanType_Interest))/100;
console.log("inerest % = "+inerest);
console.log("bal = "+bal);
								int_total = Math.round((bal * yeardiff * inerest),2);
								if(daydiff > 90) {
console.log(">90days");
									pend_inst = Math.floor(daydiff / 30);//no_of_installments_pending
									//alert("pend_inst = "+pend_inst);
									pending_emi = emi * pend_inst + parseFloat(EMIremaining);
									due_days = daydiff - 90;
									due_years = daydiff/365;
console.log("due_days="+due_days);
console.log("emi="+emi);
console.log("pend_inst="+pend_inst);
console.log("pending_emi="+pending_emi);
									
									due_interest = (parseFloat(loan_due_interest)) /100;
console.log("due_interest="+due_interest);
									
									due_total = Math.round((pending_emi * due_years * due_interest),2);
									//alert("\ndue_total = "+due_total+"\npending_emi = "+pending_emi+"\ndue_days = "+due_days+"/365 \ndue_interest ="+due_interest);
								}else{
									due_total = 0;
								}
console.log("int_total = "+int_total);
console.log("due_total = "+due_total);
console.log("remaining_interest = "+remaining_interest);
								totbal = int_total + due_total + remaining_interest;
						/*interest*/
						
						
						/*if(daydiff>90)
						{
							inerest=(parseFloat(LoanType_Interest))/100;
						}
						else
						{
							
							inerest=(parseFloat(LoanType_Interest))/100;
						}
						
						days=daydiff/365;
						
						//bal=round($bal,2);
						totbal=days*inerest*bal;*/
						totbal=Math.round(totbal);
						bal=Math.round(bal);
						//totbal=+totbal.toFixed(2);
						//totbal=round($totbal1,2);
						$('#plintamt').val(totbal);
						//totamt=(parseFloat(totbal)+parseFloat(bal));
						//totamt=round($totamt1,2);
						
						//alert(bal+" "+totbal+" "+totamt);
						$('#plremtotamt').val(totbal);
						$('#balamt').val(bal);
						$('#plpendemi').val(pending_emi);
						
						
					}
				});
				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&DLAlcID='+dlalid+'&loan_type=PL',
				success:function(data){
				 
				}
				});
				
			}
		});
		
	});
	

/********************JL********************/
	//$('#JLAccNum').change(function(e)
	$('.JLAccNumTypeAhead, #interest_upto').change(function(e)
	{
		jlaccid=$('.JLAccNumTypeAhead').data('value');
		
		$.ajax({
			url:'/GetjlDetail',
			type:'post',
			data:'&jlAlcID='+jlaccid,
			success:function(data)
			{
					
				$('#jlremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#jlcustname').val(fullname);
				$('#jlStdate').val(data['StDte']);
				$('#jldatecal').val(data['datecal']);
				$('#jlEnddate').val(data['EndDte']);
				//sdate=$('#jlStdate').val();
				last_paid_date=$('#jldatecal').val();
				end_date=$('#jlEnddate').val();
				start_date = data['StDte'];
				bal=$('#jlremamt').val();
				bal=data['reamt'];
				datecal=data['datecal'];
				LoanType_Interest=data['LoanType_Interest'];
				loan_due_interest=data['loan_due_interest'];
				JewelLoan_remaininginterest = data['JewelLoan_remaininginterest'];
					
					
					
				/**********************/
				
					
					
						
				$.ajax({
					url:"/is_jl_first_repay_done",
					type:"post",
					data:'&jlaccid='+jlaccid,
					success:function(data)
					{
							var first_repay = parseInt(data);
							console.log("is_jl_first_repay_done="+first_repay);
							if(isNaN(first_repay))
								first_repay = 0;
							var today = $("#interest_upto").val();//"<?php echo date("Y-m-d"); ?>";//////fethc from date picker - INTEREST PAying  TILL
							console.log("today="+today);
							$.ajax({
								url:"/dateComp",
								type:"post",
								data:'&first='+today+'&second='+end_date,
								success:function(data)
								{
									var d1_gt_d2 = data;
									
									if(d1_gt_d2 == 1) {//TODAY > END_DATE
										console.log("1");
							
										$.ajax({
											url:"/dateDiff",
											type:"post",
											data:'&first='+end_date+'&second='+last_paid_date,
											success:function(data) { console.log("*******3\n");
												var num_of_days = data;
												var last_diff = parseInt(num_of_days);
												if(first_repay == 0) {
													last_diff++;//FIRST REPAYMENT NOT DONE
												}
												
												$.ajax({
													url:"/dateDiff",
													type:"post",
													data:'&first='+today+'&second='+end_date,
													success:function(data) {
														var num_of_days = data;
														console.log("num_of_days="+num_of_days);
														
														var due_diff = parseInt(num_of_days);
														console.log("last_diff="+last_diff);
														
														var last_diff_years = last_diff/365;
														var interest = (parseFloat(LoanType_Interest))  / 100;
														console.log("interest rate="+interest);
														
														
														var due_diff_years = due_diff/365;
														var due_interest = ((parseFloat(loan_due_interest)) + (parseFloat(LoanType_Interest))) /100;
														console.log("due interest rate="+due_interest);
														
														
														
														t1 =(last_diff_years * interest * bal);
														t2=(due_diff_years * due_interest * bal);
														t1=Math.round(t1);
														t2=Math.round(t2);
														console.log("interest = "+t1+"+"+t2+"+"+JewelLoan_remaininginterest);
														
														jlint =t1 + t2 + parseFloat(JewelLoan_remaininginterest);
														console.log("interest = "+jlint);
														
														$('#jlintamt').val(jlint);
														bal=Math.round(bal);
														var tot_rem = (parseFloat(jlint) + parseFloat(bal));
														$('#jlremtotamt').val(tot_rem);
														$('#jlloanremainigamt').val(bal);
														
														
														
														//REPAY REPORT
														$.ajax({
															url:'/jewel_loan_repay_report_data',
															type:'post',
															data:'&loan_allocation_id='+jlaccid+'&loan_type=JL',
															success:function(data){
																$("#jewel_repayment").html(data);
															}
														});
														//REPAY REPORT END
														
														
														
													}
												});
												
											}
										});
										
									} else {//TODAY < END_DATE
										console.log("2");
										var days = 0;
										$.ajax({//start_to_last
											url:"/dateDiff",
											type:"post",
											data:'&first='+start_date+'&second='+last_paid_date,
											success:function(start_to_last) {console.log("start_to_last="+start_to_last);
											
					/*case1: LP = ST*/				if(start_to_last == 0 || last_paid_date == "0000-00-00") {//LAST_DATE = START_DATE
														console.log("case1: LP = ST");
														$.ajax({
															url:"/dateDiff",
															type:"post",
															data:'&first='+start_date+'&second='+today,
															success:function(start_to_today) {console.log("start_to_today="+start_to_today+"+1");
																days = parseInt(start_to_today) + 1;//THIS IS FIRST REPAYMENT
															
															//	console.log("days="+days);
																if(days <= 15) {
																	console.log("days bw 0 - 15");
																	days = 15;
																} else if(days <= 30) {
																	console.log("days bw 15 - 30");
																	days = 30;
																} else {
																	days = days;
																}
																//print_days();
																calculate_jewel_interest(days,LoanType_Interest,JewelLoan_remaininginterest,bal);
															}
														});
													//if end start_end
				/*case2: LP = ST+15*/				} else if (start_to_last == 15) {
														console.log("case2: LP = ST+15");
														$.ajax({
															url:"/dateDiff",
															type:"post",
															data:'&first='+last_paid_date+'&second='+today,
															success:function(last_to_today) {console.log("last_to_today="+last_to_today);
																console.log("last_to_today="+last_to_today);
																days = parseInt(last_to_today);//THIS IS SECOND REPAYMENT
																if(days <= 15) {
																	days = 15;
																}
																//print_days();
																calculate_jewel_interest(days,LoanType_Interest,JewelLoan_remaininginterest,bal);
															}
														});
			/*case3: normal case*/				} else {//NOT FIRST REPAY
														console.log("case3: normal case");
														$.ajax({
															url:"/dateDiff",
															type:"post",
															data:'&first='+last_paid_date+'&second='+today,
															success:function(last_to_today) {
																console.log("last_to_today="+last_to_today);
																days = parseInt(last_to_today);
																//print_days();
																calculate_jewel_interest(last_to_today,LoanType_Interest,JewelLoan_remaininginterest,bal);
															}
														});
														
													}//END OF IF ELSE ...
											}
										});
							/**********************/
							
							
							
								
								
									}
								}
							});
					}
				});
/*				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&DLAlcID='+dlalid+'loan_type=JL',
				success:function(data){
				 
				}
				});*/
			}
		});
	});
	
	
	function calculate_jewel_interest(days,LoanType_Interest,JewelLoan_remaininginterest,bal) {
		/********************************/
			console.log("days="+days);
			var years = parseInt(days)/365;
			var interest = (parseFloat(LoanType_Interest))  / 100;
			console.log("interest="+interest);
			console.log("JewelLoan_remaininginterest="+JewelLoan_remaininginterest);
			jlint =Math.round((years * interest * bal)) + parseFloat(JewelLoan_remaininginterest);
			$('#jlintamt').val(jlint);
			bal=Math.round(bal);
			var tot_rem = (parseFloat(jlint) + parseFloat(bal));
			$('#jlremtotamt').val(tot_rem);
			$('#jlloanremainigamt').val(bal);
			//REPAY REPORT
				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&loan_allocation_id='+jlaccid+'&loan_type=JL',
				success:function(data){
					$("#jewel_repayment").html(data);
				 }
				});
			//REPAY REPORT END
		/********************************/
	}

/********************SL********************/
	
	$('.SLAccNumTypeAhead').change(function(e)
	{
		slaccid=$('.SLAccNumTypeAhead').data('value');
		
		$.ajax({
			url:'/GetslDetail',
			type:'post',
			data:'&slAlcID='+slaccid,
			success:function(data)
			{
				
				$('#slremamt').val(data['reamt']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#slcustname').val(fullname);
				$('#slStdate').val(data['StDte']);
				sdate=$('#slStdate').val();
				bal=$('#slremamt').val();
				sdate=data['StDte'];
				LoanType_Interest= 13;//data['LoanType_Interest'];
				loan_due_interest = 3;//data['loan_due_interest'];
				emi=data['emi'];
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate,
					success:function(data)
					{
						daydiff=data;
						
						
						/*interest*/
								var totbal,int_total,due_total,yeardiff,daydiff,due_days,due_years,inerest,pend_inst,due_interest,
								yeardiff = daydiff / 365;
								inerest=(parseFloat(LoanType_Interest))/100;
								int_total = Math.round((bal * yeardiff * inerest),2);
								if(daydiff > 90) {
									pend_inst = Math.floor(daydiff / 30);//no_of_installments_pending
									//alert("pend_inst = "+pend_inst);
									pending_emi = emi * pend_inst;
									due_days = daydiff - 90;
									due_years = due_days/365;
									due_interest = (parseFloat(loan_due_interest)) /100;
									due_total = Math.round((pending_emi * due_years * due_interest),2);
									alert("\ndue_total = "+due_total+"\npending_emi = "+pending_emi+"\ndue_days = "+due_days+"/365 \ndue_interest ="+due_interest);
								}else{
									due_total = 0;
								}
								totbal = int_total + due_total;
						/*interest*/
						
						
						
/*						inerest=13/100;
						days=daydiff/365;
						
						
						totbal=days*inerest*bal;*/
						
						
						$('#slintamt').val(totbal);
						totamt=(parseFloat(totbal)+parseFloat(bal));
						alert(bal+" "+totbal+" "+totamt);
						$('#slremtotamt').val(totamt);
						
						
					}
				});
				$.ajax({
				url:'/jewel_loan_repay_report_data',
				type:'post',
				data:'&DLAlcID='+dlalid+'&loan_type=SL',
				success:function(data){
				 
				}
				});
			}
		});
		
		
	});
	
//edit	
	$('.fdCertTypeAhead').change(function(e){
		fdid=$('.fdCertTypeAhead').data('value');
		$.ajax({
			url:'/GetFDDetail',
			type:'post',
			data:'&fdid='+fdid,
			success:function(data)
			{	var Fd_TotalAmt, amt_paid,rem;
				amt_paid = $('#fdpayamt').val();
				$('#Fd_CertificateNum').val(data['Fd_CertificateNum']);
				Fd_TotalAmt = data['Fd_TotalAmt'];
				rem = Fd_TotalAmt-amt_paid;
/**********************/
				var adj_amt = data['adj_amt'];
				$('#fdFDAvail').val(adj_amt);
				$('#fdFDRem').val(parseFloat(adj_amt - amt_paid));
/**********************/
				//$('#fdFDAvail').val(Fd_TotalAmt);
				//$('#fdFDRem').val(rem);
				$('#Fdid').val(data['Fdid']);
			}
		});
	});
//edit	
	
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			$('.pigmidlrepayclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.resetbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			
			return true;
		}
		else{
			return false;
		}
		
	});
	dlsubindex=0;
	$('.sbmbtn').click( function(e) {
		dl=$('#dl').val();
		
		if(dlsubindex==0)
		{
			dlsubindex++;
			if(dl=="pygmy DL")
			{
				
				
				temp="";
				temp1="";
				for(i=1;i<xpdl;i++)
				{
					amt=$('#BranchListDDpdl'+i).val();
					amt1=$('#xtr_chargpdl'+i).val();
					if(i < xpdl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xpdl;
				charges=temp;
				amount=temp1;
				
				alert(charges);
				alert(amount);
			}
			else if(dl=="RD DL")
			{
				temp="";
				temp1="";
				for(i=1;i<xrddl;i++)
				{
					amt=$('#BranchListDDrddl'+i).val();
					amt1=$('#xtr_chargrddl'+i).val();
					if(i < xrddl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xrddl;
				charges=temp;
				amount=temp1;
				
				alert(charges);
				alert(amount);
			}
			else if(dl=="FD DL")
			{
				
				temp="";
				temp1="";
				for(i=1;i<xfddl;i++)
				{
					amt=$('#BranchListDDfddl'+i).val();
					amt1=$('#xtr_chargfddl'+i).val();
					if(i < xfddl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xrddl;
				charges=temp;
				amount=temp1;
				
				alert(charges);
				alert(amount);
			}
			DlAlocID=$('.PygmyAccNumTypeAhead').data('value');
			RDDlAlocID=$('.RDAccNumTypeAhead').data('value');
			FDDlAlocID=$('.FDAccNumTypeAhead').data('value');
			bank_pigmy=$('#creditbank_pigmy').data('value');
			bank_rd=$('#creditbank_rd').data('value');
			bank_fd=$('#creditbank_fd').data('value');
			
			
			
			BidP=$('.BranchTypeAheadPG').data('value');
			BidR=$('.BranchTypeAheadRD').data('value');
			BidF=$('.BranchTypeAheadFD').data('value');
			//alert(BidR);
			DlAccNo=$('.PygmyAccNumTypeAhead').val();
			RDDlAccNo=$('.RDAccNumTypeAhead').val();
			FDDlAccNo=$('.FDAccNumTypeAhead').val();
			
			FD_pay_num=$('.FDAccNumTypeAheadPDL').data('value');
		//	FDAccNumFDL=$('.SearchTypeahead').data('value');
			Fdid=$('#Fdid').val();
			//alert(DlAlocID);
			e.preventDefault();
			$.ajax({
				url: 'createPigmyDL',
				type: 'post',
				data: $('#form_dlrepay').serialize()+'&DLAlloc='+DlAlocID+'&RDDLAlloc='+RDDlAlocID+'&FDDLAlloc='+FDDlAlocID+'&BranchIDP='+BidP+'&BranchIDR='+BidR+'&BranchIDF='+BidF+'&DLAccNum='+DlAccNo+'&RDDLAccNum='+RDDlAccNo+'&FDDLAccNum='+FDDlAccNo+'&dltype='+dl+'&charges='+temp+'&amount='+temp1+'&loopid='+x+'&bank_pigmy='+bank_pigmy+'&bank_rd='+bank_rd+'&bank_fd='+bank_fd+'&FD_pay_num='+FD_pay_num+'&Fdid='+Fdid,
				success: function(data) {
					alert('success');
					$('.pigmidlrepayclassid').click();
				}
			});
		}
	});
	
	dl_renewsubindex=0;
	$('.sbmbtn_renew1').click( function(e) {
		dl=$('#dl').val();
		
		if(dl_renewsubindex==0)
		{
			dl_renewsubindex++;
			if(dl=="pygmy DL")
			{
				
				
				temp="";
				temp1="";
				for(i=1;i<xpdl;i++)
				{
					amt=$('#BranchListDDpdl'+i).val();
					amt1=$('#xtr_chargpdl'+i).val();
					if(i < xpdl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xpdl;
				charges=temp;
				amount=temp1;
				DlAlocID=$('.PygmyAccNumTypeAhead').data('value');
				Bid=$('.BranchTypeAheadPG').data('value');
				DlAccNo=$('.PygmyAccNumTypeAhead').val();
				
				remamt=$('#pgremamt').val();
				intamt=$('#pgintamt').val();
				loannum=$('#pgloannum').val();
				
				
				
				
				
			}
			else if(dl=="RD DL")
			{
				temp="";
				temp1="";
				for(i=1;i<xrddl;i++)
				{
					amt=$('#BranchListDDrddl'+i).val();
					amt1=$('#xtr_chargrddl'+i).val();
					if(i < xrddl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xrddl;
				charges=temp;
				amount=temp1;
				DlAlocID=$('.RDAccNumTypeAhead').data('value');
				Bid=$('.BranchTypeAheadRD').data('value');
				DlAccNo=$('.RDAccNumTypeAhead').val();
				remamt=$('#rdremamt').val();
				intamt=$('#rdintamt').val();
				loannum=$('#rdloannum').val();
				
				
				
			}
			else if(dl=="FD DL")
			{
				
				temp="";
				temp1="";
				for(i=1;i<xfddl;i++)
				{
					amt=$('#BranchListDDfddl'+i).val();
					amt1=$('#xtr_chargfddl'+i).val();
					if(i < xfddl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xrddl;
				charges=temp;
				amount=temp1;
				DlAlocID=$('.FDAccNumTypeAhead').data('value');
				Bid=$('.BranchTypeAheadFD').data('value');
				DlAccNo=$('.FDAccNumTypeAhead').val();
				remamt=$('#fdremamt').val();
				intamt=$('#fdintamt').val();
				loannum=$('#fdloannum').val();
			}
			e.preventDefault();
			$.ajax({
				url: 'createDL_renew',
				type: 'post',
				data:'&DLAlloc='+DlAlocID+'&Bid='+Bid+'&DlAccNo='+DlAccNo+'&remamt='+remamt+'&intamt='+intamt+'&charges='+charges+'&amount='+amount+'&loopid='+x+'&dl='+dl+'&loannum='+loannum,
				success: function(data) {
					alert('success');
					$('.box').html(data);
				}
			});
		}
	});
	plsubindex=0;
	//SUBMIT FOR PERSONAL LOAN
	$('.PLRPSbmBtn').click( function(e) {
		if(plsubindex==0)
		{
			plsubindex++;
			temp="";
			temp1="";
			for(i=1;i<x;i++)
			{
				amt=$('#BranchListDD'+i).val();
				amt1=$('#xtr_charg'+i).val();
				if(i < x-1){
					temp+=amt+",";
					temp1+=amt1+",";
					}else{
					temp+=amt;
					temp1+=amt1;
				}
			}
			
			
			charges=temp;
			amount=temp1;
			
			alert(charges);
			alert(amount);
			
			plAlocID=$('.PLAccNumTypeAhead').data('value');
			
			
			Bidpl=$('.BranchTypeAheadPL').data('value');
			
			adid=$('.adjustmentTypeAheadPL').data('value');
			plAccNo=$('.PlAccNumTypeAhead').val();
			bank_pl=$('#creditbank_pl').data('value');
			//dl=$('#dl').val();
			
			e.preventDefault();
			$.ajax({
				url: 'PersonalLoanRepay',
				type: 'post',
				data: $('#form_dlrepay').serialize()+'&plAlloc='+plAlocID+'&branch='+Bidpl+'&plloanno='+plAccNo+'&charges='+temp+'&amount='+temp1+'&loopid='+x+'&bank_pl='+bank_pl+'&adid='+adid,
				success: function(data) {
					alert('success');
					$('.pigmidlrepayclassid').click();
				}
			});
		}
	});
	
	$('.sbmbtn_renew_pl').click( function(e) {
		if(plsubindex==0)
		{
			plsubindex++;
			temp="";
			temp1="";
			for(i=1;i<x;i++)
			{
				amt=$('#BranchListDD'+i).val();
				amt1=$('#xtr_charg'+i).val();
				if(i < x-1){
					temp+=amt+",";
					temp1+=amt1+",";
					}else{
					temp+=amt;
					temp1+=amt1;
				}
			}
			
			
			charges=temp;
			amount=temp1;
			
			
			
			plAlocID=$('.PLAccNumTypeAhead').data('value');
			Bidpl=$('.BranchTypeAheadPL').data('value');
			plAccNo=$('#PLAccNum').val();
			plintamt=$('#plintamt').val();
			plremamt=$('#plremamt').val();
			e.preventDefault();
			$.ajax({ 
				url: 'PersonalLoanRepay_renewal', 
				type: 'post',
				data: '&plAlloc='+plAlocID+'&branch='+Bidpl+'&plloanno='+plAccNo+'&charges='+temp+'&amount='+temp1+'&loopid='+x+'&plremamt='+plremamt+'&plintamt='+plintamt,
				success: function(data) {
					alert('success');
					$('.box').html(data);
					//$('.pigmidlrepayclassid').click();
				}
			});
		}
	});
	jlsubindex=0;
	//SUBMIT FOR jewel LOAN
	$('.JLRPSbmBtn').click( function(e) {
		if(jlsubindex==0)
		{
			jlsubindex++;
			temp="";
			temp1="";
			for(i=1;i<xjl;i++)
			{
				amt=$('#BranchListDDjl'+i).val();
				amt1=$('#xtr_chargjl'+i).val();
				if(i < xjl-1){
					temp+=amt+",";
					temp1+=amt1+",";
					}else{
					temp+=amt;
					temp1+=amt1;
				}
			}
			
			
			charges=temp;
			amount=temp1;
			
			alert(charges);
			alert(amount);
			
			jlAlocID=$('.JLAccNumTypeAhead').data('value');
			Bidjl=$('.BranchTypeAheadJL').data('value');
			bank_jl=$('#creditbank_jl').data('value');
			jlAccNo=$('.JlAccNumTypeAhead').val();
			
			e.preventDefault();
			$.ajax({
				url: 'JewelLoanRepay',
				type: 'post',
				data: $('#form_dlrepay').serialize()+'&jlAlloc='+jlAlocID+'&branch='+Bidjl+'&jlloanno='+jlAccNo+'&charges='+temp+'&amount='+temp1+'&loopid='+xjl+'&bank_jl='+bank_jl,
				success: function(data) {
					alert('success');
				//	$('.pigmidlrepayclassid').click();
				}
			});
		}
	});
	
	jlsubindex_renew=0;
	//SUBMIT FOR jewel LOAN
	$('.sbmbtn_renew_jl').click( function(e) {
		if(jlsubindex_renew==0)
		{
			jlsubindex_renew++;
			temp="";
			temp1="";
			for(i=1;i<xjl;i++)
			{
				amt=$('#BranchListDDjl'+i).val();
				amt1=$('#xtr_chargjl'+i).val();
				if(i < xjl-1){
					temp+=amt+",";
					temp1+=amt1+",";
					}else{
					temp+=amt;
					temp1+=amt1;
				}
			}
			
			
			charges=temp;
			amount=temp1;
			
			alert(charges);
			alert(amount);
			
			jlAlocID=$('.JLAccNumTypeAhead').data('value');
			Bidjl=$('.BranchTypeAheadJL').data('value');
			//bank_jl=$('.#creditbank_jl').data('value');
			bank_jl=0;
			jlAccNo=$('#JLAccNum').val();
			alert(jlAccNo);
			alert(jlAlocID);
			
			e.preventDefault();
			$.ajax({
				url: 'JewelLoanRepay_renewal',
				type: 'post',
				data: $('#form_dlrepay').serialize()+'&jlAlloc='+jlAlocID+'&branch='+Bidjl+'&jlloanno='+jlAccNo+'&charges='+temp+'&amount='+temp1+'&loopid='+xjl+'&bank_jl='+bank_jl,
				success: function(data) {
					alert('success');
					$('.box').html(data);
					//$('.pigmidlrepayclassid').click();
				}
			});
		}
	});
	slsubindex=0;
	//SUBMIT FOR staff LOAN
	$('.SLRPSbmBtn').click( function(e) {
		if(jlsubindex==0)
		{
/********************* sl add charge **************************/
			
				temp="";
				temp1="";
				for(i=1;i<xsl;i++)
				{
					amt=$('#BranchListDDsl'+i).val();
					amt1=$('#xtr_chargsl'+i).val();
					if(i < xsl-1){
						temp+=amt+",";
						temp1+=amt1+",";
						}else{
						temp+=amt;
						temp1+=amt1;
					}
				}
				
				x=xsl;
				charges=temp;
				amount=temp1;
				
				alert(charges);
				alert(amount);
				
				
/********************* sl add charge **************************/
			jlsubindex++;
			slAlocID=$('.SLAccNumTypeAhead').data('value');
			
			
			Bidsl=$('.BranchTypeAheadSL').data('value');
			
			
			slAccNo=$('.SlAccNumTypeAhead').val();
			
			//dl=$('#dl').val();
			
			e.preventDefault();
			$.ajax({
				url: 'StaffLoanRepay',
				type: 'post',
				data: $('#form_dlrepay').serialize()+'&slAlloc='+slAlocID+'&branch='+Bidsl+'&slloanno='+slAccNo+'&charges='+charges+'&amount='+amount+'&xsl='+xsl,
				success: function(data) {
					alert('success');
					$('.pigmidlrepayclassid').click();
				}
			});
		}
	});
	x=1;
	xjl=1;
	xpdl=1;
	xrddl=1;
	xfddl=1;
	xsl=1;
	var htmltext="";
	
	var amt;
	var amt1;
	var xxx="";
	var drop_val="<?php foreach($chargeslist as $key){
		echo "<option >-------------</option>";
		echo "<option value='".$key->charges_id."' >" .$key->charges_name."";
		echo "</option>";
	}?>";
	$('.addcharg').click(function(e){
		
		
		htmltext=	'<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltext+=	'<select class="form-control xtr_drop"  id="BranchListDD'+x+'" name="BranchListDD'+x+'" >'+drop_val+'</select>';  
		htmltext+='<input type="text" class="form-control xtr_charg" id="xtr_charg'+x+'">';
		htmltext+="</label></span>";
		
		x=x+1;
		
		
		
		
		$("#charge").append(htmltext);
		//append
	});
	
	var htmltextjl="";
	$('.jladdcharg').click(function(e){
		
		
		htmltextjl=	'<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltextjl+=	'<select class="form-control xtr_drop"  id="BranchListDDjl'+xjl+'" name="BranchListDD'+xjl+'" >'+drop_val+'</select>';  
		htmltextjl+='<input type="text" class="form-control xtr_charg" id="xtr_chargjl'+xjl+'">';
		htmltextjl+="</label></span>";
		
		xjl=xjl+1;
		
		
		
		
		$("#jlcharge").append(htmltextjl);
		//append
	});
	
	var htmltextpdl="";
	$('.pdladdcharg').click(function(e){
		
		
		htmltextpdl='<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltextpdl+='<select class="form-control xtr_drop"  id="BranchListDDpdl'+xpdl+'" name="BranchListDDpdl'+xpdl+'" >'+drop_val+'</select>';  
		htmltextpdl+='<input type="text" class="form-control xtr_charg" id="xtr_chargpdl'+xpdl+'">';
		htmltextpdl+="</label></span>";
		
		xpdl=xpdl+1;
		
		
		
		
		$("#pdlcharge").append(htmltextpdl);
		//append
	});
	
	var htmltextrddl="";
	$('.rddladdcharg').click(function(e){
		
		
		htmltextrddl='<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltextrddl+='<select class="form-control xtr_drop"  id="BranchListDDrddl'+xrddl+'" name="BranchListDDrddl'+xrddl+'" >'+drop_val+'</select>';  
		htmltextrddl+='<input type="text" class="form-control xtr_charg" id="xtr_chargrddl'+xrddl+'">';
		htmltextrddl+="</label></span>";
		
		xrddl=xrddl+1;
		
		
		
		
		$("#rddlcharge").append(htmltextrddl);
		//append
	});
	
	var htmltextfddl="";
	$('.fddladdcharg').click(function(e){
		
		
		htmltextfddl='<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltextfddl+='<select class="form-control xtr_drop"  id="BranchListDDfddl'+xfddl+'" name="BranchListDDfddl'+xfddl+'" >'+drop_val+'</select>';  
		htmltextfddl+='<input type="text" class="form-control xtr_charg" id="xtr_chargrddl'+xfddl+'">';
		htmltextfddl+="</label></span>";
		
		xrddl=xrddl+1;
		
		
		
		
		$("#fddlcharge").append(htmltextfddl);
		//append
	});
	
	var htmltextsl="";
	$('.sladdcharg').click(function(e){
		
		
		htmltextsl='<span class="xtr"><label class="control-label inline col-md-2">chareges:';
		htmltextsl+='<select class="form-control xtr_drop"  id="BranchListDDsl'+xsl+'" name="BranchListDDsl'+xsl+'" >'+drop_val+'</select>';  
		htmltextsl+='<input type="text" class="form-control xtr_charg" id="xtr_chargsl'+xsl+'">';
		htmltextsl+="</label></span>";
		
		xsl=xsl+1;
		
		
		
		
		$("#slcharge").append(htmltextsl);
		//append
	});
	
	
	
	
	
	
	temp="";
	temp1="";
	function getdata1()
	{		
		for(i=1;i<x;i++)
		{
			amt=$('#BranchListDD'+i).val();
			amt1=$('#xtr_charg'+i).val();
			if(i < x-1){
				temp+=amt+",";
				temp1+=amt1+",";
				}else{
				temp+=amt;
				temp1+=amt1;
			}
			
		}
		
		
	}
	
	$('input.typeaheadbankcrditbank').typeahead({
		//ajax: '/GetBank'
		source:GetBank
	});
	$('.adjustmentTypeAheadPL').change(function(e)
	{
		adid=$('.adjustmentTypeAheadPL').data('value');
		
		
		$.ajax({
			url:'/Getadjustmentdetails',
			type:'post',
			data:'&adid='+adid,
			success:function(data)
			{
				
				$('#plpayamt').val(data['amount']);
				$('#jlpayamt').val(data['amount']);
			}
		});
		
	});
	
	$('.adjustmentTypeAheadJL').change(function(e)
	{
		adid=$('.adjustmentTypeAheadJL').data('value');
		
		
		$.ajax({
			url:'/Getadjustmentdetails',
			type:'post',
			data:'&adid='+adid,
			success:function(data)
			{
				$('#jlpayamt').val(data['amount']);
			}
		});
		
	});
	
	
	var htmltextast="";
	i=0;
	$('.adjustmentcarg').click(function(e){
		
		
		
		htmltextast='<div class="form-group adjust">';
		htmltextast+='<label class="control-label col-sm-4" for="first_name">ADjustment Number :</label>';
		htmltextast+='<div id="the-basics" class="col-sm-4">';
		htmltextast+='<input class="adjustmentTypeAheadPL'+i+' form-control"  type="text"  id="adjustnum'+i+'" onchange=dddd('+i+')>';
		htmltextast+='</div>';
		htmltextast+='</div>';
		
		i=i+1;
		
		$("#adjustcharge").append(htmltextast);
		
		for(var s=0;s<i;s++){
			$('.adjustmentTypeAheadPL'+s).typeahead({
				ajax:'/adjustment_num'
			});
		}
		/*$('.adjustmentTypeAheadPL'+s).change(function(e)
			{
			adid=$('.adjustmentTypeAheadPL'+s).data('value');
			
			
			$.ajax({
			url:'/Getadjustmentdetails',
			type:'post',
			data:'&adid='+adid,
			success:function(data)
			{
			
			$('#plpayamt').val(data['amount']);
			}
			});
			
		});*/
		
		
		
	});
	function dddd(i)
	{
		
		adid=$('.adjustmentTypeAheadPL'+i).data('value');
		
		
		$.ajax({
			url:'/Getadjustmentdetails',
			type:'post',
			data:'&adid='+adid,
			success:function(data)
			{
				a=$('#plpayamt').val();
				b=data['amount'];
				c=parseFloat(a)+parseFloat(b);
				$('#plpayamt').val(c);
			}
		});
		
	}
</script>





























<?php /*


																	$.ajax({
																		url:"/dateDiff",
																		type:"post",
																		data:'&first='+today+'&second='+last_paid_date,
																		success:function(today_to_last) {
																			var num_of_days = today_to_last;
																			console.log("first_repay="+first_repay);
																			if(first_repay == 0) {
																				num_of_days++;//FIRST REPAYMENT NOT DONE
																			}
																			var daydiff = parseInt(num_of_days);
																			console.log("num_of_days="+num_of_days);
																			if(daydiff <= 15) {
																				daydiff=15;
																			} else if(daydiff >= 15 && daydiff <= 30) {
																				daydiff=30;
																			}
																			var years = daydiff/365;
																			var interest = (parseFloat(LoanType_Interest))  / 100;
																			console.log("interest="+interest);
																			jlint =Math.round((years * interest * bal)) + parseFloat(JewelLoan_remaininginterest);
																			
																			$('#jlintamt').val(jlint);
																			bal=Math.round(bal);
																			var tot_rem = (parseFloat(jlint) + parseFloat(bal));
																			$('#jlremtotamt').val(tot_rem);
																			$('#jlloanremainigamt').val(bal);
																			
																			
																			
																		//REPAY REPORT
																			$.ajax({
																			url:'/jewel_loan_repay_report_data',
																			type:'post',
																			data:'&loan_allocation_id='+jlaccid+'&loan_type=JL',
																			success:function(data){
																				$("#jewel_repayment").html(data);
																			 }
																			});
																		//REPAY REPORT END
																		}
																	});//today_to_last AJAX 
																	
																	
										*/?>
<script>
	function jewel_interest()
	{
		console.log("*******fn called*********");
		return;
	}
</script>

<script>
	
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>
<script>
	$("#interest_upto").change(function() {
		console.log("change");
	});
</script>