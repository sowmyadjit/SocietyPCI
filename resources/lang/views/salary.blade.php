<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-typeahead.js"></script>
<div id="content" class="col-md-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<!--<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i>SALARY</h2>
					<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>-->
				
				{!! Form::open(['url' => "salaryinsert",'class' => 'form-horizontal','id' => 'form_sal','method'=>'post']) !!}
				
				<div class="col-md-6">
					<div class="row">
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Employee Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ename" name="ename"  value="{{ $sal->FirstName }}" >
								<input type="text" class="hidden" id="eid" name="eid"  value="{{ $sal->Eid }}" >
								<input type="text" class="hidden" id="uid" name="uid"  value="{{ $sal->Uid }}" >
								<input type="text" class="hidden" id="bid" name="bid"  value="{{ $sal->Bid }}" >
							</div>
						</div>
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Bank Name:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="bname" name="bname"  >
							</div>
						</div>
						
						
			            <div class="form-group">
							<label class="control-label col-sm-4">Employee Code:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ecode" name="ecode"  value="{{ $sal->ECode }}" >
							</div>
						</div>
						
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Cheque No:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="cqno" name="cqno"  >
							</div>
						</div>
						
						
						
						
						
					</div>
				</div>
				
				
				<div class="col-md-6">
					<div class="row">
						
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Cheque Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="cqdate" name="cqdate"  >
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Designation:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="desig" name="desig"  value="{{ $sal->DName }}" >
								<input type="text" class="hidden" id="desigid" name="desigid"  value="{{ $sal->Did }}" >
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Date:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="date" name="date" >
							</div>
						</div>
						
						
						
						
						
						<div class="form-group hidden">
							<label class="control-label col-sm-4">Year:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="year" name="year"  >
							</div>
						</div>
						
						
						
						
						
					</div>
				</div>
				
				
				<div class="col-md-6">
					<div class="row">
						
						<div class="form-group">
							<label class="control-label col-sm-4">Basic Pay:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="bpay" name="bpay"  value="{{ $sal->basicpay }}" >
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">HRA:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="hra" name="hra"  value="{{ $sal->hra }}" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">CCNA:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ccna" name="ccna"  >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">OTHERS:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="oth" name="oth"  >
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Special Allowance:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="sa" name="sa"  onblur="earningcalculate();">
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Gross Earning:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ge" name="ge"   >
							</div>
						</div>
						
						
						
						
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="row">
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">PF:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="pf" name="pf"  value="{{ $sal->pf }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Income Tax:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="it" name="it"   >
							</div>
						</div>
						
						
						
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Professional Tax:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="pt" name="pt"  >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">other Deduction:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="od" name="od"  onblur="calculatededuction();" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">ESI:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="esi" name="esi"   >
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Gross Deduction:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="gd" name="gd" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Loan details:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="ld" name="ld" value="{{ $sal->LoanDetails }}" >
							</div>
						</div>
						
						<div class="loandetails">
							<div class="form-group">
								<label class="control-label col-sm-4">LOAN NUMBER</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="ln" name="ln" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">remaining amount:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="ra" name="ra" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">EMI AMOUNT:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="ea" name="ea" >
								</div>
							</div>
							
						</div>
						<input type="text" class="form-control hidden" id="temp" name="temp" >
						
						
						
						<div class="form-group" >
							<label class="control-label col-sm-4">DONT PAY LOAN AMT:</label>
							<div class="col-md-8">
								<input type="checkbox" id="dp" name="dp">
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-4">Net Pay:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npay" name="npay" >
								
							</div>
						</div>
						
						
						<input type="text" class="form-control hidden" id="totpf" name="totpf" >
						<input type="text" class="form-control hidden" id="totesi" name="totesi" >
						
						
						
					</div>
				</div>
				
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
						<input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="SUBMIT" />
						
					</div>
				</div>
			</form>
			
		</div>
	</div>
	
</div>
</div>
<script>
	$('.loandetails').hide();
	function earningcalculate()
	{
		sallowance=$('#sa').val();
		//alert(sallowance);
		basic=$('#bpay').val();
		hra_amt=$('#hra').val();
		ccna=$('#ccna').val();
		others=$('#oth').val();
		gearning=(parseFloat(sallowance)+parseFloat(basic)+parseFloat(hra_amt)+parseFloat(ccna)+parseFloat(others));
		// alert('gearning');
		$('#ge').val(gearning);
		a=0;
		loan=0;
		usr="<?php echo $temp=$sal->Uid;?>";
		$.ajax({
			url: 'getloandetaiforsalary',
			type: 'get',
			data: '&userid='+usr,
			success: function(data) {
				
				if(data=="[object Object]")
				{
					$('.loandetails').hide();
				}
				else
				{				
					$('.loandetails').show();
					$('#ln').val(data['loannum']);
					$('#ea').val(data['emiamt']);
					$('#ra').val(data['remainigamt']);
					$('#temp').val(data['ac']);
				}
			}
		});
		
	}
</script>
<script>
	function calculatededuction()
	{
		
		
		
		pfund1=$('#pf').val();
		itax=$('#it').val();
		ptax=$('#pt').val();
		basic=$('#ge').val();
		otherdedction=$('#od').val();
		
		pfund=basic*0.12;
		esi=basic*0.0175;
		gdeduction=(parseFloat(pfund)+parseFloat(itax)+parseFloat(ptax)+parseFloat(esi)+parseFloat(otherdedction));
		$('#gd').val(gdeduction);
		$('#esi').val(esi);
		gearn=$('#ge').val();
		netpay=(parseFloat(gearn)-parseFloat(gdeduction));
		a=$('#ea').val();
		
		totpf=pfund*2;
		soicetyesi=basic*0.045;
		totesi=soicetyesi+esi;
		$('#totpf').val(totpf);
		$('#totesi').val(totesi);
		loan=$('#temp').val();
		//alert('EMI = '+a);
		//alert('LOAN = '+loan);
		if(loan==0)
		{
			
		pay=(parseFloat(netpay)-parseFloat(a));
			$('#npay').val(pay);
			
}
		else if(loan==1)
		{
			$('#npay').val(netpay);
		}
		
		
		
		
		
		
		
		$('#dp').click(function(e){
			if($('#dp').is(":checked"))
			{
				$('#npay').val(netpay);
				noloan="YES";
			}
			else{
				a=$('#ea').val();
				netpay=(parseFloat(gearn)-parseFloat(gdeduction));
				pay=(parseFloat(netpay)-parseFloat(a));
				$('#npay').val(pay);
				noloan="NO";
			}
		});
		
	}
	
	
	
	
	
	
	
</script>
<script>
	indexid=0;
	$('.sbmbtn').click( function(e) {
		
		e.preventDefault();
		if(indexid==0)
		{
			indexid++;
			$.ajax({
				
				url: 'salaryinsert',
				type: 'post',
				data: $('#Form_sal').serialize()+'&noloan='+noloan,
				success: function(data) {
				alert("success");
					$('.salclassid').click();
					
				}
			});
		}
	});
</script>






