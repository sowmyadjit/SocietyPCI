<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<link href="css/daterangepicker.css" rel='stylesheet'>
<link href="css/datepicker.css" rel='stylesheet'>
<div id="content" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create New expense</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
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
								@foreach ($led as $ld)
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
						</select>
					</div>
				</div>
				
				
				<div id="inhandcash">
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
							<input class="typeahead form-control"  type="text" id="bn" placeholder="SELECT BANK">  
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
					<div class="form-group chequenum">
						<label class="control-label col-sm-4" for="comment"> Cheque Number:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="chqno" name="chqno" placeholder="CHEQUE NUMBER"/>
						</div>
					</div>
					
						
					<div class="form-group">
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
				
				
				
				
				<center>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
							<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
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
	
	
	
	
	
	
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.expenceclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	$('input.typeahead').typeahead({
		ajax: '/GetBank'
	});
	
	$('.sbmbtn').click( function(e) {
		e.preventDefault();
		x=$('#bn').data('value');
		
		branch=$('#socbranch').data('value');
		
		bankname=$('#bn').val();
		$.ajax({
			url: 'createexp1',
			type: 'post',
			data: $('#form_expence').serialize()+'&bankid='+x+'&bankName='+bankname+'&branchid='+branch,
			success: function(data) {
				//alert('success');
				$('.expenceclassid').click();
			}
		});
	});
	$('.pcicbranch').typeahead({  //Newly added typeahead for branch
		ajax: '/GetBranchForExpense'
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
		}
		else if(sel=="CHEQUE")
		{
			$('#bankcash').show();
			$('#inhandcash').hide();
		}
	}
</script>
<script>
		