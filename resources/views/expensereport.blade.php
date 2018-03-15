<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $data['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $data['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  EXPENSE REPORT</h2>
					
					
				</div>
				
				
				<div class="form-group">
					<div class="alert alert-info">
						
						
						<div class="row table-row">
							
							
							<label class="control-label inline col-md-2">BRANCH:
								<select class="form-control BranchListDD"  id="BranchiD" name="BranchiD">  
									<option value="ALL">ALL</option>
									<?php foreach($data['branch'] as $key){
										echo "<option value='".$key->Bid."' >" .$key->BName."";
										echo "</option>";
									}?>
								</select>
							</label>
							
							<label class="control-label inline col-md-2">PAYMENT MODE:
								<select class="form-control BranchListDD"  id="paymode" name="paymode">  
									<option value="">------SELECT-------</option>
									<option value="INHAND">INHAND CASH</option>
									<option value="CHEQUE">CHEQUE</option>
									
								</select>
							</label>
							
							<label class="control-label inline col-md-3">HEAD:
								<select class="form-control HeadListDD"  id="HeadiD" name="HeadiD">  
									<option value="">--Select Head--</option>
									<?php foreach($data['led'] as $key){
										echo "<option value='".$key->lid."' >" .$key->lname."";
										echo "</option>";
									}?>
								</select>
							</label>
							
							
							<label class="control-label inline col-md-2">Expense Sub Head:
								
								<select class="form-control" id="expsubhead" name="expsubhead">
									
									<option></option>
									
								</select>
								
							</label>
							
							
							
							
							<label class="control-label inline col-md-3" >Date Range:
								<div id="reportrange<?php echo $data['module']->Mid; ?>" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</label>
							
						</div>
						
						
						
						<div class="row table-row">
							<center>
								
								<a class="btn btn-default Searchex<?php echo $data['module']->Mid; ?> btn-success">
								<i class="glyphicon glyphicon-search"> SEARCH</i></a>
								
								
								
								<a class="btn btn-default PrintRd<?php echo $data['module']->Mid; ?> btn-info">
								<i class="glyphicon glyphicon-print"> PRINT</i></a>
								
								<!--<a class="btn btn-default PrintAllRd">PRINT ALL</a>
								</div>-->
								
								
							</center>
						</div>
						
						
						
					</div>
					
				</div>
				
				
				
				
				
				
				<div class='SearchRes<?php echo $data['module']->Mid; ?>'> 
					<div  id="toprint<?php echo $data['module']->Mid; ?>">
						
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							
							<thead>
								<tr>
									<th>Expense Date</th>
									<!--<th>Cheque Date</th>-->
									<th>Payment Mode</th>
									<th>Amount</th>
									<th>Particulars</th>
									
									
								</tr>
							</thead>
							
							<tbody>
								@foreach ($data['exp'] as $expense)
								<tr>
									<td class="hidden">{{ $expense->	id }}</td>
									<td><?php $edate=date("d-m-Y",strtotime($expense->e_date)); echo $edate; ?></td>
									<!--<td>{{ $expense->cheque_date }}</td>-->
									<td>{{ $expense->pay_mode }}</td>
									<td>{{ $expense->amount }}</td>
									<td>{{ $expense->Particulars }}</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div id='pagei<?php echo $data['module']->Mid; ?>'>
						{!! $data['exp']->render() !!}
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
	
	
	
	<script>
		
		
		
		
		$('#HeadiD').change(function(e){
			//agent=$('ul.typeahead1 li.active').data('value');
			Lid=$('#HeadiD').val();
			
			// alert(Lid);
			e.preventDefault();
			
			$.ajax({
				url:'GetSubLedgerHead',
				type:'get',
				data:'&LedgerId='+Lid,
				success:function(data)
				{
					// alert("success");
					var sel = document.getElementById('expsubhead');
					for (i = sel.length - 1; i >= 0; i--) {
						sel.remove(i);
					}
					$("#expsubhead").append("<option value=\"ALL\">ALL</option>");
					var jsonData = JSON.parse(data);
					for (var i = 0; i < jsonData.length; i++) {
						var prop = jsonData[i];
						$("#expsubhead").append("<option value=\"" + prop.lid +"\">"+ prop.lname +"</option>");
					}
					
				}
			});
		});
		
		
		
		
		
		
		
		
		$('.Searchex<?php echo $data['module']->Mid; ?>').click(function(e){
			
			BrDD=$('#BranchiD').val();
			HeadDD=$('#HeadiD').val();
			SubHeadDD=$('#expsubhead').val();
			//alert(SubHeadDD);
			pay=$('#paymode').val();
			e.preventDefault();
			$.ajax({
				url:'GetExpenceBranchWiseData',
				type:'get',
				data:'&BranchDD='+BrDD+'&startdate='+sdate+'&enddate='+edate+'&paymode='+pay+'&HeadID='+HeadDD+'&SubHeadID='+SubHeadDD,
				success:function(data)
				{
					//alert("success");
					$('.SearchRes<?php echo $data['module']->Mid; ?>').html('');
					$('.SearchRes<?php echo $data['module']->Mid; ?>').html(data);
					
					
					
				}
			});
			
		});
		
		
		
		
		$("#pagei<?php echo $data['module']->Mid; ?> > ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc<?php echo $data['module']->Mid; ?>");
			
		});
		$('.loadmc<?php echo $data['module']->Mid; ?>').click(function(e)
		{
			e.preventDefault();
			$('#<?php echo $data['module']->Mid; ?>_content').load($(this).attr('href'));
		});	
		
	</script>
	
	
	<!--DATE RANGE PICKER-->
	
	<script type="text/javascript">
		var sdate;
		var edate;
		$(function() {
			
			function cb(start, end) {
				//$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); //original code
				//$('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
				$('#reportrange<?php echo $data['module']->Mid; ?> span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
				//alert(start.format('DD-MM-YYYY'));
				//alert(start.format('DD-MM-YYYY'));
				sdate=start.format('YYYY-MM-DD');
				//sdate=start.format('DD-MM-YYYY');
				edate=end.format('YYYY-MM-DD');
				//edate=end.format('DD-MM-YYYY');
				//sdate=start.format('DD/MM/YYYY');
				//edate=end.format('DD/MM/YYYY');
				//alert(sdate);
				//alert(edate);
				//alert(moment());
				
			}
			cb(moment(), moment());
			
			
			$('#reportrange<?php echo $data['module']->Mid; ?>').daterangepicker({
				
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
			$(".PrintRd<?php echo $data['module']->Mid; ?>").click(function() {
				//alert('test');
				//$("#toprint").print();
				
				var divContents = $("#toprint<?php echo $data['module']->Mid; ?>").html();
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
	
