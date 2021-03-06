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
						<div class="RDtypehead">
							<div class="form-group">
								<label class="control-label col-sm-4">Account Number:</label>
								<div id="the-basics" class="col-sm-4">
									<input class="typeahead2 form-control" id="rdaccount" type="text" placeholder="ACCOUNT NUMBER">  
								</div>
							</div>
						</div>
						<div style="color:red; padding-left:0;" id='id'></div>
						
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnsbint"/>
									
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnpigmiint"/>
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnrdint"/>
									<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnFDint"/>
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
							<input type="button" value="Edit" class="btn btn-success btn-sm editint"/>
						</div>
						<div class="form-group">
							<input type="button" value="Edit" class="btn btn-success btn-sm editintrd"/>
						</div>
					</center>
			</div>
		</div>
	</div>
</div>


<script>
	
	
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
			$('.sbmbtnsbint').show();
			$('.sbmbtnpigmiint').hide();
			$('.tran').show();
			$('.sbmbtnFDint').hide();
			$('.pigmytypehead').hide();
			$('.FDtypehead').hide();
			$('.RDtypehead').hide();
		}
		else if(type=="Pigmi Interest")
		{
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.tran').hide();
			$('.sbmbtnFDint').hide();
			$('.pigmytypehead').show();
			$('.FDtypehead').hide();
			$('.RDtypehead').hide();
		}
		else if(type=="RD Interest")
		{
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.tran').hide();
			$('.sbmbtnrdint').show();
			$('.sbmbtnFDint').hide();
			$('.pigmytypehead').hide();
			$('.FDtypehead').hide();
			$('.RDtypehead').show();
		}
		else if(type=="FD WITHDRAW")
		{
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.tran').hide();
			$('.sbmbtnrdint').hide();
			$('.pigmytypehead').hide();
			$('.sbmbtnFDint').show();
			$('.FDtypehead').show();
			$('.RDtypehead').hide();
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
	$('.sbmbtnpigmiint').click(function(e)
	{
		if(pigmiindex==0)
		{
			
			pigmiindex++;
			
			acc=$('.SearchTypeahead').data('value');
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
				}
			});
		}
	});
	
	$('.editint').click(function(e)
	{
		acc=$('.SearchTypeahead').data('value');
		editedintamt=$('#editintamt').val();
		
		calculatedintamt=$('#editintamthiden').val();
		$.ajax({
			url:'editpigmiInterestCalc',
			type:'post',
			data: '&intrestamt='+editedintamt+'&acc11='+acc+'&acualamt='+calculatedintamt,
			success:function(data){
				alert('success');
				$('.companyclassid').click();
			}
		});
		
	});
	$('.editintrd').click(function(e)
	{
		acc=$('.typeahead2').data('value');
		editedintamt=$('#editintamtrd').val();
		
		calculatedintamt=$('#editintamthidenrd').val();
		$.ajax({
			url:'editrdInterestCalc',
			type:'post',
			data: '&intrestamt='+editedintamt+'&acc11='+acc+'&acualamt='+calculatedintamt,
			success:function(data){
				alert('success');
				$('.companyclassid').click();
			}
		});
		
	});
	rdindexid=0;
	$('.sbmbtnrdint').click( function(e) {
		if(rdindexid==0)
		{
			
			rdindexid++;
			//acctyp=$('.typeahead1').data('value');
			rdaccnum=$('.typeahead2').data('value');
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
			acctyp=$('.typeahead1').data('value');
			
			if(acctyp == undefined)
			{
				$("#id").html('This field is required');
			}
			else{
				$("#id").hide();
				
				e.preventDefault();
				$.ajax({
					url: 'sb_interest',
					type: 'post',
					data: '&acctyp_11=' + acctyp,
					success: function(data) {
						alert('success');
						//  $('.companyclassid').click();
					}
				});
			}
		}
	});
	fdindexid=0;
	$('.sbmbtnFDint').click(function(e)
	{
		if(fdindexid==0)
		{
			
			
			fdindexid++;
			e.preventDefault();
			fdnum=$('.fdSearchTypeahead').data('value');
			$.ajax({
				url:'FDwithdraw',
				type:'post',
				data: '&fdalocid=' + fdnum,
				success:function(e){
					alert('Success');
				}
			});
		}
	});
	
	$('input.SearchTypeahead').typeahead({
		ajax: '/GetSeachedpigmyAccinterest'
	});
	
	$('input.typeahead2').typeahead({
		ajax:'/Getrdaccnum'
	});
	
	$('.SearchTypeahead').change(function(e){
		
		acc=$('#searchacc').data('value');
		
		e.preventDefault();
		$.ajax({
			url:'secrchforloan',
			type:'get',
			data:'&acc='+acc,
			success:function(data)
			{
				if(data>0)
				{
					$('.sbmbtnpigmiint').hide();
					alert("Loan is not closed");
				}
				else
					
					{
						$('.sbmbtnpigmiint').show();
					}
			}
		});
	});	
	
	
	
	</script>	