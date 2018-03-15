<script src="js/bootstrap-typeahead.js"></script>


<div id="content" class="col-lg-10 col-sm-10 col-md-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a>
			</li>
			<li>
				<a class="clickme" >Account</a>
			</li>
		</ul>
	</div>
	
	<div class="row loadper">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Account Detail</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					<div class="col-md-6"><!-- customer SECTION-->
						<div class="row">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								
								<thead>
									<tr>
										<th>Account Number</th>
										<th>Date</th>
										<th>Amount</th>
										
										
									</tr>
								</thead>
								
								<tbody>
								
									@foreach ($ledger[0] as $led)
									<tr>
										
										
										
										<td><h3><u> {{ $led->Accno}} </u></h3></td>
										
										<td><h3><u> {{ $led->Amount}} </u></h3></td>
										
										<td><h3><u> {{ $led->Date_}} </u></h3></td>
										
										
								
										
									</tr>
									
									
									@endforeach
									
								</tbody>
								
							</table>
						</div>
					</div>
					
					
				</div>	
			</div>	
			
			
			
		</div>
	</div>	
</div>	



<script>
	
	$('.hidebtn').show();
	
	$('.msg1').hide();
$('.msg2').hide();







$('.clickme').click(function(e)
{
	$('.accclassid').click();
}); 
$('.crtacc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.loadper').load($(this).attr('href'));
});

$('.ViewMinAcc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box-inner').load($(this).attr('href'));
});

$('.JointAcc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
});

$('.viwbtn').click(function(e){
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
});

$('.edtbtn').click(function(e){
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
});

$("ul.pagination li a").each(function() {
	
	$(this).addClass("loadmc");
	
});
$('.loadmc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('#maincontents').load($(this).attr('href'));
});

$('input.SearchTypeahead').typeahead({
	ajax: '/GetSearchAcc'
});

$('input.SearchOldAccTypeahead').typeahead({
	ajax: '/GetSearchOldAcc'
});

$('.SearchTypeahead').change(function(e){
	//agent=$('ul.typeahead1 li.active').data('value');
	searchvalue=$('#searchacc').data('value');
	//alert(searchvalue);
	e.preventDefault();
	$.ajax({
		url:'getSearchaccount',
		type:'get',
		data:'&SearchAccId='+searchvalue,
		success:function(data)
		{
			//alert("success");
			$('.box').html(data);
			
			
		}
	});
});

$('.SearchOldAccTypeahead').change(function(e){
	//agent=$('ul.typeahead1 li.active').data('value');
	searcholdvalue=$('#searcholdacc').data('value');
	//alert(searcholdacc);
	e.preventDefault();
	$.ajax({
		url:'getSearchOldaccount',
		type:'get',
		data:'&SearchOldAccId='+searcholdvalue,
		success:function(data)
		{
			//alert("success");
			$('.box').html(data);
			
			
		}
	});
});

</script>	