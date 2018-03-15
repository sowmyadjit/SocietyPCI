    <link href="css/toggles.css" rel="stylesheet">
<link href="css/toggles-soft.css" rel="stylesheet">

	<noscript>
		<div class="alert alert-block col-md-12">
                <h4 class="alert-heading"> Warning!</h4>
			</div>
    </noscript>

	<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
      
		
		<div class="row">
			<div class="box col-md-12">
				<div class="bdy_<?php echo $c['module']->Mid; ?> box-inner">
				
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   COMPANY Detail</h2>
						
						
					</div>
					
				<div class="box-content">
					<div class="alert alert-info">
						<a href="companydetail" class="btn btn-default crtds<?php echo $c['module']->Mid; ?>">Create Company</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Company Name</th>
						<th>Company Initial</th>
						<th>Company Address</th>
						<th>Company City</th>
						<th>Company State</th>
						<th>Company Pincode</th>
						<th>Company PhoneNO</th>
						<th>Company SMS</th>
					</tr>
					</thead>
					
					<tbody>
						@foreach ($c['company'] as $company)
						<tr>
							<td class="hidden">{{ $company->Cid }}</td>
							<td>{{ $company->Cname }}</td>
							<td>{{ $company->CInitial }}</td>
							<td>{{ $company->CAddress }}</td>
							<td>{{ $company->CCity }}</td>
							<td>{{ $company->CState }}</td>
							<td>{{ $company->CPincode }}</td>
							<td>{{ $company->CPhoneNo }}</td>
							<td>						
						<div class="toggle toggle-soft" data-mid='{{ $company->Cid }}' data-toggle-on="<?php $temp=""; if($company->SMS=="YES")
										{
											$temp="true";
											
										}
										else if($company->SMS=="NO")
										{
											$temp="false";
											
										} echo $temp; ?>" data-toggle-height="20" data-toggle-width="60" onclick="setid($id=<?php $temp=$company->Cid; echo $temp;?>);">
									</div>
									
								</td>
						</tr>
						@endforeach
				</div>
				</div>
			</div>
		</div>
	</div>
<script src="js/toggles.min.js"></script>	
<script>
	  
	  $('.clickme').click(function(e){
			$('.companyclassid').click();
		});
		
		//alert(modid);
	  $('.crtds<?php echo $c['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert('<?php echo $c['module']->Mid; ?>');
			$('.bdy_<?php echo $c['module']->Mid; ?>').load($(this).attr('href'));
		});
			$('.toggle').toggles();
			
			var ccid=0;
			function setid($temp)
			{
				ccid=$temp;
			}
			
			$('.toggle').click(function(e){
				Stat2=$(this).data('toggle-active');
				
				//alert(Stat);
				
				if(Stat2==true)
				{
					Stat="YES";
					//alert(Stat);
					
					
				}
				else if(Stat2==false)
				{
					Stat="NO";
					//alert(Stat);
					
				}
				//alert(bbid);
				//Mid=$(this).data('mid');
				//alert('status - '+$(this).data('toggle-active')+' mid -'+$(this).data('mid'));
				e.preventDefault();
				
				$.ajax({
					url: 'UpdateCompanyModel',
					type: 'post',
					data: '&SSMSStatus='+Stat+'&CompanyId='+ccid,
					success: function(data) {
						//alert('success');
						//$('.modulesclassid').click();
					}
				});
			});
</script>