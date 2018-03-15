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
                <a class="clickme" >pre withdrawal Interest Calculation</a>
			</li>
		</ul>
	</div>
	
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				
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
						<input class="typeahead2 form-control"  type="text"  name="account" id="account" placeholder="SELECT Pigmy Account number">
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
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnsbint"/>
							
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm rdintbtn"/>
							
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnpigmiint"/>
							<input type="button" value="CALCULATE" class="btn btn-success btn-sm sbmbtnfdint"/>
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
	$('.sbmbtnsbint').hide();
	$('.sbmbtnpigmiint').hide();
	$('.rdintbtn').hide();
	$('.tran').hide();
	$('.sbmbtnfdint').hide();
	$('.pigmyacc').hide();
	$('.RdAccount').hide();
	$('.FDAccount').hide();
	//Hide and Show buttons while dropdown value changed
	$('#intrtype').change(function(){
		//alert("Hello");
		type=$('#intrtype').val();
		if(type=="SB pre withdrawal")
		{
			$('.sbmbtnsbint').show();
			$('.sbmbtnpigmiint').hide();
			$('.rdintbtn').hide();
			$('.pigmyacc').hide();
			$('.RdAccount').hide();
			$('.tran').show();
			$('.FDAccount').hide();
			
			$('.sbmbtnfdint').hide();
		}
		else if(type=="Pigmi pre withdrawal")
		{
			$('.sbmbtnsbint').hide();
			$('.rdintbtn').hide();
			$('.sbmbtnpigmiint').hide();
			$('.pigmyacc').show();
			$('.tran').hide();
			$('.RdAccount').hide();
			$('.FDAccount').hide();
			$('.sbmbtnfdint').hide();
		}
		else if(type=="RD pre withdrawal")
		{
			$('.sbmbtnsbint').hide();
			$('.rdintbtn').show();
			$('.sbmbtnpigmiint').hide();
			$('.pigmyacc').hide();
			$('.tran').hide();
			$('.RdAccount').show();
			$('.FDAccount').hide();
			$('.sbmbtnfdint').hide();
		}
		else if(type=="FD pre withdrawal")
		{
			$('.sbmbtnsbint').hide();
			$('.sbmbtnpigmiint').hide();
			$('.sbmbtnfdint').show();
			$('.rdintbtn').hide();
			$('.tran').hide();
			$('.pigmyacc').hide();
			$('.RdAccount').hide();
			$('.FDAccount').show();
		}
		else
		{
			alert("Select Interest Calculation Type");
			$('.sbmbtnsbint').hide();
			$('.rdintbtn').hide();
			$('.sbmbtnpigmiint').hide();
			$('.pigmyacc').hide();
			$('.tran').hide();
			$('.RdAccount').hide();
			$('.sbmbtnfdint').hide();
			$('.FDAccount').hide();
		}
	});
	
	$('input.typeahead1').typeahead({
		ajax: '/Getacctyp'
	});
    $('input.typeahead2').typeahead({
		ajax: '/Getpigmyacct'
	});
	$('input.typeahead3').typeahead({
		ajax: '/Getrdprewithdrawaccnum'
	});
	$('input.typeahead4').typeahead({
		ajax: '/GetFDNum'
	});
	
	//Pigmi Interest Calculation
	p=0;
	$('.sbmbtnpigmiint').click(function(e)
	{
	if(p==0)
	{
	p++;
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
	r=0;
	$('.rdintbtn').click(function(e)
	{
	if(r==0)
	{
		r++;
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
	f=0;
	$('.sbmbtnfdint').click(function(e)
	{
	if(f==0)
	{
		f++;
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
	
	$('.typeahead2').change(function(e){
		
		acc=$('#account').data('value');
		
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