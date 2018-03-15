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
					<h2><i class="glyphicon glyphicon-user"></i> Authorising Details </h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="authcust" class="btn btn-default crtcust">UnAuthorised Customer</a>
						<a href="authemp" class="btn btn-default crtcust">UnAuthorised Employee</a>
						<a href="authmemb" class="btn btn-default crtcust">UnAuthorised shares</a>
						<a href="authaccount" class="btn btn-default crtcust">UnAuthorised Accounts</a>
						<a href="authpigmy" class="btn btn-default crtcust">UnAuthorised Pigmy Accounts</a>
					</div>
					
					<div class="alert alert-info">
						<a href="authloan" class="btn btn-default crtcust">UnAuthorised Loans</a>
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
	
	$('.crtcust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
	});
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
	</script>	