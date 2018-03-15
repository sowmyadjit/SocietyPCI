<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>

<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> SHARE HAND OVER</h2>
					
				</div>
				
				<div class="box-content">
					
					
					{!! Form::open(['url' => 'crtpigmialloc','class' => 'form-horizontal','id' => 'form_pigmialloc','method'=>'post']) !!}
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
								<div class="form-group">
									<label class="control-label col-sm-4">Select Member:</label>
									<div class="col-md-4">
										<input style="border-color:red" class="typeahead1 form-control"  type="text" name="pigmitype" placeholder="Select Member"/>  
									</div>
								</div>
								
								
								
							</div>
						</div>
					</div>
					<div class="SearchRes">
					</div>
				</div>
				
				
				<!--Pigmi Allocation Detail-->
				
			</div>
			
			{!! Form::close() !!}
		</div>
	</div>
</div>

</div>
</div>

<script>
	
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.pigmiallocclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.resetbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			
			return true;
		}
		else{
			return false;
		}
		
	});
	
	
	
	$('.typeahead1').change( function(e) {
		
		mid=$('.typeahead1').data('value');
		
		e.preventDefault();
		$.ajax({
			
			url: 'getshares',
			type: 'post',
			data: '&mid='+mid,
			success: function(data) {
				$('.SearchRes').html(" ");
				$('.SearchRes').html(data);
			}
		});
		
	});
	
</script>

<script>
	
	$('input.typeahead1').typeahead({
	ajax: '/GetMemberdetails'
});

</script>

