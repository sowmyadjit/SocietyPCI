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
                <a class="clickme">Receipt And Payment</a>
            </li>
			</ul>
		</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> Receipt And Payment  Detail</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="createreceipt" class="btn btn-default crtds">Receipt And Payment</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Receipt</th>
						<th>Debit</th>
						<th>Payment</th>
						<th>Credit</th>
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach ($r as $receipt)
						<tr>
							<td class="hidden">{{ $receipt->rid }}</td>
							<td>{{ $receipt->receipt }}</td>
							<td>{{ $receipt->debit }}</td>
							<td>{{ $receipt->payment }}</td>
							<td>{{ $receipt->credit }}</td>
							
						
							
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
		$('.receiptclassid').click();
	});
	
	$('.crtds').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	
	
	
</script>