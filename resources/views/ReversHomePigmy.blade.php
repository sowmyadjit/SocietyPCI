



<div class="box-content<?php echo $reversentry['module']->Mid; ?>">
	
	
	
	
				
	<div class="SearchRes<?php echo $reversentry['module']->Mid; ?>">
	
	<div class="row table-row alert alert-info">
					<label class="control-label inline col-sm-4" for="first_name">Perticulars:
					
						<input type="text" class="form-control" id="perpigmy" name="perpigmy" >
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
					var a=0;
					function setid($temp)
					{
						a=$temp;
						
						
						
					}
					rp=0;
					$('.sbmbtn<?php echo $reversentry['module']->Mid; ?>').click( function(e) {
						if(rp==0)
						{
							rp++;
							per=$('#perpigmy').val();
							alert(a);
							$.ajax({
								url:'/reversentrypigmy',
								type:'post',
								data:'&tranid='+a+'&perticulpigmy='+per,
								success:function(data)
								{
									alert("success");
									//$('.SearchRes').html(data);
									
									
								}
							});
						}
					});
				</script>
				
				@foreach ($reversentry['data'] as $reverssb)
				
				
				
				<tr>
					<td class="hidden">{{ $reverssb->PigmiTrans_ID }}</td>
					<td><input type="radio" name="sele" value="<?php $temp=$reverssb->PigmiTrans_ID; echo $temp;?>" onclick="setid($id=<?php $temp=$reverssb->PigmiTrans_ID; echo $temp;?>);"></td>
					<td>{{ $reverssb->Trans_Date }}</td>
					<td>{{ $reverssb->PigmiAcc_No }}</td>
					<td>{{ $reverssb->FirstName }}.{{ $reverssb->MiddleName }}.{{ $reverssb->LastName }}</td>
					
					<td>{{$reverssb->Transaction_Type}}</td>
					<td>{{$reverssb->Particulars}}</td>
					
					<td>{{$reverssb->Amount}}</td> 
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
		ajax: '/SearchPigmy' 
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
	};
	
	
</script>		