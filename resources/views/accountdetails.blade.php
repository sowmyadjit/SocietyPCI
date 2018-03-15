<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $acd['module']->Mid; ?>" class="col-md-12">
	<div class="row">
		<div class="box_bdy_<?php echo $acd['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $acd['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>Account Details</h2>
					
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "updateacc",'class' => 'form-horizontal','id' => 'form_acc','method'=>'post']) !!}
					
					
					<?php $edit=$acd['type'];?>
					
					@foreach ($acd['account']['alldetails'] as $createaccount)
					
					
					<div class="col-md-6"> <!-- ACCOUNT DETAILS SECTION-->
						<div class="row">
							
							
							
							<div class="hidden">{{ $createaccount->Accid }}</div>
							<div class="hidden">{{ $createaccount->Nid }}</div>
							<div class="hidden">{{ $createaccount->Uid }}</div>
							
							
							<input type="text" class="form-control hidden" id="acid" name="acid" value="{{ $createaccount->Accid }}" >
							
							<div class="box-header well col-md-12">
								<h2>ACCOUNT DETAILS (Read Only)</h2>
							</div>
							
							<div class="alert alert-success">	
								<!--ACCOUNT DETAILSDetail-->
								
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Account Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="crtdte" name="crtdte" value="{{ $createaccount->AccNum }}" readonly>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Customer ID:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="crtdte" name="crtdte" value="{{ $createaccount->Uid }}" readonly>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Total Amount:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="totamt" name="totamt" value="{{ $createaccount->Total_Amount }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Account Type:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->Acc_Type }}" readonly>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Creation Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="crtdte" name="crtdte" value="{{ $createaccount->Created_on }}" readonly>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Branch Name:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->BName }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">First Name:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->FirstName }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Middle Name:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->MiddleName }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Last Name:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->LastName }}" readonly>  
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">Father Name:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value=" {{ $acd['account']['fa_name'] }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->Address }}" readonly>  
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-4">Age:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->Age }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">BirthDate:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->BirthDate }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Gender:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->Gender }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Marital Status:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->MaritalStatus }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->Occupation }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->MobileNo }}" readonly>  
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
									<div class="col-md-8">
										<input class="form-control"  type="text" value="{{ $createaccount->PhoneNo }}" readonly>  
									</div>
								</div>
								
								
								
							</div>
							
							
							
							
							
							
							
							
						</div>
					</div>
					
					
					
					<div class="col-md-6">
						<div class="row">
							
							<div class="box-header well col-md-12">
								<h2>NOMINEE DETAILS</h2>
							</div>
							
							<div class="alert alert-danger">
								
								<!--Nominee Detail continued-->
								
								<div class="form-group">
									<label class="control-label col-sm-4">First Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nfname" name="nfname" value="{{ $createaccount->Nom_FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Middle Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmname" name="nmname" value="{{ $createaccount->Nom_MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Last Name:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nlname" name="nlname" value="{{ $createaccount->Nom_LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Relationship:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="relation" name="relation" value="{{ $createaccount->Relationship }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nemail" name="nemail" value="{{ $createaccount->Nom_Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Gender:</label>
									<div class="col-md-8">
										<select class="form-control" id="ngender" name="ngender"required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
											<option value="{{ $createaccount->Nom_Gender }}" selected>{{ $createaccount->Nom_Gender }} </option>
											<option>Male</option>
											<option>Female</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Marital Status:</label>
									<div class="col-md-8">
										<select class="form-control" id="nmstate" name="nmstate" required <?php if($edit=='edit'){}else {echo 'disabled';} ?>>
											<option value="{{ $createaccount->Nom_Marital_Status }}" selected>{{ $createaccount->Nom_Marital_Status }}</option>
											<option>Married</option>
											<option>Unmarried</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Age:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nage" name="nage" value="{{ $createaccount->Nom_Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Birth Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nbdate" name="nbdate" value="{{ $createaccount->Nom_Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="noccup" name="noccup" value="{{ $createaccount->Nom_Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nmno" name="nmno" value="{{ $createaccount->Nom_MobNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npno" name="npno" value="{{ $createaccount->Nom_PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nadd" name="nadd" value="{{ $createaccount->Nom_Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ncity" name="ncity" value="{{ $createaccount->Nom_City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="ndist" name="ndist" value="{{ $createaccount->Nom_District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="nstate" name="nstate" value="{{ $createaccount->Nom_state }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								
								
								
								
								
								
								<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="npin" name="npin" value="{{ $createaccount->Nom_Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
									</div>
								</div>
								@endforeach
								
								
							</div>
						</div>
					</div>
					
					<center>
    					<div class="form-group">
							
							<div class="col-sm-12">
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="UPDATE" class="btn btn-success btn-sm sbmbtn<?php echo $acd['module']->Mid; ?>"/>
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $acd['module']->Mid; ?>"/>
								<input type="<?php if($edit=='edit'){echo 'hidden';} else {echo 'button';} ?>" value="CLOSE" class="btn btn-danger btn-sm clsbtn<?php echo $acd['module']->Mid; ?>"/>
							</div>
						</div>
						
					</center>
					
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	//Cancel button
	$('.cnclbtn<?php echo $acd['module']->Mid; ?>').click(function(e)
	{
		alert('are you sure?');
		$('.accclassid').click();
	});
	
	$('.clsbtn<?php echo $acd['module']->Mid; ?>').click(function(e){
		$('.accclassid').click();
	});
	
	//Submit button
	
</script>

<script>
	$('input.typeahead2').typeahead({
		//ajax: '/GetBranches'
		source:GetBranches
	});
	$('input.typeahead1').typeahead({
		//ajax: '/Getacctyp'
		source:Getacctyp	
	});
	$('input.typeahead3').typeahead({
		//ajax: '/Getuser'
		source:Getuser
	});
</script>
<script>
	/*$('#sel').change(function(){
		usr=$('#sel').val();
		alert(usr);
		if(usr=="User")
		{
		$('input.typeahead3').typeahead({
		ajax: '/Getuser'
		});
		alert("hello");
		}
		else if(usr=="Customer")
		{
		$('input.typeahead3').typeahead({
		ajax: '/Getcustomer'
		});
		
		}
		else
		{
		alert("Athish");
		}
	});*/
	
	/*$('#sel').change(function(){
		
		//e.preventDefault();
		usr=$('#sel').val();
		
		if(usr == "user")
		{
		$('#ty1').show();
		$('#ty2').hide();
		
		$('input.typeahead3').typeahead({
		
		ajax:'/Getuser'
		
		});
		
		}
		else
		{
		$('#ty1').hide();
		$('#ty2').show();
		
		$('input.typeahead4').typeahead({
		
		ajax:'/Getcustomer'
		});
		
		}
		
		/*$('input.typeahead3').typeahead({
		
		
		ajax:'/Getuser'
		
		});
		}
		else if(usr == "customer")
		{
		
		$('input.typeahead3').typeahead({
		
		
		ajax:'/Getcustomer'
		
		});
		}
		/*else if(usr=="Customer")
		{
		ajax:'/Getcustomer'
	}*/
	
	
	
</script>
<script>
$('.sbmbtn<?php echo $acd['module']->Mid; ?>').click( function(e) {
		
		e.preventDefault();
		nomid={{ $createaccount->Nid }};
		userid={{ $createaccount->Uid }};
		
		
		
		$.ajax({
			url: 'updateacc',
			type: 'post',
			data: $('#form_acc').serialize()+ '&nnid=' + nomid +'&uid='+userid,
			success: function(data) {
				alert('success');
				$('.accclassid').click();
			}
		});
	});
</script>
