<script src="js/bootstrap-typeahead.js"></script>

	<div id="content" class="col-md-12">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> EDIT Branch</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				{!! Form::open(['url' => "updatebranch",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}
						
						<?php // print_r($ud);
						$edit=$bd['type'];?>
							
						@foreach ($bd['branch'] as $branch)

						<div class="hidden">{{ $branch->Bid }}</div>
						<div class="hidden">{{ $branch->Cid }}</div>
						
				<div class="form-group">
					<label class="control-label col-sm-4" for="last_name">COMPANY NAME:</label>
					
					<div class="col-sm-4">
					
					<select class="form-control" id="cid" name="cid" " <?php if($edit=='edit'){}else {echo 'readonly';} ?> >
					<option value="{{ $branch->Cid }}" selected>{{ $branch->Cname }}</option>
						<?php foreach ($company as $key) {
						//print_r($key);
						echo "<option value='".$key->cid."' >".$key->cname."";
						echo "</option>";
						}?>
					</select>
            		</div>
					
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="comment">BRANCH CODE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bcode" name="bcode" value="{{ $branch->BCode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">BRANCH NAME:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bname" name="bname" value="{{ $branch->BName }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">ADDRESS:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="baddress" name="baddress" value="{{ $branch->BAddress }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">CITY:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bcity" name="bcity" value="{{ $branch->BCity }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">STATE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bstate" name="bstate" value="{{ $branch->BState }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">PHONE NUMBER:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bphone" name="bphone" value="{{ $branch->BPhoneNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">MOBILE NUMBER:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bmobile" name="bmobile" value="{{ $branch->BMobileNo }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4" for="first_name">PINCODE:</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="bpincode" name="bpincode" value="{{ $branch->BPincode }}" <?php if($edit=='edit'){}else {echo 'readonly';} ?>>
					</div>
				</div>
				@endforeach

				<!--<center>
    
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" value="Upload" class="btn btn-info btn-sm sbmbtn"/>
						<input type="button" value="cancel" class="btn btn-info btn-sm cnclbtn"/>
					</div>
				</div>
				</center>-->
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
	

<script>
	branchid=0;
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.branchclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	
	
	
	$('.sbmbtn').click( function(e) {
	//branchid=$('ul.typeahead li.active').data('value');
	e.preventDefault();
	bid={{ $branch->Bid }};
		$.ajax({
			url: 'updatebranch',
			type: 'post',
			data: $('#form_des').serialize()+ '&bid=' + bid ,
			success: function(data) {
				//alert('success');
				$('.branchclassid').click();
			}
		});
	});

</script>