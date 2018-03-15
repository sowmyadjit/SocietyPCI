

<div id="content" class="col-md-10">
	<!-- content starts -->
    <div class="row">
		<div class="boxbox col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Loan Payment</h2>
					
					
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_addbank','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Select Loan Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="loantype" name="loantype">
								<option value="">--Select Loan Type--</option>
								<option value="DL">DL</option>
								<option value="PERSONAL LOAN">PERSONAL LOAN</option>
								<option value="JEWEL LOAN">JEWEL LOAN</option>
								<option value="STAFF LOAN">STAFF LOAN</option>
							</select>
						</div>
					</div>
					
					
					
					
					<div class="form-group dLAccNum">
						<label class="control-label col-sm-4" for="first_name"> Account Number :</label>
						<div id="the-basics" class="col-sm-4">
							<input class="dLAccNumTypeAhead form-control"  type="text" placeholder="SELECT dL ACCOUNT NUMBER" id="dLAccNum">  
						</div>
					</div>
					
					<div class="form-group PLAccNum">
						<label class="control-label col-sm-4" for="first_name"> Account Number :</label>
						<div id="the-basics" class="col-sm-4">
							<input class="PLAccNumTypeAhead form-control"  type="text" placeholder="SELECT PL ACCOUNT NUMBER" id="PLAccNum">  
						</div>
					</div>
					
					
					<div class="form-group JLAccNum">
						<label class="control-label col-sm-4" for="first_name">JL Account Number :</label>
						<div id="the-basics" class="col-sm-4">
							<input class="JLAccNumTypeAhead form-control"  type="text" placeholder="SELECT PL ACCOUNT NUMBER" id="JLAccNum">  
						</div>
					</div>
					
					
					<div class="form-group SLAccNum">
						<label class="control-label col-sm-4" for="first_name">SL Account Number :</label>
						<div id="the-basics" class="col-sm-4">
							<input class="SLAccNumTypeAhead form-control"  type="text" placeholder="SELECT SL ACCOUNT NUMBER" id="SLAccNum">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Customer Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="plcustname" name="plcustname" placeholder="CUSTOMER NAME"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Loan Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="plremamt" name="plremamt" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Loan Amount Paid :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="plamtpaid" name="plamtpaid" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Loan Amount Pending :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="plamtpending" name="plamtpending" />
						</div>
					</div>
					
					
					
					
					
					
					<div class="form-group ">
						<label class="control-label col-sm-4" for="first_name">Enter  Amount :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ea" name="ea" placeholder="Enter  Amount">
						</div>
					</div>
					
					
					
					
					
					
					
					<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm AddBankSbmBtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm AddBankCnclBtn"/>
								<input type="reset" value="RESET" class="btn btn-info btn-sm resetbtn"/>
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
<script src="js/jquery.min.js"></script>
<script src="js/sidebar/sidebar.js"></script>
<script src="js/bootstrap-typeahead.js"></script>

<script>
	
	$('.dLAccNum').hide();
	$('.PLAccNum').hide();
	$('.JLAccNum').hide();
	$('.SLAccNum').hide();
	
	$('.AddBankCnclBtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.bankclassid').click();
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
	
	
	
	
	
	
	$('.PLAccNumTypeAhead').typeahead({   
		ajax:'/getplacc_partpayment'
	});
	
	$('.JLAccNumTypeAhead').typeahead({   
		ajax:'/getjlacc_partpayment'
	});
	$('.SLAccNumTypeAhead').typeahead({   
		ajax:'/getslacc_partpayment'
	});
	$('.dLAccNumTypeAhead').typeahead({   
		ajax:'/getdlacc_partpayment'
	});
	
	
	
	$('#ea').change(function(e){
		d=$('#plamtpending').val();
		e=$('#ea').val();
		if(e>d)
		{
			alert("Amount is grater than pending Amount");
			$('#ea').val(" ");
		}
		
		
	});
	
	$('#loantype').change(function(e){
		loantype=$('#loantype').val();
		
		
		if(loantype=="PERSONAL LOAN")
		{
			$('.dLAccNum').hide();
			$('.PLAccNum').show();
			$('.JLAccNum').hide();
			$('.SLAccNum').hide();
		}
		else if(loantype=="JEWEL LOAN")
		{
			$('.dLAccNum').hide();
			$('.PLAccNum').hide();
			$('.JLAccNum').show();
			$('.SLAccNum').hide();
		}
		else if(loantype=="DL")
		{
			$('.dLAccNum').show();
			$('.PLAccNum').hide();
			$('.JLAccNum').hide();
			$('.SLAccNum').hide();
		}
		else if(loantype=="STAFF LOAN")
		{
			$('.dLAccNum').hide();
			$('.PLAccNum').hide();
			$('.JLAccNum').hide();
			$('.SLAccNum').show();
		}
		
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
				
				$('#plremamt').val(data['LoanAmt']);
				$('#plamtpaid').val(data['partpayment_amount']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#plcustname').val(fullname);
				$a=$('#plremamt').val();
				$b=$('#plamtpaid').val();
				$c=$a-$b;
				$('#plamtpending').val($c);
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
				
				$('#plremamt').val(data['LoanAmt']);
				$('#plamtpaid').val(data['partpayment_amount']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#plcustname').val(fullname);
				$a=$('#plremamt').val();
				$b=$('#plamtpaid').val();
				$c=$a-$b;
				$('#plamtpending').val($c);
				
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
				
				$('#plremamt').val(data['LoanAmt']);
				$('#plamtpaid').val(data['partpayment_amount']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#plcustname').val(fullname);
				$a=$('#plremamt').val();
				$b=$('#plamtpaid').val();
				$c=$a-$b;
				$('#plamtpending').val($c);
			}
		});
	});
	
	$('.dLAccNumTypeAhead').change(function(e)
	{
		dlaccid=$('.dLAccNumTypeAhead').data('value');
		
		$.ajax({
			url:'/GetDLDetail',
			type:'post',
			data:'&DLAlcID='+dlaccid,
			success:function(data)
			{
				
				$('#plremamt').val(data['DepLoan_LoanAmount']);
				$('#plamtpaid').val(data['partpayment_amount']);
				fullname=data['FN']+" . "+data['MN']+" . "+data['LN'];
				$('#plcustname').val(fullname);
				$a=$('#plremamt').val();
				$b=$('#plamtpaid').val();
				$c=$a-$b;
				$('#plamtpending').val($c);
			}
		});
	});
	
	
	addbankindex=0;
	
	$('.AddBankSbmBtn').click( function(e) {
		if(addbankindex==0){
			//addbankindex++;
			loantype=$('#loantype').val();
			
			if(loantype=="PERSONAL LOAN")
			{
				type_loan="PL";
				alloc=$('.PLAccNumTypeAhead').data('value');
			}
			else if(loantype=="JEWEL LOAN")
			{
				type_loan="JL";
				alloc=$('.JLAccNumTypeAhead').data('value');
			}
			else if(loantype=="DL")
			{
				type_loan="DL";
				alloc=$('.dLAccNumTypeAhead').data('value');
				
			}
			else if(loantype=="STAFF LOAN")
			{
				type_loan="SL";
				alloc=$('.SLAccNumTypeAhead').data('value');
				
			}
			
			
			
			e.preventDefault();
			$.ajax({
				url: 'partpaypartamt',
				type: 'post',
				data: $('#form_addbank').serialize()+'&type='+type_loan+'&alloc='+alloc,
				success: function(data) {
					alert('success');
					$('.bankclassid').click();
				}
			});
		}
	});
</script>
