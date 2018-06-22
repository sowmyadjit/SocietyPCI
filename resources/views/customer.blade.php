<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>


<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $id['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div class="SearchRes">	
		
		<div class="row">
			<div class="box col-md-12">
				<div class="bdy_<?php echo $id['module']->Mid; ?> box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> Customers Detail</h2>
						
					</div>
					
					<div class="box-content">
						
						
						
						<div class="alert alert-info">
							<div class="form-group">
								
								<div class="row table-row">
									<a href="createcustomer" class="btn btn-default crtcust<?php echo $id['module']->Mid; ?>">Create Customer</a>
									<div class="msg1 pull-left blink1"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
									<div class="msg2 pull-left blink2"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
									
									<input type="button" value="D class Customer" class="btn btn-info crtdclasscust" />
									<div class="col-md-5 pull-right">
										<input class="SearchTypeahead form-control" id="SearchCust" type="text" name="SearchCust" placeholder="SEARCH CUSTOMER">
										
										
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="SearchRes<?php echo $id['module']->Mid; ?>">
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								
								<thead>
									<tr>
										<th>Customer ID</th>
										<th>NAME</th>
										<th>BRANCH NAME</th>
										<th>MOBILE NUMBER</th>
										<th>CUSTOMER TYPE</th>
										<th>Member Number</th>
										<th colspan=2><center>ACTION</center></th>
										
									</tr>
								</thead>
								
								<tbody>
									@foreach ($id['customer'] as $customer)
									<tr>
										<td class="hidden">{{ $customer->Custid }}</td>
										<td>{{ $customer->Uid }}</td>
										<td><a  href="customerdetails/{{ $customer->Custid }}" >{{ $customer->FirstName }} {{ $customer->MiddleName }} {{ $customer->LastName }}</a></td>
										<td>{{ $customer->BName }}</td>
										<td>{{ $customer->MobileNo }}</td>
										<td>{{ $customer->custtyp }}</td>
										<td>{{ $customer->Member_No }}</td>
										
										<td>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $id['module']->Mid; ?>" href="customerdetails/{{ $customer->Custid }}/edit"/>
												</div>
											</div>
										</td>
										@if($customer->custtyp=="CLASS D")
										<td>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $id['module']->Mid; ?>" href="CustomerReceipt/{{ $customer->Custid }}"/>
													</div>
												</div>
										</td>
										@else
										<td>
											
										</td>
										@endif
										
									</tr>
									@endforeach
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.crtcust').hide();
	$('.msg1').hide();
	$('.msg2').hide();
	
	
	$temp1="<?php echo $id['open'];?>";
	$temp2="<?php echo $id['close'];?>";
	if($temp1==1)
	{
		if($temp2==0)
		{
			$('.crtcust').show();
		}
		else if($temp2==1)
		{
			
			$('.crtcust').hide();
			$('.msg2').show();
			blink('.blink2');
			//$(".modal_btn").click();
			
		}
	}
	else if($temp1==0)
	{
		
		$('.crtcust').hide();
		$('.msg1').show();
		blink('.blink1');
		//$(".modal_btn").click();
	}
	
	function blink(selector){
		$(selector).fadeOut('show',function(){
			
			$(this).fadeIn('show',function(){
				blink(this);
			});	
		});	
	}
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/SearchCustomer' 
		//source:SearchCustomer
	});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchCust').data('value');
		e.preventDefault();
		$.ajax({
			url:'/CustSearchView',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes').html(data);
				
				
			}
		});
	});
	
	$('.crtdclasscust').click(function(e){
		a="hai";
		e.preventDefault();
		$.ajax({
			url:'/D_class_custm',
			type:'get',
			data:'&hai='+a,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes').html("");
				$('.SearchRes').html(data);
				
				
				
			}
		});
	});
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtcust<?php echo $id['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $id['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.custdet<?php echo $id['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $id['module']->Mid; ?>').load($(this).attr('href'));
	});	
	
	$('.crtdclasscust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $id['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $id['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $id['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.ReceiptPrint<?php echo $id['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-content').load($(this).attr('href'));
		$('.bdy_<?php echo $id['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $id['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $id['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $id['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $id['module']->Mid; ?>_content').load($(this).attr('href'));
	});
</script>		