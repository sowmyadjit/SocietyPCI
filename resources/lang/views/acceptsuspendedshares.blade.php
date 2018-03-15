<div class="box-inner">
	<div class="box-header well" data-original-title="">
		<h2><i class="glyphicon glyphicon-user"></i> Member Detail</h2>
		<div class="box-icon">
			<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
			<a href="#" class="btn btn-minimize btn-round btn-default"><i
			class="glyphicon glyphicon-chevron-up"></i></a>
			<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
		</div>
	</div>
	
	<div class="box-content">
		
		<div class="alert alert-info">
			
			<a href="autoriseindividualshares" class="btn btn-default crtmem">view Individual shares</a>
			
			
			
		</div>
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					
					<th>Name</th>
					<th>Date</th>
					<th>Share Class</th>
					<th>Number Of Shares</th>
					<th>Total Share Price</th>
					<th>Remaining Amount</th>
					<th>Enter Amount</th>
					<th>Remarks</th>
					<th>Status</th>
					<th colspan=2><center>ACTION</center></th>
				</tr>
				
			</thead>
			
			<tbody>
				
				@foreach ($m as $members)
				<tr>
					<td class="hidden">{{ $members->Memid }}</td>
					<td class="hidden pursid<?php echo $members->PURSH_Pid;?>">{{ $members->PURSH_Pid }}</td>
					
					<td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}.{{ $members->MiddleName }}.{{ $members->LastName }}</a></td>
					<td>{{$members->PURSH_Date}}</td>
					<td>{{$members->PURSH_Shrclass}}</td>
					<td>{{$members->PURSH_Noofshares}}</td>
					<td>{{$members->PURSH_TotalShareValue}}</td>
					<td class="pendamt<?php echo $members->PURSH_Pid;?>">{{$members->PURSH_PendingAmount}}</td>
					
					<td>
						
						<div class="form-group ">
							
							<div class="col-md-12">
								<input type="text" class="form-control" id="amt<?php echo "$members->PURSH_Pid";?>" name="amt<?php echo $members->PURSH_Pid;?>" onblur="btnhide<?php echo $members->PURSH_Pid;?>();"/>
							</div>
						</div>
						
						
					</td>
					<td>{{$members->Remarks}}</td>
					<td>{{$members->Status}}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="memberdetails/{{ $members->Memid }}/edit"/>
							</div>
						</div>
					</td>
					
					<script>
						
						$('.accbtn<?php echo $members->PURSH_Pid;?>').hide();
						
						
						function btnhide<?php echo $members->PURSH_Pid;?>()
						{
							//Purid=$('.pursid<?php echo $members->PURSH_Pid;?>').html();
							//pendamt1=$('.pendamt<?php echo $members->PURSH_Pid;?>').html();
							Purid<?php echo $members->PURSH_Pid;?>="<?php echo $members->PURSH_Pid;?>";
							pendamt1<?php echo $members->PURSH_Pid;?>="<?php echo $members->PURSH_PendingAmount;?>";
							amt1<?php echo $members->PURSH_Pid;?>=$('#amt<?php echo $members->PURSH_Pid;?>').val();
							//test="<?php echo $members->PURSH_Pid;?>";
							//alert(test);
							pendamttt<?php echo $members->PURSH_Pid;?>=parseFloat(pendamt1<?php echo $members->PURSH_Pid;?>);
							amttt<?php echo $members->PURSH_Pid;?>=parseFloat(amt1<?php echo $members->PURSH_Pid;?>);
							//alert(pendamttt<?php echo $members->PURSH_Pid;?>);
							//alert(amttt<?php echo $members->PURSH_Pid;?>);
							if(amttt<?php echo $members->PURSH_Pid;?>==pendamttt<?php echo $members->PURSH_Pid;?>)
							{
								//alert("function");
								$('.accbtn<?php echo $members->PURSH_Pid;?>').show();
							}
							else
							{
							$('.accbtn<?php echo $members->PURSH_Pid;?>').hide();	
							}
						}
						
						
					</script>
					
					
					<td>
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" class="btn btn-info btn-sm accbtn<?php echo $members->PURSH_Pid;?>" href="acceptsuspendshares/{{ $members->PURSH_Pid }}/{{$members->PURSH_PendingAmount}}"/>
							</div>
						</div>
						
						
						
						<script>
							$('.accbtn<?php echo $members->PURSH_Pid;?>').click(function(e){
								e.preventDefault();
								//alert($(this).attr('href'));
								$('.box-inner').load($(this).attr('href'));
							});
						</script>
					</td>
					
					
					
				</tr>
				@endforeach
				
				</tbody>
				
				</table>
	</div>
</div>


<script>
	
	$('.clickme').click(function(e)
	{
		$('.memclassid').click();
	});
	
	$('.crtmem').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.memdet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	
	$('.backbtn').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
</script>