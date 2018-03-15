<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>


<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li> <a href="#">Home</a> </li>
			<li> <a class="clickme" >Extra Amount</a> </li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Amount DETAIL</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Date</th>
								<th>Agent Name</th>
								<th>Branch</th>
								<th>Account Number</th>
								<th>Amount</th>
								<th>Action</th>
								
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($amtdetails as $amt)
							<tr>
								<td class="hidden">{{ $amt->ExtraAmt_Id }}</td>
								<td>{{ $amt->ExtraAmt_Date }}</td>
								<td>{{ $amt->FirstName }}.{{ $amt->MiddleName }}.{{ $amt->LastName }}</td>
								<td>{{ $amt->BName }}</td>
								<td>{{ $amt->ExtraAmt_AccountNum }}</td>
								<td>{{ $amt->ExtraAmt_Amount }}</td>
							<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="PAY BACK" class="btn btn-info btn-sm edtbtn" href="paybackamt/{{ $amt->ExtraAmt_Id }}"/>
											</div>
										</div>
									</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div> 
			</div>
		</div>
	</div>
</div>
<script src="js/jquery.min.js"></script>
<script>
	$('.clickme').click(function(e){
		$('.bankclassid').click();
	});
	
	$('.crtds').click(function(e){
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
		
	});
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
</script>