<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div  id="toprint<?php// echo $loanjewel['module']->Mid; ?>">
				<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
								<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
								<!--this css should be inside the toprint div , for printing the table borders-->    
					
					<table class="table-striped table-bordered bootstrap-datatable datatable responsive" id="jewel_auction">
						
						<thead>
							<tr>
<?php /*								<th><input id="select_all" type="checkbox" /></th>*/?>
								<th>NAME</th>
								<th>LOAN Number</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Description</th>
								<th>Gross Weight</th>
								<th>Net Weight</th>
								<th>Appraisal Value</th>
								<th>LoanAmount</th>
								<th>Remaining Amount</th>
								<th>Interest Amount</th>
								<th>Auction Amount</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $jew)
							<tr>
<?php /*								<td><input class="chkboxs" id="{{$jew->JewelLoanId}}" type="checkbox" /></td>*/?>
								<td id="name_{{$jew->JewelLoanId}}">{{ $jew->FirstName }} {{$jew->LastName}}</td>
								<td id="ln_no_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_LoanNumber }}</td>
								<td id="st_date_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_StartDate }}</td>
								<td id="end_date_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_EndDate }}</td>
								<td id="desc_{{$jew->JewelLoanId}}">{{ $jew->jewelloan_Description }}</td>
								<td id="gross_wt_{{$jew->JewelLoanId}}">{{ $jew->GrossWeight }}</td>
								<td id="net_wt_{{$jew->JewelLoanId}}">{{ $jew->NetWeight }}</td>
								<td id="app_val_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_AppraisalValue }}</td>
								<td id="ln_amt_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_LoanAmount }}</td>
								<td id="rem_amt_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_LoanRemainingAmount }}</td>
								<td><input class="form-control" id="interest_{{$jew->JewelLoanId}}" type="text" /></td>
								<td><input class="form-control" id="amount_{{$jew->JewelLoanId}}" type="text" /></td>
								<td><input class="btn btn-info btn-sm" id="auction_bt_{{$jew->JewelLoanId}}" type="button" value="Auction"  data-toggle="modallll" data-target="#myModallll"/></td>
							</tr>
							@endforeach
							<tr>
							<!--	<input class="btn btn-info btn-sm" id="auction_all" type="button" value="Auction all" />-->
							</tr>
						</tbody>
					</table>
					<div id='pagei'>
						{!! $data->appends(Input::except('page'))->render() !!}
					</div>
					
					

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Auction</h4>
      </div>
	  
	  
      <div class="modal-body"><center>
		<div>
			<label>
				<p>Buyer Details</p>
				<input type='text' name="info" />
			</label>
		</div>
		<div>
			<label>
				<p>Amount Paid</p>
				<input id="amt" type='text' name="amt" disabled />
			</label>
		</div>
		<div>
			<label><p>Pay Mode</p>
				<select id="pay_mode" name="pay_mode" >
					<option value="CASH">CASH</option>
					<option value="SB">SB</option>
				</select>
			</label>
		</div>
		<div>
			<label class="cheque"><p>Bank Name</p>
				<select name="bank_name">
					<option value="bank_name">bank_name</option>
					<option value="bank_name">bank_name</option>
					<option value="bank_name">bank_name</option>
				</select>
			</label>
		</div>
		<div>
			<label class="cheque"><p>Cheque No.</p>
				<input type='text' name="cheque_no" />
			</label>
		</div>
		<div>
			<label class="cheque"><p>Cheque Date</p>
				<input type='text' name="cheque_date" />
			</label>
		</div>
		<div>
			<label class="sb"><p>Bank Name</p>
				<select name="sb_bank_name">
					<option value="sb_bank_name">sb_bank_name</option>
					<option value="sb_bank_name">sb_bank_name</option>
					<option value="sb_bank_name">sb_bank_name</option>
				</select>
			</label>
		</div>
		<div>
			<label class="sb"><p>Acc No.</p>
				<input type='text' name="acc_no" />
			</label>
		</div>
      </div>
	  </center>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

					</div>
				</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


<div id='aa'>
</div>



<script>
	$(document).ready(function(){
		$("#select_all").click(function(){
			if($('#select_all').prop('checked')) {
				$(".chkboxs").prop('checked', true);
			} else {
				$(".chkboxs").prop('checked', false);
			}
		});
		
		
/*		$("#auction_all").click(function(){
			
			var val="";
			var amt_id="";
			$('.chkboxs').each(function(){
				if($(this).prop('checked')) {
					var id=$(this).attr('id');
					var amt = $('#amount_'+id).val();
					if(amt != "") {
						if(val == "")
							val += $(this).attr('id') + " " + amt;
						else
						val = val + "," + $(this).attr('id') + " " + amt;
					}
				}
			});
			alert(val);
			if(val != "") {
				$.ajax({
							url:'/jewelAuction',
							type:'get',
							data:'&val='+val,
							success:function(data)
							{
								alert("success");
								$('#aa').html(data);
								
							}
						});
			}
		});*/
		
		
		$("[id^='auction_bt_']").click(function() {
				var id, jl_alloc_id, amt, val,name,ln_no,st_date,end_date,gross_wt,net_wt,app_val,ln_amt,rem_amt,auc_amt,rem_int;
				id=$(this).attr('id');
				jl_alloc_id = id.substr(11);
				auc_amt = amt = $('#amount_'+jl_alloc_id).val();
				rem_amt = $('#rem_amt_'+jl_alloc_id).html();
				rem_int = $('#interest_'+jl_alloc_id).val();
				$("#amt").val(amt);
				cname = $("#name_"+jl_alloc_id).html();
				ln_no = $("#ln_no_"+jl_alloc_id).html();
				st_date = $("#st_date_"+jl_alloc_id).html();
				end_date = $("#end_date_"+jl_alloc_id).html();
				gross_wt = $("#gross_wt_"+jl_alloc_id).html();
				net_wt = $("#net_wt_"+jl_alloc_id).html();
				app_val = $("#app_val_"+jl_alloc_id).html();
				ln_amt = $("#ln_amt_"+jl_alloc_id).html();
				
				
				
		/*		val = jl_alloc_id + " " + amt;*/
		//		alert(amt);
				
				
				
				
/*				cname = $("#name").html();
				ln_no = $("#ln_no").html();
				st_date = $("#st_date").html();
				end_date = $("#end_date").html();
				gross_wt = $("#gross_wt").html();
				net_wt = $("#net_wt").html();
				app_val = $("#app_val").html();
				ln_amt = $("#ln_amt").html();*/
//				rem_amt = $("#rem_amt").html();
//				rem_int = interest;
//				auc_amt = amt;
				
				$.ajax({
							url:'/jewelAuctionPay',
							type:'get',
							data:'&jl_alloc_id='+jl_alloc_id+'&cname='+cname+'&ln_no='+ln_no+'&st_date='+st_date+'&end_date='+end_date+'&gross_wt='+gross_wt+'&net_wt='+net_wt+'&ln_amt='+ln_amt+'&rem_amt='+rem_amt+'&auc_amt='+auc_amt+'&rem_int='+rem_int,
							success:function(data)
							{
								alert("success");
								$('#content').html(data);
								
							}
						});
				
			}
		);
		
		
		
		$("#pagei > ul.pagination li a").each(function() {
			$(this).addClass("loadmc");
		});
	
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			$('#content').load($(this).attr('href'));
		});
		
		
	});
</script>


