

<div class="row">
	<div class="box_bdy_<?php echo $a['module']->Mid; ?> box col-md-12">
		<div class="bdy_<?php echo $a['module']->Mid; ?> box-inner">
			
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i>RD Account List</h2>
			</div>
							
						<div class="alert alert-info" id="export_box">
							<div class="row table-row">
								<div class="col-md-6">
									<label class="control-label col-sm-4">EXPORT :</label>
									<div class="col-md-6">
										<select class="form-control" id="ExportType" name="ExportType">
											<option value="">SELECT TYPE</option>
											<option value="word">WORD</option>
											<option value="excel">EXCEL</option>
											<?php /*<option value="pdf">PDF</option>*/?>
										</select>
									</div>
								</div>
							</div>
						</div>
			
			
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				
				<thead>
					<tr>
						<th>Account Number</th>
						<th>Old Account Number</th>
						<th>Agent Id</th>
						<th>Account Type</th>
						<th>Branch</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Mobile Number</th>
						<th>Phone Number</th>
						<th>Amount</th>
						<!--<th>VIEW</th>-->
						<th>EDIT</th>
					</tr>
				</thead>
				
				<tbody>
					
					@foreach ($a['RdList'] as $createaccount)
					<tr>
						<td class="hidden">{{ $createaccount->Accid }}</td>
						<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="ViewRdList<?php echo $a['module']->Mid; ?>">{{ $createaccount->AccNum }}</a></td>
						<td>{{ $createaccount->Old_AccNo }}</td>
						<td>{{ $createaccount->Agent_ID }}</td>
						<td>{{ $createaccount->Acc_Type }}</td>
						<td>{{ $createaccount->BName }}</td>
						<td>{{ $createaccount->FirstName }}</td>
						<td>{{ $createaccount->MiddleName }}</td>
						<td>{{ $createaccount->LastName }}</td>
						<td>{{ $createaccount->MobileNo }}</td>
						<td>{{ $createaccount->PhoneNo }}</td>
						<td>{{ $createaccount->Total_Amount }}</td>
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
									<input type="button" value="EDIT" class="btn btn-info btn-sm EditRdList<?php echo $a['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
								</div>
							</div>
							
						</td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
			
		</div>	
		<div id='pagei<?php echo $a['module']->Mid; ?>'>
			{!! $a['RdList']->render() !!}
		</div>
	</div>	
	<center>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="button" value="Back" class="btn btn-info btn-sm backbtn" />
			</div>
		</div>
	</center>	
</div>	



			<div class="hide_table">
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive		export_table">
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Old Account Number</th>
							<th>Agent Id</th>
							<th>Account Type</th>
							<th>Branch</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Mobile Number</th>
							<th>Phone Number</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($a['RdList2'] as $createaccount)
						<tr>
							<td class="hidden">{{ $createaccount->Accid }}</td>
							<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="ViewRdList<?php echo $a['module']->Mid; ?>">{{ $createaccount->AccNum }}</a></td>
							<td>{{ $createaccount->Old_AccNo }}</td>
							<td>{{ $createaccount->Agent_ID }}</td>
							<td>{{ $createaccount->Acc_Type }}</td>
							<td>{{ $createaccount->BName }}</td>
							<td>{{ $createaccount->FirstName }}</td>
							<td>{{ $createaccount->MiddleName }}</td>
							<td>{{ $createaccount->LastName }}</td>
							<td>{{ $createaccount->MobileNo }}</td>
							<td>{{ $createaccount->PhoneNo }}</td>
							<td>{{ $createaccount->Total_Amount }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

<script>
	
	$('.clickme').click(function(e)
	{
		$('.accclassid').click();
	}); 
	$('.crtacc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.ViewRdList<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.EditRdList<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $a['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $a['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $a['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	$('.backbtn').click(function(e){
		$('.accclassid').click();
		
	});
</script>




<script>
	$(".hide_table").hide();
	
	$('#ExportType').change( function(e) {
		type=$('#ExportType').val();
		$(".hide_table").show();
		if(type=="word")
		{
			$('.export_table').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
		}
		else if(type=="excel")
		{
			$('.export_table').tableExport({type:'excel',escape:'false'});
		}
		else if(type=="pdf")
		{
			$('.export_table').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
		}
		$(".hide_table").hide();
		
	});
</script>