<style>
	.hide_it {
		opacity: 0.5;
		height: 1px;
		overflow: scroll;
	}
</style>

						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
							<thead>
								<tr>
									<th>NAME</th>
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
								<tr  id="td_{{$customer->Custid}}">
									<td class="hidden">{{ $customer->Custid }}</td>
									<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet<?php echo $c['module']->Mid; ?>">{{ $customer->FirstName }} {{ $customer->MiddleName }} {{ $customer->LastName }}</a></td>
									<td>{{ $customer->BName }}</td>
									<td>{{ $customer->MobileNo }}</td>
									<td>{{ $customer->PhoneNo }}</td>
									<td>{{ $customer->custtyp }}</td>
								<?php /* 
									<td>{{ $customer->Customer_Fee }}</td>
									<td>{{ $customer->Member_No }}</td>
								 */?>
									 <td class="td_cf" data="{{$customer->Custid}}" style="user-select:none">
											<div class="show_cf" id="show_cf_{{$customer->Custid}}">
												{{ $customer->Customer_Fee }}
											</div>
											<div class="edit_cf" id="edit_cf_{{$customer->Custid}}">
												<input class="ip_edit_cf" id="ip_edit_cf_{{$customer->Custid}}" style="width:50px;" value="{{$customer->Customer_Fee}}" />
												<button class="save_cf btn-xs" data="{{$customer->Custid}}"><span class="glyphicon glyphicon-ok"></span></button>
											</div>
									</td>
									<td class="td_mn" data="{{$customer->Uid}}"  style="user-select:none">
										   <div class="show_mn" id="show_mn_{{$customer->Uid}}">
											   {{ $customer->Member_No }}
										   </div>
										   <div class="edit_mn" id="edit_mn_{{$customer->Uid}}">
											   <input id="ip_edit_mn_{{$customer->Uid}}" style="width:50px;" value="{{$customer->Member_No}}" />
											   <button class="save_mn btn-xs" data="{{$customer->Uid}}"><span class="glyphicon glyphicon-ok"></span></button>
										   </div>
								   </td>
									
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
											<td><b> <span id="total_cf">{{$total_cust_fee}}</span> </b></td> <?php /**/ ?>
											<td></td>
											<td></td>
											<td></td>
										</tr>
							</tbody>
					</table>

					
					<div class="hide_it " id="to_print2" >
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive to_excel2">
								<thead>
									<tr>
										<th>NAME</th>
										<th>BRANCH NAME</th>
										<th>MOBILE NUMBER</th>
										<th>PHONE NUMBER</th>
										<th>CUSTOMER TYPE</th>
										<th>CUSTOMER FEE</th>
										<th>MEMBER NUMBER</th>
										
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
									<tr  id="td_{{$customer->Custid}}">
										<td>{{ $customer->FirstName }} {{ $customer->MiddleName }} {{ $customer->LastName }}</td>
										<td>{{ $customer->BName }}</td>
										<td>{{ $customer->MobileNo }}</td>
										<td>{{ $customer->PhoneNo }}</td>
										<td>{{ $customer->custtyp }}</td>
									<?php /* 
										<td>{{ $customer->Customer_Fee }}</td>
										<td>{{ $customer->Member_No }}</td>
									*/?>
										<td class="td_cf" data="{{$customer->Custid}}" style="user-select:none">
												<div class="show_cf" id="show_cf_{{$customer->Custid}}">
													{{ $customer->Customer_Fee }}
												</div>
												<div class="edit_cf" id="edit_cf_{{$customer->Custid}}">
													<input class="ip_edit_cf" id="ip_edit_cf_{{$customer->Custid}}" style="width:50px;" value="{{$customer->Customer_Fee}}" />
													<button class="save_cf btn-xs" data="{{$customer->Custid}}"><span class="glyphicon glyphicon-ok"></span></button>
												</div>
										</td>
										<td class="td_mn" data="{{$customer->Uid}}"  style="user-select:none">
											<div class="show_mn" id="show_mn_{{$customer->Uid}}">
												{{ $customer->Member_No }}
											</div>
											<div class="edit_mn" id="edit_mn_{{$customer->Uid}}">
												<input id="ip_edit_mn_{{$customer->Uid}}" style="width:50px;" value="{{$customer->Member_No}}" />
												<button class="save_mn btn-xs" data="{{$customer->Uid}}"><span class="glyphicon glyphicon-ok"></span></button>
											</div>
										</td>
										
										
									</tr>
									@endforeach
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><b> <span id="total_cf">{{$total_cust_fee}}</span> </b></td> <?php /**/ ?>
												<td></td>
												<td></td>
												<td></td>
											</tr>
								</tbody>
						</table>

					</div>
							
<script>
	$(".custdet<?php echo $c['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url2(url,false);
	});
	$(".edtbtn").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url2(url,false);
	});
	$(".ReceiptPrint").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url2(url,false);
	});
</script>


<script>
	var flag_cf = "show_cf";// cf - CUSTOMER FEE
	$(".show_cf").show();
	$(".edit_cf").hide();
	$(".td_cf").dblclick(function() {
		var cust_id = $(this).attr("data"); // console.log("td_cust_id: "+cust_id);
		
		tgle_cf(cust_id,"on");
	});

	var flag_mn = "show_mn";// mn - MEMBER NO
	$(".show_mn").show();
	$(".edit_mn").hide();
	$(".td_mn").dblclick(function() {
		var user_id = $(this).attr("data"); // console.log("td_user_id: "+user_id);
		
		tgle_mn(user_id,"on");
	});

	$(".save_cf").click(function() {// CUSTOMER FEE
		//save value
		var cust_id = $(this).attr("data");
		var cf_val = $("#ip_edit_cf_"+cust_id).val();
		$("#show_cf_"+cust_id).html(cf_val);
		save_cf(cust_id,cf_val);
		tgle_cf(cust_id,"off");
	});
	$(".save_mn").click(function() {// MEMBER NO
		//save value
		var user_id = $(this).attr("data");
		var mn_val = $("#ip_edit_mn_"+user_id).val();
		$("#show_mn_"+user_id).html(mn_val);
		save_mn(user_id,mn_val);
		tgle_mn(user_id,"off");
	});

	function tgle_cf(cust_id,flag) {// CUSTOMER FEE
		if(flag == "on") {
			$("#show_cf_"+cust_id).hide();
			$("#edit_cf_"+cust_id).show();
		} else {
			$("#show_cf_"+cust_id).show();
			$("#edit_cf_"+cust_id).hide();
		}
	}
	function tgle_mn(user_id,flag) {// MEMBER NO
		if(flag == "on") {
			$("#show_mn_"+user_id).hide();
			$("#edit_mn_"+user_id).show();
		} else {
			$("#show_mn_"+user_id).show();
			$("#edit_mn_"+user_id).hide();
		}
	}

	function save_cf(pk_value,field_value)  {// CUSTOMER FEE
		var table = "customer";
		var pk = "Custid";
		var field_name = "Customer_Fee";
		save(table,pk,pk_value,field_name,field_value);
		calc_total_cf();
	}
	function save_mn(pk_value,field_value)  {// MEMBER NO
		var table = "user";
		var pk = "Uid";
		var field_name = "Member_No";
		save(table,pk,pk_value,field_name,field_value);
	}

	function save(table,pk,pk_value,field_name,field_value) {
		$.ajax({
			url: "save_to_db",
			type: "post",
			data: "table="+table+"&pk="+pk+"&pk_value="+pk_value+"&field_name="+field_name+"&field_value="+field_value,
			success: function() {
				console.log("save_to_db : done");
			}
		});
	}
</script>

<script>
	function calc_total_cf() {
		var total_cf = 0;
		$(".ip_edit_cf").each(function() {
			total_cf += parseFloat($(this).val());
		});
		$("#total_cf").html(total_cf);
	}
</script>


<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print2").click(function() {
			var divContents = $("#to_print2").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>D Class Customer List</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});
	
	
</script>