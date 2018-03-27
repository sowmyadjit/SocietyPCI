<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>
<div id="content" class="col-lg-10 col-sm-10">
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Common Report</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
					
				</div>
				<div class="box-content">
				<script src="js/FileSaver.js"/>			
				<script src="js/tableExport.js"/>	
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info">
							<input type="button" value="Print" class="btn btn-info btn-sm print" style="float:right;margin:15px;" id="print">
					<label>Search Customer</label>
					<input class="SearchCustomer_usertable form-control" id="SearchCust_table" type="text" name="SearchCust" placeholder="SEARCH CUSTOMER">
					</div>
					<div id="toprint">
						<h2 style="text-align:center;">POTTERS COTTAGE INDUSTRIAL CO-OP SOCIETY LTD.</h2>
						<h3 style="text-align:center;">CHAKRASOUDHA, KULAI.</h3>
						<h3 style="text-align:center;">Report</h3>
						<div id="user_details_division">
							</div>
						<div id="loan_report">
						<div style="padding:15px;">
							<h2>Loan Details</h2>    
							<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
								<tr>
									<th style="width:20%;text-align: left;">
										Loan Guarantee:
									</th>
									<td style="width:30%;text-align: left;">
										Djitsoft
									</td>
									<th style="width:20%;text-align: left;">
										Loan Guarantee Address:
									</th>
									<td style="width:30%;text-align: left;">
										Mangalore.
									</td>
								</tr>
								<tr>
									<th style="width:20%;text-align: left;">
										Account Open Date:
									</th>
									<td style="width:30%;text-align: left;">
										23-03-2018
									</td>
									<th style="width:20%;text-align: left;">
										Request Amount:
									</th>
									<td style="width:30%;text-align: left;">
										100000
									</td>
								</tr>
							</table>
						</div>
						<div style="padding:15px;">
							<h2>Loan Allocation Details</h2>    
							<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
								<tr>
									<th style="width:20%;text-align: left;">
										Date
									</th>
									<th style="width:20%;text-align: left;">
										Amount
									</th>
									<th style="width:20%;text-align: left;">
										Total Loan Amount
									</th>
									<th style="width:20%;text-align: left;">
										Remaining Amount
									</th>
								</tr>
								<tr>
									<td style="width:30%;text-align: left;">
										10-03-2017
									</td>
									<td style="width:30%;text-align: left;">
										1000
									</td>
									<td style="width:30%;text-align: left;">
										20000
									</td>
									<td style="width:30%;text-align: left;">
										100
									</td>
								</tr>
							</table>
						</div>
						<div style="padding:15px;">
							<h2>Loan Repayment Details</h2>    
							<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
								<tr>
									<th>
										Date
									</th>
									<th>
										Disbursed
									</th>
									<th>
										Repaid(Prpl)
									</th>
									<th>
										Int.rvd
									</th>
									<th>
										Pint.rvd
									</th>
									<th>
										Others
									</th>
									<th>
										Balance
									</th>
									<th>
										Int.Date
									</th>
									<th>
										Sign
									</th>
								</tr>
								<tr>
									<td>
										10-03-2017
									</td>
									<td>
										1000
									</td>
									<td>
										20000
									</td>
									<td>
										100
									</td>
									<td>
									</td>
									<td>
										1000
									</td>
									<td>
										1000000
									</td>
									<td>
										10-03-2017
									</td>
									<td>
									</td>
								</tr>
							</table>
						</div>
						</div>
						<div id="deposit_report">
						<div style="padding:15px;">
							<h2>Deposit Details</h2>    
							<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
								<tr>
									<th style="width:20%;text-align: left;">
										Deposit nominee:
									</th>
									<td style="width:30%;text-align: left;">
										Djitsoft
									</td>
									<th style="width:20%;text-align: left;">
										Deposit Nominee Address:
									</th>
									<td style="width:30%;text-align: left;">
										Mangalore.
									</td>
								</tr>
								<tr>
									<th style="width:20%;text-align: left;">
										Account Open Date:
									</th>
									<td style="width:30%;text-align: left;">
										23-03-2018
									</td>
									<th style="width:20%;text-align: left;">
										Opening Balance:
									</th>
									<td style="width:30%;text-align: left;">
										100000
									</td>
								</tr>
							</table>
						</div>
						<div style="padding:15px;">
							<h2>Surety Details</h2>    
							<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
								<tr>
									<th>
										Date
									</th>
									<th>
										Disbursed
									</th>
									<th>
										Repaid(Prpl)
									</th>
									<th>
										Int.rvd
									</th>
									<th>
										Pint.rvd
									</th>
									<th>
										Others
									</th>
									<th>
										Balance
									</th>
									<th>
										Int.Date
									</th>
									<th>
										Sign
									</th>
								</tr>
								<tr>
									<td>
										10-03-2017
									</td>
									<td>
										1000
									</td>
									<td>
										20000
									</td>
									<td>
										100
									</td>
									<td>
									</td>
									<td>
										1000
									</td>
									<td>
										1000000
									</td>
									<td>
										10-03-2017
									</td>
									<td>
									</td>
								</tr>
							</table>
						</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>





<script>
		$('input.SearchCustomer_usertable').typeahead({
		ajax: '/SearchCustomer_usertable' 
		//source:SearchCustomer
		//SearchCustomer_usertable
	});
	$('.SearchCustomer_usertable').change(function(){
	user_id=$('#SearchCust_table').attr('data-value');
	console.log(user_id);
		$.ajax({
					url:'/user_details',
					type:'post',
					data:'&user_id='+user_id,
					success:function(data)
					{
						$("#user_details_division").html(data);
					}
	});
	});
	$report_type='DEPOSIT';
	//$report_type='LOAN';
	if($report_type=='DEPOSIT'){
		$('#deposit_report').show();
		$('#loan_report').hide();
	}
	else if($report_type=='LOAN'){
		$('#deposit_report').hide();
		$('#loan_report').show();
	}
	$('#loan_report').show();
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	$("#view").click(function(){
	console.log("bai");
	from_date=$("#from_date").val();
	to_date=$("#to_date").val();
	if($('#SearchPigmy').val()=='')
	{
		console.log('haiaaaaaaaaaaaaaa');
		$('#SearchPigmy').attr('data-value', 0);
	}
	searchvalue=$('#SearchPigmy').attr('data-value');
	//$('#SearchPigmy').attr('data-value', 0);
	$.ajax({
					url:'/pigmy_report',
					type:'post',
					data:'&from_date='+from_date+'&to_date='+to_date+'&allocation_id='+searchvalue,
					success:function(data)
					{
					console.log("hai");
					$("#report").html('');
					$("#report").html(data);
					}
	});
		}
	);
	
		$('input.SearchTypeahead').typeahead({
		//ajax: '/SearchPigmy'
        source:SearchPigmy
	});
	
	$('#excel').click(function(e){
	alert("excel");
	$('#expense_details').tableExport({type:'excel',escape:'false'});
	});	
</script>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			alert("print");
			$ac_no=10;
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>POTTERS COTTAGE INDUSTRIAL CO-OP SOCIETY LTD &nbsp;&nbsp;&nbsp;&nbsp; AC No-'+$ac_no+'</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});	
</script>