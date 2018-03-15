<script  src="js/jquery.validate.min.js"></script>
<div id="content" class="col-md-10">
	<div class="row">
			<div class="box col-md-10">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2><i class="glyphicon glyphicon-briefcase"></i>Financial Details</h2>

						<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
						</div>
					</div>
					
				<div class="box-content">
				
				{!! Form::open(['url' => 'createfinancial','class' => 'form-horizontal','id' => 'form_financial','method'=>'post']) !!}
		<div id="self">
		<div class="col-md-12">
				<div class="form-group">
								<label class="control-label col-sm-4">Select Form:</label>
							<div class="col-md-8">
								 <select class="form-control" id="form_type" name="form_type"  onChange="GetSelectedItem();">
									    
                <option>--select--</option>
                <option  value="Master_code" >Master Record</option>
                <option  value="Transaction" >Transaction</option>
                <option  value="Reports" >Reports</option>
								 </select>
							</div>
						</div>
						</div>
						
	<div id="mtype">
	<div class="form-group">
								<label class="control-label col-sm-4">Select Master Code Type:</label>
							<div class="col-md-8">
								 <select class="form-control" id="mty" name="mty" onChange="GetMaster();">
							 <option>--select--</option>		    
                    <option  value="led_month">Ledger Monthly Summary</option>
                <option  value="ledger_group">General ledger Group</option>
                <option  value="group">Group Summary</option>
								 </select>
							</div>
						</div>
						</div>
						
						<div id="ledl">
	<div class="form-group">
								<label class="control-label col-sm-4">Select Ledger List:</label>
							<div class="col-md-8">
							 
								 <select class="form-control" id="lled" name="lled"  >
								<option>--select--</option>	    
                    <option  ></option>
               	@foreach ($data['fin'] as $ld)
						<option value='{{ $ld->lid }}'>{{ $ld->lname }}</option>
							@endforeach
								 </select>
							</div>
						</div>
						</div>
						
						
						
							<div id="syear">
						<div class="form-group">
								<label class="control-label col-sm-4">Start Year:</label>
						<div class="col-md-4">
								<input type="text" class="form-control" id="starty" name="starty" >
							</div>
							</div>
						</div>
						</div>
								<div id="ledlist">
	<div class="form-group">
								<label class="control-label col-sm-4">Select Ledger List:</label>
							<div class="col-md-8">
							 
								 <select class="form-control" id="lledg" name="lledg"  >
								<option>--select--</option>	    
                    <option  ></option>
               	@foreach ($data['led'] as $lnd)
						<option value='{{ $lnd->lid }}'>{{ $lnd->lname }}</option>
							@endforeach
								 </select>
							</div>
						</div>
						</div>
						
						
							<div id="ledsum">
	<div class="form-group">
								<label class="control-label col-sm-4">Select Group List:</label>
							<div class="col-md-8">
							 
								 <select class="form-control" id="lleds" name="lleds"  >
								<option>--select--</option>	    
                    <option  ></option>
                	@foreach ($data['leds'] as $lnds)
						<option value='{{ $lnds->lid }}'>{{ $lnds->lname }}</option>
							@endforeach
								 </select>
							</div>
						</div>
						</div>
						
						<div id="transtype">
						<div class="form-group">
								<label class="control-label col-sm-4">Select Transaction Type:</label>
							<div class="col-md-8">
								 <select class="form-control" id="traty" name="traty"  >
									     <option>--select--</option>
                   <option  value="Receipts">Receipts</option>
                <option  value="Payments">Payments</option>
                <option  value="Journal">Journal</option>
								 </select>
							</div>
						</div>
						</div>
						<div id="reporttype">
							<div class="form-group">
								<label class="control-label col-sm-4">Select Report Type:</label>
							<div class="col-md-8">
								 <select class="form-control" id="repty" name="repty" onChange="GetReportDetails();" >
									     <option>--select--</option>
                     <option  value="fin_miscel">Financial Miscellaneous</option>
                <option  value="tran_report">Transaction</option>
								 </select>
							</div>
						</div>
						</div>
						<div id="fmtype">
							<div class="form-group">
								<label class="control-label col-sm-4">Select Type:</label>
							<div class="col-md-8">
								 <select class="form-control" id="fin" name="fin"  >
									     <option>--select--</option>
                     <option  value="trail_bal">Trail Balance</option>
				 <option  value="profit_loss">Profit & Loss A/C</option>
                <option  value="bal_sheet">Balance Sheet</option>
								 </select>
							</div>
						</div>
						
	</div>
				</div>
				


	<script>
	$('#mtype').hide();

$('#ledlist').hide();
$('#transtype').hide();
$('#reporttype').hide();
$('#fmtype').hide();
$('#trntype').hide();
$('#ledl').hide();
$('#syear').hide();
$('#ledlist').hide();
$('#ledsum').hide();


	$('.cnclbtn').click(function(e){
		var retVal = confirm("Are You Sure ?");
            if( retVal == true ){
            $('.financialclassid').click();
                return true;
            }
            else{
                  return false;
            }
		
	});
	
	$('.sbmbtn').click( function(e) {

		e.preventDefault();
			$.ajax({
				url: 'createfinancial',
				type: 'post',
				data: $('#form_financial').serialize(),
				success: function(data) {
						 //alert('success');
						$('.receiptclassid').click();
                }
			});
			
	});
	
	
	
	
</script>

	

	
	
<script type="text/javascript">

function GetSelectedItem()
{
 sel=$('#form_type').val();
 
if(sel=='Master_code')
{
$('#mtype').show();

$('#ledlist').show();
$('#transtype').hide();
$('#reporttype').hide();
$('#fmtype').hide();
$('#trntype').hide();
$('#ledl').hide();
$('#syear').hide();
$('#ledlist').hide();
$('#ledsum').hide();
}else if(sel=='Transaction') 
{
$('#ledlist').hide();
$('#mtype').hide();
$('#reporttype').hide();
$('#transtype').show();
$('#fmtype').hide();
$('#ledl').hide();
$('#syear').hide();
$('#ledlist').hide();
$('#ledsum').hide();

}else if(sel=='Reports')
{
$('#ledlist').hide();
$('#mtype').hide();
$('#transtype').hide();
$('#reporttype').show();
$('#fmtype').hide();
$('#ledl').hide();
$('#syear').hide();
$('#ledlist').hide();
$('#ledsum').hide();
}

 
}


function GetMaster()
{
 sel=$('#mty').val();
 if(sel=='led_month')
 {
 $('#ledl').show();
 $('#transtype').hide();
 $('#reporttype').hide();
 $('#fmtype').hide();
 $('#ledsum').hide();
  $('#syear').hide();
 $('#ledlist').hide();
 }
 else if(sel=='ledger_group') 
 {
 $('#syear').show();
 $('#ledlist').show();
 $('#transtype').hide();
 $('#reporttype').hide();
 $('#fmtype').hide();
 $('#ledl').hide();
 $('#ledsum').hide();
 }
 else if(sel=='group') 
 {
 $('#ledsum').show();
 $('#transtype').hide();
 $('#reporttype').hide();
 $('#fmtype').hide();
 $('#ledl').hide();
 $('#syear').hide();
 $('#ledlist').hide();
 }
}

</script>
				
				{!! Form::close() !!}
				</div>
				</div>
			</div>
	</div>
</div>

