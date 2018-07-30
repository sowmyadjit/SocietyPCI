<div class="bdy_<?php echo $c1['module']->Mid; ?> box-inner b1_i">
	<div class="box-header well" data-original-title="">
		<h2><i class="glyphicon glyphicon-user"></i> Rejected customer Detail</h2>
		
	</div>
	
	<div class="box-content">
		<div class="alert alert-info">
			<button class="btn-sm glyphicon glyphicon-refresh" id="refresh_data_i"></button>
		</div>

		<div id="table_data_i"></div>

<?php /*
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			
			<thead>
				<tr>
					<th>FIRST NAME</th>
					<th>MIDDLE NAME</th>
					<th>LAST NAME</th>
					<th>BRANCH NAME</th>
					<th>MOBILE NUMBER</th>
					<th>PHONE NUMBER</th>
					<th colspan=2><center>ACTION</center></th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach ($c1['CustRejList'] as $customer)
				<tr>
					<td class="hidden">{{ $customer->Custid }}</td>
					<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet<?php echo $c1['module']->Mid; ?>">{{ $customer->FirstName }}</a></td>
					<td>{{ $customer->MiddleName }}</td>
					<td>{{ $customer->LastName }}</td>
					<td>{{ $customer->BName }}</td>
					<td>{{ $customer->MobileNo }}</td>
					<td>{{ $customer->PhoneNo }}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" class="btn btn-primary btn-sm edtbtn<?php echo $c1['module']->Mid; ?>" href="customerdetails/{{ $customer->Custid }}/edit"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="ACCEPT" class="btn btn-success btn-sm accustpbtn<?php echo $c1['module']->Mid; ?>" href="authoriserejcust/{{ $customer->Custid }}"/>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
*/?>

		<br/><br/>
	</div>
	
</div>



<div id="b2_i">.</div>
<div id="b3_i">
	<center>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="button" id="back_i" value="Back" class="btn btn-info btn-sm" />
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
	
	$('.crtmem').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtcust<?php echo $c1['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$('.accustpbtn<?php echo $c1['module']->Mid; ?>').click(function(e){
		alert("hai");
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $c1['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.custdet<?php echo $c1['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $c1['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	$('.rejbtn<?php echo $c1['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
	$('.edtbtn<?php echo $c1['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $c1['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.backbtn<?php echo $c1['module']->Mid; ?>').click(function(e){
		$('.custauhclassid').click();
		
	});
	*/
</script>




<script>
	function load_data_i() {
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$("#table_data_i").html(loading_img);
		$.ajax({
			url: 'custrejectview_data',
			type: 'post',
			data: "",
			success: function(data) {
				$("#table_data_i").html(data);
			}
		});

	}
</script>

<script>
	$( document ).ready(function() {

		load_data_i();

	});
</script>

<script>
	var step = 0;
	$("#back_i").click(function() {
		if(step == 0) {
			$("#back").trigger("click");
			$("#back").show();
		} else {
			step--;
			$("#b2_i").html("");
			$(".b1_i").show();
		}
	})
</script>

<script>
	$("#refresh_data_i").click(function() {
		load_data_i();
	})
</script>