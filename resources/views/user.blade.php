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
                <a class="clickme" >User</a>
            </li>
        </ul>
		</div>

		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> Users Detail</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
					<div class="alert alert-info">
					<a href="ShowUserCreate" class="btn btn-default crtds">Create User</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>FIRST NAME</th>
						<th>MIDDLE NAME</th>
						<th>LAST NAME</th>
						<!--<th>GENDER</th>-->
						<th>LOGIN NAME</th>
						<th>BRANCH NAME</th>
						<th>DESIGNATION</th>
						<!--<th>EMAIL</th>
						<th>MARITAL STATUS</th>
						<th>OCCUPATION</th>
						<th>AGE</th>
						<th>BIRTH DATE</th>
						<th>ADDRESS</th>
						<th>CITY</th>
						<th>STATE</th>
						<th>PINCODE</th>-->
						<th>MOBILE NUM</th>
						<th>PHONE NUM</th>
						<th>ACTION</th>
						
					</tr>
					</thead>
					
					<tbody>
					
						@foreach ($u as $user)
							<tr>
								<td class="hidden">{{ $user->Uid }}</td>	
								<td><a  href="userdetails/{{ $user->Uid }}" class="usrdet">{{ $user->FirstName }}</a></td>
								<td>{{ $user->MiddleName }}</td>
								<td>{{ $user->LastName }}</td>
								<!--<td>{{ $user->Gender }}</td>-->
								<td>{{ $user->LoginName }}</td>
								<td>{{ $user->BName }}</td>
								<td>{{ $user->DName }}</td>
								<!--<td>{{ $user->Email }}</td>
								<td>{{ $user->MaritalStatus }}</td>
								<td>{{ $user->Occupation }}</td>
								<td>{{ $user->Age }}</td>
								<td>{{ $user->Birthdate }}</td>
								<td>{{ $user->Address }}</td>
								<td>{{ $user->City }}</td>
								<td>{{ $user->State }}</td>
								<td>{{ $user->Pincode }}</td>-->
								<td>{{ $user->MobileNo }}</td>
								<td>{{ $user->PhoneNo }}</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="userdetails/{{ $user->Uid }}/edit"/>
										</div>
									</div>
								</td>
				            </tr>
						@endforeach
					
					</tbody>
					
					</table>
					
					 
					
					
					</div>
					<div id='pagei'>
				{!! $u->render() !!}
				</div>
				</div>
			</div>
		</div>
</div>


<script>

	$('.clickme').click(function(e){
		//alert('hi');
		$('.userclassid').click();
	});
	
	

	$('.crtds').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.usrdet').click(function(e){
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