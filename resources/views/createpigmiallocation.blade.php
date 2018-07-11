<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>
<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>

<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> ALLOCATE PIGMI</h2>
					
				</div>
				
				<div class="box-content">
					
					
					{!! Form::open(['url' => 'crtpigmialloc','class' => 'form-horizontal','id' => 'form_pigmialloc','method'=>'post']) !!}
					
					
					
					
					<!--Pigmi Allocation Detail-->
					<div class="form-group">
						<label class="control-label col-sm-4">Pigmi Type:</label>
						<div class="col-md-4">
							<input style="border-color:red" class="typeahead form-control" id="pigmitype"  type="text" name="pigmitype" placeholder="SELECT PIGMI TYPE"/>  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Branch Name:</label>
						<div class="col-md-4">
							<input  style="border-color:red" class="typeahead3 form-control"  type="text" id="bname" name="bname" placeholder="SELECT BRANCH NAME"/>  
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Agent Name:</label>
						<div class="col-md-4">
							<input style="border-color:red" class="agenttypeahead form-control"  type="text" name="agent" placeholder="SELECT AGENT NAME">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Agent Commission:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgcmsn" name="pgcmsn" placeholder="ENTER AGENT COMMISSION">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Customer Name:</label>
						<div class="col-md-4">
							<input  style="border-color:red" class="typeahead2 form-control"  type="text" name="cname" placeholder="SELECT CUSTOMER NAME">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Opening Balance:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="opngbal" name="opngbal" placeholder="ENTER OPENING BALANCE">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Allocation Date:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgalloc" name="pgalloc" value="<?php echo date('d/m/Y');?>">
						</div>
					</div>
					
					<!--<div class="form-group">
						<label class="control-label col-sm-4">Pigmi Start Date:</label>
						<div class="col-md-4">
						<input type="text" class="form-control" id="pgsdte" name="pgsdte" placeholder="ENTER START DATE">
						</div>
					</div>-->
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Pigmi Start Date</label>
						<div class="col-md-4 date">
							<div class="input-group input-append date" id="datePicker">
								<input type="text" class="form-control datepicker" name="pgsdte" id="pgsdte"  placeholder="YYYY/MM/DD" data-date-format="dd/mm/yyyy"/>
								<span class="input-group-addon add-on">
									<span class="glyphicon glyphicon-calendar">
									</span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Pigmi End Date:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="pgedte" name="pgedte" placeholder="ENTER END DATE" >
						</div>
					</div>
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="month" name="month" value="12" >
					</div>
					
					
					<div class="col-md-4 hidden">
						<input type="text" class="form-control" id="branch" name="branch" value="12" >
					</div>
					
					
					<center>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
							</div>
						</div>
					</center>
					
				</div>
				
			</div>
			
			{!! Form::close() !!}
		</div>
	</div>
</div>

</div>
</div>

<script>
	$(document).ready(function() {
		$('#pgsdte').change(function(){
			var start_date = document.getElementById('pgsdte').value;
			var c_start_date = start_date.split('/').reverse().join('/');;
			var tenure = document.getElementById('month').value; 
			var c_start_date_obj = new Date(c_start_date);
			var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(tenure), c_start_date_obj.getDate());
			var c = (c_end_date_obj.getMonth())+1;
			var c_end_date = c_end_date_obj.getDate() + '/' + c + '/' + c_end_date_obj.getFullYear();
			document.getElementById('pgedte').value = c_end_date;
		});
	});
	
	
	//Get branch Code
	$('#bname').change(function(e){
		//alert('hi');
		brid=$('#bname').data('value');
		//alert(brid);
		$.ajax({
			url:'GetBranchID',
			type:'post',
			data:'&branch='+brid,
			success:function(data)
			{
				b=$('#branch').val(data['bcde']);
				//alert(b);
			}
		});
	});
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.pigmiallocclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.resetbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
			
			return true;
		}
		else{
			return false;
		}
		
	});
	
	
p=0;
	$('.sbmbtn').click( function(e) {
		if(p==0)
		{
			
			$("#form_pigmialloc").validate({
				rules:{
					pigmitype:"required",
					agent:"required",
					pgcmsn:{
						required:true,
						number:true
					},
					cname:"required",
					opngbal:{
						required:true,
						number:true
					},
					pgalloc:{
						required:true,
						//date:true
					},
					pgsdte:{
						required:true,
						//date:true
					},
					pgedte:{
						required:true,
						//date:true
					},
				}
			});
			if($("#form_pigmialloc").valid())
			{ 
				
				//alert("hi");
			//	pt=$('.typeahead').data('value');
				pt=$('#pigmitype').attr('data-value');
				ui=$('.typeahead2').data('value');
				agi=$('.agenttypeahead').data('value');
				bid=$('#bname').data('value');
				//alert(ui);
				//alert(agi);
				//alert(pt);
				if(ui>0&&agi>0&&pt>0)
				{
					p++;
				
				e.preventDefault();
			
				$.ajax({
					
					url: 'crtpigmialloc',
					type: 'post',
					data: $('#form_pigmialloc').serialize() + '&pigmid=' + pt +'&uid='+ui+'&agid='+agi+'&branchid='+bid,
					success: function(data) {
						alert('success');
						$('.pigmiallocclassid').click();
						//window.location.reload(true);
					}
					});
				}
				else
				{
					
					alert("Account is not created,Refesh and create once again ");
				}
				
					
			}
		}
	});
	$('.typeahead').change(function(e){
		pt=$('ul.typeahead li.active').data('value');
		e.preventDefault();
		$.ajax({
			url:'RetrieveCommission',
			type:'get',
			data:'&pigmiid='+pt,
			success:function(data)
			{
				$('#pgcmsn').val(data['commission']);
				}
			});
	});
	
</script>
<script>
	
	$('input.typeahead').typeahead({
		//ajax: '/GetAccountType'
		source:GetAccountType
	});
	$('input.agenttypeahead').typeahead({
		//ajax:'/GetAgentName'
		source:GetAgentName
	});
	$('input.typeahead2').typeahead({
		ajax:'/GetCustomer'
		//source:GetCustomer
	});
	
	$('input.typeahead3').typeahead({
		ajax:'/GetBranches'
		// source:GetBranches
	});
	/*$('.chk').click(function(e)
		{
		e.preventDefault();
		a=$('ul.typeahead li.active').data('value');
		branchid=a;
		
	});*/
	$('.datepicker').datepicker().on('changeDate',function(e){
		$(this).datepicker('hide');
	});
</script>

