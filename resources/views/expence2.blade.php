
		<div id="content<?php echo $ex['module']->Mid; ?>" class="col-lg-10 col-sm-10">
			<!-- content starts -->
			
			
			<div class="row">
				<div class="box_bdy_<?php echo $ex['module']->Mid; ?> box col-md-12">
					<div class="bdy_<?php echo $ex['module']->Mid; ?> box-inner">

						
<?php /* BOX MAIN START */?>
<div class="b_main">
						<div class="box-header well" data-original-title="">
							<h2><i class="glyphicon glyphicon-globe"></i> Expense DETAIL</h2>
							
							
						</div>
						
						<div class="box-content">
							<script src="js/FileSaver.js"/>			
							<script src="js/tableExport.js"/>				
							<div class="alert alert-info">
								<!--<a href="expencedetail" class="btn btn-default CrtExpenseBtn<?php echo $ex['module']->Mid; ?>">Expense Bank</a>
								<a href="expencetran" class="btn btn-default CrtExpTranBtn<?php echo $ex['module']->Mid; ?>">Expense Transfer</a>
								<a href="createexp" class="btn btn-default CrtExpense<?php echo $ex['module']->Mid; ?>">Expense</a>-->
								
								<a href="expenceBranch" class="btn btn-default CrtExpenseBtn<?php echo $ex['module']->Mid; ?>">Branch TO Branch</a>
								<a href="expencetran" class="btn btn-default CrtExpTranBtn<?php echo $ex['module']->Mid; ?>">Bank TO Bank transfer</a>
								<a href="createexp" class="btn btn-default CrtExpense<?php echo $ex['module']->Mid; ?>">Expense</a>
								<input type="button" value="Export to Excel" class="btn btn-info btn-sm" id="excel">
								<input type="button" value="Print" class="btn btn-info btn-sm print" id="print">
								<button class="refresh_data btn-sm glyphicon glyphicon-refresh"></button>
								<!--<input type="button" value="Print" class="btn btn-info btn-sm" id="print">-->																						  																			   
							</div>

							<div id="table_data">.</div>

<?php /*	
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="expense_details">
								
								<thead>
									<tr>
										<th>Date</th>
										
										<th>Expence For</th>
										<th>Amount</th>							
										<th>Particulars</th>
										<th>Action</th>
									</tr>
								</thead>
								
								<tbody>
									@foreach ($ex['expense'] as $expence)
									<tr>
										<td class="hidden">{{ $expence->id }}</td>
										<td>{{ $expence->e_date }}</td>
										
										<td>{{ $expence->lname }}</td>
										<td>{{ $expence->amount }}</td>
										<td>{{ $expence->Particulars }}</td>
										<td>
											
											<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $ex['module']->Mid; ?>" href="ExReceipt/{{ $expence->id }}"/>
											
										</td>
										
									</tr>
									@endforeach
								</tbody>
							</table>
							<div id="toprint" style="position:fixed;opacity:0;">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
								<thead>
									<tr>
										<th>Date</th>
										<th>Expence For</th>
										<th>Amount</th>							
										<th>Particulars</th>
									</tr>
								</thead>
								<br>
								<tbody>	
									@foreach ($ex['expense'] as $expence)
									<tr>
										<td class="hidden">{{ $expence->id }}</td>
										<td>{{ $expence->e_date }}</td>	
										<td>{{ $expence->lname }}</td>
										<td>{{ $expence->amount }}</td>
										<td>{{ $expence->Particulars }}</td>	
									</tr>
									@endforeach
								</tbody>
							</table>
*/?>

							</div>	
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





					</div>
				</div>
			</div>
		</div>




<script>
	$("document").ready(function() {
		load_data();
	});

	function load_data() {
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$("#table_data").html(loading_img);
		$.ajax({
			url: "expence_data",
			type: "post",
			data: "",
			success: function(data) {
				$("#table_data").html(data);
			}
		});
	}
</script>

<script>
	$(".refresh_data").click(function() {
		load_data();
	});
</script>

<script>
	$(".CrtExpenseBtn<?php echo $ex['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});
	$(".CrtExpTranBtn<?php echo $ex['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});
	$(".CrtExpense<?php echo $ex['module']->Mid; ?>").click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		load_url(url);
	});

	function load_url(url) {
		$(".b_main").hide();
		$(".b_sub_1").load(url);
	}
</script>

<script>
	$(".b_back").click(function() {
		$(".b_main").show();
		$(".b_sub_1").html("b_sub_1");
	});
</script>
