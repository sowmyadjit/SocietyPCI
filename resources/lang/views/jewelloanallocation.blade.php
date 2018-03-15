
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
						<a href="jewelLoan" class="btn btn-default crtlal">LOAN ALLOCATION</a>
						<div class="col-md-5 pull-right">
							<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH jewel ACCOUNT">
							
							
						</div>
					</div>
					<div class="SearchRes">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
									<th>Jewel Description</th>
									<th>Jewel Last Paid Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									@foreach ($jewelLoan as $loan_allocation)
									<tr>
										<td class="hidden">{{ $loan_allocation->JewelLoanId }}</td>
										<td class="hidden">{{ $loan_allocation->JewelLoan_Uid }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td><a  href="userdetailscust/{{ $loan_allocation->JewelLoan_Uid }}" class="custdet">{{ $loan_allocation->JewelLoan_LoanNumber }}/{{ $loan_allocation->jewelloan_Oldloan_No }}</a></td>	
										
										<td>{{ $loan_allocation->JewelLoan_LoanAmount}}</td>
										<td>{{ $loan_allocation->JewelLoan_StartDate}}</td>
										<td>{{$loan_allocation->JewelLoan_EndDate}}</td>
										<td>{{$loan_allocation->JewelLoan_LoanRemainingAmount}}</td>
										<td>{{$loan_allocation->jewelloan_Description}}</td><td>{{$loan_allocation->JewelLoan_lastpaiddate}}</td>
										<td>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="jlloanrecepit/{{ $loan_allocation->JewelLoanId }}"/>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						
						<div id='pagei'>
							{!! $jewelLoan->render() !!}
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
			});
			$('.custdet').click(function(e)
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
				ajax: '/getjlaccsearch'
			});
			
			$('.SearchTypeahead').change(function(e){
				searchvalue=$('#SearchFd').data('value');
				
				e.preventDefault();
				$.ajax({
					url:'/jlsearchacc',
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