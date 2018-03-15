<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"></script>


<div id="content" class="col-md-12">
	<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>Add Ledger</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				
					
					<!--<div class="col-md-12">
					<div class="col-md-4">
					<div class="form-group ">
							<div class="col-md-3">
								<input type="button" class="btn btn-success btn-sm sbmbtn" value="Create Parent Ledger Head">
							</div>
						</div>
					</div>
					
					
					
					
					
					
					<div class="col-md-4">
					<div class="form-group ">
							<div class="col-md-3">
								<input type="button" class="btn btn-success btn-sm sbmbtn3" value="View">
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
					<div class="form-group ">
							<div class="col-md-3">
								<input type="button" class="btn btn-success btn-sm sbmbtn2" value="Create Sub Ledger Head">
							</div>
						</div>
					</div>
					<br/>
					
					
					</div>-->
					
			<div class="box-content">
			
				{!! Form::open(['url' => 'updateledger','class' => 'form-horizontal','id' => 'updateForm','method'=>'post']) !!}
				<center>
					<?php 
						$edit=$ede['type'];?>
							
						@foreach ($ede['ledger'] as $ledger)
					

						<div class="hidden leddet">{{ $ledger->lid }}</div>
						
						
					<div class="col-md-6" id="led">
					<div class="row">
					
                         	
						<div class="hidden"><input type="text" class="form-control" id="lid" name="lid" value="{{ $ledger->lid }}"></div>
						<div class="form-group ">
							<label class="control-label col-sm-4">Create Ledger Head:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="lhname" name="lhname" value="{{ $ledger->lname}}" <?php if($edit=='edit'){}else {echo 'readonly';} ?> >
							</div>
						</div>

					<div class="form-group">
							<label class="control-label col-sm-4">Date:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="date" name="date" value="{{ $ledger->Date }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
				
						<div class="form-group">
							<label class="control-label col-sm-4">Sub Ledger Head:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="subhead" name="subhead" value="{{ $ledger->subhead }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
							<div class="form-group">
							<label class="control-label col-sm-4">ಲೆಜ್ಜರ್ ಹೆಡ್ :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="kahead" name="kahead" value="{{ $ledger->kalname }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">ಸಬ್  ಲೆಜ್ಜರ್ ಹೆಡ್ :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="kasubhead" name="kasubhead" value="{{ $ledger->subhead }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">ದಿನಾಂಕ :</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="kdate" name="kdate" value="{{ $ledger->kadate }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
							</div>
						</div>
					</div>
					</div>
					
					
					
		
					@endforeach
					
		
						
    					<div class="form-group">
							<div class="col-sm-12">
								<!--<input type="button" value="Upload" class="btn btn-info btn-sm sbmbtn"/>-->
								<input type="<?php if($edit=='edit'){echo 'submit';} else {echo 'hidden';} ?>" value="UPDATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="<?php if($edit=='edit'){echo 'button';} else {echo 'hidden';} ?>" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="<?php if($edit=='edit'){echo 'hidden';} else {echo 'button';} ?>" value="CLOSE" class="btn btn-danger btn-sm clsbtn"/>
							</div>
						</div>
					
						
						
						
					</div>
					</div>
					
						</center>
			
		{!! Form::close() !!}
				</div>
				</div>
				</div>
				
				
				
				<script>
				
				
	  
	
	
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.ledclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	
	
	
	$('.sbmbtn').click( function(e) {
	e.preventDefault();
	Lid=$('.leddet').html();

		$.ajax({
			url: 'updateledger',
			type: 'post',
			data: $('#updateForm').serialize()+ '&Lid=' + Lid ,
			success: function(data) {
				//alert('success');
				//$('.ledclassid').click();
			}
		});
	});
	

</script>