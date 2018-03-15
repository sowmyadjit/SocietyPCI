<script src="js/bootstrap-typeahead.js"></script>
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
	
	
	<div class="row sb">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>  SHARE REPORT</h2>
					
					
				</div>
				
				
				<div class="form-group">
					<div class="alert alert-info">
						
						
						<div class="row table-row">
							
							
							
							<label class="control-label inline col-md-2">Share Class:
								<select class="form-control BranchListDD"  id="ShareListDD" name="ShareListDD">  
									<option value="ALL">ALL</option>
									<?php foreach($sha as $key){
										echo "<option value='".$key->Share_Class."' >" .$key->Share_Class."";
										echo "</option>";
									}?>
								</select>
							</label>
							
							
							
							<!--<label class="control-label inline col-md-3" >Date Range:
								<div id="reportrange" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
									
									
									
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
									
								</div>
							</label>-->
							
						
								
								<a class="btn btn-default Searchex btn-success">
								<i class="glyphicon glyphicon-search"> SEARCH</i></a>
								
								
								
								<a class="btn btn-default PrintRd btn-info">
								<i class="glyphicon glyphicon-print"> PRINT</i></a>
								
								<!--<a class="btn btn-default PrintAllRd">PRINT ALL</a>
								</div>-->
								
								
							
						</div>
						
						
						
					</div>
					
				</div>
				
				
				
				
				
				
				<div class='SearchRes'> 
					<div  id="toprint">
						
						
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
	</div>
	
	
	
	<script>
		
		
		
		
		
		
		
		
		
		
		
		
		
		$('.Searchex').click(function(e){
			
			sh=$('#ShareListDD').val();
			//HeadDD=$('#HeadiD').val();
			//SubHeadDD=$('#expsubhead').val();
			//alert(SubHeadDD);
			//pay=$('#paymode').val();
			e.preventDefault();
			$.ajax({
				url:'GetShareBranchWiseData',
				type:'get',
				data:'&startdate='+sdate+'&enddate='+edate+'&sha='+sh,
				success:function(data)
				{
					//alert("success");
					$('.SearchRes').html('');
					$('.SearchRes').html(data);
					
					
					
				}
			});
			
		});
		
		
		
		
		$("#pagei> ul.pagination li a").each(function() {
			
			$(this).addClass("loadmc");
			
		});
		$('.loadmc').click(function(e)
		{
			e.preventDefault();
			$('#content').load($(this).attr('href'));
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
				$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
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
			
			
			$('#reportrange').daterangepicker({
				
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
			$(".PrintRd").click(function() {
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

	