



						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th><input type="checkbox" id="select_all"> select all </th>
									<th>Serial No.</th>
									<th class="hide">Member_id</th>
									<th>Member_no</th>
									<th>Branch ID</th>
									<th>Share Class</th>
									<th>Name</th>
									<th>Divident Amount</th>
									<th>Pay Amount</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
								?>
								@foreach ($data["transactions"] as $row)
									@if($row->total_amount == 0)
										<?php
											continue;
										?>
									@endif
									<tr>
										<td><input type="checkbox" id="select_id_{{$row->member_id}}"></td>
										<td>{{ $i++ }}</td>
										<td class="hide">{{$row->member_id}}</td>
										<td id="mem_no_of_{{$row->member_id}}">{{ $row->Member_no }}</td>
										<td id="bid_of_{{$row->member_id}}">{{ $row->bid }}</td>
										<td id="share_class_of_{{$row->member_id}}">{{ $row->Share_Class }}</td>
										<td id="name_of_{{$row->member_id}}">{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
										<td id="div_amt_of_{{$row->member_id}}">{{ $row->total_amount }}</td>
										<td>
											<input class="form-control pay_amt" type="text" id="pay_amt_{{$row->member_id}}" value="{{$row->total_amount}}" />
										</td>
										<td>
											<input type="button" class="btn btn-danger btn-sm pay" id="pay_btn_{{$row->member_id}}" value="PAY"/>
										</td>
									</tr>
								@endforeach
								
								<tr>
									<td colspan="7">Total</td>
									<td><input class="form-control total" type="text" id="total" value="" disabled /></td>
									<td>
										<input type="button" value="PAY SELECTED" class="btn btn-success btn-bg pay_selected"/>
									</td>
								</tr>
							</tbody>
						</table>
						
						


<script>
	$("input").keyup( function() {
		calc_total();
	});
	
	calc_total();
	function calc_total()
	{
		var total = 0;
		
		$(".pay_amt").each(function() {
			
			var member_id = (this.id).substr(8);
			var id = "#select_id_" + member_id;
			var status = $(id).is(":checked");
			
			if(status) {
				val = parseInt($(this).val());
			} else {
				val = 0;
			}
			if(isNaN(val))
				val = 0;
			total += val;
			$("#total").val(total);
		});
	}
</script>

<script>
	$("#select_all").click(function() {
		var status = this.checked;
			$("[id^='select_id_']").each(function() {
				this.checked = status;
			});
		calc_total();
		return true;
	});
	
	$("[id^='select_id_']").click(function() {
		calc_total();
	});
</script>

<script>
	$(".pay").click(function() {
		var member_id = ($(this).attr("id")).substr(8);
//		console.log("member_id="+member_id);
		var amount = parseInt($("#pay_amt_"+member_id).val());
		if(isNaN(amount))
			amount = 0;
		console.log("amount="+amount);
		
		var member_no = $("#mem_no_of_"+member_id).html();
		var name = $("#name_of_"+member_id).html();
		var div_amt = $("#div_amt_of_"+member_id).html();
		var pay_amt = amount;
		
		$.ajax({
			url:"pay_individual_divident_view",
			type:"post",
			data:	"&member_id="+member_id
					+"&member_no="+member_no
					+"&name="+name
					+"&div_amt="+div_amt
					+"&pay_amt="+pay_amt,
			success: function(data) {
				$("#table_data").html(data);
			}
		});
		
		
		/*$.ajax({
			url:"pay_individual_divident",
			type:"post",
			data:"&amount="+amount+"&member_id="+member_id,
			success: function(data) {
				alert("success");
				console.log("success");
			}
			
		});*/
	});
	
	$(".pay_selected").click(function() {
		var first_time = true;
		var member_id = "";
		var member_ids = "";
		var amount = "";
		var amounts = "";
		
		$("[id^='pay_amt_']").each(function() {
			member_id = $(this).attr("id").substr(8);
			amount = parseInt($("#pay_amt_"+member_id).val());
			if(isNaN(amount))
				amount = 0;
			var id = "#select_id_" + member_id;
			var status = $(id).is(":checked");
			if(status) {
				if(first_time) {
					member_ids += member_id;
					amounts += amount;
					first_time = false;
				}
				else{
					member_ids += "#" + member_id;
					amounts += "#" + amount;
				}
			}
		});
		
//		console.log(member_ids);
//		console.log(amounts);

		var total_amount  = $("#total").val();
		var branch_id  = $("#branch_id").val();
		var share_class_id  = $("#share_class_id").val();
		
		if(member_ids == "")
			return;
		
		$.ajax({
			url:"pay_multiple_divident",
			type:"post",
			data:"&amounts="+amounts+"&member_ids="+member_ids+"&total_amount="+total_amount+"&branch_id="+branch_id+"&share_class_id="+share_class_id,
			success: function(data) {
				alert("success");
				console.log("pay_multiple_divident : done");
			}
			
		});
	});
</script>
