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
						<li> <a class="clickme" >FD TYPE</a> </li>
					</ul>
				</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i> FD Detail</h2>

						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
   
						<div class="alert alert-info">
						<a href="fdtypedetail" class="btn btn-default crtds">Create FD TYPE</a>
						</div>
						
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
							<th>FD Type</th>
							<th>FD Years</th>
							<th>FD Days</th>
							<th>FD Interest</th>
						</tr>
					</thead>
					
					<tbody>
						
						@foreach ($fd as $fdtype)
						<tr>
							<td class="hidden">{{ $fdtype->FdTid }}</td>
							<td>{{ $fdtype->FdType }}</td>
							<td>{{ $fdtype->NumberOfYears }}</td>
							<td>{{ $fdtype->NumberOfDays }}</td>
							<td>{{ $fdtype->FdInterest }}</td>
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
			$('.acctypclassid').click();
		});
		
	  $('.crtds').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		
	</script>