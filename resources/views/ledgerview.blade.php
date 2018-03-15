
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>





<div id="content" >
	<!-- content starts -->
	<?php /*<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a>
			</li>
			<li>
				<a class="clickme" >Account</a>
			</li>
		</ul>
	</div>*/?>
	
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
							
						<div class="alert alert-info" id="export_box">
							<div class="row table-row">
								<div class="col-md-6">
									<label class="control-label col-sm-4">EXPORT :</label>
									<div class="col-md-6">
										<select class="form-control" id="ExportType" name="ExportType" onchange="export_fn();" >
											<option value="">SELECT TYPE</option>
										<!--	<option value="word">WORD</option>-->
											<option value="excel">EXCEL</option>
											<?php /*<option value="pdf">PDF</option>*/?>
										</select>
									</div>
								</div>
							</div>
						</div>
				
				<div class="box-content">
				
				
				
				
				
				
				
				
				
					
					<div class="col-md-6"><!-- customer SECTION-->
						<div class="row">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table_1">
								
								<thead>
									<tr>
										<th>ಜಾಮಾ-ವಿವರ</th>
										<th>ಒಟ್ಟು</th>
										<th>ಒಟ್ಟು</th>
										
										
									</tr>
								</thead>
								
								<tbody>
								
									@foreach ($ledger['xyz'] as $led)
									<tr>
										
										@if($led->subhead==0)
										
										<td><h3><u> {{ $led->Kalname}} </u></h3></td>
										<td>-</td>
										<td><?php echo $ledger['xyz1'][$led->lid]?></td>
								
										@else
										
										<td><a href="LedSingleDetails/{{ $led->lid }}" >{{$led->Kalname}} </a></td>
										<td><?php echo $ledger['xyz1'][$led->lid]?></td>
										<td>-</td>
										@endif
									</tr>
									
									
									@endforeach
									
								</tbody>
								
							</table>
						</div>
					</div>
					
					<div class="col-md-6"><!-- customer SECTION-->
						<div class="row">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive table_export_2">
								
								<thead>
									<tr>
										<th>ಖರ್ಚಿನ-ವಿವರ</th>
										<th>ಒಟ್ಟು</th>
										<th>ಒಟ್ಟು</th>
										
										
									</tr>
								</thead>
								
								<tbody>
								
									@foreach ($ledger['xyz_debit'] as $led)
									<tr>
										
										@if($led->subhead==0)
										
										<td><h3><u> {{ $led->Kalname}} </u></h3></td>
										<td><?php echo $ledger['xyz1_debit'][$led->lid]?></td>
										<td>-</td>
										@else
										
										<td>{{ $led->Kalname}}</td>
										<td><?php echo $ledger['xyz1_debit'][$led->lid]?></td>
										<td>-</td>
										@endif
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


<script type="text/javascript">
	
$('.datepicker').datepicker().on('changeDate',function(e){
	$(this).datepicker('hide');
});

</script>
