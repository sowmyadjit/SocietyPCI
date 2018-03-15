

<div id="content" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create New Bank</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
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
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
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
	
	$('.cnclbtn').click(function(e){
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
	indexid=0;
	$('.sbmbtn').click( function(e) {
		if(indexid==0)
		{
			indexid++;
			a=$('#socbranch').val();
			brid=$('#socbranch').data('value');
			//alert(brid);
			e.preventDefault();
			$.ajax({
				url: 'crateaddbank',
				type: 'post',
				data: $('#form_addbank').serialize()+'&branchlist='+a+'&branchid='+brid,
				success: function(data) {
					//alert('success');
					$('.bankclassid').click();
				}
			});
		}
	});
	
	$('#socbranch').typeahead({
		ajax: '/GetBranchForAddBank'
	});
	
</script>
