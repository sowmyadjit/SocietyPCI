
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->

<link href="css/daterangepicker.css" rel='stylesheet'>


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
                <a class="clickme" >Report</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  PIGMY Branch Wise Report</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<!--<div class="box-content">
					<div class="alert alert-info">
					<a href="#" class="btn btn-default crtds">Create Company</a>
				</div>-->
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							<!--<div class="col-md-4">
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT PIGMY ACCOUNT"> 
							</div>-->
							
							<!--<label class="control-label col-md-1">BRANCH:</label>-->
							<label class="control-label inline col-md-2">BRANCH:
								<select class="form-control BranchListDD"  id="BranchListDD" name="BranchListDD" onchange="BranchDDChange();">  
									<option value="ALL">ALL</option>
									<?php foreach($PigmyBranchWise['BranchList'] as $key){
										echo "<option value='".$key->Bid."' >" .$key->BName."";
										echo "</option>";
									}?>
								</select>
							</label>
							
							
							<!--<label class="control-label col-md-1">AGENT:</label>-->
							<label class="control-label inline col-md-3">AGENT:
								
								<select class="form-control AgentListDD"  id="AgentListDD" name="AgentListDD">
								</select>
								
							</label>
							
							
							
							<div class="inline col-md-3">  
								<label class="control-label pull-left">DATE RANGE:
									
									<div id="reportrange"  style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
								
								
							</div>
							
							
							
							<div class="col-md-2">
								<a class="btn btn-default SearchBWPig pull-left">SEARCH</a>
							</div>
							
							<div class="col-md-1 pull-left">
								<a class="btn btn-default PrintPig">PRINT</a>
								
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes'>
					<div  id="toprint">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>BRANCH</th>
									<th>AGENT</th>
									<th>Account Number</th>
									
									<th>Transaction Date</th>
									<!--<th>Date</th>
									<th>Old Account Number</th>-->
									
									<th>Pigmi Type</th>
									<th>Current Balance</th>
									<th>Credited Amount</th>
									<th>Total Balance</th>
									
								</tr>
							</thead>
							
							<tbody>
								
								
								@foreach($PigmyBranchWise['PigmiReportBWData'] as $PABD)
								<tr>
									<td class="hidden">{{ $PABD->PigmiTrans_ID }}</td>
									<td>{{ $PABD->BName }}</td>
									<td>{{ $PABD->FirstName }}.{{ $PABD->MiddleName }}.{{ $PABD->LastName }}</td>
									<td>{{ $PABD->PigmiAcc_No }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($PABD->PigReport_TranDate)); echo $trandate; ?></td>
									<!--<td>{{ $PABD->Trans_Date }}</td>-->
									<!--<td>{{ $PABD->old_pigmiaccno }}</td>-->
									
									<td>{{ $PABD->Pigmi_Type }}</td>
									<td>{{ $PABD->Current_Balance }}</td>
									<td>{{ $PABD->Amount }}</td>	
									<td>{{ $PABD->Total_Amount }}</td>
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
					
					<div id='pagei'>
						{!! $PigmyBranchWise['PigmiReportBWData']->render() !!}
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>
<script>
	$('document').ready(function(){
		
		BranchDD=$('#BranchListDD').val();
		GetAgent(BranchDD);
		
	});
	
	
	function BranchDDChange() {
		//preventDefault();
		BranchDD=$('#BranchListDD').val();
		//alert(BranchDD);
		GetAgent(BranchDD);
	}
	
	function GetAgent(BDD)
	{
		
		$.ajax({
			
			url:'GetBranchAgentsDD',
			type:'get',
			data:'&BranchID='+BDD,
			success:function(data)
			{
				var sel = document.getElementById('AgentListDD');
				for (i = sel.length - 1; i >= 0; i--) {
					sel.remove(i);
				}
				$("#AgentListDD").append("<option value=\"ALL\">ALL</option>");
				var jsonData = JSON.parse(data);
				for (var i = 0; i < jsonData.length; i++) {
					var prop = jsonData[i];
					$("#AgentListDD").append("<option value=\"" + prop.Uid + "\">" + prop.BCode +"  -  "+ prop.FirstName +" "+ prop.MiddleName +" "+ prop.LastName +"</option>");
				}
			}
		});
		
	}
	
</script>

<script>
	var $searchvalue;
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#maincontents').load($(this).attr('href'));
	});
	
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	
	$('.SearchBWPig').click(function(e){
		
		BrDD=$('#BranchListDD').val();
		AgDD=$('#AgentListDD').val();
		
		e.preventDefault();
		$.ajax({
			url:'GetPigmyTranBranchWiseData',
			type:'get',
			data:'&BranchDD='+BrDD+'&AgentDD='+AgDD+'&startdate='+sdate+'&enddate='+edate,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	
	
</script>




<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var $stdate=sdate;
	var edate;
	var $endate=edate;
	$(function() {
		
		function cb(start, end) {
			
			$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			//sdate=start.format('DD/MM/YYYY');
			//edate=end.format('DD/MM/YYYY');
			//alert(sdate);
			//alert(edate);
			//alert(moment());
			
		}
		cb(moment(), moment());
		
		
		$('#reportrange').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY',
				
			},
			"showDropdowns": true,
			"opens": "left",
			
			//"autoApply": true,
			
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
		$(".PrintPig").click(function() {
			//alert('test');
			//$("#toprint").print();
			
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>SB transaction</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
</script>