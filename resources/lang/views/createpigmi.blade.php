<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
 
<div id="content" class="col-md-12">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> CREATE PIGMI TYPES</h2>
						
					</div>
					
				<div class="box-content">
 
{!! Form::open(['url' => "createpigmityp",'class' => 'form-horizontal','id' => 'form_des','method'=>'post']) !!}

    <div class="form-group">
        <label class="control-label col-sm-4" for="first_name">PIGMI TYPE:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="pt" name="pt" placeholder="PIGMI TYPE">
        </div>
    </div>
	
    	<div class="form-group">
        <label class="control-label col-sm-4">Maximum Interest:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="mi" name="mi" placeholder="MAXIMUM INTEREST"/>
        </div>
		<div class="col-md-4">
            <label class="control-label col-sm-4">(In %)</label>
		</div>
		</div>
		
		<div class="form-group">
        <label class="control-label col-sm-4">Interest:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inter" name="inter" placeholder="INTEREST"/>
        </div>
		<div class="col-md-4">
            <label class="control-label col-sm-4">(In %)</label>
		</div>
		</div>
		
		<div class="form-group">
        <label class="control-label col-sm-4">Maximum Commission:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="mcomm" name="mcomm" placeholder="MAXIMUM COMMISSION"/>
        </div>
		<div class="col-md-4">
            <label class="control-label col-sm-4">(In %)</label>
		</div>
		</div>
		
		<div class="form-group">
        <label class="control-label col-sm-4">Commission:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="comm" name="comm" placeholder="COMMISSION"/>
        </div>
		<div class="col-md-4">
            <label class="control-label col-sm-4">(In %)</label>
		</div>
		</div>
		<!--<div class="input-group form-group" id="ingredients">
   
   <div id="the-basics">
  <input class="typeahead"  type="text" placeholder="Select Branch">  
</div>
</div>-->
		
    </div>
	
	 
<!--<input type="button" value="check" class="btn btn-info btn-sm chk"/>-->
    <center>
    
    <div class="form-group">
        <div class="col-sm-12">
         <input type="button" value="CREATE" class="btn btn-success btn-sm sbmbtn"/>
         <input type="button" value="CANCEL" class="btn btn-danger btn-sm cnclbtn"/>
         <input type="reset" value="CLEAR" class="btn btn-info btn-sm resetbtn"/>
        </div></br>
      </div>
      </center>
    
	
{!! Form::close() !!}


</div>
</div>
</div>
</div>

<script>
 branchid=0;


$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.pigmeclassid').click();
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




$('.sbmbtn').click( function(e) {
 $("#form_des").validate({
 rules:{
 pt:"required",
 mi:{
 required:true,
 number:true
 },
 inter:{
 required:true,
 number:true
 },
 mcomm:{
 required:true,
 number:true
 },
 comm:{
 required:true,
 number:true
 },
 }
 });
if($("#form_des").valid())
{
	e.preventDefault();
    $.ajax({
        url: 'createpigmityp',
        type: 'post',
        data: $('#form_des').serialize(),
        success: function(data) {
			//alert('success');
                   $('.pigmeclassid').click();
                 }
    });
	}
});

     
    </script>
	
