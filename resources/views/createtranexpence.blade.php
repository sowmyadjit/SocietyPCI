<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $ex['module']->Mid; ?>" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box_bdy_<?php echo $ex['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $ex['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create New expense</h2>
					
					
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaexpence",'class' => 'form-horizontal','id' => 'form_expence','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Bank Name:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="typeahead form-control"  type="text" id="bn1" placeholder="SELECT Bank"  >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Bank Name:</label>
						<div id="the-basics" class="col-sm-4">
							<input class="typeahead1 form-control"  type="text" id="bn2" placeholder="SELECT Bank"  >  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment"> Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="ta" name="ta" placeholder="Total amount"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment"> Particulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="particulars" name="particulars" placeholder="Particulars"/>
						</div>
					</div>
					
					<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm CrtTrExpBtn<?php echo $ex['module']->Mid; ?>"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $ex['module']->Mid; ?>"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
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

<script>
	$('.cnclbtn<?php echo $ex['module']->Mid; ?>').click(function(e){
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
		//ajax: '/GetBank'
		source:GetBank
	});
	
	$('input.typeahead1').typeahead({
		//ajax: '/GetBank'
		// source:GetBank
		ajax:"GetBank_all_branch"
	});
	indexid=0;
	$('.CrtTrExpBtn<?php echo $ex['module']->Mid; ?>').click( function(e) {
		if(indexid==0)
		{
	indexid++;
			e.preventDefault();
			
			x=$('.typeahead').data('value');
			x1=$('#bn2').data('value');
			// alert(x);
			// alert(x1);
			bankname=$('.typeahead').val();
			bankname2=$('#bn2').val();
			// alert(bankname);
			// alert(bankname2);
			$.ajax({
				url: 'crateatranexpence',
				type: 'post',
				data: $('#form_expence').serialize()+'&bank='+x+'&bankName='+bankname+'&bank2='+x1+'&bankName2='+bankname2,
				success: function(data) {
					alert('success');
					$('.expenceclassid').click();
				}
			});
		}
	});
	
	</script>
