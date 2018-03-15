<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
		<th>Loan Type</th>
		<th>Loan Number</th>
		<th>Account Number</th>
		<th>Name</th>
       <th>Loan Amount</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Pending Amount</th>
		<th>Action</th>
		</tr>
    </thead>
    <tbody>

  <tr>
       @foreach ($loanalc as $loan_allocation)
        <tr>
             <td class="hidden">{{ $loan_allocation->DepLoanAllocId }}</td>
             <td class="hidden">{{ $loan_allocation->DepLoan_Uid }}</td>
			 <td>{{ $loan_allocation->DepLoan_DepositeType }}</td>
			<td><a  href="userdetailscust/{{ $loan_allocation->DepLoan_Uid }}" class="custdet">{{ $loan_allocation->DepLoan_LoanNum }}/{{ $loan_allocation->Old_loan_number }}</td>
			 <td>{{ $loan_allocation->DepLoan_AccNum }}/{{ $loan_allocation->Old_Accnum }}</td>
             <td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
			
			 <td>{{ $loan_allocation->DepLoan_LoanAmount}}</td>
			  <td>{{ $loan_allocation->DepLoan_LoanStartDate}}</td>
			  <td>{{$loan_allocation->DepLoan_LoanEndDate}}</td>
			  <td>{{$loan_allocation->DepLoan_RemailningAmt}}</td>
			  <td>
			  	<div class="form-group">
										<div class="col-sm-12">
						<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="dlloanrecepit/{{ $loan_allocation->DepLoanAllocId }}"/>
										</div>
									</div>
				</td>
        </tr>
     @endforeach
	 </tbody>
	 </table>
	 <script>
	  $('.clickme').click(function(e)
{
	$('.pigmiallocclassid').click();
});
$('.crtlal').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box-inner').load($(this).attr('href'));
});
$('.edtbtn').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box-inner').load($(this).attr('href'));
});$('.custdet').click(function(e)
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

$('input.SearchTypeahead').typeahead({
				ajax: '/getdlacc'
			});
$('.SearchTypeahead').change(function(e){
				searchvalue=$('#SearchFd').data('value');
				
				e.preventDefault();
				$.ajax({
					url:'/dlsearchacc',
					type:'get',
					data:'&SearchAccId='+searchvalue,
					success:function(data)
					{
						//alert("success");
						$('#SearchFd').val("");
						$('.SearchRes').html(data);
						//
						//$('#SearchFd').data("");
						
					}
				});
			});
 </script>