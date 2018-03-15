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
		
		
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Date</th>
					<th>Share Class</th>
					<th>Certificate Number</th>
					<th>Remaining Amount</th>
					<th>Enter Amount</th>
					<th>Status</th>
					<th>ACTION</th>
				</tr>
				
			</thead>
			
			<tbody>
				
				@foreach ($shares as $members)
				<tr>
					<td class="hidden">{{ $members->Memid }}</td>
					<td class="hidden pursid<?php echo $members->individual_share_ID;?>">{{ $members->individual_share_ID }}</td>
					
					<td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}</a></td>
					<td>{{ $members->MiddleName }}</td>
					<td>{{ $members->LastName }}</td>
					<td>{{$members->individual_share_Date}}</td>
					<td>{{$members->individual_share_Class}}</td>
					<td>{{$members->individual_share_certificateid}}</td>
					<td class="pendamt<?php echo $members->individual_shares_PendingAmount;?>">{{$members->individual_shares_PendingAmount}}</td>
					<td>
						
						<div class="form-group ">
							
							<div class="col-md-12">
								<input type="text" class="form-control" id="amt<?php echo $members->individual_share_ID;?>" name="amt<?php echo $members->individual_share_ID;?>" onblur="btnhide<?php echo $members->individual_share_ID;?>();"/>
							</div>
						</div>
						
						
					</td>
					<td>{{$members->individual_share_status}}</td>
					
					
					<script>
						
						$('.accbtn<?php echo $members->individual_share_ID;?>').hide();
						
						
						function btnhide<?php echo $members->individual_share_ID;?>()
						{
							//Purid=$('.pursid<?php echo $members->individual_share_ID;?>').html();
							//pendamt1=$('.pendamt<?php echo $members->individual_share_ID;?>').html();
							Purid<?php echo $members->individual_share_ID;?>="<?php echo $members->individual_share_ID;?>";
							pendamt1<?php echo $members->individual_share_ID;?>="<?php echo $members->individual_shares_PendingAmount;?>";
							amt1<?php echo $members->individual_share_ID;?>=$('#amt<?php echo $members->individual_share_ID;?>').val();
							//test="<?php echo $members->individual_share_ID;?>";
							//alert(test);
							pendamttt<?php echo $members->individual_share_ID;?>=parseFloat(pendamt1<?php echo $members->individual_share_ID;?>);
							amttt<?php echo $members->individual_share_ID;?>=parseFloat(amt1<?php echo $members->individual_share_ID;?>);
							//alert(pendamttt<?php echo $members->individual_share_ID;?>);
							//alert(amttt<?php echo $members->individual_share_ID;?>);
							if(amttt<?php echo $members->individual_share_ID;?>==pendamttt<?php echo $members->individual_share_ID;?>)
							{
								//alert("function");
								$('.accbtn<?php echo $members->individual_share_ID;?>').show();
							}
							else
							{
							$('.accbtn<?php echo $members->individual_share_ID;?>').hide();	
							}
						}
						
						
					</script>
					
					
					
					<td>	
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="Accept" class="btn btn-info btn-sm accbtn<?php echo $members->individual_share_ID;?>" href="acceptsuspendindividualshares/{{ $members->individual_share_ID }}/{{$members->individual_shares_PendingAmount}}/{{$members->individual_share_certificateid}}"/>
							</div>
						</div>
					</td>
					
					<script>
						$('.accbtn<?php echo $members->individual_share_ID;?>').click(function(e){
							e.preventDefault();
							//alert($(this).attr('href'));
							$('.box-inner').load($(this).attr('href'));
						});
					</script>
					
					
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
	
	$('.accbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
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