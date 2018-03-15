
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
<!--this css should be inside the toprint div , for printing the table borders-->
{!! Form::open(['url' => "createbranch1",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}

<label class="control-label inline col-md-3">Select Agent:
								<select class="form-control agent1"  id="agen1" name="agen1">  
									<option></option>
											@foreach ($allcust as $pg)
											<option value='{{ $pg->Uid }}'>{{ $pg->FirstName }}.{{ $pg->MiddleName }}.{{ $pg->LastName }}</option>
											@endforeach
								</select>
							</label>

							<label class="control-label inline col-md-3">Select Agent:
								<select class="form-control agent2"  id="agen2" name="agen1">  
									<option></option>
											@foreach ($allcust as $pg)
											<option value='{{ $pg->Uid }}'>{{ $pg->FirstName }}.{{ $pg->MiddleName }}.{{ $pg->LastName }}</option>
											@endforeach
								</select>
							</label>
							</br>
							</br>
							<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								
							</div>
						</div>
					</center>

{!! Form::close() !!}			
<script>
	
	$('.sbmbtn').click(function(e){
			
			agent1=$('#agen1').val();
			agent2=$('#agen2').val();
			
			e.preventDefault();
			$.ajax({
				url:'changeallcust',
				type:'post',
				data:'&agent1='+agent1+'&agent2='+agent2,
				success:function(data)
				{
					alert("success");
					//$('.SearchRes').html('');
					//$('.SearchRes').html(data);
					
					
					
				}
			});
			
		});
	
	
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes').load($(this).attr('href'));// append the required param after href with + ,before that store those params in a global variable inside other div which is comman
	});
</script>
