<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>

	<div id="content<?php echo $b['module']->Mid; ?>" class="col-md-10">
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
					
				<div class="bdy_<?php echo $b['module']->Mid; ?>box-content">
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
						<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $b['module']->Mid; ?>"/>
						<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $b['module']->Mid; ?>"/>
						<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
					</div>
				</div>
				</center>
    
	
				{!! Form::close() !!}
				</div>
				<center>
				<a href='' id='download_link<?php echo $b['module']->Mid; ?>' >Click Here To Download </a>
				<p id='download_load<?php echo $b['module']->Mid; ?>' >Loading....</p>
				</center>
			</div>
			</div>
		</div>
	</div>
	

<script>
	$('#download_link<?php echo $b['module']->Mid; ?>').hide();
	$('#download_load<?php echo $b['module']->Mid; ?>').hide();
	$('input.typeahead1').typeahead({
		//ajax: '/getAllocateagentlist'
		source: getAllocateagentlist
		});
	
	
	
	
	$('.cnclbtn<?php echo $b['module']->Mid; ?>').click(function(e){
	$('#download_link<?php echo $b['module']->Mid; ?>').hide();
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.branchclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	agentdwnldindex=0;
	$('.sbmbtn<?php echo $b['module']->Mid; ?>').click( function(e) {
		if(agentdwnldindex==0){
			agentdwnldindex++;
	$('#download_link<?php echo $b['module']->Mid; ?>').hide();
	$('#download_load<?php echo $b['module']->Mid; ?>').show();
	
		aid=$('#ptagnt').data('value');
		aname=$('#ptagnt').val();
	$.ajax({
			url: 'agentdownloadsubmit',
			type: 'post',
			data:'&agentid='+aid,
			success: function(data) {
				$('#download_link<?php echo $b['module']->Mid; ?>').attr({target: '_blank', href:data});
				$('#download_link<?php echo $b['module']->Mid; ?>').text('Click Here To Download '+aname+' File' );
				
				$('#download_link<?php echo $b['module']->Mid; ?>').show();
				$('#download_load<?php echo $b['module']->Mid; ?>').hide();
				//$('.branchclassid').click();
			}
			
		});
		}
		
	});

</script>