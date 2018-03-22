

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>
<div id="content" class="col-lg-10 col-sm-10">
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> PIGMI Report</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
					
				</div>
				<div class="box-content">
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info">
					
					</div>
						<div class="form-group col-sm-6">
							<label class="control-label col-sm-5" for="first_name">From Date :</label>
							<div class="input-group input-append date col-sm-7" id="" style="padding-left:15px;padding-right:15px;">
								<input type="text" class="form-control datepicker" name="from_date" id="from_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label col-sm-5" for="first_name">To Date :</label>
							<div class="input-group input-append date col-sm-7" id="" style="padding-left:15px;padding-right:15px;">
								<input type="text" class="form-control datepicker" name="to_date" id="to_date"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd" value="{{date("Y-m-d")}}"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span> 
							</div>
						</div>
						<div class="col-md-5 pull-right">
									<input class="SearchTypeahead form-control" id="SearchPigmy" type="text" name="SearchPigmy" placeholder="SEARCH PIGMY">
						</div>
						<div>
						<button style="margin-left:1000px;" id="view">View</button>
						</div>
						<div id="report">
						</div>
				</div>
		</div>
	</div>
</div>





<script>
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	$("#view").click(function(){
	console.log("bai");
	from_date=$("#from_date").val();
	to_date=$("#to_date").val();
	searchvalue=$('#SearchPigmy').attr('data-value');
	$.ajax({
					url:'/pigmy_report',
					type:'post',
					data:'&from_date='+from_date+'&to_date='+to_date+'&allocation_id='+searchvalue,
					success:function(data)
					{console.log("hai");
					$("#report").html(data);
					}
	});
		}
	);
	
		$('input.SearchTypeahead').typeahead({
		//ajax: '/SearchPigmy'
        source:SearchPigmy
	});
	
	
</script>