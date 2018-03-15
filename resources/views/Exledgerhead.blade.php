<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"></script>


<div id="content<?php echo $data['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    
	
	<div class="row">
		<div class="box_bdy_<?php echo $data['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $data['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					
					<h2><i class="glyphicon glyphicon-user"></i>Add Ledger Head</h2>
					
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => 'addledger','class' => 'form-horizontal','id' => 'addledgerForm','method'=>'post']) !!}
					<div class="col-md-12">
						<div class="row">
							
							<div class="form-group">
								
								<div class="col-md-6">
									<center>
										<input type="button" class="btn btn-primary btn-md sbmbtn<?php echo $data['module']->Mid; ?>" value="Create Ledger Head">
									</center>
								</div>
								
								
								<div class="col-md-6">
									<center>
										<input type="button" class="btn btn-primary btn-md sbmbtn2<?php echo $data['module']->Mid; ?>" value="Create Sub Head">
									</center>
								</div>
								
							</div>
							
							
							
						</div>
						
					</div>
					
					
					<div class ="col-md-12">
						
						<div class="col-md-6" id="led">
							
							
							<center>
								
								<div class="form-group ">
									<label class="control-label col-md-5">Create Ledger Head</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="lhname" name="lhname" >
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-5 control-label">Date</label>
									<div class="col-md-6 date">
										<div class="input-group input-append date">
											<input type="text" class="form-control datepicker<?php echo $data['module']->Mid; ?>" name="date" id="date" placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</div>
								
								
								
							</center>
							
							<center>
								<input type="submit" value="CREATE" class="btn btn-success btn-sm crte<?php echo $data['module']->Mid; ?>"/>
								
								
							</center>
							
							
							
						</div>
						
						<div class ="col-md-6" id="sub1"></div>
						<div class="col-md-6" id="sub">
							
							<center>
								<div class="form-group ">
									<label class="control-label col-md-5">Ledger Head:</label>
									<div class="col-md-6">
										<select class="form-control" id="ledgerhead" name="ledgerhead">
											<option></option>
											@foreach ($data['ledger'] as $ld)
											<option value='{{ $ld->lid }}'>{{ $ld->lname }}</option>
											@endforeach
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-5">Sub Ledger Head:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="subhead" name="subhead" >
									</div>
								</div>
								
							</center>
							
							<center>
								
								
								<input type="submit" value="CREATE" class="btn btn-success btn-sm create<?php echo $data['module']->Mid; ?>"/>
								
								
							</center>
							
							
							
						</div>
						
						
						
						{!! Form::close() !!}
						
					</div>
					</br></br></br></br></br></br></br></br></br></br>
					
				</div>
				
			</div>
			
		</div>
	</div>
</div>

<script src="js/bootstrap-datepicker.js"/>	



<script>
	$('.datepicker<?php echo $data['module']->Mid; ?>').datepicker();	
	$('#led').hide();
	$('#sub').hide();
	$('#sub1').hide();
	$('#view').hide();
	$('#viewk').hide();
	
	
	$('.clickme').click(function(e)
	{
		$('.ledclassid').click();
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
	}); 
	
	$('.sbmbtn<?php echo $data['module']->Mid; ?>').click(function(e)
	{
		$('#led').show();
		$('#sub').hide();
		$('#sub1').hide();
		$('#view').hide();
		$('#viewk').hide();
		
	}); 
	
	$('.sbmbtn2<?php echo $data['module']->Mid; ?>').click(function(e)
	{
		$('#sub').show();
		$('#sub1').show();
		$('#led').hide();
		$('#view').hide();
		$('#viewk').hide();
	});
	/*$('.leddet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});*/
	
	
	
	
	$('.crte<?php echo $data['module']->Mid; ?>').click( function(e) {
		e.preventDefault();
		$.ajax({
			url: 'Exaddledger',
			type: 'post',
			data: $('#addledgerForm').serialize(),
			success: function(data) {
				//alert('success');
				$('.ledclassid').click();
			}
		});
	});
	
	
	
	$('.create<?php echo $data['module']->Mid; ?>').click( function(e) {
		e.preventDefault();
		$.ajax({
			url: 'Exaddsubled',
			type: 'post',
			data: $('#addledgerForm').serialize(),
			success: function(data) {
				//alert('success');
				$('.ledclassid').click();
			}
		});
	});
	
	
	/*$('.salcrt').click(function(e)
		{
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
	});*/
	
</script>																		