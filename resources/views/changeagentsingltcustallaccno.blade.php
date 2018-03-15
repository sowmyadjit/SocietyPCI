<div  id="toprint">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th> select </th>
				<th>Name</th>
				<th> Account Number</th>
				<th>Total Amount</th>
				
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($alldetails as $PigmyBWD)
			<tr>
				<td class="hidden">{{ $PigmyBWD->PigmiAllocID }}</td>
				<td><input type="checkbox" name="sele" value="<?php $temp=$PigmyBWD->PigmiAllocID; echo $temp;?>" onclick="setid($id=<?php $temp=$PigmyBWD->PigmiAllocID; echo $temp;?>);"></td>
				<td>{{ $PigmyBWD->FirstName }}.{{ $PigmyBWD->MiddleName }}.{{ $PigmyBWD->LastName }}</td>
				<td>{{ $PigmyBWD->old_pigmiaccno }}/{{ $PigmyBWD->PigmiAcc_No }}</td>
				
				<td>{{ $PigmyBWD->Total_Amount }}</td>
				
			</tr>
			@endforeach
			
			
		</tbody>
		
	</table>
	<div class="col-sm-12">
		<input type="button" value="submit" class="btn btn-success btn-sm sbmbtn"/>
		
	</div>
	
</div>

<script>
	i=0;
	temp=" ";
	
	function setid($id)
	{
		
		temp+=$id+",";
		i++;
	}
	
	$('.sbmbtn').click(function(e)
	{
		agent1=$('#agen1').val();
		agent2=$('#agen2').val();
			
			e.preventDefault();
			$.ajax({
				url:'changesinglecustcheck',
				type:'get',
				data:'&agent1='+agent1+'&agent2='+agent2+'&alocid='+temp+'&loopid='+i,
				success:function(data)
				{
					alert("success");
						
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
