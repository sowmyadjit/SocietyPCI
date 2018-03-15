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
		
		<div class="row sb">
			<div class="box col-md-12">
				<div class="box-inner">
					
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   SB PASSBOOK PRINT</h2>
						
						<!--<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>-->
					</div>
					
					<!--<div class="box-content">
						<!--<div class="alert alert-info">
						<a href="companydetail" class="btn btn-default crtds">Create Company</a>
					</div>-->
					
					<!--<div class="form-group">
						<div class="col-md-4">
						<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SEARCH SB or RD ACCOUNT"> 
						</div>
					</div></br></br>-->
					
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="row table-row alert alert-info">
								
								
								
								<label class="control-label inline col-md-4">Select Account Number:
									<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT SB ACCOUNT"> 
								</label>
								
								<label class="control-label inline col-md-2">Select Line:
									<input class="form-control" id="lineval" type="text" name="lineval"> 
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
								
								
								<label class="control-label inline col-md-2">Print Front Page:
									<input type="checkbox" id="KanCheck" name="KanCheck" value="0"/>
									
								</label>
								
								<div class="col-md-2">
									<a class="btn btn-default SearchSb">SEARCH</a>
									
								</div>
								
								
								
								
								
							</div>
						</div>
					</div>
					
					
					
					</br></br>
					
					
					<div class='SearchRes'> 
						
						
						
						
					</div>
					
					
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	
	
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	$('.SearchSb').click(function(e){
		
		
		
		e.preventDefault();
		if($('#KanCheck').is(":checked"))
		{
			kanche="1";
			
		}
		else
		{
			kanche="0";
		}
		//alert(kanche);
		searchvalue=$('#searchacc').data('value');
		lineval=$('#lineval').val();
		
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetSbprintPerData',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&Kannada='+kanche+'&lineval='+lineval,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
		
		
		
		
		
	});
	
	
	
	
	
	
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('#maincontents').load($(this).attr('href'));
	});
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSearchSbAccWithOldAcc' 
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
			edate=end.format('YYYY-MM-DD');
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
			//autoUpdateInput: false,
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




