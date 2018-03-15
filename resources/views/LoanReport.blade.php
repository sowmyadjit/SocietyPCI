<link href="css/daterangepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->



<div id="content<?php echo $LoanRepo['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $LoanRepo['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>   Loan REPORT</h2>
					
					
				</div>
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<div class="col-md-4">
								<input class="SearchTypeahead<?php echo $LoanRepo['module']->Mid; ?> form-control" id="searchacc<?php echo $LoanRepo['module']->Mid; ?>" type="text" name="searchacc<?php echo $LoanRepo['module']->Mid; ?>" placeholder="SELECT ACCOUNT"> 
							</div>
							
							
							
							<div class="col-md-3">
								<div id="reportrange<?php echo $LoanRepo['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</div>
							
							<div class="col-md-2">
								<a class="btn btn-default SearchLoan<?php echo $LoanRepo['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-3 pull-left">
								<a class="btn btn-default PrintLoan<?php echo $LoanRepo['module']->Mid; ?>">PRINT</a>
								
								<a class="btn btn-default PrintAllLoan<?php echo $LoanRepo['module']->Mid; ?>">PRINT ALL</a>
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				</br></br>
				
				
				<div class='SearchRes<?php echo $LoanRepo['module']->Mid; ?>'> 
					<div  id="toprint<?php echo $LoanRepo['module']->Mid; ?>">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									
									<th>Loan Transaction Date</th>
									<th>FirstName</th>
									<th>MiddleName</th>
									<th>LastName</th>
									<th>Loan Type</th>
									<th>Branch Name</th>
									<th>Loan Amount</th>
									<th>Loan Amount Paid</th>
									<th>Remaining Loan Amount</th>
									<th>Loan Duration</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Action</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								@foreach ($LoanRepo['LoanRepo'] as $Loan_Report)
								<tr>
									<td class="hidden">{{ $Loan_Report->LoanTrans_LoanAlloc_ID }}</td>
									<td class="hidden">{{ $Loan_Report->LoanTrans_ID }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($Loan_Report->LoanReport_TranDate)); echo $trandate; ?> </td>
									<td>{{ $Loan_Report->FirstName }}</td>
									<td>{{ $Loan_Report->MiddleName }}</td>
									<td>{{ $Loan_Report->LastName }}</td>
									<td>{{ $Loan_Report->LoanType_Name }}</td>
									<td>{{$Loan_Report->BName}}
										<td>{{ $Loan_Report->LoanAlloc_LoanAmt}}</td>
										<td>{{ $Loan_Report->LoanTrans_AmtPaid}}</td>
										<td>{{ $Loan_Report->LoanTrans_RemTotal}}</td>
										<td>{{ $Loan_Report->LoanAlloc_Duration}}</td>
										<td>{{ $Loan_Report->LoanAlloc_SDate}}</td>
										<td>{{$Loan_Report->LoanAlloc_EDate}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						
						<div id='pagei<?php echo $LoanRepo['module']->Mid; ?>'>
							{!! $LoanRepo['LoanRepo']->render() !!}
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		
	</div>
	
	
	<script>
		
		$('.clickme<?php echo $LoanRepo['module']->Mid; ?>').click(function(e){
			$('.LoanClassId<?php echo $LoanRepo['module']->Mid; ?>').click();
		}); 
		
		$('.SearchLoan<?php echo $LoanRepo['module']->Mid; ?>').click(function(e){
			
			
			
			e.preventDefault();
			
			
			searchvalue=$('#searchacc<?php echo $LoanRepo['module']->Mid; ?>').data('value');
			
			//alert(searchvalue);
			
			$.ajax({
				url:'getLoanacc',
				type:'get',
				data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate,
				success:function(data)
				{
					//alert("success");
					//$('.box').html(data);
					$('.SearchRes<?php echo $LoanRepo['module']->Mid; ?>').html('');
					$('.SearchRes<?php echo $LoanRepo['module']->Mid; ?>').html(data);
					
					
					
				}
			});
			
			
			
			
			
			
		});
		
		
		
		
		$("#pagei<?php echo $LoanRepo['module']->Mid; ?> > ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc<?php echo $LoanRepo['module']->Mid; ?>");
			
		});
		$('.loadmc<?php echo $LoanRepo['module']->Mid; ?>').click(function(e)
		{
			e.preventDefault();
			$('#<?php echo $LoanRepo['module']->Mid; ?>_content').load($(this).attr('href'));
		});	
		
		
		
		$('input.SearchTypeahead<?php echo $LoanRepo['module']->Mid; ?>').typeahead({
			//ajax: '/GetSearchLoanAcc' //SEND BID OF THE LOGGED IN USER ALONG WITH  THIS
		source:GetSearchLoanAcc
		});
		
		
		
		
	</script>
	
	
	<!--DATE RANGE PICKER-->
	
	<script type="text/javascript">
		var sdate;
		var edate;
		$(function() {
			
			function cb(start, end) {
				$('#reportrange<?php echo $LoanRepo['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
				sdate=start.format('YYYY-MM-DD');
				edate=end.format('YYYY-MM-DD');
			}
			cb(moment(), moment());
			
			$('#reportrange<?php echo $LoanRepo['module']->Mid; ?>').daterangepicker({
				
				locale: {
					
					format: 'DD-MM-YYYY'
				},
				"showDropdowns": true,
				//"autoApply": true,
				//"minDate": "01-01-1950"
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				}
			}, cb);
			
		});
	</script>
	
	<script>
		
		$(function() {
			$(".PrintLoan<?php echo $LoanRepo['module']->Mid; ?>").click(function() {
				//alert('test');
				//$("#toprint").print();
				
				var divContents = $("#toprint<?php echo $LoanRepo['module']->Mid; ?>").html();
				var printWindow = window.open('', '', 'height=400,width=800');
				printWindow.document.write('<html><head><title>Loan transaction</title>');
				printWindow.document.write('</head><body >');
				printWindow.document.write(divContents);
				printWindow.document.write('</body></html>');
				printWindow.document.close();
				printWindow.print();
				//$.print("#toprint");
			});
		});
		
		
	</script>			