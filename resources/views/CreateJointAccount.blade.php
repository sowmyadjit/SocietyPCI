<script src="js/jquery.validate.min.js"></script>
   <script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $JAccCreate['module']->Mid; ?>" class="col-md-12">
	<div class="row">
		<div class="box_bdy_<?php echo $JAccCreate['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $JAccCreate['module']->Mid; ?> box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-user"></i>Create joint Account</h2>
						
					</div>
					
				<div class="box-content">
				{!! Form::open(['url' => "createacc",'class' => 'form-horizontal','id' => 'form_acc','method'=>'post']) !!}
				
				
				<div class="col-md-6"> <!-- ACCOUNT DETAILS SECTION-->
					<div class="row">
			
						<div class="box-header well col-md-12">
							<h2>ACCOUNT DETAILS</h2>
						</div>
						
						<div class="alert alert-success">	
							<!--ACCOUNT DETAILSDetail-->
				

				<div class="form-group">
					<label class="control-label col-sm-4">Creation Date:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="crtdte" name="crtdte" value="<?php echo date('d/m/Y');?>">
					</div>
				</div>
	
				<div class="form-group">
					<label class="control-label col-sm-4">Account Type:</label>
					<div class="col-md-8">
						<input style="border-color:red" class="typeahead1 form-control"  id="actyp" type="text" name="actype" placeholder="SELECT ACCOUNT TYPE">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Old Account Number:</label>
					<div class="col-md-8">
						<input class="form-control"  type="text" id="oldaccno" name="oldaccno" placeholder="OLD ACCOUNT NUMBER">  
					</div>
				</div>
				<div class="form-group" id="rdd">
					<label class="control-label col-sm-4">RD Duration:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="rddurtn" name="rddurtn" placeholder="RD DURATION" onblur="mdate();">
					</div>
				</div>
				
				<div class="form-group" id="md">
					<label class="control-label col-sm-4"> Matured Date:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="m" name="m" placeholder="Date">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Branch Name:</label>
					<div class="col-md-8">
						<input style="border-color:red" class="typeahead2 form-control" id="branch"type="text" name="branch" placeholder="SELECT BRANCH">  
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4"> Number of User:</label>
					<div class="col-md-8">
						<input class="form-control"  type="number" id="nou" name="nou" placeholder="Number of user" onblur="xxx();">  
					</div>
				</div>
				<div id="texts">
				<div class="form-group">
					<label class="control-label col-sm-4">User Name:</label>
					<div class="col-md-8">
						<input style="border-color:red"id="usr" class="typeahead3 form-control"  type="text" name="user" placeholder="SELECT user" >  
					</div>
				</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Opening Blance:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="ob" name="ob" onblur="getdata();" placeholder="Opening Balance">
					</div>
				</div>
				
				</div>
				
				<div class="box-header well col-md-12">
							<h2>NOMINEE DETAILS</h2>
						</div>
						
						<div class="alert alert-danger">
				
						<!--Nominee Detail-->
	
				<div class="form-group">
					<label class="control-label col-sm-4">First Name:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="nfname" name="nfname" placeholder="FIRST NAME">
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
						<input type="text" class="form-control" id="relation" name="relation" placeholder="RELATIONSHIP">
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-4">EMail ID:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="nemail" name="nemail" placeholder="EMAIL ID">
					</div>
				</div>
				
				
				
				</div>
				
				
				
				</div>
				</div>
	
						
				
				<div class="col-md-6">
					<div class="row">
					
					<div class="box-header well col-md-12">
							<h2>NOMINEE DETAILS continued</h2>
						</div>
					
					<div class="alert alert-danger">
				
						<!--Nominee Detail continued-->
						
						<div class="form-group">
					<label class="control-label col-sm-4">Gender:</label>
					<div class="col-md-8">
						 <select class="form-control" id="ngender" name="ngender" placeholder="SELECT GENDER">
						 <option value="">--Select Gender--</option>
						 <option>Male</option>
						 <option>Female</option>
						 </select>
					</div>
				</div>
						
						
						
						
						<div class="form-group">
					<label class="control-label col-sm-4">Marital Status:</label>
					<div class="col-md-8">
						 <select class="form-control" id="nmstate" name="nmstate" placeholder="SELECT MARITAL STATUS">
						 <option value="">--Select Marital Status--</option>
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
						<input type="text" class="form-control" id="nmno" name="nmno" placeholder="MOBILE NUMBER">
					</div>
				</div>
				
				

				<div class="form-group">
					<label class="control-label col-sm-4">Phone Number:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="npno" name="npno" placeholder="PHONE NUMBER">
					</div>
				</div>
				

				<div class="form-group">
					<label class="control-label col-sm-4">Address:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="nadd" name="nadd" placeholder="ADDRESS">
					</div>
				</div>
						
						
						
				<div class="form-group">
					<label class="control-label col-sm-4">City:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="ncity" name="ncity" placeholder="CITY">
					</div>
				</div>

				
				<div class="form-group">
					<label class="control-label col-sm-4">District:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="ndist" name="ndist" placeholder="DISTRICT">
				</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4">State:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="nstate" name="nstate" placeholder="STATE">
					</div>
				</div>
				
					<div class="col-md-8 hidden">
						<input type="text" class="form-control" id="branchcd" name="branchcd">
					</div>
				
<input type="text" class="form-control hidden" id="x" name="x" >
				
				
				<div class="form-group">
					<label class="control-label col-sm-4">Pincode:</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="npin" name="npin" placeholder="PINCODE">
					</div>
				</div>
	
				<input type="text" class="hidden" id="jointuid" name="jointuid" >
				
				
				</div>
				</div>
				</div>

				<center>
				
					<div class="form-group">
						<div class="col-sm-12">
						 <input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn<?php echo $JAccCreate['module']->Mid; ?>"/>
						 <input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn<?php echo $JAccCreate['module']->Mid; ?>"/>
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
$('#md').hide();
$('#rdd').hide();
//Cancel button
  $('.cnclbtn<?php echo $JAccCreate['module']->Mid; ?>').click(function(e)
{
	alert('are you sure?');
	$('.accclassid').click();
});


//Get BranchCode
$('.typeahead2').change(function(e){
				//alert("aa");
				branchid=$('.typeahead2').attr('data-value');
				// alert(branchid);
				$.ajax({
					url:'GetBranchid',
					type:'post',
					data:'&branch='+branchid,
					success:function(data)
					{
						$('#branchcd').val(data['bcode']);
					}
				});
	});

var jointusers="";

var count = 0;
//Submit button
$('.sbmbtn<?php echo $JAccCreate['module']->Mid; ?>').click( function(e) {
$("#form_acc").validate({
rules:{
actype:"required",
rddurtn:{
required:true,
number:true
},
m:{
required:true,
date:true
},
bname:"required",
user:"required",
ob:
{
required:true,
number:true
},
nfname:"required",
ngender:"required",
nmstate:"required",
noccup:"required",
nmno:{
required:true,
number:true,
maxlength:10,
minlength:10
},
nadd:"required",
ncity:"required",
ndist:"required",
nstate:"required",
npin:{
required:true,
number:true,
maxlength:6,
minlength:6
},
}
});
if($("#form_acc").valid())
{
	 a=$('.typeahead2').data('value');
 branchid=a;
 acttype=$('.typeahead1').val();
 acctyp=$('.typeahead1').data('value');
 //user_name=$('.typeahead3').data('value');
	e.preventDefault();
		if(count == 0) {
			count++;
			$.ajax({
				url: 'CreateJointAcc',
				type: 'post',
				data: $('#form_acc').serialize()+ '&branchid=' + a + '&acctyp_11=' + acctyp +'&atype='+acttype,
				success: function(data) {
					alert('success');
						// $('.accclassid').click();
				}
			});
		}
	}
});
$('.typeahead1').change(function(e){
	ft=$('.typeahead1').val();
 if(ft=="RD"||ft=="Recurring Deposit")
	{
		$('#rdd').show();
		$('#md').show();
	}
	else
	{
$('#rdd').hide();
$('#rddurtn').val("0");
$('#md').hide();
$('#m').val("0");
	}
});

/*$('#usr').change(function(e){
	//alert("hai");
user_name=$('#usr').data('value');
//alert(user_name);
e.preventDefault();
    $.ajax({
        url: 'checkaccount',
        type: 'post',
		data:'&userid='+user_name,
		 success: function(data) {
		
			$('#x').val(data['chk']);
		
			m=$('#x').val();
			s=$('#actyp').val();
		
			if(m==user_name&&s=="SB")
			{
				alert("ACCOUNT ALREADY EXISTs");
			
				$('.accclassid').click();
			}
		
		 }
	});
});*/

function mdate()
{
	var year=$('#rddurtn').val();
	var month=year*12;
var start_date = document.getElementById('crtdte').value;
var c_start_date = start_date.split('/').reverse().join('/');;
var c_start_date_obj = new Date(c_start_date);
var c_end_date_obj = new Date(c_start_date_obj.getFullYear(), c_start_date_obj.getMonth() + parseInt(month), c_start_date_obj.getDate());
var c = (c_end_date_obj.getMonth())+1;
var c_end_date = c_end_date_obj.getDate() + '/' + c + '/' + c_end_date_obj.getFullYear();
document.getElementById('m').value = c_end_date;

}

	/*function abc()
	{
		$.ajax({
			url:'GetBranches'
			
		});
	}*/

$('input.typeahead2').typeahead({
      //ajax: '/GetBranches'
	source:GetBranches
	
});
$('input.typeahead1').typeahead({
      //ajax: '/Getacctyp'
	  source:Getacctyp
});
/*$('input.typeahead3').typeahead({
	
      ajax: '/Getuser'
});*/

function xxx()
{
	
	var htmltext="";
	var n = $('#nou').val();
	for(var i=0;i<n;i++){
		htmltext+= "<div class=\"form-group\">";
	    htmltext+= "<label class=\"control-label col-sm-4\">User Name:</label>";
		htmltext+="<div class=\"col-md-8\">";
		htmltext+="<input style=\"border-color:red\" id=\"usr"+i+"\" class=\"typeahead"+(i+3)+" form-control\"  type=\"text\" name=\"user\" placeholder=\"SELECT user\" >";  
		htmltext+="</div>";
		htmltext+="</div>";
		}	
	 var foo = document.getElementById("texts");
	 foo.innerHTML = htmltext;
	
	 for(var i=0;i<n;i++){
	  $('input.typeahead'+(i+3)).typeahead({
          // ajax: '/Getuser'
		  source:Getuser
       });
      }	
}


function getdata(){
	var n = $('#nou').val();
	jointusers="";
	//alert(n);
	for(var i=0;i<n;i++){
		//array.push($('#usr'+i).val());
		if(i < n-1){
		jointusers +=$('#usr'+i).data('value')+",";
		}else{
		jointusers +=$('#usr'+i).data('value');	
		}
	}
	alert(jointusers);
	$('#jointuid').val(jointusers);
	
}
</script>

