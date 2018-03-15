<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $ua['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
    
	
	<div class="row">
		<div class="box_bdy_<?php echo $ua['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $ua['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Authorising Details </h2>
					
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="authcust" class="btn btn-default UnAuthCust<?php echo $ua['module']->Mid; ?>">UnAuthorised Customer</a>
						<a href="authemp" class="btn btn-default UnAuthEmp<?php echo $ua['module']->Mid; ?>">UnAuthorised Employee</a>
						<a href="authmemb" class="btn btn-default UnAuthShare<?php echo $ua['module']->Mid; ?>">UnAuthorised shares</a>
						<a href="authaccount" class="btn btn-default UnAuthAcc<?php echo $ua['module']->Mid; ?>">UnAuthorised Accounts</a>
						<a href="authpigmy" class="btn btn-default UnAuthPigm<?php echo $ua['module']->Mid; ?>">UnAuthorised Pigmy Accounts</a>
						
						
					</div>
					
					<div class="alert alert-info">
						
						<a href="authloan" class="btn btn-default UnAuthLoan<?php echo $ua['module']->Mid; ?>">UnAuthorised Loan</a>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.UnAuthCust<?php echo $ua['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		$('.UnAuthEmp<?php echo $ua['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		$('.UnAuthShare<?php echo $ua['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		$('.UnAuthAcc<?php echo $ua['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		$('.UnAuthPigm<?php echo $ua['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		$('.UnAuthLoan<?php echo $ua['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		$('.UnAuthDl<?php echo $ua['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.bdy_<?php echo $ua['module']->Mid; ?>').load($(this).attr('href'));
		});
		
		
		
		
		/*
			$('.accustpbtn').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
			});
			
			$('.custdet').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			
			$('.box-inner').load($(this).attr('href'));
			
			});
			
			$('.edtbtn').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
			});
		*/
	</script>			