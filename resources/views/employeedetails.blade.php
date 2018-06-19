<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $ed['module']->Mid; ?>" class="col-md-12">
	<div class="row">
			<div class="box_bdy_<?php echo $ed['module']->Mid; ?> box col-md-12">
				<div class="bdy_<?php echo $ed['module']->Mid; ?> box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>EMPLOYEE DETAILS</h2>
						
					</div>
					
			<div class="box-content">
				{!! Form::open(['url' => 'updateemp','class' => 'form-horizontal','id' => 'empupdateForm','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
				
				<?php // print_r($ud);
						$edit=$ed['type'];?>
						
				@foreach ($ed['employee'] as $employee)		
				
				
				<div class="col-md-6">
					<div class="row">

					
						
								<div class="hidden"><input type="text" class="form-control" id="eid" name="eid" value="{{ $employee->Eid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="aid" name="aid" value="{{ $employee->Aid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="docid" name="docid" value="{{ $employee->DocProvid }}"></div>
								<div class="hidden"><input type="text" class="form-control" id="uid" name="uid" value="{{ $employee->Uid }}"></div>
					
						<div class="form-group">
							<label class="control-label col-sm-4">First Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="fname" name="fname" value="{{ $employee->FirstName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Middle Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="mname" name="mname" value="{{ $employee->MiddleName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Last Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="lname" name="lname" value="{{ $employee->LastName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Branch Name:</label>
							<div class="col-md-8">
								<input class="typeahead1 form-control" value="{{ $employee->BName }}" id="bid" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
							<div class="col-md-8 hidden">
								<input type="text" id="branchid" name="branchid" value="{{ $employee->Bid }}">
							</div>
				

						<div class="form-group">
							<label class="control-label col-sm-4">Employee Code:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="empcode" name="empcode" value="{{ $employee->ECode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Employee Type:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="emptype" name="emptype" value="{{ $employee->Emp_Type }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Designation:</label>
							<div class="col-md-8">
								<input class="typeahead desig form-control" value="{{ $employee->DName }}" id="did" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="col-md-8 hidden">
								<input type="text" id="desgnid" name="desgnid" value="{{ $employee->Did }}">
						</div>
						
						
						
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">EMAIL ID:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email" value="{{ $employee->Email }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>/>
							</div>
						</div>
						
						<!--<div class="form-group">
							<label class="control-label col-sm-4">Gender:</label>
							<div class="col-md-8">
								<select id="gender" name="gender" class="form-control">
								<option>--Select Gender--</option>
								<option>MALE</option>
								<option>FEMALE</option>
								</select>
							</div>
						</div>-->
						<div class="form-group">
							<label class="control-label col-sm-4">Gender:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="gender" name="gender" value="{{ $employee->Gender }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>/>
							</div>
						</div>
						
						 <!--<div class="form-group">
							<label class="control-label col-sm-4">Marital Status:</label>
							<div class="col-md-8">
								<select class="form-control" id="maritalstatus" name="maritalstatus">
								<option>--Select Marital Status--</option>
								<option>MARRIED</option>
								<option>UNMARRIED</option>
								</select>
							</div>
						</div>-->
						<div class="form-group">
							<label class="control-label col-sm-4">Marital Status:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="maritalstatus" name="maritalstatus" value="{{ $employee->MaritalStatus }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>/>
							</div>
						</div>

						<div class="form-group">
						<label class="control-label col-sm-4">Occupation:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="occupation" name="occupation" value="{{ $employee->Occupation }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
							<div class="form-group">
						<label class="control-label col-sm-4">Age:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="age" name="age" value="{{ $employee->Age }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						

					   <div class="form-group">
					   <label class="control-label col-sm-4">Birth Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="bdate" name="bdate" value="{{ $employee->Birthdate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						
						
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="row">
					
						
						<div class="form-group">
							<label class="control-label col-sm-4">Mobile Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="mobile" name="mobile" value="{{ $employee->MobileNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Phone:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->PhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Address:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="address" name="address" value="{{ $employee->Address }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">City:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="city" name="city" value="{{ $employee->City }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">DISTRICT:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="dist" name="dist" value="{{ $employee->District }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">State:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="state" name="state" value="{{ $employee->State }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Pincode:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="pincode" name="pincode" value="{{ $employee->Pincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Basic Pay:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="bpay" name="bpay" value="{{$employee->basicpay}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Income Tax:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="itax" name="itax" value="{{$employee->incometax}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">PF:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="pf" name="pf" value="{{$employee->pf}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">HRA:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="hra" name="hra" value="{{$employee->hra}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">PF Account No.:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="pf_acc_no" name="pf_acc_no" value="{{$employee->PF_Acc_No}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Joining Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="jd" name="jd" value="{{$employee->Joining_Date}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						
				@endforeach
						
					</div>
				</div>
				
				
				
				
				
				</br>
				
				<div class="alert alert-success col-md-12">
					<div class="row">
					
					
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
						
									<div class="form-group">
										<label class="control-label col-sm-4">ID Proof:</label>
										<div class="col-md-8">
										</br></br></br>
										<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">
										<input type="file" id="empeidp" name="empeidp" accept="image/*" onchange="loadFile1(event)">
										</div>
										
										</div>
									</div>
									
								</div>
								
								<div class="col-md-8">
								
								<img src="{{ $employee->ID_Proof }}" id="idproof" height="150" width="250"/></br>
								
								</div>
								
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Address Proof:</label>
									<div class="col-md-8">
									</br></br></br>
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">
									<input type="file" id="empeadrp" name="empeadrp" accept="image/*" onchange="loadFile2(event)" >
									</div>
									
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $employee->Address_Proof }}" id="addproof" height="150" width="250"/></br>
									</div>
								
							</div>
						</div>
						
						</div>
						
						
						</br>
						
						
						<div class="row">
							
							<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Photo:</label>
									<div class="col-md-8">
									</br></br>
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>">	<input type="file" id="empephoto" name="empephoto" accept="image/*" onchange="loadFile3(event)" ></div>
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $employee->Photo }}" id="emppic" height="150" width="120"/></br>
									</div>
								
							</div>
							</div>
							
							
							<div class="col-md-6">
							<div class="row table-row">
									<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Signature:</label>
									<div class="col-md-8">
									</br></br>
									<div class="<?php if($edit=='edit'){}else {echo 'hidden';} ?>"><input type="file" id="empesign" name="empesign" accept="image/*" onchange="loadFile4(event)"></div>
									
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img src="{{ $employee->Signature }}" id="sign" height="150" width="250"/></br>
									</div>
								
							</div>
							</div>
							
						</div>
					
					</div> <!--alert-success ends-->
				
				
				
				
				
				
				
				
				
				
				
				

					<center>
				
						<div class="form-group">
							<div class="col-sm-12">
								<input type="<?php if($edit=='edit'){echo 'submit';} else {echo 'hidden';} ?>" value="UPDATE" class="btn btn-success btn-sm sbmbtn<?php echo $ed['module']->Mid; ?>"/>
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $ed['module']->Mid; ?>"/>
								<input type="<?php if($edit=='edit'){echo 'hidden';} else {echo 'button';} ?>" value="CLOSE" class="btn btn-danger btn-sm clsbtn<?php echo $ed['module']->Mid; ?>"/>
							</div>
						</div>
						
					</center>
				{!! Form::close() !!}
			</div>
				</div>
			</div>
    </div>
</div>
	


<script src="js/bootstrap-typeahead.js"></script>
<script>

//To get BranchID
var branch='<?php echo $employee->Bid;?>';
m=$('#branchid').val(branch);

$('#bid').change(function(){
	var br=$('#bid').data('value');
	//alert(br);
	$.ajax({
		success:function()
		{
			$('#branchid').val(br);
			//alert(m1);
		}
	});
});

//To get DesignationID
var desgn='<?php echo $employee->Did;?>';
m=$('#desgnid').val(desgn);

$('#did').change(function(){
	var br=$('#did').data('value');
	//alert(br);
	$.ajax({
		success:function()
		{
			$('#desgnid').val(br);
			//alert(m1);
		}
	});
});


  $('.cnclbtn<?php echo $ed['module']->Mid; ?>').click(function(e)
{
	alert('are you sure?');
	$('.empclassid').click();
	//alert(a);
});

$('.clsbtn<?php echo $ed['module']->Mid; ?>').click(function(e){
		
		
    $('.empclassid').click();
               
});

/*$('.sbmbtn').click( function(e) {
	//DTid=$('ul.typeahead li.active').data('value');
	 a=$('.desig').data('value');
	 des=a;
	 branch=$('.typeahead1').data('value');
	 branch1=branch;
	 aid={{ $employee->Aid }};
	 eid={{ $employee->Eid }};
	 //alert(branch);
	 
// alert(a);
	e.preventDefault();
    $.ajax({
		
        url: 'updateemp',
        type: 'post',
        data: $('#empupdateForm').serialize()+ '&des=' + a + '&branch1=' + branch + '&eid=' + eid + '&aid=' + aid,
        success: function(data) {
			//alert('success');
                   $('.empclassid').click();
				  
                 }
    });
});*/

$('input.typeahead').typeahead({
     // ajax: '/GetDesignation'
	  source:GetDesignation
});
$('input.typeahead1').typeahead({
      //ajax: '/GetBranches'
	  source:GetBranches
});
</script>

<style>
input[type=file]{ 
        color:transparent;
    }
</style>


<script>

	var loadFile1 = function(event) {
		var idproof = document.getElementById('idproof');
		idproof.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile2 = function(event) {
		var addproof = document.getElementById('addproof');
		addproof.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile3 = function(event) {
		var emppic = document.getElementById('emppic');
		emppic.src = URL.createObjectURL(event.target.files[0]);
	};
	
	 var loadFile4 = function(event) {
		 var sign = document.getElementById('sign');
		 sign.src = URL.createObjectURL(event.target.files[0]);
	 };


</script>