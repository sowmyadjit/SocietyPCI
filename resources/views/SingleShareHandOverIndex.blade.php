<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery.validate.min.js"></script>

<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-random"></i> Create Branch</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					{!! Form::open(['url' => "createbranch1",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}
					
					@foreach($shares['data1']['data'] as $shr)
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">NAME:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="Name" name="Name" value="{{$shr->FirstName}}.{{$shr->MiddleName}}.{{$shr->LastName}}" readonly>
						</div>
					</div>
					
					<div class="form-group hidden">
						<label class="control-label col-sm-4" for="first_name">CERTIFICATE NUMBER:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="cn" name="cn" value="{{$shr->PURSH_Certfid}}" readonly>
							
							<input type="text" class="form-control hidden " id="cnhidden" name="cnhidden" value="{{$shr->PURSH_Certfid}}">
							
							<input type="text" class="form-control hidden" id="pid" name="pid" value="{{$shr->PURSH_Pid}}">
							
							<input type="text" class="form-control hidden" id="sid" name="sid" value="{{$shr->individual_share_ID}}">
						</div>
					</div>
					
					@endforeach
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">Number OF Shares:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bcity" name="bcity" value="{{$shares['data1']['no_of_share']}}" readonly>
							
							<input type="text" class="form-control hidden" id="no_of_shares" name="no_of_shares" value="{{$shares['data1']['no_of_share']}}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="first_name">PAYABLE AMOUNT:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="bcity" name="bcity" value="{{$shares['data1']['no_of_amt']}}" readonly>
							
							<input type="text" class="form-control hidden" id="payamt" name="payamt" value="{{$shares['data1']['no_of_amt']}}">
							
							<input type="text" class="form-control hidden" id="all_share_id" name="all_share_id" value="{{$shares['data1']['All_share_id']}}">
							
							<input type="text" class="form-control hidden" id="loopid" name="loopid" value="{{$shares['data1']['loopid']}}">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Type:</label>
						<div class="col-md-4">
							<select class="form-control" id="tt" name="tt">
								<option>-----Payment Type-----</option>
								<option>CASH</option>
								<option>Adjust TO Branch</option>
								
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4"> TO BRANCH:</label>
						<div class="col-md-4">
						<select class="form-control BranchList2"  id="BranchList2" name="BranchList2">  
							
							<?php foreach($shares['branch_data'] as $key){
								echo "<option value='".$key->Bid."' >" .$key->BName."";
								echo "</option>";
							}?>
						</select>
					</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">HEAD:	</label>
						<div class="col-md-4">
						<select class="form-control HeadListDD"  id="HeadiD" name="HeadiD">  
							<option value="">--Select Head--</option>
							<?php foreach($shares['led'] as $key){
								echo "<option value='".$key->lid."' >" .$key->lname."";
								echo "</option>";
							}?>
						</select>
					</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Sub Head:</label>
						<div class="col-md-4">
						<select class="form-control" id="expsubhead" name="expsubhead">
							
							<option></option>
							
						</select>
						
					</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Perticulars:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="per" name="per" placeholder="">
						</div>
					</div>
					
					
					<center>
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="PAY" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
							</div>
						</div>
					</center>
					
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	branchid=0;
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.branchclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	
	$('.sbmbtn').click( function(e) {
	/*	pid=$('#pid').val();
		sid=$('#sid').val();
		cerificateid=$('#cnhidden').val();
		payamt=$('#payamt').val();*/
		e.preventDefault();
		$.ajax({
			url: 'SingleShareCloseTran',
			type: 'post',
			data:  $('#form_des').serialize(),
			success: function(data) {
				alert('success');
				$('.branchclassid').click();
			}
			
		});
		
	});
	$('#HeadiD').change(function(e){
		//agent=$('ul.typeahead1 li.active').data('value');
		Lid=$('#HeadiD').val();
		
		 alert(Lid);
		e.preventDefault();
		
		$.ajax({
			url:'GetSubLedgerHead',
			type:'get',
			data:'&LedgerId='+Lid,
			success:function(data)
			{
				// alert("success");
				var sel = document.getElementById('expsubhead');
				for (i = sel.length - 1; i >= 0; i--) {
					sel.remove(i);
				}
				$("#expsubhead").append("<option value=\"ALL\">SELECT</option>");
				var jsonData = JSON.parse(data);
				for (var i = 0; i < jsonData.length; i++) {
					var prop = jsonData[i];
					$("#expsubhead").append("<option value=\"" + prop.lid +"\">"+ prop.lname +"</option>");
				}
				
			}
		});
	});
</script>