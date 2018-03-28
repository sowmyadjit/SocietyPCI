<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box_bdy_ box col-md-12">
			<div class="bdy_ box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Service Charge Calculation</h2>
					
					
				</div>
				
				<div class="box-content">
					<script src="js/FileSaver.js"/>			
					<script src="js/tableExport.js"/>				
					<div class="alert alert-info">						
						<!--<input type="button" value="Print" class="btn btn-info btn-sm" id="print">-->	
					<button class="btn btn-info btn-sm" id="already_calculated_btn">Already Calculated Service Charge</button>
					<button class="btn btn-info btn-sm" id="calculte_btn">Calculate Value</button>
					</div>
					<div>
					<div style="height:1500px;" id="already_calculated">
					</div>
					</div>
					<div id="calculte">
					<div class="form-group">
						<label class="control-label col-sm-4">Select Interest Duration:</label>
						<div class="col-md-4">
							<select class="form-control" id="account_type" name="calculation_month"> 
								<option value="">--Select Type--</option>
								<option value="SB">SB</option>
								<option value="PIGMY">PIGMY</option>
							</select>
						</div>
						<br>
					<br>
					</div>
					<br>
					<br>
					<div class="form-group">
						<label class="control-label col-sm-4">Select Year:</label>
						<div class="col-md-4">
							<input type="number" style="width:100%;" id="year">
						</div>
					</div>
					<br>
					<br>
					<div>
					<button style="margin-left: auto;display: inherit;margin-right: auto;" id="calculate">Calculate</button>
					</div>
					<div id="calulated_result">
					</div>
					<br>
					<br>
					</div>
					<br>
					<br>
			</div>
		</div>
	</div>

<script>
	$('#calculte').hide();
	$('#already_calculated').hide();
	$('#already_calculated_btn').click(function(){
		$('#calculte').hide();
		$.ajax({
		url: 'calc_service_charge_alrdy_cal',
		type: 'post',
		data:'',
		success: function(data) {
			$('#already_calculated').show();
			$("#already_calculated").html(data);
		}
		
	});
	});
	$('#calculte_btn').click(function(){
		$('#already_calculated').hide();
		$('#calculte').show();
	});
	$('.clickme').click(function(e){
		$('.expenceclassid').click();
	});

	$('#excel').click(function(e){
	$('#expense_details').tableExport({type:'excel',escape:'false'});
	});						   
	$('#calculate').click(function(){
	type=$('#account_type').val();
	year=$('#year').val();
	console.log("account type",account_type);
	console.log("year",year);
	$.ajax({
		url: 'calc_service_charge',
		type: 'post',
		data:'&type='+type+'&year='+year,
		success: function(data) {
			$("#calulated_result").html(data);
			alert('success');
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