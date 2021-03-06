<script src="js/jquery.validate.min.js"></script>
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
                <a class="clickme" >Interest Calculation</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Interest Calculation</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
						class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				
				<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
				<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
				<div class="hideitem">
					
					<div class="form-group">
						<label class="control-label col-sm-4">Select Interest Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="intrtype" name="intrtype"> 
								<option value="">--Select Type--</option>
								<option>SB Interest</option>
								<option>Pigmi Interest</option>
								<option>RD Interest</option>
								<option>FD WITHDRAW</option>
								<option>KCC WITHDRAW</option>
							</select>
						</div>
					</div></br></br></div>
					<div class="edit">
						<div class="form-group tran">
							<label class="control-label col-sm-4">Account Type:</label>
							<div class="col-md-4">
								<input class="typeahead1 form-control"  type="text"  name="account" placeholder="SELECT Account Type">
							</div>
						</div>
						</br>
						<div class="pigmytypehead">
							<label class="control-label col-sm-4">SELECT PIGMY ACCOUNT:</label>
							<div class="col-md-4">
								<input class="SearchTypeahead form-control" id="searchacc" type="text" name="searchacc" placeholder="SELECT PIGMY ACCOUNT"> 
							</div>
						</div>
						<div class="FDtypehead">
							<label class="control-label col-sm-4">SELECT FD ACCOUNT:</label>
							<div class="col-md-4">
								<input class="fdSearchTypeahead form-control" id="fdsearchacc" type="text" name="fdsearchacc" placeholder="SELECT FD ACCOUNT"> 
							</div>
						</div>
						<div class="KCCtypehead">
							<label class="control-label col-sm-4">SELECT KCC ACCOUNT:</label>
							<div class="col-md-4">
								<input class="kccSearchTypeahead form-control" id="kccsearchacc" type="text" name="kccsearchacc" placeholder="SELECT KCC ACCOUNT"> 
							</div>
						</div>
						<div class="RDtypehead">
							<div class="form-group">
								<label class="control-label col-sm-4">Account Number:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeahead2 form-control" id="rdaccount" type="text" placeholder="ACCOUNT NUMBER">  
								</div>
							</div>
						</div>
						<br><br>
						<div class="sb_date_interest">
						<div class="form-group">
						<label class="control-label col-sm-4">Select Interest Duration:</label>
						<div class="col-md-4">
							<select class="form-control" id="calculation_month" name="calculation_month"> 
								<option value="">--Select Type--</option>
								<option>March-August</option>
								<option>September-February</option>
							</select>
						</div>
						</div>
						<br>
						<br>
						<br>
						<div class="form-group">
						<label class="control-label col-sm-4">Enter Year:</label>
						<div class="col-md-4">
							<input type='number' id='interest_year'>
						</div>
						</div>
						</div>
						<br>
						<br>
						<div style="color:red; padding-left:0;" id='id'></div>
						
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnsbint"/>
									
									<input type="button" value="PREVIEW" class="btn btn-success btn-sm sbmbtnpigmiint" id="pg_preview" />
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnpigmiint" id="pg_calc" />
									<input type="button" value="PREVIEW" class="btn btn-success btn-sm sbmbtnrdint" id="rd_preview" />
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnrdint" id="rd_calc" />
								<?php /*	<input type="button" value="PREVIEW" class="btn btn-success btn-sm sbmbtnFDint" id="fd_preview" />*/?>
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnFDint" id="fd_calc" />
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnKCCint" id="kcc_calc" />
								</div>
							</div>
						</center></br></br>
						
					</div>
					</br>
					
					<div class="form-group intval">
						<label class="control-label col-sm-4" for="first_name">Interest Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="editintamt" name="editintamt">
							<input type="text" class="form-control hidden" id="editintamthiden" name="editintamthiden">
						</div>
					</div>
					
					<div class="form-group intvalrd">
						<label class="control-label col-sm-4" for="first_name">Interest Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="editintamtrd" name="editintamtrd">
							<input type="text" class="form-control hidden" id="editintamthidenrd" name="editintamthidenrd">
						</div>
					</div>
					</br>
					</br>
					</br>
					<center>
						<div class="form-group">
							<input type="button" value="SAVE" class="btn btn-success btn-sm editint"/>
						</div>
						<div class="form-group">
							<input type="button" value="SAVE" class="btn btn-success btn-sm editintrd"/>
						</div>
					</center>
			</div>
		</div>
	</div>
</div>

<script>
	$('.sb_date_interest').hide();
	
	
	$('.hideitem').hide();
	$('.editint').hide();
	$('.editintrd').hide();
	$('.intval').hide();
	$('.intvalrd').hide();
	$('.msg1').hide();
	$('.msg2').hide();
	$('input.fdSearchTypeahead').typeahead({
		ajax: '/GetFDNumber' 
	});
	$('input.kccSearchTypeahead').typeahead({
		ajax: '/GetKCCNumber' 
	});
	
	$temp1="<?php echo $interest['open'];?>";
	$temp2="<?php echo $interest['close'];?>";
	if($temp1==1)
	{
		if($temp2==0)
		{
			$('.hideitem').show();
		}
		else if($temp2==1)
		{
			
			$('.hideitem').hide();
			$('.msg2').show();
			//$(".modal_btn").click();
			
		}
	}
	else if($temp1==0)
	{
		
		$('.hideitem').hide();
		$('.msg1').show();
		//$(".modal_btn").click();
	}
	
	//Hide buttons while page load
	$('.sbmbtnsbint').hide();
	$('.sbmbtnpigmiint').hide();
	$('.sbmbtnrdint').hide();
	$('.sbmbtnFDint').hide();
	$('.tran').hide();
	$('.pigmytypehead').hide();
	$('.FDtypehead').hide();
	$('.RDtypehead').hide();
	
	//Hide and Show buttons while dropdown value changed
	$('#intrtype').change(function(){
		//alert("Hello");
		type=$('#intrtype').val();
		if(type=="SB Interest")
		{
			$('.sb_date_interest').show();
			$('.sbmbtnsbint').show();
			$('.sbmbtnpigmiint').hide();
			$('.tran').show();
			$('.sbmbtnFDint').hide();
			$('.pigmytypehead').hide();
			$('.FDtypehead').hide();
			$('.RDtypehead').hide();
			$('.sbmbtnKCCint').hide();
			$('.KCCtypehead').hide();
		}
		else if(type=="Pigmi Interest")
		{
			$('.sb_date_interest').hide();
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').show();
			$('.tran').hide();
			$('.sbmbtnrdint').hide();
			$('.sbmbtnFDint').hide();
			$('.pigmytypehead').show();
			$('.FDtypehead').hide();
			$('.RDtypehead').hide();
			$('.sbmbtnKCCint').hide();
			$('.KCCtypehead').hide();
		}
		else if(type=="RD Interest")
		{
			$('.sb_date_interest').hide();
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.tran').hide();
			$('.sbmbtnrdint').show();
			$('.sbmbtnFDint').hide();
			$('.pigmytypehead').hide();
			$('.FDtypehead').hide();
			$('.RDtypehead').show();
			$('.sbmbtnKCCint').hide();
			$('.KCCtypehead').hide();
		}
		else if(type=="FD WITHDRAW")
		{
			$('.sb_date_interest').hide();
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.tran').hide();
			$('.sbmbtnrdint').hide();
			$('.pigmytypehead').hide();
			$('.sbmbtnFDint').show();
			$('.FDtypehead').show();
			$('.RDtypehead').hide();
			$('.sbmbtnKCCint').hide();
			$('.KCCtypehead').hide();
		}
		else if(type=="KCC WITHDRAW")
		{
			$('.sb_date_interest').hide();
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.tran').hide();
			$('.sbmbtnrdint').hide();
			$('.pigmytypehead').hide();
			$('.sbmbtnFDint').hide();
			$('.FDtypehead').hide();
			$('.RDtypehead').hide();
			$('.sbmbtnKCCint').show();
			$('.KCCtypehead').show();
		}
		else
		{
			alert("Select Interest Calculation Type");
		}
	});

	
	$('input.typeahead1').typeahead({
		ajax: '/Getacctyp'
	});
	
	//Pigmi Interest Calculation
	pigmiindex=0;
	$('#pg_calc').click(function(e)
	{
		console.log("pg_calc");
		if(pigmiindex==0)
		{
			
			pigmiindex++;
			acc=$('.SearchTypeahead').attr('data-value');
			e.preventDefault();
			$.ajax({
				url:'pigmiInterestCalc',
				type:'post',
				data: '&acc11=' + acc,
				success:function(data){
					alert(data);
					$claculatedint=data;
					$('.editint').show();
					$('.intval').show();
					$('.edit').hide();
					$('#editintamt').val($claculatedint);
					$('#editintamthiden').val($claculatedint);
					disable_preview();
				}
			});
		}
	});
	indexeditsb=0;
	$('.editint').click(function(e)
	{
		if(indexeditsb==0)
		{
			indexeditsb++;
			
			acc=$('.SearchTypeahead').attr('data-value');
			editedintamt=$('#editintamt').val();
			
			calculatedintamt=$('#editintamthiden').val();
			$.ajax({
				url:'editpigmiInterestCalc',
				type:'post',
				data: '&intrestamt='+editedintamt+'&acc11='+acc+'&acualamt='+calculatedintamt,
				success:function(data){
					alert('success');
					//$('.companyclassid').click();
				}
			});
		}
	});
	indexeditrdid=0;
	$('.editintrd').click(function(e)
	{
		if(indexeditrdid==0)
		{
			indexeditrdid++;
			acc=$('.typeahead2').attr('data-value');
			editedintamt=$('#editintamtrd').val();
			
			calculatedintamt=$('#editintamthidenrd').val();
			$.ajax({
				url:'editrdInterestCalc',
				type:'post',
				data: '&intrestamt='+editedintamt+'&acc11='+acc+'&acualamt='+calculatedintamt,
				success:function(data){
					alert('success');
					//$('.companyclassid').click();
				}
			});
		}
	});
	rdindexid=0;
	$('#rd_calc').click( function(e) {
		console.log("rd_calc");
		if(rdindexid==0)
		{
			
			rdindexid++;
			//acctyp=$('.typeahead1').data('value');
			rdaccnum=$('.typeahead2').attr('data-value');
			if(rdaccnum == undefined)
			{
				$("#id").html('This field is required');
				}else{
				$("#id").hide();
				
				e.preventDefault();
				$.ajax({
					url: 'rd_interest',
					type: 'post',
					data: '&rdaccid='+rdaccnum,
					success: function(data) {
						//alert('success');
						$intamtrd=data;
						//  $('.companyclassid').click();
						$('#editintamtrd').val($intamtrd);
						$('#editintamthidenrd').val($intamtrd);
						$('.intvalrd').show();
						$('.editintrd').show();
						disable_preview();
					}
				});
			}
		}
	});
	sbindexid=0;
	$('.sbmbtnsbint').click( function(e) {
		if(sbindexid==0)
		{
			
			sbindexid++;
			acctyp=$('.typeahead1').attr('data-value');
			
			if(acctyp == undefined)
			{
				$("#id").html('This field is required');
			}
			else{
				$("#id").hide();
				
				calculation_month=$('#calculation_month').val();
				interest_year=$('#interest_year').val();
				console.log(calculation_month);
				if(calculation_month=='March-August'){
				calculation_month_value=3;
				}
				else if(calculation_month=='September-February'){
				calculation_month_value=9;
				}
				console.log('check',calculation_month_value);
				e.preventDefault();
				$.ajax({
					url: 'sb_interest',
					type: 'post',
					data: '&acctyp_11=' + acctyp+'&calculation_month_value='+calculation_month_value+'&interest_year='+interest_year,
					success: function(data) {
						alert('success');
						//  $('.companyclassid').click();
					}
				});
			}
		}
	});
	fdindexid=0;
	$('#fd_calc').click(function(e)
	{
		console.log("fd_calc");
		if(fdindexid==0)
		{
			
			
			fdindexid++;
			e.preventDefault();
			fdnum=$('.fdSearchTypeahead').attr('data-value');
			$.ajax({
				url:'FDwithdraw',
				type:'post',
				data: '&fdalocid=' + fdnum,
				success:function(e){
					alert('Success');
					disable_preview();
				}
			});
		}
	});
	kccindexid=0;
	$('#kcc_calc').click(function(e)
	{
		console.log("kcc_calc");
		if(kccindexid==0)
		{
			
			
			kccindexid++;
			e.preventDefault();
			kccnum=$('.kccSearchTypeahead').attr('data-value');
			$.ajax({
				url:'FDwithdraw',
				type:'post',
				data: '&fdalocid=' + kccnum,
				success:function(e){
					alert('Success');
					disable_preview();
				}
			});
		}
	});
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSeachedpigmyAccinterest'
	});
	
	$('input.typeahead2').typeahead({
		//ajax:'/Getrdaccnum'
		ajax:'/get_running_rd_num'
	});
	
</script>

<script>
	$("#pg_preview").click(function(e) {
		console.log("pg_preview");
		acc=$('.SearchTypeahead').attr('data-value');
		e.preventDefault();
		$.ajax({
			url:'pigmiInterestCalc',
			type:'post',
			data: '&acc11=' + acc+"&preview=1",
			success:function(data){
				alert("Interest Amount: "+data);
			}
		});
	});
</script>

<script>
	$("#rd_preview").click(function(e) {
		console.log("rd_preview");
		e.preventDefault();
		rdaccnum=$('.typeahead2').attr('data-value');
		$.ajax({
			url: 'rd_interest',
			type: 'post',
			data: '&rdaccid='+rdaccnum+"&preview=1",
			success: function(data) {
				alert("Interest Amount: "+data);
			}
		});
	});
</script>
<script>
	function disable_preview() {
		$("#pg_preview, #rd_preview").prop("disabled",true);
	}
</script>