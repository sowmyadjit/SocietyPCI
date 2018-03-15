

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $pa['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<!--<div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >PIGMI ALLOCATION DETAIL</a>
			</li>
		</ul>
	</div>-->
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $pa['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> PIGMI ALLOCATION DETAIL</h2>
					
					
				</div>
				<div class="box-content">
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
		<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
		
							<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
							</div>
							<div>
								<a href="crtpigmiallocation" class="btn btn-default crtpal<?php echo $pa['module']->Mid; ?>">PIGMI ALLOCATION</a>
								<div class="col-md-5 pull-right">
									<input class="SearchTypeahead form-control" id="SearchPigmy" type="text" name="SearchPigmy" placeholder="SEARCH PIGMY">
									
									
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="SearchRes">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>Customer ID</th>
									<th>PIGMI Type</th>
									<th>Customer Name</th>
									<th>Account Number</th>
									<th>Allocation Date</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Total Balance</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								
								
								
								@foreach ($pa['data'] as $pigmiallocation)
								<tr>
									<td class="hidden">{{ $pigmiallocation->PigmiAllocID }}</td>
									
									<td>{{ $pigmiallocation->Uid }}</td>
									<td>{{ $pigmiallocation->Pigmi_Type }}</td>
									<td>{{ $pigmiallocation->FirstName }}</td>	
									<td>{{$pigmiallocation->old_pigmiaccno}}/
									{{$pigmiallocation->PigmiAcc_No}}</td>
							<td><?php $crdate=date("d-m-Y",strtotime($pigmiallocation->AllocationDate)); echo $crdate; ?></td>
								<td><?php $crdate=date("d-m-Y",strtotime($pigmiallocation->StartDate)); echo $crdate; ?></td>
								<td><?php $crdate=date("d-m-Y",strtotime($pigmiallocation->EndDate)); echo $crdate; ?></td>
	
								<td>{{$pigmiallocation->Total_Amount}}</td> 
								<td>
								
								<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $pa['module']->Mid; ?>" href="ViewPigallocEdit/{{ $pigmiallocation->PigmiAllocID }}"/>
											</div>
										</div>
								</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						
					</div>
				</div>
				<div id='pagei<?php echo $pa['module']->Mid; ?>'>
					{!! $pa['data']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<script>
$('.crtpal').hide();
	$('.msg1').hide();
	$('.msg2').hide();
	
	
	$temp1="<?php echo $pa['open'];?>";
				$temp2="<?php echo $pa['close'];?>";
				if($temp1==1)
				{
					if($temp2==0)
					{
						$('.crtpal').show();
					}
					else if($temp2==1)
					{
						
						$('.crtpal').hide();
						$('.msg2').show();
						//$(".modal_btn").click();
						
					}
				}
				else if($temp1==0)
				{
					
					$('.crtpal').hide();
					$('.msg1').show();
					//$(".modal_btn").click();
				}
	
	$('input.SearchTypeahead').typeahead({
		//ajax: '/SearchPigmy'
        source:SearchPigmy
	});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchPigmy').data('value');
		e.preventDefault();
		$.ajax({
			url:'/PigmySearchView',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes').html(data);
				
				
			}
		});
	});
	
	
	$('.clickme<?php echo $pa['module']->Mid; ?>').click(function(e)
	{
		$('.pigmiallocclassid').click();
	});
	$('.crtpal<?php echo $pa['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $pa['module']->Mid; ?>').load($(this).attr('href'));
	});
	
$('.edtbtn<?php echo $pa['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$("#pagei<?php echo $pa['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $pa['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $pa['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $pa['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	</script>		