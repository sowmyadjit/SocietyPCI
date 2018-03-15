      <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

			</div>
        </noscript>

    <div id="content<?php echo $uc->Mid; ?>" class="col-lg-10 col-sm-10">
        <!-- content starts -->
   
		
		<div class="row">
			<div class="box_bdy_<?php echo $uc->Mid; ?> box col-md-12">
				<div class="bdy_<?php echo $uc->Mid; ?> box-inner">
					<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Uncleared Cheque Details </h2>
						
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="unclearsb" class="btn btn-default crtsb<?php echo $uc->Mid; ?>">UnCleared SB Cheque</a>
						<a href="unclearrd" class="btn btn-default crtrd<?php echo $uc->Mid; ?>">UnCleared RD Cheque</a>
						<a href="unclearpgm" class="btn btn-default crtpgm<?php echo $uc->Mid; ?>">UnCleared Pigmi Cheque</a>
						<a href="unclearloan" class="btn btn-default crtloan<?php echo $uc->Mid; ?>">UnCleared Loan Cheque</a>
						<a href="unclearfd" class="btn btn-default crtfd<?php echo $uc->Mid; ?>">UnCleared FD Cheque</a>
					</div>
					<div class="alert alert-info">
						<a href="unclearexp" class="btn btn-default crtexp<?php echo $uc->Mid; ?>">UnCleared Expense Cheque</a>
					</div>
					
			</div>
		</div>
	</div>

<script>
	  
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtsb<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $uc->Mid; ?>').load($(this).attr('href'));
	});
	$('.crtrd<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $uc->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.crtpgm<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.bdy_<?php echo $uc->Mid; ?>').load($(this).attr('href'));
		
	});
	$('.crtloan<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.bdy_<?php echo $uc->Mid; ?>').load($(this).attr('href'));
		
	});
	
	$('.crtfd<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.bdy_<?php echo $uc->Mid; ?>').load($(this).attr('href'));
		
	});
	
	$('.crtexp<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.bdy_<?php echo $uc->Mid; ?>').load($(this).attr('href'));
		
	});
	
	$('.edtbtn<?php echo $uc->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
</script>