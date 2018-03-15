<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >Purchase Share</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Purchase Share Detail</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
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
									
									
									<th>Member Name</th>
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
									
									@foreach ($ps as $purchaseshare)
									<tr>	
										<td class="hidden">{{ $purchaseshare-> PURSH_Pid}}</td>
										<td>{{ $purchaseshare->FirstName}} {{ $purchaseshare->MiddleName }}{{ $purchaseshare->LastName }}</td>
										
										<td>{{ $purchaseshare->PURSH_Memid }}/{{ $purchaseshare->Member_no }}</td>
										<td>{{ $purchaseshare->PURSH_Shrclass }}</td>
										<td>{{ $purchaseshare->PURSH_Shareamt }}</td>
										<td>{{ $purchaseshare-> PURSH_Noofshares}}</td>
										<td>{{ $purchaseshare->PURSH_Totalamt }}</td>
										<td>{{ $purchaseshare->PURSH_Memshareid }}</td>
										<td>{{ $purchaseshare->PURSH_Certfid }}</td>
										<td>{{ $purchaseshare->Status }}</td>
										@if($purchaseshare->Status=="Active")
										<td>
											
											
											<input type="button" value="CERTIFICATE" class="btn btn-info btn-sm edtbtn" href="psharedetails/{{ $purchaseshare->PURSH_Pid }}"/>
											
										</td>
										<td>-</td>
										@else
											<td>-</td>
										<td>
									
											<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="PshareReceipt/{{ $purchaseshare->PURSH_Pid }}/{{ $purchaseshare->PURSH_Memid }}"/>
											
											
										</td>
										@endif
									</tr>
									
									@endforeach
								</tbody>
								
								</table>
								
								
								<div id='pagei'>
									{!! $ps->render() !!}
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
						$('.SearchRes').html(data);
						
						
					}
				});
			});
			
			
			$('.clickme').click(function(e)
			{
				$('.purshareclassid').click();
			});
			
			$('.purshrcrt').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$('.edtbtn').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$('.ReceiptPrint').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
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
		</script>		