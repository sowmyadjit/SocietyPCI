
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
                <a class="clickme" >LOAN ALLOCATION DETAIL</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> LOAN ALLOCATION DETAIL</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info">
						
						<!-- <a href="crtloanallocation" class="btn btn-default crtlal">LOAN ALLOCATION</a>-->
						<a href="jewelLoan" class="btn btn-default crtlal">LOAN ALLOCATION</a>
						<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
						<div class="col-md-5 pull-right">
							<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH jewel ACCOUNT">
							
							
						</div>
						<div class="col-md-4">
								<select class="form-control" id="ExportType" name="ExportType">
									<option value="">SELECT TYPE TO EXPORT</option>
									<option value="word">WORD</option>
									<option value="excel">EXCEL</option>
									<option value="pdf">PDF</option>
									
								</select>
							</div>
					</div>
					<div class="SearchRes">
						<div id="">
							<script src="js/bootstrap-table.js"/>
							<script src="js/FileSaver.js"/>			
							<script src="js/tableExport.js"/>			
							<script src="js/jquery.base64.js"/>			
							<script src="js/sprintf.js"/>
							<script src="js/jspdf.js"/>
							<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
							
							<script src="js/bootstrap-table-export.js"/>
							<link href="css/bootstrap-table.css" rel='stylesheet' type="text/css" media="all">
							<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
							<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
							
							
							
							<div id="hee">
								
								<table class="table table-striped table-bordered bootstrap-datatable datatable responsive bootstrapTable" id="CustList" style='font-family:arial;font-size:10' data-tableexport-display="always">
							<thead>
								<tr>
									
									<th>Customer ID</th>
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
									<th>Jewel Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									@foreach ($jewelLoan['data_all'] as $loan_allocation)
									<tr>
										<td class="hidden">{{ $loan_allocation->JewelLoanId }}</td>
										<td>{{ $loan_allocation->JewelLoan_Uid }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td><a  href="userdetailscust/{{ $loan_allocation->JewelLoan_Uid }}" class="custdet">{{ $loan_allocation->JewelLoan_LoanNumber }}/{{ $loan_allocation->jewelloan_Oldloan_No }}</a></td>	
										
										<td>{{ $loan_allocation->JewelLoan_LoanAmount}}</td>
										<td>{{ $loan_allocation->JewelLoan_StartDate}}</td>
										<td>{{$loan_allocation->JewelLoan_EndDate}}</td>
										<td>{{$loan_allocation->JewelLoan_LoanRemainingAmount}}</td>
										<td>{{$loan_allocation->jewelloan_Description}}</td>
										<td>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="jlloanrecepit/{{ $loan_allocation->JewelLoanId }}"/>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							</div>
							</div>
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>Customer ID</th>
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
									<th>Closed?</th>
									<th>Last Paid Date</th>
									<th>Jewel Description</th>
									<th colspan="2">Net Weight</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									@foreach ($jewelLoan['data'] as $loan_allocation)
									<tr>
										<td class="hidden">{{ $loan_allocation->JewelLoanId }}</td>
										<td>{{ $loan_allocation->JewelLoan_Uid }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td><a  href="userdetailscust/{{ $loan_allocation->JewelLoan_Uid }}" class="custdet">{{ $loan_allocation->JewelLoan_LoanNumber }}/{{ $loan_allocation->jewelloan_Oldloan_No }}</a></td>	
										
										<td>{{ $loan_allocation->JewelLoan_LoanAmount}}</td>
										<td>{{ $loan_allocation->JewelLoan_StartDate}}</td>
										<td>{{$loan_allocation->JewelLoan_EndDate}}</td>
										<td>{{$loan_allocation->JewelLoan_LoanRemainingAmount}}</td>
										<td>{{$loan_allocation->JewelLoan_Closed}}</td>
										<td>{{$loan_allocation->JewelLoan_lastpaiddate}}</td>
										<td>{{$loan_allocation->jewelloan_Description}}</td>
										<td id="net_wt_{{$loan_allocation->JewelLoanId}}">{{$loan_allocation->jewelloan_Net_weight}} </td>
										<td><span class="glyphicon glyphicon-pencil btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="edit_net_wt('{{$loan_allocation->jewelloan_Net_weight}}', '{{$loan_allocation->JewelLoanId}}');" ></span></td>
										<td>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="jlloanrecepit/{{ $loan_allocation->JewelLoanId }}"/>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div id="toprint" style="position:fixed;opacity:0;">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>Customer ID</th>
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
									<th>Closed?</th>
									<th>Last Paid Date</th>
									<th>Jewel Description</th>
									<th>Net Weight</th>
			
								</tr>
							</thead>
							<tbody>
								
								<tr>
									@foreach ($jewelLoan['data'] as $loan_allocation)
									<tr>
										<td>{{ $loan_allocation->JewelLoan_Uid }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td>{{ $loan_allocation->JewelLoan_LoanNumber }}/{{ $loan_allocation->jewelloan_Oldloan_No }}</td>	
										
										<td>{{ $loan_allocation->JewelLoan_LoanAmount}}</td>
										<td>{{ $loan_allocation->JewelLoan_StartDate}}</td>
										<td>{{$loan_allocation->JewelLoan_EndDate}}</td>
										<td>{{$loan_allocation->JewelLoan_LoanRemainingAmount}}</td>
										<td>{{$loan_allocation->JewelLoan_Closed}}</td>
										<td>{{$loan_allocation->JewelLoan_lastpaiddate}}</td>
										<td>{{$loan_allocation->jewelloan_Description}}</td>
										<td>{{$loan_allocation->jewelloan_Net_weight}} </td>
									</tr>
									@endforeach
								</tbody>
							</table>
							</div>
<?php /*						
						<div id='pagei'>
							{!! $jewelLoan['data']->render() !!}
						</div>*/?>
						
					</div>
				</div>
			</div>
			</div>
			
			
			
<!-- model--->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Jewel Net Weight</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-sm-5">Net Weight:</label>
					<div class="col-md-7">
						<input type="text" id="net_wt" name="net_wt" class="form-control">
						<input type="text" id="jewel_alloc_id" name="jewel_alloc_id" class="form-control hidden">
					</div>
				</div>
				<br>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm edit btn-success save" data-dismiss="modal" >SAVE</button>
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
				
			</div>
		</div>
		
	</div>
</div>		
<!--- model close--->
			
			
		<script>
		
		$('#hee').hide();
								
								$('#ExportType').change( function(e) {
									type=$('#ExportType').val();
									
									if(type=="word")
									{
										
										$('#CustList').tableExport({type:'doc',escape:'false',fileName: 'tableExport'});
									}
									else if(type=="excel")
									{
										$('#CustList').tableExport({type:'excel',escape:'false'});
									}
									else if(type=="pdf")
									{
										//alert("Please Select Type For Export");
										$('#CustList').tableExport({type:'pdf',escape:'false',fileName: 'tableExport'});
										
									}
									
								});
								
			$('.clickme').click(function(e)
			{
				$('.pigmiallocclassid').click();
			});
			$('.crtlal').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			$('.edtbtn').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			$('.custdet').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
			
			/*$("ul.pagination li a").each(function() {
				
				$(this).addClass("loadmc");
				
			});
			$('.loadmc').click(function(e)
			{
				e.preventDefault();
				//alert($(this).attr('href'));
				$('#maincontents').load($(this).attr('href'));
			});	*/	
			
			$('input.SearchTypeahead').typeahead({
				ajax: '/getjlaccsearch'
			});
			
			$('.SearchTypeahead').change(function(e){
				searchvalue=$('#SearchFd').attr('data-value');
				
				e.preventDefault();
				$.ajax({
					url:'/jlsearchacc',
					type:'get',
					data:'&SearchAccId='+searchvalue,
					success:function(data)
					{
						//alert("success");
						$('#SearchFd').val("");
						$('.SearchRes').html(data);
						//
						//$('#SearchFd').data("");
						
					}
				});
			});
			$("#pagei > ul.pagination li a").each(function() {
				
				$(this).addClass("loadmc");
				
			});
			$('.loadmc').click(function(e)
			{
				e.preventDefault();
				
				$('#content').load($(this).attr('href'));
			});
		</script>
		
		

<script>
/*-------------------------------------------------*/
function edit_net_wt(net_wt, jewel_alloc_id)
{
	$('#net_wt').val(net_wt);
	$('#jewel_alloc_id').val(jewel_alloc_id);
}

$('.save').click( function(e) {
	net_wt=$('#net_wt').val();
	jewel_alloc_id=$('#jewel_alloc_id').val();
	$.ajax({
		url: 'edit_jl_net_wt',
		type: 'post',
		data:'&net_wt='+net_wt+'&jewel_alloc_id='+jewel_alloc_id,
		success: function(data) {
			//alert('success');
			$("#net_wt_"+jewel_alloc_id).html(net_wt);
		}
	});
	
	
});
</script>	
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});
	
	
</script>