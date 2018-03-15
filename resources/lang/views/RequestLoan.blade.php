        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

          </div>
        </noscript>

<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a class="clickme" >REQUEST FOR LOAN</a>
            </li>
        </ul>
    </div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>REQUEST FOR LOAN</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="ReqPersonalLoan" class="btn btn-default salcrt">REQUEST FOR LOAN</a>
					</div>
				
				
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
					<thead>
					
						<tr>
						
						<th>Full Name</th>
						
						<th>Request Loan Amount</th>
						<th>Loan duration</th>
						<th>Request Date</th>
						<th>Amount decided By Board</th>
						<th>Loan Category</th>
						<th>Deposit Loan Account Number</th>
						<th>Payable Amount</th>
						<th>Authorisation Status</th>
						<th>Action</th>
						
						
						</tr>
						
					</thead>
					
					<tbody>

					
						@foreach ($rl as $reqloan)
						<tr>
						
							<td class="hidden">{{ $reqloan->PersLoanAllocID }}</td>
							<td>{{$reqloan->FirstName}}.{{$reqloan->MiddleName}}.{{$reqloan->LastName}}</td>
							<td>{{$reqloan->Requested_LoanAmt}}</td>
							<td>{{$reqloan->LoandurationYears}}</td>
							<td>{{$reqloan->Request_Date}}</td>
							<td>{{$reqloan->AmountDecideBy_Board}}</td>
							<td>{{$reqloan->Loan_Category}}</td>
							<td>{{$reqloan->DepLoan_AccNo}}</td>
							<td>{{$reqloan->Payable_Amount}}</td>
							<td>{{$reqloan->Auth_Status}}</td>
					
							 
						</tr>

						@endforeach

					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
</div>


<script>
	  
	$('.clickme').click(function(e)
	{
		$('.Reqploanclassid').click();
	}); 
	
	$('.salcrt').click(function(e)
	{
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
	});
	

</script>