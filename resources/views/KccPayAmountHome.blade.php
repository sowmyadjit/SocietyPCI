<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $PayAmount['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >KCC Pay Amount</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
		<div class="bdy_<?php echo $PayAmount['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> KCC Pay Amount</h2>
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						
						<div class="form-group">
							
							<div class="row table-row">
							<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
								<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
								<a href="KCCPayAmountView" class="btn btn-default PayAmountLink">Pay Amount</a>
								<div class="col-md-5 pull-right">
									<input class="SearchTypeahead<?php echo $PayAmount['module']->Mid; ?> form-control" id="SearchFdPay" type="text" name="SearchFdPay" placeholder="SEARCH KCC PAY">
								</div>
								
							</div>
						</div>
					</div>
					
					
					<div class="SearchRes">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									
									
									<th>Customer Name</th>
									<th>Account Number</th>
									<th>FD Type</th>
									<th>Payed Date</th>
									<th>RECEIPT</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								@foreach ($PayAmount['data'] as $PAmt)
								<tr>
									<td class="hidden">{{ $PAmt->FDPayId }}</td>
									<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
									
									<td>{{ $PAmt->FDPayAmt_AccNum }}</td>
									<td>{{ $PAmt->FdType }}</td>
									
									<td><?php $paydate=date("d-m-Y",strtotime($PAmt->FDPayAmtReport_PayDate)); echo $paydate;?></td>
									
									<td>
										<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="FdPayAmountReceipt/{{ $PAmt->FDPayId }}"/>
										
										
									</td>
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


<script>
	$('.PayAmountLink').hide();
	$('.msg1').hide();
	$('.msg2').hide();
	
	
	$temp1="<?php echo $PayAmount['open'];?>";
				$temp2="<?php echo $PayAmount['close'];?>";
				if($temp1==1)
				{
					if($temp2==0)
					{
						$('.PayAmountLink').show();
					}
					else if($temp2==1)
					{
						
						$('.PayAmountLink').hide();
						$('.msg2').show();
						//$(".modal_btn").click();
						
					}
				}
				else if($temp1==0)
				{
					
					$('.PayAmountLink').hide();
					$('.msg1').show();
					//$(".modal_btn").click();
				}
	/*$('input.SearchTypeahead').typeahead({
		ajax: '/SearchFdPay' 
		});*/
	
	$('input.SearchTypeahead<?php echo $PayAmount['module']->Mid; ?>').typeahead({
		//ajax: '/SearchPigmyPay' 
		source:SearchFdPay
	});
	
	$('.SearchTypeahead<?php echo $PayAmount['module']->Mid; ?>').change(function(e){
		searchvalue=$('#SearchFdPay').data('value');
		e.preventDefault();
		$.ajax({
			url:'/FdPaySearchView',
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
		$('.rdpayclassid').click();
	});
	
	$('.PayAmountLink').click(function(e)
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