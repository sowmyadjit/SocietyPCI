<script src="js/bootstrap-typeahead.js"></script>   
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $pr['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $pr['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  PIGMY Report</h2>
					
					
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<div class="col-md-4">
								<input class="SearchTypeaheadPR<?php echo $pr['module']->Mid; ?> form-control" id="searchaccPR<?php echo $pr['module']->Mid; ?>" type="text" name="searchaccPR<?php echo $pr['module']->Mid; ?>" placeholder="SELECT PIGMY ACCOUNT"> 
							</div>
							
							
							
							<div class="col-md-3">
								<div id="reportrange<?php echo $pr['module']->Mid; ?>" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</div>
							
							<div class="col-md-2">
								<a class="btn btn-default SearchPig<?php echo $pr['module']->Mid; ?> pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-3 pull-left">
								<a class="btn btn-default PrintPig<?php echo $pr['module']->Mid; ?>">PRINT</a>
								
								<a class="btn btn-default PrintAllPig<?php echo $pr['module']->Mid; ?>">PRINT ALL</a>
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes<?php echo $pr['module']->Mid; ?>'>
					<div  id="toprint<?php echo $pr['module']->Mid; ?>">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>Account Number</th>
									<th>Name</th>
									<th>Date</th>
									<th>Transaction Date</th>
									<th>Old Account Number</th>
									<th>Agent Id</th>
									
									<th>Pigmi Type</th>
									<th>Current Balance</th>
									<th>Credited Amount</th>
									<th>Total Balance</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								
								@foreach($pr['data'] as $pigmi_transaction)
								<tr>
									<td class="hidden">{{ $pigmi_transaction->PigmiTrans_ID }}</td>
									<td>{{ $pigmi_transaction->PigmiAcc_No }}</td>
										<td>{{ $pigmi_transaction->FirstName }}.{{ $pigmi_transaction->MiddleName }}.{{ $pigmi_transaction->LastName }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($pigmi_transaction->PigReport_TranDate)); echo $trandate; ?></td>
									<td>{{ $pigmi_transaction->Trans_Date }}</td>
									<td>{{ $pigmi_transaction->old_pigmiaccno }}</td>
									<td>{{ $pigmi_transaction->Agentid }}</td>
									
									<td>{{ $pigmi_transaction->Pigmi_Type }}</td>
									<td>{{ $pigmi_transaction->Current_Balance }}</td>
									<td>{{ $pigmi_transaction->Amount }}</td>	
									<td>{{ $pigmi_transaction->Total_Amount }}</td>
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
					
					<div id='pagei<?php echo $pr['module']->Mid; ?>'>
						{!! $pr['data']->render() !!}
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>
<script>
	var $searchvalue;
	
	$("#pagei<?php echo $pr['module']->Mid; ?>ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc<?php echo $pr['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#maincontents').load($(this).attr('href'));
	});
	
	
	$('.clickme<?php echo $pr['module']->Mid; ?>').click(function(e){
		$('.companyclassid').click();
	}); 
	
	$('input.SearchTypeaheadPR<?php echo $pr['module']->Mid; ?>').typeahead({
		ajax: '/GetSearchpigmyAcc'
		//source:GetSearchpigmyAcc
	});
	
	$('.SearchPig<?php echo $pr['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		
		
		searchvalue=$('#searchaccPR<?php echo $pr['module']->Mid; ?>').data('value');
		All=$('#searchaccPR<?php echo $pr['module']->Mid; ?>').val();
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'getpigmyacc',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&AllorNot='+All,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes<?php echo $pr['module']->Mid; ?>').html('');
				$('.SearchRes<?php echo $pr['module']->Mid; ?>').html(data);
				
				
				
			}
		});
		
	});
	
	/*$('.SearchTypeahead').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		searchvalue=$('#searchacc').data('value');
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
		url:'getpigmyacc',
		type:'get',
		data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate,
		success:function(data)
		{
		//alert("success");
		$('.box').html(data);
		
		
		}
		});
	});*/
	
</script>




<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var $stdate=sdate;
	var edate;
	var $endate=edate;
	$(function() {
		
		function cb(start, end) {
			$('#reportrange<?php echo $pr['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
		}
		cb(moment(), moment());
		
		
		$('#reportrange<?php echo $pr['module']->Mid; ?>').daterangepicker({
			
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
		$(".PrintPig<?php echo $pr['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint<?php echo $pr['module']->Mid; ?>").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>PIGMY transaction</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
</script>