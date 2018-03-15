

<div id="content" class="col-md-10">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SD PAY</h2>
					
					
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "crateaddbank",'class' => 'form-horizontal','id' => 'form_addbank','method'=>'post']) !!}
					
					<div class="form-group">
						<label class="control-label col-sm-4">Select:</label>
						<div class="col-md-4">
							<input  class="selectemp form-control" id="selectemp" type="text" name="selectemp" placeholder="SELECT ">  
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">SD:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="sd" name="sd" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">SD Interest:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="sdi" name="sdi" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">payment mode:</label>
						<div class="col-md-4">
							<select class="form-control" id="tt" name="tt">
								<option>-----select  Transaction-----</option>
								<option>SB</option>
								<option>CASH</option>
								
							</select>
						</div>
					</div>
					<div class="sb">
						<div class="form-group">
							<label class="control-label col-sm-4">Account Number:</label>
							<div class="col-md-4">
								<input class="typeahead form-control"  id="account" type="text" name="account" placeholder="SELECT Account Number">  
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">NAME:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="name" name="name" />
								
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="comment">Balance:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="cb" name="cb" />
								<input type="text" class="form-control hidden" id="cbreadonly" name="cbreadonly" />
							</div>
						</div>
					</div>
					<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm AddBankSbmBtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm AddBankCnclBtn"/>
								<input type="reset" value="RESET" class="btn btn-info btn-sm resetbtn"/>
							</div>
						</div>
					</center>
					<!--</form>-->
					{!! Form::open() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/sidebar/sidebar.js"></script>
<script src="js/bootstrap-typeahead.js"></script>

<script>
	
	
	$('.sb').hide();
	
	
	addbankindex=0;
	
	$('.AddBankSbmBtn').click( function(e) {
		if(addbankindex==0){
			addbankindex++;
			
			accnum=$('#account').data('value');
			selectemp=$('#selectemp').data('value');
			
			e.preventDefault();
			$.ajax({
				url: 'SDINTERESTPAY',
				type: 'post',
				data: $('#form_addbank').serialize()+'&accnum='+accnum+'&selectemp='+selectemp,
				success: function(data) {
					alert('success');
					$('.bankclassid').click();
				}
			});
		}
	});
	
	$('#selectemp').typeahead({
		ajax: '/GetEmpName1'
	});
	$('#account').typeahead({
		ajax:'/Getaccnum'
		//source:GetlnAccNum
	});
	
	$('#selectemp').change(function(e){
		selectemp=$('#selectemp').data('value');
		$.ajax({
			url:'getemployeeSD',
			type:'post',
			data:'&selectemp='+selectemp,
			success:function(data)
			{
				$('#sd').val(data['sd']);
			}
		});
	});
	$('#account').change(function(e){
		accnum=$('#account').data('value');
		e.preventDefault();
		$.ajax({
			url:'retriveacc',
			type:'post',
			data:'&acttype='+accnum,
			success:function(data){ 
				$('#cb').val(data['crbal']);
				$('#cbreadonly').val(data['crbal']);
				//$('#at').val(data['actype']);
				$('#name').val(data['fname']);
				//$('#acctype').val(data['acid']);
			}
		});
	});
	
	
	$('#tt').change( function(e) {
		e.preventDefault();
		mode=$('#tt').val();
		if(mode=="CASH")
		{
			
			
			$('.sb').hide();
		}
		else 
		{
			$('.sb').show();
		}
	});
	
	
	
</script>
