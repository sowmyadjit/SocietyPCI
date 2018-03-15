<div class="SearchRes">
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		<thead>
			<tr>
				<th>Cetificate Number</th>
				<th>Number Of Shares</th>
				<th>Total value</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
			
			
			<h3>SHARE DETAILS</h3>
			
			@foreach ($shares['data1'] as $hugeshares)
			<tr>
				<td class="hidden">{{ $hugeshares->PURSH_Pid }}</td>
				
				
				<td>{{ $hugeshares->PURSH_Certfid }}</td>
				<td>{{ $hugeshares->PURSH_Noofshares }}</td>
				<td>{{ $hugeshares->PURSH_TotalShareValue }}</td>
				
				<td>
					
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CLOSE" class="btn btn-info btn-sm edtbtn" href="shareclose/{{$hugeshares->PURSH_Pid}}"/>
						</div>
					</div>
				</td>
				
				
				
				
				
			</tr>
			@endforeach
		</tbody>
	</table>
	<h3> INDIVIDUAL  SHARE DETAILS</h3>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		<thead>
			<tr>
				<th><input type="checkbox" id="select_all" />sel. all</th>
				<th>Share Number</th>
				<th>Cetificate Number</th>
				<th> Shares Amount</th>
				<th> Action</th>
				
				
			</tr>
		</thead>
		<tbody>
			
			
			
			
			@foreach ($shares['data2'] as $indvshares)
			<tr>
				<td ><input class="ck" type="checkbox" data_src="{{$indvshares->individual_share_ID}}" ></td>
				
				<td >{{ $indvshares->individual_share_ID }}</td>
				
				
				<td>{{ $indvshares->individual_share_certificateid }}</td>
				<td>{{ $indvshares->PURSH_Shareamt }}</td>
				<td>
					
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CLOSE" class="btn btn-info btn-sm edtbtn1" href="indshareclose/{{$indvshares->individual_share_ID}}"/>
						</div>
					</div>
				</td>
				
				
				
				
				
				
				
			</tr>
			@endforeach
		</tbody>
		</table><center>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="button" value="Close" class="btn btn-success btn-sm sbmbtn"/>
				
			</div>
		</div>
	</center>
	
	
</div>

<div class="result1"></div>

<script>
	
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn1').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.sbmbtn').click(function() { 
		//temp="";
		var temp = [];
		var t=0;
		$('.ck').each(function() { 
			var share=$(this).attr('data_src');
			if ($(this).is(':checked')) 
			{
				temp[t]=share;
				t=t+1;
				s_id=share;
				
			}
		});
		
		$.ajax({
			url: 'indshareclose',
			type: 'post',
			data: '&shareid='+temp+'&s_id='+s_id+'&loopid='+t,
			success: function(data) {
				alert('success');
				//$('.SearchRes').hide();
				$('.result1').html(data);
			}
		});
		
		
	});
</script>			


<script>
	$("#select_all").click(function(){
		if($('#select_all').prop('checked')) {
			$(".ck").prop('checked', true);
		} else {
			$(".ck").prop('checked', false);
		}
	});
</script>