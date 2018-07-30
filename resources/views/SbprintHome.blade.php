<script src="js/bootstrap-typeahead.js"></script>
<script src="js/moment.min.js"></script>    <!--for daterange picker-->
<script src="js/daterangepicker.js"></script>    <!--for daterange picker-->
<link href="css/daterangepicker.css" rel='stylesheet'>

<div id="content<?php echo $SBPass['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
			{!! Form::open(['url' => "createtransaction",'class' => 'form-horizontal','id' => 'form_tran','method'=>'post']) !!}
		
		<div class="row sb">
			<div class="box col-md-12">
				<div class="bdy_<?php echo $SBPass['module']->Mid; ?> box-inner">
					
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i>   SB PASSBOOK PRINT</h2>
						
						
					</div>
					
					
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="row table-row alert alert-info">
								
								
								
								<label class="control-label inline col-md-2">Select Account:
									<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT SB ACCOUNT"> 
								</label>
								<label class="control-label inline col-md-2">Enter Page Num:
									<input class="form-control" id="pnum" type="text" name="pnum"> 
								</label>
								
								<label class="control-label inline col-md-2"> SL number:
									<input class="form-control" id="num" type="text" name="num" placeholder="Enter Next SL no."> 
								</label>
								<label class="control-label inline col-md-2">Select Next Line:
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
								
								<label class="control-label inline col-md-2"> Previous Balance:
									<input type="checkbox" id="pb" name="pb" value="1"/>
									
								</label>
								
								<div class="col-md-2">
									<a class="btn btn-default SearchSbPass<?php echo $SBPass['module']->Mid; ?> sb_print_refresh">SEARCH</a>
									
								</div>
								
								
								
								
								
							</div>
						</div>
					</div>
					
					
					
					</br></br>
					
					
					<div class='SearchResSbPass<?php echo $SBPass['module']->Mid; ?>'> 
						
						
						
						
					</div>
					
					
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script>
	
	var a=0;
	var previous_balance = 0;
	var sb_id_set = 0;
	$('.clickme').click(function(e){
		$('.companyclassid').click();
	}); 
	
	$('.SearchSbPass<?php echo $SBPass['module']->Mid; ?>').click(function(e){
		
		
		
		e.preventDefault();
		if($('#KanCheck').is(":checked"))
		{
			kanche="1";
			
		}
		else
		{
			kanche="0";
		}
		if($('#pb').is(":checked"))
		{
			pbval="0";
			
		}
		else
		{
			pbval="1";
		}
		//alert(kanche);
		searchvalue=$('#searchacc').data('value');
		lineval=$('#lineval').val();
		
		alert(a);
		// console.log("previous_balance:"+previous_balance);
		//alert(searchvalue);
		e.preventDefault();
		$.ajax({
			url:'GetSbprintPerData',
			type:'get',
			data:$('#form_tran').serialize()+'&SearchAccId='+searchvalue+'&startdate='+sdate+'&enddate='+edate+'&Kannada='+kanche+'&lineval='+lineval+'&tranid='+a+'&pbval='+pbval+'&previous_balance='+previous_balance+'&sb_id_set='+sb_id_set,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchResSbPass<?php echo $SBPass['module']->Mid; ?>').html('');
				$('.SearchResSbPass<?php echo $SBPass['module']->Mid; ?>').html(data);
				
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
		//source:GetSearchSbAccWithOldAcc
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




