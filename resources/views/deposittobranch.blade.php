<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>
<div id="content" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create New Deposit</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaddeposit",'class' => 'form-horizontal','id' => 'form_deposit','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Bank Name:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="typeahead form-control"  type="text" id="bn" placeholder="SELECT Bank"  >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Current Balance</label>
						<div class="col-sm-4">
							<input class="form-control"  type="text" id="totalamt" name="totalamt" placeholder="CURRENT AMOUNT">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment"> Bank Branch:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="branch" name="branch" placeholder="BANK BRANCH"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment"> IFSC Code:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ifsc" name="ifsc" placeholder="IFSC CODE"/>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Withdrawl Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ta" name="ta" placeholder="Total amount"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="paymode" name="paymode">
								<option>--Select  Mode--</option>
								<option>INHAND</option>
								
							</select>
						</div>
					</div>
					
					<div class="form-group chequenum">
						<label class="control-label col-sm-4" for="comment"> Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="chqno" name="chqno" placeholder="CHEQUE NUMBER"/>
						</div>
					</div>
					
					<div class="form-group chequedte">
						<label class="col-sm-4 control-label">Cheque Date</label>
						<div class="col-md-4 date">
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
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">PCICS Branch:</label>
						<div class="col-sm-4">
							<select class="form-control branch"  id="branch" name="branch" placeholder="SELECT BRANCH">  
								<option value="">--Select Branch--</option>
								<?php foreach($branch as $key){
									echo "<option value='".$key->Branch."' >" .$key->Branch."";
									echo "</option>";
								}?>
							</select>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment"> Perticulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="perti" name="perti" placeholder="PERTICULARS"/>
						</div>
					</div>
					
					<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="RESET" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
					<!--</form>-->
					{!! Form::open() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<script>
	//Hide and show (Newly Added)
	$('.chequenum').hide();
	$('.chequedte').hide();
	
	//Payment Mode Change (Newly Added)
	/*$('#paymode').change(function(e){
		pmode=$('#paymode').val();
		if(pmode=="CASH")
		{
		$('.chequenum').hide();
		$('.chequedte').hide();
		}
		else if(pmode=="CHEQUE")
		{
		$('.chequenum').show();
		$('.chequedte').show();
		}
		else
		{
		alert("Please Select the Payment Mode");
		}
		
	});*/
	
	//Bank Name Change (Newly Added)
	$('#bn').change(function(e){
		bnkid=$('#bn').data('value');
		$.ajax({
			url: 'depgetbankdetail',
			type: 'post',
			data:'&bankid='+bnkid,
			success: function(data) {
				$('#branch').val(data['bnkbranch']);
				$('#ifsc').val(data['ifsc']);
				$('#totalamt').val(data['totamt']);
				//alert('success');
				//$('.expenceclassid').click();
			}
		});
	});
	
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.depositclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	
	$('input.typeahead').typeahead({
		ajax: '/GetBank'
	});
	indexid=0;
	$('.sbmbtn').click( function(e) {
		if(indexid==0)
		{
			indexid++;
			
			
			e.preventDefault();
			x=$('#bn').data('value');
			alert(x);
			bankname=$('#bn').val();
			$.ajax({
				url: 'crateaddeposittobranch',
				type: 'post',
				data: $('#form_deposit').serialize()+'&bank='+x+'&bankName='+bankname,
				success: function(data) {
					alert('success');
					$('.depositclassid').click();
				}
			});
		}
	});
	
</script>
<script>
	//Deposite Cheque Date (Newly Added)
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
				