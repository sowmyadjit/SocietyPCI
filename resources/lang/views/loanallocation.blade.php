
<script src="js/bootstrap-typeahead.js"></script>
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
                <a class="clickme" >LOAN ALLOCATION DETAIL</a>
            </li>
        </ul>
    </div>
  <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> LOAN ALLOCATION DETAIL</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
   <!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
  <div class="alert alert-info">

 <!-- <a href="crtloanallocation" class="btn btn-default crtlal">LOAN ALLOCATION</a>-->
   <a href="crtloanalloc" class="btn btn-default crtlal">LOAN ALLOCATION</a>
   <div class="col-md-5 pull-right">
							<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH DL ACCOUNT">
							
							
						</div>
   </div>
   <div class="SearchRes">
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
	 
	 <div id='pagei'>
				{!! $loanalc->render() !!}
				</div>
				</div>
				</div>
				</div>
				</div>
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