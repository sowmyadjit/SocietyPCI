<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $ps['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <!--<div>
        <ul class="breadcrumb">
		<li>
		<a href="#">Home</a>
		</li>
		<li>
		<a class="clickme" >Purchase Share</a>
		</li>
		</ul>
	</div>-->
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $ps['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Purchase Share Detail</h2>
					
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
								<!--<a href="pursharesdetail" class="btn btn-default purshrcrt">Create Purchase Shares</a>-->
								<div class="col-md-4">
									<input class="SearchTypeahead form-control" id="SearchShare" type="text" name="SearchShare" placeholder="SEARCH PURCHASE SHARE">
								</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="SearchRes">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									
									
									<th>Member Firstname</th>
									<th>Member MiddleName</th>
									<th>Member LastName</th>
									<th>Member ID</th>
									
									<th>Share Class</th>
									<th>Share Amount</th>
									<!--<th>Share Price</th>-->
									<th>Total Shares</th>
									<th>Total Amount</th>
									<th>Member Share ID</th>
									<th>Certificate ID</th>
									<th>SHARE STATUS</th>
									<th>CERTIFICATE</th>
									<th>RECEIPT</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								@foreach ($ps['PurchaseShares'] as $purchaseshare)
								<tr>
									<td class="hidden">{{ $purchaseshare-> PURSH_Pid}}</td>
									<td>{{ $purchaseshare->FirstName}}</td>
									<td>{{ $purchaseshare->MiddleName }}</td>
									<td>{{ $purchaseshare->LastName }}</td>
									<td>{{ $purchaseshare->PURSH_Memid }}</td>
									<td>{{ $purchaseshare->PURSH_Shrclass }}</td>
									<td>{{ $purchaseshare->PURSH_Shareamt }}</td>
									<td>{{ $purchaseshare-> PURSH_Noofshares}}</td>
									<td>{{ $purchaseshare->PURSH_Totalamt }}</td>
									<td>{{ $purchaseshare->PURSH_Memshareid }}</td>
									<td>{{ $purchaseshare->PURSH_Certfid }}</td>
									<td>{{ $purchaseshare->Status }}</td>
									<td>
										
										
										<input type="button" value="CERTIFICATE" class="btn btn-info btn-sm edtbtn<?php echo $ps['module']->Mid; ?> " href="psharedetails/{{ $purchaseshare->PURSH_Pid }}"/>
									</td>
									<td>
										<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $ps['module']->Mid; ?> " href="PshareReceipt/{{ $purchaseshare->PURSH_Pid }}/{{ $purchaseshare->PURSH_Memid }}"/>
										
										
									</td>
								</tr>
								
								@endforeach
							</tbody>
							
						</table>
						
						
						<div id='pagei<?php echo $ps['module']->Mid; ?>'>
							{!! $ps['PurchaseShares']->render() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/SearchPurchaseShare' 
		//source:SearchPurchaseShare
	});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchShare').data('value');
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'/PurchaseShareSearchView',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes<?php echo $ps['module']->Mid; ?>').html(data);
				
				
			}
		});
	});
	
	
	$('.clickme<?php echo $ps['module']->Mid; ?>').click(function(e)
	{
		$('.purshareclassid').click();
	});
	
	$('.purshrcrt<?php echo $ps['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $ps['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.ReceiptPrint<?php echo $ps['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $ps['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $ps['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $ps['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $ps['module']->Mid; ?>_content').load($(this).attr('href'));
	});
</script>		