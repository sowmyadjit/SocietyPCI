<script src="js/bootstrap-typeahead.js"/>
<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> User Details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
			<div class="box-content">
			{!! Form::open(['url' => 'updateuser','class' => 'form-horizontal','id' => 'form_userupdate','method'=>'post']) !!}
				
				
						<?php // print_r($ud);
						$edit=$ud['type'];?>
							
						@foreach ($ud['user'] as $user)
				
					<div class="col-md-6">
						<div class="row">
						
							 	<div class="hidden">{{ $user->Uid }}</div>
								<div class="hidden">{{ $user->Aid }}</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4" for="fname">FIRST NAME:</label>
									<div class="col-md-8">
			<input type="text" class="form-control" name="fname" id="fname" value="{{ $user->FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
							
								<div class="form-group">
									<label class="control-label col-sm-4" for="first_name">MIDDLE NAME:</label>
									<div class="col-md-8">
			<input type="text" class="form-control" name="mname" id="mname" value="{{ $user->MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<div class="form-group">
									<label class="control-label col-sm-4" for="first_name">LAST NAME:</label>
									<div class="col-md-8">
			<input type="text" class="form-control" name="lname" id="lname" value="{{ $user->LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
					
							
								<div class="form-group">
									<label class="control-label col-sm-4" for="first_name">LOGIN NAME:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="logname" id="logname" value="" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<div class="form-group">
									<label class="control-label col-sm-4" for="branch">BRANCH NAME:</label>
									<div class="col-md-8">
								<input type="text" class="form-control typeahead" value="{{ $user->BName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4" for="branch">DESIGNATION:</label>
									<div class="col-md-8">
								<input type="text" class="form-control typedesig" value="{{ $user->DName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
								<div class="form-group">
									<label class="control-label col-sm-4" for="email">EMAIL ADDRESS:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="email" id="email" value="{{ $user->Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<!--<div class="form-group">
									<label class="control-label col-sm-4">GENDER:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="gender" id="gender" value="{{ $user->Gender }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>-->
								<div class="form-group">
									<label class="control-label col-sm-4">GENDER:</label>
										<div class="col-sm-8">
											<select id="gender" name="gender" class="form-control" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $user->Gender }}" selected>{{ $user->Gender }} </option>
												<option value="MALE">MALE</option>
												<option value="FEMALE">FEMALE</option>
											</select>
										</div>
								</div>
								
					
							
								<!--<div class="form-group">
								<label class="control-label col-sm-4">MARITAL STATUS:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="ms" id="ms" width="" value="{{ $user->MaritalStatus }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>-->
								<div class="form-group">
									<label class="control-label col-sm-4">MARITAL STATUS:</label>
										<div class="col-sm-8">
											<select id="ms" name="ms" class="form-control" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
												<option value="{{ $user->MaritalStatus }}" selected>{{ $user->MaritalStatus }}</option>
												<option value="MARRIED">MARRIED</option>
												<option value="UNMARRIED">UNMARRIED</option>
											</select>
										</div>
								</div>
								
							
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">OCCUPATION:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="oc" id="oc" width="" value="{{ $user->Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="row">
					
					
					
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">AGE:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="age" id="age" width="" value="{{ $user->Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<div class="form-group">
								<label class="col-sm-4 control-label">BIRTH DATE</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="bd" id="bd" width="" value="{{ $user->Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">FATHER NAME:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="mn" id="mn" width="" value="{{ $user->FatherName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">MOBILE NUMBER:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="mn" id="mn" width="" value="{{ $user->MobileNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">PHONE:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="phone" id="phone" width="" value="{{ $user->PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
						
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="address">ADDRESS:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="address" id="address" width="" value="{{ $user->Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">CITY:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="city" id="city" width="" value="{{ $user->City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
								
								
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">DISTRICT:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="dist" id="dist" width="" value="{{ $user->District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
							
						
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">STATE:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="state" id="state" width="" value="{{ $user->State }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
					
							
								<div class="form-group">
								<label class="control-label col-sm-4" for="phone">PINCODE:</label>
									<div class="col-md-8">
								<input type="text" class="form-control" name="pc" id="pc" width="" value="{{ $user->Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
								</div>
								</div>
								
							
					@endforeach
					
						</div>
					</div>
						
				
				
						<center>
    					<div class="form-group">
							
							<div class="col-sm-12">
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="UPDATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="<?php if($edit=='edit'){echo 'hidden';} else {echo 'button';} ?>" value="CLOSE" class="btn btn-danger btn-sm clsbtn"/>
							</div>
						</div>
						
						</center>
					{!! Form::close() !!}
				
			</div>
			
				</div>
			</div>
</div>
</div>

<script src="js/bootstrap-typeahead.js"/>
<script>
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.userclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.clsbtn').click(function(e){
		$('.userclassid').click();
	});	
	
	$('.sbmbtn').click( function(e) {
		
		branchid=$('ul.typeahead li.active').data('value');
		a=$('ul.typeahead li.active').data('value');
		branchid=a;
		des=$('.typedesig').data('value');
		desig=des;
		//alert(a);
		e.preventDefault();
		uid={{ $user->Uid }};
		aid={{ $user->Aid }};
		//alert(addid);
		
		
		$.ajax({
				url: 'updateuser',
				type: 'post',
				data: $('#form_userupdate').serialize() + '&branchid=' + a + '&uid=' + uid + '&aid=' + aid + '&desig=' + des,
				success: function(data) {
						 //alert('success');
						 $('.userclassid').click();
                }
		}); 
	});

	$('.clickme').click(function(e){
		//alert('hi');
		$('.userclassid').click();
	});
	
	$('input.typeahead').typeahead({
		ajax: '/GetBranches'
	});
	
	$('input.typedesig').typeahead({
      ajax: '/GetDesignation'
	});
	
	
</script>