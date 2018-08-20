
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/bootstrap-datepicker.js"/>
<div id="content<?php echo $PayAmount['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
  
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $PayAmount['module']->Mid; ?> box-inner">





<?php /* BOX MAIN START */?>
<div class="b_main">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Pigmy Pay Amount</h2>
					
				</div>
				
				<div class="box-content">
					
					
					<div class="alert alert-info">
						<div class="form-group">
							
							<div class="row table-row">
								<div class="col-md-2">
									<a href="PigmyPayAmountView" class="btn btn-default PayAmountLink<?php echo $PayAmount['module']->Mid; ?>">Pay Amount</a>
								</div>
								<div class="col-md-2">
									<input id="from_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" value="{{$PayAmount['from_date']}}" />
								</div>
								<div class="col-md-2">
									<input id="to_date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" value="{{$PayAmount['to_date']}}" />
								</div>
								<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>
								
								<div class="col-md-2 pull-right">
									<button id="pay_amt_print" class="btn btn-default glyphicon glyphicon-print" title="print"></button>
									<button id="pay_amt_excel" class="btn btn-default glyphicon glyphicon-file" title="excel"></button>
								</div>
								<div class="col-md-3 pull-right">
									<input class="SearchTypeahead form-control" id="SearchPigmyPay" type="text" name="SearchPigmyPay" placeholder="SEARCH PIGMY PAY">
								</div>
								
							</div>
						</div>
					</div>

					<div id="table_data">.</div>
					
				</div>


</div>
<?php /* BOX MAIN END */?>


			<?php /* BOX SUB 1 START */?>
			<div class="b_sub_1">
			</div>
			<?php /* BOX SUB 1 END */?>


			<?php /* BOX SUB 2 START */?>
			<div class="b_sub_2">
			</div>
			<?php /* BOX SUB 2 END */?>

			
			<div class="b_back">
				<center><button class="btn-sm btn-info ">back</button></center>
			</div>
			<div id="temp_loading_img" class="hide">
				<div>
					<center>
						<img src="img\\loading2.gif" width="100px" height="100px"/>
					</center>
				</div>
			</div>


			</div>
		</div>
	</div>
</div>


<script>
	function show_loading_img(selector) {
		var loading_img = $("#temp_loading_img").html();
		$(selector).html(loading_img);
	}
</script>

<script>
	$("document").ready(function() {
		setTimeout(() => {
			load_data("");
		}, 1000);
	});

	function load_data(account_id) {
		var from_date = $("#from_date").val();
		var to_date = $("#to_date").val();
		show_loading_img("#table_data");
		$.ajax({
			url: "PigmyPayAmount_data",
			type: "post",
			data: "from_date="+from_date+"&to_date="+to_date+"&account_id="+account_id,
			success: function(data) {
				$("#table_data").html(data);
			}
		});
	}
</script>

<script>
	$(".refresh_data").click(function() {
		load_data("");
		$("#SearchPigmyPay").val("");
	});
</script>

<script>
	$(".PayAmountLink<?php echo $PayAmount['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});

	var is_day_open = "{{$PayAmount['is_day_open']}}"; // "yes" or "no"

	// console.log("is_day_open:", is_day_open);

	function load_url(url,check_day_open=true) {
		if(is_day_open == "yes" || !check_day_open) {
			$(".b_main").hide();
			show_loading_img(".b_sub_1");
			$(".b_sub_1").load(url);
		} else {
			alert("Day is not open!");
		}
	}
</script>

<script>
	$(".b_back").click(function() {
		$(".b_main").show();
		$(".b_sub_1").html("");
	});
</script>

<script>
	$('input.SearchTypeahead').typeahead({
		ajax: '/SearchPigmyPay'
		// source:SearchPigmyPay
	});

	$("#SearchPigmyPay").change(function() {
		var account_id = $(this).attr("data-value");
		// console.log(account_id);
		load_data(account_id);
	});
</script>

<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

<script>
		$("#pay_amt_print").click(function() {
			var divContents = $("#table_data").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
</script>
<script>
	$('#pay_amt_excel').click( function(e) {
		$('#table_data').tableExport({type:'excel',escape:'false'});
	});
</script>
