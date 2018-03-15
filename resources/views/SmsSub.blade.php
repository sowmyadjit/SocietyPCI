<script src="js/bootstrap-typeahead.js"></script>
<script src="js/GlobalTypeAheadData.js"></script>
<div id="content<?php echo $smssub['module']->Mid; ?>" class="col-md-10">
	
	
	<!-- content starts -->
	<div class="col-md-12">
		<div class="bdy_<?php echo $smssub['module']->Mid; ?>box-inner">
			
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i> SMS</h2>
			</div>
			
			<div class="box-content">
				<div class="form-group">
					<label class="control-label col-sm-4">SMS Subscription:</label>
					<div class="col-md-4">
						<input type="text" class="typeahead form-control" id="user" name="user" placeholder="Enter User Name">
					</div>
				</div>
				<br/>
				<center>
					<div class="radio">
						<label><input type="radio" name="yes" id="y" value="YES">YES</label>
						<label><input type="radio" name="yes" id="n" value="NO">NO</label><br/><br/>
						<input type="button" value="SUBMIT" class="btn btn-success btn-sm sbmt<?php echo $smssub['module']->Mid; ?>" />
					</div>
				</center><br>
				
				
				
				
			</div><br><br><br><br>
		</div>
	</div>
</div>



<script>
	/*$('.radio').hide();
	$('.submt').hide();*/
/*	$('.sbmt<?php echo $smssub['module']->Mid; ?>').click(function(e){
		
		if($('#y').is(":checked"))
		{
			id=$('#y').val();
			alert(id);
		}
		else
		{
			id=$('#n').val();
			
			alert(id);
		}
		user_name=$('#user').data('value');
		$.ajax({
			url:'SmsSubscription',
			type:'post',
			data:'&smsval='+id+'&userid='+user_name,
			success:function(data){
				$('.smsclassid').click();	
			}
		});
	});
 $('#smss').change(function(r) {
		
		sm=$('#smss').val();
		if(sm=="COMPANY")
		{
			
			$('.radio').show();
			$('.submt').hide();
			
		}
		else if(sm=="BRANCH")
		{
			$('.radio').show();
			$('.submt').hide();
		}
	});
	
	//typeahead events
	
	

	$('input.typeahead').typeahead({
		source: Getuser
	});
	
	/*$('input.typeahead1').typeahead({
		ajax: '/Getaccnum'
		
	});
	$('.typeahead1').change(function(a) {
		id=$('#user').data('value');
		sma=$('.typeahead1').id();
	});
	
	$('.typeahead1').change(function(){
		id=$('ul.typeahead1 li.active').data('value');
		
		/*$.ajax({
		url:'SmsSubs',
		type:'get',
		// data:'&smsval='+id+'&userid='+user_name,
		success:function(){
				$('.account').val(id);
				// alert(id);
			}
		});
	
	});*/
	

</script>


