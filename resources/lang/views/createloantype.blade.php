<!--<center><h1>ACCOUNT TYPE DETAILS</h1>-->
<div id="content" class="col-md-12">
	<!-- content starts -->
    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>Create Account Type</h2>
					
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					{!! Form::open(['url' => "createloantype",'class' => 'form-horizontal','id' => 'form_loantyp','method'=>'post']) !!}
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Loan Category:</label>
						<div class="col-sm-4">
							<select class="form-control LoanCategoryDD"  id="LoanCategory" name="LoanCategory" placeholder="SELECT Loan Category">  
								<option value="">--Select Loan Category--</option>
								<?php foreach($LoanCategory as $key){
									echo "<option value='".$key->LoanCategoryID."' >" .$key->LoanCategoryName."";
									echo "</option>";
								}?>
							</select>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4">Loan Type :</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="loantyp" name="loantyp" placeholder="LOAN TYPE">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4">Applies For:</label>
						<div class="col-md-8">
							<input type="checkbox" class="" id="aplformem" name="aplformem">Member</input> &nbsp&nbsp&nbsp&nbsp
							<input type="checkbox" class="" id="aplforstf" name="aplforstf">Staff</input>&nbsp&nbsp&nbsp&nbsp
							<input type="checkbox" class="" id="aplforcust" name="aplforcust">Customer</input>&nbsp&nbsp&nbsp&nbsp
							<input type="checkbox" class="" id="aplforagnt" name="aplforagnt">Agent</input>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-sm-4" for="comment">Loan Interest:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="intrest" name="intrest" placeholder="INTREST"/>
						</div>
					</div>
					
					<center>
    					<div class="form-group">
							<div class="col-sm-12">
								<input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
								<input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
								<input type="reset" value="CLEAR" class="btn btn-info btn-sm"/>
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

<script>
	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
		if( retVal == true ){
            $('.loanclassid').click();
			return true;
		}
		else{
			return false;
		}
		
	});
	/*$('#aplformem').change(function(e){
		alert("hello");
		if($('#aplformem').is(":checked"))
		{
		mem='1';
		alert(mem);
		}
		else{
		mem='0';
		}
		//alert(mem);
	});*/
	indexid=0;
	$('.sbmbtn').click( function(e) {
		if(indexid==0)
		{
			indexid++;
			e.preventDefault();
			//alert("hi");
			if($('#aplformem').is(":checked"))
			{
				//alert("checked");
				mem="1";
				//alert(mem);
			}
			else{
				mem="0";
			}
			
			if($('#aplforcust').is(":checked"))
			{
				cust="1";
			}
			else
			{
				cust="0";
			}
			
			if($('#aplforagnt').is(":checked"))
			{
				agnt="1";
			}
			else
			{
				agnt="0";
			}
			
			if($('#aplforstf').is(":checked"))
			{
				stf="1";
			}
			else
			{
				stf="0";
			}
			//alert("MEM"+mem);
			//alert("CUST"+cust);
			$.ajax({
				url: 'createloantyp',
				type: 'post',
				data: $('#form_loantyp').serialize()+'&member='+mem+'&customer='+cust+'&agent='+agnt+'&staff='+stf,
				success: function(data) {
					//alert('success');
					$('.loanclassid').click();
				}
			});
		}
	});
	
</script>
