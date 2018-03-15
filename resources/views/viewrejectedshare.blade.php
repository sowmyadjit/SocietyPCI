     <div class="bdy_<?php echo $m['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Member Detail</h2>
					
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
						<th>Number Of Shares</th>
						<th>Total Share Price</th>
						<th>Remarks</th>
						<th colspan=2><center>ACTION</center></th>
						</tr>
					
					</thead>
					
					<tbody>
					
						@foreach ($m['data'] as $members)
						<tr>
							 <td class="hidden">{{ $members->Memid }}</td>
							 <td class="hidden">{{ $members->PURSH_Pid }}</td>
							 
							 <td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}</a></td>
							 <td>{{ $members->MiddleName }}</td>
							 <td>{{ $members->LastName }}</td>
							 <td>{{$members->CreatedDate}}</td>
							 <td>{{$members->PURSH_Shrclass}}</td>
							 <td>{{$members->PURSH_Noofshares}}</td>
							 <td>{{$members->PURSH_TotalShareValue}}</td>
							 <td>{{$members->Remarks}}</td>
							
							 <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-primary btn-sm edtbtn<?php echo $m['module']->Mid; ?>" href="memberdetails/{{ $members->Memid }}/edit"/>
										</div>
									</div>
								</td>	
								
								<td>
									
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="ACCEPT" class="btn btn-success btn-sm rejbtn<?php echo $m['module']->Mid; ?>" href="AcceptRejectedShare/{{ $members->Memid }}/{{ $members->PURSH_Pid }}"/>
										</div>
									</div>
									
							 </td>
							 
						</tr>
						@endforeach
						
					</tbody>
					
					</table>
				</div>
			</div>
		</div>
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
	
	$('.edtbtn<?php echo $m['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.accbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
	});
	$('.backbtn').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn<?php echo $m['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	
</script>