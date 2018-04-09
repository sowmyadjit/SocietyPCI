

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
				<div class="box-content">'
					<script src="js/FileSaver.js"/>			
					<script src="js/tableExport.js"/>
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info">
						
						<!-- <a href="crtloanallocation" class="btn btn-default crtlal">LOAN ALLOCATION</a>-->
						<a href="PersonalLoan" class="btn btn-default crtlal" s>LOAN ALLOCATION</a>
						<div class="col-md-5 pull-left">
							
						<select class="form-control" id="ExportType" name="ExportType">
							<option value="">SELECT TYPE TO EXPORT</option>
							<option value="word">WORD</option>
							<option value="excel">EXCEL</option>
							<option value="pdf">PDF</option>
							
						</select>
						</div>
						
						<div class="col-md-5 pull-right">
							<input class="SearchTypeahead form-control" id="SearchFd" type="text" name="SearchFd" placeholder="SEARCH PL ACCOUNT" style="display:inline-block;width:80%;">
							<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
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
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									
									<tr>
										@foreach ($PersLoan['data_all'] as $loan_allocation)
										<tr>
											<td class="hidden">{{ $loan_allocation->PersLoanAllocID }}</td>
											<td>{{ $loan_allocation->Uid }}</td>
											
											<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
											
											<td>{{ $loan_allocation->PersLoan_Number}}/{{ $loan_allocation->Old_PersLoan_Number}}</td>
											<td>{{ $loan_allocation->LoanAmt}}</td>
											<td>{{ $loan_allocation->StartDate}}</td>
											<td>{{$loan_allocation->EndDate}}</td>
											<td>{{$loan_allocation->RemainingLoan_Amt}}</td>
											<td>
												<div class="form-group">
													<div class="col-sm-12">
														<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="plloanrecepit/{{ $loan_allocation->PersLoanAllocID }}"/>
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
									<th>EMI Amount</th>
									<th>Loan Type</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
									
									<tr>
										@foreach ($PersLoan['data'] as $loan_allocation)
										<tr>
											<td class="hidden">{{ $loan_allocation->PersLoanAllocID }}</td>
											<td>{{ $loan_allocation->Uid }}</td>
											<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
											
											<td>{{ $loan_allocation->PersLoan_Number}}/{{ $loan_allocation->Old_PersLoan_Number}}</td>
											<td>{{ $loan_allocation->LoanAmt}}</td>
											<td>{{ $loan_allocation->StartDate}}</td>
											<td>{{$loan_allocation->EndDate}}</td>
											<td>{{$loan_allocation->RemainingLoan_Amt}}</td>
											<td><input value="{{$loan_allocation->EMI_Amount}}" class="edit_emi" data="{{ $loan_allocation->PersLoanAllocID }}" style="width: 50px;" /></td>
											<td><input value="{{$loan_allocation->LoanType_ID}}" class="edit_int_rate" data="{{ $loan_allocation->PersLoanAllocID }}"  style="width: 50px;" /></td>
											<td>
												<div class="form-group">
													<div class="col-sm-12">
														<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="plloanrecepit/{{ $loan_allocation->PersLoanAllocID }}"/>
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
								</tr>
								</thead>
								<tbody>
									
									<tr>
										@foreach ($PersLoan['data'] as $loan_allocation)
										<tr>
											<td>{{ $loan_allocation->Uid }}</td>
											<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
											
											<td>{{ $loan_allocation->PersLoan_Number}}/{{ $loan_allocation->Old_PersLoan_Number}}</td>
											<td>{{ $loan_allocation->LoanAmt}}</td>
											<td>{{ $loan_allocation->StartDate}}</td>
											<td>{{$loan_allocation->EndDate}}</td>
											<td>{{$loan_allocation->RemainingLoan_Amt}}</td>
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
							<script>
								
	$('.SearchTypeahead').typeahead({
		ajax: '/getplaccsearch',
	});
	
	$('.SearchTypeahead').change(function(e){
		searchvalue=$('#SearchFd').attr('data-value');
console.log("data before ajax:"+searchvalue);
		e.preventDefault();
		$.ajax({
			url:'plsearchacc',
			type:'get',
			data:'&SearchAccId='+searchvalue,
			success:function(data)
			{
				//alert("success");
				$('#SearchFd').val("");
				$('.SearchRes').html(data);
				
				var searchFD_data=$('#SearchFd').data("value");
console.log("data after ajax:"+searchFD_data);
				
			}
		});
	});
		
		
		
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
								
								/*$("ul.pagination li a").each(function() {
									
									$(this).addClass("loadmc");
									
									});
									$('.loadmc').click(function(e)
									{
									e.preventDefault();
									//alert($(this).attr('href'));
									$('#maincontents').load($(this).attr('href'));
								});	*/
								
								$("#pagei > ul.pagination li a").each(function() {
									
									$(this).addClass("loadmc");
									
								});
								$('.loadmc').click(function(e)
								{
									e.preventDefault();
									
									$('#content').load($(this).attr('href'));
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


<script>
	$(".edit_emi").change(function() {
		var id = $(this).attr("data");
		var value = $(this).val();
		console.log(value);
		
		$.ajax({
			url:"edit_emi",
			type:"post",
			data:"&id="+id+"&value="+value,
			success: function(data) {
				console.log("edit_emi: done");
			}
		});
	});
	
	$(".edit_int_rate").change(function() {
		var id = $(this).attr("data");
		var value = $(this).val();
		console.log(value);
		
		$.ajax({
			url:"edit_int_rate",
			type:"post",
			data:"&id="+id+"&value="+value,
			success: function(data) {
				console.log("edit_emi: done");
			}
		});
	});
</script>



