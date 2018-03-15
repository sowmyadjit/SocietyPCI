<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $interest['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
	<div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
			</li>
            <li>
                <a class="clickme" >pre withdrawal Interest Calculation</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $interest['module']->Mid; ?>box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> pre withdrawal Interest Calculation</h2>
					
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
						<label class="control-label col-sm-4">Select pre withdrawal Interest Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="intrtype" name="intrtype"> 
								<option value="">--Select Type--</option>
								<option>SB pre withdrawal</option>
								<option>RD pre withdrawal</option>
								<option>Pigmi pre withdrawal</option>
								<option>FD pre withdrawal</option>
								
							</select>
						</div>
					</div></br></br>
				</div>
				
				<div class="form-group tran">
					<label class="control-label col-sm-4">Account Type:</label>
					<div class="col-md-4">
						<input class="typeahead1 form-control"  type="text"  name="account" placeholder="SELECT SB Account Type">
					</div>
				</div>
				<div class="form-group pigmyacc">
					<label class="control-label col-sm-4">Account number:</label>
					<div class="col-md-4">
						<input class="typeahead2 form-control"  type="text"  name="account" placeholder="SELECT Pigmy Account number">
					</div>
				</div>
				<div class="form-group FDAccount">
					<label class="control-label col-sm-4">Certificate number:</label>
					<div class="col-md-4">
						<input class="typeahead4 form-control"  type="text"  name="account" placeholder="SELECT FD Certificate number">
					</div>
				</div>
				
				<div class="form-group RdAccount">
					<label class="control-label col-sm-4">Account number:</label>
					<div class="col-md-4">
						<input class="typeahead3 form-control"  type="text"  name="account" placeholder="SELECT RD Account number">
					</div>
				</div>
				</br>
				<div style="color:red; padding-left:0;" id='id'></div>
				
				<center>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnsbint<?php echo $interest['module']->Mid; ?>"/>
							
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm rdintbtn<?php echo $interest['module']->Mid; ?>"/>
							
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>"/>
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnfdint<?php echo $interest['module']->Mid; ?>"/>
						</div>
					</div>
				</center></br></br>
				
				
			</div>
		</div>
	</div>
</div>


<script>
	$('.hideitem').hide();
	
	$('.msg1').hide();
	$('.msg2').hide();
	
	
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
	$('.sbmbtnsbint<?php echo $interest['module']->Mid; ?>').hide();
	$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').hide();
	$('.rdintbtn<?php echo $interest['module']->Mid; ?>').hide();
	$('.tran').hide();
	$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').hide();
	$('.pigmyacc').hide();
	$('.RdAccount').hide();
	$('.FDAccount').hide();
	//Hide and Show buttons while dropdown value changed
	$('#intrtype').change(function(){
		//alert("Hello");
		type=$('#intrtype').val();
		if(type=="SB pre withdrawal")
		{
			$('.sbmbtnsbint<?php echo $interest['module']->Mid; ?>').show();
			$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').hide();
			$('.rdintbtn<?php echo $interest['module']->Mid; ?>').hide();
			$('.pigmyacc').hide();
			$('.RdAccount').hide();
			$('.tran').show();
			$('.FDAccount').hide();
			
			$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').hide();
		}
		else if(type=="Pigmi pre withdrawal")
		{
			$('.sbmbtnsbint<?php echo $interest['module']->Mid; ?>').hide();
			$('.rdintbtn<?php echo $interest['module']->Mid; ?>').hide();
			$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').show();
			$('.pigmyacc').show();
			$('.tran').hide();
			$('.RdAccount').hide();
			$('.FDAccount').hide();
			$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').hide();
		}
		else if(type=="RD pre withdrawal")
		{
			$('.sbmbtnsbint<?php echo $interest['module']->Mid; ?>').hide();
			$('.rdintbtn<?php echo $interest['module']->Mid; ?>').show();
			$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').hide();
			$('.pigmyacc').hide();
			$('.tran').hide();
			$('.RdAccount').show();
			$('.FDAccount').hide();
			$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').hide();
		}
		else if(type=="FD pre withdrawal")
		{
			$('.sbmbtnsbint<?php echo $interest['module']->Mid; ?>').hide();
			$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').hide();
			$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').show();
			$('.rdintbtn<?php echo $interest['module']->Mid; ?>').hide();
			$('.tran').hide();
			$('.pigmyacc').hide();
			$('.RdAccount').hide();
			$('.FDAccount').show();
		}
		else
		{
			alert("Select Interest Calculation Type");
			$('.sbmbtnsbint<?php echo $interest['module']->Mid; ?>').hide();
			$('.rdintbtn<?php echo $interest['module']->Mid; ?>').hide();
			$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').hide();
			$('.pigmyacc').hide();
			$('.tran').hide();
			$('.RdAccount').hide();
			$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').hide();
			$('.FDAccount').hide();
		}
	});
	
	$('input.typeahead1').typeahead({
		//ajax: '/Getacctyp'
		source:Getacctyp
	});
    $('input.typeahead2').typeahead({
		//ajax: '/Getpigmyacct'
		source:Getpigmyacct
	});
	$('input.typeahead3').typeahead({
		//ajax: '/Getrdprewithdrawaccnum'
		source:Getrdprewithdrawaccnum
	});
	$('input.typeahead4').typeahead({
		//ajax: '/GetFDNum'
		source:GetFDNum
	});
	
	//Pigmi Interest Calculation
	prepigindex=0;
	$('.sbmbtnpigmiint<?php echo $interest['module']->Mid; ?>').click(function(e)
	{
		if(prepigindex==0){
			prepigindex++;
		
		pigmyacc=$('.typeahead2').data('value');
		// alert(pigmyacc);
		e.preventDefault();
		$.ajax({
			url:'prepigmiwithdrawal',
			type:'post',
			data:'&pigmyaccount='+pigmyacc,
			success:function(e){
				alert('Success');
			}
		});
		}
	});
	rdindex=0;
	$('.rdintbtn<?php echo $interest['module']->Mid; ?>').click(function(e)
	{
		if(rdindex==0){
			rdindex++;
		
		rdacc=$('.typeahead3').data('value');
		alert(rdacc);
		e.preventDefault();
		$.ajax({
			url:'prerdwithdrawal',
			type:'post',
			data:'&rdaccount='+rdacc,
			success:function(e){
				alert('Success');
				$('.typeahead3').data('');
			}
		});
		}
	});
	sbindex=0;
	$('.sbmbtnfdint<?php echo $interest['module']->Mid; ?>').click(function(e)
	{
		if(sbindex==0){
			sbindex++;
		
		
		fdacc=$('.typeahead4').data('value');
		alert(fdacc);
		e.preventDefault();
		$.ajax({
			url:'prefdwithdrawal',
			type:'post',
			data:'&fdaccount='+fdacc,
			success:function(e){
				alert('Success');
				// $('.typeahead3').data('');
			}
		});
		}
	});
	
	
	
	
</script>