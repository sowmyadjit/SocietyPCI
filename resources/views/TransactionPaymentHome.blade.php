<script src="js/bootstrap-typeahead.js"></script>

<div id="content" class="col-lg-12 col-sm-12">
	<!-- content starts -->
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  Transaction Payment</h2>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							<!--<div class="col-md-4">
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT PIGMY ACCOUNT"> 
							</div>-->
							<label class="control-label inline col-md-4 col-md-offset-4">Payment Type:
								<select class="form-control ReceiptTypeDD"  id="ReceiptTypeDD" name="ReceiptTypeDD">  
									<option value=""> SELECT PAYMENT TYPE</option>
									<option value="SB"> SB PAYMENT </option>
									<option value="RD"> RD PAYMENT </option>
									<option value="JL"> JL ALLOCATE </option>
									<option value="DL"> DL ALLOCATE </option>
									<option value="SL"> SL ALLOCATE </option>
									<option value="PL"> PL ALLOCATE </option>
									<option value="FD_PAY_AMT"> FD PAY AMOUNT </option>
									<option value="RD_PAY_AMT"> RD PAY AMOUNT </option>
									<option value="PG_PAY_AMT"> PG PAY AMOUNT </option>
									<option value="EXPENSE"> EXPENESE </option>
									<option value="BANK_DEP"> BANK DEPOSIT </option>
									<!--<option value="PIGMY"> PIGMY RECEIPT </option>-->
								</select>
							</label>
						</div>
					</div>
				</div>
				</br></br>
				<div class='SearchRes'></div>
			</div>
		</div>
	</div>
</div>


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

			$.ajax({
				url:'rv_print',
				type:'post',
				data:'&tran_category='+ReceDD+"&tran_type=DEBIT",
				success:function(data)
				{
					$('.SearchRes').html('');
					$('.SearchRes').html(data);
				}
			});
		}
		
	});
	
	
	
</script>