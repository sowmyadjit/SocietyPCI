

<script src="js/bootstrap-datepicker.js"/>	
<link href="css/datepicker.css" rel='stylesheet'>

<script src="js/bootstrap-typeahead.js"></script>
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
					<h2><i class="glyphicon glyphicon-globe"></i>  REVERSE ENTRY</h2>
					
					
				</div>
				
				
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row table-row alert alert-info">
							
							
							
							
							
							
							
							<label class="control-label inline col-sm-3">Transaction Type:
								<select class="form-control" id="tt" name="tt">
									<option>-----select  Transaction-----</option>
									<option>SB Transaction</option>
									<option>PIGMI Transaction</option>
									<option>RD Transaction</option>
									<!--<option>Loan Transaction</option>-->
								</select>
							</label>
							
							<div class="sb">
								
								
								
								
								<label class="control-label inline col-sm-3">Account Number:
									
									<input class="typeahead form-control"  id="account" type="text" name="account" placeholder="Select SB Account Number">
								</label>
								
								
								<label class="col-sm-3 control-label">CREATED DATE
									<div class="date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="dte" id="dte" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</label>
								
								
								
								
								<div class="col-md-2">
									
									<a class="btn btn-default Searchsb btn-info pull-left">
									<i class="glyphicon glyphicon-search"> SEARCH</i></a>
									
								</div>
								
							</div>	
							
							
							
							
							<div class="pigmy">
								
								
								
								<label class="control-label inline col-sm-3">Account Number:
									
									<input class="typeaheadpigmy form-control"  id="pigmy" type="text" name="account" placeholder="Select Pigmy Account Number">  
									
									
								</label>
								
								
								
								
								<label class="col-sm-3 inline control-label">CREATED DATE
									<div class="date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="dtepigmy" id="dtepigmy" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</label>
								
								
								
								
								<div class="col-md-2">
									
									<a class="btn btn-default Searchpigmy btn-info pull-left">
									<i class="glyphicon glyphicon-search"> SEARCH</i></a>
									
								</div>
								
							</div>	
							
							<div class="rd">
								
								
								
								<label class="inline control-label col-sm-3">Account Number:
									
									<input class="typeahead2 form-control" id="rdaccount" type="text" placeholder="ASelect RD Account Number">  
									
								</label>
								
								
								
								<label class="col-sm-3 control-label inline">CREATED DATE
									<div class="date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="dterd" id="dterd"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</label>
								
								
								
								
								<div class="col-md-2">
									
									<a class="btn btn-default Searchrd btn-info pull-left">
									<i class="glyphicon glyphicon-search"> SEARCH</i></a>
									
									
									
								</div>		
							</div>	
							<div class="loan">
								
								
								<label class="control-label inline col-sm-3">Account Number:
									
									<input class="typeahead7 form-control" id="lnaccount" type="text" placeholder="ACCOUNT NUMBER" required>  
									
								</label>
								
								
								
								<label class="col-sm-4 control-label inline">CREATED DATE
									<div class="date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="dteloan"  placeholder="YYYY/MM/DD" data-date-format="yyyy-mm-dd"/>
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</label>
								
								
								
								
								<div class="col-md-2">
									
									<a class="btn btn-default SearchBWloan btn-info pull-left">
									<i class="glyphicon glyphicon-search"> SEARCH</i></a>
									
								</div>
								
							</div>
							
							
							
						</div>
					</div>
				</div>
				
				
				
				
				</br></br>
				</br></br>
				</br>
				
				<div class='SearchRes'>
					<div  id="toprint">
						
						
						
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>


<script>
	
	
	$('.sb').hide();
	$('.rd').hide();
	$('.loan').hide();
	$('.pigmy').hide();
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
	
	
	$('.Searchsb').click(function(e){
		
		trantyp=$('#tt').val();
		dte=$('#dte').val();
		
		
		acid=$('#account').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'reversentryindex',
			type:'get',
			data:'&trantyo='+trantyp+'&startdate='+dte+'&accid='+acid,
			success:function(data)
			{
				//alert("success");
				//$('.box').html(data);
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	$('.Searchpigmy').click(function(e){
		
		trantyp=$('#tt').val();
		dte=$('#dtepigmy').val();
		
		
		acid=$('#pigmy').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'reversentryindexpigmy',
			type:'get',
			data:'&trantyo='+trantyp+'&startdate='+dte+'&accid='+acid,
			success:function(data)
			{
				
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	$('.Searchrd').click(function(e){
		
		trantyp=$('#tt').val();
		dte=$('#dterd').val();
		
		
		acid=$('#rdaccount').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'reversentryindexrd',
			type:'get',
			data:'&trantyo='+trantyp+'&startdate='+dte+'&accid='+acid,
			success:function(data)
			{
				
				$('.SearchRes').html('');
				$('.SearchRes').html(data);
				
				
				
			}
		});
		
	});
	
	
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
	
	$('input.typeahead').typeahead({
		ajax: '/Getaccnum'
	});
	
	$('input.typeahead2').typeahead({
		ajax:'/Getrdaccnum'
	});
	
	$('input.typeahead7').typeahead({
		ajax:'/GetlnAccNum'
	});
	
	$('input.typeaheadpigmy').typeahead({
		ajax:'/GetSearchpigmyAcc'
	});
	
	$('#tt').change( function(e) {
		
		tran=$('#tt').val();
		if(tran=="SB Transaction")
		{
			$('.sb').show();
			$('.rd').hide();
			$('.loan').hide();
			$('.pigmy').hide();
			
		}
		else if(tran=="PIGMI Transaction")
		{
			$('.sb').hide();
			$('.rd').hide();
			$('.loan').hide();
			$('.pigmy').show();
		}
		else if(tran=="RD Transaction"){
			
			$('.sb').hide();
			$('.rd').show();
			$('.loan').hide();
			$('.pigmy').hide();
		}
		else if(tran=="Loan Transaction"){
			
			$('.sb').hide();
			$('.rd').hide();
			$('.loan').show();
			$('.pigmy').hide();
		}
		
		else
		{
			alert("Please Select the Payment Mode");
			$('.sb').hide();
			$('.rd').hide();
			$('.loan').hide();
			$('.pigmy').hide();
		}
	});
	
</script>



