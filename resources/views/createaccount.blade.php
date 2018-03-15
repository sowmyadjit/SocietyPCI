<script src="js/bootstrap-typeahead.js"></script>
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $a['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box_bdy_<?php echo $a['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $a['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Account Detail</h2>
					
					
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="acccreation" class="btn btn-default CreateAcc<?php echo $a['module']->Mid; ?>">Create Account</a>
						<a href="ViewCreateJointAcc" class="btn btn-default JointAcc<?php echo $a['module']->Mid; ?>">Create Joint Account</a>
						<a href="ViewMinorAccHome" class="btn btn-default ViewMinAcc<?php echo $a['module']->Mid; ?>">Create Minor Account</a>
						<a href="sbacclist" class="btn btn-default SbList<?php echo $a['module']->Mid; ?> pull-right">SB Account List</a>
						<a href="rdacclist" class="btn btn-default RdList<?php echo $a['module']->Mid; ?> pull-right">RD Account List</a>
						
						<!-- <input class="SearchTypeahead" id="searchacc" type="text" name="searchacc" placeholder="SELECT Account Number"> 
						<input class="SearchOldAccTypeahead" id="searcholdacc" type="text" name="searcholdacc" placeholder="SELECT Account Number"> -->
						
						
					</div>
					
					
					
					
					
					
					
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
								
								<div class="col-md-6">
									<label class="control-label col-sm-6">SELECT Account Number:</label>
									<div class="col-md-6">
										<input class="SearchTypeahead form-control" id="searchacc<?php echo $a['module']->Mid; ?>" type="text" name="searchacc<?php echo $a['module']->Mid; ?>" placeholder="SELECT Account Number"> 
									</div>
								</div>
								
								<div class="col-md-6">
									<label class="control-label col-sm-4">EXPORT:</label>
									<div class="col-md-6">
										<select class="form-control" id="ExportType" name="ExportType">
											<option value="">		SELECT TYPE</option>
											<option value="word">WORD</option>
											<option value="excel">EXCEL</option>
											<option value="pdf">PDF</option>
											
										</select>
									</div>
								</div>
								
								
								
								
								<!--	<div class="col-md-6">
									<label class="control-label col-md-6">SELECT Old Account Number:</label>
									<div class="col-md-6">
									<input class="SearchOldAccTypeahead form-control" id="searcholdacc" type="text" name="searcholdacc" placeholder="SELECT Old Account Number"> 
									</div>
								</div>-->
								
								
							</div>
						</div>
					</div>
					
					
					<div id="">
						<script src="js/bootstrap-table.js"/>
						<script src="js/FileSaver.js"/>			
						<script src="js/tableExport.js"/>			
						<script src="js/jquery.base64.js"/>			
						<script src="js/sprintf.js"/>
						<script src="js/jspdf.js"/>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
						
						<script src="js/bootstrap-table-export.js"/>
						<link href="css/bootstrap-table.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
						
						
						
						<div id="hee">
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive bootstrapTable" id="CustList" style='font-family:arial;font-size:10' data-tableexport-display="always">
								
								<!--<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">-->
								
								<thead>
									<tr>
										<th>Account Number</th>
										<th>Account Type</th>
										<th>Name</th>
										<th>Mobile Number</th>
										<th>Start Date</th>
										<th>Mature Date</th>
										<th>Balance</th>
										
									</tr>
								</thead>
								
								<tbody>
									
									@foreach ($a['accounts_all'] as $createaccount)
									<tr>
										<td>{{ $createaccount->AccNum }}/{{ $createaccount->Old_AccNo }}</td> 
										<td>{{ $createaccount->Acc_Type }}</td>
										<td>{{ $createaccount->FirstName }}.{{ $createaccount->MiddleName }}.{{ $createaccount->LastName }}</td>
										<td>{{ $createaccount->MobileNo }}</td>
										<td>{{ $createaccount->Created_on }}</td>
										<td>{{ $createaccount->Maturity_Date }}</td>
										<td>{{ $createaccount->Total_Amount }}</td>
										
										
										
									</tr>
									
									@endforeach
							</tbody>
							
						</table>	
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Account Number</th>
								<th>Account Type</th>
								<th>Name</th>
								<th>Mobile Number</th>
								<th>Start Date</th>
								<th>Mature Date</th>
								<th>Balance</th>
								<th>EDIT</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($a['accounts'] as $createaccount)
							<tr>
								<td class="hidden">{{ $createaccount->Accid }}</td>
								<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn<?php echo $a['module']->Mid; ?>"> {{ $createaccount->AccNum }}/{{ $createaccount->Old_AccNo }}</a></td> 
								<td>{{ $createaccount->Acc_Type }}</td>
								<td>{{ $createaccount->FirstName }}.{{ $createaccount->MiddleName }}.{{ $createaccount->LastName }}</td>
								<td>{{ $createaccount->MobileNo }}</td>
								<td>{{ $createaccount->Created_on }}</td>
								<td>{{ $createaccount->Maturity_Date }}</td>
								<td>{{ $createaccount->Total_Amount }}</td>
							</div>		
							
							<td>
								
								<div class="form-group">
									<div class="col-sm-12">
										<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $a['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
									</div>
								</div>
								
							</td>
						</tr>
						
						@endforeach
					</tbody>
					
				</table>
				
				
				
	<?php /*			
			</div>	
			<div id='pagei<?php echo $a['module']->Mid; ?>'>
				{!! $a['accounts']->render() !!}
			</div>
			*/?>
			
		</div>
	</div>	
</div>	
</div>	
</div>	



<script>
	
	$('#hee').hide();
	
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		
		if(type=="word")
		{
			
			$('#CustList').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('#CustList').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			//alert("Please Select Type For Export");
			$('#CustList').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
			
		}
		
	});
	
	
	
	
	
	$('.hidebtn').hide();
	
	$('.msg1').hide();
	$('.msg2').hide();
	
	$temp1="<?php echo $a['open'];?>";
	$temp2="<?php echo $a['close'];?>";
	if($temp1==1)
	{
		if($temp2==0)
		{
			$('.hidebtn').show();
		}
		else if($temp2==1)
		{
			
			$('.hidebtn').hide();
			$('.msg2').show();
			$(".modal_btn").click();
			
		}
	}
	else if($temp1==0)
	{
		
		$('.hidebtn').hide();
		$('.msg1').show();
		$(".modal_btn").click();
	}
	
	
	$('.clickme').click(function(e)
	{
		$('.accclassid').click();
	}); 
	$('.CreateAcc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.SbList<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.RdList<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.ViewMinAcc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.JointAcc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.viwbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $a['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $a['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $a['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('input.SearchTypeahead').typeahead({
		//ajax: '/GetSearchAcc'
		source:GetSearchAcc
	});
	
	/*$('input.SearchOldAccTypeahead').typeahead({
		//ajax: '/GetSearchOldAcc'
		source:GetSearchOldAcc
	});*/
	
	$('#searchacc<?php echo $a['module']->Mid; ?>').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		searchvalue=$('#searchacc<?php echo $a['module']->Mid; ?>').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'getSearchaccount',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.box_bdy_<?php echo $a['module']->Mid; ?>').html(data);
				
				
			}
		});
	});
	
	/*	$('.SearchOldAccTypeahead').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		searcholdvalue=$('#searcholdacc').data('value');
		//alert(searcholdacc);
		e.preventDefault();
		$.ajax({
		url:'getSearchOldaccount',
		type:'get',
		data:'&SearchOldAccId='+searcholdvalue,
		success:function(data)
		{
		//alert("success");
		$('.box_bdy_<?php echo $a['module']->Mid; ?>').html(data);
		
		
		}
		});
		});
	*/
	</script>								