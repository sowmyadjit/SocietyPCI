

<div class="bdy_<?php echo $a['module']->Mid; ?> box-inner b1">
	
	<div class="box-header well" data-original-title="">
		<h2><i class="glyphicon glyphicon-globe"></i> Account Detail</h2>
		
		
	</div>
	
	<div class="box-content">
		<div class="alert alert-info">
			<a href="rejectedaccount" class="btn btn-default rejacc<?php echo $a['module']->Mid; ?>">Rejected Account</a>
			<button class="btn-sm glyphicon glyphicon-refresh" id="refresh_data"></button>
		</div>

		<div id="table_data"></div>
		
	<?php /*
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			<thead>
				<tr>
					<th>Account Number</th>
					<th>Account Type</th>
					<th>Branch</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Mobile Number</th>
					<th>Phone Number</th>
					<!--<th>VIEW</th>-->
					<th colspan=3><center>ACTION</center></th>
				</tr>
			</thead>
			
			<tbody>
				
				@foreach ($a['data'] as $createaccount)
				<tr>
					<td class="hidden">{{ $createaccount->Accid }}</td>
					<td>{{ $createaccount->AccNum }}</td>
					<td>{{ $createaccount->Acc_Type }}</td>
					<td>{{ $createaccount->BName }}</td>
					<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn<?php echo $a['module']->Mid; ?>">{{ $createaccount->FirstName }} {{ $createaccount->MiddleName }} {{ $createaccount->LastName }}</a></td>
					<td>{{ $createaccount->MobileNo }}</td>
					<td>{{ $createaccount->PhoneNo }}</td>
					<!--<td>
						
						<div class="form-group">
						<div class="col-sm-12">
						<input type="button" value="VIEW" class="btn btn-info btn-sm viwbtn" href="accountdetails/{{ $createaccount->Accid }}"/>
						</div>
						</div>
						
					</td>-->
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" class="btn btn-primary btn-sm edtbtn<?php echo $a['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="ACCEPT" class="btn btn-success btn-sm accbtn<?php echo $a['module']->Mid; ?>" href="acceptaccount/{{ $createaccount->Accid }}"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $a['module']->Mid; ?>" href="rejectaccount/{{ $createaccount->Accid }}"/>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				
				
				@foreach ($a['data_joint'] as $createaccount)
				<tr>
					<td class="hidden">{{ $createaccount->Accid }}</td>
					<td>{{ $createaccount->AccNum }}</td>
					<td>{{ $createaccount->Acc_Type }}</td>
					<td>{{ $createaccount->BName }}</td>
					<td>1. <a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn<?php echo $a['module']->Mid; ?>">{{ $createaccount->user1 }}</a>
						<br>
						2. <a  href="accountdetails_joint/{{ $createaccount->Accid }}" class="viwbtn<?php echo $a['module']->Mid; ?>">{{ $createaccount->user2 }}</a>
					</td>
					<td>{{ $createaccount->MobileNo }}</td>
					<td>{{ $createaccount->PhoneNo }}</td>
					<!--<td>
						
						<div class="form-group">
						<div class="col-sm-12">
						<input type="button" value="VIEW" class="btn btn-info btn-sm viwbtn" href="accountdetails/{{ $createaccount->Accid }}"/>
						</div>
						</div>
						
					</td>-->
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" class="btn btn-primary btn-sm edtbtn<?php echo $a['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
							</div>
						</div>
						
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="ACCEPT" class="btn btn-success btn-sm accbtn<?php echo $a['module']->Mid; ?>" href="acceptaccount/{{ $createaccount->Accid }}"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $a['module']->Mid; ?>" href="rejectaccount/{{ $createaccount->Accid }}"/>
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
	$('.clickme<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		$('.accclassid').click();
	}); 
	$('.crtacc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	
	$('.viwbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	$('.accbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.backbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	 */
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
			url: 'authaccount_data',
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
	$('.rejacc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
		$("#back").hide();
	});
</script>