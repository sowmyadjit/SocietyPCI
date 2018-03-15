<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


<div id="content<?php echo $BranchWise['module']->Mid; ?>" class="col-md-10">
	<!-- content starts -->
	<div class="row">
		<div class="box_bdy_<?php echo $BranchWise['module']->Mid; ?> box col-md-12">
				<div class="bdy_<?php echo $BranchWise['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   Report</h2>
					
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
							
						<label class="control-label inline col-md-4">Account Type:
						
							<select class="form-control" id="tt" name="tt">
								<option>-----select  Account-----</option>
								<option>SB Account</option>
								<option>PIGMI Account</option>
								<option>RD Account</option>
								
							</select>
						
				</label>
				
				
								<div class="sb">
									<label class="control-labelinline col-md-4">SELECT Account Number:
									
										<input class="SearchTypeahead form-control" id="searchacc<?php echo $BranchWise['module']->Mid; ?>" type="text" name="searchacc<?php echo $BranchWise['module']->Mid; ?>" placeholder="SELECT Account Number"> 
									
								</label>
								</div>
								<div class="pigmi">
									<label class="control-labelinline col-md-4">SELECT Account Number:
						
										<input class="SearchTypeaheadpigmi form-control" id="searchpigmiacc<?php echo $BranchWise['module']->Mid; ?>" type="text" name="searchpigmiacc<?php echo $BranchWise['module']->Mid; ?>" placeholder="SELECT Account Number"> 
									
								</label>
								</div>
					<div class="col-md-2">
								<a class="btn btn-default SearchBWPig<?php echo $BranchWise['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes'>
					<div  id="toprint">
						
						
					</div>
					
					
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>


<script>
	$('.sb').hide();
	$('.pigmi').hide();
	var $searchvalue;
	
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
	
	
	$('.SearchBWPig<?php echo $BranchWise['module']->Mid; ?>').click(function(e){
		
		
		accounttype=$('#tt').val();
		if(accounttype=="PIGMI Account")
		{
			
			id=$('.SearchTypeaheadpigmi').data('value');
		}
		else
		{
			id=$('.SearchTypeahead').data('value');
			
		}
		
		e.preventDefault();
		$.ajax({
			url:'getallaccount',
			type:'get',
			data:'&accounttype='+accounttype+'&id='+id,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSearchAcc'
		//source:GetSearchAcc
		});
	$('input.SearchTypeaheadpigmi').typeahead({
		//ajax: '/SearchPigmy'
        source:SearchPigmy
	});			
	
	
	$('#tt').change(function(e){
		sbtran=$('#tt').val();
		if(sbtran=="SB Account")
		{
			$('.sb').show();
			
			$('.pigmi').hide();
		}
		else if(sbtran=="PIGMI Account")
		{
			$('.pigmi').show();
			$('.sb').hide();
		}
		else if(sbtran=="RD Account")
		{
			$('.pigmi').hide();
			$('.sb').show();
		}
		
		else
		{
			$('.sb').hide();
			$('.pigmi').hide();
			alert("Please Select the Transaction Type");
		}
		
	});
	
</script>


<script>
	
	$(function() {
		$(".PrintPig").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>SB transaction</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
</script>