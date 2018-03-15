<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $fda['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	
	<!--<div>
        <ul class="breadcrumb">
		<li>
		<a href="#">Home</a>
		</li>
		<li>
		<a class="clickme" >FD ALLOCATION DETAIL</a>
		</li>
		</ul>
	</div>-->
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $fda['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> FD ALLOCATION DETAIL</h2>
				</div>
				
				<div class="box-content">
					
					
					
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
								
								<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
								<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
								<a href="crtfdallocation" class="btn btn-default crtpal<?php echo $fda['module']->Mid; ?>">FD ALLOCATION</a>
								
								<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
								<div class="pull-right col-md-4">
								
									<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH FD ACCOUNT">
									
								</div>
								
								
								<div class="col-md-4">
									<select class="form-control" id="ExportType" name="ExportType">
										<option value="">SELECT TYPE OF EXPORT</option>
										<option value="word">WORD</option>
										<option value="excel">EXCEL</option>
										<option value="pdf">PDF</option>
										
									</select>
								</div>
								
							</div>
							
							
								
							
							
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
								
								<table class="table table-striped table-bordered bootstrap-datatable datatable responsive bootstrapTable" id="CustList1" style='font-family:arial;font-size:10' data-tableexport-display="always">
									
									<!--<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">-->
									<thead>
										<tr>
											
											<th>Customer ID1</th>
											<th>Certificate Number1</th>
											
											<th>Name</th>
											
											
											<th>Number Of Days</th>
											<th>Interest</th>
											<th>Deposit Amount</th>
											<th>Start Date</th>
											<th>Mature Date</th>
											<th>Maturity Amount</th>
											<th>Remarks</th>
											<th colspan=2><center>ACTION</center></th>
											
											
										</tr>
									</thead>
									<tbody>
										
										<tr>
											@foreach ($fda['data_all'] as $fdallocation)
											<tr>
												<td>{{ $fdallocation->Uid }}</td>
												<td>{{ $fdallocation->Fd_CertificateNum }}</td>
												<td>{{ $fdallocation->FirstName }}.{{ $fdallocation->MiddleName}}.{{ $fdallocation->LastName }}</td>		
												<td>{{ $fdallocation->Days }}</td>
												<td>{{ $fdallocation->FdInterest }}</td>
												<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
												<td>{{$fdallocation->Fd_StartDate}}
												<td>{{ $fdallocation->Fd_MatureDate}}</td>
												<td>{{ $fdallocation->Fd_TotalAmt}}</td>
												<td>{{ $fdallocation->Fd_Remarks}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
										
									</div>
									<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
										<thead>
											<tr>
												
												<th>Customer ID</th>
												<th>Certificate Number</th>
												
												<th>Name</th>
												
												
												<th>Number Of Days</th>
												<th>Interest</th>
												<th>Deposit Amount</th>
												<th>Start Date</th>
												<th>Mature Date</th>
												<th>Maturity Amount</th>
												<th>Remarks</th>
												<th colspan=3><center>ACTION</center></th>
												
												
											</tr>
										</thead>
										<tbody>
											
											<tr>
												@foreach ($fda['data'] as $fdallocation)
												<tr>
													<td class="hidden">{{ $fdallocation->Fdid }}</td>
													<td class="hidden">{{ $fdallocation->FdTid }}</td>
													<td class="hidden">{{ $fdallocation->Uid }}</td>
													
													
													<td>{{ $fdallocation->Uid }}</td>
													<td>{{ $fdallocation->Fd_CertificateNum }}</td>
													
													
													<td>{{ $fdallocation->FirstName }}.{{ $fdallocation->MiddleName}}.{{ $fdallocation->LastName }}</td>		
													
													
													<td>{{ $fdallocation->Days }}</td>
													<td>{{ $fdallocation->FdInterest }}</td>
													<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
													<td>{{$fdallocation->Fd_StartDate}}
														<td>{{ $fdallocation->Fd_MatureDate}}</td>
														<td>{{ $fdallocation->Fd_TotalAmt}}</td>
														<td>{{ $fdallocation->Fd_Remarks}}</td>
														<td>
															<input type="button" value="CERTIFICATE" class="btn btn-success btn-sm CertiBtn" href="FdCertificate/{{ $fdallocation->Fdid }}"/>
														</td>
														<td>
															
															<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="FDReceipt/{{ $fdallocation->Fdid }}"/>
															
														</td>
														
														<td>
															
															<input type="button" value="EDIT" class="btn btn-info btn-sm ReceiptPrint" href="FDedit/{{ $fdallocation->Fdid }}"/>
															
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
												<th>Certificate Number</th>										
												<th>Name</th>
												<th>Number Of Days &nbsp;</th>
												<th>Interest</th>
												<th>Deposit Amount</th>
												<th>Start Date</th>
												<th>Mature Date</th>
												<th>Maturity<br>Amount</th>
												<th>Remarks</th>
												
												
											</tr>
										</thead>
										<tbody>
											
											<tr>
												@foreach ($fda['data'] as $fdallocation)
												<tr>
													
													
													<td>{{ $fdallocation->Uid }}</td>
													<td>{{ $fdallocation->Fd_CertificateNum }}</td>
													
													
													<td>{{ $fdallocation->FirstName }}.{{ $fdallocation->MiddleName}}.{{ $fdallocation->LastName }}</td>		
													
													
													<td>{{ $fdallocation->Days }}</td>
													<td>{{ $fdallocation->FdInterest }}</td>
													<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
													<td>{{$fdallocation->Fd_StartDate}}
														<td>{{ $fdallocation->Fd_MatureDate}}</td>
														<td>{{ $fdallocation->Fd_TotalAmt}}</td>
														<td>{{ $fdallocation->Fd_Remarks}}</td>
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
					
					
					$('.crtpal').hide();
					$('.msg1').hide();
					$('.msg2').hide();
					
					
					$temp1="<?php echo $fda['open'];?>";
					$temp2="<?php echo $fda['close'];?>";
					if($temp1==1)
					{
						if($temp2==0)
						{
							$('.crtpal').show();
						}
						else if($temp2==1)
						{
							
							$('.crtpal').hide();
							$('.msg2').show();
							//$(".modal_btn").click();
							
						}
					}
					else if($temp1==0)
					{
						
						$('.crtpal').hide();
						$('.msg1').show();
						//$(".modal_btn").click();
					}
					
					
					
					$('input.SearchTypeahead').typeahead({
						ajax: '/SearchFdAllocation'
						//source:SearchFdAllocation
					});
					
					$('.SearchTypeahead').change(function(e){
						searchvalue=$('#SearchFd').data('value');
						//$('SearchTypeahead').typeahead('destroy');
						e.preventDefault();
						$.ajax({
							url:'/FDSearchView',
							type:'get',
							data:'&SearchAccId='+searchvalue,
							success:function(data)
							{
								alert("success");
								$('.SearchRes').html(data);
								//$('#SearchFd').val("");
								//$('#SearchFd').data("");
								
							}
						});
					});
					$('.clickme').click(function(e)
					{
						$('.fdallclassid').click();
					});
					
					$('.CertiBtn').click(function(e){
						e.preventDefault();
						//alert($(this).attr('href'));
						$('.box-inner').load($(this).attr('href'));
					});
					
					$('.ReceiptPrint').click(function(e){
						e.preventDefault();
						//alert($(this).attr('href'));
						$('.box-inner').load($(this).attr('href'));
					});
					
					$('.crtpal<?php echo $fda['module']->Mid; ?>').click(function(e)
					{
						e.preventDefault();
						//alert($(this).attr('href'));
						$('.bdy_<?php echo $fda['module']->Mid; ?>').load($(this).attr('href'));
					});
					
					$("#pagei<?php echo $fda['module']->Mid; ?> > ul.pagination li a").each(function() {
						
						$(this).addClass("loadmc<?php echo $fda['module']->Mid; ?>");
						
					});
					
					$('.loadmc<?php echo $fda['module']->Mid; ?>').click(function(e)
					{
						e.preventDefault();
						$('#<?php echo $fda['module']->Mid; ?>_content').load($(this).attr('href'));
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