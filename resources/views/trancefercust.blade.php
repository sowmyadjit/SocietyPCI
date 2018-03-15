<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> TRASFER CUSTOMER TO MEMBER</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => 'JewelLoanAllocation','class' => 'form-horizontal','id' => 'FormJewelLoanAlloc','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
					
					
					
					
					
					
						
						<div class="form-group">
							<label class="control-label col-sm-4">select customer:</label>
							<div  class="col-sm-4">
								<input style="border-color:red" class="typeahead form-control"   id="usr" placeholder="select customer" required>  
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Share Class:</label>
							<div class="col-sm-4">
								<select class="form-control shclass"  id="shclass" name="shclass" placeholder="SELECT SHARE CLASS" required>  
									<option value=""></option>
									<?php foreach($shares as $key){
										
										echo "<option value='".$key->Share_Class."' >" .$key->Share_Class."";
										echo "</option>";
									}?>
								</select>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4"> Face Value:</label>
							<div class="col-md-4">
								<input style="border-color:red" type="text" class="form-control" id="shamt" name="shamt" placeholder="SAHARE AMOUNT">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Share Fees:</label>
							<div class="col-md-4">
								<input style="border-color:red" type="text" class="form-control" id="shprice" name="shprice" placeholder="SHARE PRICE">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Total Shares:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="totshare" name="totshare" placeholder="TOTAL SHARES" onblur="calculate();maxvl();" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Total Share Value:</label>
							<div class="col-md-4">
								<input style="border-color:red" type="text" class="form-control" id="totshrval" name="totshrval" placeholder="TOTAL SHARE VALUE" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Total Amount Payable:</label>
							<div class="col-md-4">
								<input style="border-color:red" type="text" class="form-control" id="totamt" name="totamt" placeholder="TOTAL AMOUNT PAYABLE" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Member Share ID:</label>
							<div class="col-sm-4">
								<input style="border-color:red" type="text" class="form-control" id="memshr" name="memshr" placeholder="MEMBER SHARE ID" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Member Fee:</label>
							<div class="col-sm-4">
								<input style="border-color:red" type="text" class="form-control" id="memfee" name="memfee" placeholder="MEMBER FEES"/>
							</div>
						</div>
						
						<div class="form-group hidden">
							<div class="col-sm-4">
								<input type="text" class="form-control" id="count" name="count"/>
							</div>
						</div>
						<div class="col-sm-8 hidden">
							<input type="text" class="form-control" id="branchid" name="branchid"/>
						</div>
						<div class="col-sm-8 hidden">
							<input type="text" class="form-control" id="usrid" name="usrid"/>
						</div>
						
						
						
						
					
					
					<center>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="CREATE" class="btn btn-success btn-sm SbmBtn"/>
						<input type="button" value="CANCEL" class="btn btn-danger btn-sm CnclBtn"/>
						<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
						
					</div>
				</div>
			</center>
					
				</div>				
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			{!! Form::close() !!}
			
		</div>
	</div>
</div>
</div>
</div>

<script>
	
	function LoadUid()
	{
		$.ajax({
			url: 'Getmemuid',
			type: 'get',
			success: function(result) {
				m=result;
				uid=(parseInt(m)+1);
				$('#usrid').val(uid);
				//alert(id);
			}
		});
	}
	
	//Calculate Share Amount
	function calculate()
	{
		shamt=$('#shamt').val();
		shpr=$('#shprice').val();
		nosh=$('#totshare').val();
		tot=shamt*nosh;
		tot1=shpr*nosh;
		total=tot+tot1;
		$('#totshrval').val(tot);
		$('#totamt').val(total);
	}
	
	//Share Class Dropdown Change Event
	$('#shclass').change(function(e){
		e.preventDefault();
		$.ajax({
			url:'retrieveinfo',
			type:'post',
			data:$('#shclass'),
			success:function(data){
				$('#shamt').val(data['face']);
				$('#shprice').val(data['sharep']);
			}
		});
	});
	
	//CertificateID Calculation
	function maxvl()
	{
		totshr=$('#totshare').val();
		$.ajax({
			url:'retrievemax',
			type:'get',
			success:function(data){
				countval=data;
				max=(parseInt(totshr)+parseInt(countval));
				min=(parseInt(countval)+1);
				sid=min+"-"+max;
				$("#memshr").val(sid);
				$("#count").val(max);
			}
		});
	}
	
	//Hide PurchaseShare Detail
	$('.purdetail').hide();
	
	//PurchaseShare Button
	$('.nxtbtn').click(function(){
		$('.purdetail').show();
	});
	
	//Cancel Button
	$('.CnclBtn').click(function(e)
	{
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.reqclassid').click();
			return true;
		}
		else{
			return false;
		}
	});
	
	//To get the BranchID
	$('#branch').change(function(){
		a=$('ul.typeahead li.active').data('value');
		
		$.ajax({
			success:function(){
				$('#branchid').val(a);
			}
		});
	});
	
	//Typeahead for Branch
	$('input.typeahead').typeahead({
		ajax: '/Getjewelcust'
	});
	
	//Address checkbox click
	$('#chk').click(function(e){
		if($('#chk').is(":checked"))
		{
			add=$('#madd').val();
			city=$('#mcity').val();
			dist=$('#mdist').val();
			pin=$('#mpin').val();
			state=$('#mstate').val();
			$('#nadd').val(add);
			$('#ncity').val(city);
			$('#ndist').val(dist);
			$('#nstate').val(state);
			$('#npin').val(pin);
		}
		else{
			$('#nadd').val('');
			$('#ncity').val('');
			$('#ndist').val('');
			$('#nstate').val('');
			$('#npin').val('');
		}
	});
	
	$('.SbmBtn').click( function(e) 
	{
		user=$('#usr').data('value');
		alert(user);
		e.preventDefault();
		$.ajax({
			url: 'tranmember',
			type: 'post',
			data: $('#FormJewelLoanAlloc').serialize()+'&userid='+user,
			success: function(data) {
				alert('Success');
				$('.reqclassid').click();
				
			}
		});
		
	});
	
</script>

<style>
	input[type=file]{ 
	color:transparent;
    }
</style>



