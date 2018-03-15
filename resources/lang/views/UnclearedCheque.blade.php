      <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

			</div>
        </noscript>

    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
    <!--   <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a class="clickme" >Authorising</a>
            </li>
        </ul>
		</div>-->
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Uncleared Cheque Details </h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="unclearsb" class="btn btn-default crtsb">UnCleared SB Cheque</a>
						<a href="unclearrd" class="btn btn-default crtrd">UnCleared RD Cheque</a>
						<a href="unclearpgm" class="btn btn-default crtpgm">UnCleared Pigmi Cheque</a>
						<a href="unclearloan" class="btn btn-default crtloan">UnCleared Loan Cheque</a>
						<a href="unclearfd" class="btn btn-default crtfd">UnCleared FD Cheque</a>
					</div>
					<div class="alert alert-info">
						<a href="unclearexp" class="btn btn-default crtexp">UnCleared Expense Cheque</a>
					</div>
					
			</div>
		</div>
	</div>

<script>
	  
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtsb').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$('.crtrd').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.crtpgm').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	$('.crtloan').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
	$('.crtfd').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
	$('.crtexp').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
</script>