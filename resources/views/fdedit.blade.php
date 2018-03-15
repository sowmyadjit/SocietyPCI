   <script src="js/bootstrap-typeahead.js"></script>
   <script src="js/jquery.validate.min.js"></script>
   <link href="css/datepicker.css" rel='stylesheet'>
   <script src="js/bootstrap-datepicker.js"/>	
 
 <div id="content" class="col-md-12">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> FD EDIT</h2>
						
					</div>
					
				<div class="box-content">


{!! Form::open(['url' => 'crtpigmialloc','class' => 'form-horizontal','id' => 'form_pigmialloc','method'=>'post']) !!}


   
   
   <!--Pigmi Allocation Detail-->
   
						<div class="form-group" >
								<label class="control-label col-sm-4">Account Number</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="dd" name="mfnaddme" value="{{ $fddetails->Fd_CertificateNum }}"disabled >
								</div>
							</div>
						<div class="form-group" >
								<label class="control-label col-sm-4">Old Account Number</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="dd" name="mfnaddme" value="{{ $fddetails->Fd_OldCertificateNum }}"disabled >
								</div>
							</div>
						
							
							
							
							<div class="form-group">
									<label class="col-sm-4 control-label">CREATED DATE</label>
									<div class="col-md-4 date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="cd"   data-date-format="yyyy-mm-dd"  value="{{ $fddetails->FdReport_StartDate }}" />
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</div>
							
							

								<div class="form-group">
									<label class="col-sm-4 control-label">End date</label>
									<div class="col-md-4 date">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control datepicker" name="ed"   data-date-format="yyyy-mm-dd"  value="{{ $fddetails->FdReport_MatureDate }}" />
											<span class="input-group-addon add-on">
												<span class="glyphicon glyphicon-calendar">
												</span>
											</span>
										</div>
									</div>
								</div>
							
							
							
						
							
							<div class="form-group" >
								<label class="control-label col-sm-4">Deposit Amount</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ta" name="ta" value="{{ $fddetails->Fd_DepositAmt }}" >
								</div>
							</div>
							
							<div class="form-group" >
								<label class="control-label col-sm-4">Mature Amount</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="ta1" name="ta1" value="{{ $fddetails->Fd_TotalAmt }}" >
								</div>
							</div>
							<input class="hidden" id="alocid" name="alocid" value="{{ $fddetails->Fdid }}" >
   
   
     
			<center>
		<div class="form-group">
			<div class="col-sm-12">
			 <input type="button" value="UPDATE" class="btn btn-success btn-sm sbmbtn"/>
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



<script>
createindex=0;
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


  
$('.sbmbtn').click( function(e) {
	if(createindex==0){
		createindex++;
		
	
	
	e.preventDefault();
    $.ajax({
		
        url: 'editfd',
        type: 'post',
        data: $('#form_pigmialloc').serialize(),
        success: function(data) {
			alert('success');
                   $('.pigmiallocclassid').click();
				    //window.location.reload(true);
                 }
    });
	}
	
});

$('.datepicker').datepicker().on('changeDate',function(e){
	$(this).datepicker('hide');
	});
</script>


