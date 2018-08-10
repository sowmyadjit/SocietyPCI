<script src="js/bootstrap-typeahead.js"></script>

							<div class="col-md-4">
								<label class="control-label inline col-md-offset-4">
									Receipt Type:
								</label>
							</div>
							<div class="col-md-4">
								<select class="form-control ReceiptTypeDD"  id="ReceiptTypeDD" name="ReceiptTypeDD">  
									<option value=""> SELECT RECEIPT TYPE</option>
									<option value="SB"> SB RECEIPT </option>
									<option value="RD"> RD RECEIPT </option>
									<option value="JL"> JL ALLOCATE RECEIPT </option>
									<option value="DL"> DL ALLOCATE RECEIPT </option>
									<option value="JL_PAY"> JL REPAY RECEIPT </option>
									<option value="DL_PAY"> DL REPAY RECEIPT </option>
									<option value="SL_PAY"> SL REPAY RECEIPT </option>
									<option value="PL_PAY"> PL REPAY RECEIPT </option>
									<option value="FD_PAY_AMT"> FD PAY RECEIPT </option>
									<option value="RD_PAY_AMT"> RD PAY RECEIPT </option>
									<option value="PG_PAY_AMT"> PG PAY RECEIPT </option>
									<option value="MEM_FEE"> MEMBER FEE RECEIPT </option>
									<option value="CUST_FEE"> D CLASS </option>
									<option value="PG_PEND"> PIGMY PENDING RECEIPT </option>
									<option value="SHARE"> SHARE ALLOCATION </option>
									<option value="INCOME"> INCOME RECEIPT </option>
									<option value="BANK_WID"> BANK WITHDRAWAL </option>
									<option value="B2B_CR"> HEAD OFFICE </option>
									<!--<option value="PIGMY"> PIGMY RECEIPT </option>-->
								</select>
							</div>
							<div class="col-md-4">
								<button class="glyphicon glyphicon-list btn-sm" id="list_refresh">
									<span class="" />
								</button>
							</div>
							<br />
							<br />
							<br />
							<div class='SearchRes'></div>
			


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

	$("#list_refresh").click(function() {
		$(".ReceiptTypeDD").trigger("change");
	});
	
	$('.ReceiptTypeDD').change(function(e){
		
		ReceDD=$('#ReceiptTypeDD').val();
		e.preventDefault();
		if(ReceDD=="")
		{
			alert("Please Select Receipt Type");
		}
		else
		{
			// $.ajax({
			// 	url:'TransactionReceiptView',
			// 	type:'get',
			// 	data:'&ReceiptTypeDD='+ReceDD,
			// 	success:function(data)
			// 	{
			// 		$('.SearchRes').html('');
			// 		$('.SearchRes').html(data);
			// 	}
			// });

			show_loading_img(".SearchRes");
			$.ajax({
				url:'rv_print',
				type:'post',
				data:'&tran_category='+ReceDD+"&tran_type=CREDIT",
				success:function(data)
				{
					$('.SearchRes').html('');
					$('.SearchRes').html(data);
				}
			});
		}
		
	});
	
	
	
</script>