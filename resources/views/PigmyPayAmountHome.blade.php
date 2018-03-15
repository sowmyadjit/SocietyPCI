<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $PayAmount['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
  
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $PayAmount['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Pigmy Pay Amount</h2>
					
				</div>
				
				<div class="box-content">
					
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
		<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
		<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
								<a href="PigmyPayAmountView" class="btn btn-default PayAmountLink<?php echo $PayAmount['module']->Mid; ?>">Pay Amount</a>
								
								<div class="col-md-5 pull-right">
									<input class="SearchTypeahead form-control" id="SearchPigmyPay" type="text" name="SearchPigmyPay" placeholder="SEARCH PIGMY PAY">
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="SearchRes<?php echo $PayAmount['module']->Mid; ?>">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									
									
									<th>Customer Name</th>
									<th>Account Number</th>
									<th>Pigmy Type</th>
									<th>Payed Date</th>
									<th>RECEIPT</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								@foreach ($PayAmount['data'] as $PAmt)
								<tr>
									<td class="hidden">{{ $PAmt->PayId }}</td>
									<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
									
									<td>{{ $PAmt->PayAmount_PigmiAccNum }}</td>
									<td>{{ $PAmt->Pigmi_Type }}</td>
									<td><?php $paydate=date("d-m-Y",strtotime($PAmt->PayAmountReport_PayDate)); echo $paydate;?></td>
									
									<td>
										<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $PayAmount['module']->Mid; ?>" href="PigmyPayAmountReceipt/{{ $PAmt->PayId }}"/>
										
										
									</td>
								</tr>
								
								@endforeach
							</tbody>
							
						</table>
						
					</div>
				</div>
				<div id='pagei<?php echo $PayAmount['module']->Mid; ?>'>
					{!! $PayAmount['data']->render() !!}
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
	
	
	$('input.SearchTypeahead').typeahead({
		//ajax: '/SearchPigmyPay' 
		source:SearchPigmyPay
	});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchPigmyPay').data('value');
		e.preventDefault();
		$.ajax({
			url:'/PigmyPaySearchView',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes<?php echo $PayAmount['module']->Mid; ?>').html(data);
				
				
			}
		});
	});
	
	$('.clickme').click(function(e)
	{
		$('.purshareclassid').click();
	});
	
	$('.PayAmountLink<?php echo $PayAmount['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $PayAmount['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.ReceiptPrint<?php echo $PayAmount['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $PayAmount['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $PayAmount['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $PayAmount['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $PayAmount['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $PayAmount['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	</script>		