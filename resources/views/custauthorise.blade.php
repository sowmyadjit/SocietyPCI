<div class="bdy_<?php echo $c['module']->Mid; ?> box-inner b1">
	<div class="box_bdy_<?php echo $c['module']->Mid; ?> box-header well" data-original-title="">
		<h2><i class="glyphicon glyphicon-user"></i> UnAutorised customer Detail</h2>
		
	</div>
	
	<div class="box-content">
		<div class="alert alert-info">
			<a href="custrejectview" class="btn btn-default crtmem<?php echo $c['module']->Mid; ?>">view Reject Customer</a>
			<button class="btn-sm glyphicon glyphicon-refresh" id="refresh_data"></button>
		</div>

		<div id="table_data"></div>

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
					<th>MEMEBR NUMBER</th>
					<th colspan=3><center>ACTION</center></th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach ($c['CustAuth'] as $customer)
				<tr>
					<td class="hidden">{{ $customer->Custid }}</td>
					<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet<?php echo $c['module']->Mid; ?>">{{ $customer->FirstName }}</a></td>
					<td>{{ $customer->MiddleName }}</td>
					<td>{{ $customer->LastName }}</td>
					<td>{{ $customer->BName }}</td>
					<td>{{ $customer->MobileNo }}</td>
					<td>{{ $customer->PhoneNo }}</td>
					<td>{{ $customer->Member_No }}</td>
					
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="EDIT" class="btn btn-primary btn-sm edtbtn<?php echo $c['module']->Mid; ?>" href="customerdetails/{{ $customer->Custid }}/edit"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="ACCEPT" class="btn btn-success btn-sm accustpbtn<?php echo $c['module']->Mid; ?>" href="authorisecust/{{ $customer->Custid }}"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $c['module']->Mid; ?>" href="rejectcust/{{ $customer->Custid }}"/>
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
	function load_data() {
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$("#table_data").html(loading_img);
		$.ajax({
			url: 'custauthorise_data',
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
	
	$('.clickme').click(function(e)
	{
		$('.memclassid').click();
	});
/* 	
	$('.crtmem<?php echo $c['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	 */
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtcust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
	});
	/* 
	$('.accustpbtn<?php echo $c['module']->Mid; ?>').click(function(e){
		//alert("hai");
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.box_bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
	});
	 */
	/* 
	$('.custdet<?php echo $c['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
		
	});
 */
/* 
	$('.rejbtn<?php echo $c['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	 */
	/* 
	$('.edtbtn<?php echo $c['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
	});
	 */
	$('.backbtn<?php echo $c['module']->Mid; ?>').click(function(e){
		$('.custauhclassid').click();
		
	});
	
</script>


<script>
	$('.crtmem<?php echo $c['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$(".b1").hide();
		$('#b2').load($(this).attr('href'));
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
