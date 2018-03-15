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
						<h2><i class="glyphicon glyphicon-globe"></i> Deposit DETAIL</h2>

						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
   
						<div class="alert alert-info">
						<a href="depodetail" class="btn btn-default crtds">Deposit To Bank</a>
						
						<a href="depodetailbranch" class="btn btn-default crtds">Bank To Branch</a>
						</div>
						
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
							<th>Date</th>
							<th>Bank Name</th>
							<th>Amount</th>							
							<th>Society Branch</th>							
							<th>perticulars</th>
						</tr>
					</thead>
					
					<tbody>
						
						@foreach ($depo as $deposit)
						<tr>
							<td class="hidden">{{ $deposit->d_id }}</td>
							<td>{{ $deposit->d_date }}</td>
							<td>{{ $deposit->depo_bank }}</td>
							<td>{{ $deposit->amount }}</td>
							<td>{{ $deposit->Branch }}</td>
							<td>{{ $deposit->reason }}</td>
							
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
			$('.depositclassid').click();
		});
		
	  $('.crtds').click(function(e){
			e.preventDefault();
			$('.box-inner').load($(this).attr('href'));
		});
	</script>