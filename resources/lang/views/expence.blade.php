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
			<li> <a class="clickme" >bank</a> </li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Expense DETAIL</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<!--<a href="expencedetail" class="btn btn-default crtds">expense</a>-->
						<a href="expenceBranch" class="btn btn-default crtds">Branch TO Branch</a>
						<a href="expencetran" class="btn btn-default crtds">Bank TO Bank transfer</a>
						<a href="createexp" class="btn btn-default crtds">Expense</a>
					</div>
					
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Date</th>
								
								<th>Expence For</th>
								<th>Amount</th>							
								<th>Particulars</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($ex as $expence)
							<tr>
								<td class="hidden">{{ $expence->id }}</td>
								<td>{{ $expence->e_date }}</td>
								
								<td>{{ $expence->lname }}</td>
								<td>{{ $expence->amount }}</td>
								<td>{{ $expence->Particulars }}</td>
								<td>
									
									<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="ExReceipt/{{ $expence->id }}"/>
									
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

<script>
	$('.clickme').click(function(e){
		$('.expenceclassid').click();
	});
	
	$('.crtds').click(function(e){
		e.preventDefault();
		$('.box-inner').load($(this).attr('href'));
	});
	$('.ReceiptPrint').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
</script>