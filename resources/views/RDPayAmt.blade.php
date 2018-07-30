

<script src="js/jquery.min.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i>		&nbsp RD Pay Amount</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "CreateRDPayAmount",'class' => 'form-horizontal','id' => 'RDFormPayAmount','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Interest Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="RDIntMode" name="RDIntMode">
								<option value="">--Select Interest Type--</option>
								<option value="INTEREST">INTEREST</option>
								<option value="PREWITHDRAWAL">PREWITHDRAWAL</option>
							</select>
						</div>
					</div>
					
					<div class="form-group preacc">
						<label class="control-label col-sm-4" for="comment">RD Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control RDAccNumTypeAhead" id="RDAccnum" name="RDAccnum" placeholder="SELECT RD ACCOUNT "/>
						</div>
					</div>
					
					<div class="form-group intacc">
						<label class="control-label col-sm-4" for="comment">RD Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control RDIntAccNumTypeAhead" id="RDIntAccnum" name="PigmyIntAccnum" placeholder="SELECT RD INTEREST ACCOUNT "/>
						</div>
					</div>	
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="rdaccount" name="rdaccount">
					</div>
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="uid" name="uid">
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Customer Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="RDPayFullName" name="RDPayFullName" placeholder="FULL NAME" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Total Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdTot" name="rdTot" placeholder="TOTAL AMOUNT" disabled>
						</div>
					</div>
					
					<div class="form-group rdint">
						<label class="control-label col-sm-4">Interest Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rdintamt" name="rdintamt" placeholder="INTEREST AMOUNT" disabled>
						</div>
					</div>
					
					<div class="form-group rddedamt">
						<label class="control-label col-sm-4">Deduction Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rddedamt" name="rddedamt" placeholder="COMMISSION" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payable Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="RDPayableAmtReadOnly" name="RDPayableAmtReadOnly" placeholder="PAYABLE AMOUNT" disabled>
						</div>
					</div>
					<input type="text" class="form-control hidden" id="RDPayableAmt" name="RDPayableAmt" placeholder="PAYABLE AMOUNT">
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="RDPayMode" name="RDPayMode">
								<option value="">--Select Payment Mode--</option>
								<option value="CASH">CASH</option>
								<option value="CHEQUE">CHEQUE</option>
								<option value="SB ACCOUNT">SB ACCOUNT</option>
							</select>
						</div>
					</div>
					<div class="form-group sbaccnoreadonly">
						<div class="form-group">
							<label class="control-label col-sm-4">Account Number:</label>
							<div class="col-md-4">
								<input class="typeahead form-control"  id="account" type="text" name="account" placeholder="SELECT Account Number">  
							</div>
						</div>
						<label class="control-label col-md-4">SB Account Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="sbaccnoreadonly" name="sbaccnoreadonly" placeholder="SB ACCOUNT NUMBER" disabled>
						</div>
					</div>
					
					<div class="form-group sbavailamtreadonly">
						
						<label class="control-label col-md-4">SB Available Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="sbavailamtreadonly" name="sbavailamtreadonly" placeholder="SB AVAILABLE BALANCE" disabled>
						</div>
					</div>
					<div class="form-group sbremamtreadonly">
						
						<label class="control-label col-md-4">SB Remaining Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="sbremamtreadonly" name="sbremamtreadonly" placeholder="SB REMAINING BALANCE" disabled>
						</div>
						</div>
						
						<input type="text" class="form-control hidden" id="sbremamt" name="sbremamt">
						
						<input type="text" class="form-control hidden" id="sbavailamt" name="sbavailamt">
						<input type="text" class="form-control hidden" id="accid" name="accid">
						<input type="text" class="form-control hidden" id="sbaccno" name="sbaccno">
						
						<div class="alert alert-success PigCheque col-md-8 col-md-offset-2">
							
							<div class="form-group chequenum">
								
								<label class="control-label col-md-3">Cheque Number:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="RDPayChequeNum" name="RDPayChequeNum" placeholder="CHEQUE NUMBER">
								</div>
							</div>	
							
							<div class="form-group chequedte">
								<label class="col-md-3 control-label">CHEQUE DATE</label>
								<div class="col-md-6 date">
									
									<div class="input-group input-append">
										<input type="text" name="RDPayChequeDate" id="RDPayChequeDate" class="form-control" value=""/>
										<span class="input-group-addon add-on">
											<span class="glyphicon glyphicon-calendar">
											</span>
											<b class="caret"></b>
										</span> 
									</div>
									
								</div>
							</div>
							
							
							
							<div class="form-group bnknme">
								<label class="control-label col-md-3">Bank Name:</label>
								<div class="col-md-6">
									<input type="text" class="form-control BankNameTypeAhead" id="RDPayBankName" name="RDPayBankName" placeholder="SELECT BANK">
								</div>
							</div>
							
							
							<div class="form-group bnkbranch">
								<label class="control-label col-md-3">Bank Branch:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="RDPayBankBranch" name="RDPayBankBranch" placeholder="BANK BRANCH" disabled>
								</div>
							</div>		
							
							
							<div class="form-group ifsccde">
								<label class="control-label col-md-3">IFSC Code:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="RDPayIfsc" name="RDPayIfsc" placeholder="IFSC CODE" disabled>
								</div>
							</div>
							
							
							<div class="form-group ifsccde">
								<label class="control-label col-md-3">Account Number:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="RDPayAccountNumber" name="RDPayAccountNumber" placeholder="ACCOUNT NUMBER" disabled>
								</div>
							</div>
							<input type="text" class="form-control hidden" id="acnvalue" name="acnvalue">
							<input type="text" class="form-control hidden" id="actid" name="actid">
							
						</div> <!--alert-success for PigmyPayAmt Cheque ends-->
						
						
						
						<center>
							
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CREATE" class="btn btn-success btn-sm RDPaySbmBtn"/>
									<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
									<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
								</div>
							</div>
							
						</center>
						
						
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<!--------------------------------------------------------------------------------->	
	<script src="js/bootstrap-typeahead.js"></script>
	
	<script src="js/jquery.validate.min.js"></script>
	<script>
		branchid=0;
		
		$('.cnclbtn').click(function(e){
			var retVal = confirm("Are You Sure ?");
			if( retVal == true ){
				$('.payclassid').click();
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
		
		/*$('.RDPaySbmBtn').click( function(e) {
			//branchid=$('ul.typeahead li.active').data('value');
			
			e.preventDefault();
			$.ajax({
			url: 'RDPayAmount',
			type: 'post',
			data: $('#RDFormPayAmount').serialize(),
			success: function(data) {
			alert('success');
			$('.rdpayclassid').click();
			}
			
			});
			
		});*/
		
	</script>
	
	
	<script>
		//Hide Cheque Number and Cheque Date (Newly Added)
		$('.PigCheque').hide();
		$('.chequedte').hide();
		$('.chequenum').hide();
		$('.bnknme').hide();
		$('.bnkbranch').hide();
		$('.ifsccde').hide();
		$('.sbavailamtreadonly').hide();
		$('.sbremamtreadonly').hide();
		$('.sbaccnoreadonly').hide();
		$('input.typeahead').typeahead({
			//ajax: '/Getaccnum'
			source:Getaccnum
		});
		//PaymentMode Changed (Newly Added)
		$('#RDPayMode').change( function(e) {
			e.preventDefault();
			mode=$('#RDPayMode').val();
			
			if(mode=="CASH")
			{
				$('.PigCheque').hide();
				$('.chequedte').hide();
				$('.chequenum').hide();
				$('.bnknme').hide();
				$('.bnkbranch').hide();
				$('.ifsccde').hide();
				$('.sbavailamtreadonly').hide();
				$('.sbremamtreadonly').hide();
				$('.sbaccnoreadonly').hide();
				
			}
			else if(mode=="CHEQUE"){
				$('.PigCheque').show();
				$('.chequedte').show();
				$('.chequenum').show();
				$('.bnknme').show();
				$('.bnkbranch').show();
				$('.ifsccde').show();
				$('.sbavailamtreadonly').hide();
				$('.sbremamtreadonly').hide();
				$('.sbaccnoreadonly').hide();
			}
			else if(mode=="SB ACCOUNT"){
				$('.PigCheque').hide();
				$('.chequedte').hide();
				$('.chequenum').hide();
				$('.bnknme').hide();
				$('.bnkbranch').hide();
				$('.ifsccde').hide();
				$('.sbavailamtreadonly').show();
				$('.sbremamtreadonly').show();
				$('.sbaccnoreadonly').show();
				
				
			}
			
			else{
				
				//$('.PigCheque').hide();
				alert("Please Select the Payment Mode");
			}
		});
		
		
		
		$('#account').change( function(e) {
			usr=$('#account').data('value');
			$.ajax({
				url:'GetSBForRDPayAmt',
				type:'post',
				data:'&usrid='+usr,
				success:function(data){
					
					$('#acnvalue').val(data['acn']);
					acnval=$('#acnvalue').val();
					if(acnval==0)
					{
						//alert(acn);
						$('#sbavailamt').val(data['tot']);
						sbamt=$('#sbavailamt').val();
						$('#sbavailamtreadonly').val(sbamt);
						$('#sbaccno').val(data['acccn']);
						$('#sbaccnoreadonly').val(data['acccn']);
						$('#accid').val(data['acid']);
						payamt=$('#RDPayableAmt').val();
						sbtotal=(parseFloat(payamt)+parseFloat(sbamt));
						//	sbtotal=payamt+sbamt;
						
						$('#sbremamtreadonly').val(sbtotal);
						$('#sbremamt').val(sbtotal);
						$('#actid').val(data['actid']);
					}
					else
					{
						alert("SB Account Does not exist for this Customer. Please Create a SB Account");
					}
					
				}
			});
		});
	</script>
	
	
	
	<script>
		
		
		
		//Typeahead for Bank Branch Name from AddBank Table
		$('input.BankNameTypeAhead').typeahead({
			ajax:'/GetBankNameForPayAmt'
		});
		
		//Typeahead for Pigmy Account Number from PreWithdrawel Table
		$('input.RDAccNumTypeAhead').typeahead({
			ajax:'/GetRDAccForPayAmt'
		});
		
		//Typeahead for Pigmy Account Number from Interest Table (Newly Added)
		$('input.RDIntAccNumTypeAhead').typeahead({
			ajax:'/GetRDIntAccForPayAmt'
		});
		
		// Hide and show
		$('.preacc').hide();
		$('.intacc').show();
		$('.rdint').show();
		$('.rddedamt').hide();
		
		//Interest Type Changed
		$('#RDIntMode').change(function(e){
			pim=$('#RDIntMode').val();
			if(pim=="INTEREST")
			{
				$('.preacc').hide();
				$('.intacc').show();
				$('.rdint').show();
				$('.rddedamt').hide();
				$('#RDAccnum').val("");
				$('#RDIntAccnum').val("");
				$('#RDIntAccnum').data("");
				$('#RDAccnum').data("");
				$('#RDPayFullName').val("");
				$('#RDPayableAmtReadOnly').val("");
				$('#RDPayableAmt').val("");
				$('#rdTot').val("");
				$('#rdintamt').val("");
				$('#rddedamt').val("");
				$('#rdaccount').val("");
			}
			else if(pim=="PREWITHDRAWAL")
			{
				$('.preacc').show();
				$('.intacc').hide();
				$('.rdint').hide();
				$('.rddedamt').show();
				$('#RDAccnum').val("");
				$('#RDIntAccnum').val("");
				$('#RDIntAccnum').data("");
				$('#RDAccnum').data("");
				$('#RDPayFullName').val("");
				$('#RDPayableAmtReadOnly').val("");
				$('#RDPayableAmt').val("");
				$('#rdTot').val("");
				$('#rdintamt').val("");
				$('#rddedamt').val("");
				$('#rdaccount').val("");
			}
			else
			{
				alert("Please select the interest type");
			}
			
		});
		
		//Typeahed of interest RD account number Changed
		$('#RDIntAccnum').change(function(e){
			RDIntac=$('#RDIntAccnum').val();
			e.preventDefault();
			$.ajax({
				url:'GetRDIntDetailsForPayAmt',
				type:'get',
				data:'&RDIntAccNum='+RDIntac,
				success:function(data)
				{
					$('#RDPayableAmt').val(data['TotIntPayAmt']);
					
					$('#RDPayableAmtReadOnly').val(data['TotIntPayAmt']);
					TEST=data['RDIntFn']+" . "+data['RDIntMn']+" . "+data['RDIntLn'];
					$('#RDPayFullName').val(TEST);
					$('#rdaccount').val(RDIntac);
					$('#uid').val(data['uid']);
					// $('#rdTot').val(data['mtot']);
					$('#rdTot').val(data['principle']);
					$('#rdintamt').val(data['intrst']);
					//payamt=parseFloat(totamt);
					//alert(totamt);
					totamt=$('#RDPayableAmt').val();
					payamt=parseFloat(totamt);
					if(payamt>20000)
					{
						alert("Amount Payable is Greater than 20,000. Please Transfer to SB Account");
					}
					
					
					
				}
			});
			
		});
	</script>
	
	<script>
		//PigmiAccount Number Changed
		$('.RDAccNumTypeAhead').change(function(e){
			
			RDAN=$('.RDAccNumTypeAhead').val();
			e.preventDefault();
			$.ajax({
				url:'GetRDDetailsForPayAmt',
				type:'get',
				data:'&RDAccNum='+RDAN,
				success:function(data)
				{
					
					$('#RDPayableAmt').val(data['RDPayAmt']);
					$('#RDPayableAmtReadOnly').val(data['RDPayAmt']);
					TEST=data['RDFn']+" . "+data['RDMn']+" . "+data['RDLn'];
					$('#RDPayFullName').val(TEST);
					$('#uid').val(data['uid']);
					$('#rdTot').val(data['RDTot']);
					$('#rddedamt').val(data['RDDedAmt']);
					$('#rdaccount').val(RDAN);
					totamt1=$('#RDPayableAmt').val();
					payamt1=parseFloat(totamt1);
					if(payamt1>20000)
					{
						alert("Amount Payable is Greater than 20,000. Please Transfer to SB Account");
					}
				}
			});
		});
		
		//BankName Changed
		$('.BankNameTypeAhead').change(function(e){
			
			Bnkid=$('.BankNameTypeAhead').data('value');
			
			e.preventDefault();
			$.ajax({
				url:'GetBankDetailsForPayAmt',
				type:'get',
				data:'&BankId='+Bnkid,
				success:function(data)
				{
					$('#RDPayBankBranch').val(data['Branch']);
					
					$('#RDPayIfsc').val(data['IFSC']);
					
					$('#RDPayAccountNumber').val(data['AccountNo']);
					
				}
			});
		});
	</script>
	
	<script>//CHANGES DONE TILL HERE, SUBMIT FUNCTION AND TABLE FOR RDPAYAMT HAS TO DONE
		//Pigmi Submit button
		pr=0;
		$('.RDPaySbmBtn').click( function(e) {
			if(pr==0)
			{
				pr++;
				pmode=$('#RDPayMode').val();
				if(pmode=="CASH")
				{
					//alert("CASH");
					$("#RDFormPayAmount").validate({
						
						rules:{
							RDAccnum:"required",
							RDPayableAmt:{
								required:true,
								number:true
							},
							
							//RDPayMode:"required",
							
							
						}
						
					});
				}
				
				else
				{
					$("#RDFormPayAmount").validate({
						
						rules:{
							RDAccnum:"required",
							RDPayableAmt:{
								required:true,
								number:true
							},
							
							RDPayMode:"required",
							//RDChequeNum:"required",
							//RDPayChequeDate:"required",
							//RDPayBankName:"required",
							
							
						}
						
					});
					
					
				}
				
				if($("#RDFormPayAmount").valid())
				{
					//PayMode=$('#PigPayMode').val();
					Bnkid=$('.BankNameTypeAhead').data('value');
					//PigmyAN=$('.PigmyAccNumTypeAhead').val();
					e.preventDefault();
					$.ajax({
						url: 'RDPayAmount',
						type: 'post',
						data: $('#RDFormPayAmount').serialize()+'&BankId='+Bnkid,
						success: function(data) {
							alert('success');
							// $('.tranclassid').click();
						}
					});
				}
			}
		});
	</script>
	
	
	<script>
		//PigmyPay Cheque Date
		//var PigPayChequeDate;
		
		$('input[name="RDPayChequeDate"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			autoUpdateInput: false,//to get blank initially
			
			locale: {
				cancelLabel: 'Clear',	//to get blank initially
				format: 'DD-MM-YYYY'
			},
			
			
		});
		
		//to get blank initially
		$('input[name="RDPayChequeDate"]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD-MM-YYYY'));
		});
		
		$('input[name="RDPayChequeDate"]').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
		
		
	</script>								