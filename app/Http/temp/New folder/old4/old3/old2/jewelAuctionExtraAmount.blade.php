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
								<th>NAME</th>
								<th>LOAN Number</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Description</th>
								<th>Gross Weight</th>
								<th>Net Weight</th>
								<th>LoanAmount</th>
								<th>Auction Amount</th>
								<th>Extra Amount</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $jew)
							<tr>
								<td id="cname_{{$jew->JewelLoanId}}">{{ $jew->FirstName }} {{$jew->LastName}}</td>
								<td id="ln_no_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_LoanNumber }}</td>
								<td id="st_date_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_StartDate }}</td>
								<td id="end_date_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_EndDate }}</td>
								<td id="desc_{{$jew->JewelLoanId}}">{{ $jew->jewelloan_Description }}</td>
								<td id="gross_wt_{{$jew->JewelLoanId}}">{{ $jew->GrossWeight }}</td>
								<td id="net_wt_{{$jew->JewelLoanId}}">{{ $jew->NetWeight }}</td>
								<td id="ln_amt_{{$jew->JewelLoanId}}">{{ $jew->JewelLoan_LoanAmount }}</td>
								<td id="auc_amt_{{$jew->JewelLoanId}}">{{ $jew->jewel_auction_amount }}</td>
								<td id="extra_amt_{{$jew->JewelLoanId}}">{{ $jew->extra_amount }}</td>
								<td><input class="btn btn-info btn-sm" id="pay_{{$jew->JewelLoanId}}" type="button" value="Pay" /></td>
							</tr>
							@endforeach
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
		
		$("[id^='pay_']").click(function() {
				var id, jl_alloc_id, amt, val,name,ln_no,st_date,end_date,gross_wt,net_wt,ln_amt,rem_amt,auc_amt;
				id=$(this).attr('id');
				jl_alloc_id = id.substr(4);		alert("jl_alloc_id="+jl_alloc_id);
				cname = $("#cname_"+jl_alloc_id).html();
				ln_no = $("#ln_no_"+jl_alloc_id).html();
				st_date = $("#st_date_"+jl_alloc_id).html();
				end_date = $("#end_date_"+jl_alloc_id).html();
				gross_wt = $("#gross_wt_"+jl_alloc_id).html();
				net_wt = $("#net_wt_"+jl_alloc_id).html();
				ln_amt = $("#ln_amt_"+jl_alloc_id).html();
				auc_amt = $("#auc_amt_"+jl_alloc_id).html();
				extra_amt = $("#extra_amt_"+jl_alloc_id).html();
				
				$.ajax({
							url:'/jewelAuctionExtraAmountPayDetails',
							type:'get',
							data:'&jl_alloc_id='+jl_alloc_id+'&cname='+cname+'&ln_no='+ln_no+'&st_date='+st_date+'&end_date='+end_date+'&gross_wt='+gross_wt+'&net_wt='+net_wt+'&ln_amt='+ln_amt+'&auc_amt='+auc_amt+'&extra_amt='+extra_amt,
							success:function(data)
							{
								alert("success");
								$('#content').html(data);
								
							}
						});
				
			}
		);
		
	});
</script>


