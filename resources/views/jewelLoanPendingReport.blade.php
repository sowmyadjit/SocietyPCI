<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
			<script src="js/FileSaver.js"/>			
			<script src="js/tableExport.js"/>
				<div  id="toprint<?php// echo $loanjewel['module']->Mid; ?>">
				<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
								<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
								<!--this css should be inside the toprint div , for printing the table borders-->    
					<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
					<table class="table-striped table-bordered bootstrap-datatable datatable responsive" id="jewel_auction">
						
						<thead>
							<tr>
								<th><input id="select_all" type="checkbox" /></th>
								<th>NAME</th>
								<th>LOAN Number</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Description</th>
								<th>Gross Weight</th>
								<th>Net Weight</th>
								<th>Appraisal Value</th>
								<th>LoanAmount</th>
								<th>Remaining Amount</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $jew)
							<tr>
								<td><input class="chkboxs" id="{{$jew->JewelLoanId}}" type="checkbox" /></td>
								<td>{{ $jew->FirstName }} {{$jew->LastName}}</td>
								<td>{{ $jew->JewelLoan_LoanNumber }}</td>
								<td>{{ $jew->JewelLoan_StartDate }}</td>
								<td>{{ $jew->JewelLoan_EndDate }}</td>
								<td>{{ $jew->jewelloan_Description }}</td>
								<td>{{ $jew->GrossWeight }}</td>
								<td>{{ $jew->NetWeight }}</td>
								<td>{{ $jew->JewelLoan_AppraisalValue }}</td>
								<td>{{ $jew->JewelLoan_LoanAmount }}</td>
								<td>{{ $jew->JewelLoan_LoanRemainingAmount }}</td>
							</tr>
							@endforeach
							<tr>
								<input class="" id="repay_all" type="button" value="Send to Auction" />
							</tr>
						</tbody>
					</table>
					<div id="toprint" style="position:fixed;opacity:0;">
						<table class="table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>NAME</th>
								<th>LOAN Number</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Description</th>
								<th>Gross Weight</th>
								<th>Net Weight</th>
								<th>Appraisal Value</th>
								<th>LoanAmount</th>
								<th>Remaining Amount</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $jew)
							<tr>
								<td>{{ $jew->FirstName }} {{$jew->LastName}}</td>
								<td>{{ $jew->JewelLoan_LoanNumber }}</td>
								<td>{{ $jew->JewelLoan_StartDate }}</td>
								<td>{{ $jew->JewelLoan_EndDate }}</td>
								<td>{{ $jew->jewelloan_Description }}</td>
								<td>{{ $jew->GrossWeight }}</td>
								<td>{{ $jew->NetWeight }}</td>
								<td>{{ $jew->JewelLoan_AppraisalValue }}</td>
								<td>{{ $jew->JewelLoan_LoanAmount }}</td>
								<td>{{ $jew->JewelLoan_LoanRemainingAmount }}</td>
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
<div id='aa'>
</div>
<script>
	$(document).ready(function(){
		$("#select_all").click(function(){
			if($('#select_all').prop('checked')) {
				$(".chkboxs").prop('checked', true);
			} else {
				$(".chkboxs").prop('checked', false);
			}
			
			
		});
		
		$("#repay_all").click(function(){
			var a="";
			$('.chkboxs').each(function(){
				if($(this).prop('checked')) {
					if(a == "")
						a += $(this).attr('id');
					else
					a = a + "," + $(this).attr('id');
				}
			});
			alert(a);

			$.ajax({
						url:'/sendToJewelAuction',
						type:'get',
						data:'&val='+a,
						success:function(data)
						{
							alert("success");
/*							$('#aa').html(data);*/
							
						}
					});
			refershtab(89,"Jewel Loan Pending Report","jewelLoanPendingReport");
		});
		
		$("#pagei > ul.pagination li a").each(function() {
			$(this).addClass("loadmc");
		});
	
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			$('#content').load($(this).attr('href'));
		});
		
		
		
		
	});
</script>
<script src="js/sidebar/sidebar.js"></script>
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
