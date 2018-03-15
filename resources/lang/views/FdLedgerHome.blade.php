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
						<h2><i class="glyphicon glyphicon-globe"></i>   FD Ledger</h2>
						
						
					</div>
					
					
					
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="row table-row alert alert-info">
								
								<label class="control-label inline col-md-2">Select Mode:
									
									<select class="form-control" id="FdMode" name="FdMode">
										<option value="">SELECT MODE</option>
										<option value="SINGLE">SINGLE</option>
										<option value="MULTIPLE">MULTIPLE</option>
									</select>
								</label>
								
								<label class="control-label inline col-md-3 Single">Select Account Number / ALL:
									<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT FD ACCOUNT / ALL"> 
								</label>
								
								
								<label class="control-label inline col-md-2 Multiple">Select Status:
									
									<select class="form-control" id="FdStatus" name="FdStatus">
										<option value=""></option>
										<option value="CLOSED">CLOSED</option>
										<option value="ACTIVE">ACTIVE</option>
										<option value="ALL">ALL</option>
									</select>
								</label>
								
								<div class="SerchParams">
								<div class="col-md-3">
									<label class="control-label pull-left">DATE RANGE(Opening Date):
										<div id="reportrange" class="pull-left" style="cursor: pointer;padding: 5px 10px; border: 3px solid #ccc;color:#000">
											
											
											<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
											<span></span> <b class="caret"></b>
											
										</div>
									</label>
								</div>
								
								
								<label class="control-label inline col-md-1">Show In Kannada:
									<input type="checkbox" id="KanCheck" name="KanCheck" value="0"/>
									
								</label>
								
								<div class="col-md-2">
									<a class="btn btn-default SearchSb">SEARCH</a>
									
								</div>
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
	$('.Single').hide();
	$('.Multiple').hide();
	$('.SerchParams').hide();
	
	$('#FdMode').change( function(e) {
		e.preventDefault();
		mode=$('#FdMode').val();
		if(mode=="SINGLE")
		{
            $('.Single').show();
            $('.SerchParams').show();
            $('.Multiple').hide();
		}
		else if(mode=="MULTIPLE"){
			$('.Multiple').show();
			$('.SerchParams').show();
            $('.Single').hide();
		}
		
		else{
			$('.Single').hide();
			$('.Multiple').hide();
			$('.SerchParams').hide();
			alert("Please Select the Mode");
		}
	});
	
	
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
		FdStat=$('#FdStatus').val();
		All=$('#searchacc').val();
		
		
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetFdLedgerPerData',
			type:'get',
			data:'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&Kannada='+kanche+'&AllorNot='+All+'&FdStatus='+FdStat,
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
		ajax: '/GetSearchFdAccWithOldAcc' 
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




