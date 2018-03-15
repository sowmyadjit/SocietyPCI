
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >Report</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  PIGMY AGENT CHANGE</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<!--<div class="box-content">
					<div class="alert alert-info">
					<a href="#" class="btn btn-default crtds">Create Company</a>
				</div>-->
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<!--<div class="col-md-4">
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT PIGMY ACCOUNT"> 
							</div>-->
							
							<!--<label class="control-label col-md-1">BRANCH:</label>-->
							
							
							
							<!--<label class="control-label col-md-1">AGENT:</label>-->
							
							
							
							
							
							
							<div class="col-md-2">
								<a class="btn btn-default allcust pull-left"> AGENT CHANGE</a>
							</div>
							
							
						
						<div class="col-md-8">
								<a class="btn btn-default singlecust pull-left">SINGLE CUSTOMER</a>
							</div>
							
							
							
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes'>
					
					
					
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>


<script>
	$('.crtcust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
	});
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#maincontents').load($(this).attr('href'));
	});
	
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	
	$('.allcust').click(function(e){
		
		
		e.preventDefault();
		$.ajax({
			url:'allcust',
			type:'get',
			success:function(data)
			{
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});	
	
	$('.singlecust').click(function(e){
		
		
		e.preventDefault();
		$.ajax({
			url:'singlecust',
			type:'get',
			success:function(data)
			{
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	
	
</script>




