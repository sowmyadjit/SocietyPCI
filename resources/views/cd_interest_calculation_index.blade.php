<?php
	$date_str = date("Y-03-31");
	$date = strtotime($date_str);
?>
<script src="js/daterangepicker.js"></script>
<link href="css/daterangepicker.css" rel='stylesheet'>

					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> Compulsory Deposit Interest Calculation</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
				
				
					<div class="alert alert-info" style="height:60px;">
						<form id="form_data">
							<div class="form-group chequedte col-md-12">
								<label class="col-md-4 control-label">DATE</label>
								<div class="col-md-4 date">
									
									<div class="input-group input-append">
										<input type="text" name="date" id="date" class="form-control" value="{{date('d-m-Y',$date)}}"/>
										<span class="input-group-addon add-on">
											<span class="glyphicon glyphicon-calendar">
											</span>
											<b class="caret"></b>
										</span> 
									</div>
									
								</div>
								<div class="col-md-4 date">
									<button id="bt_calculate" >Calculate</button>
								</div>
							</div>
						</form>
					</div>
					
					
					kjfbkjdfj<br >zjb


<script>
	$("#bt_calculate").click(function(e) {
		e.preventDefault();
		var form_data = $("#form_data").serialize();
		$.ajax({
			url : "cd_interest_calculatoin",
			type : "post",
			data : form_data,
			success : function() {
				console.log("done");
			}
		});
	});
</script>

<script>
	
	$('input[name="date"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,//to get blank initially
		
		locale: {
			cancelLabel: 'Clear',	//to get blank initially
			format: 'DD-MM-YYYY'
		},
		
		
	});
	
	//to get blank initially
	$('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD-MM-YYYY'));
	});
	
	$('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
</script>