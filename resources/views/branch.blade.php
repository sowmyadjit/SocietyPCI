<link href="css/toggles.css" rel="stylesheet">
<link href="css/toggles-soft.css" rel="stylesheet">
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $b['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $b['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> Branch  Detail</h2>
					
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="showcreatebranch" class="btn btn-default crtds<?php echo $b['module']->Mid; ?>">Create Branch</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Company Name</th>
								<th>Branch Name</th>
								<th>Branch Code</th>
								<th>Branch Address</th>
								<th>Branch City</th>
								<th>Branch State</th>
								<th>Branch Phone No</th>
								<th>Branch Mobile No</th>
								<th>Branch Pincode</th>
								<th>Actions</th>
								<th>SMS </th>
							</tr>
						</thead>
						
						<tbody>
							@foreach ($b['branch'] as $Branch)
							<tr>
								<td class="hidden">{{ $Branch->Bid }}</td>
								<td>{{ $Branch->Cname }}</td>
								<td>{{ $Branch->BName }}</td>
								<td>{{ $Branch->BCode }}</td>
								<td>{{ $Branch->BAddress }}</td>
								<td>{{ $Branch->BCity }}</td>
								<td>{{ $Branch->BState }}</td>
								<td>{{ $Branch->BPhoneNo }}</td>
								<td>{{ $Branch->BMobileNo }}</td>
								<td>{{ $Branch->BPincode }}</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $b['module']->Mid; ?>" href="branchdetails/{{ $Branch->Bid }}/edit"/>
										</div>
									</div>
								</td>
								<td>
								<div class="toggle toggle-soft" data-mid='{{ $Branch->Bid }}' data-toggle-on="<?php $temp="";  if($Branch->SMS=="YES")
									{
										$temp="true";
										
									}
									else if($Branch->SMS=="NO")
									{
										$temp="false";
										
									} echo $temp; ?>" data-toggle-height="20" data-toggle-width="60" onclick="setid($id=<?php $temp=$Branch->Bid; echo $temp;?>);">
									</div>
								</td>
							</tr>
							@endforeach
							
						</tbody>
						
					</table>
					
					
					
					
					
					
				</div>
				<div id='pagei<?php echo $b['module']->Mid; ?>'>
					{!! $b['branch']->render() !!}
				</div>
			</div>
			
		</div>
	</div>
</div>


<script>
	
	$('.clickme').click(function(e){
		$('.branchclassid').click();
	});
	//alert(modid);
	$('.crtds<?php echo $b['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $b['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $b['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $b['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	/*$('document').ready(function(){
		$('#brtbl').datatable();
	});*/
	$("#pagei<?php echo $b['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $b['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $b['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('<?php echo $b['module']->Mid; ?>').addClass("col-md-12");
		$('#<?php echo $b['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	$('.toggle').toggles();
	
	var bbid=0;
	function setid($temp)
	{
		bbid=$temp;
	}
	
	$('.toggle').click(function(e){
		Stat1=$(this).data('toggle-active');
		
		//alert(Stat);
		
		if(Stat1==true)
		{
			Stat="YES";
			//alert(Stat);
			
			
		}
		else if(Stat1==false)
		{
			Stat="NO";
			//alert(Stat);
			
		}
		//alert(bbid);
		//Mid=$(this).data('mid');
		//alert('status - '+$(this).data('toggle-active')+' mid -'+$(this).data('mid'));
		e.preventDefault();
		
		$.ajax({
			url: 'UpdateBranchModel',
			type: 'post',
			data: '&SMSStatus='+Stat+'&BranchId='+bbid,
			success: function(data) {
				//alert('success');
				//$('.modulesclassid').click();
			}
		});
	});
</script>