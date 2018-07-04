<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $c['module']->Mid; ?>" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box_bdy_<?php echo $c['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $c['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SB Account List</h2>
					
				</div>
				<div class="box-content">
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>FIRST NAME</th>
								<th>MIDDLE NAME</th>
								<th>LAST NAME</th>
								<th>BRANCH NAME</th>
								<th>MOBILE NUMBER</th>
								<th>PHONE NUMBER</th>
								<th>CUSTOMER TYPE</th>
								<th>CUSTOMER FEE</th>
								<th>MEMBER NUMBER</th>
								<th colspan=2><center>ACTION</center></th>
								
							</tr>
						</thead>
						
						<tbody>
							<?php
								$total_cust_fee = 0;
							?>
							@foreach ($c['data'] as $customer)
							<?php
								$total_cust_fee += $customer->Customer_Fee;
							?>
							<tr>
								<td class="hidden">{{ $customer->Custid }}</td>
								<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet<?php echo $c['module']->Mid; ?>">{{ $customer->FirstName }}</a></td>
								<td>{{ $customer->MiddleName }}</td>
								<td>{{ $customer->LastName }}</td>
								<td>{{ $customer->BName }}</td>
								<td>{{ $customer->MobileNo }}</td>
								<td>{{ $customer->PhoneNo }}</td>
								<td>{{ $customer->custtyp }}</td>
								<td>{{ $customer->Customer_Fee }}</td>
								<td>{{ $customer->Member_No }}</td>
								
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="customerdetails/{{ $customer->Custid }}/edit"/>
										</div>
									</div>
								</td>
								@if($customer->custtyp=="CLASS D")
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="CustomerReceipt/{{ $customer->Custid }}"/>
										</div>
									</div>
								</td>
								@else
								<td>
									
								</td>
								@endif
								
							</tr>
							@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_cust_fee}}</b></td> <?php /**/ ?>
										<td></td>
										<td></td>
										<td></td>
									</tr>
						</tbody>
					</table>
				</div>	
				
			</div>	
			
			
		</div>	
	</div>	
</div>	

<script>
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtcust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	
	$('.custdet<?php echo $c['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.box_bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.ReceiptPrint').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-content').load($(this).attr('href'));
	});
</script>