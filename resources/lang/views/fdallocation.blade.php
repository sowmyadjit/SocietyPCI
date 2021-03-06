<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-lg-10 col-sm-10">
	
	<div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >FD ALLOCATION DETAIL</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> FD ALLOCATION DETAIL</h2>
				</div>
				
				<div class="box-content">
					
					
					
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
								
								<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
								<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
								<a href="crtfdallocation" class="btn btn-default crtpal">FD ALLOCATION</a>
								
								<div class="col-md-5 pull-right">
									<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH FD ACCOUNT">
									
									
								</div>
							</div>
						</div>
						
						
					</div>
					
					
					
					
					
					<div class="SearchRes">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								
								<th>Certificate Number</th>
								
								<th>Name</th>
								
								<th>Number Of Days</th>
								<th>Interest</th>
								<th>Deposit Amount</th>
								<th>Start Date</th>
								<th>Mature Date</th>
								<th>Maturity Amount</th>
								<th>Remarks</th>
								<th colspan=2><center>ACTION</center></th>
								
								
							</tr>
						</thead>
						<tbody>
							
							<tr>
								@foreach ($fda['data'] as $fdallocation)
								<tr>
									<td class="hidden">{{ $fdallocation->Fdid }}</td>
									<td class="hidden">{{ $fdallocation->FdTid }}</td>
									<td class="hidden">{{ $fdallocation->Uid }}</td>
									<td class="hidden">{{ $fdallocation->Custid }}</td>
									
									
									<td><a  href="customerdetails/{{ $fdallocation->Custid }}" class="custdet">{{ $fdallocation->Fd_OldCertificateNum }}/{{ $fdallocation->Fd_CertificateNum }}</a></td>
									
						<td>{{ $fdallocation->FirstName }}.{{ $fdallocation->MiddleName}}.{{ $fdallocation->LastName }}</td>
									
									<td>{{ $fdallocation->NumberOfDays }}</td>
									<td>{{ $fdallocation->FdInterest }}</td>
									<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
									<td>{{$fdallocation->Fd_StartDate}}
										<td>{{ $fdallocation->Fd_MatureDate}}</td>
										<td>{{ $fdallocation->Fd_TotalAmt}}</td>
										<td>{{ $fdallocation->Fd_Remarks}}</td>
										<td>
											<input type="button" value="CERTIFICATE" class="btn btn-success btn-sm CertiBtn" href="FdCertificate/{{ $fdallocation->Fdid }}"/>
										</td>
										<td>
											
											<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="FDReceipt/{{ $fdallocation->Fdid }}"/>
											
										</td>
										
										
									</tr>
									@endforeach
								</tbody>
							</table>
						
						<div id='pagei'>
							{!! $fda['data']->render() !!}
						</div>
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
	
	
	$temp1="<?php echo $fda['open'];?>";
				$temp2="<?php echo $fda['close'];?>";
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
				ajax: '/SearchFdAllocation'
			});
			
			$('.SearchTypeahead').change(function(e){
				searchvalue=$('#SearchFd').data('value');
				//$('SearchTypeahead').typeahead('destroy');
				e.preventDefault();
				$.ajax({
					url:'/FDSearchView',
					type:'get',
					data:'&SearchAccId='+searchvalue,
					success:function(data)
					{
						//alert("success");
						$('.SearchRes').html(data);
						//$('#SearchFd').val("");
						//$('#SearchFd').data("");
						
					}
				});
			});
			$('.clickme').click(function(e)
			{
				$('.fdallclassid').click();
			});
			
			$('.CertiBtn').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$('.ReceiptPrint').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			$('.crtpal').click(function(e)
			{
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
			$('.custdet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
		</script>						