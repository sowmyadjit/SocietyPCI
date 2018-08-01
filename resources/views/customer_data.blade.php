
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
										<td><a  href="customerdetails/{{ $customer->Custid }}" class="cust_name" >{{ $customer->FirstName }} {{ $customer->MiddleName }} {{ $customer->LastName }}</a></td>
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
							
<script>
	$(".cust_name").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url,false);
	});
	$(".edtbtn<?php echo $id['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url,false);
	});
	$(".ReceiptPrint<?php echo $id['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url,false);
	});
</script>