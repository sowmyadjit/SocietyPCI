

<div id="content" class="col-md-10">
            <!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>Deposit Report</h2>

						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
				</div>
					
				<div class="box-content">

				{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_addbank','method'=>'post']) !!}
			
				<div class="form-group">
					<label class="control-label col-sm-4">select witdraw type :</label>
					<div class="col-md-4">
						<select class="form-control "  id="typeid" name="typeid" >  
									<option value="1">matured Account witdraw Report</option>
									<option value="2">Prewitdraw Account Report</option></select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4">Status :</label>
					<div class="col-md-4">
						<select class="form-control "  id="typeid1" name="typeid1" >  
									<option value="1">UNPAID</option>
									<option value="2">PAID</option></select>
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
	
	
	

	$('.sbmbtn').click( function(e) {
		
		t1=$('#typeid').val();
		t2=$('#typeid1').val();
	//alert(brid);
		e.preventDefault();
				$.ajax({
				url: 'pigmyreport_paid_unpaid',
				type: 'post',
				data: '&witdrawtyp='+t1+'&paidsate='+t2,
				success: function(data) {
				//alert('success');
				
                }
		});
	});
	
	
	
</script>
