        	 <script src="js/bootstrap-typeahead.js"></script>
			 <script src="js/jquery.min.js"></script>
		<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>
			</div>
        </noscript>

<div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            
			
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
		
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Minor Account Home</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
	
				<div class="box-content">
					<div class="alert alert-info">
					   <a href="ShowGetMinDetails" class="btn btn-default GetMinDet">Get Minor's Details</a>
					   <a href="ViewCreateMinorAcc" class="btn btn-default CreatMinAcc">Create Minor Account</a>
					  
					 
					  
					  
					</div>
					
					
					
					
					
					
					
					
					
					
					 
					
					
				</div>	
			
			
				</div>
			</div>	
		</div>	
	</div>	
</div>	



<script>
	 
	  
	  
	  $('.GetMinDet').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('#content').load($(this).attr('href'));
		});


	$('.CreatMinAcc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#content').load($(this).attr('href'));
	});



	


</script>