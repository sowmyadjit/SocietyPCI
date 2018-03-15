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
			<li> <a class="clickme" >Add bank</a> </li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Bank DETAIL</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="bankdetail" class="btn btn-default crtds">CREATE Bank</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Bank Name</th>
								<th>Bank Branch</th>
								<th>IFSC</th>
								<th>Account Number</th>
								<th>PCIC Society Branch</th>
								<th>Total Amount</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($bank as $AddBank)
							<tr>
								<td class="hidden">{{ $AddBank->Bankid }}</td>
								<td>{{ $AddBank->BankName }}</td>
								<td>{{ $AddBank->Branch }}</td>
								<td>{{ $AddBank->AddBank_IFSC }}</td>
								<td>{{ $AddBank->AccountNo }}</td>
								<td>{{ $AddBank->SocietyBranch }}</td>
								<td>{{ $AddBank->TotalAmt }}</td>
								
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
	
	
</script>