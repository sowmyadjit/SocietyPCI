<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $m['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
	<!--<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a>
			</li>
			<li>
				<a class="clickme" >Member</a>
			</li>
		</ul>
	</div>-->
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $m['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Members Detail</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<div class="form-group">
							<div class="row table-row">
								<!--<a href="memberview" class="btn btn-default crtmem">Create Member</a>-->
								<div class="col-md-4">
									<input class="SearchTypeahead form-control" id="SearchMemb" type="text" name="SearchMemb" placeholder="SEARCH MEMBER">
								</div>
								<div class="col-md-4">
									<button class="btn btn-default pull-right" id="member_details_btn">MEMBER DETAILS</button>
								</div>
								<div class="col-md-4">
									<button class="btn btn-default pull-right" id="share_details_btn">SHARE DETAILS</button>
								</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="SearchRes">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									
									<th>MEMBERSHIP NO</th>
									<th>MEMBERSHIP Class</th>
									<th>Name</th>
									<th>Father Name</th>
									<th>Date</th>
									<th>Status</th>
									<!--<th>Share Class</th>
										<th>Number Of Shares</th>
									<th>Total Share Price</th>-->
									<th>No. of Shares</th>
									<th>Total Share Amt</th>
									<th>Remarks</th>
									<th>ACTION</th>
								</tr>
								
							</thead>
							
							<tbody>
								
								@foreach ($m['members'] as $members)
								<tr>
									<td class="hidden">{{ $members->Memid }}</td>
									<td>{{ $members->Memid }}/{{ $members->Member_no }}</td>
									<td>{{ $members->classtype }}</td>
									
									<td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}.{{ $members->MiddleName }}.{{ $members->LastName }}</a></td>
									<td>{{ $members->FatherName }}</td>
									<td><?php $crdate=date("d-m-Y",strtotime($members->CreatedDate)); echo $crdate; ?> </td>
									
									<td>{{$members->status}}</td>
									<td>{{$members->no_of_shares}}</td>
									<td>{{$members->total_share_amt}}</td>
									
									<td>{{$members->Remarks}}</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="memberdetails/{{ $members->Memid }}/edit"/>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
								
							</tbody>
							
						</table>
				
				<div id='pagei<?php echo $m['module']->Mid; ?>'>
					{!! $m['members']->render() !!}
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$('input.SearchTypeahead').typeahead({
		ajax: '/SearchMember' 
		//source:SearchMember
		});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchMemb').data('value');
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'/MemSearchView',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('.SearchRes').html(data);
				
				
			}
		});
	});
	
	
	
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
	
	$('.memdet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $m['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $m['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $m['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
</script>

<script>
	$("#share_details_btn").click(function() {
		$.ajax({
			url:"share_details",
			type: "post",
			success: function(data) {
				$(".box-inner").html(data);
				console.log("done");
				
			}
		});
	});
</script>

<script>
	$("#member_details_btn").click(function() {
		$.ajax({
			url:"member_details",
			type: "post",
			success: function(data) {
				$(".box-inner").html(data);
				console.log("done");
			}
		});//*/
	});
</script>
