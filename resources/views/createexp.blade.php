<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<link href="css/daterangepicker.css" rel='stylesheet'>
<link href="css/datepicker.css" rel='stylesheet'>
<div id="content<?php echo $led['module']->Mid; ?>" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box_bdy_<?php echo $led['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $led['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create New expense</h2>
					
					
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "createexp",'class' => 'form-horizontal','id' => 'form_expence','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">PCIC Society Branch:</label>
						<div class="col-md-4">
							<input  class="pcicbranch form-control" id="socbranch" type="text" name="socbranch" placeholder="SELECT BRANCH">  
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Expense Head:</label>
						<div class="col-md-4">
							<select class="form-control" id="exphead" name="exphead">
		                        <option></option>
								@foreach ($led['expense'] as $ld)
								<option value="{{ $ld->lid }}">{{ $ld->lname }}</option>
								@endforeach
							</select>
							
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4">Expense Sub Head:</label>
					<div class="col-md-4">
						<select class="form-control" id="expsubhead" name="expsubhead">
							
							<option></option>
							
						</select>
					</div>
				</div>
				
				
				
				<div class="form-group">
					<label class="control-label col-sm-4">Payment Done Through:</label>
					<div class="col-md-4">
						<select class="form-control" id="paydone" name="paydone"   onChange="Getinhand();" >
							<option>--Select Payment Mode--</option>
							<option value="INHAND">INHAND</option>
							<option value="CHEQUE">CHEQUE</option>
							<option value="SB">SB</option>
							<option value="ADJUSTMENT">ADJUSTMENT</option>
						</select>
					</div>
				</div>
				
				
				<div class="all">
					<div class="form-group">
						<label class="control-label col-sm-4">Amount</label>
						<div class="col-sm-4">
							<input class="form-control"  type="text" id="ta1" name="ta1" placeholder="AMOUNT">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Particulars</label>
						<div class="col-sm-4">
							<input class="form-control"  type="text" id="parti1" name="parti1" placeholder="PARTICULARS">  
						</div>
					</div>
			
				</div>
				
				
				<div id="bankcash">
					
					<div class="form-group">
						<label class="control-label col-sm-4">Bank Name:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="bank-typeahead form-control"  type="text" id="bn" placeholder="SELECT BANK">  
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
						<label class="control-label col-sm-4" for="comment"> Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ta" name="ta" placeholder="AMOUNT" onblur="calculate();"/>
						</div>
					</div>
					<div class="form-group chequenum ADJUSTMENT">
						<label class="control-label col-sm-4" for="comment"> Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="chqno" name="chqno" placeholder="CHEQUE NUMBER"/>
						</div>
					</div>
					
					
					<div class="form-group ADJUSTMENT">
						<label class="col-sm-4 control-label">Cheque Date</label>
						<div class="col-md-4 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="chdate" id="chdate" placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment"> Particulars</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="parti" name="parti" placeholder="PARTICULARS"/>
						</div>
					</div>
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="unclearedval" name="unclearedval" value="CLEARED">
					</div>
					
					
					
					
					
					
					
					
				</div>
				
				<div class="SB">
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
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Account Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ab" name="ab"  disabled>
						</div>
					</div>
				</div>
				
				
				<center>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CREATE" class="btn btn-success btn-sm CrtExpSbmBtn<?php echo $led['module']->Mid; ?>"/>
							<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $led['module']->Mid; ?>"/>
							<input type="reset" value="RESET" class="btn btn-info btn-sm"/>
						</div>
					</div>
				</center>
				
			</form>
			
		</div>
	</div>
</div>
</div>
</div>
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<script src="js/bootstrap-datepicker.js"/>	




<script>
	$('.datepicker').datepicker();
	$('#inhandcash').hide();
	$('#bankcash').hide();
	$('.SB').hide();
	$('input.typeahead').typeahead({
		//ajax: '/Getaccnum'
		source:Getaccnum
	});
	$('#exphead').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		Lid=$('#exphead').val();
		// alert(Lid);
		e.preventDefault();
		
		$.ajax({
			url:'GetSubLedgerHead',
			type:'get',
			data:'&LedgerId='+Lid,
			success:function(data)
			{
				// alert("success");
				var sel = document.getElementById('expsubhead');
				for (i = sel.length - 1; i >= 0; i--) {
					sel.remove(i);
				}
				
				var jsonData = JSON.parse(data);
				for (var i = 0; i < jsonData.length; i++) {
					var prop = jsonData[i];
					$("#expsubhead").append("<option value=\"" + prop.lid +"\">"+ prop.lname +"</option>");
				}
				
			}
		});
	});
	
	
	
	
	
	
	$('.cnclbtn<?php echo $led['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.expenceclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	$('input.bank-typeahead').typeahead({
		//	ajax: '/GetBank'
		source:GetBank
	});
	indexid=0;
	$('.CrtExpSbmBtn<?php echo $led['module']->Mid; ?>').click( function(e) {
		if(indexid==0)
		{
			
			indexid++;
			
			e.preventDefault();
			x=$('#bn').data('value');
			
			branch=$('#socbranch').data('value');
			accnum=$('#account').data('value');
			
			bankname=$('#bn').val();
			$.ajax({
				url: 'createexp1',
				type: 'post',
				data: $('#form_expence').serialize()+'&bankid='+x+'&bankName='+bankname+'&branchid='+branch+'&accnum='+accnum,
				success: function(data) {
					alert('success');
					//$('.expenceclassid').click();
				}
			});
		}
	});
	$('.pcicbranch').typeahead({  //Newly added typeahead for branch
		ajax: '/GetBranchForExpense'
		//source:GetBranchForExpense
		
	});
	
	$('#bn').change(function(e){
		bnkid=$('#bn').data('value');
		$.ajax({
			url: 'getbnkdetail',
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
	
	
</script>

<script type="text/javascript">
	function Getinhand()
	{
		sel=$('#paydone').val();
		if(sel=="INHAND")	
		{
			$('#inhandcash').show();
			$('#bankcash').hide();
			$('.SB').hide();
		}
		else if(sel=="CHEQUE")
		{
			$('#bankcash').show();
			$('#inhandcash').hide();
			$('.ADJUSTMENT').show();
			$('.all').hide();
			$('.SB').hide();
		}else if(sel=="SB")
		{
			$('#bankcash').hide();
			$('#inhandcash').hide();
			$('.SB').show();
		}
		else if(sel=="ADJUSTMENT")
		{
			$('#bankcash').show();
			$('#inhandcash').hide();
			$('.ADJUSTMENT').hide();
			$('.all').hide();
			$('.SB').hide();
		}
	}
	
	$('#account').change(function(e){
		accnum=$('#account').data('value');
		e.preventDefault();
		$.ajax({
			url:'retriveacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){
				$('#ab').val(data['crbal']);
				$('#name').val(data['fname']);
				
			}
		});
	});
</script>

		