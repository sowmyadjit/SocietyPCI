        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

          </div>
        </noscript>

<div id="content" class="col-lg-12 col-sm-12">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a class="clickme" >EMPLOYEE</a>
            </li>
        </ul>
    </div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>EMPLOYEE</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
			
				
				
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
					<thead>
					
						<tr>
						<th>EMPLOYEE CODE</th>
						<th>FIRST NAME</th>
						<th>MIDDLE NAME</th>
						<th>LAST NAME</th>
						<th>BRANCH NAME</th>
						<th>DESIGNATION</th>
						<th>MOBILE NUMBER</th>
						<th>PHONE NUMBER</th>
						
						<th>Action</th>
						</tr>
						
					</thead>
					
					<tbody>

					
						@foreach ($emp1['UnAuthEmp'] as $employee)
						<tr>
							<td class="hidden">{{ $employee->Eid }}</td>
							<td><a  href="empdetails/{{ $employee->Eid }}" class="empdet">{{$employee->ECode}}</a></td>
							<td><a  href="empdetails/{{ $employee->Eid }}" class="empdet">{{ $employee->FirstName }}</a></td>
							<td>{{ $employee->MiddleName}}</td>
							<td>{{$employee->LastName}}</td>
							<td>{{$employee->BName}}</td>
							<td>{{$employee->DName}}</td>
							<td>{{$employee->MobileNo}}</td>
							<td>{{$employee->PhoneNo}}</td>
							
							
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="empdetails/{{ $employee->Eid }}/edit"/>
										</div>
									</div>
							</td>
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accemp" href="acceptemp/{{ $employee->ECode }}"/>
										</div>
									</div>
								</td>
									<td>
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="REject" class="btn btn-info btn-sm rejbtn" href="rejectemp/{{ $employee->ECode }}"/>
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


<script>
	  
	$('.clickme').click(function(e)
	{
		$('.empclassid').click();
	}); 
	
	$('.accemp').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
	});
	
	$('.rejbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
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

</script>