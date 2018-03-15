
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
				<th></th>
				
			</tr>
		</thead>
	@if($view['types']==1)
		<tbody>
			@foreach($view['fontdata'] as $fonts)
			<tr>
				<td>{{$fonts->LoanType_Name}}</td>
				<td>{{$fonts->StartDate}}</td>
				<td>{{$fonts->EndDate}}</td>
				<td><a href="#" onclick="personalLoan({{$fonts->LoanType_ID}})">{{$fonts->PersLoan_Number}}</a></td>
				<td>{{$fonts->LoanAmt}}</td>
				<td>{{$fonts->RemainingInterest_Amt}}</td>
				<td>{{$fonts->RemainingLoan_Amt}}</td>
				<td>{{$fonts->caldate}}</td>
				
			</tr>
			@endforeach
	 @else
		@foreach($view['fontdata'] as $fonts)
			<tr>
				<td>{{$fonts->LoanType_Name}}</td>
				<td>{{$fonts->DepLoan_LoanStartDate}}</td>
				<td>{{$fonts->DepLoan_LoanEndDate}}</td>
				<td><a href="#" onclick="DepositLoan({{$fonts->DepLoan_LoanTypeID}})">{{$fonts->DepLoan_LoanNum}}</a></td>
				<td>{{$fonts->DepLoan_LoanAmount}}</td>
				<td>{{$fonts->DepLoan_LoanCharge}}</td>
				<td>{{$fonts->DepLoan_RemailninginterestAmt}}</td>
				<td>{{$fonts->DepLoan_lastpaiddate}}</td>
				
				
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