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
                <a class="clickme" >COMPANY</a>
            </li>
			</ul>
		</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   COMPANY Detail</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="companydetail" class="btn btn-default crtds">Create Company</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Company Name</th>
						<th>Company Initial</th>
						<th>Company Address</th>
						<th>Company City</th>
						<th>Company State</th>
						<th>Company Pincode</th>
						<th>Company PhoneNO</th>
					</tr>
					</thead>
					
					<tbody>
						@foreach ($c as $company)
						<tr>
							<td class="hidden">{{ $company->Cid }}</td>
							<td>{{ $company->Cname }}</td>
							<td>{{ $company->CInitial }}</td>
							<td>{{ $company->CAddress }}</td>
							<td>{{ $company->CCity }}</td>
							<td>{{ $company->CState }}</td>
							<td>{{ $company->CPincode }}</td>
							<td>{{ $company->CPhoneNo }}</td>
						</tr>
						@endforeach
				</div>
				</div>
			</div>
		</div>
	</div>

<script>
	  
	  $('.clickme').click(function(e){
			$('.companyclassid').click();
		}); 
		
	  $('.crtds').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		
</script>