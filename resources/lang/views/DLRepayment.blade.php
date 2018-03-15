<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
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
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="SB ACCOUNT">SB ACCOUNT</option>
									<option value="PIGMI ACCOUNT">PIGMI ACCOUNT</option>
								</select>
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
									<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
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
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
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
								<input type="text" class="form-control" id="plpayamt" name="plpayamt" placeholder="PAY AMOUNT"onblur="getdata1();" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="plPayMode" name="plPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
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
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
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
								<input type="text" class="form-control" id="slpayamt" name="slpayamt" placeholder="PAY AMOUNT" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Payment Mode:</label>
							<div class="col-md-4">
								<select class="form-control" id="slPayMode" name="slPayMode">
									<option value="">--Select Payment Mode--</option>
									<option value="CASH">CASH</option>
									<!--<option value="PYGMY ACCOUNT">PYGMY ACCOUNT</option>-->
									<option value="SB ACCOUNT">SB ACCOUNT</option>
								</select>
							</div>
						</div>
						
						<div class="form-group sbaccsl">
							<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
							<div id="the-basics" class="col-sm-4">
								<input class="SBAccNumTypeAheadSL form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNumsl">  
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
					
					
					
				</div>
				<!--</form>-->
				{!! Form::open() !!}
				
			</div>
		</div>
	</div>
</div>

<script>
	
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
	
	$('#repay').change(function(e)
	{
		repay1=$('#repay').val();
		if(repay1=="DEPOSIT LOAN")
		{
			$('.dloan').show();
			$('.personal_loan').hide();
			$('.jewel_loan').hide();
			$('.staff_loan').hide();
			
		}
		else if(repay1=="PERSONAL LOAN")
		{
			$('.dloan').hide();
			$('.personal_loan').show();
		}
		else if(repay1=="JEWEL LOAN")
		{
			$('.dloan').hide();
			$('.personal_loan').hide();
			$('.jewel_loan').show();
		}
		else if(repay1=="STAFF LOAN")
		{
			$('.dloan').hide();
			$('.personal_loan').hide();
			$('.jewel_loan').hide();
			$('.staff_loan').show();
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
		}
		else if(dl=="RD DL")
		{
			$('.RD').show();
			$('.pygmy').hide();
			$('.FD').hide();
		}
		else if(dl=="FD DL")
		{
			$('.RD').hide();
			$('.pygmy').hide();
			$('.FD').show();
		}
		else
		{
			alert("Please Select The DL Type");
			$('.RD').hide();
			$('.pygmy').hide();
			$('.FD').hide();
			
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
		}
		else if(pmode=="SB ACCOUNT")
		{
			$('.pgsbaccnumb').show();
			$('.sbacc').show();
			$('.pgsbavailable').show();
			$('.pgsbtotamt').show();
			$('.pgavailable').hide();
			$('.pgtotamt').hide();
			$('.PMPgmForPDL').hide();
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
			
			//$('.pgsbaccnumb').show();
			//$('.sbacc').show();
			//$('.pgsbavailable').show();
			//$('.pgsbtotamt').show();
			//$('.pgavailable').hide();
			$('.PMPgmForPDL').show();
			$('.PMSbForPDL').hide();
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
		}
		
	});
	
	$('#RdPayMode').change(function(e)
	{
		
		pmode=$('#RdPayMode').val();
		if(pmode=="CASH")
		{
			$('.rdsbaccnumb').hide();
			$('.rdsbavailable').hide();
			$('.rdsbtotamt').hide();
			$('.rdavailable').hide();
			$('.rdtotamt').hide();
			$('.sbaccrd').hide();
			$('.PMPgmForRDL').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{
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
		{
			
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
		
	});
	
	$('#FdPayMode').change(function(e)
	{
		
		pmode=$('#FdPayMode').val();
		if(pmode=="CASH")
		{
			$('.fdsbaccnumb').hide();
			$('.fdsbavailable').hide();
			$('.fdsbtotamt').hide();
			$('.fdavailable').hide();
			$('.fdtotamt').hide();
			$('.sbaccfd').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{
			$('.fdsbaccnumb').show();
			$('.sbaccfd').show();
			$('.fdsbavailable').show();
			$('.fdsbtotamt').show();
			$('.fdavailable').hide();
			$('.fdtotamt').hide();
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
		
	});
	
	$('#plPayMode').change(function(e)
	{
		
		pmode=$('#plPayMode').val();
		if(pmode=="CASH")
		{
			$('.plsbaccnumb').hide();
			$('.plsbavailable').hide();
			$('.plsbtotamt').hide();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.sbaccpl').hide();
			$('.pigmyforPL').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{
			$('.plsbaccnumb').show();
			$('.sbaccpl').show();
			$('.plsbavailable').show();
			$('.plsbtotamt').show();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.pigmyforPL').hide();
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
		{
			$('.plsbaccnumb').hide();
			$('.sbaccpl').hide();
			$('.plsbavailable').hide();
			$('.plsbtotamt').hide();
			$('.plavailable').hide();
			$('.pltotamt').hide();
			$('.pigmyforPL').show();
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
	});
	
	$('#jlPayMode').change(function(e)
	{
		
		pmode=$('#jlPayMode').val();
		if(pmode=="CASH")
		{
			$('.jlsbaccnumb').hide();
			$('.jlsbavailable').hide();
			$('.jlsbtotamt').hide();
			$('.jlavailable').hide();
			$('.jltotamt').hide();
			$('.sbaccjl').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{
			$('.jlsbaccnumb').show();
			$('.sbaccjl').show();
			$('.jlsbavailable').show();
			$('.jlsbtotamt').show();
			$('.jlavailable').hide();
			$('.jltotamt').hide();
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
		
	});
	
	$('#slPayMode').change(function(e)
	{
		
		pmode=$('#slPayMode').val();
		if(pmode=="CASH")
		{
			$('.slsbaccnumb').hide();
			$('.slsbavailable').hide();
			$('.slsbtotamt').hide();
			$('.slavailable').hide();
			$('.sltotamt').hide();
			$('.sbaccsl').hide();
		}
		else if(pmode=="SB ACCOUNT")
		{
			$('.slsbaccnumb').show();
			$('.sbaccsl').show();
			$('.slsbavailable').show();
			$('.slsbtotamt').show();
			$('.slavailable').hide();
			$('.sltotamt').hide();
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
		
	});
	
	
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
				bal=data['reamt'];
			}
		});
		
		$.ajax({
			url:'/CalcDayDiff',
			type:'post',
			data:'&dlsdate='+sdate,
			success:function(data)
			{
				daydiff=data;
				inerest=12/100;
				days=daydiff/365;
				
				//alert(bal);
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
	});
	
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
			}
		});
		
		$.ajax({
			url:'/CalcDayDiff',
			type:'post',
			data:'&dlsdate='+sdate,
			success:function(data)
			{
				daydiff=data;
				inerest=12/100;
				days=daydiff/365;
				
				//alert(bal);
				totbal=days*inerest*bal;
				totbal=Math.round(totbal);
				bal=Math.round(bal);
				//alert(totbal);
				$('#rdintamt').val(totbal);
				totamt=(parseFloat(totbal)+parseFloat(bal));
				alert(bal+" "+totbal+" "+totamt);
				$('#rdremtotamt').val(totamt);
				//$('#Pgremtotamt').val(totamt);
				//
			}
		});
	});
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
			}
		});
		
		$.ajax({
			url:'/CalcDayDiff',
			type:'post',
			data:'&dlsdate='+sdate,
			success:function(data)
			{
				daydiff=data;
				inerest=12/100;
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
	});
	
	
	
	$('.PLAccNumTypeAhead').change(function(e)
	{
		
		
		
		
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
				//sdate=$('#plStdate').val();
				//bal=$('#plremamt').val();
				sdate=data['StDte'];
				bal=data['reamt'];
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+sdate,
					success:function(data)
					{
						
						alert(data);
						daydiff=data;
						if(daydiff>90)
						{
							inerest=19/100;
						}
						else
						{
							
							inerest=16/100;
						}
						
						days=daydiff/365;
						
						//bal=round($bal,2);
						totbal=days*inerest*bal;
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
						
						
					}
				});
				
				
				
			}
		});
		
		
		
		
	});
	
	$('.JLAccNumTypeAhead').change(function(e)
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
				sdate=$('#jlStdate').val();
				datecal=$('#jldatecal').val();
				edate=$('#jlEnddate').val();
				bal=$('#jlremamt').val();
				bal=data['reamt'];
				datecal=data['datecal'];
				
				
				$.ajax({
					url:'/CalcDayDiff',
					type:'post',
					data:'&dlsdate='+datecal,
					success:function(data)
					{
						daydiff2=data;
						daydiff1=parseInt(daydiff2)+1;
						//alert(daydiff);
						$.ajax({
							url:'/jlCalcDayDiff',
							type:'post',
							data:'&dlsdate='+datecal+'&strdate='+sdate,
							success:function(data)
							{
								checkdate=data;
								
							}
						});
						
						
						
						
						daydiff=parseInt(daydiff1);
						
						if(datecal > checkdate)
						{
							
						}
						else
						{
							if(daydiff<=15)
							{
								
								daydiff=15;	
							}
							else if(daydiff>=15&&daydiff<=30)
							{
								daydiff=30;
								
							}
						}
						
						//	}
						//	else
						//		{
						//		daydiff=parseInt(daydiff1);
						//	}
						//	if(today>edate)
						//	{
						//		inerest=18/100;
						//	}
						//	else
						//	{
						inerest=15/100;
						//	}
						
						alert(daydiff);
						//days=daydiff/365;
						
						
						//totbal=days*inerest*bal;
						totbal=(bal*daydiff*inerest)/365;
						totbal=Math.round(totbal);
						bal=Math.round(bal);
						$('#jlintamt').val(totbal);
						totamt=(parseFloat(totbal)+parseFloat(bal));
						//alert(bal+" "+totbal+" "+totamt);
						$('#jlremtotamt').val(totamt);
						$('#jlloanremainigamt').val(bal);
						
						
					}
				});
				
				
			}
		});
		
		
		
		
	});
	
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
			}
		});
		
		
		$.ajax({
			url:'/CalcDayDiff',
			type:'post',
			data:'&dlsdate='+sdate,
			success:function(data)
			{
				daydiff=data;
				inerest=13/100;
				days=daydiff/365;
				
				
				totbal=days*inerest*bal;
				
				$('#slintamt').val(totbal);
				totamt=(parseFloat(totbal)+parseFloat(bal));
				alert(bal+" "+totbal+" "+totamt);
				$('#slremtotamt').val(totamt);
				
				
			}
		});
		
	});
	
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
	
	$('.sbmbtn').click( function(e) {
		dl=$('#dl').val();
		
		
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
		
		BidP=$('.BranchTypeAheadPG').data('value');
		BidR=$('.BranchTypeAheadRD').data('value');
		BidF=$('.BranchTypeAheadFD').data('value');
		//alert(BidR);
		DlAccNo=$('.PygmyAccNumTypeAhead').val();
		RDDlAccNo=$('.RDAccNumTypeAhead').val();
		FDDlAccNo=$('.FDAccNumTypeAhead').val();
		
		
		//alert(DlAlocID);
		e.preventDefault();
		$.ajax({
			url: 'createPigmyDL',
			type: 'post',
			data: $('#form_dlrepay').serialize()+'&DLAlloc='+DlAlocID+'&RDDLAlloc='+RDDlAlocID+'&FDDLAlloc='+FDDlAlocID+'&BranchIDP='+BidP+'&BranchIDR='+BidR+'&BranchIDF='+BidF+'&DLAccNum='+DlAccNo+'&RDDLAccNum='+RDDlAccNo+'&FDDLAccNum='+FDDlAccNo+'&dltype='+dl+'&charges='+temp+'&amount='+temp1+'&loopid='+x,
			success: function(data) {
				alert('success');
				$('.pigmidlrepayclassid').click();
			}
		});
		
	});
	
	//SUBMIT FOR PERSONAL LOAN
	$('.PLRPSbmBtn').click( function(e) {
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
		
		
		plAccNo=$('.PlAccNumTypeAhead').val();
		
		//dl=$('#dl').val();
		
		e.preventDefault();
		$.ajax({
			url: 'PersonalLoanRepay',
			type: 'post',
			data: $('#form_dlrepay').serialize()+'&plAlloc='+plAlocID+'&branch='+Bidpl+'&plloanno='+plAccNo+'&charges='+temp+'&amount='+temp1+'&loopid='+x,
			success: function(data) {
				alert('success');
				$('.pigmidlrepayclassid').click();
			}
		});
		
	});
	
	//SUBMIT FOR jewel LOAN
	$('.JLRPSbmBtn').click( function(e) {
		
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
		jlAccNo=$('.JlAccNumTypeAhead').val();
		e.preventDefault();
		$.ajax({
			url: 'JewelLoanRepay',
			type: 'post',
			data: $('#form_dlrepay').serialize()+'&jlAlloc='+jlAlocID+'&branch='+Bidjl+'&jlloanno='+jlAccNo+'&charges='+temp+'&amount='+temp1+'&loopid='+xjl,
			success: function(data) {
				alert('success');
				$('.pigmidlrepayclassid').click();
			}
		});
		
	});
	
	//SUBMIT FOR staff LOAN
	$('.SLRPSbmBtn').click( function(e) {
		
		
		slAlocID=$('.SLAccNumTypeAhead').data('value');
		
		
		Bidsl=$('.BranchTypeAheadSL').data('value');
		
		
		slAccNo=$('.SlAccNumTypeAhead').val();
		
		//dl=$('#dl').val();
		
		e.preventDefault();
		$.ajax({
			url: 'StaffLoanRepay',
			type: 'post',
			data: $('#form_dlrepay').serialize()+'&slAlloc='+slAlocID+'&branch='+Bidsl+'&slloanno='+slAccNo,
			success: function(data) {
				alert('success');
				$('.pigmidlrepayclassid').click();
			}
		});
		
	});
	x=1;
	xjl=1;
	xpdl=1;
	xrddl=1;
	xfddl=1;
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
</script>
