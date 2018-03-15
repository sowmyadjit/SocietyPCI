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
	<div>
		<ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >Report</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Closed PIGMY Report</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<!--<div class="box-content">
					<div class="alert alert-info">
					<a href="#" class="btn btn-default crtds">Create Company</a>
				</div>-->
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							<label class="control-label inline col-md-2">Option:
								<select class="form-control ClosingTypeDD"  id="ClosingTypeDD" name="ClosingTypeDD">  
									
									<option value="MATURED">MATURED</option>
									<option value="PREWITHDRAWAL">PREWITHDRAWAL</option>
									
								</select>
							</label>
							
							<label class="control-label inline col-md-3">SELECT ACCOUNT:
								
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT PIGMY ACCOUNT">
								
							</label>
							
							
							
							
							
							<div class="col-md-3">
								<label class="control-label pull-left">DATE RANGE:
									<div id="reportrange" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
										
										<!-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">-->
										
										<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
										<span></span> <b class="caret"></b>
										
									</div>
								</label>
							</div>
							
							
								
								<div class="col-md-2">
									<a class="btn btn-default SearchPig pull-left">SEARCH</a>
								</div>
								
								<div class="col-md-2">
									<a class="btn btn-default PrintPig pull-right">PRINT</a>
									
									
								</div>
								
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				<div class='SearchRes'>
					<div  id="toprint">
						
						
					</div>
					
					
				</div>
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
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSearchpigmyAcc'
	});
	
	$('.SearchPig').click(function(e){
		e.preventDefault();
		
		
		searchvalue=$('#searchacc').val();
		//alert(searchvalue);
		ClosedType=$('#ClosingTypeDD').val();
		//All=$('#searchacc').val();
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetPigmyEndReport',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&ClosingTypeDD='+ClosedType+'&startdate='+sdate+'&enddate='+edate,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	/*$('.SearchTypeahead').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		searchvalue=$('#searchacc').data('value');
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
		url:'getpigmyacc',
		type:'get',
		data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate,
		success:function(data)
		{
		//alert("success");
		$('.box').html(data);
		
		
		}
		});
	});*/
	
</script>




<!--DATE RANGE PICKER-->

<script type="text/javascript">
	var sdate;
	var $stdate=sdate;
	var edate;
	var $endate=edate;
	$(function() {
		
		function cb(start, end) {
			//$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); //original code
			//$('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
			$('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			//alert(start.format('DD-MM-YYYY'));
			sdate=start.format('YYYY-MM-DD');
			edate=end.format('YYYY-MM-DD');
			//sdate=start.format('DD/MM/YYYY');
			//edate=end.format('DD/MM/YYYY');
			//alert(sdate);
			//alert(edate);
			//alert(moment());
			
		}
		cb(moment().subtract(29, 'days'), moment());
		
		
		$('#reportrange').daterangepicker({
			
			locale: {
				
				format: 'DD-MM-YYYY'
			},
			"showDropdowns": true,
			"opens": "left",
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
		$(".PrintPig").click(function() {
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