<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-md-10">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i> CREATE MEMBER</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				{!! Form::open(['url' => 'createmem','class' => 'form-horizontal','id' => 'form_member','method'=>'post','method'=>'post','files'=>true,'enctype'=>"multipart/form-data"]) !!}
			
			
				<div class="col-md-6"> <!-- MEMBER SECTION-->
					<div class="row">
			
						<div class="box-header well col-md-12">
							<h2>MEMBER DETAILS</h2>
						</div>
						
						<div class="alert alert-success">	
						<!--Member Detail-->
						
							<div class="form-group" >
								<label class="control-label col-sm-4">First Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mfname" name="mfname" placeholder="FIRST NAME" onblur="LoadUid();" required>
								</div>
							</div>
			
							<div class="form-group">
									<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="mmname" name="mmname" placeholder="MIDDLE NAME">
							</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-sm-4">Last Name:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="mlname" name="mlname" placeholder="LAST NAME">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Old Number:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="oldnum" name="oldnum" placeholder="Old Number">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Father Name:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="fthrname" name="fthrname" placeholder="FATHER NAME" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Spouse Name:</label>
								<div class="col-md-8">
								 <input type="text" class="form-control" id="spousename" name="spousename" placeholder="SPOUSE NAME">
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4">Branch Name:</label>
									<div  class="col-sm-8">
										<input style="border-color:red" class="typeahead form-control"  type="text" id="branch" placeholder="SELECT BRANCH NAME" required>  
									</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4">Login Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="lgname" name="lgname" placeholder="LOGIN NAME">
								</div>
							</div>
	
							<div class="form-group">
								<label class="control-label col-sm-4">Password:</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="pwd" name="pwd" placeholder="PASSWORD">
								</div>
							</div>
	
							<div class="form-group">
								<label class="control-label col-sm-4">Passcode:</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="pscd" name="pscd" placeholder="PASSCODE">
								</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-sm-4">Join Date:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" id="mdte" name="mdte" value="<?php echo date('Y-m-d');?>" required>
									</div>
							</div>
							
						
							<div class="form-group">
									<label class="control-label col-sm-4">Member Fees:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="mfee" name="mfee" placeholder="MEMBER FEES" required>
							</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">EMail ID:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="memail" name="memail" placeholder="EMAIL ID">
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Gender:</label>
										<div class="col-md-8">
											 <select class="form-control" id="mgender" name="mgender" placeholder="SELECT GENDER" required>
												 <option value=""></option>
												 <option>Male</option>
												 <option>Female</option>
											 </select>
										</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Marital Status:</label>
								<div class="col-md-8">
									 <select class="form-control" id="mmrstate" name="mmrstate" placeholder="SELECT MARITAL STATUS" required>
										 <option value=""></option>
										 <option>Married</option>
										 <option>Unmarried</option>
									 </select>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
							 <input type="text" class="form-control" id="mage" name="mage" placeholder="AGE">
							</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Birth Date:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mbdate" name="mbdate" placeholder="BIRTH DATE">
								</div>
							</div>

							

							<div class="form-group">
									<label class="control-label col-sm-4">Occupation:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="moccup" name="moccup" placeholder="OCCUPATION">
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Mobile Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mmno" name="mmno" placeholder="MOBILE NUMBER" required>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">Phone Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mpno" name="mpno" placeholder="PHONE NUMBER">
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Address:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="madd" name="madd" placeholder="ADDRESS" required>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">City:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mcity" name="mcity" placeholder="CITY" required>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">District:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mdist" name="mdist" placeholder="DISTRICT" required>
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4">State:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mstate" name="mstate" placeholder="STATE" required>
								</div>
							</div>

							<div class="form-group">
									<label class="control-label col-sm-4">Pincode:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="mpin" name="mpin" placeholder="PINCODE" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-4"> Pancard Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="pncrdno" name="pncrdno" placeholder="PANCARD NUMBER">
								</div>
							</div>
	
						   <div class="form-group">
								<label class="control-label col-sm-4"> Adharcard Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="adcrdno" name="adcrdno" placeholder="ADHARCARD NUMBER">
								</div>
							</div>
		
						   <div class="form-group">
								<label class="control-label col-sm-4">VoterID Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="voterid" name="voterid" placeholder="VOTERID NUMBER">
								</div>
							</div>
		
							<div class="form-group">
								<label class="control-label col-sm-4">Passport Number:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="passportnum" name="passportnum" placeholder="PASSPORT NUMBER">
								</div>
							</div>
		
							<div class="form-group">
								<label class="control-label col-sm-4">Remarks:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="remark" name="remark" placeholder="REMARKS"/>
								</div>
							</div>
					
	
						</div> <!--members alert-success div ends-->
					</div>
				</div> <!-- MEMBER SECTION ENDS-->


				
				

				<div class="col-md-6">
					<div class="row">

						<div class="box-header well col-md-12">
							<h2>NOMINEE DETAILS</h2>
						</div>
						
						<div class="alert alert-danger">
				
						<!--Nominee Detail-->
						
						 <div class="form-group" >
							<label class="control-label col-sm-4">First Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nfname" name="nfname" placeholder="FIRST NAME" required>
							</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Middle Name:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nmname" name="nmname" placeholder="MIDDLE NAME">
								</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-4">Last Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nlname" name="nlname" placeholder="LAST NAME">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Relationship:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="reltn" name="reltn" placeholder="RELATIONSHIP" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">EMail ID:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nemail" name="nemail" placeholder="EMAIL ID">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Gender:</label>
							<div class="col-md-8">
								 <select class="form-control" id="ngender" name="ngender" placeholder="SELECT GENDER" required>
									 <option value=""></option>
									 <option>Male</option>
									 <option>Female</option>
								 </select>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Marital Status:</label>
							<div class="col-md-8">
								 <select class="form-control" id="nmstate" name="nmstate" placeholder="SELECT MARITAL STATUS" required>
									 <option value=""></option>
									 <option>Married</option>
									 <option>Unmarried</option>
								 </select>
							</div>
						</div>
					 
						<div class="form-group">
								<label class="control-label col-sm-4">Age:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nage" name="nage" placeholder="AGE">
								</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-4">Birth Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nbdate" name="nbdate" placeholder="BIRTH DATE">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Occupation:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="noccup" name="noccup" placeholder="OCCUPATION">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Mobile Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nmno" name="nmno" placeholder="MOBILE NUMBER" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Phone Number:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npno" name="npno" placeholder="PHONE NUMBER">
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label  col-sm-5">Same as Member Address</label>
							<div class="col-sm-1">
							<input type="checkbox" class="form-control" id="chk" name="chk"/>
								
							</div>
						</div>
						
					
						 <div class="form-group">
								<label class="control-label col-sm-4">Address:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nadd" name="nadd" placeholder="ADDRESS" required>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">City:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ncity" name="ncity" placeholder="CITY" required>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-sm-4">District:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ndist" name="ndist" placeholder="DISTRICT" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">State:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nstate" name="nstate" placeholder="STATE" required>
							</div>
						</div>
						
						<div class="form-group">
								<label class="control-label col-sm-4">Pincode:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npin" name="npin" placeholder="PINCODE" required>
							</div>
						</div>
					
						
					
						
						

					</div>   <!-- DIV alert-danger ends here-->
					
					
						<center>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" value="Purchase Share" class="btn btn-info btn-sm nxtbtn"/>
								</div>
							 </div>
						</center>
	  
	  
	  
					<div class="box-header well col-md-12">
						<h2>PURCHASE SHARE DETAILS</h2>
					</div>
				
					<div class="alert alert-info">
					
					<!--Purchaseshare Detail-->
		
					<div class="purdetail">
		
						<div class="form-group">
							<label class="control-label col-sm-4">Share Class:</label>
								<div class="col-sm-8">
									  <select class="form-control shclass"  id="shclass" name="shclass" placeholder="SELECT SHARE CLASS" required>  
										  <option value=""></option>
										  <?php foreach($shares as $key){
											  
											  echo "<option value='".$key->Share_Class."' >" .$key->Share_Class."";
											  echo "</option>";
										  }?>
									  </select>
								</div>
						</div>
						
	  
						<div class="form-group">
							<label class="control-label col-sm-4"> Face Value:</label>
							<div class="col-md-8">
								<input style="border-color:red" type="text" class="form-control" id="shamt" name="shamt" placeholder="SAHARE AMOUNT">
							</div>
						</div>
	
						<div class="form-group">
							<label class="control-label col-sm-4">Share Fees:</label>
							<div class="col-md-8">
								<input style="border-color:red" type="text" class="form-control" id="shprice" name="shprice" placeholder="SHARE PRICE">
							</div>
						</div>
	
						<div class="form-group">
							<label class="control-label col-sm-4">Total Shares:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="totshare" name="totshare" placeholder="TOTAL SHARES" onblur="calculate();maxvl();" required>
							</div>
						</div>
	
						<div class="form-group">
							<label class="control-label col-sm-4">Total Share Value:</label>
							<div class="col-md-8">
								<input style="border-color:red" type="text" class="form-control" id="totshrval" name="totshrval" placeholder="TOTAL SHARE VALUE" />
							</div>
						</div>
	
						<div class="form-group">
							<label class="control-label col-sm-4">Total Amount Payable:</label>
							<div class="col-md-8">
								<input style="border-color:red" type="text" class="form-control" id="totamt" name="totamt" placeholder="TOTAL AMOUNT PAYABLE" />
							</div>
						</div>

						 <div class="form-group">
							<label class="control-label col-sm-4">Member Share ID:</label>
							<div class="col-sm-8">
								<input style="border-color:red" type="text" class="form-control" id="memshr" name="memshr" placeholder="MEMBER SHARE ID" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Board Resolution Num:</label>
							<div class="col-sm-8">
								<input  type="text" class="form-control" id="brn" name="brn" placeholder="Board Resolution Num" />
							</div>
						</div>
		
						 <div class="form-group hidden">
							<div class="col-sm-8">
								<input type="text" class="form-control" id="count" name="count"/>
							</div>
						</div>
						<div class="col-sm-8 hidden">
								<input type="text" class="form-control" id="branchid" name="branchid"/>
							</div>
							<div class="col-sm-8 hidden">
								<input type="text" class="form-control" id="usrid" name="usrid"/>
							</div>
		
					</div>	<!--DIV purdetail ends here-->	


					</div>  <!--- div alert-info ends here-->



					</div>				
				</div>
				
				
				
				
				
				
				
				
				
				<div class="alert alert-success col-md-12">
					<div class="row">
					
					
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
						
									<div class="form-group">
										<label class="control-label col-sm-4">ID Proof:</label>
										<div class="col-md-8">
										</br></br></br>
										<input type="file" id="idp" name="idp" accept="image/*" onchange="loadFile1(event)">
										</div>
									</div>
									
								</div>
								
								<div class="col-md-8">
								
								<img id="idproof" height="150" width="250"/></br>
								
								</div>
								
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Address Proof:</label>
									
									<div class="col-md-8">
									</br></br></br>
									<input type="file" id="adprf" name="adprf" accept="image/*" onchange="loadFile2(event)">
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img id="addproof" height="150" width="250"/></br>
									</div>
								
							</div>
						</div>
						
						</div>
						
						
						</br>
						
						
						<div class="row">
							
							<div class="col-md-6">
							<div class="row table-row">
								<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Photo:</label>
									<div class="col-md-8">
									</br></br>
									<input type="file" id="photo" name="photo" accept="image/*" onchange="loadFile3(event)">
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img id="emppic" height="150" width="130"/></br>
									</div>
								
							</div>
							</div>
							
							
							<div class="col-md-6">
							<div class="row table-row">
									<div class="col-md-4">
								
									<div class="form-group">
									<label class="control-label col-sm-4">Signature:</label>
									<div class="col-md-8">
									</br></br>
									<input type="file" id="sign" name="sign" accept="image/*" onchange="loadFile4(event)">
									</div>
									</div>
									</div>
									
									<div class="col-md-8">
									<img id="signi" height="150" width="250"/></br>
									</div>
								
							</div>
							</div>
							
						</div>
					
					</div> <!--alert-success ends-->
				
				
				
				
				
				
					
					
        
						<center>
							<div class="form-group">
								<div class="col-sm-12">
								 <input type="submit" value="CREATE" class="btn btn-success btn-sm sbmbtn" />
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

function LoadUid()
{
	$.ajax({
		        url: 'Getmemuid',
				type: 'get',
				success: function(result) {
					m=result;
					uid=(parseInt(m)+1);
					$('#usrid').val(uid);
					//alert(id);
				}
		});
}

//Calculate Share Amount
function calculate()
{
	shamt=$('#shamt').val();
	shpr=$('#shprice').val();
	nosh=$('#totshare').val();
	mfee=$('#mfee').val();
	tot=shamt*nosh;
	tot1=shpr*nosh;
	total1=tot+tot1;
	total=parseInt(total1)+parseInt(mfee);
	$('#totshrval').val(tot);
	$('#totamt').val(total);
}

//Share Class Dropdown Change Event
$('#shclass').change(function(e){
	e.preventDefault();
	$.ajax({
		url:'retrieveinfo',
		type:'post',
		data:$('#shclass'),
		success:function(data){
			$('#shamt').val(data['face']);
			$('#shprice').val(data['sharep']);
		}
	});
});

//CertificateID Calculation
function maxvl()
{
	totshr=$('#totshare').val();
	$.ajax({
		url:'retrievemax',
		type:'get',
		success:function(data){
			countval=data;
			max=(parseInt(totshr)+parseInt(countval));
			min=(parseInt(countval)+1);
			sid=min+"-"+max;
			$("#memshr").val(sid);
			$("#count").val(max);
		}
	});
}

//Hide PurchaseShare Detail
$('.purdetail').hide();

//PurchaseShare Button
$('.nxtbtn').click(function(){
	$('.purdetail').show();
});

//Cancel Button
 $('.cnclbtn').click(function(e)
{
	var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.reqclassid').click();
                return true;
            }
            else{
                return false;
            }
});

//To get the BranchID
$('#branch').change(function(){
	 a=$('ul.typeahead li.active').data('value');
	
	 $.ajax({
			success:function(){
				 $('#branchid').val(a);
			}
		});
});

//Typeahead for Branch
$('input.typeahead').typeahead({
      ajax: '/GetBranches'
});

//Address checkbox click
$('#chk').click(function(e){
	if($('#chk').is(":checked"))
	{
	add=$('#madd').val();
	city=$('#mcity').val();
	dist=$('#mdist').val();
	pin=$('#mpin').val();
	state=$('#mstate').val();
	$('#nadd').val(add);
	$('#ncity').val(city);
	$('#ndist').val(dist);
	$('#nstate').val(state);
	$('#npin').val(pin);
	}
	else{
		$('#nadd').val('');
	$('#ncity').val('');
	$('#ndist').val('');
	$('#nstate').val('');
	$('#npin').val('');
	}
});
</script>

<style>
input[type=file]{ 
        color:transparent;
    }
</style>


<script>

	var loadFile1 = function(event) {
		var idproof = document.getElementById('idproof');
		idproof.src = URL.createObjectURL(event.target.files[0]);
	};
	
	var loadFile2 = function(event) {
		var addproof = document.getElementById('addproof');
		addproof.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile3 = function(event) {
		var emppic = document.getElementById('emppic');
		emppic.src = URL.createObjectURL(event.target.files[0]);
	};
	
	 var loadFile4 = function(event) {
		 var signi = document.getElementById('signi');
		 signi.src = URL.createObjectURL(event.target.files[0]);
	 };


</script>


