<script src="js/jquery.validate.min.js"></script>
<div class="MemCreatePage">
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
					<a class="clickme" >Transaction</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-globe"></i> shares</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
					
					{!! Form::open(['url' => "createtransaction",'class' => 'form-horizontal','id' => 'form_tran','method'=>'post']) !!}
					<div class="msg1 pull-left"><h5 style="color:red;">Day Is Not Open, Please Contact The Manager</h5></div> 
				<div class="msg2 pull-left"><h5 style="color:red;">Day Is Closed, Please Contact The Manager</h5></div> 
				
				<div class="hideitem">
					<div class="form-group">
						<label class="control-label col-sm-4">Select Member:</label>
						<div class="col-md-4">
							<select class="form-control" id="tt" name="tt">
								<option>-----select  Member-----</option>
								<option>New Member</option>
								<option>Existing Member</option>
								<option>Transfer Customer To Member </option>
								
								</select>
						</div>
					</div>
					</div>
				</div>
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
	
	$('#tt').change(function(e){
		temp=$('#tt').val();
		if(temp=="New Member")
		{
			
			$.ajax({
				url:'/memberview',
				type:'get',
				success:function(data)
				{
					//alert("success");
					$('.MemCreatePage').html(data);
					
					
					}
				});
			
				
			}
			else if(temp=="Existing Member")
			{
				//$('.purshareclassid').click();
				$.ajax({
				url:'/pursharesdetail',
				type:'get',
				success:function(data)
				{
					//alert("success");
					$('.MemCreatePage').html(data);
					
					
					}
				});
			}
			else
			
			{
				//$('.transclassid').click();
				$.ajax({
				url:'/transfercusttomem',
				type:'get',
				success:function(data)
				{
					//alert("success");
					$('.MemCreatePage').html(data);
					
					
					}
				});
				
			}
		});
	</script>
	
	
