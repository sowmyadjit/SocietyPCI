        	 <script src="js/bootstrap-typeahead.js"></script>
		<noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>
			</div>
        </noscript>

<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a class="clickme" >Pending Pigmy</a>
					</li>
				</ul>
			</div>
			
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
		
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Pending Pigmy Amount</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
	
				<div class="box-content">
					<!--<div class="alert alert-info">
					   <a href="acccreation" class="btn btn-default crtacc">Create Account</a>
					   <a href="ViewCreateJointAcc" class="btn btn-default JointAcc">Create Joint Account</a>
					   <a href="ViewMinorAccHome" class="btn btn-default ViewMinAcc">Create Minor Account</a>
					   <a href="sbacclist" class="btn btn-default crtacc pull-right">SB Account List</a>
					   <a href="rdacclist" class="btn btn-default crtacc pull-right">RD Account List</a>
					   
					  <!-- <input class="SearchTypeahead" id="searchacc" type="text" name="searchacc" placeholder="SELECT Account Number"> 
					   <input class="SearchOldAccTypeahead" id="searcholdacc" type="text" name="searcholdacc" placeholder="SELECT Account Number"> 
					  
					  
					</div> -->
					
					
					
					
					
					
					
					
					<!--<div class="alert alert-info">
					<div class="form-group">
					
					<div class="row table-row">
					
					<div class="col-md-6">
					<label class="control-label col-sm-6">SELECT Account Number:</label>
					<div class="col-md-6">
					<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT Account Number"> 
					</div>
					</div>
					
					
					
					<div class="col-md-6">
					<label class="control-label col-md-6">SELECT Old Account Number:</label>
					<div class="col-md-6">
					   <input class="SearchOldAccTypeahead form-control" id="searcholdacc" type="text" name="searcholdacc" placeholder="SELECT Old Account Number"> 
					 </div>
					 </div>
					
					 
					 </div>
					  </div>
					  </div>-->
					 
					<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
							<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
					
   
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						
						<th>Branch</th>
						<th>Agent Name</th>
						<th>Collection Date</th>
						<th>Pending Amount</th>
						<th>Status</th>
						
						
						
						<th>Mobile Number</th>
					
						
					<th>Action</th>
					</tr>
					</thead>
					
					<tbody>

					@foreach ($PendingList['data'] as $PpAmtList)
					<tr>
						<td class="hidden">{{ $PpAmtList->PpId }}</td>
						
						<td>{{ $PpAmtList->BName }}</td>
				<td>{{ $PpAmtList->FirstName }} . {{ $PpAmtList->MiddleName }} . {{ $PpAmtList->LastName }}</td>
		<td><?php $trandate=date("d-m-Y",strtotime($PpAmtList->PendPigmy_CollectionDate)); echo $trandate; ?></td>
						
						<td>{{ $PpAmtList->PendPigmy_PendingAmount }}</td>
						<td>{{ $PpAmtList->PendPigmy_Status }}</td>
						
						
						
						<td>{{ $PpAmtList->MobileNo }}</td>
						
						
						
						<td>
						
						<div class="form-group">
										<div class="col-sm-12">
						<input type="button" value="RECEIVE" class="btn btn-info btn-sm edtbtn" href="ReceivePigmiPendingAmtView/{{ $PpAmtList->PpId }}"/>
										</div>
									</div>
						
						</td>
					</tr>
			 
					@endforeach
					</tbody>
					
					</table>
					
					 
					
					
				</div>	
				<div id='pagei'>
				{!! $PendingList['data']->render() !!}
				</div>
			
			
				</div>
			</div>	
		</div>	
	</div>	
</div>	



<script>
	  
	  $('.edtbtn').hide();
	$('.msg1').hide();
	$('.msg2').hide();
	
	
	$temp1="<?php echo $PendingList['open'];?>";
				$temp2="<?php echo $PendingList['close'];?>";
				if($temp1==1)
				{
					if($temp2==0)
					{
						$('.edtbtn').show();
					}
					else if($temp2==1)
					{
						
						$('.edtbtn').hide();
						$('.msg2').show();
						//$(".modal_btn").click();
						
					}
				}
				else if($temp1==0)
				{
					
					$('.edtbtn').hide();
					$('.msg1').show();
					//$(".modal_btn").click();
				}
	  
	  
	  
	  
	  $('.clickme').click(function(e)
{
	$('.accclassid').click();
}); 
	  $('.crtacc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
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