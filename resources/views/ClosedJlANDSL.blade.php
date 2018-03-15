
<div  id="toprint">
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="content">
		
		<thead>
			<tr>
				<th>Type</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Account Number</th>
				<th>LoanAmount</th>
				<th>Loan Charge</th>
				<th>Pending Amount</th>
				<th>Last Paid date</th>
				
				
			</tr>
		</thead>
	
		<tbody>
		@if($view['types1']==1)
			@foreach($view['fontdata'] as $fonts)
			<tr>
				<td>{{$fonts->Loan_Type}}</td>
				<td>{{$fonts->StartDate}}</td>
				<td>{{$fonts->EndDate}}</td>
				<td><a href="#" onclick="personalLoan({{$fonts->Loan_Type}})">{{$fonts->StfLoan_Number}}</a></td>
				<td>{{$fonts->LoanAmt}}</td>
				<td>{{$fonts->EMI_Amount}}</td>
				<td>{{$fonts->StaffLoan_LoanRemainingAmount	}}</td>
				<td>{{$fonts->LastPaidDate}}</td>
			</tr>
			@endforeach
	    @else
			@foreach($view['fontdata'] as $fonts)
			<tr>
				<td>{{$fonts->JewelLoan_LoanTypeId}}</td>
				<td>{{$fonts->JewelLoan_StartDate}}</td>
				<td>{{$fonts->JewelLoan_EndDate}}</td>
				<td><a href="#" onclick="personalLoan({{$fonts->JewelLoan_LoanTypeId}})">{{$fonts->JewelLoan_LoanNumber}}</a></td>
				<td>{{$fonts->JewelLoan_LoanAmount}}</td>
				<td>{{$fonts->partpayment_amount}}</td>
				<td>{{$fonts->JewelLoan_LoanRemainingAmount	}}</td>
				<td>{{$fonts->JewelLoan_lastpaiddate}}</td>
			</tr>
			@endforeach
		@endif
	
	
			
		</tbody>
	</table>


<div id='pagei'>
	{!!$view['fontdata']->appends(Input::except('page'))->render()!!}
</div>
</div>
</div>
</div>
</div>
<script>
	
	$("#pagei > ul.pagination li a").each(function() {
		$(this).addClass("loadmc");
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		$('#toprint').load($(this).attr('href'));
	});
	function DepositLoan(a)
	{
		 alert(a);
	}
	
	function personalLoan(b)
	{
		 alert(b);
	}
</script>	