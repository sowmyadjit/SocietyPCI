<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.min.js"></script>
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $MAccHome['module']->Mid; ?>" class="col-lg-12 col-sm-12">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box_bdy_<?php echo $MAccHome['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $MAccHome['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Minor Account Home</h2>
					
					
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="ShowGetMinDetails" class="btn btn-default GetMinDet<?php echo $MAccHome['module']->Mid; ?>">Get Minor's Details</a>
						<a href="ViewCreateMinorAcc" class="btn btn-default CreatMinAcc<?php echo $MAccHome['module']->Mid; ?>">Create Minor Account</a>
						
						
						
						
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
				</div>	
				
				
			</div>
		</div>	
	</div>	
</div>	
</div>	



<script>
	
	$('.GetMinDet<?php echo $MAccHome['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#content<?php echo $MAccHome['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	
	$('.CreatMinAcc<?php echo $MAccHome['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#content<?php echo $MAccHome['module']->Mid; ?>').load($(this).attr('href'));
	});
	</script>	