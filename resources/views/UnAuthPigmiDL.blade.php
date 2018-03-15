

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

          </div>
        </noscript>

        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a class="clickme" >UNAUTORISED PIGMY DL DETAIL</a>
            </li>
        </ul>
    </div>
  <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i>UNAUTORISED PIGMY DL DETAIL</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
   <!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
  
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
		<th>Loan Type</th>
		<th>Name</th>
        <th>Branch Name</th>
		<th>Loan Amount</th>
		<th>Loan Charge</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Action</th>
		</tr>
    </thead>
    <tbody>

  <tr>
       @foreach ($pigmydl as $depositeloan_allocation)
        <tr>
             <td class="hidden">{{ $depositeloan_allocation->DepLoanAllocId }}</td>
			 <td>{{ $depositeloan_allocation->LoanType_Name }}</td>
             <td>{{ $depositeloan_allocation->FirstName }}</td>	
			 <td>{{$depositeloan_allocation->BName}}
			 <td>{{ $depositeloan_allocation->DepLoan_LoanAmount}}</td>
			  <td>{{ $depositeloan_allocation->DepLoan_LoanCharge}}</td>
			  <td>{{ $depositeloan_allocation->DepLoan_LoanStartDate}}</td>
			  <td>{{$depositeloan_allocation->DepLoan_LoanEndDate}}</td>
			  <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accbtn" href="acceptunauthpigmydl/{{ $depositeloan_allocation->DepLoanAllocId }}"/>
										</div>
									</div>
								</td>
									<td>
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="REject" class="btn btn-info btn-sm rejbtn" href="rejectunauthpigmydl/{{ $depositeloan_allocation->DepLoanAllocId }}"/>
										</div>
									</div>
									</td>
        </tr>
     @endforeach
	 
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
$('.accbtn').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
});
$('.rejbtn').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
});
 </script>