
<style>
	.right_text{
	text-align: right;
    vertical-align: middle;
    margin-top: 10px;
	}
	</style>
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
					<h2><i class="glyphicon glyphicon-user"></i> Appraiser Commission Report</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
					
				</div>
				<div class="box-content" style="height: 365px;">
				<script src="js/FileSaver.js"/>			
				<script src="js/tableExport.js"/>	
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info" style="height:340px;">
					
						<div class="form-group col-sm-12">
							<label class="control-label col-sm-5 right_text" for="first_name">From Date :</label>
							<div class="input-group input-append date col-sm-7" id="" style="padding-left:15px;padding-right:15px;">
								<input type="text" class="form-control datepicker" name="from_date" id="from_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
						<div class="form-group col-sm-12">
							<label class="control-label col-sm-5 right_text" for="first_name">To Date :</label>
							<div class="input-group input-append date col-sm-7" id="" style="padding-left:15px;padding-right:15px;">
								<input type="text" class="form-control datepicker" name="to_date" id="to_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
						
						<div class="col-md-12" style="height:100px;">
							<label class="control-label col-sm-5 right_text" for="first_name">Select Year :</label>
							<div class="col-md-7 pull-right">
								<select class="form-control">
									<option>aaa</option>
									<option>bbbb</option>
								</select>
							</div>
						</div>
						<div class="col-md-12" style="height:100px;">
							<label class="control-label col-sm-5 right_text" for="first_name">Select Month :</label>
							<div class="col-md-7 pull-right">
								<select class="form-control">
									<option value="01">January</option>
									<option value="02">aaa</option>
									<option value="03">aaa</option>
									<option value="04">aaa</option>
									<option value="05">aaa</option>
									<option value="06">aaa</option>
									<option value="01">aaa</option>
									<option value="01">aaa</option>
									<option value="01">aaa</option>
									<option value="01">aaa</option>
									<option value="01">aaa</option>
									<option value="01">aaa</option>
								</select>
							</div>
						</div>
						<div class="col-sm-7">
						<?php /*	<div class="col-md-4 pull-right" style='display:inline-block;'>
							<button class="btn btn-info btn-sm"  id="print">Print</button>
							</div> */?>
						<div class="col-md-1 pull-right" style='display:inline-block;'>
						<button class="btn btn-info btn-sm"  id="excel">Excel</button>
						</div>
						</div>
						
                <br />Choose a Month:
                <input id="IconDemo" class='Default' type="text" />
				
					</div>
					<div style="opacity:0;height:0; position: fixed;overflow-y:scroll" id="report">
					</div> 
				</div>
		</div>
	</div>
</div>





<script>
	
    $('.Default').MonthPicker();
	
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	$("#print,#excel").click(function(){
		console.log("view clicked");
		agent_uid=$("#agent_uid").val();
		from_date=$("#from_date").val();
		to_date=$("#to_date").val();
		print=$(this).attr('id');
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
						data:'&from_date='+from_date+'&to_date='+to_date+'&allocation_id='+searchvalue+'&print='+print+'&agent_uid='+agent_uid,
						success:function(data)
						{
						console.log("hai");
						$("#report").html('');
						$("#report").html(data);
						}
		});
	});
	
		$('input.SearchTypeahead').typeahead({
		//ajax: '/SearchPigmy'
        source:SearchPigmy
	});
	
	$('#excela').click(function(e){
	alert("excel");
	$('#expense_details').tableExport({type:'excel',escape:'false'});
	});	
</script>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".printa").click(function() {
			alert("print");
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