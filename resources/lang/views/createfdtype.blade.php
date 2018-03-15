<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<div id="content" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create FD Type</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "createfdtyp",'class' => 'form-horizontal','id' => 'form_fdtyp','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="fdtype">FD Type :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="fdtype" name="fdtype" placeholder="FD Type">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Number Of Years :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="fdyear" name="fdyear" placeholder="Number Of Years" onkeyup="cal();">
						</div>
					</div>
					<div> or</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Number Of Days :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="fddays" name="fddays" placeholder="Number Of Days">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">INTEREST:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="interest" name="interest" placeholder="INTEREST"/>
						</div>
					</div>
					
					<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm cnclbtn"/>
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
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.fdtypclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	intedid=0;
	$('.sbmbtn').click( function(e) {
		e.preventDefault();
		if(intedid==0)
		{
			intedid++;
			$.ajax({
				url: 'createfdtyp',
				type: 'post',
				data: $('#form_fdtyp').serialize(),
				success: function(data) {
					//alert('success');
					$('.fdtypclassid').click();
				}
			});
		}
	});
	function cal()
	{
		x=$('#fdyear').val();
		y=x*365;
		$('#fddays').val(y);
		
	}
	
</script>
