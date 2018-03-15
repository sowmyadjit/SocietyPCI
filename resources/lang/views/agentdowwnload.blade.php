<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>

	<div id="content" class="col-md-10">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> Agent Data Download</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				{!! Form::open(['url' => "createbranch1",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}

								<div class="form-group">
										<label class="control-label col-sm-4">Agent Name:</label>
										<div class="col-md-4">
											<input class="typeahead1 form-control ptagnt"  id="ptagnt" name="ptagnt" placeholder="SELECT AGENT NAME" >  
										</div>
									</div>
					
				<center>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
						<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
						<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
					</div>
				</div>
				</center>
    
	
				{!! Form::close() !!}
				</div>
				<center>
				<a href='' id='download_link' >Click Here To Download </a>
				<p id='download_load' >Loading....</p>
				</center>
			</div>
			</div>
		</div>
	</div>
	

<script>
	$('#download_link').hide();
	$('#download_load').hide();
	$('input.typeahead1').typeahead({
		ajax: '/getAllocateagentlist'
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
	
	$('.sbmbtn').click( function(e) {
	$('#download_link').hide();
	$('#download_load').show();
	
		aid=$('#ptagnt').data('value');
		aname=$('#ptagnt').val();
	$.ajax({
			url: 'agentdownloadsubmit',
			type: 'post',
			data:'&agentid='+aid,
			success: function(data) {
				$('#download_link').attr({target: '_blank', href:data});
				$('#download_link').text('Click Here To Download '+aname+' File' );
				
				$('#download_link').show();
				$('#download_load').hide();
				//$('.branchclassid').click();
			}
			
		});
		
	});

</script>