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
					<h2><i class="glyphicon glyphicon-globe"></i>  PIGMY CUSTOMER REPORT</h2>
					
					
				</div>
				
				
				<div class="form-group">
					<div class="alert alert-info">
						
						
						<div class="row table-row">
							
							<center>
							<label class="control-label inline col-md-3">Select Agent:
								<select class="form-control IncomeListDD"  id="agen" name="agen">  
									<option></option>
											@foreach ($pig as $pg)
											<option value='{{ $pg->Uid }}'>{{ $pg->FirstName }}.{{ $pg->MiddleName }}.{{ $pg->LastName }}</option>
											@endforeach
								</select>
							</label>
							
								
								<a class="btn btn-default Searchex btn-success">
								<i class="glyphicon glyphicon-search"> SEARCH</i></a>
								
								
								
								<a class="btn btn-default PrintRd btn-info">
								<i class="glyphicon glyphicon-print"> PRINT</i></a>
								
								<!--<a class="btn btn-default PrintAllRd">PRINT ALL</a>
								</div>-->
								
								
							</center>
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
			
			agent=$('#agen').val();
			//HeadDD=$('#HeadiD').val();
			//SubHeadDD=$('#expsubhead').val();
			//alert(SubHeadDD);
			//pay=$('#paymode').val();
			e.preventDefault();
			$.ajax({
				url:'GetPigmyCustPerData',
				type:'get',
				data:'&age='+agent,
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
	
