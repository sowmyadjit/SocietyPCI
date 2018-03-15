
<script src="js/bootstrap-typeahead.js"></script>
<div class="row">
	<div class="box col-md-9">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i> STAFF ALLOCATION DETAIL</h2>
				
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
					<a href="staffloan_home" class="btn btn-default crtlal">LOAN ALLOCATION</a>
					<div class="col-md-5 pull-right">
						<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH DL ACCOUNT">
						
						
					</div>
					
					</div>
					
				<div class="SearchRes">	
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th>Loan Number</th>
								<th>Name</th>
								<th>Loan Amount</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>EMI</th>
								<th>CD</th>
								<th>CD</th>
								<th>Pending Amount</th>
								<th>Last Paid Date</th>
							</tr>
						</thead>
						<tbody>
							
							
								@foreach ($staff as $loan_allocation)
								<tr>
									
									<td>{{ $loan_allocation->StfLoan_Number }}/{{ $loan_allocation->old_saffloan_no }}</td>
									<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
									
									<td>{{ $loan_allocation->LoanAmt}}</td>
									<td>{{ $loan_allocation->StartDate}}</td>
									<td>{{$loan_allocation->EndDate}}</td>
									<td>{{$loan_allocation->EMI_Amount}}</td>
									<td>{{$loan_allocation->AjustmentCharges}}</td>
									<td>{{$loan_allocation->ShareCharges}}</td>
									<td>{{$loan_allocation->StaffLoan_LoanRemainingAmount}}</td>
									<td>{{$loan_allocation->LastPaidDate}}</td>
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
		
		$('#hee').hide();
		
		$('#ExportType').change( function(e) {
			type=$('#ExportType').val();
			
			if(type=="word")
			{
				
				$('#CustList').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
			}
			else if(type=="excel")
			{
				$('#CustList').tableExport({type:'excel',escape:'false'});
			}
			else if(type=="pdf")
			{
				//alert("Please Select Type For Export");
				$('#CustList').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
				
			}
			
		});
		
		
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
			ajax: '/getslaccsearch'
		});
		$('.SearchTypeahead').change(function(e){
			searchvalue=$('#SearchFd').attr('data-value');
			
			e.preventDefault();
			$.ajax({
				url:'/slsearchacc',
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
		
		
		$("#pagei > ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc");
			
		});
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			
			$('#content').load($(this).attr('href'));
		});
	</script>																																							