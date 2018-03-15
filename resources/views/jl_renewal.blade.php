<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>LOAN ALLOCATION DETAILS</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					
					{!! Form::open(['url' => 'JewelLoanAllocation','class' => 'form-horizontal','id' => 'FormJewelLoanAlloc','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
					
					
					
					<div class="StaffLoan">
						<div class="form-group">
							
							<div class="col-md-6 alert-success">
								<div class="row">
									
									<div class="form-group">
										<label class="control-label col-sm-4"> Loan Number:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="account_num" name="account_num" value="{{$jlall['jlloanno']}}">
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Old Principal Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="old_principal_num" name="old_principal_num" value="{{$jlall['jlremamt']}}">
										</div>
										</div><div class="form-group">
										<label class="control-label col-sm-4">Old Interest Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="old_interest_num" name="old_interest_num" value="{{$jlall['jlintamt']}}">
											
											<input type="text" class="form-control hidden" id="charges" name="charges" value="{{$jlall['charges']}}">
											
											<input type="text" class="form-control hidden" id="amount" name="amount" value="{{$jlall['amount']}}">
											
											<input type="text" class="form-control hidden" id="loopid" name="loopid" value="{{$jlall['loopid']}}">
											
											<input type="text" class="form-control" id="tot" name="tot" value="{{$jlall['tot']}}">
										</div>
									</div>
									
									<input type="text" class="form-control hidden" id="bid" name="bid" >
									<input type="text" class="form-control hidden" id="loantyp" name="loantyp" >
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Duration:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="Jewelduration" name="Jewelduration" placeholder="Duration Month" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Loan Amount:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelAmt" name="JewelAmt" placeholder="LOAN AMOUNT" onblur="CheckAmt();">
										</div>
									</div>
									
									<div class="form-group cash_amt">
										<label class="control-label col-sm-4"> Amount to be recived:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="Amt_recive" name="Amt_recive" placeholder="LOAN AMOUNT">
											
											<input type="text" class="form-control hidden" id="totcharge" name="totcharge">
										</div>
									</div>	
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Sarapara Comission:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelspacomValReadOnly" name="JewelspacomValReadOnly" placeholder="SARAPARA COMISSION" disabled>
											
											<input type="text" class="form-control hidden" id="JewelspacomVal" name="JewelspacomVal">
											
											<input type="text" class="form-control hidden" id="Jewelspacom" name="Jewelspacom">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Insurance Charge:</label>
										<div class="col-md-6"> 
											<input type="text" class="form-control" id="JewelinsuValReadOnly" name="JewelinsuValReadOnly" placeholder="INSURANCE CHARGE" disabled>
											
											<input type="text" class="form-control hidden" id="JewelinsuVal" name="JewelinsuVal" placeholder="INSURANCE CHARGE">
											
											
											<input type="text" class="form-control hidden" id="Jewelinsu" name="Jewelinsu">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-4">Book and Forms Charge:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelBkfrmChrgValReadOnly" name="JewelBkfrmChrgValReadOnly" placeholder="BOOK AND FORMS CHARGE" disabled>
											
											<input type="text" class="form-control hidden" id="JewelBkfrmChrgVal" name="JewelBkfrmChrgVal" placeholder="BOOK AND FORMS CHARGE" >
											
											<input type="text" class="form-control hidden" id="JewelBkfrmChrg" name="JewelBkfrmChrg">
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Other Charge:</label>
										<div class="col-md-6">
											<input type="text" class="form-control hidden" id="JewelOthrChrges" name="JewelOthrChrges" placeholder="OTHER CHARGE">
											<input type="text" class="form-control" id="JewelOthrChrgesReadOnly" name="JewelOthrChrgesReadOnly" placeholder="OTHER CHARGE" disabled>
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-sm-4">Payable Amount After Deduction:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelPayAmountAfterReadOnly" name="JewelPayAmountAfterReadOnly" placeholder="Payable Amount After Deduction" disabled>
											<input type="text" class="form-control hidden" id="JewelPayAmountAfter" name="JewelPayAmountAfter">
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="col-md-6 alert-success">
								<div class="row">
									
									<div class="form-group">
										<label class="control-label col-sm-4">Start Date:</label>
										<div class="col-md-6">
											<input type="text" class="form-control hidden" id="JewelStartDate" name="JewelStartDate" value="<?php echo date('Y-m-d');?>">
											<input type="text" class="form-control" id="JewelStartDate1" name="JewelStartDate1" value="<?php echo date('d/m/Y');?>">
										</div>
										
										
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">End Date:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="JewelEndDate" name="JewelEndDate" placeholder="ENTER END DATE">
									</div>
								</div>
								
								
								<div class="form-group pay_mode">
									<label class="control-label col-sm-4">Payment Mode:</label>
									<div class="col-md-6">
										<select class="form-control" id="JewelPayMode" name="JewelPayMode">
											<option value="">--Select Payment Mode--</option>
											<option value="CASH">CASH</option>
											<option value="CHEQUE">CHEQUE</option>
											<option value="SB ACCOUNT">SB ACCOUNT</option>
										</select>
									</div>
								</div>
								
								
								
								<div class="form-group sbaccnumb">
									<label class="control-label col-sm-4" for="first_name">SB Account Number :</label>
									<div class="col-sm-6">
										<input class="SBAccNumTypeAhead form-control"  type="text" placeholder="SELECT SB ACCOUNT NUMBER" id="SBAccNum">  
									</div>
									
									<div class="form-group hidden">
										<label class="control-label col-sm-4">SB Account Number:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelSBAccountNum" name="JewelSBAccountNum" disabled >
										</div>
									</div>
									
									<input type="text" class="form-control hidden" id="JewelSBAcNum" name="JewelSBAcNum" >
								</div>
								
								<div class="form-group sbavailable">
									
									<label class="control-label col-sm-4">SB Available Amount:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="JewelSBAvailReadOnly" name="JewelSBAvailReadOnly" disabled>
										<input type="text" class="form-control hidden" id="JewelSBAvail" name="JewelSBAvail">
									</div>
								</div>
								
								<div class="form-group sbtotamt">
									
									<label class="control-label col-sm-4">SB Total Amount:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="JewelSBtotalReadOnly" name="JewelSBtotalReadOnly" disabled>
										<input type="text" class="form-control hidden" id="JewelSBtotal" name="JewelSBtotal">
									</div>
								</div>
								
								<div class="JewelCheque">
									
									<div class="form-group chequenum">
										
										<label class="control-label col-md-4">Cheque Number:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelChequeNum" name="JewelChequeNum" placeholder="CHEQUE NUMBER">
										</div>
									</div>
									
									<div class="form-group chequedte">
										
										<label class="control-label col-md-4">CHEQUE DATE:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelChequeDte" name="JewelChequeDte" placeholder="CHEQUE DATE">
										</div>
									</div>
									
									
									
									<div class="form-group bnknme">
										<label class="control-label col-md-4">Bank Name:</label>
										<div class="col-md-6">
											<input type="text" class="form-control JewelBankNameTypeAhead" id="JewelBankName" name="JewelBankName" placeholder="SELECT BANK">
										</div>
									</div>
									
									<div class="form-group bnkbranch">
										<label class="control-label col-md-4">Bank Branch:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelBankBranch" name="JewelBankBranch" placeholder="BANK BRANCH" disabled>
										</div>
									</div>		
									
									<div class="form-group ifsccde">
										<label class="control-label col-md-4">IFSC Code:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelIFSC" name="JewelIFSC" placeholder="IFSC CODE" disabled>
										</div>
									</div>
									
									<div class="form-group ifsccde">
										<label class="control-label col-md-4">Account Number:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelBankAccNumber" name="JewelBankAccNumber" placeholder="ACCOUNT NUMBER" disabled>
										</div>
									</div>
									
									<div class="form-group ifsccde">
										<label class="control-label col-md-4">Account Balance:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="JewelBankAccBlance" name="JewelBankAccBlance" placeholder="ACCOUNT Balance" disabled>
										</div>
									</div>
								</div> <!--alert-success for PigmyPayAmt Cheque ends-->
								
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="lnmonth" name="lnmonth" value="12" >
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="lntp" name="lntp">
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="6mon" name="6mon">
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="1yr" name="1yr" >
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="uid" name="uid" >
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="sbacval" name="sbacval" >
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="jewelLoanInhand" name="jewelLoanInhand" >
								</div>
								
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="StfAccountNum" name="StfAccountNum" >
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="StfAvailableAmount" name="StfAvailableAmount" >
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="YearInDays" name="YearInDays" value="365">
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="StfLoanChequeState" name="StfLoanChequeState" value="CLEARED">
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="StfLoanInhand" name="StfLoanInhand">
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="StfLoanSBAccid" name="StfLoanSBAccid">
								</div>
								
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="StfLoanSBAccTid" name="StfLoanSBAccTid">
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="jeweluid" name="jeweluid">
								</div>
								<div class="col-md-4 hidden">
									<input type="text" class="form-control" id="Jewel_Description" name="Jewel_Description"><input type="text" class="form-control" id="PersLoanAllocID" name="PersLoanAllocID">
								</div>
							</div>
						</div>
					</div>
				</div>
				<center>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CREATE" class="btn btn-success btn-sm JewelSbmBtn"/>
							<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
							
						</div>
					</div>
				</center><!--Deposite Loan Allocation Detail ends-->
				
				
				
				
				
				{!! Form::close()!!}
			</div>
		</div>
	</div>
</div>
</div>







<script>
	
	//$('document').ready(function(){
	
	//$('.DurTextDay').hide();
	//$('.DurTextYear').hide();
	$('.JewelCheque').hide();
	$('.sbavailable').hide();
	$('.sbaccnumb').hide();
	$('.sbtotamt').hide();
	$('.cash_amt').hide();
	
	
	//});
	
	$('input.JewelLoanTTypeAhead').typeahead({
		ajax: '/GetLoanType'
	});
	
	//Get Branch
	$('input.JewelBranchTypeAhead').typeahead({
		ajax:'/GetBranchCode'
	});
	
	$('input.JewelBankNameTypeAhead').typeahead({
		ajax:'/GetBank'
	});
	
	$('input.CustnameTypeahead').typeahead({
		
		ajax:'/Getjewelcustfromrequesttable'
		
	});
	
	
	//Check Loan Amount
	function CheckAmt()
	{
		
		
		
		
		$.ajax({
			url:'/GetJewelDetail',
			type:'get',
			success:function(data)
			{
				durationamt=0;
				loanamt=$('#JewelAmt').val();
				Duration_month=$('#Jewelduration').val();
				Duration_month=parseInt(Duration_month);
				//	if(dur=="6 MONTHS")
				//	{
				month=data['6month'];
				
				sarapara=data['sapacom'];
				
				bookandform=data['book_form'];
				
				Jewelinsu=data['insurance'];
				JewelOthrChrges=data['other_charges'];
				$('#JewelOthrChrges').val(data['other_charges']);
				$('#JewelOthrChrgesReadOnly').val(data['other_charges']);
				
				SaraChrg=((parseFloat(sarapara)*loanamt)/100);
				BFChrg=((parseFloat(bookandform)*loanamt)/100);
				InsuChrg=((parseFloat(Jewelinsu)*loanamt)/100);
				SaraChrg=Math.round(SaraChrg);
				BFChrg=Math.round(BFChrg);
				InsuChrg=Math.round(InsuChrg);
				
				$('#JewelspacomValReadOnly').val(parseFloat(SaraChrg));
				$('#JewelspacomVal').val(parseFloat(SaraChrg));
				$('#JewelinsuValReadOnly').val(parseFloat(InsuChrg));
				$('#JewelinsuVal').val(parseFloat(InsuChrg));
				$('#JewelBkfrmChrgValReadOnly').val(parseFloat(BFChrg));
				$('#JewelBkfrmChrgVal').val(parseFloat(BFChrg));
				
				JewelOthrChrges=parseFloat(JewelOthrChrges);
				TotCharges=(parseFloat(SaraChrg)+parseFloat(BFChrg)+parseFloat(InsuChrg)+parseFloat(JewelOthrChrges));
				$('#totcharge').val(TotCharges);
				PayAftDed=(parseFloat(loanamt)-parseFloat(TotCharges));
				$('#JewelPayAmountAfter').val(parseFloat(PayAftDed));
				$('#JewelPayAmountAfterReadOnly').val(parseFloat(PayAftDed));
				
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
				var result1 = myDate.addMonths(Duration_month);
				
				var dateObj1 = new Date(result1);
				var month = dateObj1.getUTCMonth() + 1; //months from 1-12
				var day = dateObj1.getUTCDate();
				var year = dateObj1.getUTCFullYear();
				var newdate5 = day + "/" + month + "/" + year;
				
				
				
				document.getElementById('JewelEndDate').value = newdate5;
				
				
				old_principal_num=$('#old_principal_num').val();
				old_interest_num=$('#old_interest_num').val();
				JewelAmt=$('#JewelAmt').val();
				
				if(old_principal_num==JewelAmt)
				{
					totbal=$('#tot').val();
					
					totamt=parseFloat(old_principal_num)+parseFloat(old_interest_num);
					totamt=parseFloat(totbal)-parseFloat(totamt);
					cashamt=parseFloat(old_interest_num)+parseFloat(TotCharges)+parseFloat(totamt);
					$('#Amt_recive').val(cashamt);
					$('#JewelPayAmountAfter').val("0");
					$('#JewelPayAmountAfterReadOnly').val("0");
					$('.cash_amt').show();
					$('.pay_mode').hide();
					  
				}
			}
		});
		
		
		
		
	}
	
	$('.JewelBankNameTypeAhead').change(function(e){
		
		bankid=$('.JewelBankNameTypeAhead').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'getbankdetails',
			type:'get',
			data:'&bankid='+bankid,
			success:function(data)
			{ 
				$('#JewelIFSC').val(data['AddBank_IFSC']);
				$('#JewelBankAccNumber').val(data['AccountNo']);
				$('#JewelBankAccBlance').val(data['TotalAmt']);
			}
		});
	});
	
	
	//PaymentMode Changed (Newly Added)
	$('#JewelPayMode').change( function(e) {
		e.preventDefault();
		mode=$('#JewelPayMode').val();
		if(mode=="CASH")
		{
			$('.JewelCheque').hide();
			$('.JewelChequeDte').hide();
			$('.JewelChequeNum').hide();
			$('.JewelBankName').hide();
			$('.JewelBankBranch').hide();
			$('.JewelIFSC').hide();
			$('.sbavailable').hide();
			$('.sbaccnumb').hide();
			$('.sbtotamt').hide();
			loan=$('#JewelAmt').val();
			loanamt=parseFloat(loan);
			inhand=$('#jewelLoanInhand').val();
			inhandval=parseFloat(inhand);
		}
		else if(mode=="CHEQUE"){
			$('.JewelCheque').show();
			$('.JewelChequeDte').show();
			$('.JewelChequeNum').show();
			$('.JewelBankName').show();
			$('.JewelBankBranch').show();
			$('.JewelIFSC').show();
			//$('#StfLoanChequeState').val("UNCLEARED");
			$('.sbavailable').hide();
			$('.sbaccnumb').hide();
			$('.sbtotamt').hide();
			
		}
		else if(mode=="SB ACCOUNT"){
			$('.JewelCheque').hide();
			$('.JewelChequeDte').hide();
			$('.JewelChequeNum').hide();
			$('.JewelBankName').hide();
			$('.JewelBankBranch').hide();
			$('.JewelIFSC').hide();
			$('.sbavailable').show();
			$('.sbaccnumb').show();
			$('.sbtotamt').show();
			
			
			
			
			$('.SBAccNumTypeAhead').change(function(e)
			{
				AccNum=$('.SBAccNumTypeAhead').data('value');
				$.ajax({
					url:'/DLRepayGetSBDetails',
					type:'post',
					data:'&sbAcNo='+AccNum,
					success:function(data)
					
					{
						$('#JewelSBAccountNum').val(data['acnum']);
						$('#JewelSBAcNum').val(data['acnum']);
						$('#JewelSBAvailReadOnly').val(data['totamt']);
						$('#JewelSBAvail').val(data['totamt']);
						AvailBal=$('#JewelSBAvail').val();
						
						LoanAmt=$('#JewelPayAmountAfter').val();
						TotalAmt=(parseFloat(AvailBal)+parseFloat(LoanAmt));
						$('#JewelSBtotal').val(TotalAmt);
						$('#JewelSBtotalReadOnly').val(TotalAmt);
						
						
						
					}
				});
			});
		}
		else
		{
			
			
			alert("Please Select the Payment Mode");
		}
	});
	
	
	indexid=0;
	
	$('.JewelSbmBtn').click( function(e) 
	{
		if(indexid==0)
		{
			
			bankid=$('.JewelBankNameTypeAhead').data('value');
			//indexid++;
			
			accid=$('.SBAccNumTypeAhead').data('value');
			
			user=$('#Custname').data('value');
			//BankName=$('#JewelBankName').data('value');
			e.preventDefault();
			$.ajax({
				url: 'JewelLoanAllocation_Renewal',
				type: 'post',
				data: $('#FormJewelLoanAlloc').serialize()+'&BankId='+bankid+'&accid='+accid,
				success: function(data) {
					alert('Success');
					$('.jewloanclassid').click();
				}
			});
		}
	});
	
	$('.SBAccNumTypeAhead').typeahead({
		ajax:'/SBdlacc'
	});
	
	
	
</script>
