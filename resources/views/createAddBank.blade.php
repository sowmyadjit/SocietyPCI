

<div id="content<?php echo $bank['module']->Mid; ?>" class="col-md-12">
            <!-- content starts -->
    <div class="row">
		<div class="box_bdy_<?php echo $bank['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $bank['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>Create New Bank</h2>

						
				</div>
					
				<div class="box-content">

				{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_addbank','method'=>'post']) !!}

				<div class="form-group">
					<label class="control-label col-sm-4">Bank Name :</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bn" name="bn" placeholder="Bank name">
					</div>
				</div>
	
	           
				
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">Bank Branch:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="branch" name="branch" placeholder="Bank Branch"/>
					</div>
				</div>
				
				
				<div class="form-group ifsccde">
					<label class="control-label col-sm-4" for="first_name">IFSC:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="ifsc" name="ifsc" placeholder="IFSC">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">Account Number:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="acc" name="acc" placeholder="Account Number"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4">PCIC Society Branch:</label>
					<div class="col-md-4">
						<input  class="branchta form-control" id="socbranch" type="text" name="socbranch" placeholder="SELECT BRANCH">  
					</div>
				</div>
				
			<div class="form-group">
					<label class="control-label col-sm-4" for="comment">Total amount:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="ta" name="ta" placeholder="Total Amount"/>
					</div>
				</div>

				<center>
    					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CREATE" class="btn btn-success btn-sm AddBankSbmBtn<?php echo $bank['module']->Mid; ?>"/>
							<input type="button" value="CANCEL" class="btn btn-danger btn-sm AddBankCnclBtn<?php echo $bank['module']->Mid; ?>"/>
							<input type="reset" value="RESET" class="btn btn-info btn-sm resetbtn<?php echo $bank['module']->Mid; ?>"/>
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
		
	$('.AddBankCnclBtn<?php echo $bank['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.bankclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.resetbtn<?php echo $bank['module']->Mid; ?>').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	
	/*$('#aplformem').change(function(e){
		alert("hello");
		if($('#aplformem').is(":checked"))
		{
			mem='1';
			alert(mem);
		}
		else{
			mem='0';
		}
		//alert(mem);
	});*/
	addbankindex=0;

	$('.AddBankSbmBtn<?php echo $bank['module']->Mid; ?>').click( function(e) {
		if(addbankindex==0){
			addbankindex++;
		a=$('#socbranch').val();
		brid=$('#socbranch').data('value');
		
	//alert(brid);
		e.preventDefault();
				$.ajax({
				url: 'crateaddbank',
				type: 'post',
				data: $('#form_addbank').serialize()+'&branchlist='+a+'&branchid='+brid,
				success: function(data) {
				alert('success');
				$('.bankclassid').click();
                }
		});
		}
	});
	
	/*$('#socbranch').typeahead({
      ajax: '/GetBranchForAddBank'
	});*/
	//LOCAL TYPEAHEAD DATA STARTS
	$('input.branchta').typeahead({
		source: GetBranchForAddBank
	});
	//LOCAL TYPEAHEAD DATA ENDS
	
	
</script>
