        <div class="bdy_<?php echo $m['module']->Mid; ?> box-inner b1">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Member Detail</h2>
					
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="membesuspendview" class="btn btn-default ViewSuspendShare<?php echo $m['module']->Mid; ?>">View Suspend Shares</a>
						<a href="memberejectview" class="btn btn-default ViewRejectShare<?php echo $m['module']->Mid; ?>">View Rejected Shares</a>
						<button class="btn-sm glyphicon glyphicon-refresh" id="refresh_data"></button>

					</div>

					<div id="table_data"></div>
					
				<?php /*
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
					
						<th>Name</th>
						<th>Date</th>
						<th>Share Class</th>
						<th>Number Of Shares</th>
						<th>Total Share Price</th>
						<th>Remarks</th>
						<th>Status</th>
						<th colspan=3><center>Action</center></th>
						</tr>
					
					</thead>
					
					<tbody>
					
						@foreach ($m['data'] as $members)
						<tr>
							 <td class="hidden">{{ $members->Memid }}</td>
							 <td class="hidden">{{ $members->PURSH_Pid }}</td>
							 
							 <td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }} {{ $members->MiddleName }} {{ $members->LastName }}</a></td>
							 <td>{{$members->CreatedDate}}</td>
							 <td>{{$members->PURSH_Shrclass}}</td>
							 <td>{{$members->PURSH_Noofshares}}</td>
							 <td>{{$members->PURSH_TotalShareValue}}</td>
							 <td>{{$members->Remarks}}</td>
							 <td>{{$members->Status}}</td>
							
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
											<input type="button" value="ACCEPT" class="btn btn-success btn-sm accbtn<?php echo $m['module']->Mid; ?>" href="acceptshares/{{ $members->Memid }}/{{ $members->PURSH_Pid }}"/>
										</div>
									</div>
								</td>
								<td>
									
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $m['module']->Mid; ?>" href="rejectshare/{{ $members->Memid }}/{{ $members->PURSH_Pid }}"/>
										</div>
									</div>
									
							 </td>
							 
						</tr>
						@endforeach
						
					</tbody>
					
					</table>
				*/?>

				</div>
			</div>
		</div>
	</div>
</div>

<div id="b2">.</div>
<div id="b3">
	<center>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="button" id="back" value="Back" class="btn btn-danger btn-sm" />
			</div>
		</div>
	</center>	
</div>

   
<script>
	  /* 
	$('.clickme').click(function(e)
	{
		$('.memclassid').click();
	});
	
	$('.ViewSuspendShare<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.ViewRejectShare<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
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
	
	$('.accbtn<?php echo $m['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
	});
	$('.backbtn').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn<?php echo $m['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		//$('.box').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
		 
	});
	*/
</script>

<script>
	function accept_suspended_share(purchase_share_id) {
		var url = "acceptsuspendshares/" + purchase_share_id;
//		alert(url);
		console.log(url);
//		return;
		$.ajax({
			url: url,
			type:"get",
			success:function() {
				console.log(url + ": done");
				alert("success");
			}
		});
	}
</script>





<script>
	function load_data() {
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$("#table_data").html(loading_img);
		$.ajax({
			url: 'viewshares_data',
			type: 'post',
			data: "",
			success: function(data) {
				$("#table_data").html(data);
			}
		});

	}
</script>

<script>
	$( document ).ready(function() {

		load_data();

	});
</script>

<script>
	$("#back").click(function() {
		$("#b2").html("");
		$(".b1").show();
	})
</script>

<script>
	$("#refresh_data").click(function() {
		load_data();
	})
</script>

<script>
	$('.ViewSuspendShare<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>

<script>
	$('.ViewRejectShare<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
	});
</script>


