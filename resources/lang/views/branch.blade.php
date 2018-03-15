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
                <a class="clickme">Branch</a>
            </li>
			</ul>
		</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> Branch  Detail</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="showcreatebranch" class="btn btn-default crtds">Create Branch</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Company Name</th>
						<th>Branch Name</th>
						<th>Branch Code</th>
						<th>Branch Address</th>
						<th>Branch City</th>
						<th>Branch State</th>
						<th>Branch Phone No</th>
						<th>Branch Mobile No</th>
						<th>Branch Pincode</th>
						<th>Actions</th>
					</tr>
					</thead>
					
					<tbody>
						@foreach ($b as $Branch)
						<tr>
							<td class="hidden">{{ $Branch->Bid }}</td>
							<td>{{ $Branch->Cname }}</td>
							<td>{{ $Branch->BName }}</td>
							<td>{{ $Branch->BCode }}</td>
							<td>{{ $Branch->BAddress }}</td>
							<td>{{ $Branch->BCity }}</td>
							<td>{{ $Branch->BState }}</td>
							<td>{{ $Branch->BPhoneNo }}</td>
							<td>{{ $Branch->BMobileNo }}</td>
							<td>{{ $Branch->BPincode }}</td>
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="branchdetails/{{ $Branch->Bid }}/edit"/>
										</div>
									</div>
								</td>
                        </tr>
			 			@endforeach

					</tbody>
					
					</table>
					
					  


					
					
				</div>
				<div id='pagei'>
				{!! $b->render() !!}
				</div>
				</div>
				
			</div>
		</div>
	</div>

	
<script>

	$('.clickme').click(function(e){
		$('.branchclassid').click();
	});
	
	$('.crtds').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	/*$('document').ready(function(){
	$('#brtbl').datatable();
	});*/
	$("ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc");
  
});
$('.loadmc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('#maincontents').load($(this).attr('href'));
});
</script>