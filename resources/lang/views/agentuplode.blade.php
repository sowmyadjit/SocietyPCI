<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>

	<div id="content" class="col-md-10">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> Agent Data Upload</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				
				
				{!! Form::open(['url' => 'agentUploadsubmit','class' => 'form-horizontal','id' => 'form_cust','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}

						
						<div class="form-group">
										<label class="control-label col-sm-4">Agent Name:</label>
										<div class="col-md-4">
											<input class="typeahead1 form-control ptagnt"  id="ptagnt" name="ptagnt" placeholder="SELECT AGENT NAME" >  
										</div>
									</div>
						
						
							<div class="form-group">
										
										<div class="form-group">
											<label class="control-label col-sm-4">uplode file:</label>
											<div class="col-md-4">
												</br></br>
												<input type="file"  id="agentfile" name="agentfile" accept="text/*">
											</div>
										</div>
									</div>	
							<input type="text" class="form-control hidden" id="agentid" name="agentid">
					
				<center>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="submit" value="CREATE" class="btn btn-success btn-sm"/>
						
						<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
						<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
					</div>
				</div>
				</center>
    
	
				{!! Form::close() !!}
				</div>
				
			</div>
			</div>
		</div>
	</div>
	

<script>
	
	
	$('input.typeahead1').typeahead({
					ajax: '/getAllocateagentlist'
				});
				
	$('.typeahead1').change(function(e){
	accnum=$('.typeahead1').data('value');	
	$('#agentid').val(accnum);
	});
	
	$('.cnclbtn').click(function(e){
	$('#download_link').hide();
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.branchclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	
	
    
    
</script>