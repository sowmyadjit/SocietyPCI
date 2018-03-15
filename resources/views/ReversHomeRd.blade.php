



<div class="box-content<?php echo $reversentry['module']->Mid; ?>">
	
	
	
	
				
	<div class="SearchRes<?php echo $reversentry['module']->Mid; ?>">
	
	<div class="row table-row alert alert-info">
					<label class="control-label inline col-sm-4" for="first_name">Perticulars:
					
						<input type="text" class="form-control" id="perrd" name="perrd" >
					
					</label>
					</div>
				
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			<thead>
				<tr>
					<th>Select</th>
					<th>Date</th>
					<th>Account Number</th>
					<th>Customer Name</th>
					<th>TransactionType</th>
					<th>particulars</th>
					<th>Amount</th>
					<th>Total_Bal</th>
					
				</tr>
			</thead>
			<tbody>
				
				
				<script>
					reverserdindex=0;
					var a=0;
					function setid($temp)
					{
						a=$temp;
						
						
						
					}
					$('.sbmbtn<?php echo $reversentry['module']->Mid; ?>').click( function(e) {
						if(reverserdindex==0){
							reverserdindex++;
							per=$('#perrd').val();
							alert(a);
							$.ajax({
								url:'/reversentryrd',
								type:'post',
								data:'&tranid='+a+'&perrd='+per,
								success:function(data)
								{
									alert("success");
									//$('.SearchRes<?php echo $reversentry['module']->Mid; ?>').html(data);
									
									
								}
							});
						}
						});
				</script>
				
				@foreach ($reversentry['data'] as $reverssb)
				
				
				
				<tr>
					<td class="hidden">{{ $reverssb->RD_TransID }}</td>
					<td><input type="radio" name="sele" value="<?php $temp=$reverssb->RD_TransID; echo $temp;?>" onclick="setid($id=<?php $temp=$reverssb->RD_TransID; echo $temp;?>);"></td>
					<td>{{ $reverssb->RD_Date }}</td>
					<td>{{ $reverssb->AccNum }}</td>
					<td>{{ $reverssb->FirstName }}.{{ $reverssb->MiddleName }}.{{ $reverssb->LastName }}</td>
					
					<td>{{$reverssb->RD_Trans_Type}}</td>
					<td>{{$reverssb->RD_Particulars}}</td>
					
					<td>{{$reverssb->RD_Amount}}</td> 
					<td>{{$reverssb->Total_Amount}}</td> 
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
	
	<center>
    
	<div class="form-group">
		<div class="col-sm-12">
			<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $reversentry['module']->Mid; ?>"/>
			
		</div>
	</div>
</center>

</br>
</br>
</div>





<script>
	
	
	
	
	$('input.SearchTypeahead').typeahead({
		//ajax: '/SearchPigmy'
			source:SearchPigmy
	});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchPigmy').data('value');
		e.preventDefault();
		$.ajax({
			url:'/PigmySearchView',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes<?php echo $reversentry['module']->Mid; ?>').html(data);
				
				
			}
		});
	});
	
	
	$('.clickme').click(function(e)
	{
		$('.pigmiallocclassid').click();
	});
	$('.crtpal').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $reversentry['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $reversentry['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#<?php echo $reversentry['module']->Mid; ?>maincontents').load($(this).attr('href'));
	});
	
	
</script>		