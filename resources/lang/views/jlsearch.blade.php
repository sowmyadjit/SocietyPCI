


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
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									@foreach ($jewelLoan as $loan_allocation)
									<tr>
										<td class="hidden">{{ $loan_allocation->JewelLoanId }}</td>
										<td class="hidden">{{ $loan_allocation->Custid }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td><a  href="customerdetails/{{ $loan_allocation->Custid }}" class="custdet">{{ $loan_allocation->JewelLoan_LoanNumber }}/{{ $loan_allocation->jewelloan_Oldloan_No }}</a></td>	
										
										<td>{{ $loan_allocation->JewelLoan_LoanAmount}}</td>
										<td>{{ $loan_allocation->JewelLoan_StartDate}}</td>
										<td>{{$loan_allocation->JewelLoan_EndDate}}</td>
										<td>{{$loan_allocation->JewelLoan_LoanRemainingAmount}}</td>
										<td>{{$loan_allocation->jewelloan_Description}}</td>
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
						$('.SearchRes').html(data);
						//$('#SearchFd').val("");
						//$('#SearchFd').data("");
						
					}
				});
			});
			
			</script>			