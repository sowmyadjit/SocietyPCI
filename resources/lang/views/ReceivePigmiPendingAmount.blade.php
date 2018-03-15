   <script src="js/bootstrap-typeahead.js"></script>
   <script src="js/jquery.validate.min.js"></script>
 
 <div id="content" class="col-md-12">
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-random"></i> Receive Pigmi Pending Amount</h2>
						
					</div>
					
				<div class="box-content">


{!! Form::open(['url' => 'ReceivePigmyPendingAmt','class' => 'form-horizontal','id' => 'FormReceivePigmyPending','method'=>'post']) !!}


   @foreach($PendingAgent as $PpAgent)
   
   <!--Pigmi Allocation Detail-->
     <input type="text" class="form-control hidden" id="PPrPpId" name="PPrPpId" value="{{$PpAgent->PpId}}">
     
		<div class="form-group">
				<label class="control-label col-sm-4">Branch Name:</label>
			<div class="col-md-4">
		  <input type="text" class="form-control" id="PPrBname" name="PPrBname" value="{{$PpAgent->BName}}" readonly>  
		    
		</div>
		</div>
		
		
		 <div class="form-group">
				<label class="control-label col-sm-4">Agent Name:</label>
			<div class="col-md-4">
		  <input type="text "class="form-control" id="PPrAgentName" name="PPrAgentName" value="{{$PpAgent->FirstName}}.{{$PpAgent->MiddleName}}.{{$PpAgent->LastName}}"readonly> 
		</div>
		</div>

		<div class="form-group">
				<label class="control-label col-sm-4">Collection Date:</label>
			<div class="col-md-4">
		 <input type="text" class="form-control" id="PPrCollectDate" name="PPrCollectDate" value="<?php $trandate=date("d-m-Y",strtotime($PpAgent->PendPigmy_CollectionDate)); echo $trandate; ?>" readonly>
		</div>
		</div>

		<div class="form-group">
				<label class="control-label col-sm-4">Pending Amount Payable:</label>
			<div class="col-md-4">
		  <input class="form-control"  type="text" id="PPrPendingAmtReadOnly" name="PPrPendingAmtReadOnly" value="{{$PpAgent->PendPigmy_PendingAmount}}" readonly>
		  
		  <input class="form-control hidden"  type="text" id="PPrPendingAmt" name="PPrPendingAmt" value="{{$PpAgent->PendPigmy_PendingAmount}}">  
		</div>
		</div>
		
		<div class="form-group">
				<label class="control-label col-sm-4">Paid Amount:</label>
			<div class="col-md-4">
		  <input style="border-color:red" class="form-control"  type="text" id="PPrPaidAmt" name="PPrPaidAmt" placeholder="Enter Paid Amount" onkeyup="PendingAmtCalc();" required>  
		</div>
		</div>
		
		<div class="form-group">
				<label class="control-label col-sm-4">Pending Balance:</label>
			<div class="col-md-4">
		  <input class="form-control"  type="text" id="PPrPendingBalReadOnly" name="PPrPendingBalReadOnly" placeholder="Pending Amount" readonly>
		  
		  <input class="form-control hidden"  type="text" id="PPrPendingBal" name="PPrPendingBal" placeholder="Pending Amount">  
		</div>
		</div>
		@endforeach
		

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

function PendingAmtCalc()
{
	PendingAmt={{$PpAgent->PendPigmy_PendingAmount}};
	PaidAmt=$('#PPrPaidAmt').val();
	if(PaidAmt > PendingAmt)
	{
		alert("Paid Amount is More Than Pending Amount");
		$('#PPrPaidAmt').val("");
		$('#PPrPendingBalReadOnly').val("");
	}
	else{
		PendingBal=PendingAmt-PaidAmt;
		$('#PPrPendingBal').val(PendingBal);
		$('#PPrPendingBalReadOnly').val(PendingBal);
	}
	
}

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
	e.preventDefault();
    $.ajax({
		
        url: 'ReceivePigmyPendingAmt',
        type: 'post',
        data: $('#FormReceivePigmyPending').serialize(),
        success: function(data) {
			
                   $('.PigmiPendingAmtclassid').click();
				    
                 }
    });
	
});

</script>